<?php

function seleccion_directa($array_numeros){
    //Contamos la longitud del array
    $arrlength = count($array_numeros);
    //Recorremos todo el array
    for($i = 0; $i < $arrlength; $i++){
        //Guardaremos el int del numero mas pequeño y la posicion. 
        //Cojemos el primer elemento para poder hacer la comparacion
        $numero_mas_pequeño = $array_numeros[$i];
        $posicion_mas_pequeño = $i;
        
        //En la primera iteracion comparamos el primer numero con el resto, si el numero con el que comparamos es mas pequeño guardamos su valor y su posicion como numero mas pequeño.
        //De manera que si encontraramos un numero mas pequeño que el que acabamos de guardar quedaria su valor y su posicion guardada como el numero mas pequeño y asi succesibamente hasta el final del bucle
        //De esta manera nos aseguramos de guardar el numero mas pequeño de todos los que estamos comparando.
        //En la segunda iteracion comparamos el segundo numero con el resto (de los que tiene deante) y nos quedamos con el mas pequeño de la misma forma que en la primera iteracion.
        //Asi suscesivamente hasta ordenar todos los numeros.
        $x = $i+1;
        for($x; $x < $arrlength; $x++) {
            if($array_numeros[$x] < $numero_mas_pequeño){
                $numero_mas_pequeño = $array_numeros[$x];
                $posicion_mas_pequeño = $x;
            }
        }

        //Una vez tenemos la posicion del numero mas pequeño lo intercambiamos (despues del ultimo numero mas pequeño que hemos añadido)
        
        //Guardamos el contenido de uno de los numeros a intercambiar en una variable auxiliar
        $numero_pequeño = $array_numeros[$posicion_mas_pequeño];

        //Hacemos el intercambio
        $array_numeros[$posicion_mas_pequeño] = $array_numeros[$i];
        $array_numeros[$i] = $numero_pequeño;
    }

    //Retornamos el array de numeros ordenados
    return $array_numeros;          
}

function intercambio($array_numeros){
    //Contamos la longitud del array
    $arrlength = count($array_numeros);
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
        
    //Retornamos el array de numeros ordenados
    return $array_numeros;
}

