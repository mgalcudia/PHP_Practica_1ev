
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert title here</title>
</head>
<body>
 
	<table border="1">
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
		</tr>
		

<?php

foreach ( $listaEnvios as $clave => $valor ) {
	echo "<tr>";
	foreach ( $valor as $informacion ) {
		echo "<td>";
		echo$informacion;
		echo "</td>";		
	}	
	echo "</tr>";
}

 ?>



 
	</table>
	<?php 
	
	for($i=0;$i<$paginasTotales;$i++){
	
if($i==1 ||$i==$paginasTotales ||  $i==$paginaActual||($i > $paginaActual - 2 && $i <= $paginaActual + 2)){

	echo '<a href=?pagina=' . $i .'>' . $i . '</a>';
}


}

	
	?>

</body>
</html>