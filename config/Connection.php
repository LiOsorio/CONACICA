<?php

    function connection() {
        $host = 'localhost';
        $user = 'root'; //'u715629485_root';
        $pwd = '428655';//'Gerardo101010?';
        $db =  'conacica'; //'u715629485_conacica';
        $charset = 'utf8mb4';

        $dbConf = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => pdo::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        try{
            // $ch = curl_init("https://pgs.ligelira.com/");
            // curl_setopt_array($ch, [
            //     CURLOPT_RETURNTRANSFER => true,
            //     CURLOPT_HTTPGET => true,
            //     CURLOPT_HTTPHEADER => [
            //         'X-API-KEY: 1mm3n43'
            //     ]
            // ]);
            // $r = curl_exec($ch);
            // curl_close($ch);
            // $d = json_decode($r,true);
            $conn = new PDO($dbConf, $user, $pwd, $opt);
            // if( $conn && $d ){
                return $conn;
            // }
            exit;
        }catch( PDOException $e ){
            echo "Hubo un error en la conexión: " . $e -> getMessage();
        }
    }