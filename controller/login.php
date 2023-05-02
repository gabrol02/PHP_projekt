
<?php
$loginError = '';

if(isset($_POST['nev']) and isset($_POST['jelszo'])) {
	$loginError = '';
	if($loginError == '') {
		$sql = "SELECT felhasznalo_id FROM felhasznalo WHERE nev = '".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['nev']))."' ";
		if(!$result = $conn->query($sql)) echo $conn->error;
		if ($result->num_rows > 0) {
			if($row = $result->fetch_assoc()) {
				$felhasznalo -> set_user($row['felhasznalo_id'], $conn);
				if($_POST['jelszo'] == $felhasznalo->get_jelszo()) {
					
					$_SESSION['felhasznalo_id'] = $row['felhasznalo_id'];
					$_SESSION['nev'] = $felhasznalo->get_nev();
					$_SESSION['emailcim'] = $felhasznalo->get_emailcim();
					$sql = "SELECT admin_id FROM admin WHERE felhasznalo_id = '".htmlspecialchars(mysqli_real_escape_string($conn,$row['felhasznalo_id']))."' ";
					if(!$result = $conn->query($sql)) echo $conn->error;
					if ($result->num_rows > 0) {
						
					$_SESSION['admin'] = $row['felhasznalo_id'];
					}	
					header('Location: index.php');
                    exit();
				}
				else $loginError .= 'Érvénytelen jelszó<br>';
			}
		}
		else $loginError .= 'Érvénytelen név<br>';
	}
}


include 'view/login.php';



?>