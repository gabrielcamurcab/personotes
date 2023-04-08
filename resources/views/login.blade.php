<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personotes - Login</title>
</head>
<body>
    <form method="POST" action="{{ route('auth.login') }}">
        @csrf
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="password" placeholder="Senha">
        <input type="submit" value="Login">
    </form>
</body>
</html>