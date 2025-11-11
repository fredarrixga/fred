<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>formulario</title>
  <style>
    body {
      background: linear-gradient(135deg, #f6063a 0%, #042eea 100%);
      box-shadow: 0 4px 6px rgba(0,0,0,0.1);
      text-align: center;
    }
    legend {
      color: rgb(0, 10, 7);
      margin-bottom: 20px;
      font-family: cursive;
      text-align: center;
      font-size: 30px;
    }
    label {
      display: inline-block;
      margin: 15px;
      padding: 15px 30px;
      background-color: rgb(38, 131, 237);
      color: rgb(23, 22, 22);
      border: none;
      border-radius: 30px;
      text-decoration: none;
      font-size: 20px;
      transition: background-color 0.3s;
    }
    input[type="text"],
    input[type="tel"] {
      margin-bottom: 25px;
      background-color: rgb(237, 216, 253);
      border-radius: 8px;
      padding: 15px;
    }
    input[type="submit"], .btn-regresar {
      border-radius: 8px;
      font-size: 20px;
      background-color: rgb(157, 141, 250);
      border-radius: 15% 20% 25%;
      margin-bottom: 20px;
      padding: 20px;
      margin: 15px;
      cursor: pointer;
      border: none;
      text-decoration: none;
      color: black;
      display: inline-block;
      transition: background-color 0.3s;
    }
    input[type="submit"]:hover,
    .btn-regresar:hover {
      background-color: rgb(121, 101, 243);
    }
    .mensaje {
      background-color: rgba(255,255,255,0.7);
      padding: 10px;
      margin: 15px auto;
      width: 50%;
      border-radius: 10px;
      font-family: sans-serif;
    }
  </style>
</head>
<body>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $edad = $_POST["edad"];
    $telefono = $_POST["telefono"];

 
    $conexion = new mysqli("localhost", "root", "", "alumnos");

    if ($conexion->connect_error) {
        echo "<div class='mensaje' style='color:red;'>Error de conexión: " . $conexion->connect_error . "</div>";
    } else {
        $sql = "INSERT INTO tabla (nombre, edad, telefono) VALUES ('$nombre', '$edad', '$telefono')";
        if ($conexion->query($sql) === TRUE) {
            echo "<div class='mensaje' style='color:green;'>✅ Datos insertados correctamente</div>";
        } else {
            echo "<div class='mensaje' style='color:red;'>❌ Error al insertar: " . $conexion->error . "</div>";
        }
        $conexion->close();
    }
}
?>

  <fieldset>
    <legend>FORMULARIO DE MUESTRA</legend>
    <form method="POST" action="">
      <label>NOMBRE DEL ALUMNO:</label>
      <input type="text" name="nombre" id="nombre" required placeholder="Nombre">
      <br><br>

      <label>EDAD DEL ALUMNO:</label>
      <input type="text" name="edad" id="edad" required placeholder="Número entero">
      <br><br>

      <label>TELÉFONO DEL ALUMNO:</label>
      <input type="tel" name="telefono" id="telefono" required placeholder="Ejem. 7293666701" minlength="10" maxlength="10">
      <br><br>

      <input type="submit" value="Enviar">
    </form>

  
    <a href="fondo.html" class="btn-regresar"> Regresar</a>
  </fieldset>

</body>
</html>