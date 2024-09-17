<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like($image_id){
        // recoger datos de usuatio y la imagen
        $user = Auth::user();
        // condicion para ver si ya existe el like y no duplicarlo
        $isset_like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->count();
        if ($isset_like == 0) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
            // guardar
            $like->save();
            return response()->json([
                "like" => $like,
            ]);
        } else {
            return response()->json([
                'message' => 'El like ya existe',
            ]);
        }
    }

    public function dislike($image_id){
        // recoger datos de usuatio y la imagen
        $user = Auth::user();
        // condicion para ver si ya existe el like y no duplicarlo
        $like = Like::where('user_id', $user->id)
            ->where('image_id', $image_id)
            ->first();
        if ($like) {
            // eliminar
            $like->delete();
            return response()->json([
                "like" => $like,
                'message' => 'El like ha sido eliminado',
            ]);
        } else {
            return response()->json([
                'message' => 'El like no existe',
            ]);
        }
    }
}
