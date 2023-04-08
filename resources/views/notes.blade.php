<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PersoNotes - Notas</title>
    <style>
        body {
          background-color: #f2f2f2;
        }

        .card-container {
            display: flex;
            flex-wrap: wrap;
            /* justify-content: space-between; */
        }
    
        .card {
          background-color: #fff;
          border-radius: 5px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
          margin: 10px;
          padding: 20px;
          width: 300px;
        }

        .card-100 {
          background-color: #fff;
          border-radius: 5px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.15);
          margin: 10px;
          padding: 20px;
          width: 100%;
        }
    
        .card-title {
          color: #3366cc;
          font-size: 24px;
          font-weight: bold;
          margin-bottom: 10px;
        }

        .card-title-principal {
          color: #001d57;
          font-size: 24px;
          font-weight: bold;
        }
    
        .card-text {
          color: #333;
          font-size: 16px;
          line-height: 1.5;
          margin-bottom: 20px;
        }
    
        .card-buttons {
          display: flex;
          justify-content: space-between;
        }
    
        .card-button {
          background-color: #3366cc;
          border: none;
          border-radius: 5px;
          color: #fff;
          cursor: pointer;
          font-size: 16px;
          padding: 10px;
          text-align: center;
          width: 48%;
          text-decoration: none;
        }

        .card-button:hover {
          background-color: #1a488e;
        }

        .card-button-red {
          background-color: #eb0000;
          border: none;
          border-radius: 5px;
          color: #fff;
          cursor: pointer;
          font-size: 16px;
          padding: 10px;
          text-align: center;
          width: 48%;
          text-decoration: none;
        }

        .card-button-red:hover {
            background-color: #a30000;          
        }
      </style>
</head>
<body>
    <div class="card-container">
        @if(count($notes) > 0)
            <div class="card-100">
                <div class="card-title-principal">Olá, {{ Auth::user()->name }} 
                    <a href="auth/logout" class="card-button-red">Sair</a></div><br>
                <div class="card-title">Deseja criar uma nova anotação?</div><br>
                <a href="notes/create" class="card-button">Criar anotação</a>
            </div>
            @foreach ($notes as $note)
                <div class="card">
                    <div class="card-title">{{ $note->title }}</div>
                    <div class="card-text">{{ $note->text }}</div>
                    <div class="card-buttons">
                    <button class="card-button">Editar</button>
                    <button class="card-button">Excluir</button>
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