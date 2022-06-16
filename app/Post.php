<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Post extends Model
{
    //
    protected $guarded = [];//mass assignment but without having to specify columns

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function setPostImageAttribute($value){
    //     $this->attributes['post_image'] = asset($value);
    // }

    public function getPostImageAttribute($value){
        return asset('storage/' . $value);
    }
}
