<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['personal'] == 1)
  	 {

//Mandamos a llamar los requerimientos 
Page::header('LA CARPINTERIA SV - PERMISOS');
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
    </div><br>
    </div>
</form>
<?php
//Si el input del form no esta vacios
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	//Va a ordenar segun "permiso" y lo ingresado en el input
	$sql = "SELECT * FROM modulos WHERE permiso LIKE ? ORDER BY permiso";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT P.Id_cargo, C.cargos , P.Id_Permiso AS id
	FROM cargos AS C , permisos AS P
	Where C.Id_cargo = P.Id_cargo";
	$params = null;
}
$data = Database::getRows($sql, $params);
//Si la informacion no es diferente de vacio, realiza el if(tabla)
if($data != null)
{
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
	        $tabla .=	" 
                             
	                        <tr class='active'>";

	                        if($row['Id_cargo'] != 1)

	            			 {

				                                    $tabla .= "<td class='table-hover col-xs-12 col-md-6 col-lg-9'><h5>$row[cargos]</h5></td>
	            			<td >
	            				<a href='save.php?id=".base64_encode($row['Id_cargo'])."&id_p=".base64_encode($row['id'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Asignar permisos</a>
							</td>
	        			</tr>";	
				                       }
	            			
	            			
		}
		$tabla .= 	"</tbody>
    			</table>
    			</div>";
	print($tabla);
}
else
//Indica que no hay archivos para buscar
{
	print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-3' role='alert'><b> AVISO:</b></i> <b>NO HAY MODULOS REGISTRADOS.</b></div>");
}
}else{
	header("location: error.php");
}
Page::footer();

?>