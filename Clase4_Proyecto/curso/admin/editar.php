<?php
session_start();
if(isset($_SESSION['email'])){
    echo "<br><br><a href=../?page=ingreso&salir=true>Salir del sistema</a>";

$idProducto = $_GET['idProducto'];
$datos = recuperarDatosProducto($idProducto);
if(isset($_POST['enviar'])){
    $rta = editarProducto($_POST);
    echo mostrarMensaje($rta);
}
?>
<h1>Editar producto</h1>
<div class="container">
    <section id="page">
        <div class="register">
            <div class="register-top-grid">
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="mation">
                        <span>Producto: <label>*</label></span>
                        <input type="text" name="nombre" value="<?= $datos['Nombre'] ?>">
                        <span>Precio: <label>*</label></span>
                        <input type="text" name="precio" value="<?= $datos['Precio'] ?>">
                        <span>Presentación: <label>*</label></span>
                        <input type="text" name="presentacion" value="<?= $datos['Presentacion'] ?>">
                        <span>Stock: <label>*</label></span>
                        <input type="text" name="stock" value="<?= $datos['Stock'] ?>">
                        <span>Marca: <label>*</label></span>

                        <select name="marca">
                            <?php
                            $row = listarMarcas();
                            foreach ($row as $valor) {
                                if ($valor['idMarca'] == $datos['Marca']) {
                            ?>
                                    <option value="<?= $valor['idMarca'] ?>" selected><?= $valor['Nombre'] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?= $valor['idMarca'] ?>"><?= $valor['Nombre'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select><br><br>
                        <span>Categoria: <label>*</label></span>
                        <select name="categoria">
                            <?php
                            include "conexion.php";
                            $sql = 'SELECT *FROM categorias';
                            $result = $conexion->prepare($sql);
                            $result->execute();
                            $row = $result->fetchAll();
                            foreach ($row as $valor) {
                                if ($valor['idCategoria'] == $datos['Categoria']) {
                            ?>
                                    <option value="<?= $valor['idCategoria'] ?>" selected><?= $valor['Nombre'] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?= $valor['idCategoria'] ?>"><?= $valor['Nombre'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select><br><br>
                        <span>Imagen: <label>*</label></span>
                        <input type="hidden" name="imagenActual" value="<?= $datos['Imagen'] ?>">
                        <input type="hidden" name="idProducto" value="<?= $datos['idProducto'] ?>">
                        <img src="../images/productos/<?= $datos['Imagen'] ?>" style="width:130px">
                        <input type="file" name="imagen">
                        <div class="register-but">
                            <input type="submit" value="Actualizar producto" name="enviar">
                        </div>
                    </div>
                </form>
            </div>
            <div class="clearfix"></div>
        </div>

    </section>
    <div class="clearfix"></div>
</div>
<?php
}else{
    header("location:../?page=ingreso&rta=0X017");
}
?>