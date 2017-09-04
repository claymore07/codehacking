<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable=[
      'post_id', 'user_id','is_active','body',
    ];


    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function replies(){
        return $this->hasMany('App\CommentReply');
    }
}
