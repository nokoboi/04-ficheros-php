<?php
/**
 * Redimensiona una imagen manteniendo su proporción original.
 *
 * Esta función toma una imagen de origen, la redimensiona a un ancho específico
 * manteniendo su relación de aspecto, y guarda la imagen resultante en la ubicación
 * especificada. Soporta formatos JPEG, PNG y GIF.
 *
 * @param string $sourcePath  Ruta completa a la imagen de origen.
 * @param string $targetPath  Ruta completa donde se guardará la imagen redimensionada.
 * @param int    $targetWidth Ancho deseado para la imagen redimensionada en píxeles.
 *
 * @throws RuntimeException Si no se puede crear o procesar la imagen.
 *
 * @return void
 */
function redimensionarImagen($sourcePath, $targetPath, $targetWidth)
{

    list($width, $height, $type) = getimagesize($sourcePath);
    // $width = getimagesize($targetPath)[0];
    // $height = getimagesize($targetPath)[1];
    // $type =getimagesize($targetPath)[2];
    $ratio = $targetWidth / $width;
    $targetHeight = $height * $ratio;

    // esto crea la imagen
    $sourceImage = imagecreatefromstring(file_get_contents($sourcePath));
    $targetImage = imagecreatetruecolor($targetWidth, $targetHeight);

    imagecopyresampled($targetImage, $sourceImage, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

    switch ($type) {
        case IMAGETYPE_JPEG:
            imagejpeg($targetImage, $targetPath, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($targetImage, $targetPath, 9);
            break;
        case IMAGETYPE_GIF:
            imagegif($targetImage, $targetPath);
            break;
    }

    imagedestroy($sourceImage);
    imagedestroy($targetImage);

}