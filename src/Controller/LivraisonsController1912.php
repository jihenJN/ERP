<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Livraisons Controller
 *
 * @property \App\Model\Table\LivraisonsTable $Livraisons
 * @method \App\Model\Entity\Livraison[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LivraisonsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function imprimeview($id = null)
    {
      
        $livraison= $this->Livraisons->get($id, [
            'contain' => [ 'Fournisseurs']
        ]);
        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['limit' => 200]);
        // $this->set(compact('commande','commercials','clients'));
      

        $this->loadModel('Lignelivraisons');
        $lignelivraisons = $this->Lignelivraisons->find('all')->contain(['Articles'])->where(["Lignelivraisons.livraison_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $livraisons = $this->Livraisons->find('all')->contain(['Fournisseurs']);
        $this->set(compact('lignelivraisons', 'articles', 'livraison', 'fournisseurs'));
    }
    public function index()
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $this->loadModel('Personnels');


        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $numero = $this->request->getQuery('numero');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $depot_id = $this->request->getQuery('depot_id');

        if ($historiquede) {
            $cond2 = "Livraisons.date  >='" . $historiquede . "' ";
        }
        if ($au) {
            $cond6 = "Livraisons.date <='" . $au . "' ";
        }
        if ($pointdevente_id) {
            $cond3 = "Livraisons.pointdevente_id = '" . $pointdevente_id . "' ";
        }
        if ($fournisseur_id) {
            $cond4 = "Livraisons.fournisseur_id =  '" . $fournisseur_id . "' ";
        }
        if ($depot_id) {
            $cond5 = "Livraisons.depot_id =  '" . $depot_id . "' ";
        }
        if ($numero) {
            $cond1 = "Livraisons.numero =  '" . $numero . "' ";
        }

        $query = $this->Livraisons->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6])
                  ->order(["Livraisons.id"=>'DESC']);
                ;

        $this->paginate = [
            'contain' => ['Fournisseurs', 'Adresselivraisonfournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports'],
        ];
        $livraisons = $this->paginate($query);

        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Livraisons->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //$chauffeurs= $this->Commandes->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"'),'fields'=>array('Commandes->Personnels.code','Commandes->Personnels.nom','Commandes->Personnels.prenom')));
        $chauffeurs = $this->Livraisons->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="1"'), 'fields' => array('Personnels.code', 'Personnels.nom', 'Personnels.prenom')));
        $confaieurs = $this->Livraisons->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="5"'), 'fields' => array('Personnels.code', 'Personnels.nom', 'Personnels.prenom')));
        //$chauffeurs=$this->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id="1"')));
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);


        $this->set(compact('confaieurs', 'fournisseurs', 'livraisons', 'chauffeurs', 'materieltransports', 'pointdeventes', 'depots', 'cartecarburants'));
    }

    /**
     * View method
     *
     * @param string|null $id Livraison id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $livraison = $this->Livraisons->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Lignelivraisons');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
            if ($this->Livraisons->save($livraison)) {
                $this->loadModel('Lignelivraisons');
                $articles_ids = $this->request->getData('articles_ids');
                $codefs = $this->request->getData('codef');
                $qtes = $this->request->getData('qte');
                $prixhts = $this->request->getData('prixht');
                $remises = $this->request->getData('remise');
                $prixunhts = $this->request->getData('prixunht');
                $fcodecs = $this->request->getData('fcodec');
                $tvas = $this->request->getData('tva');
                $ttcs = $this->request->getData('ttc');
                $lignes = $this->Lignelivraisons->find()->where(["Livraison_id" => $id])->all();
                foreach ($lignes as $item) {
                    $this->Lignelivraisons->delete($item);
                }
                for ($i = 0; $i < sizeof($articles_ids); $i++) {
                    $ligne = $this->Lignelivraisons->newEmptyEntity();
                    $this->loadModel('Lignebonchargements');
                    $lignebonChar = $this->Lignebonchargements->find()->where(['article_id' => $articles_ids[$i]])->order(['id' => "DESC"])->first();
                    $qte = 0;
                    if ($lignebonChar != null) {
                        $qte = $lignebonChar->qte;
                        $lignebonChar->qte -= $qtes[$i];
                        $this->Lignebonchargements->save($lignebonChar);
                    }
                    $ligne->Livraison_id = $livraison->id;
                    $ligne->commande_id = $livraison->commande_id;
                    $ligne->fournisseur_id = $livraison->fournisseur_id;
                    $ligne->codefrs = $codefs[$i];
                    $ligne->article_id = $articles_ids[$i];
                    $ligne->qte = $qte;
                    $ligne->qteliv = $qtes[$i];
                    $ligne->remise = $remises[$i];
                    $ligne->fodec = $fcodecs[$i];
                    $ligne->tva = $tvas[$i];
                    $ligne->ttc = $ttcs[$i];
                    $ligne->prix = $prixhts[$i];
                    $ligne->ht = $prixunhts[$i];
                    $this->Lignelivraisons->save($ligne);
                }
                $this->Flash->success(__('The {0} has been saved.', 'Livraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Livraison'));
        }
        $commandes = $this->Livraisons->Commandes->find('list', ['limit' => 200]);

        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisons->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['limit' => 200]);
        $lignes = $this->Lignelivraisons->find()->where(["Livraison_id" => $id])->all();
        $count = $this->Lignelivraisons->find()->where(["Livraison_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');

        $this->set(compact('livraison', 'lignes', 'count', 'articles', 'fournisseurs', 'commandes', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
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
         $liendd = $session->read('lien_achat' . $abrv);
         //   debug($liendd);
         $fournisseur = 0;
         foreach ($liendd as $k => $liens) {
             //  debug($liens);
             if (@$liens['lien'] == 'livraisons') {
                 $fournisseur = $liens['ajout'];
             }
         }
         // debug($societe);die;
         if (($fournisseur <> 1)) {
             $this->redirect(array('controller' => 'users', 'action' => 'login'));
         }
        $livraison = $this->Livraisons->newEmptyEntity();
        $last = $this->Livraisons->find()->order(['id' => "desc"])->first();
        $numero = 1;
        if ($last != null) {
            preg_match_all('!\d+!', $last->numero, $numero);

            $numero = $numero[0][0];
        }

        if ($this->request->is('post')) {
              //debug($this->request->getData());die;
            $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
            if ($this->Livraisons->save($livraison)) {
                $this->loadModel('Livraisons');
                if ($this->request->is('post')) {

                    $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
                    if ($this->Livraisons->save($livraison)) {
                        $this->loadModel('Livraisons');
                        $livraison_id = $livraison->id;

                        if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                            $this->loadModel('Lignelivraisons');
                            foreach ($this->request->getData('data')['tabligne3'] as $i => $livraison) {
                                debug($livraison);
                                if ($livraison['sup'] != 1) {
                                    $data['article_id'] = $livraison['article_id'];
                                    $data['livraison_id'] = $livraison_id;
                                    $data['qteliv'] = $livraison['qte'];
                                    $data['prix'] = $livraison['prix'];
                                    $data['remise'] = $livraison['remise'];
                                    $data['ht'] = $livraison['ht'];
                                    $data['tva'] = $livraison['tva'];
                                    $data['fodec'] = $livraison['fodec'];
                                    $data['ttc'] = $livraison['ttc'];

                                    
                                    $lignelivraisons = $this->fetchTable('Lignelivraisons')->newEmptyEntity();
                                    $lignelivraisons = $this->Lignelivraisons->patchEntity($lignelivraisons, $data);

                                    
                                    if ($this->Lignelivraisons->save($lignelivraisons)) {

                                        $this->Flash->success("lignelivraisons has been created successfully");
                                    } else {


                                        $this->Flash->error("Failed to create lignelivraisons");
                                    }
                                }
                                $this->set(compact("lignelivraisons"));
                            }
                        }
                 
                        }

                    $this->Flash->success(__('The {0} has been saved.', 'livraison'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'livraison'));
        }
        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisons->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['limit' => 200]);
       // $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);

        $this->loadModel('Articles');
        $cond = 'Articles.famille_id != 1 ';

        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])
        ->where([$cond]) ; 
        //debug($articles);
        $chauffeurs = $this->Livraisons->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 1]);
        $conffaieurs = $this->Livraisons->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 5]);
        $this->set(compact('conffaieurs', 'chauffeurs', 'livraison', 'articles', 'numero', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }




    public function getadresselivraison($id = null)
    {
        $id = $this->request->getQuery('idfam');
       
        $ligne = $this->fetchTable('Fournisseurs')->get($id, [
            'contain' => [],
        ]);
        $query = $this->fetchTable('Adresselivraisonfournisseurs')->find();
        $query->where(['fournisseur_id' => $id]);
        // debug($query);
        $select = "
        <label class='control-label' for='sousfamille1-id'>Adresse livraison</label>
        <select name='adresse' id='adresselivraison-id' class='form-control select2'  onchange='getsousfamille2(this.value)'>
                    <option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q);
            $select =  $select . "  <option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['adresse'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> ";
        echo json_encode(array('select' => $select, 'ligne' => $ligne));
        die;
        //$this->set(compact('query'));
        /* foreach ($query as $q) {
            json_encode($q);
            debug($q);
        }
     */
    }






    /**
     * Edit method
     *
     * @param string|null $id Livraison id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    
    
    
    
//     public function edit($id = null)
//    {
//        $this->loadModel('Lignelivraisons');
//
//
//        $bonlivraison = $this->Livraisons->get($id, [
//            'contain' => [ 'Pointdeventes', 'Depots'],
//        ]);
//
//
//
//
//        // debug($bonlivraison);
//
//
//        if ($this->request->is(['patch', 'post', 'put'])) {
//            // debug($this->request->getData());
//
//
//            $data['numero'] = $this->request->getData('numero');
//            $data['date'] = $this->request->getData('date');
////            $data['client_id'] = $this->request->getData('client_id');
////            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
//            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
////            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
//            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
////            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
//            $data['depot_id'] = $this->request->getData('depot_id');
////            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
//
//            $data['totalht'] = $this->request->getData('total');
//            $data['totaltva'] = $this->request->getData('tvacommande');
//            $data['totalfodec'] = $this->request->getData('fod');
//            $data['totalremise'] = $this->request->getData('totalremise');
////            $data['escompte'] = $this->request->getData('escompte');
////            $data['escompte'] = $this->request->getData('tpecommande');
////            $data['escompte'] = $this->request->getData('escompte');
//
//
//
//            $data['totalttc'] = $this->request->getData('totalttc');
////            $data['payementcomptant'] = $this->request->getData('checkpayement');
////            $data['poste'] = $this->request->getData('poste');
//
//
//
//
//            $livraison = $this->Livraisons->patchEntity($livraison, $data);
//            if ($this->livraisons->save($livraison)) {
//                $commande = $this->fetchTable('Commandefournisseurs')->get($livraison->commandefournisseur_id);
//                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
//                    foreach ($this->request->getData('data')['tabligne3'] as $i => $l) {
//                        //debug($l);
//
//
//                        $tab['livraison_id'] = $livraison->id;
//                        $tab['article_id'] = $l['article_id'];
//                        $tab['qte'] = $l['qte'];
//                       
//                        $tab['punht'] = $l['punht'];
//                        $tab['remise'] = $l['remiseligne'];
//                        $tab['tva'] = $l['tva'];
//
//
//                        $tab['fodec'] = $l['fodec'];
//                        $tab['tva'] = $l['tva'];
//                        $tab['ttc'] = $l['ttc'];
//                        $tab['qteliv'] = $l['qteliv'];
//
//                        $lignelivraison = $this->fetchTable('Lignelivraisons')->get($l['id'], [
//                            'contain' => ['Articles']
//                        ]);
//
//
//
//
//                        $lignelivraison = $this->fetchTable('Lignelivraisons')->patchEntity($lignelivraison, $tab);
//                        $this->fetchTable('Lignelivraisons')->save($lignelivraison);
//                        
//
//
//
//
//
//                        $lignecommandes = $this->fetchTable('Lignecommandefournisseurs')->find('all', [])
//                            ->where(['commandefournisseur_id =' . $commande->id]);
//                        // debug($lignecommandes);
//                        foreach ($lignecommandes as $lignecommande) {
//                            if ($l['article_id'] == $lignecommande['article_id']) {
//                                $ligneupdate = $this->fetchTable('Lignecommandefournisseurs')->get($lignecommande['id']);
//
//                                //  debug($qte);
//                                $ligneupdate->qteliv = $l['qteliv'];
//                                $this->fetchTable('Lignecommandefournisseurs')->save($ligneupdate);
//                            }
//                        }
//                        /*
//                            // debug($lignebonchargement);
//                            $donne = $l['quantiteliv'] + $lignecommande['quantiteliv'];
//                            // debug($donne);
//                            $lignecommande->quantiteliv = $donne;**/
//
//
//
//                        //   $this->fetchTable('Lignecommandes')->save($lignecommande);
//
//                    }
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
//               // $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
//        }
//        $lignelivraisons = $this->Lignelivraisons->find('all', [
//            'contain' => ['Articles']
//        ])
//            ->where(['livraison_id' => $id]);
//
//
//        /* foreach($lignebonlivraisons as $l){
//            debug($l);}*/
//
//
//
//
//
//        $client_id = $bonlivraison->client_id;
//
//
//
//
//
//       
//       // $depots = $this->Depots->find('list', ['limit' => 200]);
//    
//        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
//       // $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
//        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
//
//        $this->set(compact('lignelivraisons', 'articles', 'livraison',  'adresselivraisonclients'));
//    }


    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function edit($id = null)
    {
         $session = $this->request->getSession();
         $abrv = $session->read('abrvv');
         $liendd = $session->read('lien_achat' . $abrv);
         //   debug($liendd);
         $fournisseur = 0;
         foreach ($liendd as $k => $liens) {
             //  debug($liens);
             if (@$liens['lien'] == 'livraisons') {
                 $fournisseur = $liens['modif'];
             }
         }
         // debug($societe);die;
         if (($fournisseur <> 1)) {
             $this->redirect(array('controller' => 'users', 'action' => 'login'));
         }
        $livraison = $this->Livraisons->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Lignelivraisons');

        if ($this->request->is(['patch', 'post', 'put'])) {
         //debug($this->request->getData());die;
            $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
            if ($this->Livraisons->save($livraison)) {
                 $commande = $this->fetchTable('Commandefournisseurs')->get($livraison->commandefournisseur_id);
                $this->loadModel('Lignelivraisons');
                $articles_ids = $this->request->getData('articles_ids');
                $codefs = $this->request->getData('codef');
                $qtes = $this->request->getData('qte');
                $prixhts = $this->request->getData('prixht');
                $remises = $this->request->getData('remise');
                $prixunhts = $this->request->getData('prixunht');
                $fodecs = $this->request->getData('fodec');
                $tvas = $this->request->getData('tva');
                $ttcs = $this->request->getData('ttc');
                $lignes = $this->Lignelivraisons->find()->where(["livraison_id" => $id])->all();
                
              if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                            $this->loadModel('Lignelivraisons');

                            foreach ($this->request->getData('data')['tabligne3'] as $i => $livraison) {
                             //debug($livraison);
                                if ($livraison['sup'] != 1) {
                                    // debug($facture);
                                    $data['article_id'] = $livraison['article_id'];
                                    $data['livraison_id'] = $id;
                                    $data['qteliv'] = $livraison['qteliv'];
                                    $data['qte'] = $livraison['qte'];
                                    $data['prix'] = $livraison['prix'];
                                    $data['remise'] = $livraison['remise'];
                                    $data['ht'] = $livraison['punht'];
                                    $data['tva'] = $livraison['tva'];
                                    $data['fodec'] = $livraison['fodec'];
                                    $data['ttc'] = $livraison['ttc'];
                                    //debug($data);

                                

                        $lignelivraison = $this->fetchTable('Lignelivraisons')->get($livraison['id'], [
                            'contain' => ['Articles']
                        ]);
                           $lignelivraison = $this->fetchTable('Lignelivraisons')->patchEntity($lignelivraison, $data);         
                                     
                           $this->fetchTable('Lignelivraisons')->save($lignelivraison);
                          // debug($lignelivraison);
                                   
                                     
                                      
                                      
                                      
                                        $lignecommande = $this->fetchTable('Lignecommandefournisseurs')->find('all', [])
                            ->where(['commandefournisseur_id=' . $commande->id]);
                    
                                        
                        foreach ($lignecommande as $lignecommande) {
                            if ($livraison['article_id'] == $lignecommande['article_id']) {
                                $ligneupdate = $this->fetchTable('Lignecommandefournisseurs')->get($lignecommande['id']);

                            
                                $ligneupdate->qteliv = $livraison['qteliv'];
                                $this->fetchTable('Lignecommandefournisseurs')->save($ligneupdate);
                            }
                        }
                                
                                     
                                     
                                     
                                     
                                     
                                }
                                $this->set(compact("lignelivraison"));
                            }
                        }
                //$this->Flash->success(__('The {0} has been saved.', 'Livraison'));

                return $this->redirect(['action' => 'index']);
            }
           // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Livraison'));
        }
        $commandes = $this->Livraisons->Commandes->find('list', ['limit' => 200]);

        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Livraisons->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['limit' => 200]);
        $lignes = $this->Lignelivraisons->find()->where(["Livraison_id" => $id])->all();
        $count = $this->Lignelivraisons->find()->where(["Livraison_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
         $this->loadModel('Personnels');
        $articles = $this->Articles->find('all');
//        $chauffeurs = $this->Livraisons->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 1]);
//    
//        $conffaieurs = $this->Livraisons->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 5]);
              $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
        $this->set(compact('conffaieurs','chauffeurs','livraison', 'lignes', 'count', 'articles', 'fournisseurs', 'commandes', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Livraison id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    { $session = $this->request->getSession();
         $abrv = $session->read('abrvv');
         $liendd = $session->read('lien_achat' . $abrv);
         //   debug($liendd);
         $fournisseur = 0;
         foreach ($liendd as $k => $liens) {
             //  debug($liens);
             if (@$liens['lien'] == 'livraisons') {
                 $fournisseur = $liens['supp'];
             }
         }
         // debug($societe);die;
         if (($fournisseur <> 1)) {
             $this->redirect(array('controller' => 'users', 'action' => 'login'));
         }
        $this->loadModel('Lignelivraisons');
        $this->request->allowMethod(['post', 'delete']);
        $livraison = $this->Livraisons->get($id);
         $commande = $this->fetchTable('Commandefournisseurs')->get($livraison->commandefournisseur_id);
         $idcom = $commande->id;
         $idd = $id;
        $lignelivraisons = $this->Lignelivraisons->find('all', [])
        ->where(['livraison_id' => $id]);
        
         $lignelivraisons = $this->fetchTable('Lignelivraisons')->find('all', [])
            ->where(['Lignelivraisons.livraison_id=' . $idd]);

          $lignecommandes = $this->fetchTable('Lignecommandefournisseurs')->find('all', [])
            ->where(['commandefournisseur_id =' . $idcom]);
        
       foreach ($lignelivraisons as $lignelivraison) {
            foreach ($lignecommandes as $lignecommande) {

                if ($lignelivraison['article_id'] == $lignecommande['article_id']) {

                    $ligneupdate = $this->fetchTable('Lignecommandefournisseurs')->get($lignecommande['id']);
                    $qte = $lignecommande['qteliv'] - $lignelivraison['qteliv'];
                  
                    $ligneupdate->qteliv = $qte;
                    $this->fetchTable('Lignecommandefournisseurs')->save($ligneupdate);
                }
            }
        }

        
        foreach ($lignelivraisons as $l) {
                $this->Lignelivraisons->delete($l);
            }

        if ($this->Livraisons->delete($livraison)) {
        } else {
        }

    
        
        
        
        
        
        return $this->redirect(['action' => 'index']);
    }
    
    
    
    
}