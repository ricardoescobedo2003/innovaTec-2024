<?php
// Incluir archivo de conexión a la base de datos
include_once "conexion.php";

// Obtener comentarios de la base de datos
$sql = "SELECT * FROM comentarios ORDER BY fecha DESC";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // Mostrar comentarios
    while ($fila = $resultado->fetch_assoc()) {
        $idComentario = $fila['id'];
        $nombre = $fila['nombre'];
        $comentario = $fila['comentario'];
        $fecha = date("d/m/Y H:i", strtotime($fila['fecha']));
        $likes = $fila['likes']; // Obtener cantidad de me gusta

        // HTML para mostrar el comentario y botón de me gusta
        echo "<div class='comentario'>";
        echo "<span class='nombre'>$nombre</span>";
        echo "<span class='fecha'>$fecha</span>";
        echo "<p class='mensaje'>$comentario</p>";
        echo "<button class='btn-like' data-id='$idComentario'>Me gusta ($likes)</button>";
        echo "</div>";
    }
} else {
    echo "<div class='comentario'>No hay comentarios disponibles.</div>";
}

// Cerrar conexión
$conexion->close();
?>
