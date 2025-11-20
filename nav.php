<!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-green sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-light fs-1 logo-stroked" href="index.php">CONACICA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto fw-semibold">
          <li class="nav-item"><a class="nav-link active" href="#quienes-somos">Quiénes Somos</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown">Servicios/Apoyo</a>
            <ul class="dropdown-menu bg-green">
              <li><a class="dropdown-item" href="cursos.php">Cursos y Capacitación</a></li>
              <li><a class="dropdown-item" href="directorio.php">Directorio Mayorista</a></li>
              <li><a class="dropdown-item" href="ruta/a/alianzas.html">Vacantes</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown">Información</a>
            <ul class="dropdown-menu bg-green">
              <li><a class="dropdown-item text-dark" href="precios.php">Precios de Mercado</a></li>
              <li><a class="dropdown-item" href="blog.php">Blog / Noticias</a></li>
              <li><a class="dropdown-item" href="ruta/a/alianzas.html">Alianzas</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#" data-bs-toggle="modal" data-bs-target="#modalContacto">Contáctanos</a>
          </li>

        </ul>
      </div>
    </div>
  </nav>


  <!-- MODAL DE CONTACTO -->
<div class="modal fade" id="modalContacto" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header bg-green text-white">
        <h5 class="modal-title">Contáctanos</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Body -->
      <div class="modal-body">
        <form action="procesar_contacto.php" method="POST">

          <div class="mb-3">
            <label class="form-label">Nombre completo</label>
            <input type="text" class="form-control" name="nombre" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="email" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Asunto</label>
            <input type="text" class="form-control" name="asunto" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Mensaje</label>
            <textarea class="form-control" name="mensaje" rows="4" required></textarea>
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-success">Enviar mensaje</button>
          </div>

        </form>
      </div>

    </div>
  </div>
</div>
