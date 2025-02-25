<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Bureaupostes Controller
 *
 * @property \App\Model\Table\BureaupostesTable $Bureaupostes
 * @method \App\Model\Entity\Bureauposte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BureaupostesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Gouvernorats'],
        ];
        $bureaupostes = $this->paginate($this->Bureaupostes);

        $this->set(compact('bureaupostes'));
    }

    /**
     * View method
     *
     * @param string|null $id Bureauposte id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bureauposte = $this->Bureaupostes->get($id, [
            'contain' => ['Gouvernorats', 'Clients'],
        ]);

        $this->set(compact('bureauposte'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bureauposte = $this->Bureaupostes->newEmptyEntity();
        if ($this->request->is('post')) {
            $bureauposte = $this->Bureaupostes->patchEntity($bureauposte, $this->request->getData());
            if ($this->Bureaupostes->save($bureauposte)) {
                $this->Flash->success(__('The bureauposte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bureauposte could not be saved. Please, try again.'));
        }
        $gouvernorats = $this->Bureaupostes->Gouvernorats->find('list', ['limit' => 200])->all();
        $this->set(compact('bureauposte', 'gouvernorats'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bureauposte id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bureauposte = $this->Bureaupostes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bureauposte = $this->Bureaupostes->patchEntity($bureauposte, $this->request->getData());
            if ($this->Bureaupostes->save($bureauposte)) {
                $this->Flash->success(__('The bureauposte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bureauposte could not be saved. Please, try again.'));
        }
        $gouvernorats = $this->Bureaupostes->Gouvernorats->find('list', ['limit' => 200])->all();
        $this->set(compact('bureauposte', 'gouvernorats'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bureauposte id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bureauposte = $this->Bureaupostes->get($id);
        if ($this->Bureaupostes->delete($bureauposte)) {
            $this->Flash->success(__('The bureauposte has been deleted.'));
        } else {
            $this->Flash->error(__('The bureauposte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
