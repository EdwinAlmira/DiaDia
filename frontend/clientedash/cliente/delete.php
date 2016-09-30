<?php
require("pagina.php");
require("../../../backend/procesos/database.php");
require("../../../backend/procesos/validator.php");
Page::header("Eliminar productos");

if(!empty($_GET['id'])) 
{
    $id = $_GET['id'];
}
else
{
    header("location: productos.php");
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{

       
		$sql = "UPDATE clientes SET estadoCliente = 0 WHERE Id_cliente = ?";
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    ob_end_clean();
         header("location: ../../views/logoutcliente.php");
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
	<button type='submit' class='btn btn-danger'><i class='glyphicon glyphicon-ok'></i>Si</button>
	<a href='cliente.php' class='btn btn-primary'><i class='glyphicon glyphicon-remove'></i>No</a>
</form>
</div>
