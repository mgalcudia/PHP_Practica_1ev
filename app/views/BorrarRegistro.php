<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert title here</title>
</head>
<body>

<p>¿Desea borrar el registro <?=$_GET['id'] ?>?</p>
<p>
<a href="index.php?action=eliminar&id=<?=$_GET['id'] ?>&confirmar=si"><button>Yes</button></a>
<a href="index.php?action=eliminar&id=<?=$_GET['id'] ?>&confirmar=no"><button>No</button></a>
</p>

</body>
</html>



