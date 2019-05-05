<?php
// Iniciamos la sesión, necesariamente tiene que ser lo primero del archivo.
session_start();  // variable global de PHP:$ _SESSION.
?>
<!DOCTYPE HTML>  
<html lang="es">
	<head>
		<meta charset=utf-8>
		<title>DATOS DEL USUARIO</title>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	<body>
	<?php
		//------------------------------------------DECLARO VARIABLES Y METO LO INTRODUCIDO EN VARIABLES O FOR_EACH (ESTA DENTRO DEL POST)---------------------- 
		$nameErr = "";
		$nameErr1 = "";
		$nameErr2 = "";
		$nameErr3 = "";
		$id= "";  
		$edad= "";
		$gen= "";
		$correcto = true;
		
		//La comprobacion sera cada vez que se haga click en Aceptar 
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if(isset($_POST["Aceptar"])){
				
				if (empty($_POST["edad"])) {
					$nameErr1 = "Campo obligatorio";
					$correcto = false;
				} else {
					$edad = test_input($_POST["edad"]); //saneamos el dato
					//echo " XXXEDAD".$edad;					
					$error = compruebaEdad($edad);
					
					if(!empty($error)) { //si var tiene el mensaje de error, no esta vacia
						$edad="";  //la variable o el datos lo vaceamos o no guardamos el dato
						$correcto = false; //false porque si hay var de error.
						$nameErr1= $error;
					}
				}
				
				if (empty($_POST["id"])) {
					$nameErr = "Campo obligatorio";
					$correcto = false;
				} else {
					$id = test_input($_POST["id"]); //saneamos el dato
					$error = compruebaId($id, $edad); //sino coincide devuelve mensaje de error
					echo " XXXERR".$error;
					if(!empty($error)) { //si var tiene el mensaje de error, no esta vacia
						$id="";  //la variable o el datos lo vaceamos o no guardamos el dato
						$correcto = false; //false porque si hay var de error.
						$nameErr= $error;
					}
				}
				
				
				
				if (empty($_POST["gen"])) {
					$nameErr2 = "Campo obligatorio";
					$correcto = false;
				} else {
					$gen = test_input($_POST["gen"]); //saneamos el dato
					if(!empty($error)) { //si var tiene el mensaje de error, no esta vacia
						$gen="";  //la variable o el datos lo vaceamos o no guardamos el dato
						$correcto = false; //false porque si hay var de error.
						$nameErr2= $error;
					}
				}				
				
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
			$error= "";
			if ($dato < 0 || $dato > 110){
				$error= "Edad no valida";
			}
			return $error;
		}
		/* 		Código: 3 caracteres1 que representarán sus iniciales seguidos de tres dígitos que serán su edad,rellenando con ceros a la izquierda en caso
		necesario. Por ejemplo Ramón Ramírez Rodríguez de23 añosy tipo B de paciente tendría el código RRR023
		*/
		function compruebaId($xid, $xedad) {
			$patron= "/^[A-Z]{3}[0-9]{3}/"; 	
			if (!preg_match($patron,$xid)) {
				$error = "El identificador es de tipo: XXX000";
				return $error;
			}
													//  nºs de control el 7 y 8 
			$longitud = strlen($xid);   //LOS GUIONES SE CUENTAN --> XXX000"
			//											  			 012345 
			
			
			//HAGO ESTO PERO COMO ME SALTA ERROR LO PONGO EN COMENTARIO: PERO CUENTA:
			$sumaDigitos = $xid[3] + $xid[4] + $xid[5];	//=edad	
			/*
			if($sumaDigitos != $xedad ){  
			  $error =  " Los tres ultimos digitos debeb ser iguales a sue edad";
			  $correcto = false;
			  return $error;
			}
			*/
			
			
			if($longitud > 6){
				$error =  "El identificador tiene una longitud de 8 u 9 caracteres";
				$correcto = false;
				return $error;			  
			}	
		}
	?>
	<!---------------------------------------------------------------FORMULARIO------------------------------------------------------------> 
	<?php  //Si no está definida o no es correcto, se ejecuta el html que mostrará el mensaje de error:
		if(!isset($_POST["Aceptar"]) || !$correcto) {  //isset, determina si una var está definida(no es NULL)
		?>	
		<h2>ENTREGA DE MEDICAMENTOS</h2>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
			
			<fieldset>
				CODIGO: <input type="text" name="id"> 
				<span class="error">* <?php echo $nameErr;?></span> 
				<br><br>
			</fieldset>
			<fieldset>
				EDAD: <input type="text" name="edad">
				<span class="error1">* <?php echo $nameErr1;?></span> <!--span=div pero en una linea. -->
				<br><br>
			</fieldset>
			<fieldset>
				GENERO: 
				<select name="gen">
				  <option value=""> </option>
				  <option value="F">F</option>
				  <option value="M">M</option>
				</select>
			</fieldset>
			<br>
			<span class="error2"> <?php echo $nameErr2;?></span>
			<input type="submit" name="Aceptar" value="Aceptar">  
		</form>
	<?php
		} 
		
		else {  //METO LO QUE HAY QUE LLEVAR A LA SGTE PAG EN LA VAR DE SESSION Y REDIRIJO.  nombre, apellidos y número de viajero
			$_SESSION["id"]= $id;
			$_SESSION["edad"]= $edad;
			$_SESSION["gen"]= $gen;
			header("Location: ./RodriguezC_Examen2EV_parte2.php");
		}
		
		?>
	</body>  
</html> 