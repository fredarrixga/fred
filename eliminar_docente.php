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
  <title>Eliminar Docente</title>
  <style>
    body {
      background: linear-gradient(135deg, #ffe6e6, #ffd6d6);
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    fieldset {
      border: 2px solid #cc0000;
      border-radius: 10px;
      padding: 20px;
      background: #fff;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
    legend {
      font-size: 1.4em;
      color: #cc0000;
      font-weight: bold;
    }
    select {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type=submit], a.boton {
      background: linear-gradient(135deg, #cc0000, #ff4d4d);
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
      background: linear-gradient(135deg, #a30000, #ff1a1a);
    }
    p {
      text-align: center;
    }
  </style>
</head>
<body>

  <fieldset>
    <legend>Eliminar Docente</legend>
    <form method="POST">
      <label>Selecciona el docente que deseas eliminar:</label>
      <select name="DNI_docente" required>
        <option value="">-- Selecciona un docente --</option>
        <?php
        $consulta = "SELECT DNI_docente, nombre_docente, apellido_docente FROM docente";
        $resultado = $conexion->query($consulta);
        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                echo "<option value='" . $fila['DNI_docente'] . "'>" . $fila['nombre_docente'] . " " . $fila['apellido_docente'] . " (ID: " . $fila['DNI_docente'] . ")</option>";
            }
        } else {
            echo "<option disabled>No hay docentes registrados</option>";
        }
        ?>
      </select>

      <input type="submit" value="Eliminar Docente">
    </form>
  </fieldset>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dni = $_POST['DNI_docente'];

    if (!empty($dni)) {
        $consulta = "DELETE FROM docente WHERE DNI_docente = '$dni'";
        if ($conexion->query($consulta) === TRUE) {
            if ($conexion->affected_rows > 0) {
                echo "<p style='color:green;'>✅ Docente eliminado correctamente.</p>";
            } else {
                echo "<p style='color:red;'>❌ No se encontró el docente seleccionado.</p>";
            }
        } else {
            echo "<p style='color:red;'>❌ Error al eliminar: " . $conexion->error . "</p>";
        }
    } else {
        echo "<p style='color:red;'>⚠ Debes seleccionar un docente.</p>";
    }
}
$conexion->close();
?>

  <div style="text-align:center;">
    <a href="fondo.html" class="boton">🏠 Regresar</a>
  </div>

</body>
</html>