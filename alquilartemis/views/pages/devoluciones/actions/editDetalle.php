<?php 
if (isset($_POST['editentradaDetalle'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/entradaDetalles.php?op=GetId";
  $data = array(
      'entrada_detalle_id' => $_POST['editDetalle']
  );
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  $entradaDetalle = json_decode($response, true);
  $entradaDetalle = $entradaDetalle[0];

?>
<form action="" method="post">
            <div>
                <label for="">entrada_id</label>
                <input type="number" name="entrada_id_editado" value="<?php echo $entradaDetalle['entrada_id']; ?>">
            </div>
            <div>
                <label for="">producto_id</label>
                <input type="number" name="producto_id_editado" value="<?php echo $entradaDetalle['producto_id']; ?>">
            </div>
            <div>
                <label for="">obra_id</label>
                <input type="number" name="obra_id_editado" value="<?php echo $entradaDetalle['obra_id']; ?>">
            </div>
            <div>
                <label for="">entrada_cantidad</label>
                <input type="number" name="entrada_cantidad_editado" value="<?php echo $entradaDetalle['entrada_cantidad']; ?>">
            </div>
            <div>
                <label for="">entrada_cantidad_propia</label>
                <input type="number" name="entrada_cantidad_propia_editado" value="<?php echo $entradaDetalle['entrada_cantidad_propia']; ?>">
            </div>
            <div>
                <label for="">entrada_cantidad_subalquilada</label>
                <input type="number" name="entrada_cantidad_subalquilada_editado" value="<?php echo $entradaDetalle['entrada_cantidad_subalquilada']; ?>">
            </div>
            <div>
                <label for="">estado</label>
                <input type="text" name="estado_editado" value="<?php echo $entradaDetalle['estado']; ?>">
            </div>
            <div>
            <input type="hidden" name="editando_detalle_entrada_id" value="<?php echo $entradaDetalle['entrada_detalle_id']; ?>">
            <input type="submit" value="Editar Devolucion" name="editarentradaDetalle">
        </form>
<?php } ?>
<?php
if (isset($_POST['editarentradaDetalle'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/entradaDetalles.php?op=update";
    $data = array(
        'entrada_detalle_id' => $_POST['editando_detalle_entrada_id'],
        'entrada_id' => $_POST['entrada_id_editado'],
        'producto_id' => $_POST['producto_id_editado'], 
        'obra_id' => $_POST['obra_id_editado'],
        'entrada_cantidad' => $_POST['entrada_cantidad_editado'],
        'entrada_cantidad_propia' => $_POST['entrada_cantidad_propia_editado'],
        'entrada_cantidad_subalquilada' => $_POST['entrada_cantidad_subalquilada_editado'],
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

    echo "<script>alert('alquiler editado');document.location='devoluciones'</script>"; 
}


?>