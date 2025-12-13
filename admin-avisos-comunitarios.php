<?php 
    session_start();

    include_once "./config/Connection.php";

    $conn = connection();
    $error ='';
    


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avisos Comunitarios - Admin</title>

  <!-- Bootstrap -->
  <link href="./src/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./src/css/style.css">
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

    <!-- TAB 1: RECIBIDOS -->
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

                <!-- FILA CLICKEABLE -->
                <tr class="ver-aviso"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDetalleAviso"
                    data-etiqueta="Bloqueo"
                    data-color="#DC3545"
                    data-titulo="Bloqueo por transportistas en carretera libre"
                    data-lugar="Carretera México–Toluca"
                    data-fecha="2025-11-11"
                    data-descripcion="Transportistas realizan un bloqueo parcial en ambos sentidos como medida de protesta. Se recomienda tomar rutas alternas y mantenerse informado.">

                  <td>Ana Ramírez</td>
                  <td>Bloqueo por transportistas en carretera libre</td>
                  <td>2025-11-11</td>
                  <td>
                    <button class="btn btn-success btn-sm me-1">Aprobar</button>
                    <button class="btn btn-danger btn-sm">Rechazar</button>
                  </td>
                </tr>

                <tr class="ver-aviso"
                    data-bs-toggle="modal"
                    data-bs-target="#modalDetalleAviso"
                    data-etiqueta="Mercado"
                    data-color="#007BFF"
                    data-titulo="Apertura de mercado regional"
                    data-lugar="Toluca, Estado de México"
                    data-fecha="2025-11-10"
                    data-descripcion="Productores locales informan sobre la apertura de un nuevo mercado regional con apoyo comunitario.">

                  <td>Juan Pérez</td>
                  <td>Apertura de mercado regional</td>
                  <td>2025-11-10</td>
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

    <!-- TAB 2: APROBADOS -->
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
                  <th>Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Juan Pérez</td>
                  <td>Apertura de mercado regional</td>
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

    <!-- TAB 3: RECHAZADOS -->
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
                  <th>Agregar</th>
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

  </div>
</div>

<!-- MODAL DETALLE AVISO -->
<div class="modal fade" id="modalDetalleAviso" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header bg-green">
        <span id="modalEtiqueta" class="badge me-2"></span>
        <h5 class="text-light fw-semibold" id="modalTitulo"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p><strong>Lugar:</strong> <span id="modalLugar"></span></p>
        <p class="text-muted"><strong>Fecha:</strong> <span id="modalFecha"></span></p>

        <hr>

        <p id="modalDescripcion" class="lh-lg"></p>

        <div class="alert alert-warning small mt-4">
          ⚠️ Recuerda validar la información para evitar información falsa.
        </div>
      </div>

    </div>
  </div>
</div>

<!-- Bootstrap -->
<script src="./src/js/bootstrap.bundle.js"></script>

<!-- SCRIPT -->
<script>
document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.ver-aviso').forEach(fila => {
    fila.addEventListener('click', () => {

      document.getElementById('modalEtiqueta').textContent = fila.dataset.etiqueta;
      document.getElementById('modalEtiqueta').style.backgroundColor = fila.dataset.color;

      document.getElementById('modalTitulo').textContent = fila.dataset.titulo;
      document.getElementById('modalLugar').textContent = fila.dataset.lugar;
      document.getElementById('modalFecha').textContent = fila.dataset.fecha;
      document.getElementById('modalDescripcion').textContent = fila.dataset.descripcion;

    });
  });
});
</script>

</body>
</html>
