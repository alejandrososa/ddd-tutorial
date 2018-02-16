<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 22/01/18
 * Time: 18:16
 */

namespace InterfaceSegregation;


class BasketballPlayer implements Offense, Defense
{
    /**
     * Block a shot by the offense
     *
     * @return bool
     */
    public function block()
    {
        return $this->randomBool();
    }

    /**
     * Try to score by shooting the ball while on offense
     *
     * @return bool
     */
    public function shoot()
    {
        return $this->randomBool();
    }

    protected function randomBool()
    {
        return (bool)rand(0, 1);
    }
}
