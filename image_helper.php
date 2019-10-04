<?php

/**
 * Resize image - Generar imagen con nuevo tamaño.
 * @param string $sourceImage Ruta de ubicación de la imagen JPEG
 * @param string $targetImage ruta destino de la imagen JPEG
 * @param int $maxWidth Ancho máximo de la imagen final (value 0 - $maxWidth is optional)
 * @param int $maxHeight Altura máxima de la imagen final (value 0 - $maxHeight is optional)
 * @param int $quality Calidad de la imagen final (0-100)
 * @return bool
 */
function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight,
                     $quality = 80)
{
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
    $widthRatio  = $maxWidth / $origWidth;
    $heightRatio = $maxHeight / $origHeight;

    // Calculando nuevas dimensiones de la imagen
    $ratio     = min($widthRatio, $heightRatio);
    $newWidth  = (int) $origWidth * $ratio;
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
