<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mensajes - Admin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">



</head>
<body class="bg-light body-admin ">

    <?php include 'admin-menu.php'; ?>


<div class="container row py-4">

    <h2 class="mb-4">Mensajes Recibidos</h2>

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
                        $sql = 'SELECT * FROM correos';

                        try{
                            $stmt = $conn -> prepare( $sql );
                        } catch( PDOException $e ) {
                            echo '<p>Hubo un problema al intentar cargar los correos.</p>';
                        }

                    ?>
                    <tbody>
                        <!-- Ejemplo de mensaje NO leído -->
                        <tr>
                            <td>María López</td>
                            <td>maria@example.com</td>
                            <td>Problema con registro</td>
                            <td>2025-11-15</td>
                            <td><span class="badge badge-nuevo">Nuevo</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalMensaje1">
                                    Ver
                                </button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>

                        <!-- Modal para mensaje 1 -->
                        <div class="modal fade" id="modalMensaje1" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Mensaje de María López</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p><strong>Email:</strong> maria@example.com</p>
                                        <p><strong>Asunto:</strong> Problema con registro</p>
                                        <hr>
                                        <p>
                                            Hola, traté de registrarme en la plataforma pero me marca error al subir mi archivo. 
                                            ¿Me podrían ayudar?
                                        </p>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-success btn-sm">Marcar como leído</button>
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <!-- Ejemplo de mensaje LEÍDO -->
                        <tr>
                            <td>Carlos Peña</td>
                            <td>carlos@example.com</td>
                            <td>Duda sobre avisos</td>
                            <td>2025-11-14</td>
                            <td><span class="badge badge-leido">Leído</span></td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalMensaje2">Ver</button>
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </td>
                        </tr>

                        <!-- Modal para mensaje 2 -->
                        <div class="modal fade" id="modalMensaje2" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h5 class="modal-title">Mensaje de Carlos Peña</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <div class="modal-body">
                                        <p><strong>Email:</strong> carlos@example.com</p>
                                        <p><strong>Asunto:</strong> Duda sobre avisos</p>
                                        <hr>
                                        <p>
                                            ¿Cuánto tiempo tarda en publicarse un aviso después de enviarlo?
                                        </p>
                                    </div>

                                    <div class="modal-footer">
                                        <button class="btn btn-danger btn-sm">Eliminar</button>
                                        <button class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
