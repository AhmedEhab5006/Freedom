<?php
session_start();
require_once('user.php');
require_once('../Ctrl/DB.php');

class ClientDao
{
    private $conn;

    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function saveUser(Client $user)
    {
        $username = $user->getUsername();
        $fname = $user->getFName();
        $lname = $user->getLname();
        $phone = $user->getPhone();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $approve = $user->getApp();

        try {
            // Prepare and execute the SQL statement
            $stmt = $this->conn->prepare("INSERT INTO usesr (username, firstname, lastname, phonenumber, email, password, role) VALUES (?, ?, ?, ?, ?, ?, 'client')");
            $stmt->bind_param("ssssss", $username, $fname, $lname, $phone, $email, $password);

            // Execute the statement
            $result = $stmt->execute();

            // Close the statement
            $stmt->close();

            if ($result) {
                $_SESSION["username"] = $username;
                return ['success' => true]; // Return success indicator
            } else {
                return ['success' => false, 'error' => 'Database error: Unable to save user.']; // Return error message
            }
        } catch (Exception $e) {
            return ['success' => false, 'error' => 'Exception: ' . $e->getMessage()]; // Return exception message
        }
    }


    public function getUserInfo(Client $user)
    {
        $userId = $user->getId();
        try {
            $stmt = $this->conn->prepare("SELECT * FROM usesr WHERE id = ?");
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                return $result->fetch_assoc();
            } else {
                return false; // User not found
            }
        } catch (Exception $e) {
            return false; // Error occurred
        }
    }


    public function oldLoginUser(Client $user)
    {
        $username = $user->getUsername();
        $password = $user->getPassword();

        $query = "SELECT * FROM user WHERE name = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();

        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            $user->setEmail($userData['email']);
            return true; // Login successful
        } else {
            return false; // Login failed
        }
    }

    public function loginUser($username, $password)
    {
        try {
            // Prepare and execute the SQL statement
            $stmt = $this->conn->prepare("SELECT * FROM usesr WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            // Check if user exists
            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verify the password (compare plain text)
                if ($password === $user['password']) {
                    // Password is correct, start the session
                    session_start();

                    // Store user details in the session
                    $_SESSION['user'] = $user;

                    // Close the statement
                    $stmt->close();

                    return ['success' => true]; // Login successful
                } else {
                    // Incorrect password
                    return ['success' => false, 'error' => 'Incorrect password'];
                }
            } else {
                // User not found
                return ['success' => false, 'error' => 'User not found'];
            }
        } catch (Exception $e) {
            // Log the specific error message
            error_log('Exception during login: ' . $e->getMessage());

            return ['success' => false, 'error' => 'Exception during login'];
        }
    }


    public function getAllPosts()
    {
        try {
            // Prepare and execute the SQL statement
            $stmt = $this->conn->prepare("SELECT username, postTitle, postBody, likes, dislikes FROM posts");
            $stmt->execute();
            $result = $stmt->get_result();

            // Fetch all posts as objects
            $posts = [];
            while ($row = $result->fetch_assoc()) {
                $posts[] = (object)$row;
            }

            // Close the statement
            $stmt->close();

            return $posts;
        } catch (Exception $e) {
            // Log the specific error message
            error_log('Exception while getting posts: ' . $e->getMessage());

            return false;
        }
    }
}
