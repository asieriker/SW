<html>
	<form id="login" action="InsertarPregunta.php?email=<?php echo $_GET['email'] ?>" method="get">     
		<h2>Añadir pregunta </h2>                
		<input type="hidden" name="email" value="<?php echo $_GET['email']?>"               
		<p> Pregunta: <input type="text" required id="preg" name="preg" size="50" value="" />   
		<p> Respuesta: <input type="text" required id="resp" name="resp" size="50" value="" />
		<p> Complejidad (1,5): <input type="number" min="1" max="5" id="comp" name="comp" size="50" value="" />
		<p> <input id="input" type="submit" name="Enviar" value="Enviar"/>
	</form>
	<a href="layoutin.php?email=<?php echo $_GET['email'] ?>">Pagina inicio </a>
</html>

<?php
	if (isset($_GET['preg'])){
		$link = mysqli_connect("localhost", "root", "", "Quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}

	$email=$_GET['email'];
	$preg=$_GET['preg']; 
	$resp=$_GET['resp'];
	$ip=$_SERVER['REMOTE_ADDR'];
	$sql = mysqli_query($link, "SELECT MAX(Id)FROM conexiones WHERE Correo='$email'" );	
	$resultado=mysqli_fetch_row($sql);
	$Id=$resultado[0];
	$sql="INSERT INTO pregunta (Email, Pregunta, Respuesta, Complejidad) VALUES ('$email', '$preg', '$resp', '$_GET[comp]')";
	if (!mysqli_query($link ,$sql)){
		die('Error: ' . mysqli_error($link));
	}
	$sql="INSERT INTO acciones (IdConexion, Correo, Tipo, Hora, IP)values('$Id','$email', 'InsertarPregunta',CURTIME(), '$ip')";
	if (!mysqli_query($link ,$sql)){
		die('Error: ' . mysqli_error($link));
	}
	echo '<script language="javascript">alert("1 record added");</script>';
	mysqli_close($link); 
	}
?>