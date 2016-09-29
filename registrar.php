<?php

//Crear conexión
$mysqli = mysqli_connect("localhost", "root", "", "Quiz");
if (!$mysqli)
{
echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
}


$sql="INSERT INTO Usuario (NombreApellidos, Correo, Contrasena, NTelefono, Especialidad, Intereses) VALUES ('$_POST[nombreyapellidos]','$_POST[direcciondecorreo]','$_POST[password]',$_POST[numerodetelefono],'$_POST[especialidad]','$_POST[intereses]')";



if (!mysqli_query($mysqli ,$sql))
{
die('Error: ' . mysqli_error($mysqli));
}
echo "1 record added";

echo "<p> <a href='visualizar.php'> Ver registros </a>";

//Cerrar conexión
mysqli_close($mysqli);

?>