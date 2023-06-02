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
        @if(isset($message))
            <div class="alert-success">{{ $message }}</div>
        @endif
        <form class="note" method="POST" action="{{ route('categories.create') }}">
            @csrf
            <input type="text" name="name" placeholder="Nome da categoria">
            <input type="submit" value="Criar">
            <a href="/notes">< Voltar</a>
        </form>
    </div>
    <div class="container">
        @foreach ($categories as $categorie)
            <table>
                <tr>
                    <td>{{ $categorie->name }}</td>
                    <td><a href="#">Editar</a></td>
                    <td><a href="#">Excluir</a></td>
                </tr>
            </table>
        @endforeach
    </div>
</body>
</html>