<?php
if (isset($_POST["registrarse"])) {
    require_once("Registro.php");

    $registro = new Registro();

    $registro->nombre = $_POST['nombre'];
    $registro->direccion = $_POST['direccion'];
    $registro->telefono = $_POST['telefono'];
    $registro->cargo = $_POST['cargo'];
    $registro->salario = $_POST['salario'];
    $registro->password = $_POST['passwordRegistro'];
    $registro->email = $_POST['emailRegistro'];

    $registro-> insertData();

    echo "<script>alert('Los datos fueron guardados satisfactoriamente');document.location='../alquilartemis'</script>";
}
?>