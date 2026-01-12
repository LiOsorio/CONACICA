<?php

    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");

    $conn = connection();
    $error = '';
    $location = 'Location: ../blog.php';
    // echo "<pre>";
    // echo var_dump($_POST);
    // echo "</pre>";
    // exit;

    if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
        if( $_POST['action'] === 'avisoPub' ){
            $tipos = ['Bloqueo','Mercado','Agricultura','Clima','Logística','General'];
            ( !isset( $_POST['tipo']) || empty($_POST['tipo'] ) ) ? $error = 'El tipo de aviso es necesario.' : $tipo = $_POST['tipo'];
            ( !isset( $_POST['titulo'] ) || empty( $_POST['titulo'] ) ) ? $error = 'El titulo del aviso es necesario.' : $titulo = $_POST['titulo'];
            ( !isset( $_POST['lugar'] ) || empty( $_POST['lugar'] ) ) ? $error = 'Es necesario indicar el lugar' : $lugar = $_POST['lugar'];
            ( !isset( $_POST['fecha'] ) || empty( $_POST['fecha'] ) )? $error ='Es necesario ingresar la fecha.' : $fecha = $_POST['fecha'];
            ( !isset( $_POST['descripcion']) || empty( $_POST['descripcion'] ) ) ? $error = 'la descripcion es obligatoria' : $desc = $_POST['descripcion'] ;

            if( !empty($error) ){
                $_SESSION['error'] = $error;
                header( $location );
                exit;
            }

            $sql = "INSERT INTO avisos (titulo, lugar, fecha, tipo, estado, aviso) VALUES ( :titulo, :lugar, :fecha, :tipo, 'proceso', :aviso )";

            try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute([
                    'titulo' => $titulo,
                    'lugar' => $lugar,
                    'fecha' => $fecha,
                    'tipo' => $tipo,
                    'aviso' => $desc
                ]);
                $res = $stmt -> rowCount();
                if( $res === 0 ){
                    $_SESSION['error'] = 'No se pudo enviar el aviso al sistema.';
                }
                header( $location );
                exit;

            } catch( PDOException $e ) {
                $_SESSION['error'] = 'Hubo un error al insertar el aviso';
                header( $location );
                exit;
            }
        }
    }
