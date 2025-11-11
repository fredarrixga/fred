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
  <title>Buscar Maestro</title>
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
    input[type=text], input[type=number] {
      width: 100%;
      padding: 8px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type=submit] {
      background-color: #0056b3;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    input[type=submit]:hover {
      background-color: #003d80;
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
      background-color: #0056b3;
      color: white;
    }
    a {
      color: #0056b3;
      text-decoration: none;
      margin-left: 10px;
      font-weight: 600;
      transition: color 0.3s;
    }
    a:hover {
      color: #8f94fb;
    }
    .bt {
      margin-top: 20px;
      text-align: center;
    }
    .boton {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background: linear-gradient(135deg, #4e54c8, #8f94fb);
      color: white;
      font-size: 1em;
      border-radius: 10px;
      text-decoration: none;
      transition: transform 0.2s ease, background 0.3s ease;
    }
    .boton:hover {
      background: linear-gradient(135deg, #0056b3, #007bff);
      transform: scale(1.05);
    }
  </style>
</head>
<body>

  <fieldset>
    <legend>Buscar Información del Docente</legend>
    <form method="POST">
      <label>Ingrese el nombre del docente:</label>
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
        echo "<p style='text-align:center; color:red;'>Debes ingresar el nombre o el ID del docente.</p>";
    } else {
        // Buscar al docente
        if (!empty($id)) {
            $consultaDocente = "SELECT * FROM docente WHERE DNI_docente = " . intval($id);
        } else {
            $consultaDocente = "SELECT * FROM docente WHERE nombre_docente LIKE '%" . $conexion->real_escape_string($nombre) . "%'";
        }

        $resultadoDocente = $conexion->query($consultaDocente);

        if ($resultadoDocente && $resultadoDocente->num_rows > 0) {
            $docente = $resultadoDocente->fetch_assoc();

            echo "<div style='max-width:900px;margin:30px auto;background:#fff;padding:20px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.1)'>";
            echo "<h2 style='color:#0056b3;'>Información del Docente</h2>";
            echo "<p><strong>ID:</strong> {$docente['DNI_docente']}</p>";
            echo "<p><strong>Nombre:</strong> {$docente['nombre_docente']}</p>";
             echo "<p><strong>Apellido:</strong> {$docente['apellido_docente']}</p>";
            echo "<p><strong>Especialidad:</strong> {$docente['especialidad']}</p>";
             echo "<p><strong>Email:</strong> {$docente['Email']}</p>";

          
            $dni = $docente['DNI_docente'];
            $consultaMaterias = "SELECT * FROM docente_materia WHERE DNI_docente = $dni";
            $resultadoMaterias = $conexion->query($consultaMaterias);

            if ($resultadoMaterias && $resultadoMaterias->num_rows > 0) {
                echo "<h3>Materias que imparte:</h3>";
                echo "<table>
                        <tr>
                          <th>Clave</th>
                          <th>Materia</th>
                          <th>Descripción</th>
                          <th>Horas/Semana</th>
                          <th>Créditos</th>
                        </tr>";

                while ($dm = $resultadoMaterias->fetch_assoc()) {
                    $clave = $dm['clave_materia'];
                    $consultaMateria = "SELECT * FROM materia WHERE clave_materia = '$clave'";
                    $resultadoMateria = $conexion->query($consultaMateria);

                    if ($resultadoMateria && $resultadoMateria->num_rows > 0) {
                        $materia = $resultadoMateria->fetch_assoc();
                        echo "<tr>
                                <td>{$materia['clave_materia']}</td>
                                <td>{$materia['nombre']}</td>
                                <td>{$materia['descripcion']}</td>
                                <td>{$materia['horas_semana']}</td>
                                <td>{$materia['creditos']}</td>
                              </tr>";
                    }
                }
                echo "</table>";
            } else {
                echo "<p style='color:red;'>No tiene materias registradas.</p>";
            }
            echo "</div>";
        } else {
            echo "<p style='text-align:center; color:red;'>No se encontró ningún docente con esos datos.</p>";
        }
    }
}
$conexion->close();
?>

<div class="bt">
  <a href="fondo.html" class="boton">🏠 Regresar</a>
</div>

</body>
</html>