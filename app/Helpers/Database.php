<?php

namespace App\Helpers;

use mysqli;

class Database
{
    /**
     * @var mysqli
     */
    protected $connection = null;

    /**
     * Construct a database object with optional db connection parameters
     *
     * @param null $host
     * @param null $user
     * @param null $password
     * @param null $schema
     */
    public function __construct($host = null, $user = null, $password = null, $schema = null)
    {
        if ($host && $user && $password !== null && $schema)
            $this->connect($host, $user, $password, $schema);
    }

    /**
     * Disconnect the connection
     */
    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * Disconnects if connection exists
     */
    public function disconnect()
    {
        if ($this->connection)
        {
            $this->connection->close();

            $this->connection = null;
        }
    }

    /**
     * Connects to a database
     *
     * @param $host
     * @param $user
     * @param $password
     * @param $schema
     */
    public function connect($host, $user, $password, $schema)
    {
        $this->disconnect();

        $this->connection = mysqli_connect($host, $user, $password, $schema);
    }

    /**
     * Manually set the connection
     *
     * @param mysqli $connection
     */
    public function setConnection(mysqli $connection)
    {
        $this->disconnect();

        $this->connection = $connection;
    }

    /**
     * Gets the current connection
     *
     * @return mysqli | null
     */
    public function getConnection()
    {
        return $this->connection;
    }

    public function insert($table, array $values)
    {
        $keys = implode(',', array_keys($values));

        $vals = '';

        foreach ($values as $value)
            $vals .= $value === null ? 'null,' : "'{$value}',";

        $vals = substr($vals, 0, strlen($vals) - 1);

        $query = "
          INSERT INTO {$table}
          ({$keys})
          VALUES
          ({$vals})
        ";

        $this->connection->query($query);

    }
}