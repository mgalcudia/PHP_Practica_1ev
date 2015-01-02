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
			
					if ($_POST) { // si hay post incluye los datos
						$error=Filtrado($_POST);
						//$this->pev($error);
						unset ( $_POST ['id'] );//Quitamos el id del post
						
						if(($_POST ['provincia'])){
						$consulta = $this->modelo->ObtenProvincia ( $_POST ['provincia'] );						
						$resultado = array_merge ( $_POST, $consulta );
						}
						if ($error){
							
							$titulo = "Modificar envios";
							include Raiz . '\views\ModificaFormulario.php';
						}else{
							
						$consulta = $this->modelo->ModificaEnvio ( $resultado, $_GET ['id'] );
						header ( 'Location:index.php?action=listar' );	
							
						}
					} else {
						$campos = $this->modelo->MuestraEnvio ( $_GET ['id'] );
						
						if (is_array ( $campos )) {
							$envio = $campos [0];
						}
						$titulo = "Modificar envios";
						include Raiz . '\views\ModificaFormulario.php';
						// no hay post
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
			//$error= $this->Filtrado($_POST);
			$error= Filtrado($_POST);
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
	
	
}
