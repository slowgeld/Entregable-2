<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        $stmt = $conn->prepare("INSERT INTO registrotareas (nombre, apellido) VALUES (:nombre, :apellido)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);

        $stmt->execute();

        header("Location: entregable2-centroe.php");
        exit();
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
