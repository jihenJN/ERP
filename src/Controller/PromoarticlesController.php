<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Promoarticles Controller
 *
 * @property \App\Model\Table\PromoarticlesTable $Promoarticles
 * @method \App\Model\Entity\Promoarticle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PromoarticlesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cond1 = '';
        $typecl = $this->request->getQuery('typeclient_id');

        if ($typecl) {
            $cond1 = "Promoarticles.typeclient_id  = " . $typecl;
        }

        $query = $this->Promoarticles->find('all')->where([$cond1]);

        $this->paginate = [
            'contain' => ['Typeclients'],
        ];

        $promoarticles = $this->paginate($query);
        $typeclients = $this->fetchTable('Typeclients')->find('all')->where(['Typeclients.grandsurface=0']);

        $this->set(compact('promoarticles','typeclients'));
    }

    /**
     * View method
     *
     * @param string|null $id Promoarticle id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $promoarticle = $this->Promoarticles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->loadModel('Gouvpromoarticles');
            $data['promoarticle_id'] = $this->request->getData('promoarticle_id');
            $data['gouvernorat_id'] = $this->request->getData('gouvernorat_id');
            $data['toutgouv'] = $this->request->getData('toutgouv');
            $gouvpromoarticle = $this->Gouvpromoarticles->find('all')
                ->where(["Gouvpromoarticles.promoarticle_id  ='" . $id . "'"]);
            foreach ($gouvpromoarticle as $c) {
                $this->fetchTable('Gouvpromoarticles')->delete($c);
            }
            $this->loadModel('Clientpromoarticles');
            $dd['promoarticle_id'] = $this->request->getData('promoarticle_id');
            $dd['client_id'] = $this->request->getData('client_id');
            $dd['checkk'] = $this->request->getData('checkk');
            $clientpromoarticle = $this->Clientpromoarticles->find('all')
                ->where(["Clientpromoarticles.promoarticle_id  ='" . $id . "'"]);
            foreach ($clientpromoarticle as $clie) {
                $this->fetchTable('Clientpromoarticles')->delete($clie);
            }
            $this->loadModel('Lignepromoarticles');
            $dataa['promoarticle_id'] = $this->request->getData('promoarticle_id');
            $dataa['article_id'] = $this->request->getData('article_id');
            $dataa['id'] = $this->request->getData('id');
            $dataa['min'] = $this->request->getData('min');
            $dataa['max'] = $this->request->getData('max');
            $dataa['value'] = $this->request->getData('value');
            $lignepromoarticle = $this->Lignepromoarticles->find('all')
                ->where(["Lignepromoarticles.promoarticle_id  ='" . $id . "'"]);
            $this->loadModel('Natlignepromoarticles');
            $dat['promoarticle_id'] = $this->request->getData('promoarticle_id');
            $dat['article_id'] = $this->request->getData('article_id');
            $dat['id'] = $this->request->getData('id');
            $dat['qte'] = $this->request->getData('qte');
            $dat['value'] = $this->request->getData('value');
            $natlignepromoarticle = $this->Natlignepromoarticles->find('all')
                ->where(["Natlignepromoarticles.promoarticle_id  ='" . $id . "'"]);
            $promoarticle = $this->Promoarticles->patchEntity($promoarticle, $this->request->getData());
            if ($this->Promoarticles->save($promoarticle)) {
                $promoarticle_id = ($this->Promoarticles->save($promoarticle)->id);
                $this->misejour("Promoarticles", "edit", $promoarticle_id);
                $this->loadModel('Gouvpromoarticles');
                if (isset($this->request->getData('data')['gouvpromoarticles']) && (!empty($this->request->getData('data')['gouvpromoarticles']))) {
                    foreach ($this->request->getData('data')['gouvpromoarticles'] as $i => $tar) {
                        if ($tar['sup'] != 1) {
                            $data['promoarticle_id'] = $promoarticle_id;
                            $data['gouvernorat_id'] = $tar['gouvernorat_id'];
                            $data['toutgouv'] = $tar['toutgouv'];
                            $gouvpromoarticle = $this->fetchTable('Gouvpromoarticles')->newEmptyEntity();
                            $gouvpromoarticle = $this->Gouvpromoarticles->patchEntity($gouvpromoarticle, $data);
                            if ($this->Gouvpromoarticles->save($gouvpromoarticle)) {
                            }
                        }
                    }
                }
                $this->loadModel('Clientpromoarticles');
                if (isset($this->request->getData('data')['clientpromoarticles']) && (!empty($this->request->getData('data')['clientpromoarticles']))) {
                    foreach ($this->request->getData('data')['clientpromoarticles'] as $c => $cli) {
                        // debug($cli);
                        if ($cli['sup2'] != 1) {
                            $dd['promoarticle_id'] = $promoarticle_id;
                            $dd['client_id'] = $cli['client_id'];
                            $dd['checkk'] = $cli['checkk'];
                            $clientpromoarticle = $this->fetchTable('Clientpromoarticles')->newEmptyEntity();
                            $clientpromoarticle = $this->Clientpromoarticles->patchEntity($clientpromoarticle, $dd);
                            if ($this->Clientpromoarticles->save($clientpromoarticle)) {
                                // debug($data);
                                //debug($clientpromoarticle);
                            }
                        }
                    }
                }
                $this->loadModel('Lignepromoarticles');
                if (isset($this->request->getData('data')['lignepromoarticles']) && (!empty($this->request->getData('data')['lignepromoarticles']))) {
                    foreach ($this->request->getData('data')['lignepromoarticles'] as $j => $tarr) {
                        if ($tarr['sup0'] != 1) {
                            $dataa['promoarticle_id'] = $promoarticle_id;
                            $dataa['article_id'] = $tarr['article_id'];
                            $dataa['id'] = $tarr['id'];
                            $dataa['min'] = $tarr['min'];
                            $dataa['max'] = $tarr['max'];
                            $dataa['value'] = $tarr['value'];
                            $lignepromoarticle = $this->fetchTable('Lignepromoarticles')->newEmptyEntity();
                            $lignepromoarticle = $this->Lignepromoarticles->patchEntity($lignepromoarticle, $dataa);
                            if ($this->Lignepromoarticles->save($lignepromoarticle)) {
                            }
                        } else {
                            $lignepromoarticless = $this->fetchTable('Lignepromoarticles')->get($tarr['id']);
                            $this->fetchTable('Lignepromoarticles')->delete($lignepromoarticle);
                        }
                    }
                }
                $this->loadModel('Natlignepromoarticles');
                if (isset($this->request->getData('data')['natlignepromoarticles']) && (!empty($this->request->getData('data')['natlignepromoarticles']))) {
                    //debug($this->request->getData());
                    foreach ($this->request->getData('data')['natlignepromoarticles'] as $p => $nat) {
                        //debug($tar);
                        if ($nat['sup1'] != 1) {
                            $dat['promoarticle_id'] = $promoarticle_id;
                            $dat['id'] = $nat['id'];
                            $dat['article_id'] = $nat['article_id'];
                            $dat['qte'] = $nat['qte'];
                            $dat['value'] = $nat['value'];
                            $natlignepromoarticle = $this->fetchTable('Natlignepromoarticles')->newEmptyEntity();
                            $natlignepromoarticle = $this->Natlignepromoarticles->patchEntity($natlignepromoarticle, $dat);
                            if ($this->Natlignepromoarticles->save($natlignepromoarticle)) {
                                // debug($natlignepromoarticle);
                                // debug($nat['id']);
                            } else {
                                $natlignepromoarticle = $this->fetchTable('Natlignepromoarticles')->get($nat['id']);
                                $this->fetchTable('Natlignepromoarticles')->delete($natlignepromoarticle);
                            }
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->where(['Typeclients.grandsurface=0']);
        $clientpromoarticles = $this->fetchTable('Clientpromoarticles')->find('all', [
            'contain' => ['Clients']
        ])
            ->where(['promoarticle_id' => $id]);
        $gouvpromoarticles = $this->fetchTable('Gouvpromoarticles')->find('all', [
            'contain' => ['Gouvernorats']
        ])
            ->where(['promoarticle_id' => $id]);
        $lignepromoarticles = $this->fetchTable('Lignepromoarticles')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['promoarticle_id' => $id]);
        $natlignepromoarticles = $this->fetchTable('Natlignepromoarticles')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['promoarticle_id' => $id]);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id" => 1])->order(["Articles.Code" => 'asc']);
        $this->set(compact('natlignepromoarticles', 'articles', 'lignepromoarticles', 'gouvpromoarticles', 'typeclients', 'clientpromoarticles', 'promoarticle'));
    }


    public function notgrandsurface($id=null)
    {
    $promoarticle = null ;
     $this->set(compact('promoarticle','id'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $promoarticle = $this->Promoarticles->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());
            // die;
            //$promoarticle_id = $promoarticle->id;
            // debug($promoarticle_id);
            $promoarticle = $this->Promoarticles->patchEntity($promoarticle, $this->request->getData());
            if ($this->Promoarticles->save($promoarticle)) {
                $promoarticle_id = ($this->Promoarticles->save($promoarticle)->id);
                $this->misejour("Promoarticles", "add", $promoarticle_id);
                $this->loadModel('Clientpromoarticles');
                if (isset($this->request->getData('data')['clientpromoarticles']) && (!empty($this->request->getData('data')['clientpromoarticles']))) {
                    // debug($this->request->getData('data')['clientpromoarticles']);
                    // die;
                    foreach ($this->request->getData('data')['clientpromoarticles'] as $c => $cli) {
                        // debug($cli);
                        if ($cli['supc'] != 1) {
                            $dd['promoarticle_id'] = $promoarticle_id;
                            $dd['client_id'] = $cli['client_id'];
                            $dd['checkk'] = $cli['checkk'];
                            $clientpromoarticle = $this->fetchTable('Clientpromoarticles')->newEmptyEntity();
                            $clientpromoarticle = $this->Clientpromoarticles->patchEntity($clientpromoarticle, $dd);
                            if ($this->Clientpromoarticles->save($clientpromoarticle)) {
                                // debug($data);
                                //debug($clientpromoarticle);
                            }
                        }
                    }
                }
                $this->loadModel('Gouvpromoarticles');
                if (isset($this->request->getData('data')['gouvpromoarticles']) && (!empty($this->request->getData('data')['gouvpromoarticles']))) {
                    //debug($this->request->getData());

                    foreach ($this->request->getData('data')['gouvpromoarticles'] as $i => $tar) {
                        //debug($tar);
                        if ($tar['sup'] != 1) {
                            $data['promoarticle_id'] = $promoarticle_id;
                            $data['gouvernorat_id'] = $tar['gouvernorat_id'];
                            $data['toutgouv'] = $tar['toutgouv'];
                            $gouvpromoarticle = $this->fetchTable('Gouvpromoarticles')->newEmptyEntity();
                            $gouvpromoarticle = $this->Gouvpromoarticles->patchEntity($gouvpromoarticle, $data);
                            if ($this->Gouvpromoarticles->save($gouvpromoarticle)) {
                                //debug($data);
                                //debug($gouvpromoarticle);
                            }
                        }
                    }
                }
                $this->loadModel('Lignepromoarticles');
                if (isset($this->request->getData('data')['lignepromoarticles']) && (!empty($this->request->getData('data')['lignepromoarticles']))) {
                    //debug($this->request->getData());
                    foreach ($this->request->getData('data')['lignepromoarticles'] as $i => $tarr) {
                        //debug($tar);
                        if ($tar['sup0'] != 1) {
                            $dataa['promoarticle_id'] = $promoarticle_id;
                            $dataa['article_id'] = $tarr['article_id'];
                            $dataa['min'] = $tarr['min'];
                            $dataa['max'] = $tarr['max'];
                            $dataa['value'] = $tarr['value'];
                            $lignepromoarticle = $this->fetchTable('Lignepromoarticles')->newEmptyEntity();
                            $lignepromoarticle = $this->Lignepromoarticles->patchEntity($lignepromoarticle, $dataa);
                            if ($this->Lignepromoarticles->save($lignepromoarticle)) {
                                //debug($dataa);
                                //debug($lignepromoarticle);
                            }
                        }
                    }
                }
                $this->loadModel('Natlignepromoarticles');
                if (isset($this->request->getData('data')['natlignepromoarticles']) && (!empty($this->request->getData('data')['natlignepromoarticles']))) {
                    //debug($this->request->getData());
                    foreach ($this->request->getData('data')['natlignepromoarticles'] as $i => $nat) {
                        //debug($tar);
                        if ($nat['supn'] != 1) {
                            $dat['promoarticle_id'] = $promoarticle_id;
                            $dat['article_id'] = $nat['article_id'];
                            $dat['qte'] = $nat['qte'];
                            $dat['value'] = $nat['value'];
                            $natlignepromoarticle = $this->fetchTable('Natlignepromoarticles')->newEmptyEntity();
                            $natlignepromoarticle = $this->Natlignepromoarticles->patchEntity($natlignepromoarticle, $dat);
                            if ($this->Natlignepromoarticles->save($natlignepromoarticle)) {
                                //debug($dat);
                                //debug($natlignepromoarticle);
                            }
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->where(['Typeclients.grandsurface=0']);
        $typeclient = $this->fetchTable('Typeclients')->find('all', ['keyfield' => 'id', 'valueField' => 'type'])->where(['Typeclients.grandsurface=1']);
        foreach ($typeclient as $ac) {
            $ab = $ac['id'];
        }
        // $clients = $this->fetchTable('Clients')->find('all')->where(["Clients.typeclient_id = " . $ab . ""])->order(["Clients.Code" => 'asc']);
        //debug($clients);
        // die;
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id" => 1])->order(["Articles.Code" => 'asc']);
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('all')->order(["Gouvernorats.code" => 'asc']);
        $this->set(compact('articles', 'gouvernorats', 'typeclients', 'clients', 'promoarticle'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Promoarticle id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $promoarticle = $this->Promoarticles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());
            // die;
            $this->loadModel('Gouvpromoarticles');
            $data['promoarticle_id'] = $this->request->getData('promoarticle_id');
            $data['gouvernorat_id'] = $this->request->getData('gouvernorat_id');
            $data['toutgouv'] = $this->request->getData('toutgouv');
            $gouvpromoarticle = $this->Gouvpromoarticles->find('all')
                ->where(["Gouvpromoarticles.promoarticle_id  ='" . $id . "'"]);
            foreach ($gouvpromoarticle as $c) {
                $this->fetchTable('Gouvpromoarticles')->delete($c);
            }
            $this->loadModel('Clientpromoarticles');
            $dd['promoarticle_id'] = $this->request->getData('promoarticle_id');
            $dd['client_id'] = $this->request->getData('client_id');
            $dd['checkk'] = $this->request->getData('checkk');
            $clientpromoarticle = $this->Clientpromoarticles->find('all')
                ->where(["Clientpromoarticles.promoarticle_id  ='" . $id . "'"]);
            foreach ($clientpromoarticle as $clie) {
                $this->fetchTable('Clientpromoarticles')->delete($clie);
            }
            $this->loadModel('Lignepromoarticles');
            $dataa['promoarticle_id'] = $this->request->getData('promoarticle_id');
            $dataa['article_id'] = $this->request->getData('article_id');
            $dataa['id'] = $this->request->getData('id');
            $dataa['min'] = $this->request->getData('min');
            $dataa['max'] = $this->request->getData('max');
            $dataa['value'] = $this->request->getData('value');
            $lignepromoarticle = $this->Lignepromoarticles->find('all')
                ->where(["Lignepromoarticles.promoarticle_id  ='" . $id . "'"]);
            $this->loadModel('Natlignepromoarticles');
            $dat['promoarticle_id'] = $this->request->getData('promoarticle_id');
            $dat['article_id'] = $this->request->getData('article_id');
            $dat['id'] = $this->request->getData('id');
            $dat['qte'] = $this->request->getData('qte');
            $dat['value'] = $this->request->getData('value');

            $natlignepromoarticle = $this->Natlignepromoarticles->find('all')
                ->where(["Natlignepromoarticles.promoarticle_id  ='" . $id . "'"]);
            foreach ($natlignepromoarticle as $nat) {
                $this->fetchTable('Natlignepromoarticles')->delete($nat);
            }

            

            $promoarticle = $this->Promoarticles->patchEntity($promoarticle, $this->request->getData());
            if ($this->Promoarticles->save($promoarticle)) {
                $promoarticle_id = ($this->Promoarticles->save($promoarticle)->id);
                $this->misejour("Promoarticles", "edit", $promoarticle_id);
                $this->loadModel('Gouvpromoarticles');
                if (isset($this->request->getData('data')['gouvpromoarticles']) && (!empty($this->request->getData('data')['gouvpromoarticles']))) {
                    foreach ($this->request->getData('data')['gouvpromoarticles'] as $i => $tar) {
                        if ($tar['sup'] != 1) {
                            $data['promoarticle_id'] = $promoarticle_id;
                            $data['gouvernorat_id'] = $tar['gouvernorat_id'];
                            $data['toutgouv'] = $tar['toutgouv'];
                            $gouvpromoarticle = $this->fetchTable('Gouvpromoarticles')->newEmptyEntity();
                            $gouvpromoarticle = $this->Gouvpromoarticles->patchEntity($gouvpromoarticle, $data);
                            if ($this->Gouvpromoarticles->save($gouvpromoarticle)) {
                            }
                        }
                    }
                }
                $this->loadModel('Clientpromoarticles');
                if (isset($this->request->getData('data')['clientpromoarticles']) && (!empty($this->request->getData('data')['clientpromoarticles']))) {
                    foreach ($this->request->getData('data')['clientpromoarticles'] as $c => $cli) {
                        // debug($cli);
                        if ($cli['supc'] != 1) {
                            $dd['promoarticle_id'] = $promoarticle_id;
                            $dd['client_id'] = $cli['client_id'];
                            $dd['checkk'] = $cli['checkk'];
                            $clientpromoarticle = $this->fetchTable('Clientpromoarticles')->newEmptyEntity();
                            $clientpromoarticle = $this->Clientpromoarticles->patchEntity($clientpromoarticle, $dd);
                            if ($this->Clientpromoarticles->save($clientpromoarticle)) {
                                // debug($data);
                                //debug($clientpromoarticle);
                            }
                        }
                    }
                }
                $this->loadModel('Lignepromoarticles');
                if (isset($this->request->getData('data')['lignepromoarticles']) && (!empty($this->request->getData('data')['lignepromoarticles']))) {
                   // debug($this->request->getData('data')['lignepromoarticles']);
                   $lignepromoarticless = $this->fetchtable('Lignepromoarticles')->find('all')
                     ->where(["Lignepromoarticles.promoarticle_id ='" . $id . "'"]);
                     foreach ($lignepromoarticless as $lig) {
                    $this->fetchTable('Lignepromoarticles')->delete($lig);
                }
                    foreach ($this->request->getData('data')['lignepromoarticles'] as $i => $tarr) {
                        //debug($tar);
                        if ($tarr['sup0'] != 1) {
                            $dataa = $this->fetchTable('Lignepromoarticles')->newEmptyEntity();
                            $dataa['promoarticle_id'] = $promoarticle_id;
                            $dataa['article_id'] = $tarr['article_id'];
                            // $dataa['id'] = $tarr['id'];
                            $dataa['min'] = $tarr['min'];
                            $dataa['max'] = $tarr['max'];
                            $dataa['value'] = $tarr['value'];
                           
                           // $lignepromoarticles = $this->fetchTable('Lignepromoarticles')->patchEntity($lignepromoarticles, $dataa);
                            if ($this->fetchTable('Lignepromoarticles')->save($dataa)) {
                                //debug($dataa);die;
                               // debug($lignepromoarticles);
                            }
                        }
                    }
                }
                $this->loadModel('Natlignepromoarticles');
                if (isset($this->request->getData('data')['natlignepromoarticles']) && (!empty($this->request->getData('data')['natlignepromoarticles']))) {
                    //debug($this->request->getData());
                    foreach ($this->request->getData('data')['natlignepromoarticles'] as $p => $nat) {
                        //  debug($nat);die;
                        if ($nat['supn'] != 1) {
                            $dat['promoarticle_id'] = $promoarticle_id;
                            $dat['id'] = $nat['id'];
                            $dat['article_id'] = $nat['article_id'];
                            $dat['qte'] = $nat['qte'];
                            $dat['value'] = $nat['value'];
                            $natlignepromoarticle = $this->fetchTable('Natlignepromoarticles')->newEmptyEntity();
                            $natlignepromoarticle = $this->fetchTable('Natlignepromoarticles')->patchEntity($natlignepromoarticle, $dat);
                            if ($this->fetchTable('Natlignepromoarticles')->save($natlignepromoarticle)) {
                                // debug($natlignepromoarticle);
                                // debug($nat['id']);
                            }
                        }
                        // else {
                        //     $natlignepromoarticle = $this->fetchTable('Natlignepromoarticles')->get($nat['id']);
                        //     $this->fetchTable('Natlignepromoarticles')->delete($natlignepromoarticle);
                        // }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->where(['Typeclients.grandsurface=0']);
        $clientpromoarticles = $this->fetchTable('Clientpromoarticles')->find('all', [
            'contain' => ['Clients']
        ])
            ->where(['promoarticle_id' => $id]);
        $gouvpromoarticles = $this->fetchTable('Gouvpromoarticles')->find('all', [
            'contain' => ['Gouvernorats']
        ])
            ->where(['promoarticle_id' => $id]);
        $lignepromoarticles = $this->fetchTable('Lignepromoarticles')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['promoarticle_id' => $id]);
        $natlignepromoarticles = $this->fetchTable('Natlignepromoarticles')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['promoarticle_id' => $id]);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id" => 1])->order(["Articles.Code" => 'asc']);
        $this->set(compact('natlignepromoarticles', 'articles', 'lignepromoarticles', 'gouvpromoarticles', 'typeclients', 'clientpromoarticles', 'promoarticle'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Promoarticle id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->loadModel('Gouvpromoarticles');
        $this->loadModel('Lignepromoarticles');
        $this->loadModel('Natlignepromoarticles');
        $this->request->allowMethod(['post', 'delete']);
        $promoarticle = $this->Promoarticles->get($id);
        if ($this->Promoarticles->delete($promoarticle)) {
            $gouvpromoarticle = $this->fetchTable('Gouvpromoarticles')->find('all')
                ->where(["Gouvpromoarticles.promoarticle_id  =" . $id]);
            $lignepromoarticle = $this->fetchTable('Lignepromoarticles')->find('all')
                ->where(["Lignepromoarticles.promoarticle_id  =" . $id]);
            $natlignepromoarticle = $this->fetchTable('Natlignepromoarticles')->find('all')
                ->where(["Natlignepromoarticles.promoarticle_id  =" . $id]);
            if ($gouvpromoarticle != null) {
                foreach ($gouvpromoarticle as $c) {
                    $this->fetchTable('Gouvpromoarticles')->delete($c);
                }
            }
            if ($lignepromoarticle != null) {
                foreach ($lignepromoarticle as $cc) {
                    $this->fetchTable('Lignepromoarticles')->delete($cc);
                }
            }
            if ($natlignepromoarticle != null) {
                foreach ($natlignepromoarticle as $ccc) {
                    $this->fetchTable('Natlignepromoarticles')->delete($ccc);
                }
            }
            $promoarticle_id = ($this->Promoarticles->save($promoarticle)->id);
            $this->misejour("Promoarticles", "delete", $promoarticle_id);
        }
        return $this->redirect(['action' => 'index']);
    }
}
