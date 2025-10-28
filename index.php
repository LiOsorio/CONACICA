<?php 
    session_start();
    if(!empty($_SESSION['error'])){
        $error = $_SESSION['error'];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CONACICA</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-green sticky-top shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold text-light fs-1 logo-stroked" href="index.html">CONACICA</a>
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
              <li><a class="dropdown-item" href="directorio.html">Directorio Mayorista</a></li>
              <li><a class="dropdown-item" href="ruta/a/alianzas.html">Vacantes</a></li>
            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" data-bs-toggle="dropdown">Información</a>
            <ul class="dropdown-menu bg-green">
              <li><a class="dropdown-item text-dark" href="precios.html">Precios de Mercado</a></li>
              <li><a class="dropdown-item" href="ruta/a/blog.html">Blog / Noticias</a></li>
              <li><a class="dropdown-item" href="ruta/a/alianzas.html">Alianzas</a></li>
            </ul>
          </li>

          <li class="nav-item"><a class="nav-link active" href="#contacto">Contacto</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <header class="hero-section" id="inicio">
    <div class="d-flex align-items-center justify-content-between flex-wrap">
      <div class="hero-text-content">
        <h1 class="display-3 fw-bold animate__animated animate__fadeInDown">
          Confederación Nacional Integradora de
        </h1>
        <p class="lead my-4 animate__animated animate__fadeInUp fw-semibold">
          Centrales de Abasto, Transportistas, Productores Agrícolas y Mercados Públicos.
        </p>
      </div>

      <img src="logo.png" alt="Logo CONACICA" class="img-fluid logo-conacica">
    </div>
  </header>

  <!-- SECCIÓN: NOSOTROS + CARRUSEL -->
  <section id="quienes-somos" class="my-5">
    <div class="container">
      <div class="row align-items-center justify-content-center">

        <!-- Texto -->
        <div class="col-lg-5 mb-4 mb-lg-0">
          <h2 class="fw-bold text-conacica-green border-start border-conacica-green border-5 ps-3">Nosotros</h2>
          <p class="lead mt-3">
            Realizamos acciones en apoyo al fortalecimiento y profesionalización del sector Agroalimentario, 
            mediante la creación de vínculos con las Centrales de Abasto, Transportistas, Productores Agrícolas 
            y Mercados Públicos.
          </p>
        </div>

        <!-- Carrusel -->
        <div class="col-lg-7">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            </div>

            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="img/car1.jpg" class="d-block w-100 rounded-4" alt="Imagen 1">
              </div>
              <div class="carousel-item">
                <img src="img/car2.jpg" class="d-block w-100 rounded-4" alt="Imagen 2">
              </div>
              <div class="carousel-item">
                <img src="img/car3.jpg" class="d-block w-100 rounded-4" alt="Imagen 3">
              </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
              <span class="carousel-control-prev-icon"></span>
              <span class="visually-hidden">Anterior</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
              <span class="carousel-control-next-icon"></span>
              <span class="visually-hidden">Siguiente</span>
            </button>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- SECCIÓN: PILARES -->
  <section class="container my-5">
    <h3 class="fw-bold text-dark border-start border-conacica-green border-5 ps-3 mb-4">Nuestros Pilares</h3>
    <div class="row g-4">
      <div class="col-lg-4 col-md-6">
        <div class="card bg-light shadow-sm h-100 card-hover-effect">
          <div class="card-body">
            <h5 class="fw-bold text-conacica-green"><i class="fas fa-bullseye me-2"></i> Misión</h5>
            <p>Identificar y promover proyectos orientados a potencializar el desarrollo de las empresas y organizaciones del sector Abasto Agroalimentario.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card bg-light shadow-sm h-100 card-hover-effect">
          <div class="card-body">
            <h5 class="fw-bold text-conacica-green"><i class="fas fa-lightbulb me-2"></i> Visión</h5>
            <p>Revolucionar el desarrollo del sector Abasto Agroalimentario con innovación, transparencia y responsabilidad social.</p>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6">
        <div class="card bg-light shadow-sm h-100 card-hover-effect">
          <div class="card-body">
            <h5 class="fw-bold text-conacica-green"><i class="fas fa-flag-checkered me-2"></i> Objetivo</h5>
            <p>Integrar, apoyar, profesionalizar y representar al sector Abasto Agroalimentario de México.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECCIÓN: BENEFICIOS -->
  <section id="pilares" class="bg-light py-4">
    <div class="container text-center">
      <h3 class="fw-bold mb-1">Beneficios CONACICA</h3>
      <p class="text-muted mb-4">Trabajamos dando apoyo a nuestra comunidad.</p>
      <div class="row justify-content-center g-4">
        <div class="col-lg-4 col-md-6">
          <div class="card h-100 card-hover-effect">
            <div class="card-body p-4">
              <i class="fas fa-graduation-cap fa-3x text-success mb-3"></i>
              <h4 class="fw-bold">Profesionalización</h4>
              <p>Accede a cursos y talleres especializados.</p>
              <a href="ruta/a/cursos.html" class="btn btn-outline-success mt-3">Ver Cursos</a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="card h-100 card-hover-effect">
            <div class="card-body p-4">
              <i class="fas fa-handshake fa-3x text-warning mb-3"></i>
              <h4 class="fw-bold">Conexión Estratégica</h4>
              <p>Conéctate con mayoristas de todo el país.</p>
              <a href="ruta/a/directorio.html" class="btn btn-outline-warning mt-3">Directorio Mayorista</a>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="card h-100 card-hover-effect">
            <div class="card-body p-4">
              <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
              <h4 class="fw-bold">Información de Mercado</h4>
              <p>Consulta precios de la canasta básica en tiempo real.</p>
              <a href="ruta/a/precios.html" class="btn btn-outline-primary mt-3">Consultar Precios</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- SECCIÓN: ALIANZAS -->
<section id="alianzas" class="py-2">
    <div class="container text-center">
      <h3 class="fw-bold mb-1">Nuestras Alianzas Institucionales</h3>
      <p class="text-muted mb-4">Trabajamos con líderes académicos y empresariales para tu beneficio.</p>

      <!-- Carrusel múltiple de logos -->
      <div id="logoCarouselMulti" class="carousel slide" data-bs-ride="carousel" data-bs-interval="2000">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="row justify-content-center align-items-center" style="min-height:150px;">
              <div class="col-4"><img src="logo.png" class="img-fluid logo-multi-img"></div>
              <div class="col-4"><img src="logo.png" class="img-fluid logo-multi-img"></div>
              <div class="col-4"><img src="logo.png" class="img-fluid logo-multi-img"></div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="row justify-content-center align-items-center" style="min-height:150px;">
              <div class="col-4"><img src="company.jpg" class="img-fluid logo-multi-img"></div>
              <div class="col-4"><img src="company.jpg" class="img-fluid logo-multi-img"></div>
              <div class="col-4"><img src="company.jpg" class="img-fluid logo-multi-img"></div>
            </div>
          </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#logoCarouselMulti" data-bs-slide="prev">
          <span class="carousel-control-prev-icon"></span>
          <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#logoCarouselMulti" data-bs-slide="next">
          <span class="carousel-control-next-icon"></span>
          <span class="visually-hidden">Siguiente</span>
        </button>
      </div>
    </div>
</section>

  <!-- SECCIÓN: BLOG -->
<section class="container py-2">
  <div class="text-center mb-2">

    <h3 class="fw-bold mb-1">Blog de noticias</h3>
      <p class="text-muted mb-4">Explora nuestras publicaciones más recientes sobre el sector agroalimentario.</p>

  </div>

  <div id="carouselBlog" class="carousel slide">
    <div class="carousel-inner">

      <!-- Grupo 1 -->
      <div class="carousel-item active">
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card shadow border-0 h-100">
              <img src="img/n6.jpg" class="card-img-top" alt="Blog 1">
              <div class="card-body">
                <h5 class="card-title text-conacica-green">Tendencias del mercado agrícola</h5>
                <p class="card-text">Descubre las proyecciones más recientes para el comercio agrícola nacional.</p>
                              <a href="ruta/a/noticia1.html" class="btn btn-sm btn-link text-success">Leer más</a>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow border-0 h-100">
              <img src="img/n4.png" class="card-img-top" alt="Blog 2">
              <div class="card-body">
                <h5 class="card-title text-conacica-green">Innovación en el transporte</h5>
                <p class="card-text">Conoce las nuevas tecnologías que están revolucionando la logística alimentaria.</p>
                              <a href="ruta/a/noticia1.html" class="btn btn-sm btn-link text-success">Leer más</a>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow border-0 h-100">
              <img src="img/n5.jpg" class="card-img-top" alt="Blog 3">
              <div class="card-body">
                <h5 class="card-title text-conacica-green">Productores locales en crecimiento</h5>
                <p class="card-text">Historias inspiradoras de productores que fortalecen el campo mexicano.</p>
                              <a href="ruta/a/noticia1.html" class="btn btn-sm btn-link text-success">Leer más</a>

              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Grupo 2 -->
      <div class="carousel-item">
        <div class="row g-4">
          <div class="col-md-4">
            <div class="card shadow border-0 h-100">
              <img src="img/n1.jpg" class="card-img-top" alt="Blog 4">
              <div class="card-body">
                <h5 class="card-title text-conacica-green">Exportaciones sostenibles</h5>
                <p class="card-text">Cómo la sustentabilidad impulsa la competitividad en mercados globales.</p>
                              <a href="ruta/a/noticia1.html" class="btn btn-sm btn-link text-success">Leer más</a>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow border-0 h-100">
              <img src="img/n2.jpg" class="card-img-top" alt="Blog 5">
              <div class="card-body">
                <h5 class="card-title text-conacica-green">Nuevas regulaciones alimentarias</h5>
                <p class="card-text">Todo lo que debes saber sobre las normativas más recientes del sector.</p>
                              <a href="ruta/a/noticia1.html" class="btn btn-sm btn-link text-success">Leer más</a>

              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card shadow border-0 h-100">
              <img src="img/n3.jpg" class="card-img-top" alt="Blog 6">
              <div class="card-body">
                <h5 class="card-title text-conacica-green">Tecnología en la producción</h5>
                <p class="card-text">El papel del IoT y la automatización en la agricultura moderna.</p>
                              <a href="ruta/a/noticia1.html" class="btn btn-sm btn-link text-success">Leer más</a>

              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

    <!-- Controles -->
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselBlog" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselBlog" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Siguiente</span>
    </button>
  </div>
</section>


  <!-- MODAL LOGIN -->
  <div class="modal fade" id="modalLogin" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow login-modal">
        <form action="./validaciones/loginVal.php" method="POST" class="p-4 rounded">
          <div class="text-center mb-3">
            <img src="logo.png" width="150" height="150" class="img-fluid mb-2">
            <h5 class="fw-bold text-primary-custom">Iniciar sesión</h5>
          </div>

          <div class="mb-3">
            <label for="user" class="form-label fw-semibold">Correo electrónico</label>
            <input type="text" name="user" id="user" class="form-control form-control-lg input-custom" placeholder="Usuario" required>
          </div>

          <div class="mb-3">
            <label for="password" class="form-label fw-semibold">Contraseña</label>
            <input type="password" name="pwd" id="password" class="form-control form-control-lg input-custom" placeholder="••••••••" required>
          </div>

          <div class="d-flex justify-content-end gap-2">
            <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary-custom">Ingresar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

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

  <!-- SCRIPTS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
