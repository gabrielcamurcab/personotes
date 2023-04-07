<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PersoNotes - Cadastro</title>
</head>
<body>
    <form method="POST" action="{{ route('api.register') }}">
        @csrf
        <input type="text" name="name" placeholder="Nome">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Senha">
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>