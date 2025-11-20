<?php 
    session_start();
    require_once(__DIR__ . '/config/Connection.php');
    $conn = connection();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONACICA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>

    <?php include 'nav.php'; ?>




    <section id="blog" class="py-5 bg-light">
        <?php if( !empty( $_SESSION[ 'userId' ] ) ){?>
            <button class="btn btn-warning justify-self-end m-3" type="button" data-bs-toggle="modal" data-bs-target="#modalAgregar" >Agregar curso</button>
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
                                <label for="date">Fecha:</label>
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
        <?php } ?>
        <div class="container">
            <h2 class="text-center mb-0 fw-bold">Cursos y Capacitación</h2>
            <p class="lead text-center text-secondary fw-semibold">Centrales de Abasto, Transportistas, Productores Agrícolas y Mercados Públicos.</p>
            <?php 
            $sql = "SELECT * FROM courses";

            $stmt = $conn -> prepare($sql);
            $stmt -> execute();
            ?>
            <div class="row">
                <?php while ($res = $stmt -> fetch()): ?>
                    
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="<?php echo $res['images'] ?>" class="card-img-top" alt="Noticia 1">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $res['title'] ?></h5>
                            <p class="card-text text-muted small"><?echo $res['area']?></p>
                            <p class="card-text text-muted small"><?php echo $res['date'] ?></p>
                            <p class="card-text"><?php echo $res['descr']?></p>
                            <p><?php echo $res['offers'] ?></p>
                            <div class="">

                                <a href="ruta/a/blog.html" class="btn btn-outline-success m-4">Postularse</a>
                                <?php if( !empty( $_SESSION[ 'userId' ] ) ): ?>
                                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalBorrar<?php echo $res['id']?>">Borrar</button>
                                <?php endif; ?>
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
    </section>
    <?php include 'footer.php'; ?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>