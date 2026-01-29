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
    $locationNoticiaImg = __DIR__ . '/../img/imgBlog/';

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

        }
        if( $_POST['action'] === 'editarNoticia' ){

        }
    }