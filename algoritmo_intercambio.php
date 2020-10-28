<?php

function ordenarConAlgoritmoIntercambio($array_numeros, $algoritmo_ordenacion, $numero_busqueda_binaria, $arrlength ){
    //Recorremos todos los numeros menos el ultimo 
    //(no nos hace falta por que se compara un numero con todos los de delante, el ultimo numero no tiene ninguno delante)
    for($i = 0; $i < $arrlength-1; $i++){
        $j = $i+1;
        //Comparamos el numero $i en el que nos encontramos en el anterior for con todos los que tiene delante
        //En caso de que encontremos un numero menor que $i lo intercambiamos
        //Cuando se llega al final del bucle $i es el numero mas pequeño
        for($j; $j < $arrlength; $j++){
            if($array_numeros[$i] > $array_numeros[$j]){
                $var_aux = $array_numeros[$i];
                $array_numeros[$i] = $array_numeros[$j];
                $array_numeros[$j] = $var_aux;
            }
        }
    }
    //Guardamos en una variable el resultado del array passado a un string para mostrarlo
    $resultado = "El resultado ordenado mediante intercambio es: ";
    foreach ($array_numeros as $numero) {
        $resultado .= $numero." ";
    }
    //Retornamos el string con el texto y el resultado
    return $resultado;
}

?>