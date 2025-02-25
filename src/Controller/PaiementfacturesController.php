<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Paiementfactures Controller
 *
 * @property \App\Model\Table\PaiementfacturesTable $Paiementfactures
 * @method \App\Model\Entity\Paiementfacture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PaiementfacturesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Factures', 'Paiements'],
        ];
        $paiementfactures = $this->paginate($this->Paiementfactures);

        $this->set(compact('paiementfactures'));
    }

    /**
     * View method
     *
     * @param string|null $id Paiementfacture id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paiementfacture = $this->Paiementfactures->get($id, [
            'contain' => ['Factures', 'Paiements'],
        ]);

        $this->set(compact('paiementfacture'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paiementfacture = $this->Paiementfactures->newEmptyEntity();
        if ($this->request->is('post')) {
            $paiementfacture = $this->Paiementfactures->patchEntity($paiementfacture, $this->request->getData());
            if ($this->Paiementfactures->save($paiementfacture)) {
                $this->Flash->success(__('The {0} has been saved.', 'Paiementfacture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Paiementfacture'));
        }
        $factures = $this->Paiementfactures->Factures->find('list', ['limit' => 200]);
        $paiements = $this->Paiementfactures->Paiements->find('list', ['limit' => 200]);
        $this->set(compact('paiementfacture', 'factures', 'paiements'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Paiementfacture id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paiementfacture = $this->Paiementfactures->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paiementfacture = $this->Paiementfactures->patchEntity($paiementfacture, $this->request->getData());
            if ($this->Paiementfactures->save($paiementfacture)) {
                $this->Flash->success(__('The {0} has been saved.', 'Paiementfacture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Paiementfacture'));
        }
        $factures = $this->Paiementfactures->Factures->find('list', ['limit' => 200]);
        $paiements = $this->Paiementfactures->Paiements->find('list', ['limit' => 200]);
        $this->set(compact('paiementfacture', 'factures', 'paiements'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Paiementfacture id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paiementfacture = $this->Paiementfactures->get($id);
        if ($this->Paiementfactures->delete($paiementfacture)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Paiementfacture'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Paiementfacture'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
