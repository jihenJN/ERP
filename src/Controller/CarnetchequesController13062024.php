<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Carnetcheques Controller
 *
 * @property \App\Model\Table\CarnetchequesTable $Carnetcheques
 * @method \App\Model\Entity\Carnetcheque[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CarnetchequesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Comptes', 'Banques'],
        ];
        $carnetcheques = $this->paginate($this->Carnetcheques);
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $this->set(compact('carnetcheques', 'banques', 'comptes'));
    }

    /**
     * View method
     *
     * @param string|null $id Carnetcheque id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $carnetcheque = $this->Carnetcheques->get($id, [
            'contain' => ['Comptes', 'Piecereglements'],
        ]);
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $comptes = $this->Carnetcheques->Comptes->find('list', ['limit' => 200])->all();

        $this->set(compact('carnetcheque', 'banques', 'comptes'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
     {
    //     $session = $this->request->getSession();
    //     $abrv = $session->read('abrvv');
    //     $liendd = $session->read('lien_finance' . $abrv);
    //     /// debug($liendd);die;
    //     $f = 0;
    //     foreach ($liendd as $k => $liens) {
    //         //          debug($liens);
    //         if (@$liens['lien'] == 'carnetcheques') {
    //             $f = $liens['ajout'];
    //         }
    //     }
    //     // debug($societe);die;
    //     if (($f <> 1)) {
    //         $this->redirect(array('controller' => 'users', 'action' => 'login'));
    //     }
        $carnetcheque = $this->Carnetcheques->newEmptyEntity();
        if ($this->request->is('post')) {
            $carnetcheque = $this->Carnetcheques->patchEntity($carnetcheque, $this->request->getData());
            if ($this->Carnetcheques->save($carnetcheque)) {
                // $this->Flash->success(__('The carnetcheque has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The carnetcheque could not be saved. Please, try again.'));
        }
        $comptes = $this->Carnetcheques->Comptes->find('list', ['limit' => 200])->all();
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('carnetcheque', 'comptes', 'banques'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Carnetcheque id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        // //   debug($liendd);
        // $ff = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'carnetcheques') {
        //         $ff = $liens['modif'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        $carnetcheque = $this->Carnetcheques->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $carnetcheque = $this->Carnetcheques->patchEntity($carnetcheque, $this->request->getData());
            if ($this->Carnetcheques->save($carnetcheque)) {
                //  $this->Flash->success(__('The carnetcheque has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The carnetcheque could not be saved. Please, try again.'));
        }
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('carnetcheque', 'comptes', 'banques'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Carnetcheque id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        // //   debug($liendd);
        // $ff = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'carnetcheques') {
        //         $ff = $liens['supp'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        //$this->request->allowMethod(['post', 'delete']);
        $carnetcheque = $this->Carnetcheques->get($id);
        if ($this->Carnetcheques->delete($carnetcheque)) {
            //  $this->Flash->success(__('The carnetcheque has been deleted.'));
        } else {
            // $this->Flash->error(__('The carnetcheque could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
