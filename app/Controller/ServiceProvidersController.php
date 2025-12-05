<?php

App::uses('AppController', 'Controller');

class ServiceProvidersController extends AppController {

    public $layout = 'custom';
    public $uses = array('ServiceProvider', 'Service');
    public $components = array('Flash', 'Paginator');

    public $paginate = array(
        'limit' => 10,
        'order' => array(
            'ServiceProvider.first_name' => 'asc'
        )
    );

    public function index() {
        $conditions = array();

        if (!empty($this->request->query['search'])) {
            $search = $this->request->query['search'];
            $conditions['OR'] = array(
                'ServiceProvider.first_name LIKE' => '%' . $search . '%',
                'ServiceProvider.last_name LIKE' => '%' . $search . '%',
                'CONCAT(ServiceProvider.first_name, " ", ServiceProvider.last_name) LIKE' => '%' . $search . '%'
            );
        }

        $this->Paginator->settings = array_merge($this->paginate, array(
            'conditions' => $conditions
        ));
        
        $data = $this->Paginator->paginate('ServiceProvider');
        $this->set('serviceProviders', $data);
        $this->set('search', isset($this->request->query['search']) ? $this->request->query['search'] : '');
    }

    public function create() {
        if ($this->request->is('post')) {
            $this->ServiceProvider->create();
            
            if (!empty($this->request->data['ServiceProvider']['photo']['name'])) {
                $photo = $this->request->data['ServiceProvider']['photo'];
                $filename = $this->request->data['ServiceProvider']['photo']['name'];
                $uploadDir = WWW_ROOT . 'img' . DS . 'uploads' . DS;
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                if (move_uploaded_file($photo['tmp_name'], $uploadDir . $filename)) {
                    $this->request->data['ServiceProvider']['photo'] = 'uploads/' . $filename;
                } else {
                    $this->request->data['ServiceProvider']['photo'] = null;
                }
            } else {
                $this->request->data['ServiceProvider']['photo'] = null;
            }
            
            $this->ServiceProvider->set($this->request->data);
            
            if ($this->ServiceProvider->validates()) {
                if ($this->ServiceProvider->save($this->request->data)) {
                    $this->Flash->success('Prestador cadastrado com sucesso!');
                    return $this->redirect(array('action' => 'index'));
                }
            }
        }

        $serviceSuggestions = $this->Service->find('list', array('fields' => array('name', 'name')));
        $this->set(compact('serviceSuggestions'));
    }

    public function view($id = null) {
        $this->ServiceProvider->id = $id;
        if (!$this->ServiceProvider->exists()) {
            throw new NotFoundException('Prestador não encontrado');
        }
        $serviceProvider = $this->ServiceProvider->findById($id);
        $this->set('serviceProvider', $serviceProvider);
    }

    public function edit($id = null) {
        $this->ServiceProvider->id = $id;
        if (!$this->ServiceProvider->exists()) {
            throw new NotFoundException('Prestador não encontrado');
        }

        if ($this->request->is(array('post', 'put'))) {
            if (!empty($this->request->data['ServiceProvider']['photo']['name'])) {
                $photo = $this->request->data['ServiceProvider']['photo'];
                $extension = pathinfo($photo['name'], PATHINFO_EXTENSION);
                $filename = uniqid('photo_') . '.' . $extension;
                $uploadDir = WWW_ROOT . 'img' . DS . 'uploads' . DS;
                
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }
                
                if (move_uploaded_file($photo['tmp_name'], $uploadDir . $filename)) {
                    $this->request->data['ServiceProvider']['photo'] = 'uploads/' . $filename;
                } else {
                    unset($this->request->data['ServiceProvider']['photo']); 
                }
            } else {
                unset($this->request->data['ServiceProvider']['photo']); 
            }

            if ($this->ServiceProvider->save($this->request->data)) {
                $this->Flash->success('Prestador atualizado com sucesso!');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error('Erro ao atualizar. Verifique os dados.');
        } else {
            $this->request->data = $this->ServiceProvider->findById($id);
        }
        
        $serviceSuggestions = $this->Service->find('list', array('fields' => array('name', 'name')));
        $this->set(compact('serviceSuggestions'));
    }

    public function delete($id = null) {
        $this->ServiceProvider->id = $id;
        if (!$this->ServiceProvider->exists()) {
            throw new NotFoundException('Prestador não encontrado');
        }
        if ($this->ServiceProvider->delete()) {
            $this->Flash->success('Prestador removido com sucesso!');
        } else {
            $this->Flash->error('Erro ao remover prestador.');
        }
        return $this->redirect(array('action' => 'index'));
    }
}