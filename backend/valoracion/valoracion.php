<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['producto'] == 1)
  	 {

//Definimos la hora del area
date_default_timezone_set('America/Guatemala');
Page::header('COMENTARIOS -LA CARPINTERIA SV');
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
      	<input id='buscar' type='text' name='buscar' placeholder = 'Buscar productos' class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>  ACEPTAR</button> 	
    
    	
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
	$sql = "SELECT Id_calificacion, calificacion, productos.nombreProdu, clientes.usuario from calificaciones, productos, clientes WHERE calificaciones.Id_producto=productos.Id_producto and clientes.Id_cliente=calificaciones.Id_cliente AND productos.nombreProdu like ?";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT Id_calificacion, calificacion, productos.nombreProdu, productos.imagen, clientes.usuario from calificaciones, productos, clientes WHERE calificaciones.Id_producto=productos.Id_producto and clientes.Id_cliente=calificaciones.Id_cliente";


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
				    		<th><h5><strong>CLIENTE CALIFICADOR</strong></h5></th>
				    		<th><h5><strong>PRODUCTO CALIFICADO</strong></h5></th>
				    		<th><h5><strong>PUNTUACION</strong></h5></th>
				    	    <th><h5><strong>IMAGEN</strong></h5></th>

				    		
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr class='active'>
	            			<td class='tabla table-hover'>$row[usuario]</td>
	            			<td class='tabla table-hover'>$row[nombreProdu]</td>
	            			<td class='tabla table-hover'>$row[calificacion] &nbsp estrellas</td>
	            	        <td ><img src='data:image/*;base64,$row[imagen]' class='materialboxed' width='40' height='35'></td>

	            			<td class='tabla table-hover'>
								
	        			</tr>
	        			";
		}
		$tabla .= 	"</tbody>
    			</table>
    			</div>";
	print($tabla);
}
else
	//Indica que no hay archivos para buscar
{
	print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-3' role='alert'><b> AVISO:</b></i> <b>NO HAY COMENTARIOS DE LOS CLIENTES.</b></div>");
}

}else{
	header("location: error.php");
}
Page::footer();
?>

