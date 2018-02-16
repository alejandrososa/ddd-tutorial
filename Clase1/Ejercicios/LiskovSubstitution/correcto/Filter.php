<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 22/01/18
 * Time: 18:14
 */

namespace LiskovSubstitution;


interface Filter
{
    /**
     * Runs a filter against the given array.
     * If the input array is empty, it should return an empty array.
     *
     * @param array $array
     * @return array
     */
    public function run(array $array);
}