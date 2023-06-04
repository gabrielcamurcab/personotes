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
            <div class="card-title-principal">Personotes v1.0</div>
        </div>
        <div class="card-50">
            <div class="card-title"> {{ Auth::user()->name }} | <a href="auth/logout" class="card-button-red">Sair</a> |
                <a href="user/update" class="card-button">Editar</a>
            </div>
        </div>
    </div>
    <div class="card-container">
        <div class="card-100">
            <div class="card-title">Categorias</div><br>
                <a class="card-button-2" href="{{ route('notes.index') }}">Todas as notas</a>
                @foreach($categories as $categorie)
                    <a class="card-button-2" href="{{ route('notes.indexbycategorie', $categorie->id) }}">{{ $categorie->name }}</a>
                @endforeach
        </div>
        @if (count($notes) > 0)
            <div class="card-100">
                <div class="card-title">Deseja criar uma nova anotação?</div><br>
                <a href="{{ route('notes.index.create') }}" class="card-button">Criar anotação</a>
                <a href="{{ route('categories.index') }}" class="card-button">Criar categoria</a>
            </div>
            @foreach ($notes as $note)
                <div class="card" style="color: {{ $note->color }}; background-color: {{ $note->background_color }}">
                    <div class="card-title">{{ $note->title }}
                        @if ($note->favorite === 1)
                            <a style="color: {{ $note->color }};" href="{{ route('notes.unfavorite', $note->id) }}">
                                <i class="fa-solid fa-star"></i>
                            </a>
                        @else
                            <a style="color: {{ $note->color }};" href="{{ route('notes.favorite', $note->id) }}">
                                <i class="fa-regular fa-star"></i>
                            </a>
                        @endif
                    </div>
                    <div class="card-text">{!! $note->text !!}</div>
                    <strong>Categoria: </strong> 
                    @if ($note->categorieName)
                        {{ $note->categorieName }}
                    @else
                        Sem categoria
                    @endif
                    <br><br>
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

    <script src="https://cdn.jsdelivr.net/npm/easymde/dist/easymde.min.js"></script>
    <script src="https://kit.fontawesome.com/6cc45966dd.js" crossorigin="anonymous"></script>
    <script>
        const easyMDE = new EasyMDE({
            showIcons: ['strikethrough', 'code', 'table', 'redo', 'heading', 'undo', 'heading-bigger',
                'heading-smaller', 'heading-1', 'heading-2', 'heading-3', 'clean-block', 'horizontal-rule'
            ],
            element: [document.getElementByClassName('markdown-editor')]
        });
        easyMDE.codemirror.setOption('readOnly', true);
    </script>
</body>

</html>
