<?php
// Configuración de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Incluir base de datos y cabecera
require __DIR__ . '/../config/bd.php';
require __DIR__ . '/../template/cabecera.php';

// Función para subir imagen
function subirImagen($file, $imagenActual = null) {
    $directorio = $_SERVER['DOCUMENT_ROOT'] . '/olimpiada/img/productos/';
    if (!file_exists($directorio)) {
        mkdir($directorio, 0755, true);
    }

    if (!isset($file['error']) || $file['error'] === UPLOAD_ERR_NO_FILE) {
        return $imagenActual;
    }

    if ($file['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Error al subir la imagen.");
    }

    $extensiones = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($extension, $extensiones)) {
        throw new Exception("Extensión no válida.");
    }

    if ($file['size'] > 2097152) {
        throw new Exception("La imagen supera 2MB.");
    }

    $nombre = 'img_' . uniqid() . '.' . $extension;
    $destino = $directorio . $nombre;
    if (!move_uploaded_file($file['tmp_name'], $destino)) {
        throw new Exception("Error al guardar la imagen.");
    }

    if ($imagenActual && file_exists($directorio . $imagenActual)) {
        unlink($directorio . $imagenActual);
    }

    return $nombre;
}

// Lógica del formulario
$accion = $_POST['accion'] ?? '';
$id = $_POST['txtID'] ?? '';
$datos = [
    'nombre' => $_POST['txtNombre'] ?? '',
    'precio' => (float)($_POST['txtPrecio'] ?? 0),
    'lugar' => $_POST['txtLugar'] ?? '',
    'descripcion' => $_POST['txtDescripcion'] ?? '',
    'imagen' => $_POST['imagenActual'] ?? null,
];

try {
    $conexion->beginTransaction();
    
    switch ($accion) {
        case 'Agregar':
            $datos['imagen'] = subirImagen($_FILES['txtImagen'] ?? null);
            
            // Insertar en servicio_completo
            $stmt = $conexion->prepare("INSERT INTO servicio_completo (nombre, precio, lugar, descripcion, imagen) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $datos['nombre'],
                $datos['precio'],
                $datos['lugar'],
                $datos['descripcion'],
                $datos['imagen']
            ]);
            
            // Generar código único para el producto
            $codigo_producto = 'PKT-' . uniqid();
            
            // Insertar en productos
            $stmt = $conexion->prepare("INSERT INTO productos (codigo_producto, descripcion, tipo_producto, precio_unitario, imagen) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([
                $codigo_producto,
                $datos['descripcion'],
                'Paquete Turístico',
                $datos['precio'],
                $datos['imagen']
            ]);
            
            $_SESSION['mensaje'] = "Paquete agregado correctamente";
            $conexion->commit();
            header("Location: producto.php");
            exit;

        case 'Modificar':
            $datos['imagen'] = subirImagen($_FILES['txtImagen'] ?? null, $datos['imagen']);
            
            // Actualizar servicio_completo
            $stmt = $conexion->prepare("UPDATE servicio_completo SET nombre = ?, precio = ?, lugar = ?, descripcion = ?, imagen = ? WHERE id = ?");
            $stmt->execute([
                $datos['nombre'],
                $datos['precio'],
                $datos['lugar'],
                $datos['descripcion'],
                $datos['imagen'],
                $id
            ]);
            
            // Actualizar productos (asumiendo que producto_id es el mismo que id en servicio_completo)
            $stmt = $conexion->prepare("UPDATE productos SET descripcion = ?, precio_unitario = ?, imagen = ? WHERE producto_id = ?");
            $stmt->execute([
                $datos['descripcion'],
                $datos['precio'],
                $datos['imagen'],
                $id
            ]);
            
            $_SESSION['mensaje'] = "Paquete actualizado correctamente";
            $conexion->commit();
            header("Location: producto.php");
            exit;

        case 'borrar':
            // Obtener imagen primero
            $stmt = $conexion->prepare("SELECT imagen FROM servicio_completo WHERE id = ?");
            $stmt->execute([$id]);
            $imagen = $stmt->fetchColumn();
            
            // Eliminar de ambas tablas
            $conexion->prepare("DELETE FROM servicio_completo WHERE id = ?")->execute([$id]);
            $conexion->prepare("DELETE FROM productos WHERE producto_id = ?")->execute([$id]);
            
            // Eliminar imagen si existe
            if ($imagen && file_exists($_SERVER['DOCUMENT_ROOT'] . '/olimpiada/img/productos/' . $imagen)) {
                unlink($_SERVER['DOCUMENT_ROOT'] . '/olimpiada/img/productos/' . $imagen);
            }
            
            $_SESSION['mensaje'] = "Paquete eliminado correctamente";
            $conexion->commit();
            header("Location: producto.php");
            exit;

        case 'seleccionar':
            $stmt = $conexion->prepare("SELECT * FROM servicio_completo WHERE id = ?");
            $stmt->execute([$id]);
            $datos = $stmt->fetch();
            $conexion->commit();
            break;
            
        default:
            $conexion->commit();
            break;
    }
} catch (Exception $e) {
    $conexion->rollBack();
    $_SESSION['error'] = $e->getMessage();
}

// Obtener lista de paquetes
try {
    $stmt = $conexion->query("SELECT * FROM servicio_completo ORDER BY id DESC");
    $paquetes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $paquetes = [];
    $_SESSION['error'] = "Error al cargar paquetes: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Administrar Paquetes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Estilos CSS (mantener igual) -->
    <style>
    :root {
        --primary-dark: #1e293b;   /* Negro azulado oscuro */
        --primary-blue: #2563eb;   /* Azul principal */
        --accent-blue: #3b82f6;    /* Azul claro */
        --text-dark: #0f172a;      /* Negro para texto */
        --text-light: #f8fafc;     /* Blanco para texto sobre oscuro */
        --border-color: #e2e8f0;   /* Borde gris claro */
        --danger: #dc2626;         /* Rojo para acciones peligrosas */
        --warning: #d97706;        /* Naranja para advertencias */
        --success: #16a34a;        /* Verde para éxito */
        --border-radius: 6px;
        --box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        background-color: var(--primary-dark);
        color: var(--text-light);
        line-height: 1.6;
        padding: 20px;
        margin: 0;
    }

    .card {
        background: rgba(255, 255, 255, 0.05);
        border-radius: var(--border-radius);
        box-shadow: var(--box-shadow);
        margin-bottom: 30px;
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
    }

    .card-header {
        background: linear-gradient(135deg, var(--primary-blue), var(--primary-dark));
        color: var(--text-light);
        padding: 15px 25px;
        font-size: 1.2rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    form {
        padding: 25px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        font-weight: 500;
        color: var(--accent-blue);
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    input[type="text"],
    input[type="number"],
    textarea,
    input[type="file"] {
        width: 100%;
        padding: 12px 18px;
        margin-bottom: 25px;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--border-radius);
        background-color: rgba(0, 0, 0, 0.2);
        color: var(--text-light);
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    textarea:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.3);
        outline: none;
        background-color: rgba(0, 0, 0, 0.3);
    }

    textarea {
        min-height: 120px;
        resize: vertical;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 24px;
        border: none;
        border-radius: var(--border-radius);
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-right: 12px;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }

    .btn i {
        margin-right: 8px;
    }

    .btn-success {
        background-color: var(--success);
        color: white;
    }

    .btn-success:hover {
        background-color: #15803d;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(21, 128, 61, 0.2);
    }

    .btn-warning {
        background-color: var(--warning);
        color: white;
    }

    .btn-warning:hover {
        background-color: #b45309;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(217, 119, 6, 0.2);
    }

    .btn-secondary {
        background-color: transparent;
        color: var(--text-light);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-secondary:hover {
        background-color: rgba(255, 255, 255, 0.05);
        transform: translateY(-2px);
    }

    .btn-danger {
        background-color: var(--danger);
        color: white;
    }

    .btn-danger:hover {
        background-color: #b91c1c;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(220, 38, 38, 0.2);
    }

    .btn-primary {
        background-color: var(--primary-blue);
        color: white;
    }

    .btn-primary:hover {
        background-color: #1d4ed8;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(37, 99, 235, 0.2);
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 0.85rem;
    }

    .img-thumbnail {
        max-width: 200px;
        height: auto;
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: var(--border-radius);
        padding: 4px;
        background-color: rgba(0, 0, 0, 0.2);
        display: block;
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        background-color: rgba(0, 0, 0, 0.2);
        border-radius: var(--border-radius);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    th, td {
        padding: 15px 20px;
        text-align: left;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    th {
        background-color: var(--primary-blue);
        color: var(--text-light);
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        font-size: 0.85rem;
    }

    tr:hover {
        background-color: rgba(255, 255, 255, 0.03);
    }

    .alert {
        padding: 15px 20px;
        margin-bottom: 25px;
        border-radius: var(--border-radius);
        border-left: 4px solid transparent;
    }

    .alert-success {
        background-color: rgba(22, 163, 74, 0.15);
        color: #86efac;
        border-left-color: var(--success);
    }

    .alert-danger {
        background-color: rgba(220, 38, 38, 0.15);
        color: #fca5a5;
        border-left-color: var(--danger);
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    @media (max-width: 768px) {
        body {
            padding: 15px;
        }
        
        .card {
            margin-bottom: 20px;
        }
        
        form {
            padding: 20px;
        }
        
        th, td {
            padding: 12px 15px;
        }
        
        .btn {
            padding: 10px 18px;
            margin-bottom: 10px;
            width: 100%;
        }
        
        .action-buttons {
            flex-direction: column;
        }
    }
</style>
</head>
<body>

    <?php if(isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
    <?php endif; ?>
    <?php if(isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header">Datos del Paquete</div>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="txtID" value="<?= htmlspecialchars($id) ?>">
            <input type="hidden" name="imagenActual" value="<?= htmlspecialchars($datos['imagen'] ?? '') ?>">

            <label>Nombre del Paquete*</label>
            <input type="text" class="form-control" name="txtNombre" required value="<?= htmlspecialchars($datos['nombre'] ?? '') ?>">

            <label>Descripción*</label>
            <textarea class="form-control" name="txtDescripcion" required><?= htmlspecialchars($datos['descripcion'] ?? '') ?></textarea>

            <label>Lugar</label>
            <input type="text" class="form-control" name="txtLugar" value="<?= htmlspecialchars($datos['lugar'] ?? '') ?>">

            <label>Precio*</label>
            <input type="number" class="form-control" name="txtPrecio" step="0.01" value="<?= htmlspecialchars($datos['precio'] ?? '0.00') ?>">

            <label>Imagen</label>
            <input type="file" class="form-control" name="txtImagen" accept="image/*">
            <?php if (!empty($datos['imagen'])): ?>
                <img src="/olimpiada/img/productos/<?= htmlspecialchars($datos['imagen']) ?>" class="img-thumbnail mt-2">
            <?php endif; ?>

            <div class="mt-3">
                <button type="submit" name="accion" value="Agregar" class="btn btn-success">Agregar</button>
                <button type="submit" name="accion" value="Modificar" class="btn btn-warning">Modificar</button>
                <button type="submit" name="accion" value="Cancelar" class="btn btn-secondary">Cancelar</button>
            </div>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Lugar</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($paquetes as $paquete): ?>
                <tr>
                    <td><?= $paquete['id'] ?></td>
                    <td><?= htmlspecialchars($paquete['nombre']) ?></td>
                    <td><?= htmlspecialchars($paquete['lugar']) ?></td>
                    <td>$<?= number_format($paquete['precio'], 2) ?></td>
                    <td>
                        <form method="post" style="display:inline-block;">
                            <input type="hidden" name="txtID" value="<?= $paquete['id'] ?>">
                            <button type="submit" name="accion" value="seleccionar" class="btn btn-primary btn-sm">Editar</button>
                            <button type="submit" name="accion" value="borrar" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar este paquete?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>

<?php require __DIR__ . '/../template/pie.php'; ?>