	<!DOCTYPE html>
	<html>
	<head>
	    <meta charset="utf-8"> 
		<title>Bodas</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/bootstrap-theme.min.css">
		<link rel="stylesheet" type="text/css" href="../css/products.css">
		<link rel="stylesheet" type="text/css" href="../css/nav.css">
		<link rel="stylesheet" type="text/css" href="../css/main.css">
		<link rel="stylesheet" href="../css/register.css">
	  	<link rel="stylesheet" href="../css/font-awesomeq.css">
	    <link href="../css/bootstrap-social.css" rel="stylesheet">
	    <script src="../../backend/assets/js/sololetras.js"></script>
	    <link rel="stylesheet" href="../css/animate.css">
	    <link href="../css/docs.css" rel="stylesheet" >
	    <link href="../css/index.css" rel="stylesheet" >
	    <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
	    <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>
	    <script src="../js/modernizr.custom.js"></script>
	    <link rel="stylesheet" type="text/css" href="../css/ns-default.css" />
	    <link rel="stylesheet" type="text/css" href="../css/ns-style-growl.css" />
	    <link rel="shortcut icon" href="../img/logos/logosmall.ico">
	    <!-- Start WOWSlider.com HEAD section -->
	    <link rel="stylesheet" type="text/css" href="../js/engine2/style.css" />
	    <script type="text/javascript" src="../js/engine2/jquery.js"></script>
	    <!-- End WOWSlider.com HEAD section -->

	</head>

	<body>



	<!--Barra de navegación-->

	  <?php include 'nav.php'; ?>

	<script src="../js/classie.js"></script>
	<script src="../js/notificationFx.js"></script>
	 <?php
	                            if(isset($_SESSION['usuario'])){
	                                $nombre_usu = $_SESSION['usuario'];
	                                
	                                print(""); 
	                               
	                                
	                               
	                            }


	                        else{
	                                echo "<script>
	// create the notification
	var notification = new NotificationFx({

	  // element to which the notification will be appended
	  // defaults to the document.body
	  wrapper : document.body,

	  // the message
	  message : '<b>LA CARPINTERIA SV :</b>&nbsp<i>No olvides iniciar sesion para comentar y comprar nuestros productos!</i>',

	  // layout type: growl|attached|bar|other
	  layout : 'growl',

	  // effects for the specified layout:
	  // for growl layout: scale|slide|genie|jelly
	  // for attached layout: flip|bouncyflip
	  // for other layout: boxspinner|cornerexpand|loadingcircle|thumbslider
	  // ...
	  effect : 'slide',

	  // notice, warning, error, success
	  // will add class ns-type-warning, ns-type-error or ns-type-success
	  type : 'error',

	  // if the user doesn´t close the notification then we remove it 
	  // after the following time
	  ttl : 9000,

	  // callbacks
	  onClose : function() { return false; },
	  onOpen : function() { return false; }

	});

	// show the notification
	notification.show();

	</script>




	";
	                            }  
	                                               
	                        ?> 


	<section>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>


	<!-- Start WOWSlider.com BODY section -->
	<div id="wowslider-container1">
	<div class="ws_images"><ul>
			<li><img src="../img/data2/images/uno.png" alt="" title="" id="wows1_0"/></li>
			<li><img src="../img/data2/images/tres.png" alt="" title="" id="wows1_1"/></li>
			<li><img src="../img/data2/images/cinco.png" alt="" title="" id="wows1_2"/></li>
			<li><img src="../img/data2/images/cuatrp.png" alt="" title="" id="wows1_3"/></li>
			<li><img src="../img/data2/images/seis.png" alt="" title="" id="wows1_4"/></li>
			<li><a href="http://wowslider.com"><img src="../img/data2/images/siete.png" alt="wowslider.com" title="" id="wows1_5"/></a></li>
			<li><img src="../img/data2/images/ocho.png" alt="" title="" id="wows1_6"/></li>
		</ul></div>
		<div class="ws_bullets"><div>
			<a href="#" title=""><span><img src="../img/data2/tooltips/uno.png" alt=""/>1</span></a>
			<a href="#" title=""><span><img src="../img/data2/tooltips/tres.png" alt=""/>2</span></a>
			<a href="#" title=""><span><img src="../img/data2/tooltips/cinco.png" alt=""/>3</span></a>
			<a href="#" title=""><span><img src="../img/data2/tooltips/cuatrp.png" alt=""/>4</span></a>
			<a href="#" title=""><span><img src="../img/data2/tooltips/seis.png" alt=""/>5</span></a>
			<a href="#" title=""><span><img src="../img/data2/tooltips/siete.png" alt=""/>6</span></a>
			<a href="#" title=""><span><img src="../img/data2/tooltips/ocho.png" alt=""/>7</span></a>
		</div></div><div class="ws_script" style="position:absolute;left:-99%"><a href="http://wowslider.com">wowslider.com</a> by WOWSlider.com v8.7</div>
	<div class="ws_shadow"></div>
	</div>	
	<script type="text/javascript" src="../js/engine2/wowslider.js"></script>
	<script type="text/javascript" src="../js/engine2/script.js"></script>
	<!-- End WOWSlider.com BODY section -->

	<br>
	 
	 <hr>
	 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	 <h1 class="text-center fuente fuentecolor"> <i>BODAS</i></h1><br> 
	 <hr>
	 </div>


		<!--Boton de compra-->
		<div class="container-fluid" id="principalP">
			<div class="row-fluid">
			<div class="col-sm-12 col-md-offset-10 col-md-2 postz" id="barranueva">
					<br><br><ul class="nav nav-pills nav-stacked" id="menuVertical">
						<li class="active item " ><a href="#" class="categoria"><p id="boton1" class="text-center"></p><button type="button" class="btn btn-hola center-block" onClick="getBuy()"><span class="glyphicon glyphicon-shopping-cart"></span> Comprar </button>
						</a></li>
					</ul><br>
					</div>
				</div>


				<!---Navegacion entre categorias-->
				<div class="col-sm-2 col-md-2 postz wow slideInLeft" data-wow-offset="300"  data-wow-iteration="1" id="" >
				<ul class="nav nav-pills nav-stacked" id="menuVertical">
				<!--Crea las tabs con las subcategorias -->
				<?php
						require("../../backend/procesos/database.php");
						$sql = "SELECT subcategoria, id_subcategoria from subcategorias where Id_categoria=3";
						$data = Database::getRows($sql, null);
						if($data != null)
						{
							$itemo = "";
							foreach ($data as $row) 
							{
								$sub = $row['id_subcategoria'];
								$itemo .= "<li class='item'><a href='#Jardin'>
											  <form action='' method='post'>
			                                    <input type='hidden' name='filtrar'  value='si' />
			                                    <input type='hidden' name='subca'  value='$sub' /> <!--  id carrito -->
			                                    <input type='submit' value='$row[subcategoria]' class='btn btn-elimi' />
			                                  </form>
			                                 </a>
			                                </li>";

							}
							print($itemo);
						}
						else
						{
							print("<div class='alert alert-success col-xs-12 col-md-8 col-lg-5' role='alert'><img src='../img/logos/logosmall.png' class=''><b class='fuente'> AVISO:</b></i> <b class='fuente'>NO HAY PRODUCTOS INGRESADOS EN ESTE MOMENTO.</b></div>");
						}
			    ?>

			    	</ul>
					
					<form action='' method='post' class="navbar-form navbar-right" role="search">
	                <input id='buscar' type='text' name='buscar' autocomplete="off" placeholder = 'Buscar categorías' onkeypress="return soloLetras(event)" class='validate col-md-12'/><br><br>
	                <input type='submit' value='Buscar' class='btn btn-hola  col-md-offset-4 col-xs-offset-2 colordebotonaceptar enblanco' />
				</form>
			</div>

			<!--Funciones para agregar al carrito-->
	        <?php
	        	           /*Fecha*/
			    ini_set("date.timezone","America/El_Salvador");
			    $fechaIngreso = date("Y/m/d");
			    $horaIngreso = date("G:i:s");
			    $valuando = 0;
	        	if(isset($_SESSION['Id_cliente'])){
		                $idc =$_SESSION['Id_cliente'];           
		            }
		            else{
		                echo "<a class='fuente' href='views/login.php'><i></i><span></span></a><br>";
		            } 

	            function alcarro($idprodu, $cliente) {
	            	$sqlito = "SELECT * from carritos where estadoCarrito = 0 and Id_producto = ? and Id_cliente = ?";
					$parameeshta = array($idprodu, $cliente);
					$mlg = Database::getRows($sqlito, $parameeshta);

						if($mlg == null){
				            $sql = "INSERT INTO carritos (Id_producto, Id_cliente, cantidadCarrito, estadoCarrito) VALUES (?, ?, '1', '0')";
				            $params = array($idprodu, $cliente);
				            Database::executeRow($sql, $params);
				            $valuando = 1;
				        }
				        else{
				        	
				        }
	            }

	            if(isset($_POST['alcarro']) and $_POST['alcarro'] == 'si'){
	               alcarro($_POST['idp'], $idc);
	            }
	            if($valuando == 1){
				      $usuariando = $_SESSION['Id_cliente'];
				      $bitacoriando = "CALL insertBitacoraC(3, 'Se agrego un producto al carrito', ?, ?, ?)" ;
				      $parametrando = array($usuariando, $fechaIngreso, $horaIngreso);
				      Database::executeRow($bitacoriando, $parametrando);
				}

	        ?>
				


					<!--Cuadricula con productos-->	
			<div class="col-sm-10 col-md-10 cuadricula wow slideInLeft" data-wow-offset="300"  data-wow-iteration="1">
					<div class="row">
						
						<?php
					

							if(!empty($_POST))
							{
								if(isset($_POST['filtrar']) and $_POST['filtrar'] == 'si'){
					                $search = trim($_POST['subca']);
									$sql = "SELECT productos.Id_producto, nombreProdu, miniDescrip, precio,imagen, productos.id_subcategoria, subcategorias.Id_categoria FROM productos, categorias, subcategorias WHERE  productos.id_subcategoria = subcategorias.id_subcategoria and subcategorias.Id_categoria=categorias.Id_categoria AND subcategorias.Id_categoria=3 AND estadoProducto = 1 and subcategorias.id_subcategoria = ? ORDER BY nombreProdu";
									$params = array($search);
				  	            }
					            else{
									$search = trim($_POST['buscar']);
									if($search != ""){

										$sql = "SELECT productos.Id_producto, nombreProdu, miniDescrip, precio,imagen, productos.id_subcategoria, subcategorias.Id_categoria FROM productos, categorias, subcategorias WHERE productos.id_subcategoria = subcategorias.id_subcategoria and subcategorias.Id_categoria=categorias.Id_categoria AND subcategorias.Id_categoria=3 AND estadoProducto = 1 and nombreProdu LIKE ? ORDER BY nombreProdu";
										$params = array("%$search%");
									}
									else{
										$sql = "SELECT productos.Id_producto, nombreProdu, miniDescrip, precio,imagen, productos.id_subcategoria,subcategorias.Id_categoria FROM productos, categorias, subcategorias WHERE  productos.id_subcategoria = subcategorias.id_subcategoria and subcategorias.Id_categoria=categorias.Id_categoria AND subcategorias.Id_categoria=3 AND estadoProducto = 1 ORDER BY nombreProdu";
										$params = null;
									}
								}
							}
							else
							{
							$sql = "SELECT productos.Id_producto, nombreProdu, miniDescrip, precio,imagen, productos.id_subcategoria,subcategorias.Id_categoria FROM productos, categorias, subcategorias WHERE  productos.id_subcategoria = subcategorias.id_subcategoria and subcategorias.Id_categoria=categorias.Id_categoria AND subcategorias.Id_categoria=3 AND estadoProducto = 1 ORDER BY nombreProdu";
							$params = null;
							}
							$data = Database::getRows($sql, $params);
							if($data != null)
							{
								$products = "";
								foreach ($data as $row) 
								{
									$idproducto = $row['Id_producto'];
									$products .= "
									<div class='col-xs-6 col-sm-4 col-md-3  text-center box'>
									  	<div class='thumbnail'>

									    			<img 
									    			class='imgproducto img-responsive activador'  
									    			src='data:image/*;base64,$row[imagen]'>

									    			<div class='caption'>
									      				<h3 class='text-center fuente'>$row[nombreProdu]</h3>
									    			</div>
									      				<p class='text-center fuente'>$row[nombreProdu]</p>
									      				<p class='fuente'>$row[miniDescrip]</p>
									      				<p><strong class='fuente'> Precio (US$) $row[precio] </strong></p>
									      				<form action='' method='post'>
						                                    <input type='hidden' name='alcarro'  value='si' />
						                                    <input type='hidden' name='buscar'  value='' />
						                                    <input type='hidden' name='idp'  value='$idproducto' /> <!--  id producto -->
						                                    ";
						                                    if(isset($_SESSION['usuario'])){
					                                    	
					                                    $products .= "<input type='submit' value='Comprar' class='btn btn-hola fuente' />

	                                                     <br>
					                                    <br>
					                                    <a class='fuente btn btn-hola'  href='prev.php?id=".base64_encode($row['Id_producto'])."'>Dejanos tu comentario!&nbsp 
					                                     <span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>

					                                     </a>";	
					                                    }
					                                    $products .=  "
						                                   
						                                </form><br>
									        			<form action='' method='post'>
						                                    <input type='hidden' name='procesar'  value='si' />
						                                    <input type='hidden' name='id'  value='' /> <!--  id carrito -->
						                                    <input type='hidden' name='agra'  value='' /> <!--  una menos -->
						                                </form>
										    </div>
									  	</div>";
									}
									print($products);
								}
								else
								{
									print("<div class='alert alert-success col-xs-12 col-md-8 col-lg-7' role='alert'><img src='../img/logos/logosmall.png' class=''><b class='fuente'></b></i> <b class='fuente'>NO HAY PRODUCTOS QUE COINCIDAN CON SU BUSQUEDA EN ESTE MOMENTO</b></div>");
								}
					    ?>


					</div>
			</div>
					
					
		</div>
		</div>
		</div>
		</section>
		<br>

		<!--footer-->
	<?php include 'footer.php'; ?>

	<script src="../js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<script src="../js/vendor/jquery-1.11.2.min.js"></script>
	<script src="../js/vendor/bootstrap.min.js"></script>
	<script src="../js/products.js"></script>
	<script src="../js/wow.min.js"></script>
	<script src="../js/nav.js"></script>
	<script>
	    wow = new WOW(
	      {
	        animateClass: 'animated',
	        offset:       100,
	        callback:     function(box) {
	          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
	        }
	      }
	    );
	    wow.init();
	    document.getElementById('moar').onclick = function() {
	      var section = document.createElement('section');
	      section.className = 'section--purple wow fadeInDown';
	      this.parentNode.insertBefore(section, this);
	    };
	  </script>
	</body>
	</html>