<?php 
if ($i>0) echo "$i fájl feltöltve" ;
if ($errors) {
    foreach($errors as $error){
        foreach($error as $errorMsg){
            echo"$errorMsg <br>";
        
        }
    }
}
echo'<div class="middle">';
echo'<div class="bordering">';
echo'<img id="profilepicture" src="'.$_SESSION['picture_name'].'"><br>';?>
</div>
<form action="index.php?page=profile" method="POST" enctype="multipart/form-data">
        Profilkép megváltoztatása:<br>
        <input type="file" name="profilepicture" " >
        <br>
        <input type="submit" name="profilepicturebutton">
        
</form>
<?php
echo "Felhasználó: ".$_SESSION["username"]."<br>" ;
echo "E-mail: ".$_SESSION["email"]."<br>";
if ($_SESSION["gender"]==0) {
    echo "Nem: Férfi";
}else echo "Nem: Nő";

?>

<form action="index.php?page=profile" method="POST"><input type="submit" value="Feltöltött képek" name="mypics"><input type="submit" value="Kedvenc képeim" name="favpics"> </form>
</div>
<?php

if(isset($_POST['favpics'])){
    echo"<div class='flex-container' id='flex-con'>";
    
            $sql = "SELECT favorited_picture_id FROM favourite WHERE felhasznalo_id=".$_SESSION['felhasznalo_id']." ORDER BY favorited_picture_id DESC";
            if(!$result = $conn->query($sql)) echo $conn->error;
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $pictures->set_photo($row['favorited_picture_id'],$conn);
                    if($pictures->get_category()!="Profilkep"){
                        echo '<div class="keret"><span><img class="kepek" src="'.$pictures->get_picture_name().'"><span>'.$pictures->get_category().'</span></span>';
                        
                       $sql="SELECT felhasznalo_id FROM favourite WHERE favorited_picture_id=".$pictures->get_picture_id()." and felhasznalo_id=".$_SESSION['felhasznalo_id']." ORDER BY felhasznalo_id ASC ";
                        if(!$rs = $conn->query($sql)) echo $conn->error;
                        echo'<form action="index.php?page=profile" method="post" id="absolut">';
                        if($rs->num_rows > 0){
                            echo'<input type="submit" class="onfav" name="fav"  value>';
                            echo'<input type="hidden" name="favpics" >';
                            echo'<input type="hidden" value="'.$pictures->get_picture_id().'" name="selected_picture_id"></form>';
                            
                        }
                        echo "</div>";
                    }
                    
                }
            }else echo "Még nincsenek kedvenc képeid.";
        
    
    echo"</div>";
}else{
echo"<div class='flex-container' id='flex-con'>";


if ($pictureIds) {

    foreach($pictureIds as $pictureId) {

        $pictures->set_photo($pictureId,$conn);

        $sql = "SELECT picture_id FROM pictures WHERE felhasznalo_id = '".$_SESSION['felhasznalo_id']."'";

        if($result->num_rows > 0){
            
            
                if($pictures->get_category()!="Profilkep"){
                    if ($pictures->get_felhasznalo_id()==$_SESSION['felhasznalo_id']) {
                        echo '<div class="keret"><span><img class="kepek" src="'.$pictures->get_picture_name().'"><span>'.$pictures->get_category().'
                        <form action="index.php?page=profile" method="post">
                        <input type="hidden" value="'.$pictures->get_picture_id().'" name="selected_picture_id">
                        <input type="submit"  name="del"  value="Törlés"></form></span></span></div>';
                    }
        }
        
           
    
}
}
echo"</div>";
}
}
?>