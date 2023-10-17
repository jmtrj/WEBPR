<?php
class CRUD
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function create($table, $data)
    {
        $columns = implode('`, `', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO `$table` (`$columns`) VALUES ($values)";

        $stmt = $this->conn->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function read($table, $condition = '', $params = array())
    {
        $sql = "SELECT * FROM $table";

        if (!empty($condition)) {
            $sql .= " WHERE $condition";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($table, $data, $condition, $params = array())
    {
        $columns = '';
        foreach ($data as $key => $value) {
            $columns .= "`$key`=:$key, "; // Wrap column names in backticks
        }
        $columns = rtrim($columns, ', ');

        $sql = "UPDATE $table SET $columns WHERE $condition";

        $stmt = $this->conn->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        return $stmt->execute();
    }


    public function delete($table, $condition, $params = array())
    {
        $sql = "DELETE FROM `$table` WHERE $condition";

        $stmt = $this->conn->prepare($sql);

        foreach ($params as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}


$crud = new CRUD($conn);

?>