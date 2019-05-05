</head>
<body>  
  <?php	

//echo " HOLA"."</br>";
	
	$id= $_SESSION["id"];		
	$edad= $_SESSION["edad"];		
	$gen= $_SESSION["gen"];		
	$cod= $_SESSION["cod"];		
	$cant= $_SESSION["cant"];
	$xletra= $_SESSION["xletra"];

	$cantidadTotal= 0;
	$porCaja= 0;
	$sobra= 0;

	echo "<ul><li>"." Codigo de paciente: ". $id."</li></ul>";
	echo "<ul><li>"." Codigo del medicamento : ". $cod."</li></ul>";
	echo "<ul><li>"." genero: ". $gen."</li></ul>";
	
	
	$pastillasPorCaja= array("A" =>"5", "B" =>"6", "C" =>"7", "D" =>"8", "E" =>"9", "F" => "10");
	$dosisPorPastilla= array("A" =>"1", "B" =>"5", "C" =>"10", "D" =>"1", "E" =>"5", "F" => "10");
	
	///cant 100
	foreach($pastillasPorCaja as $tipoCaja => $cantidad){
		foreach($dosisPorPastilla as $dosisCaja => $dosis){
			if($tipoCaja==$dosisCaja){
				echo "<ul><li>"." La caja tiene ".$cantidad. " pastillas de ". $dosis ." mg de dosis "."</li></ul>";
				$x= $cantidad*$dosis;  //x=5
				$cantidadTotal= $cant/$x;  //100 entre 5 
				$porCaja= $cantidadTotal/$cantidad;
				$sobra= $cantidadTotal-($cantidad*$porCaja);
				break;				
			}
		}
		break;
	}
	echo "<ul><li>"." Dosis TOTAL a tomar ". $cant.", entonces en total debe tomar ".$cantidadTotal." pastillas"."</li></ul>";
	echo "<ul><li>"." Se le dan ". $porCaja." cajas y le sobra ".$sobra."</li></ul>";
	
	/* CORRECION SERGIO
		-El cod del paciente: posicion 3*100, 4*10 y sumarlos.
		- dosis: el foreach dentro de otro es solo pedir una posicion de lo q querias. de la posicion 0 en este caso. $dosis[$letra o "A"].
	nº de cajas x entregar es dosis total. si hay resto hay q sumarle una caja.
	nº de pastillas q le sobrarian, dosis /nº de mg x pastilla.

	para hacer otro tratamiento se hacia redirigia a la pag anterior. en sesion poner la dosis total a 0.		
	*/
		
	// eliminamos las variables
    session_unset();
    // y destruimos la sesión por motivos de seguridad.
    session_destroy();  
  
   ?>  
</body>
</html>