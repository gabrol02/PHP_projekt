
<?php
$loginError = '';

if(isset($_POST['nev']) and isset($_POST['jelszo'])) {
	$loginError = '';
	if($loginError == '') {
		$sql = "SELECT felhasznalo_id FROM felhasznalo WHERE nev = '".htmlspecialchars(mysqli_real_escape_string($conn,$_POST['nev']))."' ";
		if(!$result = $conn->query($sql)) echo $conn->error;
		if ($result->num_rows > 0) {
			if($row = $result->fetch_assoc()) {
				$tanulo -> set_user($row['felhasznalo_id'], $conn);
				if($_POST['jelszo'] == $tanulo->get_jelszo()) {
					
					$_SESSION['felhasznalo_id'] = $row['felhasznalo_id'];
					$_SESSION['nev'] = $tanulo->get_nev();
					$_SESSION['emailcim'] = $tanulo->get_emailcim();					
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