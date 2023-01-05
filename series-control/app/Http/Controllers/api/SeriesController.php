<?php
namespace App\Http\Controllers\api;

use App\Models\Series;
use App\Http\Controllers\Controller;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function __construct(private SeriesRepository $seriesRepository)
    {
    }

    public function index()
    {
        return Series::all();
    }

    public function store(SeriesFormRequest $request)
    {
        $series = $this->seriesRepository->add($request);

        return response()
            ->json($series, 201);
    }

    public function show(int $seriesId)
    {
        $series = Series::whereId($seriesId)
            ->with('seasons.episodes')
            ->first();

        return $series;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    public function destroy(int $series)
    {
        Series::destroy($series);
        return response()->noContent();
    }
}
