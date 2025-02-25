<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignecommandes Controller
 *
 * @property \App\Model\Table\LignecommandesTable $Lignecommandes
 * @method \App\Model\Entity\Lignecommande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignecommandesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Commandes', 'Articles'],
        ];
        $lignecommandes = $this->paginate($this->Lignecommandes);

        $this->set(compact('lignecommandes'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignecommande id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignecommande = $this->Lignecommandes->get($id, [
            'contain' => ['Commandes', 'Articles'],
        ]);

        $this->set(compact('lignecommande'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignecommande = $this->Lignecommandes->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignecommande = $this->Lignecommandes->patchEntity($lignecommande, $this->request->getData());
            if ($this->Lignecommandes->save($lignecommande)) {
                $this->Flash->success(__('The lignecommande has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignecommande could not be saved. Please, try again.'));
        }
        $commandes = $this->Lignecommandes->Commandes->find('list', ['limit' => 200])->all();
        $articles = $this->Lignecommandes->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('lignecommande', 'commandes', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignecommande id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignecommande = $this->Lignecommandes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignecommande = $this->Lignecommandes->patchEntity($lignecommande, $this->request->getData());
            if ($this->Lignecommandes->save($lignecommande)) {
                $this->Flash->success(__('The lignecommande has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignecommande could not be saved. Please, try again.'));
        }
        $commandes = $this->Lignecommandes->Commandes->find('list', ['limit' => 200])->all();
        $articles = $this->Lignecommandes->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('lignecommande', 'commandes', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignecommande id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignecommande = $this->Lignecommandes->get($id);
        if ($this->Lignecommandes->delete($lignecommande)) {
            $this->Flash->success(__('The lignecommande has been deleted.'));
        } else {
            $this->Flash->error(__('The lignecommande could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
