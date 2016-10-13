
<html>
	<form action="http://sw14.hol.es/accesobd/login.php"   method="post">           
		<h2>Identificación de usuario </h2>                
		<p> Email   : <input type="email"  required name="email" size="21" value="" />                
		<p> Password: <input type="password" required name="pass" size="21" value="" />                
		<p> <input id="input_2" type="submit" />
		<p> <input id="input_2" type="submit" />
	</form>
</html>

<?php
	if (isset($_POST['email']))
		$link=mysqli_connect("mysql.hostinger.es","u121928603_jav","micontrasena","u121928603_sw") 
	or die(mysql_error());
	$email=$_POST['email']; $pass=$_POST['pass']; 
	$usuarios = mysqli_query($link,"select * from users where user_email='$email' and user_password='$pass'"); 
	$cont= mysqli_num_rows($usuarios); mysql_close(); 
	if($cont==1){header('location:http://sw14.hol.es/accesobd/borraramigo.php');} 
	else {echo "<FONT COLOR=RED>Datos incorrectos !!</FONT>";}}
?>

