<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Series;
use App\Repositories\SeriesRepository;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $repository){}

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
        $series  = $this->repository->add($request);
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
