<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Clientfourchettes Controller
 *
 * @property \App\Model\Table\ClientfourchettesTable $Clientfourchettes
 * @method \App\Model\Entity\Clientfourchette[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientfourchettesController extends AppController
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
        $clientfourchettes = $this->paginate($this->Clientfourchettes);

        $this->set(compact('clientfourchettes'));
    }

    /**
     * View method
     *
     * @param string|null $id Clientfourchette id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $clientfourchette = $this->Clientfourchettes->get($id, [
            'contain' => ['Clients'],
        ]);

        $this->set(compact('clientfourchette'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $clientfourchette = $this->Clientfourchettes->newEmptyEntity();
        if ($this->request->is('post')) {
            $clientfourchette = $this->Clientfourchettes->patchEntity($clientfourchette, $this->request->getData());
            if ($this->Clientfourchettes->save($clientfourchette)) {
                $this->Flash->success(__('The {0} has been saved.', 'Clientfourchette'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Clientfourchette'));
        }
        $clients = $this->Clientfourchettes->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientfourchette', 'clients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Clientfourchette id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $clientfourchette = $this->Clientfourchettes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $clientfourchette = $this->Clientfourchettes->patchEntity($clientfourchette, $this->request->getData());
            if ($this->Clientfourchettes->save($clientfourchette)) {
                $this->Flash->success(__('The {0} has been saved.', 'Clientfourchette'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Clientfourchette'));
        }
        $clients = $this->Clientfourchettes->Clients->find('list', ['limit' => 200]);
        $this->set(compact('clientfourchette', 'clients'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Clientfourchette id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $clientfourchette = $this->Clientfourchettes->get($id);
        if ($this->Clientfourchettes->delete($clientfourchette)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Clientfourchette'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Clientfourchette'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
