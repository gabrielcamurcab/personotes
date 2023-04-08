<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PersoNotes - Notas</title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
    <div class="card-container">
        <div class="card-50">
            <div class="card-title-principal">Personotes v1.0</div>
        </div>
        <div class="card-50">
            <div class="card-title"> {{ Auth::user()->name }} | <a href="auth/logout" class="card-button-red">Sair</a> | <a href="user/update" class="card-button">Editar</a></div>
        </div>
        @if(count($notes) > 0)
            <div class="card-100">
                <div class="card-title">Deseja criar uma nova anotação?</div><br>
                <a href="notes/create" class="card-button">Criar anotação</a>
            </div>
            @foreach ($notes as $note)
                <div class="card">
                    <div class="card-title">{{ $note->title }}</div>
                    <textarea style="resize: none" rows="7" readonly>{{ $note->text }}</textarea><br><br>
                    <div class="card-buttons">
                    <a href="notes/update/{{ $note->id }}" class="card-button">Editar</a>
                    <a href="notes/delete/{{ $note->id }}" class="card-button">Excluir</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card-100">
                <div class="card-title">Você ainda não tem anotações</div><br>
                <a href="notes/create" class="card-button">Criar anotação</a>
            </div>
        @endif
    </div>
</body>
</html>