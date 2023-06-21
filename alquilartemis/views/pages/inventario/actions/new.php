<?php
if (isset($_POST['nuevoInventario'])) {
    $url = "http://localhost/Alquilartemis/apirest/controllers/inventarios.php?op=insert";
    $data = array(
        'producto_id' => $_POST['producto_id'],
        'CantidadInicial' => $_POST['CantidadInicial'], 
        'CantidadIngresos' => $_POST['CantidadIngresos'], 
        'CantidadSalidas' => $_POST['CantidadSalidas'],
        'CantidadFinal' => $_POST['CantidadFinal'],
        'FechaInventario' => $_POST['FechaInventario'],
        'TipoOperacion' =>$_POST['TipoOperacion']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec ($ch);
    curl_close($ch);
    print $response;
    echo "<script>alert('Datos guardados');document.location='inventario'</script>"; 
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear Inventario
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo inventario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
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
            <div>
                <label for="">CantidadInicial</label>
                <input type="number" name="CantidadInicial">
            </div>
            <div>
                <label for="">CantidadIngresos</label>
                <input type="number" name="CantidadIngresos">
            </div>
            <div>
                <label for="">CantidadSalidas</label>
                <input type="number" name="CantidadSalidas">
            </div>
            <div>
                <label for="">CantidadFinal</label>
                <input type="number" name="CantidadFinal">
            </div>
            <div>
                <label for="">FechaInventario</label>
                <input type="date" name="FechaInventario">
            </div>
            <div>
                <label for="">TipoOperacion</label>
                <input type="text" name="TipoOperacion">
            </div>
          
            <input type="submit" value="enviar" name="nuevoInventario">
        </form>
      </div>
    </div>
  </div>
</div>
