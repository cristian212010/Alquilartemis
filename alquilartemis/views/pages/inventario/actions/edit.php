<?php 
if (isset($_POST['editInventario'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/inventarios.php?op=GetId";
  $data = array(
      'inventario_id' => $_POST['edit']
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

?>
<form action="" method="post">
            <div>
                <label for="">producto_id</label>
                <input type="number" name="producto_id_editado" value="<?php echo $inventario['producto_id']; ?>">
            </div>
            <div>
                <label for="">CantidadInicial</label>
                <input type="number" name="CantidadInicial_editado" value="<?php echo $inventario['CantidadInicial']; ?>">
            </div>
            <div>
                <label for="">CantidadIngresos</label>
                <input type="number" name="CantidadIngresos_editado" value="<?php echo $inventario['CantidadIngresos']; ?>">
            </div>
            <div>
                <label for="">CantidadSalidas</label>
                <input type="number" name="CantidadSalidas_editado" value="<?php echo $inventario['CantidadSalidas']; ?>">
            </div>
            <div>
                <label for="">CantidadFinal</label>
                <input type="number" name="CantidadFinal_editado" value="<?php echo $inventario['CantidadFinal']; ?>">
            </div>
            <div>
                <label for="">FechaInventario</label>
                <input type="date" name="FechaInventario_editado" value="<?php echo $inventario['FechaInventario']; ?>">
            </div>
            <div>
                <label for="">TipoOperacion</label>
                <input type="text" name="TipoOperacion_editado" value="<?php echo $inventario['TipoOperacion']; ?>">
            </div>
            <input type="hidden" name="editando_id" value="<?php echo $inventario['inventario_id']; ?>">
            <input type="submit" value="Editar Inventario" name="editarInventario">
        </form>
<?php } ?>
<?php
if (isset($_POST['editarInventario'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/inventarios.php?op=update";
    $data = array(
        'inventario_id' => $_POST['editando_id'], 
        'producto_id' => $_POST['producto_id_editado'],
        'CantidadInicial' => $_POST['CantidadInicial_editado'], 
        'CantidadIngresos' => $_POST['CantidadIngresos_editado'], 
        'CantidadSalidas' => $_POST['CantidadSalidas_editado'],
        'CantidadFinal' => $_POST['CantidadFinal_editado'],
        'FechaInventario' => $_POST['FechaInventario_editado'],
        'TipoOperacion' => $_POST['TipoOperacion_editado']
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

    echo "<script>alert('Inventario editado');document.location='inventario'</script>";
}


?>


      