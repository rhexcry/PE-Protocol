<?php

namespace rhexcry\pe\protocol\utils;

class Utils
{

    /**
     * Returns a string that can be printed, replaces non-printable characters
     *
     * @param mixed $str
     */
    public static function printable($str) : string{
        if(!is_string($str)){
            return gettype($str);
        }

        return preg_replace('#([^\x20-\x7E])#', '.', $str);
    }

}