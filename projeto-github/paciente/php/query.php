<?php 
try{
    require_once "conn.php";
    session_start();
}catch(Exception $e){ 
    print_r($e);}

    if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $NomeUsu = htmlspecialchars($_POST["_NomeUsu"]);
    $Senha = $_POST['_Senha'];

    try{
        $stmt = $conn ->prepare('SELECT * FROM paciente WHERE NomeUsu = :NomeUsu');
        $stmt -> bindParam(':NomeUsu',$NomeUsu);
        $stmt -> execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
//;
        if($resultado)
        {
            //Verifica se a senha criptografada está correta
            if(password_verify($Senha,$resultado['Senha']))
            {   $_SESSION["NomeUsu"] = $NomeUsu;
                $_SESSION['Cpf'] = $resultado['Cpf'];

                
                echo"<meta http-equiv='refresh' content='1;url=../php/interface_usuario.php'>";
                
            }else{
                echo "<script>alert('Usuário não encontrado');</script>";
                echo"<meta http-equiv='refresh' content='1;url= ../index.php'>";
            }
        }else{
            echo "<script>alert('Usuário não encontrado');</script>";
            echo"<meta http-equiv='refresh' content='1;url= ../index.php'>";
        }
    }catch(PDOException $e){
        echo "Erro no login:".$e->getMessage();
        print($e);
    }
}
