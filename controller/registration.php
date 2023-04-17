<?php
$registrationError = '';
	if($registrationError == '' && isset($_POST['submit'])) {
    
    $un = mysqli_query($conn, "SELECT nev FROM felhasznalo WHERE nev = '".isset($_POST['nev'])."'");
    $em = mysqli_query($conn, "SELECT emailcim FROM felhasznalo WHERE emailcim = '".isset($_POST['emailcim']) ."'");

    if(mysqli_num_rows($un)) {
        exit('Ez a felhasználónév már létezik.');
    }elseif(mysqli_num_rows($em)){
      exit('Ez az email már regisztrálva van.');
    }else{
        $sql = "INSERT INTO felhasznalo (nev,jelszo,emailcim,iranyitoszam,lakcim)
        VALUES ('".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['nev']))."','".$_POST['jelszo']."','".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['emailcim']))."','".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['iranyitoszam']))."','".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['lakcim']))."')";
        if ($conn->query($sql) === TRUE) {
            echo "Sikeres regisztráció ";
            header('Location: index.php?page=login');
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }    
  }

  
include 'view/registration.php';

?>