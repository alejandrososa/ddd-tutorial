<?php
/**
 * Created by PhpStorm.
 * User: alejandro
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
     * @return array|string
     * @throws \Exception
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