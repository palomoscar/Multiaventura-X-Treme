
<!DOCTYPE html>
<html>
  <head> 
    <meta name="tipo_contenido" content="text/html;" http-equiv="content-type" charset="utf-8">
	<title>Registro</title>
    <link rel='stylesheet' type='text/css' href='../estilos/style2.css' />
	<link rel='stylesheet' 
		   type='text/css' 
		   href='../estilos/wide2.css' />
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
			<li class = "lista2"><a href='galeria.php' class="sel">Galería</a></li>
			<li class = "lista2"><a href='comentarios.php' class="sel"> Valoraciones Clientes</a></li>
			<li class = "lista2"><a href='reservar.php' class="sel"> Reservas</a></li>
			<li class = "lista2"><a href='layout.php' class="sel"> Inicio</a></li>
		</ul>
	</div>
    <section class="main" id="s1"><br><br>
		<center>
			<h2>REGISTRO PARA EMPLEADOS</h2><br><br>
			<form  id = "login" name "login" onSubmit = "return ../js/funciones.js/validar()"action="registro.php" method="post" >
				<tr>
					<td>Nombre *:</td>
					<input name="nombre" type="text" id="nombre" class = "inputs" required>
				
					<td>Apellidos *:</td>
					<input name="apellidos" type="text" id="apellidos" class = "inputs" required>
				</tr>
				<br><br>
				<tr>
					<td>Username *:</td>
					<input name="nick" type="text" id="nick" class = "inputs" required>
				
					<td>Password *:</td>
					<input name="pass1" type="password" id="pass1" class = "inputs" required>
				</tr>	
				<br><br>
				<tr>
					<td>Repetir Password *:</td>
					<input name="pass2" type="password" id="pass2" class = "inputs" required>
				
					<td>Actividad 1 *:</td>
					<select name="act1" id = "act1"  class = "selects" size="1" required>
					<option value = "0" selected> </option>
					<option value = "Barranquismo">Barranquismo</option>
					<option value = "Quads">Quads</option>
					<option value = "Paseos a caballo">Paseos a caballo</option>
					<option value = "Rafting">Rafting</option>
					</select>	
				</tr>				
				<br><br>
				<tr>
					<td>Actividad 2 :</td>
					<select name="act2" id = "act2"  class = "selects" size="1">
					<option value = "0" selected> </option>
					<option value = "Barranquismo">Barranquismo</option>
					<option value = "Quads">Quads</option>
					<option value = "Paseos a caballo">Paseos a caballo</option>
					<option value = "Rafting">Rafting</option>
					</select>	
				
					<td>Sexo *:</td>
					<select name="sexo" id = "sexo"  class = "selects" size="1">
					<option value = "0" selected> </option>
					<option value = "Hombre">Hombre</option>
					<option value = "Mujer">Mujer</option>
					<option value = "Otro">Otro</option>
					</select>	
				</tr>
				<br><br>
				<td>Código de empleado *:</td>
					<input name="cod" type="password" id="cod" class = "inputs" >
				<BR><BR>
				<input type = "submit" class = "boton"  value = "REGISTRARSE"> 
			</form>
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
<?php

if( isset( $_POST['nombre'] ) && isset($_POST['apellidos']) && isset($_POST['nick']) && isset($_POST['pass1']) && isset( $_POST['pass2'] ) && isset( $_POST['act1'] ) && isset( $_POST['sexo'] ) && isset( $_POST['cod'] ) ){
	
	include("./conexionbd.php");
	
	$cod = $_POST['cod'];
	
	$codigo = mysqli_query( $mysqli, "SELECT * from codigos WHERE Codigo = '$cod' ");
	
	$cont = mysqli_num_rows($codigo);
	
	if( $cont < 1 ){
		
		echo "<script>El codigo de empleado ingresado no se encuentra en la BD</script>";
		
		die('');
		
	}
	
	if( $_POST['pass1'] != $_POST['pass2']){
		
		echo "<center> Las contraseñas no coinciden</center>";
		
		die('');
		
	}
	
	if( strlen($_POST['pass1']) < 6 ){
		
		echo "<center> La contraseña elegida es demasiado corta</center>";
		
		die('');
		
	}
	
	if( $_POST['sexo'] == "0"){
		
		echo "<center> Selecciona tu sexo </center>";
		
		die('');
		
	}
	
	if(  $act1 == "0" ){
		
		die('<center>Selecciona una actividad</center>');
		
	}
	
	//si ha pasado las validaciones...
	
	$nombre = $_POST['nombre'];
	
	$apellidos = $_POST['apellidos']; 
	
	$nick = $_POST['nick'];
	
	$pass = sha1($_POST['pass1']);
	
	$act1 = $_POST['act1'];
	

	
	$act2 = $_POST['act2'];
	
	$sexo = $_POST['sexo'];
	
	if( $act2 != "0"){
		
		$result = $mysqli->query("Insert into empleados(Nombre,Apellidos,Nick,Clave,Actividad1,Actividad2,Sexo) Values ('$nombre','$apellidos','$nick','$pass','$act1','$act2','$sexo')") or die('<center>No se ha podido añadir el usuario a la BD</center>');
		
	}else{
		
		$result = $mysqli->query("Insert into empleados(Nombre,Apellidos,Nick,Clave, Actividad1,Sexo) Values ('$nombre','$apellidos','$nick','$pass','$act1','$sexo')") or die('<center>No se ha podido añadir el usuario a la BD</center>');
		
	}
	
			
	echo "<center>";
	
	echo "¡Usuario registrado con exito!";
	
	echo "</center>";
		
	die('');
			
	mysqli_close($mysqli);
			
	
}


?>