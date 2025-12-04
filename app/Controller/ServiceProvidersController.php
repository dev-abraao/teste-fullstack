<?php

App::uses('AppController', 'Controller');

class ServiceProvidersController extends AppController {

    public function index() {
        $this->layout = false;
        $this->set('serviceProviders', $this->ServiceProvider->find('all'));
    }

}