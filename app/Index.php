<?php
//Controlador frontal
//Raiz principal
define("Raiz",__DIR__);

//Carpeta del controlador
define("control", Raiz."\controllers");

include control."\controlador.php";

//instanciar al controlador
$mvc= new controlador();

if (isset($_GET['action']) && $_GET['action']=='listar'){
	
	$mvc->ListarEnvios();
}elseif (isset($_GET['action']) && $_GET['action']=='buscar'){
	
	$mvc->BusquedaEnvios($datosBusqueda);
}elseif (isset($_GET['action']) && $_GET['action']=='modificar'){
	
	$mvc->ModificaEnvios($datosmodificado, $_GET['id']);
}elseif (isset($_GET['action']) && $_GET['action']=='eliminar' ){
	
	$mvc->EliminaEnvios($_GET['id']);
}elseif (isset($_GET['action']) && $_GET['action']=='insertar'){
	
	$mvc->EliminaEnvios($_GET['id']);
}elseif (isset($_GET['action']) && $_GET['action']=='anotar'){
	
	$mvc->AnotaRecepcion($_GET['id'], $observaciones);
}

else{
	
	$mvc->Inicio();
}




