<?php

include_once "config.php";
include_once "entidades/tipo_producto.php";

$tipoproducto = new Tipoproducto();
$tipoproducto->cargarFormulario($_REQUEST);

if ($_POST) {
  if (isset($_POST["btnGuardar"])) {
    if (isset($_GET["id"]) && $_GET["id"] > 0) {
      $tipoproducto->actualizar();
    } else {
      $tipoproducto->insertar();
      $msg = "Guardado correctamente";
    }
  } else if (isset($_POST["btnBorrar"])) {
    $tipoproducto->eliminar();
  }
}
if (isset($_GET["id"]) && $_GET["id"] > 0) {
  $tipoproducto->obtenerPorId();
}

include_once "header.php";
?>

  <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Tipo de producto</h1>
            <div class="row">
              <div class="col-12 mb-3">
                <a href="tipoproducto-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
                <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
              </div>
            </div>
            <div class="row">
              <div class="col-6 form-group">
                <label for="txtNombre">Nombre:</label>
                <input type="text" required class="form-control" name="txtNombre" id="txtNombre" value="<?php echo $tipoproducto->nombre ?> ">
              </div>

            </div>
            <div class="row">
              <div class="col-12 text-center">
                <?php if (isset($msg)) : ?>
                  <div class="alert alert-info my-4 color" style="text-transform: uppercase; padding: 20px; margin: 223px; font-weight: bold;" role="alert">
                    <?php echo $msg; ?>

                  </div>
                <?php endif; ?>
              </div>
            </div>

          </div>
          <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <?php include_once("footer.php"); ?>