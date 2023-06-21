<?php
if (isset($_POST["loguearse"])) {
    require_once("Registro.php");

    $logueo = new Registro();
    $datos = $logueo-> verificacionLogin();

    $coincidencia = false;
    foreach ($datos as $empleados) {
        if ($empleados['email'] == $_POST['email'] && $empleados['password'] == $_POST['password']) {
            $coincidencia = true;
            header('Location: ../alquilartemis');
            exit();
        }
    }
    if (!$coincidencia) {
        echo "<script>alert('Usuario o contraseña incorrecto');document.location ='login.php'</script>";
    }
}
?>