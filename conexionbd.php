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
echo "✅ conexion exitosa a la base de datos:" .$database . "<br>";
//proceso de la insercion de datos
if($_SERVER ["REQUEST_METHOD"] =="POST") {
//atributo de la tabla
$nombre=$_POST['nombre'];
$edad=$_POST['edad'];
$telefono=$_POST['telefono'];
// validar que no haya campos vacios
if (!empty($nombre) && !empty($edad) && !empty($telefono)){
//setencia de sql 
$sql ="INSERT INTO tabla(nombre, edad, telefono) VALUES('$nombre', '$edad', '$telefono')";
if(mysqli_query($conexion,$sql)){
    echo"✅nuevo registro creado exitosamente";
}else{
    echo("❌error al insertar: ". mysql_error($conexion));
}
}
else{echo"por favor completa los campos del formulario";}
mysqli_close($conexion);
}
?>