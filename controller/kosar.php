<?php 
if (empty($_SESSION['felhasznalo_id'])) {
    header('Location: index.php?page=index');
}

if (isset($_SESSION['kosarid'])) {

             $sql="DELETE FROM kosar WHERE kosar_id='".$_SESSION['kosarid']."' and felhasznalo_id=".$_SESSION['felhasznalo_id']."";
             if($conn->query($sql) === TRUE) {
                $deleteKosarError="Sikeres kosar törlés!<br>";
                
          } else {
            $deleteKosarError="Error: " . $sql . "<br>" . $conn->error;
          }
        
}

if (isset($_SESSION['modositid']) and isset($_POST['mennyiseg']) ) {
    $sql="UPDATE kosar
    SET mennyiseg = ".$_POST['mennyiseg']."
    WHERE kosar_id = ".$_SESSION['modositid']."";
    if($conn->query($sql) === TRUE) {
       $deleteKosarError="Sikeres kosar modosítás!<br>";
       
 } else {
   $deleteKosarError="Error: " . $sql . "<br>" . $conn->error;
 }
}
if (isset($_POST['veglegesit'])) {
  echo 'Gombnyomás <br>';
  
      $sql = "SELECT felhasznalo_id,termek_id,mennyiseg FROM kosar WHERE felhasznalo_id = '".$_SESSION['felhasznalo_id']."'";
      if(!$result = $conn->query($sql)) echo $conn->error;
      if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
                $sql="INSERT INTO tranzakcio(felhasznalo_id,termek_id,mennyiseg,vasralas_ido)
                VALUES('".$row['felhasznalo_id']."','".$row['termek_id']."','".$row['mennyiseg']."','".date("Y-m-d H:i:s")."')";
                if($conn->query($sql) === TRUE) {
                  $sql="DELETE FROM kosar Where felhasznalo_id=".$_SESSION['felhasznalo_id']."";
                  if($conn->query($sql) === TRUE) {
                   
                    
                } else {
                 
                    
                }
              } else {
                
                  
              }
                
            
        }
        }
      }
    
  



include "view/kosar.php"
?>