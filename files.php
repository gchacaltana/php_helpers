<?php
/**
 * Devuelve unidad de medida según la cantidad de bytes.
 * @param int $bytes número de bytes de un fichero. Ejem: 307200
 * @return string Ejem: 300KB
 */
function getFileSizeByBytes(int $bytes): string
{
    $bytesGB = 1073741824;
    $bytesMB = 1048576;
    $bytesKB = 1024;
    if ($bytes >= $bytesGB) {
        $bytes = number_format($bytes / $bytesGB, 2).' GB';
    } elseif ($bytes >= $bytesMB) {
        $bytes = number_format($bytes / $bytesMB, 2).' MB';
    } elseif ($bytes >= $bytesKB) {
        $bytes = number_format($bytes / $bytesKB, 2).' KB';
    } elseif ($bytes > 1) {
        $bytes = $bytes.' bytes';
    } elseif ($bytes == 1) {
        $bytes = $bytes.' byte';
    } else {
        $bytes = '0 bytes';
    }
    return $bytes;
}
