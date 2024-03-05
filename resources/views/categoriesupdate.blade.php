<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PersoNotes - Editar categoria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
    <link rel="stylesheet" href="/public/css/app.css">
</head>

<body>
    <div class="card-container">
        <div class="card-50">
            <div class="card-title-principal">Personotes v1.0</div>
        </div>
        <div class="card-50">
            <div class="card-title"> {{ Auth::user()->name }} | <a href="auth/logout" class="card-button-red">Sair</a>
            </div>
        </div>
    </div>
    <div class="container">
        <h2>Editar categoria</h2>
        <form class="note" method="POST" action="{{ route('categories.update') }}">
            @csrf
            @foreach ($categories as $categorie)
                <input type="hidden" name="id" value="{{ $categorie->id }}">
                <input type="text" name="name" placeholder="Nome da categoria" value="{{ $categorie->name }}">
            @endforeach
            <input type="submit" value="Salvar">
            <a href="/categories">
                < Voltar</a>
        </form>
    </div>
</body>

</html>
