
<!DOCTYPE html>
<?php

session_start();

include("./conexionbd.php");

if( !isset($_SESSION['monitor'])){
	
	header("location: layout.php");
	
}

?>
<html>
  <head>
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Mi Horario</title>
    <link rel='stylesheet' type='text/css' href='../estilos/style2.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   href='../estilos/wide2.css' />
	<script>
	
	function mostrarhorario(dia){ 
	
		xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange=function(){
			
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			document.getElementById("desplegable").innerHTML=xmlhttp.responseText;
			
			}
		}
		
		xmlhttp.open("GET","desplegablehorario.php?dia="+dia,true);
	
		xmlhttp.send();
	}
	
	
	</script>
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
			<li class = "lista2"><a href='logout.php' class="sel"> Logout</a></li>
			<li class = "lista2"><a href='galeria.php' class="sel">Galería</a></li>
			<li class = "lista2"><a href='comentarios.php' class="sel"> Valoraciones Clientes</a></li>
			<li class = "lista2"><a href='reservar.php' class="sel"> Reservas</a></li>
			<li class = "lista2"><a href='layout.php' class="sel"> Inicio</a></li>
		</ul>
	</div>
    <section class="main" id="s1">
		<?php
		
		echo "<center><h3>Bienvenido, ".$_SESSION['monitor']."</h3></center>";
		
		?>
		<center>
			<br>
			Ingresa el día a consultar : <input type ="number" id = "dia" name = "dia" class = "inputsCortos" min = "1" max = "31" required>
			<input type = "button" onClick= "mostrarhorario(document.getElementById('dia').value)" class = "boton2" value = "CONSULTAR">
			<br><br>
			<div id="desplegable">
			</div>
		</center>
    </section>
	<footer class='main' id='f1'>
		<div id= "rrss">
			<a href = "https://twitter.com/" ><img src = "../imagenes/twitter.png" width="60" height = "60" align= "center"></a>
			<a href = "https://github.com/" ><img src = "../imagenes/github.png"  width="60" height = "60" align= "center"></a>
			<a href = "https://www.instagram.com/" ><img src = "../imagenes/insta.png"  width="60" height = "60" align= "center"></a>
		</div>
	</footer>
</div>
</body>
</html>