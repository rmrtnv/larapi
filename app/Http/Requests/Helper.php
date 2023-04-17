<?php

namespace App\Http\Requests;

class Helper
{

    static function q(string $query, string $array_separator = '+', $item_separator = ':'):array
    {
        foreach(explode($array_separator, $query) as $item) {
            $_arr = explode($item_separator, $item);
            $arr[$_arr[0]] = $_arr[1];
        }
        return $arr;
    }
}
