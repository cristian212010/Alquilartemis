<?php
$url = "http://localhost/Alquilartemis/apirest/controllers/salidaDetalles.php?op=GetAll";
$curl = curl_Init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$detalles = json_decode(curl_exec($curl));
curl_close($curl);

include "deleteDetalle.php";
include "editDetalle.php";
?>
<?php if (isset($_POST['detalle'])) { ?>
<section class="content">
      <div class="container-fluid">
        <h2>Detalle Alquiler ID: <?php echo $_POST['verDetalle'] ?></h2>
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- Button trigger modal -->

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>SALIDA ID</th>
                    <th>PRODUCTO</th>
                    <th>EMPLEADO</th>
                    <th>OBRA</th>
                    <th>CANTIDAD SALIDA</th>
                    <th>CANTIDAD PROPIA</th>
                    <th>CANTIDAD SUBALQUILADA</th>
                    <th>VALOR UNIDAD</th>
                    <th>FECHA STRANBYE</th>
                    <th>ESTADO</th>
                    <th>VALOR TOTAL</th>
                    <th>DETALLE</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        foreach ($detalles as $detalle) 
                        {
                            if ($detalle->salida_id==$_POST['verDetalle']) {
                                
                    ?>
                  <tr>
                    <td><?php echo $detalle->salida_detalle_id; ?></td>
                    <td><?php echo $detalle->salida_id; ?></td>
                    <?php $url = "http://localhost/Alquilartemis/apirest/controllers/productos.php?op=GetId";
                    $data = array(
                        'producto_id' => $detalle->producto_id
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                    $response = curl_exec($ch);
                    curl_close($ch);

                    $productos = json_decode($response, true);
                    $producto = $productos[0]; ?>
                    <td><?php echo $producto['nombre']; ?></td>
                    <?php $url = "http://localhost/Alquilartemis/apirest/controllers/empleados.php?op=GetId";
                    $data = array(
                        'empleado_id' => $detalle->empleado_id
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                    $response = curl_exec($ch);
                    curl_close($ch);

                    $empleados = json_decode($response, true);
                    $empleado = $empleados[0]; ?>
                    <td><?php echo $empleado['nombre']; ?></td>
                    <?php $url = "http://localhost/Alquilartemis/apirest/controllers/obras.php?op=GetId";
                    $data = array(
                        'obra_id' => $detalle->obra_id
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                    $response = curl_exec($ch);
                    curl_close($ch);

                    $obras = json_decode($response, true);
                    $obra = $obras[0]; ?>
                    <td><?php echo $obra['nombre_obra']; ?></td>
                    <td><?php echo $detalle->cantidad_salida; ?></td>
                    <td><?php echo $detalle->cantidad_propia; ?></td>
                    <td><?php echo $detalle->cantidad_subalquilada; ?></td>
                    <td><?php echo $detalle->valorUnidad; ?></td>
                    <td><?php echo $detalle->fecha_standBye; ?></td>
                    <td><?php echo $detalle->estado; ?></td>
                    <td><?php echo $detalle->valorTotal; ?></td>
                    <td> 
                      <form method="post" action="">
                          <input type="hidden" name="salida_id" value="<?php echo $detalle->salida_detalle_id; ?>">
                          <input type="submit" value="Eliminar" name="eliminarDetalle" class="btn btn-danger">
                      </form>
                      <form method="post" action="">
                            <input type="hidden" name="editDetalle" value="<?php echo $detalle->salida_detalle_id; ?>">
                            <input type="submit" value="Editar" name="editSalidaDetalle" class="btn btn-warning">
                      </form>

                    </td>
                  </tr>
                  <?php } } ?>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Rendering engine</th>
                    <th>Browser</th>
                    <th>Platform(s)</th>
                    <th>Engine version</th>
                    <th>CSS grade</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
      </div>
</section>
<?php } ?>