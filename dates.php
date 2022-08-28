<?php

declare( strict_types=1 );

/**
 * Devuelve la fecha del primer dia del mes de una fecha especifica
 * @param string $date Fecha. Ejem: 2018-03-28
 * @return string Ejem: 2018-03-01
 */
function getFirstDayOfDate(string $date): string {
    $d = new DateTime($date);
    $d->modify('first day of this month');
    return $d->format('Y-m-d');
}

/**
 * Devuelve la fecha del ultimo dia del mes de una fecha especifica
 * @param string $date Fecha. Ejem: 2018-03-14
 * @return string Ejem: 2018-03-31
 */
function getLastDayOfDate(string $date): string {
    $d = new DateTime($date);
    $d->modify('last day of this month');
    return $d->format('Y-m-d');
}