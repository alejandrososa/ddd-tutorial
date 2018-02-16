<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 22/01/18
 * Time: 18:18
 */

namespace InterfaceSegregation;


interface Offense
{
    /**
     * Try to score by shooting the ball while on offense
     *
     * @return bool
     */
    public function shoot();
}