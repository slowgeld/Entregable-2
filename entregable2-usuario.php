<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro de usuario</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
 
    .container {
      width: 80%;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
    }
 
    .imagen-bienvenida {
      width: 100%;
      height: auto;
      margin-bottom: 20px;
    }
 
    form {
      width: 96%;
      padding: 20px;
      border: 1px solid #ccc;
    }
 
    label {
      display: block;
      margin-bottom: 5px;
    }
 
    input, textarea {
      width: 98%;
      padding: 8px;
      border: 1px solid #ccc;
    }
 
    button {
      background-color: #4CAF50;
      color: white;
      padding: 8px 15px;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="bienvenidos.png" alt="Bienvenido" class="imagen-bienvenida">
 
    <h1>Registrar usuario</h1>
 
    <form action="entregable2-datos1.php" method="post">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" required><br>
      <br>
      <label for="apellido">Apellido:</label>
      <input type="text" id="apellido" name="apellido" required><br>
       <br>
      <button type="submit">Guardar</button>
    </form>
  </div>
</body>
</html>