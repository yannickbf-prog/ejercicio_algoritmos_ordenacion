<?php
$array_numeros_ordenados = [24, 31, 36, 80, 92, 110];
$numero_a_encontrar = 110;

$indice_bajo = 0;
$indice_alto = count($array_numeros_ordenados) - 1;

//Se calcula el elemento central del array
$elemento_central = (integer)(($indice_bajo + $indice_alto) / 2);

//Buscamos
$posicion_elemento = "No encontrado";
$seguir_buscando_numero =  true;
while($seguir_buscando_numero){
    if($array_numeros_ordenados[$elemento_central] == $numero_a_encontrar){
        $posicion_elemento = $elemento_central;
        $seguir_buscando_numero = false;
    }
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