<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 22/01/18
 * Time: 18:17
 */

namespace InterfaceSegregation;


interface Defense
{
    /**
     * Block a shot by the offense
     *
     * @return bool
     */
    public function block();
}