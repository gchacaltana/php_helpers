<?php

declare( strict_types=1 );

/**
 * Función para generar imagen con nuevo tamaño.
 * 
 * @param string $sourceImage Ruta de ubicación de la imagen JPEG
 * @param string $targetImage ruta destino de la imagen JPEG
 * @param int $maxWidth Ancho máximo de la imagen final (value 0 - $maxWidth is optional)
 * @param int $maxHeight Altura máxima de la imagen final (value 0 - $maxHeight is optional)
 * @param int $quality Calidad de la imagen final (0-100)
 * @return bool
 */
function resizeImage(string $sourceImage, string $targetImage, int $maxWidth, int $maxHeight,
        int $quality = 80): bool {
    if (!$image = @imagecreatefromjpeg($sourceImage)) {
        return FALSE;
    }

    // Obtener dimensiones de la imagen
    list($origWidth, $origHeight) = getimagesize($sourceImage);

    if ($maxWidth == 0) {
        $maxWidth = $origWidth;
    }

    if ($maxHeight == 0) {
        $maxHeight = $origHeight;
    }

    // Calculando la proporción de tamaños máximos
    $widthRatio = $maxWidth / $origWidth;
    $heightRatio = $maxHeight / $origHeight;

    // Calculando nuevas dimensiones de la imagen
    $ratio = min($widthRatio, $heightRatio);
    $newWidth = (int) $origWidth * $ratio;
    $newHeight = (int) $origHeight * $ratio;

    // Creando imagen final con nuevas dimensiones
    $newImage = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight,
            $origWidth, $origHeight);
    imagejpeg($newImage, $targetImage, $quality);
    // Liberar memoria.
    imagedestroy($image);
    imagedestroy($newImage);
    return TRUE;
}

/**
 * Función que retorna el data uri de una imagen
 * @param string $image Ruta y nombre de imagen
 * @param string $mime Tipo MIME de la imagen
 */
function getImageDataUri(string $image, string $mime = ""): string {
    return 'data: ' . (function_exists('mime_content_type') ? mime_content_type($image) : $mime) . ';base64,' . base64_encode(file_get_contents($image));
}
