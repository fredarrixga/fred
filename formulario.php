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
  <title>Iinsertar</title>
  <style>
    body {
      background: linear-gradient(135deg, #e6ffe6, #ccffcc);
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    fieldset {
      border: 2px solid #009933;
      border-radius: 10px;
      padding: 20px;
      background: #fff;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
    legend {
      font-size: 1.4em;
      color: #006600;
      font-weight: bold;
    }
    input[type=text], input[type=email], input[type=number], input[type=date], select {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type=submit], a.boton {
      background: linear-gradient(135deg, #28a745, #5cd65c);
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
      background: linear-gradient(135deg, #1e7e34, #4cd64c);
    }
    p {
      text-align: center;
    }
  </style>
</head>
<body>

  <fieldset>
    <legend>Insertar Nuevo Alumno</legend>
    <form method="POST">
      <label>ID del Alumno:</label>
      <input type="number" name="id_alumno" required>

      <label>Nombre:</label>
      <input type="text" name="nombre_alumno" required>

      <label>Apellido:</label>
      <input type="text" name="apellido_alumno" required>

      <label>Fecha de Nacimiento:</label>
      <input type="date" name="fecha_na" required>

      <label>Dirección:</label>
      <input type="text" name="direccion" required>

      <label>Teléfono:</label>
      <input type="text" name="telefono" required>

      <label>Email:</label>
      <input type="email" name="email" required>

      <label>Sexo:</label>
      <select name="sexo" required>
        <option value="">-- Selecciona --</option>
        <option value="Masculino">masculino</option>
        <option value="Femenino">femenino</option>
      </select>

      <input type="submit" value="Guardar Alumno">
    </form>
  </fieldset>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_alumno'];
    $nombre = $_POST['nombre_alumno'];
    $apellido = $_POST['apellido_alumno'];
    $fecha = $_POST['fecha_na'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $sexo = $_POST['sexo'];

    $consulta = "INSERT INTO alumno (id_alumno, nombre_alumno, apellido_alumno, fecha_na, direccion, telefono, email, sexo)
                 VALUES ('$id', '$nombre', '$apellido', '$fecha', '$direccion', '$telefono', '$email', '$sexo')";

    if ($conexion->query($consulta) === TRUE) {
        echo "<p style='color:green;'>✅ Alumno insertado correctamente.</p>";
    } else {
        echo "<p style='color:red;'>❌ Error al insertar: " . $conexion->error . "</p>";
    }
}
$conexion->close();
?>

  <div style="text-align:center;">
    <a href="fondo.html" class="boton">🏠 Regresar</a>
  </div>

</body>
</html>