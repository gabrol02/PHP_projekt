<?php
echo "<div id='fehel'>";
echo $deleteAdminError;
echo $addAdminError;
echo "</div>";
?>
<div class="middle">
<form action="index.php?page=admin" method="POST">
        <h2>Admin hozzáadása:</h2>
            <select name="addadminnev" id="cat" required>
            <option disabled selected value="defaultvalue">Válasszon felhasználót!</option>
               <?php 
                $sql="SELECT nev,felhasznalo_id FROM felhasznalo  where felhasznalo_id not in (SELECT felhasznalo_id from admin)";
                if(!$rs = $conn->query($sql)) echo $conn->error;
                if($rs->num_rows > 0){
                    while($row = $rs->fetch_assoc()) {
                        
                            echo" <option  value=".$row['felhasznalo_id']." >".$row['nev']."</option>";
                        
                        
                    }
                }
                ?>
                
            </select>
            <input type="submit" name="adminadd" value="Admin hozzáadása" id="submit">
        </form>
<?php 
$sql="SELECT felhasznalo_id from admin where  felhasznalo_id='".$_SESSION['felhasznalo_id']."'";
if(!$result = $conn->query($sql)) echo $conn->error;
if($result->num_rows > 0){
?>
        <form action="index.php?page=admin" method="POST">
        <h2>Admin törlése:</h2>
            <select name="deladminnev" id="cat" required>
            <option disabled selected value="defaultvalue">Válasszon felhasználót!</option>
               <?php 
                $sql="SELECT admin.felhasznalo_id,nev FROM admin INNER JOIN felhasznalo ON felhasznalo.felhasznalo_id=admin.felhasznalo_id  and admin.felhasznalo_id not like ".$_SESSION['felhasznalo_id'];
                if(!$rs = $conn->query($sql)) echo $conn->error;
                if($rs->num_rows > 0){
                    while($row = $rs->fetch_assoc()) {
                        
                            echo" <option name='futcat' value=".$row['felhasznalo_id']." >".$row['nev']."</option>";
                        
                        
                    }
                }
                ?>
                
            </select>
            <input type="submit" name="deleteadmin" value="Admin törlése"id="submit">
        </form>
            </div>
            <?php
            }
            ?>

<form action="index.php?page=admin" method="POST"> 
            <h2>Típus hozzáadása:</h2>
            <input type="text" placeholder="Típus neve" name="addtipusnev">
            <input type="submit" name="addtipus"  value="Típus hozzáadása"  id="submit">
            </form>
                   <form action="index.php?page=admin" method="POST">
                    <h2>Típus törlése:</h2>
                        <select name="deltipus" required>
                        <option disabled selected value="defaulttipus">Válasszon típust!</option>
                           <?php 
                            $sql="SELECT termek_tipus_id, tipus FROM termek_tipus ";
                           
                            if(!$rs = $conn->query($sql)) echo $conn->error;
                            if($rs->num_rows > 0){
                                while($row = $rs->fetch_assoc()) {
                                        echo" <option name='deltipusnev' value=".$row['termek_tipus_id']." >".$row['tipus']."</option>";
                                }
                            }
                            ?>
                            
                        </select>
                        <input type="submit" name="deletetipus" value="Típus törlése" id="submit">
                    </form>
                 
            

            
        

