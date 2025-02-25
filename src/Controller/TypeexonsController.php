<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Typeexons Controller
 *
 * @property \App\Model\Table\TypeexonsTable $Typeexons
 * @method \App\Model\Entity\Typeexon[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TypeexonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $typeexons = $this->paginate($this->Typeexons);

        $this->set(compact('typeexons'));
    }

    /**
     * View method
     *
     * @param string|null $id Typeexon id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeexon = $this->Typeexons->get($id, [
            'contain' => ['Clientexonerations', 'Exonerations'],
        ]);

        $this->set(compact('typeexon'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $typeexon = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'typeexons') {
                $typeexon = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($typeexon <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $typeexon = $this->Typeexons->newEmptyEntity();
        if ($this->request->is('post')) {
            $typeexon = $this->Typeexons->patchEntity($typeexon, $this->request->getData());
            if ($this->Typeexons->save($typeexon)) {
                $typeexon_id = ($this->Typeexons->save($typeexon)->id);
                $this->misejour("Typeexons", "add", $typeexon_id);

                return $this->redirect(['action' => 'index']);
            }
            
        }
        $this->set(compact('typeexon'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Typeexon id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $typeexon = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'typeexons') {
                $typeexon = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($typeexon <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $typeexon = $this->Typeexons->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeexon = $this->Typeexons->patchEntity($typeexon, $this->request->getData());
            if ($this->Typeexons->save($typeexon)) {
                //$this->Flash->success(__('The typeexon has been saved.'));
                $typeexon_id = ($this->Typeexons->save($typeexon)->id);
                $this->misejour("Typeexons", "edit", $typeexon_id);
                return $this->redirect(['action' => 'index']);
            }
            //   $this->Flash->error(__('The typeexon could not be saved. Please, try again.'));
        }
        $this->set(compact('typeexon'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Typeexon id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $typeexon = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'typeexons') {
                $typeexon = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($typeexon <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $typeexon = $this->Typeexons->get($id);
        if ($this->Typeexons->delete($typeexon)) {
            $typeexon_id = ($this->Typeexons->save($typeexon)->id);
            $this->misejour("Typeexons", "delete", $typeexon_id);        } else {
            // $this->Flash->error(__('The typeexon could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
