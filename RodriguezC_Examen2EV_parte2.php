</head>
<body>  
	<?php
		//------------------------------------------DECLARO VARIABLES Y METO LO INTRODUCIDO EN VARIABLES O FOR_EACH------------------------> 
		$nameErr = "";
		$nameErr1 = "";
		$nameErr2 = "";
		$nameErr3 = "";
		$cod= "";  
		$cant= "";
		$num= "";
		$correcto= true;
		$xletra= "";
		$cantidadTotal= "";
		/*
		
		•La cantidad total que debe tomar, en miligramos (mg) que siempre será múltiplo de 10. Porejemplo 730 mg. (Dosis total)
		
		•El número de pastillas por caja y la dosis por pastilla vendrán indicados por la primera letra delcódigo: por ejemplo la letra A indicará 13 pastillas de 5 mg, la letra B 15 pastillas de 10mg, etc.Aunque el programa podría
		incluir todas las letras basta con que hagas las 10 primeras. •Para gestionar lo anterior debes guardar en uno o varios arrays la información asociada a cadaletra: el número de pastillas por caja y la dosis por pastilla. •El
		número de pastillas en cada caja puede ser cualquiera entre 5 y 20.•La dosis en cada pastilla será de 1 o 5 o 10 mg. (no pongo coma para no confundir 1 o 5 con 1,5)
		cod, cant, num
		*/
		
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST["Aceptar"])){
				
				
				if (empty($_POST["cod"])) {
					$nameErr = "Campo obligatorio";
					$correcto = false;
				} else {
					$cod = test_input($_POST["cod"]); //saneamos el dato
					$xletra= letraCod($cod);
					echo " XXXC LETRAAAA: ".$xletra;		
					$error = compruebaCod($cod); //sino coincide devuelve mensaje de error
					//echo " XXXERR".$error;
					if(!empty($error)) { //si var tiene el mensaje de error, no esta vacia
						$id="";  //la variable o el datos lo vaceamos o no guardamos el dato
						$correcto = false; //false porque si hay var de error.
						$nameErr= $error;
					}
				}
				
				
				
				if (empty($_POST["cant"])) {
					$nameErr1 = "Campo obligatorio";
					$correcto = false;
				} else {
					$cant= test_input($_POST["cant"]); //saneamos el dato
							
					$error = compruebaCant($cant);	
					if(!empty($error)) { //si var tiene el mensaje de error, no esta vacia
						$edad="";  //la variable o el datos lo vaceamos o no guardamos el dato
						$correcto = false; //false porque si hay var de error.
						$nameErr1= $error;
					}
				}	
				
/*La cantidad total (mg) siempre será múltiplo de 10.(Dosis total)•El número de pastillas por caja y la dosis por pastilla vendrán indicados por la primera
letra delcódigo: por ejemplo la letra A indicará 13 pastillas de 5 mg, la letra B 15 pastillas de 10mg, etc.Aunque el programa podría incluir todas las letras basta con que hagas las 10 primeras. 

•Para gestionar  lo anterior debes guardar en uno o varios arrays la información asociada a cadaletra: el número de pastillas por caja y la dosis por pastilla. •El número de pastillas en cada caja puede ser cualquiera entre 5 y 20.
 •La dosis en cada pastilla será de 1 o 5 o 10 mg. (no pongo coma para no confundir 1 o 5 con 1,5)*/		
				
				
				
				
				
				
				
				
			}
		}
		//-------------------------------------------------FUNCIONES DE COMPROBACION-------------------------------------------------------->
		function test_input($data) {
			$data = trim($data); //ELIMINA ESPACIOS ANTE Y DESPUES DE LOS DATOS
			$data = stripslashes($data); //ELIMINA BARRAS \
			$data = htmlspecialchars($data); //Traduce caracteres especiales en entidades HTML
			return $data;
		}
		
		function compruebaEdad($dato){
			if ($dato < 0 || $dato > 110){
				$error= "Edad no valida";
			}
			return $error;
		}
		
		function compruebaCant($dato){
			$error= "";
			if ($dato % 10 !== 0){
				$error= " No es la cantidad correcta, debe ser multiplo de 10";
			}
			return $error;
		}
		
		function letraCod($dato){
			if (!empty($dato)){
				$letra= $dato[0]; 
				//echo "".$letra;
			} 
			return $letra;	
		}
		
/*El número de pastillas por caja y la dosis por pastilla vendrán indicados por la primera letra delcódigo: por ejemplo la letra A indicará 13 pastillas de 5 mg, la letra B 15 pastillas de 10mg, etc.
Aunque el programa podría incluir todas las letras basta con que hagas las 10 primeras. •Para gestionar lo anterior debes guardar en uno o varios arrays la información asociada a cadaletra: 
el número de pastillas por caja y la dosis por pastilla. •El número de pastillas en cada caja puede ser cualquiera entre 5 y 20.•La dosis en cada pastilla será de 1 o 5 o 10 mg. (no pongo coma para no confundir 1 o 5 con 1,5)*/
		
		function compruebaCod($xcod) {
			$patron= "/^[A-Z]{1}[A-Z0-9]{2}\-[A-Z]{2,7}([\-](\d)[B-DF-HJ-NP-TV-Z])?/"; 	
			$error= "";
			$long= strlen($xcod);
			if (!preg_match($patron,$xcod)) {
				$error = "El identificador es de tipo: 3caracteres- de 2 a 7 caracteres";
			}
			if($long< 6 || $long > 12){
				$error = "La longitud es de 6 a 12 caracteres";
			}
			return $error;
		}
	?>
	<!---------------------------------------------------------------FORMULARIO------------------------------------------------------------> 
	<?php  
		
		if(!isset($_POST["Aceptar"]) || !$correcto) {  //isset, determina si una var está definida(no es NULL)
		?>	
		<h2>DATOS DEL MEDICAMENTO</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			
			<fieldset>
				CODIGO DE MEDICAMENTO: <input type="text" name="cod"> 
				<span class="error">* <?php echo $nameErr;?></span> 
				<br><br>
			</fieldset>
			<fieldset>
				DOSIS A TOMAR: <input type="text" name="cant">
				<span class="error1">* <?php echo $nameErr1;?></span> <!--span=div pero en una linea. -->
				<br><br>
			</fieldset>
			<br>
			<span class="error2"> <?php echo $nameErr3;?></span>
			<input type="submit" name="Aceptar" value="Aceptar">  
		</form>
	<?php
		} 
		
		else {  //METO LO QUE HAY QUE LLEVAR A LA SGTE PAG EN LA VAR DE SESSION Y REDIRIJO.  nombre, apellidos y número de viajero
			$_SESSION["cod"]= $cod;
			$_SESSION["cant"]= $cant;
			$_SESSION["xletra"]= $xletra;
			header("Location: ./RodriguezC_Examen2EV_Fin.php");
		}
		
		?>
	</body>  
</html> 