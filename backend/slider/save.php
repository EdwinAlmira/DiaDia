<!-- COMIENZO  DE LA SENTENCIA  PHP--> 
<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DEL CATOLOGO--> 
<?php
	require("../pagina.php");
	require("../procesos/database.php");
	$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
	$par = array(@$_SESSION['cargo']);
	$permisos = Database::getRow($consu , $par);
	if($permisos['extra'] == 1)
	{

		require("../procesos/validator.php");


		if(empty($_GET['id'])) 
		{
			Page::header("AGREGAR MIEMBRO "); // ENCABEZADO DE LA PAGINA AGREGAR IMAGEN
			$id = null;
			$Imagen = null;
			$Imagen2 = null;
			$Imagen3 = null;
			$Imagen4 = null;
			$Imagen5 = null;
			$Imagen6 = null;
			$Imagen7 = null;


		}
		else
		{
			Page::header("MODIFICAR SLIDER");
			$id = base64_decode($_GET['id']);
			$sql = "SELECT * FROM sliders WHERE Id_slider = ?";
			$params = array($id);
			$data = Database::getRow($sql, $params);
			$Imagen = $data['imagen_uno'];
			$Imagen2 = $data['imagen_dos'];
			$Imagen3 = $data['imagen_tres'];
			$Imagen4 = $data['imagen_cuatro'];
			$Imagen5 = $data['imagen_cinco'];
			$Imagen6 = $data['imagen_seis'];
			$Imagen7 = $data['imagen_siete'];

		}

		if(!empty($_POST))
		{      //aca estan los posts , tengo que crearlos luego abajo para que concuerden
			$_POST = Validator::validateForm($_POST);
			$Archivo = $_FILES['imagen_uno'];
			$Archivo2 = $_FILES['imagen_dos'];
			$Archivo3 = $_FILES['imagen_tres'];
			$Archivo4 = $_FILES['imagen_cuatro'];
			$Archivo5 = $_FILES['imagen_cinco'];
			$Archivo6 = $_FILES['imagen_seis'];
			$Archivo7 = $_FILES['imagen_siete'];

			//aqui era name en vez de foto
			if($Archivo['name'] != null)
			{  

				if($Archivo2['name'] != null)
				{  

					if($Archivo3['name'] != null)
					{  

						if($Archivo4['name'] != null)
						{  

							if($Archivo5['name'] != null)
							{  

								if($Archivo6['name'] != null)
								{  

									if($Archivo7['name'] != null)
									{  

										$base64 = Validator::validateImage($Archivo,$Archivo2,$Archivo3,$Archivo4,$Archivo5,$Archivo6,$Archivo7);


										if($Imagen == null)
										{
											throw new Exception("Debe seleccionar una imagen.");
										}
										else if ($Imagen2 == null)
										{
											throw new Exception("Debe seleccionar una imagen.");
										}
										else if ($Imagen3 == null)
										{
											throw new Exception("Debe seleccionar una imagen.");
										}
										else if ($Imagen4 == null)
										{
											throw new Exception("Debe seleccionar una imagen.");
										}
										else if ($Imagen5 == null)
										{
											throw new Exception("Debe seleccionar una imagen.");
										}
										else if ($Imagen6 == null)
										{
											throw new Exception("Debe seleccionar una imagen.");
										}
										else if ($Imagen7 == null)
										{
											throw new Exception("Debe seleccionar una imagen.");
										}



										if($id == null)
										{
											$sql = "INSERT INTO sliders(imagen_uno, imagen_dos,imagen_tres,imagen_cuatro, imagen_cinco, imagen_seis, imagen_siete) VALUES(?,?,?,?,?,?,?)";
											$params = array($Imagen,$Imagen2,$Imagen3,$Imagen4,$Imagen5,$Imagen6,$Imagen7);
										}
										else
										{
											$sql = "UPDATE sliders SET imagen_uno = ?, imagen_dos = ?, imagen_tres = ? , imagen_cuatro = ?, imagen_cinco = ?,imagen_seis = ?, imagen_siete = ? WHERE Id_slider = ?";
											$params = array($Imagen, $Imagen2 , $Imagen3, $Imagen4, $Imagen5,$Imagen6,$Imagen7,$id);
										}
										Database::executeRow($sql, $params);
										ob_end_clean();
										header("location: slider.php");


									}
								}
							}
						}

					}
				}
			}
		}
	



?>
<br>
<br>


<div class="panel-info col-md-8">
<div class='panel-heading'><b>SLIDERS<b></div>
 <div class='panel-body'>


<form method='post' class='row' enctype='multipart/form-data'>
	<div class='row'>
		<div class='col-md-12'>
		 
		 <div class="col-md-6">

			<br>
			<br>
				<label for="exampleInputFile">Seleccionar imagen</label>
				<i class='glyphicon glyphicon-picture col-md-3'></i>
				<br>
				<input type="file" name='imagen_uno' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
			  </div>


			  <div class="col-md-6">

			<br>
			<br>
				<label for="exampleInputFile">Seleccionar imagen</label>
				<i class='glyphicon glyphicon-picture col-md-3'></i>
				<br>
				<input type="file" name='imagen_dos' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
			  </div>



			  <div class="col-md-6">

			<br>
			<br>
				<label for="exampleInputFile">Seleccionar imagen</label>
				<i class='glyphicon glyphicon-picture col-md-3'></i>
				<br>
				<input type="file" name='imagen_tres' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
			  </div>


			  <div class="col-md-6">

			<br>
			<br>
				<label for="exampleInputFile">Seleccionar imagen</label>
				<i class='glyphicon glyphicon-picture col-md-3'></i>
				<br>
				<input type="file" name='imagen_cuatro' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
			  </div>


			  <div class="col-md-6">

			<br>
			<br>
				<label for="exampleInputFile">Seleccionar imagen</label>
				<i class='glyphicon glyphicon-picture col-md-3'></i>
				<br>
				<input type="file" name='imagen_cinco' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
			  </div>


			  <div class="col-md-6">

			<br>
			<br>
				<label for="exampleInputFile">Seleccionar imagen</label>
				<i class='glyphicon glyphicon-picture col-md-3'></i>
				<br>
				<input type="file" name='imagen_seis' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
			  </div>


			  <div class="col-md-6">

			<br>
			<br>
				<label for="exampleInputFile">Seleccionar imagen</label>
				<i class='glyphicon glyphicon-picture col-md-3'></i>
				<br>
				<input type="file" name='imagen_siete' id="exampleInputFile" placeholder='1200x1200px máx., 2MB máx., PNG/JPG/GIF'>
			  </div>


			  <!-- ESTRUCTURA DE LOS BOTONES CANCELAR Y GUARDAR--> 
				<div class="btnforms">
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
	
	<button type='submit' class='btn btn-info colordebotonmodificar'><i class='glyphicon glyphicon-pencil'></i> Guardar</button>
	<a href='slider.php' class='btn btn-danger colordebotoneliminar'><i class='glyphicon glyphicon-remove'></i> Cancelar</a>
	</div>


		</div>
	</div>
	
</form>
</div>
<?php
}else{
	header("location: error.php");
}
Page::footer(); // FOOTER DE LA CLASE PAGE
?>
