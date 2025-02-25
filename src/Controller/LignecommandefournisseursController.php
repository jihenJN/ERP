<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignecommandefournisseurs Controller
 *
 * @property \App\Model\Table\LignecommandefournisseursTable $Lignecommandefournisseurs
 * @method \App\Model\Entity\Lignecommandefournisseur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignecommandefournisseursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Commandefournisseurs', 'Fournisseurs', 'Articles'],
        ];
        $lignecommandefournisseurs = $this->paginate($this->Lignecommandefournisseurs);

        $this->set(compact('lignecommandefournisseurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignecommandefournisseur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignecommandefournisseur = $this->Lignecommandefournisseurs->get($id, [
            'contain' => ['Commandefournisseurs', 'Fournisseurs', 'Articles'],
        ]);

        $this->set(compact('lignecommandefournisseur'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignecommandefournisseur = $this->Lignecommandefournisseurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignecommandefournisseur = $this->Lignecommandefournisseurs->patchEntity($lignecommandefournisseur, $this->request->getData());
            if ($this->Lignecommandefournisseurs->save($lignecommandefournisseur)) {
                $this->Flash->success(__('The lignecommandefournisseur has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignecommandefournisseur could not be saved. Please, try again.'));
        }
        $commandefournisseurs = $this->Lignecommandefournisseurs->Commandefournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Lignecommandefournisseurs->Fournisseurs->find('list', ['limit' => 200])->all();
        $articles = $this->Lignecommandefournisseurs->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('lignecommandefournisseur', 'commandefournisseurs', 'fournisseurs', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lignecommandefournisseur id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignecommandefournisseur = $this->Lignecommandefournisseurs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignecommandefournisseur = $this->Lignecommandefournisseurs->patchEntity($lignecommandefournisseur, $this->request->getData());
            if ($this->Lignecommandefournisseurs->save($lignecommandefournisseur)) {
                $this->Flash->success(__('The lignecommandefournisseur has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The lignecommandefournisseur could not be saved. Please, try again.'));
        }
        $commandefournisseurs = $this->Lignecommandefournisseurs->Commandefournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Lignecommandefournisseurs->Fournisseurs->find('list', ['limit' => 200])->all();
        $articles = $this->Lignecommandefournisseurs->Articles->find('list', ['limit' => 200])->all();
        $this->set(compact('lignecommandefournisseur', 'commandefournisseurs', 'fournisseurs', 'articles'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lignecommandefournisseur id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignecommandefournisseur = $this->Lignecommandefournisseurs->get($id);
        if ($this->Lignecommandefournisseurs->delete($lignecommandefournisseur)) {
            $this->Flash->success(__('The lignecommandefournisseur has been deleted.'));
        } else {
            $this->Flash->error(__('The lignecommandefournisseur could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
