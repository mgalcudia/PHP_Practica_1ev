<?php
//Controlador frontal
//Raiz principal
define("Raiz",__DIR__);

//Carpeta del controlador
define("control", Raiz."\controllers");
//insertamos la cabecera
include Raiz.'\views\Cabecera.php';
include Raiz.'\views\Inicio.php';
//ahora incluimos en cuerpo según nos devuelve $mvc
include control."\controlador.php";

//instanciar al controlador
$mvc= new controlador();

if (isset($_GET['action']) && $_GET['action']=='listar'){
	
	$mvc->ListarEnvios();
	
}elseif (isset($_GET['action']) && $_GET['action']=='buscar'){

		$mvc->BusquedaEnvios();

	
}elseif (isset($_GET['action']) && $_GET['action']=='modificar'){
	
	$mvc->ModificaEnvios();	
	
}elseif (isset($_GET['action']) && $_GET['action']=='eliminar' ){
	
	$mvc->EliminaEnvios();
	
}elseif (isset($_GET['action']) && $_GET['action']=='insertar'){
	
	$mvc->InsertaEnvios();
}elseif (isset($_GET['action']) && $_GET['action']=='anotar'){
	
	$mvc->AnotaRecepcion();
}

else{
	
	$mvc->Inicio();
}



	include Raiz.'\views\pie.php';
	
	




