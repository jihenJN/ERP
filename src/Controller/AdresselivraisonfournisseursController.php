<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Adresselivraisonfournisseurs Controller
 *
 * @property \App\Model\Table\AdresselivraisonfournisseursTable $Adresselivraisonfournisseurs
 * @method \App\Model\Entity\Adresselivraisonfournisseur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AdresselivraisonfournisseursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Fournisseurs'],
        ];
        $adresselivraisonfournisseurs = $this->paginate($this->Adresselivraisonfournisseurs);

        $this->set(compact('adresselivraisonfournisseurs'));
    }

    /**
     * View method
     *
     * @param string|null $id Adresselivraisonfournisseur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $adresselivraisonfournisseur = $this->Adresselivraisonfournisseurs->get($id, [
            'contain' => ['Fournisseurs', 'Factures', 'Livraisons'],
        ]);

        $this->set(compact('adresselivraisonfournisseur'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $adresselivraisonfournisseur = $this->Adresselivraisonfournisseurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $adresselivraisonfournisseur = $this->Adresselivraisonfournisseurs->patchEntity($adresselivraisonfournisseur, $this->request->getData());
            if ($this->Adresselivraisonfournisseurs->save($adresselivraisonfournisseur)) {
                $this->Flash->success(__('The {0} has been saved.', 'Adresselivraisonfournisseur'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Adresselivraisonfournisseur'));
        }
        $fournisseurs = $this->Adresselivraisonfournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('adresselivraisonfournisseur', 'fournisseurs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Adresselivraisonfournisseur id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $adresselivraisonfournisseur = $this->Adresselivraisonfournisseurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $adresselivraisonfournisseur = $this->Adresselivraisonfournisseurs->patchEntity($adresselivraisonfournisseur, $this->request->getData());
            if ($this->Adresselivraisonfournisseurs->save($adresselivraisonfournisseur)) {
                $this->Flash->success(__('The {0} has been saved.', 'Adresselivraisonfournisseur'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Adresselivraisonfournisseur'));
        }
        $fournisseurs = $this->Adresselivraisonfournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $this->set(compact('adresselivraisonfournisseur', 'fournisseurs'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Adresselivraisonfournisseur id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $adresselivraisonfournisseur = $this->Adresselivraisonfournisseurs->get($id);
        if ($this->Adresselivraisonfournisseurs->delete($adresselivraisonfournisseur)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Adresselivraisonfournisseur'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Adresselivraisonfournisseur'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
