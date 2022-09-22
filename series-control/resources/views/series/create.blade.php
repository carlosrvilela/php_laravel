<x-layout title="Nova Série">
    <form action="{{ route('series.store') }}" method="post">
        @csrf

        <div class="row mb-3">

            <div class="col-8">
                <label for="nome" class="form-label">Nome:</label>
                <input class="form-control"
                    type="text"
                    autofocus
                    name="nome"
                    id="nome"
                    placeholder="nova série"
                    value="{{ old('nome') }}">
            </div>

            <div class="col-2">
                <label for="seasonsQuantity" class="form-label">N° Temporadas:</label>
                <input class="form-control"
                    type="text"
                    name="seasonsQuantity"
                    id="seasonsQuantity"
                    placeholder="01"
                    value="{{ old('seasonsQuantity') }}">
            </div>

            <div class="col-2">
                <label for="episodesPerSeason" class="form-label">Episódeos por Temporada:</label>
                <input class="form-control"
                    type="text"
                    name="episodesPerSeason"
                    id="episodesPerSeason"
                    placeholder="01"
                    value="{{ old('episodesPerSeason') }}">
            </div>

        </div>

        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>
