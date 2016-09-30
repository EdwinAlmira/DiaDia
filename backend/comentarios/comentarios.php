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
      	<input id='buscar' type='text' name='buscar' placeholder = 'Buscar comentarios' class='validate col-md-12'/>
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
	$sql = "SELECT C.nombreCliente , CC.titulo , CC.comentario , CC.fecha, Pro.nombreProdu from clientes AS C , comentariospro AS CC , productos AS Pro where CC.id_cliente = C.Id_cliente and CC.id_pro=Pro.Id_producto and  CC.comentario LIKE ?";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT C.nombreCliente , CC.titulo , CC.comentario , CC.fecha, Pro.nombreProdu , CC.Id_com from clientes AS C , comentariospro AS CC , productos AS Pro where CC.id_cliente = C.Id_cliente and CC.id_pro=Pro.Id_producto ";
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
				    		<th><h5><strong>NOMBRE DEL CLIENTE</strong></h5></th>
				    		<th><h5><strong>TITULO</strong></h5></th>
				    		<th><h5><strong>COMENTARIO</strong></h5></th>
				    		<th><h5><strong>FECHA</strong></h5></th>
				    		<th><h5><strong>NOMBRE PRODUCTO</strong></h5></th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr class='active'>
	            			<td class='tabla table-hover'>$row[nombreCliente]</td>
	            			<td class='tabla table-hover'>$row[titulo]</td>
	            			<td class='tabla table-hover'>$row[comentario]</td>
	            			<td class='tabla table-hover'>$row[fecha]</td>
	            			<td class='tabla table-hover'>$row[nombreProdu]</td>
	            			<td class='tabla table-hover'>
								<a href='delete.php?id=".base64_encode($row['Id_com'])."'class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar comentario</a>
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

