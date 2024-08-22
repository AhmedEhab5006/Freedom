<?php
require_once('../,classes/pstclass.php');
require_once('DB.php');

// Assume you have a function to get saved posts for a specific user


// function getSavedPostsByUserId($userId) {
//     global $conn;

//     $posts = array();

//     $sql = "SELECT * FROM post WHERE userId = $userId";
//     $result = $conn->query($sql);

//     if ($result->num_rows > 0) {
//         while ($row = $result->fetch_assoc()) {
//             $post = new Post();
//             $post->setpostId($row['postId']);
//             $post->setuserId($row['userId']); 
//             $post->setTitle( $row['title']);
//             $post->setContent($row['content']); 

//             $posts[] = $post;
//         }
//     }

//     return $posts;
// }

// Get saved posts for a specific user (replace 1 with the actual user ID)
// $p=new savedPost();
// $p->getSavedPostsByUserId(1);
//$userPosts = getSavedPostsByUserId(2);


// Include the view page
// include('sPView.php');
?>