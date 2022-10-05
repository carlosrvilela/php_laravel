<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Series;
use App\Mail\SeriesCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;

class SeriesController extends Controller
{
   public function __construct(private SeriesRepository $seriesRepository)
   {
        $this->middleware('auth')->except('index');
   }
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
        $serie = $this->seriesRepository->add($request);

        $usersList = User::all();
        foreach ($usersList as $index => $user) {
            $email = new SeriesCreated(
                $serie->nome,
                $serie->id,
                $request->seasonsQuantity,
                $request->episodesPerSeason

            );

            $delay = now()->addSeconds($index * 5);
            Mail::to($user)->later($delay, $email);
        }

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
