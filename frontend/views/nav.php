

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
                <li class="fuente"><a href="galeria.php" role="button">GALERÍA DE PROYECTOS</a>
                </li>
                
                 <!--Dropdown de quienes somos -->
                <li  class="dropdown fuente">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">¿QUIENES SOMOS?<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="fuente"><a href="quienes.php">MISION Y VISION</a></li>
                    <li class="fuente"><a href="../conoce/conoce.php">CONOCE NUESTRO EQUIPO</a></li>
                   
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
                    <li class='fuente'><a href='../clientedash/cliente/dashboard.php'><span class='glyphicon glyphicon-pencil'></span> MODIFICAR MI PERFIL</a></li>
                    <li class='fuente'><a href='compra.php'><span class='glyphicon glyphicon-shopping-cart'></span> VER CARRITO DE COMPRA</a></li>
                      <li class='fuente'><a href='rec.php?id'><span class='glyphicon glyphicon-book'></span> VER TUS COTIZACIONES</a></li>
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