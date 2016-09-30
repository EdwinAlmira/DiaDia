<!DOCTYPE html>
<html lang="en-US">
<head>

	<!-- Meta tags & title /-->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="robots" content="all,index,follow" />
	<link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>  <link rel="shortcut icon" href="../img/logos/logosmall.ico">


	<title>Nuestro equipo</title>
	<meta name="description" content="" />
	
	<!-- Stylesheets /-->
  <link rel="stylesheet" href="../css/demo.css">
  <link rel="stylesheet" href="../css/font-awesomeq.css">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
  <link href="../css/docs.css" rel="stylesheet" >
	<link rel="stylesheet" href="../css/animate.css">
	<link rel="stylesheet" type="text/css" href="css/style.css" /> <!-- Main stylesheet /-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css"> <!-- Grid framework /-->
	<link rel="shortcut icon" href="../img/logos/logosmall.ico">
	<link rel="stylesheet" href="../css/nav.css">
	<link rel="stylesheet" href="../css/main.css">
	<link rel="stylesheet" href="../css/index.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'> <!-- Open Sans /-->
    <link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700' rel='stylesheet' type='text/css'> <!-- PT Sans Narrow /-->
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet"> <!-- Font Awesome /-->
	
	<link rel="shortcut icon" href="img/favicon.png" type="image/x-icon" /> <!-- Favicon /-->

</head>

  
<body>
<div>
<nav class="navbar navbar-fixed-top topedegama">
          <div class="container-fluid">
            <div class="navbar-header">
              <button class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <!--Marca del nav -->
              <a href="../index.php" class="navbar-brand"><img src="../img/logos/logo1.png" class="img-responsive marca" alt="Responsive image"></a>
            </div><strong>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                <li class="fuente"><a href="../index.php">HOME</a></li>
                 <!-- dropdown de productos -->
                <li  class="dropdown fuente">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PRODUCTOS<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="fuente"><a href="ecopet.php">ECO-PET</a></li>
                    <li class="fuente"><a href="hogar.php">HOGAR</a></li>
                    <li class="fuente"><a href="oficina.php">OFICINAS</a></li>
                    <li class="fuente"><a href="bodas.php">BODAS</a></li>
                    <li class="fuente"><a href="decoracion.php">DECORACIÓN</a></li>
                  </ul>
                </li>

                <!-- dropdown de blog -->
                <li class="fuente"><a href="blog.php" role="button">BLOG</a>
                </li>
                
                <!--Dropdown de quienes somos -->
                <li  class="dropdown fuente">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">QUIENES SOMOS?<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="fuente"><a href="../views/quienes.php">MISION Y VISION</a></li>
                    <li class="fuente"><a href="conoce/conoce.php">CONOCE NUESTRO EQUIPO</a></li>
                   
                  </ul>
                </li>

                <!-- dropdown de blog -->
                <li class="dropdown fuente">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">CONTACTANOS<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="fuente"><a href="#" data-toggle="modal" data-target="#help">FORMULARIO DE CONTACTO</a></li>
                    <li class="fuente"><a href="ask.php">PREGUNTAS FRECUENTES</a></li>
                  </ul>
                </li>
                
                <li>
          <?php
                            @session_start();
                            if(isset($_SESSION['usuario'])){
                                $nombre_usu = $_SESSION['usuario'];
                                
                                print("<li class='dropdown fuente'>
                  <a href='#' class='dropdown-toggle mayuscula' data-toggle='dropdown' role='button' aria-haspopup='true' aria-expanded='false'> <span class='glyphicon glyphicon-user'></span> BIENVENIDO, $nombre_usu<span class='caret'></span></a>
                  <ul class='dropdown-menu'>
                    <li class='fuente'><a href='#' data-toggle='modal' data-target='#help'><span class='glyphicon glyphicon-pencil'></span> MODIFICAR MI PERFIL</a></li>
                    <li class='fuente'><a href='compra.php'><span class='glyphicon glyphicon-shopping-cart'></span> VER CARRITO DE COMPRA</a></li>
                    <li class='fuente'><a href='views/rec.php?id'><span class='glyphicon glyphicon-book'></span> VER TUS COTIZACIONES</a></li>
                    <li class='fuente'><a href='logoutcliente.php'><span class='glyphicon glyphicon-remove'></span> CERRAR SESION</a></li>
                  </ul>
                </li>"); 
                               
                                
                               
                            }
                            else{
                                echo "<a class='fuente' href='login.php'><span class='glyphicon glyphicon-user '></span> INICIAR SESION</a><br>";
                            }                            
                        ?> 


                        </li>
                        
              </ul>
              

            </div></strong>
          </div>
        </nav>

</div>

<br>
<br
<br>
<br>

<div class="animated fadeIn">
	<!-- SPEAKERS SECTION -->	
	<section id="speakers">
		<h2 class="fuente mayuscula">NUESTRO EQUIPO</h2> <!-- Section Title -->
		<div class="container">
			<div class="col-md-8 col-md-offset-2">
				<!-- Section Description -->
				<p class="fuente">Conoce al equipo de trabajo que hace posible este sitio: </p>
			</div>

			<!-- First Row of Speakers -->
			     <div class='row1'>
			   
			
	<?php

         include("../../backend/procesos/database.php");

$sql = "SELECT * FROM equipo";
            $params = null;
            
            $data = Database::getRows($sql, $params);
            if($data != null)
            {
              $products = "";
              foreach ($data as $row) 
              {
                
                $products .= "
			
				<!-- Speaker 1 -->

				        <div class='col-md-3'>
						<div class='unhover_img'>
						<img src='data:image/*;base64,$row[foto]' alt=' />
						</div>
						
                        <h4 class='fuente '></h4>
					
						<br>
						<h5 class=' btn btn-hola'>$row[cargo]</h5>
						<br>
						<br>
						<br>
						<h4 class='fuente'>$row[nombre]</h4>

			            

			            </div>

				   	</a>	
					<ul>
					<li><a href='$row[facebook]' target='_blank'><i class='fa fa-facebook'></i></a></li>
				    <li><a href='$row[twitter]'  target='_blank'><i class='fa fa-twitter'></i></a></li>
					</ul>
					<br>
					<br>
					   </div>
												
				";
                }
                print($products);
              }
              else
              {
                print("<div class='col-xs-6 col-sm-4 col-md-3  text-center box'><i class='material-icons left'></i>No hay mision , vision ni valores disponibles en este momento.</div>");
              }
            ?>

            

            	</div>
				</div> <!-- End First Row -->
			
			
			
			
			
					
		</div>
	</section>
	</div>
	</div>

	</div>

	<!-- //SPEAKERS SECTION -->
	<?php include '../views/footer.php'; ?>
				
					
			

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> <!-- Load jQuery -->

	
</body>
</html>	