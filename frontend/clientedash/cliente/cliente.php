<?php
require("pagina.php");
require("../../../backend/procesos/database.php");
Page::header('MI PERFIL - LA CARPINTERIA SV');
?>
	<br>
   	<br>	<br>
   	<br>



<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM clientes WHERE estadoCliente = 1 and Id_cliente = ".$_SESSION['Id_cliente']." AND usuario LIKE ? ORDER BY Id_cliente";
	$params = array("%$search%");


}
else
{
	$sql = "SELECT * FROM clientes WHERE Id_cliente = ".$_SESSION['Id_cliente']." AND estadoCliente = 1 ORDER BY Id_cliente";
	$params = null;
}

$data = Database::getRows($sql, $params);
if($data != null)
{
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-12 col-lg-12 col-xs-12 col-lg-12 table-hover'>
					<thead>
			    		<tr>
				    		<th>NOMBRES</th>
				    		<th>APELLIDOS</th>
				    		<th>CORREO</th>
				    		<th>USUARIO</th>

				    		
				    		
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr class='active'>
	            			<td  class='table-hover'>$row[nombreCliente]</td>
	            			<td  class='table-hover'>$row[apellidoCliente]</td>
	            			<td  class='table-hover'>$row[correo_cliente]</td>
	            			<td  class='table-hover'>$row[usuario]</td>
	            			
	            			
	            		

	            			<td class='tabla'>
	            			<a href='save.php?id=".base64_encode($row['Id_cliente'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Modificar mi informacion</a>
	            			<a href='contra.php?id=".base64_encode($row['Id_cliente'])."' class='btn btn-success'><i class='glyphicon glyphicon-ok'></i> Modificar mi contraseña</a>
	            				<a href='delete.php?id=".base64_encode($row['Id_cliente'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar mi cuenta</a>
	            				
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

print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-3' role='alert'><b> AVISO:</b></i> <b>NO HAY CLIENTES REGISTRADAS.</b></div>");
}
Page::footer();
?>