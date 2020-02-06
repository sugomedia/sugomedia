<h3>Cégadatok kezelése</h3>
<hr>
<?php
	if (isset($_POST['modosit']))
	{
		$cegnev = escapeshellcmd($_POST['cegnev']);
		$rovidnev = escapeshellcmd($_POST['rovidnev']);
		$szekhely = escapeshellcmd($_POST['szekhely']);
		$email = escapeshellcmd($_POST['email']);
		$tel = escapeshellcmd($_POST['tel']);
		$ado = escapeshellcmd($_POST['ado']);
		$euado = escapeshellcmd($_POST['euado']);
		$bank = escapeshellcmd($_POST['bank']);
		$cegjszam = escapeshellcmd($_POST['cegjszam']);
		$ceglogo = $_FILES['ceglogo']['name'];

		if (empty($cegnev) || empty($rovidnev) || empty($szekhely) || empty($email) || empty($tel) || empty($ado) || empty($euado) || empty($bank) || empty($cegjszam))
		{
			showError("Nem adtál meg minden adatot!");
		}
		else
		{
			$db->query("UPDATE cegadatok SET 
				cegnev = '$cegnev',
				rovidnev='$rovidnev',
				szekhely='$szekhely',
				email='$email',
				tel='$tel',
				adoszam='$ado',
				eu_adoszam='$euado',
				bankszla='$bank',
				cegjegyzekszam='$cegjszam',
				ceglogo='$ceglogo'
				WHERE ID=1");
			showSuccess("A módosítás sikeres!");

		}

	}
	$db->query("SELECT * FROM cegadatok WHERE ID=1");
	$res = $db->fetchAll();
	echo '<form method="POST" action="index.php?pg='.$page.'" enctype="multipart/form-data">
		<div class="form-group">
			<label>Cégnév:</label>
			<input type="text" name="cegnev" class="form-control" value="'.$res[0]['cegnev'].'">
		</div>
		<div class="form-group">
			<label>Rövid név:</label>
			<input type="text" name="rovidnev" class="form-control" value="'.$res[0]['rovidnev'].'">
		</div>
		<div class="form-group">
			<label>Székhely:</label>
			<input type="text" name="szekhely" class="form-control" value="'.$res[0]['szekhely'].'">
		</div>
		<div class="form-group">
			<label>E-mail cím:</label>
			<input type="email" name="email" class="form-control" value="'.$res[0]['email'].'">
		</div>
		<div class="form-group">
			<label>Telefonszám:</label>
			<input type="text" name="tel" class="form-control" value="'.$res[0]['tel'].'">
		</div>
		<div class="form-group">
			<label>Adószám:</label>
			<input type="text" name="ado" class="form-control" value="'.$res[0]['adoszam'].'">
		</div>
		<div class="form-group">
			<label>EU adószám:</label>
			<input type="text" name="euado" class="form-control" value="'.$res[0]['eu_adoszam'].'">
		</div>
		<div class="form-group">
			<label>Bankszámlaszám:</label>
			<input type="text" name="bank" class="form-control" value="'.$res[0]['bankszla'].'">
		</div>
		<div class="form-group">
			<label>Cégjegyzékszám:</label>
			<input type="text" name="cegjszam" class="form-control" value="'.$res[0]['cegjegyzekszam'].'">
		</div>
		<div class="form-group">
			<label>Céglogó:</label>';
			if (empty($res[0]['ceglogo']))
			{
				echo '<input type="file" name="ceglogo" class="form-control">';
			}
			else
			{
				echo '<input type="text" name="ceglogo" class="form-control" disabled value="'.$res[0]['ceglogo'].'"><a href="index.php?pg=logodel" class="btn btn-default">X</a>';
			}
			echo'
		</div>
		<div class="form-group">
			<input type="submit" name="modosit" class="btn btn-primary" value="Módosítás">
		</div>
	</form>';
?>

