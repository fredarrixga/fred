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

