<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 12/02/18
 * Time: 13:09
 */

namespace SingleResponsability;


class FutballReferee implements Referee
{
    public function leadTeam()
    {
        return 'Run your plays!';
    }

    public function leadPractice()
    {
        return 'Run another ladder...';
    }
}