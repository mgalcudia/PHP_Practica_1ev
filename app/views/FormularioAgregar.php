<span class="titulo"><?= $titulo ?></span>
<div class="formulario">
<form action="" method="post">
	<p>
		Destinatario : <input type="text" name="destinatario" value="<?=$this->ValorPost('destinatario')?>" />
		<div class="error"> <?=(isset($error['destinatario']))?$error['destinatario']:''?> </div>
	</p>
	<p>
		Direccion : <input type="text" name="direccion" value="<?=$this->ValorPost('direccion')?>" />
		<div class="error"> <?=(isset($error['direccion']))?$error['direccion']:''?> </div>
	</p>
	<p>
		Teléfono : <input type="text" name="telefono" value="<?=$this->ValorPost('telefono')?>" />
		<div class="error"> <?=(isset($error['telefono']))?$error['telefono']:''?></div>
	</p>
	<p>
		Código Postal: <input type="text" name="cod_postal"	maxlength="5" value="<?=$this->ValorPost('cod_postal')?>" />
		<div class="error"> <?=(isset($error['cod_postal']))?$error['cod_postal']:''?></div> 
	</p>
	<p>
			Provincia: <?= $this->CreaSelect('provincia',$provincias,$this->ValorPost('provincia'))?>
			<div class="error"> <?=(isset($error['provincia']))?$error['provincia']:''?> </div>
		</p>
	<p>
		Correo electronico: <input type="text" name="email"	value="<?=$this->ValorPost('email')?>" />
		<div class="error"> <?=(isset($error['email']))?$error['email']:''?> </div>
	</p>
	<p>
	
		Fecha de creacion: <input type="date" readonly="readonly" name="fec_creacion" value="<?=date('Y-m-d')?>" />
		
	</p>

	<p>
		Observaciones:

		<textarea name="observaciones" rows="5" cols="50" value="<?=$this->ValorPost('observaciones')?>"></textarea>
	</p>
	<p><input type="submit" value="Aceptar"> </p>

</form>
</div>
