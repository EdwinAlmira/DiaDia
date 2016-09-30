
<!-- COMIENZO DE LA SENTENCIA PHP--> 


<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO--> 
<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['cliente'] == 1)
  	 {
require("../procesos/validator.php");



Page::header("¿ELIMINAR CLIENTE?"); // ENCABEZADO DE LA PAGINA ELIMINAR PRODUCTOS

if(!empty($_GET['id'])) 
{
    $id = base64_decode($_GET['id']);
}
else
{
    header("location: productos.php"); // REDIRECCION DESPUES DE LA ACCION REALIAZADA
}

if(!empty($_POST))
{
	$id = $_POST['id'];
	try 
	{
		$sql = "UPDATE clientes SET estadoCliente = 0 WHERE Id_cliente = ?"; // ACTUALIZAMOS EN LA TABLA CLIENTES
	    $params = array($id);
	    Database::executeRow($sql, $params);
	    ob_end_clean();
         header("location: cliente.php"); // REDIRECCION DE LA PAGINA AL REALIZAR LA ACCION
	} 
	catch (Exception $error) 
	{
		print("<div class='card-panel red'><i class='material-icons left'>error</i>".$error->getMessage()."</div>"); // EN CASO DE ERROR , MOSTRAR ESTE MENSAJE
	}
}
}else{
	header("location: error.php");
}
?>
<!-- FIN DE LA SENTENCIA PHP--> 

<!-- COMIENZO DE LA ESTRUCTURA DE LOS BOTONES--> 

<br>
<br>

<div class="center-block">
<form method='post' class='row'>
	<input type='hidden' name='id' value='<?php print($id); ?>'/>
	<button type='submit' class='btn btn-info colordebotonmodificar col-md-2 col-md-offset-3'><i class='glyphicon glyphicon-pencil'></i> Aceptar</button>
	<a href='cliente.php' class='btn btn-danger colordebotoneliminar col-md-2 col-md-offset-1'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
</form>
</div>
<!-- FIN DE LA ESTRUCTURA DE LOS BOTONES--> 
