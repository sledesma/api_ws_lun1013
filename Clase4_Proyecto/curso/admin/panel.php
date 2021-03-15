<?php
session_start();
if (isset($_SESSION['email'])) {
    echo "<br><br><a href=../?page=ingreso&salir=true>Salir del sistema</a>"
?>
    <div class="container">
        <?php
        //ELIMINAR PRODUCTOS
        if (isset($_GET['accion']) && $_GET['accion'] == 'eliminar') {
            $idProducto = $_GET['idProducto'];
            $imagen = $_GET['imagen'];
            $rta = eliminarProducto($idProducto, $imagen);
            echo mostrarMensaje($rta);
        }
        if (isset($_GET['accion']) && $_GET['accion'] == 'actualizarE') {
            $idProducto = $_GET['idProducto'];
            $estado = $_GET['estado'];
            $rta = actualizarEstado($idProducto, $estado);
            echo mostrarMensaje($rta);
        }
        ?>
        <br><br>
        <?php
        if ($_SESSION['tipo'] == 1) {
        ?>
            <h1>Gestión de productos Clientes</h1>
        <?php
        } elseif ($_SESSION['tipo'] == 2) {
        ?>
            <h1>Gestión de productos Admin</h1>

            <table border="1">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Presentación</th>
                    <th>Stock</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th>Imagen</th>
                    <th>Operaciones</th>
                </tr>

                <?php


                include "conexion.php";
                $sql = "SELECT p.idProducto,p.Nombre,p.Precio,p.Presentacion,p.Stock,p.Estado,p.Imagen,m.Nombre as marca,c.Nombre as categoria from productos p INNER JOIN marcas m ON p.Marca=m.idMarca INNER JOIN categorias c ON p.Categoria=c.idCategoria";
                $conexion->prepare($sql);
                foreach ($conexion->query($sql) as $row) {
                ?>
                    <tr>
                        <td><?= $row['idProducto']; ?></td>
                        <td><?= $row['Nombre']; ?></td>
                        <td><?= $row['Precio']; ?></td>
                        <td><?= $row['Presentacion']; ?></td>
                        <td><?= $row['Stock']; ?></td>
                        <td><?= $row['marca']; ?></td>
                        <td><?= $row['categoria']; ?></td>
                        <td><img src="../images/productos/<?= $row['Imagen']; ?>" style="width:30px"></td>
                        <td>
                            <?php

                            $estado = $row['Estado'] == 1 ? 'desactivar' : 'activar';

                            ?>
                            <a href="./?page=panel&accion=actualizarE&idProducto=<?= $row['idProducto']; ?>&estado=<?= $estado ?>"><?= $estado ?></a>

                            <a href="./?page=panel&accion=eliminar&idProducto=<?= $row['idProducto']; ?>&imagen=<?= $row['Imagen']; ?>" onclick="return confirm('¿Seguro que quieres eliminar el producto?')">eliminar</a>

                            <a href="?page=editar&idProducto=<?= $row['idProducto']; ?>"> editar</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        <?php } ?>
    </div>
<?php
} else {
    header("location:../?page=ingreso&rta=0X017");
}
?>