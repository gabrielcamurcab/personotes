<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PersoNotes - Notas</title>
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
</head>
<body>
    <div class="card-container">
        <div class="card-50">
            <div class="card-title-principal"><img src="/img/logo.png"></div>
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
            <textarea id="markdown-editor" style="resize: none" rows="7" name="text" placeholder="Texto">{{ $note->text }}</textarea>
            Categoria:<br>
            <select name="categorie_id">
                <option value="{{ $note->categorie_id }}">{{ $note->categorieName }} (Categoria atual)</option>
                <option value="">Sem categoria</option>
                @foreach ($categories as $categorie)
                    <option value={{ $categorie->id }}>{{ $categorie->name }}</option>
                @endforeach
            </select><br>
            Cor do texto: <input type="color" name="color" value="{{ $note->color }}"> Cor do fundo: <input type="color" name="background_color" value="{{ $note->background_color }}"><br><br>
            <input type="submit" value="Atualizar">
            <a href="/notes">< Voltar</a>
        </form>
    @endforeach
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
    <script>
        const easyMDE = new EasyMDE({
            showIcons: ['strikethrough', 'code', 'table', 'redo', 'heading', 'undo', 'heading-bigger', 'heading-smaller', 'heading-1', 'heading-2', 'heading-3', 'clean-block', 'horizontal-rule'],
            element: document.getElementById('markdown-editor')});
    </script>
</html>
