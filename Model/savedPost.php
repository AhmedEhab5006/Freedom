<?php
session_start();
require_once('Posts.php');
require_once('../Ctrl/DB.php');

class savedPost extends Post{

    private $userId;
    private $userName;
    private $list_of_post=[];
    
    public function removeSavedPost($userId,$postId){
        $post = new Post ();
        $postId = $post->getId();
        $this->userId =  $_SESSION['username'];
        $postId = $_SESSION["postId"];
        $sql="DELETE FROM posts  WHERE Client_name LIKE '$userId' and ID='$postId';";
        if($this->getConnection()->query($sql)){
            return "post deleted";
        }
        else{
            return "error";
        }
    }
    public function getSavedPostsByUserId($postId) {
        $post = new Post ();
        $postId = $_SESSION["test"] ;
        $post->setId($postId) ;
        $post->savePosts($postId);
        echo ($post->savePosts($postId));
    }

    // public function viewSavedPost($userId){
    //     // $userId=$this->conn->real_escape_string($userId);
    //     $this->userId = $userId;
    //     $sql="select * from `post` where userId='$userId'";
    //     $result=$this->conn->query($sql);
    //     if($result->num_rows > 0){
    //         $savedPost=[];
    //         while($row=$result->fetch_assoc()){
    //             $savedPost=$row;
    //         }
    //         return $savedPost;
    //     }
    //     else{
    //         return "this user has No saved post";
    //     }
    // }
}

?>