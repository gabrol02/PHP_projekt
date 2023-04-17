<?php

if(isset($_POST['fav'])){
    $sql = "SELECT users_id FROM favourite WHERE favorited_picture_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
    if(!$result = $conn->query($sql)) echo $conn->error;
    if($result->num_rows > 0){
        $sql = "DELETE FROM favourite WHERE favorited_picture_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
        if ($conn->query($sql) === TRUE) {
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }else{
        $sql = "INSERT INTO favourite (users_id,favorited_picture_id)
            VALUES ('".$_SESSION['users_id']."','".($_POST['selected_picture_id'])."')";
             if ($conn->query($sql) === TRUE) {
                
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
}
if (isset($_POST['del'])) {
    $sql="SELECT picture_name FROM pictures WHERE picture_id=".$_POST['selected_picture_id'];
    if(!$result = $conn->query($sql)) echo $conn->error;
    if($result->num_rows > 0){
        if($row = $result->fetch_assoc()) {
            unlink($row['picture_name']);
        }
    }
    $sql="DELETE FROM pictures WHERE picture_id=".$_POST['selected_picture_id'];
    if(!$result = $conn->query($sql)) echo $conn->error;
    header('Location: index.php?page=index');

    
  }

if(isset($_POST['upvote'])){
    // Megnézi hogy ez a felhasználó upvoteolta-e már ezt a képet
    $sql = "SELECT users_id FROM likes WHERE vote = 0 and liked_pic_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
    if(!$result = $conn->query($sql)) echo $conn->error;
    //ha nem akkor megnézi hogy felhasználó downvoteolta-e már ezt a képet
    if(!$result->num_rows > 0){
        $sql = "SELECT users_id FROM likes WHERE vote = 1 and liked_pic_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
        if(!$result = $conn->query($sql)) echo $conn->error;
        // ha igen updateli
        if($result->num_rows > 0){
            $sql = "UPDATE  likes SET vote=0 WHERE vote = 1 and users_id=".$_SESSION['users_id']." and liked_pic_id= ".$_POST['selected_picture_id']."";
            
            if(!$result = $conn->query($sql)) echo $conn->error;
            if ($conn->query($sql) === TRUE) {
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            //utána beszúrja az adatbázisba
        }else{
            $sql = "INSERT INTO likes (users_id,liked_pic_id,vote)
            VALUES ('".$_SESSION['users_id']."','".($_POST['selected_picture_id'])."','0')";
             if ($conn->query($sql) === TRUE) {
                header('Location: index.php?=vote&category='.$category.'');
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

    }else{
        $sql = "DELETE FROM likes WHERE vote = 0 and users_id=".$_SESSION['users_id']." and liked_pic_id= ".$_POST['selected_picture_id']."";
        if(!$result = $conn->query($sql)) echo $conn->error;
            if ($conn->query($sql) === TRUE) {
                header('index.php?=vote&category='.$category.'');
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
     }
    
}
if(isset($_POST['downvote'])){
    // Megnézi hogy ez a felhasználó upvoteolta-e már ezt a képet
    $sql = "SELECT users_id FROM likes WHERE vote = 1 and liked_pic_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
    if(!$result = $conn->query($sql)) echo $conn->error;
    //ha nem akkor megnézi hogy felhasználó downvoteolta-e már ezt a képet
    if(!$result->num_rows > 0){
        $sql = "SELECT users_id FROM likes WHERE vote = 0 and liked_pic_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
        if(!$result = $conn->query($sql)) echo $conn->error;
        // ha igen kitörli
        if($result->num_rows > 0){
            $sql = "UPDATE  likes SET vote=1 WHERE vote = 0 and users_id=".$_SESSION['users_id']." and liked_pic_id= ".$_POST['selected_picture_id']."";
            if(!$result = $conn->query($sql)) echo $conn->error;
            if ($conn->query($sql) === TRUE) {
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
            }
            //utána beszúrja az adatbázisba
        }else{
            $sql = "INSERT INTO likes (users_id,liked_pic_id,vote)
            VALUES ('".$_SESSION['users_id']."','".($_POST['selected_picture_id'])."','1')";
             if ($conn->query($sql) === TRUE) {
                header('Location: index.php?=vote&category='.$category.'');
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

    }else{
        $sql = "DELETE FROM likes WHERE vote = 1 and users_id=".$_SESSION['users_id']." and liked_pic_id= ".$_POST['selected_picture_id']."";
        
        
        if(!$result = $conn->query($sql)) echo $conn->error;
            if ($conn->query($sql) === TRUE) {
                header('Location: index.php?=vote&category='.$category.'');
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
            }
     }
    
}

include 'view/index.php';
?>