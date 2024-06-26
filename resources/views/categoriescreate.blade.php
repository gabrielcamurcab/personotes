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
            <div class="card-title-principal"><img src="/img/logo.png"></div>
        </div>
        <div class="card-50">
            <div class="card-title"> {{ Auth::user()->name }} | <a href="auth/logout" class="card-button-red">Sair</a>
            </div>
        </div>
    </div>
    <div class="container">
        <h2>Criar categoria</h2>
        @if (isset($message))
            <div class="alert-success">{{ $message }}</div>
        @endif
        <form class="note" method="POST" action="{{ route('categories.create') }}">
            @csrf
            <input type="text" name="name" placeholder="Nome da categoria">
            <input type="submit" value="Criar">
            <a href="/notes">
                < Voltar</a>
        </form>
    </div>
    <div class="container">
        <div class="note">
            @foreach ($categories as $categorie)
                <table>
                    <tr>
                        <td width="460px">{{ $categorie->name }}</td>
                        <td height="50px"><a href="categories/update/{{ $categorie->id }}"" class="card-button">Editar</a></td>
                        <td height="50px"><a href="categories/delete/{{ $categorie->id }}" class="card-button-red">Excluir</a></td>
                    </tr>
                </table>
            @endforeach
        </div>
    </div>
</body>

</html>
