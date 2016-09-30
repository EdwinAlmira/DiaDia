
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es" class="full">
<head>
  <meta charset="UTF-8">
  <title>La Carpinteria SV</title>
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link href='https://fonts.googleapis.com/css?family=Old+Standard+TT' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/animate.css">
  <link rel="stylesheet" href="css/index.css">
  <link rel="stylesheet" href="css/font-awesomeq.css">
  <link rel="stylesheet" href="css/demo.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/estiloarriba.css" />
  <link rel="stylesheet" href="css/image-hover.min.css"/>
  <link rel="stylesheet" href="css/image-hover.css"/>
  <link rel="stylesheet" type="text/css" href="css/ns-default.css" />
  <link rel="stylesheet" type="text/css" href="css/ns-style-growl.css" />
  <script src="js/modernizr.custom.js"></script>
  <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
  <link rel="shortcut icon" href="img/logos/logosmall.ico">



<!-- Start WOWSlider.com HEAD section -->
<link rel="stylesheet" type="text/css" href="js/engine1/style.css" />
<script type="text/javascript" src="js/engine1/jquery.js"></script>
<!-- End WOWSlider.com HEAD section -->

<link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>
</head>
<body>
 
 <?php require("../backend/procesos/database.php");?>

 <?php include 'views/nav.php'; ?>


<!--MODAL DE CONTACTENOS-->
<!--Modales-->

<?php
                            
                            
                            if(isset($_SESSION['usuario'])){
                                $nombre_usu = $_SESSION['usuario'];
                                print("<div class='modal fade' id='help'>
<form action='email/mail.php' method='post'>
  <div class='modal-dialog'>
    <div class='modal-content'>
      
      <div class='modal-body'>
        
        <img class='img-responsive' src='img/logos/logomodal.png' alt='img-rude'>
        
        <br><br>
        <h4 class='text-center fuente mayuscula'> ¿PROBLEMAS $nombre_usu? , ESTAMOS ENCANTADOS EN AYUDARTE.</h4>
        <!-- formulario de ingreso de duda-->
        <form role='form'>

        <br>
          <div class='form-group'>
            <label class=' fuente mayuscula' for='name'>Motivo de consulta</label>
            <input type='text' class='form-control fuente ' id='pwd' name='asuntotxt' placeholder='Ingrese el motivo de su consulta'>
          </div>

          <div class='form-group'>
            <label class='fuente mayuscula' for='pwd'>Comentanos tu duda</label>
            <textarea class='form-control fuente' id='pwd' rows='7' name='mensajetxt' placeholder='Te responderemos lo más rapido posible' >
            </textarea>
          </div>

        </form>
        
      </div>
      <div class='modal-footer'>
        <input type='submit' class='btn btn-hola fuente' value='Enviar mensaje'>
        <buttton class='btn btn-default fuente' data-dismiss='modal'>Cancelar</buttton>
      </div>
    </div>
  </div>
</div>"); 
                               
                                
                               
                            }
                            

                            else{
                                echo "<div class='modal fade' id='help'>

  <div class='modal-dialog'>
    <div class='modal-content'>
      
      <div class='modal-body'>
        
        <img class='img-responsive' src='img/logos/logomodal.png' alt='img-rude'>
        
        <h3 class='text-center fuente'> BIENVENIDO , ESTAMOS ENCANTADOS EN AYUDARTE</h3>
        <!-- formulario de ingreso de duda-->
      

        <br>
          <div class='form-group'>
           
          </div>

          <div class='form-group'>
           
          </div>

        </form>
        
      </div>
      <div class='modal-footer'>
        <a href='views/login.php' class='btn btn-hola fuente'>Inicia sesion para enviar una consulta.</a>
              <a class='btn btn-default fuente' data-dismiss='modal'>Volver al sitio</a>

      </div>
    </div>
  </div>
</div>";
                            }                            
                        ?> 



<!--NUEVO SLIDER-->



<?php
                            
if(isset($_SESSION['usuario'])){
    $nombre_usu = $_SESSION['usuario'];
    print("



<br>
<br>
<br>
<br>

<div id='wowslider-container1'>
<div class='ws_images'><ul>
    <li><img src='img/data1/images/muebles.png' alt='' title='' id='wows1_0'/></li>
    <li><img src='img/data1/images/aprende.png' alt='' title='' id='wows1_1'/></li>
    <li><img src='img/data1/images/calidad.png' alt='' title='' id='wows1_2'/></li>
    <li><img src='img/data1/images/desing.png' alt='' title='' id='wows1_3'/></li>
    <li><img src='img/data1/images/diseo.png' alt='' title='' id='wows1_4'/></li>
    <li><img src='img/data1/images/ecopet.png' alt='' title='' id='wows1_5'/></li>
    <li><a href='http://wowslider.com/vi'><img src='img/data1/images/emprendimiento.png' alt='cssslider' title='' id='wows1_6'/></a></li>
    <li><img src='img/data1/images/ideas.png' alt='' title='' id='wows1_7'/></li>
    </ul>
      </div>
  

  <div class='ws_bullets'><div>
    <a href='#' title=''><span><img src='img/data1/tooltips/muebles.png' alt=''/>1</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/aprende.png' alt=''/>2</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/calidad.png' alt=''/>3</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/desing.png' alt=''/>4</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/diseo.png' alt=''/>5</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/ecopet.png' alt=''/>6</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/emprendimiento.png' alt=''/>7</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/ideas.png' alt=''/>8</span></a>
  </div></div><div class='ws_script' style='position:absolute;left:-99%'><a href='http://wowslider.com'>http://wowslider.com/</a> by WOWSlider.com v8.7</div>
   <div class='ws_shadow'>
  </div>
  </div>  

  <script type='text/javascript' src='js/engine1/wowslider.js'></script>
  <script type='text/javascript' src='js/engine1/script.js'></script>"); 
                               
                                
                               
                            }
                            
else{
echo "


<br>
<br>
<br>
<br>
<br>



    
<div id='wowslider-container1'>
<div class='ws_images'><ul>
    <li><img src='img/data1/images/muebles.png' alt='' title='' id='wows1_0'/></li>
    <li><img src='img/data1/images/aprende.png' alt='' title='' id='wows1_1'/></li>
    <li><img src='img/data1/images/calidad.png' alt='' title='' id='wows1_2'/></li>
    <li><img src='img/data1/images/desing.png' alt='' title='' id='wows1_3'/></li>
    <li><img src='img/data1/images/diseo.png' alt='' title='' id='wows1_4'/></li>
    <li><img src='img/data1/images/ecopet.png' alt='' title='' id='wows1_5'/></li>
    <li><a href='http://wowslider.com/vi'><img src='img/data1/images/emprendimiento.png' alt='cssslider' title='' id='wows1_6'/></a></li>
    <li><img src='img/data1/images/ideas.png' alt='' title='' id='wows1_7'/></li>
  </ul>
  </div>

  <div class='ws_bullets'><div>
    <a href='#' title=''><span><img src='img/data1/tooltips/muebles.png' alt=''/>1</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/aprende.png' alt=''/>2</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/calidad.png' alt=''/>3</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/desing.png' alt=''/>4</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/diseo.png' alt=''/>5</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/ecopet.png' alt=''/>6</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/emprendimiento.png' alt=''/>7</span></a>
    <a href='#' title=''><span><img src='img/data1/tooltips/ideas.png' alt=''/>8</span></a>
  </div></div><div class='ws_script' style='position:absolute;left:-99%'><a href='http://wowslider.com'>http://wowslider.com/</a> by WOWSlider.com v8.7</div>
<div class='ws_shadow'>
</div>
</div>  

<script type='text/javascript' src='js/engine1/wowslider.js'></script>
<script type='text/javascript' src='js/engine1/script.js'></script>";
                            }                            
                        ?> 



<script src="js/classie.js"></script>
<script src="js/notificationFx.js"></script>

<script>


// create the notification
var notification = new NotificationFx({

  // element to which the notification will be appended
  // defaults to the document.body
  wrapper : document.body,

  // the message
  message : '<img src="img/logos/blancosmall.png" align="left"><h4 class="fuente"> <br>&nbsp&nbspLA CARPINTERIA SV</h4><br><br><span class="text-center">&nbsp&nbsp&nbspConoce las novedades de nuestra tienda!</span><br><br><button type="button" class="btn btn-hola fuente ">&nbsp&nbspSuscribete a nuestro newsletter&nbsp&nbsp <span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span></button>',

  // layout type: growl|attached|bar|other
  layout : 'growl',

  // effects for the specified layout:
  // for growl layout: scale|slide|genie|jelly
  // for attached layout: flip|bouncyflip
  // for other layout: boxspinner|cornerexpand|loadingcircle|thumbslider
  // ...
  effect : 'genie',

  // notice, warning, error, success
  // will add class ns-type-warning, ns-type-error or ns-type-success
  type : 'error',

  // if the user doesn´t close the notification then we remove it 
  // after the following time
  ttl : 5600,

  // callbacks
  onClose : function() { return false; },
  onOpen : function() { return false; }

});

// show the notification
notification.show();

</script>








       
    <!-- SECCION - QUE TE OFRECEMOS? -->
    
    <section class="seccion">
    <!--Productos-->
    <br>
    <br>
    <br>
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <h3 class="text-center fuente">¿QUE TE OFRECEMOS?</h3><br>
          </div>
            <div class="col-lg-offset-1 col-lg-2 col-md-offset-1 col-md-2 col-sm-4">
              <div class="hovereffect">
              <br><img src="img/bodas/boda3.jpg" alt="" class="img-responsive bordes1">
             <h4 class="text-center fuente">BODAS</h4>
              <p class="text-center fuente text-justify">La mejor decoración especial para tus eventos especiales y los de tu familia.</p><br class="hidden-sm hidden-md hidden-lg">
          
             <div class="overlay">
                <h2 class="size fuente mayuscula"><i>BODAS</i></h2>
        <p> 
          <a class="fuente" href="views/bodas.php">Ver catalogo</a>
           </p> 
          </div>
          </div>
          </div>

            <div class="col-lg-2 col-md-2 col-sm-4">
              <div class="hovereffect">
              <br><img src="img/hogar/sofa.jpg" alt="" class="img-responsive bordes1">
              <h4 class="text-center fuente">HOGAR</h4>
              <p class="text-center fuente text-justify">Paletiza esos rincones vacios que tienes en tu hogar con muebles unicos.</p>
              <br class="hidden-sm hidden-md hidden-lg">
              <div class="overlay">
                <h2 class="size fuente mayuscula"><i>HOGAR</i></h2>
        <p> 
          <a class="fuente" href="views/hogar.php">Ver catalogo</a>
           </p> 
          </div>
          </div>
          </div>

          
            <div class="col-lg-2 col-md-2 col-sm-4">
              <div class="hovereffect">
              <br><img src="img/oficina/escritorio.jpg" alt="" class="img-responsive bordes1">
              <h4 class="text-center fuente">OFICINA</h4>
              <p class="text-center fuente text-justify">Amuebla tu oficina con un diseño innovador y comodo para tu día a día.</p><br class="hidden-sm hidden-md hidden-lg">
              <div class="overlay">
              <h2 class="size fuente mayuscula"><i>OFICINA</i></h2>
            <p> 
            <a class="fuente" href="views/oficina.php">Ver catalogo</a>
             </p> 
            </div>
            </div>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-offset-1 col-md-offset-0 col-lg-offset-0  col-sm-4">
              <div class="hovereffect">
              <br><img src="img/eco-Pet/ejemplo.jpg" alt="" class="img-responsive bordes1">
              <h4 class="text-center fuente">ECO-PET</h4>
              <p class="text-center fuente text-justify">Mima a tus mascotas con productos de calidad amigables al medio ambiente</p>
              <div class="overlay">
              <h2 class="size fuente mayuscula"><i>ECO-PET</i></h2>
            <p> 
            <a class="fuente" href="views/ecopet.php">Ver catalogo</a>
             </p> 
            </div>
            </div>
            </div>
            
            
            <div class="col-lg-2 col-md-2 col-sm-offset-2 col-md-offset-0 col-lg-offset-0 col-sm-4">
              <div class="hovereffect">
              <br><img src="img/decoracion/ejemplod.jpg" alt="" class="img-responsive bordes1">
              <h4 class="text-center fuente">DECORACION</h4>
              <p class="text-center fuente text-justify">Los mejores elementos para decorar ecologicamente tus inmuebles.</p>
              <div class="overlay">
              <h2 class="size fuente mayuscula"><i>DECORACION</i></h2>
              <p> 
             <a class="fuente" href="views/decoracion.php">Ver catalogo</a>
             </p> 
            </div>
            </div>
            </div>
        </div>
       <br> <br>
       <br><br>
       <br><br>
       <br><br>
       <br><br>
 <div class="container">

        <!-- Page Header -->
        <div class="row">
            <div class="col-lg-12 ">
           
                <b><hr class="fuentecolor"></b>
                <h1 class=" text-center fuente mayuscula letragrande "> PORQUE UNA BUENA COMPRA , ES PARA SIEMPRE! 


                 <b></h1> </b>
                <h3 class="fuente mayuscula text-center"> ¡TENEMOS SOLO LO MEJOR PARA TI! 
                </h3>
                <hr class="fuentecolor">
                <br>
                <br>
            </div>
            <br>
        </div>

        <br><br>
        <br><br>
       

        <!-- Portfolio Item Row -->
        <div class="row">

            <div class="col-md-9">
                <img class="img-responsive img-thumbnail" src="img/index/Diseño2.png" alt="">
            </div>

            <div class="col-md-3">
                                <img class="img-responsive img-thumbnail" src="img/index/diferentes.png" alt="">

                
                <br>
                <br>
                <h5 class="mayuscula fuente fuentecolor"> &nbsp&nbsp&nbsp&nbsp DISEÑO INNOVADOR DE</h5>
                <ul>
                    <li class="fuente">Habitaciones</li>
                    <li class="fuente">Muebles</li>
                    <li class="fuente">Interiores</li>
                    <li class="fuente">Salas y recibidores</li>
                </ul>
                <br>

                &nbsp&nbsp&nbsp&nbsp<a class="btn btn-success" href="#modaly" data-toggle="modal">Ver stock de productos <span class="glyphicon glyphicon-chevron-right"></span></a>
             

               <!-- Modal de youtube -->
    <div id="modaly" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     <img class="img-responsive col-md-offset-1" src="img/logos/stock.png" alt="">
                </div>
                <div class="modal-body">
                    <iframe id="cartoonVideo" width="570" height="480" src="//www.youtube.com/embed/sZ1YbTGIlbk?autoplay=1" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>



            </div>

        </div>
        <!-- /.row -->

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
         <div class='row'>
       
         <?php

     

$sql = "SELECT imagenBlog,titulo,(SUBSTRING(cuerpo,1, 183)) AS EDWIN FROM blogs WHERE estadoBlog =1";
            $params = null;
            
            $data = Database::getRows($sql, $params);
            if($data != null)
            {
              $products = "";
              foreach ($data as $row) 
              {
                
                $products .= " <!-- Projects Row -->
       
        <div class='col-md-6 portfolio-item fade1'>
                <a class='ihover left' href='hola.php'>
                    <img class='img-responsive' src='data:image/*;base64,$row[imagenBlog]' alt=''>
                </a>
                 <h3
                   class='text-center fuente mayuscula fuentecolor'>$row[titulo]</a>
                </h3>
                
                 <hr>
                <p class='fuente text-justify'>$row[EDWIN]</p>
                 <hr>
            </div>
            ";
                }
                print($products);
              }
              else
              {
                print("<div class='col-xs-6 col-sm-4 col-md-3  text-center box'><i class='material-icons left'></i>NO HAY ARTICULOS DE BLOG EN ESTE MOMENTO</div>");
              }
            ?>


        


       
                  <br>
                   <br>
                  </div>
             <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
       

    

<?php





     

$sql = "SELECT imagen FROM mesproducto WHERE estado_mes =1";
            $params = null;
            
            $data = Database::getRows($sql, $params);
            if($data != null)
            {
              $products = "";
              foreach ($data as $row) 
              {
                
                $products .= " <div class='col-lg-3 col-md-6 col-xs-6 thumb'>
                  <ul class='list-inline'> 
                  <li><a  class='ihover'><img class='img-thumbnail ' src='data:image/*;base64,$row[imagen]'><br><br></a></li>
                  </div>
                  <!--FIN DE LAS IMAGENES NORMALES-->
                </ul> ";
                }
                print($products);
              }
              else
              {
                print("<div class='col-xs-6 col-sm-4 col-md-3  text-center box'><i class='material-icons left'></i>No hay imagen de mes en este momento</div>");
              }
            ?>






 

       <?php


$tumama = "SELECT fecha_inicio, fecha_fin FROM mesproducto where estado_mes=1";
$parameesta = array();
$fechando = Database::getRows($tumama, $parameesta); 

$angelloescribio = $fechando['fecha_inicio'];
$tusabesquesi = $fechando['fecha_fin'];


$sqle = "SELECT productos.Id_producto, nombreProdu, miniDescrip, precio,fechaIngreso,imagen, productos.id_subcategoria,subcategorias.Id_categoria,categoria,subcategoria FROM productos, categorias, subcategorias WHERE  productos.id_subcategoria = subcategorias.id_subcategoria and subcategorias.Id_categoria=categorias.Id_categoria AND estadoProducto = 1 AND fechaIngreso between ? and ?";
            
            $parames = arrays($angelloescribio, $tusabesquesi);
            
            $data = Database::getRows($sqle, $parames);
            if($data != null)
            {
              $products = "";
              foreach ($data as $row) 
              {
                $idproducto = $row['Id_producto'];
                $products .= "

 <br>
 <br>
 <br>
 <br>
 
                <!--INICIO DE LA ULTIMA GALERIA-->
  
<div class='col-lg-3 col-md-6 col-xs-6 thumb'>
  <ul class='list-inline'> 
  <li><a  class='ihover circle2' href='#myGallery' data-slide-to='0' data-toggle='modal' data-target='#$row[Id_producto]'><img class='img-thumbnail ' src='data:image/*;base64,$row[imagen]''><br><br></a></li>
  </div>
  <!--FIN DE LAS IMAGENES NORMALES-->
</ul>
 
  

        

        <!--INICIO DEL MODAL DEL PREVIEW-->
<div class='modal fade' id='$row[Id_producto]'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<div class='fuente mayuscula fuentecolor'><img src='img/logos/logosmall.png' class='ubicacion-modal'>
NUESTROS NUEVOS PRODUCTOS</div>
</div>
<div class='modal-body'>


<div class='container'>
      <div class='row '>
        <div class='col-xs-12 col-sm-9 col-md-5'>
          <div class='thumbnail'>
<img  class='bordes' src='data:image/*;base64,$row[imagen]'>
              <div class='caption'>
              <hr>
                <h4 class='fuente mayuscula'><h4 class='fuente'>PRODUCTO</h4><h5 class='fuente'>$row[nombreProdu]</h4></h5>
                <hr>
                <p class='fuente text-justify'><h4 class='fuente'>DESCRIPCION</h4><h5 class='fuente'>$row[miniDescrip]</h5></p>
                <a class='btn btn-success btn-sm fuente mayuscula' role='button'>AGREADO EL: $row[fechaIngreso] <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
</a> 

            </div>
          </div>
        </div>
    </div><!--/row-->
</div><!--/container -->



<!--FINALIZAMOS EL CUERPO DEL MODAL Y ENTRAMOS AL FOOTER--></div>

<div class='modal-footer'>
<div class='pull-left'>
</div>
<button class='btn btn-hola fuente' type='button' data-dismiss='modal'>Volver al sitio&nbsp <span class='glyphicon glyphicon-share-alt' aria-hidden='true'></button>
<!--end modal-footer--></div>
<!--end modal-content--></div>
<!--end modal-dialoge--></div>
<!--end myModal-->></div>       
     
                ";
                }
                print($products);
              }
              else
              {
                print("<div class='alert alert-success img-thumbnail col-xs-12 col-md-8 col-lg-3' role='alert'><img src='img/logos/logosmall.png' ><br>       
    <b class='fuente'></b></i> <b class='fuente'>NO HAY PRODUCTOS QUE COINCIDAN CON ESTE MES</b></div>");
              }
            ?>

 

            </div>

            
        <br>
        <br>
        <br>
        <br>


       
       






 
    </div>

    </section>



 <div class="container-fluid botoncito">
        <div class="row">
          <div class="col-lg-offset-3 col-lg-3 col-md-offset-3 col-md-3 col-xs-6"><br>
            <h5 class="text-justify fuente">¿Tienes ideas en tu cabeza que quieras hacer realidad? Nosotros te ayudamos a darle vida a tus ideas con calidad y valores que nos identifican. Aquí puedes cotizar tus proyectos.</h5>
          </div>
           <?php
                            if(isset($_SESSION['usuario'])){
                                $nombre_usu = $_SESSION['usuario'];
                                
                                print("<div class='col-lg-3 col-md-3 col-xs-6'><br><br>
            <a href='views/cotiza.php' class='btn btn-hola col-lg-8 col-md-8 col-sm-8 col-xs-8 text-center fuente'><strong>Cotiza</strong></a>
          </div>"); 
                               
                                
                               
                            }
                            else{
                                echo "<div class='col-lg-3 col-md-3 col-xs-6'><br><br>
            <a href='views/login.php' class='btn btn-hola col-lg-8 col-md-8 col-sm-8 col-xs-8 text-center fuente'>Inicia sesion para cotizar tu idea</a>
          </div>";
                            }                            
                        ?> 
        
      </div>

    </div>

    
    <!--footer-->
  <br>
  <footer class="footer-distributed">
      <div class="footer-left">
        <h3><img src="img/logos/logo2.png" class="imgfooter"alt=""></h3>
        <!--<p class="footer-links">
          <a href="#">Home</a>
          ·
          <a href="#">Blog</a>
          ·
          <a href="#">Pricing</a>
          ·
          <a href="#">About</a>
          ·
          <a href="#">Faq</a>
          ·
          <a href="#">Contact</a>
        </p>-->
        <p class="footer-company-name">La Carpinteria SV &copy; 2016</p>
      </div>
      <div class="footer-center">
        <!--<div>
          <i class="fa fa-map-marker"></i>
          <p><span>21 Revolution Street</span> Paris, France</p>
        </div>-->
        <div>
          <i class="fa fa-phone"></i>
          <p>+503 6011 1363</p>
        </div>
        <div>
          <i class="fa fa-envelope"></i>
          <p><a href="mailto:support@company.com">lcsv.ecodesign@gmail.com</a></p>
        </div>
      </div>
      <div class="footer-right">
        <p class="footer-company-about">
          <span>Acerca de la empresa</span>
          Somos una empresa dedicada al diseño y ambientación de interiores con mobiliario y accesorios decorativos hechos de paletas. 
        </p>
        <div class="footer-icons">
          <a href="https://www.facebook.com/lacarpinteriasv/" target="_blank"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-twitter"></i></a>
          <!--<a href="#"><i class="fa fa-linkedin"></i></a>-->
          <!--<a href="#"><i class="fa fa-github"></i></a>-->
        </div>
      </div>
    </footer>

<a href="#" class="scrollup">Scroll</a>

<script type="text/javascript">
    $(document).ready(function(){
  
        $(window).scroll(function(){
            if ($(this).scrollTop() >1500) {
                $('.scrollup').fadeIn();
            } else {
                $('.scrollup').fadeOut();
            }
        });
  
        $('.scrollup').click(function(){
            $("html, body").animate({ scrollTop: 0 }, 900);
            return false;
        });
  
    });
</script>




  <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
  <script src="js/vendor/jquery-1.11.2.min.js"></script>
  <script src="js/vendor/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
  <script src="js/nav.js"></script>
</body>
</html>