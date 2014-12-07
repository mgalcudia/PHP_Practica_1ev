<?php /*
$this->pev($idenvios);
$this->pev($id);
foreach ( $idenvios as $clave => $valor ){
	echo "clave".$clave;
	echo "valor".$valor;
}
*/
?>
<span class="titulo"><?= $titulo ?></span>
<form action="?action=buscar" method="post">
	<p>
		Nombre: <input type="text" name="destinatario"
			value="<?=$this->ValorPost('destinatario')?>">
	</p>
	<p>
			Provincia: <?= $this->CreaSelect('provincia',$provincias)?>
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
			Codigo envios:<?=$this->CreaSelectID('idenvios',$idenvios)?>
		</p>
	<p>
		<input type="submit" value="Buscar">
	</p>
</form>
<span class="sinDatos"><?=$sinDatos?> </span>