

<?php 
	echo"<div class='flex-container' id='flex-con'>";
    if ($termekIds) {
        foreach($termekIds as $termekId) {
                $termek->set_termek($termekId,$conn);
                echo '<div class="keret"><span > Termék: '.$termek->get_termek_nev().'  Ár/kg: '.$termek->get_termek_ar().'</span>';
                echo '<form action="index.php?page=index" method="POST">
                        <input type="hidden" value="'.$termekId.'" name="selected_termek_id">
                        <input type="text" name="mennyiseg" required> 
                        <input type="submit" name="addkosar"  value="Kosárba"  id="submit">
                      </form></div>';
         
        }
    }


echo"</div>";

?>

