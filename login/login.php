<?php
session_start();

// Conexión a la base de datos (cambia los datos según tu configuración)
$host = 'localhost';
$dbname = 'innova';
$username = 'dni';
$password = 'MinuzaFea265/';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Validar datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username FROM usuarios WHERE username = :username AND password = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        // Inicio de sesión exitoso
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        echo json_encode(['success' => true]);
    } else {
        // Credenciales incorrectas
        echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
    }
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en la conexión a la base de datos']);
}
?>
