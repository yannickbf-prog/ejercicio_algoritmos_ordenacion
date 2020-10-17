<?php
if( isset($_POST['envio_form'])){
    //Recuperamos los valores de los 2 menus con radio buttons
    $valor_metodo_entrada = $_POST['metodo_entrada'];
    $valor_algoritmo_ordenacion = $_POST['algoritmo_ordenacion'];

    //Definimos la funcion que vamos a utilizar para realizar la ordenacion
    function ordenarConAlgoritmoOrdenacion($array_numeros, $algoritmo_ordenacion){
        //Si el usuario ha elegido ordenacion directa ordenaremos mediante este algoritmo
        if($algoritmo_ordenacion == "seleccion_directa"){
            //Contamos la longitud del array
            $arrlength = count($array_numeros);
            //Guardaremos en una variable el numero mas pequeño de cada iteracion del bucle for.
            
            for($i = 0; $i < $arrlength; $i++){
                //Cojemos el primer elemento para poder hacer la comparacion
                $numero_mas_pequeño = $array_numeros[$i];
                
                $x = $i+1;
                for($x; $x < $arrlength; $x++) {
                    if($array_numeros[$x] < $numero_mas_pequeño){
                        $numero_mas_pequeño = $array_numeros[$x];
                    }
                }
                //Una vez tenemos el numero mas pequeño lo buscamos en el array y cuando lo encontramos intercambiamos posiciones (despues del ultimo numero mas pequeño que hemos añadido con el que acabamos de encontrar)
                $seguir_buscando_numero =  true;
                $y = 0;
                
                while($seguir_buscando_numero){
                    if($array_numeros[$y] == $numero_mas_pequeño){

                        //Guardamos uno de los numeros a intercambiar en una variable auxiliar
                        $numero_pequeño = $array_numeros[$y];

                        //Hacemos el intercambio
                        $array_numeros[$y] = $array_numeros[$i];
                        $array_numeros[$i] = $numero_pequeño;

                        $seguir_buscando_numero = false;
                    }
                    $y++;
                }
            }

            //Guardamos en una variable el resultado del array passado a un string para mostrarlo
            $resultado = "El resultado ordenado mediante ordenacion directa es: ";
            foreach ($array_numeros as $numero) {
                $resultado .= $numero." ";
            }
            return $resultado;           
        }
    }
    
    //Hacemos un switch y segun el tipo de metodo de entrada hacemos las operaciones para pasarle un array al metodo ordenarConAlgoritmoOrdenacion().
    //Al que tambien le pasaremos el tipo de algoritmo de ordenacion con el que queremos ordenar el array
    switch($valor_metodo_entrada){
        case "matriz_predeterminada":
            $resultado_final = ordenarConAlgoritmoOrdenacion(array(49, 24, 36, 80, 31), $valor_algoritmo_ordenacion);
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
    <form method="POST" action="index.php" class="formulario_ordenacion">
        <br><label>Metodo de entrada: </label><br>
		<input type="radio" id="matriz_predeterminada" name="metodo_entrada" value="matriz_predeterminada" checked>
		<label for="matriz_predeterminada">Matriz predeterminada 49, 24, 36, 80, 31 <label><br>
		<input type="radio" id="generacion_aleatoria" name="metodo_entrada" value="generacion_aleatoria">
		<label for="generacion_aleatoria">Generacion aleatoria</label><br>
        <input type="radio" id="entrada_teclado" name="metodo_entrada" value="entrada_teclado">
		<label for="entrada_teclado">Entrada por teclado</label><br>
        <input type="radio" id="entrada_fichero" name="metodo_entrada" value="entrada_fichero">
		<label for="entrada_fichero">Entrada por fichero</label><br>
        <br>
        <label>Algoritmo de ordenacion: </label><br>
        <input type="radio" id="seleccion_directa" name="algoritmo_ordenacion" value="seleccion_directa" checked>
		<label for="seleccion_directa">Selección directa</label><br><br>
		<input type="submit" name="envio_form" value="Envia">
	</form>
</body>
</html>