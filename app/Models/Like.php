<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likes';

    // Relation 1:N
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    // Relation 1:N
    public function image()
    {
        return $this->belongsTo('App\Models\Image', 'image_id');
    }
}
