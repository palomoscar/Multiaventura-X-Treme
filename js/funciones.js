<script>
function mostrarcorreo(){ /*este sera el de ajax*/

xmlhttp = new XMLHttpRequest();
				
			xmlhttp.onreadystatechange=function(){
					
				if (xmlhttp.readyState==4 && xmlhttp.status==200){
						
					document.getElementById("monitor").innerHTML=xmlhttp.responseText;
				}
			}
				xmlhttp.open("GET","comprobarMail.php",true); 
				xmlhttp.send();
}

function resaltar(){
	
	var texto = document.getElementById("unregistered").style.font-size = "200%";
	
}

function normal(){
	
	var texto = document.getElementById("unregistered").style.font-size = "100%";
	
}