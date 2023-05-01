<?php

if (isset($_POST['addkosar'])) {
    if (empty($_SESSION['felhasznalo_id'])) {
        header('Location: index.php?page=login');
    }else{
            $sql="INSERT INTO kosar(felhasznalo_id,termek_id,mennyiseg)
            VALUES('".$_SESSION['felhasznalo_id']."','".$_POST['selected_termek_id']."','".$_POST['mennyiseg']."')";
            if($conn->query($sql) === TRUE) {
                $addAdminError="Sikeres admin hozzáadás!<br>";    
            } 
}
}
include 'view/index.php';
?>