<x-layout title="Editar Série '{{ $serie->nome }}'">
    <x-series.form action="{{ route('series.update', $serie->id) }}" nome="{{ $serie->nome }}" btnSubmitText="Atualizar">
    </x-series.form>
</x-layout>

