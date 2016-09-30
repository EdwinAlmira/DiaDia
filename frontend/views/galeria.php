
  <!DOCTYPE html>
  <html>
  <head>
      <meta charset="utf-8"> 
      <title>GALERÍAS DE PROYECTOS</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../css/products.css">
    <link rel="stylesheet" type="text/css" href="../css/nav.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">
    <link rel="stylesheet" href="../css/register.css">
      <link rel="stylesheet" href="../css/font-awesomeq.css">
      <link href="../css/bootstrap-social.css" rel="stylesheet">
      <link rel="stylesheet" href="../css/animate.css">
      <link href="../css/docs.css" rel="stylesheet" >
      <link href="../css/index.css" rel="stylesheet" >
      <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>
      <!-- Start WOWSlider.com HEAD section -->
      <link rel="stylesheet" type="text/css" href="../js/engine2/style.css" />
      <script type="text/javascript" src="../js/engine2/jquery.js"></script>
      <!-- End WOWSlider.com HEAD section -->
      <script src="../js/modernizr.custom.js"></script>
      <link rel="stylesheet" type="text/css" href="../css/ns-default.css" />
      <link rel="stylesheet" type="text/css" href="../css/ns-style-growl.css" />
      <link rel="shortcut icon" href="../img/logos/logosmall.ico">

    
  </head>

  <body>




  <!--Barra de navegación-->
    <?php
          
    require("../../backend/procesos/database.php");      
    include 'nav.php'; ?>

    <br><br><br><br><br><br>
    <section class="seccion">
   

    

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

  <script src="../js/classie.js"></script>
  <script src="../js/notificationFx.js"></script>

 <div class="row">
          
  
  <div class="container " >
    <h1 class="fuente mayuscula text-center" >Galería de Proyectos</h1><br>
    <div class=" fuente col-sm-10 col-md-10 cuadricula " data-wow-offset="300"  data-wow-iteration="1">
          <div class="row">
          
          <?php
                   
            $sql = "SELECT * FROM galerias";
            $params = null;
            $data = Database::getRows($sql, $params);
            if($data != null)
            {
              $products = "";
              foreach ($data as $row) 
              {
                $idproducto = $row['Id_galeria'];
                $products .= "
                <div class='col-xs-6 col-sm-4 col-md-5 as  text-center box'>
                    <div class='thumbnail wow fadeInUp'>

                          <img 
                          class='imgproducto  img-responsive activador'  
                          src='data:image/*;base64,$row[ImagenG]'>
                              <p class='text-center fuente'>$row[Descripcion]</p>
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
    <br><br>
    </div>
    <br><br>

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

</section>
  </body>
  </html>