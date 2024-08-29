<?php
session_start(); 
if(!isset($_SESSION['Cpf'])){
  // Se Sessão com Login não existir
  header("Location: ../index.php");// Redireciona para index
  exit();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include_once("conn.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $CodMed = htmlspecialchars($_POST["_CodMed"]);
    $Cpf = htmlspecialchars($_POST["_Cpf"]);
    $Dia = htmlspecialchars($_POST["_Data"]);
    $Hora = htmlspecialchars($_POST["_Hora"]);
    $Sintomas = htmlspecialchars($_POST["_Sintomas"]); 
    $stmt = $conn->prepare('SELECT med.IdMed, pac.Cpf FROM medico as med, paciente as pac 
                                                      WHERE med.IdMed = :CodMed AND pac.Cpf = :Cpf');
    $stmt->bindParam(':CodMed', $CodMed);
    $stmt->bindParam(':Cpf', $Cpf);    
    $stmt->execute();
    $Resultado = $stmt->fetch(PDO::FETCH_ASSOC); 
    if ($Resultado) {
        $_SESSION['Cpf'] = $Resultado['Cpf'];
        $stmt = $conn->prepare('SELECT med.Nome FROM medico as med WHERE IdMed = :CodMed');
        $stmt->bindParam(':CodMed', $CodMed);
        $stmt->execute();
        $NomeMed = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($NomeMed) {
            $_SESSION['nome_medico'] = $NomeMed['Nome'];
            
            $stmt =$conn->prepare('SELECT med.AreaAtend FROM medico as med WHERE IdMed =:CodMed');
            $stmt->bindParam(':CodMed',$CodMed);
            $stmt->execute();
            $AreaMed = $stmt->fetch(PDO::FETCH_ASSOC);
            if($AreaMed){
              $_SESSION['area_medico'] = $AreaMed['AreaAtend'];
              
              $count = $conn->prepare("SELECT * FROM consulta WHERE 
                                                      Dia =:Dia AND 
                                                      Hora =:Hora AND 
                                                      IdMed=:CodMed AND 
                                                      CpfPac=:Cpf");
              $count->bindParam(':Dia',$Dia);
              $count->bindParam(':Hora',$Hora);
              $count->bindParam(':CodMed',$CodMed);
              $count->bindParam(':Cpf',$Cpf);
              $count->execute();
              $resultado = $count->fetchAll();
               
              if(count($resultado) > 0){
                echo "<script>alert('Já existe uma consulta marcada tente outro dia e horário ');</script>";
                echo"<meta http-equiv='refresh' content='1;url=MarcarConsult.php'>";
              }else{
                $stmt = $conn->prepare('INSERT INTO consulta (IdMed,CpfPac,Dia,Hora,Sintomas) 
                                                VALUES (:CodMed,:Cpf,:Dia,:Hora,:Sintomas)');
                $stmt->bindParam(':CodMed',$CodMed);
                $stmt->bindParam(':Cpf',$Cpf);
                $stmt->bindParam(':Dia',$Dia);
                $stmt->bindParam(':Hora',$Hora);
                $stmt->bindParam(':Sintomas',$Sintomas);
                $stmt->execute();  
                echo "<script>alert('Cadastro Feito com Sucesso');</script>";
              }
             
              // Recuperar o ID do último registro inserido
              $ultimoID = $conn->lastInsertId();
              $stmt = $conn->prepare('SELECT * FROM consulta WHERE idConsulta = :ultimoID');
              $stmt->bindParam(':ultimoID', $ultimoID);
              $stmt->execute();
              $resultadoConsultaId = $stmt->fetch(PDO::FETCH_ASSOC);// dia, hora e id consulta
              //$_SESSION["newsession"]=$value;
              $_SESSION['ResultadoConsulta'] = $resultadoConsultaId['IdConsulta'];
              //echo $_SESSION['ResultadoConsulta'];
            }
        } else {
          echo"<script>alert('Credenciais Inválidas')</script>;";
          echo"<meta http-equiv='refresh' content='1;url=MarcarConsult.php'>";
        }
    } else {
        echo"<script>alert('Médico não encontrado')</script>;";
        echo"<meta http-equiv='refresh' content='1;url=MarcarConsult.php'>";
    } 
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar</title>
    <link rel="stylesheet" href="../css/registro.css">
</head>
<body>
  <div class="container">
    <form action="DeleteCons.php" method="POST">
      <h1>INFORMAÇÕES DA CONSULTA</h1>
      
      <div class="card">
        <h3>Informações do Médico</h3>
        <table> 
          <tr>
              <th>CÓDICO MÉDICO</th>
              <td><?php echo $CodMed ?></td>
          </tr>
          <tr>
              <th>NOME MÉDICO</th>
              <td><?php echo $_SESSION['nome_medico']?></td>
          </tr>
          <tr>
              <th>ÁREA DE ATENDIMENTO</th>
              <td><?php echo $_SESSION['area_medico']  ?></td>
          </tr>
        </table>
      </div>

      <div class="card">
        <h3>Informações do Paciente</h3>
        <table>
          <tr>
              <th>Nome Paciente</th>
              <td><?php echo $_SESSION["NomeUsu"]?></td>
          </tr>
          <tr>
              <th>Cpf Paciente</th>
              <td><?php echo $Cpf?></td>
          </tr>
          <tr>
              <th>Data Consulta</th>
              <td><?php echo $Dia?></td>
          </tr>
          <tr>
              <th>Horário Consulta</th>
              <td><?php echo $Hora ?></td>
          </tr>
          <tr>
              <th>Sintomas</th>
              <td><?php echo $Sintomas?></td>
          </tr>
        </table>  
      </div>

      <div class="button-group">
        <input type="submit" value="Deletar Consulta">
        <a href="interface_usuario.php">Voltar à página Home</a>
      </div>
      
    </form>
  </div>
</body>
</html>















   




























   