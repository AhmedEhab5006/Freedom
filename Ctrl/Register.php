<?php

require_once('../Model/user.php');
require_once('../Model/userDao.php');

class RegistrationController
{
    public function registerUser($username, $fname, $lname, $phone, $email, $password)
    {
        // Validate input (add more validation if needed)

        // Create a User object
        $user = new Client();
        $user->setUsername($username);
        $user->setFname($fname);
        $user->setLname($lname);
        $user->setPhone($phone);
        $user->setEmail($email);
        $user->setPassword($password);

        // Create a UserDao instance
        $userDao = new ClientDao();

        // Save the user to the database
        $result = $userDao->saveUser($user);

        if ($result['success']) {
            // Registration successful
            header('Location: ../View/pending.php');
        } else {
            // Registration failed, display error message
            header('Location: ../View/register.php?error=' . urlencode($result['error']));
        }
        
    }




    public function loginUser($username, $password)
    {
        // Create a UserDao instance
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
}
