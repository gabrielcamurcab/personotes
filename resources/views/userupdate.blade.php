<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personotes - Cadastro</title>
    <link rel="stylesheet" href="public/css/app.css">
</head>
<body>
    <div class="card-container">
        <div class="card-100">
            <div class="card-title-principal">Personotes v1.0</div>
        </div>
    </div>
    <div class="container">
        <h2>Editar perfil</h2>
        @foreach ($users as $user)
            <form class="login" method="POST" action="{{ route('user.update') }}">
                @csrf
                <input type="text" name="name" placeholder="Nome" value="{{ $user->name }}">
                <input type="email" name="email" placeholder="E-mail" value="{{ $user->email }}">
                <input type="password" name="password" placeholder="Deixe vazio se não quiser alterar">
                <input type="submit" value="Atualizar">
                <a href="/notes">< Voltar</a>
            </form>
        @endforeach
    </div>
</body>
</html>
