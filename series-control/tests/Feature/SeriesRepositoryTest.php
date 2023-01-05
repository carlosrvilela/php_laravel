<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SeriesRepositoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_when_a_series_is_created_its_seasons_and_episodes_must_also_be_created(): void
    {
        // Arrenge
        /** @var SeriesRepository $repository */
        $repository = $this->app->make(SeriesRepository::class);

        $request = new SeriesFormRequest();
        $request->nome = 'Nome';
        $request->seasonsQuantity = 1;
        $request->episodesPerSeason = 1;

        // Act
        $repository->add($request);

        // Assert
        $this->assertDatabaseHas('series', ['nome' => 'Nome']);
        $this->assertDatabaseHas('seasons', ['number' => 1]);
        $this->assertDatabaseHas('episodes', ['number' => 1]);
    }
}
