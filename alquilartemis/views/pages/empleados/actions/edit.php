<?php 
if (isset($_POST['editEmpleado'])) {
  $url = "http://localhost/Alquilartemis/apirest/controllers/empleados.php?op=GetId";
  $data = array(
      'empleado_id' => $_POST['edit']
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
                <label for="">Nombre</label>
                <input type="text" name="nombreEditado" value="<?php echo $empleado['nombre']; ?>">
            </div>
            <div>
                <label for="">direccion</label>
                <input type="text" name="direccionEditado" value="<?php echo $empleado['direccion']; ?>">
            </div>
            <div>
                <label for="">telefono</label>
                <input type="number" name="telefonoEditado" value="<?php echo $empleado['telefono']; ?>">
            </div>
            <div>
                <label for="">email</label>
                <input type="text" name="emailEditado" value="<?php echo $empleado['email']; ?>">
            </div>
            <div>
                <label for="">cargo</label>
                <input type="text" name="cargoEditado" value="<?php echo $empleado['cargo']; ?>">
            </div>
            <div>
                <label for="">salario</label>
                <input type="number" name="salarioEditado" value="<?php echo $empleado['salario']; ?>">
            </div>
            <input type="hidden" name="editando_id" value="<?php echo $empleado['empleado_id']; ?>">
            <input type="submit" value="Editar Empleado" name="editarEmpleado">
        </form>
<?php } ?>
<?php
if (isset($_POST['editarEmpleado'])) {
    $url = "http://localhost/Alquilartemis/apiRest/controllers/empleados.php?op=update";
    $data = array(
        'empleado_id' => $_POST['editando_id'],
        'nombre' => $_POST['nombreEditado'], 
        'direccion' => $_POST['direccionEditado'], 
        'telefono' => $_POST['telefonoEditado'],
        'email' => $_POST['emailEditado'],
        'cargo' => $_POST['cargoEditado'],
        'salario' => $_POST['salarioEditado']
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

    echo "<script>alert('Empleado editado');document.location='empleados'</script>";
}


?>


      