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

    //Recuperamos los valores de los 2 menus con radio buttons y el numero a encontrar por busqueda binaria
    $valor_metodo_entrada = $_POST['metodo_entrada'];
    $valor_algoritmo_ordenacion = $_POST['algoritmo_ordenacion'];
    $numero_busqueda_binaria = $_POST['numero_busqueda_binaria'];

    //Hacemos include de las diferentes funciones
    include 'ordenar_con_algoritmo_ordenacion.php';
    include 'algoritmo_seleccion_directa.php';
    include 'algoritmo_intercambio.php';
    include 'busqueda_binaria.php';

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
            $resultado_final = ordenarConAlgoritmoOrdenacion($array_aleatorio, $valor_algoritmo_ordenacion, $numero_busqueda_binaria);
            break;
        case "entrada_teclado":
            //Guardaremos en un array los numeros que nos han pasado separados por espacios
            //Recuperamos el string con los numeros que nos han pasado
            $num_introducidos = $_POST['num_introducidos'];
            //Guardamos en una variable el array que generamos con explode() (nos genera un array con los elementos separados por un espacio)
            $array_num_introducidos = explode(" ", $num_introducidos);
            //Le pasamos el array y el tipo de algoritmo y nos devuelve el resultado
            $resultado_final = ordenarConAlgoritmoOrdenacion($array_num_introducidos, $valor_algoritmo_ordenacion, $numero_busqueda_binaria);
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
            $resultado_final = ordenarConAlgoritmoOrdenacion($array_numeros_xml, $valor_algoritmo_ordenacion, $numero_busqueda_binaria);
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
        <input type="number" name="numero_busqueda_binaria" placeholder="ej. 40"><br>
        <span>ALERTA! si no pones un numero que exista el programa no va a funcionar. Dara vueltas en un while. En el <a href="busqueda_binaria_prueba.php" target="_blank">script orginal</a> funciona, pero al pasarlo a funcion falla, no he llegado a averiguar porque.</span><br><br>
		<input type="submit" name="envio_form" value="Envia"><br><br>
	</form>
    <!-- Mostraremos los resultados en caso de existir, en caso contrario no mostraremos nada -->
    <section>
        <?php if($resultado_final != ""){echo "<span>".$resultado_final."</span>";} ?>
    </section>
</body>
</html>