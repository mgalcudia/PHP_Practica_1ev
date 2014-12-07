<div class="formulario">

<form action="" method="post">
<div class="izquierda">
<span class="titulo"><?= $titulo ?></span>

	<p>
		Destinatario : <input type="text" name="destinatario" value="<?=$this->ValorPost('destinatario')?>" />
	</p>
	<p>
		Direccion : <input type="text" name="direccion" value="<?=$this->ValorPost('direccion')?>" />
	</p>
	<p>
		Teléfono : <input type="text" name="telefono" value="<?=$this->ValorPost('telefono')?>" />
	</p>
	

	<p>
		Código Postal: <input type="text" name="cod_postal"	value="<?=$this->ValorPost('cod_postal')?>" />
	</p>
	<p>
			Provincia: <?= $this->CreaSelect('provincia',$provincias)?>
		</p>
	<p>
		Correo electronico: <input type="text" name="email"	value="<?=$this->ValorPost('email')?>" />
	</p>
	<p>
		Fecha de creacion: <input type="date" name="fec_creacion" value="<?=$this->ValorPost('fec_creacion')?>" />
	</p>

	<p>
		Observaciones:
		</p>
		<p>
		<textarea name="observaciones" rows="5" cols="50" value="<?=$this->ValorPost('observaciones')?>"></textarea>
	</p>
	<p><input type="submit" value="Modificar"> </p>
</div>
</form>
</div>
