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
    <title>Mensajes - Admin</title>

    <link href="./src/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./src/css/style.css">



</head>
<body class="bg-light body-admin ">

    <?php include 'admin-menu.php'; ?>


<div class="container row py-4">

    <h2 class="mb-4">Mensajes Recibidos</h2>
    <?php if( !empty( $error ) ): ?>
        <div class="p-3 bg-light rounded border mb-4 mx-auto">
            <p class="text-danger text-center"><?php echo $error ?></p>
        </div>
    <?php endif; ?>
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Remitente</th>
                            <th>Email</th>
                            <th>Asunto</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <?php 
                        $sql = 'SELECT * FROM correos ORDER BY fecha DESC';

                        try{
                            $stmt = $conn -> prepare( $sql );
                            $stmt -> execute();
                        } catch( PDOException $e ) {
                            echo '<p>Hubo un problema al intentar cargar los correos.</p>';
                        }

                    ?>
                    <tbody>
                        <!-- Ejemplo de mensaje NO leído -->
                        <?php while ( $res = $stmt -> fetch() ): ?>
                        <tr 
                            data-id = "<?= $res['id'] ?>?>"
                            data-nombre = "<?=  htmlspecialchars( $res['nombre'] ) ?>"
                            data-email = "<?=  htmlspecialchars( $res['email'] ) ?>"
                            data-asunto = "<?= htmlspecialchars( $res['asunto'] ) ?>"
                            data-mensaje = "<?= htmlspecialchars( $res['mensaje'] ) ?>"
                            data-fecha = "<?= htmlspecialchars( $res['fecha'] ) ?>"
                        >
                            <td><?php echo $res['nombre'] ?></td>
                            <td><?php echo $res['email'] ?></td>
                            <td><?php echo $res['asunto'] ?></td>
                            <td><?php echo $res['fecha'] ?></td>
                            <td><span class="badge badge-nuevo">Nuevo</span></td>
                            <td>
                                <!-- data-bs-toggle="modal" data-bs-target="#modalMensaje1" -->
                                <button class="btn btn-primary btn-sm btn-ver">
                                    Ver
                                </button>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                        <!-- Modal para mensaje 1 -->
                        <div class="modal fade" id="modalMensaje" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">    
                                <form action="./dashboardCrud/gestionMensajes.php" method="post" >
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalTitulo">Mensaje</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <p class="mb-1"><strong>Email:</strong> <span id="modalEmail"></span></p>
                                            <p class="mb-1"><strong>Asunto:</strong> <span id="modalAsunto"></span></p>
                                            <p class="mb-1"><strong>Fecha:</strong> <span id="modalFecha"></span></p>
                                        </div>

                                        <div class="border rounded p-3 bg-light mb-4">
                                            <p class="mb-0" id="modalMensajeTexto"></p>
                                        </div>
                                        <h6 class="mb-2">Responder mensaje</h6>
                                        <input type="email" id="respuestaEmail" name="respuestaEmail" hidden>
                                        <input type="text" id="correoIdRespuesta" name="correoIdRespuesta" hidden>
                                        <div class="mb-3">
                                            <label for="respuestaAsunto" class="form-label small">Asunto</label>
                                            <input 
                                                type="text" 
                                                id="respuestaAsunto" 
                                                name="asuntoRespuesta"
                                                class="form-control"
                                                placeholder="Re: Consulta"
                                            >
                                        </div>

                                        <div class="mb-3">
                                            <label for="respuestaMensaje" class="form-label small">Mensaje</label>
                                            <textarea 
                                                id="respuestaMensaje"
                                                name="mensajeRespuesta" 
                                                class="form-control" 
                                                rows="5"
                                                placeholder="Escribe aquí tu respuesta..."
                                            ></textarea>
                                        </div>

                                    </div>

                                    <!-- Footer -->
                                    <div class="modal-footer">
                                        <button class="btn btn-success btn-sm" type="submit" name="action" value="respuesta">
                                            Enviar respuesta
                                        </button>
                                        <button class="btn btn-danger btn-sm" type="submit" name="action" value="borrarCorreo">
                                            Eliminar
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                                            Cerrar
                                        </button>
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="./src/js/bootstrap.bundle.js"></script>

<script>
    document.addEventListener('click', e => {

        if (!e.target.classList.contains('btn-ver')) return;

        const fila = e.target.closest('tr');
        document.getElementById('modalTitulo').innerText = 'Mensaje de ' + fila.dataset.nombre;
        document.getElementById('modalEmail').innerText = fila.dataset.email;
        document.getElementById('modalAsunto').innerText = fila.dataset.asunto;
        document.getElementById('modalFecha').innerText = fila.dataset.fecha;
        document.getElementById('modalMensajeTexto').innerText = fila.dataset.mensaje;
        document.getElementById('respuestaAsunto').value = fila.dataset.asunto;
        document.getElementById('respuestaEmail').value = fila.dataset.email;
        document.getElementById('correoIdRespuesta').value = fila.dataset.id;

        const modal = new bootstrap.Modal(
            document.getElementById('modalMensaje')
        );

        modal.show();
    });

</script>

</body>
</html>
