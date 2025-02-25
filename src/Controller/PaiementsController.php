<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Paiements Controller
 *
 * @property \App\Model\Table\PaiementsTable $Paiements
 * @method \App\Model\Entity\Paiement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaiementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $name = $this->request->getQuery('name');
        $typepaiement_id = $this->request->getQuery('typepaiement_id');
        $cond1 = '';
        $cond2 = '';
        if ($name) { 
            $cond1 = "Paiements.name like  '%" . $name . "%' ";
        }
        if ($typepaiement_id) {
            $cond2 = "Paiements.typepaiement_id   like  '%" . $typepaiement_id . "%' ";
        }
        $query = $this->Paiements->find('all')->where([$cond1, $cond2]);
        $this->paginate = [
            'contain' => ['Typepaiements'],
        ];
        $paiements = $this->paginate($query);
        // $paiements = $this->paginate($this->Paiements);
        $typepaiements = $this->Paiements->Typepaiements->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('paiements','typepaiements'));
    }

    /**
     * View method
     *
     * @param string|null $id Paiement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paiement = $this->Paiements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paiement = $this->Paiements->patchEntity($paiement, $this->request->getData());
            if ($this->Paiements->save($paiement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Paiement'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Paiement'));
        }
        $typepaiements = $this->Paiements->Typepaiements->find('list', ['limit' => 200]);
        $this->set(compact('paiement', 'typepaiements'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paiement = $this->Paiements->newEmptyEntity();
        if ($this->request->is('post')) {
            $paiement = $this->Paiements->patchEntity($paiement, $this->request->getData());
            if ($this->Paiements->save($paiement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Paiement'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Paiement'));
        }
        $typepaiements = $this->Paiements->Typepaiements->find('list', ['limit' => 200]);
        $this->set(compact('paiement', 'typepaiements'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Paiement id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paiement = $this->Paiements->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paiement = $this->Paiements->patchEntity($paiement, $this->request->getData());
            if ($this->Paiements->save($paiement)) {
                $this->Flash->success(__('The {0} has been saved.', 'Paiement'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Paiement'));
        }
        $typepaiements = $this->Paiements->Typepaiements->find('list', ['limit' => 200]);
        $this->set(compact('paiement', 'typepaiements'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Paiement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paiement = $this->Paiements->get($id);
        if ($this->Paiements->delete($paiement)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Paiement'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Paiement'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
