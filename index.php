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
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CONACICA</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  
  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
  <link rel="font" href="./src/fonts/Ethnocentric-Regular.otf">

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <?php include_once 'nav.php'; ?>
  <!-- HERO (ok solo checar responsive) -->
  <header class="hero-section py-5" id="inicio">
    <div class="container py-5">
        <div class="row align-items-center">
            
            <div class="col-12 col-md-6 text-center">
                <img src="img/logo-6.jpg" class="img-fluid d-block mx-auto logo-conacica logo-hero-responsive" alt="Logo CONACICA Circular">
            </div>

            <div class="col-md-6 text-md-end text-center mt-4 mt-md-0">
                
                <h1 class="display-4 fw-bold mb-3">
                    La Fuerza Integradora del Sector Agroalimentario.
                </h1>
                
                <p class="lead mb-4">
                    Uniendo a Centrales de Abasto, Transportistas, Productores Agrícolas y Mercados Públicos de México.
                </p>
                
                <a href="#" class="btn btn-lg rounded-pill btn-cta-hero">Conoce a CONACICA</a>
            </div>

        </div>
    </div>
  </header>

<section>

<?php if( !empty( $_SESSION[ 'userId' ] ) ){?>
  <div class="modal fade" id="modalEditarNosotros" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalAgregar" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-centered">
          <div class="modal-content border-0 shadow login-modal m-3">
              <form action="crudIndex/editIndex.php" method="POST" enctype="multipart/form-data">
                <input type="text" value="nosotros" name="action" hidden >
                <div class="text-center mb-3">
                    <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                    <h5 class="fw-bold text-primary-custom" style="font-size: 35px;">Modificar Imágen de Nosotros</h5>
                    <p class="fw-bold text-center " style="color: #ec4141ff;">Una vez aceptados los cambios, la imágen anterior se eliminará.</p>
                </div>
                <div class="d-flex flex-column flex-md-row col-12 justify-content-center gap-2">
                  <div class="col-6 d-flex justify-content-center flex-column mx-auto">
                    <p class="fw-bold text-center" style="font-size: 20px;">Imágen actual</p>
                    <img style="width: auto; height: fit; object-fit:contain; object-position: center center; display: block;" src="./img/indexImg/nosotros.webp" alt="Nosotros Imagen">
                  </div>
                  <div class="col-4 d-flex flex-column justify-content-center mx-auto">
                    <label for="imgNosotros" class="fw-bold " style="font-size: 20px;">Imagen a mostrar:</label>
                    <input type="file" id="imgNosotros" name="imgNosotros" accept="image/jpeg, image/png" placeholder="Ingresa la imagen a mostrar">
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-2 m-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" >Agregar</button>
                </div>
              </form>
          </div>
      </div>
  </div>
<?php } ?>

<section id="nosotros-mega-card" class="bg-light">
  <div class="container-fluid p-0">
    <div class="row row-full-height g-0 align-items-center">
      <div class="col-lg-6 p-5 d-flex flex-column justify-content-center animation"> 
        <div class="py-5"> <h2 class="fw-bold border-start border-conacica-green border-5 ps-3 fs-1 mb-4">Nosotros</h2>
            <p class="lead fw-normal">
                Realizamos acciones en apoyo al fortalecimiento y profesionalización del sector Agroalimentario, 
                mediante la creación de vínculos con las Centrales de Abasto, Transportistas, Productores Agrícolas 
                y Mercados Públicos.
            </p>
            <?php if( !empty( $_SESSION['userId'] ) ): ?>
              <button class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEditarNosotros">Cambiar Imágen</button>
            <?php endif; ?>
        </div>
          
      </div>
      <div class="col-lg-6 p-2 col-img-full d-flex justify-content-center"> 
        <img style="width: auto; height: 500px; object-fit: cover; object-position: center;" src="./img/indexImg/nosotros.webp" class="d-block animation" alt="Imagen de Productores">
      </div>
    </div>
  </div>
</section>

<section id="nuestros-pilares" class="container-fluid py-3 px-5">
    <h3 class="fw-bold border-start text-start border-conacica-green border-5 ps-3 mb-4 animation">Nuestros Pilares</h3>
    <div class="row g-4 animation">
        
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
  <section id="pilares" class="bg-light p-5 pb-0">
    <div class="container-fluid text-center">
      <h3 class="fw-bold border-start text-start border-conacica-green border-5 ps-3 mb-1 fs-1 animation">Beneficios CONACICA</h3>
      <p class="text-muted mb-4 text-start animation">Trabajamos dando apoyo a nuestra comunidad.</p>

      <div class="row justify-content-center g-4 animation">
        <div class="col-lg-3 col-md-6">
          <div class="card h-100 card-hover-effect">
            <div class="card-body p-4">
              <i class="fas fa-graduation-cap fa-3x text-success mb-3"></i>
              <h4 class="fw-bold">Profesionalización</h4>
              <p>Accede a cursos y talleres especializados.</p>
              <a href="cursos.php" class="btn btn-outline-success mt-3">Ver Cursos</a>
            </div>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="card h-100 card-hover-effect">
            <div class="card-body p-4">
              <i class="fas fa-handshake fa-3x text-warning mb-3"></i>
              <h4 class="fw-bold">Conexión Estratégica</h4>
              <p>Conéctate con mayoristas de todo el país.</p>
              <a href="directorio.php" class="btn btn-outline-warning mt-3">Directorio Mayorista</a>
              
            </div>
            
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="card h-100 card-hover-effect">
            <div class="card-body p-4">
              <i class="bi bi-graph-up-arrow text-primary mb-3 fs-1"></i>
            <h4 class="fw-bold">Información de Mercado</h4>
              <p>Consulta precios de la canasta básica en tiempo real.</p>
              <a href="precios.php" class="btn btn-outline-primary mt-3">Consultar Precios</a>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="card h-100 card-hover-effect">
            <div class="card-body p-4">
              <i class="bi bi-people-fill text-dark fs-1"></i>
              <h4 class="fw-bold">Únete a CONACICA</h4>
              <p>Únete como persona física o moral</p>
              <a href="#" data-bs-toggle="modal" data-bs-target="#modalContacto" class="btn btn-outline-dark mt-3">Unirse</a>
            </div>

        
        </div>
      </div>
    </div>
  </section>

<?php if( !empty( $_SESSION[ 'userId' ] ) ){?>
  <div class="modal fade" id="modalEditarParticipaciones" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalParticipaciones" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-centered">
          <div class="modal-content border-0 shadow login-modal m-3">
              <form action="crudIndex/editIndex.php" method="POST" enctype="multipart/form-data">
                <input type="text" value="participaciones" name="action" hidden >
                <div class="text-center mb-3">
                    <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                    <h5 class="fw-bold text-primary-custom" style="font-size: 35px;">Modificar Imágen de Participaciones</h5>
                    <p class="fw-bold text-center " style="color: #ec4141ff;">Una vez aceptados los cambios, la imágen anterior se eliminará.</p>
                </div>
                <div class="d-flex flex-column flex-md-row col-12 justify-content-center gap-2">
                  <div class="col-6 d-flex justify-content-center flex-column mx-auto">
                    <p class="fw-bold text-center" style="font-size: 20px;">Imágen actual</p>
                    <img style="width: auto; height: fit; object-fit:contain; object-position: center center; display: block;" src="./img/indexImg/participaciones.webp" alt="Nosotros Imagen">
                  </div>
                  <div class="col-4 d-flex flex-column justify-content-center mx-auto">
                    <label for="imgParticipaciones" class="fw-bold " style="font-size: 20px;">Imagen a mostrar:</label>
                    <input type="file" id="imgParticipaciones" name="imgParticipaciones" accept="image/jpeg, image/png" placeholder="Ingresa la imagen a mostrar">
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
<?php } ?>

<section id="participaciones-mega-card" class="bg-light">
    <div class="container-fluid p-0">
        <div class="row row-full-height g-0 align-items-center">
            
            <div class="col-lg-6 p-5 d-flex flex-column justify-content-center"> 
                <div class="py-5"> <h2 class="fw-bold border-start border-conacica-green border-5 ps-3 fs-1 mb-4 animation">Nuestras Participaciones</h2>
                    <p class="lead fw-normal animation">
                        Nuestra Huella en el Desarrollo Nacional De congresos a foros especializados,
                        CONACICA es un actor indispensable en la agenda agroalimentaria de México. 
                        Explore nuestra galería y descubra cómo llevamos nuestra misión de integración 
                        y profesionalización a los escenarios más importantes.
                    </p>

                    <div class="d-flex justify-content-end animation">
                      <?php  if( !empty( $_SESSION['userId'] ) ): ?>
                        <button class="btn btn-warning rounded-pill m-3" data-bs-toggle="modal" data-bs-target="#modalEditarParticipaciones">Cambiar imágen</button>
                      <?php endif; ?>
                      <a href="participaciones.php" class="btn btn-lg rounded-pill btn-cta-hero1 m-3">Ver más participaciones</a>
                    </div>
                </div>
                
            </div>

            <div class="col-lg-6 p-2 col-img-full contenedor-imagen position-relative animation"> 
              <img src="./img/indexImg/participaciones.webp" class="d-block w-100" alt="Imagen de Productores">
            </div>
            
        </div>
    </div>
</section>

<?php 
  $sql = "SELECT * FROM promocional WHERE active = 1 LIMIT 1 ";
  
  $stmt = $conn -> prepare($sql);
  $stmt -> execute();
  $res = $stmt -> fetch();

?>

<section id="restaurante-mega-card" class="bg-light">
    <div class="container-fluid py-4 my-3">
        <div class="row row-full-height g-0 align-items-center">
          <div class="col-lg-6 p-2 col-img-full contenedor-imagen position-relative"> 
            <img src="./img/indexImg/<?php echo $res['img']; ?>" class="d-block w-100 animation" alt="Imagen de Productores">
          </div>
            <div class="col-lg-6 px-5 d-flex flex-column justify-content-center animation"> 
                <div class="py-5"> 
                  <h2 class="fw-bold border-start border-conacica-green border-5 ps-3 fs-1 mb-4 mt-5"><?php echo $res['titulo']; ?></h2>
                    <p class="lead fw-normal">
                      <?php echo $res['descripcion']; ?>
                    </p>
                    <div class="d-flex justify-content-end">
                      <?php if( !empty($_SESSION['userId']) ): ?>
                        <button class="btn btn-warning rounded-pill m-3" data-bs-toggle="modal" data-bs-target="#modalEditarPromocional">Editar Promocional</button>
                      <?php endif; ?>
                      <a href="<?php echo $res['url'] ?>" class="btn btn-lg rounded-pill btn-cta-hero1 m-3">Conócenos</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if( !empty( $_SESSION[ 'userId' ] ) ){?>
  <div class="modal fade" id="modalEditarPromocional" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalPromocional" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-centered">
          <div class="modal-content border-0 shadow login-modal m-3">
              <form action="crudIndex/editIndex.php" method="POST" enctype="multipart/form-data">
                <input type="text" value="promocional" name="action" hidden >
                <div class="text-center mb-3">
                    <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                    <h5 class="fw-bold text-primary-custom" style="font-size: 35px;">Modificar datos de promocional</h5>
                </div>
                <div class="d-flex flex-column col-12 justify-content-center gap-2">
                  <div class="col-4 d-flex flex-column justify-content-center mx-auto">
                    <label for="tituloPromocional" class="fw-bold " style="font-size: 20px;">Titulo de la promoción:</label>
                    <input type="text" id="tituloPromocional" name="tituloPromocional" placeholder="Titulo de la promoción...">
                  </div>
                  <div class="col-4 d-flex flex-column justify-content-center mx-auto">
                    <label for="descripcionPromocional" class="fw-bold " style="font-size: 20px;">Descripción:</label>
                    <textarea style="height: 300px; max-height: 300px; min-height: 300px; width: 100%;" class="m-1" id="descripcionPromocional" name="descripcionPromocional" placeholder="Descripción..."></textarea>
                  </div>
                  <div class="col-4 d-flex flex-column justify-content-center mx-auto">
                    <label for="urlPromocional" class="fw-bold " style="font-size: 20px;">URL de la promoción:</label>
                    <input type="text" id="urlPromocional" name="urlPromocional" placeholder="URL de la promoción...">
                  </div>
                  <div class="col-4 d-flex flex-column justify-content-center mx-auto">
                    <label for="imgPromocional" class="fw-bold " style="font-size: 20px;">Imagen a mostrar:</label>
                    <input type="file" id="imgPromocional" name="imgPromocional" accept="image/jpeg, image/png,image/webp" placeholder="Ingresa la imagen a mostrar">
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-2 m-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" >Cambiar Promocional</button>
                </div>
              </form>
          </div>
      </div>
  </div>
<?php } ?>

  <!-- SECCIÓN: ALIANZAS -->
<section id="alianzas" class="py-2">
    <div class="container-fluid p-5 text-start animation">
      <h3 class="fw-bold border-start border-conacica-green border-5 ps-3 fs-1 mb-1 ">Alianzas</h3>
      <p class="text-muted mb-4 ">Trabajamos con líderes académicos y empresariales que fortalecen el sector agroalimentario de México.</p>
      <?php if( !empty($_SESSION['userId']) ): ?>
        <button class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modalAgregarAlianzas">Agregar Alianzas</button>
        <button class="btn btn-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modalEditarAlianzas">Editar Alianzas Existentes</button>
      <?php endif; ?>
      <div class="logo-marquee shadow-sm rounded-4 py-4 bg-white animation">
        <div class="logo-track">
          <?php 
            $sql = "SELECT * FROM alianzas WHERE active = 1";

            $stmt = $conn -> prepare( $sql );
            $stmt -> execute();
            
            while( $res = $stmt -> fetch() ):
          ?>
            <div class="logo-wrapper"><img src="./img/indexImg/alianzas/<?php echo $res['img'] ?>" alt="<?php echo $res['nombre'] ?>"></div>
          <?php endwhile; ?>
          <!-- <div class="logo-wrapper"><img src="./img/indexImg/alianzas/kevallevar-logo.png" alt="Kevallevar"></div>
          <div class="logo-wrapper"><img src="./img/indexImg/alianzas/lareina-logo.jpg" alt="lareina"></div>
          <div class="logo-wrapper"><img src="./img/indexImg/alianzas/casalucio-logo.jpg" alt="casalucio"></div>
          <div class="logo-wrapper"><img src="./img/indexImg/alianzas/sanpedro-logo.jpg" alt="san pedro"></div> -->
          <!-- duplicados para loop infinito -->
        </div>
      </div>

    </div>
</section>
<?php if( !empty( $_SESSION[ 'userId' ] ) ){?>
  <div class="modal fade" id="modalAgregarAlianzas" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalAlianzas" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-centered">
          <div class="modal-content border-0 shadow login-modal m-3 col-12">
              <form class="" action="crudIndex/editIndex.php" method="POST" enctype="multipart/form-data">
                <input type="text" value="nuevaAlianza" name="action" hidden >
                <div class="text-center mb-3">
                    <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                    <h5 class="fw-bold text-primary-custom" style="font-size: 25px;">Agregar alianza</h5>
                </div>
                <div class="d-flex flex-column col-12 justify-content-center gap-2">
                  <div class=" d-flex flex-column justify-content-center mx-auto">
                    <label for="nombreNuevaAlianza" class="fw-bold " style="font-size: 20px;">Nombre de la alianza:</label>
                    <input type="text" id="nombreNuevaAlianza" name="nombreNuevaAlianza" placeholder="Nombre de la empresa...">
                  </div>
                  <div class="d-flex flex-column justify-content-center mx-auto">
                    <label for="imgNuevaAlianza" class="fw-bold " style="font-size: 20px;">Imagen de la alianza:</label>
                    <input type="file" id="imgNuevaAlianza" name="imgNuevaAlianza" accept="image/jpeg, image/png, image/webp" placeholder="Ingresa la imagen a mostrar">
                  </div>
                </div>
                <div class="d-flex justify-content-end gap-2 m-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" >Agregar alianza</button>
                </div>
              </form>
          </div>
      </div>
  </div>
<?php } ?>

<?php 
  $sqlVerAlianzas = "SELECT * FROM alianzas";

  $stmt = $conn -> prepare( $sqlVerAlianzas );
  $stmt -> execute();
?>

<?php if( !empty( $_SESSION[ 'userId' ] ) ){?>
  <div class="modal fade" id="modalEditarAlianzas" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="modalAlianzas" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-centered">
          <div class="modal-content border-0 shadow login-modal m-3 col-12">
              <form class="" action="crudIndex/editIndex.php" method="POST" enctype="multipart/form-data">
                <input type="text" value="editarAlianza" name="action" hidden >
                <div class="text-center mb-3">
                    <img src="logo.png" width="150" height="150" alt="Logo de la empresa" class="img-fluid mb-2">
                    <h5 class="fw-bold text-primary-custom" style="font-size: 25px;">Editar alianzas</h5>
                </div>
                <table class="d-flex flex-column col-12 justify-content-center gap-2">
                  <thead class="col-12">
                    <tr class="col-12 d-flex flex-row justify-content-around">
                      <td>Imagen</td>
                      <td>Nombre</td>
                      <td>Estado</td>
                    </tr>
                  </thead>  
                  <tbody class="col-12">
                      <?php while ( $res = $stmt -> fetch() ): ?>
                        <tr class="col-12 d-flex flex-row justify-content-around ">  
                          <td class="" style="max-width: 100px; max-height: 100px"><img style="width: 100%; height: auto; object-fit:contain; object-position: center center; display: block;" src="./img/indexImg/alianzas/<?php echo $res['img'] ?>" alt="<?php echo $res['nombre'] ?>"></td>
                          <td><?php echo $res['nombre'] ?></td>
                          <td><input name="active[<?php echo $res['id']; ?>]" type="checkbox" <?php if( $res['active'] == '1' ){ echo "checked"; } else { echo ""; } ?> > </td>
                        </tr>
                      <?php endwhile; ?>
                  </tbody>
                </table>
                <div class="d-flex justify-content-end gap-2 m-3">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning" >Aceptar</button>
                </div>
              </form>
          </div>
      </div>
  </div>
<?php } ?>
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
    <?php include 'footer.php'; ?>

  <!-- SCRIPTS -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="alianzas.js"></script>
  <script src="animations.js"></script>
</body>
</html>
