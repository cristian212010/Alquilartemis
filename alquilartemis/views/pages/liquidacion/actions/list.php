<?php
$url = "http://localhost/Alquilartemis/apiRest/controllers/liquidacion.php?op=GetAll";
$curl = curl_Init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($curl));
curl_close($curl);
?>

<?php
include "new.php";
include "edit.php";
?>
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
                    <th>CLIENTE</th>
                    <th>EMPLEADO</th>
                    <th>FECHA SALIDA</th>
                    <th>FECHA ENTRADA</th>
                    <th>OBRA</th>
                    <th>PRODUCTO</th>
                    <th>Total PAGAR</th>
                    <th>DETALLE</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                          foreach ($output as $out) 
                          {
                      ?>
                    <tr>
                      <td><?php echo $out->liquidacion_id; ?></td>
                      <?php $url = "http://localhost/Alquilartemis/apirest/controllers/clientes.php?op=GetId";
                    $data = array(
                        'cliente_id' => $out->cliente_id
                    );

                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                    $response = curl_exec($ch);
                    curl_close($ch);

                    $clientes = json_decode($response, true);
                    $cliente = $clientes[0]; ?>
                      <td><?php echo $cliente['nombre']; ?></td>
                      <?php $url = "http://localhost/Alquilartemis/apirest/controllers/empleados.php?op=GetId";
                      $data = array(
                          'empleado_id' => $out->empleado_id
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

                        <?php $url = "http://localhost/Alquilartemis/apirest/controllers/alquileres.php?op=GetId";
                        $data = array(
                            'salida_id' => $out->salida_id
                        );

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                        $response = curl_exec($ch);
                        curl_close($ch);

                        $salidas = json_decode($response, true);
                        $salida = $salidas[0]; ?>
                        <td><?php echo $salida['hora_salida']; ?></td>

                        <?php $url = "http://localhost/Alquilartemis/apirest/controllers/devoluciones.php?op=GetId";
                        $data = array(
                            'entrada_id' => $out->entrada_id
                        );

                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

                        $response = curl_exec($ch);
                        curl_close($ch);

                        $entradas = json_decode($response, true);
                        $entrada = $entradas[0]; ?>
                        <td><?php echo $entrada['hora_entrada']; ?></td>

                      <?php $url = "http://localhost/Alquilartemis/apirest/controllers/obras.php?op=GetId";
                      $data = array(
                          'obra_id' => $out->obra_id
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
                      <?php $url = "http://localhost/Alquilartemis/apirest/controllers/productos.php?op=GetId";
                      $data = array(
                          'producto_id' => $out->producto_id
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



                      <?php
                      $fecha1 = DateTime::createFromFormat('Y-m-d H:i:s', $salida['hora_salida']);
                      $fecha2 = DateTime::createFromFormat('Y-m-d H:i:s', $entrada['hora_entrada']);
                      $diferencia = $fecha1->diff($fecha2);
                      $dias = $diferencia->days;
                      $horas = $diferencia->h;
                      $totalHoras = ($dias * 24) + $horas;
                      $url = "http://localhost/Alquilartemis/apirest/controllers/productos.php?op=GetId";
                      $data = array(
                          'producto_id' => $out->producto_id
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
                      $producto = $productos[0]; 
                      $precio = $totalHoras * $producto['precio'];
                      ?>
                      <td><?php echo $precio; ?></td>



                      <td>
                        <form method="post" action="">
                            <input type="hidden" name="liquidacion_id" value="<?php echo $out->liquidacion_id; ?>">
                            <input type="submit" value="Eliminar" name="eliminar" class="btn btn-danger">
                        </form>
                        <?php include "delete.php"; ?>
                        <form method="post" action="">
                            <input type="hidden" name="edit" value="<?php echo $out->liquidacion_id; ?>">
                            <input type="submit" value="Editar" name="editLiquidacion" class="btn btn-warning">
                        </form>

                      </td>

                    </tr>
                    <?php } ?>
                  
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

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>