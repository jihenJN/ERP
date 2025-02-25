<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Clientexonerations Controller
 *
 * @property \App\Model\Table\ClientexonerationsTable $Clientexonerations
 * @method \App\Model\Entity\Clientexoneration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientexonerationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Typeexons', 'Clients'],
        ];
        $clientexonerations = $this->paginate($this->Clientexonerations);

        $this->set(compact('clientexonerations'));
    }

    /**
     * View method
     *
     * @param string|null $id Clientexoneration id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientexoneration = $this->Clientexonerations->get($id, [
            'contain' => ['Typeexons', 'Clients'],
        ]);

        $this->set(compact('clientexoneration'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientexoneration = $this->Clientexonerations->newEmptyEntity();
        if ($this->request->is('post')) {
            $clientexoneration = $this->Clientexonerations->patchEntity($clientexoneration, $this->request->getData());
            if ($this->Clientexonerations->save($clientexoneration)) {
                $this->Flash->success(__('The {0} has been saved.', 'Clientexoneration'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Clientexoneration'));
        }
        $typeexons = $this->Clientexonerations->Typeexons->find('list', ['limit' => 200]);
        $clients = $this->Clientexonerations->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientexoneration', 'typeexons', 'clients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Clientexoneration id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientexoneration = $this->Clientexonerations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientexoneration = $this->Clientexonerations->patchEntity($clientexoneration, $this->request->getData());
            if ($this->Clientexonerations->save($clientexoneration)) {
                $this->Flash->success(__('The {0} has been saved.', 'Clientexoneration'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Clientexoneration'));
        }
        $typeexons = $this->Clientexonerations->Typeexons->find('list', ['limit' => 200]);
        $clients = $this->Clientexonerations->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientexoneration', 'typeexons', 'clients'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Clientexoneration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientexoneration = $this->Clientexonerations->get($id);
        if ($this->Clientexonerations->delete($clientexoneration)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Clientexoneration'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Clientexoneration'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
