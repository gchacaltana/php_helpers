<?php

/**
 * Devuelve la fecha del primer dia del mes de una fecha especifica
 * @param string $date Fecha. Ejem: 2018-03-28
 * @return string Ejem: 2018-03-01
 */
function getFirstDayOfDate($date)
{
    $d = new DateTime($date);
    $d->modify('first day of this month');
    return $d->format('Y-m-d');
}
