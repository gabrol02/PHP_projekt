
<?php
if (empty($_SESSION['users_id'])) {
        header('Location: index.php?page=index');
    }
  if (isset($_POST['del'])) {
    
    $sql="SELECT picture_name FROM pictures WHERE picture_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
    if(!$result = $conn->query($sql)) echo $conn->error;
    if($result->num_rows > 0){
        if($row = $result->fetch_assoc()) {
            unlink($row['picture_name']);
        }
    }

    if($result->num_rows > 0){
        $sql ="DELETE FROM pictures WHERE picture_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
        if(!$result = $conn->query($sql)) echo $conn->error;
    }
     
  }
    if(isset($_POST['fav'])){
        $sql = "SELECT favorited_picture_id FROM favourite WHERE favorited_picture_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
        if(!$result = $conn->query($sql)) echo $conn->error;
        if($result->num_rows > 0){
            
    
            $sql = "DELETE FROM favourite WHERE favorited_picture_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
            if ($conn->query($sql) === TRUE) {
                
            } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
        }
        
    }
    


if(isset($_POST['fav'])){
    $sql = "SELECT favorited_picture_id FROM favourite WHERE favorited_picture_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
    if(!$result = $conn->query($sql)) echo $conn->error;
    if($result->num_rows > 0){
        

        $sql = "DELETE FROM favourite WHERE favorited_picture_id=".$_POST['selected_picture_id']." and users_id=".$_SESSION['users_id']."";
        if ($conn->query($sql) === TRUE) {
            
        } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
    }
        
}
    
    
    if(isset($_POST['profilepicturebutton'])){
        
        $name=$_FILES["profilepicture"]['name'];
        if (isset($_FILES["profilepicture"]['name'][0])!=null)  {
            
            $target_file = "pictures/".date("Y-m-d")."-".date("h-i-sa").basename($_FILES["profilepicture"]["name"]);
            str_replace(" ","_",$target_file);
            if (!in_array($_FILES["profilepicture"]["type"],$allowed_filetypes)) {
                $errors[$key][]="A $name fájl nem jpg vagy png vagy jpeg";
            }
            if(empty($errors[$key])){
                $str=explode("/",$_FILES["profilepicture"]["type"]);
                if(empty($errors[$key])){
                    @move_uploaded_file($_FILES["profilepicture"]["tmp_name"],$target_file);
                    $sql="INSERT INTO pictures (users_id,picture_name,size,formats,cat_id)
                        VALUES ('".$_SESSION['users_id']."','".$target_file."','".$_FILES["profilepicture"]["size"]."','".$str[1]."','1')";
                    if ($conn->query($sql) === TRUE) {
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }
                $sql="SELECT picture_id FROM pictures WHERE users_id='".$_SESSION['users_id']."' AND picture_name ='".$target_file."'";
                if(!$result = $conn->query($sql)) echo $conn->error;
                if ($result->num_rows > 0) {
                    if($row = $result->fetch_assoc()) {
                        $p_photo -> set_photo($row['picture_id'], $conn);
                            $_SESSION['picture_id'] = $row['picture_id'];
                            $_SESSION['picture_name'] = $p_photo->get_picture_name();

                    }
                }

                    if ($conn->query($sql) === TRUE) {
                        $_SESSION['success']="Sikeres profilkép változtatás";
                        
                    } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    $conn->close();
                }else{
                        $sql = "UPDATE profile_pics SET picture_id ='".$_SESSION['picture_id']."' WHERE users_id='".$_SESSION['users_id']."' ";
                        if ($conn->query($sql) === TRUE) {
                            echo $_SESSION['success']="Sikeres profilkép változtatás";
                            
                        }else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                }
            }
        }else $errors[$key][]="Nincs fájl kiválasztva";
    
    include 'view/profile.php';

?>