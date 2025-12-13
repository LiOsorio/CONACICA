<?php

    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");

    $conn = connection();
    $location = 'Location: ./../admin-avisos-comunitarios.php';
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
    }