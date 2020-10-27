<?php

$array_numeros_ordenados = [24, 31, 36, 80, 92, 110];
$numero_a_encontrar = 24;

//Definimos los primeros indices con los que hara el calculo para buscar el central como el primer elemento y el ultimo
$indice_bajo = 0;
$indice_alto = count($array_numeros_ordenados) - 1;

//Se calcula el elemento central del array
$elemento_central = (integer)(($indice_bajo + $indice_alto) / 2);

//Definimos las variables para el funcionamiento de la busqueda
$posicion_elemento = "No encontrado";
$seguir_buscando_numero =  true;
$numero_encontrado = false;

//Hacemos un bucle while en el que buscaremos el numero
while($seguir_buscando_numero){
    //Si el elemento central que hemos calculado es el numero guardamos la posicion y paramos el bucle
    if($array_numeros_ordenados[$elemento_central] == $numero_a_encontrar){
        $posicion_elemento = $elemento_central;
        $seguir_buscando_numero = false;
        $numero_encontrado = true;
    }
    //Si el $indice_bajo y el $indice_alto son el mismo numero  y no hemos encontrado el numero buscado
    //Paramos el while ya que el numero buscado no existe en el array
    else if(($indice_bajo == $indice_alto) && ($numero_encontrado == false)){
        $seguir_buscando_numero = false;
    }
    //Si el elemento_central no es el numero que buscavamos miramos si este elemento central es mas grande o mas pequeño que el que buscamos
    //Segun si es mas grande o mas pequeño buscaremos en la seccion anterior o en la siguiente
    //De esta manera iremos buscando por segmentos hasta encontrar el numero
    else{
        if($numero_a_encontrar > $array_numeros_ordenados[$elemento_central]){
            $indice_bajo = $elemento_central + 1;
            $elemento_central = (integer)(($indice_bajo + $indice_alto) / 2);
        }
        else{
            $indice_alto = $elemento_central - 1;
            $elemento_central = (integer)(($indice_bajo + $indice_alto) / 2);
        }
    }
}

echo $posicion_elemento;

?>