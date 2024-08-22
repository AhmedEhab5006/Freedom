<?php
// PostController.php

require_once('../Model/userDao.php');

// Create a ClientDao instance
$clientDao = new ClientDao();


class PostController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllPosts()
    {
        $result = [];

        $sql = "SELECT * FROM posts";
        $queryResult = $this->conn->query($sql);

        if ($queryResult->num_rows > 0) {
            while ($row = $queryResult->fetch_assoc()) {
                $result[] = $row;
            }
        }

        return $result;
    }
}
