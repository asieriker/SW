<html>
	<form id="login" action="InsertarPregunta.php" method="post">     
		<h2>Añadir pregunta </h2>                
		<p> Email autor  : <input type="email"  required id="email" name="email" size="21" value="" />                
		<p> Pregunta: <input type="text" required id="preg" name="preg" size="50" value="" />   
		<p> Respuesta: <input type="text" required id="resp" name="resp" size="50" value="" />
		<p> Complejidad (1,5): <input type="number" min="1" max="5" id="comp" name="comp" size="50" value="" />
		<p> <input id="input" type="submit" name="Enviar" value="Enviar"/>
	</form>
	<a href="layout.html">Pagina inicio </a>
</html>

<?php
	if (isset($_POST['email']) && ($_POST['preg']) && ($_POST['resp'])){
		$link = mysqli_connect("localhost", "root", "", "Quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}
	
	$email=$_POST['email'];
	$preg=$_POST['preg']; 
	$resp=$_POST['resp']; 
	$sql="INSERT INTO pregunta (Email, Pregunta, Respuesta, Complejidad) VALUES ('$email', '$preg', '$resp', '$_POST[comp]')";
	if (!mysqli_query($link ,$sql)){
		die('Error: ' . mysqli_error($link));
	}
		echo "1 record added";
	mysqli_close($link); 
	}
?>