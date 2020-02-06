
<div id="grafikon"></div>

<?php

	$db->query("
		SELECT 
		datum, 
		ar 
		FROM termekarvaltozasok
		WHERE cikkszam =". $id."
		GROUP BY datum");

	$db->toChart('line', 'Árváltozás', 'datum', 'ar', 'grafikon', 'light1', 'true');

?>