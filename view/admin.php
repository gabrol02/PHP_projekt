<?php
echo "<div id='fehel'>";
echo $deleteAdminError;
echo $deleteCategoryError;
echo $addAdminError;
echo $addCategoryError;
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
        

