<?php
$servername = "localhost";
$database = "alumnos";
$username = "root";
$password = "";

// Crear conexión
$conexion = mysqli_connect($servername, $username, $password, $database);

// Verificar conexión
if (!$conexion) {
    die("❌ Conexión fallida: " . mysqli_connect_error());
}
echo "✅ Conexión exitosa a la base de datos: " . $database . "<br>";
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Eliminar Alumno</title>
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fad0c4);
    background-size: 400% 400%;
    animation: fondoAnimado 10s ease infinite;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    color: #333;
    margin: 0;
  }

  fieldset {
    background: #fff;
    border: 3px solid #ff4b2b;
    border-radius: 25px;
    padding: 30px 45px;
    width: 420px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
    animation: aparecer 0.6s ease-in-out;
  }

  legend {
    font-size: 1.8em;
    font-weight: 700;
    color: #fff;
    background: linear-gradient(135deg, #ff416c, #ff4b2b);
    padding: 10px 20px;
    border-radius: 10px;
    box-shadow: 0 3px 10px rgba(255, 75, 43, 0.3);
  }

  label {
    display: block;
    margin-top: 15px;
    font-weight: 600;
    font-size: 1.05em;
  }

  select {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border: 2px solid #ccc;
    border-radius: 12px;
    font-size: 1em;
    outline: none;
    transition: 0.3s;
  }

  select:hover {
    border-color: #ff4b2b;
    background-color: #fff3f3;
  }

  select option:hover {
    background-color: #ff7a70;
    color: #fff;
  }

  input[type="submit"], a {
    display: inline-block;
    margin-top: 25px;
    padding: 10px 25px;
    border: none;
    background: linear-gradient(135deg, #ff4b2b, #ff416c);
    color: white;
    font-size: 1.05em;
    border-radius: 12px;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.2s ease, background 0.3s ease;
  }

  input[type="submit"]:hover, a:hover {
    background: linear-gradient(135deg, #ff6a3d, #ff416c);
    transform: scale(1.08);
  }

  a {
    margin-left: 10px;
    font-weight: 600;
  }

  @keyframes aparecer {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
  }

  @keyframes fondoAnimado {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
</style>
</head>
<body>

<fieldset>
  <legend>Eliminar Alumno</legend>
  
  <form method="post" action="">
    <label>Seleccionar Alumno a Eliminar:</label>
    <select name="id_alumno" required>
      <option value="">-- Selecciona un alumno --</option>
      <?php
      // Obtener alumnos desde la tabla alumno
      $sql = "SELECT id_alumno, nombre_alumno, apellido_alumno FROM alumno ORDER BY id_alumno";
      $resultado = mysqli_query($conexion, $sql);
      
      while ($fila = mysqli_fetch_assoc($resultado)) {
        echo "<option value='{$fila['id_alumno']}'>
              ID: {$fila['id_alumno']} - {$fila['nombre_alumno']} {$fila['apellido_alumno']}
              </option>";
      }
      ?>
    </select>
    
    <input type="submit" name="eliminar" value="Eliminar" onclick="return confirm('¿Estás seguro de que quieres eliminar este alumno?')">
    <a href="index.html">🏠 Regresar</a>
  </form>
</fieldset>

<?php
// Eliminar alumno si se envió el formulario
if (isset($_POST['eliminar'])) {
    $id_alumno = $_POST['id_alumno'];
    $sql_delete = "DELETE FROM alumno WHERE id_alumno = '$id_alumno'";
    
    if (mysqli_query($conexion, $sql_delete)) {
        echo "<p style='color:green; text-align:center;'>✅ Alumno eliminado correctamente.</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>❌ Error al eliminar el alumno: " . mysqli_error($conexion) . "</p>";
    }
}

mysqli_close($conexion);
?>

</body>
</html>