<?php

App::uses('AppController', 'Controller');

class ServiceProvidersController extends AppController {

    public function index() {
        $this->layout = false;
        $this->set('serviceProviders', $this->ServiceProvider->find('all'));
    }

public function create() {
        $this->layout = false;
        
        if ($this->request->is('post')) {
            $this->ServiceProvider->create();
            
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
                    $this->request->data['ServiceProvider']['photo'] = null;
                }
            } else {
                $this->request->data['ServiceProvider']['photo'] = null;
            }
            
            if ($this->ServiceProvider->save($this->request->data)) {
                $this->Flash->success('Prestador cadastrado com sucesso!');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error('Erro ao cadastrar. Verifique os dados.');
        }

        $services = $this->ServiceProvider->Service->find('list');
        $this->set(compact('services'));
    }

    public function edit($id = null) {
        $this->ServiceProvider->id = $id;
        if (!$this->ServiceProvider->exists()) {
            throw new NotFoundException('Prestador não encontrado');
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->ServiceProvider->save($this->request->data)) {
                $this->Flash->success('Prestador atualizado com sucesso!');
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error('Erro ao atualizar. Verifique os dados.');
        } else {
            $this->request->data = $this->ServiceProvider->findById($id);
        }
        $services = $this->ServiceProvider->Service->find('list');
        $this->set(compact('services'));
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