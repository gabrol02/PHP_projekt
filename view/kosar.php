<?php
 $sql="SELECT kosar_id FROM kosar WHERE   felhasznalo_id=".$_SESSION['felhasznalo_id']."";
 if(!$result = $conn->query($sql)) echo $conn->error;
 if($result->num_rows > 0){
    echo"<div class='flex-container' id='flex-con'>";
if ($kosarIds) {
   
    foreach($kosarIds as $kosarId) {
    $sql="SELECT kosar_id FROM kosar WHERE kosar_id=".$kosarId."  and felhasznalo_id=".$_SESSION['felhasznalo_id']."";
    
    if(!$result = $conn->query($sql)) echo $conn->error;
    if($result->num_rows > 0){
        foreach($result->fetch_assoc() as $row){
            $kosar->set_kosar($kosarId,$conn);
            $sql="SELECT termek_nev FROM termek INNER JOIN kosar ON termek.termekek_id=kosar.termek_id WHERE termek_id=".$kosar->get_kosar_termek_id()." and kosar_id=".$kosarId." ";
            if(!$rs = $conn->query($sql)) echo $conn->error;
            if($rs->num_rows > 0){
            while($row = $rs->fetch_assoc()){
            echo '<div class="keret">
                    <span >Termék: '.$row['termek_nev'].' <br> Mennyiség: '.$kosar->get_kosar_mennyiseg().' </span> 
                    <form action="index.php?page=kosar&modositid='.$kosarId.'" method="POST">
                    <input type="text" name="mennyiseg"  required> <a href="index.php?page=kosar&kosarid='.$kosarId.'">X</a>
                    <input type="submit"  value="Módosít"><br>
                    </form></div>
                    
                    
                    
                    ';
                    

                }
            }
        }
        }
    }
}
echo'</div>';
echo '<div class="middle"><form action="index.php?page=kosar" method="POST"><input type="submit" name="veglegesit" value="Véglegesít"></form></div><br>';
 }else echo 'Üres a kosarad. <a href="index.php?page=index">Irány vásárolni</a>';
    
        
         
    
    


?>
        

