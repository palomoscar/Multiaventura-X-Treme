<!DOCTYPE html>
<html>
  <head>
  
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Inicio</title>
    <link rel='stylesheet' type='text/css' href='../estilos/styleComentarios.css' />
	<script>
	function mostrarAJAX{ 
	
		xmlhttp = new XMLHttpRequest();
		
		xmlhttp.onreadystatechange=function(){
			
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			
			document.getElementById("monitor").innerHTML=xmlhttp.responseText;
			
			}
		}
	
		xmlhttp.open("GET","comprobarMail.php",true); cambiar
	
		xmlhttp.send();
	}
	


	</script>
	<link rel='stylesheet' 
		   type='text/css' 
		   href='../estilos/wideComentarios.css' />
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
			<li class = "lista2"><a href='reservar.php' class="sel"> Reservas</a></li>
			<li class = "lista2"><a href='layout.php' class="sel"> Inicio</a></li>
		</ul>
	</div>

	<nav class='main' id='n1'>
		<center>
		<h2>¡Coméntanos tu experiencia!</h2><br>
			<form  id = "comentarios" name "comentarios"  method="post" action = "pruebajax.php" >		
				<td>Autor : </td><input name="autor" type="text" id="autor" class = "inputs" placeholder="Pepe" required><br><br>
				<?php
				
					
				$fecha =  date('l jS \of F Y ');

				echo "<td>Fecha : </td> ".$fecha."<br><br>";
				
				?>
				<td>Actividad : </td><input type = "text" class = "inputs" name = "actividad" id = "actividad" placeholder = "Rafting" required>				
				<br><br>
				<td>Valoracion : </td><select name="valoracion" id = "valoracion"  class = "inputs" size="1" required>
					<option value = "0" selected></option>
					<option value = "1">1</option>
					<option value = "2">2</option>
					<option value = "3">3</option>
					<option value = "4">4</option>
					<option value = "5">5</option>
					</select><br><br>
				<td>Observaciones : </td><br><textarea rows="4" cols="40" placeholder = "...¡Escribenos un comentario!..." class = "inputs"></textarea><br><br>
				<input type="submit" name="Submit" class = "boton" value="ENVIAR">
			</form>
		</center>
	</nav>
    <section class="main" id="s1">
    <?php
	
		echo "<center>";
		
		echo "<h3>VALORACIONES DE NUESTROS CLIENTES</h3>";
	
		echo "<br>"; 
		
		$comentarios = simplexml_load_file("../XML/comentarios.xml");

		echo '<table border=1><tr> 
		<th> Autor </th>
		<th> Fecha </th>
		<th> Actividad </th>
		<th> Valoracion </th>
		<th> Observaciones </th>
		</tr>';
		
		foreach($comentarios as $comentario ){
			
			echo '<tr>
					<th>'.$comentario->comentario->autor.'</th>
					<th>'.$comentario->comentario->fecha.'</th>
					<th>'.$comentario->comentario->actividad.'</th>
					<th>'.$comentario->comentario->valoracion.'</th>
					<th>'.$comentario->comentario->observaciones.'</th>
				</tr>';
		}
		
		echo "</center>";
		
	?>
    </section>
</div>
</body>
</html>
<?php

//insertamos en el xml	

echo "aun no ha entrado";


if( isset($_POST['autor']) ){
	
	echo "pasa el primero";
	
	if( $_POST['valoracion'] > 0 ){
		
		echo "pasa el segundo";
		
		echo $_POST['actividad'];
		
		if( $_POST['actividad']  != "Quads" || $_POST['actividad']  != "Barranquismo" || $_POST['actividad']  != "Paseos a caballo"  || $_POST['actividad']  != "Rafting"  ){
			
			echo "Por favor, selecciona una de nuestras actividades para valorar";
			
			die('');
			
		}
			
		echo "pasa el tercero";
		
		die('');
			
		$xml = simplexml_load_file('../XML/comentarios.xml');
	
		$id = $xml['last_id']+1;
	
		//creamos el comentario
	
		$comentario = $xml->addChild('comentario');
	
		$comentario->addChild('autor', $_POST['autor']); 
		
		$comentario->addChild('fecha', $fecha);
	
		$comentario->addChild('actividad', $_POST['actividad']);
	
		$comentario->addChild('valoracion', $_POST['valoracion']);
	
		if( isset($_POST['observaciones'])){
		
			$comentario->addChild('observaciones');
		
		}
	
		$xml['last_id'] = $id;
	
		//guardamos el comentario
	
		$resultado = $xml->asXML('../XML/comentarios.xml');
		
		if($resultado == true){
			
			echo '<script>alert("¡Comentario agregado con exito!");</script>';
			
		}else{
			
			echo '<center> Error al insertar tu comentario en comentarios.xml</center>';
			
		}
		
	}	
}
		
?>