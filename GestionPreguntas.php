<!DOCTYPE html>
<html>
<head>
	<title>Gestionar Preguntas</title>
</head>
<body>
	<form id="pregunta" >     
		<h2>Añadir pregunta </h2>                
		<input type="hidden" name="email" id="email" value="<?php echo $_GET['email']?>" >     
		<p> Asignatura: <input type="text" required id="asig" name="asig" size="50" value="" />		
		<p> Pregunta: <input type="text" required id="preg" name="preg" size="50" value="" />   
		<p> Respuesta: <input type="text" required id="resp" name="resp" size="50" value="" />
		<p> Complejidad (1,5): <input type="number" min="1" max="5" id="comp" name="comp" size="50" value="" />
	</form>

	<form>  
		<input type = "button" value = "Mostrar" onclick = "pedirDatos()">  
		<input type = "button" value = "insertado" onclick = "verificar()">  
	</form>  
	<div id="resultado">  <p>Aparecera algo</p> </div>
	<div id="insertado">  
		<p>Apareceran las preguntas del documento XML</p>  
	</div> 
</body>
</html>

<script language="javascript">
	function verificar(){ 
			valor = document.getElementById("asig").value;
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
				alert("Introduce Asignatura");
				return false;
			}
			
			valor = document.getElementById("preg").value;
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
				alert("Introduce Pregunta");
				return false;
			}
			
			valor = document.getElementById("resp").value;
			if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ){
				alert("Introduce Respuesta");
				return false;
			}
			insertarDatos();
	}
	function pedirDatos()
	{
		xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
			{
				document.getElementById("resultado").innerHTML = xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","verPreguntasXML.php"); 
		xmlhttp.send();
	}


	function insertarDatos(){
		xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange=function(){
			if(xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById('insertado').innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","InsertarPregunta.php?email="+ document.getElementById('email').value+ "&asig=" + document.getElementById("asig").value + "&preg=" + document.getElementById("preg").value + "&resp=" + document.getElementById("resp").value + "&comp=" +document.getElementById("comp").value, true);
		xmlhttp.send();
	}
</script>
