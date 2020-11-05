<?php
/**
 * Ejercicio algoritmos de ordenacion
 * @author Yannick
 */

//Inicializamos variable en la que guardaremos el resultado final (array de numeros ordenados). Como podemos ver en la linea 145 si esta vacia no mostramos nada y si tiene algun contenido si lo mostramos
$resultado_final = array();

/**
 * Si se ha dado al boton "Envia" de la seccion de ordenacion entraremos en este if, aqui dentro realizaremos todas las operaciones necesarias para mostrar el resultado de ordenar por seleccion directa o intercambio
 */
if( isset($_POST['envio_form'])){

    //Recuperamos los valores de los 2 menus con radio buttons
    $metodo_entrada = $_POST['metodo_entrada'];
    $algoritmo = $_POST['algoritmo_ordenacion'];

    //Hacemos include de las funciones para ordenar
    include 'ordenar.php';

    //Hacemos un switch y segun el tipo de metodo de entrada hacemos las operaciones para pasarle un array al metodo correspondiente.
    switch($metodo_entrada){
        case "matriz_predeterminada":
            //En este caso le pasaremos un array predeterminado directamente y guardaremos el resultado en la variable $resultado_final
            $resultado_final = $algoritmo(array(49, 24, 36, 80, 31));
            break;
        case "generacion_aleatoria":
            //Guardaremos en un array tantos numeros aleatorios como hayan sido solicitados y se lo pasaremos a la funcion
            //Creamos array vacio
            $array_aleatorio = array();
            //Recuperamos el numero de numeros aleatorios que nos han pasado por $_POST
            $numero_numeros_aleatorios = $_POST['numero_numeros_generados'];
            //Hacemos un bucle en el que se hara push al array con la cantidad de numeros aleatorios que nos hayan pedido
            for($i = 0; $i < $numero_numeros_aleatorios; $i++){
                array_push($array_aleatorio,rand(10, 99));
            }
            //Guardamos en la variable $resultado_final
            $resultado_final = $algoritmo($array_aleatorio);
            break;
        case "entrada_teclado":
            //Guardaremos en un array los numeros que nos han pasado separados por espacios
            //Recuperamos el string con los numeros que nos han pasado
            $num_introducidos = $_POST['num_introducidos'];
            //Guardamos en una variable el array que generamos con explode() (nos genera un array con los elementos separados por un espacio)
            $array_num_introducidos = explode(" ", $num_introducidos);
            //Le pasamos el array y el tipo de algoritmo y nos devuelve el resultado
            $resultado_final = $algoritmo($array_num_introducidos);
            break;
        case "entrada_fichero":
            //Cargaremos los numeros desde un fichero xml y los guardaremos en un array que le pasaremos a la funcion correspondiente
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
            $resultado_final = $algoritmo($array_numeros_xml);
            break;
    }
}
/**
 * Si se ha dado al boton envia de la seccion busqueda binaria entraremos aqui. Aqui realizaremos las operaciones para encontrar un numero en un array ordenado mediante busqueda binaria
 */
if( isset($_POST['envio_form_binaria'])){
    //Recojemos los datos
    $numeros_ordenados = $_POST['numeros_ordenados'];
    $numero_encontrar = $_POST['numero_encontrar'];

    //Pasamos los numeros ordenados a array
    $numeros_ordenados_array = explode(" ", $numeros_ordenados);

    //Incluimos la funcion que realiza la busqueda binaria
    include 'busqueda_binaria.php';

    //Utilizamos la funcion para busqueda bianria que nos devuelve el numero de indice del array del numero a encontrar en caso de encontrarlo, en caso contrario devuelve -1 
    $resultado_busqueda = busquedaBinaria($numeros_ordenados_array, $numero_encontrar);

    //Guardamos resultado en formato html y lo mostramos en el html
    $resultado_binaria = "<span>";
    if($resultado_busqueda == -1){
        $resultado_binaria .= "El numero ".$numero_encontrar." no ha sido encontrado en la lista de numeros ".$numeros_ordenados."</span>";
    }
    else{
        $resultado_binaria .= "El numero ".$numero_encontrar." ha sido encontrado en el indice del array ".$resultado_busqueda." de los siguientes numeros ".$numeros_ordenados."</span>";
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
        <h1>Algoritmos de ordenacion</h1>
        <br><label>Metodo de entrada: </label><br>
		<input type="radio" id="matriz_predeterminada" name="metodo_entrada" value="matriz_predeterminada" checked>
		<label for="matriz_predeterminada">Matriz predeterminada<label><br>
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
		<input type="submit" name="envio_form" value="Envia"><br><br>
    </form>
    <form method="POST" action="index.php" class="formulario_busqueda_binaria">
        <h1>Busqueda binaria</h1>
        <label>Escribe numeros ordenados separados por espacios:</label>
        <input type="text" name="numeros_ordenados"><br>
        <label>Escribe el numero que quieres encontrar: </label>
        <input type="text" name="numero_encontrar"><br><br>
        <input type="submit" name="envio_form_binaria" value="Envia"><br><br>
    </form>
    <!-- Mostraremos los resultados en caso de existir, en caso contrario no mostraremos nada -->
    <section>
        <h2>Resultado</h2>
        <?php 
        //Si el array de numeros ordenados no esta vacio (es decir, si es la primera vez que se carga la pagina) mostraremos su contenido formateado con html
        if(!empty($resultado_final))
        {
            echo "<span>Numeros ordenados: ";
            
            foreach ($resultado_final as $numero) {
                echo $numero." ";
            }

            echo "</span>";
        }
        //Comprovamos que exista $resultado_binaria, si hemos enviado formulario de busqueda binaria deveria de existir
        //En caso que exista mostramos el resultado en formato html que hemos creado mas arriba
        if(isset($resultado_binaria)) echo $resultado_binaria; 
        ?>
    </section>
</body>
</html>