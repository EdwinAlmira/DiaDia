<!doctype html>
<html class="no-js" lang="es">
<head>
    <meta charset="utf-8">
    <title>Formulario de Compra</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--Estilos-->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="../css/mainEdwin.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/nav.css">
    <link rel="stylesheet" href="../css/products.css">
    <link href="../css/index.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Ropa+Sans' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Advent+Pro' rel='stylesheet' type='text/css'>


</head>
<body>
    <!-- Barra de navegación -->
    <?php include 'nav.php'; ?>
    <?php include '../views/detalle.php'; ?>

    <br><br>
    <!--Blog-->
    <div class="container vcenter">
      <div class="row">
        <div class="blogback col-md-offset-1 col-md-10">
          <div class="cabez"><br>
            <h1 class="text-center fuente mayuscula">Formulario de Compra</h1><br>
            <img src='../img/logos/blancosmall.png' class='ubicacion2'>

        </div>
        <br>

        <!--Funciones que modifican la cantidad en el carrito y eliminar productos-->
        <?php
            require("../../backend/procesos/database.php");
            function agregar_mas($idcarro, $agregado) {
            $sql = "UPDATE carritos SET cantidadCarrito = ? WHERE carritos.Id_carrito = ?";
            $params = array($agregado, $idcarro);
            Database::executeRow($sql, $params);
            }

            if(isset($_POST['procesar']) and $_POST['procesar'] == 'si' and $_POST['agra'] > 0){
               agregar_mas($_POST['id'], $_POST['agra']);
            }

            function eliminarC($idcarro) {
            $sql = "UPDATE carritos SET estadoCarrito = 2 WHERE carritos.Id_carrito = ?";
            $params = array($idcarro);
            Database::executeRow($sql, $params);
            }

            if(isset($_POST['eliminar']) and $_POST['eliminar'] == 'si'){
               eliminarC($_POST['ide']);
            }

            function pagarCarrito($idcliente) {
            $sql = "UPDATE carritos SET estadoCarrito = 1 WHERE carritos.Id_cliente = ? and carritos.estadoCarrito=0";
            $params = array($idcliente);
            Database::executeRow($sql, $params);
            }

            function agregarPagado($idcliente) {
            $sql = "UPDATE carritos SET estadoCarrito = 1 WHERE carritos.Id_cliente = ? and carritos.estadoCarrito=0";
            $params = array($idcliente);
            Database::executeRow($sql, $params);
            }

            if(isset($_POST['pagado']) and $_POST['pagado'] == 'si'){
               pagarCarrito($_POST['iduser']);
            }


        ?>
        <br>


        <table  class="table ">

            <!-- Encabezado de tabla-->
            <thead>
                <tr>
                    <th></th>
                    <th class="fuente">Producto</th>
                    <th class="fuente">Cantidad</th>
                    <th class="fuente"></th>
                    <th class="fuente"></th>
                    <th class="fuente">$/U</th>
                    <th class="fuente">SubTotal</th>
                </tr>
            </thead>

            <!-- Cuerpo de tabla-->
            <tbody>
                <?php
                    $idp = $_SESSION['Id_cliente'];
                    $sql = "SELECT productos.nombreProdu, carritos.cantidadCarrito, carritos.Id_cliente, productos.precio, carritos.Id_carrito, carritos.estadoCarrito from productos, carritos where carritos.Id_cliente=? and carritos.Id_producto=productos.Id_producto and carritos.estadoCarrito=0 ";
                    $param = array($idp);
                    $data = Database::getRows($sql, $param);
                    if($data != null)
                    {
                        $totale = "";
                        $itemo = "";
                        foreach ($data as $row) 
                        {
                            
                            $multi = $row['precio']*$row['cantidadCarrito'];
                            $unamas = $row['cantidadCarrito'] + 1;
                            $unamenos = $row['cantidadCarrito'] - 1;
                            $idCarrito = $row['Id_carrito'];
                            $itemo .= "
                        <tr>
                            
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='eliminar'  value='si' />
                                    <input type='hidden' name='ide'  value='$idCarrito' /> <!--  id carrito -->
                                    <input type='submit' value='X' class='btn btn-elimi' />
                                </form>
                            </td>
                            <td>
                            <input type='submit' name='item_name' value='$row[nombreProdu]' class='btn btn-elimi' disabled>
                            </td>
                            <td>
                            <input type='submit' name='item_number' value='$row[cantidadCarrito]' class='btn btn-elimi' disabled>
                            </td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='procesar'  value='si' />
                                    <input type='hidden' name='id'  value='$idCarrito' /> <!--  id carrito -->
                                    <input type='hidden' name='agra'  value='$unamenos' /> <!--  una menos -->
                                    <input type='submit' value='-' class='btn btn-hola' />
                                </form>
                            </td>
                            <td>
                                <form action='' method='post'>
                                    <input type='hidden' name='procesar'  value='si' />
                                    <input type='hidden' name='id'  value='$idCarrito' /> <!--  id carrito -->
                                    <input type='hidden' name='agra'  value='$unamas' /> 
                                    <input type='submit' value='+' class='btn btn-hola' />
                                </form>
                            </td>
                            <td>$
                            <input type='submit' name='amount' value='$row[precio]' class='btn btn-elimi' disabled>
                            </td>
                            <td>$$multi</td>

                        </tr>

                            ";
                        $totale = $totale + $multi;
                        }
                        print($itemo);
                    }
                    else
                    {
                        print("<div class='center-block  text-center box fuente mayuscula'><i class='material-icons left'></i>No hay productos disponibles en este momento.</div><br><br>");
                    }
                ?>
                <?php
                    $param = array($idp);
                    $data = Database::getRows($sql, $param);
                    if($data != null)
                    {
                        $tota = "";
                        $tota .= "
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><strong>Total</strong></td>
                                <td>$$totale</td>
                            </tr>
                            <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <!--Boton de pagar-->
                                <form action='' method='post'>
                                    <input type='hidden' name='pagado'  value='si' />
                                    <input type='hidden' name='iduser'  value='$idp' /> <!--  id carrito -->
                                    <input type='submit' value='Pagar' class='btn btn-hola' />
                                </form>
                            </td>
                            <td>
                            <button class='btn btn-hola hidden-xs  col-sm-offset-1' onClick='cancelar()'>Cancelar</button>
                            </td>
                            </tr>";
                        print($tota);
                    }
                ?>

                

                <!--Botones de compra y cancelar -->

                <tr class=" hidden-sm hidden-md hidden-lg">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-hola" onClick="comprar()">Cancelar</button></td>
                </tr>
            </tbody>
        </table>



    </div>
</div>
</div>
<br>

<!--Footer-->

                <?php include 'footer.php'; ?>

<!--fin del DOM-->
    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="../js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

<script src="../js/vendor/bootstrap.min.js"></script>

<script src="../js/nav.js"></script>
</body>
</html>
