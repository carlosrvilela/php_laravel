<?php

namespace App\Repositories;

use App\Models\Series;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;

interface SeriesRepository
{
    public function add(SeriesFormRequest $request): Series;

    public function updateWachedEpisodes(Array $watchedEpisodes): void;
}
