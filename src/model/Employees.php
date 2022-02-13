<?php

class Employees
{
    private $conn;

    public function __construct($dbConnection)
    {
        if ($dbConnection instanceof mysqli) {
            $this->conn = $dbConnection;
        } else {
            throw new Exception('Connection injected should be of Mysqli object');
        }
    }

    public function select($where = '')
    {
        if($where != '' ){
            $where = 'where ' . $where; 
        }
        $query = "SELECT * FROM employees " . $where;
        $result = mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
        $emplyees = [];
        while($emplyee = mysqli_fetch_object($result))
        {
            $emplyees[] = $emplyee;
        }
        return $emplyees;
    }

    public function create($params = [])
    {
        try {
            if (empty($params)) {
                return false;
            }
            $name = trim($params['name']) ? "'" .$params['name'] ."'" : "null";
            $description = trim($params['description']) ? "'" .$params['description'] ."'" : "null";
            $gender = (int) $params['gender'] ?? 0;
            $salary = (int) $params['salary'] ?? 0;
            $birthday = trim($params['birthday']) ? "'" .$params['birthday'] ."'" : "null";
            $query = "INSERT INTO employees (
                name,
                description,
                gender,
                salary,
                birthday) VALUES (
                    " . $name . ",
                    " . $description . ",
                    " . $gender . ",
                    " . $salary . ",
                    " . $birthday . ")";
            mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function update($params = [])
    {
        try {
            if (empty($params) || empty($params['id'])) {
                return false;
            }
            $name = trim($params['name']) ? "'" .$params['name'] ."'" : "null";
            $description = trim($params['description']) ? "'" .$params['description'] ."'" : "null";
            $gender = (int) $params['gender'] ?? 0;
            $salary = (int) $params['salary'] ?? 0;
            $birthday = trim($params['birthday']) ? "'" .$params['birthday'] ."'" : "null";
            $query = "UPDATE employees SET name = " . $name . ",
                    description = " . $description . ",
                    gender = " . $gender . ",
                    salary = " . $salary . ",
                    birthday = " . $birthday . "
                    WHERE id = " . $params['id'];
            mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete($id)
    {
        try {
            if (empty($id)) {
                return false;
            }
            $query = "DELETE FROM employees WHERE id =" . $id;
            mysqli_query($this->conn, $query) or die(mysqli_error($this->conn));
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}