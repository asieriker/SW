<?php

		$link = mysqli_connect("localhost", "root", "", "quiz");
		if (!$link){
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
		}

		$sql = mysqli_query($link,"SELECT count (*) FROM pregunta");
		$resultado=mysqli_fetch_row($sql);
		$numPregTotal=$resultado[0];

		$usuario = $_GET['email'];
		$sql = mysqli_query($link,"SELECT count (email) FROM pregunta WHERE email='$usuario' ");
		$resultado=mysqli_fetch_row($sql);
		$numPregUsuario=$resultado[0];

		echo "Mis preguntas/Todas las preguntas: " . $numPregUsuario . "/". $numPregTotal;
		mysqli_close($link);
?>