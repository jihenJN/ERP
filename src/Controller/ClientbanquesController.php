<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Clientbanques Controller
 *
 * @property \App\Model\Table\ClientbanquesTable $Clientbanques
 * @method \App\Model\Entity\Clientbanque[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientbanquesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Banques', 'Clients'],
        ];
        $clientbanques = $this->paginate($this->Clientbanques);

        $this->set(compact('clientbanques'));
    }

    /**
     * View method
     *
     * @param string|null $id Clientbanque id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientbanque = $this->Clientbanques->get($id, [
            'contain' => ['Banques', 'Clients'],
        ]);

        $this->set(compact('clientbanque'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientbanque = $this->Clientbanques->newEmptyEntity();
        if ($this->request->is('post')) {
            $clientbanque = $this->Clientbanques->patchEntity($clientbanque, $this->request->getData());
            if ($this->Clientbanques->save($clientbanque)) {
                $this->Flash->success(__('The {0} has been saved.', 'Clientbanque'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Clientbanque'));
        }
        $banques = $this->Clientbanques->Banques->find('list', ['limit' => 200]);
        $clients = $this->Clientbanques->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientbanque', 'banques', 'clients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Clientbanque id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientbanque = $this->Clientbanques->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientbanque = $this->Clientbanques->patchEntity($clientbanque, $this->request->getData());
            if ($this->Clientbanques->save($clientbanque)) {
                $this->Flash->success(__('The {0} has been saved.', 'Clientbanque'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Clientbanque'));
        }
        $banques = $this->Clientbanques->Banques->find('list', ['limit' => 200]);
        $clients = $this->Clientbanques->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientbanque', 'banques', 'clients'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Clientbanque id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientbanque = $this->Clientbanques->get($id);
        if ($this->Clientbanques->delete($clientbanque)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Clientbanque'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Clientbanque'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
