<?php
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
	if(isset($datos['cod_envio']))
	{
		if($datos['cod_envio']==='')
		{
			$err['cod_envio'] = $msj['cod_envio_no_especificado'];
		}
		else
		{
			if(!filter_var($datos['cod_envio'], FILTER_VALIDATE_INT,
					array( 'options' => array('min_range' => 1, 'max_range' => 99999999999))))
			{
				$err['cod_envio'] = $msj['cod_envio_no_valido'];
			}
		}
	}
	if(isset($datos['destinatario']))
	{
		if(empty($datos['destinatario']))
		{
			$err['destinatario'] = $msj['destinatario_no_especificado'];
		}
		else
		{
			$patron = "/^[a-zA-ZaáéíóúäëïöüÁÉÍÓÚÄËÏÖÜñÑ ]+/";
			if(!preg_match($patron, $datos['destinatario']))
			{
				$err['destinatario'] = $msj['destinatario_no_valido'];
			}
		}
	}
	if(isset($datos['telefono']))
	{
		if($datos['telefono']==='')
		{
			$err['telefono'] = $msj['telefono_no_especificado'];
		}
		else
		{
			$patron = "/(?!:\A|\s)(?!(\d{1,6}\s+\D)|((\d{1,2}\s+){2,2}))(((\+\d{1,3})
                |(\(\+\d{1,3}\)))\s*)?((\d{1,6})|(\(\d{1,6}\)))\/?(([ -.]?)\d{1,5}){1,5}((\s*
                (#|x|(ext))\.?\s*)\d{1,5})?(?!:(\Z|\w|\b\s))/";
			if(!preg_match($patron, $datos['telefono']))
			{
				$err['telefono'] = $msj['telefono_no_valido'];
			}
		}
	}
	if(isset($datos['direccion'])) {
		$patron = "/^[a-zA-Z 0-9 üÜáéíóúÁÉÍÓÚñÑ,.-ºª\"]{1,45}$/";
		if (!$datos['direccion']==='') {
			if (!preg_match($patron, $datos['direccion'])) {
				$err['direccion'] = $msj['direccion_no_valida'];
			}
		}
	}
	if(isset($datos['poblacion']))
	{
		if(!$datos['poblacion']==='')
		{
			if(!preg_match("/^[a-zA-Z ]{1,25}$/", $datos['poblacion']))
			{
				$err['poblacion'] = $msj['poblacion_no_valida'];
			}
		}
	}
	if(isset($datos['cod_postal']))
	{
		if($datos['cod_postal']!=='')
		{
			$patron = "/^0[1-9][0-9]{3}|[1-4][0-9]{4}|5[0-2][0-9]{3}$/";
			if(!preg_match($patron, $datos['cod_postal']))
			{
				$err['cod_postal'] = $msj['cod_postal_no_valido'];
			}
		}
	}
	if(isset($datos['provincia']))
	{
		if($datos['provincia']==='00')
		{
			$err['provincia'] = $msj['provincia_no_especificada'];
		}
		else
		{
			$patron = "/^0[1-9]|[1-4][0-9]|5[0-2]$/";
			if(!preg_match($patron, $datos['provincia']))
			{
				$err['provincia'] = $msj['provincia_no_valida'];
			}
		}
	}
	if(isset($datos['email']))
	{
		if($datos['email']==='')
		{
			$err['email'] = $msj['email_no_especificado'];
		}
		else
		{
			if(!filter_var($datos['email'], FILTER_VALIDATE_EMAIL))
			{
				$err['email'] = $msj['email_no_valido'];
			}
		}
	}
	return $err;
}
