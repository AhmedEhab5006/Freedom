<?php
session_start();
require_once "C:\\xampp\\htdocs\\Freedom\\Model\\Posts.php";
require_once "C:\\xampp\\htdocs\\Freedom\\Ctrl\\operations.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/wallpage.css" rel="stylesheet" />
    <title>Previous posts</title>
</head>
<body>
</body>
</html>
<?php
$posts = new Operations (); 
$posts->showSpecificUserPosts($_SESSION["username"]);
?>
<a href = "http://localhost/Freedom/View/wallpage.php">Go to wall Page</a>
<br>
<br>
<a href = "http://localhost/Freedom/View/addpost.php">Go and share a new post</a>
