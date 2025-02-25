<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Clientresponsables Controller
 *
 * @property \App\Model\Table\ClientresponsablesTable $Clientresponsables
 * @method \App\Model\Entity\Clientresponsable[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientresponsablesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $clientresponsables = $this->paginate($this->Clientresponsables);

        $this->set(compact('clientresponsables'));
    }

    /**
     * View method
     *
     * @param string|null $id Clientresponsable id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientresponsable = $this->Clientresponsables->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set(compact('clientresponsable'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientresponsable = $this->Clientresponsables->newEmptyEntity();
        if ($this->request->is('post')) {
            $clientresponsable = $this->Clientresponsables->patchEntity($clientresponsable, $this->request->getData());
            if ($this->Clientresponsables->save($clientresponsable)) {
                $this->Flash->success(__('The {0} has been saved.', 'Clientresponsable'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Clientresponsable'));
        }
        $clients = $this->Clientresponsables->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientresponsable', 'clients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Clientresponsable id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientresponsable = $this->Clientresponsables->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientresponsable = $this->Clientresponsables->patchEntity($clientresponsable, $this->request->getData());
            if ($this->Clientresponsables->save($clientresponsable)) {
                $this->Flash->success(__('The {0} has been saved.', 'Clientresponsable'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Clientresponsable'));
        }
        $clients = $this->Clientresponsables->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientresponsable', 'clients'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Clientresponsable id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientresponsable = $this->Clientresponsables->get($id);
        if ($this->Clientresponsables->delete($clientresponsable)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Clientresponsable'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Clientresponsable'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
