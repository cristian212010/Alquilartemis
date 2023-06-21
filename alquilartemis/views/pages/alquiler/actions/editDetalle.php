<?php 
if (isset($_POST['editSalidaDetalle'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/salidaDetalles.php?op=GetId";
  $data = array(
      'salida_detalle_id' => $_POST['editDetalle']
  );
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  $salidasDetalle = json_decode($response, true);
  $salidaDetalle = $salidasDetalle[0];

?>
<form action="" method="post">
            <div>
                <label for="">salida_id</label>
                <input type="number" name="salida_id_editado" value="<?php echo $salidaDetalle['salida_id']; ?>">
            </div>
            <div>
                <label for="">producto_id</label>
                <input type="number" name="producto_id_editado" value="<?php echo $salidaDetalle['producto_id']; ?>">
            </div>
            <div>
                <label for="">empleado_id</label>
                <input type="number" name="empleado_id_editado" value="<?php echo $salidaDetalle['empleado_id']; ?>">
            </div>
            <div>
                <label for="">obra_id</label>
                <input type="number" name="obra_id_editado" value="<?php echo $salidaDetalle['obra_id']; ?>">
            </div>
            <div>
                <label for="">cantidad_salida</label>
                <input type="number" name="cantidad_salida_editado" value="<?php echo $salidaDetalle['cantidad_salida']; ?>">
            </div>
            <div>
                <label for="">cantidad_propia</label>
                <input type="number" name="cantidad_propia_editado" value="<?php echo $salidaDetalle['cantidad_propia']; ?>">
            </div>
            <div>
                <label for="">cantidad_subalquilada</label>
                <input type="number" name="cantidad_subalquilada_editado" value="<?php echo $salidaDetalle['cantidad_subalquilada']; ?>">
            </div>
            <div>
                <label for="">valorUnidad</label>
                <input type="number" name="valorUnidad_editado" value="<?php echo $salidaDetalle['valorUnidad']; ?>">
            </div>
            <div>
                <label for="">fecha_standBye</label>
                <input type="datetime-local" name="fecha_standBye_editado" value="<?php echo $salidaDetalle['fecha_standBye']; ?>">
            </div>
            <div>
                <label for="">estado</label>
                <input type="text" name="estado_editado" value="<?php echo $salidaDetalle['estado']; ?>">
            </div>
            <div>
                <label for="">valorTotal</label>
                <input type="number" name="valorTotal_editado" value="<?php echo $salidaDetalle['valorTotal']; ?>">
            </div>
            <input type="hidden" name="editando_detalle_salida_id" value="<?php echo $salidaDetalle['salida_detalle_id']; ?>">
            <input type="submit" value="Editar Alquiler" name="editarSalidaDetalle">
        </form>
<?php } ?>
<?php
if (isset($_POST['editarSalidaDetalle'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/salidaDetalles.php?op=update";
    $data = array(
        'salida_detalle_id' => $_POST['editando_detalle_salida_id'],
        'salida_id' => $_POST['salida_id_editado'],
        'producto_id' => $_POST['producto_id_editado'], 
        'empleado_id' => $_POST['empleado_id_editado'], 
        'obra_id' => $_POST['obra_id_editado'],
        'cantidad_salida' => $_POST['cantidad_salida_editado'],
        'cantidad_propia' => $_POST['cantidad_propia_editado'],
        'cantidad_subalquilada' => $_POST['cantidad_subalquilada_editado'],
        'valorUnidad' => $_POST['valorUnidad_editado'],
        'fecha_standBye' => $_POST['fecha_standBye_editado'],
        'estado' => $_POST['estado_editado'],
        'valorTotal' => $_POST['valorTotal_editado']
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