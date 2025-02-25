<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Ligneexcs Controller
 *
 * @property \App\Model\Table\LigneexcsTable $Ligneexcs
 * @method \App\Model\Entity\Ligneexc[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LigneexcsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $ligneexcs = $this->paginate($this->Ligneexcs);

        $this->set(compact('ligneexcs'));
    }

    /**
     * View method
     *
     * @param string|null $id Ligneexc id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ligneexc = $this->Ligneexcs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('ligneexc'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ligneexc = $this->Ligneexcs->newEmptyEntity();
        if ($this->request->is('post')) {
            $ligneexc = $this->Ligneexcs->patchEntity($ligneexc, $this->request->getData());
            if ($this->Ligneexcs->save($ligneexc)) {
                $this->Flash->success(__('The ligneexc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ligneexc could not be saved. Please, try again.'));
        }
        $this->set(compact('ligneexc'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Ligneexc id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $ligneexc = $this->Ligneexcs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ligneexc = $this->Ligneexcs->patchEntity($ligneexc, $this->request->getData());
            if ($this->Ligneexcs->save($ligneexc)) {
                $this->Flash->success(__('The ligneexc has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ligneexc could not be saved. Please, try again.'));
        }
        $this->set(compact('ligneexc'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Ligneexc id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ligneexc = $this->Ligneexcs->get($id);
        if ($this->Ligneexcs->delete($ligneexc)) {
            $this->Flash->success(__('The ligneexc has been deleted.'));
        } else {
            $this->Flash->error(__('The ligneexc could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
