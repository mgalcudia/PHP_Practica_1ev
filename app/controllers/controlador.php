<?php
include Raiz . '\models\modelo.php';

$modelo = new modelo ();
class controlador {
	function __construct() {
		$this->modelo = new modelo ();
	}

	function BusquedaEnvios() {
		$provincias = $this->modelo->ListarProvincias ();
		$id = $this->modelo->ListaID ();
		$titulo = "Buscar envios";
		$sinDatos = "";
		if (is_array ( $id )) {
			foreach ( $id as $valor ) {
				$idenvios [] = $valor ['idenvios'];
			}
		}
		
		if ($_POST) {	
			$listaEnvios = $this->modelo->BuscarEnvios ( $_POST );			
			if (empty ( $listaEnvios )) {
				
				$sinDatos = "No existe ningun envio asociado a esos campos";
				include Raiz . '\views\VistaBuscar.php';
			} else {
				include Raiz . '\views\VistaListar.php';
			}			
			
		} else {
			
			include Raiz . '\views\VistaBuscar.php';
		}
	}
	
	/**
	 * funcion del controlador para modificar los envios
	 * 
	 * @param unknown $datosmodificado        	
	 * @param unknown $id        	
	 */
	function ModificaEnvios() {
				$provincias = $this->modelo->ListarProvincias ();	
		if (isset ( $_GET ['id'] )) {
			$existeId = $this->modelo->ExisteId ( $_GET ['id'] );
			if ($existeId) {					
				if (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "si") {
					if ($_POST) {//si hay post incluye los datos	
						unset($_POST['id']);
						$consulta=$this->modelo->ObtenProvincia($_POST['provincia']);
						
						$resultado=array_merge($_POST,$consulta);

						$consulta= $this->modelo->ModificaEnvio ($resultado , $_GET ['id'] );											
						header ( 'Location:index.php?action=listar' );
					} else {						
						$campos=$this->modelo->MuestraEnvio($_GET ['id']);
						
						if(is_array($campos))
						{
							$envio = $campos[0];	
						}
						$titulo="Modificar envios";
						include Raiz . '\views\Formulario.php';
						// no hay post
					}
				} elseif (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "no") {
					header ( 'Location:index.php?action=listar' ); 
				} else {
					include Raiz.'\views\ModificarRegistro.php';
				}
			} else {
				include Raiz.'\views\CambiarIdModificar.php';
				// formulario para cambiar la id  CambiarIdModificar.php
			}
		} else  {
			$titulo = "Modificar";
			$listaEnvios = $this->modelo->TodosEnvios ();
			// include Raiz .'\views\Formulario.php';
			include Raiz . '\views\VistaListar.php';
		}
	}
	/**
	 * funcion para eliminar envios, recoge la id por get
	 *
	 * @param
	 *        	id de envios $id
	 */
	function EliminaEnvios() {
		if (isset ( $_GET ['id'] )) {
			$eliminar = $this->modelo->ExisteId ( $_GET ['id'] ); // función para comprobar si existe una id
			if ($eliminar) {
				if (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "si") {
					$this->modelo->EliminaEnvios ( $_GET ['id'] );
					$titulo = "Eliminar";
					$listaEnvios = $this->modelo->TodosEnvios ();
					// include Raiz .'\views\Formulario.php';
					include Raiz . '\views\VistaListar.php';
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
						$titulo = "Eliminar";
			$listaEnvios = $this->modelo->TodosEnvios ();
			// include Raiz .'\views\Formulario.php';
			include Raiz . '\views\VistaListar.php';
		}
	}
	
	function InsertaEnvios() {
		$provincias = $this->modelo->ListarProvincias ();
		//$insertEnvio = $this->modelo->InsertaEnvios ( $datos );
		if($_POST){
			$consulta=$this->modelo->ObtenProvincia($_POST['provincia']);
			
			$resultado=array_merge($_POST,$consulta);
			//$this->pev($resultado);
			$this->modelo->InsertaEnvios($resultado);
			echo "Envio agregado";
		}else{
			
			$titulo="Insertar un envios";
			include Raiz . '\views\FormularioAgregar.php';
			
			
		}
		
	}
	
	function AnotaRecepcion() {
		$id = $this->modelo->ListaID ();
		$titulo = "Anotar Recepcion";
		$sinDatos = "";		
		if (is_array ( $id )) {
			foreach ( $id as $valor ) {
				$idenvios [] = $valor ['idenvios'];
			}
		}
		
		if(isset($_GET['idenvios'])){
			$existeId = $this->modelo->ExisteId ( $_GET ['idenvios'] );
			
			
			if($existeId){
				$envio=$this->modelo->MuestraEnvio($_GET['idenvios']);
				$this->pev($envio);
				if(is_array($envio))
				{
					$envio = $envio[0];
				}
				$this->pev($envio);
				//TODO:voy por aqui realizar el formulario para modificar el estado;
				
			}else{
				echo "Ese id no existe";
				include Raiz.'\views\FormularioAnotar.php';
			}
			
		}else{
			
			include Raiz.'\views\FormularioAnotar.php';
		}
		
		//$anotaRecepcion = $this->modelo->AnotaRecepcion ( $idRecepcion, $observaciones );
	}
	/**
	 * funcion para listar los envios, tiene paginacion
	 */
	function ListarEnvios() {
		$listaEnvios = $this->modelo->ListaEnvios ();
		$totalEnvios = $this->modelo->TotalEnvios ();
		$paginasTotales = $this->modelo->PaginasTotales ( $totalEnvios );
		$paginaActual = $this->modelo->PaginaActual ( $totalEnvios );
		$titulo = "Listar envios";
		
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
	 * funcion que recoge el valor post por defecto	 *
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
	 * funcion que recoge el valor get por defecto	 *
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
				'destinatario' => ValorPost ( 'destinatario' ),
				'telefono' => ValorPost ( 'telefono' ),
				'direccion' => ValorPost ( 'direccion' ),
				'poblacion' => ValorPost ( 'poblacion' ),
				'cod_postal' => ValorPost ( 'cod_postal' ),
				'provincia' => ValorPost ( 'provincia' ),
				'email' => ValorPost ( 'email' ),
				'estado' => ValorPost ( 'estado' ),
				'observaciones' => ValorPost ( 'observaciones' ) 
		);
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
		$html .= "<option value= '' selected=selected></option>";
		foreach ( $opciones as $clave => $valor ) {
			
			$html .= '<option value="' . $clave . '" ';
			
			$html .= ($clave == $valorPorDefecto) ? ' selected="selected">' . $valor : ' >' . $valor."";
			$html .= '</option>';
		}
		$html .= '</select>';
		return $html;
	}
	
	/**
	 *  Crea select para el id de envios 
	 * @param nombre del select $name
	 * @param array de datos $opciones
	 * @return string
	 */
		function CreaSelectID($name, $opciones) {
	
		$html = '';
	
		$html .= '<select name="' . $name . '">';
		$html.="<option value= '00' selected=selected></option>";
		foreach ( $opciones as $clave => $valor ) {
			
			$html .= '<option value=' . $valor . '>' . $valor."";
			//$html .= ($clave == $valorPorDefecto) ? ' selected="selected">' . $valor : ' >' . $valor."";
				
			$html .= '</option>';
		}
		$html .= '</select>';
		return $html;
	}
	
	
	
	
function pev($motrar){
	
	echo "<pre>";
	print_r($motrar);
	echo "</pre>";
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