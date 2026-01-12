<?php

session_start();

require_once(__DIR__ . '/../config/Connection.php');

$conn = connection();

if( !empty( $_SESSION['userId'] ) && $_POST[ 'borrar' ] === 'Deseo borrar el curso permanentemente' ){
    $sql = "DELETE FROM courses WHERE id = :id";

    $stmt = $conn ->prepare($sql);
    $stmt -> execute(['id' => $_POST['id']]);
    $res = $stmt -> fetch();

    header("Location: ../cursos.php");
    exit;
}else{
    echo "nope";
    exit;
}