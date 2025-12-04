<?php

App::uses('AppModel', 'Model');

class ServiceProvider extends AppModel {
    
    public $belongsTo = array(
        'Service' => array(
            'className' => 'Service',
            'foreignKey' => 'service_id',
        )
    );

    public $validate = array(
        'first_name' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Nome é obrigatório'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Nome não deve ultrapassar 100 caracteres'
            )
        ),
        'last_name' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Sobrenome é obrigatório'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'Sobrenome não deve ultrapassar 100 caracteres'
            )
        ),
        'email' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Email é obrigatório'
            ),
            'email' => array(
                'rule' => 'email',
                'message' => 'Email inválido'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 100),
                'message' => 'E-mail deve ter no máximo 100 caracteres'
            )
        ),
        'phone' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Telefone é obrigatório'
            ),
            'maxLength' => array(
                'rule' => array('maxLength', 15),
                'message' => 'Telefone deve ter no máximo 15 caracteres'
            )
        ),
        'service_id' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Serviço é obrigatório'
            )
        ),
        'price' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Preço é obrigatório'
            ),
            'numeric' => array(
                'rule' => 'numeric',
                'message' => 'Preço deve ser um número'
            )
        )
    );
}