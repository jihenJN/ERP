<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Gspromoarticles Controller
 *
 * @property \App\Model\Table\GspromoarticlesTable $Gspromoarticles
 * @method \App\Model\Entity\Gspromoarticle[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GspromoarticlesController extends AppController
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

       

        $query = $this->Gspromoarticles->find('all')->where([$cond1]);

        $this->paginate = [
            'contain' => [],
        ];

        $typeclients = $this->fetchTable('Typeclients')->find('all')->where(['Typeclients.grandsurface=1']);


        $gspromoarticles = $this->paginate($query);
        $this->set(compact('gspromoarticles','typeclients'));
    }
    public function grandsurface($id=null)
    {
    $gspromoarticle = null ;
     $this->set(compact('gspromoarticle','id'));
    }

    /**
     * View method
     *
     * @param string|null $id Gspromoarticle id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->loadModel('Clientgspromoarticles');
        $dd['gspromoarticle_id'] = $this->request->getData('gspromoarticle_id');
        $dd['client_id'] = $this->request->getData('client_id');
        $dd['checkk'] = $this->request->getData('checkk');
        $clientgspromoarticle = $this->Clientgspromoarticles->find('all')
            ->where(["Clientgspromoarticles.gspromoarticle_id  ='" . $id . "'"]);
        // echo (json_encode($clientgspromoarticle));
        // echo (json_encode($id));
        // foreach ($clientgspromoarticle as $clie) {
        //     $this->fetchTable('Clientgspromoarticles')->delete($clie);
        // }
        $this->loadModel('Lignegspromoarticles');
        $dat['gspromoarticle_id'] = $this->request->getData('gspromoarticle_id');
        $dat['article_id'] = $this->request->getData('article_id');
        $dat['id'] = $this->request->getData('id');
        $dat['qte'] = $this->request->getData('qte');
        $dat['value'] = $this->request->getData('value');
        $lignegspromoarticle = $this->Lignegspromoarticles->find('all')
            ->where(["Lignegspromoarticles.gspromoarticle_id  ='" . $id . "'"]);
        $gspromoarticle = $this->Gspromoarticles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $gspromoarticle = $this->Gspromoarticles->patchEntity($gspromoarticle, $this->request->getData());
            if ($this->Gspromoarticles->save($gspromoarticle)) {
                $gspromoarticle_id = ($this->Gspromoarticles->save($gspromoarticle)->id);
                //debug($this->request->getData());
                $this->misejour("Gspromoarticles", "edit", $gspromoarticle_id);
                $this->loadModel('Clientgspromoarticles');
                if (isset($this->request->getData('data')['clientgspromoarticles']) && (!empty($this->request->getData('data')['clientgspromoarticles']))) {
                    foreach ($this->request->getData('data')['clientgspromoarticles'] as $c => $cli) {
                        //debug($this->request->getData());
                        $this->loadModel('Clientgspromoarticles');
                        if (isset($this->request->getData('data')['clientgspromoarticles']) && (!empty($this->request->getData('data')['clientgspromoarticles']))) {
                            foreach ($this->request->getData('data')['clientgspromoarticles'] as $c => $cli) {
                                // debug($cli);
                                if ($cli['supc'] != 1) {
                                    $dd['gspromoarticle_id'] = $gspromoarticle_id;
                                    $dd['client_id'] = $cli['client_id'];
                                    $dd['checkk'] = $cli['checkk'];
                                    $clientgspromoarticle = $this->fetchTable('Clientgspromoarticles')->newEmptyEntity();
                                    $clientgspromoarticle = $this->Clientgspromoarticles->patchEntity($clientgspromoarticle, $dd);
                                    if ($this->Clientgspromoarticles->save($clientgspromoarticle)) {
                                        //debug($dd);
                                        //debug($clientgspromoarticle);
                                    }
                                }
                            }
                        }
                    }
                }
                $this->loadModel('Lignegspromoarticles');
                if (isset($this->request->getData('data')['lignegspromoarticles']) && (!empty($this->request->getData('data')['lignegspromoarticles']))) {
                    //debug($this->request->getData());
                    foreach ($this->request->getData('data')['lignegspromoarticles'] as $p => $nat) {
                        //  debug($nat);die;
                        if ($nat['supn'] != 1) {
                            $dat['gspromoarticle_id'] = $gspromoarticle_id;
                            $dat['id'] = $nat['id'];
                            $dat['article_id'] = $nat['article_id'];
                            $dat['qte'] = $nat['qte'];
                            $dat['value'] = $nat['value'];
                            $lignegspromoarticle = $this->fetchTable('Lignegspromoarticles')->newEmptyEntity();
                            $lignegspromoarticle = $this->Lignegspromoarticles->patchEntity($lignegspromoarticle, $dat);
                            if ($this->Lignegspromoarticles->save($lignegspromoarticle)) {
                                //debug($lignegspromoarticle);
                            }
                        } else {
                            $lignegspromoarticle = $this->fetchTable('Lignegspromoarticles')->get($nat['id']);
                            $this->fetchTable('Lignegspromoarticles')->delete($lignegspromoarticle);
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $clientgspromoarticles = $this->fetchTable('Clientgspromoarticles')->find('all', [
            'contain' => ['Clients']
        ])
            ->where(['gspromoarticle_id' => $id]);
        // echo (json_encode($clientgspromoarticles));
        // die;
        $lignegspromoarticles = $this->fetchTable('Lignegspromoarticles')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['gspromoarticle_id' => $id]);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id" => 1])->order(["Articles.Code" => 'asc']);
        $this->set(compact('articles', 'lignegspromoarticles', 'clientgspromoarticles', 'gspromoarticle'));
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
        $liendd = $session->read('lien_articles' . $abrv);
        //   debug($liendd);
        $gspromoarticle = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'gspromoarticles') {
                $gspromoarticle = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($gspromoarticle <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $gspromoarticle = $this->Gspromoarticles->newEmptyEntity();
        if ($this->request->is('post')) {
            $gspromoarticle = $this->Gspromoarticles->patchEntity($gspromoarticle, $this->request->getData());
            if ($this->Gspromoarticles->save($gspromoarticle)) {
                $gspromoarticle_id = ($this->Gspromoarticles->save($gspromoarticle)->id);
                $this->misejour("Gspromoarticles", "add", $gspromoarticle_id);
                $this->loadModel('Clientgspromoarticles');
                if (isset($this->request->getData('data')['clientgspromoarticles']) && (!empty($this->request->getData('data')['clientgspromoarticles']))) {
                    foreach ($this->request->getData('data')['clientgspromoarticles'] as $c => $cli) {
                        //debug($cli);
                        if ($cli['supc'] != 1) {
                            $dd['gspromoarticle_id'] = $gspromoarticle_id;
                            $dd['client_id'] = $cli['client_id'];
                            $dd['checkk'] = $cli['checkk'];
                            $clientgspromoarticle = $this->fetchTable('Clientgspromoarticles')->newEmptyEntity();
                            $clientgspromoarticle = $this->Clientgspromoarticles->patchEntity($clientgspromoarticle, $dd);
                            if ($this->Clientgspromoarticles->save($clientgspromoarticle)) {
                                //debug($dd);
                                //debug($clientgspromoarticle);
                            }
                        }
                    }
                }
                $this->loadModel('Lignegspromoarticles');
                if (isset($this->request->getData('data')['lignegspromoarticles']) && (!empty($this->request->getData('data')['lignegspromoarticles']))) {
                    //debug($this->request->getData());
                    foreach ($this->request->getData('data')['lignegspromoarticles'] as $i => $nat) {
                        //debug($nat);
                        if ($nat['supn'] != 1) {
                            $dat['gspromoarticle_id'] = $gspromoarticle_id;
                            $dat['article_id'] = $nat['article_id'];
                            $dat['qte'] = 0;
                            $dat['value'] = $nat['value'];
                            $lignegspromoarticle = $this->fetchTable('Lignegspromoarticles')->newEmptyEntity();
                            $lignegspromoarticle = $this->Lignegspromoarticles->patchEntity($lignegspromoarticle, $dat);
                            if ($this->Lignegspromoarticles->save($lignegspromoarticle)) {
                                //debug($dat);
                                //debug($lignegspromoarticle);
                            }
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $typeclient = $this->fetchTable('Typeclients')->find('all', ['keyfield' => 'id', 'valueField' => 'type'])->where(['Typeclients.grandsurface=1']);
        $dett = 0;
        foreach ($typeclient as $ac) {
            $dett = $dett . ',' . $ac->id;
        }
        // debug($dett);
        // die;
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id" => 1])->order(["Articles.Code" => 'asc']);
        $clients = $this->fetchTable('Clients')->find('all')->where(['Clients.typeclient_id  in (' . $dett . ')']);
        // debug($clients);
        $this->set(compact('articles', 'clients', 'gspromoarticle'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Gspromoarticle id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        //   debug($liendd);
        $gspromoarticle = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'gspromoarticles') {
                $gspromoarticle = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($gspromoarticle <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $gspromoarticle = $this->Gspromoarticles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->loadModel('Clientgspromoarticles');
            $dd['gspromoarticle_id'] = $this->request->getData('gspromoarticle_id');
            $dd['client_id'] = $this->request->getData('client_id');
            $dd['checkk'] = $this->request->getData('checkk');
            //debug ($clientgspromoarticle);die;
            // echo (json_encode($id));

            $this->loadModel('Lignegspromoarticles');
            $dat['gspromoarticle_id'] = $this->request->getData('gspromoarticle_id');
            $dat['article_id'] = $this->request->getData('article_id');
            $dat['id'] = $this->request->getData('id');
            $dat['qte'] = $this->request->getData('qte');
            $dat['value'] = $this->request->getData('value');
            $lignegspromoarticle = $this->Lignegspromoarticles->find('all')
                ->where(["Lignegspromoarticles.gspromoarticle_id  =" . $id]);
            // foreach ($lignegspromoarticle as $cl) {
            //     $this->fetchTable('Lignegspromoarticles')->delete($cl);
            // }
            $clientgspromoarticle = $this->Clientgspromoarticles->find('all')
                ->where(["Clientgspromoarticles.gspromoarticle_id=" . $id]);
            foreach ($clientgspromoarticle as $clie) {
                $this->fetchTable('Clientgspromoarticles')->delete($clie);
            }
            $gspromoarticle = $this->Gspromoarticles->patchEntity($gspromoarticle, $this->request->getData());
            if ($this->Gspromoarticles->save($gspromoarticle)) {
                $gspromoarticle_id = ($this->Gspromoarticles->save($gspromoarticle)->id);
                //debug($this->request->getData());
                $this->misejour("Gspromoarticles", "edit", $gspromoarticle_id);
                $this->loadModel('Clientgspromoarticles');
                $this->loadModel('Clientgspromoarticles');
                if (isset($this->request->getData('data')['clientgspromoarticles']) && (!empty($this->request->getData('data')['clientgspromoarticles']))) {
                    foreach ($this->request->getData('data')['clientgspromoarticles'] as $c => $cli) {
                        // debug($cli);
                        if ($cli['supc'] != 1) {
                            $dd['gspromoarticle_id'] = $gspromoarticle_id;
                            $dd['client_id'] = $cli['client_id'];
                            $dd['checkk'] = $cli['checkk'];
                            $clientgspromoarticle = $this->fetchTable('Clientgspromoarticles')->newEmptyEntity();
                            $clientgspromoarticle = $this->Clientgspromoarticles->patchEntity($clientgspromoarticle, $dd);
                            if ($this->Clientgspromoarticles->save($clientgspromoarticle)) {
                                //debug($dd);
                                //debug($clientgspromoarticle);
                            }
                        } else {
                            $clientgspromoarticle = $this->fetchTable('Clientgspromoarticles')->get($cli['id']);
                            $this->fetchTable('Clientgspromoarticles')->delete($clientgspromoarticle);
                        }
                    }
                }

                $this->loadModel('Lignegspromoarticles');
                if (isset($this->request->getData('data')['lignegspromoarticles']) && (!empty($this->request->getData('data')['lignegspromoarticles']))) {
                    //debug($this->request->getData());
                    foreach ($this->request->getData('data')['lignegspromoarticles'] as $p => $nat) {
                        //  debug($nat);die;
                        if ($nat['supn'] != 1) {
                            $dat['gspromoarticle_id'] = $gspromoarticle_id;
                            $dat['id'] = $nat['id'];
                            $dat['article_id'] = $nat['article_id'];
                            //   $dat['qte'] = $nat['qte'];
                            $dat['value'] = $nat['value'];
                            if (isset($nat['id']) && (!empty($nat['id']))) {
                                $lp = $this->fetchTable('Lignegspromoarticles')->get($nat['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lp = $this->fetchTable('Lignegspromoarticles')->newEmptyEntity();
                            }
                            // debug($lp);


                            $lp = $this->fetchTable('Lignegspromoarticles')->patchEntity($lp, $dat);


                            // debug($lp);

                            $this->fetchTable('Lignegspromoarticles')->save($lp);
                        } else {
                            $lignegspromoarticle = $this->fetchTable('Lignegspromoarticles')->get($nat['id']);
                            $this->fetchTable('Lignegspromoarticles')->delete($lignegspromoarticle);
                        }
                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }
        $clientgspromoarticles = $this->fetchTable('Clientgspromoarticles')->find('all', [
            'contain' => ['Clients']
        ])
            ->where(['gspromoarticle_id' => $id]);
        // echo (json_encode($clientgspromoarticles));
        // die;
        $lignegspromoarticles = $this->fetchTable('Lignegspromoarticles')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['gspromoarticle_id' => $id]);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id" => 1])->order(["Articles.Code" => 'asc']);
        $this->set(compact('articles', 'lignegspromoarticles', 'clientgspromoarticles', 'gspromoarticle'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Gspromoarticle id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        //   debug($liendd);
        $gspromoarticle = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'gspromoarticles') {
                $gspromoarticle = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($gspromoarticle <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $gspromoarticle = $this->Gspromoarticles->get($id);
        if ($this->Gspromoarticles->delete($gspromoarticle)) {
            $gspromoarticle_id = ($this->Gspromoarticles->save($gspromoarticle)->id);
            $this->loadModel('Clientgspromoarticles');
            $this->loadModel('Lignegspromoarticles');
            $this->misejour("Gspromoarticles", "delete", $gspromoarticle_id);
            $clientgspromoarticle = $this->Clientgspromoarticles->find('all')
                ->where(["Clientgspromoarticles.gspromoarticle_id  ='" . $id . "'"]);
            foreach ($clientgspromoarticle as $clie) {
                $this->fetchTable('Clientgspromoarticles')->delete($clie);
            }
            $lignegspromoarticle = $this->Lignegspromoarticles->find('all')
                ->where(["Lignegspromoarticles.gspromoarticle_id  ='" . $id . "'"]);
            foreach ($lignegspromoarticle as $cl) {
                $this->fetchTable('Lignegspromoarticles')->delete($cl);
            }
        }

        return $this->redirect(['action' => 'index']);
    }
}
