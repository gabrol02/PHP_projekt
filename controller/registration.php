<?php
$registrationError = '';
if(isset($_POST['nev']) and isset($_POST['jelszo'])and isset($_POST['emailcim'])) {
  
	if(strlen($_POST['nev']) == 0) $registrationError .= "Nem írtál be felhasználónevet<br>";
	if(strlen($_POST['jelszo']) == 0) $registrationError .= "Nem írtál be jelszót<br>";
  if(strlen($_POST['emailcim']) == 0) $registrationError .= "Nem írtál be emailt<br>";
  if(strlen($_POST['iranyitoszam']) == 0) $registrationError .= "Nem írtál be irányítószámot<br>";
  if(strlen($_POST['lakcim']) == 0) $registrationError .= "Nem írtál be lakcímet<br>";
  if($_POST['jelszo']!=$_POST['jelszo1'])$registrationError .= "Nem egyeznek a jelszavak<br>";
  if(strlen($_POST['nev']) >= 20)$registrationError .= "Túl hosszú a név";

	if($registrationError == '') {
    $un = mysqli_query($conn, "SELECT nev FROM felhasznalo WHERE nev = '".$_POST['nev']."'");
    $em = mysqli_query($conn, "SELECT emailcim FROM felhasznalo WHERE emailcim = '".$_POST['emailcim']."'");

    if(mysqli_num_rows($un)) {
        exit('Ez a felhasználónév már létezik.');
    }elseif(mysqli_num_rows($em)){
      exit('Ez az email már regisztrálva van.');
    }else{{
        $sql = "INSERT INTO felhasznalo (nev,jelszo,emailcim,iranyitoszam,lakcim)
        VALUES ('".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['nev']))."','".$_POST['jelszo']."','".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['emailcim']))."','".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['iranyitoszam']))."','".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['lakcim']))."')";  
        if ($conn->query($sql) === TRUE) {
            echo "Sikeres regisztráció ";
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }    
  }
}    
}

  
include 'view/registration.php';

?>