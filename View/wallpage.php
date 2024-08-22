<!-- wall.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wall</title>
    <link href="../assets/css/wallpage.css" rel="stylesheet" />
</head>

<body>

    <h1>Welcome to the Wall</h1>
    <form action = "addpost.php"  method = "post">
            <input type = "submit" value = "Add post" name = "addpost">
        </form>

    <?php

    require_once '../Ctrl/PostCtrl.php';
    require_once '../Model/Posts.php';

    // Include the database connection
    require_once '../Ctrl/DB.php';
    $db = new Database();
    $conn = $db->getConnection();
    // Create a new instance of the PostController with the database connection
    $postController = new PostController($conn);

    // Fetch all posts
    $posts = $postController->getAllPosts();

    // Your HTML and PHP rendering logic
     foreach ($posts as $post) {
        echo '<div class="post-container">';
        echo '<div class="username">' . $post['Client_name'] . '</div>';
        echo '<div class="post-title">' . $post['Post_title'] . '</div>';
        echo '<div class="post-body">' . $post['Post_body'] . '</div>';
        ?>
        
        
        
        <form method="post" action="wallpage.php">
            <input type="hidden" name="post_id" value="<?php echo $post['ID']; ?>">
            <input type="submit" name="like_<?php echo $post['ID']; ?>" value="👍">
            <label><?php echo $post["Number_of_likes"] ?></label>
            <br><br>
        </form>
        <form method="post" action="wallpage.php">
            <input type="hidden" name="post_id" value="<?php echo $post['ID']; ?>">
            <input type="submit" name="dislike_<?php echo $post['ID']; ?>" value="👎">
            <label><?php echo $post["Number_of_dislikes"] ?></label>
            <br>
        </form>
        <form method="post" action="wallpage.php">
            <input type="hidden" name="post_id" value="<?php echo $post['ID']; ?>">
            <input type="submit" name="save_<?php echo $post['ID']; ?>" value="Save post">
            <br><br>
        </form>
        <?php        
        if (isset($_POST["like_" . $post['ID']])) {
            $post = new Post();
            $id = $_POST["post_id"];
            $post->likePost($id);
        }
        if (isset($_POST["dislike_" . $post['ID']])) {
            $post = new Post();
            $id = $_POST["post_id"];
            $post->disLikePost($id);
        }
        if (isset($_POST["save_" . $post['ID']])) {
            $post = new Post();
            $id = $_POST["post_id"];
            $_SESSION["test"] = $id ;
            $post->savePosts($id);
           ?>
            <script>
            window.location.href = "http://localhost/Freedom/View/sPView.php";
            </script>
            <?php
        }
        ?>
        </div>
        <?php
        
    
    }
    ?>
    
    
        
    
   

</body>

</html>