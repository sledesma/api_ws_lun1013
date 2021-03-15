<?php
include_once 'admin/conexion.php';
function cargarPagina($page)
{
    $page = $page . ".php";
    include $page;
}
function mostrarMensaje($rta)
{
    switch ($rta) {
        case "0X001":
            $mensaje = "<strong style=color:red>Verifique el campo de nombre</strong>";
            break;
        case "0X002":
            $mensaje = "<strong style=color:red>Verifique el campo de email</strong>";
            break;
        case "0X003":
            $mensaje = "<strong style=color:red>Verifique el campo de mensaje</strong>";
            break;
        case "0X004":
            $mensaje = "<strong style=color:green>Contacto enviado correctamente</strong>";
            break;
        case "0X005":
            $mensaje = "<strong style=color:red>No se puede enviar el correo</strong>";
            break;
        case "0X006":
            $mensaje = "<strong style=color:green>Usuario registrado correctamente</strong>";
            break;
        case "0X007":
            $mensaje = "<strong style=color:red>No se puede registrar el usuario</strong>";
            break;
        case "0X008":
            $mensaje = "<strong style=color:green>Producto eliminado correctamente</strong>";
            break;
        case "0X009":
            $mensaje = "<strong style=color:red>No se puede eliminar el producto</strong>";
            break;
        case "0X010":
            $mensaje = "<strong style=color:green>Producto guardado correctamente</strong>";
            break;
        case "0X011":
            $mensaje = "<strong style=color:red>No se puede guardar el producto</strong>";
            break;
        case "0X012":
            $mensaje = "<strong style=color:green>Producto actualizado</strong>";
            break;
        case "0X013":
            $mensaje = "<strong style=color:red>No se puede actualizar el producto</strong>";
            break;
        case "0X014":
            $mensaje = "<strong style=color:red>Disculpe intente más tarde o contacte al administrador</strong>";
            break;
        case "0X015":
            $mensaje = "<strong style=color:red>Usuario no registrado</strong>";
            break;
        case "0X016":
            $mensaje = "<strong style=color:red>Datos incorrectos, no puede acceder</strong>";
            break;
        case "0X017":
            $mensaje = "<strong style=color:red>No puede acceder al admin sin datos de autorizado!</strong>";
            break;

        default:
            $mensaje = "No existe el código de error";
    }
    return $mensaje;
}

function mostrarProductos()
{
    $archivo = "listadoProductos.csv";
    if ($x = fopen($archivo, "r")) {
        while ($datos = fgetcsv($x, 1000, ",")) {

?>
            <div class="product-grid">
                <div class="content_box">
                    <a href="producto.php">
                        <div class="left-grid-view grid-view-left">
                            <img src="images/productos/<?= $datos[0]; ?>.jpg" class="img-responsive watch-right" alt="" />
                        </div>
                    </a>
                    <h4><a href="#"><?= $datos[1]; ?></a></h4>
                    <p>Marca: <?= $datos[4]; ?>, Capacidad: <?= $datos[5]; ?>, Stock <?= $datos[3]; ?> blablablabla</p>
                    <span>$<?= $datos[2] ?></span>
                </div>
            </div>
<?php
        }
        fclose($x);
    } else {
        echo "Error no puedo abrir el archivo";
    }
}

function registrarUsuario($nombre, $apellido, $email, $clave)
{
    try {
        global $conexion; //llamo a la conexión
        $clave = password_hash($clave, PASSWORD_DEFAULT);
        $sql = "INSERT INTO usuarios (nombre,apellido,email,clave) VALUES (?,?,?,?)";
        $result = $conexion->prepare($sql);
        $result->bindParam(1, $nombre, PDO::PARAM_STR);
        $result->bindParam(2, $apellido, PDO::PARAM_STR);
        $result->bindParam(3, $email, PDO::PARAM_STR);
        $result->bindParam(4, $clave, PDO::PARAM_STR);
        if ($result->execute()) {
            $rta = "0X006";
        } else {
            $rta = "0X007";
        }
        return $rta;
    } catch (PDOException $e) {
        echo "error" . $e->getMessage();
    } finally {
        $conexion = null;
    }
}


function eliminarProducto($idProducto, $imagen)
{
    try {
        global $conexion;
        $sql = "DELETE FROM productos WHERE idProducto=?";
        $result = $conexion->prepare($sql);
        $result->bindParam(1, $idProducto, PDO::PARAM_INT);
        $imagen = "../images/productos/" . $imagen;
        unlink($imagen);
        if ($result->execute()) {
            $rta = "0X008";
        } else {
            $rta = "0X009";
        }
        return $rta;
    } catch (PDOException $e) {
        echo "error" . $e->getMessage();
    } finally {
        $conexion = null;
    }
}

function guardarProducto($datos)
{
    global $conexion;
    $producto = $datos['producto'];
    $precio = $datos['precio'];
    $presentacion = $datos['presentacion'];
    $stock = $datos['stock'];
    $marca = $datos['marca'];
    $categoria = $datos['categoria'];
    $tmp_imagen = $_FILES["imagen"]["tmp_name"];
    $imagen = $_FILES["imagen"]["name"];
    $dir = "../images/productos";
    move_uploaded_file($tmp_imagen, "$dir/$imagen");
    $sql = "INSERT INTO productos (Nombre,Precio,Marca,Categoria,Presentacion,Stock,Imagen) VALUES (?,?,?,?,?,?,?)";
    $result = $conexion->prepare($sql);
    $result->bindParam(1, $producto, PDO::PARAM_STR);
    $result->bindParam(2, $precio, PDO::PARAM_STR);
    $result->bindParam(3, $marca, PDO::PARAM_INT);
    $result->bindParam(4, $categoria, PDO::PARAM_INT);
    $result->bindParam(5, $presentacion, PDO::PARAM_STR);
    $result->bindParam(6, $stock, PDO::PARAM_INT);
    $result->bindParam(7, $imagen, PDO::PARAM_STR);
    if ($result->execute()) {
        $rta = "0X010";
    } else {
        $rta = "0X011";
    }
    return $rta;
    // $imagenN=$datos

    /*echo $_FILES["imagen"]["type"];
    echo $_FILES["imagen"]["size"];
    echo $_FILES["imagen"]["name"];
    echo $_FILES["imagen"]["tmp_name"];
    echo $_FILES["imagen"]["error"];
   move_uploaded_file(nombre_temporal,directorio/nombre_imagen);
    */
}

function listarMarcas()
{
    global $conexion;
    try {
        $sql = 'SELECT *FROM marcas';
        $result = $conexion->prepare($sql);
        if ($result->execute()) {
            $datos = $result->fetchAll();
            return $datos;
        }
    } catch (PDOException $e) {
        echo "error" . $e->getMessage();
    } finally {
        $conexion = null;
    }
}

function actualizarEstado($idProducto, $estado)
{
    global $conexion;
    if ($estado == 'desactivar') {
        $estado = 0;
    } else {
        $estado = 1;
    }
    $sql = "UPDATE productos SET Estado=? WHERE idProducto=?";
    $result = $conexion->prepare($sql);
    $result->bindParam(1, $estado, PDO::PARAM_INT);
    $result->bindParam(2, $idProducto, PDO::PARAM_INT);
    if ($result->execute()) {
        $rta = "0X012";
    } else {
        $rta = "0X013";
    }
    return $rta;
}

function recuperarDatosProducto($idProducto)
{
    try {
        global $conexion;
        $sql = "SELECT *FROM productos WHERE idProducto=?";
        $result = $conexion->prepare($sql);
        $result->bindParam(1, $idProducto, PDO::PARAM_INT);
        if ($result->execute()) {
            $datos = $result->fetch();
            return $datos;
        }
    } catch (PDOException $e) {
        echo "error" . $e->getMessage();
    }
}

function editarProducto($datos)
{
    try {
        global $conexion;
        $idProducto = $datos['idProducto'];
        $nombre = $datos['nombre'];
        $precio = $datos['precio'];
        $presentacion = $datos['presentacion'];
        $stock = $datos['stock'];
        $marca = $datos['marca'];
        $categoria = $datos['categoria'];
        $imagenActual = $datos['imagenActual'];
        $imagen = ($_FILES['imagen']['name'] == '') ? $datos['imagenActual'] : $_FILES['imagen'];
        if (is_array($imagen)) {
            $nombreTmp = $imagen["tmp_name"];
            $dir = "../images/productos";
            $nombreImg = $imagen["name"];
            unlink("../images/productos/" . $imagenActual);
            move_uploaded_file($nombreTmp, "$dir/$nombreImg");
        } else {
            $nombreImg = $imagen;
        }
        $sql = "UPDATE productos SET Nombre = ?,Precio= ?,Marca = ?, Categoria = ?,Presentacion = ?, Stock = ?, Imagen = ? WHERE idProducto = ?";
        $result = $conexion->prepare($sql);
        $result->bindParam(1, $nombre, PDO::PARAM_STR);
        $result->bindParam(2, $precio, PDO::PARAM_STR);
        $result->bindParam(3, $marca, PDO::PARAM_INT);
        $result->bindParam(4, $categoria, PDO::PARAM_INT);
        $result->bindParam(5, $presentacion, PDO::PARAM_STR);
        $result->bindParam(6, $stock, PDO::PARAM_INT);
        $result->bindParam(7, $nombreImg, PDO::PARAM_STR);
        $result->bindParam(8, $idProducto, PDO::PARAM_INT);
        if ($result->execute()) {
            $rta = "0X012";
        } else {
            $rta = "0X013";
        }
        return $rta;
    } catch (PDOException $e) {
        echo "error" . $e->getMessage();
    } finally {
        $conexion = null;
    }
}

/*
session_start()
$_SESSION['nombre']
*/
function accederAdmin($email, $clave)
{
    global $conexion;
    $sql = "SELECT *FROM usuarios WHERE email=?";
    $result = $conexion->prepare($sql);
    $result->bindParam(1, $email, PDO::PARAM_STR);
    if ($result->execute()) {
        $datos = $result->fetch();
        if ($datos) {
            $claveC = $datos['clave'];
            $emailC = $datos['email'];
            $nombre = $datos['nombre'];
            $tipo = $datos['tipo'];
            if (password_verify($clave, $claveC)) {
                session_start();
                $_SESSION['email'] = $emailC;
                $_SESSION['nombre'] = $nombre;
                $_SESSION['tipo'] = $tipo;
                header("location:./admin/?page=panel");
            } else {
                header("location:./?page=ingreso&rta=0X016");
            }
        } else {
            header("location:./?page=ingreso&rta=0X015");
        }
    } else {
        header("location:./?page=ingreso&rta=0X014");
    }
}


function seleccionarProducto($idProducto)
{
    global $conexion;
    $sql = "SELECT *FROM productos WHERE idProducto=?";
    $result = $conexion->prepare($sql);
    $result->bindParam(1, $idProducto, PDO::PARAM_INT);
    if ($result->execute()) {
        $datos = $result->fetch();
    }
    return $datos;
}
