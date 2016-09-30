<!-- ÍNICIO de la SENTENCIA --> 
<!-- ARCHIVOS REQUERIDOS DE PARA EL FUNCIONAMIENTO--> 
<?php
require("../pagina.php");
require("../procesos/database.php");
Page::header('TIPO DE CONTACTO');
?>
<form method='post' class='row'>
	<div class="row">
  	<div class='col-md-1 unespacio'>
		<a href='save.php' class='btn btn-success'><i class='glyphicon glyphicon-plus'></i>Nuevo</a>
  	</div>
  	</div><br>
  	<div class="col-md-12">
	<div class=' col-md-2'>
      	<i class='glyphicon glyphicon-search'></i>
      	<input id='buscar' type='text' name='buscar' class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary'><i class=''></i>Aceptar</button> 	
  	</div></div>
</form>
<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM tipocontacto WHERE tipocontacto LIKE ? ORDER BY tipocontacto";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM tipocontacto ORDER BY tipocontacto";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-6 table-striped'>
					<thead>
			    		<tr>
				    		<th>Tipo de contacto</th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{  // CONSTRUCCION DE LA TABLA
	        $tabla .=	"<tr>  
	            			<td class='tabla'>$row[tipoContacto]</td>
	            			<td class='tabla'>
	            				<a href='save.php?id=$row[Id_tipoContacto]' class='btn btn-primary'><i class=''>Modificar</i></a>
								<a href='delete.php?id=$row[Id_tipoContacto]' class='btn btn-danger'><i class=''>Eliminar</i></a>
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
Page::footer(); //FOOTER DE LA CLASE PAGE
?>