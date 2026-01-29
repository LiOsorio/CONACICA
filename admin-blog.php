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

<body class="body-admin">

<?php include 'admin-menu.php'; ?>

<div class="m-5">
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
        <p class="lead mx-3 justificar fs-5">En CONACICA queremos dar voz a todas las piezas importantes del sector agroalimentario integrado por productores, transportistas, empacadores, industrializadores y comercializadores de México.          </p>
    </div>

    <!-- SECCIÓN HERO -->
  <div class="card p-4 mb-5">
    <div class="d-flex justify-content-between align-items-center">
      <h4 class="fw-bold mb-0">Imagen principal del blog</h4>
      <button class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modalBlog">
        <i class="bi bi-image"></i> Cambiar imagen
      </button>
    </div>
  </div>
  </div>
</section>
<div class="modal fade" id="modalBlog" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalBlog" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-centered">
          <div class="modal-content border-0 shadow login-modal m-3">
              <form action="./dashboardCrud/editBlog.php" method="POST" enctype="multipart/form-data">
                <input type="text" value="editarImgPrincipal" name="action" hidden >
                <div class="text-center mb-3">
                    <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                    <h5 class="fw-bold text-primary-custom" style="font-size: 35px;">Modificar Imágen de Noticias </h5>
                    <p class="fw-bold text-center " style="color: #ec4141ff;">Una vez aceptados los cambios, la imágen anterior se eliminará.</p>
                </div>
                <div class="d-flex flex-column flex-md-row col-12 justify-content-center gap-2">
                  <div class="col-6 d-flex justify-content-center flex-column mx-auto">
                    <p class="fw-bold text-center" style="font-size: 20px;">Imágen actual</p>
                    <img style="width: auto; height: fit; object-fit:contain; object-position: center center; display: block;" src="./img/imgBlog/imgPrincipalBlog.webp" alt="Imagen blog">
                  </div>
                  <div class="col-4 d-flex flex-column justify-content-center mx-auto">
                    <label for="imgPrincipalBlog" class="fw-bold " style="font-size: 20px;">Imagen a mostrar:</label>
                    <input type="file" id="imgPrincipalBlog" name="imgPrincipalBlog" accept="image/jpeg, image/png, image/webp" placeholder="Ingresa la imagen a mostrar">
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-2 m-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" >Cambiar Imágen</button>
                </div>
              </form>
          </div>
      </div>
  </div>




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
    <!-- SECCIÓN AVISOS COMUNIDAD -->
        <div class="card p-4 mb-5">
          <div class="d-flex justify-content-between align-items-center">
            <h4 class="fw-bold mb-0">Imagen avisos comunitarios</h4>
            <button class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modalImgAvisos">
              <i class="bi bi-image"></i> Cambiar imagen
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modalImgAvisos" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalParticipaciones" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-centered">
          <div class="modal-content border-0 shadow login-modal m-3">
              <form action="./dashboardCrud/editBlog.php" method="POST" enctype="multipart/form-data">
                <input type="text" value="ImgAvisosCambiar" name="action" hidden >
                <div class="text-center mb-3">
                    <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                    <h5 class="fw-bold text-primary-custom" style="font-size: 35px;">Modificar Imágen de Avisos Comunitarios</h5>
                    <p class="fw-bold text-center " style="color: #ec4141ff;">Una vez aceptados los cambios, la imágen anterior se eliminará.</p>
                </div>
                <div class="d-flex flex-column flex-md-row col-12 justify-content-center gap-2">
                  <div class="col-6 d-flex justify-content-center flex-column mx-auto">
                    <p class="fw-bold text-center" style="font-size: 20px;">Imágen actual</p>
                    <img style="width: auto; height: fit; object-fit:contain; object-position: center center; display: block;" src="./img/imgBlog/imgAvisosComunitarios.webp" alt="Imagen avisos">
                  </div>
                  <div class="col-4 d-flex flex-column justify-content-center mx-auto">
                    <label for="imgAvisos" class="fw-bold " style="font-size: 20px;">Imagen a mostrar:</label>
                    <input type="file" id="imgAvisos" name="imgAvisos" accept="image/jpeg, image/png, image/webp" placeholder="Ingresa la imagen a mostrar">
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-2 m-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" >Cambiar Imágen</button>
                </div>
              </form>
          </div>
      </div>
  </div>

    <section class="container my-4">

    <div class="d-flex">
  <h1 class="fw-bold border-start border-conacica-green border-5 ps-3 mb-2">
    Noticias CONACICA
  </h1>

<div class="admin-toolbar mx-5">
    <button class="btn btn-success" id="btnNuevaNoticia">
      <i class="bi bi-plus-circle"></i> Nueva noticia
    </button>
  </div>

  </div>
  <p class="lead mb-4">
    Conoce las noticias, avances y acciones más recientes de CONACICA.
  </p>

  <!-- NOTICIAS CONACICA -->
  

  <div class="grid">

    <!-- NOTICIA 1 -->
    <div class="card">
      <img src="img/noti1.jpg" alt="Noticia 1">

      <div class="card-content">
        <div class="title">Primer Congreso "Homenaje a la Mujer Moderna"</div>
        <div class="date">Publicado el 12 de noviembre, 2025</div>
        <div class="text">
          El próximo 15 de noviembre se llevará a cabo el Primer Congreso...
        </div>


         <button class="btn btn-outline-primary btn-sm editar-noticia"
          data-title="Primer Congreso “Homenaje a la Mujer Moderna”"
          data-date="12 noviembre 2025"
          data-text="Texto completo de la noticia..."
          data-img="img/noti1.jpg">
          <i class="bi bi-pencil"></i> Editar
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

        <button class="btn btn-outline-primary btn-sm editar-noticia"
          data-title="CONACICA, Embajador del Banco de Tapitas"
          data-date="2 diciembre 2025"
          data-text="Texto completo del Banco de Tapitas..."
          data-img="img/tapitas.jpg">
          <i class="bi bi-pencil"></i> Editar
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

    <button class="btn btn-outline-primary btn-sm editar-noticia"
          data-title=" CONACICA presente en el Festival Abarrotero Ecatepec 2025 "
          data-date="3 noviembre 2025"
          data-text="Texto completo de la noticia..."
          data-img="img/noticia3.jpg">
          <i class="bi bi-pencil"></i> Editar
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


<!-- MODAL CREAR / EDITAR NOTICIA -->
<div class="modal fade" id="modalAdminNoticia" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <form class="modal-content" action="./dashboardCrud/noticias.php">

      <div class="modal-header bg-green text-white">
        <h5 class="modal-title" id="modalTitulo">Editar noticia</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <img id="modalImgPreview" src="">

        <div class="mb-3">
          <label class="form-label">Imagen</label>
          <input type="file" name="imgNoticia" accept="image/jpeg,image/png,image/webp" class="form-control" >
        </div>

        <div class="mb-3">
          <label class="form-label">Título</label>
          <input type="text" class="form-control" id="inputTitulo" name="inputTitulo">
        </div>

        <div class="mb-3">
          <label class="form-label">Fecha</label>
          <input type="text" class="form-control" id="inputFecha" name="inputFecha">
        </div>

        <div class="mb-3">
          <label class="form-label">Contenido</label>
          <textarea class="form-control" rows="6" id="inputTexto" name="inputTexto"></textarea>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancelar</button>
        <button class="btn btn-success" type="submit">
          <i class="bi bi-save"></i> Guardar cambios
        </button>
      </div>
    </form>
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
        <form class="shadow-sm p-4 bg-white rounded">

          <div class="row g-3">

            <!-- Tipo de aviso -->
            <div class="col-md-6">
              <label class="form-label">Tipo de aviso</label>
              <select class="form-select" name="id_tipo" required>
                <option value="">Selecciona una categoría</option>
                <option value="1" data-color="#DC3545">Bloqueo</option>
                <option value="2" data-color="#28A745">Agricultura</option>
                <option value="3" data-color="#007BFF">Mercado</option>
                <option value="4" data-color="#FFC107">Logística</option>
                <option value="5" data-color="#17A2B8">Clima</option>
                <option value="6" data-color="#6F42C1">General</option>
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
            <div class="col-12">
              <label class="form-label">Imagen (opcional)</label>
              <input type="file" class="form-control" name="imagen" accept="image/*">
            </div>

            <!-- Botón -->
            <div class="col-12 text-end mt-3">
              <button type="submit" class="btn btn-outline-conacica-green rounded-pill px-4">
                Enviar aviso
              </button>
            </div>

          </div>

        </form>
      </div>

    </div>
  </div>
</div>

</div>

<!-- SCRIPTS: asegúrate de tener bootstrap.bundle (tiene Modal) cargado antes de este script -->
<script>
document.addEventListener('DOMContentLoaded', () => {

  const modal = new bootstrap.Modal(
    document.getElementById('modalAdminNoticia')
  );

  const titulo = document.getElementById('inputTitulo');
  const fecha = document.getElementById('inputFecha');
  const texto = document.getElementById('inputTexto');
  const img = document.getElementById('modalImgPreview');

  // EDITAR
  document.querySelectorAll('.editar-noticia').forEach(btn => {
    btn.addEventListener('click', () => {
      document.getElementById('modalTitulo').textContent = 'Editar noticia';

      titulo.value = btn.dataset.title;
      fecha.value = btn.dataset.date;
      texto.value = btn.dataset.text;
      img.src = btn.dataset.img;

      modal.show();
    });
  });

  // NUEVA
  document.getElementById('btnNuevaNoticia').addEventListener('click', () => {
    document.getElementById('modalTitulo').textContent = 'Nueva noticia';

    titulo.value = '';
    fecha.value = '';
    texto.value = '';
    img.src = '';

    modal.show();
  });

});
</script>

<script src="./src/js/bootstrap.bundle.js"></script>

</body>
</html>