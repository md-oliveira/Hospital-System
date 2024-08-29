<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/suporte.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Suporte</title>
    <style>
        
    </style>
</head>
<body>
    <div class="container">
        <div class="conteudo">
            <h2>Suporte</h2>
            <br><br>
                <form action="relatorio_suporte.php" method="POST">
                    

                    <h3>Nos informe quem é você!</h3>

                    
                    <input type="text" required placeholder="Nome Completo" name="_Nome"> <br>

                    
                    <input type="text" required placeholder="CPF" name="_Cpf"><br>

                    
                    <input type="email" required placeholder="Email" name="_Email">
                    <br>
                    
                    <textarea class="ocorrido" required placeholder="Ocorrido" name="_Ocorrido"></textarea><br>
                
                    <input type="submit" value="Enviar" >        
                
                </form>

                <a href="interface_usuario.php">Voltar a página Home</a>
            </div>
        </div>    
    </body>
</html>