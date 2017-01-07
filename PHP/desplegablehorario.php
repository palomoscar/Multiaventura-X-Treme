<?php

session_start();

include("./conexionbd.php");

$nick = $_SESSION['monitor'];

$dia = $_GET['dia'];

$nombre = mysqli_query($mysqli, "SELECT * FROM empleados WHERE Nick = '$nick' ") or die('<center>No se ha podido conectar con la BD</center>');

$seleccion = mysqli_fetch_array($nombre);

$monitor = $seleccion['Nombre'];

$horario = array(); //meteremos todas las coincidencias en un array

$actividad = array();

//como hay 3 grupos y son columnas diferentes haremos 3 querys distintos 

$horario1 = mysqli_query($mysqli, "SELECT * FROM horarios WHERE Monitor1 = '$monitor' and Dia = '$dia' ") or die('<center>No hemos podido acceder a la BD</center>');

if( ( $cont = mysqli_num_rows( $horario1 ) ) > 0 ){
	
	while( $row1 = mysqli_fetch_array($horario) ){
	
	array_push($horario, $row1['Horario']);
	
	array_push($actividad, $row1['Actividad']);
	
	}
}

$horario2 = mysqli_query($mysqli, "SELECT * FROM horarios WHERE Monitor2 = '$monitor' and Dia = '$dia' ") or die('<center>No hemos podido acceder a la BD</center>');

if( ( $cont = mysqli_num_rows( $horario2 ) ) > 0 ){
	
	while( $row2 = mysqli_fetch_array($horario2) ){
	
	array_push($horario, $row2['Horario']);
	
	array_push($actividad, $row2['Actividad']);
	
	}
}

$horario3 = mysqli_query($mysqli, "SELECT * FROM horarios WHERE Monitor3 = '$monitor' and Dia = '$dia' ") or die('<center>No hemos podido acceder a la BD</center>');

if( ( $cont = mysqli_num_rows( $horario3 ) ) > 0 ){
	
	while( $row3 = mysqli_fetch_array($horario) ){
	
	array_push($horario, $row3['Horario']);
	
	array_push($actividad, $row3['Actividad']);
	
	}
}

$size = sizeof( $horario );

if(  $size == 0 ){
	
	echo "No tienes actividades asignadas para este día";
	
	die('');
	
}

echo "<center>";

		echo '<table border=1><tr> 
		<th> Horario</th>
		<th> Actividad </th>
		</tr>';
		
		$size = sizeof( $horario );
		
		for( $i = 0 ; $i < $size ; $i++ ){
		
			echo '<tr>
					  <td>'.$horario[$i].'</td>
					  <td>'.$actividad[$i].'</td>
				 </tr>';
			
		}
		echo '</table>';
		
echo "</center>";
		
die('');

?>