<?php

$racine = dirname(__DIR__);
$paquet = file_get_contents($racine . '/paquet.xml');
$base = file_get_contents($racine . '/base/association_evenements.php');
$admin = file_get_contents($racine . '/association_evenements_administrations.php');
$erreurs = array();
foreach (array('prefix="association_evenements"', 'nom="agenda"', 'nom="saisies"', 'nom="verifier"') as $attendu) {
	if (strpos($paquet, $attendu) === false) $erreurs[] = 'déclaration absente: ' . $attendu;
}
foreach (array('spip_asso_categories_activites', 'spip_asso_activites', 'spip_asso_categories_activites_liens') as $table) {
	if (strpos($base, $table) === false) $erreurs[] = 'table absente: ' . $table;
}
if (strpos($admin, 'sql_drop_table') !== false) $erreurs[] = 'désinstallation destructive';
if (!is_file($racine . '/squelettes/evenement.html')) $erreurs[] = 'page publique événement absente';
if ($erreurs) {
	fwrite(STDERR, implode("\n", $erreurs) . "\n");
	exit(1);
}
echo "OK: structure Association Événements.\n";
