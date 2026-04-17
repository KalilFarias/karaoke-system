<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model{

    protected $fillable = [ 'user_id', 'pub_id', 'song_name', 'artist_name',  'status', 'position',];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pub(){
        return $this->belongsTo(Pub::class);
    }
   
}
