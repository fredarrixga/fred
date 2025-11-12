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
      background: linear-gradient(135deg, #e6f0ff, #cce0ff);
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
    input[type=text], input[type=email], input[type=number], input[type=date] {
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
    <legend>Insertar Nuevo Docente</legend>
    <form method="POST">
      <label>ID del Docente:</label>
      <input type="number" name="DNI_docente" required>

      <label>Nombre:</label>
      <input type="text" name="nombre_docente" required>

      <label>Apellido:</label>
      <input type="text" name="apellido_docente" required>

      <label>Especialidad:</label>
      <input type="text" name="especialidad" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Fecha de Contrato:</label>
      <input type="date" name="fecha_contrato" required>

      <input type="submit" value="Guardar Docente">
    </form>
  </fieldset>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['DNI_docente'];
    $nombre = $_POST['nombre_docente'];
    $apellido = $_POST['apellido_docente'];
    $especialidad = $_POST['especialidad'];
    $email = $_POST['email'];
    $fecha_contrato = $_POST['fecha_contrato'];

    // Inserción en la tabla docente con fecha
    $consulta = "INSERT INTO docente (DNI_docente, nombre_docente, apellido_docente, especialidad, email, fecha_contrato)
                 VALUES ('$dni', '$nombre', '$apellido', '$especialidad', '$email', '$fecha_contrato')";

    if ($conexion->query($consulta) === TRUE) {
        echo "<p style='color:green;'>✅ Docente insertado correctamente.</p>";
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