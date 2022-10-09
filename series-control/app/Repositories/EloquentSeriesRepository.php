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
            $serie = Series::create([
                'nome' => $request->nome,
                'cover_path' => $request->coverPath,
            ]);

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

    public function updateWachedEpisodes(Array $watchedEpisodes): void
    {
        DB::transaction(function () use ($watchedEpisodes) {
            DB::table('episodes')->whereIn('id', $watchedEpisodes)->update(['watched' => true]);
            DB::table('episodes')->whereNotIn('id', $watchedEpisodes)->update(['watched' => false]);
        });
    }
}
