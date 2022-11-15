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

/** MENU DE OPCIONES pto(3)
 * @return int
 */
function seleccionarOpcion(){
    //int $eleccion

    echo "\n--------------MENÚ DE OPCIONES-------------\n" ;
    echo "1.JUGAR AL WORDIX CON UNA PALABRA ELEGIDA \n";
    echo "2.JUGAR AL WORDIX CON UNA PALABRA ALEATORIA \n";
    echo "3.MOSTRAR UNA PARTIDA \n";
    echo "4.MOSTRAR LA PRIMER PARTIDA GANADORA \n";
    echo "5.MOSTRAR RESUMEN DE JUGADOR \n";
    echo "6.MOSTRAR LISTADO DE PARTIDAS ORDENADAS POR JUGADOR Y POR PALABRA \n";
    echo "7.AGREGAR UNA PALABRA DE 5 LETRAS A WORDIX \n";
    echo "8.SALIR \n";
    echo "Ingrese su opción: ";
    $eleccion = solicitarNumeroEntre(1, 8);
    
    return $eleccion;
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
 * Ingresa un numero de partida y retorna resumen de la misma 
 * @param INT $nroPartida
 * @param ARRAY $coleccionPartidas
 */
function informePartida($coleccionPartidas, $nroPartida) {
	echo "\n************************************\n";
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

/** AGREGA Y RETORNA UNA NUEVA PALABRA A LA COLECCION DE PALABRAS pto(7)
 * @param array $coleccionPalabra
 * @param string $nuevaPalabra
 * @return array
 */
function agregarPalabra($coleccionPalabra, $nuevaPalabra){
    //
    $coleccionPalabra[]= $nuevaPalabra;
    echo "\n". json_encode($coleccionPalabra). "\n";
    echo "\nSe ha agregado la palabra ". $nuevaPalabra. " para poder jugar con ella.\n";
}


/** 
 * Solicita al usuario el nombre de jugador. Verifica que el mismo comience con una letra, caso contrario se solicita modificar el mismo. Convierte todas las letras a minusculas.
*@return STRING
*/
function solicitarJugador() {
	// STRING $nombre
	do {
		echo "Ingrese nombre de jugador: ";
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

/**
 * Verifica si el jugador ya jugo con una palabra wordix
 * @param ARRAY $coleccionPartidas
 * @param ARRAY $coleccionPalabras
 * @param INT $indicePalabra
 * @param STRING $nombreJugador
 * @return BOOLEAN
 */

function validarPalabraJugador($coleccionPartidas, $coleccionPalabras, $indicePalabra, $nombreJugador) {
    // INT $i, $n BOOLEAN $yaJugo
    $i=0;
    $n=count($coleccionPartidas)-1;
    $yaJugo= false;
    while ($i<$n && !$yaJugo) {
        if ($coleccionPartidas[$i]["palabraWordix"]==$coleccionPalabras[$indicePalabra]) {
            if ($coleccionPartidas[$i]["jugador"]==$nombreJugador) {
                $yaJugo= true;
            }
        }
        $i++;
    }
    return $yaJugo;
}


/********************************************************/
/****************** PROGRAMA PRINCIPAL ******************/
/********************************************************/

//Declaración de variables:
/* BOOLEAN $jugo
 * STRING $nombreJugador
 * INT $indicePalabra, $opcion
 * ARRAY $coleccionPalabras, $coleccionPartidas
*/

//Inicialización de variables:

$coleccionPalabras= cargarColeccionPalabras();
$coleccionPartidas= cargarPartidas();


//Proceso:

do {
    $opcion= seleccionarOpcion();

    
    switch ($opcion) {
        case 1: 
            $nombreJugador= solicitarJugador();

            do{
                echo "Ingrese el numero de palabra Wordix con el que desea jugar: ";
                $indicePalabra= solicitarNumeroEntre(0, count($coleccionPalabras)-1);
                
                $haJugado=validarPalabraJugador($coleccionPartidas, $coleccionPalabras, $indicePalabra, $nombreJugador);
                if ($haJugado) {
                    echo "Ya jugaste con esa palabra, por favor elije otra palabra\n";
                }
                else {
                    echo "vamos a jugar\n";
                }
            } while($haJugado);
            
            $coleccionPartidas[]= jugarWordix($coleccionPalabras[$indicePalabra], $nombreJugador);


            break;



        case 2: 
            $nombreJugador= solicitarJugador();
            
            do {
                $indicePalabra= array_rand($coleccionPalabras, 1);
                $haJugado=validarPalabraJugador($coleccionPartidas, $coleccionPalabras, $indicePalabra, $nombreJugador);
                if ($haJugado) {
                    echo "Ya jugaste con esa palabra, por favor elije otra palabra\n";
                }
                else {
                    echo "vamos a jugar\n";
                }
            } while ($haJugado);

            $coleccionPartidas[]= jugarWordix($coleccionPalabras[$indicePalabra], $nombreJugador);
            
            break;



        case 3: 
            echo "Ingrese el numero de partida que desea revisar: ";
            $nroPartida= solicitarNumeroEntre(0, count($coleccionPartidas)-1);
            informePartida($coleccionPartidas, $nroPartida);

            break;
        

        
        case 4:
            $nombreJugador= solicitarJugador();
            $indicePartidaGanada= primeraGanadaJugador($coleccionPartidas, $nombreJugador);
            if ($indicePartidaGanada==-1) {
                echo "\nEl jugador no tiene una partida registrada.\n";
            } 
            else {
                informePartida($coleccionPartidas, $indicePartidaGanada);
            }
            break;
        

        case 5:
            $nombreJugador= solicitarJugador();
            estadisticasJugador($coleccionPartidas, $nombreJugador);
            break;


        case 6:

            break;


        case 7:
            // Aqui se le solicita al usuario una nueva palabra de 5 letras que posteriormente podra usarse para jugar.
            $palabraNueva= leerPalabra5Letras();
            agregarPalabra($coleccionPalabras, $palabraNueva);
            
            break;

            
    }
} while ($opcion != 8);
