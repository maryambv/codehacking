<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable =[
        'title',
        'body',
        'category_id',

    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function photo(){
        return $this->hasMany('App\Photo');
    }
    public function comment(){
        return $this->hasMany('App\Comment');
    }
    public function category(){
        return $this->belongsTo('App\Category');
    }
}
