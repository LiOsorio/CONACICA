<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Precios Canasta Básica</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="style.css">
</head>
<body class="body-admin">

    <?php include 'admin-menu.php'; ?>

    <div class="container my-2">
        <h2 class="fw-semibold border-bottom pb-2">Gestión de Precios Mayoristas</h2>

        <div class="p-3 bg-light rounded border mb-4">
            <div class="d-flex gap-3 align-items-center">
                <h5 class="text-secondary fs-5">Última actualización</h5>

                <input type="date" class="form-control w-auto" id="fecha_actualizacion" value="2025-10-15">
                <button class="btn btn-success"><i class="bi bi-save me-2"></i> Guardar fecha</button>
            </div>
        </div>

        <div class="card shadow-lg mt-4">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Precios Registrados</h4>
                <div class="input-group w-50">
                    <input type="text" class="form-control" placeholder="Buscar producto o central...">
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
                        <tbody>
                            <tr>
                                <td>Aguacate Hass</td>
                                <td>CEDA Iztapalapa</td>
                                <td>Mayoreo</td>
                                <td><span class='badge bg-success fs-6'>$65.50</span></td>
                                <td>
                                    <button class='btn btn-sm btn-warning me-2' data-bs-toggle='modal' data-bs-target='#modalEditar'><i class='bi bi-pencil'></i> Editar</button>
                                    <button class='btn btn-sm btn-danger'><i class='bi bi-trash'></i> Eliminar</button>
                                </td>
                            </tr>
                            <tr>
                                <td>Limón Persa</td>
                                <td>CEDA Iztapalapa</td>
                                <td>Medio Mayoreo</td>
                                <td><span class='badge bg-success fs-6'>$18.90</span></td>
                                <td>
                                    <button class='btn btn-sm btn-warning me-2' data-bs-toggle='modal' data-bs-target='#modalEditar'><i class='bi bi-pencil'></i> Editar</button>
                                    <button class='btn btn-sm btn-danger'><i class='bi bi-trash'></i> Eliminar</button>
                                </td>
                            </tr>
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
                
                <form id="form_nuevo_precio_modal" action="guardar_precio.php" method="POST">
                    <div class="modal-body row g-3">
                        
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Producto</label>
                            <div class="input-group">
                                <select class="form-select" name="producto" required>
                                    <option value="">Seleccione el producto...</option>
                                    <option>Aguacate Hass</option>
                                    <option>Limón Persa</option>
                                </select>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalGestionProductos" title="Administrar Productos">
                                    <i class="bi bi-gear"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Central de Abasto</label>
                            <div class="input-group">
                                <select class="form-select" name="central" required>
                                    <option value="">Seleccione la Central...</option>
                                    <option>CEDA Iztapalapa</option>
                                    <option>CEDA Guadalajara</option>
                                </select>
                                <button class="btn btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalGestionCentrales" title="Administrar Centrales">
                                    <i class="bi bi-gear"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Unidad (kg)</label>
                            <select class="form-select" name="unidad" required>
                                <option>Menudeo</option>
                                <option>Mayoreo</option>
                                <option>Medio mayoreo</option>
                            </select>
                        </div>

                       

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Precio Promedio</label>
                            <input type="number" class="form-control bg-info bg-opacity-10" name="precio_promedio" step="0.01" placeholder="0.00" required>
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
                            <select class="form-select">
                                <option>Aguacate Hass</option>
                                <option>Limón Persa</option>
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
                            <input type="number" step="0.01" class="form-control" value="65.50">
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
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Nombre de la Central (e.g., CEDA Monterrey)">
                        <button class="btn btn-primary" type="button"><i class="bi bi-plus-lg"></i> Agregar</button>
                    </div>
                    
                    <h6>Centrales Registradas</h6>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            CEDA Iztapalapa
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            CEDA Guadalajara
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button>
                        </li>
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
                    <div class="input-group mb-4">
                        <input type="text" class="form-control" placeholder="Nombre del Producto (e.g., Manzana Roja)">
                        <button class="btn btn-primary" type="button"><i class="bi bi-plus-lg"></i> Agregar</button>
                    </div>
                    
                    <h6>Productos Registrados</h6>
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Aguacate Hass
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Limón Persa
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-x-lg"></i></button>
                        </li>
                    </ul>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>