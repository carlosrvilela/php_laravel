<x-layout title="Nova Série">
    <x-series.form :action="route('series.store')" :nome="old('nome')" :update="false" btnSubmitText="Adicionar">
    </x-series.form>
</x-layout>
