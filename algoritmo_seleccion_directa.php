<?php

/**
 * Con este funcion ordenamos numeros mediante algoritmo de seleccion directa
 * @param $array_numeros Le pasamos un array con los numeros que queremos ordenar
 * @param $numero_busqueda_binaria Le pasaremos el numero que quiere buscar por busqueda binaria
 * @param $arrlength Tambien nos pasaran el lenght del array
 */
function ordenarConAlgoritmoSeleccionDirecta($array_numeros, $numero_busqueda_binaria, $arrlength ){
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

    //Guardamos en una variable el resultado del array passado a un string para mostrarlo
    $resultado = "El resultado ordenado mediante seleccion directa es: ";
    foreach ($array_numeros as $numero) {
        $resultado .= $numero." ";
    }

    //Usamos la funcion de busqueda binaria para buscar el numero
    $numero_busqueda_binaria = (integer)$numero_busqueda_binaria;

    //$resultado_busqueda_binaria = busquedaBinaria($array_numeros, $numero_busqueda_binaria);
    //echo $resultado_busqueda_binaria;

    //Retornamos el string con el texto y el resultado
    return $resultado;        
}

?>