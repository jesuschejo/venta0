<?php

include_once "config.php";
include_once "entidades/tipo_producto.php";

$tipoproducto = new Tipoproducto();
$aTipoProductos = $tipoproducto->obtenerTodos();

include_once "header.php";
?>

      <!-- Begin Page Content -->
          <div class="container-fluid">

        <!-- Page Heading -->
           <div class="row">
             <div class="col-6">
                <h1 class="h3 mb-4 text-gray-800 text-center">Listado de tipos de productos</h1>
                <a href="tipoproducto-formulario.php" class="btn btn-primary my-3 mr-2">Nuevo</a>
             <table class="table table-hover border">
            <tr>
                <th>Nombre:</th>
                <th>Acciones:</th>
            </tr>
            <?php foreach ($aTipoProductos as $tipo) { ?>
                <tr>
                    <td><?php echo $tipo->nombre; ?></a></td>
                    <td><a href="tipoproducto-formulario.php?id=<?php echo $tipo->idtipoproducto; ?>"><i class="fas fa-edit"></i></a></td>
                </tr>
                <?php } ?>
             </table>
             </div>

        </div>

       </div>
       <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

<?php include_once("footer.php"); ?>