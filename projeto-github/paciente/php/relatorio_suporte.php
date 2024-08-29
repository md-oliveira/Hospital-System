<?php

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
    $Nome = htmlspecialchars($_POST["_Nome"]);
    $Email = htmlspecialchars($_POST["_Email"]);
    $Cpf =htmlspecialchars($_POST["_Cpf"]);
    $Ocorrido = htmlspecialchars($_POST["_Ocorrido"]);
        
    echo "<script>alert('Relatório enviado, entraremos em contato em breve!');</script>";
    echo"<meta http-equiv='refresh' content='1;url=interface_usuario.php'>";
       


}