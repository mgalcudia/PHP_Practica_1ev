<div class="formulario">
<form action="" method="get">

<div class="izquierda">
<span class="titulo"><?=$titulo?></span>
<p>
Seleccione el pedido entregado:
</p>
<input type="hidden" name="action" value="anotar" />
	 <p>										
			Codigo envios:<?=$this->CreaSelectID('idenvios',$idenvios)?>
		</p>


	<p><input type="submit" value="Modificar"> </p>

</div>
</form>
</div>