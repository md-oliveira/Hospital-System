<?php
session_start();
// Verifica se o usuário está logado
if(!isset($_SESSION['Cpf'])){
    // Se Sessão com Login não existir
    header("Location: ../index.php");// Redireciona para index
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requisição de Consultas</title>
    <link rel="stylesheet" href="../css/marcar_consulta.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
</head>
<body>
            
<div id="container">
        <form action="registro.php" method="POST">
            <p>Digite o Código do seu Médico</p>
                <input type="text" required  placeholder="Códico Médico" name="_CodMed">
            <br>
            <p>Seu CPF</p>
                <input type="text" placeholder="Cpf" name="_Cpf" value="<?php echo $_SESSION['Cpf'] ?>"></input>
            <br>
           <p>Escolha o Dia</p>
                <input type="date" required placeholder="Data" name="_Data">
            <br>
            <p>Escolha o Horário para a consulta</p>
                <input type="time" required placeholder="Hora" step="3600"  min="8:00" max="22:00" name="_Hora" >
            <br>
            <p>O que você está sentindo?</p><br>
                <textarea name="_Sintomas" cols="30" rows="10"></textarea>
            <br>
        
            <input type="submit" value="Cadastrar Consulta">
        </form>
        
        <div class="btns">
            <a href="lista_med.php">Nome e código dos médicos</a>
            <a href="interface_usuario.php">Voltar a página Home</a>
        </div>
    </div>

</body>
</html>