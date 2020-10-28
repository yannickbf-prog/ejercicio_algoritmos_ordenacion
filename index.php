<?php
/**
 * Ejercicio algoritmos de ordenacion
 * @author Yannick
 */

//Inicializamos variable en la que guardaremos el resultado final. Como podemos ver en la linea 178 si esta vacia no mostramos nada y si tiene algun contenido si lo mostramos
$resultado_final = "";

/**
 * Si se ha dado al boton "Envia" entraremos en este if, aqui dentro realizaremos todas las operaciones necesarias para mostrar el resultado
 */
if( isset($_POST['envio_form'])){

    //Recuperamos los valores de los 2 menus con radio buttons
    $valor_metodo_entrada = $_POST['metodo_entrada'];
    $valor_algoritmo_ordenacion = $_POST['algoritmo_ordenacion'];
    $numero_busqueda_binaria = $_POST['numero_busqueda_binaria'];

    include 'busqueda_binaria.php';

    /**
     * Definimos la funcion que vamos a utilizar para realizar la ordenacion. Ya sea mediante seleccion directa o intercambio
     * @param $array_numeros Le pasamos un array con los numeros que queremos ordenar
     * @param $algoritmo_ordenacion Le pasamos tambien que tipo de algoritmo de ordenacion vamos a utilizar
     * @return string Nos retornara un string con un texto indicando el tipo de algoritmo de ordenacion elegido seguido de los numeros ordenados
     */
    function ordenarConAlgoritmoOrdenacion($array_numeros, $algoritmo_ordenacion, $numero_busqueda_binaria){
        //Contamos la longitud del array
        $arrlength = count($array_numeros);
        //Si el usuario ha elegido ordenacion directa ordenaremos mediante este algoritmo
        if($algoritmo_ordenacion == "seleccion_directa"){
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
        
            $resultado_busqueda_binaria = busquedaBinaria($array_numeros, $numero_busqueda_binaria);
            echo $resultado_busqueda_binaria;

            //Retornamos el string con el texto y el resultado
            return $resultado;           
        }
        //Si el algoritmo de ordenacion solicitado es de intercambio nos dirije aqui
        else if($algoritmo_ordenacion == "intercambio"){
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
    }
    
    //Hacemos un switch y segun el tipo de metodo de entrada hacemos las operaciones para pasarle un array al metodo ordenarConAlgoritmoOrdenacion().
    //Al que tambien le pasaremos el tipo de algoritmo de ordenacion con el que queremos ordenar el array
    //Esta funcion nos retornara el resultado que pintaremos en el html
    switch($valor_metodo_entrada){
        case "matriz_predeterminada":
            //En este caso le pasaremos un array predeterminado directamente y guardaremos el resultado en la variable $resultado_final
            $resultado_final = ordenarConAlgoritmoOrdenacion(array(49, 24, 36, 80, 31), $valor_algoritmo_ordenacion, $numero_busqueda_binaria);
            break;
        case "generacion_aleatoria":
            //Guardaremos en un array tantos numeros aleatorios como hayan sido solicitados y se lo pasaremos a la funcion
            //Creamos arral vacio
            $array_aleatorio = array();
            //Recuperamos el numero de numeros aleatorios que nos han pasado por $_POST
            $numero_numeros_aleatorios = $_POST['numero_numeros_generados'];
            //Hacemos un bucle en el que se hara push al array con la cantidad de numeros aleatorios que nos hayan pedido
            for($i = 0; $i < $numero_numeros_aleatorios; $i++){
                array_push($array_aleatorio,rand(10, 99));
            }
            //Guardamos en la variable $resultado_final el resultado que nos devuelve la funcion despues de pasarle el array con los numeros y el tipo de algoritmo
            $resultado_final = ordenarConAlgoritmoOrdenacion($array_aleatorio, $valor_algoritmo_ordenacion);
            break;
        case "entrada_teclado":
            //Guardaremos en un array los numeros que nos han pasado separados por espacios
            //Recuperamos el string con los numeros que nos han pasado
            $num_introducidos = $_POST['num_introducidos'];
            //Guardamos en una variable el array que generamos con explode() (nos genera un array con los elementos separados por un espacio)
            $array_num_introducidos = explode(" ", $num_introducidos);
            //Le pasamos el array y el tipo de algoritmo y nos devuelve el resultado
            $resultado_final = ordenarConAlgoritmoOrdenacion($array_num_introducidos, $valor_algoritmo_ordenacion);
            break;
        case "entrada_fichero":
            //Cargaremos los numeros desde un fichero xml y los guardaremos en un array que le pasaremos a la funcion ordenarConAlgoritmoOrdenacion()
            //Cargamos el XML desde un archivo xml
            $xml = simplexml_load_file('xml/archivo.xml');
            //Contamos cuantos nodos numero tenemos
            $cuenta_numeros = $xml->numero->count();
            //Guardaremos los numeros en un array
            $array_numeros_xml = array();
            //Recorremos todos los nodos numero y hacemos push al array para rellenarlo con todos los numeros
            for($i = 0; $i < $cuenta_numeros ;$i++){
                //Guardamos en una variable el nodo en el que nos encontramos haciendole un casting a int
                $nodo_numero = (int)$xml->numero[$i];
                //Hacemos push del numero
                array_push($array_numeros_xml,$nodo_numero);
            }
            //Guardamos en la variable $resultado_final el resultado de pasarle el array junto al tipo de algoritmo seleccionado
            $resultado_final = ordenarConAlgoritmoOrdenacion($array_numeros_xml, $valor_algoritmo_ordenacion);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Algoritmos de ordenación</title>
</head>
<body>
    <!--Mostramos un form en el que nos pasaran la informacion necesaria por metodo POST a la misma pagina para calcular y pintar los resultados -->
    <form method="POST" action="index.php" class="formulario_ordenacion">
        <br><label>Metodo de entrada: </label><br>
		<input type="radio" id="matriz_predeterminada" name="metodo_entrada" value="matriz_predeterminada" checked>
		<label for="matriz_predeterminada">Matriz predeterminada 49, 24, 36, 80, 31 <label><br>
		<input type="radio" id="generacion_aleatoria" name="metodo_entrada" value="generacion_aleatoria">
		<label for="generacion_aleatoria">Generacion aleatoria</label>
        <input type="number" name="numero_numeros_generados" value="5"><br>
        <input type="radio" id="entrada_teclado" name="metodo_entrada" value="entrada_teclado">
		<label for="entrada_teclado">Entrada por teclado</label>
        <input type="text" name="num_introducidos" placeholder="ej. 40 14 17 25"><br>
        <input type="radio" id="entrada_fichero" name="metodo_entrada" value="entrada_fichero">
        <label for="entrada_fichero">Entrada por fichero (xml)</label>
        <br>
        <br>
        <label>Algoritmo de ordenacion: </label><br>
        <input type="radio" id="seleccion_directa" name="algoritmo_ordenacion" value="seleccion_directa" checked>
		<label for="seleccion_directa">Selección directa</label><br>
        <input type="radio" id="intercambio" name="algoritmo_ordenacion" value="intercambio">
        <label for="intercambio">Intercambio</label><br><br>
        <label>Busqueda binaria: </label><br>
        <input type="number" name="numero_busqueda_binaria" placeholder="ej. 40"><br><br>
		<input type="submit" name="envio_form" value="Envia"><br><br>
	</form>
    <!-- Mostraremos los resultados en caso de existir, en caso contrario no mostraremos nada -->
    <section>
        <?php if($resultado_final != ""){echo "<span>".$resultado_final."</span>";} ?>
    </section>
</body>
</html>