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
Page::header(' LA CARPINTERIA SV - EMPRESA ');
?>
	<br>
   	<br>	<br>
   	<br>
<form method='post' class='row'>
	<div class="row">
  	<div class='col-md-1 unespacio'>
  	</div>
  	</div><br>
  	
</form>
<?php
//Si el input del form no esta vacios
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	//Va a ordenar segun "permiso" y lo ingresado en el input
	$sql = "SELECT * FROM empresa";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM empresa";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	//Si la informacion no es diferente de vacio, realiza el if(tabla)
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-12 col-lg-12 col-xs-12 col-lg-8 table-hover'>
					<thead>
			    		<tr>
                        <thead>
			    		<tr>
				    		
				    		
			    		</tr>

		    		</thead>

				    		<td><h4 class='text-center'>MISION</h4></td>
				    		<td><h4 class='text-center'>VISION </h4></td>
				    		
				    		
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr class='active'>
	            		<td class='tabla table-hover col-lg-5 text-justify '>&nbsp&nbsp$row[Mision]</td>
	            		<td class='tabla table-hover col-lg-5 text-justify '>&nbsp&nbsp$row[Vision]</td>
	            		
                            
	            			<td class='tabla table-hover'>
	            				<a href='save.php?id=".base64_encode($row['Id_empresa'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Modificar</a>
	            				<br><br><br>

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
	print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-3' role='alert'><b> AVISO:</b></i> <b>NO HAY PERSONAL REGISTRADO.</b></div>");
}
}else{
	header("location: error.php");
}
Page::footer();
?>

