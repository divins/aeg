<?php
class Motor extends AppModel {
	var $name = 'Motor';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $actsAs = array('Containable');
	
	var $belongsTo = array(
		'Serie' => array(
			'className' => 'Serie',
			'foreignKey' => 'serie_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Part' => array(
			'className' => 'Part',
			'joinTable' => 'motors_parts',
			'foreignKey' => 'motor_id',
			'associationForeignKey' => 'part_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		),
		'Planol' => array(
			'className' => 'Planol',
			'joinTable' => 'motors_planols',
			'foreignKey' => 'motor_id',
			'associationForeignKey' => 'planol_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>