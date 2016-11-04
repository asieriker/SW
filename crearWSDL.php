<?php
	//incluimos la clase nusoap.php
	require_once('nusoap-0.9.5/lib/nusoap.php');
	require_once('nusoap-0.9.5/lib/class.wsdlcache.php');
	//creamos el objeto de tipo soap_server
	$ns="nusoap-0.9.5/samples";
	$server = new soap_server;
	$server->configureWSDL('comprobarContrasena',$ns);
	$server->wsdl->schemaTargetNamespace=$ns;
	//registramos la función que vamos a implementar
	$server->register('comprobarContrasena',
	array('x'=>'xsd:string'),
	array('z'=>'xsd:string'),
	$ns);
	//implementamos la función
	function comprobarContrasena($x){
		
		$myfile = fopen("toppasswords.txt", "r") or die("Unable to open file!");
		// Output one line until end-of-file
		while(!feof($myfile)) 
		{
  			$fileStr = fgets($myfile);
  			if(  strcmp($fileStr, $x)  == 0)
  			{		
				fclose($myfile);
				return "INVALIDA";
			} 
		}
		fclose($myfile);
		return "VALIDA";
	}
	//llamamos al método service de la clase nusoap
	$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$server->service($HTTP_RAW_POST_DATA);
?>