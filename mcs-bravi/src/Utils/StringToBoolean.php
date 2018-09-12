<?php
/**
 * Created by Marcelo
 */

namespace Mcs\Bravi\Utils;


class StringToBoolean
{
    public static function convert($string)
    {

        if (is_bool($string)) {
            return $string;
        }

        if (empty($string)) {
            return false;
        }

        if (is_string($string) || is_numeric($string)) {
            $string = strtoupper($string);

            $validosTrue = ['TRUE', 'SIM', 'S', 'YES', 'Y', '1'];

            return in_array($string, $validosTrue);
        }

        return false;
    }

}
