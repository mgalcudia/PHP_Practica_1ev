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
	
	/**
	 * @todo ESTA FUNCION NO ESTA TERMINADA COMPROBAR LO ESCRITO,FORMULARIO.PHP Y $provincias = $this->modelo->ListarProvincias ();
	 * @param unknown $datosmodificado
	 * @param unknown $id
	 */
	function ModificaEnvios($datosmodificado, $id) {
		$provincias = $this->modelo->ListarProvincias ();
		if (isset ( $_GET ['id'] )) {
			$existeId = $this->modelo->ExisteId ( $_GET ['id'] );
			if ($existeId) {
				if (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "si") {
					if ($_POST) {
						$this->modelo->ModificaEnvio ( $this->CreaArrayDatos (), $_GET ['id'] );
					} else {
						include Raiz . '\views\Formulario.php';
						// no hay post
					}
				} elseif (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "no") {
					header ( 'Location:index.php?action=listar' ); // TODO: mostrar los listados
				} else {
					// formulario para no se que #########
				}
			} else {
				// formulario para cambiar la id
			}
		} else {
			include Raiz . '\views\Formulario.php';
		}
		$modificaEnvio = $this->modelo->ModificaEnvio ( $datosmodificado, $id );
	}
	/**
	 * funcion para eliminar envios, recoge la id por get
	 * 
	 * @param
	 *        	id de envios $id
	 */
	function EliminaEnvios($id) {
		if (isset ( $_GET ['id'] )) {
			$eliminar = $this->modelo->ExisteId ( $_GET ['id'] ); // función para comprobar si existe una id
			if ($eliminar) {
				if (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "si") {
					$this->modelo->EliminaEnvios ( $_GET ['id'] );
				} elseif (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "no") {
					header ( 'Location:index.php?action=listar' ); // TODO: mostrar los listados
				} else {
					include Raiz . '\views\BorrarRegistro.php';
				}
			} else {
				include Raiz . '\views\CambiarID.php';
				// TODO: mostrar formulario para insertar id pasandole la id incorrecta
			}
		} else {
			header ( 'Location:index.php?action=listar' ); // TODO: mostrar los listados
		}
	}
	function InsertaEnvios($datos) {
		$insertEnvio = $this->modelo->InsertaEnvios ( $datos );
	}
	function AnotaRecepcion($idRecepcion, $observaciones) {
		if (isset ( $anotaRecepcion )) {
		}
		$anotaRecepcion = $this->modelo->AnotaRecepcion ( $idRecepcion, $observaciones );
	}
	/**
	 * funcion para listar los envios, tiene paginacion
	 */
	function ListarEnvios() {
		$listaEnvios = $this->modelo->ListaEnvios ();
		$totalEnvios = $this->modelo->TotalEnvios ();
		$paginasTotales = $this->modelo->PaginasTotales ( $totalEnvios );
		$paginaActual = $this->modelo->PaginaActual ( $totalEnvios );
		
		if (isset ( $listaEnvios )) {
			
			include Raiz . '\views\VistaListar.php';
		} else {
			
			header ( 'Status: 404 Not Found' );
			echo '<html><body><h1>Error 404: No existe  
						</p></body></html>';
		}
	}
	
	/**
	 * funcion para la vista inicio
	 */
	function Inicio() {
		include Raiz . '/views/VistaInicio.php';
	}
	
	/**
	 * funcion que recoge el valor post por defecto
	 * 
	 * @param string $nombreCampo        	
	 * @param string $valorPorDefecto        	
	 * @return string|string
	 */
	function ValorPost($nombreCampo, $valorPorDefecto = '') {
		if (isset ( $_POST [$nombreCampo] ))
			return $_POST [$nombreCampo];
		else
			return $valorPorDefecto;
	}
	/**
	 * funcion que recoge el valor get por defecto
	 * 
	 * @param string $nombreCampo        	
	 * @param string $valorPorDefecto        	
	 * @return string|string
	 */
	function ValorGet($nombreCampo, $valorPorDefecto = '') {
		if (isset ( $_GET [$nombreCampo] ))
			return $_GET [$nombreCampo];
		else
			return $valorPorDefecto;
	}
	
	/**
	 * crea un array con los valores recogidos por post
	 * 
	 * @return array
	 */
	function CreaArrayDatos() {
		$datos = array (
				'destinatario' => $this->ValorPost ( 'destinatario' ),
				'telefono' => $this->ValorPost ( 'telefono' ),
				'direccion' => $this->ValorPost ( 'direccion' ),
				'poblacion' => $this->ValorPost ( 'poblacion' ),
				'cod_postal' => $this->ValorPost ( 'cod_postal' ),
				'provincia' => $this->ValorPost ( 'provincia' ),
				'email' => $this->ValorPost ( 'email' ),
				'estado' => $this->ValorPost ( 'estado' ),
				'observaciones' => $this->ValorPost ( 'observaciones' ) 
		);
		return $datos;
	}
	/**
	 * funcion para crear el menu desplegable de provincias
	 *
	 * @param unknown $name        	
	 * @param unknown $opciones        	
	 * @param number $valorPorDefecto        	
	 * @return string
	 */
	function CreaSelect($name, $opciones, $valorPorDefecto = 0) {
		$html = '';
		
		$html .= '<select name="' . $name . '">';
		
		foreach ( $opciones as $clave => $valor ) {
			$html .= '<option value="' . $clave . '" ';
			
			$html .= ($clave == $valorPorDefecto) ? ' selected="selected">' . $valor : ' >' . $valor;
			$html .= '</option>';
		}
		$html .= '</select>';
		return $html;
	}
}

/*
 if($totalEnvios){
echo "<pre>";
print_r($paginaActual);
echo "</pre>";
}
else{
echo 'NULO';
}
*/



/*
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