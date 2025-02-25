<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Typeexonerations Controller
 *
 * @property \App\Model\Table\TypeexonerationsTable $Typeexonerations
 * @method \App\Model\Entity\Typeexoneration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeexonerationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typeexonerations = $this->paginate($this->Typeexonerations);

        $this->set(compact('typeexonerations'));
    }

    /**
     * View method
     *
     * @param string|null $id Typeexoneration id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeexoneration = $this->Typeexonerations->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set(compact('typeexoneration'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeexoneration = $this->Typeexonerations->newEmptyEntity();
        if ($this->request->is('post')) {
            $typeexoneration = $this->Typeexonerations->patchEntity($typeexoneration, $this->request->getData());
            if ($this->Typeexonerations->save($typeexoneration)) {
                $this->Flash->success(__('The typeexoneration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The typeexoneration could not be saved. Please, try again.'));
        }
        $this->set(compact('typeexoneration'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Typeexoneration id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $typeexoneration = $this->Typeexonerations->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeexoneration = $this->Typeexonerations->patchEntity($typeexoneration, $this->request->getData());
            if ($this->Typeexonerations->save($typeexoneration)) {
                $this->Flash->success(__('The typeexoneration has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The typeexoneration could not be saved. Please, try again.'));
        }
        $this->set(compact('typeexoneration'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Typeexoneration id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $typeexoneration = $this->Typeexonerations->get($id);
        if ($this->Typeexonerations->delete($typeexoneration)) {
            $this->Flash->success(__('The typeexoneration has been deleted.'));
        } else {
            $this->Flash->error(__('The typeexoneration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
