<?php
$url = "http://localhost/Alquilartemis/apiRest/controllers/empleados.php?op=GetAll";
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
                    <th>NOMBRE</th>
                    <th>DIRECCION</th>
                    <th>TELEFONO</th>
                    <th>EMAIL</th>
                    <th>CARGO</th>
                    <th>SALARIO</th>
                    <th>DETALLE</th>
                  </tr>
                  </thead>
                  <tbody>
                      <?php
                          foreach ($output as $out) 
                          {
                      ?>
                    <tr>
                      <td><?php echo $out->empleado_id; ?></td>
                      <td><?php echo $out->nombre; ?></td>
                      <td><?php echo $out->direccion; ?></td>
                      <td><?php echo $out->telefono; ?></td>
                      <td><?php echo $out->email; ?></td>
                      <td><?php echo $out->cargo; ?></td>
                      <td><?php echo $out->salario; ?></td>
                      <td>
                        <form method="post" action="">
                            <input type="hidden" name="empleado_id" value="<?php echo $out->empleado_id; ?>">
                            <input type="submit" value="Eliminar" name="eliminar" class="btn btn-danger">
                        </form>
                        <?php include "delete.php"; ?>
                        <form method="post" action="">
                            <input type="hidden" name="edit" value="<?php echo $out->empleado_id; ?>">
                            <input type="submit" value="Editar" name="editEmpleado" class="btn btn-warning">
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
