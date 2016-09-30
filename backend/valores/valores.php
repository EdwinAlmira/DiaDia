<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['extra'] == 1)
  	 {

//Definimos la hora del area
date_default_timezone_set('America/Guatemala');
Page::header('VALORES - LA CARPINTERIA SV');
?>
	<br>
   	<br>	<br>
   	<br>
<form method='post' class='row'>
	<div class="row">
  	<div class='col-md-1 unespacio'>
  	</div>
  	</div><br>
  	<div class="col-md-12">
	<div class=' col-md-2'>
      	<i class='glyphicon glyphicon-search'></i>
      	<input id='buscar' type='text' name='buscar' placeholder = 'Buscar valor' class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>  ACEPTAR</button> 	
    <a href='save.php' class='btn btn-success colordebotonagregar'><i class='glyphicon glyphicon-plus'></i> AGREGAR NUEVO VALOR EMPRESARIAL</a>
    		
    	
    	<br>	
   	<br>
   	<br>	
    	<br>

  	</div></div>
</form>
<?php
//Si el input del form no esta vacios
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	//Va a ordenar segun "permiso" y lo ingresado en el input
	$sql = "SELECT * FROM valores WHERE titulo_valor LIKE ? ORDER BY titulo_valor ";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM valores";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	//Si la informacion no es diferente de vacio, realiza el if(tabla)
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-12 col-lg-12 col-xs-12 col-lg-12 table-hover'>
					<thead>
			    		<tr>
				    		<td><h4>TITULO DEL VALOR</h4></td>
				    		<td><h4>DESCRIPCION</h4></td>
				    		
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr class='active'>
	            			<td class='tabla table-hover'>$row[titulo_valor]</td>
	            			<td class='tabla table-hover'>$row[descripcion]</td>
	            			<td class='tabla table-hover'>
	            				<a href='save.php?id=".base64_encode($row['Id_valor'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Modificar</a>
								<a href='delete.php?id=".base64_encode($row['Id_valor'])."'class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar</a>
	        			</tr>
	        			<br>
	        			<br>";
		}
		$tabla .= 	"</tbody>
    			</table>
    			</div>";
	print($tabla);
}
else
	//Indica que no hay archivos para buscar
{
	print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-5' role='alert'><b> AVISO:</b></i> <b>NO HAY VALORES EMPRESARIALES REGISTRADOS.</b></div>");
}
}else{
	header("location: error.php");
}
Page::footer();
?>


