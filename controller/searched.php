<?php
if(isset($_POST['upvote'])){
    // Megnézi hogy ez a felhasználó upvoteolta-e már ezt a képet
    $sql = "SELECT felhasznalo_id FROM likes WHERE vote = 0 and liked_pic_id=".$_POST['selected_picture_id']." and felhasznalo_id=".$_SESSION['felhasznalo_id']."";
    if(!$result = $conn->query($sql)) echo $conn->error;
    //ha nem akkor megnézi hogy felhasználó downvoteolta-e már ezt a képet
    if(!$result->num_rows > 0){
        $sql = "SELECT felhasznalo_id FROM likes WHERE vote = 1 and liked_pic_id=".$_POST['selected_picture_id']." and felhasznalo_id=".$_SESSION['felhasznalo_id']."";
        if(!$result = $conn->query($sql)) echo $conn->error;
        // ha igen updateli
        if($result->num_rows > 0){
            $sql = "UPDATE  likes SET vote=0 WHERE vote = 1 and felhasznalo_id=".$_SESSION['felhasznalo_id']." and liked_pic_id= ".$_POST['selected_picture_id']."";
            
            if(!$result = $conn->query($sql)) echo $conn->error;
            if ($conn->query($sql) === TRUE) {
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            //utána beszúrja az adatbázisba
        }else{
            $sql = "INSERT INTO likes (felhasznalo_id,liked_pic_id,vote)
            VALUES ('".$_SESSION['felhasznalo_id']."','".($_POST['selected_picture_id'])."','0')";
             if ($conn->query($sql) === TRUE) {
                header('Location: index.php?page=searchedUser&searched='.$_SESSION['search']);
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
        }

    }else{
        $sql = "DELETE FROM likes WHERE vote = 0 and felhasznalo_id=".$_SESSION['felhasznalo_id']." and liked_pic_id= ".$_POST['selected_picture_id']."";
        if(!$result = $conn->query($sql)) echo $conn->error;
            if ($conn->query($sql) === TRUE) {
                header('Location: index.php?page=searchedUser&searched='.$_SESSION['search']);
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
     }
    
}
if(isset($_POST['downvote'])){
    // Megnézi hogy ez a felhasználó upvoteolta-e már ezt a képet
    $sql = "SELECT felhasznalo_id FROM likes WHERE vote = 1 and liked_pic_id=".$_POST['selected_picture_id']." and felhasznalo_id=".$_SESSION['felhasznalo_id']."";
    if(!$result = $conn->query($sql)) echo $conn->error;
    //ha nem akkor megnézi hogy felhasználó downvoteolta-e már ezt a képet
    if(!$result->num_rows > 0){
        $sql = "SELECT felhasznalo_id FROM likes WHERE vote = 0 and liked_pic_id=".$_POST['selected_picture_id']." and felhasznalo_id=".$_SESSION['felhasznalo_id']."";
        if(!$result = $conn->query($sql)) echo $conn->error;
        // ha igen kitörli
        if($result->num_rows > 0){
            $sql = "UPDATE  likes SET vote=1 WHERE vote = 0 and felhasznalo_id=".$_SESSION['felhasznalo_id']." and liked_pic_id= ".$_POST['selected_picture_id']."";
            if(!$result = $conn->query($sql)) echo $conn->error;
            if ($conn->query($sql) === TRUE) {
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            //utána beszúrja az adatbázisba
        }else{
            $sql = "INSERT INTO likes (felhasznalo_id,liked_pic_id,vote)
            VALUES ('".$_SESSION['felhasznalo_id']."','".($_POST['selected_picture_id'])."','1')";
             if ($conn->query($sql) === TRUE) {
                header('Location: index.php?page=searchedUser');
             } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
        }

    }else{
        $sql = "DELETE FROM likes WHERE vote = 1 and felhasznalo_id=".$_SESSION['felhasznalo_id']." and liked_pic_id= ".$_POST['selected_picture_id']."";
        
        
        if(!$result = $conn->query($sql)) echo $conn->error;
            if ($conn->query($sql) === TRUE) {
                header('Location: index.php?page=searchedUser='.$_SESSION['search']);
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
     }
    
}
if(isset($_POST['fav'])){
    $sql = "SELECT felhasznalo_id FROM favourite WHERE favorited_picture_id=".$_POST['selected_picture_id']." and felhasznalo_id=".$_SESSION['felhasznalo_id']."";
    if(!$result = $conn->query($sql)) echo $conn->error;
    if($result->num_rows > 0){
        $sql = "DELETE FROM favourite WHERE favorited_picture_id=".$_POST['selected_picture_id']." and felhasznalo_id=".$_SESSION['felhasznalo_id']."";
        if ($conn->query($sql) === TRUE) {
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }else{
        $sql = "INSERT INTO favourite (felhasznalo_id,favorited_picture_id)
            VALUES ('".$_SESSION['felhasznalo_id']."','".($_POST['selected_picture_id'])."')";
             if ($conn->query($sql) === TRUE) {
                
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
    }
}
if (isset($_POST['userdel'])) {
   $sql = "SELECT felhasznalo_id FROM users WHERE felhasznalo_id = ".$_SESSION['searched_user_id'];
    if(!$result = $conn->query($sql)) echo $conn->error;
    if($result->num_rows > 0){
       $sql="DELETE FROM users WHERE felhasznalo_id = ".$_SESSION['searched_user_id'];
        if(!$result = $conn->query($sql)) echo $conn->error;
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
}

$_SESSION['searched_user_id']="";
$sql = "SELECT felhasznalo_id FROM users WHERE username = '".$_SESSION['search']."'";
    if(!$result = $conn->query($sql)) echo $conn->error;
    if ($result->num_rows > 0) {
        if($row = $result->fetch_assoc()) {
            $tanulo -> set_user($row['felhasznalo_id'], $conn);
                $_SESSION['searched_user_id'] = $row['felhasznalo_id'];
                $_SESSION['searched_username'] = $tanulo->get_username();
                $_SESSION['searched_email'] = $tanulo->get_email();
                $_SESSION['searched_gender'] = $tanulo->get_gender();
               
        }
    }

$sql = "SELECT picture_id FROM profile_pics WHERE felhasznalo_id = '".$_SESSION['searched_user_id']."'";
if(!$result = $conn->query($sql)) echo $conn->error;
if ($result->num_rows > 0) {
    if($row = $result->fetch_assoc()) {
        $p_photo -> set_photo($row['picture_id'], $conn);
        
            $_SESSION['searched_picture_id'] = $row['picture_id'];
            $_SESSION['searched_picture_name'] = $p_photo->get_picture_name();

    }
}
include 'view/searchedUser.php';
    ?>