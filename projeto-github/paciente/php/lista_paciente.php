<?php 
session_start();
if(!isset($_SESSION['Cpf'])){
    // Se Sessão com Login não existir
    header("Location: index.php"); // Redireciona para index
    exit();
}
include_once("conn.php");

$CpfPac = $_SESSION['Cpf'];

$stmt = $conn->prepare("SELECT consulta.*, medico.Nome AS NomeMedico, medico.AreaAtend
FROM consulta
INNER JOIN medico ON consulta.IdMed = medico.IdMed
WHERE consulta.CpfPac = :CpfPac
");
$stmt->bindParam(':CpfPac', $CpfPac);
$stmt->execute();
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($resultados) {
    $consultas = [];
    foreach ($resultados as $resultado) {
        $CodCons = $resultado['IdConsulta'];
        $Cpf = $resultado['CpfPac'];
        $Dia = $resultado['Dia'];
        $Hora = $resultado['Hora'];
        $Sintomas = $resultado['Sintomas'];
        $IdMed = $resultado['IdMed'];
        $NomeMed = $resultado['NomeMedico'];
        $AreaAtend = $resultado['AreaAtend'];
        $Resposta = $resultado['Resposta']; // Obtém o status da consulta

        // Define o status da consulta com base no valor da coluna 'Resposta'
        $SituacaoConsulta = '';
        if ($Resposta == 0 || $Resposta == 2) {
            $SituacaoConsulta = 'Em Andamento';
        } elseif ($Resposta == 1) {
            $SituacaoConsulta = 'Concluída';
        }

        $consultas[] = [
            'CodCons' => $CodCons,
            'NomeMed' => $NomeMed,
            'AreaAtend' => $AreaAtend,
            'Dia' => $Dia,
            'Hora' => $Hora,
            'Sintomas' => $Sintomas,
            'SituacaoConsulta' => $SituacaoConsulta
        ];
    }
} else {
    $consultas = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/lista_paciente.css">
    <link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
    <title>Minhas Consultas</title>
</head>
<body>
<div id="container">
    <h1>Minhas Solicitações</h1>
    <?php if (!empty($consultas)) : ?>
        <table border="1">
            <tr>
                <th>Código Consulta</th>
                <th>Médico Responsável</th>
                <th>Especialidade do Médico</th>
                <th>Dia</th>
                <th>Hora</th>
                <th>Sintomas</th>
                <th>Situação da Consulta</th>
            </tr>
            <?php foreach ($consultas as $c) : ?>
            <tr>
                <td><?php echo htmlspecialchars($c['CodCons']); ?></td>
                <td><?php echo htmlspecialchars($c['NomeMed']); ?></td>
                <td><?php echo htmlspecialchars($c['AreaAtend']); ?></td>
                <td><?php echo htmlspecialchars($c['Dia']); ?></td>
                <td><?php echo htmlspecialchars($c['Hora']); ?></td>
                <td><?php echo htmlspecialchars($c['Sintomas']); ?></td>
                <td><?php echo htmlspecialchars($c['SituacaoConsulta']); ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php else :
       echo "<script>alert('Nenhuma Consulta encontrada faça o cadastro!')</script>;";
       echo "<meta http-equiv='refresh' content='1;url=MarcarConsult.php'>";
    ?>
    <?php endif; ?>
    <div class="card">
        <form action="delete_lista_paciente.php" method="POST">
            <h3>Deseja Cancelar a Consulta?</h3>
            <h3>Essa ação não tem mais volta!</h3>
            <h4>Código da Consulta</h4>
            <input type="text" required placeholder="Código da Consulta" name="_CodCons">
            <br>
            <input type="submit" value="Cancelar Consulta">
            <br>
            <br>
            <br>
            <a href="interface_usuario.php">Voltar à página Home</a>
        </form>
    </div>
</div>        
</body>
</html>
