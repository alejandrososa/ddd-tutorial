<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 12/02/18
 * Time: 13:09
 */

namespace SingleResponsability;


class FutballPlayer implements Player
{
    public function play()
    {
        return 'Kick the ball';
    }

    public function practice()
    {
        return 'Run fast behind the ball';
    }
}