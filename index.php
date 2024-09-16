<?php
require 'helperImages.php';
/**
 * Mostrar una lista de los archivos que hay en el directorio
 */

//  Directorio que queremos escanear
$directorio = 'imagenes/';

// Función para mostrar las imágenes
function mostrarImagen($directorio, $imagen){
    echo "<img src='$directorio$imagen' alt='imagen de prueba' width='200px'>";
}

// Comprobamos si el directorio existe
if(is_dir($directorio)){
    // el directorio existe
    // abrimos el directorio
    if($dh = opendir($directorio)){
        echo "<h1>Archivos de imagen en el directorio $directorio</h1>";
        echo "<ul>";

        // Leemos cada entrada del directorio
        while(($archivo = readdir($dh)) !== false){
            if($archivo != "." && $archivo != ".."){
                if(esImagen2($directorio, $archivo)){
                    echo "<li>";
                    echo $archivo;
                    mostrarImagen($directorio,$archivo);
                    echo "</li>";
                }else{
                    echo 'Imagen no soportada';
                }
            }            
        }

        echo "</ul>";
    }
}else{
    // el directorio no existe
    echo "El directorio $directorio no existe";
}
