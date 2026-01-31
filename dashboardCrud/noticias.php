<?php
    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");

    $conn = connection();
    $location = 'Location: ./../admin-blog.php';
    $error = '';
    $fileSizeLimit = 1024 * 1024 * 3;
    $acceptedTypes = [ 'image/jpg', 'image/png', 'image/jpeg', 'image/webp' ];
    $mime;
    $locationNoticiaImg = __DIR__ . '/../img/imgNoticias/';

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
        if( $_POST['action'] === 'nuevaNoticia' ){
            ( !isset( $_POST['titulo'] ) || empty( $_POST['titulo'] ) ) ? $_SESSION['error'] = "Debe ingresar un titulo para la noticia." : $titulo = $_POST['titulo'] ;
            ( !isset( $_POST['fecha'] ) || empty( $_POST['fecha'] ) ) ? $_SESSION['error'] = "Es necesario ingresar la fecha de la noticia." : $fecha = $_POST['fecha'] ;
            ( !isset( $_POST['texto'] ) || empty( $_POST['texto'] ) ) ? $_SESSION['error'] = "Es necesario ingresar el texto/contenido de la noticia." : $texto = $_POST['texto'];

            if( !empty( $_SESSION['error'] ) ){
                header( $location );
                exit;
            }
            
            if($_FILES['imgNoticia']['error'] === UPLOAD_ERR_OK && !empty( $_FILES['imgNoticia']['name'] )){
                $mime = mime_content_type($_FILES['imgNoticia']['tmp_name']);
                if( !in_array( $mime, $acceptedTypes ) ){
                    $_SESSION['error'] =  'Solo se aceptan imágenes de tipo PNG, JPG, JPEG y WEBP';
                    header( $location );
                    exit;
                }
                if( $_FILES['imgNoticia']['size'] > $fileSizeLimit ) {
                    $_SESSION['error'] = 'La imágen debe ser menor a 3mb';
                    header( $location );
                    exit;
                }
            } else {
                $_SESSION['error'] = 'La imágen no es valida';
                header( $location );
                exit;
            }

            $imageName = md5( uniqid( ( rand() ), true ) ). '.webp';
            $locationNoticiaImg .= $imageName; 

            if( $mime === 'image/jpeg' || $mime === 'image/jpg' ){
                $image = imagecreatefromjpeg( $_FILES['imgNoticia']['tmp_name'] );
                imagewebp( $image, $locationNoticiaImg, 50 );
            }

            if( $mime === 'image/png' ){
                $image = imagecreatefrompng( $_FILES['imgNoticia']['tmp_name'] );
                imagewebp( $image, $locationNoticiaImg, 50 );
            }

            if( $mime === 'image/webp' ){
                $image = imagecreatefrompng( $_FILES['imgNoticia']['tmp_name'] );
                imagewebp( $image, $locationNoticiaImg, 50 );
            }

            $sql = "INSERT INTO noticias (titulo, fecha, contenido, imagen) VALUES (:titulo, :fecha, :contenido, :imagen)";

            try{
                $stmt = $conn -> prepare($sql);
                $stmt -> execute([
                    'titulo' => $titulo,
                    'fecha' => $fecha,
                    'contenido' => $texto,
                    'imagen' => $imageName 
                ]);
                $res = $stmt -> rowCount();
                if( $res > 0 ){
                    header($location);
                    exit;
                }else{
                    $_SESSION['error'] = 'No se pudo agregar el curso';
                    header($location);
                    exit;
                }
            }catch(PDOException $e){
                $_SESSION['error'] = 'Hubo un error en ingresar el curso en el sistema.';
                header($location);
                exit;
            }

        }
        if( $_POST['action'] === 'editarNoticia' ){

            ( !isset($_POST['idNoticia']) || empty($_POST['idNoticia']) ) 
                ? $_SESSION['error'] = "Noticia no válida." 
                : $idNoticia = $_POST['idNoticia'];

            ( !isset($_POST['titulo']) || empty($_POST['titulo']) ) 
                ? $_SESSION['error'] = "Debe ingresar un titulo." 
                : $titulo = $_POST['titulo'];

            ( !isset($_POST['fecha']) || empty($_POST['fecha']) ) 
                ? $_SESSION['error'] = "Debe ingresar la fecha." 
                : $fecha = $_POST['fecha'];

            ( !isset($_POST['texto']) || empty($_POST['texto']) ) 
                ? $_SESSION['error'] = "Debe ingresar el contenido." 
                : $texto = $_POST['texto'];

            if( !empty($_SESSION['error']) ){
                header($location);
                exit;
            }

            /* 🔍 OBTENER IMAGEN ACTUAL */
            $sqlImg = "SELECT imagen FROM noticias WHERE id = :id";
            $stmtImg = $conn->prepare($sqlImg);
            $stmtImg->execute(['id' => $idNoticia]);
            $noticia = $stmtImg->fetch(PDO::FETCH_ASSOC);

            if(!$noticia){
                $_SESSION['error'] = 'La noticia no existe.';
                header($location);
                exit;
            }

            $imageName = $noticia['imagen'];

            /* 📷 SI HAY NUEVA IMAGEN */
            if( isset($_FILES['imgNoticia']) && $_FILES['imgNoticia']['error'] === UPLOAD_ERR_OK && !empty($_FILES['imgNoticia']['name']) ){

                $mime = mime_content_type($_FILES['imgNoticia']['tmp_name']);

                if( !in_array($mime, $acceptedTypes) ){
                    $_SESSION['error'] = 'Solo se aceptan imágenes PNG, JPG, JPEG y WEBP';
                    header($location);
                    exit;
                }

                if( $_FILES['imgNoticia']['size'] > $fileSizeLimit ){
                    $_SESSION['error'] = 'La imagen debe ser menor a 3MB';
                    header($location);
                    exit;
                }

                /* 🗑️ BORRAR IMAGEN ANTERIOR */
                $oldImgPath = $locationNoticiaImg . $imageName;
                if( file_exists($oldImgPath) ){
                    unlink($oldImgPath);
                }

                /* 💾 GUARDAR NUEVA IMAGEN */
                $imageName = md5( uniqid(rand(), true) ) . '.webp';
                $newImgPath = $locationNoticiaImg . $imageName;

                if( $mime === 'image/jpeg' || $mime === 'image/jpg' ){
                    $image = imagecreatefromjpeg($_FILES['imgNoticia']['tmp_name']);
                }

                if( $mime === 'image/png' ){
                    $image = imagecreatefrompng($_FILES['imgNoticia']['tmp_name']);
                }

                if( $mime === 'image/webp' ){
                    $image = imagecreatefromwebp($_FILES['imgNoticia']['tmp_name']);
                }

                imagewebp($image, $newImgPath, 50);
                imagedestroy($image);
            }

            /* ✏️ UPDATE */
            $sql = "UPDATE noticias 
                    SET titulo = :titulo, fecha = :fecha, contenido = :contenido, imagen = :imagen
                    WHERE id = :id";

            try{
                $stmt = $conn->prepare($sql);
                $stmt->execute([
                    'titulo' => $titulo,
                    'fecha' => $fecha,
                    'contenido' => $texto,
                    'imagen' => $imageName,
                    'id' => $idNoticia
                ]);

                header($location);
                exit;

            }catch(PDOException $e){
                $_SESSION['error'] = 'Error al actualizar la noticia.';
                header($location);
                exit;
            }
        }
    }