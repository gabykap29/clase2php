<?php
session_start(); // Inicia la sesión

// Inicializar el saldo si no está en la sesión
if (!isset($_SESSION["saldo"])) {
    $_SESSION["saldo"] = 1000;
}

// Inicializar el estado de login
$login = isset($_SESSION["loggedin"]) ? $_SESSION["loggedin"] : false;
$user = "GENERICO";

// Manejar la lógica de retiro
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["monto"])) {
    $monto = $_POST["monto"];
    if ($monto > 0) {
        if ($monto > $_SESSION["saldo"]) {
            echo '<div class="alert alert-danger" role="alert">
                    No tienes suficiente saldo para realizar esta operación
                  </div>';
        } else {
            $_SESSION["saldo"] -= $monto; // Restar el monto del saldo en la sesión
            echo '<div class="alert alert-success" role="alert">
                    Retiro exitoso. Tu nuevo saldo es de $' .
                $_SESSION["saldo"] .
                '.
                  </div>';
        }
    }
}

// Manejar la lógica de depósito

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deposito"])) {
    $monto = $_POST["deposito"];
    if ($monto > 0) {
        $_SESSION["saldo"] += $monto; // Sumar el monto al saldo en la sesión
        echo '<div class="alert alert-success" role="alert">
                Deposito exitoso. Tu nuevo saldo es de $' .
            $_SESSION["saldo"] .
            '.
              </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cajero Automático con PHP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

    <div class="container">
        <div class="row">
        <?php if ($login == false) {
            echo '<div class="col-12" id="login">
                <h1>Cajero Automático</h1>
                <form action="clase_2_php.php" method="POST">
                    <div class="mb-3">
                        <label for="user" class="form-label">Usuario</label>
                        <input type="text" class="form-control" id="user" name="user">
                    </div>
                    <div class="mb-3">
                        <label for="pass" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="pass" name="pass">
                    </div>
                    <button type="submit" class="btn btn-primary">Ingresar</button>
                </form>
            </div>';
        } else {
            echo "<h1>Bienvenido $user</h1>";
            echo "<h2>Tu saldo es de $" . $_SESSION["saldo"] . "</h2>";
            echo '<div class="col-12">
                <h1>Cajero Automático</h1>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto a retirar</label>
                        <input type="number" class="form-control" id="monto" name="monto">
                    </div>
                    <button type="submit" class="btn btn-primary">Retirar</button>

                </form>
            </div>';
            #Depositar
            echo '<div class="col-12">
                <h1>Realizar un deposito</h1>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto a depositar</label>
                        <input type="number" class="form-control" id="deposito" name="deposito">
                    </div>
                    <button type="submit" class="btn btn-success">Depositar</button>

                </form>';
        } ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
