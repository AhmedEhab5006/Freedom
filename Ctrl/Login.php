<?php
require_once('../Model/userDao.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Create a ClientDao instance
    $userDao = new ClientDao();

    // Attempt to login
    $result = $userDao->loginUser($username, $password);

    if ($result['success']) {
        // Login successful, redirect to the home page or any other desired page
        header('Location: ../View/index.php');
    } else {
        // Login failed, redirect to the login page with an error message
        header('Location: ../View/login.php?error=' . urlencode($result['error']));
    }
}
