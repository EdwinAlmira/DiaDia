<!--INICIO DE LA SENTENCIA PHP --> 
<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['producto'] == 1)
  	 {

require("../procesos/validator.php");


Page::header("¿ELIMINAR CATEGORIA?"); // TEXTO DE ENCABEZADO DE LA PAGINA (CLASE PAGE)

if(!empty($_GET['id'])) 
{
    $id = base64_decode($_GET['id']);
}
else
{
    header("location: categorias.php");
}


if(!empty($_POST))
{
	$id = $_POST['id']; // ELIMINAMOS TODO LO  DE CATEGORIAS QUE TENGA EL ID INGRESADO
	try 
	{
		$sql = "DELETE FROM categorias WHERE id_categoria = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    ob_end_clean();
         header("location: categorias.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}
?>
<!-- FIN DE LA SENTENCIA PHP--> 

<!--BOTONES DE ELIMINAR Y ACEPTAR --> 
<br>
<br>
<div class="center-block">
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit' class='btn btn-info colordebotonmodificar col-md-2 col-md-offset-3'><i class='glyphicon glyphicon-pencil'></i> Aceptar</button>
	<a href='categorias.php'  class='btn btn-danger colordebotoneliminar col-md-2 col-md-offset-1'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
</form>
</div>

<?php
}else{
	header("location: error.php");
}
Page::footer(); //FOOTER DE LA CLASE PAGE

