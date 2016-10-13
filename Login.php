<html>
	<form id="login" action="Login.php"   method="post">           
		<h2>Identificación de usuario </h2>                
		<p> Email   : <input type="email"  required id="email" name="email" size="21" value="" />                
		<p> Password: <input type="password" required id="pass" name="pass" size="21" value="" />                
		<p> <input id="input" type="submit" />
	</form>
	<a href="layout.html">Volver</a>
</html>

<?php
	if (isset($_POST['email'])){
		$link = mysqli_connect("localhost", "root", "", "Quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}
	
	$email=$_POST['email'];
	$pass=$_POST['pass']; 
	$usuarios = mysqli_query($link,"select * from usuario where Correo='$email' and Contrasena='$pass'"); 
	$cont= mysqli_num_rows($usuarios); 
	mysqli_close($link); 
	if($cont==1){
		header('Location: InsertarPregunta.php');
	} 
	else {echo '<script language="javascript">alert("Datos incorrectos");</script>'; }
	}
?>
