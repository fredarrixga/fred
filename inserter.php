<?php include("conexionbd.php"); 

if (isset($_POST['enviar'])) {
  $nombre = $_POST['nombre'];
  $edad = $_POST['edad'];
  $telefono = $_POST['telefono'];

  $sql = "INSERT INTO tabla (nombre, edad, telefono) VALUES ('$nombre', '$edad', '$telefono')";
  $resultado = mysqli_query($conexion, $sql);

  if ($resultado) {
    echo "<script>
            alert('Alumno insertado correctamente');
            window.location.href = 'formulario1.html';
          </script>";
  } else {
    echo "<script>
            alert('Error al insertar');
            window.location.href = 'formulario1.html';
          </script>";
  }
}
?>