<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personotes - E-mail de verificação enviado</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
    <div class="card-container">
        <div class="card-100">
            <div class="card-title-principal"><img src="/img/logo.png"></div>
        </div>
    </div>
    <div class="container">
        <h2>Verifique seu e-mail</h2>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <div class="alert-success">Um e-mail de verificação foi enviado para você!</div>
        <a href="{{ route('verification.send') }}">Reenviar link</a>
    </div>
</body>

</html>
