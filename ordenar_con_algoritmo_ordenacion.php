<?php 
/**
* Definimos la funcion que vamos a utilizar para realizar la ordenacion. Ya sea mediante seleccion directa o intercambio
* Segun lo que elijamos (seleccion directa o intercambio) nos mandara a la funcion correspondiente para ordenarlo
* Dentro de estas funciones tambien lo usaremos para buscar el numero que nos envien por busqueda binaria
* @param $array_numeros Le pasamos un array con los numeros que queremos ordenar
* @param $algoritmo_ordenacion Le pasamos tambien que tipo de algoritmo de ordenacion vamos a utilizar
* @param $numero_busqueda_binaria Le pasaremos el numero que quiere buscar por busqueda binaria
* @return string Nos retornara un string con un texto indicando el tipo de algoritmo de ordenacion elegido seguido de los numeros ordenados
*/
function ordenarConAlgoritmoOrdenacion($array_numeros, $algoritmo_ordenacion, $numero_busqueda_binaria){
    //Contamos la longitud del array
    $arrlength = count($array_numeros);
    //Si el usuario ha elegido ordenacion directa ordenaremos mediante este algoritmo
    if($algoritmo_ordenacion == "seleccion_directa"){
        return ordenarConAlgoritmoSeleccionDirecta($array_numeros, $algoritmo_ordenacion, $numero_busqueda_binaria, $arrlength );
    }
    //Si el algoritmo de ordenacion solicitado es de intercambio nos dirije aqui
    else if($algoritmo_ordenacion == "intercambio"){
        return ordenarConAlgoritmoIntercambio($array_numeros, $algoritmo_ordenacion, $numero_busqueda_binaria, $arrlength );
    }
}
?>