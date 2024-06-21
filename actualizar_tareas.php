<?php
// Recibir datos del cuerpo de la solicitud
$data = json_decode(file_get_contents('php://input'), true);

// Configuración de la conexión PDO
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros";

try {
    // Crear conexión PDO
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Preparar y ejecutar consulta SQL para actualizar tareas
    $stmt = $pdo->prepare("UPDATE registrotareas SET matematica = ?, comunicacion = ?, ciencias = ?, fisica = ?, quimica = ? WHERE nombre = ? AND apellido = ?");
    $stmt->execute([$data['matematica'], $data['comunicacion'], $data['ciencias'], $data['fisica'], $data['quimica'], $data['nombre'], $data['apellido']]);

    // Enviar respuesta JSON al cliente
    echo json_encode(['success' => true]);
} catch(PDOException $e) {
    // Enviar respuesta de error en caso de fallo
    echo json_encode(['error' => $e->getMessage()]);
}
?>
