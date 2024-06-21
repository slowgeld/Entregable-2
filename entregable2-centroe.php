<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centro Educativo Virtual</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
 
        .container {
            width: 90%;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
 
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
 
        table {
            width: 100%;
            border-collapse: collapse;
        }
 
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
 
        th {
            background-color: #eee;
        }
 
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Centro Educativo Virtual</h1>
 
        <!-- Formulario de Búsqueda -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
 
            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" required>&nbsp; &nbsp; 
 
            <button type="submit" class="button">Buscar</button><br>
            <br>
        </form>
 
        <!-- Tabla para mostrar resultados -->
        <?php
        // Aquí va el código PHP para manejar la búsqueda y mostrar resultados
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['apellido'])) {
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

                // Preparar consulta SQL con parámetros para evitar inyección SQL
                $stmt = $pdo->prepare("SELECT nombre, apellido FROM registrotareas WHERE nombre LIKE ? OR apellido LIKE ?");
                $stmt->execute(["%$nombre%", "%$apellido%"]);
                $resultados = $stmt->fetchAll();

                if ($resultados) {
                    echo "<table>";
                    echo "<thead><tr><th>Nombre</th><th>Apellido</th><th>Acciones</th></tr></thead>";
                    echo "<tbody>";
                    foreach ($resultados as $fila) {
                        echo "<tr>";
                        echo "<td>{$fila['nombre']}</td>";
                        echo "<td>{$fila['apellido']}</td>";
                        echo "<td>
                               <a href='entregable2-registrar.php?nombre={$fila['nombre']}&apellido={$fila['apellido']}' class='button'>Registrar</a> 
                               <a href='entregable2-edicion.php?nombre={$fila['nombre']}&apellido={$fila['apellido']}' class='button'>Editar</a>
                        
                        <form action='entregable2-eliminar.php' method='post' style='display: inline;'>
                                <input type='hidden' name='nombre' value='{$fila['nombre']}'>
                                <input type='hidden' name='apellido' value='{$fila['apellido']}'>
                                <button type='submit' class='button'>Eliminar</button>
                            </form>
                        </td>";

                        echo"</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>No se encontraron resultados.</p>";
                }
            } catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }
        }
        ?>
    </div>
</body>
</html>
