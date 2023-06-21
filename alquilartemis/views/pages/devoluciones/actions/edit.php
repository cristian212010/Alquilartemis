<?php 
if (isset($_POST['editEntrada'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/devoluciones.php?op=GetId";
  $data = array(
      'entrada_id' => $_POST['edit']
  );
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  $entradas = json_decode($response, true);
  $entrada = $entradas[0];

?>
<form action="" method="post">
            <div>
                <label for="">salida_id</label>
                <input type="number" name="salida_id_editado" value="<?php echo $entrada['salida_id']; ?>">
            </div>
            <div>
                <label for="">empleado_id</label>
                <input type="number" name="empleado_id_editado" value="<?php echo $entrada['empleado_id']; ?>">
            </div>
            <div>
                <label for="">cliente_id</label>
                <input type="number" name="cliente_id_editado" value="<?php echo $entrada['cliente_id']; ?>">
            </div>
            <div>
                <label for="">fecha_entrada</label>
                <input type="date" name="fecha_entrada_editado" value="<?php echo $entrada['fecha_entrada']; ?>">
            </div>
            <div>
                <label for="">hora_entrada</label>
                <input type="datetime-local" name="hora_entrada_editado" value="<?php echo $entrada['hora_entrada']; ?>">
            </div>
            <div>
                <label for="">observaciones</label>
                <input type="text" name="observaciones_editado" value="<?php echo $entrada['observaciones']; ?>">
            </div>
            
            <input type="hidden" name="editando_id" value="<?php echo $entrada['entrada_id']; ?>">
            <input type="submit" value="Editar Devolucion" name="editarEntrada">
        </form>
<?php } ?>
<?php
if (isset($_POST['editarEntrada'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/devoluciones.php?op=update";
    $data = array(
        'entrada_id' => $_POST['editando_id'],
        'salida_id' => $_POST['salida_id_editado'], 
        'empleado_id' => $_POST['empleado_id_editado'], 
        'cliente_id' => $_POST['cliente_id_editado'], 
        'fecha_entrada' => $_POST['fecha_entrada_editado'],
        'hora_entrada' => $_POST['hora_entrada_editado'],
        'observaciones' => $_POST['observaciones_editado'],
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

    echo "<script>alert('devolucion editado');document.location='devoluciones'</script>";
}


?>


      