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
    <link href="./src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="./src/css/style.css">

</head>
<body>

    <?php include 'nav.php'; ?>

    <section id="blog" class="py-5 bg-light">
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
                            <img src="./imagesCourses/<?php echo $res['images'] ?>" class="card-img-top" alt="Noticia 1">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $res['title'] ?></h5>
                                <p class="card-text text-muted small"><?echo $res['area']?></p>
                                <p class="card-text text-muted small">Fecha de inicio: <?php echo $res['date'] ?></p>
                                <p class="card-text"><?php echo nl2br( $res['descr'] ) ?></p>
                                <p><?php echo nl2br( $res['offers'] )?></p>
                                <div class="">
                                    <button class="btn btn-outline-success m-4" type="button" data-bs-toggle="modal" data-bs-target="#modalInfoCurso<?php echo $res['id'] ?>">Solicitar Información</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalInfoCurso<?php echo $res['id'] ?>" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalAgregar" aria-hidden="true">
                        <div class="modal-dialog modal-centered">
                            <div class="modal-content border-0 shadow login-modal m-3">
                                <!-- Header -->
                                <div class="modal-header bg-green text-white">
                                    <h5 class="modal-title">Contáctanos</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <!-- Body -->
                                <div class="modal-body">
                                    <form action="./crudIndex/contactoIndex.php" method="POST">
                                        <div class="mb-3">
                                            <label class="form-label">Nombre completo</label>
                                            <input type="text" class="form-control" name="nombre" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Correo electrónico</label>
                                            <input type="email" class="form-control" name="email" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" name="asunto" value="Cursos" required hidden>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Mensaje</label>
                                            <textarea class="form-control" name="mensaje" rows="4" required>Me gustaria recibir información sobre el curso " <?php echo $res['title'] ?>, gracias."</textarea>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" name="action" value="sendMail" class="btn btn-success">Enviar mensaje</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
    <?php include 'footer.php'; ?>


    <script src="./src/js/bootstrap.bundle.js"></script>
</body>
</html>