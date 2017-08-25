<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
        'path', 'photoable_id','photoable_type',
    ];
    protected $userImages = '/images/users/';
    protected $postImages = '/images/posts/';


    public function photoable(){
        return $this->morphTo();
    }
    public function user(){
        return $this->hasOne('App\User');
    }

    public function post(){
        return $this->hasOne('App\Post');
    }
    public function getPathAttribute($value){
        if($this->photoable_type == 'App\User'){
            return $this->userImages . $value;
        }elseif ($this->photoable_type == 'App\Post'){
            return $this->postImages . $value;
        }

    }
}
