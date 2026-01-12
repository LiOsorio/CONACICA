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
  <?php if( !empty( $error ) ): ?>
      <div class="p-3 bg-light rounded border mb-4 mx-auto">
          <p class="text-danger text-center"><?php echo $error ?></p>
      </div>
  <?php endif; ?>
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
              <?php 
                $sql = "SELECT * FROM avisos WHERE estado = 'proceso'";

                try{
                  $stmt = $conn -> prepare( $sql );
                  $stmt -> execute();
                }catch( PDOException $e ) {
                  echo '<p>Hubo un error al consultar la base de datos</p>';
                }

                while( $res = $stmt -> fetch()):
              ?>
                  <tr class="ver-aviso"
                      data-bs-toggle="modal"
                      data-bs-target="#modalDetalleAviso"
                      data-etiqueta="Mercado"
                      data-color="#007BFF"
                      data-titulo="Apertura de mercado regional"
                      data-lugar="Toluca, Estado de México"
                      data-fecha="2025-11-10"
                      data-descripcion="Productores locales informan sobre la apertura de un nuevo mercado regional con apoyo comunitario.">

                    <td><?= $res['lugar']  ?></td>
                    <td><?= $res['titulo'] ?></td>
                    <td><?= $res['fecha'] ?></td>
                    <td>
                      <form action="./dashboardCrud/editBlog.php" method="post">
                        <input type="text " name="id" value="<?= $res['id'] ?>" hidden>
                        <button name="action" value="aprovar" type="submit" class="btn btn-success btn-sm me-1">Aprobar</button>
                        <button name="action" value="rechazar" type="submit" class="btn btn-danger btn-sm">Rechazar</button>
                      </form>
                    </td>
                  </tr>
                <?php endwhile;?>
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
                <?php 
                $sql = "SELECT * FROM avisos WHERE estado = 'aprovado'";

                try{
                  $stmt = $conn -> prepare( $sql );
                  $stmt -> execute();
                }catch( PDOException $e ) {
                  echo '<p>Hubo un error al consultar la base de datos</p>';
                }

                while( $res = $stmt -> fetch()):
              ?>
                <tr>
                  <td><?= $res['lugar']  ?></td>
                  <td><?= $res['titulo'] ?></td>
                  <td><?= $res['fecha'] ?></td>
                  <td><span class="badge bg-success"><?= $res['estado'] ?></span></td>
                  <td>
                    <form action="./dashboardCrud/editBlog.php" method="post">
                      <input type="text" name="id" value="<?= $res['id'] ?>" hidden>
                      <button type="submit" name="action" value="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                  </td>
                </tr>
              <?php endwhile; ?>
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
                <?php 
                $sql = "SELECT * FROM avisos WHERE estado = 'rechazado'";

                try{
                  $stmt = $conn -> prepare( $sql );
                  $stmt -> execute();
                }catch( PDOException $e ) {
                  echo '<p>Hubo un error al consultar la base de datos</p>';
                }

                while( $res = $stmt -> fetch()):
              ?>
                <tr>
                  <td><?= $res['lugar']  ?></td>
                  <td><?= $res['titulo'] ?></td>
                  <td><?= $res['fecha'] ?></td>
                  <td><span class="badge bg-danger"><?= $res['estado'] ?></span></td>
                  <td>
                    <form action="./dashboardCrud/editBlog.php" method="post">
                      <input type="text" name="id" value="<?= $res['id'] ?>" hidden>
                      <button type="submit" name="action" value="aprovar" class="btn btn-success btn-sm">Agregar</button>
                    </form>
                  </td>
                </tr>
                <?php endwhile; ?>
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
