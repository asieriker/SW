<?php
	//incluimos la clase nusoap.php
	require_once('nusoap-0.9.5/lib/nusoap.php');
	require_once('nusoap-0.9.5/lib/class.wsdlcache.php');
	//creamos el objeto de tipo soap_server
	$ns="http://localhost/SW/nusoap-0.9.5/samples";
	$server = new soap_server;
	$server->configureWSDL("comprobarMatricula",$ns);
	$server->wsdl->schemaTargetNamespace=$ns;
	//registramos la función que vamos a implementar
	$server->register("comprobarMatricula",
	array("x"=>"xsd:string"),
	array("z"=>'xsd:string'),
	$ns);
	//implementamos la función
	function comprobarMatricula($x){
	

  			if(  (strcmp($x, "iredondo019@ikasle.ehu.eus")  == 0 ) || (strcmp($x, "atamayo005@ikasle.ehu.eus")  == 0 )) return "SI";
  			else
				return "NO";
	}
	//llamamos al método service de la clase nusoap
	//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$rawPostData = file_get_contents("php://input");
	$server->service($rawPostData);
?>