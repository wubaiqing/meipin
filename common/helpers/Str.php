<?php

class Str
{
    /**
     * Generate random string
     *
     * @param  integer $length
     * @return string
     */
    public static function random($length)
    {
        static $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $chars[rand(0, strlen($chars) - 1)];
        }

        return $string;
    }
}
