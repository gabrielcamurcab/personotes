<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personotes - Cadastro</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="card-container">
        <div class="card-100">
            <div class="card-title-principal">Personotes v1.0</div>
        </div>
    </div>
    <div class="container">
        <h2>Faça seu cadastro</h2>
        <form class="login" method="POST" action="{{ route('auth.register') }}">
            @csrf
            <input type="text" name="name" placeholder="Nome">
            <input type="email" name="email" placeholder="E-mail">
            @error('email')
                <div class="alert-danger">{{ $message }}</div>
            @enderror
            <input type="password" name="password" placeholder="Senha">
            @error('password')
                <div class="alert-danger">{{ $message }}</div>
            @enderror
            <input type="submit" value="Cadastrar">
            <a href="login">Fazer login</a>
        </form>
    </div>
</body>
</html>