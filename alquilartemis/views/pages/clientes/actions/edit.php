<?php 
if (isset($_POST['editCliente'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/clientes.php?op=GetId";
  $data = array(
      'cliente_id' => $_POST['edit']
  );
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  $clientes = json_decode($response, true);
  $cliente = $clientes[0];

?>
<form action="" method="post">
            <div>
                <label for="">nombre</label>
                <input type="text" name="nombre_editado" value="<?php echo $cliente['nombre']; ?>">
            </div>
            <div>
                <label for="">direccion</label>
                <input type="text" name="direccion_editado" value="<?php echo $cliente['direccion']; ?>">
            </div>
            <div>
                <label for="">telefono</label>
                <input type="number" name="telefono_editado" value="<?php echo $cliente['telefono']; ?>">
            </div>
            <div>
                <label for="">email</label>
                <input type="text" name="email_editado" value="<?php echo $cliente['email']; ?>">
            </div>
           
            <input type="hidden" name="editando_id" value="<?php echo $cliente['cliente_id']; ?>">
            <input type="submit" value="Editar Cliente" name="editarCliente">
        </form>
<?php } ?>
<?php
if (isset($_POST['editarCliente'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/clientes.php?op=update";
    $data = array(
        'cliente_id' => $_POST['editando_id'],
        'nombre' => $_POST['nombre_editado'], 
        'direccion' => $_POST['direccion_editado'],
        'telefono' => $_POST['telefono_editado'],
        'email' => $_POST['email_editado'],
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

    $response = curl_exec($ch);
    curl_close($ch);
    print $response;

    echo "<script>alert('alquiler editado');document.location='clientes'</script>";
}


?>


      