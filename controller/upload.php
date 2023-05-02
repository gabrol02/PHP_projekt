<?php

if (empty($_SESSION['admin'])) {
    header('Location: index.php?page=index');
}

$deleteAruError="";
$addAruError="";

if(isset($_POST['addaru'])){

    if ( isset($_POST['addaruar']) and isset($_POST['addarukat']) and isset($_POST['addarunev'])) {

        if(!empty($_POST['addarunev'])) {
       $sql = "SELECT termek_nev FROM termek WHERE termek_nev = '".$_POST['addarunev']."'";
       if(!$result = $conn->query($sql)) echo $conn->error;
       if ($result->num_rows > 0) {
           $addAruError="Ilyen áru már létezik";
       }else{
           $sql="INSERT INTO termek(termek_nev,termek_ar,termek_tipus)
           VALUES ('".$_POST['addarunev']."','".$_POST['addaruar']."','".$_POST['addarukat']."')";
           if ($conn->query($sql) === TRUE) {
               $addAruError="Sikeres áru hozzáadás";        
           }else {
               echo"Error: " . $sql . "<br>" . $conn->error;
           }
       }
   }else $addAruError="Nem adtál meg nevet az új árunak.";
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
                   $deleteAruError="Error: " . $sql . "<br>" . $conn->error;
                 }
                }
            }else $deleteAruError="Válassza ki az árut akit törölni akar.";
   }


include "view/upload.php"
?>