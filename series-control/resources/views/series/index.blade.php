<x-layout title="Séries" :success-message="$successMessage">
    @auth
    <a href={{ route('series.create') }} class="btn btn-dark mb-2">Adicionar Nova Série</a>
    @endauth

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <img alt="Capa da Série"
                @if($serie->cover_path)
                src="{{ asset('storage/'.$serie->cover_path) }}"
                @else
                src="{{ asset('storage/img/default_img.jpg') }}"
                @endif
                width="150 px"
                class="img-thumbnail me-3">

                @auth <a href="{{ route('seasons.index', $serie->id) }}"> @endauth
                    {{ $serie->nome }}
                @auth </a> @endauth
            </div>

            @auth
            <samp class="d-flex">
                <a href="{{ route('series.edit', $serie->id) }}" class="btn btn-primary btn-sm">Editar</a>


                <form action="{{ route('series.destroy', $serie->id) }}" method="post" class="ms-2">
                    @csrf
                    @method('DELETE')
                    <button class= "btn btn-danger btn-sm">
                        Excuir!
                    </button>
                </form>
            </li>
            </samp>
            @endauth
        @endforeach
    </ul>
</x-layout>
