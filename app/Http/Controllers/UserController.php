<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){
        // obtener usuario identificado
        $id = Auth::user()->id;
        $user = Auth::user();
        // validacion de campos
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|unique:users,nick,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        ]);
        // obtener datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');
        // asignar nuevos valores al objeto de usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;
        // subir la imagen
        $image_path = $request->file('image_path');
        if ($image_path) {
            // poner nombre unico
            $image_path_name = time() . $image_path->getClientOriginalName();
            // guardar en la capeta storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));
            // setear el nombre de la imagen en el objeto
            $user->image = $image_path_name;
        }
        // ejecutar consulta y cambios en la bd
        $user->update();

        return redirect()
            ->route('config')
            ->with(['message'=>'User Updated Successfully']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
