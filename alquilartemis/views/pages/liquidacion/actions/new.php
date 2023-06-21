<?php
if (isset($_POST['nuevaLiquidacion'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/liquidacion.php?op=insert";
    $data = array(
        'cliente_id' => $_POST['cliente_id'], 
        'empleado_id' => $_POST['empleado_id'], 
        'salida_id' => $_POST['salida_id'],
        'entrada_id' => $_POST['entrada_id'],
        'obra_id' => $_POST['obra_id'],
        'producto_id' => $_POST['producto_id']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec ($ch);
    curl_close($ch);
    print $response;

    echo "<script>alert('Datos guardados');document.location='liquidacion'</script>";
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear Liquidacion
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
                <label for="">CLIENTE ID</label>
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


            <?php
              $url = "http://localhost/Alquilartemis/apirest/controllers/empleados.php?op=GetAll";
              $curl = curl_Init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              $empleados = json_decode(curl_exec($curl));
              curl_close($curl);
            ?>
            <div>
                <label for="">EMPLEADO ID</label>
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
              $url = "http://localhost/Alquilartemis/apirest/controllers/alquileres.php?op=GetAll";
              $curl = curl_Init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              $salidas = json_decode(curl_exec($curl));
              curl_close($curl);
            ?>
            <div>
                <label for="">SALIDA ID</label>
                <select name="salida_id">
              <option value="">seleccione sailda/alquiler</option>
              <?php
                foreach ($salidas as $salida) {
                  $salida_id = $salida->salida_id;
                  echo "<option value='" . intval($salida_id) . "'>$salida_id</option>";
                }
              ?>
              </select>
            </div>


            <?php
              $url = "http://localhost/Alquilartemis/apirest/controllers/devoluciones.php?op=GetAll";
              $curl = curl_Init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              $entradas = json_decode(curl_exec($curl));
              curl_close($curl);
            ?>
            <div>
                <label for="">ENTRADA ID</label>
                <select name="entrada_id">
              <option value="">seleccione entrada/devolucion</option>
              <?php
                foreach ($entradas as $entrada) {
                  $entrada_id = $entrada->entrada_id;
                  echo "<option value='" . intval($entrada_id) . "'>$entrada_id</option>";
                }
              ?>
              </select>
            </div>

            <?php
              $url = "http://localhost/Alquilartemis/apirest/controllers/obras.php?op=GetAll";
              $curl = curl_Init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              $obras = json_decode(curl_exec($curl));
              curl_close($curl);
            ?>
            <div>
                <label for="">OBRA ID</label>
                <select name="obra_id">
              <option value="">seleccione obra</option>
              <?php
                foreach ($obras as $obra) {
                  $obra_id = $obra->obra_id;
                  $nombre_obra = $obra->nombre_obra;
                  echo "<option value='" . intval($obra_id) . "'>$nombre_obra</option>";
                }
              ?>
              </select>
            </div>

            <?php
              $url = "http://localhost/Alquilartemis/apirest/controllers/productos.php?op=GetAll";
              $curl = curl_Init();
              curl_setopt($curl, CURLOPT_URL, $url);
              curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
              $productos = json_decode(curl_exec($curl));
              curl_close($curl);
            ?>
            <div>
                <label for="">PRODUCTO ID</label>
                <select name="producto_id">
              <option value="">seleccione producto</option>
              <?php
                foreach ($productos as $producto) {
                  $producto_id = $producto->producto_id;
                  $nombre_producto = $producto->nombre;
                  echo "<option value='" . intval($producto_id) . "'>$nombre_producto</option>";
                }
              ?>
              </select>
            </div>

            <input type="submit" value="enviar" name="nuevaLiquidacion">
        </form>
      </div>
    </div>
  </div>
</div>