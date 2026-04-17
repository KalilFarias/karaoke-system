<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Pub;

class SongController extends Controller
{

    public function store(Request $request)
    {

        $user = auth()->user();

        $exists = Song::where('user_id', $user->id)
            ->where('pub_id', $request->pub_id)
            ->where('status', 'waiting')
            ->exists();

        if ($exists) {
            return back()->with('error', 'Você já está na fila.');
        }

        $lastPosition = Song::where('pub_id', $request->pub_id)
            ->max('position');

        Song::create([
            'user_id' => $user->id,
            'pub_id' => $request->pub_id,
            'song_name' => $request->song_name,
            'artist_name' => $request->artist_name,
            'position' => $lastPosition + 1,
        ]);

        return back()->with('success', 'Adicionado à fila!');
    }

    public function callNext($pubId)
    {
        // pegar próxima música da fila
        $song = Song::where('pub_id', $pubId)
            ->where('status', 'waiting')
            ->orderBy('position')
            ->first();

        if (!$song) {
            return back()->with('error', 'Fila vazia!');
        }

        $song->update([
            'status' => 'called',
            'called_at' => now()
        ]);

        return back()->with('success', 'Chamando: ' . $song->song_name);
    }

    public function finish($id)
    {

        $song = Song::findOrFail($id);

        $song->update([
            'status' => 'finished',
            'finished_at' => now()
        ]);

        return back()->with('success', 'Música finalizada!');
    }
    public function destroy($id)
    {
        if (!auth()->user()->is_admin) {
            abort(403, 'Acesso negado');
        }

        $song = Song::findOrFail($id);
        $song->delete();

        return back()->with('success', 'Removido da fila');
    }
}
