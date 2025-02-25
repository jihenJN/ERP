<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Adresselivraisonclients Controller
 *
 * @property \App\Model\Table\AdresselivraisonclientsTable $Adresselivraisonclients
 * @method \App\Model\Entity\Adresselivraisonclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdresselivraisonclientsController extends AppController
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
        $adresselivraisonclients = $this->paginate($this->Adresselivraisonclients);

        $this->set(compact('adresselivraisonclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Adresselivraisonclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adresselivraisonclient = $this->Adresselivraisonclients->get($id, [
            'contain' => ['Clients', 'Bonlivraisons', 'Factureclients'],
        ]);

        $this->set(compact('adresselivraisonclient'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adresselivraisonclient = $this->Adresselivraisonclients->newEmptyEntity();
        if ($this->request->is('post')) {
            $adresselivraisonclient = $this->Adresselivraisonclients->patchEntity($adresselivraisonclient, $this->request->getData());
            if ($this->Adresselivraisonclients->save($adresselivraisonclient)) {
                $this->Flash->success(__('The {0} has been saved.', 'Adresselivraisonclient'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Adresselivraisonclient'));
        }
        $clients = $this->Adresselivraisonclients->Clients->find('list', ['limit' => 200]);
        $this->set(compact('adresselivraisonclient', 'clients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Adresselivraisonclient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adresselivraisonclient = $this->Adresselivraisonclients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adresselivraisonclient = $this->Adresselivraisonclients->patchEntity($adresselivraisonclient, $this->request->getData());
            if ($this->Adresselivraisonclients->save($adresselivraisonclient)) {
                $this->Flash->success(__('The {0} has been saved.', 'Adresselivraisonclient'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Adresselivraisonclient'));
        }
        $clients = $this->Adresselivraisonclients->Clients->find('list', ['limit' => 200]);
        $this->set(compact('adresselivraisonclient', 'clients'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Adresselivraisonclient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adresselivraisonclient = $this->Adresselivraisonclients->get($id);
        if ($this->Adresselivraisonclients->delete($adresselivraisonclient)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Adresselivraisonclient'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Adresselivraisonclient'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
