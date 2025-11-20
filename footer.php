<!-- FOOTER -->
  <footer id="contacto" class="bg-green text-white pt-5 pb-3">
    <div class="container">
      <div class="row">
        <div class="col-md-3 mb-4">
          <h5 class="fw-bold text-dark">Contacto</h5>
          <ul class="list-unstyled small">
            <li><i class="fas fa-map-marker-alt me-2"></i> Dirección de Oficinas Centrales</li>
            <li><i class="fas fa-phone me-2"></i> +52 55 XXXX XXXX</li>
            <li><i class="fas fa-envelope me-2"></i> info@conacica.org</li>
          </ul>
        </div>

        <div class="col-md-3 mb-4">
          <h5 class="fw-bold text-dark">Enlaces Rápidos</h5>
          <ul class="list-unstyled small">
            <li><a href="ruta/a/quienes-somos.html" class="text-white text-decoration-none">Nuestra Visión</a></li>
            <li><a href="ruta/a/directorio.html" class="text-white text-decoration-none">Directorio Mayorista</a></li>
            <li><a href="ruta/a/precios.html" class="text-white text-decoration-none">Consulta de Precios</a></li>
            <li><a href="ruta/a/contacto.html" class="text-white text-decoration-none">Formulario de Contacto</a></li>
          </ul>
        </div>

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
