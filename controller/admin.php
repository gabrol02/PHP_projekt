<?php 
if (empty($_SESSION['felhasznalo_id'])) {
    header('Location: index.php?page=index');
}
if (empty($_SESSION['admin'])) {
    header('Location: index.php?page=index');
}

$deleteAdminError="";
$addAdminError="";

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
if (isset($_POST['addtipus'])) {
    if (isset($_POST['addtipusnev'])) {
       
                $sql="INSERT INTO termek_tipus(tipus)
                VALUES('".$_POST['addtipusnev']."')";
                if($conn->query($sql) === TRUE) {
                    $addTipusError="Sikeres típus hozzáadás!<br>";
                    
                } else {
                    echo $conn->error;
                    
                }
        
    }
}
if (isset($_POST['deletetipus'])) {
    if (isset($_POST['deltipus']) and strlen($_POST['deltipus']!=0) ) {
    if($_POST['deltipus']!="defaulttipus"){
        if(isset($_POST['deltipus'])){
             $sql="DELETE FROM termek_tipus WHERE termek_tipus_id='".$_POST['deltipus']."'";
             if($conn->query($sql) === TRUE) {
                $deleteAdminError="Sikeres tipus törlés!<br>";
                
          } else {
            $deleteAdminError="Error: " . $sql . "<br>" . $conn->error;
          }
         }}
     }
}

include "view/admin.php"
 ?>