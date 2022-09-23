<x-layout title="Séries">
    <a href={{ route('series.create') }} class="btn btn-dark mb-2">Adicionar Nova Série</a>

    @isset($successMessage)
    <div class="alert alert-success">
        {{$successMessage}}
    </div>
    @endisset

    <ul class="list-group">
        @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="{{ route('seasons.index', $serie->id) }}">
                {{ $serie->nome }}
            </a>


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
        @endforeach
    </ul>
</x-layout>
