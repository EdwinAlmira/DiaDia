<!DOCTYPE html>
<html>

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="keywords" content="footer, address, phone, icons" />
	<title>Footer With Address And Phones</title>
	<link rel="stylesheet" href="../css/demo.css">
	<link rel="stylesheet" href="../css/footer.css">
</head>
	<body>
		<!-- The content of your page would go here. -->
		<footer class="footer-distributed">
			<div class="footer-left">
				<h3><img src="../img/logos/logo2.png" class="imgfooter"alt=""></h3>
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
				<?php
				

					$sql = "SELECT * FROM redsocial";
            $params = null;
            
            $data = Database::getRows($sql, $params);
            if($data != null)
            {
              $products = "";
              foreach ($data as $row) 
              {
                
                $products .= "<a href='$row[url]' target='_blank'><i class='$row[nombre_red]'></i></a>";
                }
                print($products);
              }
              else
              {
                print("<div class='col-xs-6 col-sm-4 col-md-3  text-center box'><i class='material-icons left'></i>No hay redes sociales en este momento.</div>");
              }
            ?>


					
			
				</div>
			</div>
		</footer>
	</body>
</html>
