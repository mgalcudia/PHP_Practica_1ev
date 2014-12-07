<?php
/**
 * MODELO
 */
require Raiz . '\db.php';
class modelo {
	private $bd;
	function __construct() {
		$this->bd = Db::getInstance ();
	}
	/**
	 * Función para averiguar el total de envios en la tabla envios
	 * 
	 * @return number
	 */
	function TotalEnvios() {
		$consulta = 'SELECT COUNT(*) as total FROM envios';
		$totalEnvios = $this->bd->Consulta ( $consulta );
		
		$resultado = $this->bd->LeeRegistro ( $totalEnvios );
		
		return $resultado ['total'];
	}
	
	/**
	 * Número totales de páginas en la paginacion
	 * 
	 * @param number $totalEnvios        	
	 * @return number
	 */
	function PaginasTotales($totalEnvios) {
		$enviosPagina = 3;
		
		$paginasTotal = ceil ( $totalEnvios / $enviosPagina );
		
		return $paginasTotal;
	}
	
	/**
	 * Página en la que nos encontramos ahora mismo
	 * 
	 * @param number $totalEnvios        	
	 * @return Ambigous <number, valor get de la página>
	 */
	function PaginaActual($totalEnvios) {
		if (isset ( $_GET ['pagina'] )) {
			
			$paginaActual = $_GET ['pagina'];
		} else {
			$paginaActual = 0;
		}
		if ($paginaActual < 1) {
			
			$paginaActual = 0;
		} elseif ($paginaActual > $totalEnvios) {
			
			$paginaActual = $totalEnvios;
		}
		
		return $paginaActual;
	}
	
	/**
	 * Listar los envios para paginacion, los introduce en un array asociativo
	 * 
	 * @return array
	 */
	function ListaEnvios() {
		$enviosPagina = 3;
		$paginaActual = $this->PaginaActual ( $enviosPagina );
		$paginaInicial = ($paginaActual - 1) * $enviosPagina;
		
		$consulta = 'SELECT * FROM envios order by fec_creacion desc limit ' . $paginaActual . ',' . $enviosPagina;
		$this->bd->Consulta ( $consulta );
		$resultado = [ ];
		while ( $registro = $this->bd->LeeRegistro () ) {
			$resultado [] = $registro;
		}
		return $resultado;
	}
	
	/**
	 * Listar todos los envios
	 * @return array
	 */
	function TodosEnvios(){
		
		$consulta = 'SELECT * FROM envios order by fec_creacion desc';
		$this->bd->Consulta ( $consulta );
		$resultado = [ ];
		while ( $registro = $this->bd->LeeRegistro () ) {
			$resultado [] = $registro;
		}
		return $resultado;
		
	}
	
	/**
	 * Funcion para intsertar envios en la tabla, recibe un array con los valores a insertar
	 * 
	 * @param array $datos        	
	 */
	function InsertaEnvios($datos) {
		$campos = [ ];
		$valores = [ ];
		
		foreach ( $datos as $campos => $valores ) {
			$camposArray [] = $campos;
			$valoresArray [] = $valores;
		}
		$camposUnidos = implode ( ",", $camposArray );
		$valoresUnidos = implode ( "' , '", $valoresArray );
		$consulta = "insert into envios (" . $camposUnidos . ")values( '" . $valoresUnidos . "' )";
		
		$this->bd->Consulta ( $consulta );
	}
	
	/**
	 * Función para modificar envios en la tabla
	 * 
	 * @param array $datos        	
	 * @param
	 *        	id de la tabla $id
	 */
	function ModificaEnvio($datos, $id) {
		$campos = [ ];
		$valores = [ ];
		
		foreach ( $datos as $campos => $valores ) {
			
			$camposArray [] = $campos . "=" . "'" . $valores . "'";
		}
		$camposIgualados = implode ( ",", $camposArray );
		
		$consulta = "update envios set " . $camposIgualados . " where idenvios= " . $id;
		
		$this->bd->Consulta($consulta );
		//return $consulta;
	}
	
	/**
	 * Función para eliminar envios de la tabla
	 * 
	 * @param
	 *        	id de la tabla $id
	 */
	function EliminaEnvios($id) {
		$consulta = "delete from envios where idenvios= " . $id;
		
		// return $consulta;
		
		$this->bd->Consulta ( $consulta );
	}
	
	/**
	 * Función para anotar una recepcion
	 * 
	 * @param
	 *        	id de la tabla $id
	 * @param array $observaciones        	
	 */
	function AnotaRecepcion($observaciones,$id ) {
		$consulta = "update envios set estado = 'e', fec_entrega = curdate(), observaciones= '" . $observaciones . "' where idenvios= " . $id;
		
		if ($consulta) {
			
			$this->bd->Consulta ( $consulta );
			echo "Recepción anotada con éxito!";
		} else {
			echo "Error de consulta";
		}
		// return $consulta;
	}
	
	/**
	 * Función para buscar envios					
	 * 
	 * @param array $datos        	
	 * @return array asociativo con los datos del envio
	 */
	function BuscarEnvios($datos) {
		$campos = [ ];
		$valores = [ ];
		foreach ( $datos as $campos => $valores ) {
			
			$valoresUnidos [] = $campos ." like " . "'" . $valores . "'";
		}
		$camposUnidos = implode ( " or ", $valoresUnidos );
		
		$consulta = "select * from envios where " . $camposUnidos;

		$this->bd->Consulta ( $consulta );
		$resultado = [ ];
		while ( $registro = $this->bd->LeeRegistro () ) {
			$resultado [] = $registro;
					
		}
		
		//return $consulta;
		
		return $resultado;
	}
	/**
	 * Muestra los datos de un envio concreto 
	 * @param id_envios $datos
	 * @return array
	 */
	function MuestraEnvio($idenvios){
		
		$consulta= "SELECT * FROM envios WHERE idenvios =".$idenvios;
		
		$this->bd->Consulta ( $consulta );
		$resultado = [ ];
		while ( $registro = $this->bd->LeeRegistro()) {
			$resultado [] = $registro;				
		}

		return $resultado;		
	}
	
	/**
	 * Lista todos los Idenvios existentes en la tabla
	 * @return Array
	 */
	function ListaID(){
		
		$consulta= "SELECT idenvios FROM envios";
		$this->bd->Consulta ( $consulta );
		
		while ( $registro = $this->bd->LeeRegistro()) {
			$resultado [] = $registro;
		}
		
		return $resultado;
		
		
	}
	
	/**
	 * funcion para listar las provincias de forma ordenadas
	 * 
	 * @return array
	 */
	function ListarProvincias() {
		$consulta = "select * from provincias order by id_provincias";
		$this->bd->Consulta ( $consulta );
		$resultado = [ ];
		while ( $registro = $this->bd->LeeRegistro () ) {
			$resultado [$registro ['id_provincias']] = $registro ['nombre'];
		}
		return $resultado;
	}
	
	
	function ObtenProvincia($id){
		$consulta= "select nombre from provincias where id_provincias=".$id;
		$this->bd->Consulta($consulta);
		while($registro=$this->bd->LeeRegistro()){
			
			$resultado['poblacion']=$registro['nombre'];
		}
		return $resultado;
		//return $consulta;
	}
	
	
	/**
	 * Función para comprobar si existe una id de un pedido
	 * 
	 * @param numerico $id        	
	 * @return boolean
	 */
	function ExisteId($id) {
		$consulta = "select count(*) as total from envios where idenvios=" . $id;
		$resultado = $this->bd->Consulta ( $consulta );
		$numero = $this->bd->LeeRegistro ( $resultado );
		
		if ($numero ['total']) {
			
			$existe = true;
		} else {
			$existe = false;
		}
		
		return $existe;
	}
}

