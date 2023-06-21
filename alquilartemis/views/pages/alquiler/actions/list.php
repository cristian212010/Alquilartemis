<?php
$url = "http://localhost/Alquilartemis/apirest/controllers/alquileres.php?op=GetAll";
$curl = curl_Init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($curl));
curl_close($curl);

include "new.php";
include "newDetalle.php";
include "edit.php";
include "delete.php";
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
                    <th>HORA SALIDA</th>
                    <th>SUBTOTAL PESO</th>
                    <th>PLACA TRANSPORTE</th>
                    <th>OBSERVACIONES</th>
                    <th>DETALLES</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        foreach ($output as $out) 
                        {
                    ?>
                  <tr>
                    <td><?php echo $out->salida_id; ?></td>
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

                    <td><?php echo $out->fecha_salida; ?></td>
                    <td><?php echo $out->hora_salida; ?></td>
                    <td><?php echo $out->subtotalPeso; ?></td>
                    <td><?php echo $out->placatransporte; ?></td>
                    <td><?php echo $out->observaciones; ?></td>
                    <td> 
                      <form method="post" action="">
                            <input type="hidden" name="verDetalle" value="<?php echo $out->salida_id; ?>">
                            <input type="submit" value="Ver Detalle" name="detalle" class="btn btn-success">
                      </form>
                      <form method="post" action="">
                          <input type="hidden" name="salida_id" value="<?php echo $out->salida_id; ?>">
                          <input type="submit" value="Eliminar" name="eliminar" class="btn btn-danger">
                      </form>
                      <form method="post" action="">
                            <input type="hidden" name="edit" value="<?php echo $out->salida_id; ?>">
                            <input type="submit" value="Editar" name="editSalida" class="btn btn-warning">
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

            <?php include "listDetalle.php"; ?>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
