<?php 
$servername="localhost";
$database="alumnos";
$username="root";
$password="";
//creacion de conexion 
$conexion=mysqli_connect($servername, $username,$password,$database);
//chequeo de conexion
if (!$conexion ){
die("❌ conexion fallida:". mysqli_connect_error());

}

if (isset($_POST['eliminar'])) {
  $id = mysqli_real_escape_string($conexion, $_POST['id']);
  
  // Primero, verificar si el registro existe
  $sql_verificar = "SELECT * FROM tabla WHERE id = '$id'";
  $resultado_verificar = mysqli_query($conexion, $sql_verificar);
  
  if (mysqli_num_rows($resultado_verificar) > 0) {
    // El registro existe, proceder a eliminar
    $sql_eliminar = "DELETE FROM tabla WHERE id = '$id'";
    $resultado_eliminar = mysqli_query($conexion, $sql_eliminar);
    
    if ($resultado_eliminar) {
      echo "<script>
              alert('✅ Alumno eliminado correctamente');
              window.location.href = './eliminar.php';
            </script>";
    } else {
      echo "<script>
              alert('❌ Error al eliminar el alumno: " . mysqli_error($conexion) . "');
              window.location.href = './eliminar.php';
            </script>";
    }
  } else {
    echo "<script>
            alert('❌ No se encontró ningún alumno con ese ID');
            window.location.href = './eliminar.php';
          </script>";
  }
  
  mysqli_close($conexion);
} else {
  
  header("Location: ./eliminar.php");
  exit();
}
?>