<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pub extends Model{

    protected $fillable = [ 'name'];


    public function songs(){
        return $this->hasMany(Song::class);
    }
}
