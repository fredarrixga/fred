<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>modificar</title>
<link rel="stylesheet" href="estilos.css">
<style>
  body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #ff9a9e, #fad0c4, #fad0c4);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100vh;
    color: #333;
    margin: 0;
  }

  fieldset {
    background: white;
    border: 3px solid #ffb703;
    border-radius: 20px;
    padding: 25px 40px;
    width: 380px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.6s ease-in-out;
  }

  legend {
    font-size: 1.3em;
    font-weight: bold;
    color: black;
    padding: 0 10px;
  }

  label {
    display: block;
    margin-top: 12px;
    font-weight: 600;
  }

  select, input[type="text"], input[type="number"], input[type="tel"] {
    width: 100%;
    padding: 10px;
    margin-top: 6px;
    border: 2px solid #ccc;
    border-radius: 10px;
    font-size: 1em;
    outline: none;
    transition: 0.3s;
  }

  select:hover, input:hover {
    border-color: #4e54c8;
    background-color: #f3f3ff;
  }

  select option {
    padding: 10px;
    background-color: #fff;
    color: #333;
  }

  select option:hover {
    background-color: #8f94fb;
    color: white;
  }

  input[type="submit"], a.boton {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 20px;
    border: none;
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    color: white;
    font-size: 1em;
    border-radius: 10px;
    text-decoration: none;
    cursor: pointer;
    transition: transform 0.2s ease, background 0.3s ease;
  }

  input[type="submit"]:hover, a.boton:hover {
    background: linear-gradient(135deg, #0056b3, #007bff);
    transform: scale(1.05);
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
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: scale(0.9); }
    to { opacity: 1; transform: scale(1); }
  }
</style>
</head>
<body>

<fieldset>
  <legend>Modificar docente</legend>
  
  <form method="get" action="">
    <label>Seleccionar Alumno:</label>
    <select name="DNI_docente" onchange="this.form.submit()" required id="DNI_docente">
      <option value="">-- Selecciona un docente --</option>
      <?php
      include("conexion.php");
      $sql = "SELECT DNI_docente, nombre_docente, especialidad FROM docente ORDER BY nombre";
      $resultado = mysqli_query($conexion, $sql);
      while ($fila = mysqli_fetch_assoc($resultado)) {
        $selected = (isset($_GET['DNI_docente']) && $_GET['apellido_docente'] == $fila['id']) ? 'selected' : '';
        echo "<option value='{$fila['id']}' $selected>{$fila['id']} - {$fila['nombre_docente']}</option>";
      }
      ?>
    </select>
  </form>
  
  <br>
  
  <?php
  if (isset($_GET['DNI_docente'])) {
    $id = $_GET['DNI_docente'];
    $sql = "SELECT * FROM docente WHERE id = '$id'";
    $resultado = mysqli_query($conexion, $sql);
    
    if (mysqli_num_rows($resultado) > 0) {
      $alumno = mysqli_fetch_assoc($resultado);
  ?>
  
  <form method="post" action="modificar1.php">
    <input type="hidden" name="id" value="<?php echo $alumno['id']; ?>">
    
    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?php echo $alumno['nombre_docente']; ?>" required>
    
    <label>Edad:</label>
    <input type="number" name="edad" value="<?php echo $alumno['apellido_docente']; ?>" required>
    
    <label>Teléfono:</label>
    <input type="tel" name="telefono" value="<?php echo $alumno['especialidad']; ?>" pattern="\d{10}" required>
    
    <input type="submit" name="actualizar" value="Actualizar">
    <a href="modificar.php">🔄 Nueva Selección</a>
  
  </form>
  
  <?php
    }
    mysqli_close($conexion);
  }
  ?>
</fieldset>

<div class="bt">
  <a href="fondo.html" class="boton">🏠 Regresar</a>
</div>

</body>
</html>