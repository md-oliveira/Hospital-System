<?php
session_start();
// Verifica se o usuário está logado
if(!isset($_SESSION['Cpf'])){
    // Se Sessão com Login não existir
    header("Location: index.php");// Redireciona para index
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/interface_usu.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <style>
        
    </style>
</head>
<body>
<header>
        <div class="logo">
            <h1>LifeHealth</h1>
        </div>
        <nav class="menu">
            <ul>
                <li><a href="suporte.php">Suporte</a></li>
                <li><a href="../../sobrenos/sobrenos.html" target="_blank">Sobre nós</a></li>
                <li><a href="destroy.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main>
    <div class="grid">

        <a href="MarcarConsult.php">
        <article class="card">
            <div class="card_image">
                <img src="../img/marcarconsul.jpg" alt="imagem de medica cumprimentando">
            </div>
            <div class="card_content">
                <p>Marcar Consulta</p>
            </div>
        </article>
        </a>
        

        <a href="lista_paciente.php">
            <article class="card">
                <div class="card_image">
                    <img src="../img/minhasconsul.jpg" alt="banner de um medico">
                </div>
                <div class="card_content">
                <p>Minhas Consultas</p>
                </div>
            </article>
        </a>

        <a href="lista_med.php">
            <article class="card">
                <div class="card_image">
                    <img src="../img/medicos.jpg" alt="medica segurando um instrumento medico">
                </div>
                <div class="card_content">
                    <p>Médicos</p>
                </div>
            </article>
        </a>

        <a href="documentacao.php">
            <article class="card">
                <div class="card_image">
                    <img src="../img/ajuda.jpg" alt="medica apontando para prancheta">
                </div>
                <div class="card_content">
                    <p>Ajuda</p>
                </div>
            </article>
        </a>

    </div>
    </main>

</body>
</html>