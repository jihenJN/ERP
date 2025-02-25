<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Compterendus Controller
 *
 * @property \App\Model\Table\CompterendusTable $Compterendus
 * @method \App\Model\Entity\Compterendus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CompterendusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $compterendus = $this->paginate($this->Compterendus);

        $this->set(compact('compterendus'));
    }

    /**
     * View method
     *
     * @param string|null $id Compterendus id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $compterendus = $this->Compterendus->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('compterendus'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $compterendus = $this->Compterendus->newEmptyEntity();
        if ($this->request->is('post')) {
            $compterendus = $this->Compterendus->patchEntity($compterendus, $this->request->getData());
            if ($this->Compterendus->save($compterendus)) {
                $this->Flash->success(__('The compterendus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The compterendus could not be saved. Please, try again.'));
        }
        $this->set(compact('compterendus'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Compterendus id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $compterendus = $this->Compterendus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $compterendus = $this->Compterendus->patchEntity($compterendus, $this->request->getData());
            if ($this->Compterendus->save($compterendus)) {
                $this->Flash->success(__('The compterendus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The compterendus could not be saved. Please, try again.'));
        }
        $this->set(compact('compterendus'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Compterendus id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $compterendus = $this->Compterendus->get($id);
        if ($this->Compterendus->delete($compterendus)) {
            $this->Flash->success(__('The compterendus has been deleted.'));
        } else {
            $this->Flash->error(__('The compterendus could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
