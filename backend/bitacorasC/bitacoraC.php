<?php
require("../pagina.php");
require("../procesos/database.php");
$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['cliente'] == 1)
  	 {
Page::header('Bitacoras de los Clientes');
?>

<form method='post' class='row'>
	<div class="row">
  	<div class='col-md-1 unespacio'>
  	</div>
  	</div><br>
  	<div class="col-md-12">
	<div class=' col-md-2'>
      	<i class='glyphicon glyphicon-search'></i>
      	<input id='buscar' type='text' name='buscar' class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda por fecha</label>
    </div><br>
    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary'><i class=''></i>Aceptar</button> 	
    	 	
  	</div></div>
</form>
<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT descripcion, acciones.accion, clientes.usuario, fechaBitacora, horaBitacora FROM bitacorasclientes, acciones, clientes where bitacorasclientes.Id_accion = acciones.id_accion AND bitacorasclientes.Id_cliente = clientes.Id_clienteand fechaBitacora LIKE ? ORDER BY fechaBitacora DESC, horaBitacora DESC";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT descripcion, acciones.accion, clientes.usuario, fechaBitacora, horaBitacora FROM bitacorasclientes, acciones, clientes where bitacorasclientes.Id_accion = acciones.id_accion AND bitacorasclientes.Id_cliente = clientes.Id_cliente ORDER BY fechaBitacora DESC, horaBitacora DESC";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-10 table-striped' >
					<thead>
			    		<tr>
				    		<th class='tabla col-md-2'>Usuario</th>
				    		<th class='tabla col-md-2'>Acción</th>
				    		<th class='tabla col-md-2'>Usuario</th>
				    		<th class='tabla col-md-2'>Fecha</th>
				    		<th class='tabla col-md-2'>Hora</th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr>
	            			<td class='tabla col-md-2'>$row[usuario]</td>
	            			<td class='tabla col-md-2''>$row[accion]</td>
	            			<td class='tabla col-md-5'>$row[descripcion]</td>
	            			<td class='tabla col-md-2'>$row[fechaBitacora]</td>
	            			<td class='tabla col-md-2'>$row[horaBitacora]</td>
	            			<td class='tabla'>
							</td>
	        			</tr>";
		}
		$tabla .= 	"</tbody>
    			</table>
    			</div>";
	print($tabla);
}
else
{
	print("<div class='c'><i class=''>warning</i>No hay registros.</div>");
}

}else{
	header("location: error.php");
}
Page::footer();
?>



