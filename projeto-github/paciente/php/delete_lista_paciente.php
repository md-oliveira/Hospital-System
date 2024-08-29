<?php
    session_start();
    if(!isset($_SESSION['Cpf'])){
        // Se Sessão com Login não existir
        header("Location: ../index.php");// Redireciona para index
        exit();
    }
    include_once("conn.php");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $CodCons = htmlspecialchars($_POST['_CodCons']);
        
        $stmt = $conn->prepare("SELECT * FROM consulta WHERE IdConsulta = :CodCons");
        $stmt->bindParam(':CodCons', $CodCons);
        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ///var_dump ($resultado);
        if($resultado){
            $stmt = $conn->prepare("DELETE FROM consulta WHERE IdConsulta = :CodCons");
            $stmt->bindParam(':CodCons', $CodCons);
            $stmt->execute();
            echo"<script>alert('Consulta Deletada! Essa ação não tem mais volta.')</script>;";
            echo"<meta http-equiv='refresh' content='1;url=lista_paciente.php'>";
        }else{
            echo"<script>alert('Erro , Código Inválido')</script>;";
            echo"<meta http-equiv='refresh' content='1;url=lista_paciente.php'>";
        }
    }



