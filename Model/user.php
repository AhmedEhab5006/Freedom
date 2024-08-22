<?php

class Client
{

    private $id;
    private $username;
    private $password;
    private $firstName;
    private $lastName;
    private $email;
    private $phoneNumber;
    private $pfp;
    private $role;
    private $App = false;
    private $db;

    public function __construct()
    {
        include_once '../Ctrl/DB.php';
        $this->db = new Database();
    }

    public function validateUsername($username, $dbConnection)
    {
        // Validate against SQL injection
        $username = mysqli_real_escape_string($dbConnection, $username);

        // Check uniqueness
        $query = "SELECT COUNT(*) as count FROM users WHERE username = '$username'";
        $result = mysqli_query($dbConnection, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] > 0) {
            // Username is not unique
            return "Username is already taken.";
        }

        return true; // Username is valid
    }

    public function validateEmail($email, $dbConnection)
    {
        // Validate against SQL injection
        $email = mysqli_real_escape_string($dbConnection, $email);

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return "Invalid email address.";
        }

        // Check uniqueness
        $query = "SELECT COUNT(*) as count FROM users WHERE email = '$email'";
        $result = mysqli_query($dbConnection, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] > 0) {
            // Email is not unique
            return "Email is already registered.";
        }

        return true; // Email is valid
    }

    public function validatePhoneNumber($phoneNumber, $dbConnection)
    {
        // Validate against SQL injection
        $phoneNumber = mysqli_real_escape_string($dbConnection, $phoneNumber);

        // Ensure only numbers are present
        if (!ctype_digit($phoneNumber)) {
            return "Invalid phone number. Please enter only numbers.";
        }

        return true;
    }



    public function signup($username, $fname, $lname, $phone, $email, $password)
    {
        // Basic validation
        if (empty($username) || empty($fname) || empty($lname) || empty($phone) || empty($email) || empty($password)) {
            return false; // Validation failed
        }

        // Set the properties
        $this->setUsername($username);
        $this->setFname($fname);
        $this->setLname($lname);
        $this->setPhone($phone);
        $this->setEmail($email);
        $hash_password = hash($password, PASSWORD_DEFAULT);
        $this->setPassword($hash_password);
        return true; // Validation successful
    }
/*
     public function signup($username, $fname, $lname, $phone, $email, $pass)
     {
         $this->username = $username;
            $this->firstName = $fname;
         $this->lastName = $lname;
         $this->phoneNumber = $phone;
         $this->email = $email;
         $this->password = $pass;

         $hash_pass = password_hash($pass, PASSWORD_DEFAULT);

         $app = $this->App;
            $sql = "INSERT INTO usesr (username, fname, lname, phone, email, hash_pass, App) 
                 VALUES ('$username', '$fname', '$lname', '$phone', '$email', '$hash_pass', '$app')";
         $row = $this->db->insert($sql);
         $_SESSION['username'] = $username;
         $_SESSION['email'] = $email;
         $_SESSION['fname'] = $fname;
         $_SESSION['lname'] = $lname;
         $_SESSION['phone'] = $phone;
         $_SESSION['App'] = $this->App;
     }


*/
    public function login($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $sql = "SELECT * FROM usesr WHERE username='$this->username'";
        $row = $this->db->select($sql);
        if ($row && password_verify($this->password, $row['password'])) {
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['fname'] = $row['fname'];
            $_SESSION['lname'] = $row['lname'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['App'] = $row['App'];
            return true;
        }
        return false;
    }

    public function logout()
    {
        session_start();
        unset($_SESSION['id']);
        unset($_SESSION['role']);
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        unset($_SESSION['email']);
        unset($_SESSION['fname']);
        unset($_SESSION['lname']);
        unset($_SESSION['phone']);
        unset($_SESSION['pfp']);
        session_destroy();
        header("location:../index.php");
    }

    public function addUser($info)
    {
        $sql = "SELECT * FROM users WHERE username = '{$info['username']}'";
        $r = $this->db->check($sql);
        if ($r == 0) {
            $s_sql1 = "INSERT INTO usesr (role, username, password, email, fname, lname, age, phone, address) 
                        VALUES ('client','{$info['username']}', '{$info['password']}', '{$info['email']}', '{$info['fname']}', '{$info['lname']}', '{$info['phone']}')";
            if ($this->db->insert($s_sql1)) {
                $check = 1;
            }
            return true;
        }

        return false;
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

    // public function usersinfo($info)
    // {
    //     $this->username = $info['username'];
    //     $this->password = $info['password'];
    //     $this->getName() = $info['name'];
    //     $this->role = $info['role'];
    // }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }



    public function getEmail()
    {
        return $this->email;
    }
    public function getPhone()
    {
        return $this->phoneNumber;
    }

    public function setPhone($ph)
    {
        if (is_numeric($ph)) {
            $this->phoneNumber = $ph;
        }
    }
    public function getPfp()
    {
        return $this->pfp;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getApp()
    {
        return $this->App;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }



    public function setFName($firstName)
    {
        $this->firstName = $firstName;
    }


    public function setLName($lastName)
    {
        $this->lastName = $lastName;
    }


    public function getFName()
    {
        return $this->firstName;
    }


    public function getLName()
    {
        return $this->lastName;
    }





    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPfp($pfp)
    {
        $this->pfp = $pfp;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function setApp($App)
    {
        $this->App = $App;
    }
}
