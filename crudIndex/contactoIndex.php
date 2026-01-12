<?php 
session_start();
include_once __DIR__ . '/../config/Connection.php';

$conn = connection();
$error;

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
                $mailContent = '
                    <div style="font-family: Arial, sans-serif; color:#333; line-height:1.6;">
                        <h1 style="color:#1f2937;">Gracias por contactarnos</h1>

                        <p>
                            Hemos recibido tu mensaje correctamente. 
                            Nuestro equipo de <strong>CONACICA</strong> lo revisará y 
                            te responderá a la brevedad posible.
                        </p>

                        <p>
                            Agradecemos el tiempo que te tomaste para escribirnos.
                            A continuación, te compartimos los datos del mensaje enviado:
                        </p>

                        <hr style="border:none; border-top:1px solid #ddd; margin:20px 0;">

                        <h3 style="margin-bottom:5px;">Asunto</h3>
                        <p style="background:#f9fafb; padding:10px; border-radius:5px;">
                            '.$asunto.'
                        </p>

                        <h3 style="margin-bottom:5px;">Mensaje</h3>
                        <p style="background:#f9fafb; padding:10px; border-radius:5px;">
                            '.nl2br(htmlspecialchars($mensaje)).'
                        </p>

                        <hr style="border:none; border-top:1px solid #ddd; margin:20px 0;">

                        <p style="font-size:14px; color:#555;">
                            Este correo es una confirmación automática. 
                            Si necesitas agregar información adicional, 
                            puedes responder directamente a este mensaje.
                        </p>

                        <p style="margin-top:30px;">
                            Saludos cordiales,<br>
                            <strong>Equipo CONACICA</strong>
                        </p>
                    </div>
                ';

                $mail->Body = $mailContent;

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