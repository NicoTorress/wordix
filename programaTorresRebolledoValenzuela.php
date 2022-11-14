<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/*Valenzuela, Jazmin María. FAI-4322. Tecnicatura Universitaria en Desarrollo Web. jazmin.valenzuela@est.fi.uncoma.edu.ar . Usuario Github: jazminValenzuela 
/*Torres, Nicolás Iván. FAI-4215. Tecnicatura Universitaria en Desarrollo Web. nicolas.torres@est.fi.uncoma.edu.ar. Usuario Github: NicoTorress*/
/*Rebolledo, Sergio Emiliano. FAI-4055. Tecnicatura Universitaria en Desarrollo Web. sergio.rebolledo@est.fi.uncoma.edu.ar. Usuario Github: sergrebo /*


/********************************************************/
/****************** DEFINIR FUNCIONES ******************/
/********************************************************/

/**
 * Obtiene una colección de palabras pto(1)
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "PERRO", "GORRA", "PLATO", "MANGO", "CASCO"
    ];

    return ($coleccionPalabras);
}

/** 
 * Entran un numero entero minimo y uno maximo. Solicita al usuario un numero ingresado por teclado. Si el numero ingresado no es entero o no se encuentra entre minimo y maximo, solicita otro numero hasta cumplir con las condiciones. Retorna el numero ingresado.
 *@param INT $min
 *@param INT $max
 *@return INT
 */
function solicitarNumeroEntre($min, $max)
{
    //int $numero
    $numero = trim(fgets(STDIN));
    while (!is_int($numero) && !($numero >= $min && $numero <= $max)) {
        echo "Debe ingresar un número entre " . $min . " y " . $max . ": ";
        $numero = trim(fgets(STDIN));
    }
    return $numero;
}

/** 
 * Obtiene una coleccion de partidas
 * @return ARRAY
 */
function cargarPartidas()
{
    $coleccionPartidas[0]=["palabraWordix"=>"MUJER", "jugador"=>"neon", "intentos"=>5, "puntaje"=>11];
    $coleccionPartidas[1]=["palabraWordix"=>"TINTO", "jugador"=>"exart", "intentos"=>3, "puntaje"=>15];
    $coleccionPartidas[2]=["palabraWordix"=>"MELON", "jugador"=>"elkenku", "intentos"=>4, "puntaje"=>12];
    $coleccionPartidas[3]=["palabraWordix"=>"HUEVO", "jugador"=>"planero", "intentos"=>0, "puntaje"=>0];
    $coleccionPartidas[4]=["palabraWordix"=>"GATOS", "jugador"=>"Planero", "intentos"=>3, "puntaje"=>14];
    $coleccionPartidas[5]=["palabraWordix"=>"QUESO", "jugador"=>"neon", "intentos"=>6, "puntaje"=>10];
    $coleccionPartidas[6]=["palabraWordix"=>"AYUDA", "jugador"=>"cuernomocho", "intentos"=>3, "puntaje"=>12];
    $coleccionPartidas[7]=["palabraWordix"=>"CREMA", "jugador"=>"v", "intentos"=>1, "puntaje"=>15];
    $coleccionPartidas[8]=["palabraWordix"=>"DUNAS", "jugador"=>"majo", "intentos"=>0, "puntaje"=>0];
    $coleccionPartidas[9]=["palabraWordix"=>"CASAS", "jugador"=>"rudolf", "intentos"=>3, "puntaje"=>14];
    return ($coleccionPartidas);
}

/** 
 * Recibe una cadena de caracteres como entrada. Evalua si la misma esta formada solo por letras.
 *@param STRING $cadena
 *@return BOOLEAN
 */
function esPalabra($cadena)
{
    //int $cantCaracteres, $i, boolean $esLetra
    $cantCaracteres = strlen($cadena);
    $esLetra = true;
    $i = 0;
    while ($esLetra && $i < $cantCaracteres) {
        $esLetra =  ctype_alpha($cadena[$i]);
        /* La funcion integrada a PHP ctype_alpha verifica que los caracteres del string ingresado sean alfabeticos, mayusculas o minusculas. Dado su argumento, ($cadena[$i]), analizara a la cadena como un arreglo formado por las letras de la cadena mencionada, letra a letra gracias al contador de la instruccion while */
        $i++;
    }
    return $esLetra;
}

/** 
 * Solicita se ingrese una palabra de 5 letras, convierte sus letras en mayusculas, verifica su longitud y que este formada solo por letras. En caso que no se cumpla su longitud o conformacion solo en caracteres alfabeticos, se solicita ingrese otra palabra. Confirmadas las condiciones, retorna la palabra.
 *@return STRING
 */
function leerPalabra5Letras()
{
    //string $palabra
    echo "Ingrese una palabra de 5 letras: ";
    $palabra = trim(fgets(STDIN));
    $palabra  = strtoupper($palabra);

    while ((strlen($palabra) != 5) || !esPalabra($palabra)) {
        echo "Debe ingresar una palabra de 5 letras:";
        $palabra = strtoupper(trim(fgets(STDIN)));
    }
    return $palabra;
}

/** 
 * Ingresa un numero de partida y retorna resumen de la misma 
 *@param INT $nroPartida
 */
function informePartida($nroPartida) {
    $coleccionPartidas= cargarPartidas();
	echo "************************************\n";
    echo "Partida WORDIX ". $nroPartida. ": palabra ". $coleccionPartidas[$nroPartida]["palabraWordix"]. "\n";
    echo "Jugador: ". $coleccionPartidas[$nroPartida]["jugador"]. "\n";
	echo "Puntaje: ". $coleccionPartidas[$nroPartida]["puntaje"]. "\n";
    if ($coleccionPartidas[$nroPartida]["intentos"]>0) {
        echo "Intento: Adivinó la palabra en ". $coleccionPartidas[$nroPartida]["intentos"]. " intentos\n";
    }
    else {
        echo "Intento: No adivinó la palabra\n";
    }
	echo "************************************\n";
}

/** 
 * Solicita al usuario el nombre de jugador. Verifica que el mismo comience con una letra, caso contrario se solicita modificar el mismo. Convierte todas las letras a minusculas.
*@return STRING
*/
function solicitarJugador() {
	// STRING $nombre
	do {
		echo "ingrese nombre de jugador ";
		$nombre= trim(fgets(STDIN));
		if (!ctype_alpha($nombre[0])) {
			echo "El primer carácter debe ser una letra. Por favor, ingrese otro nombre.\n";
		}
	} while (!ctype_alpha($nombre[0]));
	$nombre= strtolower($nombre);
	return $nombre;
}

/**
 * Dada una colección de partidas y el nombre de un jugador, retorna el indice de la primera partida ganada por dicho jugador. Si el jugador no ganó ninguna partida, la función retorna -1.
 *@param ARRAY $coleccionPartidas
 *@param STRING $nombreJugador
 *@return INT
 */
function primeraGanadaJugador($coleccionPartidas, $nombreJugador) {
	//INT $primerPartidaGanada, $n, $i
    
	$n=count($coleccionPartidas);
	$i=0;
	$primerPartidaGanada= -1;
	while ($i<$n && $primerPartidaGanada==-1) {
		if ($coleccionPartidas[$i]["jugador"]==$nombreJugador) {
			if ($coleccionPartidas[$i]["puntaje"]>0) {
				$primerPartidaGanada=$i;
			}
		}
		$i=$i+1;
	}
	return $primerPartidaGanada;
}

/**
 * Una función que dada la colección de partidas y el nombre de un jugador, retorne las estadisticas del mismo.
 *@param ARRAY $coleccionPartidas
 *@param STRING $nombreJugador
 *@return INT
 */
function estadisticasJugador($coleccionPartidas, $nombreJugador) {
	//INT $n, $i, $cantPartidas, $puntaje, $cantVictorias, $intento1, $intento2, $intento3, $intento4, $intento5, $intento6

	$intento1=0;
	$intento2=0;
	$intento3=0;
	$intento4=0;
	$intento5=0;
	$intento6=0;
	$cantPartidas=0;
	$puntaje=0;
	$cantVictorias=0;
	$n=count($coleccionPartidas);
	for ($i=0; $i<$n; $i++) {
		if ($coleccionPartidas[$i]["jugador"]==$nombreJugador) {
			$cantPartidas= $cantPartidas+1;
			$puntaje= $puntaje+ $coleccionPartidas[$i]["puntaje"];
			if ($coleccionPartidas[$i]["puntaje"]>0) {
				$cantVictorias= $cantVictorias+1;
			}
			if ($coleccionPartidas[$i]["intentos"]==1) {
				$intento1= $intento1+1;
			}
			elseif ($coleccionPartidas[$i]["intentos"]==2) {
				$intento2= $intento2+1;
			}
			elseif ($coleccionPartidas[$i]["intentos"]==3) {
				$intento3= $intento3+1;
			}
			elseif ($coleccionPartidas[$i]["intentos"]==4) {
				$intento4= $intento4+1;
			}
			elseif ($coleccionPartidas[$i]["intentos"]==5) {
				$intento5= $intento5+1;
			}
			elseif ($coleccionPartidas[$i]["intentos"]==6) {
				$intento6= $intento6+1;
			}
		}
	}

echo "************************************\n
Jugador: ". $nombreJugador. "\n
Partidas: ". $cantPartidas. "\n
Puntaje Total: ". $puntaje. "\n
Victorias: ". $cantVictorias. "\n
Porcentaje Victorias: ". ($cantVictorias*100/$cantPartidas). "%\n
Adivinadas:\n
    Intento 1: ". $intento1. "\n
    Intento 2: ". $intento2. "\n
    Intento 3: ". $intento3. "\n
    Intento 4: ". $intento4. "\n
    Intento 5: ". $intento5. "\n
    Intento 6: ". $intento6. "\n
************************************\n";
}


/********************************************************/
/****************** PROGRAMA PRINCIPAL ******************/
/********************************************************/

//Declaración de variables:

$coleccionPalabras= [];
$coleccionDePartidas= [];


//Inicialización de variables:

$coleccionPalabras= cargarColeccionPalabras();
$coleccionPartidas= cargarPartidas();


//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partidas

//echo"ingrese un num:";
//$num = trim(fgets(STDIN));

//echo mostrarPartida($num);
////////////$coleccionPalabra = cargarColeccionPalabras();
////////////echo agregarPalabra($coleccionPalabra, "AUTOS");
$coleccionDePartidas= cargarPartidas();
echo primerPartidaGanada($coleccionDePartidas, "Nico");
/*
do {
    $opcion = ...;
    $opcion = seleccionarOpcion();
    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
