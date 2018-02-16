<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 12/02/18
 * Time: 13:07
 */

namespace OpenClosed\filters;


class FooFilter implements Filter
{
    /**
     * Replaces bar with foo in string
     *
     * @param string $string
     * @return mixed
     */
    public function run($string)
    {
        return str_replace('foo', 'bar', $string);
    }
}