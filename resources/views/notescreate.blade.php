<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PersoNotes - Notas</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.css">
        <link rel="stylesheet" href="/css/app.css">
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
        <h2>Criar anotação</h2>
        <form class="note" method="POST" action="{{ route('notes.create') }}">
            @csrf
            @error('title')
                <div class="alert-danger">{{ $message }}</div>
            @enderror
            @error('text')
                <div class="alert-danger">{{ $message }}</div>
            @enderror
            <input type="text" name="title" placeholder="Titulo">
            <textarea id="markdown-editor" style="resize: none" rows="7" name="text" placeholder="Texto"></textarea>
            Categoria:<br>
            <select name="categorie_id">
                <option value="">Sem categoria</option>
                @foreach ($categories as $categorie)
                    <option value={{ $categorie->id }}>{{ $categorie->name }}</option>
                @endforeach
            </select><br>
            Cor do texto: <input type="color" name="color" value="#ffffff"> Cor do fundo: <input type="color" name="background_color" value="#000000"><br><br>
            <input type="submit" value="Criar">
            <a href="/notes">< Voltar</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
    <script>
        const easyMDE = new EasyMDE({
            showIcons: ['strikethrough', 'code', 'table', 'redo', 'undo', 'clean-block', 'horizontal-rule'],
            element: document.getElementById('markdown-editor')});
    </script>
</body>
</html>
