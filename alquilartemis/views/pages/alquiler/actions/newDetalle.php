<?php
if (isset($_POST['nuevoDetalleAlquiler'])) {
    $url = "http://localhost/Alquilartemis/apirest/controllers/salidaDetalles.php?op=insert";
    $data = array(
        'salida_id' => $_POST['salida_id'], 
        'producto_id' => $_POST['producto_id'], 
        'empleado_id' => $_POST['empleado_id'],
        'obra_id' => $_POST['obra_id'],
        'cantidad_salida' => $_POST['cantidad_salida'],
        'cantidad_propia' =>$_POST['cantidad_propia'],
        'cantidad_subalquilada' =>$_POST['cantidad_subalquilada'],
        'valorUnidad' =>$_POST['valorUnidad'],
        'fecha_standBye' =>$_POST['fecha_standBye'],
        'estado' =>$_POST['estado'],
        'valorTotal' =>$_POST['valorTotal']
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

    $cantidad = intval($inventario['CantidadFinal']);
    $final = $cantidad - intval($_POST['cantidad_subalquilada']);

    $salidas = intval($inventario['CantidadSalidas']);
    $finalSalidas = $salidas + intval($_POST['cantidad_salida']);

    $url = "http://localhost/Alquilartemis/apiRest/controllers/inventarios.php?op=update";
    $data = array(
        'inventario_id' => $inventario['inventario_id'], 
        'producto_id' => $inventario['producto_id'],
        'CantidadInicial' => intval($inventario['CantidadInicial']), 
        'CantidadIngresos' => intval($inventario['CantidadIngresos']), 
        'CantidadSalidas' => $finalSalidas,
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

    echo "<script>alert('Datos guardados');document.location='alquiler'</script>";
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalDetalle">
  Crear Detalle Alquiler
</button>

<!-- Modal -->
<div class="modal fade" id="modalDetalle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    $url = "http://localhost/Alquilartemis/apirest/controllers/alquileres.php?op=GetAll";
                    $curl = curl_Init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $salidas = json_decode(curl_exec($curl));
                    curl_close($curl);
                ?>
                <label for="">SALIDA</label>
                <select name="salida_id">
                <option value="">seleccione Salida</option>
                <?php
                    foreach ($salidas as $salida) {
                    $salida_id = $salida->salida_id;
                    echo "<option value='" . intval($salida_id) . "'>$salida_id</option>";
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
                    $url = "http://localhost/Alquilartemis/apirest/controllers/empleados.php?op=GetAll";
                    $curl = curl_Init();
                    curl_setopt($curl, CURLOPT_URL, $url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $empleados = json_decode(curl_exec($curl));
                    curl_close($curl);
                ?>
                <label for="">EMPLEADOS</label>
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
                <label for="">cantidad_salida</label>
                <input type="number" name="cantidad_salida">
            </div>
            <div>
                <label for="">cantidad_propia</label>
                <input type="number" name="cantidad_propia">
            </div>
            <div>
                <label for="">cantidad_subalquilada</label>
                <input type="number" name="cantidad_subalquilada">
            </div>
            <div>
                <label for="">valorUnidad</label>
                <input type="number" name="valorUnidad">
            </div>
            <div>
                <label for="">fecha_standBye</label>
                <input type="datetime-local" name="fecha_standBye">
            </div>
            <div>
                <label for="">estado</label>
                <input type="text" name="estado">
            </div>
            <div>
                <label for="">valorTotal</label>
                <input type="text" name="valorTotal">
            </div>
            <input type="submit" value="enviar" name="nuevoDetalleAlquiler">
        </form>
      </div>
    </div>
  </div>
</div>