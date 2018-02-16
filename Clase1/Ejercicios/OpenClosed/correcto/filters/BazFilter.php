<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 12/02/18
 * Time: 13:06
 */

namespace OpenClosed\filters;


class BazFilter implements Filter
{
    /**
     * Replaces baz with amazing in string
     *
     * @param string $string
     * @return string
     */
    public function run($string)
    {
        return str_replace('baz', 'amazing', $string);
    }
}