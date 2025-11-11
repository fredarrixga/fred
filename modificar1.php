<?php include("conexion.php");

if (isset($_POST['actualizar'])) {
  $id = $_POST['id'];
  $nombre = $_POST['nombre'];
  $edad = $_POST['edad'];
  $telefono = $_POST['telefono'];

  $sql = "UPDATE tabla SET nombre='$nombre', edad='$edad', telefono='$telefono' WHERE id=$id";
  $resultado = mysqli_query($conexion, $sql);

  if ($resultado) {
    echo "<script>
            alert('Registro actualizado correctamente');
            window.location.href = './modificar.php';
          </script>";
  } else {
    echo "<script>
            alert('Error al actualizar');
            window.history.back();
          </script>";
  }
}
?>