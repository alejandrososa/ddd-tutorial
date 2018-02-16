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
     * @var ConnectionInterface
     */
    protected $dbConnection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->dbConnection = $connection;
    }

    public function connect()
    {
        $this->dbConnection->connect();
    }
}

$mysql = new MySqlConnection();
$postgres = new PostgresConnection();
$passReminder = new PasswordReminder($postgres);
$passReminder->connect();