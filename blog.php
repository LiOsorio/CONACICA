<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="style.css">


    <title>blog</title>
</head>
<body>

    <?php include 'nav.php'; ?>

  
  <!-- HERO (ok solo checar responsive) -->
  <header class="hero-section py-5" id="inicio">
    <div class="container py-5">
        <div class="row align-items-center">
            
            <div class="col-12 col-md-6 text-center">
                <img src="img/logo-6.jpg" class="img-fluid d-block mx-auto logo-conacica logo-hero-responsive" alt="Logo CONACICA Circular">
            </div>

            <div class="col-md-6 text-md-end text-center mt-4 mt-md-0">
                
                <h1 class="display-4 fw-bold mb-3">
                    Noticias y Avisos del Sector Agroalimentario
                </h1>
                
                <p class="lead mb-4">
                    Infórmate sobre los acontecimientos, comunicados y colaboraciones de CONACICA y la comunidad del campo mexicano.
                </p>
                
            </div>

        </div>
    </div>
  </header>

<section>


<section class="noticias-destacadas py-2 bg-light text-dark">
  <div class="container">
    <div id="carousel-destacadas" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active text-center">
        AVISO urgente: cierre temporal de la Central de Abasto Toluca por mantenimiento.
        </div>
        <div class="carousel-item text-center">
         Nueva alianza CONACICA – Secretaría de Economía para fortalecer productores locales.
        </div>
        <div class="carousel-item text-center">
          Se inaugura el Foro Nacional Agroalimentario 2025 con participación de CONACICA.
        </div>
      </div>
    </div>
  </div>
</section>

<div class="row">

<div class="col-md-9 px-5">
<section class="detalle-noticia py-5">
  <div class="container">
  <img src="img/eventos-2.jpg" class="img-detalle-noticia mb-4" alt="Noticia completa">
  <h2 class="fw-bold">Foro Nacional Agroalimentario 2025</h2>
    <p class="text-muted">Publicado el 15 de octubre, 2025</p>
    <p class="lead">CONACICA participó en el foro nacional promoviendo la colaboración entre productores...</p>
  </div>
</section>

<div class="container my-2">
       <h3 class="fw-bold border-start text-start border-conacica-green border-5 ps-3 mb-4">Avisos de la Comunidad CONACICA</h3>

  <div class="row g-4">

    <!-- Card 1 -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <span class="badge bg-warning text-dark mb-2">Bloqueo</span>
          <h5 class="card-title fw-bold">Bloqueo en carretera 190</h5>
          <p class="text-muted mb-1"><i class="bi bi-geo-alt"></i> Chiapas</p>
          <p class="text-muted"><i class="bi bi-calendar"></i> 18 Nov 2025</p>
          <p class="card-text">
            Transportistas bloquean la carretera. Evitar zona de 9 AM a 4 PM.
          </p>
        </div>
      </div>
    </div>

    <!-- Card 2 -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <span class="badge bg-primary mb-2">Agricultura</span>
          <h5 class="card-title fw-bold">Manifestación agrícola</h5>
          <p class="text-muted mb-1"><i class="bi bi-geo-alt"></i> Veracruz</p>
          <p class="text-muted"><i class="bi bi-calendar"></i> 14 Nov 2025</p>
          <p class="card-text">
            Productores se reunirán en el Zócalo para exigir apoyo federal.
          </p>
        </div>
      </div>
    </div>

    <!-- Card 3 -->
    <div class="col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <span class="badge bg-success mb-2">Mercado</span>
          <h5 class="card-title fw-bold">Variación de precios</h5>
          <p class="text-muted mb-1"><i class="bi bi-geo-alt"></i> Jalisco</p>
          <p class="text-muted"><i class="bi bi-calendar"></i> 12 Nov 2025</p>
          <p class="card-text">
            Aumento del 8% en chile serrano por baja oferta en centros de abasto.
          </p>
        </div>
      </div>
    </div>

  </div>
</div>



<section class="blog-listado py-2">
         <h3 class="fw-bold border-start text-start border-conacica-green border-5 ps-3 mb-4">BLOG CONACICA</h3>

  <div class="container">
     <div class="g-4">
        <div class="blog-item" data-category="conacica">
          <div class="card h-100 shadow-sm">
            <img src="img/n1.jpg" class="card-img-top" alt="Noticia">
            <div class="card-body d-flex flex-column h-100"> 
              <h5 class="card-title fw-bold">Foro Nacional Agroalimentario 2025</h5>
              <p class="text-muted mb-2">15 de octubre, 2025</p>
              <p class="card-text flex-grow-1">CONACICA participó en el foro nacional para promover las cadenas de valor agroalimentarias sostenibles...</p>
              <a href="detalle-noticia.html" class="btn btn-cta-hero1 btn-sm rounded-pill mt-auto">Leer más</a>
            </div>
          </div>
        </div>

      <div class="blog-item" data-category="sector">
        <div class="card h-100 shadow-sm">
        <img src="img/n2.jpg" class="card-img-top" alt="Aviso">
          <div class="card-body d-flex flex-column h-100">
            <h5 class="card-title fw-bold">Bloqueo en carretera México-Puebla</h5>
            <p class="text-muted mb-2">10 de octubre, 2025</p>
            <p class="card-text flex-grow-1">Transportistas anuncian bloqueo temporal debido a conflictos de carga agroindustrial...</p>
            <a href="#" class="btn btn-cta-hero1 btn-sm rounded-pill mt-auto">Leer más</a>
          </div>
        </div>
      </div>

      <div class="blog-item" data-category="conacica">
          <div class="card h-100 shadow-sm">
            <img src="img/n1.jpg" class="card-img-top" alt="Noticia">
            <div class="card-body d-flex flex-column h-100"> 
              <h5 class="card-title fw-bold">Foro Nacional Agroalimentario 2025</h5>
              <p class="text-muted mb-2">15 de octubre, 2025</p>
              <p class="card-text flex-grow-1">CONACICA participó en el foro nacional para promover las cadenas de valor agroalimentarias sostenibles...</p>
              <a href="detalle-noticia.html" class="btn btn-cta-hero1 btn-sm rounded-pill mt-auto">Leer más</a>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>

<div class="modal fade" id="modalAviso" tabindex="-1" aria-labelledby="modalAvisoLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title fw-bold" id="modalAvisoLabel">Enviar aviso del sector</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <form class="shadow-sm p-4 bg-white rounded">
          <div class="row g-3">

            <div class="col-md-6">
              <label class="form-label">Nombre / Organización</label>
              <input type="text" class="form-control" placeholder="Ej. Asociación de Productores de Jalisco">
            </div>

            <div class="col-md-6">
              <label class="form-label">Título del aviso</label>
              <input type="text" class="form-control" placeholder="Ej. Cierre temporal de carretera 57">
            </div>

            <div class="col-12">
              <label class="form-label">Descripción</label>
              <textarea class="form-control" rows="3" placeholder="Describe brevemente el aviso..."></textarea>
            </div>

            <div class="col-12">
              <label class="form-label">Imagen o documento (opcional)</label>
              <input type="file" class="form-control">
            </div>

            <div class="col-12 text-end">
              <button type="submit" class="btn btn-outline-conacica-green rounded-pill px-4">Enviar aviso</button>
            </div>

          </div>
        </form>

      </div>

    </div>
  </div>
</div>

</div>




<div class="col-md-3 p-0">

<aside class="filtro-aside">
  <section class="blog-filtro">
    <div class="btn-group-vertical" role="group" aria-label="Filtro de categorías">
      <button type="button" class="btn btn-outline-conacica-green text-dark" data-filter="all">Todos</button>
      <button type="button" class="btn btn-outline-conacica-green text-dark" data-filter="conacica">Blog CONACICA</button>
      <button type="button" class="btn btn-outline-conacica-green text-dark" data-filter="sector">Avisos del sector</button>
      <button type="button" class="btn btn-outline-conacica-green text-dark" data-filter="oficiales">Comunicados oficiales</button>
      <button class="btn btn-outline-conacica-green text-dark" data-bs-toggle="modal" data-bs-target="#modalAviso"> Enviar un aviso del sector</button>

    </div>


  </section>
</aside>
</div>

</div>


  <?php include 'footer.php'; ?>

</body>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>