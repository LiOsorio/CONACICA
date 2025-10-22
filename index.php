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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-green sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-light fs-1 logo-stroked" href="index.html">CONACICA</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto fw-semibold">
                <li class="nav-item"><a class="nav-link active" href="#quienes-somos">Quiénes Somos</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Servicios/Apoyo</a>
                    <ul class="dropdown-menu bg-green">
                        <li><a class="dropdown-item" href="cursos.php">Cursos y Capacitación</a></li>
                        <li><a class="dropdown-item" href="directorio.html">Directorio Mayorista</a></li>
                        <li><a class="dropdown-item" href="ruta/a/alianzas.html">Vacantes</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Información</a>
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


   <header class="hero-section" id="inicio">

    <div class="d-flex">
        
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

    <section id="quienes-somos" class="py-5">
    <div class="container">
        
        <div class="row align-items-center mb-0">
            
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="fw-bold text-conacica-green border-start border-conacica-green border-5 ps-3">Nosotros</h2>
                <p class="lead mt-3">Realizamos acciones en apoyo al fortalecimiento y profesionalización del sector Agroalimentario, mediante la creación de vínculos con las centrales de Abasto, Transportistas, Productores Agrícolas y Mercados Públicos.</p>
            </div>

            <div class="col-md-6 text-center">
                <img src="central.jpg" alt="Imagen Central de Abasto" class="img-fluid p-4" style="max-height: 350px; object-fit: cover;">
            </div>
            
        </div>
        
            <h3 class="fw-bold text-dark border-start border-conacica-green border-5 ps-3 mb-4">Nuestros Pilares</h3>
        
        <div class="row d-flex align-items-stretch">
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card bg-light shadow-sm h-100"> 
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-conacica-green"><i class="fas fa-bullseye me-2"></i> Misión</h5>
                        <p class="card-text">Identificar y promover proyectos orientados a potencializar el desarrollo de las empresas y organizaciones del sector Abasto Agroalimentario.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card bg-light shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-conacica-green"><i class="fas fa-bullseye me-2"></i> Visión</h5>
                        <p class="card-text">Revolucionar el desarrollo del sector Abasto Agroalimentario de México que le permita responder de forma genuina, innovadora y transparente las exigencias del mercado global, siempre con un compromiso de responsabilidad social.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card bg-light shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-conacica-green"><i class="fas fa-bullseye me-2"></i> Objetivo</h5>
                        <p class="card-text">Somos una confederación 100% mexicana que tiene como objetivo principal el integrar, apoyar, profesionalizar y representar al sector Abasto Agroalimentario de México.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

    <section id="pilares" class="bg-light">
        <div class="container text-center">
            <h3 class="mb-5 fw-bold">Beneficios para tí</h3>
            <div class="row justify-content-center">
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow border-0">
                        <div class="card-body p-4">
                            <i class="fas fa-graduation-cap fa-3x text-success mb-3"></i>
                            <h4 class="card-title fw-bold">Profesionalización</h4>
                            <p class="card-text">Accede a cursos y talleres especializados para elevar la calidad y eficiencia de tus operaciones.</p>
                            <a href="ruta/a/cursos.html" class="btn btn-outline-success mt-3">Ver Cursos</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow border-0">
                        <div class="card-body p-4">
                            <i class="fas fa-handshake fa-3x text-warning mb-3"></i>
                            <h4 class="card-title fw-bold">Conexión Estratégica</h4>
                            <p class="card-text">Conéctate directamente con mayoristas confiables en Centrales de Abasto de todo el país.</p>
                            <a href="ruta/a/directorio.html" class="btn btn-outline-warning mt-3">Directorio Mayorista</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100 shadow border-0">
                        <div class="card-body p-4">
                            <i class="fas fa-chart-line fa-3x text-primary mb-3"></i>
                            <h4 class="card-title fw-bold">Información de Mercado</h4>
                            <p class="card-text">Consulta los precios de la canasta básica y toma decisiones comerciales basadas en datos reales.</p>
                            <a href="ruta/a/precios.html" class="btn btn-outline-primary mt-3">Consultar Precios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="alianzas" class="py-5">
        <div class="container text-center">
            <h3 class="mb-0">Nuestras Alianzas Institucionales</h3>
            <p class="text-muted">Trabajamos con líderes académicos y empresariales para tu beneficio.</p>
            <div class="row align-items-center justify-content-center mt-4">
                <div class="col-6 col-md-2 p-3"><div class="text-secondary opacity-50 fw-bold fs-4"><img src="company.jpg" alt="" width="200px"></div></div>
                <div class="col-6 col-md-2 p-3"><div class="text-secondary opacity-50 fw-bold fs-4"><img src="company.jpg" alt="" width="200px"></div></div>
                <div class="col-6 col-md-2 p-3"><div class="text-secondary opacity-50 fw-bold fs-4"><img src="company.jpg" alt="" width="200px"></div></div>
                <div class="col-6 col-md-2 p-3"><div class="text-secondary opacity-50 fw-bold fs-4"><img src="company.jpg" alt="" width="200px"></div></div>
                <div class="col-6 col-md-2 p-3"><div class="text-secondary opacity-50 fw-bold fs-4"><img src="company.jpg" alt="" width="200px"></div></div>
            </div>
        </div>
    </section>

    <section id="blog" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Actualidad del Sector</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="n1.jpg" class="card-img-top" alt="Noticia 1">
                        <div class="card-body">
                            <h5 class="card-title">El campo mexicano: corazón y fuerza de nuestra nación🌽</h5>
                            <p class="card-text text-muted small">24 de Abril, 2025</p>
                            <p class="card-text">En CONACICA celebramos a quienes trabajan la tierra con dedicación y pasión, impulsando a ...</p>
                            <a href="ruta/a/noticia1.html" class="btn btn-sm btn-link text-success">Leer más <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="n2.jpg" class="card-img-top" alt="Noticia 2">
                        <div class="card-body">
                            <h5 class="card-title">Se acerca el Día de Muertos y con él, el aroma del pan de muerto💀</h5>
                            <p class="card-text text-muted small">18 de Octubre, 2025</p>
                            <p class="card-text">En México, el pan de muerto es mucho más que un postre: es un símbolo de amor y recuerdo....</p>
                            <a href="ruta/a/noticia2.html" class="btn btn-sm btn-link text-success">Leer más <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="n3.jpg" class="card-img-top" alt="Noticia 3">
                        <div class="card-body">
                            <h5 class="card-title">La tierra es raíz, tradición y orgullo mexicano 🌾</h5>
                            <p class="card-text text-muted small">10 de septiembre, 2025</p>
                            <p class="card-text">Una mirada a los factores que están impactando el mercado actual...</p>
                            <a href="ruta/a/noticia3.html" class="btn btn-sm btn-link text-success">Leer más <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4">
                <a href="ruta/a/blog.html" class="btn btn-outline-dark">Ver el Blog Completo</a>
            </div>
        </div>
    </section>
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
                        <button type="button" class="btn btn-secondary-custom" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary-custom">Ingresar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


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
                    <?php if( empty( $_SESSION[ 'userId' ] ) ){ ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalLogin">Ingresar</button>
                    <?php }else{ ?>
                        <a href="./login/logout.php">Salir</a>
                    <?php } ?>
                </div>
                <div class="col-md-3 mb-4 text-md-end">
                    <h5 class="fw-bold text-dark">Síguenos</h5>
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-2x"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-x fa-2x"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in fa-2x"></i></a>
                    <p class="mt-3 small">&copy; 2025 CONACICA Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>