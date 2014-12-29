<?php
include Raiz . '\models\modelo.php';
include Raiz.'\helpers\configuracion.php';

$modelo = new modelo ();
class controlador {
	
	/**
	 * constructor de modelo
	 */
	function __construct() {
		$this->modelo = new modelo ();
		
	}
	
	
	/**
	 * funcion para buscar los envios
	 */
	function BusquedaEnvios() {
		$provincias = $this->modelo->ListarProvincias ();
		$id = $this->modelo->ListaID ();
		$titulo = "Buscar envios";
		$sinDatos = "";
		$borrar=false;
		$modificar=false;
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
 */
	function ModificaEnvios() {
		$borrar = false;
		$modificar = true;
		$provincias = $this->modelo->ListarProvincias ();
		if (isset ( $_GET ['id'] )) {
			$existeId = $this->modelo->ExisteId ( $_GET ['id'] );
			if ($existeId) {
				if (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "si") {
					if ($_POST) { // si hay post incluye los datos
						unset ( $_POST ['id'] );//Quitamos el id del post
						$consulta = $this->modelo->ObtenProvincia ( $_POST ['provincia'] );
						
						$resultado = array_merge ( $_POST, $consulta );
						
						$consulta = $this->modelo->ModificaEnvio ( $resultado, $_GET ['id'] );
						header ( 'Location:index.php?action=listar' );
					} else {
						$campos = $this->modelo->MuestraEnvio ( $_GET ['id'] );
						
						if (is_array ( $campos )) {
							$envio = $campos [0];
						}
						$titulo = "Modificar envios";
						include Raiz . '\views\ModificaFormulario.php';
						// no hay post
					}
				} elseif (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "no") {
					header ( 'Location:index.php?action=listar' );
				} else {
					include Raiz . '\views\ModificarRegistro.php';
				}
			} else {
				include Raiz . '\views\CambiarIdModificar.php';
				// formulario para cambiar la id CambiarIdModificar.php
			}
		} else {
			$titulo = "Modificar";
			$listaEnvios = $this->modelo->TodosEnvios ();
			
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
		$borrar = true;
		$modificar = false;
		if (isset ( $_GET ['id'] )) {
			$eliminar = $this->modelo->ExisteId ( $_GET ['id'] ); // función para comprobar si existe una id
			if ($eliminar) {
				if (isset ( $_GET ['confirmar'] ) && $_GET ['confirmar'] == "si") {
					$this->modelo->EliminaEnvios ( $_GET ['id'] );
					$titulo = "Eliminar";
					$listaEnvios = $this->modelo->TodosEnvios ();
					
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
			include Raiz . '\views\VistaListar.php';
		}
	}
	
	/**
	 * funcion para insertar los envios
	 */
	function InsertaEnvios() {
		
		$provincias = $this->modelo->ListarProvincias ();
		
		if ($_POST) {
			
			$error= $this->Filtro($_POST);
			if(($_POST ['provincia']))
			{
			$consulta = $this->modelo->ObtenProvincia ( $_POST ['provincia'] );	
				
			$resultado = array_merge ( $_POST, $consulta );
			
			}
			
			 
			 if($error){
			 	
			 	$titulo = "Insertar envios";
			 	include Raiz . '\views\FormularioAgregar.php';
			 	
			 }else{

			 	$this->modelo->InsertaEnvios ( $resultado );
			    echo "Envio agregado";
			 	
			 }
			 
			 
			
		} else {
			
			$titulo = "Insertar envios";
			include Raiz . '\views\FormularioAgregar.php';
		}
	}
	
	/**
	 * funcion para anotar la rececion de pedidos
	 */
	function AnotaRecepcion() {
		$id = $this->modelo->ListaID ();
		$titulo = "Anotar Recepcion";
		$sinDatos = "";
		if (is_array ( $id )) {
			foreach ( $id as $valor ) {
				$idenvios [] = $valor ['idenvios'];
			}
		}
		
		if (isset ( $_GET ['idenvios'] )) {
			$existeId = $this->modelo->ExisteId ( $_GET ['idenvios'] );
			$provincias = $this->modelo->ListarProvincias ();
			
			if ($existeId) {
				$envio = $this->modelo->MuestraEnvio ( $_GET ['idenvios'] );
				
				if (is_array ( $envio )) {
					$envio = $envio [0];
				}
				
				if (($_POST)) {
					
					$this->modelo->AnotaRecepcion ( $_POST ['observaciones'], $_POST ['idenvios'] );
				} else {
					include Raiz . '\views\FormularioAnotar2.php';
				}
			} else {
				echo "Ese código de envio no existe";
				include Raiz . '\views\FormularioAnotar.php';
			}
		} else {
			include Raiz . '\views\FormularioAnotar.php';
		}
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
		$borrar = true;
		$modificar = true;
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
	 * funcion que recoge el valor post por defecto *
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
	 * funcion que recoge el valor get por defecto *
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
			
			$html .= ($clave == $valorPorDefecto) ? ' selected="selected">' . $valor : ' >' . $valor . "";
			$html .= '</option>';
		}
		$html .= '</select>';
		return $html;
	}
	
	/**
	 * Crea select para el id de envios
	 * 
	 * @param
	 *        	nombre del select $name
	 * @param
	 *        	array de datos $opciones
	 * @return string
	 */
	function CreaSelectID($name, $opciones) {
		$html = '';
		
		$html .= '<select name="' . $name . '">';
		$html .= "<option value= '00' selected=selected></option>";
		foreach ( $opciones as $clave => $valor ) {
			
			$html .= '<option value=' . $valor . '>' . $valor . "";
			// $html .= ($clave == $valorPorDefecto) ? ' selected="selected">' . $valor : ' >' . $valor."";
			
			$html .= '</option>';
		}
		$html .= '</select>';
		return $html;
	}
	
	/**
	 * Filtra los datos $datos y devuelve un array con los
	 * mensajes de error para cada campo
	 * @param $datos
	 * @return array
	 */
	function Filtro($datos=array())
	{
		//$msj = GetConfigValue('msjFiltroEnvios');
		$err = array();
		if(isset($datos['idenvios']))
		{
			if($datos['idenvios']==='')
			{
				$err['idenvios'] = 'idenvios no especificado';
			}
			else
			{
				if(!filter_var($datos['idenvios'], FILTER_VALIDATE_INT,
						array( 'options' => array('min_range' => 1, 'max_range' => 99999999999))))
				{
					$err['idenvios'] = 'idenvios no valido';
				}
			}
		}
		if(isset($datos['destinatario']))
		{
			if(empty($datos['destinatario']))
			{
				$err['destinatario'] = 'destinatario no especificado';
			}
			else
			{
				$patron = "/^[a-zA-ZaáéíóúäëïöüÁÉÍÓÚÄËÏÖÜñÑ ]+/";
				if(!preg_match($patron, $datos['destinatario']))
				{
					$err['destinatario'] = 'destinatario no valido';
				}
			}
		}
		if(isset($datos['telefono']))
		{
			if($datos['telefono']==='')
			{
				$err['telefono'] = 'telefono no especificado';
			}
			else
			{
				$patron = "/(?!:\A|\s)(?!(\d{1,6}\s+\D)|((\d{1,2}\s+){2,2}))(((\+\d{1,3})
                |(\(\+\d{1,3}\)))\s*)?((\d{1,6})|(\(\d{1,6}\)))\/?(([ -.]?)\d{1,5}){1,5}((\s*
                (#|x|(ext))\.?\s*)\d{1,5})?(?!:(\Z|\w|\b\s))/";
				if(!preg_match($patron, $datos['telefono']))
				{
					$err['telefono'] = 'telefono no valido';
				}
			}
		}
		if(isset($datos['direccion'])) {
			//$err['direccion'] = 'direccion_no_especificada';
			$patron = "/^[a-zA-Z 0-9 üÜáéíóúÁÉÍÓÚñÑ,.-ºª\"]{1,45}$/";
			if ($datos['direccion']==='') {
				$err['direccion'] = 'direccion no especificada';
			}else {
				if (!preg_match($patron, $datos['direccion'])) {
					$err['direccion'] = 'direccion no valida';
				}
			}
		}
		if(isset($datos['poblacion']))
		{
			if(!$datos['poblacion']==='')
			{
				if(!preg_match("/^[a-zA-Z ]{1,25}$/", $datos['poblacion']))
				{
					$err['poblacion'] = 'poblacion no valida';
				}
			}
		}
		if(isset($datos['cod_postal']))
		{
			$patron = "/^0[1-9][0-9]{3}|[1-4][0-9]{4}|5[0-2][0-9]{3}$/";
			if($datos['cod_postal']==='')
			{
				$err['cod_postal'] = 'cod postal no especificada';
			}else{
				if(!preg_match($patron, $datos['cod_postal']))
				{
					$err['cod_postal'] = 'cod postal no valido';
				}
			}
		}
		if(isset($datos['provincia']))
		{
			if($datos['provincia']==='00')
			{
				$err['provincia'] = 'provincia no especificada';
			}
			else
			{
				$patron = "/^0[1-9]|[1-4][0-9]|5[0-2]$/";
				if(!preg_match($patron, $datos['provincia']))
				{
					$err['provincia'] = 'provincia no valida';
				}
			}
		}
		if(isset($datos['email']))
		{
			if($datos['email']==='')
			{
				$err['email'] = 'email no especificado';
			}
			else
			{
				if(!filter_var($datos['email'], FILTER_VALIDATE_EMAIL))
				{
					$err['email'] = 'email no valido';
				}
			}
		}
		return $err;
	}
	
	function pev($motrar) {
		echo "<pre>";
		echo "resultado";
		print_r ( $motrar );
		echo "</pre>";
	}
}
