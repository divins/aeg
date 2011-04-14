<?php
class Part extends AppModel {
	var $name = 'Part';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $actsAs = array('Containable');
	
	var $hasAndBelongsToMany = array(
		'Motor' => array(
			'className' => 'Motor',
			'joinTable' => 'motors_parts',
			'foreignKey' => 'part_id',
			'associationForeignKey' => 'motor_id',
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
			'joinTable' => 'parts_planols',
			'foreignKey' => 'part_id',
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
		),
		'Parent' => array(
            'className' => 'Part',
            'jointable' => 'parts_parts',
            'foreignKey' => 'child_id',
            'associationForeignKey' => 'parent_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'unique' =>'',
            'finderQuery' => '',
            'deleteQuery' => '',
        ),
		'Child' => array(
            'className' => 'Part',
            'jointable' => 'parts_parts',
            'foreignKey' => 'parent_id',
            'associationForeignKey' => 'child_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'unique' =>true,
            'finderQuery' => '',
            'deleteQuery' => '',
        )
	);
	/*
	'Part' => array(
			'className' => 'Part',
			'joinTable' => 'parts_parts',
			'foreignKey' => 'part_id',
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
		'Parent' => array(
            'className' => 'Part',
            'jointable' => 'parts_parts',
            'foreignKey' => 'parent_id',
            'associationForeignKey' => 'child_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'unique' =>'',
            'finderQuery' => '',
            'deleteQuery' => '',
        ),
		'Child' => array(
            'className' => 'Part',
            'jointable' => 'parts_parts',
            'foreignKey' => 'child_id',
            'associationForeignKey' => 'parent_id',
            'conditions' => '',
            'order' => '',
            'limit' => '',
            'unique' =>'',
            'finderQuery' => '',
            'deleteQuery' => '',
        ),
		*/
}
?>