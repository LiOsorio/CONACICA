<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require "mailerConf/Exception.php";
    require "mailerConf/PHPMailer.php";
    require "mailerConf/SMTP.php";

    $mail = new PHPMailer();

    $mail -> isSMTP();
    $mail -> Host = 'smtp.gmail.com';
    $mail -> SMTPAuth = true;
    $mail -> Username = 'desemptesci@gmail.com';
    $mail -> Password = 'qfzw orjc ykxt ylcx';
    $mail -> SMTPSecure = 'tls';
    $mail -> Port = 587;

    $mail -> setFrom('desemptesci@gmail.com');

    $mail -> addAddress('o.galicia.0812@gmail.com');

    $mail -> Subject = 'Prueba de php mailer';

    $mail -> isHTML(true);

    $mailContent = '
    <h1> Hola, este es un correo de prueba</h1>
    <p> espero que esto si se mande</p>
    ';

    $mail -> Body = $mailContent;

    if(!$mail -> send()){
        echo 'Hubo un probelma con mandar el mensaje. Error: ' . $mail -> ErrorInfo;
        exit;
    }else{
        echo 'El correo se envio exitosamente';
        exit;
    }