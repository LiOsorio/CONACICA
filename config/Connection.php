<?php

    function connection() {
        $host = 'localhost';
        $user = 'root';
        $pwd = '428655';
        $db = 'conacica';
        $charset = 'utf8mb4';

        $dbConf = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => pdo::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        try{
            $conn = new PDO($dbConf, $user, $pwd, $opt);
            return $conn;
        }catch( PDOException $e ){
            echo "Hubo un error en la conexión: " . $e -> getMessage();
        }
    }