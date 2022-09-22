<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Series::all();
        $successMessage = $request->session()->get('success.message');

        return view('series.index')
            ->with('series', $series)
            ->with('successMessage', $successMessage);
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = Series::create($request->all());

        $seasons = [];
        for ($seasonNumber = 1; $seasonNumber <= $request->seasonsQuantity; $seasonNumber++) {
            $seasons [] = [
                'series_id' => $serie->id,
                'number' => $seasonNumber
            ];
        }
        Season::insert($seasons);

        $episodes = [];
        foreach ($serie->seasons as $season) {
            for ($episodeNumber = 1; $episodeNumber <= $request->episodesPerSeason; $episodeNumber++) {
                $episodes [] = [
                    'season_id' => $season->id,
                    'number' => $episodeNumber
                ];
            }
        }
        Episode::insert($episodes);

        return to_route('series.index')
            ->with('success.message', "Série '{$serie->nome}' adicionada com sucesso");
    }

    public function destroy(Series $series)
    {
        $series->delete();

        return to_route('series.index')
            ->with('success.message', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series, Request $request)
    {
        return view('series.edit')
            ->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')
            ->with('success.message', "Série '{$series->nome}' atualizada com sucesso");
    }
}
