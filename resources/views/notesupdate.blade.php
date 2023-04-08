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
            <div class="card-title"> {{ Auth::user()->name }} | <a href="auth/logout" class="card-button-red">Sair</a> </div>
        </div>
    </div>
    <div class="container">
        <h2>Editar anotação</h2>
    {{-- {{ dd($notes) }} --}}
    @foreach ($notes as $note)
        <form class="note" method="POST" action="{{ route('notes.update') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $note->id }}">
            <input type="text" name="title" placeholder="Titulo" value="{{ $note->title }}">
            <textarea style="resize: none" rows="7" name="text" placeholder="Texto">{{ $note->text }}</textarea>
            <input type="submit" value="Atualizar">
            <a href="/notes">< Voltar</a>
        </form>
    @endforeach
    </div>
</body>
</html>