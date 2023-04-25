


<?php
if ($i>0) echo "$i fájl feltöltve" ;
if ($errors) {
    foreach($errors as $error){
        foreach($error as $errorMsg){
            echo"$errorMsg <br>";
        
        }
    }
}
if(isset($_SESSION['success'])){
echo $_SESSION['success'];
}
?>
<div class="middle">
            
            <form action="index.php?page=upload" method="POST"> 
            <h2>Áru hozzáadása:</h2>
            <input type="text" placeholder="Áru neve" name="addarunev"><br>
            <input type="text" placeholder="Áru ára" pattern="[A-Za-z0-9\_\ ]{1,20}"  name="addaruar"><br>
            
            
                <select name="addarukat" id="cat" required>
                <option disabled selected value="defaultvalue">Válasszon árut!</option>
                   <?php 
                    $sql="SELECT termek_tipus_id,tipus FROM termek_tipus";
                    if(!$rs = $conn->query($sql)) echo $conn->error;
                    if($rs->num_rows > 0){
                        while($row = $rs->fetch_assoc()) {
                            
                                echo" <option name='addarukat' value=".$row['termek_tipus_id']." >".$row['tipus']."</option>";
                            
                            
                        }
                    }
                    ?>
                    
                </select>
                
            
                <input type="submit" name="addaru"  value="Áru hozzáadása"  id="submit">
            </form>
    
            <form action="index.php?page=admin" method="POST">
            <h2>Áru törlése:</h2>
                <select name="delarunev" id="cat" required>
                <option disabled selected value="defaultvalue">Válasszon árut!</option>
                   <?php 
                    $sql="SELECT termekek_id,termek_nev FROM termek";
                    if(!$rs = $conn->query($sql)) echo $conn->error;
                    if($rs->num_rows > 0){
                        while($row = $rs->fetch_assoc()) {
                            
                                echo" <option name='futcat' value=".$row['termekek_id']." >".$row['termek_nev']."</option>";
                            
                            
                        }
                    }
                    ?>
                    
                </select>
                <input type="submit" name="delaru" value="Áru törlése" id="submit">
            </form>
                </div>
    
        
