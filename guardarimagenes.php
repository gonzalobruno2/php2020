<?php
/*
 * Realizar el programa que muestre un formulario web que permita el envío
 * de uno o dos fichero de imágenes que se guardarán un directorio llamado
 * imgusers no accesible por web.
 *
 * Crear el directorio y darle los permisos adecuados. El programa
 * mostrará el formulario (GET) o lo procesará (POST)
 *
 * El programa PHP debe controlar:
 *
 * El tamaño máximo de los ficheros no puede superar los 200 Kbytes cada uno
 * y entre los dos no mas de 300 Kbytes.
 * Se puede enviar uno o dos ficheros simultáneamente.
 * Los ficheros tienes que ser o JPG o PNG no se admiten otros formatos.
 * La aplicación NO debe permitir subir ficheros cuyo nombres ya exista
 * en el directorio de imágenes.
 *
 * Subir la URL con el proyecto subido a vuestra cuenta de GITHUB
 */
define('RUTA', '/home/gonzalo/Escritorio/imgusers');
define('TAMTOTAL', 300000);
define('TAMFICHERO', 200000);
define('ERROR_FORMATO', 5000);
define('ERROR_TAMFICHERO', 5001);
define('ERROR_TAMTOTAL', 5002);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $codigosErrorSubida = [
        0 => 'Subida correcta',
        1 => 'El tamaño del archivo excede el admitido por el servidor', // directiva upload_max_filesize en php.ini
        2 => 'El tamaño del archivo excede el admitido por el cliente', // directiva MAX_FILE_SIZE en el formulario HTML
        3 => 'El archivo no se pudo subir completamente',
        4 => 'No se seleccionó ningún archivo para ser subido',
        6 => 'No existe un directorio temporal donde subir el archivo',
        7 => 'No se pudo guardar el archivo en disco', // permisos
        8 => 'Una extensión PHP evito la subida del archivo', // extensión PHP
        ERROR_FORMATO => 'Formato de Imagen no admitido',
        ERROR_TAMFICHERO => 'El archivo supera el tamaño máximo permitido',
        ERROR_TAMTOTAL => 'El total de los archivos supera el máximo permitido '
    ];

    function almacenarImg($imagen, $coderror)
    {
        $nombre = $imagen['name'];

        $error = $imagen['error'];

        if ($error != 0) {
            $msg = "error numero: " . $coderror[$error];
        } else {
            if ($imagen['size'] > TAMFICHERO) {
                $msg = "Error: $nombre " . $coderror[ERROR_TAMFICHERO] . "<br><br>";
            } else {
                if ($imagen['type'] != "image/jpeg" && $imagen['type'] != "image/png") {
                    $msg = "Error: $nombre " . $coderror[ERROR_FORMATO] . "<br><br>";
                } else {
                    if (! file_exists(RUTA . '/' . $nombre)) {
                        move_uploaded_file($imagen['tmp_name'], RUTA . '/' . $nombre);
                        $msg = "archivo $nombre movido con exito<br><br>";
                    } else {
                        $msg = "Error. Ya existe el archivo $nombre<br><br>";
                    }
                }
            }
        }
        return $msg;
    }

    $img1 = almacenarImg($_FILES['imagen1'], $codigosErrorSubida);
    $img2 = almacenarImg($_FILES['imagen2'], $codigosErrorSubida);
    echo $img1;
    echo $img2;
} else {

    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Tarea Guardar Imágenes</title>
<style type="text/css">
input[type=number] {
	width: 100px;
}

body {
	text-align: center;
}
</style>
</head>
<body>
	<h1>GUARDAR IMÁGENES</h1>
	<form enctype="multipart/form-data"
		action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
		<input type="file" name="imagen1"> <br> <input type="file"
			name="imagen2"> <br>
		<br> <input type="submit" name="enviar" value="Subir imágenes">
	</form>



	<br>

</body>
</html>

<?php }?>
