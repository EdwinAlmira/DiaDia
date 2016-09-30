<!-- COMIENZO DE LA SENTENCIA PHP--> 

<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO--> 
<?php
require("../pagina.php");
require("../procesos/database.php");
Page::header('CONTACTO PERSONAL'); // ENCABEZADO DE LA PAGINA
?>

<!-- COMIENZO DE LA ESTRUCTURA DEL PANEL SUPERIOR--> 

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

<!-- FIN DE LA ESTRUCTURA DEL PANEL SUPERIOR--> 

<?php

if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT Id_contactopersonal, tipocontacto.tipoContacto, contactoPersonal  FROM contactopersonal, tipocontacto WHERE contactopersonal.Id_tipoContacto=tipocontacto.Id_tipoContacto ORDER BY contactopersonal";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT Id_contactopersonal, tipocontacto.tipocontacto, contactoPersonal  FROM contactopersonal, tipocontacto WHERE contactopersonal.Id_tipoContacto=tipocontacto.Id_tipoContacto ORDER BY contactopersonal";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	// COMIENZO DE LA ESTRUCTURA DE LA TABLA
	

	$tabla = 	"<br>    
	<div class='container-fluid'>
	<table class='col-md-6 table-striped'>
					<thead>
			    		<tr>
				    		<th>Tipo de Contacto</th>
				    		<th>Contacto</th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)  //CREAMOS LA ESTRUCTURA DE LA TABLA CON UN FOREACH
		{
	        $tabla .=	"<tr>
	            			<td class='tabla'>$row[tipocontacto]</td>
	            			<td class='tabla'>$row[contactoPersonal]</td>
	            			<td class='tabla'>
	            				<a href='save.php?id=$row[Id_contactopersonal]' class='btn btn-primary'><i class=''>edit</i></a>
								<a href='delete.php?id=$row[Id_contactopersonal]' class='btn btn-danger'><i class=''>delete</i></a>
							</td>
	        			</tr>";
		}
		$tabla .= 	"</tbody>
    			</table>
    			</div>";
	print($tabla); //IMPRIMIMOS LA TABLA QUE HEMOS CRADO
}
else
{
	print("<div class='c'><i class=''>warning</i>No hay registros.</div>");
}
Page::footer(); // FOOTER DE LA CLASE PAGE
?>
<!-- FIN DE LA SENTENCIA PHP--> 
