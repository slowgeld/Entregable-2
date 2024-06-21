<?php
require_once __DIR__ . '/vendor/autoload.php';

use Mpdf\Mpdf;

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nombre']) && isset($_POST['apellido'])) {
    // Recuperar datos del formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $matematica = isset($_POST['matematica']) ? $_POST['matematica'] : 0;
    $comunicacion = isset($_POST['comunicacion']) ? $_POST['comunicacion'] : 0;
    $ciencias = isset($_POST['ciencias']) ? $_POST['ciencias'] : 0;
    $fisica = isset($_POST['fisica']) ? $_POST['fisica'] : 0;
    $quimica = isset($_POST['quimica']) ? $_POST['quimica'] : 0;

    if ($_POST['accion'] == 'generar_pdf') {
        // Crear un objeto mPDF
        $mpdf = new Mpdf();

        // Construir el contenido del PDF
        $html = "
        <h1>Informe de Tareas</h1>
        <p><strong>Nombre:</strong> $nombre</p>
        <p><strong>Apellido:</strong> $apellido</p>
        <h2>Tareas seleccionadas:</h2>
        <ul>
            <li>Matemática: " . ($matematica ? 'Seleccionado' : 'No seleccionado') . "</li>
            <li>Comunicación: " . ($comunicacion ? 'Seleccionado' : 'No seleccionado') . "</li>
            <li>Ciencias: " . ($ciencias ? 'Seleccionado' : 'No seleccionado') . "</li>
            <li>Física: " . ($fisica ? 'Seleccionado' : 'No seleccionado') . "</li>
            <li>Química: " . ($quimica ? 'Seleccionado' : 'No seleccionado') . "</li>
        </ul>
        ";

        // Añadir el contenido al PDF
        $mpdf->WriteHTML($html);

        // Nombre del archivo PDF descargable
        $filename = "Informe_Tareas_$nombre.pdf";

        // Generar el PDF y enviarlo para descarga
        $mpdf->Output($filename, 'D');
        exit; // Detener la ejecución del script después de enviar el PDF
    }

    // Si no se está generando el PDF, se puede continuar con otros procesos aquí
    // Por ejemplo, actualizar la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registros";

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Preparar la consulta SQL para actualizar los datos
        $stmt = $pdo->prepare("UPDATE registrotareas SET matematica=?, comunicacion=?, ciencias=?, fisica=?, quimica=? WHERE nombre=? AND apellido=?");
        $stmt->execute([$matematica, $comunicacion, $ciencias, $fisica, $quimica, $nombre, $apellido]);

        // No es necesario mostrar una alerta aquí porque ya se muestra con JavaScript
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrar tareas</title>
  <style>
    body {
      font-family: sans-serif;
    }
 
    form {
      width: 500px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
    }
 
    label {
      display: block;
      margin-bottom: 5px;
    }
 
    input,
    textarea {
      width: calc(100% - 16px); 
      padding: 8px;
      border: 1px solid #ccc;
      margin-bottom: 10px;
    }
 
    button {
      padding: 8px 15px;
      background-color: #007bff;
      color: white;
      border: none;
      cursor: pointer;
      margin-right: 10px;
    }
 
    .button-container {
      text-align: center;
      margin-top: 20px;
    }

    .checkbox-container {
      display: flex;
      align-items: center;
    }

  </style>
</head>
<body>
  <h1>Registrar tareas</h1>
 
  <form id="registroForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <?php
      // Recibir y mostrar nombre y apellido desde la URL
      $nombre = $_GET['nombre'] ?? '';
      $apellido = $_GET['apellido'] ?? '';

      echo "<label for='nombre'>Nombre:</label>";
      echo "<input type='text' id='nombre' name='nombre' value='$nombre' readonly>";

      echo "<label for='apellido'>Apellido:</label>";
      echo "<input type='text' id='apellido' name='apellido' value='$apellido' readonly>";
    ?>
    
    <label for="matematica">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Tarea 1</label><br>
    <div class="checkbox-container">
      <label for="matematica">Matemática:</label>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" id="matematica" name="matematica" value="1"><br>
    </div>
    <br>
    <div class="checkbox-container">
      <label for="comunicacion">Comunicación:</label>
      &nbsp;<input type="checkbox" id="comunicacion" name="comunicacion" value="1">
    </div>
    <br>
    <div class="checkbox-container">
      <label for="ciencias">Ciencias:</label>
      &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input type="checkbox" id="ciencias" name="ciencias" value="1">
    </div>
    <br>
    <div class="checkbox-container">
      <label for="fisica">Física:</label>
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="checkbox" id="fisica" name="fisica" value="1">
    </div>
    <br>
    <div class="checkbox-container">
      <label for="quimica">Química:</label>
      &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="checkbox" id="quimica" name="quimica" value="1">
    </div>
 
    <div class="button-container">
    <button type="submit" name="accion" value="generar_pdf">Crear</button> 
      <button type="button" id="guardarBtn">Guardar</button>
      <button type="button" id="regresarBtn">Regresar</button>
    </div>
  </form>

  <script>
    document.getElementById('guardarBtn').addEventListener('click', function() {
      var nombre = document.getElementById('nombre').value;
      var apellido = document.getElementById('apellido').value;
      var matematica = document.getElementById('matematica').checked ? 1 : 0;
      var comunicacion = document.getElementById('comunicacion').checked ? 1 : 0;
      var ciencias = document.getElementById('ciencias').checked ? 1 : 0;
      var fisica = document.getElementById('fisica').checked ? 1 : 0;
      var quimica = document.getElementById('quimica').checked ? 1 : 0;

      var xhr = new XMLHttpRequest();
      xhr.open('POST', '<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

      xhr.onload = function() {
        if (xhr.status >= 200 && xhr.status < 400) {
          alert('Sus tareas se han registrado con éxito.');
        } else {
          alert('Hubo un error al procesar la solicitud.');
        }
      };

      xhr.send('nombre=' + encodeURIComponent(nombre) +
               '&apellido=' + encodeURIComponent(apellido) +
               '&matematica=' + encodeURIComponent(matematica) +
               '&comunicacion=' + encodeURIComponent(comunicacion) +
               '&ciencias=' + encodeURIComponent(ciencias) +
               '&fisica=' + encodeURIComponent(fisica) +
               '&quimica=' + encodeURIComponent(quimica));
    });
  </script>


<script>
  document.getElementById('regresarBtn').addEventListener('click', function() {
    window.location.href = 'entregable2-centroe.php';
  });
</script>
</body>
</html>
