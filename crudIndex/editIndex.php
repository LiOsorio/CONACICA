<?php
    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");

    $conn = connection();
    $fileSizeLimit = 1024 * 1024 * 3;
    $acceptedTypes = [ 'image/jpg', 'image/png', 'image/jpeg' ];
    $mime;
    
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

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        if( $_POST['action'] === 'nosotros' ){

            $imageFolder = '../img/indexImg/nosotros.webp';
            $newFile = "../img/indexImg/nosotros.webp";

            if( $_FILES['imgNosotros']['error'] === UPLOAD_ERR_OK && !empty( $_FILES['imgNosotros']['name'] ) ){
                $mime = mime_content_type( $_FILES['imgNosotros']['tmp_name'] );
                if( !in_array( $mime, $acceptedTypes ) ){
                    $error = "Solo se aceptan imagenes tipo PNG/JPEG/JPG";
                    header( 'Location: /' );
                    exit;
                }
                if( $_FILES['imgNosotros']['size'] > $fileSizeLimit ){
                    $error = "La imagen debe ser menor a 3mb";
                    header( 'Location: /' );
                    exit;
                }
            } else {
                $error = "La imagen no es valida";
                header( 'Location: /' );
                exit;
            }


            if( $mime === 'image/jpeg' || $mime == 'image/jpg' ){
                $image = imagecreatefromjpeg( $_FILES['imgNosotros']['tmp_name'] ); 
                imagewebp( $image, $newFile, 85 );
                header( 'Location: /' );
                exit;
            }
            if( $mime === 'image/png' ){
                $image = imagecreatefrompng( $_FILES['imgNosotros']['tmp_name'] );
                imagewebp( $image, $newImage, 85 );
                header( 'Location: /' );
                exit;
            }
        }
        echo "nope";
        if( $_POST['action'] === 'participaciones' ){

            echo "hola";

            $imgDir = "../img/indexImg/participaciones.webp";

            if( $_FILES['imgParticipaciones']['error'] === UPLOAD_ERR_OK && !empty( $_FILES['imgParticipaciones']['name'] ) ){
                $mime = mime_content_type( $_FILES['imgParticipaciones']['tmp_name'] );
                if( !in_array( $mime, $acceptedTypes ) ){
                    $error = "Solo se aceptan imagenes tipo PNG/JPEG/JPG";
                    header( 'Location: /' );
                    exit;
                }
                if( $_FILES['imgParticipaciones']['size'] > $fileSizeLimit ){
                    $error = "La imagen debe ser menor a 3mb";
                    header( 'Location: /' );
                    exit;
                }
            } else {
                $error = "La imagen no es valida";
                header( 'Location: /' );
                exit;
            }

            if( $mime === 'image/jpeg' || $mime == 'image/jpg' ){
                $image = imagecreatefromjpeg( $_FILES['imgParticipaciones']['tmp_name'] ); 
                imagewebp( $image, $imgDir, 50 );
                header( 'Location: /' );
                exit;
            }
            if( $mime === 'image/png' ){
                $image = imagecreatefrompng( $_FILES['imgParticipaciones']['tmp_name'] );
                imagewebp( $image, $imgDir, 50 );
                header( 'Location: /' );
                exit;
            }

        }
    }