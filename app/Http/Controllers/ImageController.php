<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class ImageController extends Controller
{
/*    public function __construct() {
        $this->middleware('auth');
    }*/

    public function create() {
        return view('image.create');
    }

    public function save(Request $request) {
        // validacion
        $request->validate([
            'description' => 'required',
            'image_path' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // recoger datos
        $image_path = $request->file('image_path');
        $description = $request->input('description');
        // asignar valores al objeto
        $user = Auth::user();
        $image = new Image();
        $image->user_id = $user->id;
        $image->description = $description;
        // subir fichero
        if ($image_path) {
            $image_path_name = time() . $image_path->getClientOriginalName();
            Storage::disk('images')->put($image_path_name, File::get($image_path));
            $image->image_path = $image_path_name;
        }
        $image->save();
        return redirect()->route('home')->with([
            'message' => 'Image uploaded successfully!'
        ]);
    }

    public function getImage($filename) {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('image.detail', ['image' => $image]);
    }

    public function delete($id){
        $user = Auth::user();
        $image = Image::find($id);
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        if ($user && $image && $image->user->id == $user->id) {
            // Eliminar Comentario
            if ($comments && count($comments) > 0) {
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            // Eliminar Likes
            if ($likes && count($likes) > 0) {
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            // Eliminar ficheros de la imagen
            Storage::disk('images')->delete($image->image_path);
            // Eliminar Registro de Imagen
            $image->delete();
            $message = array('message' => 'Image deleted successful');
        } else {
            $message = array('message' => 'Image deletion failed!');
        }
        return redirect()->route('home')->with($message);
    }
}
