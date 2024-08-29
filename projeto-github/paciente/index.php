<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login_paciente.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>Login</title>
</head>
<body>
    
    <div class="left">
        <h1>Life Health</h1>

        <p>Marque consultas de maneira <b>FÁCIL</b> e <b>RÁPIDA</b></p>

        <img src="img/logo.png" alt="LifeLogo" style="width: 250px;">

    </div>

    <div class="container">

        <div class="right">

            <h2>Bem-vindo</h2>

            <br><br>

                
            <form action="php/query.php" method="POST">
                <input  type="text" name="_NomeUsu" required placeholder="Nome de Usuário">
                <br>
                <input type="password" name="_Senha" required placeholder ="Senha">
                <br>
                <input type="submit" value="Entrar"> 
                <a href="cadastro_paciente/cadastro_paciente.php">Cadastre-se</a>
            </form>
         </div>
    </div>
    
<!--
    <div name="auto-cadastro">
        <label>Não possui cadastro?</label><br>
        <a href="../InsertUsu/index.php">Fazer Meu Cadastro</a>
    </div>

    <div name="Suporte">
        <label>Ocorreu algum erro?</label>
        <br>
        <label>Relate para nós</label><br>
        <a href="../suport/index.php">Suporte</a>
    </div>





</body>
</html>