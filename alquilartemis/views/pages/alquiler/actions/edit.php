<?php 
if (isset($_POST['editSalida'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/alquileres.php?op=GetId";
  $data = array(
      'salida_id' => $_POST['edit']
  );
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  $salidas = json_decode($response, true);
  $salida = $salidas[0];

?>
<form action="" method="post">
            <div>
                <label for="">cliente_id</label>
                <input type="number" name="cliente_id_editado" value="<?php echo $salida['cliente_id']; ?>">
            </div>
            <div>
                <label for="">empleado_id</label>
                <input type="number" name="empleado_id_editado" value="<?php echo $salida['empleado_id']; ?>">
            </div>
            <div>
                <label for="">fecha_salida</label>
                <input type="date" name="fecha_salida_editado" value="<?php echo $salida['fecha_salida']; ?>">
            </div>
            <div>
                <label for="">hora_salida</label>
                <input type="datetime-local" name="hora_salida_editado" value="<?php echo $salida['hora_salida']; ?>">
            </div>
            <div>
                <label for="">subtotal_peso</label>
                <input type="number" name="subtotalPeso_editado" value="<?php echo $salida['subtotalPeso']; ?>">
            </div>
            <div>
                <label for="">placatransporte</label>
                <input type="text" name="placatransporte_editado" value="<?php echo $salida['placatransporte']; ?>">
            </div>
            <div>
                <label for="">observaciones</label>
                <input type="text" name="observaciones_editado" value="<?php echo $salida['observaciones']; ?>">
            </div>
            <input type="hidden" name="editando_id" value="<?php echo $salida['salida_id']; ?>">
            <input type="submit" value="Editar Alquiler" name="editarSalida">
        </form>
<?php } ?>
<?php
if (isset($_POST['editarSalida'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/alquileres.php?op=update";
    $data = array(
        'salida_id' => $_POST['editando_id'],
        'cliente_id' => $_POST['cliente_id_editado'], 
        'empleado_id' => $_POST['empleado_id_editado'], 
        'fecha_salida' => $_POST['fecha_salida_editado'],
        'hora_salida' => $_POST['hora_salida_editado'],
        'subtotalPeso' => $_POST['subtotalPeso_editado'],
        'placatransporte' => $_POST['placatransporte_editado'],
        'observaciones' => $_POST['observaciones_editado']
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

    echo "<script>alert('alquiler editado');document.location='alquiler'</script>";
}


?>


      