<?php
    require_once "conn.php";

    //print_r($conn);
    

    
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        echo "<script>alert('Formúlario Enviado');</script>";
        echo"<meta http-equiv='refresh' content='1;url=interface_med.php'>";
    
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Consulta</title>
    <link rel="stylesheet" href="../css/relatorio.css">
</head>
<body>
    <div id="container">
        <h2 class="destaque">Relatório de Consulta</h2>
        <form action="envia_relatorio.php" method="post">
        
            <label>Nome do Paciente:</label>
                <input type="text"  name="nome_pac" required><br><br>
            <label>Email do Paciente:</label>
                <input type="email"  name="email_pac" required><br><br>
            <label>Diagnóstico:</label><br>
                <textarea name="diagnostico" rows="4" cols="50" required></textarea><br><br>
            <label>Recomendações de Tratamento:</label><br>
                <textarea name="tratamento" rows="4" cols="50" required></textarea><br><br>
            <label>Prescrição:</label><br>
                <textarea name="prescricao" rows="4" cols="50" required></textarea><br><br>
            <label>Data da Próxima Consulta:</label>
                <input type="date" name="data_acompanhamento" required><br><br>
            <!-- <label>Código Paciente:</label>
                <input type="text" name="CodPac" required><br><br> -->
        
            <div class="botao"><input type="submit" value="Enviar Relatório"></div><br>
            <a href="interface_med.php">Voltar</a>
        </form>
    </div>
</body>
</html>