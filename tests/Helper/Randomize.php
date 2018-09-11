<?php
/**
 * Created by PhpStorm.
 * User: Akar
 * Date: 09.09.2018
 * Time: 22:44
 */

namespace App\Tests\Helper;


class Randomize
{
    public static function string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))-1];
        }
        return $randstring;
    }

    public static function email() {
        return self::string() . '@gmail.ru';
    }

    public static function number($min = 1, $max = 100) {
		return rand($min, $max);
	}
}