<?php
include_once("wordix.php");

/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/
/*Valenzuela, Jazmin María. FAI-4322. Tecnicatura Universitaria en Desarrollo Web. jazmin.valenzuela@est.fi.uncoma.edu.ar . Usuario Github: jazminValenzuela 
/*Torres, Nicolás Iván. FAI-4215. Tecnicatura Universitaria en Desarrollo Web. nicolas.torres@est.fi.uncoma.edu.ar. Usuario Github: NicoTorress*/
/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/

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

/* ... COMPLETAR ... */



/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:

//$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partidas

//echo"ingrese un num:";
//$num = trim(fgets(STDIN));

//echo mostrarPartida($num);
$coleccionPalabra = cargarColeccionPalabras();
echo agregarPalabra($coleccionPalabra, "AUTOS");
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
