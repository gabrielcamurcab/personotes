<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personotes - Login</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="card-container">
        <div class="card-100">
            <div class="card-title-principal">Personotes v1.0</div>
        </div>
    </div>
    <div class="container">
        <h2>Faça login</h2>
        <form class="login" method="POST" action="{{ route('auth.login') }}">
            @csrf
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Senha">
            <input type="submit" value="Login">
            <a href="cadastro">Cadastrar-se</a>
        </form>
    </div>
</body>
</html>