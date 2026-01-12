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

    <?php include 'nav.php'; ?>

<section id="directorio-mayorista" class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-2 text-dark">
            Directorio CONACICA: Conecta tu Producción al Abasto
        </h2>
        <p class="text-center lead mb-5 text-muted">Encuentra distribuidores y mayoristas verificados en las principales Centrales de Abasto de México.</p>

        <div class="row justify-content-center mb-5">
            <div class="col-lg-10">
                <div class="card p-4 shadow">
                    <form class="row g-3 align-items-end">
                        
                        <div class="col-md-5">
                            <label for="search-input" class="form-label small fw-bold">Buscar Mayorista o Producto</label>
                            <input type="text" class="form-control" id="search-input" placeholder="Ej: Tomate Saladet, Distribuidora lil">
                        </div>

                        <div class="col-md-3">
                            <label for="filtro-producto" class="form-label small fw-bold">Categoría</label>
                            <select class="form-select" id="filtro-producto">
                                <option selected>Cualquier Categoría</option>
                                <option>Frutas</option>
                                <option>Verduras</option>
                                <option>Granos y Cereales</option>
                                </select>
                        </div>

                        <div class="col-md-3">
                            <label for="filtro-ubicacion" class="form-label small fw-bold">Ubicación</label>
                            <select class="form-select" id="filtro-ubicacion">
                                <option selected>Todas las Centrales</option>
                                <option>Ecatepec</option>
                                <option>Iztapalapa</option>
                                </select>
                        </div>

                        <div class="col-md-1">
                            <button type="submit" class="btn btn-success w-100">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <h3 class="fw-bold mb-4">Resultados de la Búsqueda</h3>
        
        <div class="row">
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body d-flex flex-column">
                        
                        <h5 class="card-title fw-bold text-conacica-green"> Mayorista "El Buen Campo"</h5>
                        <p class="mb-2 small">
                            <span class="badge bg-green">Distribuidor de Central</span>
                        </p>
                        
                        <ul class="list-unstyled small mb-3">
                            <li><i class="fas fa-map-marker-alt me-2 text-danger"></i> **Ubicación:** CEDA Ecatepec (Pasillo I)</li>
                            <li><i class="fas fa-seedling me-2 text-success"></i> **Especialidad:** Cítricos (Naranja, Limón) y Mango.</li>
                        </ul>
                        
                        <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                            
                            <button class="btn btn-sm btn-outline-secondary me-2" data-bs-toggle="modal" data-bs-target="#contactoModal1">
                                <i class="fas fa-phone"></i> Ver Teléfono
                            </button>
                            
                            <a href="#" class="btn btn-know-us btn-sm fw-bold">
                                Contactar (Email)
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            </div>
    </div>
</section>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>