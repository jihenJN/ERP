<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Remiseclients Controller
 *
 * @property \App\Model\Table\RemiseclientsTable $Remiseclients
 * @method \App\Model\Entity\Remiseclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RemiseclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Typeclients'],
        ];
        $remiseclients = $this->paginate($this->Remiseclients);

        $this->set(compact('remiseclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Remiseclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    { {
            $remiseclient = $this->Remiseclients->get($id, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $this->loadModel('Ligneremiseclients');
                $data['max'] = $this->request->getData('max');
                $data['min'] = $this->request->getData('min');
                $data['remise'] = $this->request->getData('remise');
                $data['remiseclient_id'] = $this->request->getData('remiseclient_id');
                $remiseclient = $this->Remiseclients->patchEntity($remiseclient, $this->request->getData());
                if ($this->Remiseclients->save($remiseclient)) {
                    $remiseclient_id = ($this->Remiseclients->save($remiseclient)->id);
                    $this->misejour("Remiseclients", "edit", $remiseclient_id);
                    $ligneremiseclient = $this->Ligneremiseclients->find('all')
                        ->where(["Ligneremiseclients.remiseclient_id  ='" . $id . "'"]);
                    foreach ($ligneremiseclient as $c) {
                        $this->fetchTable('Ligneremiseclients')->delete($c);
                    }
                    if (isset($this->request->getData('data')['ligneremiseclients']) && (!empty($this->request->getData('data')['ligneremiseclients']))) {
                        // debug($this->request->getData());
                        // die;
                        foreach ($this->request->getData('data')['ligneremiseclients'] as $i => $tar) {
                            //debug($tar);
                            if ($tar['sup'] != 1) {
                                $data['remiseclient_id'] = $remiseclient_id;
                                $data['remise'] = $tar['remise'];
                                $data['min'] = $tar['min'];
                                $data['max'] = $tar['max'];
                                $ligneremiseclient = $this->fetchTable('Ligneremiseclients')->newEmptyEntity();
                                $ligneremiseclient = $this->Ligneremiseclients->patchEntity($ligneremiseclient, $data);
                                if ($this->Ligneremiseclients->save($ligneremiseclient)) {
                                    //  debug($ligneremiseclient);
                                } else {
                                }
                            }
                        }
                    }
                    return $this->redirect(['action' => 'index']);
                }
            }
            $ligneremiseclients = $this->fetchTable('Ligneremiseclients')->find('all')->where(['remiseclient_id' => $id])->order(["Ligneremiseclients.id" => 'asc']);
            $typeclients = $this->Remiseclients->Typeclients->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
            $this->set(compact('remiseclient', 'typeclients', 'ligneremiseclients'));
        }
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);
        //   debug($liendd);
        $remiseclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'remiseclients') {
                $remiseclient = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($remiseclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $numeroobj = $this->Remiseclients->find()->select(["numerox" =>
        'MAX(Remiseclients.code)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            //debug($code);die;

        } else {
            $code = "00001";
        }
        $remiseclient = $this->Remiseclients->newEmptyEntity();
        if ($this->request->is('post')) {
            $remiseclient = $this->Remiseclients->patchEntity($remiseclient, $this->request->getData());
            if ($this->Remiseclients->save($remiseclient)) {
                $remiseclient_id = ($this->Remiseclients->save($remiseclient)->id);
                $this->misejour("Remiseclients", "add", $remiseclient_id);
                $this->loadModel('Ligneremiseclients');
                if (isset($this->request->getData('data')['ligneremiseclients']) && (!empty($this->request->getData('data')['ligneremiseclients']))) {
                    // debug($this->request->getData());
                    // die;
                    foreach ($this->request->getData('data')['ligneremiseclients'] as $i => $tar) {
                        //debug($tar);
                        if ($tar['sup'] != 1) {
                            $data['remiseclient_id'] = $remiseclient_id;
                            $data['remise'] = $tar['remise'];
                            $data['min'] = $tar['min'];
                            $data['max'] = $tar['max'];
                            $ligneremiseclient = $this->fetchTable('Ligneremiseclients')->newEmptyEntity();
                            $ligneremiseclient = $this->Ligneremiseclients->patchEntity($ligneremiseclient, $data);
                            if ($this->Ligneremiseclients->save($ligneremiseclient)) {
                                //  debug($ligneremiseclient);
                            } else {
                            }
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $typeclients = $this->Remiseclients->Typeclients->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('code', 'remiseclient', 'typeclients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Remiseclient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);
        //   debug($liendd);
        $remiseclient = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'remiseclients') {
                $remiseclient = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($remiseclient <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $remiseclient = $this->Remiseclients->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->loadModel('Ligneremiseclients');
            $data['max'] = $this->request->getData('max');
            $data['min'] = $this->request->getData('min');
            $data['remise'] = $this->request->getData('remise');
            $data['remiseclient_id'] = $this->request->getData('remiseclient_id');
            $remiseclient = $this->Remiseclients->patchEntity($remiseclient, $this->request->getData());
            if ($this->Remiseclients->save($remiseclient)) {
                $remiseclient_id = ($this->Remiseclients->save($remiseclient)->id);
                $this->misejour("Remiseclients", "edit", $remiseclient_id);
                $ligneremiseclient = $this->Ligneremiseclients->find('all')
                    ->where(["Ligneremiseclients.remiseclient_id  ='" . $id . "'"]);
                foreach ($ligneremiseclient as $c) {
                    $this->fetchTable('Ligneremiseclients')->delete($c);
                }
                if (isset($this->request->getData('data')['ligneremiseclients']) && (!empty($this->request->getData('data')['ligneremiseclients']))) {
                    //debug($this->request->getData());
                    // die;
                    foreach ($this->request->getData('data')['ligneremiseclients'] as $i => $tar) {
                        // debug($tar);
                        if ($tar['sup'] != 1) {
                            $data['remiseclient_id'] = $remiseclient_id;
                            $data['remise'] = $tar['remise'];
                            $data['min'] = $tar['min'];
                            $data['max'] = $tar['max'];
                            //debug($data);
                            $ligneremiseclient = $this->fetchTable('Ligneremiseclients')->newEmptyEntity();
                            $ligneremiseclient = $this->Ligneremiseclients->patchEntity($ligneremiseclient, $data);
                            if ($this->Ligneremiseclients->save($ligneremiseclient)) {
                                //debug($ligneremiseclient);
                            } else {
                            }
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $ligneremiseclients = $this->fetchTable('Ligneremiseclients')->find('all')->where(['remiseclient_id' => $id])->order(["Ligneremiseclients.id" => 'asc']);
        $typeclients = $this->Remiseclients->Typeclients->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('remiseclient', 'typeclients', 'ligneremiseclients'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Remiseclient id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
               $session = $this->request->getSession();
               $abrv = $session->read('abrvv');
               $liendd = $session->read('lien_clients' . $abrv);
               //   debug($liendd);
               $remiseclient = 0;
               foreach ($liendd as $k => $liens) {
                   //  debug($liens);
                   if (@$liens['lien'] == 'remiseclients') {
                       $remiseclient = $liens['supp'];
                   }
               }
               // debug($societe);die;
               if (($remiseclient <> 1)) {
                   $this->redirect(array('controller' => 'users', 'action' => 'login'));
               }
        $this->request->allowMethod(['post', 'delete']);
        $remiseclient = $this->Remiseclients->get($id);
        if ($this->Remiseclients->delete($remiseclient)) {
            $remiseclient_id = ($this->Remiseclients->save($remiseclient)->id);
            $this->misejour("Remiseclients", "delete", $remiseclient_id);
            $ligneremiseclient = $this->fetchTable('Ligneremiseclients')->find('all')
                ->where(["Ligneremiseclients.remiseclient_id  ='" . $id . "'"]);
            foreach ($ligneremiseclient as $c) {
                $this->fetchTable('Ligneremiseclients')->delete($c);
            }
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }

    public function consultation($id = null)
    { {
            $remiseclient = $this->Remiseclients->get($id, [
                'contain' => []
            ]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $this->loadModel('Ligneremiseclients');
                $data['max'] = $this->request->getData('max');
                $data['min'] = $this->request->getData('min');
                $data['remise'] = $this->request->getData('remise');
                $data['remiseclient_id'] = $this->request->getData('remiseclient_id');
                $remiseclient = $this->Remiseclients->patchEntity($remiseclient, $this->request->getData());
                if ($this->Remiseclients->save($remiseclient)) {
                    $remiseclient_id = ($this->Remiseclients->save($remiseclient)->id);
                    $this->misejour("Remiseclients", "edit", $remiseclient_id);
                    $ligneremiseclient = $this->Ligneremiseclients->find('all')
                        ->where(["Ligneremiseclients.remiseclient_id  ='" . $id . "'"]);
                    foreach ($ligneremiseclient as $c) {
                        $this->fetchTable('Ligneremiseclients')->delete($c);
                    }
                    if (isset($this->request->getData('data')['ligneremiseclients']) && (!empty($this->request->getData('data')['ligneremiseclients']))) {
                        // debug($this->request->getData());
                        // die;
                        foreach ($this->request->getData('data')['ligneremiseclients'] as $i => $tar) {
                            //debug($tar);
                            if ($tar['sup'] != 1) {
                                $data['remiseclient_id'] = $remiseclient_id;
                                $data['remise'] = $tar['remise'];
                                $data['min'] = $tar['min'];
                                $data['max'] = $tar['max'];
                                $ligneremiseclient = $this->fetchTable('Ligneremiseclients')->newEmptyEntity();
                                $ligneremiseclient = $this->Ligneremiseclients->patchEntity($ligneremiseclient, $data);
                                if ($this->Ligneremiseclients->save($ligneremiseclient)) {
                                    //  debug($ligneremiseclient);
                                } else {
                                }
                            }
                        }
                    }
                    return $this->redirect(['action' => 'index']);
                }
            }
            $ligneremiseclients = $this->fetchTable('Ligneremiseclients')->find('all')->where(['remiseclient_id' => $id])->order(["Ligneremiseclients.id" => 'asc']);
            $typeclients = $this->Remiseclients->Typeclients->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
            $this->set(compact('remiseclient', 'typeclients', 'ligneremiseclients'));
        }
    }
}
