<?php
$url = "http://localhost/Alquilartemis/apirest/controllers/productos.php?op=GetAll";
$curl = curl_Init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = json_decode(curl_exec($curl));
curl_close($curl);
?>

<?php
include "new.php";
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
                    <th>salida_id</th>
                    <th>producto_id</th>
                    <th>empleado_id</th>
                    <th>obra_id</th>
                    <th>cantidad_salida</th>
                    <th>cantidad_propia</th>
                    <th>cantidad_subalquilada</th>
                    <th>valorUnidad</th>
                    <th>fecha_standBye</th>
                    <th>estado</th>
                    <th>valorTotal</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        foreach ($output as $out) 
                        {
                    ?>
                  <tr>
                    <td><?php echo $out->salida_id; ?></td>
                    <td><?php echo $out->producto_id; ?></td>
                    <td><?php echo $out->empleado_id; ?></td>
                    <td><?php echo $out->obra_id; ?></td>
                    <td><?php echo $out->cantidad_salida; ?></td>
                    <td><?php echo $out->cantidad_propia; ?></td>
                    <td><?php echo $out->cantidad_subalquilada; ?></td>
                    <td><?php echo $out->valorUnidad; ?></td>
                    <td><?php echo $out->fecha_standBye; ?></td>
                    <td><?php echo $out->estado; ?></td>
                    <td><?php echo $out->valorTotal; ?></td>


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