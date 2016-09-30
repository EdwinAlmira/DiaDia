<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['personal'] == 1)
  	 {

//Cargamos los archivos que se requieren
require("../procesos/validator.php");
Page::header("¿ELIMINAR MODULO?");
//Verificamos si el id esta vacio
if(!empty($_GET['id'])) 
{
    $id = base64_decode($_GET['id']);
}
//Si es asi que lo redireccione a la siguiente pagina
else
{
    header("location: modulos.php");
}
//Si el id esta, realizamos el proceso
if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM modulos WHERE id_modulo = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    ob_end_clean();
         header("location: modulos.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}
?>
<div class="center-block">
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit' class='btn btn-info colordebotonmodificar col-md-2 col-md-offset-3'><i class='glyphicon glyphicon-pencil'></i>ACEPTAR</button>
	<a href='modulos.php' <a href='index.php'  class='btn btn-danger colordebotoneliminar col-md-2 col-md-offset-1'><i class='glyphicon glyphicon-remove'></i>CANCELAR</a>
</form>
</div>
<?php
}else{
	header("location: error.php");
}
Page::footer();

?>