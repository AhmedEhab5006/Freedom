<?php
require_once "../Model/savedPost.php";
require_once "../Model/Posts.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saved Posts</title>
</head>
<body>

<h1>Saved Posts</h1>

<?php
$userId = $_SESSION["username"];
$postId = $_SESSION["test"];
$userPosts = new savedPost();
$post = new Post();
echo($userPosts->getSavedPostsByUserId($postId));

/*
foreach ($userPosts as $post) {
    echo "<h2>{$post->getPostTitle()}</h2>";
    echo "<p>{$post->getContent()}</p>";
    echo "<hr>";
}
echo $_SESSION["username"];
*/
?>

</body>
</html>
