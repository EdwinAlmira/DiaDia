<!-- COMIENZO DE LA SENTENCIA  PHP--> 
<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO--> 

<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['extra'] == 1)
  	 {

Page::header('LA CARPINTERIA SV - SLIDERS');
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
      	<input id='buscar' type='text' name='buscar' placeholder = 'Buscar miembro' class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>  ACEPTAR</button> <a href='save.php' class='btn btn-success colordebotonagregar'><i class='glyphicon glyphicon-plus'></i> AGREGAR UN NUEVO INTEGRANTE</a>
    	<br>	
   	<br>
   	<br>	
    	<br>

  	</div></div>
</form>
<!-- FIN DE LA ESTRUCTURA DEL PANEL SUPERIOR-->


<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM sliders WHERE Nombre LIKE ? ORDER BY Nombre";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM sliders";
	$params = null;
}
$data = Database::getRows($sql, $params);
if($data != null)
{  //CONSTRUCCION DE LA ESTRUCTURA DE LA TABLA
	$tabla = 	"<br> 
	<div class='container-fluid'>
	<table class='col-md-12 col-lg-9 col-xs-12 col-lg-9 table-hover'>
					<thead>
			    		<tr>
				    		
				    		<th><h5>NOMBRE</h5></th>
				    	    <th><h5>IMG 1</h5></th>
				    	    <th><h5>IMG 2</h5></th>
				    	    <th><h5>IMG 3</h5></th>
				    	    <th><h5>IMG 4</h5></th>
   				    	    <th><h5>IMG 5</h5></th>
				    	    <th><h5>IMG 6</h5></th>
				    	    <th><h5>IMG 7</h5></th>
 

				    		

			    		</tr>
		    		</thead>
		    		<tbody>";
		foreach($data as $row)  //CONSTRUCCION DE LA TABLA MEDIANTE UN FOREACH
		{
	        $tabla .=	"<tr class='active'>  
	            			
	            			
	            			<td ><img src='data:image/*;base64,$row[imagen_uno]' class='materialboxed' width='40' height='35'></td>
	            			<td ><img src='data:image/*;base64,$row[imagen_dos]' class='materialboxed' width='40' height='35'></td>
	            			<td ><img src='data:image/*;base64,$row[imagen_tres]' class='materialboxed' width='40' height='35'></td>
	            			<td ><img src='data:image/*;base64,$row[imagen_cuatro]' class='materialboxed' width='40' height='35'></td>
	            			<td ><img src='data:image/*;base64,$row[imagen_cinco]' class='materialboxed' width='40' height='35'></td>
	            			<td ><img src='data:image/*;base64,$row[imagen_seis]' class='materialboxed' width='40' height='35'></td>
	            			<td ><img src='data:image/*;base64,$row[imagen_siete]' class='materialboxed' width='40' height='35'></td>

	            				<a href='save.php?id=".base64_encode($row['Id_slider'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Modificar</a>
								<a href='delete.php?id=".base64_encode($row['Id_slider'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar</a>
							</td>
	        			</tr>";
		}
		$tabla .= 	"</tbody>
    			</table>
    			</div>";
	print($tabla);  // IMPRIMIMOS LA TABLA
}
else
{

print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-5' role='alert'><b> AVISO:</b></i> <b>NO HAY IMAGENES DE SLIDERS INGRESADAS.</b></div>"); //EN CASO DE ERROR MOSTRAR EL SIGUIENTE MENSAJE
}
}else{
	header("location: error.php");
}
Page::footer(); // FOOTER  DE LA CLASE PAGE 
?>
?>
