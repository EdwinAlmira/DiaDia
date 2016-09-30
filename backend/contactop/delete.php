
<!-- COMIENZO DE LAS SENTENCIA PHP--> 

<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO--> 

<?php
require("../pagina.php");
require("../procesos/database.php");
require("../procesos/validator.php");
Page::header("Eliminar peronal");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: contactopersonal.php"); // ENCABEZADO DE LA PAGINA CONTACTO PERSONAL
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "DELETE FROM contactopersonal WHERE Id_contactopersonal = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	   ob_end_clean();
         header("location: contactop.php");
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>");
	}
}
?>

<!-- COMIENZO DE  LA ESTRUCTURA DE LOS BOTONES--> 
<div class="center-block">
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit' class='btn btn-danger'><i class='glyphicon glyphicon-ok'></i>Si</button>
	<a href='categoriascategoria.php' class='btn btn-primary'><i class='glyphicon glyphicon-remove'></i>No</a>
</form>
</div>

<!-- FIN  DE LA ESTRUCTURA DE LOS BOTONES--> 

<?php
Page::footer();
?>
<!-- FIN DE LA SENTENCIA  PHP--> 