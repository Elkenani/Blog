<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $guarded = [];
    
    public function permissions(){

        return $this->belongsToMany(Permission::class);//i would have to add another parameter if we are not following convintions
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
