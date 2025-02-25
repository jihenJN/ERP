<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Tarifs Controller
 *
 * @property \App\Model\Table\TarifsTable $Tarifs
 * @method \App\Model\Entity\Tarif[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TarifsController extends AppController
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
        $tarifs = $this->paginate($this->Tarifs);

        $this->set(compact('tarifs'));
    }

    public function imprimeview($id = null)
    {
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        //debug($fam); // die;
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }

        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }
        // debug($cond100);

        $articles = $this->Tarifs->Articles->find('all')->where([$cond100]);
        //debug($articles);
        //die;
        $tarif = $this->Tarifs->get($id, [
            'contain' => []
        ]);
        $this->paginate = [
            'contain' => ['Typeclients'],
        ];
        $tarifs = $this->paginate($this->Tarifs);
        $tarif = $this->Tarifs->patchEntity($tarif, $this->request->getData());
        if ($this->Tarifs->save($tarif)) {
            $tarif_id = $tarif->id;
            if (isset($this->request->getData('data')['tarifclients']) && (!empty($this->request->getData('data')['tarifclients']))) {
                //debug($this->request->getData());die;
                $this->loadModel('Tarifclients');
                foreach ($this->request->getData('data')['tarifclients'] as $i => $tar) {
                    //debug($tar);
                    if ($tar['sup0'] != 1) {
                        $data['tarif_id'] = $tarif_id;
                        $data['article_id'] = $tar['article_id'];
                        $data['prix'] = $tar['prix'];
                        // $data['date'] = $tar['date'];
                    }
                }
            }
        }
        $tarifclients = $this->Tarifs->Tarifclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['tarif_id' => $id]);

        $typeclients = $this->Tarifs->Typeclients->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('tarifclients', 'tarifs','tarif', 'articles', 'typeclients'));
    }
    /**
     * View method
     *
     * @param string|null $id Tarif id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        //debug($fam); // die;
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }

        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }
        // debug($cond100);

        $articles = $this->Tarifs->Articles->find('all')->where([$cond100]);
        //debug($articles);
        //die;
        $tarif = $this->Tarifs->get($id, [
            'contain' => []
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $tarif = $this->Tarifs->patchEntity($tarif, $this->request->getData());
            if ($this->Tarifs->save($tarif)) {
                $tarif_id = $tarif->id;
                if (isset($this->request->getData('data')['tarifclients']) && (!empty($this->request->getData('data')['tarifclients']))) {
                    //debug($this->request->getData());die;
                    $this->loadModel('Tarifclients');
                    foreach ($this->request->getData('data')['tarifclients'] as $i => $tar) {
                        //debug($tar);
                        if ($tar['sup0'] != 1) {
                            $data['tarif_id'] = $tarif_id;
                            $data['article_id'] = $tar['article_id'];
                            $data['prix'] = $tar['prix'];
                            // $data['date'] = $tar['date'];
                            $tarifclient = $this->fetchTable('Tarifclients')->newEmptyEntity();
                            $tarifclient = $this->Tarifclients->patchEntity($tarifclient, $data);
                            if ($this->Tarifclients->save($tarifclient)) {
                                return $this->redirect(['action' => 'index']);
                            } else {
                            }
                        }
                    }
                }
            }
        }
        $tarifclients = $this->Tarifs->Tarifclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['tarif_id' => $id]);

        $typeclients = $this->Tarifs->Typeclients->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('tarifclients', 'tarif', 'articles', 'typeclients'));
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
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tarifs') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        //debug($fam); // die;
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }

        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }
        // debug($cond100);

        $articles = $this->Tarifs->Articles->find('all')->where([$cond100]);
        // debug($articles);
        // die;
        $tarif = $this->Tarifs->newEmptyEntity();
        //debug($tarif);die;
        if ($this->request->is('post')) {

            //  debug($tarif);die;
           // debug($this->request->getData());//die;
            $tarif_id = $tarif->id;
            $tarif = $this->Tarifs->patchEntity($tarif, $this->request->getData());
            // debug($tarif);die;
            if ($this->Tarifs->save($tarif)) {
                $tarif_id = ($this->Tarifs->save($tarif)->id);
                $this->misejour("Tarifs", "add", $tarif_id);
  
                // debug('hh');
                $this->loadModel('Etatbases');
                $etatbasess=$this->Etatbases->find('all');
                 foreach ($etatbasess as $i => $etat) {
                    // debug($etat);//die;
                     $etatbase = $this->fetchTable('Etatbases')->get($etat->id, [
                    'contain' => []
                ]);
                     $etatbase->etat =0;
                     $this->fetchTable('Etatbases')->save($etatbase);
                 }
                         //debug($etatbase);die;
               // $etatbase->etat =0;
       
              //  $this->fetchTable('Etatbases')->save($etatbase);
              // $data['date'] = $this->request->getData('date');
            $this->loadModel('Tarifclients');
                if (isset($this->request->getData('data')['tarifclients']) && (!empty($this->request->getData('data')['tarifclients']))) {
                    //debug($this->request->getData());die;
                    $this->loadModel('Tarifclients');
                    foreach ($this->request->getData('data')['tarifclients'] as $i => $tar) {
                        //debug($tar);
                        if ($tar['sup0'] != 1) {
                                      $data['date'] = $this->request->getData('date');
                            $data['tarif_id'] = $tarif_id;
                            $data['article_id'] = $tar['article_id'];
                            $data['prix'] = $tar['prix'];
                            $data['inserted'] =1;
                            // $data['date'] = $tar['date'];
                         //   debug($data);//die;
                            $tarifclient = $this->fetchTable('Tarifclients')->newEmptyEntity();
                           //debug($tarifclient);//die;
                            $tarifclient = $this->Tarifclients->patchEntity($tarifclient, $data);
                            if ($this->Tarifclients->save($tarifclient)) {
                            } else {
                            }
                        }
                    }
                }
            }
            return $this->redirect(['action' => 'index']);
        }

        //debug($articles);die;
        $typeclients = $this->Tarifs->Typeclients->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('tarif', 'articles', 'typeclients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Tarif id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
   $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tarifs') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        //debug($fam); // die;
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }

        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }
        // debug($cond100);
        $articles = $this->Tarifs->Articles->find('all')->where([$cond100]);
        //debug($articles);
        //die;
        $tarif = $this->Tarifs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());die;
            $tarif = $this->Tarifs->patchEntity($tarif, $this->request->getData());
            if ($this->Tarifs->save($tarif)) {
                
                $tarif_id = $tarif->id;
                        $this->loadModel('Etatbases');
                $etatbasess=$this->Etatbases->find('all');
                 foreach ($etatbasess as $i => $etat) {
                     //debug($etat);//die;
                     $etatbase = $this->fetchTable('Etatbases')->get($etat->id, [
                    'contain' => []
                ]);
                     $etatbase->etat =0;
                     $this->fetchTable('Etatbases')->save($etatbase);
                 }
                $tarif_id = ($this->Tarifs->save($tarif)->id);
                $this->misejour("Tarifs", "edit", $tarif_id);
                $this->loadModel('Tarifclients');
                $tarifclient = $this->Tarifclients->find('all')
                    ->where(["Tarifclients.tarif_id  ='" . $id . "'"]);
                foreach ($tarifclient as $c) {
                    $this->Tarifs->Tarifclients->delete($c);
                }
                if (isset($this->request->getData('data')['tarifclients']) && (!empty($this->request->getData('data')['tarifclients']))) {
                    //debug($this->request->getData());die;
                    $this->loadModel('Tarifclients');
                    foreach ($this->request->getData('data')['tarifclients'] as $i => $tar) {
                        //debug($tar);die;
                        if ($tar['sup0'] != 1) {
                            $data['tarif_id'] = $tarif_id;
                            $data['article_id'] = $tar['article_id'];
                            $data['prix'] = $tar['prix'];
                            $data['inserted'] =1;
                            // $data['date'] = $tar['date'];
                            $tarifclient = $this->fetchTable('Tarifclients')->newEmptyEntity();
                            $tarifclient = $this->Tarifclients->patchEntity($tarifclient, $data);
                            if ($this->Tarifclients->save($tarifclient)) {
                            } else {
                            }
                        }
                    }
                }
            }
            return $this->redirect(['action' => 'index']);
        }
        $tarifclients = $this->Tarifs->Tarifclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['tarif_id' => $id]);

        $typeclients = $this->Tarifs->Typeclients->find('list', ['keyfield' => 'id', 'valueField' => 'type']);
        $this->set(compact('tarifclients', 'tarif', 'articles', 'typeclients'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Tarif id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
      $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'tarifs') {
                $societe = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->request->allowMethod(['post', 'delete']);
        $tarif = $this->Tarifs->get($id);
        $this->loadModel('Tarifclients');
        $tarifclient = $this->Tarifclients->find('all')
            ->where(["Tarifclients.tarif_id  ='" . $id . "'"]);
        foreach ($tarifclient as $c) {
            $this->Tarifs->Tarifclients->delete($c);
        }
        if ($this->Tarifs->delete($tarif)) {
            $tarif_id = ($this->Tarifs->save($tarif)->id);
            $this->misejour("Tarifs", "delete", $tarif_id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }
}
