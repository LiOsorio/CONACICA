<?php 

require_once(__DIR__ . '/../config/Connection.php');

$conn = connection();
    $fileSizeLimit = 3 * 1024 * 1024;
    $acceptedTypes = ['image/jpg', 'image/png', 'image/jpeg'];
    $imageFolder = "../imagesCourses";
    $imageName ='';
    $evidencia;
    $error = '';

( !isset($_POST['title']) || empty($_POST['title']) ) ? $error = "todo los campos son obligatorios." : $title = $_POST['title'];
( !isset($_POST['area']) || empty($_POST['area']) ) ? $error = "todo los campos son obligatorios."  : $area = $_POST['area'];
( !isset($_POST['descr']) || empty($_POST['descr']) ) ? $error = "todo los campos son obligatorios." : $descr = $_POST['descr'];
( !isset($_POST['offers']) || empty($_POST['offers']) ) ? $error = "todo los campos son obligatorios." : $offers = $_POST['offers'];

$date = $_POST['date'];

if($error !== ''){
    $_SESSION['error'] = $error;
    exit;
    header('Location: ../cursos.php');
}

if( $_FILES['imgCourse']['error'] === UPLOAD_ERR_OK && !empty( $_FILES['imgCourse']['name'] ) ){
    if( !in_array($_FILES['imgCourse']['type'], $acceptedTypes  ) ){
        $error = 'Solo se acpetan imágenes de tipo PNG/JPEG';
        echo  $error;
        exit;
        header('Location: ../cursos.php');
    }
    if( $_FILES['imgCourse']['size'] > $fileSizeLimit ){
        echo  'La imagen es muy pesada';
        $_SESSION['error'] = $error;
        exit;
        header('Location: ../cursos.php');
    }
}else{
    echo  'La imagen no es valida';
    $_SESSION['error'] = $error;
    exit;
    header('Location: ../cursos.php');
}

if( !is_dir( $imageFolder ) ){
    mkdir($imageFolder);
}
$imageTmpName = md5( uniqid( ( rand() ), true ) );
$imageName = $imageTmpName . '.' . pathinfo( $_FILES['imgCourse']['name'], PATHINFO_EXTENSION );
move_uploaded_file( $_FILES['imgCourse']['tmp_name'], $imageFolder. '/' . $imageName );

$sql = "INSERT INTO courses 
(title, descr, area, date, offers, images) 
VALUES (:title, :descr, :area, :date, :offers, :images)";

try{
    $stmt = $conn -> prepare($sql);
    $stmt -> execute([
        'title' => $title,
        'descr' => $descr,
        'area' => $area,
        'date' => $date,
        'offers' => $offers,
        'images' => $imageName
    ]);
    $res = $stmt -> rowCount();
    if( $res > 0 ){
        header("Location: ../cusros.php");
        exit;
    }else{
        echo  "Error al insertar en la BD";
        exit;
        header("Location: ../cursos.php");
    }
}catch ( PDOException $e ) {
    echo  "Error en la base de datos.";
    exit;
    header("Location: ../cursos.php");
}
