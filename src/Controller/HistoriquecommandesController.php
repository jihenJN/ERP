<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Historiquecommandes Controller
 *
 * @property \App\Model\Table\HistoriquecommandesTable $Historiquecommandes
 * @method \App\Model\Entity\Historiquecommande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class HistoriquecommandesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $historiquecommandes = $this->fetchTable('Historiquecommandes')->find('all', [
            'contain' => [] ,
        ]) ;



        $this->set(compact('historiquecommandes'));
    }

    /**
     * View method
     *
     * @param string|null $id Historiquecommande id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $historiquecommande = $this->Historiquecommandes->get($id, [
            'contain' => ['Commandes'],
        ]);

        $this->set(compact('historiquecommande'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $historiquecommande = $this->Historiquecommandes->newEmptyEntity();
        if ($this->request->is('post')) {
            $historiquecommande = $this->Historiquecommandes->patchEntity($historiquecommande, $this->request->getData());
            if ($this->Historiquecommandes->save($historiquecommande)) {
                $this->Flash->success(__('The {0} has been saved.', 'Historiquecommande'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Historiquecommande'));
        }
        $commandes = $this->Historiquecommandes->Commandes->find('list', ['limit' => 200]);
        $this->set(compact('historiquecommande', 'commandes'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Historiquecommande id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $historiquecommande = $this->Historiquecommandes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $historiquecommande = $this->Historiquecommandes->patchEntity($historiquecommande, $this->request->getData());
            if ($this->Historiquecommandes->save($historiquecommande)) {
                $this->Flash->success(__('The {0} has been saved.', 'Historiquecommande'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Historiquecommande'));
        }
        $commandes = $this->Historiquecommandes->Commandes->find('list', ['limit' => 200]);
        $this->set(compact('historiquecommande', 'commandes'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Historiquecommande id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $historiquecommande = $this->Historiquecommandes->get($id);
        if ($this->Historiquecommandes->delete($historiquecommande)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Historiquecommande'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Historiquecommande'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
