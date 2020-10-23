<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function config(){
        return view('user.config');
    }
    
    public function update(Request $request){
        
        //Obtiene usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        
        //Validacion de datos del formulario
        $validate = $this->validate($request, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);
        
        //Obtiene datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        
        //Subir imagen
        $image_path = $request->file('image_path');
        if($image_path){
            //Poner nombre unico
            $image_path_name = time().$image_path->getClientOriginalName();
            //Guardarla en la carpeta (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            //Setea nombre imagen en el objeto user
            $user->image = $image_path_name;
        }
        
        //Actualiza valores al usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        
        //Ejecutar consulta y cambios en la base de datos
        $user->update();
        
        return redirect()->route('config')->with(['message' => 'Usuario actualizado correctamente']);
    }
    
    public function update_password(Request $request){
        //Obtiene usuario identificado
        $user = \Auth::user();
        $id = $user->id;
        
        //Validamos campos
        $validate = $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required|string|min:6'
        ]);
        
        //Obtiene datos del formulario
        $old_password = $request->input('old_password');
        $password = $request->input('password');
        $password_confirmation = $request->input('password_confirmation');
        
        //Comprueba si coinciden los valores recibidos
        if(\Hash::check($old_password, $user->password) && $password == $password_confirmation){
            $user->password = Hash::make($password);
            $user->update();
            
            return redirect()->route('config')->with(['message_update_password' => 'Contraseña actualizada correctamente']);
        }else{
            
            return redirect()->route('config')->with(['message_update_password' => 'Error al actualizar contraseña']);
        }
        
    }
    
    
    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
