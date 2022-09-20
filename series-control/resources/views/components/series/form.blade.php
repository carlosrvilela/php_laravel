<form action="{{ $action }}" method="post">
    @csrf

    @if($update)
        @method('PUT')
    @endif

    <div class="form-group mb-2">
        <label for="nome" class="form-label">Nome:</label>
        <input class="form-control"
            type="text"
            name="nome"
            id="nome"
            placeholder="nova série"
            @isset($nome)value="{{$nome}}" @endisset>
    </div>
    <button type="submit" class="btn btn-dark">{{ $btnSubmitText }}</button>
</form>
