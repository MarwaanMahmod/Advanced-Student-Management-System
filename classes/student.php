<?php
class Student
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create($name, $email, $phone, $address)
    {
        $stmt = $this->conn->prepare("INSERT INTO students (name, email, phone, address) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $address);
        return $stmt->execute();
    }

    public function getAll($search = "")
    {
        $search = "%$search%";
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE name LIKE ? OR id LIKE ?");
        $stmt->bind_param("ss", $search, $search);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function getById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function update($id, $name, $email, $phone, $address)
    {
        $stmt = $this->conn->prepare("UPDATE students SET name=?, email=?, phone=?, address=? WHERE id=?");
        $stmt->bind_param("ssssi", $name, $email, $phone, $address, $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
