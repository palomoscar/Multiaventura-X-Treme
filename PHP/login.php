<?php

	
	include("./conexionbd.php");

	$usuario = $_GET['username'];

	$pass = sha1($_GET['pass']);

	$query = mysqli_query($mysqli, "SELECT * FROM empleados WHERE Nick = '$usuario' and Clave = '$pass' ") or die('No se ha podido buscar al usuario en la BD');

	if( ($result = mysqli_num_rows($query) ) < 1 ){

		echo "<center> No se ha encontrado al usuario</center>";
	
		echo "Intentas iniciar sesion como : ".$usuario;
	
		die('');
	
	}else{
	
		echo "Has iniciado sesion como : ".$usuario;
		
		session_start();
		
		$_SESSION['monitor'] = $user;
	
		//header("location: horarios.php");
		
		
	
	}
	


?>