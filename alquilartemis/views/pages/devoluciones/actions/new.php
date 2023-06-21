<?php
if (isset($_POST['nuevaDevolucion'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/devoluciones.php?op=insert";
    $data = array(
        'salida_id' => $_POST['salida_id'], 
        'alquiler_id' => $_POST['alquiler_id'], 
        'cliente_id' => $_POST['cliente_id'],
        'fecha_entrada' => $_POST['fecha_entrada'],
        'hora_entrada' => $_POST['hora_entrada'],
        'observaciones' =>$_POST['observaciones']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec ($ch);
    curl_close($ch);
    print $response;

    echo "<script>alert('Datos guardados');document.location='devoluciones'</script>";
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear Devolucion
</button>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">

              <?php
              $url = "http://localhost/Alquilartemis/apirest/controllers/alquileres.php?op=GetAll";
              $curl = curl_Init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              $alquileres = json_decode(curl_exec($curl));
              curl_close($curl);
              ?>
            <div>
                <label for="">Alquiler_id</label>
                <select name="salida_id">
              <option value="">seleccione alquiler</option>
              <?php
                foreach ($alquileres as $alquiler) {
                  $alquiler_id = $alquiler->salida_id;
                  echo "<option value='" . intval($alquiler_id) . "'>$alquiler_id</option>";
                }
              ?>
              </select>
            </div>


            <?php
              $url = "http://localhost/Alquilartemis/apirest/controllers/empleados.php?op=GetAll";
              $curl = curl_Init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              $empleados = json_decode(curl_exec($curl));
              curl_close($curl);
            ?>
            <div>
              <label for="">Empleado_id</label>
              <select name="empleado_id">
              <option value="">seleccione empleado</option>
              <?php
                foreach ($empleados as $empleado) {
                  $empleado_id = $empleado->empleado_id;
                  $nombre_empleado = $empleado->nombre;
                  echo "<option value='" . intval($empleado_id) . "'>$nombre_empleado</option>";
                }
              ?>
              </select>
            </div>


            <?php
              $url = "http://localhost/Alquilartemis/apirest/controllers/clientes.php?op=GetAll";
              $curl = curl_Init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              $clientes = json_decode(curl_exec($curl));
              curl_close($curl);
            ?>
            <div>
                <label for="">Cliente_Id</label>
                <select name="cliente_id">
              <option value="">seleccione cliente</option>
              <?php
                foreach ($clientes as $cliente) {
                  $cliente_id = $cliente->cliente_id;
                  $nombre_cliente = $cliente->nombre;
                  echo "<option value='" . intval($cliente_id) . "'>$nombre_cliente</option>";
                }
              ?>
              </select>
            </div>

            <div>
                <label for="">Fecha Entrada</label>
                <input type="date" name="fecha_entrada">
            </div>
            <div>
                <label for="">Hora Entrada</label>
                <input type="datetime-local" name="hora_entrada">
            </div>
            <div>
                <label for="">Observaciones</label>
                <input type="text" name="observaciones">
            </div>
            <input type="submit" value="enviar" name="nuevaDevolucion">
        </form>
      </div>
    </div>
  </div>
</div>
