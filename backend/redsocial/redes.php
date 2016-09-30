<!-- INIICO DE LA SENTENCIA PHP--> 
<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL PROYECTO--> 
<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['extra'] == 1)
  	 {

Page::header('LA CARPINTERIA SV - REDES SOCIALES');
?>



<!-- COMIENZO DE LA ESTRUCTURA DEL PANEL SUPERIOR--> 
	<br>
   	<br>	<br>
   	<br>
   	<div class='alert alert-info col-xs-12 col-md-8 col-lg-8' role='alert'><b> AVISO:</b></i> <b>PARA AGREGAR UN NUEVO TIPO DE RED, SIGA EL SIGUIENTE CATALOGO DE NOMBRES</b>
   	    <br><br>
        <li><b>fa fa-facebook para :</b> Facebook</li>
        <li><b>fa fa-twitter para :</b> Twitter</li>
        <li><b>fa fa-instagram para :</b> Instagram</li>
        <li><b>fa fa-linkedin para :</b> Linked-in</li>
        <li><b>fa fa-foursquare para :</b> Foursquare</li>
        <li><b>fa fa-google-plus para :</b> Google+</li>

	</div>
<form method='post' class='row'>
	<div class="row">
  	<div class='col-md-1 unespacio'>
  	</div>
  	</div><br>
  	<div class="col-md-12">
	<div class=' col-md-2'>
      	<i class='glyphicon glyphicon-search'></i>
      	<input id='buscar' type='text' name='buscar'  placeholder="Buscar red social" class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
   <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>  ACEPTAR</button> 	
    	<a href='save.php' class='btn btn-success colordebotonagregar'><i class='glyphicon glyphicon-plus'></i> AGREGAR UNA NUEVA RED SOCIAL</a>
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
	$sql = "SELECT * FROM redsocial WHERE nombre_red LIKE ? ORDER BY nombre_red";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM redsocial ORDER BY nombre_red";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{
	$tabla = 	"<br>
	<div class='container-fluid'>
	<table class='col-md-12 table-striped'>
					<thead>
			    		<tr>
				    		<h4>REDES SOCIALES EXISTENTES</h4>
			    		</tr>
			    		<br>
			    		<tr>
				    		<th>NOMBRE DE LA RED</th>
				    		<th>URL</th>
			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)
		{ 

			//CONSTRUCCION DE LA ESTRUCTURA DE LA TABLA  
	        $tabla .=	"<tr>  
	            			<td class='tabla'>$row[nombre_red]</td>
	            			<td class='tabla'>$row[url]</td>
	            			<td class='tabla'>
	            				<a href='save.php?id=".base64_encode($row['id_red'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Modificar</a>
								<a href='delete.php?id=".base64_encode($row['id_red'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar</a>
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
	print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-5' role='alert'><b> AVISO:</b></i> <b>NO HAY REDES SOCIALES REGISTRADAS.</b></div>"); // EN CASO DE NO HABER REGISTROS , IMPRIMIR EL SIGUIENTE MENSAJE
}
}else{
	header("location: error.php");
}
Page::footer(); //FOOTER DE LA CLASE PAGE
?>
