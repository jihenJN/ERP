<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignedemandeoffredeprixes Controller
 *
 * @property \App\Model\Table\LignedemandeoffredeprixesTable $Lignedemandeoffredeprixes
 * @method \App\Model\Entity\Lignedemandeoffredeprix[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignedemandeoffredeprixesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Demandeoffredeprixes', 'Articles', 'Fournisseurs'],
        ];
        $lignedemandeoffredeprixes = $this->paginate($this->Lignedemandeoffredeprixes);

        $this->set(compact('lignedemandeoffredeprixes'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignedemandeoffredeprix id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignedemandeoffredeprix = $this->Lignedemandeoffredeprixes->get($id, [
            'contain' => ['Demandeoffredeprixes', 'Articles', 'Fournisseurs', 'Lignebandeconsultations'],
        ]);

        $this->set(compact('lignedemandeoffredeprix'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignedemandeoffredeprix = $this->Lignedemandeoffredeprixes->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignedemandeoffredeprix = $this->Lignedemandeoffredeprixes->patchEntity($lignedemandeoffredeprix, $this->request->getData());
            if ($this->Lignedemandeoffredeprixes->save($lignedemandeoffredeprix)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignedemandeoffredeprix'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignedemandeoffredeprix'));
        }
        $demandeoffredeprixes = $this->Lignedemandeoffredeprixes->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $articles = $this->Lignedemandeoffredeprixes->Articles->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignedemandeoffredeprixes->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('lignedemandeoffredeprix', 'demandeoffredeprixes', 'articles', 'fournisseurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignedemandeoffredeprix id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignedemandeoffredeprix = $this->Lignedemandeoffredeprixes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignedemandeoffredeprix = $this->Lignedemandeoffredeprixes->patchEntity($lignedemandeoffredeprix, $this->request->getData());
            if ($this->Lignedemandeoffredeprixes->save($lignedemandeoffredeprix)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignedemandeoffredeprix'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignedemandeoffredeprix'));
        }
        $demandeoffredeprixes = $this->Lignedemandeoffredeprixes->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $articles = $this->Lignedemandeoffredeprixes->Articles->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignedemandeoffredeprixes->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('lignedemandeoffredeprix', 'demandeoffredeprixes', 'articles', 'fournisseurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignedemandeoffredeprix id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignedemandeoffredeprix = $this->Lignedemandeoffredeprixes->get($id);
        if ($this->Lignedemandeoffredeprixes->delete($lignedemandeoffredeprix)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignedemandeoffredeprix'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignedemandeoffredeprix'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
