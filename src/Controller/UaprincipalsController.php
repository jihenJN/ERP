<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Uaprincipals Controller
 *
 * @property \App\Model\Table\UaprincipalsTable $Uaprincipals
 * @method \App\Model\Entity\Uaprincipal[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UaprincipalsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Unites'],
        ];
        $uaprincipals = $this->paginate($this->Uaprincipals);

        $this->set(compact('uaprincipals'));
    }

    /**
     * View method
     *
     * @param string|null $id Uaprincipal id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $uaprincipal = $this->Uaprincipals->get($id, [
            'contain' => ['Unites'],
        ]);

        $this->set(compact('uaprincipal'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $uaprincipal = $this->Uaprincipals->newEmptyEntity();
        if ($this->request->is('post')) {
            $uaprincipal = $this->Uaprincipals->patchEntity($uaprincipal, $this->request->getData());
            if ($this->Uaprincipals->save($uaprincipal)) {
                $this->Flash->success(__('The {0} has been saved.', 'Uaprincipal'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Uaprincipal'));
        }
        $unites = $this->Uaprincipals->Unites->find('list', ['limit' => 200]);
        $this->set(compact('uaprincipal', 'unites'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Uaprincipal id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $uaprincipal = $this->Uaprincipals->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $uaprincipal = $this->Uaprincipals->patchEntity($uaprincipal, $this->request->getData());
            if ($this->Uaprincipals->save($uaprincipal)) {
                $this->Flash->success(__('The {0} has been saved.', 'Uaprincipal'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Uaprincipal'));
        }
        $unites = $this->Uaprincipals->Unites->find('list', ['limit' => 200]);
        $this->set(compact('uaprincipal', 'unites'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Uaprincipal id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $uaprincipal = $this->Uaprincipals->get($id);
        if ($this->Uaprincipals->delete($uaprincipal)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Uaprincipal'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Uaprincipal'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
