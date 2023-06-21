<?php
if (isset($_POST['nuevoCliente'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/clientes.php?op=insert";
    $data = array(
        'nombre' => $_POST['nombre'], 
        'direccion' => $_POST['direccion'],
        'telefono' => $_POST['telefono'],
        'email' => $_POST['email'],
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST,true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); 
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec ($ch);
    curl_close($ch);
    print $response;

    echo "<script>alert('Datos guardados');document.location='clientes'</script>";
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Crear Cliente
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
                <label for="">direccion</label>
                <input type="text" name="direccion">
            </div>
            <div>
                <label for="">telefono</label>
                <input type="number" name="telefono">
            </div>
            <div>
                <label for="">email</label>
                <input type="text" name="email">
            </div>
           
            <input type="submit" value="enviar" name="nuevoCliente">
        </form>
      </div>
    </div>
  </div>
</div>
