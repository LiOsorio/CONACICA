<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>participaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <link rel="stylesheet" href="style.css">

</head>
<body>

  <?php include 'nav.php'; ?>

<header class="hero-section py-5" id="inicio">
    <div class="container py-5">
        <div class="row align-items-center">
            
            <div class="col-12 col-md-6 text-center">
                <img src="img/logo-6.jpg" class="img-fluid d-block mx-auto logo-conacica logo-hero-responsive" alt="Logo CONACICA Circular">
            </div>

            <div class="col-md-6 text-md-end text-center mt-4 mt-md-0">
                
                <h1 class="display-4 fw-bold mb-3">
                    Nuestras Participaciones
                </h1>
                
                <p class="lead mb-4">
                    Conoce los eventos, colaboraciones y acciones en las que hemos presentado el sector agroalimentario de México.
                </p>
                
            </div>

        </div>
    </div>
  </header>


<section>
  <div class="container my-5">
    <div class="mb-4">
      <h3 class="fw-bold border-start text-start border-conacica-green border-5  my-5 ps-3 mb-1 fs-2">Conoce nuestras participaciones</h3>
    </div>

  
    <div id="carousel-EVENTOS" class="carousel slide mx-4">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carousel-EVENTOS" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carousel-EVENTOS" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carousel-EVENTOS" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">

        <div class="carousel-item active">
          <img src="img/eventos-2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block text-center px-5 mx-5 text-light">
            <h5 class="fs-4">Ceremonia de entrega del distintivo HECHO EN MÉXICO para el Marketplace KEVALLEVAR.COM</h5>
            <p>Participación de CONACICA en la Ceremonia de entrega del distintivo HECHO EN MÉXICO para el Marketplace KEVALLEVAR.COM y la Central de Abasto Ecatepec, como orgullosos portadores del sello que distingue la calidad, identidad y compromiso con lo mexicano, de manos de la *Lic. Barbara Botello, Directora de la marca.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="img/eventos-1.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block text-center px-5 mx-5">
            <h5 class="fs-3">CURSO PMI</h5>
            <p>El curso de PMI de metodologías ágiles aplicadas a la gestión de proyectos, donde se realizaron dinámicas para reforzar la teoría que se presentó por La Lic. Guadalupe que fue un ejercicio para destacar las competencias y responder de forma rápida y efectiva a la realización de proyectos.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="img/eventos-3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block text-center px-5 mx-5">
            <h5 class="fs-3">Jafza</h5>
            <p class="mb-0">Visita a la embajada de los Emiratos Árabes Unidos, con la finalidad de </p>
            <p>participar en el comercio internacional con medio oriente y crear oportunidades de negocios.</p>
          </div>
        </div>
      </div>

      <button class="carousel-control-prev" type="button" data-bs-target="#carousel-EVENTOS" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>

      <button class="carousel-control-next" type="button" data-bs-target="#carousel-EVENTOS" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
</div>
</section>

<section id="galeria-grid" class="py-2">
  <div class="container">

    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-4 col-sm-6">
        <div class="gallery-card position-relative overflow-hidden rounded shadow-sm">
          <img src="img/parti1.jpg" class="img-fluid w-100" alt="Evento 2025">
          <div class="gallery-overlay d-flex flex-column justify-content-center align-items-center text-white text-center">
            <h5 class="fw-bold mb-1">2025</h5>
            <p class="mb-0">Entrega del distintivo HECHO EN MÉXICO</p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-4 col-sm-6">
        <div class="gallery-card position-relative overflow-hidden rounded shadow-sm">
          <img src="img/parti2.jpg" class="img-fluid w-100" alt="Evento 2024">
          <div class="gallery-overlay d-flex flex-column justify-content-center align-items-center text-white text-center">
            <h5 class="fw-bold mb-1">2024</h5>
            <p class="mb-0">Concurso Estatal de Proyectos</p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-4 col-sm-6">
        <div class="gallery-card position-relative overflow-hidden rounded shadow-sm">
          <img src="img/parti3.jpg" class="img-fluid w-100" alt="Evento 2023">
          <div class="gallery-overlay d-flex flex-column justify-content-center align-items-center text-white text-center">
            <h5 class="fw-bold mb-1">2023</h5>
            <p class="mb-0">CONACICA Presente en el evento "Expande tu empresa a Dubai"</p>
        </div>
      </div>
      </div>
      </div>

</section>


<section class="testimonios py-5">
  <div class="container">
    <h3 class="fw-bold mb-4 border-start border-5 border-conacica-green ps-3 text-start">Testimonios y menciones</h3>
    <div class="row mt-4">
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm p-4 h-100">
          <p class="fst-italic">“Agradecemos a CONACICA por su participación en el Foro de Logística Agroalimentaria.”</p>
          <p class="fw-bold mb-0">— Secretaría de Economía, 2025</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm p-4 h-100">
          <p class="fst-italic">“Su apoyo ha sido fundamental para el desarrollo de productores locales.”</p>
          <p class="fw-bold mb-0">— Gobierno de Ecatepec</p>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card shadow-sm p-4 h-100">
          <p class="fst-italic">“Una institución comprometida con el desarrollo agroalimentario de México.”</p>
          <p class="fw-bold mb-0">— Revista Agrovisión</p>
        </div>
      </div>
    </div>
  </div>
</section>




  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>