<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Article;
use App\Model\Entity\Pointdevente;

/**
 * Bondechargements Controller
 *
 * @property \App\Model\Table\BondechargementsTable $Bondechargements
 * @method \App\Model\Entity\Bondechargement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BondechargementsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $depot_id = $this->request->getQuery('depot_id');
        if ($datedebut) {
            $cond1 = "Bondechargements.date >=  '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "Bondechargements.date  <=  '" .     $datefin . "' ";
        }


        if ($pointdevente_id) {
            $cond4 = "Bondechargements.pointdevente_id  =  '" . $pointdevente_id . "' ";
        }


        if ($depot_id) {
            $cond2 = "Bondechargements.depot_id =  '" .  $depot_id . "' ";
        }
        $query = $this->Bondechargements->find('all')->where([$cond1, $cond2, $cond3, $cond4])->order(['Bondechargements.id' => 'DESC']);
        $this->paginate = [
            'contain' => ['Pointdeventes', 'Depots', 'Bondetransferts'],
        ];
        $bondechargements = $this->paginate($query);
        $pointdeventes = $this->Bondechargements->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Bondechargements->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('bondechargements', 'depots','pointdeventes', 'depot_id', 'datedebut', 'datefin', 'pointdevente_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Bondechargement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $session = $this->request->getSession();
       $abrv = $session->read('abrvv');
       $liendd = $session->read('lien_stock' . $abrv);

       //   debug($liendd);
       $unite = 0;
       foreach ($liendd as $k => $liens) {
           //  debug($liens);
           if (@$liens['lien'] == 'bondechargements') {
               $unite = $liens['modif'];
           }
       }
       // debug($nombrecommande);die;
       if (($unite <> 1)) {
           $this->redirect(array('controller' => 'users', 'action' => 'login'));
       }
       $bondechargement = $this->Bondechargements->get($id, [
           'contain' => [
               'Pointdeventes', 'Depots', 'Bondetransferts', 'Lignebonchargements', 'Lignebondetransferts'
           ]
       ]);
       // debug($bondechargement);
       if ($this->request->is(['patch', 'post', 'put'])) {
           // debug($this->request->getData());die;
           $bondechargement = $this->Bondechargements->patchEntity($bondechargement, $this->request->getData(), ['associated' => ['Pointdeventes', 'Depots', 'Bondetransferts', 'Lignebonchargements', 'Lignebondetransferts' => ['validate' => false]]]);
           if ($this->Bondechargements->save($bondechargement)) {
               if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                   // debug($this->request->getData('data')['ligner']);
                   foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                       // debug($l);

                       if ($l['sup'] != 1) {
                           $tab['bondechargement_id'] = $id;
                           $tab['article_id'] = $l['article_id'];
                           // $tab['qtestock'] = $l['qtestock'];
                           $tab['qte'] = $l['qte'];
                           $tab['prix'] = $l['prix'];
                           $tab['total'] = $l['total'];

                           if (isset($l['id']) && (!empty($l['id']))) {
                               $lignebondechargement = $this->fetchTable('lignebonchargements')->get($l['id'], [
                                   'contain' => []
                               ]);
                           } else {
                               $lignebondechargement = $this->fetchTable('lignebonchargements')->newEmptyEntity();
                           };

                           $lignebondechargement = $this->fetchTable('lignebonchargements')->patchEntity($lignebondechargement, $tab);

                           if ($this->fetchTable('lignebonchargements')->save($lignebondechargement)) {

                              // $this->Flash->success("Ligne bon de chargement has been modified successfully");
                           } else {
                              // $this->Flash->error("Failed to midify ligne bon de chyargements");
                           }
                       } else {
                           //S  $this->request->allowMethod(['post', 'delete']);
                           $lignebonchargement = $this->fetchTable('Lignebonchargements')->get($l['id']);

                           $this->fetchTable('Lignebonchargements')->delete($lignebonchargement);
                       }
                   }
               }
           }
          // $this->set(compact("lignebondechargement"));
          return $this->redirect(['action' => 'index']);
          // $this->Flash->success("Bon de chargement has been modified successfully");
       }
       $lignebonchargementss = $this->Bondechargements->Lignebonchargements->find('all', [
           'contain' => ['Articles']
       ])
           ->where(['bondechargement_id' => $id]);

       $articles = $this->fetchTable('Articles')->find('all');
       
       $pointdeventes = $this->Bondechargements->Pointdeventes->find('list', ['limit' => 200]);
      
       $depots = $this->Bondechargements->Depots->find('list', ['limit' => 200]);
       $bondetransferts = $this->Bondechargements->Bondetransferts->find('list', ['limit' => 200]);
       $this->set(compact('bondechargement', 'articles', 'pointdeventes', 'depots', 'bondetransferts', 'lignebonchargementss'));
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
        $liendd = $session->read('lien_stock' . $abrv);

        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bondechargements') {
                $unite = $liens['ajout'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $num = $this->Bondechargements->find()->select(["num" =>
        'MAX(Bondechargements.numero)'])->first();
        // debug($num);

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

        $bondechargement = $this->Bondechargements->newEmptyEntity();
        if ($this->request->is('post')) {

            $bondechargement = $this->Bondechargements->patchEntity($bondechargement, $this->request->getData());
            if ($this->Bondechargements->save($bondechargement)) {

                $bondechargement_id = $bondechargement->id;

                $this->loadModel('Lignebonchargements');
//debug($this->request->getData('data')['ligner']);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
            
                    foreach ($this->request->getData('data')['ligner'] as $ligne) {

                        if ($ligne['sup'] != 1) {
                            $data = $this->fetchTable('Lignebonchargements')->newEmptyEntity();
                            $data['article_id'] = $ligne['article_id'];
                           /// $data['prix'] = $ligne['prix'];
                            $data['qte'] = $ligne['qte'];
                            ///$data['total'] = $ligne['total'];
                            $data['qteliv'] = 0;

                            $data['bondechargement_id'] = $bondechargement_id;

                            if ($this->fetchTable('Lignebonchargements')->save($data)) {
                               //debug($data);die();
                                //$this->Flash->success("Ligne bon de chargement ajouté");
                            } else {
                                //$this->Flash->error("Veuillez réessayer");
                            }
                        }

                        //$this->set(compact("lignebondechargement"));
                    }
                }



                //$this->Flash->success(__('Bon de chargement ajouté'));
                return $this->redirect(['action' => 'index']);
            } else {
               // $this->Flash->error(__("Veuillez réessayer"));
            }
        }
        $articles = $this->fetchTable('Articles')->find('all');


        $pointdeventes = $this->Bondechargements->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bondechargements->Depots->find('list', ['limit' => 200]);
        $bondetransferts = $this->Bondechargements->Bondetransferts->find('list', ['limit' => 200]);
        $this->set(compact('bondechargement', 'pointdeventes', 'depots', 'bondetransferts', 'articles', 'mm'));
    }


    /* 
    public function edit($id = null)
    {
        $bondechargement = $this->Bondechargements->get($id, [
            'contain' => ['Pointdeventes','Depots', 'Bondetransferts', 'Lignebonchargements', 'Lignebondetransferts'
            ]
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
     debug ($this->request->getData('data')['ligner']);die;
            $bondechargement = $this->Bondechargements->patchEntity($bondechargement, $this->request->getData());
            if ($this->Bondechargements->save($bondechargement)) {
//////

    if (isset($this->request->getData('data')['adresselivraisonclients']) && (!empty($this->request->getData('data')['adresselivraisonclients']))) {
        foreach ($this->request->getData('data')['adresselivraisonclients'] as $i => $adresseliv) {
       
            if ($adresseliv['sup'] != 1) {
                $data['adresse'] = $adresseliv['adresse'];
                $data['client_id'] = $id;
              
                if (isset($adresseliv['id']) && (!empty($adresseliv['id']))) {
                    $adresselivraisonclient = $this->fetchTable('adresselivraisonclients')->get($adresseliv['id'], [
                        'contain' => []
                    ]);
                } else {
                    $adresselivraisonclient = $this->fetchTable('adresselivraisonclients')->newEmptyEntity();
                };
               
                $adresselivraisonclient = $this->fetchTable('adresselivraisonclients')->patchEntity($adresselivraisonclient, $data);
            
                if ($this->fetchTable('adresselivraisonclients')->save($adresselivraisonclient)) {
          
                    $this->Flash->success("adresselivraisonclient has been òodified successfully");
                } else {
                    $this->Flash->error("Failed to midify adresselivraisonclient");
                }
            }
            $this->set(compact("adresselivraisonclient"));
        }
    
  

                /////

                $id = $this->Bondechargement->id;
                //$this->misejour("Bondechargement", "add", $id);
                if (!empty($this->request->getData('data')['ligner'])) {
                    foreach ($this->request->getData('data')['ligner']as $l) {
                        $tab = array();
                        if ($l['sup'] != 1) {
                            $tab['bondechargement_id'] = $id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['qtestock'] = $l['qtestock'];
                            $tab['qte'] = $l['qte'];
                            $tab['prix'] = $l['prix'];
                            $tab['total'] = $l['total'];
                            $this->Lignebonchargement->create();
                            $this->Lignebonchargement->save($tab);
                        }
                    }
                }
                        

















                $this->Flash->success(__('The {0} has been saved.', 'Bondechargement'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bondechargement'));
        }
      $lignebonchargementss=$this->Bondechargements->Lignebonchargements->find('all',[
            'contain'=> ['Articles']
         ])
         ->where(['bondechargement_id' =>$id]);

         $articles = $this->fetchTable('Articles')->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation']);
         //$ban= $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $pointdeventes = $this->Bondechargements->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bondechargements->Depots->find('list', ['limit' => 200]);
        $bondetransferts = $this->Bondechargements->Bondetransferts->find('list', ['limit' => 200]);
        $this->set(compact('bondechargement','articles', 'pointdeventes', 'depots', 'bondetransferts','lignebonchargementss'));
    }*/


    /**
     * Delete method
     *
     * @param string|null $id Bondechargement id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
         $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_stock' . $abrv);

        //   debug($liendd);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bondechargements') {
                $unite = $liens['supp'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->request->allowMethod(['post', 'delete']);
        $bn = $this->Bondechargements->get($id);
        $lignes = $this->fetchTable('Lignebonchargements')->find('all', [])
        ->where(['Lignebonchargements.bondechargement_id=' . $id]);
            if ($this->Bondechargements->delete($bn)) {
                $this->misejour("Bondechargements", "delete", $id);
                foreach ($lignes as $l) {
                    $this->fetchTable('Lignebonchargements')->delete($l);
                }
            } else {
                
}

        return $this->redirect(['action' => 'index']);
    }



    public function receive()
    {
        $id = $this->request->getQuery('idfam');

        $ligne = $this->fetchTable('Articles')->get($id);

        echo (json_encode($ligne));

        die;
    }





    public function edit($id = null)
    {
         $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_stock' . $abrv);

        //   debug($liendd);
        $unite = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'bondechargements') {
                $unite = $liens['modif'];
            }
        }
        // debug($nombrecommande);die;
        if (($unite <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $bondechargement = $this->Bondechargements->get($id, [
            'contain' => [
                'Pointdeventes', 'Depots', 'Bondetransferts', 'Lignebonchargements', 'Lignebondetransferts'
            ]
        ]);
        // debug($bondechargement);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());die;
            $bondechargement = $this->Bondechargements->patchEntity($bondechargement, $this->request->getData(), ['associated' => ['Pointdeventes', 'Depots', 'Bondetransferts', 'Lignebonchargements', 'Lignebondetransferts' => ['validate' => false]]]);
            if ($this->Bondechargements->save($bondechargement)) {
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        // debug($l);

                        if ($l['sup'] != 1) {
                            $tab['bondechargement_id'] = $id;
                            $tab['article_id'] = $l['article_id'];
                            // $tab['qtestock'] = $l['qtestock'];
                            $tab['qte'] = $l['qte'];
                          ///  $tab['prix'] = $l['prix'];
                            //$tab['total'] = $l['total'];

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignebondechargement = $this->fetchTable('Lignebonchargements')->get($l['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignebondechargement = $this->fetchTable('Lignebonchargements')->newEmptyEntity();
                            };

                            $lignebondechargement = $this->fetchTable('Lignebonchargements')->patchEntity($lignebondechargement, $tab);

                            if ($this->fetchTable('lignebonchargements')->save($lignebondechargement)) {

                               // $this->Flash->success("Ligne bon de chargement has been modified successfully");
                            } else {
                               // $this->Flash->error("Failed to midify ligne bon de chyargements");
                            }
                        } else {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            if ($l['id']){
                                $lignebonchargement = $this->fetchTable('Lignebonchargements')->get($l['id']);
                                $this->fetchTable('Lignebonchargements')->delete($lignebonchargement);


                            }

                        }
                    }
                }
            }
           // $this->set(compact("lignebondechargement"));
           return $this->redirect(['action' => 'index']);
           // $this->Flash->success("Bon de chargement has been modified successfully");
        }
        $lignebonchargementss = $this->Bondechargements->Lignebonchargements->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bondechargement_id' => $id]);

        $articles = $this->fetchTable('Articles')->find('all');
        
        $pointdeventes = $this->Bondechargements->Pointdeventes->find('list', ['limit' => 200]);
       
        $depots = $this->Bondechargements->Depots->find('list', ['limit' => 200]);
        $bondetransferts = $this->Bondechargements->Bondetransferts->find('list', ['limit' => 200]);
        $this->set(compact('bondechargement', 'articles', 'pointdeventes', 'depots', 'bondetransferts', 'lignebonchargementss'));
    }

    public function imprimerrecherche()
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $depot_id = $this->request->getQuery('depot_id');
        if ($datedebut) {
            $cond1 = "Bondechargements.date >=  '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "Bondechargements.date  <=  '" .     $datefin . "' ";
        }
        if ($pointdevente_id) {
            $cond4 = "Bondechargements.pointdevente_id  =  '" . $pointdevente_id . "' ";
        }


        if ($depot_id) {
            $cond2 = "Bondechargements.depot_id =  '" .  $depot_id . "' ";
        }
        $query = $this->Bondechargements->find('all')->where([$cond1, $cond2, $cond3, $cond4]);
        $this->paginate = [
            'contain' => ['Pointdeventes', 'Depots', 'Bondetransferts'],
        ];
        $bondechargements = $this->paginate($query);
        //debug($bondechargements);
        // die;
        $this->set(compact('bondechargements'));
    }





    public function imprimerBon($id = null)
    {
        $bondechargement = $this->Bondechargements->get($id, [
            'contain' => ['Pointdeventes', 'Depots', 'Bondetransferts',  'Lignebondetransferts'],
        ]);
        //  debug($bondechargement['lignebonchargements']['id']);die;
        $pointdeventes = $this->Bondechargements->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Bondechargements->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('lignebonchargements')->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);



        $lignebonchargements = $this->Bondechargements->Lignebonchargements->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bondechargement_id' => $id]);


        foreach ($lignebonchargements as $l) {
            //   debug($l);die;

        }






        /* $lignebondechargements = $this->Bondechargements->Lignebonchargements->find('list',[
            'contain' => ['Bondechargements', 'Articles'],
        ]);*/


        $this->set(compact('bondechargement', 'pointdeventes', 'depots', 'articles', 'lignebonchargements'));
    }

    public function getdepot($id = null){

        $id = $this->request->getQuery('id');
    
        $query = $this->fetchTable('Depots')->find();
        $query->where(['pointdevente_id' => $id]);
       
        $select = "<select name='depot_id' id='depot_id' class='form-control select2'  '>
                    <option value='' >Veuillez choisir !!</option>";
        foreach ($query as $q) {
            $select =  $select . "  <option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['name'] . "</option>";
        }
        $select = $select . "</select>";
        echo json_encode(array('select' => $select));
        die;
    
    
    }
}
