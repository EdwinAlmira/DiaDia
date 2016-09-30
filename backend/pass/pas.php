<?php
//Cargamos los archivos necesarios
require("../pagina.php");
require("../procesos/database.php");
//Definimos la hora del area
date_default_timezone_set('America/Guatemala');
Page::header('PERSONAL - LA CARPINTERIA SV');
?>
<img src="../assets/logo1.png"  class="img-circle redireccionar">
	<br>
   	<br>	<br>
   	<br>

<?php
//Si el input del form no esta vacios
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	//Va a ordenar segun "permiso" y lo ingresado en el input
	$sql = "SELECT * FROM personal WHERE usuario LIKE ? ORDER BY usuario";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM personal, cargos where cargos.id_cargo=personal.id_cargo AND Id_personal = ".$_SESSION['Id_personal']." ORDER BY usuario";
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
				    		<td><h5>NOMBRE DE PERSONAL</h5></td>
				    		<td><h5>APELLIDO DEL PERSONAL</h5></td>
				    		<td><h5>CORREO DE PERSONAL</h5></td>
				    		<td><h5>USUARIO</h5></td>
				    		<td><h5>CARGOS ASIGNADOS</h5></td>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{
	        $tabla .=	"<tr class='active'>
	            			<td class='tabla table-hover'>$row[nombrePersonal]</td>
	            			<td class='tabla table-hover'>$row[apellidoPersonal]</td>
	            			<td class='tabla table-hover'>$row[correo_personal]</td>
	            			<td class='tabla table-hover'>$row[usuario]</td>
	            			<td class='tabla table-hover'>$row[cargos]</td>
	            			<td class='tabla table-hover'>
	            				<a href='save.php?id=".base64_encode($_SESSION['Id_personal'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> MODIFICAR clave</a>
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
Page::footer();
?>