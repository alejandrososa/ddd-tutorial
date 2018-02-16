<?php
/**
 * Created by PhpStorm.
 * User: Alejandro Sosa <alesjohnson@hotmail.com>
 * Date: 22/01/18
 * Time: 18:21
 */

namespace DependencyInversion;


class PasswordReminder
{
    /**
     * @var MySqlConnection
     */
    protected $dbConnection;

    public function __construct()
    {
        $this->dbConnection = new MySqlConnection();
    }
}