<?php 
session_start();
include_once __DIR__ . '/../config/Connection.php';

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

$conn = connection();
$error;

$mailRegex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\\.[a-zA-Z]{2,}$/';

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        if ( $_POST['action'] === 'sendMail' ) {
            ( !isset( $_POST['nombre'] ) || empty( $_POST['nombre'] ) ) ? $error = 'El nombre es obligatorio.' : $nombre = $_POST['nombre'] ;
            ( !isset( $_POST['email'] ) || empty( $_POST['email'] ) ) ?  $error = 'El correo es obligatorio' : $email = $_POST['email'];
            ( !isset( $_POST['asunto'] ) || empty( $_POST['asunto'] ) ) ? $error = 'El asunto es obligatorio' : $asunto = $_POST['asunto'];
            ( !isset( $_POST['mensaje'] ) || empty( $_POST['mensaje'] ) ) ? $error = 'El mensaje es obligatorio' : $mensaje = $_POST['mensaje'];
            
            if( !empty( $error ) ){
                $_SESSION['error'] = $error;
                header( 'Location: /' );
                exit;
            }
            
            if( !preg_match( $mailRegex, $email) ){
                $error = 'El correo no es valido';
                $_SESSION['error'] = $error;
                header( 'Location: /' );
                exit;
            }
        
            $sql = 'INSERT INTO correos ( nombre, email, asunto, mensaje, fecha, estado ) VALUES ( :nombre, :email, :asunto, :mensaje, CURDATE(), "Nuevo" )';

            try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute([
                    'nombre' => $nombre,
                    'email' => $email,
                    'asunto' => $asunto,
                    'mensaje' => $mensaje
                ]);

            } catch( PDOException $e ) {
                $error = 'Hubo un problema al agregar el mensaje al centro de mensajes.';
                $_SESSION['error'] = $error;
                header( 'Location: /' );
                exit;
            }

            try{
                $mail -> addAddress( $email );
                $mail -> Subject = $asunto;
                $mail -> isHTML(true);
                $mailContent = '<h1>Gracias por contactar a CONACICA!</h1>
                <p>Hemos recibido tu coreo, pronto recibirás una respuesta de nuestros administradores!</p>
                <h2>Datos del correo enviado</h2>
                <h3>Asunto:</h3>
                <p>'.$asunto.'</p>
                <h3>Mensaje</h3>
                <p>'.$mensaje.'</p>
                ';
                $mail -> Body = $mailContent;
                $mail ->send();
                header( 'Location: /' );
                exit;
            } catch( Exception $e ) {
                $error = 'Hubo un error al mandar el correo de confirmacion.';
                $_SESSION['error'] = $error;
                header( 'Location: /' );
                exit;
            }

        }
    } 