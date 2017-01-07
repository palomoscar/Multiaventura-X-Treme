
<?php	
	include("./conexionbd.php");
	
	$dia = $_GET['dia'];

	$actividad = $_GET['actividad'];

	//extraer e numer de monitores para esa actividad

	$monitor1 = mysqli_query($mysqli, "SELECT * FROM empleados WHERE Actividad1 = '$actividad'");

	$monitor2 = mysqli_query($mysqli, "SELECT * FROM empleados WHERE Actividad2 = '$actividad'");

	$monitores = mysqli_num_rows($monitor1)+ mysqli_num_rows($monitor2);

	//comprobar si tenemos mayor demanda que monitores

	$demanda =  mysqli_query($mysqli, "SELECT * FROM horarios WHERE Actividad = '$actividad' and Dia = '$dia'");

	$demandas =  mysqli_num_rows($demanda);

	if($demandas > ($monitores*5)){ //multiplicamos el numero de monitores totales por el numero de subgrupos maximos al dia que pueden atender
	
		echo "<center>Estamos completos para tu actividad el día ".$dia." , selecciona otro, por favor</center>";
	
		die('');
	
	}

	echo "Tenemos ".$monitores." monitores para esa actividad<br>";

	echo ",por lo que puede haber hasta ".$monitores." subgrupos en cada franja horaria<br><br>";
		
//si llegamos aqui es que todo va bien

//ahora habra que mostrar la tabla del ajax con lo que esta ocupado

	echo '<table border=1>
				<center>
				<tr> 
				<th> Horario </th>
				<th> Subgrupos ocupados a esta hora </th>
				</tr></center>';
	
			
	while( $row = mysqli_fetch_array($demanda) ){
				
		echo '<tr>
				<td>'.$row['Horario'].'</td>
				<td>'.$row['Subgrupos'].'</td>
			</tr>';
	}
	
	echo '</center>';


?>
