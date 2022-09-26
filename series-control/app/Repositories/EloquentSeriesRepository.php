<?php

namespace App\Repositories;

use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\SeriesFormRequest;

class EloquentSeriesRepository implements SeriesRepository{
    public function add(SeriesFormRequest $request): Series
    {
        return DB::transaction(function () use ($request, &$serie) {
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

            return $serie;
        });
    }
}
