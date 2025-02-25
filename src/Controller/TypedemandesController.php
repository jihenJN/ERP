<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typedemandes Controller
 *
 * @property \App\Model\Table\TypedemandesTable $Typedemandes
 * @method \App\Model\Entity\Typedemande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypedemandesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typedemandes = $this->paginate($this->Typedemandes);

        $this->set(compact('typedemandes'));
    }

    /**
     * View method
     *
     * @param string|null $id Typedemande id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typedemande = $this->Typedemandes->get($id, [
            'contain' => ['Demandeclients'],
        ]);

        $this->set(compact('typedemande'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typedemande = $this->Typedemandes->newEmptyEntity();
        if ($this->request->is('post')) {
            $typedemande = $this->Typedemandes->patchEntity($typedemande, $this->request->getData());
            if ($this->Typedemandes->save($typedemande)) {
                $this->Flash->success(__('The typedemande has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The typedemande could not be saved. Please, try again.'));
        }
        $this->set(compact('typedemande'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Typedemande id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typedemande = $this->Typedemandes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typedemande = $this->Typedemandes->patchEntity($typedemande, $this->request->getData());
            if ($this->Typedemandes->save($typedemande)) {
                $this->Flash->success(__('The typedemande has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The typedemande could not be saved. Please, try again.'));
        }
        $this->set(compact('typedemande'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Typedemande id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typedemande = $this->Typedemandes->get($id);
        if ($this->Typedemandes->delete($typedemande)) {
            $this->Flash->success(__('The typedemande has been deleted.'));
        } else {
            $this->Flash->error(__('The typedemande could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
