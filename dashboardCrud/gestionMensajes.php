<?php 
session_start();
include_once __DIR__ . '/../config/Connection.php';

$conn = connection();
$error;
$location = 'Location: ../admin-mensajes.php';

if( !isset( $_SESSION['userId'] ) || empty( $_SESSION['userId'] ) ){
    header( "Location: /" );
    exit;
} else {
    $userId = $_SESSION['userId'];
}

$sql = "SELECT * FROM users WHERE id = :userId ";

$stmt = $conn -> prepare($sql);
$stmt -> execute( [ 'userId' => $userId ] );
$res = $stmt -> fetch();

if( !$res ){
    header( "location: /" );
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "./../PHPMailer/mailerConf/Exception.php";
require "./../PHPMailer/mailerConf/PHPMailer.php";
require "./../PHPMailer/mailerConf/SMTP.php";

$mail = new PHPMailer();

$mail -> isSMTP();
$mail -> Host = 'smtp.gmail.com';
$mail -> SMTPAuth = true;
$mail -> Username = 'desemptesci@gmail.com';
$mail -> Password = 'qfzw orjc ykxt ylcx';
$mail -> SMTPSecure = 'tls';
$mail -> Port = 587;
$mail -> setFrom('desemptesci@gmail.com');

$mailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/';

if( $_SERVER['REQUEST_METHOD'] === 'POST'){
    if( $_POST['action'] === 'respuesta' ){
        ( !isset( $_POST['respuestaEmail'] ) || empty( $_POST['respuestaEmail'] ) ) ?  $error = 'El correo es obligatorio' : $email = $_POST['respuestaEmail'];
        ( !isset( $_POST['asuntoRespuesta'] ) || empty( $_POST['asuntoRespuesta'] ) ) ? $error = 'El asunto es obligatorio' : $asunto = $_POST['asuntoRespuesta'];
        ( !isset( $_POST['mensajeRespuesta'] ) || empty( $_POST['mensajeRespuesta'] ) ) ? $error = 'El mensaje es obligatorio' : $mensaje = $_POST['mensajeRespuesta'];
            
        if( !empty( $error ) ){
            $_SESSION['error'] = $error;
            header( $location );
            exit;
        }
        
        if( !preg_match( $mailRegex, $email) ){
            $error = 'El correo no es valido';
            $_SESSION['error'] = $error;
            header( $location );
            exit;
        }
        try{
                $mail -> addAddress( $email );
                $mail -> Subject = $asunto;
                $mail -> isHTML(true);
                $mailContent = '
                    <div style="font-family: Arial, sans-serif; color:#333; line-height:1.6;">
                        <h2 style="color:#1f2937;">Respuesta a tu mensaje</h2>

                        <p>
                            Hemos revisado el mensaje que nos enviaste y a continuación te compartimos nuestra respuesta.
                        </p>

                        <hr style="border:none; border-top:1px solid #ddd; margin:20px 0;">

                        <h3 style="margin-bottom:5px;">Asunto</h3>
                        <p style="background:#f9fafb; padding:10px; border-radius:5px;">
                            '.$asunto.'
                        </p>

                        <h3 style="margin-bottom:5px;">Respuesta</h3>
                        <p style="background:#f9fafb; padding:10px; border-radius:5px;">
                            '.nl2br(htmlspecialchars($mensaje)).'
                        </p>

                        <hr style="border:none; border-top:1px solid #ddd; margin:20px 0;">

                        <p style="font-size:14px; color:#555;">
                            Si tienes alguna otra duda o necesitas información adicional,
                            no dudes en responder este correo. Con gusto te atenderemos.
                        </p>

                        <p style="margin-top:30px;">
                            Atentamente,<br>
                            <strong>Equipo CONACICA</strong>
                        </p>
                    </div>';

                $mail->Body = $mailContent;

                $mail ->send();
                header( $location );
                exit;
            } catch( Exception $e ) {
                $error = 'Hubo un error al mandar el correo de confirmacion.';
                $_SESSION['error'] = $error;
                header( $location );
                exit;
            }
    }

    if( $_POST['action'] === 'borrarCorreo' ){
        ( !isset( $_POST['correoIdRespuesta'] ) || empty($_POST['correoIdRespuesta']) ) ? $error = "No se pudo obtener el correo, intentelo de nuevo." : $id = $_POST['correoIdRespuesta'];
        if( !empty( $error ) ){
            $_SESSION['error'] = $error;
            header( $location );
            exit;
        }
        $sql = "DELETE FROM correos WHERE id = :id";
        try{
            $stmt = $conn -> prepare( $sql );
            $stmt -> execute(['id' => $id]);
            $res = $stmt -> rowCount();
            if( $res === 0 ){
                $_SESSION['error'] = "No se pudo borrar el correo.";
            }
            header( $location );
            exit;
        } catch( PDOException $e ) {
            $_SESSION['error'] = "Hubo un problema al intentar borrar el correo.";
            header( $location );
            exit;
        }
    }
}