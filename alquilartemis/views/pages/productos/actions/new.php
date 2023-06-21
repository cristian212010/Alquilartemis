<?php
if (isset($_POST['nuevoProducto'])) {
    $url = "http://localhost/Alquilartemis/apirest/controllers/productos.php?op=insert";
    $data = array(
        'nombre' => $_POST['nombre'], 
        'descripcion' => $_POST['descripcion'], 
        'precio' => $_POST['precio'],
        'stock' => $_POST['stock'],
        'categoria' => $_POST['categoria'],
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec ($ch);
    curl_close($ch);
    print $response;

    echo "<script>alert('Datos guardados');document.location='productos'</script>";
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear Productos
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
            <div>
                <label for="">nombre</label>
                <input type="text" name="nombre">
            </div>
            <div>
                <label for="">descripcion</label>
                <input type="text" name="descripcion">
            </div>
            <div>
                <label for="">precio</label>
                <input type="number" name="precio">
            </div>
            <div>
                <label for="">stock</label>
                <input type="number" name="stock">
            </div>
            <div>
                <label for="">categoria</label>
                <input type="text" name="categoria">
            </div>
            
            <input type="submit" value="enviar" name="nuevoProducto">
        </form>
      </div>
    </div>
  </div>
</div>
