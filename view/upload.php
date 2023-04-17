


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
<h2>Kép feltöltése:</h2>
    <form action="index.php?page=upload" method="POST" enctype="multipart/form-data">
        Tallózás:
        <input type="file" name="fileToUpload[]" id="fileToUpload"  multiple>
        <br><br>
        
        <label >Kategória:</label>
            <select name="cat" id="cat" required>  
                <option disabled selected value="defaultcategory">Válasszon kategóriát!</option>
                <?php 
                $sql="SELECT cat_id,category FROM cat";
                if(!$result = $conn->query($sql)) echo $conn->error;
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()) {
                        if($row['category']!="Profilkep"){
                            echo"<option value=".$row['cat_id'].">".$row['category']."</option>";
                        }
                    }
                }
                ?>
            </select>
        
        <input type="submit" name="submit" id="submit">
        
        </form>
            </div>
        
