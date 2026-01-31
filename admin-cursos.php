<?php  
    session_start();
    include_once __DIR__ . '/config/Connection.php';

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
    if( isset( $_SESSION['error'] ) || !empty( $_SESSION['error'] ) ){
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Admin - Cursos</title>

    <link href="./src/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./src/css/style.css">



</head>
<body class="bg-light body-admin ">

    <?php include_once __DIR__ . '/admin-menu.php'; ?>


    <div class="container py-4">
        <div class="modal fade" id="modalAgregar" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalAgregar" aria-hidden="true">
            <div class="modal-dialog modal-centered">
                <div class="modal-content border-0 shadow login-modal m-3">
                    <form action="crudCourses/agregarCurso.php" method="POST" enctype="multipart/form-data">
                        <div class="text-center mb-3">
                            <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                            <h5 class="fw-bold text-primary-custom">Agregar curso</h5>
                        </div>
                        <div class="d-flex justify-content-center flex-column gap-2 m-3">
                            <label for="title">Titulo del curso:</label>
                            <input type="text" id="title" name="title">
                            <label for="area">Area:</label>
                            <input type="text" name="area" id="area">
                            <label for="descr" > Descripcion: </label>
                            <textarea name="descr" id="descr"></textarea>
                            <label for="offers">Ofrecemos: </label>
                            <textarea name="offers" id="offers"></textarea>
                            <label for="date">Fecha de inicio:</label>
                            <input type="date" name="date" id="date">
                            <label for="imgCourse"></label>
                            <input type="file" id="imgCourse" name="imgCourse" accept="image/jpeg, image/png" placeholder="Ingresa la imagen del curso">
                        </div>
                        <div class="d-flex justify-content-end gap-2 m-3">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning" >Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <h2 class="text-center mb-0 fw-bold">Cursos y Capacitación</h2>
        <p class="lead text-center text-secondary fw-semibold">Centrales de Abasto, Transportistas, Productores Agrícolas y Mercados Públicos.</p>
        <button class="btn btn-warning justify-self-end m-3" type="button" data-bs-toggle="modal" data-bs-target="#modalAgregar" >Agregar curso</button>
        <?php 
        $sql = "SELECT * FROM courses";
        $stmt = $conn -> prepare($sql);
        $stmt -> execute();
        ?>
        <div class="row">
            <?php while ($res = $stmt -> fetch()): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="./imagesCourses/<?php echo $res['images'] ?>" class="card-img-top" alt="Noticia 1">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $res['title'] ?></h5>
                        <p class="card-text text-muted small"><?echo $res['area']?></p>
                        <p class="card-text text-muted small">Fecha de inicio: <?php echo $res['date'] ?></p>
                        <p class="card-text"><?php echo nl2br( $res['descr'] ) ?></p>
                        <p><?php echo nl2br( $res['offers'] )?></p>
                        <div class="">
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBorrar<?php echo $res['id']?>">Borrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalBorrar<?php echo $res['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="ModalBorrar" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow login-modal">
                        <form action="./crudCourses/borrarCurso.php" method="POST" class="p-4 rounded">
                            <div class="text-center mb-3">
                                <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                                <h5 class="fw-bold text-primary-custom">BORRAR CURSO | <?php echo $res['title'] ?></h5>
                            </div>
                            <input type="text" value="<?php echo $res['id'] ?>" name="id" hidden>
                            
                            <div class="mb-3">
                                <label for="borrarFrase" class="form-label fw-semibold">"Deseo borrar el curso permanentemente"</label>
                                <input type="text" name="borrar" class="form-control form-control-lg input-custom" placeholder="Para borrar ingrese la frase de arriba" required>
                            </div>
                            <div class="d-flex justify-content-end gap-2">
                                <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary-custom">Borrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

<script src="./src/js/bootstrap.bundle.js"></script>


</body>
</html>
