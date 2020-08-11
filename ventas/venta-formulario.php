
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
ini_set('error_reporting', E_ALL);

include_once "config.php";
include_once "entidades/venta.php";
include_once "entidades/cliente.php";
include_once "entidades/producto.php";

$venta = new Venta();
$venta->cargarFormulario($_REQUEST);

$cliente = new Cliente();
$aClientes = $cliente->obtenerTodos();

$producto = new Producto();
$aProductos = $producto->obtenerTodos();

if ($_POST) {
  if (isset($_POST["btnGuardar"])) {
    if (isset($_GET["id"]) && $_GET["id"] > 0) {
      $venta->actualizar();
    } else {
      $venta->insertar();
      $msg = "La venta se guardó correctamente";
    }
  } else if (isset($_POST["btnBorrar"])) {
    $venta->eliminar();
  }
}
if (isset($_GET["id"]) && $_GET["id"] > 0) {
  $venta->obtenerPorId();
}
if(isset($_GET["do"]) && $_GET["do"] == "buscarProducto"){
  $idProducto = $_GET["id"];
  $producto = new Producto();
  $producto->obtenerUnoPorId($idProducto);
  echo json_encode($producto->precio);
  exit;
}

include_once "header.php";
?>

          <!-- Begin Page Content -->
          <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Venta</h1>
            <div class="row">
              <div class="col-12 mb-3">
                <a href="venta-formulario.php" class="btn btn-primary mr-2">Nuevo</a>
                <button type="submit" class="btn btn-success mr-2" id="btnGuardar" name="btnGuardar">Guardar</button>
                <button type="submit" class="btn btn-danger" id="btnBorrar" name="btnBorrar">Borrar</button>
              </div>
            </div>
            <div class="row">
              <div class="col-6 form-group">
                <label for="txtNombre">Cliente:</label>
                <select required class="form-control" name="lstCliente" id="lstCliente">
                  <option value="" disabled selected>Seleccionar</option>
                  <?php foreach ($aClientes as $cliente) : ?>
                    <?php if ($cliente->idcliente == $venta->fk_idcliente) : ?>
                      <option selected value="<?php echo $cliente->idcliente; ?>"> <?php echo $cliente->nombre; ?></option>

                    <?php else : ?>
                      <option value="<?php echo $cliente->idcliente; ?>"> <?php echo $cliente->nombre; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="col-6 form-group">
                <label for="txtNombre">Producto:</label>
                <select onchange="fBuscarPrecioUnitario();" required class="form-control" name="lstProducto" id="lstProducto">
                  <option value="" disabled selected>Seleccionar</option>
                  <?php foreach ($aProductos as $producto) : ?>
                    <?php if ($producto->idproducto == $venta->fk_idproducto) : ?>
                      <option selected value="<?php echo $producto->idproducto; ?>"> <?php echo $producto->nombre; ?></option>

                    <?php else : ?>
                      <option value="<?php echo $producto->idproducto; ?>"> <?php echo $producto->nombre; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>

                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-4 form-group">
                <label for="txtFecha">Fecha:</label>
                <input type="date" required class="form-control" name="txtFecha" id="txtFecha" value="<?php echo date_format(date_create($venta->fecha), "Y-m-d");  ?>">
              </div>
              <div class="col-4 form-group">
                <label for="txtHora">Hora:</label>
                <input type="time" required class="form-control" name="txtHora" id="txtHora" value="<?php echo date_format(date_create($venta->fecha), "H:i");  ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-6 form-group">
                <label for="txtCantidad">Cantidad:</label>
                <input type="number" onchange="fCalcularTotal();" required class="form-control" name="txtCantidad" id="txtCantidad" value="<?php echo $venta->cantidad ?>">
              </div>
              <div class="col-6 form-group">
                <label for="txtPrecioUnitario">Precio Unitario:</label>
                <input type="text" required class="form-control" name="txtPrecioUnitario" id="txtPrecioUnitario" value="<?php echo $venta->preciounitario ?>">
              </div>
            </div>
            <div class="row">
              <div class="col-4 form-group">
                <label for="txtTotal">Total:</label>
                <input type="number" class="form-control" name="txtTotal" id="txtTotal" value="<?php echo $venta->total ?>">
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