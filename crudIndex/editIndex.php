<?php
    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");

    $conn = connection();
    $fileSizeLimit = 1024 * 1024 * 4;
    $acceptedTypes = [ 'image/jpg', 'image/png', 'image/jpeg', 'image/webp' ];
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
    // echo '<pre>';
    // echo var_dump($_POST);
    // echo '</pre>';
    // exit;

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        if( $_POST['action'] === 'nosotros' ){

            $imageFolder = __DIR__ . '/../img/indexImg/nosotros.webp';
            $newFile = __DIR__ . "/../img/indexImg/nosotros.webp";

            if( $_FILES['imgNosotros']['error'] === UPLOAD_ERR_OK && !empty( $_FILES['imgNosotros']['name'] ) ){
                $mime = mime_content_type( $_FILES['imgNosotros']['tmp_name'] );
                if( !in_array( $mime, $acceptedTypes ) ){
                    $error = "Solo se aceptan imagenes tipo PNG/JPEG/JPG/WEBP";
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
                imagewebp( $image, $newFile, 85 );
                header( 'Location: /' );
                exit;
            }
            if($mime === 'image/webp'){
                $image = imagecreatefromwebp( $image, $newFile, 100 );
                header( 'Location: /' );
                exit;
            }
        }

        if( $_POST['action'] === 'participaciones' ){

            $imgDir = __DIR__ . "/../img/indexImg/participaciones.webp";

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

            $imgDir = __DIR__ . "/../img/indexImg/promocional.webp";

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

        if( $_POST['action'] === 'nuevaAlianza' ){
            
            $error;
            ( !isset( $_POST['nombreNuevaAlianza'] ) || empty( $_POST['nombreNuevaAlianza'] ) ) ? $error = 'El nombre de la alianza no es valido.' : $nombreAlianza = $_POST["nombreNuevaAlianza"];
            
            $imgDir = __DIR__ . "../img/indexImg/alianzas/".$nombreAlianza .".webp";

            if( $error !== '' ){
                $_SESSION['error'] = $error;
                header( 'Location: /' );
                exit;
            }

            $sqlVerifAlianza = "SELECT * FROM alianzas WHERE nombre = :nombre";

            $stmt = $conn -> prepare( $sqlVerifAlianza ) ;
            $stmt -> execute( [ 'nombre' => $nombreAlianza ] );
            $res = $stmt -> fetch();

            if( $res ){
                $error = 'Ya existe una alianza con este nombre';
                $_SESSION['error'] = $error;
                header( ' Location: / ' );
                exit;
            }

            if( $_FILES['imgNuevaAlianza']['error'] === UPLOAD_ERR_OK && !empty($_FILES['imgNuevaAlianza']['name']) ){
                if( !in_array( $_FILES['imgNuevaAlianza']['type'], $acceptedTypes ) ){
                    $error = 'Sólo se aceptan imágenes de tipo JPEG, JPG y PNG';
                    $_SESSION['error'] = $error;
                    header( 'Location: /' );
                    exit;
                }
                
                if( $_FILES['imgNuevaAlianza']['size'] > $fileSizeLimit ){
                    $error = 'El tamaño de la imágen debe ser menor a 3mb.';
                    $_SESSION['error'] = $error;
                    header( 'Location: /' );
                    exit;
                }
                $mime = mime_content_type( $_FILES['imgNuevaAlianza']['tmp_name'] );
            } else {
                $error = 'La imágen no es valida.';
                $_SESSION['error'] = $error;
                header( 'Location: /' );
                exit;
            }

            if( $mime === 'image/jpeg' || $mime === 'image/jpg' ){
                $image = imagecreatefromjpeg( $_FILES['imgNuevaAlianza']['tmp_name'] );
                imagewebp($image, $imgDir, 50);
            }
            if( $mime === 'image/png' ){
                $image = imagecreatefrompng( $_FILES['imgNuevaAlianza']['tmp_name'] );
                imagewebp( $image, $imgDir, 50 );
            }

            

            $sql = "INSERT INTO alianzas ( img, nombre, active ) VALUES ( :imgName, :nombreAlianza, 1 )";

            try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute([
                    'imgName' => $nombreAlianza.'.webp',
                    'nombreAlianza' => $nombreAlianza
                ]);
                header( 'Location: /' );
                exit;
            }catch( PDOException $e ){
                $error = "Hubo un error al ingresar la alianza a la base de datos.";
                $_SESSION['error'] = $error;
                header( 'Location: /' );
                exit;
            }
        }


        if( $_POST['action'] === 'editarAlianza' ){  

            $sqlReset = "UPDATE alianzas SET active = 0";

            $stmt = $conn -> prepare( $sqlReset ) -> execute();

            $ids = array_keys( $_POST['active'] );
            
            $sql = "UPDATE alianzas SET active = 1 WHERE id IN (" . implode( ',', $ids ) . ") ";
            
            try{
                $stmt = $conn -> prepare( $sql ) -> execute();
                header( 'Location: /' );
                exit;
            } catch( PDOException $e ) {
                $error = 'Hay un error al subir a la base de datos.';
            }
        }
    }