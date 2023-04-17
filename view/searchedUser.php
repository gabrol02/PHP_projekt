<?php 

if (!empty($_SESSION['searched_user_id'])) {
    
    echo'<div class="middle"><img id="profilepicture" src="'.$_SESSION['searched_picture_name'].'"><br>';
    echo "Felhasználó: ".$_SESSION["searched_username"]."<br>" ;
    echo "E-mail: ".$_SESSION["searched_email"]."<br>";
    if ($_SESSION["searched_gender"]==0) {
        echo "Nem: Férfi";
    }else echo "Nem: Nő";

    if(!empty($_SESSION['users_id'])){
        $sql="SELECT users_id FROM admins WHERE users_id='".$_SESSION['users_id']."'";
        if(!$result = $conn->query($sql)) echo $conn->error;
        if($result->num_rows > 0){
             $sql="SELECT admins.users_id FROM admins WHERE admins.users_id  ='".$_SESSION['searched_user_id']."' and layer =1";
            if(!$rs = $conn->query($sql)) echo $conn->error;
            if(!$rs->num_rows > 0){
            echo'
            <form action="index.php?page=index.php?page=searchedUser&searched='.$_SESSION["searched_username"].'" method="post">
            <input type="submit"  name="userdel"  value="Felhasználó törlése">
            </form>';
        }}
    }
echo'</div>';
    echo"<div id='flex-con' class='flex-container'>";
        if ($pictureIds) {
            


            foreach($pictureIds as $pictureId) {
                $pictures->set_photo($pictureId,$conn);
                $sql = "SELECT picture_id FROM pictures WHERE users_id = '".$_SESSION['searched_user_id']."'";
                if($result->num_rows > 0){
                    if($pictures->get_category()!="Profilkep"){
                        if ($pictures->get_users_id()==$_SESSION['searched_user_id']) {
                            $i=0;
                $j=0;
                   $sql="SELECT COUNT(users_id) FROM likes WHERE vote = 0 and liked_pic_id='".$pictureId."'";
                   if(!$result = $conn->query($sql)) echo $conn->error;
                   
                
                   if($result->num_rows > 0){
                    foreach($result->fetch_assoc() as $row){
                        $i=$row;
                       }
                    } 
                    $sql="SELECT  COUNT(users_id) FROM likes WHERE vote = 1 and liked_pic_id='".$pictureId."'";
                   if(!$result = $conn->query($sql)) echo $conn->error;
                   if($result->num_rows > 0){
                    foreach($result->fetch_assoc() as $row){
                        $j=$row;
                       }
                    }
                            
                            echo '<div class="keret"><span><img class="kepek" src="'.$pictures->get_picture_name().'"><span>'.$pictures->get_category().'</span>';
                            
                            if (!empty($_SESSION['users_id'])) {
                                echo 
                                '<form action="index.php?page=searchedUser&searched='.$_SESSION['search'].'" method="post" id="absolut">
                                
                                    <input type="submit" class="upvote" name="upvote" value>
                                    '.$i.'
                                    
                                    
                                    <input type="submit" class="downvote" name="downvote" value>
                                    <input type="hidden" value="'.$pictureId.'" name="selected_picture_id">
                                    
                                    '.$j.'';
                                    
                                    $sql="SELECT users_id FROM favourite WHERE favorited_picture_id=".$pictureId." and users_id=".$_SESSION['users_id']." ";
                                    if(!$result = $conn->query($sql)) echo $conn->error;
                                    if($result->num_rows > 0){
                                        echo'<input type="submit" class="onfav" name="fav" onclick="favno(this.value)" value></form>';
                                    }else{
                                        echo'<input type="submit" class="nofav" name="fav" onclick="favo(this.value)"  value></form>';
                                    }
            
                                    $sql="SELECT users_id FROM admins WHERE users_id='".$_SESSION['users_id']."'";
                                    if(!$result = $conn->query($sql)) echo $conn->error;
                                    if($result->num_rows > 0){
                                                    echo'
                                                
                                                <form action="index.php?page=index" method="post">
                                                <input type="submit"  name="del"  value="Törlés">
                                                <input type="hidden" value="'.$pictureId.'" name="selected_picture_id">
                                                </form>';
                                    }
                               
                            else echo 'Likes: '.$i.' Dislikes: '.$j.'</span></div>';
                            
                        }
                            
                      echo'</span></div>';
                    }  
                }
            }
        
        }
        
    }
    echo"</div>";
}else {
    if(empty($_SESSION['search'])){
    echo "Kérlek írj be egy felhasználónevet.";
        }else{
        echo $_SESSION['search']." nevű felhasználó nem létezik.<br>";
        echo "Erre gondolt:<br><ul id='pilos'> ";
        
   
            $stmt=mysqli_prepare($conn,"SELECT username FROM users WHERE username LIKE ?");
            if(isset($_REQUEST['searched'])){
            

            $stmt->bind_param('s', $nev); 
            $nev = "%".$_REQUEST['searched']."%";
            $stmt->execute();
            
                if($result = $stmt->get_result()){
                
                    if ($result->num_rows > 0 ){
                        
                                    
                                while($row = $result->fetch_assoc()){
                                    $sql="";
                                    echo "\t <a href='index.php?page=searchedUser&searched=".$row['username']."'>".$row['username']."<br>";
                                }
                            }
                        }
                    
                } else echo "Ehhez hasonló név nem szerepel az adatbazisban";
        
            }
}  
    

?>