<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 23/01/18
 * Time: 17:20
 */

namespace InterfaceSegregation;


interface Basketball
{
    /**
     * Try to score by shooting the ball while on offense
     *
     * @return void
     */
    public function shoot();

    /**
     * Block a shot by the offense
     *
     * @return void
     */
    public function block();

    /**
     * Echos out some string of profanities
     *
     * @return void there is no return when you play for Bobby Knight
     */
    public function yellAtPlayersLikeBobbyKnight();
}