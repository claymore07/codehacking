<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $fillable = [
        'path'
    ];
    protected $userImages = '/images/users/';

    public function user(){
        return $this->hasOne('App\User');
    }
    public function getPathAttribute($value){
        return $this->userImages . $value;
    }
}
