	<?php
		
				
			
				echo'<div class="middle">';
				echo $loginError;
			 echo "<h2>Belépés</h2>";
				?>
		<form action="index.php?page=login" method="post">
			Felhasználónév:<br><input type="text" name="nev">
			<br>
			Jelszó: <br><input type="password" name="jelszo">
			
			<br>
			<a href="index.php?page=registration"> <?php echo"Még nincs felhasználód? Regisztrálj!"?></a>
			<br>
			<br>
			<input type="submit">
			
		</form>
</div>
						
				

        