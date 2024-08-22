<?php
/* require './DB.php';



if (!session_status()) {
    session_start();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (
        !empty($_POST['Name']) && !empty($_POST['username']) &&
        !empty($_POST['email']) && !empty($_POST['password'])
    )
        if (isset($_POST['submit'])) {
            $_SESSION['Name'] = $_POST['Name'];
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            header('Location: ../View/index.html');
            exit();
        } else {
            header('Location: ../View/login.html');
            exit();
        }
}
*/