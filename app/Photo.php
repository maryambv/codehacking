<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $uploads = "/images/";
    protected $fillable=['file','user_id','post_id','is_profile'];

    public function getFileAttribute($photo){
        return $this->uploads . $photo;
    }
}
