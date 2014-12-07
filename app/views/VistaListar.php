
 
<div class="contenedor">
<span class="titulo"><?= $titulo ?></span>
			<table border='1'>
			<tr>
			<td>Número de envio</td>
			<td>Destinatario</td>			
			<td>Teléfono</td>
			<td>Dirección</td>
			<td>Población</td>
			<td>Código postal</td>
			<td>Numero provincia</td>
			<td>Correo electrónico</td>
			<td>Estado</td>
			<td>Fecha creación</td>
			<td>Fecha estrega</td>
			<td>Observaciones</td>
			<?php if($borrar):?>
			<td>Borrar</td>
			<?php  endif;
					if($modificar):?>
			<td>Modificar</td>
			<?php endif;  ?>
		</tr>
		

<?php

foreach ( $listaEnvios as $clave => $valor ) {
	echo "<tr>";
	foreach ( $valor as $informacion ) {
		echo "<td>";
		echo$informacion;
		echo "</td>";		
	}	
	if($borrar){
	echo "<td>";
	echo  '<a href=index.php?action=eliminar&id='.$valor['idenvios'] .'>Borrar</a>';
	echo "</td>";
	}
	if($modificar){
	echo "<td>";
	echo  '<a href=index.php?action=modificar&id='.$valor['idenvios'] .'>Modificar</a>';
	echo "</td>";
	}
	echo "</tr>";
}
 
echo"</table>";	

if(isset($paginasTotales)){
	echo '<a href=index.php?action=listar&pagina=0>Primera  </a>';
	for($i=1;$i<=$paginasTotales;$i++){
	
if($i==1 ||$i==$paginasTotales ||  $i==$paginaActual||($i > $paginaActual - 2 && $i <= $paginaActual + 2)){

	echo '<a href=index.php?action=listar&pagina='. $i .'>' . $i . '-</a>';
}


}
echo '<a href=index.php?action=listar&pagina='.$paginasTotales.'>Ultima  </a>';
}
	?>
</div>