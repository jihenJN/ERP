<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typepaiements Controller
 *
 * @property \App\Model\Table\TypepaiementsTable $Typepaiements
 * @method \App\Model\Entity\Typepaiement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypepaiementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typepaiements = $this->paginate($this->Typepaiements);

        $this->set(compact('typepaiements'));
    }

    /**
     * View method
     *
     * @param string|null $id Typepaiement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typepaiement = $this->Typepaiements->get($id, [
            'contain' => ['Paiements'],
        ]);

        $this->set(compact('typepaiement'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typepaiement = $this->Typepaiements->newEmptyEntity();
        if ($this->request->is('post')) {
            $typepaiement = $this->Typepaiements->patchEntity($typepaiement, $this->request->getData());
            if ($this->Typepaiements->save($typepaiement)) {
                $this->Flash->success(__('The typepaiement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The typepaiement could not be saved. Please, try again.'));
        }
        $this->set(compact('typepaiement'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Typepaiement id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typepaiement = $this->Typepaiements->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typepaiement = $this->Typepaiements->patchEntity($typepaiement, $this->request->getData());
            if ($this->Typepaiements->save($typepaiement)) {
                $this->Flash->success(__('The typepaiement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The typepaiement could not be saved. Please, try again.'));
        }
        $this->set(compact('typepaiement'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Typepaiement id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typepaiement = $this->Typepaiements->get($id);
        if ($this->Typepaiements->delete($typepaiement)) {
            $this->Flash->success(__('The typepaiement has been deleted.'));
        } else {
            $this->Flash->error(__('The typepaiement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
