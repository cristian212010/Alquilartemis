<?php
if (isset($_POST['nuevoAlquiler'])) {
    $url = "http://localhost/Alquilartemis/apirest/controllers/alquileres.php?op=insert";
    $data = array(
        'cliente_id' => $_POST['cliente_id'], 
        'empleado_id' => $_POST['empleado_id'], 
        'fecha_salida' => $_POST['fecha_salida'],
        'hora_salida' => $_POST['hora_salida'],
        'subtotalPeso' => $_POST['subtotalPeso'],
        'placatransporte' => $_POST['placatransporte'],
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

    echo "<script>alert('Datos guardados');document.location='alquiler'</script>";
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear Alquiler
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
              $url = "http://localhost/Alquilartemis/apirest/controllers/clientes.php?op=GetAll";
              $curl = curl_Init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              $clientes = json_decode(curl_exec($curl));
              curl_close($curl);
            ?>
            <div>
            <label for="">Cliente</label>
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
		            <?php
                    $url = "http://localhost/Alquilartemis/apirest/controllers/empleados.php?op=GetAll";
                    $curl = curl_Init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $empleados = json_decode(curl_exec($curl));
                    curl_close($curl);
                ?>
                <label for="">Empleado</label>
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

            <div>
                <label for="">fecha_salida</label>
                <input type="date" name="fecha_salida">
            </div>
            <div>
                <label for="">hora_salida</label>
                <input type="datetime-local" name="hora_salida">
            </div>
            <div>
                <label for="">Subtotal Peso</label>
                <input type="number" name="subtotalPeso">
            </div>
            <div>
                <label for="">Placa Transporte</label>
                <input type="text" name="placatransporte">
            </div>
            <div>
                <label for="">Observaciones</label>
                <input type="text" name="observaciones">
            </div>
            <input type="submit" value="enviar" name="nuevoAlquiler">
        </form>
      </div>
    </div>
  </div>
</div>
