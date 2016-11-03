<?php

		$link = mysqli_connect("localhost", "root", "", "Quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}

		$sql = mysqli_query($link,"SELECT * FROM pregunta");
		$numPregTotal=mysqli_num_rows($sql);
		$usuario = $_GET['email'];
		$sql = mysqli_query($link,"SELECT * FROM pregunta WHERE email='$usuario' ");
		$numPregUsuario=mysqli_num_rows($sql);

		echo "Mis preguntas/Todas las preguntas: " . $numPregUsuario . "/". $numPregTotal;
		mysqli_close($link);
?>
