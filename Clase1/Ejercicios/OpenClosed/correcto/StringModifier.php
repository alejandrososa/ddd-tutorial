<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 12/02/18
 * Time: 13:05
 */

namespace OpenClosed;


use OpenClosed\filters\Filter;

class StringModifier
{
    /**
     * Modifies strings using Filters
     *
     * @param string $string
     * @param Filter[] $filters
     * @return string
     */
    public function modify($string, array $filters)
    {
        foreach ($filters as $filter) {
            $string = $filter->run($string);
        }
        return $string;
    }
}