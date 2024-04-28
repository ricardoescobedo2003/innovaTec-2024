<?php
// Incluir archivo de conexión a la base de datos
include_once "conexion.php";

// Verificar si se recibió un ID de comentario válido
if (isset($_POST['idComentario'])) {
    $idComentario = $_POST['idComentario'];

    // Actualizar la cantidad de me gusta en la base de datos
    $sql = "UPDATE comentarios SET likes = likes + 1 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idComentario);

    if ($stmt->execute()) {
        // Obtener la cantidad actualizada de me gusta
        $sqlLikes = "SELECT likes FROM comentarios WHERE id = ?";
        $stmtLikes = $conexion->prepare($sqlLikes);
        $stmtLikes->bind_param("i", $idComentario);
        $stmtLikes->execute();
        $resultLikes = $stmtLikes->get_result();
        $row = $resultLikes->fetch_assoc();
        $likes = $row['likes'];

        // Devolver respuesta con la cantidad actualizada de me gusta
        echo json_encode(['status' => 'success', 'likes' => $likes]);
    } else {
        echo json_encode(['status' => 'error']);
    }

    // Cerrar conexión
    $stmt->close();
    $conexion->close();
} else {
    echo json_encode(['status' => 'error']);
}
?>
