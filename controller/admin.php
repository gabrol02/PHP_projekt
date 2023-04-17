<?php 
if (empty($_SESSION['users_id'])) {
    header('Location: index.php?page=index');
}

$deleteAdminError="";
$deleteCategoryError="";
$addAdminError="";
$addCategoryError="";

if (isset($_POST['adminadd'])) {
    if (isset($_POST['addadminname'])) {
        if($_POST['addadminname']!="defaultvalue"){
                $sql="INSERT INTO admins(users_id,layer)
                VALUES('".$_POST['addadminname']."','0')";
                if($conn->query($sql) === TRUE) {
                    $addAdminError="Sikeres admin hozzáadás!<br>";
                    
                } else {
                    $addAdminError="Nem létezik ilyen felhasználó";
                    
                }
        }
    }else $addAdminError="Válassza ki a felhasználót akit adminná akar tenni.";
}

if (isset($_POST['deleteadmin'])) {
    if (isset($_POST['deladminname']) and strlen($_POST['deladminname']!=0)) {
        
    
    if($_POST['deladminname']!="defaultvalue"){
        
             $sql="DELETE FROM admins WHERE users_id='".$_POST['deladminname']."'";
             if($conn->query($sql) === TRUE) {
                $deleteAdminError="Sikeres admin törlés!<br>";
                
          } else {
            $deleteAdminError="Error: " . $sql . "<br>" . $conn->error;
          }
         }
     }else $addAdminError="Válassza ki az admint akit törölni akar.";
    }

 if (isset($_POST['addcat']) and isset($_POST['addcatname'])) {
     if(!empty($_POST['addcatname'])) {
    $sql = "SELECT category FROM cat WHERE category = '".$_POST['addcatname']."'";
    if(!$result = $conn->query($sql)) echo $conn->error;
    if ($result->num_rows > 0) {
        $addCategoryError="Ilyen kategória már létezik";
    }else{
        $sql="INSERT INTO cat (category)
        VALUES ('".$_POST['addcatname']."')";
        if ($conn->query($sql) === TRUE) {
            $addCategoryError="Sikeres kategória hozzáadás";        
        }else {
            echo"Error: " . $sql . "<br>" . $conn->error;
        }
    }
}else $addCategoryError="Nem adtál meg nevet az új kategóriának.";
}

if (isset($_POST['delcategory'])) {
if (isset($_POST['delcat'])!=null) {
if($_POST['delcat']!="defaultvalue"){
    
     $sql="SELECT picture_name FROM pictures WHERE cat_id='".$_POST['delcat']."'";
    
    if(!$result = $conn->query($sql)) echo $conn->error;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            unlink($row['picture_name']);
            $sql="DELETE FROM pictures WHERE cat_id='".$_POST['delcat']."'";
            if(!$rs= $conn->query($sql)) echo $conn->error;
        }
    }else $deleteCategoryError="Ilyen kategória nem létezik";
    $sql="DELETE FROM cat WHERE cat_id='".$_POST['delcat']."'";
    if ($result->num_rows > 0) {
        if($result = $conn->query($sql)) 
        {
            $deleteCategoryError='Kategória törölve!';
        }else{
            $deleteCategoryError=$conn->error;
            
        }
    }
    
}
}else $deleteCategoryError="Nem választottál törölni kívánt kategóriát.";
}
include "view/admin.php"
 ?>