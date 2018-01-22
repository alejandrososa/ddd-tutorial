<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 22/01/18
 * Time: 18:05
 */

namespace SingleResponsability;


class FutballPlayerAndReferee implements Player, Referee
{
    public function leadTeam()
    {
        return 'Score or you will be running ladders';
    }

    public function leadPractice()
    {
        return 'Run ladders';
    }

    public function play()
    {
        return 'I am going to score points';
    }

    public function practice()
    {
        return 'Running ladders';
    }
}