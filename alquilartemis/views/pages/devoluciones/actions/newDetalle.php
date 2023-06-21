<?php
if (isset($_POST['nuevoDetalleAlquiler'])) {
    $url = "http://localhost/Alquilartemis/apirest/controllers/entradaDetalles.php?op=insert";
    $data = array(
        'entrada_id' => $_POST['entrada_id'], 
        'producto_id' => $_POST['producto_id'], 
        'obra_id' => $_POST['obra_id'],
        'entrada_cantidad' => $_POST['entrada_cantidad'],
        'entrada_cantidad_propia' => $_POST['entrada_cantidad_propia'],
        'entrada_cantidad_subalquilada' =>$_POST['entrada_cantidad_subalquilada'],
        'estado' =>$_POST['estado'],
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec ($ch);
    curl_close($ch);
    print $response;

    $url = "http://localhost/Alquilartemis/apirest/controllers/inventarios.php?op=GetId";
    $data = array(
        'inventario_id' => $_POST['producto_id']
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    
    $response = curl_exec($ch);
    curl_close($ch);
    
    $inventarios = json_decode($response, true);
    $inventario = $inventarios[0];

    $cantidad = intval($inventario['CantidadIngresos']);
    $finalEntradas = $cantidad + intval($_POST['entrada_cantidad']); 

    $cantidadEntrada = intval($inventario['CantidadFinal']);
    $final = $cantidadEntrada + intval($_POST['entrada_cantidad_propia']);

    $url = "http://localhost/Alquilartemis/apiRest/controllers/inventarios.php?op=update";
    $data = array(
        'inventario_id' => $inventario['inventario_id'], 
        'producto_id' => $inventario['producto_id'],
        'CantidadInicial' => intval($inventario['CantidadInicial']), 
        'CantidadIngresos' => $finalEntradas, 
        'CantidadSalidas' => intval($inventario['CantidadSalidas']),
        'CantidadFinal' => $final,
        'FechaInventario' => $inventario['FechaInventario'],
        'TipoOperacion' => $inventario['TipoOperacion']
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);

    echo "<script>alert('Datos guardados');document.location='devoluciones'</script>";
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetalleDevolucion">
  Crear Detalle Devoluciones
</button>


<!-- Modal -->
<div class="modal fade" id="modalDetalleDevolucion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
        <div>
                <?php
                    $url = "http://localhost/Alquilartemis/apirest/controllers/devoluciones.php?op=GetAll";
                    $curl = curl_Init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $entradas = json_decode(curl_exec($curl));
                    curl_close($curl);
                ?>
                <label for="">ENTRADAS</label>
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
            <div>
                <?php
                    $url = "http://localhost/Alquilartemis/apirest/controllers/productos.php?op=GetAll";
                    $curl = curl_Init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $productos = json_decode(curl_exec($curl));
                    curl_close($curl);
                ?>
                <label for="">PRODUCTOS</label>
                <select name="producto_id">
                <option value="">seleccione Producto</option>
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
                <?php
                    $url = "http://localhost/Alquilartemis/apirest/controllers/obras.php?op=GetAll";
                    $curl = curl_Init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $obras = json_decode(curl_exec($curl));
                    curl_close($curl);
                ?>
                <label for="">OBRAS</label>
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
            <div>
                <label for="">entrada_cantidad</label>
                <input type="number" name="entrada_cantidad">
            </div>
            <div>
                <label for="">entrada_cantidad_propia</label>
                <input type="number" name="entrada_cantidad_propia">
            </div>
            <div>
                <label for="">entrada_cantidad_subalquilada</label>
                <input type="number" name="entrada_cantidad_subalquilada">
            </div>
            <div>
                <label for="">estado</label>
                <input type="text" name="estado">
            </div>
            
            <input type="submit" value="enviar" name="nuevoDetalleAlquiler">
        </form>
      </div>
    </div>
  </div>
</div>