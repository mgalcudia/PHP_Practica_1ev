<div class="cambiarid">
<p>Cambiar id:  <?=$_GET['id'] ?></p>
<form action="index.php" method="get" >
<input type="text" name="id"/>
<input type="hidden" name="action" value="modificar">
<input type="hidden" name="confirmar" value="si" >
<p><input type="submit" value="Modificar"> </p>
</form>
</div>