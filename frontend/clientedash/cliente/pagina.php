<?php
class Page
{
	public static function header($title)
	{
		session_start();
		ob_start();
		ini_set("date.timezone","America/El_Salvador");
		$sesion = false;
		$filename = basename($_SERVER['PHP_SELF']);
		$header = '<!DOCTYPE html>
			<html lang="en">
			  <head>
			    <meta charset="utf-8">
			    <meta name="viewport" content="width=device-width, initial-scale=1.0">
			    <meta name="description" content="">
			    <meta name="author" content="Dashboard">
			    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

			    <title>MI PERFIL | LA CARPINTERIA SV</title>


			    <!-- Bootstrap core CSS -->
			    <link href="../../../backend/assets/css/bootstrap.css" rel="stylesheet">
			    <!--external css-->
			    <link href="../../../backend/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
			    <link rel="stylesheet" type="text/css" href="../../../backend/assets/js/bootstrap-datepicker/css/datepicker.css"/>
			    <link rel="stylesheet" type="text/css" href="../../../backend/assets/js/bootstrap-daterangepicker/daterangepicker.css"/>
			        
			    <!-- Custom styles for this template -->
			    <link href="../../../backend/assets/css/style.css" rel="stylesheet">
			    <link href="../../../backend/assets/css/style-responsive.css" rel="stylesheet">
			  </head>

			  <body>
			  <!--Abertura de section general -->
			  <section id="container" >';
		      	if(isset($_SESSION['usuario']))
    			{
    				
    				$sesion = true;
	        		$header .= "<header class='header black-bg'>
		              <div class='sidebar-toggle-box'>
		                  <div class='fa fa-bars tooltips iconos'data-placement='right' data-original-title='Click para desplegar el menú'></div>
		              </div>
		            <!--logo start-->
		            <a href='index.html' class='logo'><b>La Carpinteria SV</b></a>
		            <!--logo end-->
		            <div class='nav notify-row' id='top_menu'>
		                <!--  notification start -->
		                <ul class='nav top-menu'>
		                 
		                </ul>
		                <!--  notification end -->
		            </div>
		            <div class='top-menu'>
		            	<ul class='nav pull-right top-menu'>
		                    <li><a class='logout' href='../../index.php'><span class='glyphicon glyphicon-chevron-left'></span>
 VOLVER A LA TIENDA</a></li>
		            	</ul>
		            </div>
		        </header>

		        <!--sidebar start-->
		      <aside>
		          <div id='sidebar'  class='nav-collapse '>
		              <!-- sidebar menu start-->
		              <ul class='sidebar-menu' id='nav-accordion'>
			              
		                  <h5 class='centered'>MENÚ</h5>
		                    
		                <br>
		                <br>

		                  

		                  <li class='sub-menu'>
		                      <a href='javascript:;' >
		                          <i class='glyphicon glyphicon-user'></i>
		                          <span>INFORMACION GENERAL</span>
		                      </a>
		                      <ul class='sub'>
		                          <li><a  href='../cliente/cliente.php'>Ver perfil</a></li>
		                        
		                      </ul>
		                  </li>

		                  
		                  
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
	        						<i class='material-icons'>web</i>
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
  				print("<div class='card-panel red'><a href='../index.php'><h5>Debe iniciar sesión.</h5></a></div>");
		  		self::footer();
		  		exit();
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

				      <script src="../../../backend/assets/js/jquery.js"></script>
					    <script src="../../../backend/assets/js/bootstrap.min.js"></script>
					    <script class="include" type="text/javascript" src="../../../backend/assets/js/jquery.dcjqaccordion.2.7.js"></script>
					    <script src="../../../backend/assets/js/jquery.scrollTo.min.js"></script>
					    <script src="../../../backend/assets/js/jquery.nicescroll.js" type="text/javascript"></script>


					    <!--common script for all pages-->
					    <script src="../../../backend/assets/js/common-scripts.js"></script>

					    <!--script for this page-->
					    <script src="../../../backend/assets/js/jquery-ui-1.9.2.custom.min.js"></script>

					  <!--custom switch-->
					  <script src="../../../backend/assets/js/bootstrap-switch.js"></script>
					  
					  <!--custom tagsinput-->
					  <script src="../../../backend/assets/js/jquery.tagsinput.js"></script>
					  
					  <!--custom checkbox & radio-->
					  
					  <script type="text/javascript" src="../../../backend/assets/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
					  <script type="text/javascript" src="../../../backend/assets/js/bootstrap-daterangepicker/date.js"></script>
					  <script type="text/javascript" src="../../../backend/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
					  
					  <script type="text/javascript" src="../../../backend/assets/js/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
					  
					  
					  <script src="../../../backend/assets/js/form-component.js"></script>    
					    
					    
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