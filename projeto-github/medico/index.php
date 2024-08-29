<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login_medico.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
    
    <div class="left">
        <h1>Life Health</h1>

        <p>Acesso para <strong>Médicos</strong></p>

        <img src="img/logo.png" alt="LifeLogo" style="width: 250px;">

    </div>

    <div class="container">

        <div class="right">

            <h2>Bem-vindo</h2>

            <br><br>

                
            <form action="php/query.php" method="POST">
                <input  type="text" name="_Crm" required placeholder="CRM">
                <br>
                <input type="password" name="_Senha" required placeholder ="Senha">
                <br>
                <input type="submit" value="Entrar"> 

                
                
                <!-- <a href="../suport/index.php">Contato com o Suporte</a> -->
              
            </form>
         </div>
    </div>
    
