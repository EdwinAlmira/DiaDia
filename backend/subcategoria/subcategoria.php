<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['producto'] == 1)
  	 {

Page::header('LA CARPINTERIA SV - SUBCATEGORIAS');


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
      	<input id='buscar' type='text' name='buscar' placeholder="Buscar subcategoría" class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
   <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>  ACEPTAR</button> <a href='save.php' class='btn btn-success colordebotonagregar'><i class='glyphicon glyphicon-plus'></i> AGREGAR NUEVA SUBCATEGORIA</a>
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
	$sql = "SELECT * FROM subcategorias WHERE subcategoria LIKE ? ORDER BY subcategoria";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM subcategorias ORDER BY subcategoria";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-12 col-lg-12 col-xs-12 col-lg-10 table-hover'>
					<thead>
			    		<tr>
				    		<th><h4>SUBCATEGORIAS EXISTENTES</h4></th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr class='active'>
	            			<td class='table-hover col-xs-12 col-md-6 col-lg-9'><h5>$row[subcategoria]</h5></td>
	            			<td class='tabla-hover'>


	            				<a href='save.php?id=".base64_encode($row['Id_subcategoria'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Modificar</a>
								<a href='delete.php?id=".base64_encode($row['Id_subcategoria'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar</a>
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
print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-5' role='alert'><b> AVISO:</b></i> <b>NO HAY SUBCATEGORIAS REGISTRADAS.</b></div>");
}

}else{
	header("location: error.php");
}
Page::footer();
?>


