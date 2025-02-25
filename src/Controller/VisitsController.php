<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Visits Controller
 *
 * @property \App\Model\Table\VisitsTable $Visits
 * @method \App\Model\Entity\Visit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VisitsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['TypeContacts', 'Clients', 'Visiteurs'],
        ];
        $visits = $this->paginate($this->Visits);

        $this->set(compact('visits'));
    }

    /**
     * View method
     *
     * @param string|null $id Visit id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $visit = $this->Visits->get($id, [
            'contain' => ['TypeContacts', 'Clients', 'Visiteurs'],
        ]);

        $this->set(compact('visit'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $visit = $this->Visits->newEmptyEntity();
        if ($this->request->is('post')) {
            $visit = $this->Visits->patchEntity($visit, $this->request->getData());
            if ($this->Visits->save($visit)) {
                $this->Flash->success(__('The visit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visit could not be saved. Please, try again.'));
        }
        $typeContacts = $this->Visits->TypeContacts->find('list', ['limit' => 200])->all();
        $clients = $this->Visits->Clients->find('list', ['limit' => 200])->all();
        $visiteurs = $this->Visits->Visiteurs->find('list', ['limit' => 200])->all();
        $this->set(compact('visit', 'typeContacts', 'clients', 'visiteurs'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Visit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $visit = $this->Visits->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $visit = $this->Visits->patchEntity($visit, $this->request->getData());
            if ($this->Visits->save($visit)) {
                $this->Flash->success(__('The visit has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The visit could not be saved. Please, try again.'));
        }
        $typeContacts = $this->Visits->TypeContacts->find('list', ['limit' => 200])->all();
        $clients = $this->Visits->Clients->find('list', ['limit' => 200])->all();
        $visiteurs = $this->Visits->Visiteurs->find('list', ['limit' => 200])->all();
        $this->set(compact('visit', 'typeContacts', 'clients', 'visiteurs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Visit id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $visit = $this->Visits->get($id);
        if ($this->Visits->delete($visit)) {
            $this->Flash->success(__('The visit has been deleted.'));
        } else {
            $this->Flash->error(__('The visit could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
