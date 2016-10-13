
<html>
	<form action="http://sw14.hol.es/accesobd/login.php"  method="post">           
		<h2>Identificación de usuario </h2>                
		<p> Email   : <input type="email"  id ="email" required name="email" size="21" value="" />                
		<p> Password: <input type="password" id="pass" required name="pass" size="21" value="" />                
		<p> <input id="input" type="submit" />
	</form>
</html>

<?php
	if (isset($_POST['email']))
		$link=mysqli_connect("localhost","root","","Quiz") 
	or die(mysql_error());
	$email=$_POST['email']; 
	$pass=$_POST['pass']; 
	$usuarios = mysqli_query($link,"select * from users where correo='$email' and user_password='$pass'"); 
	$cont= mysqli_num_rows($usuarios);
	mysql_close(); 
	if($cont==1){header('location:http://asiksw.hol.es/SW_seguridad/layout.html');} 
	else {echo "<FONT COLOR=RED>Datos incorrectos !!</FONT>";}
?>

