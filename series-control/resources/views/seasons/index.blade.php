<x-layout title="Temporadas de {{ $series->nome }}">
    <div class="d-flex justify-center">
        <img  alt="Capa da Série"
        @if($series->cover_path)
        src="{{ asset('storage/'.$series->cover_path) }}"
        @else
        src="{{ asset('storage/img/default_img.jpg') }}"
        @endif
        style="height: 300px"
        class="img-fluid">
    </div>


    <ul class="list-group">
        @foreach ($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <a href="{{route('episodes.index', $season->id)}}">
                    Temporada {{ $season->number }}
                </a>

                <samp class="badge bg-secondary">
                     {{ $season->numberOfWhachedEpisodes() }} / {{ $season->episodes->count() }}
                </samp>
            </li>
        @endforeach
    </ul>
</x-layout>
