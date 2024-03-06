<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personotes - Esqueci a senha</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <div class="card-container">
        <div class="card-100">
            <div class="card-title-principal"><img src="/img/logo.png"></div>
        </div>
    </div>
    <div class="container">
        <h2>Esqueci a senha</h2>
        <form class="login" method="POST" action="{{ route('password.forgot') }}">
            @csrf
            @error('email')
                <div class="alert-danger">{{ $message }}</div>
            @enderror
            @if (session()->has('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <input type="email" name="email" placeholder="E-mail">
            <input type="submit" value="Solicitar nova senha">
        </form>
    </div>
</body>

</html>
