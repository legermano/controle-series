<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeriesRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository){}

    public function index(Request $request)
    {
        $query = Series::query();

        if($request->has('name')) {
            $query->where('name', $request->name);
        }

        return $query->paginate(5);
    }

    public function store(SeriesRequest $request)
    {
        return response()
            ->json($this->seriesRepository->add($request), 201);
    }

    public function show(int $seriesId){
        $seriesModel = Series::with('seasons.episodes')->find($seriesId);

        if($seriesModel == null)
        {
            return response()->json(['message' => 'Series not found'], 404);
        }

        return $seriesModel;
    }

    public function update(Series $series, SeriesRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    public function destroy(int $seriesId)
    {
        Series::destroy($seriesId);

        return response()->noContent();
    }
}
