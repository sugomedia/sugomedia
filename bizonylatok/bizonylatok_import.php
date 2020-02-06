<h3>Bizonylatok kezelése</h3>
<hr>
<h4>Adatok imortálása a Clear Admin programból</h4>

<?php
	echo '
	<form method="POST" action="index.php?pg='.$page.'" enctype="multipart/form-data">
		<div class="form-group">
			<label>XML fájl:</label>
			<input type="file" name="xmlfile" class="form-control">
		</div>
		<div class="form-group">
			<input type="submit" name="import" value="Importálás" class="btn btn-primary">
			<a href="index.php?pg='.$dir.'" class="btn btn-primary">Vissza a rekordok listájához...</a>
		</div>
	</form>';

	if (isset($_POST['import']))
	{
		$xmlfile = $_FILES['xmlfile']['name'];
		$xml = simplexml_load_file($xmlfile) or die("Hiba az XML fájl beolvasása során!");
		echo '<h4>Importált tételek:</h4>';

		$db->query("SELECT * FROM cegadatok WHERE ID=1");
  		$kibo = $db->fetchAll();
  		
		foreach ($xml->szamla as $bizonylat) 
		{
			
			$db->query("SELECT ID FROM bizonylatok WHERE bizonylatszam='".$bizonylat->fejlec->szlasorszam."'");
	  		if ($db->numRows()>0)
	  		{
	  			showError($bizonylat->fejlec->szlasorszam. " -> Ez a bizonylat már szerepel az adatbázisban!");
	  		}
	  		else
	  		{
	  			switch($bizonylat->fejlec->szlatipus)
	  			{
	  				case 1:{$tipus = 'Kimenő számla';}
	  				case 6:{$tipus = 'Sztornó számla';}
	  			}

				$db->query("INSERT INTO bizonylatok VALUES(
	  			null, 	
	  			'".$bizonylat->fejlec->szlasorszam."',
	  			'".$kibo[0]['rovidnev']."',
	  			'".$kibo[0]['szekhely']."',
	  			'".$kibo[0]['adoszam']."',
	  			'".$kibo[0]['bankszla']."',
	  			'".$bizonylat->vevo->nev."', 	
	  			'".$bizonylat->vevo->cim->iranyitoszam.' '.$bizonylat->vevo->cim->telepules.', '.$bizonylat->vevo->cim->kozterulet_neve."', 	
	  			'".$bizonylat->vevo->adoszam."', 	
	  			'".$bizonylat->fejlec->szladatum."', 	
	  			'".$bizonylat->fejlec->teljdatum."', 	
	  			'".$bizonylat->nem_kotelezo->fiz_hatarido."', 	
	  			".$bizonylat->osszesites->vegosszeg->nettoarossz.",	
	  			".$bizonylat->osszesites->vegosszeg->bruttoarossz.", 	
	  			".$bizonylat->osszesites->vegosszeg->afaertekossz.", 	
	  			'".$bizonylat->nem_kotelezo->fiz_mod."', 
	  			'".$bizonylat->nem_kotelezo->penznem."', 	
	  			2, 	
	  			'', 	
	  			'".$tipus."', 	
	  			1 
	  		)");
				echo '<span class="glyphicon glyphicon-plus"> '.$bizonylat->fejlec->szlasorszam.' - '.$bizonylat->vevo->nev.'</span><ul>';

				foreach ($bizonylat->termek_szolgaltatas_tetelek as $tetel) 
				{
					$db->query("INSERT INTO bizonylattetelek VALUES(null,
						'".$bizonylat->fejlec->szlasorszam."',
						'".$tetel->termeknev."',
						".doubleval($tetel->menny).",
						".doubleval($tetel->nettoegysar).",
						".doubleval((100+$tetel->adokulcs)/100).", 
						'',
						'',
						'',
						'".$tetel->mertekegys."',
						0,
						''
					)");
					echo '<li>'.$tetel->termeknev.'</li>';
				}
				echo '</ul><hr>';
			}
		
		}
		
	}
?>