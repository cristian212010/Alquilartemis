<?php
$url = "http://localhost/Alquilartemis/apirest/controllers/inventarios.php?op=GetAll";
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
                    <th>PRODUCTO</th>
                    <th>CANTIDAD INICIAL</th>
                    <th>CANTIDAD INGRESOS</th>
                    <th>CANTIDAD SALIDAS</th>
                    <th>CANTIDAD FINAL</th>
                    <th>FECHA INVENTARIO</th>
                    <th>TIPO OPERACION</th>
                    <th>DETALLES</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                        foreach ($output as $out) 
                        {
                    ?>
                  <tr>
                  <td><?php echo $out->inventario_id; ?></td>
                  
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

                    <td><?php echo $out->CantidadInicial; ?></td>
                    <td><?php echo $out->CantidadIngresos; ?></td>
                    <td><?php echo $out->CantidadSalidas; ?></td>
                    <td><?php echo $out->CantidadFinal; ?></td>
                    <td><?php echo $out->FechaInventario; ?></td>
                    <td><?php echo $out->TipoOperacion; ?></td>
                    <td>
                      <form method="post" action="">
                          <input type="hidden" name="inventario_id" value="<?php echo $out->inventario_id; ?>">
                          <input type="submit" value="Eliminar" name="eliminar" class="btn btn-danger">
                      </form>
                      <?php include "delete.php"; ?>

                      <form method="post" action="">
                            <input type="hidden" name="edit" value="<?php echo $out->inventario_id; ?>">
                            <input type="submit" value="Editar" name="editInventario" class="btn btn-warning">
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