
<?php 
require_once "DB.php" ;
require_once "C:\\xampp\\htdocs\\Freedom\\Model\\Posts.php";
class Operations extends Database {
    public function showSpecificUserPosts (){
        $username = $_SESSION["username"];
        $sql = "SELECT * FROM posts WHERE Client_name = '$username' ";
        $query = $this->getConnection()->query($sql);
        $c = 1 ;
        while ($row = $query->fetch_assoc()){
            echo "Post no $c : " . "<br>" . "<br>" . "Title : " . $row ["Post_title"] . "<br>" . "<br>" . "Body : " . $row ["Post_body"] . "<br>". "<br>". "<br>";
            $c += 1 ;
            ?>
            <link href="../assets/css/wallpage.css" rel="stylesheet" />
            <form method="post" action="viewPreviousPosts.php">
            <label>Write a data for a new post if you want to edit it</label>   
            <input type="hidden" name="post_id" value="<?php echo $row['ID']; ?>">
            <br><br>
            <input type="text" name = "title" placeholder="Enter new title">
            <br><br>
            <input type="text" name = "body" placeholder="Enter new body">
            <br><br>
            <input type = "submit" name = "save" value="Save changes">
            <br><br>
            </form>
            <?php
                if(isset($_POST["save"])){
                    $post = new Post ();
                    $id = $_POST["post_id"]; 
                    $title = filter_input(INPUT_POST , "title" , FILTER_SANITIZE_SPECIAL_CHARS);
                    $body = filter_input(INPUT_POST , "body" , FILTER_SANITIZE_SPECIAL_CHARS);
                    if(empty($body) || empty($title)){
                        ?>
                         <script>
                         alert('empty post or title');
                         </script>
                         <?php
                    }
                    else{
                        $post->editPost($title , $body , $id);
                    }
                    
                } 
        ?>
        <form method="post" action="viewPreviousPosts.php">
            <input type="hidden" name="post_id" value="<?php echo $row['ID']; ?>">
            <input type="submit" name="delete_<?php echo $row['ID']; ?>" value="Delete">
            <br><br>
        </form>
        <?php
         if (isset($_POST["delete_" . $row['ID']])) {
            $post = new Post();
            $id = $_POST["post_id"];
            $post->deletePost($id);
        }
        
        
        
    }
}
}

?>

