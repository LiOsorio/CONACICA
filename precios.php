
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

        $stmt = $conn -> prepare( $sql );
        $stmt -> execute();
        $res = $stmt -> fetch();

        ?>
        <div class="text-center mb-5">
            <span class="badge bg-warning text-dark p-2">
                <i class="fas fa-calendar-check me-1"></i> Datos actualizados al <?php echo $res['fechaActualizacion'] ?>
            </span>
        </div>

        <div class="card p-4 shadow-sm mb-5">
            <h4 class="card-title fw-bold small text-muted mb-3">Filtra tu Búsqueda:</h4>
            <div class="row g-3 align-items-end">
                <?php 
                    $sql = "SELECT * FROM producto";
                    try{
                        $stmt = $conn -> prepare( $sql );
                        $stmt -> execute();
                    } catch( PDOException $e ) {
                        echo "<p>Hay un error al tratar de conectar con el servidor, Intente de nuevo más tarde.</p>";
                    }
                ?>
                <div class="col-md-4">
                    <label for="filtro-producto" class="form-label small">Producto</label>
                    <select class="form-select" id="filtroProducto">
                        <option value="">Todos</option>
                        <?php while( $res = $stmt -> fetch() ): ?>
                            <option value="<?php echo $res['productoId'] ?>"><?php echo $res['productName'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <?php 
                    $sql = "SELECT * FROM central";
                    try{
                        $stmt = $conn -> prepare( $sql );
                        $stmt -> execute();
                    } catch ( PDOException $e ) {
                        echo "<p>Ocurrió un error al conectar con el servidor. Por favor intentelo de nuevo más tarde.</p>";
                    }

                ?>
                <div class="col-md-4">
                    <label for="filtro-central" class="form-label small">Central de Abasto</label>
                    <select class="form-select" id="filtroCentral">
                        <option value="">Todos</option>
                        <?php while( $res = $stmt -> fetch() ): ?>
                            <option value="<?php echo $res['centralId'] ?>"><?php echo $res['centralName'] ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>
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
                <tbody id="preciosPub">
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
    <script>
        const filtroProducto = document.getElementById('filtroProducto');
        const filtroCentral = document.getElementById('filtroCentral');

        filtroProducto.addEventListener('change', filtrarTabla);
        filtroCentral.addEventListener('change', filtrarTabla);


        function filtrarTabla(){
            const productoId = filtroProducto.value;
            const centralId = filtroCentral.value;

            fetch( './dashboardCrud/gestionPreciosPub.php', {
                method: 'POST',
                headers: {
                    "Content-Type":"application/json"
                },
                body: JSON.stringify({
                    action: 'filtrarTablaPub',
                    productoId: productoId,
                    centralId: centralId
                })
            })
            .then( res => {
                if( !res.ok ){
                    throw new Error('Error');
                }
                return res.json();
            })
            .then( data => {
                if( !data ){
                    return
                }
                document.getElementById('preciosPub').innerHTML = data.res;
            } )
            .catch( err => console.log(err));
        }
    </script>
</body>
</html>

