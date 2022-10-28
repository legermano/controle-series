<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::all();
        $successMessage = session('message.success');
        session()->forget('message.success');

        return view('series.index', compact('series', 'successMessage'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $series = Series::create($request->all());
        $seasons = [];

        for ($i=1; $i <= $request->seasonsQty; $i++)
        {
            $seasons[] = [
                'series_id' => $series->id,
                'number'    => $i,
            ];

        }

        Season::insert($seasons);

        $episodes = [];
        foreach ($series->seasons as $season)
        {
            for ($i=1; $i <= $request->episodesPerSeason; $i++)
            {
                $episodes[] = [
                    'season_id' => $season->id,
                    'number'    => $i,
                ];
            }
        }

        Episode::insert($episodes);

        return to_route('series.index')
            ->with('message.success', "Series '{$series->name}' addedd sucessefully!");
    }

    public function edit(Series $series)
    {
        return view('series.edit', compact('series'));
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('message.success', "Series '{$series->name}' updated sucessefully!");
    }

    public function destroy(Series $series)
    {
        $series->delete();
        return to_route('series.index')
            ->with('message.success', "Series '{$series->name}' deleted sucessefully!");
    }

}
