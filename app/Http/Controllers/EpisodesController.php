<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EpisodesController extends Controller
{
    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'successMessage' => session('message.success')
        ]);
    }

    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = $request->episodes;

        DB::transaction(function() use($season, $watchedEpisodes) {
            $season->episodes->each(function (Episode $episode) use($watchedEpisodes) {
                $episode->watched = in_array($episode->id, $watchedEpisodes);
            });

            $season->push();
        });

        return to_route('episodes.index', $season->id)
            ->with('message.success', 'Episodes marked as watched!');
    }
}
