<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fourchettes Controller
 *
 * @property \App\Model\Table\FourchettesTable $Fourchettes
 * @method \App\Model\Entity\Fourchette[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FourchettesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Clients', 'Fourches', 'Articles'],
        ];
        $fourchettes = $this->paginate($this->Fourchettes);

        $this->set(compact('fourchettes'));
    }

    /**
     * View method
     *
     * @param string|null $id Fourchette id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fourchette = $this->Fourchettes->get($id, [
            'contain' => ['Clients', 'Fourches', 'Articles'],
        ]);

        $this->set(compact('fourchette'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fourchette = $this->Fourchettes->newEmptyEntity();
        if ($this->request->is('post')) {
            $fourchette = $this->Fourchettes->patchEntity($fourchette, $this->request->getData());
            if ($this->Fourchettes->save($fourchette)) {
                $this->Flash->success(__('The {0} has been saved.', 'Fourchette'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fourchette'));
        }
        $clients = $this->Fourchettes->Clients->find('list', ['limit' => 200]);
        $fourches = $this->Fourchettes->Fourches->find('list', ['limit' => 200]);
        $articles = $this->Fourchettes->Articles->find('list', ['limit' => 200]);
        $this->set(compact('fourchette', 'clients', 'fourches', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Fourchette id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fourchette = $this->Fourchettes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fourchette = $this->Fourchettes->patchEntity($fourchette, $this->request->getData());
            if ($this->Fourchettes->save($fourchette)) {
                $this->Flash->success(__('The {0} has been saved.', 'Fourchette'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Fourchette'));
        }
        $clients = $this->Fourchettes->Clients->find('list', ['limit' => 200]);
        $fourches = $this->Fourchettes->Fourches->find('list', ['limit' => 200]);
        $articles = $this->Fourchettes->Articles->find('list', ['limit' => 200]);
        $this->set(compact('fourchette', 'clients', 'fourches', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Fourchette id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fourchette = $this->Fourchettes->get($id);
        if ($this->Fourchettes->delete($fourchette)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Fourchette'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Fourchette'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
