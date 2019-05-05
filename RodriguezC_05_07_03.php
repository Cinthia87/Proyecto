<!DOCTYPE html>
<html lang="es-ES">
<head>
	<meta charset="utf-8">
</head>
<body>
<!--7.3. Crea un formulario para registrar usuarios. Los campos que llevará serán nick de
usuario, nombre, apellidos, teléfono y provincia de residencia. El nick debe estar
compuesto por letras y números, pero empieza por letra, y tener una longitud de
entre cuatro y diez caracteres. El nombre y los apellidos deben ir en minúsculas
con la primera letra en mayúsculas y solo contendrán letras, incluyendo tildes, ñ y
diéresis. El teléfono tendrá un formato correcto y la provincia debe existir. Usa el
campo de formulario adecuado para cada caso, convierte los datos que se puedan
al formato adecuado y en caso de no poderse informa al usuario de qué campos no
cumplen con las normas.-->
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {//esto es: si se ha enviado osea post o get entonces haz... :
		if (empty($_POST["name"])) {
			$nameErr = "Campo obligatorio";
		} else if (!empty($nameErr)){ //si nameErr no está vacío, guarda el valor de name para que user no vuelva a escribir el campo
			$name="";
		} 
		
		/*podemos poner required en el html para no tener q hacerlo en php
		*/
		//strpos lo hace para mayus y minus
		
		
		/*
		//No todos los campos son obligatorios si están todos cargados:
		if (!(is_null($name))){  //isset — Determina si una variable está definida y no es NULL
			$name = test_input($_POST["name"]);
			//$nameErr=compruebanombre($name); //LO DE SERGIO.para que no se borre 
		}
		*/
	}
	
	//El nick debe estar compuesto por letras y números, pero empieza por letra, y
	//tener una longitud de entre cuatro y diez caracteres.
	//substr("devuelve parte de cadena", desde, hasta)
	//strpos($frase, $sebusca)- Encuentra la posición de la 1era letra que aparece en un string;
	
	$nick = $_POST["nick"];
	function valido_alfanumerico($dato){
		$permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$long= strlen($dato);
		for ($i=0; $i< $long; $i++){
			if (strpos($permitidos, substr($dato,$i,1))===false){
				return false;	//echo $dato." - No válido!! solo valores alfanumericos"."<br>";
				break;
			} else {
				return true;
			}
		}
	}
	$nickOk= valido_alfanumerico($nick);  //devueltre true o 1
	
	$long_nick= strlen($nick); //longitud de variable
	$min= 4;
	$max=10;
	if($nickOk == true){
		//$primera= substr($dato,0,1);
		if($nick[0] == "a-Z"){
			if ($long_nick > 4 && $long_nick < 10){
				echo "Nick valido: ". $nick;
			} else {
				echo "El nick debe tener entre 4 y 10 caracteres";
				//$nameErr = "El nick debe tener entre 4 y 10 caracteres";
			}
		} else {
			$nameErr = "El nick debe empezar por una letra";
		}
	} else {
		$nameErr = "Solo se admiten letras y números";
	}
	
		//if(is_numeric(nick[0])){
		//	valido= false;
		//}
	
	
	//LO DE SERGIO.
	//if(!empty($nameErr)){ //si esta bien estará vacio y si está bien se mantiene
	//	$name="";
	//}
	/*LO DE SERGIO:
	function comrpuebanombre( ){
		$transporte= test_input($_POST["trans"]);
		if (isset($tra[$arg])) { 
			echo "transporte seleccionado: ".$tvalores;
		}		
	}
	*/	
	
	function test_input($data) {
		$data = trim($data);  //ELIMINA ESPACIOS ANTE Y DESPUES DE LOS DATOS
		$data = stripslashes($data); //ELIMINA BARRAS \
		$data = htmlspecialchars($data);  //Traduce caracteres especiales en entidades HTML
		return $data;
	}
	
	
	
	
	
	
	echo "<h2>Tus datos:</h2>";
	echo $nick;
	echo "</br>";
	//echo $nombre;
	echo "</br>";
	//echo $ape;
	echo "</br>";
	echo "</br>";
	//echo $tel;
?>
</body>
</html> 