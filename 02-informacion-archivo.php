<?php
function mostrarInfoArchivo($ruta){
    if(!file_exists($ruta)){
        /// no existe el archivo
        return "El archivo no existe";
    }

    $info = [];
    // Información básica del archivo
    $info['nombre'] = basename($ruta);
    $info['ruta'] = realpath($ruta);
    $info['tamanio'] = filesize($ruta) . 'bytes';
    $info['tipo_mime'] = mime_content_type($ruta);

    // fechas
    $info['fecha_ultimo_acceso'] = date("Y-m-d H:i:s", fileatime($ruta));
    $info['fecha_ultimo_modificacion'] = date("Y-m-d H:i:s", filemtime($ruta));
    $info['fecha_creacion'] = date("Y-m-d H:i:s", filectime($ruta));

    // Permisos
    $permisos = fileperms($ruta);
    $info['permisos'] = $permisos;
    $info['permisos_filtrados'] = substr(sprintf('%o', $permisos), -4);

    // Hash - encripta en md5
    $info['md5'] = md5_file($ruta);
    $info['sha1'] = sha1_file($ruta);

    // Si es una imagen 
    if(exif_imagetype($ruta)){
        $imageInfo = getimagesize($ruta);
        $info['dimensiones'] = $imageInfo[0] . ' X ' . $imageInfo[1] . ' Y pixeles';
        $info['tipo'] = $imageInfo['mime'];
    }

    return $info;
}

$rutaArchivo = 'imagenes/loki.gif';
$informacion = mostrarInfoArchivo($rutaArchivo);

echo '<h2>Información del archivo</h2>' . $rutaArchivo;
echo '<ul>';

foreach ($informacion as $key => $value) {
    echo "<li>$key : $value</li>";
}

echo '</ul>';