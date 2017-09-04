<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    //
    protected $fillable=[
      'comment_id', 'user_id', 'post_id', 'body', 'is_active',
    ];


    public function comment(){
        return $this->belongsTo('App\Comment');
    }
    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
