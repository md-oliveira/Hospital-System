<?php
 session_start();
    if(!isset($_SESSION['Cpf'])){
        // Se Sessão com Login não existir
        header("Location: ../index.php");// Redireciona para index
        exit();
    }
 include_once("conn.php");
 
    $CodMed = 0;
    //echo $CodMed;
    $stmt = $conn->prepare("SELECT Nome , AreaAtend ,IdMed FROM medico WHERE  IdMed > :CodMed");
    $stmt->bindParam(":CodMed",$CodMed);
    $stmt->execute();
    $resultado = $stmt->fetchAll();

    if($resultado){
        $consulta =[];
        foreach($resultado as $r){
        $NomeMed = $r['Nome'];
        $AreaMed = $r['AreaAtend'];
        $IdMed = $r['IdMed'];    
        $consulta [] = [
            'Nome' => $NomeMed,
            'AreaAtend' => $AreaMed,
            'IdMed' => $IdMed
        ];
        //var_dump($consulta);
    }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/lista_med.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Lista de Médicos</title>
</head>
<body>
    <?php if (!empty($consulta)): ?>
        <h1>Lista de Médicos</h1>
    <table>
        <tr>
            <th>Código Médico</th>
            <th>Nome do Médico</th>
            <th>Área Médico</th>
        </tr>
        <?php foreach($consulta as $c) :?>
        <tr>
            <td><?php echo htmlspecialchars($c['IdMed'])?></td>
            <td><?php echo htmlspecialchars($c['Nome'])?></td>
            <td><?php echo htmlspecialchars($c['AreaAtend'])?></td>
            
        </tr>
        <?php endforeach; ?>
    </table>
<?php else :
    echo"<script>alert('Nenhuma Consulta encontrada faça o cadastro!')</script>;";
    echo"<meta http-equiv='refresh' content='1;url=../index.php'>";
?>

<?php endif; ?>
    <a href="interface_usuario.php">Voltar a página Home</a>
    <br>
     <br>
    <br>
    <a href="MarcarConsult.php">Voltar a página marcar consultas</a>
</body>
</html>