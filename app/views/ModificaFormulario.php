<span class="titulo"><?= $titulo ?></span>
<div class="formulario">
<form action="" method="post">
	<p>
		Código de envios: <input type="text" name="id" readonly="readonly" value="<?= $this->ValorGet('id')?>" />

	</p>

	<p>
		Destinatario : <input type="text" name="destinatario" value="<?=(isset($envio['destinatario']))?$envio['destinatario']:$this->ValorPost('destinatario')?>" />
		<div class="error"> <?=(isset($error['destinatario']))?$error['destinatario']:''?> </div>
	</p> 

	<p>
		Direccion : <input type="text" name="direccion" value="<?=(isset($envio['direccion']))?$envio['direccion']:$this->ValorPost('direccion')?>" />
				<div class="error"> <?=(isset($error['direccion']))?$error['direccion']:''?> </div>
	</p>
	<p>
		Teléfono : <input type="text" name="telefono" value="<?=(isset($envio['telefono']))?$envio['telefono']:$this->ValorPost('telefono')?>" />
		<div class="error"> <?=(isset($error['telefono']))?$error['telefono']:''?></div>
	</p>
	<p>
		Código Postal: <input type="text" name="cod_postal"	value="<?=(isset($envio['cod_postal']))?$envio['cod_postal']:$this->ValorPost('cod_postal')?>" />
		<div class="error"> <?=(isset($error['cod_postal']))?$error['cod_postal']:''?> </div>
	</p>
	<p>
			Provincia: <?= $this->CreaSelect('provincia',$provincias,(isset($envio['provincia']))?$envio['provincia']:$this->ValorPost('provincia'))?>
			<div class="error"> <?=(isset($error['provincia']))?$error['provincia']:''?> </div>
		</p>
	<p>
		Correo electronico: <input type="text" name="email"	value="<?=(isset($envio['email']))?$envio['email']:$this->ValorPost('email')?>" />
		<div class="error"> <?=(isset($error['email']))?$error['email']:''?> </div>
	</p>
	<p>
		Fecha de creacion: <input type="date" name="fec_creacion" readonly="readonly" value="<?= (isset($envio['fec_creacion']))?$envio['fec_creacion']:$this->ValorPost('fec_creacion')?>" />
		<div class="error"> <?=(isset($error['fec_creacion']))?$error['fec_creacion']:''?> </div>
	</p>

	<p>
		Observaciones:
		</p>
		<p>
		<textarea name="observaciones" rows="5" cols="50" value="<?= $envio['observaciones']?>"></textarea>
	</p>
	<p><input type="submit" value="Aceptar"> </p>

</form>
</div>
