<h1>Novo Prestador de Serviço</h1>

<?php

// echo $this->Flash->render();

echo $this->Form->create('ServiceProvider', array('type' => 'file'));

echo $this->Form->input('first_name', array(
    'label' => 'Nome'));
echo $this->Form->input('last_name', array(
    'label' => 'Sobrenome'));
echo $this->Form->input('email', array(
    'label' => 'E-mail'));
echo $this->Form->input('phone', array(
    'label' => 'Telefone'));
echo $this->Form->input('photo', array(
    'type' => 'file',
    'label' => 'Foto'
));
echo $this->Form->input('service_id', array(
    'type' => 'select',
    'label' => 'Serviço',
    'options' => $services,
    'empty' => 'Selecione um serviço'
));

echo $this->Form->input('price', array(
    'label' => 'Preço'));

echo $this->Form->end('Cadastrar');
?>