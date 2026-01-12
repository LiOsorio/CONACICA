<?php
session_start();
require_once(__DIR__ . '/../config/Connection.php');

$conn = connection();

/*
echo "<pre>";
echo var_dump($_POST);
echo "</pre>";
exit;
*/

( !isset($_POST['user']) || empty($_POST['user']) ) ? $error = "Verifique los datos de inicio de sesión." : $user = $_POST['user'];
( !isset($_POST['pwd']) || empty($_POST['pwd']) ) ? $error = "Verifique los datos de inicio de sesión." : $pwd = $_POST['pwd'];

if($error === ''){
    $_SESSION['error'] = $error;
    header("Location: /");
    exit;
}
$sql = "SELECT * FROM users WHERE user = :user ";

$stmt = $conn -> prepare($sql);
$stmt -> execute(['user' => $user]);
$res  = $stmt -> fetch();

if( $pwd === $res['pwd'] ){
    $_SESSION['userId'] = $res['id']; 
    header('Location: /');
    exit;
} else {
    $_SESSION['error'] =  "Compruebe sus datos de inicio de sesión";
    header('Location: /');
    exit;
}