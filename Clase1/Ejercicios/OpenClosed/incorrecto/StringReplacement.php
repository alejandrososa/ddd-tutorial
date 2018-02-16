<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 22/01/18
 * Time: 18:10
 */

namespace OpenClosed;


class StringReplacement
{
    /**
     * Modifies strings
     *
     * @param $string
     * @return string
     */
    public function modify($string)
    {
        $string = str_replace('baz', 'amazing', $string);
        $string = str_replace('foo', 'bar', $string);
        return $string;
    }
}