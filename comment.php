<?php
// Verificar si se recibió un formulario de comentario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Incluir el archivo de conexión a la base de datos
    include_once "conexion.php";

    // Obtener los datos del formulario
    $nombre = $_POST['name'];
    $email = $_POST['email'];
    $comentario = $_POST['comment'];

    // Preparar la consulta para insertar el comentario en la base de datos
    $sql = "INSERT INTO comentarios (nombre, email, comentario) VALUES (?, ?, ?)";
    
    // Preparar la declaración y enlazar los parámetros
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sss", $nombre, $email, $comentario);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Comentario guardado correctamente
        echo "<script>alert('Comentario enviado correctamente');</script>";
        echo "<script>window.location.replace('/comentarios/index.html');</script>";
    } else {
        // Error al guardar el comentario
        echo "<script>alert('Error al enviar el comentario');</script>";
        echo "<script>window.location.replace('index.html');</script>";
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $conexion->close();
} else {
    // Redirigir si se intenta acceder directamente a este script sin enviar datos
    header("Location: /index.html");
    exit();
}
?>
