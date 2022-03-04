<?php

use Illuminate\Support\Carbon;

if( !function_exists('carbon_parse') )
{
    /**
     * @param string $date
     *
     * @return Carbon
     */
    function carbon_parse(string $date): Carbon
    {
        return Carbon::parse($date);
    }
}
