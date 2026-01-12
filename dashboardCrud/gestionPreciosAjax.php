<?php

    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");
    
    $conn = connection();
    $location = 'Location: ./../admin-precios.php';
    $error = '';

    if( !isset( $_SESSION['userId'] ) || empty( $_SESSION['userId'] ) ){
        http_response_code(401);
        echo json_encode([ 'error' => 'No autorizado' ]);
        exit;
    } else {
        $userId = $_SESSION['userId'];
    }
    
    $sql = "SELECT * FROM users WHERE id = :userId ";
    
    $stmt = $conn -> prepare($sql);
    $stmt -> execute( [ 'userId' => $userId ] );
    $res = $stmt -> fetch();
    
    if( !$res ){
        http_response_code(401);
        echo json_encode([ 'error' => 'No autorizado' ]);
        exit;
    }
    header('Content-Type: application/json; charset=utf-8');
    $input = json_decode(file_get_contents("php://input"), true);
    $action = $input['action'];

    if( $action === 'obtenerPrecios' ){
        $html = '';
        $sql = 'SELECT 
                reg.preciosId,
                reg.unidad,
                reg.precio,
                pro.productName,
                cen.centralName
                FROM preciosRegistrados reg
                INNER JOIN producto pro
                ON reg.productoId = pro.productoId
                INNER JOIN central cen
                ON reg.centralId = cen.centralId ';

        try{
            $stmt = $conn -> prepare( $sql );
            $stmt -> execute();
            while( $res = $stmt -> fetch() ){
                $html .= '<tr>
                            <td>'.$res['productName'].'</td>
                            <td>'.$res['centralName'].'</td>
                            <td>'.$res['unidad'].'</td>
                            <td><span class="badge bg-success fs-6">$'.$res['precio'].'</span></td>
                            <td>
                                <form action="./dashboardCrud/gestionPrecios.php" method="post">
                                    <input type="text" name="productoId" value="'.$res['preciosId'].'" hidden>
                                    <button class="btn btn-sm btn-warning me-2" data-bs-toggle="modal" type="button" data-bs-target="#modalEditar"><i class="bi bi-pencil"></i> Editar</button>
                                    <button class="btn btn-sm btn-danger" type="submit" name="action" value="deletePrecio"><i class="bi bi-trash"></i> Eliminar</button>
                                </form>
                            </td>
                        </tr>';
            }
            echo json_encode( [ 'res' => $html ] );
        } catch( PDOException $e ) {
            http_response_code(500);
            echo json_encode([ 'error' => 'Error al realizar la consulta.']);
        }
    }

    if( $action === 'obtenerPreciosFiltrados' ) {
        $html = '';
        $buscar = $input['buscar'] ?? '';
        $sql = 'SELECT 
                reg.preciosId,
                reg.unidad,
                reg.precio,
                pro.productName,
                cen.centralName
                FROM preciosRegistrados reg
                INNER JOIN producto pro
                ON reg.productoId = pro.productoId
                INNER JOIN central cen
                ON reg.centralId = cen.centralId ';

        if( $buscar !== '' ){
            $sql .= ' WHERE pro.productName LIKE :buscar1 OR cen.centralName LIKE :buscar2'; 
        }

        $stmt = $conn -> prepare( $sql );
        if( $buscar !== ''){
            $stmt->bindValue(':buscar1', "%$buscar%", PDO::PARAM_STR);            
            $stmt->bindValue(':buscar2', "%$buscar%", PDO::PARAM_STR);            
        }
        $stmt -> execute();
        while( $res = $stmt -> fetch() ){
        $html .= '<tr>
                    <td>'.$res['productName'].'</td>
                    <td>'.$res['centralName'].'</td>
                    <td>'.$res['unidad'].'</td>
                    <td><span class="badge bg-success fs-6">$'.$res['precio'].'</span></td>
                    <td>
                        <form action="./dashboardCrud/gestionPrecios.php" method="post">
                            <input type="text" name="productoId" value="'.$res['preciosId'].'" hidden>
                            <button class="btn btn-sm btn-warning me-2" type="button" data-bs-toggle="modal" data-bs-target="#modalEditar"><i class="bi bi-pencil"></i> Editar</button>
                            <button class="btn btn-sm btn-danger" type="submit" name="action" value="deletePrecio"><i class="bi bi-trash"></i> Eliminar</button>
                        </form>
                    </td>
                </tr>';
        }
        echo json_encode( [ 'res' => $html ] );

    }