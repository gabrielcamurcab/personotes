<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PersoNotes - Notas</title>
</head>
<body>
    <form method="POST" action="{{ route('notes.create') }}">
        @csrf
        <input type="text" name="title" placeholder="Titulo">
        <input type="text" name="text" placeholder="Texto">
        <input type="submit" value="Criar">
    </form>
</body>
</html>