<?php
// Comprobar si un archivo es una imagen
// function esImagen($directorio,$ruta){
//     $rutaCompleta = $directorio . $ruta;
//     $tipoMime = mime_content_type($rutaCompleta);
//     echo $tipoMime;
//     return strpos($tipoMime,'image/') === 0;
// }

function esImagen2($directorio,$ruta){
    // Construir la ruta completa del archivo
    $rutaCompleta = $directorio . $ruta;
    
    // Obtener la extensión del archivo
    $extension = strtolower(pathinfo($rutaCompleta, PATHINFO_EXTENSION));
    
    // Definir una lista de extensiones de imágenes válidas
    $tiposImagen = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'webp'];
    
    // Comprobar si la extensión está en la lista de tipos de imagen
    return in_array($extension, $tiposImagen);
}