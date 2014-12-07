<div class="formulario">
<form action="" method="post">
<div class="izquierda">
<span class="titulo"><?= $titulo ?></span>
	<p>
		Código de envios: <input type="text" name="idenvios" readonly="readonly" value="<?= $envio['idenvios']?>" />
	</p>

	<p>
		Destinatario : <input type="text" name="" readonly="readonly" value="<?=$envio['destinatario']?>" />
	</p>
	<p>
		Direccion : <input type="text" name="" readonly="readonly" value="<?=$envio['direccion']?>" />
	</p>
	<p>
		Teléfono : <input type="text" name="" readonly="readonly" value="<?=$envio['telefono']?>" />
	</p>
		<p>
		Estado: <input type="text" name="" readonly="readonly" value="entregado" />
	</p>
	<p>
		Código Postal: <input type="text" name="" readonly="readonly"	value="<?= $envio['cod_postal']?>" />
	</p>
	<p>
			Provincia: <input type="text" name="" readonly="readonly"	value="<?= $envio['poblacion']?>" />
		</p>
	<p>
		Correo electronico: <input type="text" name="" readonly="readonly"	value="<?= $envio['email']?>" />
	</p>
	<p>
		Fecha de creacion: <input type="date" name="" readonly="readonly" value="<?= $envio['fec_creacion']?>" />
	</p>

	<p>
		Observaciones:
		</p>
		<p>
		<textarea name="observaciones" rows="5" cols="50" value="<?= $envio['observaciones']?>"></textarea>
	</p>
	  Los datos se guardarán de la siguiente forma.
	<p><input type="submit" value="Aceptar"> </p>
</div>
</form>
</div>
