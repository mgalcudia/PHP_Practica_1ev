<?php
/**
 * Filtra los datos $datos y devuelve un array con los
 * mensajes de error para cada campo
 * @param $datos
 * @return array
 */
function Filtrado($datos=array())
	{
		
		$error = array();
		if(isset($datos['idenvios']))
		{
			if($datos['idenvios']==='')
			{
				$error['idenvios'] = 'idenvios no especificado';
			}
			else
			{
				if(!filter_var($datos['idenvios'], FILTER_VALIDATE_INT,
						array( 'options' => array('min_range' => 1, 'max_range' => 99999999999))))
				{
					$error['idenvios'] = 'idenvios no valido';
				}
			}
		}
		if(isset($datos['destinatario']))
		{
			if(empty($datos['destinatario']))
			{
				$error['destinatario'] = 'destinatario no especificado';
			}
			else
			{
				$patron = "/^[a-zA-ZaáéíóúäëïöüÁÉÍÓÚÄËÏÖÜñÑ ]+/";
				if(!preg_match($patron, $datos['destinatario']))
				{
					$error['destinatario'] = 'destinatario no valido';
				}
			}
		}
		if(isset($datos['telefono']))
		{
			if($datos['telefono']==='')
			{
				$error['telefono'] = 'telefono no especificado';
			}
			else
			{
				$patron = "/(?!:\A|\s)(?!(\d{1,6}\s+\D)|((\d{1,2}\s+){2,2}))(((\+\d{1,3})
                |(\(\+\d{1,3}\)))\s*)?((\d{1,6})|(\(\d{1,6}\)))\/?(([ -.]?)\d{1,5}){1,5}((\s*
                (#|x|(ext))\.?\s*)\d{1,5})?(?!:(\Z|\w|\b\s))/";
				if(!preg_match($patron, $datos['telefono']))
				{
					$error['telefono'] = 'telefono no valido';
				}
			}
		}
		if(isset($datos['direccion'])) {
			//$error['direccion'] = 'direccion_no_especificada';
			$patron = "/^[a-zA-Z 0-9 üÜáéíóúÁÉÍÓÚñÑ,.-ºª\"]{1,45}$/";
			if ($datos['direccion']==='') {
				$error['direccion'] = 'direccion no especificada';
			}else {
				if (!preg_match($patron, $datos['direccion'])) {
					$error['direccion'] = 'direccion no valida';
				}
			}
		}
		if(isset($datos['poblacion']))
		{
			if(!$datos['poblacion']==='')
			{
				if(!preg_match("/^[a-zA-Z ]{1,25}$/", $datos['poblacion']))
				{
					$error['poblacion'] = 'poblacion no valida';
				}
			}
		}
		if(isset($datos['cod_postal']))
		{
			$patron = "/^0[1-9][0-9]{3}|[1-4][0-9]{4}|5[0-2][0-9]{3}$/";
			if($datos['cod_postal']==='')
			{
				$error['cod_postal'] = 'cod postal no especificada';
			}else{
				if(!preg_match($patron, $datos['cod_postal']))
				{
					$error['cod_postal'] = 'cod postal no valido';
				}
			}
		}
		if(isset($datos['provincia']))
		{
			if($datos['provincia']==='00')
			{
				$error['provincia'] = 'provincia no especificada';
			}
			else
			{
				$patron = "/^0[1-9]|[1-4][0-9]|5[0-2]$/";
				if(!preg_match($patron, $datos['provincia']))
				{
					$error['provincia'] = 'provincia no valida';
				}
			}
		}
		if(isset($datos['email']))
		{
			if($datos['email']==='')
			{
				$error['email'] = 'email no especificado';
			}
			else
			{
				if(!filter_var($datos['email'], FILTER_VALIDATE_EMAIL))
				{
					$error['email'] = 'email no valido';
				}
			}
		}
		return $error;
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
 *  Funcion para comprobar el array de datos tal como se recibe
 * @param Array $motrar
 */
function pev($motrar) {
		echo "<pre>";
		echo "resultado";
		print_r ( $motrar );
		echo "</pre>";
	}