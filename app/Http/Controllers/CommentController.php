<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function save(Request $request){
        // validacion
        $validate = $request->validate([
            'image_id' => 'integer|required',
            'content' => 'string|required',
        ]);
        // recoger datos del formularion
        $user = Auth::user();
        $image_id = $request->input('image_id');
        $content = $request->input('content');
        // asigno los valores en el objeto
        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->image_id = $image_id;
        $comment->content = $content;
        // guardar en la bd
        $comment->save();
        // redireccion
        return redirect()
            ->route('image.detail', ['id' => $image_id])
            ->with([
                'message' => 'New comment added',
            ]);
    }

    public function delete($id){
        // conseguir datos del usuario logueado
        $user = Auth::user();
        // conseguir objeto del comentario
        $comment = Comment::find($id);
        // comprobar si soy el dueño del comentario o de la publicacion
        if ($user && ($comment->user_id == $user->id || $comment->image->user_id == $user->id)) {
            $comment->delete();
            return redirect()
                ->route('image.detail', ['id' => $comment->image->id])
                ->with([
                    'message' => 'Comment deleted',
                ]);
        } else {
            return redirect()
                ->route('image.detail', ['id' => $comment->image->id])
                ->with([
                    'message' => 'Error deleting comment',
                ]);
        }
    }
}
