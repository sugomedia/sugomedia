<h3>Vásárlók kezelése</h3>
<hr>
<?php
	$db->query("SELECT * FROM vasarlok");
	$db->toTable('i|s');
?>