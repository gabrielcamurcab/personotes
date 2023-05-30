<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PersoNotes - Criar categoria</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
        <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="card-container">
        <div class="card-50">
            <div class="card-title-principal">Personotes v1.0</div>
        </div>
        <div class="card-50">
            <div class="card-title"> {{ Auth::user()->name }} | <a href="auth/logout" class="card-button-red">Sair</a> </div>
        </div>
    </div>
    <div class="container">
        <h2>Criar categoria</h2>
        @foreach($categories as $categorie)
            {{ $categorie->name }}
        @endforeach
        <form class="note" method="POST" action="{{ route('categories.create') }}">
            @csrf
            <input type="text" name="name" placeholder="Nome da categoria">
            <input type="submit" value="Criar">
            <a href="/notes">< Voltar</a>
        </form>
    </div>
</body>
</html>