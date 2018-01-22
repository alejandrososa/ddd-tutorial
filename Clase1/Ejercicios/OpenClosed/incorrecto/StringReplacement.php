<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 22/01/18
 * Time: 18:10
 */

namespace OpenClosed;


class StringReplacement
{
    /**
     * Replace strings using Filters
     *
     * @param string $string
     * @param Filter[] $filters
     * @return string
     */
    public function modify($string)
    {
        $string = str_replace('baz', 'amazing', $string);
        $string = str_replace('foo', 'bar', $string);
        return $string;
    }
}