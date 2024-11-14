<?php

namespace App\Http\Controllers;

//básicos
use App\Http\Controllers\Controller; //funcionalidad base para controladores
use Illuminate\Http\Request; //manejar solicitudes http
 
//validar
use Exception; //para el trycatch

// conectarse a otras apis
use Illuminate\Support\Facades\Http; //para consumir apis externas
use App\Models\Token;

//propios de user
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

//para el correo con ruta firmada
use App\Mail\VerificarCorreo; //importar la clase
use Illuminate\Support\Facades\URL; //ruta temporal
use Illuminate\Support\Carbon; //tiempo de la url firmada
use Illuminate\Support\Facades\Mail; //enviar correos

//para los roles de usuario
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use Notifiable, HasRoles;

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $user->assignRole('guest');

            if (!$user) {
                return response()->json([
                    'message' => 'No se pudo crear el usuario'
                ], 500);
            }

            if (isset($user)) { 

                $signedUrl = URL::temporarySignedRoute(
                    'activate.account', // nombre de la ruta
                    Carbon::now()->addMinutes(5),
                    ['user' => $user->id]
                );

                Mail::to($user->email)->send(new VerificarCorreo($user, 'Registro exitoso', $signedUrl));
                
                return response()->json([
                    'message' => 'Usuario creado, favor de revisar su correo para seguir con el proceso.',
                    'user' => $user,
                ], 201);
            }
    }
    
    public function read($id = null)
    {
        if ($id) {
            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Usuario no encontrado'], 404);
            }
        } else {
            $user = User::all();
        }
        return response()->json($user, 200);
    }

    public function update(Request $request, $id)
    {
        if (!$id) {
            return response()->json(['message' => 'Favor de ingresar un usuario'], 400); // Cambio a 400 Bad Request
        }
    
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    
        $validatedData = $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8',
        ]);
        /*El uso de $user->id en la validación de email es una técnica 
        para evitar que el sistema valide como único el correo electrónico 
        del mismo usuario que está siendo actualizado. Esto es necesario 
        porque cuando intentas actualizar un usuario, es posible que 
        su correo electrónico sea el mismo que ya tenía, y si no se 
        excluye su propio ID de la validación, Laravel considerará que 
        el correo electrónico ya está en uso por otro usuario, incluso si 
        es el mismo.*/ 

        $user->update($validatedData);
    
        return response()->json(['message' => 'Actualización exitosa', 'user' => $user], 200);
    }

    public function delete($id)
    {
        if (!$id) {
            return response()->json(['message' => 'Favor de ingresar un usuario'], 400);
        }
    
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }
    
        $user->delete();
    
        return response()->json(['message' => 'Usuario eliminado', 'user' => $user], 200);
    }
    

    public function uploadPP(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

       $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($user->profile_photo_path) {
            Storage::disk('spaces')->delete($user->profile_photo_path);
        }

        $path = $request->file('photo')->store('profile_pictures', 'spaces');
        $user->update(['profile_photo_path' => $path]);

        $photoUrl = Storage::disk('spaces')->url($path);

        return response()->json(['message' => 'Foto de perfil actualizada', 'photo_url' => $photoUrl]);
    }

    public function deletePP()
    {
        $user = Auth::user();
    
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        if ($user->profile_photo_path) {
            Storage::disk('spaces')->delete($user->profile_photo_path);
            $user->update(['profile_photo_path' => null]);
            return response()->json(['message' => 'Foto de perfil eliminada']);
        }
        return response()->json(['error' => 'No hay foto de perfil para eliminar'], 404);
    }

    public function downloadPP()
    {
        $user = Auth::user();

        if (!$user->profile_photo_path || !Storage::disk('spaces')->exists($user->profile_photo_path)) {
            return response()->json(['error' => 'Foto de perfil no encontrada'], 404);
        }

        $fileContent = Storage::disk('spaces')->get($user->profile_photo_path);

        return response($fileContent)->header('Content-Type', 'image/png');
    }
}