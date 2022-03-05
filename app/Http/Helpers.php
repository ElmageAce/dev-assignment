<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

const ADMIN_ACCOUNT_FIELDS = [
    'name' => 'Admin',
    'username' => 'admin',
    'email' => 'admin@system.com',
];

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

if( !function_exists('slugger') )
{
    /**
     * @param string $text
     * @param string $suffix
     *
     * @return string
     */
    function slugger(string $text, string $suffix = ''): string
    {
        return Str::slug("{$text} {$suffix}");
    }
}
