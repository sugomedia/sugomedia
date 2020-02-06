<?php
	$xml = simplexml_load_file('szamla5.xml') or die("Error: Cannot create object");
	
	echo '<table class="table" border="1">	
		<tr>
			<th>Számlaszám:</th>
			<td>'.$xml->fej->szamlaszam.'</td>
		</tr>
		<tr>
			<th>keltdatum:</th>
			<td>'.$xml->fej->keltdatum.'</td>
		</tr>
		<tr>
			<th>teljdatum:</th>
			<td>'.$xml->fej->teljdatum.'</td>
		</tr>
		<tr>
			<th>fizhatdatum:</th>
			<td>'.$xml->fej->fizhatdatum.'</td>
		</tr>
		<tr>
			<th>netto_vegosszeg:</th>
			<td>'.$xml->fej->netto_vegosszeg.'</td>
		</tr>
		<tr>
			<th>brutto_vegosszeg:</th>
			<td>'.$xml->fej->brutto_vegosszeg.'</td>
		</tr>
	</table>
	<br><br>';


	echo '<table class="table" border="1">
	<thead>
		<tr>
			<th>Cikkszam</th>
			<th>Terméknév</th>
			<th>Garanciaidő</th>
			<th>Vonalkód</th>
			<th>Mennyiség</th>
			<th>Ár</th>
			<th>Összár</th>
			<th>Szériaszámok</th>
		</tr>
	</thead>
	<tbody>';
 	foreach ($xml->tetelek->tetel as $value) 
 	{
 		echo '<tr>';
		echo '<td>'.$value->cikkszam.'</td>';
		echo '<td>'.$value->nev.'</td>';
		echo '<td>'.$value->garido.'</td>';
		echo '<td>'.$value->vonalkod.'</td>';
		echo '<td>'.$value->mennyiseg.'</td>';
		echo '<td>'.$value->ar.'</td>';
		echo '<td>'.$value->osszar.'</td>
		<td>';
		foreach ($value->szeriaszamok->szeriaszam as $value2) 
		{
			echo $value2.'<br>';
		}
		echo '</td>
		</tr>';
 	}
 	echo '</tbody>
 	</table>';

?>
