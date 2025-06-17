<?php
// Iniciar sesión para mensajes flash
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configurar rutas absolutas
$ruta_base = dirname(__DIR__); // Apunta a /administrador

// Incluir archivos necesarios
require $ruta_base . '/config/bd.php';
require $ruta_base . '/template/cabecera.php';

// Función para obtener URL de imágenes
function obtenerImagen($nombre_imagen) {
    if (empty($nombre_imagen)) {
        return '/olimpiada/img/productos/default.jpg';
    }
    return '/olimpiada/img/productos/' . $nombre_imagen;
}

// Obtener productos de la base de datos con información de servicio_completo
try {
    $stmt = $conexion->prepare("
        SELECT 
            p.producto_id,
            p.codigo_producto,
            p.descripcion,
            p.tipo_producto,
            p.precio_unitario,
            p.imagen,
            s.nombre AS nombre_paquete,
            s.lugar
        FROM productos p
        LEFT JOIN servicio_completo s ON p.producto_id = s.id
        WHERE p.imagen IS NOT NULL AND p.imagen != '' 
        ORDER BY p.producto_id DESC
    ");
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Error al obtener productos: " . $e->getMessage());
    $_SESSION['error'] = "Error al cargar los productos. Por favor, intente más tarde.";
    $productos = [];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paquetes Turísticos | Olimpiadas</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-fondo: #121212;
            --color-card: #1e1e1e;
            --color-primario: #0ea5e9;
            --color-texto: #ffffff;
            --color-error: #dc3545;
            --color-success: #28a745;
        }
        
        body {
            background-color: var(--color-fondo);
            color: var(--color-texto);
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        h1.titulo-principal {
            color: var(--color-primario);
            text-align: center;
            margin: 30px 0;
            font-size: 2.2rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .grid-productos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 25px;
            padding: 20px 0;
        }
        
        .card-producto {
            background-color: var(--color-card);
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        
        .card-producto:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
        }
        
        .card-imagen {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid var(--color-primario);
        }
        
        .card-body {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .card-titulo {
            font-size: 1.3rem;
            margin: 0 0 10px 0;
            color: var(--color-texto);
            font-weight: 600;
        }
        
        .card-badge {
            display: inline-block;
            background-color: var(--color-primario);
            color: #000;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-bottom: 12px;
            font-weight: bold;
            align-self: flex-start;
        }
        
        .card-lugar {
            font-size: 0.9rem;
            color: #aaa;
            margin-bottom: 8px;
        }
        
        .card-precio {
            font-size: 1.5rem;
            color: var(--color-primario);
            font-weight: bold;
            margin: 10px 0;
        }
        
        .card-codigo {
            font-size: 0.9rem;
            color: #aaa;
            margin-bottom: 15px;
        }
        
        .btn-consultar {
            display: inline-block;
            background-color: var(--color-primario);
            color: #000;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: all 0.3s;
            text-align: center;
            margin-top: auto;
        }
        
        .btn-consultar:hover {
            background-color: #38bdf8;
            transform: scale(1.02);
        }
        
        .mensaje-vacio {
            text-align: center;
            grid-column: 1 / -1;
            padding: 40px 20px;
            color: #aaa;
            font-size: 1.2rem;
            background-color: rgba(30, 30, 30, 0.5);
            border-radius: 10px;
        }
        
        .alert {
            padding: 15px 20px;
            border-radius: 5px;
            margin-bottom: 30px;
            font-weight: 500;
        }
        
        .alert-error {
            background-color: rgba(220, 53, 69, 0.2);
            border-left: 4px solid var(--color-error);
            color: #f8d7da;
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.2);
            border-left: 4px solid var(--color-success);
            color: #d4edda;
        }
        
        @media (max-width: 768px) {
            .grid-productos {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            
            h1.titulo-principal {
                font-size: 1.8rem;
                margin: 20px 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="titulo-principal">Paquetes Turísticos</h1>
        
        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <?php if(isset($_SESSION['mensaje'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['mensaje']) ?></div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>
        
        <?php if(empty($productos)): ?>
            <div class="mensaje-vacio">
                No hay paquetes disponibles en este momento.<br>
                Por favor, vuelva a intentarlo más tarde.
            </div>
        <?php else: ?>
            <div class="grid-productos">
                <?php foreach($productos as $producto): ?>
                <div class="card-producto">
                    <img src="<?= obtenerImagen($producto['imagen']) ?>" 
                         alt="<?= htmlspecialchars($producto['nombre_paquete'] ?? $producto['descripcion']) ?>" 
                         class="card-imagen"
                         loading="lazy">
                    
                    <div class="card-body">
                        <h3 class="card-titulo"><?= htmlspecialchars($producto['nombre_paquete'] ?? $producto['descripcion']) ?></h3>
                        <span class="card-badge"><?= htmlspecialchars($producto['tipo_producto']) ?></span>
                        <?php if(!empty($producto['lugar'])): ?>
                            <p class="card-lugar"><?= htmlspecialchars($producto['lugar']) ?></p>
                        <?php endif; ?>
                        <p class="card-precio">$<?= number_format($producto['precio_unitario'], 2) ?></p>
                        <p class="card-codigo">Código: <?= htmlspecialchars($producto['codigo_producto']) ?></p>
                        <a href="#" class="btn-consultar">Consultar Paquete</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>

<?php 
// Incluir pie de página
require $ruta_base . '/template/pie.php';
?>