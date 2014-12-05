<div class="formulario">
<form action="" method="post">
<div class="izquierda">

	<p>
		Código de envios: <input type="text" name="id" readonly="readonly" value="<?= $this->ValorGet('id')?>" />
	</p>

	<p>
		Destinatario : <input type="text" name="destinatario" value="<?=$campos['destinatario']?>" />)
	</p>
	<p>
		teléfono : <input type="text" name="telefono" value="<?=$this->ValorPost('telefono')?>" />
	</p>
	<!-- 
	<p>
		Población: <input type="text" name="poblacion" value="<?= $this->ValorPost('poblacion')?>" />
	</p> -->
	<p>
		Código Postal: <input type="text" name="cod_postal"	value="<?= $this->ValorPost('cod_postal')?>" />
	</p>
	<p>
			Provincia: <?= $this->CreaSelect('provincia',$provincias , $this->ValorPost('provincia'))?>
		</p>
	<p>
		Correo electronico: <input type="text" name="email"	value="<?= $this->ValorPost('email')?>" />
	</p>
	<p>
		Fecha de creacion: <input type="text" name="fec_creacion" value="<?= $this->ValorPost('fec_creacion')?>" />
	</p>
	<p>
		Fecha de entrega: <input type="text" name="fec_entrega"	value="<?= $this->ValorPost('fec_entrega')?>" />
	</p>
	<p>
		Observaciones:
		<textarea name="observaciones" rows="10" cols="15" value="<?= $this->ValorPost('observaciones')?>"></textarea>
	</p>
	<p><input type="submit" value="Modificar"> </p>
</div>
</form>
</div>
