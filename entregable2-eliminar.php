<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea eliminada</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .card {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            padding: 20px;
            width: 300px;
        }

        .card-header {
            background-color: #f0f0f0;
            border-bottom: 1px solid #ccc;
            padding: 10px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        .card-body {
            padding: 10px;
        }

        .card-footer {
            text-align: center;
            padding: 10px;
        }

        .button {
            background-color: #008CBA;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Tareas eliminada</h2>
        </div>
        <div class="card-body">
            <?php
            if (isset($_POST['nombre']) && isset($_POST['apellido'])) {
                echo "<p>Nombre: {$_POST['nombre']}</p>";
                echo "<p>Apellido: {$_POST['apellido']}</p>";
            }
            ?>
        </div>
        <div class="card-footer">
            <button class="button" onclick="window.location.href='entregable2-centroe.php'">Ok</button>
        </div>
    </div>
</body>
</html>

<?php
// Aquí va el código para actualizar las tareas a 0 en la base de datos
if (isset($_POST['nombre']) && isset($_POST['apellido'])) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];

    // Tu código PDO para la conexión y consulta a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registros";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar consulta SQL para actualizar las tareas a 0
        $stmt = $pdo->prepare("UPDATE registrotareas SET matematica = 0, comunicacion = 0, ciencias = 0, fisica = 0, quimica = 0 WHERE nombre = ? AND apellido = ?");
        $stmt->execute([$nombre, $apellido]);

        // Redirigir automáticamente después de 2 segundos
        //header("refresh:2;url=entregable2-eliminar.php");

    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>
