
<?php

//Crear conexiÃ³n
$mysqli = mysqli_connect("localhost", "root", "", "Quiz");
if (!$mysqli)
{
echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
}

$rutaEnServidor='./imagenes';
$rutaTemporal=$_FILES['foto']['tmp_name'];
$nombreImagen=$_FILES['foto']['name'];

if (empty($nombreImagen)) {
	$nombreImagen='nodisponible.png';
}

$rutaDestino=$rutaEnServidor.'/'.$nombreImagen;
move_uploaded_file($rutaTemporal, $rutaDestino);
$emailfield='^[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)$';
if (!preg_match("/^[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)$/", $_POST['direcciondecorreo']))
{
    echo "Email introducido incorrecto";
}else if(!preg_match("/[A-Z]+[a-z]* [A-Z]+[a-z]* [A-Z]+[a-z]*/", $_POST['nombreyapellidos']))
{
	echo "El nombre y apellidos introducidos son incorrectos";	
}else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/", $_POST['password']))
{
	echo "La contraseña introducida es incorrecta";	
}else if(!preg_match("/^[0-9]{9}$/", $_POST['numerodetelefono']))
{
	echo "El numero de telfono introducido es incorrecto";	
	
}else{

$sql="INSERT INTO usuario (NombreApellidos, Correo, Contrasena, NTelefono, Especialidad, Intereses, ruta) VALUES ('$_POST[nombreyapellidos]','$_POST[direcciondecorreo]','$_POST[password]',$_POST[numerodetelefono],'$_POST[especialidad]','$_POST[intereses]', '$rutaDestino')";

if (!mysqli_query($mysqli ,$sql))
{
die('Error: ' . mysqli_error($mysqli));
}
echo "1 record added";

echo "<p> <a href='verUsuariosConFoto.php'> Ver registros </a>";
}
//Cerrar conexiÃ³n
mysqli_close($mysqli);

?>