<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 22/01/18
 * Time: 18:16
 */

namespace InterfaceSegregation;


class BasketballPlayer implements Basketball
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

    /**
     * Echos out some string of profanities
     *
     * @return string
     */
    public function yellAtPlayersLikeBobbyKnight()
    {
        return 'This has been censored because of inappropriate content';
    }
}
