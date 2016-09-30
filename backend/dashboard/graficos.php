<!--COMIENZO DE LA SENTENCIA  PHP--> 

<!-- ARCHIVOS REQUERIDOS PARA EL FUNCIONAMIENTO DE LA PAGINA--> 
<?php
require("../pagina.php");
require("../procesos/database.php");
Page::header('GRAFICOS - LA CARPINTERIA SV  ');


$now = time(); // Checking the time now when home page starts.

        if ($now > $_SESSION['expire']) {
            session_destroy();
        }
?>




<!-- FIN DE LA SENTENCIA  PHP-->

<html>
  <head>
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
  </head>

  <body>
  <!--empieza grafico1-->
   <div id="grafico1"></div>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Se crea la tabla de datos
        var data = new google.visualization.DataTable();
        //Se agrega la columna de tipo string  con titulo Topping
        data.addColumn('string', 'Titulo');
        //Se agrega la columna de tipo numero con titulo Slices
        data.addColumn('number', 'Clientes');
        //Se agregan las filas
        <?php
        $sql1 = "SELECT COUNT(*) FROM clientes";
        $alumfi = Database::getRow($sql1, null);
        $sql2 = "SELECT COUNT(DISTINCT Id_cliente) from carritos";
        $alumsi = Database::getRow($sql2, null);
       	$alumno3 = $alumfi[0] - $alumsi[0];        
        
        if($alumfi[0] == null)
        {
            $alumfi[0] = 0;
        }
        if($alumsi[0] == null)
        {
            $alumsi[0] = 0;
        }
        if($alumno3 == null)
        {
            $alumno3 = 0;
        }
        
        print("data.addRows([
          ['Cantidad de clientes que han comprado en el sitio', ".$alumsi[0]."],
          ['Cantidad de clientes que no han realizado compras', ".$alumno3."],
          
        ]);");
        ?>
        // Se definen las opciones del grafico
        var options = {'title':'Registro Compras de Clientes',
        				is3D: true,
                       'width':900,
                       'height':250,
                       colors: ['#1abc9c', '#2ecc71']
                   };

        // Se instancia y dibuja nuestro grafico, ademas se pasan las opciones.
        var chart = new google.visualization.PieChart(document.getElementById('grafico1'));
        chart.draw(data, options);
      }
    </script>
    <!--Termina el grafico 1-->
	<br>
     <!--empieza grafico2-->
   <div id="grafico2"></div>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Se crea la tabla de datos
        var data = new google.visualization.DataTable();
        //Se agrega la columna de tipo string  con titulo Topping
        data.addColumn('string', 'Titulo');
        //Se agrega la columna de tipo numero con titulo Slices
        data.addColumn('number', 'Productos');
        //Se agregan las filas
        <?php
        $sql1 = "SELECT COUNT(*) FROM productos";
        $alumfi = Database::getRow($sql1, null);
        $sql2 = "SELECT COUNT(DISTINCT Id_producto) from productos";
        $alumsi = Database::getRow($sql2, null);
       	$alumno3 = $alumfi[0] - $alumsi[0];        
        
        if($alumfi[0] == null)
        {
            $alumfi[0] = 0;
        }
        if($alumsi[0] == null)
        {
            $alumsi[0] = 0;
        }
        if($alumno3 == null)
        {
            $alumno3 = 0;
        }
        
        print("data.addRows([
          ['Cantidad de productos comprados', ".$alumsi[0]."],
          ['Cantidad de productos que no han sido comprados', ".$alumno3."],
          
        ]);");
        ?>
        // Se definen las opciones del grafico
        var options = {'title':'Registro de Productos Comprados',
				        pieHole: 0.4,
                       'width':900,
                       'height':250,
                       colors: ['#3498db', '#1abc9c']
                   };

        // Se instancia y dibuja nuestro grafico, ademas se pasan las opciones.
        var chart = new google.visualization.PieChart(document.getElementById('grafico2'));
        chart.draw(data, options);
      }
    </script>
    <!--Termina el grafico 2-->
    <br>
    <!--empieza grafico3-->
   <div id="grafico3"></div>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Se crea la tabla de datos
        var data = new google.visualization.DataTable();
        //Se agrega la columna de tipo string  con titulo Topping
        data.addColumn('string', 'Titulo');
        //Se agrega la columna de tipo numero con titulo Slices
        data.addColumn('number', 'Categorias');
        //Se agregan las filas
        <?php
        $sql1 = "SELECT COUNT(*) FROM productos, subcategorias, categorias WHERE productos.Id_subcategoria=subcategorias.Id_subcategoria AND subcategorias.Id_categoria=categorias.Id_categoria AND categorias.Id_categoria=1";
        $alumfi = Database::getRow($sql1, null);
        $sql2 = "SELECT COUNT(*) FROM productos, subcategorias, categorias WHERE productos.Id_subcategoria=subcategorias.Id_subcategoria AND subcategorias.Id_categoria=categorias.Id_categoria AND categorias.Id_categoria=2";
        $alumsi = Database::getRow($sql2, null);
       	$sql3 = "SELECT COUNT(*) FROM productos, subcategorias, categorias WHERE productos.Id_subcategoria=subcategorias.Id_subcategoria AND subcategorias.Id_categoria=categorias.Id_categoria AND categorias.Id_categoria=3";        
        $alumno3 = Database::getRow($sql3, null);
        $sql4 = "SELECT COUNT(*) FROM productos, subcategorias, categorias WHERE productos.Id_subcategoria=subcategorias.Id_subcategoria AND subcategorias.Id_categoria=categorias.Id_categoria AND categorias.Id_categoria=4";        
        $alumno4 = Database::getRow($sql4, null);
        $sql5 = "SELECT COUNT(*) FROM productos, subcategorias, categorias WHERE productos.Id_subcategoria=subcategorias.Id_subcategoria AND subcategorias.Id_categoria=categorias.Id_categoria AND categorias.Id_categoria=5";        
        $alumno5 = Database::getRow($sql5, null);

        if($alumfi[0] == null)
        {
            $alumfi[0] = 0;
        }
        if($alumsi[0] == null)
        {
            $alumsi[0] = 0;
        }
        if($alumno3 == null)
        {
            $alumno3 = 0;
        }
        if($alumno4 == null)
        {
            $alumno4 = 0;
        }
        if($alumno5 == null)
        {
            $alumno5 = 0;
        }
        
        print("data.addRows([
          ['Productos en Hogar', ".$alumfi[0]."],
          ['Productos en Eco-Pet', ".$alumsi[0]."],
          ['Productos en Bodas', ".$alumno3[0]."],
          ['Productos en Decoración', ".$alumno4[0]."],
          ['Productos en Oficinas', ".$alumno5[0]."],
          
        ]);");
        ?>
        // Se definen las opciones del grafico
        var options = {'title':'Registro de Productos por Categoria',
				        pieStartAngle: 100,
                       'width':900,
                       'height':250,
                       colors: ['#3498db', '#1abc9c', '#2ecc71','#f44336','#e67e22']
                   };

        // Se instancia y dibuja nuestro grafico, ademas se pasan las opciones.
        var chart = new google.visualization.PieChart(document.getElementById('grafico3'));
        chart.draw(data, options);
      }
    </script>
    <!--Termina el grafico 3-->
    <br>
        <!--empieza grafico4-->
   <div id="grafico4"></div>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Se crea la tabla de datos
        var data = new google.visualization.DataTable();
        //Se agrega la columna de tipo string  con titulo Topping
        data.addColumn('string', 'Titulo');
        //Se agrega la columna de tipo numero con titulo Slices
        data.addColumn('number', 'Categorias');
        //Se agregan las filas
        <?php
        $sql1 = "SELECT COUNT(*) from cotizaciones WHERE estadoCotizacion=0 ";
        $alumfi = Database::getRow($sql1, null);
        $sql2 = "SELECT COUNT(*) from cotizaciones WHERE estadoCotizacion=1"; 
        $alumsi = Database::getRow($sql2, null);
       	$sql3 = "SELECT COUNT(*) from cotizaciones WHERE estadoCotizacion=2";        
        $alumno3 = Database::getRow($sql3, null);
        

        if($alumfi[0] == null)
        {
            $alumfi[0] = 0;
        }
        if($alumsi[0] == null)
        {
            $alumsi[0] = 0;
        }
        if($alumno3 == null)
        {
            $alumno3 = 0;
        }

        
        print("data.addRows([
          ['Cotizaciones Pendientes', ".$alumfi[0]."],
          ['Cotizaciones Aceptadas', ".$alumsi[0]."],
          ['Cotizaciones Negadas', ".$alumno3[0]."],   
        ]);");
        ?>
        // Se definen las opciones del grafico
        var options = {'title':'Estado de Cotizaciones',
				        is3D: true,
				        pieHole: 0.4,
                       'width':900,
                       'height':250,
                       colors: ['#f39c12', '#e67e22', '#e74c3c']
                   };

        // Se instancia y dibuja nuestro grafico, ademas se pasan las opciones.
        var chart = new google.visualization.PieChart(document.getElementById('grafico4'));
        chart.draw(data, options);
      }
    </script>
    <!--Termina el grafico 4-->
    <br>
     <!--empieza grafico5-->
   <div id="grafico5"></div>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Se crea la tabla de datos
        var data = new google.visualization.DataTable();
        //Se agrega la columna de tipo string  con titulo Topping
        data.addColumn('string', 'Titulo');
        //Se agrega la columna de tipo numero con titulo Slices
        data.addColumn('number', 'Categorias');
        //Se agregan las filas
        <?php
        $sql1 = "SELECT COUNT(*) from cotizaciones WHERE estadoCotizacion=0 ";
        $alumfi = Database::getRow($sql1, null);
        $sql2 = "SELECT COUNT(*) from cotizaciones WHERE estadoCotizacion=1"; 
        $alumsi = Database::getRow($sql2, null);
       	$sql3 = "SELECT COUNT(*) from cotizaciones WHERE estadoCotizacion=2";        
        $alumno3 = Database::getRow($sql3, null);
        

        if($alumfi[0] == null)
        {
            $alumfi[0] = 0;
        }
        if($alumsi[0] == null)
        {
            $alumsi[0] = 0;
        }
        if($alumno3 == null)
        {
            $alumno3 = 0;
        }

        
        print("data.addRows([
          ['Cotizaciones Pendientes', ".$alumfi[0]."],
          ['Cotizaciones Aceptadas', ".$alumsi[0]."],
          ['Cotizaciones Negadas', ".$alumno3[0]."],   
        ]);");
        ?>
        // Se definen las opciones del grafico
        var options = {'title':'Estado de Cotizaciones',
				        is3D: true,
				        pieHole: 0.4,
                       'width':900,
                       'height':250,
                       colors: ['#f39c12', '#e67e22', '#e74c3c']
                   };

        // Se instancia y dibuja nuestro grafico, ademas se pasan las opciones.
        var chart = new google.visualization.BarChart(document.getElementById('grafico5'));
        chart.draw(data, options);
      }
    </script>
    <!--Termina el grafico 4-->
  </body>
</html>

<?php

Page::footer(); //FOOTER DE LA CLASE PAGE
?>