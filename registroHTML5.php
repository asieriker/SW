<!DOCTYPE html>
<html>
	<head>
		<title>RegistroHTML5</title>
		<link rel='stylesheet' type='text/css' href='estilos/style.css' />
		<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (min-width: 530px) and (min-device-width: 481px)'
		   href='estilos/wide.css' />
		<link rel='stylesheet' 
		   type='text/css' 
		   media='only screen and (max-width: 480px)'
		   href='estilos/smartphone.css' />
		<style>
          .thumb {
            height: 300px;
            border: 1px solid #000;
            margin: 10px 5px 0 0;
          }
        </style>
			<script language="JavaScript">
			var otraSeleccionada=false;
					function otraEspecialidad(frm){
						if(!otraSeleccionada){
						var otra=document.createElement('textarea');
						frm.appendChild(otra);
						otraSeleccionada=true;
						}
					}
					function ShowImagePreview( files )
					{
					if( !( window.File && window.FileReader && window.FileList && window.Blob ) )
					{
					  alert('The File APIs are not fully supported in this browser.');
					  return false;
					}

					if( typeof FileReader === "undefined" )
					{
						alert( "Filereader undefined!" );
						return false;
					}

					var file = files[0];

					if( !( /image/i ).test( file.type ) )
					{
						alert( "File is not an image." );
						return false;
					}

					reader = new FileReader();
					reader.onload = function(event) 
							{ var img = new Image; 
							  img.onload = UpdatePreviewCanvas; 
							  img.src = event.target.result;  }
					reader.readAsDataURL( file );
				}
				
				function UpdatePreviewCanvas()
				{
					var img = this;
					var canvas = document.getElementById( 'previewcanvas' );

					if( typeof canvas === "undefined" 
						|| typeof canvas.getContext === "undefined" )
						return;

					var context = canvas.getContext( '2d' );

					var world = new Object();
					world.width = canvas.offsetWidth;
					world.height = canvas.offsetHeight;

					canvas.width = world.width;
					canvas.height = world.height;

					if( typeof img === "undefined" )
						return;

					var WidthDif = img.width - world.width;
					var HeightDif = img.height - world.height;

					var Scale = 0.0;
					if( WidthDif > HeightDif )
					{
						Scale = world.width / img.width;
					}
					else
					{
						Scale = world.height / img.height;
					}
					if( Scale > 1 )
						Scale = 1;

					var UseWidth = Math.floor( img.width * Scale );
					var UseHeight = Math.floor( img.height * Scale );

					var x = Math.floor( ( world.width - UseWidth ) / 2 );
					var y = Math.floor( ( world.height - UseHeight ) / 2 );

					context.drawImage( img, x, y, UseWidth, UseHeight );  
				}

				function previsualizar($ruta) {
					document.getElementById('sample').src = $ruta;
					alert($ruta); //ver que toma el navegador del campo file
				}
			</script>
			
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" type="text/javascript"></script>
		<script>
		function correoRegAJAX(){
			$.ajax({
				url: 'correoRegistrado.php?email='+ document.getElementById('direcciondecorreo').value,
				beforeSend:function(){
					$('#correoValido').html('<div><img src="imagenes/loading.gif"/></div>')},
				success:function(datos){
					if(datos=="SI"){
						$('#correoValido').html('<div><img src="imagenes/OK.png"/></div>');
						}else{
						$('#correoValido').html('<div><img src="imagenes/error.png"/></div>');
						}
					},
				error:function(){
					$('#correoValido').fadeIn().html('<p class="error"><strong>El servidor parece que no responde</p>');
					}		
			})
		}
		function contraseñaAJAX(){
			//	alert(document.getElementById('password').value);
			//	alert(document.getElementById('ticket').value);

				$.ajax({
					url: 'clienteComprobarContrasenaWSDL.php?contrasena='+ document.getElementById('password').value +"&ticket=" +document.getElementById('ticket').value,
					beforeSend:function(){
					$('#contraseñaValida').html('<div><img src="imagenes/loading.gif"/></div>')},
					success:function(datos){
						if(datos=="VALIDA" && document.getElementById('password').value !=""){
							document.getElementById('contraseñaValida').innerHTML="Contraseña valida";
						}else if (datos == "USUARIO NO AUTORIZADO") {
								document.getElementById('contraseñaValida').innerHTML="Usuario no autorizado";    
						}else{
								document.getElementById('contraseñaValida').innerHTML="Contraseña no valida";    
						}
					},
					error:function(){
						$('#contraseñaValida').fadeIn().html('<p class="error"><strong>El servidor parece que no responde</p>');
					}        
				})
		}
	/*	pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$" required oninvalid="this.setCustomValidity('La clave introducida no cumple los requisitos: \n \n Minimo 8 caracteres \n Maximo 15 \n Al menos una letra mayúscula \n Al menos una letra minuscula \n Al menos un dígito No espacios en blanco \n Al menos 1 caracter especial')" oninput="setCustomValidity('')" */
		</script>
	
	</head>
	<body>
		<div id='page-wrap'>
			<header class='main' id='h1'>
				<span class="right"><a href="registro.html">Registrarse</a></span>
				<span class="right"><a href="Login.php">Login</a></span>
					<span class="right" style="display:none;"><a href="/logout">Logout</a></span>
				<h2>Quiz: el juego de las preguntas</h2>
			</header>
			<nav class='main' id='n1' role='navigation'>
				<span><a href="layout.html">Inicio</a></spam>
				<span><a href='creditos.html'>Creditos</a></spam>
			</nav>
	<section class="main" id="s1">
	<div>
	<h1>Registro</h1><br/>
		<form form id='registro' name='registro' enctype="multipart/form-data" method="POST" action="registroHTML5.php">

			Nombre y apellidos*: <input type="text" name="nombreyapellidos" id="nombreyapellidos" pattern="[A-Z]+[a-z]* [A-Z]+[a-z]* [A-Z]+[a-z]*" required oninvalid="this.setCustomValidity('Introduce Nombre y dos apellidos')" oninput="setCustomValidity('')"/><br><br>

			Direccion de correo*: <input type="text" name="direcciondecorreo" id="direcciondecorreo" pattern="^[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)$" required onchange="correoRegAJAX()" oninvalid="this.setCustomValidity('Introduce un email valido.\n Ejemplo: jvadillo001@ikasle.ehu.eus')" oninput="setCustomValidity('')"/><br>
			<div id="correoValido"></div><br><br> 
			
			Password*: <input type="password" name="password" id="password" onchange="contraseñaAJAX()" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$" required oninvalid="this.setCustomValidity('La clave introducida no cumple los requisitos: \n \n Minimo 8 caracteres \n Maximo 15 \n Al menos una letra mayúscula \n Al menos una letra minuscula \n Al menos un dígito No espacios en blanco \n Al menos 1 caracter especial')" oninput="setCustomValidity('')"/>

			Ticket(4 dígitos): <input type="text" name="ticket" id="ticket" onchange="contraseñaAJAX()" pattern="^[0-9]{4}$" required oninvalid="ta mal" oninput="setCustomValidity('')"/>
			<br>
			<div id="contraseñaValida"></div><br><br> 
			Numero de telefono*: <input type="text" name="numerodetelefono" id="numerodetelefono" pattern="^[0-9]{9}$" required oninvalid="this.setCustomValidity('Introduce un numero de telefono valido; 9 digitos')" oninput="setCustomValidity('')"/><br><br>
			
			Especialidad*: <br><input type="radio" name="especialidad" value="IS" checked>Ingenieria del Software<br>
						  <input type="radio" name="especialidad" value="IC">Ingenieria de Computadores<br>
						  <input type="radio" name="especialidad" value="C">Computacion<br>
						  <input type="radio" name="especialidad" value="O" onclick="JavaScript:otraEspecialidad(this.form)">Otra<br><br>
						  
			Tecnologias y herramientas en las que estas interesado: <input type="textarea" rows="4" cols="50" name="intereses" id="intereses"><br><br>
		   			<input type="file" id="foto" name="foto" onchange="return ShowImagePreview( this.files );" /><br><br>
					<div id="previewcanvascontainer"><canvas id="previewcanvas"></canvas></div>
			<br><input type="submit" value="Enviar"><br><br>	
		</form>
		
		<?php
	if(isset($_POST['nombreyapellidos'])&&isset($_POST['direcciondecorreo'])&&isset($_POST['password'])&&isset($_POST['numerodetelefono'])
	){ 
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
			echo '<script language="javascript">alert("Email introducido incorrecto");</script>';	
		}else if(!preg_match("/[A-Z]+[a-z]* [A-Z]+[a-z]* [A-Z]+[a-z]*/", $_POST['nombreyapellidos']))
		{
			echo '<script language="javascript">alert("El nombre y apellidos introducidos son incorrectos");</script>';	
		}else if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/", $_POST['password']))
		{
			echo '<script language="javascript">alert("La contraseña es incorrecta");</script>';	
		}else if(!preg_match("/^[0-9]{9}$/", $_POST['numerodetelefono']))
		{
			echo '<script language="javascript">alert("El numero de telfono introducido es incorrecto");</script>';				
		}else{
			require_once('nusoap-0.9.5/lib/nusoap.php');
			require_once('nusoap-0.9.5/lib/class.wsdlcache.php');
			$soapclient = new nusoap_client( 'http://sw14.hol.es/ServiciosWeb/comprobarmatricula.php?wsdl',true);
			$resultadoEmail= $soapclient->call('comprobar', array('x'=>$_POST['direcciondecorreo'])); 
		
			require_once("nusoap-0.9.5/lib/nusoap.php");
			require_once("nusoap-0.9.5/lib/class.wsdlcache.php");
			$soapclient = new nusoap_client( "http://localhost/SW/crearWSDL.php?wsdl",true);
			$resultadoContrasena = $soapclient->call("comprobarContrasena", array("x"=>$_POST['password'],"y"=>$_POST['ticket'])); 
			if($resultadoContrasena=="VALIDA" && $resultadoEmail== "SI"){

				$sql="INSERT INTO usuario (NombreApellidos, Correo, Contrasena, NTelefono, Especialidad, Intereses, ruta) VALUES ('$_POST[nombreyapellidos]','$_POST[direcciondecorreo]','$_POST[password]',$_POST[numerodetelefono],'$_POST[especialidad]','$_POST[intereses]', '$rutaDestino')";

				if (!mysqli_query($mysqli ,$sql))
				{
					die('Error: ' . mysqli_error($mysqli));
				}
				echo '<script language="javascript">alert("Registrado correctamente");</script>';
				echo "<p> <a href='verUsuariosConFoto.php'> Ver registros </a>";
				
			}else if($resultadoEmail== "NO"){
				echo '<script language="javascript">alert("No estás matriculado en la asignatura");</script>';	
			}else{
				echo '<script language="javascript">alert("Contraseña invalida");</script>';	
			}
		}
		//Cerrar conexiÃ³n
		mysqli_close($mysqli);
	}
?>
	</div>
	</section>
		<footer class='main' id='f1'>
			<p><a href="http://es.wikipedia.org/wiki/Quiz" target="_blank">Que es un Quiz?</a></p>
			<a href='https://github.com'>Link GITHUB</a>
		</footer>
	</div>
	</body>
</html>

