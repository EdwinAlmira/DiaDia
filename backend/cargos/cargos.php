<!-- COMIENZO DE LA SENTENCIA PHP-->
<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['personal'] == 1)
  	 {


Page::header('LA CARPINTERIA SV - CARGOS');
?>
<!-- FIN DE LA SENTENCIA PHP--> 

<br>
   	<br>	<br>
   	<br>

<!-- COMIENZO DE LA ESTRUCTURA DEL PANEL SUPERIOR--> 

<form method='post' class='row'>
	<div class="row">
  	<div class='col-md-1 unespacio'>
  	</div>
  	</div><br>
  	<div class="col-md-12">
	<div class=' col-md-2'>
      	<i class='glyphicon glyphicon-search'></i>
      	<input id='buscar' type='text' name='buscar' placeholder="Buscar cargo" class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>  ACEPTAR</button> 	
    	<a href='save.php' class='btn btn-success colordebotonagregar'><i class='glyphicon glyphicon-plus'></i> AGREGAR UN NUEVO CARGO</a>
    	<br>	
   	<br>
   	<br>	
    	<br>

  	</div></div>
</form>

<!-- FIN DE LA ESTRUCTURA DEL PANEL SUPERIOR--> 


<!--  CODIGO BUSCAR CARGOS , ESTRUCTURA DE TABLA Y COMPONENTES--> 

<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM cargos WHERE cargos LIKE ? ORDER BY cargos";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM cargos ORDER BY cargos";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{

	//ESTRUCTURA DE LA TABLA
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-12 col-lg-12 col-xs-12 col-lg-10 table-hover'>
					<thead>
			    		<tr>
				    		<th><h4>CARGOS EXISTENTES</h4></th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr class='active'>
	            			<td class='table-hover col-xs-12 col-md-6 col-lg-9'><h5>$row[cargos]</h5></td>
	            			<td class='tabla'>
	            				<a href='save.php?id=".base64_encode($row['Id_cargo'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Modificar</a>
								<a href='delete.php?id=".base64_encode($row['Id_cargo'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar</a>
							</td>
	        			</tr>";
		}
		$tabla .= 	"</tbody>
    			</table>
    			</div>";
	print($tabla); //IMPRIMIMOS LA TABLA CREADA
}
else
{
print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-4' role='alert'><b> AVISO:</b></i> <b>NO HAY CARGOS REGISTRADOS.</b></div>"); // EN CASO DE NO HABER REGISTROS
}
Page::footer();
}else{
	header("location: error.php");
}
 //FOOTER DE LA CLASE PAGE
?>
<!-- FIN DE LA SENTENCIA PHP--> 

