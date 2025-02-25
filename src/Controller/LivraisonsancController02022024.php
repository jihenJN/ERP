<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Livraisonsanc Controller
 *
 * @property \App\Model\Table\LivraisonsancTable $Livraisonsanc
 * @method \App\Model\Entity\Livraisonsanc[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LivraisonsancController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Commandes', 'Fournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports'],
        ];
        $livraisonsanc = $this->paginate($this->Livraisonsanc);

        $this->set(compact('livraisonsanc'));
    }

    /**
     * View method
     *
     * @param string|null $id Livraisonsanc id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $livraisonsanc = $this->Livraisonsanc->get($id, [
            'contain' => ['Commandes', 'Fournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports'],
        ]);

        $this->set(compact('livraisonsanc'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $livraisonsanc = $this->Livraisonsanc->newEmptyEntity();
        if ($this->request->is('post')) {
            $livraisonsanc = $this->Livraisonsanc->patchEntity($livraisonsanc, $this->request->getData());
            if ($this->Livraisonsanc->save($livraisonsanc)) {
                $this->Flash->success(__('The {0} has been saved.', 'Livraisonsanc'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Livraisonsanc'));
        }
        $commandes = $this->Livraisonsanc->Commandes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Livraisonsanc->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisonsanc->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisonsanc->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisonsanc->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisonsanc->Materieltransports->find('list', ['limit' => 200]);
        $this->set(compact('livraisonsanc', 'commandes', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Livraisonsanc id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $livraisonsanc = $this->Livraisonsanc->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $livraisonsanc = $this->Livraisonsanc->patchEntity($livraisonsanc, $this->request->getData());
            if ($this->Livraisonsanc->save($livraisonsanc)) {
                $this->Flash->success(__('The {0} has been saved.', 'Livraisonsanc'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Livraisonsanc'));
        }
        $commandes = $this->Livraisonsanc->Commandes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Livraisonsanc->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisonsanc->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisonsanc->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisonsanc->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisonsanc->Materieltransports->find('list', ['limit' => 200]);
        $this->set(compact('livraisonsanc', 'commandes', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Livraisonsanc id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $livraisonsanc = $this->Livraisonsanc->get($id);
        if ($this->Livraisonsanc->delete($livraisonsanc)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Livraisonsanc'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Livraisonsanc'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
