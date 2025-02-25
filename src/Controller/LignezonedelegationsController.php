<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignezonedelegations Controller
 *
 * @property \App\Model\Table\LignezonedelegationsTable $Lignezonedelegations
 * @method \App\Model\Entity\Lignezonedelegation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignezonedelegationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Zones'],
        ];
        $lignezonedelegations = $this->paginate($this->Lignezonedelegations);

        $this->set(compact('lignezonedelegations'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignezonedelegation id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignezonedelegation = $this->Lignezonedelegations->get($id, [
            'contain' => ['Zones'],
        ]);

        $this->set(compact('lignezonedelegation'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignezonedelegation = $this->Lignezonedelegations->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignezonedelegation = $this->Lignezonedelegations->patchEntity($lignezonedelegation, $this->request->getData());
            if ($this->Lignezonedelegations->save($lignezonedelegation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignezonedelegation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignezonedelegation'));
        }
        $zones = $this->Lignezonedelegations->Zones->find('list', ['limit' => 200]);
        $this->set(compact('lignezonedelegation', 'zones'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignezonedelegation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignezonedelegation = $this->Lignezonedelegations->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignezonedelegation = $this->Lignezonedelegations->patchEntity($lignezonedelegation, $this->request->getData());
            if ($this->Lignezonedelegations->save($lignezonedelegation)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignezonedelegation'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignezonedelegation'));
        }
        $zones = $this->Lignezonedelegations->Zones->find('list', ['limit' => 200]);
        $this->set(compact('lignezonedelegation', 'zones'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignezonedelegation id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignezonedelegation = $this->Lignezonedelegations->get($id);
        if ($this->Lignezonedelegations->delete($lignezonedelegation)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignezonedelegation'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignezonedelegation'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
