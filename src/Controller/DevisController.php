<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Devis Controller
 *
 * @property \App\Model\Table\DevisTable $Devis
 * @method \App\Model\Entity\Devi[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DevisController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $devis = $this->paginate($this->Devis);

        $this->set(compact('devis'));
    }

    /**
     * View method
     *
     * @param string|null $id Devi id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $devi = $this->Devis->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set(compact('devi'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $devi = $this->Devis->newEmptyEntity();
        if ($this->request->is('post')) {
            $devi = $this->Devis->patchEntity($devi, $this->request->getData());
            if ($this->Devis->save($devi)) {
                $this->Flash->success(__('The devi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The devi could not be saved. Please, try again.'));
        }
        $clients = $this->Devis->Clients->find('list', ['limit' => 200])->all();
        $this->set(compact('devi', 'clients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Devi id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $devi = $this->Devis->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $devi = $this->Devis->patchEntity($devi, $this->request->getData());
            if ($this->Devis->save($devi)) {
                $this->Flash->success(__('The devi has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The devi could not be saved. Please, try again.'));
        }
        $clients = $this->Devis->Clients->find('list', ['limit' => 200])->all();
        $this->set(compact('devi', 'clients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Devi id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $devi = $this->Devis->get($id);
        if ($this->Devis->delete($devi)) {
            $this->Flash->success(__('The devi has been deleted.'));
        } else {
            $this->Flash->error(__('The devi could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
