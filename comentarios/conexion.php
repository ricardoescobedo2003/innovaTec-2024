<?php
// Datos de conexión a la base de datos
$servername = "localhost"; // Cambiar si es necesario
$username = "dni"; // Cambiar por tu usuario de MySQL
$password = "MinuzaFea265/"; // Cambiar por tu contraseña de MySQL
$database = "innova"; // Nombre de tu base de datos

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
