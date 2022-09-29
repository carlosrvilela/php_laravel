<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;
use App\Repositories\SeriesRepository;

class EpisodesController
{
    public function __construct(private SeriesRepository $seriesRepository)
    {

    }

    public function index(Season $season)
    {
        return view('episodes.index', [
            'episodes' => $season->episodes,
            'successMessage' => session('success.message')
        ]);

    }

    public function update(Request $request, Season $season)
    {
        $watchedEpisodes = (array)$request->episodes;

        $this->seriesRepository->updateWachedEpisodes($watchedEpisodes);


        return to_route('episodes.index', $season->id)->with('success.message', "Atualizado com sucesso!");
    }
}
