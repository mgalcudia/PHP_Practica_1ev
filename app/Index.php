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
	
	$mvc->ModificaEnvios($datosmodificado, $id);
}elseif (isset($_GET['action']) && $_GET['action']=='eliminar' ){
	
	$mvc->EliminaEnvios($id);
}elseif (isset($_GET['action']) && $_GET['action']=='insertar'){
	
	$mvc->EliminaEnvios($id);
}elseif (isset($_GET['action']) && $_GET['action']=='anotar'){
	
	$mvc->AnotaRecepcion($idRecepcion, $observaciones);
}

else{
	
	$mvc->Inicio();
}




