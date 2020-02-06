<h3>Beszállítók kezelése</h3>
<hr>
<?php
	if (isset($_POST['felvesz']))
	{
		$nev = escapeshellcmd($_POST['nev']);
		$email = escapeshellcmd($_POST['email']);
		$tel = escapeshellcmd($_POST['tel']);
		$ado = escapeshellcmd($_POST['ado']);
		$bank = escapeshellcmd($_POST['bank']);
		$kapcsnev = escapeshellcmd($_POST['kapcsnev']);
		$cim = escapeshellcmd($_POST['cim']);
		$megjegyzes = escapeshellcmd($_POST['megjegyzes']);

		if (empty($nev) || empty($email) || empty($tel) || empty($cim) || empty($kapcsnev))
		{
			showError('Hiba! Nem adtál meg minden kötelező adatot!');
		}
		else
		{
			$db->query("SELECT * FROM beszallitok WHERE nev='$nev'");
			if ($db->numRows() != 0)
			{
				showError('Hiba! Ez a beszállító már regisztrálva van!');
			}
			else
			{
				
				$db->query("INSERT INTO beszallitok VALUES(null, '$nev', '$cim', '$kapcsnev', '$email', '$tel','$ado','bank','$megjegyzes')");
				header("location: index.php?pg=".$dir);
			}
			
		}
	}

	echo'
	<form method="POST" action="index.php?pg=beszallitok_felv">
		<div class="form-group">
			<label>Cégnév:</label><em>*</em>
			<input type="text" name="nev" class="form-control">
		</div>
		<div class="form-group">
			<label>Postacím:</label><em>*</em>
			<input type="text" name="cim" class="form-control">
		</div>
		<div class="form-group">
			<label>E-mail cím:</label><em>*</em>
			<input type="text" name="email" class="form-control">
		</div>
		<div class="form-group">
			<label>Telefonszám:</label><em>*</em>
			<input type="text" name="tel" class="form-control">
		</div>
		<div class="form-group">
			<label>Adószám:</label>
			<input type="text" name="ado" class="form-control">
		</div>
		<div class="form-group">
			<label>Bankszámlaszám:</label>
			<input type="text" name="bank" class="form-control">
		</div>
		<div class="form-group">
			<label>Kapcsolattartó neve:</label><em>*</em>
			<input type="text" name="kapcsnev" class="form-control">
		</div>
		<div class="form-group">
			<label>Megjegyzés:</label>
			<textarea name="megjegyzes" class="form-control"></textarea>
		</div>		
		<div class="form-group">
			<input type="submit" name="felvesz" value="Rekord felvétele" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához</a>
		</div>	
	</form>';
?>