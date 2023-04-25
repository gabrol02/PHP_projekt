
<div id="mySidenav" class="sidenav ">
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>

</div>
 <span style="font-size:30px;cursor:pointer" class="feher" id="oldalsav" onclick="openNav()">☰ <span id="category">Kategóriák</span></span>
<?php 
	echo"<div class='flex-container' id='flex-con'>";
    if ($termekIds) {
        foreach($termekIds as $termekId) {
        $sql="SELECT termekek_id FROM termek WHERE termekek_id=".$termekId." ";
        if(!$result = $conn->query($sql)) echo $conn->error;
        if($result->num_rows > 0){
            
                $termek->set_termek($termekId,$conn);
                echo '<span>'.$termek->get_termek_nev().''.$termek->get_termek_ar().'</span>';
         } 
        }
    }


echo"</div>";

?>

<script>
        function openNav() {
           
                
          document.getElementById("mySidenav").style.width = "200px";
          document.getElementById("oldalsav").style.display="none";
          
            
        }

        function closeNav() {
          document.getElementById("mySidenav").style.width = "0%";
          document.getElementById("oldalsav").style.display="inline";
         
        }
        function favo() {
          document.getElementById("nofav").style.backgroundImage = "url(../pictures/onfav.png)";

          
        }
        function favno() {
          document.getElementById("onfav").style.backgroundImage = "url(../pictures/nofav.png)";
        }
      </script>
      