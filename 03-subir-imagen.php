<?php
require 'helperImages.php';
require 'redimensionarImagen.php';

// Para capar el tamaño maximo y el numero de archivos hay que ir a php.ini en la carpeta de php
// post_max_size=40M para el tamaño upload_max_filesize=40M que se pueden subir max_file_uploads=20 numero maximo de archivo que se pueden subir
// configuracion
define('MAX_FILE_SIZE', 1 * 1024 * 1024); //1MB
define('TARGET_WIDTH', 300);
define('UPLOAD_DIR', 'uploads/');


// Si entramos en este if es porque hemos entrado en el formulario de abajo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['imagen'])) {
    $file = $_FILES['imagen'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die("Error al subir el archivo");
    }
    if ($file['size'] > MAX_FILE_SIZE) {
        die('El archivo es demasiado grande. Máximo 1MB permitido.');
    }
    if (!esImagen2( $file['name'])) {
        die('El archivo no es una imagen válida.');
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $nombreArchivo = 'image_' . date('YmdHis') . '.' . $extension;
    $rutaDestino = UPLOAD_DIR . $nombreArchivo;

    if (!is_dir(UPLOAD_DIR)) {
        mkdir(UPLOAD_DIR, 0755, true);
    }

    redimensionarImagen($file['tmp_name'], $rutaDestino, TARGET_WIDTH);
    echo 'Imagen procesada con exito';

} else {
    echo '
    <h1>Subir archivos</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="imagen" accept="image/*" required>
        <input type="submit" value="Subir imagen">
    </form>
';

}

