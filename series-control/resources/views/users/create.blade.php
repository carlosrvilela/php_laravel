<x-layout title="Registro de usuário">

    <form method="post">
        @csrf

        <div class="form-grup">
            <label for="name", class="form-label">Nome de usuário</label>
            <input type="name", name="name", id="name", class="form-control">
        </div>

        <div class="form-grup">
            <label for="email", class="form-label">E-mail</label>
            <input type="email", name="email", id="email", class="form-control">
        </div>

        <div class="form-grup">
            <label for="password", class="form-label">Senha</label>
            <input type="password", name="password", id="password", class="form-control">
        </div>

        <button class="btn btn-primary mt-3">
            Registrar
        </button>

    </form>
</x-layout>
