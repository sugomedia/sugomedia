<h3>Compmarket XML import</h3>
<hr>
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
  		echo '<h4>Importált termékek:</h4>';

  		$db->query("SELECT ID FROM bizonylatok WHERE bizonylatszam='".$xml->fej->szamlaszam."'");
  		if ($db->numRows()>0)
  		{
  			showError("Ez a bizonylat már szerepel az adatbázisban!");
  		}
  		else
  		{
  			$db->query("SELECT * FROM beszallitok WHERE nev LIKE '%Compmarket%'");
  			$kibocsato = $db->fetchAll();

  			$db->query("SELECT * FROM cegadatok WHERE ID=1");
  			$vevo = $db->fetchAll();

	  		$db->query("INSERT INTO bizonylatok VALUES(
	  			null, 	
	  			'".$xml->fej->szamlaszam."',
	  			'".$kibocsato[0]['nev']."',
	  			'".$kibocsato[0]['cim']."',
	  			'".$kibocsato[0]['ado']."',
	  			'".$kibocsato[0]['bank']."',
	  			'".$vevo[0]['rovidnev']."', 	
	  			'".$vevo[0]['szekhely']."', 	
	  			'".$vevo[0]['adoszam']."', 	
	  			'".$xml->fej->keltdatum."', 	
	  			'".$xml->fej->teljdatum."', 	
	  			'".$xml->fej->fizhatdatum."', 	
	  			".$xml->fej->netto_vegosszeg.",	
	  			".$xml->fej->brutto_vegosszeg.", 	
	  			".($xml->fej->brutto_vegosszeg - $xml->fej->netto_vegosszeg).", 	
	  			'Átutalás',
	  			'".$penznem."', 	
	  			1, 	
	  			'', 	
	  			'Bejövő számla', 	
	  			1 
	  		)");


	  		foreach ($xml->tetelek->tetel as $value) 
		 	{
		 		$value->cikkszam = $value->cikkszam+100000;

				$db->query("SELECT ID FROM termekek WHERE ID=".$value->cikkszam);

				if ($db->numRows()>0)
				{
					
					$db->query("UPDATE termekek SET menny = menny + ".$value->mennyiseg.", ar=".$value->ar." WHERE ID=".$value->cikkszam);
					echo '<span class="glyphicon glyphicon-refresh"> '.$value->nev.'</span><hr>';
				} 
				else
				{
					$gyartonev = substr($value->nev, 0, strpos($value->nev, ' '));
					$tipus = substr($value->nev, strpos($value->nev, ' ')+1);

					$db->query("SELECT ID FROM gyartok WHERE nev LIKE '".$gyartonev."%'");
					if ($db->numRows() > 0)
					{
						$res = $db->fetchAll();
						$gyartoID = $res[0]['ID'];
					}
					else
					{
						$db->query("INSERT IGNORE INTO gyartok VALUES(null, '$gyartonev')");
						$gyartoID = $db->lastID();
					}
					$sql = '';
			 		$sql .= $value->cikkszam.', ';
			 		$sql .= '0, ';
			 		$sql .= $gyartoID.",";
					$sql .= "'".$value->nev."', ";
					$sql .= "'".$tipus."', ";
					$sql .= intval($value->garido).", ";
					$sql .= "'".$value->vonalkod."', ";
					$sql .= doubleval($value->mennyiseg).", ";
					$sql .= doubleval($value->ar).",";
					$sql .= "'Raktárkészleten',";
					$sql .= "CURRENT_DATE";

					echo '<span class="glyphicon glyphicon-plus"> '.$value->nev.'</span><hr>';

					$db->query("INSERT IGNORE INTO termekek (ID, katID, gyartoID, nev, tipus, garido, vkod, menny, ar, keszlet, beerkezes) VALUES(".$sql.")");

				}
				$db->query("INSERT IGNORE INTO termekarvaltozasok VALUES(null, ".$value->cikkszam.", ".$value->ar.", CURRENT_DATE)");
				$szeriaszamok = '';
				foreach ($value->szeriaszamok->szeriaszam as $value2) 
				{
					$db->query("INSERT IGNORE INTO szeriaszamok VALUES(".$value->cikkszam.",'".$value2."', '".$xml->fej->szamlaszam."', '')");
					$szeriaszamok .= $value2.', ';

				}
				$szeriaszamok = rtrim($szeriaszamok, ',');

				$db->query("INSERT INTO bizonylattetelek VALUES(null,
					'".$xml->fej->szamlaszam."',
					'".$value->nev."',
					".doubleval($value->mennyiseg).",
					".doubleval($value->ar).",
					".$def_afa.", 
					'".$value->cikkszam."',
					'".$szeriaszamok."',
					'',
					'".$def_egys."',
					0,
					''
				)");
		 	}
		 }
	}	
?>