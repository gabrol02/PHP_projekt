<?php 

if (empty($_SESSION['search'])) {
    
    echo"<div id='flex-con' class='flex-container'>";
    echo"<div class='flex-container' id='flex-con'>";
    if ($termekIds) {
        foreach($termekIds as $termekId) {
        $sql="SELECT termekek_id FROM termek WHERE termekek_id=".$termekId." ";
        if(!$result = $conn->query($sql)) echo $conn->error;
        if($result->num_rows > 0){
            
                $termek->set_termek($termekId,$conn);
                echo '<span > Termék: '.$termek->get_termek_nev().'  Ár/kg: '.$termek->get_termek_ar().'</span>';
                echo '<form action="index.php?page=index" method="POST">
                        <input type="hidden" value="'.$termekId.'" name="selected_termek_id">
                        <input type="text" name="mennyiseg" required> 
                        <input type="submit" name="addkosar"  value="Kosárba"  id="submit">
                      </form>';
         } 
        }
    }


echo"</div>";
    echo"</div>";
}else{
    
    
    echo "Erre gondolt:<br><ul id='pilos'> ";
            echo"<div class='flex-container' id='flex-con'>";
                    $stmt=mysqli_prepare($conn,"SELECT termekek_id,termek_nev,termek_ar FROM termek WHERE termek_nev LIKE ?");
                    if(isset($_REQUEST['searched'])){
                    $stmt->bind_param('s', $nev); 
                    $nev = "%".$_REQUEST['searched']."%";
                    $stmt->execute();
                        if($result = $stmt->get_result()){
                        if ($result->num_rows > 0 ){
                            while($row = $result->fetch_assoc()){
                        echo '<div class="keret"><span > Termék: '.$row["termek_nev"].'  Ár/kg: '.$row["termek_ar"].'</span>';
                        echo '<form action="index.php?page=index" method="POST">
                                <input type="hidden" value="'.$row["termekek_id"].'" name="selected_termek_id">
                                <input type="text" name="mennyiseg" required> 
                                <input type="submit" name="addkosar"  value="Kosárba"  id="submit">
                            </form></div>';
                        }
                } else echo $_REQUEST['searched']." termék nem létezik.<br>";
                }else echo "Ehhez hasonló név nem szerepel az adatbazisban";   
            }
        echo"</div>";
        }



    
        

    

?>