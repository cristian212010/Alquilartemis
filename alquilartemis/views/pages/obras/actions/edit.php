<?php 
if (isset($_POST['editObra'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/obras.php?op=GetId";
  $data = array(
      'obra_id' => $_POST['edit']
  );
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  $obras = json_decode($response, true);
  $obra = $obras[0];

?>
<form action="" method="post">
            <div>
                <label for="">cliente_id</label>
                <input type="number" name="cliente_id_editado" value="<?php echo $obra['cliente_id']; ?>">
            </div>
            <div>
                <label for="">nombre_obra</label>
                <input type="text" name="nombre_obra_editado" value="<?php echo $obra['nombre_obra']; ?>">
            </div>
            <div>
                <label for="">direccion</label>
                <input type="text" name="direccion_editado" value="<?php echo $obra['direccion']; ?>">
            </div>
            <div>
                <label for="">fechaInicio</label>
                <input type="date" name="fechaInicio_editado" value="<?php echo $obra['fechaInicio']; ?>">
            </div>
            <div>
                <label for="">fechaFin</label>
                <input type="date" name="fechaFin_editado" value="<?php echo $obra['fechaFin']; ?>">
            </div>
            <div>
                <label for="">presupuesto</label>
                <input type="number" name="presupuesto_editado" value="<?php echo $obra['presupuesto']; ?>">
            </div>
            <div>
                <label for="">estado</label>
                <input type="text" name="estado_editado" value="<?php echo $obra['estado']; ?>">
            </div>
           
            <input type="hidden" name="editando_id" value="<?php echo $obra['obra_id']; ?>">
            <input type="submit" value="Editar Obra" name="editarObra">
        </form>
<?php } ?>
<?php
if (isset($_POST['editarObra'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/obras.php?op=update";
    $data = array(
        'obra_id' => $_POST['editando_id'],
        'cliente_id' => $_POST['cliente_id_editado'], 
        'nombre_obra' => $_POST['nombre_obra_editado'],
        'direccion' => $_POST['direccion_editado'],
        'fechaInicio' => $_POST['fechaInicio_editado'],
        'fechaFin' => $_POST['fechaFin_editado'],
        'presupuesto' => $_POST['presupuesto_editado'],
        'estado' => $_POST['estado_editado'],
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

    echo "<script>alert('Obra editado');document.location='obras'</script>";
}


?>


      