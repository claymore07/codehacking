<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable=[
      'title', 'body', 'user_id', 'photo_id', 'category_id',
    ];

    public function photo(){
        return $this->belongsTo('App\Photo');
    }


    public function user(){
        return $this->belongsTo('App\User');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }

    // polymorphic m2m with photo
    public function photos(){
        return $this->morphMany('App\Photo', 'photoable');
    }
}
