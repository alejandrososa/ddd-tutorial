<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 22/01/18
 * Time: 18:14
 */

namespace LiskovSubstitution;


class CodeFilter implements Filter
{
    /**
     * Runs a filter against the given array
     *
     * @param array $array
     * @return array
     */
    public function run(array $array)
    {
        if (empty($array)) throw new \Exception('empty array');

        foreach ($array as $value) {
            if ($value == 'bar') return 'yikes';
        }

        return $array;
    }
}