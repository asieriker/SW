<?php
	//incluimos la clase nusoap.php
	require_once('nusoap-0.9.5/lib/nusoap.php');
	require_once('nusoap-0.9.5/lib/class.wsdlcache.php');
	//creamos el objeto de tipo soap_server
	$ns="http://localhost/SW/nusoap-0.9.5/samples";
	$server = new soap_server;
	$server->configureWSDL("comprobarContrasena",$ns);
	$server->wsdl->schemaTargetNamespace=$ns;
	//registramos la función que vamos a implementar
	$server->register("comprobarContrasena",
	array("x"=>"xsd:string","y"=>"xsd:string"),
	array("z"=>'xsd:string'),
	$ns);
	//implementamos la función
	function comprobarContrasena($x,$y){
		
		if (($var2 = strcmp($y, "0000")) == 0){

			$fp = fopen("toppasswords.txt", "r") or die("No se ha podido abrir el archivo");
			while(!feof($fp)) {
				$linea = fgets($fp);
				$linea = trim($linea);
				if (($var1 = strcmp($linea, $x)) == 0){
					return "INVALIDA";
				}
			}
			fclose($fp);
			return "VALIDA";

		}else{
			return "USUARIO NO AUTORIZADO";
		}
	}
	//llamamos al método service de la clase nusoap
	//$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
	$rawPostData = file_get_contents("php://input");
	$server->service($rawPostData);
?>