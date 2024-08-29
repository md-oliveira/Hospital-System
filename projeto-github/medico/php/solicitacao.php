<?php
session_start(); // Inicia a sessão

// Verifica se o CRM do médico está na sessão
if (!isset($_SESSION['Crm']) || !isset($_SESSION['IdMed'])) {
    // Se a sessão com CRM ou IdMed não existir, redireciona para a página de login
    header("Location: ../index.php");
    exit();
}

include_once("conn.php");

// Obtém o IdMed da sessão
$IdMed = $_SESSION['IdMed'];

// Prepara a consulta SQL para buscar consultas filtradas pelo IdMed do médico
$stmt = $conn->prepare("
    SELECT consulta.IdConsulta, consulta.CpfPac, consulta.Dia, consulta.Hora, consulta.Sintomas, consulta.IdMed, consulta.Resposta, paciente.Nome AS NomePaciente, paciente.Gmail
    FROM consulta
    INNER JOIN paciente ON consulta.CpfPac = paciente.Cpf
    WHERE consulta.IdMed = :IdMed
");
$stmt->bindParam(':IdMed', $IdMed);
$stmt->execute();
$consultas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Se o formulário for submetido (quando o médico muda o status da consulta)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['IdConsulta'])) {
    $IdConsulta = $_POST['IdConsulta'];
    $Resposta = $_POST['Resposta'];
    
    // Atualiza o status da consulta no banco de dados
    $stmt = $conn->prepare("UPDATE consulta SET Resposta = :Resposta WHERE IdConsulta = :IdConsulta AND IdMed = :IdMed");
    $stmt->bindParam(':Resposta', $Resposta);
    $stmt->bindParam(':IdConsulta', $IdConsulta);
    $stmt->bindParam(':IdMed', $IdMed);
    $stmt->execute();
    
    // Atualiza a página para refletir a mudança
    header("Location: solicitacao.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minhas Solicitações</title>
    <link rel="stylesheet" href="../css/solicitacao.css">
</head>
<body>
    <div id="container">
        <h1>Minhas Solicitações</h1>
        <?php if (!empty($consultas)) : ?>
            <table border="1">
                <tr>
                    <th>Código Consulta</th>
                    <th>Nome do Paciente</th>
                    <th>Gmail do Paciente</th>
                    <th>CPF do Paciente</th>
                    <th>Dia</th>
                    <th>Hora</th>
                    <th>Sintomas</th>
                    <th>Situação da Consulta</th>
                </tr>
                <?php foreach ($consultas as $c) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['IdConsulta']); ?></td>
                    <td><?php echo htmlspecialchars($c['NomePaciente']); ?></td>
                    <td><?php echo htmlspecialchars($c['Gmail']); ?></td>
                    <td><?php echo htmlspecialchars($c['CpfPac']); ?></td>
                    <td><?php echo htmlspecialchars($c['Dia']); ?></td>
                    <td><?php echo htmlspecialchars($c['Hora']); ?></td>
                    <td><?php echo htmlspecialchars($c['Sintomas']); ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="IdConsulta" value="<?php echo $c['IdConsulta']; ?>">
                            <select name="Resposta" onchange="this.form.submit()">
                                <option value="2" <?php echo $c['Resposta'] == '2' ? 'selected' : ''; ?>>Em andamento</option>
                                <option value="1" <?php echo $c['Resposta'] == '1' ? 'selected' : ''; ?>>Concluída</option>
                            </select>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <script>alert('Nenhuma Consulta encontrada.')</script>
        <?php endif; ?>
        
        <div class="card">
            <a href="interface_med.php">Voltar à página Home</a>
        </div>
    </div>        
</body>
</html>
