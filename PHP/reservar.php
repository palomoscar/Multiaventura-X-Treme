
<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Inicio</title>
    <link rel='stylesheet' type='text/css' href='../estilos/styleReservas.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   href='../estilos/wideReservas.css' />
	<script>
	function mostrar(str, str2){ 
	
		xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange=function(){
			
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			document.getElementById("horario").innerHTML=xmlhttp.responseText;
			
			}
		}
	
		xmlhttp.open("GET","reservarAJAX.php?dia="+str+"&actividad="+str2,true); 
	
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
			<?php
			
				session_start();
			
				if( isset ($_SESSION['monitor']) ){
					
					echo "<li class = 'lista2'><a href='mihorario.php' class='sel'>Mi Horarios</a></li>";
					
					echo "<li class = 'lista2'><a href='logout.php' class='sel'>Logout</a></li>";
					
				}
			?>
			<li class = "lista2"><a href='galeria.php' class="sel">Galería</a></li>
			<li class = "lista2"><a href='comentarios.php' class="sel"> Valoraciones Clientes</a></li>
			<li class = "lista2"><a href='layout.php' class="sel"> Inicio</a></li>
		</ul>
	</div>
	<nav class='main' id='n1'>
		<br>
		<h2>Nuestro Horario</h2>
		<br><br>
		<h1>Mañanas</h1>
		<br>09:00 - 10:30 GP1<br>
			10:45 - 12:15 GP2<br>
			12:30 - 14:00 GP3<br>
		<br><h1>Tardes</h1>
		<br>16:00 - 17:30 GP4<br>
			17:45 - 19:15 GP5<br><br>
			
		En la hora y media que dura cada grupo se incluye 
		el reparto de material, las lecciones de seguridad
		y la toma de contacto con la actividad
		
	</nav>
	<nav class = "navHorario">
	<br><br>
	<div id ="horario">
	</div>
	</nav>
    <section class="main" id="s1"><br>
		<form id = "reserva" name = "reserva" action= "reservar.php" method = "post" >
			<h2>Selecciona una actividad a realizar</h2><br>
			<select name="act" id = "act"  class = "selects" size="1" required>
				<option value = "0" selected> </option>
				<option value = "Barranquismo">Barranquismo</option>
				<option value = "Quads">Quads</option>
				<option value = "Paseos a caballo">Paseos a caballo</option>
				<option value = "Rafting">Rafting</option>
			</select>
			<br><br>
			Condiciones : Barranquismo - Mínimo 4 personas | Máximo 8 <br>
			Quads y Paseos a caballo   - Mínimo 3 personas | Máximo 6 <br>
			Rafting - Múltiplos de 7 - Mínimo 7  personas - Máximo 28 (balsas de 7 +monitor)<br>
			<br> Integrantes del grupo : <br><br>
			<input type = "number" name = "personas" id = "personas" class = "horas" required>
			<br><br>
			Dia : <input type = "number" name = "dia" id = "dia" class = "horas" placeholder = "24" required>
			<br><br>				
			Elige un subgrupo : GP<input name = "confirmar" type =  "number" placeholder = "3" class = "horas" required >
			<input type= "submit" value = "RESERVAR" class = "boton" >
		</form>
		<br><br>
		<input type = "button" id = "mostrar" name = "mostrar" onclick = "mostrar(document.getElementById('dia').value,document.getElementById('act').value)" value="CONSULTAR DISPONIBILIDAD" class = "botonLargo">
		<br><br>
    </section>
	<footer class='main' id='f1'>
		<div id= "rrss">
			<a href = "https://twitter.com/" ><img src = "../imagenes/twitter.png"  width="60" height = "60" align= "center"></a>
			<a href = "https://github.com/" ><img src = "../imagenes/github.png"  width="60" height = "60" align= "center"></a>
			<a href = "https://www.instagram.com/" ><img src = "../imagenes/insta.png"  width="60" height = "60" align= "center"></a>
		</div>
	</footer>
</div>
</body>
</html>
<?php

if(isset($_POST['confirmar']) && ( $_POST['act'] != "0") && isset($_POST['dia']) &&isset($_POST['personas']) ){ 
	
	include("./conexionbd.php");

	//extraemos todos los datos de la reserva
	
	$dia = $_POST['dia'];
	
	$subgrupo = $_POST['confirmar'];
	
	$act = $_POST['act'];
	
	$clientes = $_POST['personas']; // hacer comprobaciones 
	
	if($dia < 1 || $dia > 31){
		
		echo "<center>Por favor, elige un día válido</center>";
		
		die('');
		
	}
	if(  ( ( ($act == "Quads") || ($act == "Paseos a caballo") ) && ( ($clientes <3 ) || ($clientes > 6) ) ) ){
		
		echo "<center>Elija un número de clientes válido</center>";
		
		die('');
		
	}
	if(   ($act == "Barranquismo")   && ( ( $clientes <4 ) || ($clientes > 8) )  ){
		
		echo "<center>Elija un número de clientes válido</center>";
		
		die('');
		
	}
	if(   ($act == "Rafting")   && ( ( $clientes <7 ) || ($clientes > 28) || ( ($clientes%7) != 0) )  ){
		
		echo "<center>Elija un número de clientes válido</center>";
		
		die('');
		
	}
	
	//miramos a ver si hay hueco para ese subgrupo 
	
	$consulta = mysqli_query($mysqli, "SELECT * from horarios WHERE Dia = '$dia' and Horario = '$subgrupo'" ) or die('<center>No se ha podido acceder al horario de ese dia</center>');;
	
	$reservas = mysqli_num_rows($consulta);
	
	$vacio = true;
	
	if( $reservas > 0){
		
		$vacio = false;	
		
	}
	
	if(!$vacio){ //en caso bueno hacemos un update
		
		$comprobar = mysqli_fetch_array($consulta);
		
		if( $comprobar['Subgrupos'] > 2){ //en caso de que no queden huecos disponibles
	
			echo "<center>Estamos completos para tu actividad el día ".$dia." , selecciona otro, por favor</center>";
	
			die('');
		
		}
		
		$add = (int)$comprobar['Subgrupos']+1;
		
		$monitor = "";
		
		//vamos a asignarle un monitor a la reserva, dependiendo del subgrupo
		
		//las actualizaciones de la BD serán individuales, el comando AND no responde bien
		
		if($act == "Quads"){
			
			if($comprobar['Subgrupos'] == 1){
				
				$monitor = "Aitor";
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Subgrupos = '$add' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Monitor2 = '$monitor' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
			}if( $comprobar['Subgrupos'] == 2){
				
				$monitor = "Alazne";
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Subgrupos = '$add' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Monitor3 = '$monitor' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
			}
			
		}if($act == "Barranquismo"){
			
			if($comprobar['Subgrupos'] == 1){
				
				$monitor = "Marta";
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Subgrupos = '$add' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Monitor2 = '$monitor' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
			}if($comprobar['Subgrupos'] == 2){
				
				$monitor = "Itziar";
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Subgrupos = '$add' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Monitor3 = '$monitor' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
			}
			
		}if($act == "Paseos a caballo"){
			
			if($comprobar['Subgrupos'] == 1){
				
				$monitor = "Manu";
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Subgrupos = '$add' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Monitor2 = '$monitor' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
			}if($comprobar['Subgrupos'] == 2){
				
				$monitor = "Pepe";
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Subgrupos = '$add' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Monitor3 = '$monitor' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');

			}
			
		}if($act == "Rafting"){
			
			if($comprobar['Subgrupos'] == 1){
				
				$monitor = "Manu";
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Subgrupos = '$add' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Monitor2 = '$monitor' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
			}if($comprobar['Subgrupos'] == 2){
				
				$monitor = "Marta";
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Subgrupos = '$add' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
				$update = mysqli_query($mysqli, "UPDATE horarios SET Monitor3 = '$monitor' WHERE Dia = '$dia' AND Actividad = '$act' ") or die('<center>Tu reserva no se ha podido realizar</center>');
				
			}
			
		}
			
		echo "<center>RESERVA REALIZADA CON ÉXITO</center>";
		
		echo "<center><a href='./layout.php'>INICIO</a></center>";
	
		die('');	
		
	}
	
	//si no hay reservas ese dia hacemos un insert
	
	$grupos = 1;
	
	switch($act){ //al igual que arriba, dependiendo de la actividad le asignamos un monitor diferente
		
		case 'Quads': 
						$monitor = "Pepe";  break;
		case 'Paseos a caballo': 
								$monitor = "Alazne";break;
		case 'Rafting':
						$monitor = "Itziar"; break;
		case 'Barranquismo':
							$monitor="Aitor";break;	
	}
	
	$empty = "";
	
	//me exige meterle el resto de los campos aunque sea vacio

	$insertar = mysqli_query($mysqli, "INSERT INTO horarios(Dia,Horario,Actividad,Subgrupos,Monitor1,Monitor2,Monitor3) VALUES('$dia','$subgrupo','$act','$grupos','$monitor', '$empty', '$empty') " ) or die('<center>Tu reserva no se ha podido realizar</center>');
	
	echo "<center>RESERVA REALIZADA CON ÉXITO</center>";
	
	echo "<center><a href='./layout.php'>INICIO</a></center>";
	
	die('');
	
}

?>