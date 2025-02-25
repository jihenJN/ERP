<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Lignelivraisons Controller
 *
 * @property \App\Model\Table\LignelivraisonsTable $Lignelivraisons
 * @method \App\Model\Entity\Lignelivraison[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LignelivraisonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Livraisons', 'Commandes', 'Fournisseurs', 'Articles'],
        ];
        $lignelivraisons = $this->paginate($this->Lignelivraisons);

        $this->set(compact('lignelivraisons'));
    }

    /**
     * View method
     *
     * @param string|null $id Lignelivraison id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lignelivraison = $this->Lignelivraisons->get($id, [
            'contain' => ['Livraisons', 'Commandes', 'Fournisseurs', 'Articles'],
        ]);

        $this->set(compact('lignelivraison'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $lignelivraison = $this->Lignelivraisons->newEmptyEntity();
        if ($this->request->is('post')) {
            $lignelivraison = $this->Lignelivraisons->patchEntity($lignelivraison, $this->request->getData());
            if ($this->Lignelivraisons->save($lignelivraison)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignelivraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignelivraison'));
        }
        $livraisons = $this->Lignelivraisons->Livraisons->find('list', ['limit' => 200]);
        $commandes = $this->Lignelivraisons->Commandes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignelivraisons->Fournisseurs->find('list', ['limit' => 200]);
        $articles = $this->Lignelivraisons->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignelivraison', 'livraisons', 'commandes', 'fournisseurs', 'articles'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Lignelivraison id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lignelivraison = $this->Lignelivraisons->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lignelivraison = $this->Lignelivraisons->patchEntity($lignelivraison, $this->request->getData());
            if ($this->Lignelivraisons->save($lignelivraison)) {
                $this->Flash->success(__('The {0} has been saved.', 'Lignelivraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignelivraison'));
        }
        $livraisons = $this->Lignelivraisons->Livraisons->find('list', ['limit' => 200]);
        $commandes = $this->Lignelivraisons->Commandes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Lignelivraisons->Fournisseurs->find('list', ['limit' => 200]);
        $articles = $this->Lignelivraisons->Articles->find('list', ['limit' => 200]);
        $this->set(compact('lignelivraison', 'livraisons', 'commandes', 'fournisseurs', 'articles'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Lignelivraison id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lignelivraison = $this->Lignelivraisons->get($id);
        if ($this->Lignelivraisons->delete($lignelivraison)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Lignelivraison'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Lignelivraison'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
