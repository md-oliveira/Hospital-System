<?php 
require_once "conn.php";
// require_once "index.php";

//var_dump($_POST);
//exit;
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    
    $Nome = htmlspecialchars($_POST["_Nome"]);
    $Senha = password_hash($_POST["_Senha"], PASSWORD_DEFAULT);
    $Gmail = htmlspecialchars($_POST["_Gmail"]);
    $Cpf = htmlspecialchars($_POST["_Cpf"]);
    $NomeUsu = htmlspecialchars($_POST["_NomeUsu"]);
    $DataNasc = htmlspecialchars($_POST["_Data"]);
    $Endereco = htmlspecialchars($_POST["_Resultado"]);

    try {
        
        $consulta = ("SELECT * FROM paciente WHERE NomeUsu = :NomeUsu");
        $stmt = $conn->prepare($consulta);
        $stmt->bindParam(':NomeUsu', $NomeUsu);
        $stmt->execute();
        
        $resultado = $stmt->fetchAll();

        if (count($resultado) > 0) {  
            echo "<script>alert('Usuário já cadastrado');</script>";
            echo "<meta http-equiv='refresh' content='1;url= cadastro_paciente.php'>";
        } else {
            
            $sql = "INSERT INTO paciente (Nome, Senha, Gmail, Cpf, NomeUsu, DataNasc, Endereco) VALUES (:Nome, :Senha, :Gmail, :Cpf, :NomeUsu, :DataNasc, :Endereco)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':Nome', $Nome);
            $stmt->bindParam(':Senha', $Senha);
            $stmt->bindParam(':Gmail', $Gmail);
            $stmt->bindParam(':Cpf', $Cpf);
            $stmt->bindParam(':NomeUsu', $NomeUsu);
            $stmt->bindParam(':DataNasc', $DataNasc);
            $stmt->bindParam(':Endereco', $Endereco);
            $stmt->execute();
            echo "<script>alert('Cadastro de Paciente Feito com Sucesso!!');</script>";
            echo "<meta http-equiv='refresh' content='1;url= cadastro_paciente.php'>";
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
