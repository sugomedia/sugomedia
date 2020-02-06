<h3>Felhasználók kezelése</h3>
<hr>
<?php
	$id = $_GET['id'];

	if (isset($_POST['modosit']))
	{
		$nev = escapeshellcmd($_POST['nev']);
		$email = escapeshellcmd($_POST['email']);
		$beosztas = escapeshellcmd($_POST['beosztas']);
		$pic = $_FILES['pic']['name'];

		if (empty($nev) || empty($email))
		{
			showError('Hiba! Nem adtál meg minden adatot!');
		}
		else
		{
			$db->query("SELECT * FROM felhasznalok WHERE email='$email' AND ID<>".$id);
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
				
				$db->query("UPDATE felhasznalok SET 
					nev='$nev',
					email='$email',
					beosztas='$beosztas',
					jogosultsag='$jogok',
					profilkep='$pic'
					WHERE ID=".$id);
				header("location: index.php?pg=".$dir);
			}
			
		}
	}

	$db->query("SELECT * FROM felhasznalok WHERE ID=".$id);
	$res = $db->fetchAll();

	echo'
	<form method="POST" action="index.php?pg='.$page.'&id='.$id.'" enctype="multipart/form-data">
		<div class="form-group">
			<label>Felhasználónév:</label><em>*</em>
			<input type="text" name="nev" class="form-control" value="'.$res[0]['nev'].'">
		</div>
		<div class="form-group">
			<label>E-mail cím:</label><em>*</em>
			<input type="text" name="email" class="form-control" value="'.$res[0]['email'].'">
		</div>
		<div class="form-group">
			<label>Beosztás:</label>
			<input type="text" name="beosztas" class="form-control" value="'.$res[0]['beosztas'].'">
		</div>
		<div class="form-group">
			<label>Profilkép:</label>
			<input type="file" name="pic" class="form-control">
		</div>
		<div class="form-group">
			<label>Jogosultság:</label>
			<br><input type="checkbox" name="jog0"';
			if ($res[0]['jogosultsag'][0] == '1') echo ' checked';
			echo '> Árukészlet kezelés
			<br><input type="checkbox" name="jog1"';
			if ($res[0]['jogosultsag'][1] == '1') echo ' checked';
			echo '> Bizonylat kezelés
			<br><input type="checkbox" name="jog2"';
			if ($res[0]['jogosultsag'][2] == '1') echo ' checked';
			echo '> Árajánlat kezelés
			<br><input type="checkbox" name="jog3"';
			if ($res[0]['jogosultsag'][3] == '1') echo ' checked';
			echo '> Foglalás kezelés
			<br><input type="checkbox" name="jog4"';
			if ($res[0]['jogosultsag'][4] == '1') echo ' checked';
			echo '> Munkalap kezelés
			<br><input type="checkbox" name="jog5"';
			if ($res[0]['jogosultsag'][5] == '1') echo ' checked';
			echo '> Garancia kezelés
			<br><input type="checkbox" name="jog6"';
			if ($res[0]['jogosultsag'][6] == '1') echo ' checked';
			echo '> Vásárló kezelés
			<br><input type="checkbox" name="jog7"';
			if ($res[0]['jogosultsag'][7] == '1') echo ' checked';
			echo '> Beszállító kezelés
			<br><input type="checkbox" name="jog8"';
			if ($res[0]['jogosultsag'][8] == '1') echo ' checked';
			echo '> Felhasználó kezelés
			<br><input type="checkbox" name="jog9"';
			if ($res[0]['jogosultsag'][9] == '1') echo ' checked';
			echo '> Cégadat kezelés
			<br><input type="checkbox" name="jog10"';
			if ($res[0]['jogosultsag'][10] == '1') echo ' checked';
			echo '> Statisztika kezelés
		</div>
		<div class="form-group">
			<input type="submit" name="modosit" value="Rekord módosítása" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>	
	</form>';
?>