<?php
	//incluimos la clase nusoap.php
	require_once("nusoap-0.9.5/lib/nusoap.php");
	require_once("nusoap-0.9.5/lib/class.wsdlcache.php");
	//creamos el objeto de tipo soapclient.
	//donde se encuentra el servicio SOAP que vamos a utilizar.
	$soapclient = new nusoap_client("http://www.webservicex.net/geoipservice.asmx?WSDL",true);

	
	//Llamamos la función que habíamos implementado en el Web Service
	//e imprimimos lo que nos devuelve

	$result= $soapclient->call("GetGeoIP", array("x"=>$_GET['ip'])); 
	print_r($result); 
?>