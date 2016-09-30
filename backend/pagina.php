<?php

session_start();

 

class Page
{
	 

	public static function header($title)
	{

		$consu = "SELECT * FROM permisos WHERE Id_cargo = ?";
  	 $par = array(@$_SESSION['cargo']);
  	 $permisos = Database::getRow($consu , $par);
		
		ob_start();
		ini_set("date.timezone","America/El_Salvador");
		$sesion = false;
		$filename = basename($_SERVER['PHP_SELF']);

		$producto = "";
		$personal = "";
		$pedidos = "";
		$cliente = "";
		$extra = "";
		if($permisos['producto'] == 1)
		{
			$producto = "
			 <li class='sub-menu'>
                  <a href='javascript:;' >
                      <i class='glyphicon glyphicon-shopping-cart '></i>
                      <span>Productos</span>
                  </a>
                  <ul class='sub'>
                      <li><a  href='../categorias/categorias.php'>Categorias</a></li>
                      <li><a  href='../subcategoria/subcategoria.php'>Subcategoria</a></li>
                      <li><a  href='../comentarios/comentarios.php'>Comentarios de productos</a></li>
                 <li><a href='../valoracion/valoracion.php'>Valoracion de productos</a></li>                      
                      <li><a  href='../producto/productos.php'>Productos</a></li>
                       <li><a  href='../galeria/galeria.php'>Galeria de proyectos</a></li>

                      <li><a  href='../mesproducto/mesproducto.php'>Imagen del mes</a></li>
                  </ul>
              </li>
			";
		}if($permisos['personal'] == 1)
		{
			$personal = "
			 <li class='sub-menu'>
                  <a href='javascript:;' >
                      <i class='glyphicon glyphicon-user'></i>
                      <span>Personal</span>
                  </a>
                  <ul class='sub'>
                      <li><a  href='../cargos/cargos.php'>Cargos</a></li>
                      <li><a  href='../modulos/modulos.php'>Permisos</a></li>
                      <li><a  href='../personal/personal.php'>Personal</a></li>
                      <li><a  href='../bitacoras/bitacora.php'>Bitacoras personal</a></li>

                      
                  </ul>
              </li>
			";
		}if($permisos['pedidos'] == 1)
		{
			$pedidos = "
				<li class='sub-menu'>
	                  <a href='javascript:;' >
	                      <i class='glyphicon glyphicon-list-alt'></i>
	                      <span>Pedidos</span>
	                  </a>
	                  <ul class='sub'>
	                     
	                      <li><a  href='../cotiza/cotiza.php'>Cotizaciones pendientes</a></li>
	                      <li><a  href='../cotresp/cotresp.php'>Registro de cotizaciones</a></li>
	                  </ul>
	              </li>
			";
			
		}if($permisos['cliente'] == 1)
		{
			$cliente = "
				 <li class='sub-menu'>
                      <a href='' >
                          <i class='glyphicon glyphicon-book'></i>
                          <span>Clientes</span>
                      </a>
                      <ul class='sub'>
                          <li><a  href='../clientes/cliente.php'>Clientes</a></li>
                          <li><a  href='../bitacorasC/bitacoraC.php'>Bitacora Clientes</a></li>

                          
                      </ul>
                  </li>
			";
		}if($permisos['extra'] == 1)
		{
			$extra = "
				<li class='sub-menu'>
                      <a href='javascript:;' >
                          <i class='glyphicon glyphicon-cog'></i>
                          <span>Extras</span>
                      </a>
                      <ul class='sub'>
                          <li><a  href='../redsocial/redes.php'>Redes sociales</a></li>
                          <li><a  href='../empresa/empresa.php'>Empresa</a></li>
                          <li><a  href='../valores/valores.php'>Valores</a></li>
                          <li><a  href='../equipo/equipo.php'>Nuestro equipo</a></li>
                          <li><a  href='../blog/blog.php'>Blog</a></li>
                          <li><a  href='../preguntas/preguntas.php'>Preguntas frecuentes</a></li>
                          <li><a  href='../slider/slider.php'>Administracion de sliders</a></li>
                          

                          
                      </ul>
                  </li>
			";
		}




  		$header = '<!DOCTYPE html>
			<html lang="en">
			  <head>
			    <meta charset="utf-8">
			    <meta name="viewport" content="width=device-width, initial-scale=1.0">
			    <meta name="description" content="">
			    <meta name="author" content="Dashboard">
			    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

			    <title>La Carpinteria SV</title>


			    <!-- Bootstrap core CSS -->
			    <link href="../assets/css/bootstrap.css" rel="stylesheet">
			    <!--external css-->
			    <link href="../assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
			    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-datepicker/css/datepicker.css"/>
			      <link rel="stylesheet" href="../frontend/css/main.css">

			    <link rel="stylesheet" type="text/css" href="../assets/js/bootstrap-daterangepicker/daterangepicker.css"/>
			        <link href="../assets/css/sweetalert.css" rel="stylesheet">
			    <!-- Custom styles for this template -->
			    <link href="../assets/css/style.css" rel="stylesheet">
			    <link href="../assets/css/style-responsive.css" rel="stylesheet">
			  </head>

			  <body>
			  <!--Abertura de section general -->
			  <section id="container" >';
		      	if(isset($_SESSION['nombrePersonal']))
    			{
    				
    				$sesion = true;
	        		$header .= "<header class='header black-bg'>
		              <div class='sidebar-toggle-box'>
		                  <div class='tooltips iconos'data-placement='right' data-original-title='Click para desplegar el menú'><img src='../../frontend/img/logos/blancosmall.png' class='ubicacion-nab'></div>
		              </div>
		            <!--logo start-->
		            <a href='../dashboard/dashboard.php' class='logo'><b>La Carpinteria SV</b></a>
		            <!--logo end-->
		            <div class='nav notify-row' id='top_menu'>
		                <!--  notification start -->
		                <ul class='nav top-menu'>
		                 
		                </ul>
		                <!--  notification end -->
		            </div>
		            <div class='top-menu'>
		            	<ul class='nav pull-right top-menu'>
		                    <li><a class='logout' href='../logout/logout.php'><i class='glyphicon glyphicon-user'></i> CERRAR SESIÓN</a></li>
		            	</ul>
		            </div>
		        </header>

		        <!--sidebar start-->
		         <br>
		      <aside>
		          <div id='sidebar'  class='nav-collapse '>
		              <!-- sidebar menu start-->
		              <ul class='sidebar-menu' id='nav-accordion'>
			              
		                  <h5 class='centered'>$_SESSION[nombrePersonal]</h5>
		              
		             
		              <br>      
		                  <li class='sub-menu'>
                  <a href='../dashboard/dashboard.php' >
                      <i class='glyphicon glyphicon-dashboard '></i>
                      <span>Dashboard</span>
                  </a>
              </li>

		                 ".$producto."

		                 ".$personal."

		                 ".$pedidos."
		                  
		                 ".$cliente."

		                 ".$extra."
		                  
		              </ul>
		              <!-- sidebar menu end-->
		          </div>
		      </aside>
		      <!--sidebar end-->
		      <section id='main-content'>
          <section class='wrapper'>
";
	      		}
	      		else
	      		{
	      			$header .= "<a href='../../' class='brand-logo'>
	        						<i class='material-icons'>algo</i>
	    						</a>";
	      		}
		      	$header .= "</div>
		    			</nav>
	  				</div>
	  				<div class='container center-align'>";
	  	print($header);
  		if($sesion)
  		{
  			if($filename != "index.php")
  			{
  				print("<br> <br> <h2 class='titulo'>$title</h2>");
  			}
  			else
  			{
  				header("location: index.php");
  			}
  		}
  		else
  		{
  			if($filename != "login.php" && $filename != "register.php")
  			{
  				header("location: ../index.php");
  			}
  			else
  			{
  				print("<h3>$title</h3>");
  			}
  		}
	}

	public static function footer()
	{
		$footer = '<!--main content end-->
		</section>
		</section>				
					<!--Cierre de section general -->
					  </section>
                    
                   	<!--Seccion de los lightbox -->
                   <script src="assets/js/bootstrap-lightbox.js"></script>
                   <script src="assets/js/bootstrap-lightbox.min.js"></script>
                   <link href="assets/css/bootstrap-lightbox.min.css" rel="stylesheet">
                   <link href="assets/css/bootstrap-lightbox.css" rel="stylesheet">




                   	<!--Fin de la seccion de los lightbox -->




                	<script src="../assets/js/bootstrap.js"></script>
                	<script src="assets/js/bootstrap.js"></script>
                	 <script src="../assets/js/bootstrap.min.js"></script>


				      <script src="../assets/js/jquery.js"></script>
				      <script src="assets/js/jquery.js"></script>
					  
					   
					     <script src="assets/js/bootstrap.min.js"></script>
					    
					    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
					    <script src="../assets/js/jquery.scrollTo.min.js"></script>
					    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>


					    <!--common script for all pages-->
					    <script src="../assets/js/common-scripts.js"></script>

					    <!--script for this page-->
					    <script src="../assets/js/jquery-ui-1.9.2.custom.min.js"></script>

					  <!--custom switch-->
					  <script src="../assets/js/bootstrap-switch.js"></script>
					  
					  <!--custom tagsinput-->
					  <script src="../assets/js/jquery.tagsinput.js"></script>
					  
					  <!--custom checkbox & radio-->
					  
					  <script type="text/javascript" src="../assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
					  <script type="text/javascript" src="../assets/js/bootstrap-daterangepicker/date.js"></script>
					  <script type="text/javascript" src="../assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
					  
					  <script type="text/javascript" src="../assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
					  
					  <script type="text/javascript" src="../assets/js/sweetalert.min.js"></script>
					  <script src="../assets/js/form-component.js"></script>    
					    
					    
					  <script>
					      //custom select box

					      $(function(){
					          $("select.styled").customSelect();
					      });

					  </script>
					</body>
					</html>';
						ob_end_flush();
		print($footer);
		
	}
	public static function setCombo($name, $value, $query)
	{
		$data = Database::getRows($query, null);
		$combo = "<select name='$name' required>";
		if($value == null)
		{
			$combo .= "<option value='' disabled selected>Seleccione una opción</option>";
		}
		foreach($data as $row)
		{
			$combo .= "<option value='$row[0]'";
			if(isset($_POST[$name]) == $row[0] || $value == $row[0])
			{
				$combo .= " selected";
			}
			$combo .= ">$row[1]</option>";
		}	
		$combo .= "</select>
				";
		print($combo);
	}
}
?>