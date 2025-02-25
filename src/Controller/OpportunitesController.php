<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Opportunites Controller
 *
 * @property \App\Model\Table\OpportunitesTable $Opportunites
 * @method \App\Model\Entity\Opportunite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OpportunitesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $opportunites = $this->paginate($this->Opportunites);

        $this->set(compact('opportunites'));
    }

    /**
     * View method
     *
     * @param string|null $id Opportunite id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $opportunite = $this->Opportunites->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('opportunite'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $opportunite = $this->Opportunites->newEmptyEntity();
        if ($this->request->is('post')) {
            $opportunite = $this->Opportunites->patchEntity($opportunite, $this->request->getData());
            if ($this->Opportunites->save($opportunite)) {
                $this->Flash->success(__('The opportunite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The opportunite could not be saved. Please, try again.'));
        }
        $this->set(compact('opportunite'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Opportunite id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $opportunite = $this->Opportunites->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $opportunite = $this->Opportunites->patchEntity($opportunite, $this->request->getData());
            if ($this->Opportunites->save($opportunite)) {
                $this->Flash->success(__('The opportunite has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The opportunite could not be saved. Please, try again.'));
        }
        $this->set(compact('opportunite'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Opportunite id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $opportunite = $this->Opportunites->get($id);
        if ($this->Opportunites->delete($opportunite)) {
            $this->Flash->success(__('The opportunite has been deleted.'));
        } else {
            $this->Flash->error(__('The opportunite could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
