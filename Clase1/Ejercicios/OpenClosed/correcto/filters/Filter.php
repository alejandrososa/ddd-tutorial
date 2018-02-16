<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 12/02/18
 * Time: 13:07
 */

namespace OpenClosed\filters;


interface Filter
{
    /**
     * @param string $string
     * @return string
     */
    public function run($string);
}
