<?php
    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");

    $conn = connection();
    $fileSizeLimit = 1024 * 1024 * 3;
    $acceptedTypes = [ 'image/jpg', 'image/png', 'image/jpeg' ];
    $mime;
    $error = '';
    
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

        if( $_POST['action'] === 'participaciones' ){

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

        if( $_POST['action'] === 'promocional' ) {
            ( !isset( $_POST['tituloPromocional'] ) || empty( $_POST['tituloPromocional'] ) ) ? $error = "Debe ingresar Un titulo para el promocional" : $tituloPromo = $_POST['tituloPromocional'];
            ( !isset( $_POST['descripcionPromocional']) || empty( $_POST['descripcionPromocional'] ) ) ? $error = "La descripcion no puede ir vacía." : $descripcionPromo = $_POST['descripcionPromocional'];
            ( !isset( $_POST['urlPromocional'] ) || empty( $_POST['urlPromocional'] ) ) ? $error = "Debe ingresar una direccion URL valida." : $urlPromo = $_POST['urlPromocional'];
            
            if( $error !== ''){
                header( 'Location: /' );
                exit;
            }

            $imgDir = "../img/indexImg/promocional.webp";

            if( $_FILES['imgPromocional']['error'] === UPLOAD_ERR_OK && !empty( $_FILES['imgPromocional']['name'] ) ){
                $mime = mime_content_type( $_FILES['imgPromocional']['tmp_name'] );
                if( !in_array( $mime, $acceptedTypes ) ){
                    $error = "Solo se aceptan imagenes tipo PNG/JPEG/JPG";
                    header( 'Location: /' );
                    exit;
                }
                if( $_FILES['imgPromocional']['size'] > $fileSizeLimit ){
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
                $image = imagecreatefromjpeg( $_FILES['imgPromocional']['tmp_name'] ); 
                imagewebp( $image, $imgDir, 50 );
            }
            if( $mime === 'image/png' ){
                $image = imagecreatefrompng( $_FILES['imgPromocional']['tmp_name'] );
                imagewebp( $image, $imgDir, 50 );
            }
            try{
                $promocionalId = uniqid('', true);
                $conn -> prepare("UPDATE promocional SET active = 0") -> execute();
                $sql = "INSERT INTO promocional (promocionalId, titulo, descripcion, url, img, active) VALUES ( :promocionalId, :tituloPromo, :descrPromo, :urlPromo, 'promocional.webp', 1 )";
                $stmt = $conn -> prepare($sql);
                $stmt -> execute([
                    'promocionalId' => $promocionalId,
                    'tituloPromo' => $tituloPromo,
                    'descrPromo' => $descripcionPromo,
                    'urlPromo' => $urlPromo
                ]);
                header( 'Location: /' );
                exit;
                
            } catch( PDOException $e ){
                $error = "Hubo un problema al ingresar la promocion.";
                header( 'Location: /' );
                exit;
            }

        }
    }