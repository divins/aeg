<?php
$this->Session->flash('auth');
echo $this->Form->create('Usuario', array('action' => 'acceder'));
echo $this->Form->inputs(array(
	'legend' => __('Acceder', true),
	'username',
	'password'
));
echo $this->Form->end('Acceder');
?>