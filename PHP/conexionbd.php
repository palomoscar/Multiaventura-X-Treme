<?php

    $HOSTINGER=1;
	
	if ($HOSTINGER==1){
		
	$host = "mysql.hostinger.es";
	
	$user = "u391708731_oscar";
	
	$password = "sar123";
	
	$dbname = "u391708731_sar";
	
    }else{
		
        $host = "localhost";
		
		$user = "root";
		
		$password = "";
		
		$dbname = "sar";
    }
	
	$mysqli = mysqli_connect($host, $user, $password, $dbname);
	
	if ($mysqli->connect_errno){
		
		die ( 'Error al conectar con la Base de Datos' . mysqli_connect_error() . PHP_EOL);	
		
	}
?>