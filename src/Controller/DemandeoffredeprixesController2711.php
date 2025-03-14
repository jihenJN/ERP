<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Demandeoffredeprixes Controller
 *
 * @property \App\Model\Table\DemandeoffredeprixesTable $Demandeoffredeprixes
 * @method \App\Model\Entity\Demandeoffredeprix[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DemandeoffredeprixesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view   
     */
    public function imprimeview($id = null) {
     $demandeoffredeprix= $this->Demandeoffredeprixes->get($id, [
            
        ]);
         $this->loadModel('Lignelignebandeconsultations');
                 $frs = $this->Lignelignebandeconsultations->find('all')->where(["demandeoffredeprix_id=" . $id . ""])
                         ->group(["nomfr" => '(Lignelignebandeconsultations.nameF)'])
                         ;
       $j=0;
                 $tab[]=array();
      foreach ( $frs as $j => $tab)
          $nb=$this->Lignelignebandeconsultations->find('all')
             ->where(["demandeoffredeprix_id=".$id.""])
              ->group(["nomfr"=>'(Lignelignebandeconsultations.nameF)'])
              ->order(["Lignelignebandeconsultation.t"])
              ->count('*');

      //debug($nb);
        
          
          $this->loadModel ('Lignebandeconsultations');
                 $lignebande= $this->Lignebandeconsultations->find('all')->where(["demandeoffredeprix_id=" . $id . ""])
                         ->group(["nomart" => '(Lignebandeconsultations.designiationA)'])
                         ;
             

                         
                 //debug($bandeconsultation); 
             $i=0;    
                  $tab1[]=array();
                  foreach ( $lignebande as $i => $tab1)
      $this->set(compact('demandeoffredeprix','frs','tab','lignebande','tab1'));

    }

    public function index($typeof = null) {
        $cond2 = '';
        $cond1 = '';
        $cond3 = '';
        $numero = $this->request->getQuery('numero');
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        if ($numero) {
            $cond1 = "Demandeoffredeprixes.numero  like'%" . $numero . "%'";
        }
        if ($datedebut) {
            $cond2 = "Demandeoffredeprixes.date >='" . $datedebut . "'";
        }

        if ($datefin) {
            $cond3 = "Demandeoffredeprixes.date <='" . $datefin . "'";
        }

        $condtype = "Demandeoffredeprixes.typeoffredeprix=" . $typeof;


        $query = $this->Demandeoffredeprixes->find('all')->where([$condtype,$cond1, $cond2, $cond3])
                ->order(['Demandeoffredeprixes.id' => 'DESC']);
        $recherches = $this->paginate($query);
        $demandeoffredeprixes = $this->paginate($this->Demandeoffredeprixes);
        $this->set(compact('typeof','demandeoffredeprixes', 'numero', 'datefin', 'datedebut', 'recherches', 'numero', 'datedebut', 'datefin'));
        //debug($recherches);die();
    }

    /**
     * View method
     *
     * @param string|null $id Demandeoffredeprix id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.


     * 
     * @param string|null $id
     * 
     * 
     */
    public function view($id = null) {

        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Lignedemandeoffredeprixes');
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Bandeconsultations', 'Lignebandeconsultations', 'Lignedemandeoffredeprixes', 'Lignelignebandeconsultations'],
        ]);

        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
                ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);

        // debug($ligneas);die;	




        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
                ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        //$fournisseurs= $this->Demandeoffredeprixes->Fournisseurs->find('list',['keyfield' => 'id', 'valueField' => 'name']);
        //   $articles= $this->Demandeoffredeprixes->Articles->find('list',['keyfield' => 'id', 'valueField' => 'designiation']);
        $this->set(compact('lignefs', 'ligneas', 'demandeoffredeprix'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($typeof = null) {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_parametrage' . $abrv);
        // //   debug($liendd);
        // $dmd = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'demandeoffredeprixes') {
        //         $dmd = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($dmd <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        
        
        
        
        
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $this->loadModel('Lignedemandeoffredeprixes');


        $num = $this->Demandeoffredeprixes->find()->select(["numdepot" =>
                    'MAX(Demandeoffredeprixes.numero)'])->first();
        $numero = $num->numdepot;
        //  DOF00001
        $n = 0;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$z", 6, 'F', STR_PAD_LEFT);
            $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        } else {
            $n = "00001";
            $c = str_pad("$n", 6, 'F', STR_PAD_LEFT);
            $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        }
 $this->set(compact('b'));
        $demandeoffredeprix = $this->Demandeoffredeprixes->newEmptyEntity();
        if ($this->request->is('post')) {
              $num = $this->Demandeoffredeprixes->find()->select(["numdepot" =>
                    'MAX(Demandeoffredeprixes.numero)'])->first();
        $numero = $num->numdepot;
        //  DOF00001
        $n = 0;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$z", 6, 'F', STR_PAD_LEFT);
            $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        } else {
            $n = "00001";
            $c = str_pad("$n", 6, 'F', STR_PAD_LEFT);
            $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        }
          $this->set(compact('b'));
       
//            debug( $this->request->getData());
            $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $this->request->getData());

            $demandeoffredeprix->typeoffredeprix = $typeof ;
            if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {
                $demandeoffredeprix_id = ($this->Demandeoffredeprixes->save($demandeoffredeprix)->id);
                $this->misejour("Demandeoffredeprixes", "add", $demandeoffredeprix_id);
                
                
                
                $id = $demandeoffredeprix->id;


                if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->getData('data')['lignef'] as $j => $fourni) {
                        if ($fourni['sup1'] != 1) {
//                           debug($fourni);
                            if ($fourni['fournisseur_id']) {
                                $fr = $this->Fournisseurs->find()->select(["nomfour" => '(Fournisseurs.name)'])->where(["Fournisseurs.id" => $fourni['fournisseur_id']])->first();

                                $frr = $fr->nomfour;
                                $fourni['nameF'] = $frr;
                            } else {
                                $fourni['nameF'] = $fourni['fournisseur_idd'];
                            }


                            if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                                $this->loadModel('Articles');
                                foreach ($this->request->getData('data')['lignea'] as $i => $art) {

                                    if ($art['sup0'] != 1) {
                                        if ($art['article_id']) {

                                            $ar = $this->Articles->find()->select(["nomarticle" => '(Articles.Dsignation)'])->where(["Articles.id" => $art['article_id']])->first();
                                            $arr = $ar->nomarticle;
                                            $art['designiationA'] = $arr;
                                            
                                        } else {
                                            $art['designiationA'] = $art['article_idd'];
                                            
                                            
                                        }

                                        $data['demandeoffredeprix_id'] = $id;
                                        $data['article_id'] = $art['article_id'];
                                        $data['designiationA'] = $art['designiationA'];
                                        $data['qte'] = $art['qte'];
                                        $data['fournisseur_id'] = $fourni['fournisseur_id'];
                                        $data['nameF'] = $fourni['nameF'];
                                      
                                        $demandeoffre = $this->fetchTable('Lignedemandeoffredeprixes')->newEmptyEntity();
                                        $demandeoffre = $this->Lignedemandeoffredeprixes->patchEntity($demandeoffre, $data);
                                        if ($this->Lignedemandeoffredeprixes->save($demandeoffre)) {
                                         
//                                          debug($demandeoffre);
                                           // $this->Flash->success("demande offre de prix has been created successfully");
                                        }

//                             
                                        $this->set(compact("demandeoffre"));
                                    }
                                }
                            }
                            // debug($art['designiationA']);die;
                            //  $this->Flash->success(__('The demande offfre has been saved.'));
                            //  
                        }
                    }
                    return $this->redirect(['action' => 'index/' . $typeof]);
                } else {
                   // $this->Flash->error(__('The demande offre could not be saved. Please, try again.'));
                }
            }
        }




//    $ligneas=$this->Lignedemandeoffredeprixes->find('all',array('conditions' => array('Lignedemandeoffredeprixes.demandeoffredeprix_id'=>$id),'group' => array('Lignedemandeoffredeprixes.designiationA')));
        //$lignefs=$this->Lignedemandeoffredeprixes->find('all',array('conditions' => array('Lignedemandeoffredeprixes.demandeoffredeprix_id'=>$id),'group' => array('Lignedemandeoffredeprixes.nameF')));
        //debug($lignefs);die;
        $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->Demandeoffredeprixes->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])
                ->where(["Articles.vente=0"])
        ;
        $this->set(compact('demandeoffredeprix', 'fournisseurs', 'articles'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Demandeoffredeprix id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
                $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);
        //   debug($liendd);
        $dmd = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'demandeoffredeprixes') {
                $dmd = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($dmd <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);
 
        if ($this->request->is(['patch', 'post', 'put'])) {
            $num = $this->Demandeoffredeprixes->find()->select(["numdepot" =>
                    'MAX(Demandeoffredeprixes.numero)'])->first();
        $numero = $num->numdepot;
        //  DOF00001
        $n = 0;
        $n = $numero;
        if (!empty($n)) {
            $ff = intval(substr($n, 3, 7)) + 1;
            $z = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$z", 6, 'F', STR_PAD_LEFT);
            $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        } else {
            $n = "00001";
            $c = str_pad("$n", 6, 'F', STR_PAD_LEFT);
            $code = str_pad("$c", 7, 'O', STR_PAD_LEFT);
            $b = str_pad("$code", 8, 'D', STR_PAD_LEFT);
        }
 $this->set(compact('b'));
            $demandeoffredeprix = $this->Demandeoffredeprixes->patchEntity($demandeoffredeprix, $this->request->getData());
            if ($this->Demandeoffredeprixes->save($demandeoffredeprix)) {
               $dmd_id = ($this->Demandeoffredeprixes->save($demandeoffredeprix)->id);
               $this->misejour("Demandeoffredeprixes", "edit", $dmd_id);
               
                $demande_id = $demandeoffredeprix->id;
                   $lignedemande = $this->Lignedemandeoffredeprixes->find('all', [])
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);
        foreach ($lignedemande as $c) {
            $this->Demandeoffredeprixes->Lignedemandeoffredeprixes->delete($c);
        }
       
         if (isset($this->request->getData('data')['lignef']) && (!empty($this->request->getData('data')['lignef']))) {
                    foreach ($this->request->getData('data')['lignef'] as $j => $fourni) {
//                       debug($fourni);
                        if ($fourni['sup1'] != 1) {
                            if ($fourni['fournisseur_id']) {
                                $fr = $this->Fournisseurs->find()->select(["nomfour" => '(Fournisseurs.name)'])->where(["Fournisseurs.id" => $fourni['fournisseur_id']])->first();
                                $frr = $fr->nomfour;
                                $fourni['nameF'] = $frr;
                            } else {
                                $fourni['nameF'] = $fourni['nameF'];
                            }
                            if (isset($this->request->getData('data')['lignea']) && (!empty($this->request->getData('data')['lignea']))) {
                                $this->loadModel('Articles');
                                foreach ($this->request->getData('data')['lignea'] as $i => $art) {
                                   // debug($art);
                                    if ($art['sup0'] != 1) {
                                        if ($art['article_id']) {
                                            $ar = $this->Articles->find()->select(["nomarticle" => '(Articles.Dsignation)'])->where(["Articles.id" => $art['article_id']])->first();
                                            $arr = $ar->nomarticle;
                                            $art['designiationA'] = $arr;
                                            
                                        } else {
                                            $art['designiationA'] = $art['designiationA'];
                                            
                                            
                                        }

                                        $data['demandeoffredeprix_id'] = $id;
                                        $data['article_id'] = $art['article_id'];
                                        $data['designiationA'] = $art['designiationA'];
                                        $data['qte'] = $art['qte'];
                                        $data['fournisseur_id'] = $fourni['fournisseur_id'];
                                        $data['nameF'] = $fourni['nameF'];
                                      
                                        $demandeoffre = $this->fetchTable('Lignedemandeoffredeprixes')->newEmptyEntity();
                                        $demandeoffre = $this->Lignedemandeoffredeprixes->patchEntity($demandeoffre, $data);
                                        if ($this->Lignedemandeoffredeprixes->save($demandeoffre)) {
                                       
                                        }

//                             
                                        $this->set(compact("demandeoffre"));
                                    }
                                }
                            }
                            // debug($art['designiationA']);die;
                            //  $this->Flash->success(__('The demande offfre has been saved.'));
                            //  
                        }
                    }
                    return $this->redirect(['action' => 'index/' . $demandeoffredeprix['typedemandeoffre']]);
                }
                return $this->redirect(['action' => 'index/' . $demandeoffredeprix['typedemandeoffre']]);
            }
        }
        $articles = $this->Demandeoffredeprixes->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])
                ->where(["Articles.vente =0" ])
        ;
        //debug($articles);
        $fournisseurs = $this->Demandeoffredeprixes->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
                ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
                ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);

        $this->set(compact('ligneas', 'lignefs', 'demandeoffredeprix', 'articles', 'fournisseurs'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Demandeoffredeprix id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
                       $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);
        //   debug($liendd);
        $dmd = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'demandeoffredeprixes') {
                $dmd = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($dmd <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
       $this->loadModel('Lignedemandeoffredeprixes');
        $this->request->allowMethod(['post', 'delete']);
        $demande = $this->Demandeoffredeprixes->get($id);
        $lignedemande = $this->Lignedemandeoffredeprixes->find('all')
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
         foreach ($lignedemande as $c) {
            $this->Demandeoffredeprixes->Lignedemandeoffredeprixes->delete($c);
         }
        if ($this->Demandeoffredeprixes->delete($demande)) {
                $dmd_id = ($this->Demandeoffredeprixes->save($demande)->id);
                $this->misejour("Demandeoffredeprixes", "delete", $dmd_id);
            
} 


        return $this->redirect(['action' => 'index']);
    }

//    
//    public function imprimerrecherche()
//    {
//        $cond1 = '';
//        $cond2 = '';
//        $cond3 = '';
//        $cond4 = '';
//        $datedebut = $this->request->getQuery('datedebut');
//        $datefin = $this->request->getQuery('datefin');
//        $pointdevente_id = $this->request->getQuery('pointdevente_id');
//        $depot_id = $this->request->getQuery('depot_id');
//        if ($datedebut) {
//            $cond1 = "Bondechargements.date >=  '" . $datedebut . "' ";
//        }
//        if ($datefin) {
//            $cond3 = "Bondechargements.date  <=  '" .     $datefin . "' ";
//        }
//        if ($pointdevente_id) {
//            $cond4 = "Bondechargements.pointdevente_id  =  '" . $pointdevente_id . "' ";
//        }
//        if ($depot_id) {
//            $cond2 = "Bondechargements.depot_id =  '" .  $depot_id . "' ";
//        }
//        $query = $this->Bondechargements->find('all')->where([$cond1, $cond2, $cond3, $cond4]);
//        $bondechargements = $this->paginate($query);
//        $this->paginate = [
//            'contain' => ['Pointdeventes', 'Depots', 'Bondetransferts'],
//        ];
//       
//        //debug($bondechargements);
//        // die;
//        $this->set(compact('bondechargements'));
//    }










    public function imprimerrecherche() {

        $cond2 = '';
        $cond1 = '';
        $cond3 = '';
        $numero = $this->request->getQuery('numero');
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');

        if ($numero) {
            $cond1 = "Demandeoffredeprixes.numero  ='" . $numero . "'";
        }

        if ($datedebut) {
            $cond2 = "Demandeoffredeprixes.date ='" . $datedebut . "'";
        }

        if ($datefin) {
            $cond3 = "Demandeoffredeprixes.date ='" . $datefin . "'";
        }



//echo $cond1.'-'. $cond2.$cond3;

        $query = $this->Demandeoffredeprixes->find('all')->where([$cond1, $cond2, $cond3]);
        $recherches = $this->paginate($query);

        $demandeoffredeprixes = $this->paginate($this->Demandeoffredeprixes);

        $this->set(compact('demandeoffredeprixes', 'recherches'));
        //debug($recherches);die(); 
    }

    public function bandeconsultation($id = null) {
        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        if (!$this->Demandeoffredeprixes->exists($id)) {
            throw new NotFoundException(__('Invalid demandeoffredeprix'));
        }
        $demandeoffredeprix = $this->Demandeoffredeprixes->get($id, [
            'contain' => ['Lignedemandeoffredeprixes']
        ]);
        if ($this->request->is('post') || $this->request->is('put')) {
            $data['demandeoffredeprix_id'] = $this->request->getData()['id'];
            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                    //debug($fourni['fournisseur_id']);die;
                    $data['fournisseur_id'] = $fourni['fournisseur_id'];
                    $data['nameF'] = $fourni['nameF'];
                    $data['t'] = $fourni['t'];
                    if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {
                        foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
                            $data['article_id'] = $art['article_id'];
                            $data['designiationA'] = $art['designiationA'];
                            $data['qte'] = $art['qte'];
                            $data['prix'] = $art['prix'];
                            $data['totalprix'] = $art['total'];
                            $data['ht'] = $art['total'];
                            $data['lignedemandeoffredeprix_id'] = $art['ligne_id'];
                            $data['codefrs'] = $art['codefrs'];
                            $bande = $this->fetchTable('Bandeconsultations')->newEmptyEntity();
                            $bande = $this->Bandeconsultations->patchEntity($bande, $data);
                            if ($this->Bandeconsultations->save($bande)) {
                                $bande_id = ($this->Bandeconsultations->save($bande)->id);
                                $this->misejour("Bandeconsultations", "add", $bande_id);
                                
                                //$this->Flash->success("Bandeconsultation offre de prix has been created successfully");
                            } else {
                                //$this->Flash->error("Failed to create Bandeconsultation offre de prix");
                            }
                            $this->set(compact("bande"));
                            $data['bandeconsultation_id'] = $bande->id;
                            //debug( $data['bandeconsultation_id']);die;
                            $lignebande = $this->fetchTable('Lignebandeconsultations')->newEmptyEntity();
                            $lignebande = $this->Lignebandeconsultations->patchEntity($lignebande, $data);
                            if ($this->Lignebandeconsultations->save($lignebande)) {
                                
                                //debug($id);die;
//    $this->loadModel('Demandeoffredeprixes');
//  //  debug($id);die;
//            $dmd = $this->Demandeoffredeprixes->find('all')
//                    ->where(["Demandeoffredeprixes.id='" .$id. "'"])->update()
//                    ->set(['consultation' => '1'])
//                    ->execute
//                            $this->Demandeoffredeprixes->id = $id;
                                // $articlesTable = TableRegistry::getTableLocator()->get('Demandeoffredeprixes'); 
                                $article = $this->Demandeoffredeprixes->get($id);
                                $article->consultation = '1';
                                $this->Demandeoffredeprixes->save($article);
                                 $demande_id = ($this->Demandeoffredeprixes->save($article)->id);
                                $this->misejour("Demandeoffredeprixes", "update", $demande_id);

                                
                                
                                
//            $dmd = $this->Demandeoffredeprixes->find('all')
//                    ->where(["Demandeoffredeprixes.id='" . $id . "'"])->update()
//                    ->set(['consultation' => '1'])
//                    ->execute();
                                //$this->Flash->success("Lignebandeconsultations offre de prix has been created successfully");
                            } else {
                               // $this->Flash->error("Failed to create Lignebandeconsultations offre de prix");
                            }
                            $this->set(compact("lignebande"));
                        }
                    }
                    //$data['lignebandeconsultation_id']=$lignebande->id;

                    $ligneligne = $this->fetchTable('Lignelignebandeconsultations')->newEmptyEntity();
                    $ligneligne = $this->Lignelignebandeconsultations->patchEntity($ligneligne, $data);
                    if ($this->Lignelignebandeconsultations->save($ligneligne)) {
                       

                     
                    } else {
                       // $this->Flash->error("Failed to create Lignelignebandeconsultation offre de prix");
                    }
                    $this->set(compact("ligneligne"));
                }
            }






            $this->redirect(array('action' => 'etatcomparatif', $id));
        } else {
            //$options = array('conditions' => array('Demandeoffredeprixes.' . $this->Demandeoffredeprixes->primaryKey => $id));
            //$this->request->getData = $this->Demandeoffredeprixes->find('first', $options);
        }


        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
                ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);

        // debug($ligneas);die;	




        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
                ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);
//debug($lignefs);die();		



        $fournisseurs = $this->Fournisseurs->find('list');
        $demandes = $this->Demandeoffredeprixes->find()
                        ->select(["dm" => '(Demandeoffredeprixes.id)'])
                        ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
        //debug($demandes);die;


        $articles = $this->Articles->find('list', array('fields' => array('Articles.designiation')));
//		$fournisseurs=$this->Fournisseur->find('list');
        $this->set(compact('articles', 'demandes', 'fournisseurs', 'ligneas', 'lignefs', 'demandeoffredeprix'));
    }

    //etat comparatif pour passer une commande c'est pourquoi le numero sera le numero de la commande                       

    public function etatcomparatif($id = null) {

        $this->loadModel('Demandeoffredeprixes');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Commandefournisseurs');
        $this->loadModel('Lignecommandefournisseurs');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');
        $this->loadModel('Bandeconsultations');
        $this->loadModel('Lignebandeconsultations');
        $this->loadModel('Lignelignebandeconsultations');
        $this->loadModel('Articlefournisseurs');
        $demandes = $this->Demandeoffredeprixes->find()
                        ->select(["dm" => '(Demandeoffredeprixes.id)'])
                        ->where(["Demandeoffredeprixes.id  ='" . $id . "'"])->first();
        // debug($demandes);die;
        
        

        $date = $this->Demandeoffredeprixes->find()
                        ->select(["date" => '(Demandeoffredeprixes.date)'])
                        ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
//debug($date);die;

        $commande = $this->Commandefournisseurs->newEmptyEntity();

        $num = $this->Commandefournisseurs->find()->select(["numcmd" =>
                    'MAX(Commandefournisseurs.numero)'])->first();
        $numero = $num->numcmd;

        $n = $numero;

        if (!empty($n)) {

            $ff = intval(substr($n, 3, 7)) + 1;
            $d = str_pad("$ff", 5, '0', STR_PAD_LEFT);
            $c = str_pad("$d", 6, 'C', STR_PAD_LEFT);
            // debug( $c);die;
        } else {
            $n = "00001";
            $c = str_pad("$n", 6, 'C', STR_PAD_LEFT);
            //debug( $c);die;
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            
            $commande = $this->Commandefournisseurs->patchEntity($commande, $this->request->getData());
            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
                    //debug($fourni);

                    if (!empty($fourni['check'])) {
                        if ($fourni['check'] == 1) {
                            $data['numero'] = $this->request->getData('numero');
                            $data['t'] = $fourni['t'];
                            $data['name'] = $fourni['nameF'];
                            $data['date'] = date('d-m-y');
                            
                            if (!$fourni['id']) {
                            //debug("pas d'id");
                                $dat = $this->fetchTable('Fournisseurs')->newEmptyEntity();
                                $dat['name'] = $fourni['nameF'];
                                if ($this->Fournisseurs->save($dat)) {
                                    $fournisseur_id = ($this->Fournisseurs->save($dat)->id);
                                      $this->misejour("Fournisseurs", "add", $fournisseur_id);
                                    
                                    $fournisseur_id = $dat->id;
                                    $data['fournisseur_id'] = $fournisseur_id;
                                // $dataligne['fournisseur_id'] =$fournisseur_id;
                                }
                            } else {
                                $data['fournisseur_id'] = $fourni['id'];
                                 //$dataligne['fournisseur_id'] = $fourni['id'];
                            }
                            $data['demandeoffredeprix_id']=$id;
                            $comd = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
                            $comd = $this->Commandefournisseurs->patchEntity($comd, $data);
                            //debug($data); 
                            if ($this->Commandefournisseurs->save($comd)) {
                                    $comd_id = ($this->Commandefournisseurs->save($comd)->id);
                                    $this->misejour("Commandefournisseurs", "add", $comd_id);
                               
                                $comd_id = $comd['id'];
                                //debug($comd);
                                if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {

                                    foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
                                                                        $dataligne = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();

                                        $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id =  '" . $art['ligne_id'] . "' "])->first();
                                        $data['designiation'] = $art['designiationA'];
                                        if (!$art['id']) {
                                            $datta = $this->fetchTable('Articles')->newEmptyEntity();
                                            $datta['Dsignation'] = $art['designiationA'];
                                            $datta['typearticle_id']=2;
//                                            debug($datta);
                                           
                                           
                                                
                                            if ($this->fetchTable('Articles')->save($datta)) {
                                                $article_id = $datta['id'];
                                                $data['article_id'] = $article_id;
                                               $dataligne['article_id']=$article_id;
                                            }
                                        } else {
                                            $data['article_id'] = $art['id'];
                                            $dataligne['article_id']=$art['id'];
                                        }
                                        $data['code'] = $lbc['codefrs'];
                                        $data['prix'] = $art['prix'];
                                        $artfr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                                        $artfr = $this->Articlefournisseurs->patchEntity($artfr, $data);
                                        if ($this->Articlefournisseurs->save($artfr)) {
                                            $artfrs_id = ($this->Articlefournisseurs->save($artfr)->id);
                                             $this->misejour("Articlefournisseurs", "add", $artfrs_id);

                                           
                                        } else {
                                            $this->Flash->error("Failed to create Articlefournisseurs offre de prix");
                                        }

                                        
                                        $dataligne['codefrs'] = $lbc['codefrs'];
                                        $dataligne['qte'] = $art['qte'];
                                        $dataligne['prix'] = $art['prix'];
                                        $dataligne['ht'] = $art['ht'];
                                        $dataligne['commandefournisseur_id'] = $comd_id;
                                     //   debug($dataligne);
                                        if ($this->Lignecommandefournisseurs->save($dataligne)) {
                                          
                                                
                                                $article = $this->Demandeoffredeprixes->get($id);
                                                $article->commande = '1';
//                                                debug($article);
                                                
                                                $this->Demandeoffredeprixes->save($article);
                                            $dmd_id = ($this->Demandeoffredeprixes->save($article)->id);
                                            $this->misejour("Demandeoffredeprixes", "update", $dmd_id);
                                              
                                            
                                            
                                        }
                                    }
                                }

                                //debug($comd_id);
                                // $this->Flash->success("Commande has been created successfully");
                            }
                        }
                    }
                }
            }
   
            
            
            
            
            
            
            if (isset($this->request->getData('data')['lignefourn']) && (!empty($this->request->getData('data')['lignefourn']))) {
                foreach ($this->request->getData('data')['lignefourn'] as $j => $fourniss) {
                                         $datx = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
                               

                    

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
        }
        else {
            $n = "C00001";
            $z = str_pad(" $n", 5, '0', STR_PAD_LEFT);
            $b = str_pad("$z", 6, 'C', STR_PAD_LEFT);
        }

 
                            
                    if (!empty($fourniss['c'])) {
                        if ($fourniss['c'] == 1) {
                            $data['numero'] = $this->request->getData('numero');
                             
                            $data['name'] = $fourniss['nameF'];
                            $data['date'] = date('d-m-y');
                            if (!$fourniss['id']) {
                        $data=$this->fetchTable('Fournisseurs')->newEmptyEntity();
                                $data['name'] = $fourniss['nameF'];
                                if ($this->Fournisseurs->save($data)) {
                                    $frs_id = ($this->Fournisseurs->save($data)->id);
                                    $this->misejour("Fournisseurs", "add", $frs_id);
                                    
                                    $fournisseur_id = $data->id;
                                    $data['fournisseur_id'] = $fournisseur_id;
                                    $datx['fournisseur_id'] =$fournisseur_id;
                                    $dattt['fournisseur_id'] =$fournisseur_id;
                                }
                            } else {
                                $data['fournisseur_id'] = $fourniss['id'];
                                  $datx['fournisseur_id'] = $fourniss['id'];
                                   $dattt['fournisseur_id'] =$fourniss['id'];
                            }


                            $datx['numero'] = $b;
                             $datx['date']= date('y-m-d');
                          $datx['demandeoffredeprix_id']=$id;
                            if ($this->Commandefournisseurs->save($datx)) {
                               $cmd_id = ($this->Commandefournisseurs->save($datx)->id);
                              $this->misejour("Commandefournisseurs", "add", $cmd_id);

                                $comd_id = $datx['id'];

                              
                                if (isset($this->request->getData('data')['lignefourn'][$j]['ligneart']) && (!empty($this->request->getData('data')['lignefourn'][$j]['ligneart']))) {
                                    foreach ($this->request->getData('data')['lignefourn'][$j]['ligneart'] as $i => $arti) {
						$datz=$this->fetchTable('Articles')->newEmptyEntity();   
                                                          $dattt=$this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
                                        if ($arti['check2']) {
                                            $data['date'] = $this->request->getData('date');
                                            $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id = '" . $arti['ligne_id'] . "' "])->first();
                                            $data['designiation'] = $arti['designiationA'];
                                            if (!$arti['article_id']) {
                                               
                                                $datz['Dsignation'] = $arti['designiationA'];
                                                $datz['typearticle_id']=2;
                                               // debug($datz);
                                                if ($this->Articles->save($datz)) {  
                                                    $article_id = ($this->Articles->save($datz)->id);
                                                    $this->misejour("Articles", "add", $article_id);
                                                    $data['article_id'] = $ar['id'];
                                                    $data['article_id'] = $datz['id'];
                                                  $dattt['article_id'] = $datz['id'];
                                                }
                                            } else {
                                                $data['article_id'] = $arti['article_id'];
                                                 $dattt['article_id'] = $arti['article_id']; 
                                            }
                                            $data['code'] = $lbc['codefrs'];
                                            $data['prix'] = $arti['prix'];

                                          //  $artfr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                                           // $artfr = $this->Articlefournisseurs->patchEntity($artfr, $data);

//                                            if ($this->Articlefournisseurs->save($artfr)) {
//                                                 
//                                            } 
//                                            else {
//                                              
//                                            }
                                            $dattt['codefrs'] = $lbc['codefrs'];
                                            $dattt['qte'] = $arti['qte'];
                                            $dattt['prix'] = $arti['prix'];
                                            $dattt['ht'] = $arti['ht'];
                                            $dattt['commandefournisseur_id'] = $comd_id;
                                         // debug($dattt);
                                           // $data['numero'] = $this->request->getData('mm');
                                            
                                           
                                            if ($this->Lignecommandefournisseurs->save($dattt)) {
                                              
                                                $article = $this->Demandeoffredeprixes->get($id);
                                                $article->commande = '1';
                                                //debug($article);
                                                $this->Demandeoffredeprixes->save($article);
                                                $dmd_id = ($this->Demandeoffredeprixes->save($article)->id);
                                                 $this->misejour("Demandeoffredeprixes", "update", $dmd_id);
                                            } else {
                                                $this->Flash->error("Failed to create Lignecommandefournisseurs offre de prix");
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }






        

            $this->redirect(array('controller' => 'commandefournisseurs', 'action' => 'index'));
        }































//            $this->Demandeoffredeprixes->id = $id;
//            $dmd = $this->Demandeoffredeprixes->find('all')
//                    ->where(["Demandeoffredeprixes.id = '" . $id . "'"]);
//
//            $dmd->update()
//                    ->set(['commande' => '1'])
//                    ->execute();


        $fournisseurs = $this->Lignelignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
                ->group(["namef" => '(Lignelignebandeconsultations.nameF)'])
                ->where(["Lignelignebandeconsultations.demandeoffredeprix_id  ='" . $id . "'"]);
//        debug($fournisseurs);


        $articles = $this->Bandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
                ->group(["art" => '(Bandeconsultations.designiationA)'])
                ->where(["Bandeconsultations.demandeoffredeprix_id = '" . $id . "'"]);
        //  debug($articles);
        $tab = array();
        $tab1 = array();
        foreach ($fournisseurs as $frs) {
            //debug($frs); 
            $idfrs = $frs['fournisseur_id'];
            $namefrs = $frs['nameF'];
            //echo($namefrs);die;

            foreach ($articles as $art) {
                //debug($art);die;
                $idart = $art['article_id'];
                $iddemande = $art['demandeoffredeprix_id'];
                $artdes = $art['designiationA'];

                $donnes = $this->Lignebandeconsultations->find()
                        ->where(["Lignebandeconsultations.nameF = '" . $namefrs . "'"])
                        ->where(["Lignebandeconsultations.demandeoffredeprix_id  = '" . $iddemande . "'"])
                        ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"]);
                //debug($donnes);die;


                $pr = $this->Lignebandeconsultations->find('all')
                        ->select(["ht" => '(Lignebandeconsultations.ht)'])
                        ->where(["Lignebandeconsultations.demandeoffredeprix_id = '" . $iddemande . "'"])
                        ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"])
                        ->order(["Lignebandeconsultations.ht"]);

//debug($pr);die;        

                $tab[$idfrs][$idart] = $donnes;
                $tab1[$idfrs][$idart] = $pr;
                // debug($tab1);
            }
        }









        $lignefs = $this->Lignelignebandeconsultations->find('all')
                ->group(["nomfour" => '(Lignelignebandeconsultations.nameF)'])
                ->where(["Lignelignebandeconsultations.demandeoffredeprix_id = '" . $id . "'"])
                ->order(["Lignelignebandeconsultations.t"]);
        $d = array();

        $o = 0;

        foreach ($lignefs as $o => $lf) {
            $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
                    //->select(["nameF"=>'(Lignebandeconsultations.designiationA)'])
                    ->group(["nomar" => '(Lignebandeconsultations.designiationA)'])
                    ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id . "'"])
                    ->where(["Lignebandeconsultations.nameF  ='" . $lf['nameF'] . "'"]);
//            debug($ligneas);
            //$ta[$o]=$lf;
            $n = 0;
            // $d=array();

            foreach ($ligneas as $n => $la) {
                $d[$o][$n] = $la;
                //debug($d);
            }
        }
        //debug( $ta);
//         debug( $d);

        $this->set(compact('tab', 'tab1', 'fournisseurs', 'd', 'demandes', 'c', 'articles', 'commande', 'date', 'lignefs', 'ligneas'));
    }

//    public function etatcomparatif($id = null) {
//        
//        $this->loadModel('Demandeoffredeprixes');
//        $this->loadModel('Lignedemandeoffredeprixes');
//        $this->loadModel('Articles');
//        $this->loadModel('Fournisseurs');
//        $this->loadModel('Commandefournisseurs');
//        $this->loadModel('Lignecommandefournisseurs');
//        $this->loadModel('Fournisseurs');
//        $this->loadModel('Lignedemandeoffredeprixes');
//        $this->loadModel('Bandeconsultations');
//        $this->loadModel('Lignebandeconsultations');
//        $this->loadModel('Lignelignebandeconsultations');
//        $this->loadModel('Articlefournisseurs');
//        $demandes = $this->Demandeoffredeprixes->find()
//                        ->select(["dm" => '(Demandeoffredeprixes.id)'])
//                        ->where(["Demandeoffredeprixes.id  ='" . $id . "'"])->first();
//      // debug($demandes);die;
//
//        $date = $this->Demandeoffredeprixes->find()
//                        ->select(["date" => '(Demandeoffredeprixes.date)'])
//                        ->where(["Demandeoffredeprixes.id ='" . $id . "'"])->first();
////debug($date);die;
//        
//        $commande = $this->Commandefournisseurs->newEmptyEntity();
//
//        $num = $this->Commandefournisseurs->find()->select(["numcmd" =>
//                    'MAX(Commandefournisseurs.numero)'])->first();
//        $numero = $num->numcmd;
//        
//        $n=$numero;
//  
//       
//         if (!empty($n)) {
//             
//            $ff = intval(substr($n, 3, 7)) + 1;
//            $d = str_pad("$ff", 5, '0', STR_PAD_LEFT);
//            $c=str_pad("$d", 6, 'C', STR_PAD_LEFT);
//        // debug( $c);die;
//        } else {
//            $n = "00001";
//            $c = str_pad("$n", 6, 'C', STR_PAD_LEFT);
//         //debug( $c);die;
//        }
//
//        if ($this->request->is('post') || $this->request->is('put')) {
//            $commande = $this->Commandefournisseurs->patchEntity($commande, $this->request->getData());
//            if (isset($this->request->getData('data')['fligne']) && (!empty($this->request->getData('data')['fligne']))) {
//                foreach ($this->request->getData('data')['fligne'] as $j => $fourni) {
//                //debug($fourni);
//                    if (!empty($fourni['check'])) {
//                        if ($fourni['check'] == 1) {
//                            $data['numero'] = $this->request->getData('numero');
//                            $data['t'] = $fourni['t'];
//                            $data['name'] = $fourni['nameF'];
//                            $data['date'] = $this->request->getData('date');
//                           if (!$fourni['id']) {
//                              // debug("true");
//                                $fournisseur = $this->Fournisseurs->newEmptyEntity();
//                                $fournisseur_id = $fournisseur->id;
//                                $data['name'] = $fourni['nameF'];
//                                $nvf = $this->fetchTable('Fournisseurs')->newEmptyEntity();
//                                $nvf = $this->Fournisseurs->patchEntity($nvf, $data);
//                               
//                             //debug($data);
//                                if ($this->Fournisseurs->save($nvf)) {
//                                     $fournisseur_id = $nvf->id;
//                                    $this->Flash->success(" A new fournissuer has been created successfully");
//                                //debug($fournisseur_id);
//                                }
//                            } else {
//                                $data['fournisseur_id'] = $fourni['id'];
//                            }
//                            //$data['fournisseur_id']=$fournisseur_id;
//                            $comd = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
//                            $comd = $this->Commandefournisseurs->patchEntity($comd, $data);
////                            debug($data);
//                            if ($this->Commandefournisseurs->save($comd)) {
//                               // debug($comd);
//                             $comd_id=$comd['id'];
//                             //debug($comd);
//                                                 if (isset($this->request->getData('data')['fligne'][$j]['aligne']) && (!empty($this->request->getData('data')['fligne'][$j]['aligne']))) {
//
//                        foreach ($this->request->getData('data')['fligne'][$j]['aligne'] as $i => $art) {
//                                                // debug($art);
//                            $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id =  '" . $art['ligne_id'] . "' "])->first();
//                  
//                            $data['designiation'] = $art['designiationA'];
//                            if (!$art['id']) {
//                                $article = $this->fetchTable('Articles')->newEmptyEntity();
//                                $data['Dsignation'] = $art['designiationA'];
//                                $article = $this->fetchTable('Articles')->patchEntity($article, $data);
//                                if ($this->fetchTable('Articles')->save($article)) {
//                                    $article_id = $article['id'];
//                                    debug( $article_id);
//                                }
//                            } else {
//                                $dataa['article_id'] = $art['id'];
//                            }
//                            $data['code'] = $lbc['codefrs'];
//                            $data['prix'] = $art['prix'];
//                            $artfr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
//                            $artfr = $this->Articlefournisseurs->patchEntity($artfr, $data);
//                            if ($this->Articlefournisseurs->save($artfr)) {
//                               
//                                //  $this->Flash->success("Articlefournisseurs offre de prix has been created successfully");
//                            } else {
//                                $this->Flash->error("Failed to create Articlefournisseurs offre de prix");
//                            }
////                            debug($comd_id);
//                            $dataa = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
//                            $dataa['codefrs'] = $lbc['codefrs'];
//                            $dataa['qte'] = $art['qte'];
//                            $dataa['prix'] = $art['prix'];
//                            $dataa['ht'] = $art['ht'];
//                            $dataa['article_id']=$article_id;
//  //                          $dataa['fournisseur_id'] = $fournisseur_id;
//                            $dataa['commandefournisseur_id'] = $comd_id;
//                         // debug($dataa);
//                            if ($this->Lignecommandefournisseurs->save($dataa)) {
//                             //debug("save lignecommandefournisseur");
//                              // debug("save fait");
////                             debug($dataa);
//                               
//                            } 
//                        }
//                    }
//
//                               //debug($comd_id);
//                                // $this->Flash->success("Commande has been created successfully");
//                            }
//                           
//                        }
//                    }
//                  
//                } 
//                
//              
//                
//                
//                
//                
//                
//                
//                
//                
//                
//                
//                
//                
//                
//                
//                
//                
//	        }			
//                
//                
//                
//                
//                
//                
//                
//                     if (isset($this->request->getData('data')['lignefourn']) && (!empty($this->request->getData('data')['lignefourn']))) {
//				foreach ($this->request->getData('data')['lignefourn'] as $j => $fourniss) {		
//			     //debug($fourniss);
//		           if (!empty($fourniss['c'])){
//                                    if($fourniss['c']==1){
//                                    $data['numero'] = $this->request->getData('numero');
////                                    $data['t'] = $fourniss['t'];
//                                    $data['name'] = $fourniss['nameF'];
//                                    $data['date'] = $this->request->getData('date');
//			            $data['numero']=$this->request->getData('numero');
//			           
//		                if(!$fourniss['id']){
//                                    $fournisseur = $this->Fournisseurs->newEmptyEntity();
//                                 $dataa['name'] = $fourniss['nameF'];
//                                $nvf = $this->fetchTable('Fournisseurs')->newEmptyEntity();
//                                $nvf = $this->Fournisseurs->patchEntity($nvf, $dataa);
//                               
//                                if ($this->Fournisseurs->save($nvf)) {
//                                  //  debug("fourniseur save");
//                                  $fournisseur_id = $fournisseur->id;
//
//                                    $this->Flash->success(" A new fournissuer has been created successfully");
//                                }}
//		                else{
//			                $data['fournisseur_id']=$fourniss['id'];
//		                }
//                                
//                            $comd = $this->fetchTable('Commandefournisseurs')->newEmptyEntity();
//                            $comd = $this->Commandefournisseurs->patchEntity($comd, $data);
//                            if ($this->Commandefournisseurs->save($comd)) {
//                                $comd_id=$comd['id'];
//                                debug($comd_id);
//                            //  debug($this->request->getData('data')['lignefourn'][$j]['ligneart']);
//                                 if (isset($this->request->getData('data')['lignefourn'][$j]['ligneart']) && (!empty($this->request->getData('data')['lignefourn'][$j]['ligneart']))) {
//					        foreach ($this->request->getData('data')['lignefourn'][$j]['ligneart'] as $i => $arti) {
//						//debug($this->request->getData('data')['lignefourn']);    
//                                                    if($arti['check2']){
//                            $lbc = $this->Lignebandeconsultations->find()->where(["Lignebandeconsultations.id = '" . $arti['ligne_id'] . "' "])->first();
//			
//                            
//                             $data['designiation'] = $arti['designiationA'];
//                            if (!$arti['article_id']) {
//                                $article = $this->fetchTable('Articles')->newEmptyEntity();
//                                $data['Dsignation'] = $arti['designiationA'];
//                                $article = $this->fetchTable('Articles')->patchEntity($article, $data);
//                                if ($this->fetchTable('Articles')->save($article)) {
////                                    debug("article save");
//                                    $data['article_id'] = $article['id'];
//                                    
//                                }
//                            } else {
//                                $dataa['article_id'] = $arti['article_id'];
//                            }
//                            $data['code'] = $lbc['codefrs'];
//                            $data['prix'] = $arti['prix'];
//                            $artfr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
//                            $artfr = $this->Articlefournisseurs->patchEntity($artfr, $data);
//                            //debug($artfr);
//                            if ($this->Articlefournisseurs->save($artfr)) {
//                                debug("the article fournisseur saved");
//                            } else {
//                                $this->Flash->error("Failed to create Articlefournisseurs offre de prix");
//                            }
//                           $dataa = $this->fetchTable('Lignecommandefournisseurs')->newEmptyEntity();
//                            $dataa['codefrs'] = $lbc['codefrs'];
//                            $dataa['qte'] = $arti['qte'];
//                            $dataa['prix'] = $arti['prix'];
//                            $dataa['ht'] = $arti['ht'];
//                            $dataa['article_id']=$article_id;
//                            $dataa['fournisseur_id'] = $fourniss['id'];
//                           $dataa['commandefournisseur_id'] = $comd_id;
//                           $dataa['numero']=$this->request->getData('numero');
//                           $dataa['date']=$this->request->getData('date');
//
//                               debug($dataa);
//                            if ($this->Lignecommandefournisseurs->save($dataa)) {
//                            debug("save lignecommandefournisseur ");
//                               debug($dataa);
//                            } else {
//                                $this->Flash->error("Failed to create Lignecommandefournisseurs offre de prix");
//                            }
//                        }
//                    }
//
//                               
//                           
//                                }
//                                
//                            }
//                                
//                            }
//                   
//                  
//               
//                
//              
//                
//                
//                
//                                
//                                
//                                    
//                                
//                                
//                                    }
//                                
//                          
//                            
//                                 
//                                    
//				    }			
//	            }
//                
//                                 $this->redirect(array('controller' => 'commandefournisseurs','action' => 'index'));
//
//                
//                
//                
//                
//                
//                
//                
//                
//                
//                
//                
//        }
//                
//                
//            
//            
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
////
////            $this->Demandeoffredeprixes->id = $id;
////            $dmd = $this->Demandeoffredeprixes->find('all')
////                    ->where(["Demandeoffredeprixes.id = '" . $id . "'"]);
////
////            $dmd->update()
////                    ->set(['commande' => '1'])
////                    ->execute();
//            
//        
//        $fournisseurs = $this->Lignelignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
//                ->group(["namef" => '(Lignelignebandeconsultations.nameF)'])
//                ->where(["Lignelignebandeconsultations.demandeoffredeprix_id  ='" . $id . "'"]);
////        debug($fournisseurs);
//
//
//        $articles = $this->Bandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
//                ->group(["art" => '(Bandeconsultations.designiationA)'])
//                ->where(["Bandeconsultations.demandeoffredeprix_id = '" . $id . "'"]);
//        //  debug($articles);
//        $tab = array();
//        $tab1 = array();
//        foreach ($fournisseurs as $frs) {
//            //debug($frs); 
//            $idfrs = $frs['fournisseur_id'];
//            $namefrs = $frs['nameF'];
//            //echo($namefrs);die;
//
//            foreach ($articles as $art) {
//                //debug($art);die;
//                $idart = $art['article_id'];
//                $iddemande = $art['demandeoffredeprix_id'];
//                $artdes = $art['designiationA'];
//
//                $donnes = $this->Lignebandeconsultations->find()
//                        ->where(["Lignebandeconsultations.nameF = '" . $namefrs . "'"])
//                        ->where(["Lignebandeconsultations.demandeoffredeprix_id  = '" . $iddemande . "'"])
//                        ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"]);
//                //debug($donnes);die;
//
//
//                $pr = $this->Lignebandeconsultations->find('all')
//                        ->select(["ht" => '(Lignebandeconsultations.ht)'])
//                        ->where(["Lignebandeconsultations.demandeoffredeprix_id = '" . $iddemande . "'"])
//                        ->where(["Lignebandeconsultations.designiationA = '" . $artdes . "'"])
//                        ->order(["Lignebandeconsultations.ht"]);
//
////debug($pr);die;        
//
//                $tab[$idfrs][$idart] = $donnes;
//                $tab1[$idfrs][$idart] = $pr;
//                // debug($tab1);
//            }
//        }
//
//
//
//
//
//
//
//
//
//        $lignefs = $this->Lignelignebandeconsultations->find('all')
//                ->group(["nomfour" => '(Lignelignebandeconsultations.nameF)'])
//                ->where(["Lignelignebandeconsultations.demandeoffredeprix_id = '" . $id . "'"])
//                ->order(["Lignelignebandeconsultations.t"]);
//        $d = array();
//        
//        $o = 0;
//
//        foreach ($lignefs as $o => $lf) {
//            $ligneas = $this->Lignebandeconsultations->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
//                    //->select(["nameF"=>'(Lignebandeconsultations.designiationA)'])
//                    ->group(["nomar" => '(Lignebandeconsultations.designiationA)'])
//                    ->where(["Lignebandeconsultations.demandeoffredeprix_id ='" . $id . "'"])
//                    ->where(["Lignebandeconsultations.nameF  ='" . $lf['nameF'] . "'"]);
////            debug($ligneas);
//           //$ta[$o]=$lf;
//            $n = 0;
//           // $d=array();
//
//            foreach ($ligneas as $n => $la) {
//                $d[$o][$n] = $la;
//             //debug($d);
//                
//                
//            }
//        }
//        //debug( $ta);
////         debug( $d);
//
//        $this->set(compact('tab', 'tab1','fournisseurs', 'd', 'demandes', 'c', 'articles', 'commande', 'date', 'lignefs', 'ligneas'));
//    }

    public function imprimer($id) {

        $this->loadModel('Articles');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Lignedemandeoffredeprixes');

        if (!$this->Demandeoffredeprix->exists($id)) {
            throw new NotFoundException(__('Invalid demandeoffredeprix'));
        }
        $ligneas = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'designiationA'])
                ->group(["nomar" => '(Lignedemandeoffredeprixes.designiationA)'])
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"]);

        $lignefs = $this->Lignedemandeoffredeprixes->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
                ->group(["nomfour" => '(Lignedemandeoffredeprixes.nameF)'])
                ->where(["Lignedemandeoffredeprixes.demandeoffredeprix_id ='" . $id . "'"]);

        //$nb=$this->Lignedemandeoffredeprixes->find('count',array('conditions' => array('Lignedemandeoffredeprix.demandeoffredeprix_id'=>$id),'group' => array('Lignedemandeoffredeprix.nameF')));
        $demandeoffredeprix = $this->Demandeoffredeprixes->find()
                ->where(["Demandeoffredeprixes.demandeoffredeprix_id  ='" . $id . "'"])
                ->first();

        $this->set(compact('nb', 'articles', 'fournisseurs', 'ligneas', 'lignefs', 'demandeoffredeprix'));
    }

}

//public function etatcomparatif($id = null) {
//		
//		$this->loadModel('Article');
//		$this->loadModel('Commande');
//		$this->loadModel('Lignecommande');
//		$this->loadModel('Fournisseur');
//		$this->loadModel('Lignedemandeoffredeprix');
//		$this->loadModel('Bandeconsultation');
//		$this->loadModel('Lignebandeconsultation');
//		$this->loadModel('Lignelignebandeconsultation');
//		$this->loadModel('Articlefournisseur');
//
//		date_default_timezone_set('Africa/Tunis');
//		if (!$this->Demandeoffredeprix->exists($id)) {
//			throw new NotFoundException(__('Invalid demandeoffredeprix'));
//		}
//	
//		
//		if ($this->request->is('post') || $this->request->is('put')) {
//		    $data['date']=date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $this->request->data['Commande']['date'])));
//			$data['demandeoffredeprix_id']=$this->request->data['Commande']['id'];
//		    if (isset($this->request->data['fligne']) && (!empty($this->request->data['fligne']))) {
//				foreach ($this->request->data['fligne'] as $j => $fourni) {
//					if($fourni['check']==1){
//				        $data['numero']=$this->request->data['Commande']['numero'];
//					    $data['t']=$fourni['t'];
//					    $data['name']=$fourni['nameF'];
//                        if(!$fourni['id']){
//				            $this->Fournisseur->create();
//				            $this->Fournisseur->save($data);
//				            $data['fournisseur_id']=$this->Fournisseur->id;
//			            }else{
//				        $data['fournisseur_id']=$fourni['id'];
//			            }
//			            $this->Commande->create();
//			            $this->Commande->save($data);	
//			            $this->misejour("commande","add",$this->Commande->id);
//                        if (isset($this->request->data['fligne'][$j]['aligne']) && (!empty($this->request->data['fligne'][$j]['aligne']))) {
//						    foreach ($this->request->data['fligne'][$j]['aligne'] as $i => $art) {
//							    $lbc=$this->Lignebandeconsultation->find('first',array('conditions' => array('Lignebandeconsultation.id'=>$art['ligne_id'])));
//						        $data['codefrs']=$lbc['Lignebandeconsultation']['codefrs'];
//						        $data['prixachat']=$art['prix'];
//                                $data['designiation']=$art['designiationA'];
//							    if(!$art['id']){
//								    $max = $this->Article->find('all', array('recursive'=>-1,'fields' => array('max(Article.codeabarre)')));
//								    $inc=intval(substr($max[0][0]['max(`Article`.`codeabarre`)'],3,10))+1;
//								    $c = str_pad($inc, 10, '0', STR_PAD_LEFT);
//								    $ch = str_pad($c, 13, '613', STR_PAD_LEFT);
//								    $data['codeabarre']= $ch;
//								    $this->Article->create();
//								    $this->Article->save($data);
//								    $data['article_id']=$this->Article->id;
//							    }else{
//								    $this->Article->updateAll(array('Article.prixachat' => $art['prix']), array('Article.id' =>$art['id']));
//								    $data['article_id']=$art['id'];
//								}
//							    $data['code']=$lbc['Lignebandeconsultation']['codefrs'];
//							    $data['prix']=$art['prix'];
//							    $this->Articlefournisseur->create();
//			                    $this->Articlefournisseur->save($data);
//							    $data['qte']=$art['qte'];
//							    $data['prix']=$art['prix'];
//							    $data['ht']=$art['ht'];
//							    $data['lignedemandeoffredeprix_id']=$art['ligne_id'];
//							    $data['commande_id']=$this->Commande->id;
//							    $this->Lignecommande->create();
//							    $this->Lignecommande->save($data);									
//						    }
//					    }
//				    }
//				}
//			}	
//		    if (isset($this->request->data['lignefourn']) && (!empty($this->request->data['lignefourn']))) {
//				foreach ($this->request->data['lignefourn'] as $j => $fourniss) {		
//			        $l=0;
//		            if($fourniss['c']==1){
//			            $l=$l+1;
//			            $num = $this->Commande->find('all', array('recursive'=>-1,'fields' => array('max(Commande.numero)')));
//			            $cc=intval(substr($num[0][0]['max(`Commande`.`numero`)'],1,5))+$l;
//			            $c= str_pad($cc, 5, '0', STR_PAD_LEFT);
//			            $ch=str_pad($c, 6, 'C', STR_PAD_LEFT);
//			            $data['numero']=$ch;
//			            $data['name']=$fourniss['nameF'];
//		                if(!$fourniss['id']){
//			                $this->Fournisseur->create();
//			                $this->Fournisseur->save($data);
//			                $data['fournisseur_id']=$this->Fournisseur->id;
//		                }else{
//			                $data['fournisseur_id']=$fourniss['id'];
//		                }
//		                $this->Commande->create();
//		                $this->Commande->save($data);	
//	                    if (isset($this->request->data['lignefourn'][$j]['ligneart']) && (!empty($this->request->data['lignefourn'][$j]['ligneart']))) {
//					        foreach ($this->request->data['lignefourn'][$j]['ligneart'] as $i => $arti) {
//						        if($arti['check2']){
//							        $lbc=$this->Lignebandeconsultation->find('first',array('conditions' => array('Lignebandeconsultation.id'=>$arti['ligne_id'])));
//					                $data['codefrs']=$lbc['Lignebandeconsultation']['codefrs'];
//					                $data['prixachat']=$arti['prix'];
//						            $data['designiation']=$arti['designiationA'];
//						            if(!$arti['article_id']){
//							            $max = $this->Article->find('all', array('recursive'=>-1,'fields' => array('max(Article.codeabarre)')));
//							            $inc=intval(substr($max[0][0]['max(`Article`.`codeabarre`)'],3,10))+1;
//							            $c = str_pad($inc, 10, '0', STR_PAD_LEFT);
//							            $ch = str_pad($c, 13, '613', STR_PAD_LEFT);
//							            $data['codeabarre']= $ch;
//							            $this->Article->create();
//							            $this->Article->save($data);
//							            $data['article_id']=$this->Article->id;
//						            }else{
//							            $data['article_id']=$arti['article_id'];
//							            $this->Article->id = $arti['article_id'];
//	                                    $this->Article->saveField('prixachat',$arti['prix'] );
//							        }
//						            $data['code']=$lbc['Lignebandeconsultation']['codefrs'];
//								    $data['prix']=$arti['prix'];
//								    $this->Articlefournisseur->create();
//			                        $this->Articlefournisseur->save($data);
//						            $data['qte']=$arti['qte'];
//						            $data['prix']=$arti['prix'];
//						            $data['ht']=$arti['ht'];
//						            $data['lignedemandeoffredeprix_id']=$arti['ligne_id'];
//						            $data['commande_id']=$this->Commande->id;
//						            $this->Lignecommande->create();
//						            $this->Lignecommande->save($data);
//					            }
//				            }
//			            }
//				    }			
//	            }
//	        }			
//	        $this->Demandeoffredeprix->id = $id;
//	        $this->Demandeoffredeprix->saveField('commande', 1);
//		    $this->redirect(array('controller' => 'commandes','action' => 'index'));
//	    } else {
//		    $options = array('conditions' => array('Demandeoffredeprix.' . $this->Demandeoffredeprix->primaryKey => $id));
//		    $this->request->data = $this->Demandeoffredeprix->find('first', $options);
//	    }
//        $num = $this->Commande->find('all', array('recursive'=>-1,'fields' => array('max(Commande.numero)')));
//	    $cc=intval(substr($num[0][0]['max(`Commande`.`numero`)'],1,5))+1;
//        $c= str_pad($cc, 5, '0', STR_PAD_LEFT);
//	    $ch=str_pad($c, 6, 'C', STR_PAD_LEFT);
//        $this->set('ch', $ch);
//	    $fournisseurs=$this->Lignelignebandeconsultation->find('all',array('conditions' => array('Lignelignebandeconsultation.demandeoffredeprix_id'=>$id),'group' => array('Lignelignebandeconsultation.nameF')));
//	    $articles=$this->Bandeconsultation->find('all',array('conditions' => array('Bandeconsultation.demandeoffredeprix_id'=>$id),'group' => array('Bandeconsultation.designiationA')));
//	    $lignefs=$this->Lignelignebandeconsultation->find('all',array('conditions' => array('Lignelignebandeconsultation.demandeoffredeprix_id'=>$id),'group' => array('Lignelignebandeconsultation.nameF'),'order'=>array('Lignelignebandeconsultation.t')));
//	    $demandes=$this->Demandeoffredeprix->find('first',array('conditions'=>array('Demandeoffredeprix.id'=>$id)));
//		$this->set(compact('articles','fournisseurs','lignefs','demandes'));
//	}