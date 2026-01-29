<?php

    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");

    $conn = connection();
    $location = 'Location: ./../admin-avisos-comunitarios.php';
    $locationBlog = 'Location: ./../admin-blog.php';
    $error = '';
    $fileSizeLimit = 1024 * 1024 * 3;
    $acceptedTypes = [ 'image/jpg', 'image/png', 'image/jpeg', 'image/webp' ];
    $mime;
    $locationBlogImg = __DIR__ . '/../img/imgBlog/imgPrincipalBlog.webp';
    $locationImgAvisos = __DIR__ . '/../img/imgBlog/imgAvisosComunitarios.webp';

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
    
    // echo "<pre>";
    // echo var_dump($_POST);
    // echo "</pre>";
    // exit;

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        if( $_POST['action'] === 'aprovar'){
            (!isset( $_POST['id']) ||empty($_POST['id'])) ? $error = 'Se requiere del identificador del aviso para aprovarlo.' : $id = $_POST['id'];
            if( !empty( $error ) ){
                $_SESSION['error'] = $error;
                header($location);
                exit;
            }
            $sql = "UPDATE avisos SET estado = 'aprovado' WHERE id = :id";
            try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute(['id' => $id]);
                $res = $stmt -> rowCount();
                if( $res === 0 ){
                    $_SESSION['error'] = "No se pudo aprovar el aviso";
                }
                header($location);
                exit;
            } catch( PDOException $e ){
                $_SESSION['error'] = "Hay un problema con el servidor";
                header($location);
                exit;
            }
        }
        if( $_POST['action'] === 'eliminar'){
            (!isset( $_POST['id']) ||empty($_POST['id'])) ? $error = 'Se requiere del identificador del aviso para aprovarlo.' : $id = $_POST['id'];
            if( !empty( $error ) ){
                $_SESSION['error'] = $error;
                header($location);
                exit;
            }
            $sql = "DELETE FROM avisos WHERE id = :id";
            try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute(['id' => $id]);
                $res = $stmt -> rowCount();
                if( $res === 0 ){
                    $_SESSION['error'] = "No se pudo eliminar el aviso";
                }
                header($location);
                exit;
            } catch( PDOException $e ){
                $_SESSION['error'] = "Hay un problema con el servidor";
                header($location);
                exit;
            }
        }
        if( $_POST['action'] === 'rechazar'){
            (!isset( $_POST['id']) ||empty($_POST['id'])) ? $error = 'Se requiere del identificador del aviso para aprovarlo.' : $id = $_POST['id'];
            if( !empty( $error ) ){
                $_SESSION['error'] = $error;
                header($location);
                exit;
            }
            $sql = "UPDATE avisos SET estado = 'rechazado' WHERE id = :id";
            try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute(['id' => $id]);
                $res = $stmt -> rowCount();
                if( $res === 0 ){
                    $_SESSION['error'] = "No se pudo rechazar el aviso";
                }
                header($location);
                exit;
            } catch( PDOException $e ){
                $_SESSION['error'] = "Hay un problema con el servidor";
                header($location);
                exit;
            }
        }
    
        if( $_POST['action'] === 'editarImgPrincipal' ){
            if( $_FILES['imgPrincipalBlog']['error'] === UPLOAD_ERR_OK && !empty( $_FILES['imgPrincipalBlog']['name'] ) ){
                $mime = mime_content_type( $_FILES['imgPrincipalBlog']['tmp_name'] );
                if( !in_array( $mime, $acceptedTypes ) ){
                    $_SESSION['error'] =  'Solo se aceptan imágenes de tipo PNG, JPG, JPEG y WEBP';
                    header( $locationBlog );
                    exit;
                }
                if( $_FILES['imgPrincipalBlog']['size'] > $fileSizeLimit ) {
                    $_SESSION['error'] = 'La imágen debe ser menor a 3mb';
                    header( $locationBlog );
                    exit;
                }
            } else {
                $_SESSION['error'] = 'La imágen no es valida';
                header( $locationBlog );
                exit;
            }

            if( $mime === 'image/jpeg' || $mime === 'image/jpg' ){
                $image = imagecreatefromjpeg( $_FILES['imgPrincipalBlog']['tmp_name'] );
                imagewebp( $image, $locationBlogImg, 50 );
                header( $locationBlog );
                exit;
            }

            if( $mime === 'image/png' ){
                $image = imagecreatefrompng( $_FILES['imgPrincipalBlog']['tmp_name'] );
                imagewebp( $image, $locationBlogImg, 50 );
                header( $locationBlog );
                exit;
            }

            if( $mime === 'image/webp' ){
                $image = imagecreatefrompng( $_FILES['imgPrincipalBlog']['tmp_name'] );
                imagewebp( $image, $locationBlogImg, 50 );
                header( $locationBlog );
                exit;
            }
        }

        if( $_POST['action'] === 'ImgAvisosCambiar' ){
            if( $_FILES['imgAvisos']['error'] === UPLOAD_ERR_OK && !empty( $_FILES['imgAvisos']['name'] ) ){
                $mime = mime_content_type( $_FILES['imgAvisos']['tmp_name'] );
                if( !in_array( $mime, $acceptedTypes ) ){
                    $_SESSION['error'] =  'Solo se aceptan imágenes de tipo PNG, JPG, JPEG y WEBP';
                    header( $locationBlog );
                    exit;
                }
                if( $_FILES['imgAvisos']['size'] > $fileSizeLimit ) {
                    $_SESSION['error'] = 'La imágen debe ser menor a 3mb';
                    header( $locationBlog );
                    exit;
                }
            } else {
                $_SESSION['error'] = 'La imágen no es valida';
                header( $locationBlog );
                exit;
            }

            if( $mime === 'image/jpeg' || $mime === 'image/jpg' ){
                $image = imagecreatefromjpeg( $_FILES['imgAvisos']['tmp_name'] );
                imagewebp( $image, $locationImgAvisos, 50 );
                header( $locationBlog );
                exit;
            }

            if( $mime === 'image/png' ){
                $image = imagecreatefrompng( $_FILES['imgAvisos']['tmp_name'] );
                imagewebp( $image, $locationImgAvisos, 50 );
                header( $locationBlog );
                exit;
            }

            if( $mime === 'image/webp' ){
                $image = imagecreatefrompng( $_FILES['imgAvisos']['tmp_name'] );
                imagewebp( $image, $locationImgAvisos, 50 );
                header( $locationBlog );
                exit;
            }
        }
    }