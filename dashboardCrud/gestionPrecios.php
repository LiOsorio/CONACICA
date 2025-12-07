<?php

use function PHPSTORM_META\type;

    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");

    $conn = connection();
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
        if( $_POST['action'] === 'NuevoProducto' ){
            ( !isset( $_POST['agregarNombreProducto'] ) || empty( $_POST['agregarNombreProducto'] ) ) ? $error = "Es necesario agregar un nombre al producto" : $nombreProducto = $_POST['agregarNombreProducto'];
        
            $sqlVerificar = "SELECT * FROM producto WHERE productName = :nombre";

            try{
                $stmt = $conn -> prepare( $sqlVerificar );
                $stmt -> execute( [ 'nombre' => $nombreProducto ] );
                $res = $stmt -> fetch();
            } catch( PDOException $e ) {
                $error = 'Error al verificar existencia del producto';
                $_SESSION['error'] = $error;
                header( 'Location: ./../admin-dashboard.php');
                exit;
            }

            if( $res ){
                $_SESSION['error'] = $error;
                header( 'Location: /' );
                exit;
            }

            $sql = 'INSERT INTO producto ( productName ) VALUES ( :nombre )';
            try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute( [ 'nombre' => $nombreProducto ] );
                $res = $stmt -> fetch();
                header( 'Location: /' );
                exit;
            } catch( PDOException $e ) {
                $error = "Hubo un error al ingresar el producto a la base de datos.";
                $_SESSION['error'] = $error;
                header( 'Location: /' );
                exit;
            }
        }

        if( $_POST['action'] === 'agregarCentral' ){
            ( !isset( $_POST['agregarNombreCentral'] ) || empty( $_POST['agregarNombreCentral'] ) ) ? $error = 'El nombre de la central es obligatiorio.' : $nombreCentral = $_POST['agregarNombreCentral'];

            $sqlVerificar = 'SELECT * FROM central WHERE centralname = :nombre';

            try{
                $stmt = $conn -> prepare( $sqlVerificar );
                $stmt -> execute( [ 'nombre' => $nombreCentral ] );
                $res = $stmt -> fetch();
            } catch( PDOException $e ) {
                $error = 'Hubo un error al verificar existencia de la central';
                $_SESSION['error'] = $error;
                header( 'Location: ./../admin/admin-dashboard.php' );
                exit;
            }

            if ( $res ) {
                $error = 'Ya existe esta central.';
                $_SESSION['error'] = $error;
                header( 'Location: ./../admin-dashboard.php' );
                exit;
            }

            $sql = 'INSERT INTO central ( centralName ) VALUES ( :nombre )';
            try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute( [ 'nombre' => $nombreCentral ] );
                $res = $stmt -> fetch();

                header( 'Location: ./../admin-dashboard.php' );
                exit;
            } catch ( PDOException $e ) {
                $error = 'Error al ingresar la central a la base de datos.';
                $_SESSION['error'] = $error;
                header( 'Location: ./../admin-dashboard.php' );
                exit;
            }
        }

        if( $_POST['action'] === 'agregarPrecio' ){
            
            $unidadesValidas = ['Mayoreo', 'Menudeo', "Medio Mayoreo"];

            ( !isset( $_POST['precioRegistrar'] ) || empty( $_POST['precioRegistrar'] ) ) ? $error = 'Es necesario ingresar un precio.' : $precio = $_POST['precioRegistrar'];
            ( !preg_match('/^-?\d+(\.\d+)?$/', $precio) ) ? $error = 'No es un número valido.' : $precioFinal = $precio;
            ( !isset( $_POST['unidadRegistrar'] ) || empty( $_POST['unidadRegistrar'] ) ) ? $error = 'Debe ingresar una unidad' : $unidad = $_POST['unidadRegistrar'];
            if( !in_array( $unidad, $unidadesValidas ) ){
                $error = 'La unidad no es valida';
                $_SESSION['error'] = $error;
                header( 'Location: ./../admin-dashboard.php' );
                exit;
            }
            ( !isset( $_POST['centralRegistrar'] ) || empty( $_POST['centralRegistrar'] ) ) ? $error = 'Es necesario seleccionar una central' : $central = $_POST['centralRegistrar'];
            ( !isset( $_POST['productoRegistrar'] ) || empty( $_POST['productoRegistrar'] ) ) ? $error = 'Es necesario seleccionar un producto' : $producto = $_POST['productoRegistrar'];

            $sqlVerificarProducto = 'SELECT * FROM producto WHERE productoId = :id';

            try{
                $stmt = $conn -> prepare( $sqlVerificarProducto );
                $stmt -> execute( [ 'id' => $producto ] );
                $res = $stmt -> fetch();
                if( !$res ) {
                    $error = 'El producto no existe.';
                    $_SESSION['error'] = $error;
                    header( 'Location: ./../admin-dashboard.php' );
                    exit;
                }
            }catch ( PDOException $e ) {
                $error = 'Hubo un error al verificar existencia de producto';
                $_SESSION['error'] = $error;
                header( 'Location: ./../admin-dashboard.php' );
                exit;
            }

            $sqlVerificarCentral = 'SELECT * FROM central WHERE centralId = :id';

            try{
                $stmt = $conn -> prepare( $sqlVerificarCentral );
                $stmt -> execute( [ 'id' => $central ] );
                $res = $stmt -> fetch();
                if( !$res ){
                    $error = 'No existe la central';
                    $_SESSION['error'] = $error;
                    header( 'Location: ./../admin-dashboard.php' );
                    exit;
                }
            }catch( PDOException $e ){
                $error = 'Hubo un problema al verificar existencia de central';
                $_SESSION['error'] = $error;
                header( 'Location: ./../admin-dashboard.php');
                exit;
            }

            $sql = 'INSERT INTO preciosRegistrados (productoId, centralId, unidad, precio, fechaActualizacion) VALUES ( :producto, :central, :unidad, :precio, CURDATE() )';

            try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute( [
                    'producto' => $producto,
                    'central' => $central,
                    'unidad' => $unidad,
                    'precio' => $precio
                ] );
                header( 'Location: ./../admin-precios.php' );
                exit;
            } catch( PDOException $e ) {
                $error = 'Hubo un problema al ingresar el precio';
                $_SESSION['error'] = $error;
                header( 'Location: ./../admin-dashboard.php' );
                exit;
            }
        }
    }