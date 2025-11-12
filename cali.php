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
  <title>cali
    
  </title>
  <style>
    body {
      background: linear-gradient(135deg, #e6f0ff, #cce0ff);
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    fieldset {
      border: 2px solid #006400;
      border-radius: 10px;
      padding: 20px;
      background: #fff;
      box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
      max-width: 600px;
      margin: auto;
    }
    legend {
      font-size: 1.4em;
      color: #006400;
      font-weight: bold;
    }
    input[type=text], input[type=number] {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type=submit] {
      background-color: #006400;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type=submit]:hover {
      background-color: #004d00;
    }
    table {
      border-collapse: collapse;
      width: 100%;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: center;
    }
    th {
      background-color: #006400;
      color: white;
    }
    tfoot td {
      font-weight: bold;
      background-color: #e6ffe6;
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
      text-decoration: none;
      margin-top: 10px;
    }
    input[type=submit]:hover, a.boton:hover {
      background: linear-gradient(135deg, #0056b3, #007bff);
    }
  </style>
</head>
<body>

  <fieldset>
    <legend>Buscar Calificaciones del Alumno</legend>
    <form method="POST">
      <label>Ingrese el nombre del alumno:</label>
      <input type="text" name="nombre">

      <label>O su ID:</label>
      <input type="number" name="id">

      <input type="submit" value="Buscar">
    </form>
  </fieldset>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $id = trim($_POST['id'] ?? '');

    if (empty($nombre) && empty($id)) {
        echo "<p style='text-align:center; color:red;'>Debes ingresar el nombre o el ID del alumno.</p>";
    } else {
    
        if (!empty($id)) {
            $consultaAlumno = "SELECT * FROM alumno WHERE id_alumno = " . intval($id);
        } else {
            $consultaAlumno = "SELECT * FROM alumno WHERE nombre_alumno LIKE '%" . $conexion->real_escape_string($nombre) . "%'";
        }

        $resultadoAlumno = $conexion->query($consultaAlumno);

        if ($resultadoAlumno && $resultadoAlumno->num_rows > 0) {
            $alumno = $resultadoAlumno->fetch_assoc();

            echo "<div style='max-width:900px;margin:30px auto;background:#fff;padding:20px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.1)'>";
            echo "<h2 style='color:#006400;'>Información del Alumno</h2>";
            echo "<p><strong>ID:</strong> {$alumno['id_alumno']}</p>";
            echo "<p><strong>Nombre:</strong> {$alumno['nombre_alumno']} {$alumno['apellido_alumno']}</p>";

           
            $idAlumno = $alumno['id_alumno'];
            $consultaCalificaciones = "SELECT * FROM calificacion WHERE id_alumno = $idAlumno";
            $resultadoCalificaciones = $conexion->query($consultaCalificaciones);

            if ($resultadoCalificaciones && $resultadoCalificaciones->num_rows > 0) {
                echo "<h3>Calificaciones:</h3>";
                echo "<table>
                        <tr>
                          <th>Materia</th>
                          <th>Calificación</th>
                        </tr>";

                $suma = 0;
                $contador = 0;

                while ($cal = $resultadoCalificaciones->fetch_assoc()) {
                    $claveMateria = $cal['clave_materia'];
                    $consultaMateria = "SELECT nombre FROM materia WHERE clave_materia = '$claveMateria'";
                    $resultadoMateria = $conexion->query($consultaMateria);
                    $materia = ($resultadoMateria && $resultadoMateria->num_rows > 0)
                        ? $resultadoMateria->fetch_assoc()['nombre']
                        : 'Desconocida';

                    echo "<tr>
                            <td>$materia</td>
                            <td>{$cal['cali']}</td>
                          </tr>";

                    $suma += $cal['cali'];
                    $contador++;
                }

                $promedio = $contador > 0 ? round($suma / $contador, 2) : 0;

                echo "<tfoot>
                        <tr>
                          <td>Promedio General</td>
                          <td>$promedio</td>
                        </tr>
                      </tfoot>";
                echo "</table>";
            } else {
                echo "<p style='color:red;'>No hay calificaciones registradas para este alumno.</p>";
            }

            echo "</div>";
        } else {
            echo "<p style='text-align:center; color:red;'>No se encontró ningún alumno con esos datos.</p>";
        }
    }
}
$conexion->close();
?>
<div style="text-align:center;">
    <a href="index.html" class="boton">🏠 Regresar</a>
  </div>

</body>
</html>