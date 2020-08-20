<?php

include_once "config.php";
include_once "entidades/venta.php";

$venta = new Venta();
$aVentas = $venta->obtenerTodos();
$aVentas = $venta->cargarGrilla();

//echo date_format(date_create($venta->fecha), "H:i");
include_once "header.php";

?>
                   <!-- Begin Page Content -->
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-4 text-gray-800 text-center">Listado de ventas</h1>
                        <table class="table table-hover border">
                            <tr>                             
                                <th>Fecha:</th>
                                <th>Cliente:</th>
                                <th>Producto:</th>
                                <th>Cantidad:</th>
                                <th>Total:</th>
                                <th class="text-center">Acciones:</th>
                            </tr>

                            <?php foreach ($aVentas as $venta) : ?>
                                <tr>
                                    <td><?php echo date_format(date_create($venta->fecha), "Y-m-d ");echo date_format(date_create($venta->fecha), "H:i");  ?></td>
                                    <td><?php echo $venta->nombre_cliente; ?></td>
                                    <td><?php echo $venta->nombre_producto; ?></td>
                                    <td style="padding-left: 43px;"><?php echo $venta->cantidad; ?></td>
                                    <td><?php echo $venta->total; ?></td>
                                    <td class="text-center"><a href="venta-formulario.php?id=<?php echo $venta->idventa; ?>"> <i class="fas fa-edit"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                            
                        </table>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
                <?php include_once("footer.php"); ?>