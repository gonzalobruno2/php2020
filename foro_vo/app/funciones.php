<?php


function usuarioOk($usuario, $contraseña): bool {
    
    $credenciales= ['pepe' => '1234',
                    'luis' => '4321',
                    'jose' => '0000',];
 
    if (!empty($usuario) && array_search($contraseña, $credenciales) == $usuario)
       
        {return true;}
    else 
        {return false;}
    
}

function evitaInyeccion($comentario): string {

    $comentarioLimpio = strip_tags($comentario);
    return $comentarioLimpio;
}


$quitaEspacio='';

function contarLetras($longitud): int {
    
    global $quitaEspacio;
    $comentarioLimpio=evitaInyeccion($longitud);
    $eliminaVacio = preg_replace("/\s+/"," ", $comentarioLimpio);
    $convierteArray= explode(" ",$eliminaVacio);
    $quitaEspacio=implode($convierteArray);

    return strlen($quitaEspacio);
   

}

function contarPalabras($longitud): int {
    
    $comentarioLimpio=evitaInyeccion($longitud);
    return str_word_count($comentarioLimpio, 0 );
    
}

function letraRepetida($longitud){ 
    
    global $quitaEspacio;
   
    $letras =  str_split($quitaEspacio);
    $letraMayor = array_count_values($letras); // cuenta y ordena de mayor a menor los valores del array
    arsort($letraMayor);
    return array_key_first($letraMayor);

    
}

function palabraRepetida($longitud): string {
    
    $comentarioLimpio=evitaInyeccion($longitud);
    $cuentaPalabras = str_word_count($comentarioLimpio, 1 );
    
    $palabras = array_count_values($cuentaPalabras); // cuenta y ordena de mayor a menor los valores del array
    arsort($palabras);
    return array_key_first($palabras);

    
}

