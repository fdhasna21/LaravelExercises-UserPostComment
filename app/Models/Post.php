<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //1 Post : 1 User
    public function userPost(){
        return$this->belongsTo(User::class);
    }

    //1 Post : many Comment
    public function postComment(){
        return$this->hasMany(Comment::class);
    }
}
