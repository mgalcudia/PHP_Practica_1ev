<div class="formulario">
<form action="?action=modificar" method="post">
<div class="izquierda">

	<p>
		Código de envios: <input type="text" name="id" readonly="readonly" value="<?= $this->ValorGet('id')?>" />
	</p>

	<p>
		Destinatario : <input type="text" name="destinatario" value="<?=$envio['destinatario']?>" />
	</p>
	<p>
		Teléfono : <input type="text" name="telefono" value="<?=$envio['telefono']?>" />
	</p>
	
	<p>
		Población: <input type="text" name="poblacion" value="<?= $envio['poblacion']?>" />
	</p> 
	<p>
		Código Postal: <input type="text" name="cod_postal"	value="<?= $envio['cod_postal']?>" />
	</p>
	<p>
			Provincia: <?= $this->CreaSelect('provincia',$provincias , $envio['provincia'])?>
		</p>
	<p>
		Correo electronico: <input type="text" name="email"	value="<?= $envio['email']?>" />
	</p>
	<p>
		Fecha de creacion: <input type="date" name="fec_creacion" value="<?= $envio['fec_creacion']?>" />
	</p>
	<p>
		Fecha de entrega: <input type="date" name="fec_entrega"	value="<?= $envio['fec_entrega']?>" />
	</p>
	<p>
		Observaciones:
		</p>
		<p>
		<textarea name="observaciones" rows="5" cols="50" value="<?= $envio['observaciones']?>"></textarea>
	</p>
	<p><input type="submit" value="Modificar"> </p>
</div>
</form>
</div>
