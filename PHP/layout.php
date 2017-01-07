
<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Inicio</title>
    <link rel='stylesheet' type='text/css' href='../estilos/style.css' />

	<link rel='stylesheet' 
		   type='text/css' 
		   href='../estilos/wide.css' />
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
			<li class = "lista2"><a href='galeria.php' class="sel">Galería</a></li>
			<li class = "lista2"><a href='comentarios.php' class="sel"> Valoraciones Clientes</a></li>
			<li class = "lista2"><a href='reservar.php' class="sel"> Reservas</a></li>
		</ul>
	</div>
	<nav class='presentacion' id='n1'>
		<div><br>
			<img src = "../imagenes/loginicon.png" width="75" height= "80"  align= "center">
		</div>
		<div><br><br>
			<form  id = "login" name "login" action="layout.php" method="post" >
				Nickname :<br>
					<input name="username" type="text" id="username" class = "inputs" required>
				<br><br>
				Password:<br>
					<input name="pass" type="password" id="pass" class = "inputs" required>
				<br><br>
					<input type="submit" name="Submit" class = "boton" value="LOGIN">
			</form>
		</div>
		<br>
		<p id = "unregistered" onclick = "window.location = 'http://multiaventuraxtreme.esy.es/Entrega/PHP/registro.php' " onmouseover = "this.style.textDecoration='underline';" onmouseout = "this.style.textDecoration='none';">
		¿Empleado y sin registrar ?
		</p>
	</nav>
    <section class="presentacion" id="s1" >
    <h2>¡Bienvenidos a Multiaventura X-treme!</h2>
	<div>
	<h3>CONÓCENOS</h3>
	<p>Somos una empresa con 15 años en el sector. Organizamos nuestras actividades a medida del grupo, por lo que es ideal para
	personas de todos los grados de experiencia en actividades de montaña / deportes. Nuestro cualificado personal hará, sin duda alguna,
	que la experiencia sea lo más agradable posible. Podéis encontrarnos en el <h4>Km 5 del puerto de Montalvacín, Huesca</h4>
	Te invitamos a que realices tu reserva desde esta misma web, pero por si te surge cualquier duda, no dudes en llamar al teléfono
	<h4>638301833</h4>
	</p><br>
	<p>
	<img src = "../imagenes/huesca.png" width="450" height= "230"  align= "center">
	</p>
	</div>
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
<?php

if( isset ($_POST['username']) && isset($_POST['pass']) ){
	
	include("./conexionbd.php");

	$usuario = $_POST['username'];

	$pass = sha1($_POST['pass']); //desencriptamos el password

	$query = mysqli_query($mysqli, "SELECT * FROM empleados WHERE Nick = '$usuario' and Clave = '$pass' ") or die('No se ha podido buscar al usuario en la BD');

	if( ($result = mysqli_num_rows($query) ) < 1 ){

		echo "<center> No se ha encontrado al usuario</center>";
	
		die('');
	
	}else{
		
		$_SESSION['monitor'] = $usuario;
	
		header("location: mihorario.php");
		
	}
	
}

?>