<?php

// Include the Client class
require_once '../Model/userDao.php';

// Include the database connection
require_once 'DB.php';
$db = new Database();
$conn = $db->getConnection();
// Create a new instance of the Client class with the database connection
$client = new Client($conn);

// Example: Get user information by user ID (replace 1 with the actual user ID)
$userId = 2;
$userInfo = $client->getUserInfo($client);

if ($userInfo !== false) {
    echo "Username: " . $userInfo['username'] . "<br>";
    echo "Email: " . $userInfo['email'] . "<br>";
    echo "Phone Number: " . $userInfo['phone_number'] . "<br>";
    echo "First Name: " . $userInfo['first_name'] . "<br>";
    echo "Last Name: " . $userInfo['last_name'] . "<br>";
    echo "Role: " . $userInfo['role'] . "<br>";
} else {
    echo "User not found or an error occurred.";
}
