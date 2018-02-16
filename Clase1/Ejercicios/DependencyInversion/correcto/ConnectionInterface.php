<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 12/02/18
 * Time: 12:58
 */

namespace DependencyInversion;


interface ConnectionInterface
{
    public function connect();
}