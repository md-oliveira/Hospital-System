<?php
    try{
        require_once "conn.php";
        session_start();
       // print_r($conn);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Crm = htmlspecialchars($_POST["_Crm"]);
            $Senha = $_POST['_Senha'];

            $stmt = $conn->prepare('SELECT * FROM medico WHERE Crm = :Crm');
            $stmt->bindParam(':Crm', $Crm);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                if (password_verify($Senha, $resultado['Senha'])) {
                    $_SESSION['Crm'] = $Crm;
                    $_SESSION['IdMed'] = $resultado['IdMed']; // Adiciona IdMed à sessão

                    echo "<meta http-equiv='refresh' content='1;url= interface_med.php'>";
                } else {
                    echo "<script>alert('Usuário não encontrado');</script>";
                    echo "<meta http-equiv='refresh' content='1;url= ../index.php'>";
                }
            } else {
                echo "<script>alert('Usuário não encontrado');</script>";
                echo "<meta http-equiv='refresh' content='1;url= ../index.php'>";
            }
        }
    } catch (Exception $e) {
        print_r($e);
    }






