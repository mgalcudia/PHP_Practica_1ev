<?php
include Raiz . '\models\modelo.php';

$modelo = new modelo ();
class controlador {
	function __construct() {
		$this->modelo = new modelo ();
	}
	function BusquedaEnvios($datosBusqueda) {
		$busquedaEnvios = $this->modelo->BuscarEnvios ( $datosBusqueda );
	}
	function ModificaEnvios($datosmodificado, $id) {
		$modificaEnvio = $this->modelo->ModificaEnvio ( $datosmodificado, $id );
	}
	function EliminaEnvios($id) {
		$eliminaEnvio = $this->modelo->EliminaEnvios ( $id );
	}
	function InsertaEnvios($datos) {
		$insertEnvio = $this->modelo->InsertaEnvios ( $datos );
	}
	function AnotaRecepcion($idRecepcion, $observaciones) {
		if (isset ( $anotaRecepcion )) {
		}
		$anotaRecepcion = $this->modelo->AnotaRecepcion ( $idRecepcion, $observaciones );
	}
	function ListarEnvios() {
		$listaEnvios = $this->modelo->ListaEnvios ();
		
		if (isset ( $listaEnvios )) {
		/*echo "<pre>";
			print_r ( $listaEnvios );
			echo "</pre>"; */
			
			
			include Raiz . '\views\VistaListar.php';
			
		} else {
		
			header ( 'Status: 404 Not Found' );
			echo '<html><body><h1>Error 404: No existe  
						</p></body></html>';
			
		}
	}
	function Inicio() {
		include Raiz . '\views\Inicio.php';
	}
	
	

}



// array de prueba para insertar envios
$datos = array (
		'destinatario' => 'Juaqui',
		'telefono' => '696969696969',
		'direccion' => 'direccion propia',
		'poblacion' => 'Huelva',
		'cod_postal' => '252525',
		'provincia' => '21',
		'email' => 'correo@propio.com',
		
		'fec_creacion' => '2014-01-06',
		'fec_entrega' => '2020-01-06',
		'observaciones' => 'uno que va y que viene' 
);
/*
//idenvios de prueba para modificar dados
$id= 6;
  //array de prueba para modificar envios
$datosmodificado= array(
		'destinatario' => 'Juaqui',
		'telefono'	   => '797979799',
		'direccion'	   => 'direccion mia',
		'poblacion'    => 'Huelva' ,
		'cod_postal'   => '252525',
		'provincia'    => '21',
		'email'        => 'mail@propio.com',

		'fec_creacion' => '2080-01-06',
		'fec_entrega'  => '2020-01-06',
		'observaciones'=>'uno que vino y se fue'
);
//datos para anotar Recepcion
//$observaciones="Sin novedad";
//$idRecepcion= 8;
$datosBusqueda= array(
		'destinatario' => 'destinatario2',
		'telefono'	   => '874646+489+4', 
		'direccion'	   => 'direccion2'
);

//hacer busquedas
 $busquedaEnvios= $modelo->BuscarEnvios($datosBusqueda);  YA
 echo "<pre>";
 print_r($busquedaEnvios);
 echo "</pre>";

 
 

 
/*
 * FUNCIONES HECHAS Y PROBADAS
//modificar envios
$modificaEnvio= $modelo->ModificaEnvio($datosmodificado, $id); YA
//eliminar envios
$eliminaEnvio= $modelo->EliminaEnvios($id); YA0
//insertar envios
$insertEnvio= $modelo->InsertaEnvios($datos); YA

//Anotar recepcion
$anotaRecepcion= $modelo->AnotaRecepcion($idRecepcion, $observaciones); YA


// listar los envios
$listaEnvios= $modelo->ListaEnvios();YA

echo "<pre>";
print_r($listaEnvios);
echo "</pre>";
*/

/*

  
 
echo "<pre>";
print_r($modificaEnvio);
echo "<pre>";



echo "<pre>";
print_r($eliminaEnvio);
echo "<pre>";





echo "<pre>";
print_r($insertEnvio);
echo "</pre>";





*/

/*
if ($listaPro){
	include 'vista.php';
}
else 
{
	echo "	no entra";
}

*/