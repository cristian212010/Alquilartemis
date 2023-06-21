<?php
if (isset($_POST['nuevaObra'])) {
    $url = "http://localhost/Alquilartemis/apirest/controllers/obras.php?op=insert";
    $data = array(
        'cliente_id' => $_POST['cliente_id'], 
        'nombre_obra' => $_POST['nombre_obra'], 
        'direccion' => $_POST['direccion'],
        'fechaInicio' => $_POST['fechaInicio'],
        'fechaFin' => $_POST['fechaFin'],
        'presupuesto' =>$_POST['presupuesto'],
        'estado' =>$_POST['estado']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec ($ch);
    curl_close($ch);
    print $response;

    echo "<script>alert('Datos guardados');document.location='obras'</script>";
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear Obra
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
                <label for="">nombre_obra</label>
                <input type="text" name="nombre_obra">
            </div>
            <div>
                <label for="">direccion</label>
                <input type="text" name="direccion">
            </div>
            <div>
                <label for="">fechaInicio</label>
                <input type="date" name="fechaInicio">
            </div>
            <div>
                <label for="">fechaFin</label>
                <input type="date" name="fechaFin">
            </div>
            <div>
                <label for="">presupuesto</label>
                <input type="number" name="presupuesto">
            </div>
            <div>
                <label for="">estado</label>
                <input type="text" name="estado">
            </div>
            <input type="submit" value="enviar" name="nuevaObra">
        </form>
      </div>
    </div>
  </div>
</div>
