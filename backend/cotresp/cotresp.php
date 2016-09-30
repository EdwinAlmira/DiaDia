<!-- COMIENZO DE LA SENTENCIA  PHP--> 
<?php
require("../pagina.php");
    require("../procesos/database.php");
    $consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
     $par = array(@$_SESSION['cargo']);
     $permisos = Database::getRow($consu , $par);
     if($permisos['pedidos'] == 1)
     {

date_default_timezone_set('America/Guatemala');
Page::header('LA CARPINTERIA SV - COTIZACIONES ');
?>
	<br>
   	<br>	<br>
   	<br>

<!-- ESTRUCTURA DEL PANEL SUPERIOR--> 
<form method='post' class='row'>
	<div class="row">
  	<div class='col-md-1 unespacio'>
  	</div>
  	</div><br>
  	<div class="col-md-12">
	<div class=' col-md-2'>
      	<i class='glyphicon glyphicon-search'></i>
      	<input id='buscar' type='text' name='buscar' placeholder = 'Buscar cotizaciones' class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>ACEPTAR</button>
    	<a href=' reporte_cotiza.php' class='btn btn-success colordebotonagregar'><i class='glyphicon glyphicon-plus'></i>Reporte de cotizaciones</a> 	
    	<br>	
   	<br>
   	<br>	
    	<br>

  	</div></div>
</form>

<?php

if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM cotizaciones,clientes WHERE  clientes.Id_cliente=cotizaciones.Id_cliente AND cotizacion LIKE ?  ORDER BY Id_cotizacion";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM cotizaciones, clientes where clientes.Id_cliente=cotizaciones.Id_cliente AND  estadoCotizacion LIKE 1 OR 2 ORDER BY Id_cotizacion";
	$params =  array();
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	//CREAMOS LA ESTRUCTURA DE LA TABLA
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-12 col-lg-12 col-xs-12 col-lg-12 table-hover'>
					<thead>
			    		<tr>
				    		<th><h5>NOMBRE DEl CLIENTE</h5></th>
				    		<th><h5>COTIZACION</h5></th>
				    		<th><h5>MENSAJE DE RESPUESTA</h5></th>
				    		<th><h5>PRECIO</h5></th>
				    		<th><h5>IMAGEN</h5></th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)

		{
	        $tabla .=	"<tr class='active'>
	            			<td class='tabla table-hover'>$row[usuario]</td>
	            			<td class='tabla table-hover'>$row[cotizacion]</td>
	            			<td class='tabla table-hover'>$row[mensajeRespuesta]</td>
	            			<td class='tabla table-hover'>$row[precio]</td>

	            			

	            			<td><img src='data:image/*;base64,".$row['imagenCotizacion']."' class='materialboxed' width='40' height='35'></td>";

	            			 if($row['estadoCotizacion'] == 1)

	            			 {

				                                    $tabla .= "<td class='tabla table-hover'>
	            				<a class=' btn btn-success'><span class='badge'> &nbspAceptada.</span></a>
	          
	            			
	        			";	
				                       }

				          else if ($row['estadoCotizacion'] == 2)

	            			 {

				                                    $tabla .= "<td class='tabla table-hover'>
	            				<a class=' btn btn-danger'><span class='badge'>Cancelada</span></a>
	          
	            			
	        			</tr>";	
				                                    }                           

	            			

	            			
	        			
		}
		$tabla .= 	"</tbody>
    			</table>
    			</div>";
	print($tabla);  // IMPRMIMOS LA TABLA QUE CREAMOS
}
else
{
	print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-4' role='alert'><b> AVISO:</b></i> <b>NO HAY COTIZACIONES INGRESADAS.</b></div>"); // EN CASO DE NO HABER REGISTROS
}
}else{
    header("location: error.php");
}
Page::footer();
?>

?>