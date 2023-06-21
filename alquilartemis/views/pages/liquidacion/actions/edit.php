<?php 
if (isset($_POST['editLiquidacion'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/liquidacion.php?op=GetId";
  $data = array(
      'liquidacion_id' => $_POST['edit']
  );
  
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
  $response = curl_exec($ch);
  curl_close($ch);
  
  $empleados = json_decode($response, true);
  $empleado = $empleados[0];

?>
<form action="" method="post">
            <div>
                <label for="">cliente_id</label>
                <input type="number" name="cliente_idEditado" value="<?php echo $empleado['cliente_id']; ?>">
            </div>
            <div>
                <label for="">empleado_id</label>
                <input type="number" name="empleado_idEditado" value="<?php echo $empleado['empleado_id']; ?>">
            </div>
            <div>
                <label for="">salida_id</label>
                <input type="number" name="salida_idEditado" value="<?php echo $empleado['salida_id']; ?>">
            </div>
            <div>
                <label for="">entrada_id</label>
                <input type="number" name="entrada_idEditado" value="<?php echo $empleado['entrada_id']; ?>">
            </div>
            <div>
                <label for="">obra_id</label>
                <input type="number" name="obra_idEditado" value="<?php echo $empleado['obra_id']; ?>">
            </div>
            <div>
                <label for="">producto_id</label>
                <input type="number" name="producto_idEditado" value="<?php echo $empleado['producto_id']; ?>">
            </div>
            <input type="hidden" name="editando_liquidacion" value="<?php echo $empleado['liquidacion_id']; ?>">
            <input type="submit" value="Editar Empleado" name="editar_liquidacion">
        </form>
<?php } ?>
<?php
if (isset($_POST['editar_liquidacion'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/liquidacion.php?op=update";
    $data = array(
        'liquidacion_id' => $_POST['editando_liquidacion'],
        'cliente_id' => $_POST['cliente_idEditado'],
        'empleado_id' => $_POST['empleado_idEditado'], 
        'salida_id' => $_POST['salida_idEditado'], 
        'entrada_id' => $_POST['entrada_idEditado'],
        'obra_id' => $_POST['obra_idEditado'],
        'producto_id' => $_POST['producto_idEditado']
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

    echo "<script>alert('Empleado editado');document.location='liquidacion'</script>";
}


?>