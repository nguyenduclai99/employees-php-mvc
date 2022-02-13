<?php

class DbConnectionManager
{

    private $connectionParam = [
        'host' => '',
        'port' => '',
        'user' => '',
        'password' => '',
        'dbname' => ''
    ];

    /**
     * @var mysqli
     */
    private $db;


    public function __construct($appConfig = null)
    {
        $this->connectionParam = $appConfig['connection']['params'];
        $this->db = $this->connect();

        if (\mysqli_connect_errno()) {
            \printf("Connect failed: %s\n", \mysqli_connect_error());
            if (\strpos(\mysqli_connect_error(), "Unknown database") !== NULL) {
                $this->install();
            }
            $this->db = $this->connect();
        }

        if (\mysqli_connect_errno()) {
            throw new \Exception(\sprintf("Connect failed: %s\n", \mysqli_connect_error()));
        }
    }


    private function connect()
    {
        $this->db = new \mysqli(
            $this->connectionParam['host'],
            $this->connectionParam['user'],
            $this->connectionParam['password'],
            $this->connectionParam['dbname']
        );
        return $this->db;
    }

    public function getConnection()
    {
        return $this->db;
    }


}