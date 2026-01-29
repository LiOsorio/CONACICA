<?php 
    session_start();

    include_once "./config/Connection.php";

    $conn = connection();
    $error ='';
    
    if(!empty($_SESSION['error'])){
        $error = $_SESSION['error'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <title>blog</title>

    <style>
      /* GRID NOTICIAS */
.grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

/* CARD */
.card {
  background: #fff;
  border-radius: 14px;
  overflow: hidden;
  box-shadow: 0 4px 10px rgba(0,0,0,.1);
}

.card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

.card-content {
  padding: 0rem;
}

.title {
  font-size: 1rem;
  font-weight: bold;
  color: #3b8c2a;
}

.date {
  font-size: .85rem;
  color: #666;
  margin-bottom: .5rem;
}

.text {
  font-size: .95rem;
  color: #333;
}

/* MODAL ESTÉTICA */
.modal-body {
  max-height: 70vh;
  overflow-y: auto;
}

#modalNoticiaImg {
  object-fit: contain;
  width: 100%;
}

#modalNoticiaTexto {
  line-height: 1;
  font-size: 1rem;
  white-space: pre-line;
}

      .justificar{
        text-align: justify;
      }
      .grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
      }
      .card {
        background: white;
        border-radius: 14px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: 0.2s;
      }
      .card:hover { transform: translateY(-4px); }
      .card img {
        width: 100%; height: 180px; object-fit: cover;
      }
      .card-content { padding: 1.2rem; }
      .title { font-size: 1.2rem; font-weight: bold; margin-bottom: .5rem; color:#3b8c2aff; }
      .date { font-size: .85rem; color: #666; margin-bottom: .8rem; }
      .text { font-size: .95rem; line-height: 1.4; color:#333; }
    </style>
</head>

<body>

  <?php include 'nav.php'; ?>

 <section>
  <div class="container">
    <div class="row align-items-center">
      
      <!-- Columna izquierda: IMAGEN -->
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="./img/imgBlog/imgPrincipalBlog.webp" class="img-fluid rounded" alt="Noticia completa">
      </div>

      <!-- Columna derecha: TEXTO -->
      <div class="col-md-6">
        <h2 class="fw-bold m-3 fs-1">Noticias y Avisos del Sector Agroalimentario</h2>
        <p class="fw-semibold m-3 fs-4">Infórmate sobre los acontecimientos, comunicados y colaboraciones de CONACICA y de la comunidad</p>
        <p class="lead mx-3 justificar fs-5">En CONACICA queremos dar voz a todas las piezas importantes del sector agroalimentario integrado por productores, transportistas, empacadores, industrializadores y comercializadores de México.          

</p>
    </div>
  </div>
</section>

<section class="container">
  
    <div class="card mt-0 p-3 shadow-sm border-0 rounded-4 bg-light">

      <div class="">
          <h3 class="fw-bold mb-2 fs-3">¿Tienes una noticia o aviso del sector?</h3>

        <div class="d-flex">
          <p class="mb-3 fs-5">
            Comparte información relevante y contribuye a mantener actualizada a toda la comunidad CONACICA.
          </p>

          <div class="text-center mx-3">
            <button 
              class="btn btn-conacica-cta rounded-pill px-4 py-2 fw-semibold"
              data-bs-toggle="modal"
              data-bs-target="#modalAviso">
              Enviar aviso
            </button>
          </div>

        </div>
      </div>


    </div>
</section>


    <div class="my-2">

    <div class="container my-4">
        <h3 class="fw-bold border-start text-start border-conacica-green border-5 ps-3 mb-4">Avisos de la Comunidad CONACICA</h3>

        <div class="row align-items-start">
      
      <!-- Columna izquierda: IMAGEN -->
      <div class="col-md-6 mb-4 mb-md-0">
        <img src="./img/imgBlog/imgAvisosComunitarios.webp" class="img-fluid rounded" alt="Noticia completa">
      </div>

      <!-- Columna derecha: TEXTO -->
      <div class="col-md-6">
        <h2 class="fw-bold m-3 fs-3">Contenido comunitario: aquí verás avisos enviados por usuarios del sector.</h2>
        <p class="lead text-semibold m-3 fs-5 justificar">
        Nuestro objetivo es mantenerte al día con lo que sucede en el ecosistema agroalimentario y ofrecer un espacio donde la comunidad pueda informarse y participar.          

    </div>
  </div>

        <div class="row g-4 my-4">
            <?php 
              $sql = "SELECT * FROM avisos WHERE estado = 'aprovado' ORDER BY fecha DESC LIMIT 3";
              try{
                $stmt = $conn -> prepare( $sql );
                $stmt -> execute();
              } catch( PDOException $e ) {
                echo '<p>Hubo un problema al cargar los datos</p>';
              }
              while( $res = $stmt -> fetch() ):
            ?>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                      <?php
                      $colores = [
                        'Bloqueo'     => '#DC3545',
                        'Agricultura' => '#28A745',
                        'Mercado'     => '#007BFF',
                        'Logística'   => '#FFC107',
                        'Clima'       => '#17A2B8',
                        'General'     => '#6F42C1'
                        ];
                        
                        $color = $colores[$res['tipo']] ?? '#6c757d';
                      ?>
                      

                        <span
                          class="badge mb-2"
                          style="background-color: <?php echo $color ?>; color: #fff;"
                        >
                          <?php echo htmlspecialchars($res['tipo']) ?>
                        </span>
                        <h5 class="card-title fw-bold"><?= $res['titulo'] ?></h5>
                        <p class="text-muted mb-1"><i class="bi bi-geo-alt"></i> <?= $res['lugar'] ?></p>
                        <p class="text-muted"><i class="bi bi-calendar"></i> <?= $res['fecha'] ?></p>
                        <p class="card-text"><?= $res['aviso'] ?></p>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>

    <section class="container my-4">
  <h1 class="fw-bold border-start border-conacica-green border-5 ps-3 mb-2">
    Noticias CONACICA
  </h1>
  <p class="lead mb-4">
    Conoce las noticias, avances y acciones más recientes de CONACICA.
  </p>

  <div class="grid">

    <!-- NOTICIA 1 -->
    <div class="card">
      <img src="./img/noti1.jpg" alt="Noticia 1">

      <div class="card-content">
        <div class="title">Primer Congreso "Homenaje a la Mujer Moderna"</div>
        <div class="date">Publicado el 12 de noviembre, 2025</div>
        <div class="text">
          El próximo 15 de noviembre se llevará a cabo el Primer Congreso...
        </div>

        <button class="btn btn-outline-success mt-3 leer-mas"
          data-title='Primer Congreso "Homenaje a la Mujer Moderna"'
          data-date="Publicado el 12 de noviembre, 2025"
          data-text='El día de hoy, CONACICA tuvo el honor de asistir al Primer Congreso “Homenaje a la Mujer Moderna”.

Este encuentro reunió a mujeres destacadas de diversos ámbitos para compartir experiencias, impulsar el diálogo y fortalecer acciones que promueven la igualdad.

Desde CONACICA reafirmamos nuestro compromiso con:
🔹 Espacios de respeto y equidad
🔹 Participación femenina
🔹 Colaboración interinstitucional
🔹 Desarrollo comunitario

💐 Un homenaje a su fuerza y liderazgo.'
          data-img="img/noticia1.jpg">
          Leer más
        </button>
      </div>
    </div>

    <!-- NOTICIA 2 -->
    <div class="card">
      <img src="img/tapitas.jpg" alt="Noticia 2">

      <div class="card-content">
        <div class="title">CONACICA, Embajador Oficial del Banco de Tapitas</div>
        <div class="date">Publicado el 2 de diciembre, 2025</div>
        <div class="text">
En CONACICA creemos firmemente que el desarrollo social también se construye desde la solidaridad.
        </div>

        <button class="btn btn-outline-success mt-3 leer-mas"
          data-title="CONACICA, Embajador Oficial del Banco de Tapitas"
          data-date="Publicado el 2 de diciembre, 2025"
          data-text='En CONACICA creemos firmemente que el desarrollo social también se construye desde la solidaridad.
          Por ello, nos enorgullece anunciar que CONACICA es Embajador Oficial del Banco de Tapitas, una iniciativa que transforma pequeñas acciones en grandes apoyos para quienes más lo necesitan.

          A través de la recolección y donación de tapitas plásticas, el Banco de Tapitas impulsa programas de apoyo a niñas, niños y familias, demostrando que cada contribución cuenta y que juntos podemos generar un impacto positivo y sostenible.

          Como embajadores, en CONACICA reafirmamos nuestro compromiso con las causas sociales, el bienestar comunitario y la construcción de una cultura de responsabilidad y empatía.

          Sumarte es sencillo. Donar es transformar.
          Invitamos a la comunidad a participar y ser parte de esta cadena de ayuda que cambia vidas.'
          data-img="img/tapitas.jpg">
          Leer más
        </button>
      </div>
    </div>

    <!-- NOTICIA 3 -->
<div class="card">
  <img src="img/noticia3.jpg" alt="Noticia 3">

  <div class="card-content">
    <div class="title">
 CONACICA presente en el Festival Abarrotero Ecatepec 2025 
    </div>

    <div class="date">
      Publicado el 3 de diciembre, 2025
    </div>

    <div class="text">
      CONACICA se une a la invitación de la Secretaría de Desarrollo Económico del Estado de México para participar en el Festival Abarrotero Ecatepec 2025
    </div>

    <button class="btn btn-outline-success mt-3 leer-mas"
      data-title=" CONACICA presente en el Festival Abarrotero Ecatepec 2025 "
      data-date="Publicado el 3 de noviembre, 2025"
      data-text='CONACICA se une a la invitación de la Secretaría de Desarrollo Económico del Estado de México para participar en el Festival Abarrotero Ecatepec 2025, un espacio diseñado para fortalecer, modernizar e impulsar el crecimiento del comercio local y del sector abarrotero

        📅 Jueves 27 de noviembre de 2025
        🕣 De 8:30 a 17:00 horas
        📍 Central de Abasto Ecatepec MX
        Regístrate en: https://sedecogem.edomex.gob.mx/eventos/com.eventos.ecatepec 
        Durante el evento podrás participar en talleres de capacitación, conocer nuevas opciones de proveeduría, y acceder a herramientas tecnológicas y soluciones financieras que impulsarán el desarrollo de tu negocio. 💼📲💡

Desde CONACICA, reconocemos y apoyamos todas las iniciativas que contribuyen al fortalecimiento del comercio, la innovación y el crecimiento económico en beneficio de los productores y comerciantes de México.' 
      data-img="img/noticia3.jpg">
      Leer más
    </button>
  </div>
</div>


  </div>
</section>


<div class="modal fade" id="modalNoticia" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-green">
        <h5 class="modal-title text-white" id="modalNoticiaTitulo"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <img id="modalNoticiaImg" class="img-fluid rounded mb-3" alt="">
        <p class="text-muted" id="modalNoticiaFecha"></p>
        <div id="modalNoticiaTexto"></div>
      </div>

    </div>
  </div>
</div>

 <!-- MODAL -->
<div class="modal fade" id="modalAviso" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header bg-green">
        <h5 class="text-white">Enviar aviso del sector</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Aviso de validación -->
            <div class="col-12">
              <div class="alert alert-warning small mb-0">
                <i class="bi bi-exclamation-triangle-fill"></i>
                La información enviada será <strong>revisada y validada</strong> antes de publicarse.
                Los avisos falsos o malintencionados no serán publicados.
              </div>
            </div>

      <div class="modal-body">
        <form action="./dashboardCrud/blogPub.php" method='post' class="shadow-sm p-4 bg-white rounded">
          <div class="row g-3">
            <!-- Tipo de aviso -->
            <div class="col-md-6">
              <label class="form-label">Tipo de aviso</label>
              <select class="form-select" name="tipo" required>
                <option value="" selected disabled>Selecciona una categoría</option>
                <option value="Bloqueo" data-color="#DC3545">Bloqueo</option>
                <option value="Agricultura" data-color="#28A745">Agricultura</option>
                <option value="Mercado" data-color="#007BFF">Mercado</option>
                <option value="Logística" data-color="#FFC107">Logística</option>
                <option value="Clima" data-color="#17A2B8">Clima</option>
                <option value="General" data-color="#6F42C1">General</option>
              </select>
            </div>

            <!-- Título -->
            <div class="col-md-6">
              <label class="form-label">Título del aviso</label>
              <input type="text" class="form-control" name="titulo" required>
            </div>

            <!-- Lugar -->
            <div class="col-md-6">
              <label class="form-label">Lugar</label>
              <input type="text" class="form-control" name="lugar" placeholder="Ej. Chiapas, Veracruz, Central de Abasto..." required>
            </div>

            <!-- Fecha -->
            <div class="col-md-6">
              <label class="form-label">Fecha del aviso</label>
              <input type="date" class="form-control" name="fecha" required>
            </div>

            <!-- Descripción -->
            <div class="col-12">
              <label class="form-label">Descripción del aviso</label>
              <textarea class="form-control" rows="4" name="descripcion" required
                placeholder="Describe el aviso de forma clara y veraz"></textarea>
            </div>

            <!-- Imagen -->
            <!-- <div class="col-12">
              <label class="form-label">Imagen (opcional)</label>
              <input type="file" class="form-control" name="imagen" accept="image/*">
            </div> -->

            <!-- Botón -->
            <div class="col-12 text-end mt-3">
              <button type="submit" name="action" value="avisoPub" class="btn btn-outline-conacica-green rounded-pill px-4">
                Enviar aviso
              </button>
            </div>

          </div>

        </form>
      </div>

    </div>
  </div>
</div>


<?php include 'footer.php'; ?>
<!-- SCRIPTS: asegúrate de tener bootstrap.bundle (tiene Modal) cargado antes de este script -->
<script>
document.addEventListener('DOMContentLoaded', function () {

  document.querySelectorAll('.leer-mas').forEach(btn => {
    btn.addEventListener('click', function () {

      const titulo = this.dataset.title || '';
      const fecha = this.dataset.date || '';
      const texto = this.dataset.text || '';
      const img = this.dataset.img || '';

      document.getElementById('modalNoticiaTitulo').textContent = titulo;
      document.getElementById('modalNoticiaFecha').textContent = fecha;
      document.getElementById('modalNoticiaImg').src = img;

      // Convertir saltos de línea en párrafos
      document.getElementById('modalNoticiaTexto').innerHTML =
        texto.replace(/\n/g, '<br><br>');

      const modal = new bootstrap.Modal(
        document.getElementById('modalNoticia')
      );
      modal.show();
    });
  });

});
</script>

<script src="./src/js/bootstrap.bundle.js"></script>

</body>
</html>
