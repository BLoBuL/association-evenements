<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function association_evenements_upgrade($nom_meta_base_version, $version_cible) {
	include_spip('base/upgrade');
	$maj = array(
		'create' => array(
			array('maj_tables', array(
				'spip_asso_categories_activites',
				'spip_asso_activites',
				'spip_asso_categories_activites_liens',
			)),
		),
	);
	maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

function association_evenements_vider_tables($nom_meta_base_version) {
	effacer_meta($nom_meta_base_version);
}
