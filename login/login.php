<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <section class="login">
        <div>
            <h2>Loguearse</h2>
            <form action="loguearEmpleado.php" method="post">
                <div>
                    <label for="">Email</label>
                    <input type="email" name="email">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="password">
                </div>
                <input type="submit" value="Enviar" name="loguearse">
            </form>
        </div>
        <div>
            <h2>Registrarse</h2>
            <form action="registrarEmpleado.php" method="post">
                <div>
                    <label for="">Nombre</label>
                    <input type="text" name="nombre">
                </div>
                <div>
                    <label for="">Direccion</label>
                    <input type="text" name="direccion">
                </div>
                <div>
                    <label for="">Telefono</label>
                    <input type="text" name="telefono">
                </div>
                <div>
                    <label for="">Cargo</label>
                    <input type="text" name="cargo">
                </div>
                <div>
                    <label for="">Salario</label>
                    <input type="text" name="salario">
                </div>
                <div>
                    <label for="">Email</label>
                    <input type="email" name="emailRegistro">
                </div>
                <div>
                    <label for="">Password</label>
                    <input type="password" name="passwordRegistro">
                </div>
                <input type="submit" value="Enviar" name="registrarse">
            </form>
        </div>
    </section>
</body>
</html>