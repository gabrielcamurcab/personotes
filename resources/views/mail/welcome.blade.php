<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Seja bem-vindo ao Personotes!</title>
</head>
<body style="font-family: 'Roboto', sans-serif; background-color: #F0F8FF; color: #4169E1; margin: 0; padding: 0;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background-color: #fff;">
        <h1 style="font-size: 24px; margin-top: 0; margin-bottom: 10px;">Seja bem-vindo ao Personotes!</h1>
        <p style="margin-bottom: 10px;">Olá {{ $name }},</p>
        <p style="margin-bottom: 10px;">É com grande prazer que te damos as boas-vindas ao Personotes!</p>
        <p style="margin-bottom: 10px;">O Personotes é um aplicativo de anotações pessoais que te ajuda a organizar suas ideias, pensamentos e tarefas de maneira simples e eficiente.</p>
        <p style="margin-bottom: 10px;">Com o Personotes, você pode:</p>
        <ul style="list-style: none; padding: 0;">
            <li style="margin-bottom: 10px;">Criar notas de texto, listas e imagens</li>
            <li style="margin-bottom: 10px;">Organizar suas notas em cadernos e categorias</li>
            <li style="margin-bottom: 10px;">Compartilhar suas notas com outras pessoas</li>
            <li style="margin-bottom: 10px;">Definir lembretes e alarmes</li>
            <li style="margin-bottom: 10px;">Personalizar a interface do aplicativo</li>
        </ul>
        <div style="text-align: center;">
            <a href="{{ url('login') }}" style="display: inline-block; padding: 10px 20px; background-color: #4169E1; color: #fff; text-decoration: none; font-size: 16px;">Entrar na plataforma</a>
        </div>
    </div>
    <div style="text-align: center; margin-top: 20px;">
        <p>Personotes &copy; {{ date('Y') }}</p>
    </div>
</body>
</html>
