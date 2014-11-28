<?php
/**
 * MODELO
 */

require Raiz.'\db.php';

class modelo{
	
	private $bd;
	
	function __construct(){
		
		$this->bd=Db::getInstance();
	}
		
	function TotalEnvios(){
		$consulta='SELECT COUNT(*) as total FROM envios';
		$totalEnvios = $this->bd->Consulta($consulta);
		
		$resultado = $this->bd->LeeRegistro($totalEnvios);
		
		return $resultado['total'];
	}
	
	function PaginasTotales($totalEnvios){
		$enviosPagina=3;
		
		$paginasTotal= ceil($totalEnvios/$enviosPagina);
		
		return $paginasTotal;
		
		
	}
	
	function PaginaActual($totalEnvios){
		
	
		if(isset($_GET['pagina'])){
				
			$paginaActual= $_GET['pagina'];
		}else{
			$paginaActual=0;
				
		}
		if($paginaActual< 1){
				
			$paginaActual=0;
		}
		elseif ($paginaActual>$totalEnvios){
				
			$paginaActual=$totalEnvios;
		}
	
		return $paginaActual;
	
	}
	
	function ListaEnvios(){
		$enviosPagina=3;
		$paginaActual= $this->PaginaActual($enviosPagina);
		$paginaInicial= ($paginaActual-1)*$enviosPagina;
	
		$consulta='SELECT * FROM envios order by fec_creacion desc limit '.$paginaActual.','.$enviosPagina;
		$this->bd->Consulta($consulta);
		$resultado= [];
		while ($registro= $this->bd->LeeRegistro()){
			$resultado[]=$registro;
	
		}
		return $resultado;
	
	}
	
	
	function InsertaEnvios($datos){
		
		$campos=[];
		$valores=[];
				
		foreach ($datos as $campos => $valores){			
			$camposArray[]=$campos;
			$valoresArray[]=$valores;				
		}
		$camposUnidos= implode(",", $camposArray);
		$valoresUnidos=implode("' , '", $valoresArray);
		$consulta= "insert into envios (".$camposUnidos.")values( '".$valoresUnidos."' )";
		
		
		 $this->bd->Consulta($consulta);
		
		
		//return $consulta;
	}
	
	function ModificaEnvio($datos, $id){
		
		$campos=[];
		$valores=[];
	
		foreach ($datos as $campos => $valores){
			
			$camposArray[]= $campos."="."'".$valores."'";			
		}
		$camposIgualados= implode(",",$camposArray);
		
		$consulta= "update envios set ".$camposIgualados." where idenvios= ".$id; 
		
		$this->bd->Consulta($consulta);
		// return $consulta;
	}
	
	
	function  EliminaEnvios($id){
		
		$consulta= "delete from envios where idenvios= ".$id;
		
		//return $consulta;
		
		$this->bd->Consulta($consulta);		
		
	}
	
	function AnotaRecepcion($id,$observaciones){
		
		
		$consulta = "update envios set estado = 'e', fec_entrega = curdate(), observaciones= '".$observaciones."' where idenvios= ".$id;
		
		if($consulta){
			
			$this->bd->Consulta($consulta);
			echo "Recepción anotada con éxito!";
		}
		else {
			echo "Error de consulta";
		}
		 // return $consulta;	
	}
	
	
	function BuscarEnvios($datos){		
		$campos=[];
		$valores=[];
		foreach ($datos as $campos => $valores){
			
			$valoresUnidos[]= $campos." like "."'".$valores."'";
			
			
		}
		$camposUnidos= implode(" and ", $valoresUnidos);
				
		$consulta= "select * from envios where ".$camposUnidos;		
		$this->bd->Consulta($consulta);
		$resultado= [];
		while ($registro= $this->bd->LeeRegistro()){
			$resultado[]=$registro;	
		}
		return $resultado;		
		
		
	}
	
	
	
	
	
	
	
}

