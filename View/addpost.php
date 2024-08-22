<?php
session_start();
require_once ("C:\\xampp\\htdocs\\Freedom\\Model\\Posts.php") ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a written post</title>
    <style>
        /* Centering the form */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 1px solid #ccc;
            padding: 20px;
        }

        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 200px;
            transition: width 0.3s; /* Transition for width change */
        }
    </style>
</head>
<body>
    <form action="addpost.php" method="post">
        <input type="text" name="title" id="textInput" placeholder="Type the title" oninput="adjustSize(this)">
        <br><br>
        <input type="text" name="type" id="textInput" placeholder="Type something..." oninput="adjustSize(this)">
        <br><br>
        <input type="submit" name="submit" value="Post"><br><br>
        <input type="submit" name="view" value="See your previous posts">

    </form>

    <script>
        function adjustSize(input) {
            input.style.width = ((input.value.length + 1) * 8) + 'px'; // Adjust width based on text length
        }
    </script>
</body>
</html>
<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["submit"])){
        $title = filter_input(INPUT_POST , "title" , FILTER_SANITIZE_SPECIAL_CHARS);
        $body = filter_input(INPUT_POST , "type" , FILTER_SANITIZE_SPECIAL_CHARS);
        if(empty($body) || empty($title)){
            ?>
            <script>
            alert('empty post or title');
            </script>
            <?php
        }
        if(!empty($body) && !empty($title)){
            $postId = rand(100000 , 999999);
            $username = $_SESSION["username"];
            $date = date("Y/m/d") ;
            $post = new Post($postId , $username , $title , $body , $date);
            $post->setId($postId);
            $post->setClientName($username);
            $post->setPostTitle($title);
            $post->setPostBody($body);
            $post->setPostDate($date);
            $_SESSION["postId"] = $post->getId();
            $post->addPost($post->getId() , $post->getClientName() , $post->getPostTitle() , $post->getPostBody() , $post->getPostDate());
            header("location: wallpage.php");
            
        }
    }
    if(isset($_POST["view"])){
        header("location: viewPreviousPosts.php");
    }
}
?>
