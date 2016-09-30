<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['producto'] == 1)
  	 {

Page::header('LA CARPINTERIA SV- CATEGORIAS');

?>

<link href="../assets/js/bootstrap-datepicker/css/datepicker.css" rel="stylesheet">

<!--LOGO DE LA CARPINTERIA SV --> 

	<br
   	<br>	<br>
   	<br>

<!-- COMIENZO DE LA ESTRUCTURA INICIAK BOTONES ACEPTAR , AGREGAR Y BUSCAR --> 
<form method='post' class='row'>
	<div class="row">
  	<div class='col-md-1 unespacio'>
  	</div>
  	</div><br>
  	<div class="col-md-12">
	<div class=' col-md-2'>
      	<i class='glyphicon glyphicon-search'></i>
      	<input id='buscar' type='text' name='buscar' placeholder = 'Buscar categorías' class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>

        <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>  ACEPTAR</button><a href='save.php' class='btn btn-success colordebotonagregar'><i class='glyphicon glyphicon-plus'></i> AGREGAR NUEVA CATEGORIA</a>
    	<br>	
   	<br>
   	<br>	
    	<br>

  	</div></div>
</form>
<!--FIN DE LA ESTRUCTURA INICIAL --> 


<!--DECLARACION DE PHP , BUSCAR  , MODIFICAR Y ELIMINAR CATEGORIAS --> 
<?php


//BUSCAR CATEGORIAS
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM categorias WHERE categoria LIKE ? ORDER BY categoria";
	$params = array("%$search%");
}
else // SELECCIONAR TODO DE CATEGORIAS EN CASO DE ERROR
{
	$sql = "SELECT * FROM categorias ORDER BY categoria";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{

	// CREAMOS LA ESTRUCTURA DE LA TABLA
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-12 col-lg-12 col-xs-12 col-lg-10 table-hover'>
					<thead>
			    		<tr>
				    		<th><h4>CATEGORIAS EXISTENTES</h4></th>
			    		</tr>

		    		</thead>

		    		<tbody>";

		foreach($data as $row) //AÑADIMOS LOS VALORES DE LA BASE EN UN DISEÑO PREDEFINIDO
		{
	        $tabla .=	"<tr class='active'>
	            			<td class='table-hover col-xs-12 col-md-6 col-lg-9'><h5>$row[categoria]</h5></td>

	            			<td class='table-hover'>
	            			

	            				<a href='save.php?id=".base64_encode($row['Id_categoria'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Modificar</a>
								<a href='delete.php?id=".base64_encode($row['Id_categoria'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar</a>
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
	print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-6' role='alert'><b> AVISO:</b></i> <b>NO HAY CATEGORIAS REGISTRADAS.</b></div>");
}
}else{
	header("location: error.php");
}
Page::footer();


?>
<?php 
