<?php
$conexion = new mysqli("localhost", "root", "", "alumnos");
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Insertar Calificación</title>
  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #a8edea, #fed6e3);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    fieldset {
      background: white;
      padding: 25px 40px;
      border-radius: 20px;
      border: 2px solid #ff4b2b;
      box-shadow: 0 5px 20px rgba(0,0,0,0.2);
      width: 420px;
      text-align: center;
    }
    legend {
      font-size: 1.5em;
      color: #ff416c;
      font-weight: bold;
    }
    select, input[type=number], input[type=submit], a {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      border-radius: 10px;
      border: 1px solid #ccc;
      font-size: 1em;
    }
    input[type=submit], a {
      background: linear-gradient(135deg, #ff416c, #ff4b2b);
      color: white;
      border: none;
      cursor: pointer;
      transition: 0.3s;
    }
    input[type=submit]:hover, a:hover {
      background: linear-gradient(135deg, #ff6a3d, #ff416c);
    }
    p { text-align: center; font-weight: bold; }
  </style>
</head>
<body>

<fieldset>
  <legend>insertar</legend>

  <form method="POST">
    <label>Selecciona un Alumno:</label>
    <select name="id_alumno" required>
      <option value="">-- Selecciona un alumno --</option>
      <?php
      $sql_alumnos = "SELECT id_alumno, nombre_alumno, apellido_alumno FROM alumno ORDER BY nombre_alumno";
      $resultado = $conexion->query($sql_alumnos);
      while ($fila = $resultado->fetch_assoc()) {
          echo "<option value='{$fila['id_alumno']}'>
                {$fila['nombre_alumno']} {$fila['apellido_alumno']}
                </option>";
      }
      ?>
    </select>

    <label>Selecciona una Materia:</label>
    <select name="clave_materia" required>
      <option value="">-- Selecciona una materia --</option>
      <?php
      $sql_materias = "SELECT clave_materia, nombre FROM materia ORDER BY nombre";
      $resultado2 = $conexion->query($sql_materias);
      while ($fila2 = $resultado2->fetch_assoc()) {
          echo "<option value='{$fila2['clave_materia']}'>{$fila2['nombre']}</option>";
      }
      ?>
    </select>

    <label>Ingresa la Calificación:</label>
    <input type="number" name="cali" min="0" max="10" step="0.1" placeholder="Ej. 8.5" required>

    <input type="submit" value="Guardar Calificación">
    <a href="index.html">🏠 Regresar</a>
  </form>
</fieldset>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_alumno = $_POST['id_alumno'];
    $clave_materia = $_POST['clave_materia'];
    $cali = $_POST['cali'];

    $consulta = "INSERT INTO calificacion (id_alumno, clave_materia, cali)
                 VALUES ('$id_alumno', '$clave_materia', '$cali')";

    if ($conexion->query($consulta) === TRUE) {
        echo "<p style='color:green;'>✅ Calificación guardada correctamente.</p>";
    } else {
        echo "<p style='color:red;'>❌ Error al guardar: " . $conexion->error . "</p>";
    }
}
$conexion->close();
?>

</body>
</html>