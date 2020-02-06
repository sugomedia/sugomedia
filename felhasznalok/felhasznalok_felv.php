<h3>Felhasználók kezelése</h3>
<hr>
<?php
	if (isset($_POST['felvesz']))
	{
		$nev = escapeshellcmd($_POST['nev']);
		$email = escapeshellcmd($_POST['email']);
		$beosztas = escapeshellcmd($_POST['beosztas']);
		$pass1 = escapeshellcmd($_POST['pass1']);
		$pass2 = escapeshellcmd($_POST['pass2']);
		$pic = $_FILES['pic']['name'];

		if (empty($nev) || empty($email) || empty($pass1) || empty($pass2))
		{
			showError('Hiba! Nem adtál meg minden adatot!');
		}
		else
		{
			if ($pass1 != $pass2)
			{
				showError('Hiba! A megadott jelszavak nem megyeznek!');
			}
			else
			{
				$db->query("SELECT * FROM felhasznalok WHERE email='$email'");
				if ($db->numRows() != 0)
				{
					showError('Hiba! Ez az e-mail cím már regisztrálva van!');
				}
				else
				{
					$jogok = '00000000000000000000';
						for($i=0; $i<11; $i++)
						{
							if (isset($_POST['jog'.$i]))
							{
								$jogok[$i] = '1';
							}
						}
					$pass1 = SHA1($pass1);
					$db->query("INSERT INTO felhasznalok VALUES(null, '$nev', '$email', '$pass1', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 0, '$pic', '$jogok', '$beosztas', 0, 1)");
					header("location: index.php?pg=".$dir);
				}
			}
		}
	}

	echo'
	<form method="POST" action="index.php?pg=felhasznalok_felv" enctype="multipart/form-data">
		<div class="form-group">
			<label>Felhasználónév:</label><em>*</em>
			<input type="text" name="nev" class="form-control">
		</div>
		<div class="form-group">
			<label>E-mail cím:</label><em>*</em>
			<input type="text" name="email" class="form-control">
		</div>
		<div class="form-group">
			<label>Beosztás:</label>
			<input type="text" name="beosztas" class="form-control">
		</div>
		<div class="form-group">
			<label>Jelszó:</label><em>*</em>
			<input type="password" name="pass1" class="form-control">
		</div>
		<div class="form-group">
			<label>Jelszó megerősítése:</label><em>*</em>
			<input type="password" name="pass2" class="form-control">
		</div>
		<div class="form-group">
			<label>Profilkép:</label>
			<input type="file" name="pic" class="form-control">
		</div>
		<div class="form-group">
			<label>Jogosultság:</label>
			<br><input type="checkbox" name="jog0"> Árukészlet kezelés
			<br><input type="checkbox" name="jog1"> Bizonylat kezelés
			<br><input type="checkbox" name="jog2"> Árajánlat kezelés
			<br><input type="checkbox" name="jog3"> Foglalás kezelés
			<br><input type="checkbox" name="jog4"> Munkalap kezelés
			<br><input type="checkbox" name="jog5"> Garancia kezelés
			<br><input type="checkbox" name="jog6"> Vásárló kezelés
			<br><input type="checkbox" name="jog7"> Beszállító kezelés
			<br><input type="checkbox" name="jog8"> Felhasználó kezelés
			<br><input type="checkbox" name="jog9"> Cégadat kezelés
			<br><input type="checkbox" name="jog10"> Statisztika kezelés
		</div>
		<div class="form-group">
			<input type="submit" name="felvesz" value="Rekord felvétele" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>	
	</form>';
?>