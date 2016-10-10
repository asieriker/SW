
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

if(!filter_var($_POST['direcciondecorreo'], FILTER_VALIDATE_EMAIL))
{
    echo "Email introducido incorrecto";
	
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