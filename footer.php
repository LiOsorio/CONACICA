<!-- FOOTER -->
  
<div class="modal fade" id="modalLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLoginLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow login-modal">
            <form action="./validaciones/loginVal.php" method="POST" class="p-4 rounded">
                <div class="text-center mb-3">
                    <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                    <h5 class="fw-bold text-primary-custom">Iniciar sesión</h5>
                </div>
                <div class="mb-3">
                    <label for="user" class="form-label fw-semibold">Correo electrónico</label>
                    <input type="text" name="user" class="form-control form-control-lg input-custom" id="user" placeholder="Usuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-semibold">Contraseña</label>
                    <input type="password" name="pwd" class="form-control form-control-lg input-custom" id="password" placeholder="••••••••" required>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button type="button" class="btn btn-primary-custom" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-secondary-custom">Ingresar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<footer id="contacto" class="bg-green text-white pt-5 pb-3">
    <div class="container">
      <div class="row justify-content-between">
        <div class="col-md-3 mb-4">
          <h5 class="fw-bold text-dark">Contacto</h5>
          <ul class="list-unstyled small">
            <li><i class="fas fa-map-marker-alt me-2"></i> Dirección de Oficinas Centrales</li>
            <li><i class="fas fa-phone me-2"></i> +52 55 XXXX XXXX</li>
            <li><i class="fas fa-envelope me-2"></i> info@conacica.org</li>
          </ul>
        </div>

        <!-- <div class="col-md-3 mb-4">
          <h5 class="fw-bold text-dark">Enlaces Rápidos</h5>
          <ul class="list-unstyled small">
            <li><a href="ruta/a/quienes-somos.html" class="text-white text-decoration-none">Nuestra Visión</a></li>
            <li><a href="ruta/a/directorio.html" class="text-white text-decoration-none">Directorio Mayorista</a></li>
            <li><a href="ruta/a/precios.html" class="text-white text-decoration-none">Consulta de Precios</a></li>
            <li><a href="ruta/a/contacto.html" class="text-white text-decoration-none">Formulario de Contacto</a></li>
          </ul>
        </div> -->

        <div class="col-md-2 mb-4">
          <h5>Administrador</h5>
          <?php if(empty($_SESSION['userId'])){ ?>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLogin">Ingresar</button>
          <?php } else { ?>
            <a href="./login/logout.php">Salir</a>
          <?php } ?>
        </div>

        <div class="col-md-3 mb-4 text-md-end">
          <h5 class="fw-bold text-dark">Síguenos</h5>
          <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-2x"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-x fa-2x"></i></a>
          <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in fa-2x"></i></a>
          <p class="mt-3 small">&copy; 2025 CONACICA. Todos los derechos reservados.</p>
        </div>
      </div>
    </div>
  </footer>
