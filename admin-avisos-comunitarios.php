<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avisos Comunitarios - Admin</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    

</head>
<body class="bg-light body-admin">

    <?php include 'admin-menu.php'; ?>


    <div class="container py-4">

        <h2 class="m-2">Avisos Comunitarios</h2>

        <ul class="nav nav-tabs mb-4" id="avisosTabs">
            <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#recibidos">Recibidos</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#aprobados">Aprobados</button>
            </li>
            <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#rechazados">Rechazados</button>
            </li>
        </ul>

        <div class="tab-content">

            <!-- TAB 1: Avisos Recibidos -->
            <div class="tab-pane fade show active" id="recibidos">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <h5 class="card-title mb-3">Avisos Recibidos</h5>

                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Aviso</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Juan Pérez</td>
                                        <td>Manifestación en Av. Universidad el martes 9 AM</td>
                                        <td>2025-11-10</td>
                                        <td>
                                            <button class="btn btn-success btn-sm me-1">Aprobar</button>
                                            <button class="btn btn-danger btn-sm">Rechazar</button>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Ana Ramírez</td>
                                        <td>Bloqueo por transportistas en carretera libre</td>
                                        <td>2025-11-11</td>
                                        <td>
                                            <button class="btn btn-success btn-sm me-1">Aprobar</button>
                                            <button class="btn btn-danger btn-sm">Rechazar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- TAB 2: Avisos Aprobados -->
            <div class="tab-pane fade" id="aprobados">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Avisos Aprobados</h5>

                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Aviso</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Eliminar de la página</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Juan Pérez</td>
                                        <td>Manifestación en Av. Universidad</td>
                                        <td>2025-11-10</td>
                                        <td><span class="badge bg-success">Aprobado</span></td>
                                        <td><button class="btn btn-danger btn-sm">Eliminar</button></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- TAB 3: Avisos Rechazados -->
            <div class="tab-pane fade" id="rechazados">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Avisos Rechazados</h5>

                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Aviso</th>
                                        <th>Fecha</th>
                                        <th>Estado</th>
                                        <th>Agregar a la página</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Ana Ramírez</td>
                                        <td>Bloqueo por transportistas</td>
                                        <td>2025-11-11</td>
                                        <td><span class="badge bg-danger">Rechazado</span></td>
                                        <td><button class="btn btn-success btn-sm">Agregar</button></td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div> <!-- tab content -->

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
