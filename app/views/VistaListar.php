<!-- 
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert title here</title>
</head>
<body>
 -->
 <?php

	echo	"<table border='1'>";
	echo	"<tr>
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
			<td>Borrar</td>
			<td>Modificar</td>
			
		</tr>";
		



foreach ( $listaEnvios as $clave => $valor ) {
	echo "<tr>";
	foreach ( $valor as $informacion ) {
		echo "<td>";
		echo$informacion;
		echo "</td>";		
	}	
	echo "<td>";
	echo  '<a href=index.php?action=eliminar&id='.$valor['idenvios'] .'>Borrar</a>'; ;
	echo "</td>";
	echo "<td>";
	echo"modificar";
	echo "</td>";
	echo "</tr>";
}
 
echo"</table>";	

	echo '<a href=index.php?action=listar&pagina=0>Primera  </a>';
	for($i=0;$i<$paginasTotales;$i++){
	
if($i==1 ||$i==$paginasTotales ||  $i==$paginaActual||($i > $paginaActual - 2 && $i <= $paginaActual + 2)){

	echo '<a href=index.php?action=listar&pagina='. $i .'>' . $i . '-</a>';
}


}
echo '<a href=index.php?action=listar&pagina='.$paginasTotales.'>Ultima  </a>';
	?>
<!--  
</body>
</html>
-->