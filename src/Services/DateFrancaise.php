<?php

namespace App\Services;

use IntlDateFormatter;


class DateFrancaise
{

    public function changerDate($date)
    {
        $fmt = new IntlDateFormatter("fr_FR", IntlDateFormatter::FULL, IntlDateFormatter::NONE);
        return $fmt->format($date);


    }

}