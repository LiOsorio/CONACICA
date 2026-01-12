<?php

    session_start();
    
    include_once(__DIR__ . "/../config/Connection.php");
    
    $conn = connection();
    $location = 'Location: /';
    $error = '';

    header('Content-Type: application/json; charset=utf-8');
    $input = json_decode(file_get_contents("php://input"), true);
    $action = $input['action'];


    if( $action === 'filtrarTablaPub' ){
        $productoId = $input['productoId'] ?? '';
        $centralId = $input['centralId'] ?? '';
        $html = '';
        $cond = [];
        $param =[];

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
                        ON reg.centralId = cen.centralId';
        if( $productoId !== ''){
            $cond[] = 'pro.productoId = :productoId';
            $param[':productoId'] = $productoId;
        }
        if( $centralId !== '' ){
            $cond[] = 'cen.centralId = :centralId';
            $param[':centralId'] = $centralId;
        }
        if( $cond ){
            $sql .= ' WHERE ' . implode( ' AND ', $cond );
        }

        $stmt = $conn -> prepare( $sql );
        $stmt -> execute( $param );

        while ( $res = $stmt -> fetch() ){
            $html .= '
            <tr>
                <td class="fw-bold">'. $res['productName'].'</td>
                <td>'.$res['centralName'].'</td>
                <td>'. $res['unidad'].'</td>
                <td class="text-end fw-bold fs-5 text-dark">$'. $res['precio'] .'</td> 
            </tr>
            ';
        }
        echo json_encode( [ 'res' => $html ] );
    }