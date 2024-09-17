<?php
// Comprobar si un archivo es una imagen
// function esImagen($directorio,$ruta){
//     $rutaCompleta = $directorio . $ruta;
//     $tipoMime = mime_content_type($rutaCompleta);
//     echo $tipoMime;
//     return strpos($tipoMime,'image/') === 0;
// }

/**
 * Comprueba si un archivo es de tipo imagen
 * Los tipos válidos son: 'jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'
 * @param string $rutaCompleta $rutacompleta es la ruta completa del archivo a analizar
 * @return bool false = si no es una imagen o true =  si es una imagen válida
 */
function esImagen2($rutaCompleta){
    
    // Obtener la extensión del archivo
    $extension = strtolower(pathinfo($rutaCompleta, PATHINFO_EXTENSION));
    
    // Definir una lista de extensiones de imágenes válidas
    $tiposImagen = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'];
    
    // Comprobar si la extensión está en la lista de tipos de imagen
    return in_array($extension, $tiposImagen);
}