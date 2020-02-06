<h3>Belépés</h3>
<?php
	if (!isset($_SESSION['uid']))
	{
		if (isset($_POST['reg']))
		{
			header("location: index.php?pg=users_reg");
		}
		if (isset($_POST['belep']))
		{
			$email = escapeshellcmd($_POST['email']);
			$jelszo = escapeshellcmd($_POST['jelszo']);
			// megadtunk-e minden kötelező adatot?
			if (empty($email) || empty($jelszo))
			{
				showError('Hiba! Nem adtál meg minden adatot!');
			}
			else
			{
				$db->query("SELECT * FROM felhasznalok WHERE email='$email'");
				if ($db->numRows() == 0)
				{
					showError('Hiba! Nem regisztrált e-mail cím!');
				}
				else
				{
					$felhasznalo = $db->fetchAll();
					if (SHA1($jelszo) != $felhasznalo[0]['jelszo'])
					{
						showError('Hiba! A megadott jelszó hibás!');
					} 
					else
					{
						if ($felhasznalo[0]['status'] == 0)
						{
							showError('Hiba! Tiltott felhasználó!');
						}
						else
						{
							$_SESSION['uid'] = $felhasznalo[0]['ID'];
							$_SESSION['uname'] = $felhasznalo[0]['nev'];
							$_SESSION['umail'] = $felhasznalo[0]['email'];
							
							$db->query("UPDATE felhasznalok SET utbelep=CURRENT_TIMESTAMP, logincount=logincount+1, allapot=1 WHERE ID=".$_SESSION['uid']);
							
							header("location: index.php");
						}
					}
				}
			}
		}

		echo '
			<form method="POST" action="index.php">
				<div class="form-group">
					<input type="text" name="email" class="form-control" placeholder="E-mail cím">
				</div>
				<div class="form-group">
					<input type="password" name="jelszo" class="form-control" placeholder="Jelszó">
				</div>
				<div class="form-group">
					<input type="submit" name="belep" value="Belépés" class="btn btn-primary">
				<input type="submit" name="reg" value="Regisztráció" class="btn btn-primary">
				</div>
			</form>';
	}
	else
	{
		if (isset($_POST['kilep']))
		{
			$db->query("UPDATE felhasznalok SET allapot=0 WHERE ID=".$_SESSION['uid']);
			unset($_SESSION['uid']);
			unset($_SESSION['uname']);
			unset($_SESSION['umail']);
			header("location: index.php");
		}

		echo '
		<h4>A bejelentkezett felhasznaló:</h4>
		<h4><span class="glyphicon glyphicon-user"></span> '.$_SESSION['uname'].'</h4>
		<form method="POST" action="index.php">
			<div class="form-group">
				<input type="submit" name="kilep" value="Kilépés" class="btn btn-primary">
			</div>
		</form>';
		include("usermenu.php");
	}

?>




