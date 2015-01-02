<div class="contenedor">
<span class="titulo"><?= $titulo ?></span>
	<div class="formulario">
	<form action="?action=buscar" method="post">
		<p>
			Nombre: <input type="text" name="destinatario"
				value="<?=ValorPost('destinatario')?>">
				
		</p>
		<p>
				Provincia: <?=CreaSelect('provincia',$provincias,ValorPost('provincia'))?>
		</p>
		<p>
			Estado: <select name="estado">
				<option value="">----</option>
				<option value="p">Pendiente</option>
				<option value="e">Entregado</option>
				<option value="d">Devuelto</option>
			</select>
		</p>
		<p>										
				Codigo envios:<?=CreaSelectID('idenvios',$idenvios,ValorPost('idenvios'))?>
			</p>
		<p>
			<input type="submit" value="Buscar">
		</p>
	</form>
	</div>
<span class="sinDatos"><?=$sinDatos?> </span>
</div>