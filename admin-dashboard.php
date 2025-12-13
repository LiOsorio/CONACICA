<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Admin - Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="./src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./src/css/style.css">

</head>

<body class="body-admin ">
    <?php include 'admin-menu.php'; ?>

    <!-- CONTENIDO PRINCIPAL -->
    <main>
        <h2 class="mb-4">Gestión CONACICA</h2>

        <!-- Tarjetas de resumen -->
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Noticias</h5>
                        <p class="card-text fs-3 fw-bold text-conacica-green">12</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Avisos</h5>
                        <p class="card-text fs-3 fw-bold text-conacica-green">8</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Participaciones</h5>
                        <p class="card-text fs-3 fw-bold text-conacica-green">27</p>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Mensajes</h5>
                        <p class="card-text fs-3 fw-bold text-conacica-green">4</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Área de gráficas (puedes agregar Chart.js después) -->
        <div class="card shadow-sm mt-4">
            <div class="card-body">
                <h5 class="card-title">Actividad Reciente</h5>
                <p class="text-muted">Cambio de imagen página principal 21/01/2025</p>
                <p class="text-muted">Se agregó nueva notica al blog 21/06/2025</p>

            </div>
        </div>

    </main>

</body>
</html>
