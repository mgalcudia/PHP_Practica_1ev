<?php
include Raiz . '\models\modelo.php';

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
	 *
	 * @param unknown $datosmodificado        	
	 * @param unknown $id        	
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
						unset ( $_POST ['id'] );
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
		// $insertEnvio = $this->modelo->InsertaEnvios ( $datos );
		if ($_POST) {
			$consulta = $this->modelo->ObtenProvincia ( $_POST ['provincia'] );
			
			$resultado = array_merge ( $_POST, $consulta );
			// $this->pev($resultado);
			$this->modelo->InsertaEnvios ( $resultado );
			echo "Envio agregado";
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
				echo "Ese id no existe";
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
	function pev($motrar) {
		echo "<pre>";
		print_r ( $motrar );
		echo "</pre>";
	}
}
