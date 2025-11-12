<?php
$conexion = new mysqli("localhost", "root", "", "alumnos");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Insertar Nuevo Docente</title>
  <style>
    body {
      background: linear-gradient(135deg, #e67, #cce0ff);
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    fieldset {
      border: 2px solid #0056b3;
      border-radius: 10px;
      padding: 20px;
      background: #fff;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
    legend {
      font-size: 1.4em;
      color: #0056b3;
      font-weight: bold;
    }
    input[type=text], input[type=creditos], input[type=number], input[type=date] {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type=submit], a.boton {
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      margin-top: 10px;
    }
    input[type=submit]:hover, a.boton:hover {
      background: linear-gradient(135deg, #0056b3, #007bff);
    }
    p {
      text-align: center;
    }
  </style>
</head>
<body>

  <fieldset>
    <legend>Insertar Nueva Materia</legend>
    <form method="POST">
      <label>Clave de la materia:</label>
      <input type="number" name="clave_materia" required>

      <label>Nombre:</label>
      <input type="text" name="nombre" required>

      <label>Descripcion:</label>
      <input type="text" name="descripcion" required>

      <label>horas a la semana:</label>
      <input type="text" name="horas_semana" required>

      <label>creditos:</label>
      <input type="creditos" name="creditos" required>

    
      <input type="submit" value="Guardar Docente">
    </form>
  </fieldset>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['clave_materia'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['descripcion'];
    $horas_semana = $_POST['horas_semana'];
    $creditos = $_POST['creditos'];
   

    // Inserción en la tabla docente con fecha
    $consulta = "INSERT INTO materia (clave_materia, nombre, descripcion, horas_semana, creditos)
                 VALUES ('$dni', '$nombre', '$apellido', '$horas_semana', '$creditos')";

    if ($conexion->query($consulta) === TRUE) {
        echo "<p style='color:green;'>✅ Materia insertada correctamente.</p>";
    } else {
        echo "<p style='color:red;'>❌ Error al insertar: " . $conexion->error . "</p>";
    }
}
$conexion->close();
?>

  <div style="text-align:center;">
    <a href="index.html" class="boton">🏠 Regresar</a>
  </div>

</body>
</html>