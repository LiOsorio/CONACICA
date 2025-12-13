
<?php 
    session_start();
    include_once __DIR__ . '/config/Connection.php';

    $conn = connection();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CONACICA</title>
    <link href="./src/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
        <link rel="stylesheet" href="./src/css/style.css">

</head>
<body>
    <?php include 'nav.php'; ?>

<section id="precios-mercado" class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-2 text-dark">
            Precios de la Canasta Básica y Productos Agrícolas
        </h2>
        <p class="text-center fs-5 mb-4 text-secondary">Consulta precios promedio actualizados para una toma de decisiones informada.</p>
        
        <?php 
        $sql = "SELECT fechaActualizacion FROM preciosRegistrados ORDER BY fechaActualizacion ASC LIMIT 1";
        ?>
        <div class="text-center mb-5">
            <span class="badge bg-warning text-dark p-2">
                <i class="fas fa-calendar-check me-1"></i> Datos actualizados al 15 de Octubre, 2025
            </span>
        </div>

        <div class="card p-4 shadow-sm mb-5">
            <h4 class="card-title fw-bold small text-muted mb-3">Filtra tu Búsqueda:</h4>
            <form class="row g-3 align-items-end">
                
                <div class="col-md-4">
                    <label for="filtro-producto" class="form-label small">Producto</label>
                    <select class="form-select" id="filtro-producto">
                        <option selected>Aguacate Hass</option>
                        <option>Tomate Saladet</option>
                        <option>Frijol Negro</option>
                        </select>
                </div>

                <div class="col-md-4">
                    <label for="filtro-central" class="form-label small">Central de Abasto</label>
                    <select class="form-select" id="filtro-central">
                        <option selected>CEDA Iztapalapa</option>
                        <option>CEDA Ecatepec</option>
                        </select>
                </div>

                

                <div class="col-md-1">
                    <button type="submit" class="btn btn-know-us w-100 fw-bold">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <h3 class="fw-bold mb-3">Resultados Recientes</h3>
        
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="bg-dark text-white">
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Central/Mercado</th>
                        <th scope="col">Unidad</th>
                        <th scope="col" class="text-end">Precio Promedio</th>
                    </tr>
                </thead>
                <?php 
                
                $sql = 'SELECT 
                        reg.preciosId,
                        reg.unidad,
                        reg.precio,
                        pro.productName,
                        cen.centralName
                        FROM preciosRegistrados reg
                        INNER JOIN producto pro
                        ON reg.productoId = pro.productoId
                        INNER JOIN central cen
                        ON reg.centralId = cen.centralId
                    ';

                try{
                    $stmt = $conn -> prepare( $sql );
                    $stmt -> execute();
                } catch( PDOException $e ) {
                    echo "<p>Hubo un error al consultar los datos.</p>";
                }
                ?>
                <tbody>
                    <?php while( $res = $stmt -> fetch() ): ?>
                    <tr>
                        <td class="fw-bold"><?php echo $res['productName'] ?></td>
                        <td><?php echo $res['centralName'] ?></td>
                        <td><?php echo $res['unidad'] ?></td>
                        <td class="text-end fw-bold fs-5 text-dark">$<?php echo $res['precio'] ?></td> 
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
            </table>
        </div>
        
        <p class="text-center mt-4 small text-muted">
            Los precios son indicativos y pueden variar por calidad y volumen de compra.
        </p>

    </div>
</section>
    <?php include 'footer.php'; ?>


    <script src="./src/js/bootstrap.bundle.js"></script>
</body>
</html>

