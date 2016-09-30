<!-- COMIENZO DE LA SENTENCIA  PHP-->
<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATALOGO-->  

<?php
require("../pagina.php");
require("../procesos/database.php");
date_default_timezone_set('America/Guatemala');
Page::header('Dashboard');
?>
<form method='post' class='row'>
	<div class="row">
  	<div class='col-md-1 unespacio'>
		<a href='save.php' class='btn btn-success'><i class='glyphicon glyphicon-plus'></i>Nuevo</a>
  	</div>
  	</div><br>
  	<div class="col-md-12">
	<div class=' col-md-2'>
      	<i class='glyphicon glyphicon-search'></i>
      	<input id='buscar' type='text' name='buscar' placeholder = 'Buscar Usuario'class='validate col-md-12'/>
      	<label for='buscar'>Búsqueda</label>
    </div><br>
    <div class='col-md-offset-1'>
    	<button type='submit' class='btn btn-primary'><i class=''></i>Aceptar</button> 	
  	</div></div>
</form>

<!-- COMIENZO  DE LA SENTENCIA  PHP--> 
<?php
if(!empty($_POST))
{
	$search = trim($_POST['buscar']);
	$sql = "SELECT * FROM personal WHERE usuario LIKE ? ORDER BY usuario";
	$params = array("%$search%");
}
else
{
	$sql = "SELECT * FROM personal, cargos where cargos.id_cargo=personal.id_cargo ORDER BY usuario";
	$params = null;
}

// FIN DE LA SENTENCIA PHP
Page::footer(); // FOOTER DE A CLASE PAGE
?>