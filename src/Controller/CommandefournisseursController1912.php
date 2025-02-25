<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Commandes Controller
 *
 * @property \App\Model\Table\CommandesTable $Commandes
 * @method \App\Model\Entity\Commande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommandefournisseursController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function imprimeview($id = null) {
        $this->loadModel('Demandeoffredeprixes');
        $commandefournisseur = $this->Commandefournisseurs->get($id, [
            'contain' => ['Fournisseurs']
        ]);
        //debug($commandefournisseur);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $this->loadModel('Lignecommandefournisseurs');
        $lignecommandefournisseurs = $this->Lignecommandefournisseurs->find('all')->contain(['Articles'])->where(["Lignecommandefournisseurs.commandefournisseur_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $commandefournisseurs = $this->Commandefournisseurs->find('all')->contain(['Fournisseurs']);
       
       // debug($commandefournisseur['demandeoffredeprix_id']);
        $dopnum=$this->Demandeoffredeprixes->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])
                ->where(["Demandeoffredeprixes.id  ='".$commandefournisseur['demandeoffredeprix_id']."'"]);
        //debug($dopnum);
       $tab1=array();
        foreach($dopnum as $tab1)
        { 
        }
       
        $this->set(compact('lignecommandefournisseurs','tab1','articles', 'commandefournisseur', 'fournisseurs'));
    }

    public function index() {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $cond8 = '';
        $cond9 = '';
        $cond10 = '';
        $cond11 = '';

        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $numero = $this->request->getQuery('numero');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
        $materieltransport_id = $this->request->getQuery('materieltransport_id');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $chauffeur = $this->request->getQuery('chauffeur');
        $depot_id = $this->request->getQuery('depot_id');
        $convoyeur = $this->request->getQuery('convoyeur');
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        $annee = $this->request->getQuery('annee');

        if ($fournisseur_id) {
            $cond1 = "Commandefournisseurs.fournisseur_id   ='" . $fournisseur_id . "'";
        }
        if ($numero) {
            $cond2 = "Commandefournisseurs.numero   like  '%" . $numero . "%' ";
        }
        if ($datedebut) {
            $cond3 = "Commandefournisseurs.date <=  '" . $datedebut . "'";
        }
        if ($datefin) {
            $cond4 = "Commandefournisseurs.date >=  '" . $datefin . "'";
        }
        if ($materieltransport_id) {
            $cond5 = "Commandefournisseurs.materieltransport_id = '" . $materieltransport_id . "'";
        }
        if ($pointdevente_id) {
            $cond6 = "Commandefournisseurs.pointdevente_id =  '" . $pointdevente_id . "'";
        }
        if ($depot_id) {
            $cond7 = "Commandefournisseurs.depot_id =  '" . $depot_id . "'";
        }
        if ($cartecarburant_id) {
            $cond8 = "Commandefournisseurs.cartecarburant_id = '" . $cartecarburant_id . "'";
        }
        if ($convoyeur) {
            $cond9 = "Commandefournisseurs.convoyeur =  '" . $convoyeur . "'";
        }
        if ($chauffeur) {
            $cond10 = "Commandefournisseurs.chauffeur =  '" . $chauffeur . "'";
        }



        $query = $this->Commandefournisseurs->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9, $cond10])
                ->order(['Commandefournisseurs.id'=>'DESC']);
        
        
        
        
        
        //$this->loadModel('Personnels');
        $this->paginate = [
            'contain' => ['Demandeoffredeprixes', 'Fournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports'],
        ];
        $commandes = $this->paginate($query);
        //debug($commandes);


        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $pointdeventes = $this->Commandefournisseurs->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //$chauffeurs= $this->Commandefournisseurs->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"'),'fields'=>array('Commandes->Personnels.code','Commandes->Personnels.nom','Commandes->Personnels.prenom')));
        $chauffeurs = $this->Commandefournisseurs->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="1"'), 'fields' => array('Personnels.code', 'Personnels.nom', 'Personnels.prenom')));

        $confaieurs = $this->Commandefournisseurs->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="5"'), 'fields' => array('Personnels.code', 'Personnels.nom', 'Personnels.prenom')));
        //$chauffeurs=$this->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id="1"')));
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);
        $this->set(compact('confaieurs', 'commandes', 'fournisseurs', 'chauffeurs', 'materieltransports', 'pointdeventes', 'depots', 'cartecarburants'));
    }

    /**
     * View method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $commande = $this->Commandefournisseurs->get($id, [
            'contain' => ['Demandeoffredeprixes', 'Fournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports', 'Lignecommandefournisseurs'],
        ]);

        
                             //        $session = $this->request->getSession();
//        $abrv = $session->read('abrvv');
//        $liendd = $session->read('lien_parametrage' . $abrv);
//        //   debug($liendd);
//        $cmd = 0;
//        foreach ($liendd as $k => $liens) {
//            //  debug($liens);
//            if (@$liens['lien'] == 'demandeoffredeprixes') {
//                $cmd = $liens['modif'];
//            }
//        }
//        // debug($societe);die;
//        if (($cmd <> 1)) {
//            $this->redirect(array('controller' => 'Commandefournisseurs', 'action' => 'login'));
//        }
        $this->loadModel('Lignecommandefournisseurs');
        $commande = $this->Commandefournisseurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());
            $commande = $this->Commandefournisseurs->patchEntity($commande, $this->request->getData());
            if ($this->Commandefournisseurs->save($commande)) {
                                
                $commande_id = $commande->id;
                $lignecmd = $this->Lignecommandefournisseurs->find('all', [])
                        ->where(["Lignecommandefournisseurs.commandefournisseur_id  ='" . $id . "'"]);
                foreach ($lignecmd as $c) {
                    $this->Commandefournisseurs->Lignecommandefournisseurs->delete($c);
                }







                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    $this->loadModel('Commandefournisseurs');
                    foreach ($this->request->getData('data')['ligner'] as $i => $commande) {
                        // debug($commande);
                        if ($commande['sup0'] != 1) {
                            $data['commandefournisseur_id'] = $commande_id;
                            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
                            $data['date'] = date('d-m-y');
                            $data['qte'] = $commande['qte'];
                            $data['prix'] = $commande['prix'];
                            $data['punht'] = $commande['punht'];
                            $data['article_id'] = $commande['article_id'];
                            $data['remise'] = $commande['remise'];
                            $data['fodec'] = $commande['fodec'];
                            $data['tva'] = $commande['tva'];
                            $data['ttc'] = $commande['ttc'];
                            $cd = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity(); //fetchtable pour creer une ligne vide avant de la remplir
                            $cd = $this->Lignecommandefournisseurs->patchEntity($cd, $data);
                            // debug($cd);
                            //debug($data);
                            if ($this->Lignecommandefournisseurs->save($cd)) {
                                //   debug($cd);
                                // $this->Flash->success("Lignecommandefournisseur has been created successfully");
                                //debug($cd);
                            } else {
                                //$this->Flash->error("Failed to create Lignecommandefournisseur");
                            }

                            $this->set(compact("cd"));
                        }
                    }
                }








                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }
        $lignecommandes = $this->Commandefournisseurs->Lignecommandefournisseurs->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['commandefournisseur_id' => $id]);
        $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandefournisseurs->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['limit' => 200]);
        $articles = $this->Commandefournisseurs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])
                ->where(["Articles.vente" => 0])
        ;
        $this->set(compact('commande', 'lignecommandes', 'articles', 'demandeoffredeprixes', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }
        
        
        
        

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add() {
                             //        $session = $this->request->getSession();
//        $abrv = $session->read('abrvv');
//        $liendd = $session->read('lien_parametrage' . $abrv);
//        //   debug($liendd);
//        $cmd = 0;
//        foreach ($liendd as $k => $liens) {
//            //  debug($liens);
//            if (@$liens['lien'] == 'demandeoffredeprixes') {
//                $cmd = $liens['ajout'];
//            }
//        }
//        // debug($societe);die;
//        if (($cmd <> 1)) {
//            $this->redirect(array('controller' => 'Commandefournisseurs', 'action' => 'login'));
//        }
        $this->loadModel('Articles');
        $this->loadModel('Lignecommandefournisseurs');
        $num = $this->Commandefournisseurs->find()->select(["numdepot" =>
                    'MAX(Commandefournisseurs.numero)'])->first();
        $numero = $num->numdepot;
        $n = 0;
        $n = $numero;

        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
            //debug($b);
        } else {
            $n = "C00001";
            $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
            $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        }

        $this->set(compact('b'));

        $this->paginate = [
            'contain' => ['Demandeoffredeprixes', 'Articles', 'Commandefournisseurs', 'Fournisseurs', 'Pointdeventes', 'Depots', 'Personnels', 'Cartecarburants', 'Materieltransports'],
        ];

        $commande = $this->Commandefournisseurs->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());
            $num = $this->Commandefournisseurs->find()->select(["numdepot" =>
                        'MAX(Commandefournisseurs.numero)'])->first();
            $numero = $num->numdepot;
            // debug($numero);die;
            // C00030

            $n = 0;
            $n = $numero;

            if (!empty($n)) {
                $ff = intval(substr($n, 3, 7)) + 1;
                $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
                $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
                //debug($b);
            } else {
                $n = "C00001";
                $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
                $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
            }

            $this->set(compact('b'));
            //debug($this->request->getData());
            $commande = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
            $commande = $this->Commandefournisseurs->patchEntity($commande, $this->request->getData());
         
            if ($this->Commandefournisseurs->save($commande)) {
                
                              $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
              $this->misejour("Commandefournisseurs", "add", $cmd_id);
//                debug($commande);
                $commande_id = $commande->id;

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    $this->loadModel('Commandefournisseurs');
                    foreach ($this->request->getData('data')['ligner'] as $i => $commande) {
                        // debug($commande);
                        if ($commande['sup0'] != 1) {
                            $data['commandefournisseur_id'] = $commande_id;
                            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
                            $data['date'] = date('d-m-y');
                            $data['qte'] = $commande['qte'];
                            $data['prix'] = $commande['prix'];
                            $data['ht'] = $commande['punht'];
                            $data['article_id'] = $commande['article_id'];
                            $data['remise'] = $commande['remise'];
                            $data['fodec'] = $commande['fodec'];
                            $data['tva'] = $commande['tva'];
                            $data['ttc'] = $commande['ttc'];
                            $cd = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity(); //fetchtable pour creer une ligne vide avant de la remplir
                            $cd = $this->Lignecommandefournisseurs->patchEntity($cd, $data);
                            //debug($cd);die;
                            if ($this->Lignecommandefournisseurs->save($cd)) {
                              
                            } else {
                                
                            }

                            $this->set(compact("cd"));
                        }
                    }
                }









           

                return $this->redirect(['action' => 'index']);
            }
        }
        $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandefournisseurs->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['limit' => 200]);

        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['limit' => 200]);
        
        $cond = 'Articles.famille_id != 1 ';

        $articles = $this->Commandefournisseurs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])
                ->where([$cond]) ; 
        ;
        // debug($articles);
        //debug($articles);die();
        $this->set(compact('commande', 'articles', 'demandeoffredeprixes', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
                             //        $session = $this->request->getSession();
//        $abrv = $session->read('abrvv');
//        $liendd = $session->read('lien_parametrage' . $abrv);
//        //   debug($liendd);
//        $cmd = 0;
//        foreach ($liendd as $k => $liens) {
//            //  debug($liens);
//            if (@$liens['lien'] == 'demandeoffredeprixes') {
//                $cmd = $liens['modif'];
//            }
//        }
//        // debug($societe);die;
//        if (($cmd <> 1)) {
//            $this->redirect(array('controller' => 'Commandefournisseurs', 'action' => 'login'));
//        }
        $this->loadModel('Lignecommandefournisseurs');
        $commande = $this->Commandefournisseurs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
             $num = $this->Commandefournisseurs->find()->select(["numdepot" =>
                    'MAX(Commandefournisseurs.numero)'])->first();
        $numero = $num->numdepot;
        $n = 0;
        $n = $numero;

        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
            //debug($b);
        } else {
            $n = "C00001";
            $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
            $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        }

        $this->set(compact('b'));
            // debug($this->request->getData());
            $commande = $this->Commandefournisseurs->patchEntity($commande, $this->request->getData());
            if ($this->Commandefournisseurs->save($commande)) {
                                   $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
               $this->misejour("Commandefournisseurs", "edit", $cmd_id);
                $commande_id = $commande->id;
                $lignecmd = $this->Lignecommandefournisseurs->find('all', [])
                        ->where(["Lignecommandefournisseurs.commandefournisseur_id  ='" . $id . "'"]);
                foreach ($lignecmd as $c) {
                    $this->Commandefournisseurs->Lignecommandefournisseurs->delete($c);
                }







                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    $this->loadModel('Commandefournisseurs');
                    foreach ($this->request->getData('data')['ligner'] as $i => $commande) {
                        // debug($commande);
                        if ($commande['sup0'] != 1) {
                            $data['commandefournisseur_id'] = $commande_id;
                            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
                            $data['date'] = date('d-m-y');
                            $data['qte'] = $commande['qte'];
                            $data['prix'] = $commande['prix'];
                            $data['ht'] = $commande['punht'];
                            $data['article_id'] = $commande['article_id'];
                            $data['remise'] = $commande['remise'];
                            $data['fodec'] = $commande['fodec'];
                            $data['tva'] = $commande['tva'];
                            $data['ttc'] = $commande['ttc'];
                            $cd = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity(); //fetchtable pour creer une ligne vide avant de la remplir
                            $cd = $this->Lignecommandefournisseurs->patchEntity($cd, $data);
                            // debug($cd);
                            //debug($data);
                            if ($this->Lignecommandefournisseurs->save($cd)) {
                                //   debug($cd);
                                // $this->Flash->success("Lignecommandefournisseur has been created successfully");
                                //debug($cd);
                            } else {
                                //$this->Flash->error("Failed to create Lignecommandefournisseur");
                            }

                            $this->set(compact("cd"));
                        }
                    }
                }








                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }
        $lignecommandes = $this->Commandefournisseurs->Lignecommandefournisseurs->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['commandefournisseur_id' => $id]);
        $demandeoffredeprixes = $this->Commandefournisseurs->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $fournisseurs = $this->Commandefournisseurs->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Commandefournisseurs->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Commandefournisseurs->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Commandefournisseurs->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Commandefournisseurs->Materieltransports->find('list', ['limit' => 200]);
        $articles = $this->Commandefournisseurs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])
                ->where(["Articles.vente" => 0]);
        $this->set(compact('commande', 'lignecommandes', 'articles', 'demandeoffredeprixes', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
                       //        $session = $this->request->getSession();
//        $abrv = $session->read('abrvv');
//        $liendd = $session->read('lien_parametrage' . $abrv);
//        //   debug($liendd);
//        $cmd = 0;
//        foreach ($liendd as $k => $liens) {
//            //  debug($liens);
//            if (@$liens['lien'] == 'demandeoffredeprixes') {
//                $cmd = $liens['supp'];
//            }
//        }
//        // debug($societe);die;
//        if (($cmd <> 1)) {
//            $this->redirect(array('controller' => 'Commandefournisseurs', 'action' => 'login'));
//        }
        $this->loadModel('Lignecommandefournisseurs');
        $this->request->allowMethod(['post', 'delete']);
        $commande = $this->Commandefournisseurs->get($id);
      // debug($commande);die;
      
        $lignecommande = $this->Lignecommandefournisseurs->find('all')
               ->where(["Lignecommandefournisseurs.commandefournisseur_id  ='" . $id . "'"]);
        foreach ($lignecommande as $c) {
        $this->Commandefournisseurs->Lignecommandefournisseurs->delete($c);
        }if (isset($commande['demandeoffredeprix_id']))
            {
              //debug('rrr');
                $this->loadModel('Demandeoffredeprixes');
                $demande=$this->Demandeoffredeprixes->find('all', [])
                ->where(["Demandeoffredeprixes.id  ='" .$commande['demandeoffredeprix_id'] . "'"]);
                //debug($demande);
                foreach($demande as $d)
                 $d->commande = '0';
                   //debug($d);
                     $this->Demandeoffredeprixes->save($d);
                     
            }
            
        
    
         else{}
      
if ($this->Commandefournisseurs->delete($commande)) {
    
    
  $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
                $this->misejour("Commandefournisseurs", "delete", $cmd_id);
        
}


        return $this->redirect(['action' => 'index']);
    }

    public function validation($id = null) {

        $this->paginate = [
            'contain' => ['Demandeoffredeprixes', 'Articles', 'Fournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports'],
        ];
        $this->loadModel('Fournisseurs');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Depots');
        $commande = $this->Commandefournisseurs->get($id, [
            'contain' => []
        ]);
        // $commande = $this->Commandefournisseurs->newEmptyEntity();
        $commande = $this->Commandefournisseurs->get($id);
        $this->loadModel('Demandeoffredeprixes');
        if (!$this->Commandefournisseurs->exists($id)) {
            throw new NotFoundException(__('Invalid commande'));
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $commande = $this->Lignecommandefournisseurs->patchEntity($commande, $data);
            $cdd = $this->Lignecommandefournisseurs->find('all')
                    ->where(["Lignecommandefournisseurs.commandefournisseur_id  ='" . $id . "'"]);
            foreach ($cdd as $c) {
                $this->Commandefournisseurs->Lignecommandefournisseurs->delete($c);
            }
            if ($this->Commandefournisseurs->save($commande)) {
                $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
                $this->misejour("Commandefournisseurs", "add", $cmd_id);
                
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $lig) {
//                                              debug($lig);
                        if ($lig['sup0'] != 1) {
                            $lig['commandefournisseur_id'] = $id;
                            $lig['numero'] = $this->request->getData('num');
                            $lig['remise'] = $lig['remise'];
                            $lig['ht'] = $lig['punht'];
                            $lig['fodec'] = $lig['fodec'];
                            $lig['tva'] = $lig['tva'];
                            $lig['ttc'] = $lig['ttc'];
                            $lig['fournisseur_id'] = $this->request->getData('fournisseur_id');
                            $lig['article_id'] = $lig['article_id'];
                            $f = $this->Lignecommandefournisseurs->newEmptyEntity();
                            $f = $this->Lignecommandefournisseurs->patchEntity($f, $lig);
                            if ($this->Lignecommandefournisseurs->save($f)) {

                                //$this->Flash->success("adresselivraisonfournisseur has been created successfully");
                            }
                        } else {
                            $this->Lignecommandefournisseurs->delete(array('Lignecommandefournisseur.id' => $f['id']));
                        }
                    }
                }

                $commande = $this->Commandefournisseurs->get($id);
                $commande->valide = '1';
                $commande->remise = $this->request->getData('remise');
                $commande->tva = $this->request->getData('tva');
                $commande->fodec = $this->request->getData('fodec');
                $commande->ttc = $this->request->getData('ttc');
                $commande->ht = $this->request->getData('ht');
                $this->Commandefournisseurs->save($commande);
                $cmd_id = ($this->Commandefournisseurs->save($commande)->id);
                $this->misejour("Commandefournisseurs", "add", $cmd_id);
                
                
		//	debug("c bon sar ajout");
                // debug("save validation");
                $this->redirect(array('action' => 'index'));
            } else {
                //debug("not save");
            }
        }







        $point = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $depot = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

//$articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);










        $date = $this->Commandefournisseurs->find()
                        ->select(["date" => '(Commandefournisseurs.date)'])
                        ->where(["Commandefournisseurs.id  ='" . $id . "'"])->first();
//debug($date);


        $lignes = $this->Lignecommandefournisseurs->find('all', ['contain' => ['Articles']])
                ->where(["Lignecommandefournisseurs.commandefournisseur_id  = '" . $id . "'"]);

        //debug($lignes);
        $punht = 0;
        foreach ($lignes as $i => $ligne) {
            $punht = $punht + $ligne['punht'];
        }





        $numero = $this->Commandefournisseurs->find()
                        ->select(["num" => '(Commandefournisseurs.numero)'])
                        ->where(["Commandefournisseurs.id = '" . $id . "'"])->first();
//     debug($numero);

        $this->set(compact('commande', 'point', 'depot', 'fournisseurs', 'date', 'numero', 'lignes'));
    }

    public function addbonliv($id = null) {
        $commandes = $this->Commandefournisseurs->find()
                ->where(["Commandefournisseurs.id ='" . "$id" . "'"])
                ->first();
        
        
        //debug($commandes);
        
        
        $this->set(compact('commandes'));
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Cartecarburants');
        $this->loadModel('Adresselivraisonfournisseurs');
        $this->loadModel('Materieltransports');
        $this->loadModel('Depots');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignelivraisons');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Personnels');
        $nmc = $this->Commandefournisseurs->find()
                        ->select(["num" => '(Commandefournisseurs.numero)'])
                        ->where(["Commandefournisseurs.id = '" . $id . "'"])->first();
        $date = $this->Commandefournisseurs->find()
                        ->select(["date" => '(Commandefournisseurs.date)'])
                        ->where(["Commandefournisseurs.id  ='" . $id . "'"])->first();
        $num = $this->Livraisons->find()->select(["nmlvc" =>
                    'MAX(Livraisons.numero)'])->first();
        $numero = $num->nmlvc;
        $n = 0;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$z", 6, 'L', STR_PAD_LEFT);
            $b = str_pad("$c", 7, 'B', STR_PAD_LEFT);
            //debug($b);
        } else {
            $n = "BL00001";
            $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$z", 6, 'L', STR_PAD_LEFT);
            $b = str_pad("$c", 7, 'B', STR_PAD_LEFT);
            //debug($b);
        }
        $this->set(compact('b'));
        $livraison = $this->Livraisons->newEmptyEntity();
    
        
        
        if ($this->request->is('post') || $this->request->is('put')) {
                   
                
           // debug($this->request->getData());
            $num = $this->Livraisons->find()->select(["nmlvc" =>
                    'MAX(Livraisons.numero)'])->first();
        $numero = $num->nmlvc;
        $n = 0;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$z", 6, 'L', STR_PAD_LEFT);
            $b = str_pad("$c", 7, 'B', STR_PAD_LEFT);
            //debug($b);
        } else {
            $n = "BL00001";
            $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$z", 6, 'L', STR_PAD_LEFT);
            $b = str_pad("$c", 7, 'B', STR_PAD_LEFT);
            //debug($b);
        }
              
              
            
            
            
            
            
            $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
//           debug($this->request->getData());
            if ($this->Livraisons->save($livraison)) {
                $liv_id = ($this->Livraisons->save($livraison)->id);
                $this->misejour("Livraisons", "add", $liv_id);
                
                $livraison_id = $livraison->id;
                $article = $this->Commandefournisseurs->get($id);
                $article->etatliv = '1';
                $this->Commandefournisseurs->save($article);
                foreach ($this->request->getData('data')['ligner'] as $i => $livraison) {
//                  debug($livraison['id']);
                      $lignelivraisons = $this->fetchTable('Lignelivraisons')->newEmptyEntity();
                    
                    if ($livraison['sup0'] != 1) {
                        $dataa['article_id'] = $livraison['article_id'];
                        $dataa['livraison_id'] = $livraison_id;
                        $dataa['qteliv'] = $livraison['qtelivre'];
                        $dataa['qte'] = $livraison['qte'];
                        $dataa['prix'] = $livraison['prix'];
                        $dataa['remise'] = $livraison['remise'];
                        $dataa['ht'] = $livraison['punht'];
                        $dataa['tva'] = $livraison['tva'];
                        $dataa['fodec'] = $livraison['fodec'];
                        $dataa['ttc'] = $livraison['ttc'];
                        $dataa['commandefournisseur_id'] = $this->request->getData('commandefournisseur_id');

                 
                   $lignecommandde = $this->fetchTable('Lignecommandefournisseurs')->get($livraison['id'], [
                            'contain' => []
                        ]);
          $donne= $lignecommandde['qteliv']+$livraison['qtelive'];
           $lignecommandde->qteliv = $donne;
             $this->Lignecommandefournisseurs->save($lignecommandde);    
                      
                      
                        $lignelivraisons = $this->Lignelivraisons->patchEntity($lignelivraisons, $dataa);
                       //  debug($lignelivraisons);die;
                        
                        
                        
                        
                        
                        
                        
                        if ($this->Lignelivraisons->save($lignelivraisons)) {
                             // debug($lignelivraisons);
                            // $this->Flash->success("lignelivraisons has been created successfully");
                        } else {
                            //   $this->Flash->error("Failed to create lignelivraisons");
                        }

                       
                         
                       
                        
                    }
                    $this->set(compact("lignelivraisons"));
                }
                

                 $lign = $this->fetchTable('Commandefournisseurs')->Lignecommandefournisseurs->find('all', [
                    'contain' => ['Articles']
                ])
                    ->where(['commandefournisseur_id ' => $id]);
               
                $test = 0;
                foreach ($lign as $li) {
                    if ($li['qte'] != $li['qteliv'])
                        $test = 1;
                 
                }
                // debug($test);
                if ($test == 0) {
                    $article->etatliv = '2';
                    $this->fetchTable('Commandefournisseurs')->save($article);
                }
               








                

               
                  $this->redirect(array('controller' => 'livraisons', 'action' => 'index'));
            } else {
                //$this->Session->setFlash(__('The commande could not be saved. Please, try again.'));
            }
        }


        $lignes = $this->Lignecommandefournisseurs->find('all', ['contain' => ['Articles']])
                ->where(["Lignecommandefournisseurs.commandefournisseur_id  = '" . $id . "'"]);
//                debug($lignes);










        $chauffeurs = $this->Personnels->find('all', ['limit' => 200])
                ->where(["Personnels.fonction_id ='" . "1" . "'"]);

        $conffaieurs = $this->Personnels->find('all', ['limit' => 200])->where(["Personnels.fonction_id ='" . "5" . "'"]);

        $adrfrs = $this->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])
                ->where(["Adresselivraisonfournisseurs.fournisseur_id ='" .$commandes['fournisseur_id']."'"]);
             //   debug($adrfrs);

        $cartecarburants = $this->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'typekiosque']);

        $fournisseurs = $this->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $point = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depot = $this->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransports = $this->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $this->set(compact('livraison','conffaieurs', 'commandes', 'lignes', 'chauffeurs', 'nmc', 'date', 'cartecarburants', 'fournisseurs', 'point', 'depot', 'adrfrs', 'materieltransports'));
    }

    public function getquantite() {
        if ($this->request->is('ajax')) {
             $articleid = $_GET['idarticle'];
             $frsid= $_GET['idfournisseur'];
            $ligne = $this->fetchTable('Articlefournisseurs')->find('all')
                    ->where(["Articlefournisseurs.article_id  ='" . $articleid . "'","Articlefournisseurs.fournisseur_id  ='" . $frsid . "'"]);
        
             foreach ($ligne as $li){
            
                $prix=$li['prix'];
             }

            echo json_encode(array("ligne" =>$prix, "success" => true));
//            echo json_encode(array("qtestockx" => $qtestock,  "success" => true));
            exit;
        }
        $this->loadModel('Articles');
        die;
    }
 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}
