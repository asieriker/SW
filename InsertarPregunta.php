<?php
	if (isset($_GET['preg']) && isset($_GET['asig']) && isset($_GET['resp']) && ($_GET['preg']!="")&& ($_GET['asig']!="")&& ($_GET['resp']!="")){
		$link = mysqli_connect("localhost", "root", "", "quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}

		$email=$_GET['email'];
		$asig=$_GET['asig'];
		$preg=$_GET['preg']; 
		$resp=$_GET['resp'];
		$comp=$_GET['comp'];
		$ip=$_SERVER['REMOTE_ADDR'];
		$sql = mysqli_query($link, "SELECT MAX(Id)FROM conexiones WHERE Correo='$email'" );	
		$resultado=mysqli_fetch_row($sql);
		$Id=$resultado[0];
		$sql="INSERT INTO pregunta (Email, Asignatura, Pregunta, Respuesta, Complejidad) VALUES ('$email','$asig', '$preg', '$resp', '$comp')";
		if (!mysqli_query($link ,$sql)){
			die('Error: ' . mysqli_error($link));
		}
		$sql="INSERT INTO acciones (IdConexion, Correo, Tipo, Hora, IP)values('$Id','$email', 'InsertarPregunta',CURTIME(), '$ip')";
		if (!mysqli_query($link ,$sql)){
			die('Error: ' . mysqli_error($link));
		}
		echo '<script language="javascript">alert("1 record added");</script>';
		mysqli_close($link);
		
		try{
			libxml_use_internal_errors(true);
			$Preguntas= new SimpleXMLElement('preguntas.xml', null, true);
			$pregunta=$Preguntas->addChild('assessmentItem');
			$pregunta->addAttribute('subject', $asig);
			$pregunta->addAttribute('complexity',$comp);
			$itemBody=$pregunta->addChild('itemBody');
			$itemBody->addChild('p', $preg);
			$correctResponse=$pregunta->addChild('correctResponse');
			$correctResponse->addChild('value', $resp);
			$Preguntas->asXML('preguntas.xml');
			echo '<script language="javascript">alert("Pregunta añadida al documento XML");</script>';
			echo '<br>';
			echo '<br>';
			echo '<a href=verPreguntasXML.php>Ver preguntas XML </a>';
		}catch (Exception $e){
			echo '<script language="javascript">alert("Error cargando XML");</script>';
		}	
	}else{
		echo '<FONT COLOR="red">Por favor rellena el formulario </FONT>';
	}
?>