<!-- INICIO DE LA SENTENCIA PHP--> 

<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO--> 

<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['cliente'] == 1)
  	 {

Page::header('LA CARPINTERIA SV - CLIENTES ');
?>


<!-- COMIENZO DE LA ESTRUCTURA DEL PANEL SUPERIOR--> 

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
      	<input id='buscar' type='text' name='buscar' placeholder="Buscar cliente" class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>  ACEPTAR</button> 	
  	</div></div>
</form>
<!-- FIN DE LA ESTRUCTURA DEL PANEL SUPERIOR--> 


<!-- COMIENZO DE LA SENTENCIA PHP PARA LA FUNCION SEARCH--> 

<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM clientes WHERE estadoCliente = 1 and  usuario LIKE ? ORDER BY Id_cliente";
	$params = array("%$search%");


}
else
{
	$sql = "SELECT * FROM clientes WHERE estadoCliente = 1 ORDER BY Id_cliente";
	$params = null;
}

$data = Database::getRows($sql, $params);
if($data != null)
{

	// COMIENZO DE LA ESTRUCTURA DEL LA TABLA
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-12 col-lg-12 col-xs-12 col-lg-12 table-hover'>
					<thead>
			    		<tr>
				    		<th>NOMBRES</th>
				    		<th>APELLIDOS</th>
				    		<th>USUARIO</th>
				    		<th>CORREO</th>
				    		<th>REGISTRADO EN</th>
				    		<th>HORA DE INGRESO</th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row) //CONSTRUCCION DE LA TABLA MEDIANTE UN FOREACH (CICLO)
		{
	        $tabla .=	"<tr class='active'>
	            			<td  class='table-hover'>$row[nombreCliente]</td>
	            			<td  class='table-hover'>$row[apellidoCliente]</td>
	            			<td  class='table-hover'>$row[usuario]</td>
	            			<td  class='table-hover'>$row[correo_cliente]</td>
	            			<td  class='table-hover'>$row[fechaIngreso]</td>
	            			<td  class='table-hover'>$row[horaIngreso]  </td>

	            			<td class='tabla'>
	            				<a href='delete.php?id=".base64_encode($row['Id_cliente'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar</a>
							</td>
	        			</tr>";
		}
		$tabla .= 	"</tbody>
    			</table>
    			</div>";
	print($tabla); // IMPRIMIMOS LA TABLA QUE HEMOS CREADO
}
else
{

print("
<br><div class='alert alert-danger col-xs-12 col-md-8 col-lg-5' role='alert'><b> AVISO:</b></i> <b>NO HAY CLIENTES REGISTRADOS.</b></div>"); // EN CASO DE NO HABER REGISTROS EN LA BASE , IMPRIMIR LA SIGUIENTE SENTENCIA
}
}else{
	header("location: error.php");
}
Page::footer(); // FOOTER DE LA CALSE PAGE
?>
