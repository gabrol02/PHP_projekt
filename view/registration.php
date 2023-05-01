


<div class="middle">
<form action="index.php?page=registration" method="post" >
	
<?php
	
	
	echo $registrationError;
	echo "<h2>Regisztráció</h2>"
?>
							Név:<br><input type="text" pattern="[A-Za-z0-9\_\ ]{1,20}" name="nev" required>
							<br>
							Jelszó: <br><input type="password" name="jelszo" id="password" required>
							<br>
							Jelszó ismét: <br><input type="password" name="jelszo1" id="password1" required>
							<br>
							E-mail: <br><input type="email" name="emailcim" required>
							<br>
							<span id = "message" > </span>
							iranyitoszam:<br><input type="text" name="iranyitoszam" required>

							<br>
							lakcim:<br><input type="text" pattern="[A-Za-z0-9\_\ ]{1,20}" name="lakcim" required>
							<br>
						<input name="submit"type="submit">
</form>
</div>

	