<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

$nome_pac = htmlspecialchars($_POST['nome_pac'], ENT_QUOTES, "UTF-8");
$email_pac = htmlspecialchars($_POST['email_pac'], ENT_QUOTES, "UTF-8");
$diagnostico = htmlspecialchars($_POST['diagnostico'], ENT_QUOTES, "UTF-8");
$tratamento = htmlspecialchars($_POST['tratamento'], ENT_QUOTES, "UTF-8");
$prescricao = htmlspecialchars($_POST['prescricao'], ENT_QUOTES, "UTF-8");
$data_acompanhamento = htmlspecialchars($_POST['data_acompanhamento'], ENT_QUOTES, "UTF-8");

include("../phpmailer/PHPMailer.php");
include("../phpmailer/Exception.php");
include("../phpmailer/SMTP.php");

$email = new PHPMailer(true);
try{
    $email -> isSMTP();
    $email -> Host = "smtp-mail.outlook.com";
    $email -> SMTPAuth = true;
    $email -> Username = "lifehealth355@hotmail.com";
    $email -> Password = "Life123456";
    $email -> CharSet = "UTF-8";
    $email -> SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $email -> Port = 587;
    $email -> setFrom ("lifehealth355@hotmail.com", "LifeHealth");
    $email -> addAddress ($email_pac, $nome_pac);
    $email -> isHtml(false);
    $email -> Subject = "Relatório da sua Consulta";
    $email -> Body = $diagnostico."  ".$tratamento."  ".$prescricao." Data da próxima consulta ".$data_acompanhamento;

    if(!$email->send()){
        echo $email->ErrorInfo;
    }
    else {
        echo "<script>alert('Email enviado com sucesso!');</script>";
        echo "<meta http-equiv='refresh' content='1;url= interface_med.php'>";
    }
}
catch(Exception $e){
    echo "Erro ao enviar o email: " . $email->ErrorInfo;
}