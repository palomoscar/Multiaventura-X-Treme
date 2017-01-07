
<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Galeria</title>
    <link rel='stylesheet' type='text/css' href='../estilos/styleGaleria.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   href='../estilos/wideGaleria.css' />
  </head>
  <body>
  <div id='pagina'>
	<header class='main' id='h1'>
		<div id ="logo">
			<img src = "../imagenes/Logo.png" width="370" align= "center">
		</div>	
    </header>
	<div class = "links">
		<ul class="lista">
			<?php
			
				session_start();
			
				if( isset ($_SESSION['monitor']) ){
					
					echo "<li class = 'lista2'><a href='mihorario.php' class='sel'>Mi Horarios</a></li>";
					
					echo "<li class = 'lista2'><a href='logout.php' class='sel'>Logout</a></li>";
					
				}
			?>
			<li class = "lista2"><a href='comentarios.php' class="sel"> Valoraciones Clientes</a></li>
			<li class = "lista2"><a href='reservar.php' class="sel"> Reservas</a></li>
			<li class = "lista2"><a href='layout.php' class="sel">Inicio</a></li>
		</ul>
	</div>
    <section class="main" id="s1">
	<br>
	<center><h2>BARRANQUISMO</h2></center><br>
	<img src = "../imagenes/barranq1.png" width="370" >
	<img src = "../imagenes/barranq2.png" width="370" ><br><br>
	<center><h2>RAFTING</h2></center><br>
	<img src = "../imagenes/rafting1.png" width="370" align= "center">
	<img src = "../imagenes/rafting2.png" width="370" align= "center"><br><br>
	<center><h2>QUADS</h2></center><br>
	<img src = "../imagenes/quad1.png" width="370" align= "center">
	<img src = "../imagenes/quad2.png" width="370" align= "center"><br><br>
	<center><h2>PASEOS A CABALLO</h2></center><br>
	<img src = "../imagenes/paseo1.png" width="370" align= "center">
	<img src = "../imagenes/paseo2.png" width="370" align= "center"><br><br>
		
    </section>
	<footer class='main' id='f1'>
		<div id= "rrss">
			<a href = "https://twitter.com/" ><img src = "../imagenes/twitter.png"  onclick = "" width="60" height = "60" align= "center"></a>
			<a href = "https://github.com/" ><img src = "../imagenes/github.png"  width="60" height = "60" align= "center"></a>
			<a href = "https://www.instagram.com/" ><img src = "../imagenes/insta.png"  width="60" height = "60" align= "center"></a>
		</div>
	</footer>
</div>
</body>
</html>