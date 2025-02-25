<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Remiseescomptes Controller
 *
 * @property \App\Model\Table\RemiseescomptesTable $Remiseescomptes
 * @method \App\Model\Entity\Remiseescompte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RemiseescomptesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Remiseescomptes->find('all')->order(["Remiseescomptes.id" => 'desc']);
        $this->paginate = [
            'contain' => ['Typeclients'],
        ];
        $remiseescomptes = $this->paginate($query);

        $this->loadModel('Typeclients');
        $typeclient = $this->Remiseescomptes->Typeclients->find('list', ['keyfield' => 'id', 'valueField' => 'type']);

        $this->set(compact('remiseescomptes', 'typeclient'));
    }

    /**
     * View method
     *
     * @param string|null $id Remiseescompte id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Remiseqtes');
        $remiseescompte = $this->Remiseescomptes->get($id, [
            'contain' => [],
        ]);

        $query = $this->fetchTable('Remiseqtes')->find('all')->where(("Remiseqtes.remiseescompte_id =" . $remiseescompte["id"]));

        //debug($query);die;

        $this->paginate = [
            'contain' => [],
        ];

        $remiseqtes = $this->paginate($query);



        $this->loadModel('Typeclients');
        $typeclient = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('remiseescompte', 'typeclient', 'remiseqtes'));
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
        $liendd = $session->read('lien_clients' . $abrv);
        //   debug($liendd);
        $remiseescompte = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'remiseescomptes') {
                $remiseescompte = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($remiseescompte <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $remiseescompte = $this->Remiseescomptes->newEmptyEntity();
        if ($this->request->is('post')) {
            // debug($this->request->getData());
            $this->loadModel('Remiseqtes');
            $remiseescompte = $this->Remiseescomptes->patchEntity($remiseescompte, $this->request->getData());
            if ($this->Remiseescomptes->save($remiseescompte)) {
                $remiseescompte_id = $remiseescompte->id;
                if (isset($this->request->getData('data')['remiseqtes1']) && (!empty($this->request->getData('data')['remiseqtes1']))) {
                    //$remiseqte = $this->Remiseqtes->newEmptyEntity();
                    foreach ($this->request->getData('data')['remiseqtes1']  as  $rem) {

                        if ($rem['sup'] != 1) {

                            $remiseqte = $this->fetchTable('Remiseqtes')->newEmptyEntity();

                            $remiseqte->qtemin = $rem['qtemin'];
                            $remiseqte->qtemax = $rem['qtemax'];
                            $remiseqte->remiseescompte_id = $remiseescompte_id;
                            $remiseqte->pourcentage = $rem['pourcentage'];
                            //debug($remiseqte);die;
                            if ($this->fetchtable('Remiseqtes')->save($remiseqte)) {
                                // $remiseqte_id = ($this->Remiseqtes->save($remiseqte)->id);
                                // $this->misejour("Remiseqtes", "add", $remiseqte_id);
                            }
                        }
                    }
                    // $remiseqte = $this->Remiseqtes->patchEntity($rem, $this->request->getData());
                }
                //$this->Flash->success(__('The remiseescompte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The remiseescompte could not be saved. Please, try again.'));
        }
        $this->loadModel('Typeclients');
        $typeclient = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('remiseescompte', 'typeclient'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Remiseescompte id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);
        //   debug($liendd);
        $remiseescompte = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'remiseescomptes') {
                $remiseescompte = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($remiseescompte <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Remiseqtes');
        $remiseescompte = $this->Remiseescomptes->get($id, [
            'contain' => [],
        ]);

        $query = $this->fetchTable('Remiseqtes')->find('all')->where(("Remiseqtes.remiseescompte_id =" . $remiseescompte["id"]));

        //debug($query);die;

        $this->paginate = [
            'contain' => [],
        ];

        $remiseqtes = $this->paginate($query);


        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());die;
            $remiseescompte = $this->Remiseescomptes->patchEntity($remiseescompte, $this->request->getData());
            if ($this->Remiseescomptes->save($remiseescompte)) {
                $remiseescompte_id = $remiseescompte->id;

                if (isset($this->request->getData('data')['remiseqtes1']) && (!empty($this->request->getData('data')['remiseqtes1']))) {

                    $Remiseqte = $this->Remiseqtes->find('all', [])->where(['Remiseqtes.remiseescompte_id =' . $id]);
                    foreach ($Remiseqte as $f) {
                        $this->Remiseqtes->delete($f);
                    }
                    //debug($this->request->getData('data')['ligne']);
                    foreach ($this->request->getData('data')['remiseqtes1'] as $rem) {
                        // debug($l);

                        if ($rem['sup'] != 1) {

                            $remiseqtes = $this->fetchTable('Remiseqtes')->newEmptyEntity();
                            //debug($tab);

                            $remiseqtes->remiseescompte_id = $remiseescompte_id;
                            $remiseqtes->qtemin = $rem['qtemin'];
                            $remiseqtes->qtemax = $rem['qtemax'];
                            $remiseqtes->pourcentage = $rem['pourcentage'];

                            ($this->fetchTable('Remiseqtes')->save($remiseqtes));
                        }
                    }
                }




                //$this->Flash->success(__('The remiseescompte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The remiseescompte could not be saved. Please, try again.'));
        }
        $this->loadModel('Typeclients');
        $typeclient = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('remiseescompte', 'typeclient', 'remiseqtes'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Remiseescompte id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);
        //   debug($liendd);
        $remiseescompte = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'remiseescomptes') {
                $remiseescompte = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($remiseescompte <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $this->loadModel('Remiseqtes');
        $Remiseqte = $this->Remiseqtes->find('all', [])->where(['Remiseqtes.remiseescompte_id =' . $id]);
        foreach ($Remiseqte as $f) {
            $this->Remiseqtes->delete($f);
        }
        $remiseescompte = $this->Remiseescomptes->get($id);
        if ($this->Remiseescomptes->delete($remiseescompte)) {
            // $this->Flash->success(__('The remiseescompte has been deleted.'));
        } else {
            // $this->Flash->error(__('The remiseescompte could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function consultation($id = null)
    {
        $this->loadModel('Remiseqtes');
        $remiseescompte = $this->Remiseescomptes->get($id, [
            'contain' => [],
        ]);

        $query = $this->fetchTable('Remiseqtes')->find('all')->where(("Remiseqtes.remiseescompte_id =" . $remiseescompte["id"]));

        //debug($query);die;

        $this->paginate = [
            'contain' => [],
        ];
        
        $remiseqtes = $this->paginate($query);
        

       
        $this->loadModel('Typeclients');
        $typeclient=$this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('remiseescompte','typeclient','remiseqtes'));
    }
}
