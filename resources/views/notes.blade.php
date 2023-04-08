<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PersoNotes - Notas</title>
</head>
<body>
    @foreach ($notes as $note)
        <div class="container">
            <h1>{{ $note->title }}</h1>
            <p>{{ $note->text }}</p>
        </div>
    @endforeach
</body>
</html>