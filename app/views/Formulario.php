
<form action="" method="post">

	<p>
		Código de envios: <input type="text" name="id" value="<?= ValorPost('provincia')?>" />
	</p>

	<p>
		Destinatario : <input type="text" name="destinatario" value="<?= ValorPost('destinatario')?>" />
	</p>
	<p>
		teléfono : <input type="text" name="telefono" value="<?= ValorPost('telefono')?>" />
	</p>
	<p>
		Población: <input type="text" name="poblacion" value="<?= ValorPost('poblacion')?>" />
	</p>
	<p>
		Código Postal: <input type="text" name="cod_postal"	value="<?= ValorPost('cod_postal')?>" />
	</p>
	<p>
			Provincia: <?= CreaSelect('provincia',$provincias , ValorPost('provincia'))?>
		</p>
	<p>
		Correo electronico: <input type="text" name="email"	value="<?= ValorPost('email')?>" />
	</p>
	<p>
		Fecha de creacion: <input type="text" name="fec_creacion" value="<?= ValorPost('fec_creacion')?>" />
	</p>
	<p>
		Fecha de entrega: <input type="text" name="fec_entrega"	value="<?= ValorPost('fec_entrega')?>" />
	</p>
	<p>
		Observaciones:
		<textarea name="observaciones" rows="10" cols="15" value="<?= ValorPost('observaciones')?>"></textarea>
	</p>

</form>

