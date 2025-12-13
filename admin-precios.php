<?php 
    session_start();

    include_once __DIR__ . "/config/Connection.php";

    $error;
    $conn = connection();

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

    $sqlCentral = 'SELECT * FROM central';
    $sqlProducto = 'SELECT * FROM  producto';
    $input = json_decode(file_get_contents("php://input"), true);



    if( isset( $_SESSION['error'] ) || !empty( $_SESSION['error'] ) ){
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }

?>
<?php  




    if(!empty($_SESSION['error'])){
        $error = $_SESSION['error'];
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precios Canasta Básica</title>

    <link href="./src/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="./src/css/style.css">
</head>
<body class="body-admin">

    <?php include 'admin-menu.php'; ?>

    <div class="container my-2">
        <h2 class="fw-semibold border-bottom pb-2">Gestión de Precios Mayoristas</h2>

        <?php if( !empty( $error ) ): ?>
            <div class="p-3 bg-light rounded border mb-4 mx-auto">
                <p class="text-danger text-center"><?php echo $error ?></p>
            </div>
        <?php endif; ?>
        <div class="card shadow-lg mt-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Precios Registrados</h4>
                <div class="input-group w-50">
                    <input type="text" id="buscarPrecios" class="form-control" placeholder="Buscar producto o central...">
                    <button class="btn btn-outline-light" type="button"><i class="bi bi-search"></i></button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th>Producto</th>
                                <th>Central/Mercado</th>
                                <th>Unidad</th>
                                <th>Precio Promedio $MXN</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        
                        <tbody id="preciosRegist">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
        <button class="btn btn-primary btn m-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalAgregar">
            <i class="bi bi-plus-circle me-2"></i> Registrar Nuevo Precio
        </button>
        </div>
    </div>

    <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="modalAgregarLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="modalAgregarLabel"><i class="bi bi-basket me-2"></i> Registrar Nuevo Precio de Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form_nuevo_precio_modal" action="./dashboardCrud/gestionPrecios.php" method="POST">
                    <input type="text" name="action" value="agregarPrecio" hidden>
                    <div class="modal-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" id="selectNuevoProducto">Producto</label>
                            <?php 
                                $stmt = $conn -> prepare( $sqlProducto );
                                $stmt -> execute();
                            ?>
                            <div class="input-group">
                                <select class="form-select" name="productoRegistrar" id="selectNuevoProducto" required>
                                    <option selected disabled>Seleccione producto...</option>
                                    <?php while( $res = $stmt -> fetch() ): ?>
                                        <option value="<?php echo $res['productoId'] ?>"><?php echo $res['productName'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalGestionProductos" title="Administrar Productos">
                                    <i class="bi bi-gear"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" for="CentralAbastoLabelAgregarProducto">Central de Abasto</label>
                            <?php 
                                $stmt = $conn -> prepare( $sqlCentral );
                                $stmt -> execute();
                            ?>
                            <div class="input-group">
                                <select class="form-select" name="centralRegistrar" id="CentralAbastoLabelAgregarProducto" required>
                                    <option selected disabled>Seleccione la Central...</option>
                                    <?php while( $res = $stmt -> fetch() ): ?>
                                        <option value="<?php echo $res['centralId'] ?>"><?php echo $res['centralName'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalGestionCentrales" title="Administrar Centrales">
                                    <i class="bi bi-gear"></i>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Unidad (kg)</label>
                            <select class="form-select" name="unidadRegistrar" required>
                                <option value="Menudeo">Menudeo</option>
                                <option value="Mayoreo">Mayoreo</option>
                                <option value="Medio Mayoreo">Medio Mayoreo</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Precio Promedio</label>
                            <input type="number" class="form-control bg-info bg-opacity-10" name="precioRegistrar" step="0.5" placeholder="0.00" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i> Guardar Registro</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="modalEditarLabel"><i class="bi bi-pencil-square me-2"></i> Editar precio</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Producto</label>
                            <?php 
                                $stmt = $conn -> prepare($sqlProducto);
                                $stmt -> execute();
                            ?>
                            <select class="form-select">
                                <?php while( $res = $stmt -> fetch() ): ?>
                                    <option value="<?php echo $res['productoId'] ?>"><?php echo $res['productName'] ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Central de Abasto</label>
                            <select class="form-select">
                                <option>CEDA Iztapalapa</option>
                                <option>Guadalajara</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Unidad</label>
                            <select class="form-select">
                                <option>Kilogramo</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Precio Promedio</label>
                            <input type="number" step="0.5" class="form-control" value="65.50">
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-success"><i class="bi bi-check-lg me-2"></i> Guardar cambios</button>
                </div>

            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalGestionCentrales" tabindex="-1" aria-labelledby="modalGestionCentralesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="modalGestionCentralesLabel"><i class="bi bi-building me-2"></i> Administrar Centrales de Abasto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body">
                    <h6>Agregar Nueva Central</h6>
                    <form action="./dashboardCrud/gestionPrecios.php" method="POST">
                        <div class="input-group mb-4">
                            <input type="text" name="action" value="agregarCentral" hidden>
                            <input type="text" name="agregarNombreCentral" class="form-control" placeholder="Nombre de la Central (e.g., CEDA Monterrey)">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-plus-lg"></i> Agregar</button>
                        </div>
                    </form>
                    
                    <h6>Centrales Registradas</h6>
                    <?php 
                        $stmt = $conn -> prepare( $sqlCentral );
                        $stmt -> execute();
                    ?>
                    <ul class="list-group">
                        <?php while( $res = $stmt -> fetch() ): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $res['centralName'] ?>
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="modalGestionProductos" tabindex="-1" aria-labelledby="modalGestionProductosLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-secondary text-white">
                    <h5 class="modal-title" id="modalGestionProductosLabel"><i class="bi bi-apple me-2"></i> Administrar Productos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h6>Agregar Nuevo Producto</h6>
                    <form action="./dashboardCrud/gestionPrecios.php" method="POST">
                        <div class="input-group mb-4">
                            <input type="text" name="action" value="NuevoProducto" hidden>
                            <input type="text" name="agregarNombreProducto" class="form-control" placeholder="Nombre del Producto (e.g., Manzana Roja)">
                            <button class="btn btn-primary" type="submit"><i class="bi bi-plus-lg"></i> Agregar</button>
                        </div>
                    </form>
                    <h6>Productos Registrados</h6>
                    <?php 
                        $stmt = $conn -> prepare( $sqlProducto ) ;
                        $stmt -> execute();
                        
                    ?>
                    <ul class="list-group">
                        <?php while( $res = $stmt -> fetch() ): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?php echo $res['productName'] ?>
                            <form action="./dashboardCrud/gestionPrecios.php" method="post">
                                <input type="text" name="productId" value="<?php echo $res['productoId'] ?>" hidden>
                                <button type="submit" name="action" value="deleteProduct" class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button>
                            </form>
                        </li>
                        
                        <?php endwhile; ?>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./src/js/bootstrap.bundle.js"></script>
    <script>

        function preventDefault( ){
            preventDefault();
        }
        document.addEventListener( 'DOMContentLoaded' , function() {
            fetch( './dashboardCrud/gestionPreciosAjax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'obtenerPrecios'
                })
            })
            .then( response => {
                if( response.status === 401 ){
                    window.location.href = '/';
                    return;
                }
                if ( !response.ok ) {
                    document.getElementById('preciosRegist').innerHTML = '<p>Hubo un problema al cargar los datos.</p>';
                }
                return response.json();
            } )
            .then( data => {
                document.getElementById('preciosRegist').innerHTML = data.res;
            } )
            .catch( error => console.error( 'Error: ', error ) );
        });

        let timeout = null;
        document.getElementById( 'buscarPrecios' ). addEventListener( 'input', e => {
            const palabra = e.target.value.trim();

            clearTimeout( timeout );


            timeout = setTimeout( () => {
                buscarPrecios( palabra );
            }, 400 );
        } );

        function buscarPrecios( palabra = '' ) {
            fetch( './dashboardCrud/gestionPreciosAjax.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    action: 'obtenerPreciosFiltrados',
                    buscar: palabra
                })
            })
            .then( res => {
                if( res.status === 401 ){
                    window.location.href = '/';
                    return;
                }
                if( !res.ok ){
                    throw new Error('Error');
                }
                return res.json();
            })
            .then( data => {
                if( !data )  return;
                document.getElementById('preciosRegist').innerHTML = data.res;
            } )
            .catch( err => console.error( err ));
        }
    </script>
</body>
</html>