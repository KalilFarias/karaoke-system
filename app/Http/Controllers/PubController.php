<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Song;
use App\Models\Pub;
use Illuminate\Http\Request;

class PubController extends Controller{

    public function show($slug){
            
        $pub = Pub::where('slug', $slug)->firstOrFail();

        $queue = Song::where('pub_id', $pub->id)
            ->where('status', 'waiting')
            ->orderBy('position')
            ->get();

        return view('pub.show', compact('pub', 'queue'));
    }
  
}
