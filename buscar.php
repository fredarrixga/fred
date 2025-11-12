<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>buscar</title>
  <style>
    body {
      background: linear-gradient(135deg, #f6063a 0%, #042eea 100%);
      text-align: center;
      font-family: Arial, sans-serif;
    }
    fieldset {
      margin: 40px auto;
      width: 60%;
      border-radius: 20px;
      background-color: rgba(255,255,255,0.3);
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      padding: 30px;
    }
    legend {
      color: rgb(0, 10, 7);
      font-family: cursive;
      font-size: 30px;
      background-color: rgba(255,255,255,0.7);
      padding: 10px 20px;
      border-radius: 10px;
    }
    label {
      display: block;
      margin: 15px auto;
      padding: 15px 30px;
      background-color: rgb(38, 131, 237);
      color: rgb(23, 22, 22);
      border: none;
      border-radius: 30px;
      font-size: 20px;
      width: fit-content;
    }
    input[type="number"],
    input[type="text"] {
      margin-bottom: 25px;
      background-color: rgb(237, 216, 253);
      border-radius: 8px;
      padding: 15px;
      font-size: 18px;
      border: none;
      width: 60%;
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
    .resultado {
      background-color: rgba(255,255,255,0.8);
      padding: 20px;
      width: 60%;
      margin: 20px auto;
      border-radius: 10px;
      text-align: left;
      font-size: 18px;
    }
  </style>
</head>
<body>

  <fieldset>
    <legend>BUSCAR ALUMNO POR ID O NOMBRE</legend>
    <form method="POST" action="">
      <label>INGRESA EL ID DEL ALUMNO:</label>
      <input type="number" name="id_alumno" placeholder="Ejemplo: 80039">
      
      <label>INGRESA EL NOMBRE DEL ALUMNO:</label>
      <input type="text" name="nombre_alumno" placeholder="Ejemplo: Fredi">
      
      <br>
      <input type="submit" value="Buscar">
      <a href="index.html" class="btn-regresar">Regresar</a>
    </form>
  </fieldset>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

   
    $conexion = new mysqli("localhost", "root", "", "alumnos");
    if ($conexion->connect_error) {
        die("<div class='resultado' style='color:red;'>Error de conexión: " . $conexion->connect_error . "</div>");
    }

    
    $id_alumno = $_POST["id_alumno"];
    $nombre = $_POST["nombre_alumno"];

   
    if (!empty($id_alumno)) {
        $sql = "SELECT * FROM alumno WHERE id_alumno = '$id_alumno'";
    } elseif (!empty($nombre)) {
        $nombre = $conexion->real_escape_string($nombre);
        $sql = "SELECT * FROM alumno WHERE nombre_alumno LIKE '%$nombre%'";
    } else {
        echo "<div class='resultado' style='color:red;'>❌ Por favor ingresa un ID o un nombre.</div>";
        exit;
    }

  
    $resultado = $conexion->query($sql);

    if ($resultado && $resultado->num_rows > 0) {
        echo "<div class='resultado'><h3>✅ Alumno(s) encontrado(s):</h3>";
        while ($fila = $resultado->fetch_assoc()) {
            echo "<strong>ID Alumno:</strong> " . $fila["id_alumno"] . "<br>";
            echo "<strong>Nombre:</strong> " . $fila["nombre_alumno"] . "<br>";
            echo "<strong>Apellido:</strong> " . $fila["apellido_alumno"] . "<br>";
            echo "<strong>Teléfono:</strong> " . $fila["telefono"] . "<br>";
            echo "<strong>Fecha de nacimiento:</strong> " . $fila["fecha_na"] . "<br>";
            echo "<strong>Dirección:</strong> " . $fila["direccion"] . "<br>";
            echo "<strong>Correo Electrónico:</strong> " . $fila["email"] . "<br>";
            echo "<strong>Sexo:</strong> " . $fila["sexo"] . "<br><hr>";
        }
        echo "</div>";
    } else {
        echo "<div class='resultado' style='color:red;'>❌ No se encontró ningún alumno con esos datos.</div>";
    }

    $conexion->close();
}
?>
</body>
</html>