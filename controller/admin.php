<?php 
if (empty($_SESSION['felhasznalo_id'])) {
    header('Location: index.php?page=index');
}

$deleteAdminError="";
$deleteCategoryError="";
$addAdminError="";
$addCategoryError="";

if (isset($_POST['adminadd'])) {
    if (isset($_POST['addadminnev'])) {
        if($_POST['addadminnev']!="defaultvalue"){
                $sql="INSERT INTO admin(felhasznalo_id)
                VALUES('".$_POST['addadminnev']."')";
                if($conn->query($sql) === TRUE) {
                    $addAdminError="Sikeres admin hozzáadás!<br>";
                    
                } else {
                    $addAdminError="Nem létezik ilyen felhasználó";
                    
                }
        }
    }else $addAdminError="Válassza ki a felhasználót akit adminná akar tenni.";
}

if (isset($_POST['deleteadmin'])) {
    if (isset($_POST['deladminnev']) and strlen($_POST['deladminnev']!=0)) {
        
    
    if($_POST['deladminnev']!="defaultvalue"){
        
             $sql="DELETE FROM admin WHERE felhasznalo_id='".$_POST['deladminnev']."'";
             if($conn->query($sql) === TRUE) {
                $deleteAdminError="Sikeres admin törlés!<br>";
                
          } else {
            $deleteAdminError="Error: " . $sql . "<br>" . $conn->error;
          }
         }
     }else $addAdminError="Válassza ki az admint akit törölni akar.";
}
if(isset($_POST['addaru'])){

 if ( isset($_POST['addaruar']) and isset($_POST['addarukat']) and isset($_POST['addarunev'])) {
    echo 'asd';
     if(!empty($_POST['addarunev'])) {
    $sql = "SELECT termek_nev FROM termek WHERE termek_nev = '".$_POST['addarunev']."'";
    if(!$result = $conn->query($sql)) echo $conn->error;
    if ($result->num_rows > 0) {
        $addCategoryError="Ilyen áru már létezik";
    }else{
        $sql="INSERT INTO termek(termek_nev,termek_ar,termek_tipus)
        VALUES ('".$_POST['addarunev']."','".$_POST['addaruar']."','".$_POST['addarukat']."')";
        if ($conn->query($sql) === TRUE) {
            $addCategoryError="Sikeres áru hozzáadás";        
        }else {
            echo"Error: " . $sql . "<br>" . $conn->error;
        }
    }
}else $addCategoryError="Nem adtál meg nevet az új árunak.";
}
}
if (isset($_POST['delaru'])) {
    if (isset($_POST['delaru']) and strlen($_POST['delarunev']!=0)) {
        if($_POST['delarunev']!="defaultvalue"){
                 $sql="DELETE FROM termek WHERE termekek_id='".$_REQUEST['delarunev']."'";
                 if(!$result = $conn->query($sql)) echo $conn->error;
                 if($conn->query($sql) === TRUE) {
                    $deleteAruError="Sikeres áru törlés!<br>";
                    
              } else {
                $deletearuError="Error: " . $sql . "<br>" . $conn->error;
              }
             }
         }else $deleteAruError="Válassza ki az árut akit törölni akar.";
}
include "view/admin.php"
 ?>