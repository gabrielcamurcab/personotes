<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personotes - Login</title>
    <style>
		body {
			margin: 0;
			padding: 0;
			background-color: #F0F8FF;
			font-family: Arial, sans-serif;
		}

		.container {
			margin-top: 100px;
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		h2 {
			color: #4169E1;
			margin-bottom: 30px;
		}

		input[type="text"], input[type="password"], input[type="email"] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			border-radius: 4px;
			box-sizing: border-box;
			font-size: 16px;
		}

		input[type="submit"] {
			background-color: #4169E1;
			color: #fff;
			padding: 12px 20px;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 16px;
		}

		input[type="submit"]:hover {
			background-color: #6495ED;
		}

		form {
			width: 300px;
			background-color: #fff;
			padding: 20px;
			border-radius: 4px;
			box-shadow: 0px 0px 20px #ccc;
		}
	</style>
</head>
<body>
    <div class="container">
        <h2>Faça login</h2>
        <form method="POST" action="{{ route('auth.login') }}">
            @csrf
            <input type="email" name="email" placeholder="E-mail">
            <input type="password" name="password" placeholder="Senha">
            <input type="submit" value="Login">
        </form>
    </div>
</body>
</html>