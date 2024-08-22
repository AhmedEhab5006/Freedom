<?php
require_once "C:\\xampp\\htdocs\\Freedom\\Ctrl\\DB.php" ;
class Post extends Database {
    private $postId ;
    private $clientName ;
    private $postTitle ;
    private $postBody ;
    private $postDate ;
    private $noOfLikes ;
    private $noOfDislikes ;
    private $listOfComments = [];
    public function getId(){
        return $this->postId ;
    }
    public function getClientName(){
        return $this->clientName ;
    }
    public function getPostTitle(){
        return $this->postTitle ;
    }
    public function getPostBody(){
        return $this->postBody ;
    }
    public function getPostDate(){
        return $this->postDate ;
    }
    public function getNoOfLikes(){
        return $this->noOfLikes ;
    }
    public function getNoOfDislikes(){
        return $this->noOfDislikes ;
    }
    public function getComments(){
        return $this->listOfComments ;
    }
    public function setId ($postId){
        $this->postId = $postId ;
    }
    public function setClientName ($clientName){
        $this->clientName = $clientName ;
    }
    public function setPostTitle ($postTitle){
        $this->postTitle = $postTitle ;
    }
    public function setPostBody ($postBody){
        $this->postBody = $postBody ;
    }
    public function setPostDate ($postDate){
        $postDate = date("Y/m/d") ;
        $this->postDate = $postDate ;
    }
    public function setNoOfLikes ($noOfLikes){
        $this->noOfLikes = $noOfLikes ;
    }
    public function setNoOfDislikes ($noOfDislikes){
        $this->noOfDislikes = $noOfDislikes ;
    }
    public function setListOfComments ($listOfComments){
        $this->listOfComments = $listOfComments ;
    }
    public function __construct()
    {
        
    }
    
    public function addPost($postId, $clientName, $postTitle, $postBody, $postDate) {
        $stmt = $this->getConnection()->prepare("INSERT INTO posts (ID, Client_name, Post_title, Post_body, Post_creation_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $postId, $clientName, $postTitle, $postBody, $postDate);
        $stmt->execute();
    }

    public function editPost($title, $body, $id) {
        $stmt = $this->getConnection()->prepare("UPDATE posts SET Post_title = ?, Post_body = ? WHERE ID = ?");
        $stmt->bind_param("ssi", $title, $body, $id);
        $stmt->execute();
    }

    public function deletePost($id) {
        $stmt = $this->getConnection()->prepare("DELETE FROM posts WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo '<script>alert("Your delete operation is done");</script>';
    }

    public function likePost($id) {
        $stmt = $this->getConnection()->prepare("UPDATE posts SET Number_of_likes = Number_of_likes + 1 WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function disLikePost($id) {
        $stmt = $this->getConnection()->prepare("UPDATE posts SET Number_of_dislikes = Number_of_dislikes + 1 WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }
    public function savePosts($id)
    {
        

        $sqlSelect = "SELECT * FROM posts WHERE ID = ?";
        $stmt = $this->getConnection()->prepare($sqlSelect);

        if ($stmt) {
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                while ($row = $result->fetch_assoc()) {
                    $post = new Post();
                    $post->setClientName($row['Client_name']);
                    $post->setPostTitle($row['Post_title']);
                    $post->setPostBody($row['Post_body']);
                    $clientName = $post->getClientName();
                    $title = $post->getPostTitle();
                    $body = $post->getPostBody();
                }

                $result->free();
            } else {
                echo "Error executing statement.\n";
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            echo "Error preparing statement.\n";
        }

        return "Username : $clientName <br><br> Title : $title <br><br> Body : $body";
    }

    
    
}

?>