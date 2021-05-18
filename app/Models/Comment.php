<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //1 Comment : 1 Post, 1 User
    public function postComment(){
        return$this->belongsTo(Comment::class);
    }

    public function userComment(){
        return$this->belongsTo(User::class);
    }
}
