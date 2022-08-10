<x-layout title="Nova Série">
    <form action="/series/salvar", method="post">
        @csrf
        <div class="form-group mb-2">
            <label for="nome" class="form-label">Nome:</label>
            <input type="text" name="nome" id="nome" placeholder="nova série" class="form-control">
        </div>
        <button type="submit" class="btn btn-dark">Adicionar</button>
    </form>
</x-layout>
