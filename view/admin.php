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
        <h2>Új kategória hozzáadása:</h2>
        <input type="text" placeholder="Új kategória" name="addcatname">
            <input type="submit" name="addcat"  value="Kategória hozzáadása"  id="submit">
        </form>

        <form action="index.php?page=admin" method="POST">
        <h2>Kategória törlése:</h2>
            <select name="delcat" id="cat" required>
            <option disabled selected value="defaultvalue">Válasszon kategóriát!</option>
               <?php 
                $sql="SELECT cat_id,category FROM cat";
                if(!$rs = $conn->query($sql)) echo $conn->error;
                if($rs->num_rows > 0){
                    while($row = $rs->fetch_assoc()) {
                        if($row['category']!="Profilkep"){
                            echo" <option name='futcat' value=".$row['cat_id']." >".$row['category']."</option>";
                        }
                        
                    }
                }
                ?>
                
            </select>
            <input type="submit" name="delcategory" value="Kategória törlése"id="submit">
        </form>
            </div>

<div class="middle">
<form action="index.php?page=admin" method="POST">
        <h2>Admin hozzáadása:</h2>
            <select name="addadminname" id="cat" required>
            <option disabled selected value="defaultvalue">Válasszon felhasználót!</option>
               <?php 
                $sql="SELECT username,users_id FROM users  where users_id not in (SELECT users_id from admins)";
                if(!$rs = $conn->query($sql)) echo $conn->error;
                if($rs->num_rows > 0){
                    while($row = $rs->fetch_assoc()) {
                        
                            echo" <option  value=".$row['users_id']." >".$row['username']."</option>";
                        
                        
                    }
                }
                ?>
                
            </select>
            <input type="submit" name="adminadd" value="Admin hozzáadása" id="submit">
        </form>
<?php 
$sql="SELECT users_id from admins where layer=1 and users_id='".$_SESSION['users_id']."'";
if(!$result = $conn->query($sql)) echo $conn->error;
if($result->num_rows > 0){
?>
        <form action="index.php?page=admin" method="POST">
        <h2>Admin törlése:</h2>
            <select name="deladminname" id="cat" required>
            <option disabled selected value="defaultvalue">Válasszon felhasználót!</option>
               <?php 
                $sql="SELECT admins.users_id,username,layer FROM admins INNER JOIN users ON users.users_id=admins.users_id where layer='0' and admins.users_id not like ".$_SESSION['users_id'];
                if(!$rs = $conn->query($sql)) echo $conn->error;
                if($rs->num_rows > 0){
                    while($row = $rs->fetch_assoc()) {
                        
                            echo" <option name='futcat' value=".$row['users_id']." >".$row['username']."</option>";
                        
                        
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
