<?php
require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
  	 if($permisos['extra'] == 1)
  	 {
?>
	<?php
	date_default_timezone_set('America/Guatemala');
	Page::header('LA CARPINTERIA SV - ARTICULOS DE BLOG');
	?>

	<br>
   	<br>
   	<br>
   	<br>
	<form method='post' class='row'>
		<div class="row">
	  	<div class='col-md-1 unespacio'>
	  	</div>
	  	</div><br>
	  	<div class="col-md-12">
		<div class=' col-md-2'>
      	<i class='glyphicon glyphicon-search'></i>
      	<input id='buscar' type='text' name='buscar' placeholder="Buscar articulo" class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
	    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary colordebotonaceptar'><i class='glyphicon glyphicon-ok-sign'></i>  ACEPTAR</button> <a href='save.php' class='btn btn-success colordebotonagregar'><i class='glyphicon glyphicon-plus'></i> AGREGAR UN NUEVO ARTICULO</a>
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
		$sql = "SELECT * FROM blogs WHERE estadoBlog = 1 and titulo LIKE ? ORDER BY titulo";
		$params = array("%$search%");
	}
	else
	{
		$sql = "SELECT * FROM blogs WHERE estadoBlog = 1 ORDER BY titulo";
		$params = null;
	}
	$data = Database::getRows($sql, $params);
	if($data != null)
	{
		$tabla = 	"<br>
		<div class='container-fluid'>
		<table class='col-md-10 table-striped'>
						<thead>
				    		<tr>
					    		<th><strong></strong>TITULO DEL ARTICULO</strong></th>
					    		<th><strong>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspCUERPO DEL ARTICULO</strong></th>
					    		<th><strong>IMAGEN</strong></th>
					    		
				    		</tr>
			    		</thead>
			    		<tbody>";
			foreach($data as $row)
			{
		        $tabla .=	"<tr>
		            			<td class='tabla col-lg-4 text-justify'>$row[titulo]</td>
		            			<td class='tabla col-lg-4 text-justify'>$row[cuerpo]</td>
		            			<td ><img src='data:image/*;base64,$row[imagenBlog]' class='materialboxed' width='40' height='35'></td>
		            			<td class='tabla'>
		            				<a href='save.php?id=".base64_encode($row['Id_blog'])."' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Modificar</a>
									<a href='delete.php?id=".base64_encode($row['Id_blog'])."' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Eliminar</a>
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
		print("<div class='alert alert-danger col-xs-12 col-md-8 col-lg-6' role='alert'><b> AVISO:</b></i> <b>NO HAY ARTICULOS REGISTRADOS.</b></div>");
	}

	?>

<?php 
}else{
	 header("location: error.php");
}
?>