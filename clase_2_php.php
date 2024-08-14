<?php
session_start(); // Inicia la sesión

// Verifica el inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["user"]) && isset($_POST["pass"])) {
        // Validar usuario y contraseña (esto es solo un ejemplo)
        $user = $_POST["user"];
        $pass = $_POST["pass"];
        if ($user == "GENERICO" && $pass == "1234") {
            $_SESSION["loggedin"] = true; // Establece la variable de sesión
        } else {
            $_SESSION["loggedin"] = false; // Establece la variable de sesión
        }
    }
}

// Redirigir a la página principal
header("Location: index.php");
exit();
