<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

/**
 * Bonlivraisons Controller
 *
 * @property \App\Model\Table\BonlivraisonsTable $Bonlivraisons
 * @method \App\Model\Entity\Bonlivraison[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonlivraisonsController extends AppController {

    public function imprimerprep($tab = null) {


        $preparatif = $this->fetchTable('Bonlivraisons')->find('all', [
                    'contain' => ['Clients', 'Commandes', 'Materieltransports']
                ])
                ->where(['Bonlivraisons.preparatif_id in (' . $tab . ')   ']);

        foreach ($preparatif as $p) {
            $p['date'] = date('Y-m-d');
        }




        foreach ($preparatif as $p) {
            $chauffeur_id = $p['chauffeur_id'];
            $convoyeur_id = $p['convoyeur_id'];
            //debug($chauffeur_id) ;die ;
        }
        $chauffeur = $this->fetchTable('Personnels')->find()->select(["id" =>
                    '(' . $chauffeur_id . ') ', "nom" => "nom"])->first();
        //debug($chauffeur) ; die ; 
        $chauffeur = $this->fetchTable('Personnels')->find('all', [])
                ->where(['Personnels.id' => $chauffeur_id]);
        foreach ($chauffeur as $ch) {
            $chauff = $ch['nom'];
        }


        //debug($namech) ; die ; 

        $convoyeur = $this->fetchTable('Personnels')->find()->select(["id" =>
                    '(' . $chauffeur_id . ') ', "nom" => "nom"])->first();
        //debug($chauffeur) ; die ; 
        $convoyeur = $this->fetchTable('Personnels')->find('all', [])
                ->where(['Personnels.id' => $convoyeur_id]);
        foreach ($convoyeur as $cv) {
            $conv = $cv['nom'];
        }




        $this->set(compact('preparatif', 'chauffeur', 'convoyeur', 'chauff', 'conv'));
    }

    public function imprimeview($id = null) {
        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Adresselivraisonclients', 'Lignebonlivraisons'],
        ]);

        $lignebonlivraisons = $this->Bonlivraisons->Lignebonlivraisons->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['bonlivraison_id' => $id]);






        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Bonlivraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonlivraisons->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);

        $this->set(compact('lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index($type = null) {

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';

        $cond8 = '';

        $cond9 = '';


        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        // debug($client_id);
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        //  debug($pointdevente_id);
        $chauffeur_id = $this->request->getQuery('chauffeur_id');
        // debug($chauffeur_id);
        $depot_id = $this->request->getQuery('depot_id');
        //debug($depot_id);
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        //debug($cartecarburant_id);
        $convoyeur_id = $this->request->getQuery('convoyeur_id');
        // debug($convoyeur_id);







        $materieltransport_id = $this->request->getQuery('materieltransport_id');
        if ($materieltransport_id) {
            $cond1 = "Bonlivraisons.materieltransport_id =  '" . $materieltransport_id . "' ";
        }


        if ($datedebut) {
            $cond2 = "Bonlivraisons.date   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "Bonlivraisons.date  <= '" . $datefin . "' ";
        }
        if ($client_id) {
            $cond4 = "Bonlivraisons.client_id = '" . $client_id . "' ";
        }
        if ($pointdevente_id) {
            $cond5 = "Bonlivraisons.pointdevente_id  =  '" . $pointdevente_id . "' ";
        }
        if ($chauffeur_id) {
            $cond6 = "Bonlivraisons.chauffeur_id  = '" . $chauffeur_id . "' ";
        }
        if ($depot_id) {
            $cond7 = "Bonlivraisons.depot_id  = '" . $depot_id . "' ";
        }
        if ($cartecarburant_id) {
            $cond8 = "Bonlivraisons.cartecarburant_id  = '" . $cartecarburant_id . "' ";
        }
        if ($convoyeur_id) {
            $cond9 = "Bonlivraisons.convoyeur_id  '=" . $convoyeur_id . "' ";
        }
        $condtyp = "Bonlivraisons.typebl=" . $type;
        // debug($condtyp);die;
        $query = $this->Bonlivraisons->find('all')->where([$condtyp, $cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9])
                ->order(['Bonlivraisons.id' => 'DESC']);
        //  debug($query);

        $this->paginate = [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Adresselivraisonclients'],
        ];
        $bonlivraisons = $this->paginate($query);
        //  debug($bonlivraisons);


        $this->loadModel('Personnels');


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($chauffeurs);

        $chauffeurs = $this->fetchTable('Personnels')->find('all')
                ->where(['fonction_id' => 1]);

        //  debug($chauffeurs);die;
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id = 5"]);


        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);

        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $pointdeventes = $this->Bonlivraisons->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Bonlivraisons->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);

        $Factureclientsoptions = $this->Bonlivraisons->Factureclients->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);

        $adresselivraisonclientsoptions = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);

        // debug($query);






        $this->set(compact('type',
                        'chauffeurs',
                        'client_id',
                        'chauffeur_id',
                        'depot_id',
                        'cartecarburant_id',
                        'convoyeur_id',
                        'pointdevente_id',
                        'conffaieurs',
                        'depots',
                        'bonlivraisons',
                        'clients',
                        'pointdeventes',
                        'depotsoptions',
                        'materieltransports',
                        'cartecarburants',
                        'Factureclientsoptions',
                        'adresselivraisonclientsoptions'
        ));
    }

    /**
     * View method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null) {
        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Adresselivraisonclients', 'Commandeclients', 'Lignebonlivraisons'],
        ]);

        $lignebonlivraisons = $this->Bonlivraisons->Lignebonlivraisons->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['bonlivraison_id' => $id]);







//        $client = $this->fetchTable('Clients')->get($commande->client_id, [
//            'contain' => ['Localites', 'Delegations']
//
//        ]);

        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Bonlivraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonlivraisons->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);

        $this->set(compact('client', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($type = null) {



        $num = $this->Bonlivraisons->find()->select(["num" =>
                    'MAX(Bonlivraisons.numero)'])->first();
        // debug($num);

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

        $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {

            $num = $this->Bonlivraisons->find()->select(["num" =>
                        'MAX(Bonlivraisons.numero)'])->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
            //debug($this->request->getData());
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['typebl'] = $type;
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresselivraison');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['kilometragedepart'] = $this->request->getData('kilm_depart');
            $data['kilometragearrive'] = $this->request->getData('kilm_arrive');
            $data['totalht'] = $this->request->getData('totalht');
            $data['totaltva'] = $this->request->getData('totaltva');
            $data['totalfodec'] = $this->request->getData('Totalfodec');
            $data['totalremise'] = $this->request->getData('Totalremise');
            $data['totalttc'] = $this->request->getData('Totalttc');
            // 
            // 
            // 
            //   debug($bonlivraison);//die;










            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            // debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {
                $this->misejour("Bonlivraisons", "add", $bonlivraison->id);

                $bonlivraison_id = $bonlivraison->id;


























                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        // debug($l);

                        if ($l['supp'] != 1) {




                            $tab['bonlivraison_id'] = $bonlivraison_id;
                            $tab['qte'] = $l['qteStock'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['quantiteliv'] = $l['qte'];
                            $tab['qte'] = $l['qte'];
                            $tab['prixht'] = $l['prixht'];
                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['punht'];
                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];

                            $tab['ttc'] = $l['ttc'];
                            // debug($tab);





                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();


                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);
                            //debug($lignebonlivraison);
                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                        }
                    }
                }






















                //   $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));

                return $this->redirect(['action' => 'index/' . $type]);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $this->loadModel('Personnels');


        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Bonlivraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonlivraisons->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        $factureclients = $this->Bonlivraisons->Factureclients->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('type', 'mm', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'factureclients', 'adresselivraisonclients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');


        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots'],
        ]);







        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());


            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');

            $data['totalht'] = $this->request->getData('total');
            $data['totaltva'] = $this->request->getData('tvacommande');
            $data['totalfodec'] = $this->request->getData('fod');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['escompte'] = $this->request->getData('escompte');
            $data['escompte'] = $this->request->getData('tpecommande');
            $data['escompte'] = $this->request->getData('escompte');



            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['poste'] = $this->request->getData('poste');




            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            if ($this->Bonlivraisons->save($bonlivraison)) {



                $this->misejour("Bonlivraisons", "edit", $id);

//debug($bonlivraison);die;

                if ($bonlivraison['typebl'] == 1) {
                    $commande = $this->fetchTable('Commandes')->get($bonlivraison->commande_id);
                }
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        // debug($l);


                        $tab['bonlivraison_id'] = $bonlivraison->id;
                        $tab['article_id'] = $l['article_id'];
                        $tab['qte'] = $l['qte'];
                        $tab['qtestock'] = $l['qteStock'];
                        $tab['punht'] = $l['prix'];
                        $tab['remise'] = $l['remiseligne'];
                        $tab['totaltva'] = $l['monatantlignetva'];


                        $tab['fodec'] = $l['fodeccommandeclient'];
                        $tab['tva'] = $l['tva'];
                        $tab['ttc'] = $l['ttc'];
                        $tab['quantiteliv'] = $l['quantiteliv'];

                        $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id'], [
                            'contain' => ['Articles']
                        ]);




                        $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);

                        $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                        //debug($lignebonlivraison);



                        if ($bonlivraison['typebl'] == 1) {

                            $lignecommandes = $this->fetchTable('Lignecommandes')->find('all', [])
                                    ->where(['commande_id=' . $commande->id]);
                            // debug($lignecommandes);
                            foreach ($lignecommandes as $lignecommande) {
                                if ($l['article_id'] == $lignecommande['article_id']) {
                                    $ligneupdate = $this->fetchTable('Lignecommandes')->get($lignecommande['id']);

                                    //  debug($qte);
                                    $ligneupdate->quantiteliv = $l['quantiteliv'];
                                    $this->fetchTable('Lignecommandes')->save($ligneupdate);
                                }
                            }
                        }
                        /*
                          // debug($lignebonchargement);
                          $donne = $l['quantiteliv'] + $lignecommande['quantiteliv'];
                          // debug($donne);
                          $lignecommande->quantiteliv = $donne;* */



                        //   $this->fetchTable('Lignecommandes')->save($lignecommande);
                    }
                }









                // $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));

                return $this->redirect(['action' => 'index/' . $bonlivraison['typebl']]);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $lignebonlivraisons = $this->Bonlivraisons->Lignebonlivraisons->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['bonlivraison_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */



//debug($bonlivraison);die;

        $client_id = $bonlivraison->client_id;

        $type = $bonlivraison->typebl;

        $this->loadModel('Clients');

//  $client = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
//            'contain' => ['Localites', 'Delegations']
//        ]);

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Bonlivraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonlivraisons->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);
        ;
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);

        $this->set(compact('type', 'client', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        $this->request->allowMethod(['post', 'delete']);
        $bonlivraison = $this->Bonlivraisons->get($id);


        /* $lignebonlivraisons = $this->Bonlivraisons->Lignebonlivraisons->find('all', [])
          ->where(['bonlivraison_id' => $id]); */

        $commande = $this->fetchTable('Commandes')->get($bonlivraison->commande_id);
        // debug($commande);
        //  $commande_id=$commande->id;
        //debug($commande->id);
        $idcom = $commande->id;
        //debug($id); //die;
        $idd = $id;
        //debug($idd);
        $lignelivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [])
                ->where(['Lignebonlivraisons.bonlivraison_id=' . $idd]);

        //    debug($lignelivraisons);
        //die;
        $lignecommandes = $this->fetchTable('Lignecommandes')->find('all', [])
                ->where(['commande_id=' . $idcom]);

        //  debug($lignecommandes);


        foreach ($lignelivraisons as $lignelivraison) {
            foreach ($lignecommandes as $lignecommande) {

                if ($lignelivraison['article_id'] == $lignecommande['article_id']) {

                    $ligneupdate = $this->fetchTable('Lignecommandes')->get($lignecommande['id']);
                    $qte = $lignecommande['quantiteliv'] - $lignelivraison['quantiteliv'];
                    //  debug($qte);
                    $ligneupdate->quantiteliv = $qte;
                    $this->fetchTable('Lignecommandes')->save($ligneupdate);
                }
            }
        }











        if ($this->Bonlivraisons->delete($bonlivraison)) {
            $this->misejour("Bonlivraisons", "delete", $id);
            foreach ($lignelivraisons as $l) {
                $this->Bonlivraisons->Lignebonlivraisons->delete($l);
            }
            // $this->Flash->success(__('The {0} has been deleted.', 'Bonlivraison'));
        } else {
            // $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Bonlivraison'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getadresselivraison($id = null) {
        $id = $this->request->getQuery('idfam');

        //  debug($id);
        // die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));



        $ligne = $this->fetchTable('Clients')->get($id, [
            'contain' => [],
        ]);

        $query = $this->fetchTable('Adresselivraisonclients')->find();
        $query->where(['client_id' => $id]);
        //debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Adresse livraison</label>
        <select name='adresse' id='adresselivraison-id' class='form-control select2'  onchange='getsousfamille2(this.value)'>
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q); 
            $select = $select . "	<option value ='" . $q['id'] . "'";
            $select = $select . " >" . $q['adresse'] . "</option>";
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

    // get prix article aprés la selectin 
    public function receive() {
        $id = $this->request->getQuery('idfam');

        //$id = $this->request->getData('idfam');
        // debug($id);

        $ligne = $this->fetchTable('Articles')->get($id);
        // $query = "call stockbassem(@art=1,@terikh=29/08/2022, @interv = 1,@depot = 1)";
        // debug($query);
        //  $a = $this->fetchTable('Inventaires')->query("exec stockbassem @art=1,@terikh=29/08/2022, @interv = 1,@depot = 1");
        // debug($a);
        //$result = $this->query($query);
        //  $st = ClassRegistry::init('Inventaire')->query("select stockbassem(" . $id . ",'" . $datef . "','0'," . $depotid . ") as v"); //debug($st[0][0]['v']);die;*/*/*/*/*/


        echo (json_encode($ligne));
        //debug($t);die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));
        //$this->set(compact('ligne'));
        //   $query = $this->fetchTable('Articles')->find();
        //  $query->where(['id_article' => $id]);
        //foreach ($query->all() as $row) {
        // debug($row->title);
        //  $prix_achat = ($row->prix_achat);
        //  $tva = $row->tva;
        // $this->set(compact('prix_achat'));
        // var_dump($row->prix_achat);
        // $prix_achat = ($row->prix_achat);
        // $ligne = $row;
        //  $this->set(compact('ligne'));
        // }
        // var_dump($query);
        die;
    }

    public function addbonlivraison($id = null) {






        $commande = $this->fetchTable('Commandes')->get($id, [
            'contain' => [
                'Lignecommandes', 'Clients'
            ]
        ]);
        $client = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);
        //debug($client);//die;
        $num = $this->Bonlivraisons->find()->select(["num" =>
                    'MAX(Bonlivraisons.numero)'])->first();
        // debug($num);

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

        $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {


            $num = $this->Bonlivraisons->find()->select(["num" =>
                        'MAX(Bonlivraisons.numero)'])->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);







            //  debug($this->request->getData());
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');

            $data['totalht'] = $this->request->getData('total');
            $data['totaltva'] = $this->request->getData('tvacommande');
            $data['totalfodec'] = $this->request->getData('fod');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['escompte'] = $this->request->getData('escompte');
            $data['tpe'] = $this->request->getData('tpecommande');




            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['poste'] = $this->request->getData('poste');
            $data['commande_id'] = $id;

            // debug($data);



            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            //debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {
                //  debug($bonlivraison);
                $this->misejour("Bonlivraisons", "addbonlivraison", $id);

                $bonlivraison_id = $bonlivraison->id;

                $commande->etatliv = '1';
                $this->fetchTable('Commandes')->save($commande);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($bonlivraison_id);die;
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        // debug($l);



                        $ligne = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                        // debug($lignebonlivraisonn);


                        $tab['bonlivraison_id'] = $bonlivraison_id;
                        $tab['article_id'] = $l['article_id'];
                        $tab['qte'] = $l['qte'];

                        $tab['qtestock'] = $l['qteStock'];
                        $tab['punht'] = $l['prix'];
                        $tab['remise'] = $l['remiseligne'];
                        $tab['totaltva'] = $l['monatantlignetva'];


                        $tab['fodec'] = $l['fodeccommandeclient'];
                        $tab['tva'] = $l['tva'];
                        $tab['ttc'] = $l['ttc'];
                        $tab['quantiteliv'] = $l['quantiteliv'];
                        $tab['montantht'] = $l['motanttotal'];
                        $tab['totalttc'] = $l['totalttc'];


                        $lignecommande = $this->fetchTable('Lignecommandes')->get($l['id'], [
                            'contain' => []
                        ]);
                        // debug($lignebonchargement);
                        $donne = $l['quantiteliv'] + $lignecommande['quantiteliv'];
                        // debug($donne);
                        $lignecommande->quantiteliv = $donne;



                        $this->fetchTable('Lignecommandes')->save($lignecommande);
                        //  debug($lignecommande);die;
                        //  debug($tab);
                        //$lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();


                        $ligne = $this->fetchTable('Lignebonlivraisons')->patchEntity($ligne, $tab);
                        // debug($ligne);
                        $this->fetchTable('Lignebonlivraisons')->save($ligne);
                    }
                }

                /*  foreach ($lignecommandes as $ligne) {
                  if ($ligne->qte == $ligne->quantiteliv)
                  $i++;

                  } */
                /* if($i == $number){
                  $commande->etatliv = '2';
                  $this->fetchTable('Commandes')->save($commande);

                  } */
                // debug($i);



                $lign = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                            'contain' => ['Articles']
                        ])
                        ->where(['commande_id' => $id]);
                //"debug($id);die;
                /* $a = $lignecommandes->count(); */
                //  debug($lignecommandes); die;
                $test = 0;
                foreach ($lign as $li) {
                    if ($li['qte'] != $li['quantiteliv'])
                        $test = 1;
                    //  debug($li);
                    //  die;
                }
                // debug($test);
                if ($test == 0) {
                    //debug("hh");
                    $commande->etatliv = '2';
                    $this->fetchTable('Commandes')->save($commande);
                }
                //   die;
                //$this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));

                return $this->redirect(['action' => 'index/1']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $this->loadModel('Personnels');




        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['commande_id' => $id]);
        // $a = $lignecommandes->count();
        //debug($a);


        /* $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('list')
          ->where(['commande_id' => $tab]);
          $data = $lignecommandes->toArray();


          debug(sizeof($data));
          die; */







        $client_id = $commande->client_id;
























        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->fetchTable('Commandes')->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Bonlivraisons->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Bonlivraisons->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        $factureclients = $this->Bonlivraisons->Factureclients->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);
        ;
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('client', 'commande', 'lignecommandes', 'commande', 'mm', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'factureclients', 'adresselivraisonclients'));
    }

    public function addpreparatif($tab = null) {
        $this->loadModel('Preparatifs');
        $lis = '0';
        $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());die;
            $p = $this->fetchTable('Preparatifs')->newEmptyEntity();

            $num = $this->Preparatifs->find()->select(["num" =>
                        'MAX(Preparatifs.numero)'])->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $mmm = str_pad("$in", 6, "0", STR_PAD_LEFT);

            $p['numero'] = $mmm;
            $p['date'] = date('Y-m-d H:i:s');

            $p['materieltransport_id'] = $this->request->getData('dat')['materieltransport_id'];
            $p['chauffeur_id'] = $this->request->getData('dat')['chauffeur_id'];
            $p['convoyeur_id'] = $this->request->getData('dat')['convoyeur_id'];


            $p['poidstotal'] = $this->request->getData('dat')['poids'];
            $p['nbcartons'] = $this->request->getData('dat')['nbcarton'];
            //    debug($p) ; die ; 
            ///
            $this->fetchTable('Preparatifs')->save($p);
            $preparatif_id = $p->id;
            $lis = $lis . ',' . $preparatif_id;
            // debug($this->request->getData()); 
            if (isset($this->request->getData('dat')['ligner']) && (!empty($this->request->getData('dat')['ligner']))) {

                foreach ($this->request->getData('dat')['ligner'] as $i => $com) {

                    $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
                    //

                    $num = $this->Bonlivraisons->find()->select(["num" =>
                                'MAX(Bonlivraisons.numero)'])->first();
                    // debug($num);

                    $n = $num->num;
                    // $int=intval($n);
                    $in = intval($n) + 1;
                    //debug($in);
                    $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

                    $d['numero'] = $mm; //preparatif_id
                    $d['date'] = date('Y-m-d H:i:s');
                    $d['preparatif_id'] = $preparatif_id;
                    $d['commande_id'] = $com['id'];
                    $d['materieltransport_id'] = $this->request->getData('dat')['materieltransport_id'];
                    $d['chauffeur_id'] = $this->request->getData('dat')['chauffeur_id'];
                    $d['convoyeur_id'] = $this->request->getData('dat')['convoyeur_id'];
                    $d['client_id'] = $com['client_id'];
                    $d['total'] = $com['total'];

                    $d['totalttc'] = $com['totalttc'];
                    $d['totalht'] = $com['totalht'];
                    $d['totalfodec'] = $com['totalfodec'];
                    $d['totalremise'] = $com['totalremise'];
                    $d['totaltva'] = $com['totaltva'];
                    $d['poidstotal'] = $com['poidstotal'];
                    $d['nbcartons'] = $com['nbcartons'];
                    //  debug($d);//die;
                    $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $d);

                    if ($this->Bonlivraisons->save($bonlivraison)) {

                        $bonlivraison_id = $bonlivraison->id;





                        if (isset($com['article']) && (!empty($com['article']))) {


                            foreach ($com['article'] as $j => $bl) {


                                $t = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();

                                $t['bonlivraison_id'] = $bonlivraison_id;
                                $t['quantiteliv'] = $bl['quantiteliv'];
                                $t['article_id'] = $bl['article_id'];
                                $t['remise'] = $bl['remise'];
                                $t['prix'] = $bl['prix'];
                                $t['tva'] = $bl['tva'];
                                $t['fodec'] = $bl['fodec'];
                                $t['totalttc'] = $bl['totalttc'];
                                $t['total'] = $bl['total'];
                                $t['montantht'] = $bl['montantht'];
                                $t['nombrepiece'] = $bl['nombrepiece'];
                                $t['TXTPE'] = $bl['TXTPE'];


                                $this->fetchTable('Lignebonlivraisons')->save($t);
                            } //die;
                        }
                    }
                }
                $lis = $lis;
                ?>

                                                                <!--<script language="javascript" >$(this).attr("href", "Bonlivraisons/imprimerprep/" + $lis)</script>-->
                <script>
                                    window.open("https://codifaerp.isofterp.com/demo/Bonlivraisons/imprimerprep/<?php echo $lis; ?>");</script>
                <?php
                //return $this->redirect(['action' => 'index']);
            }
        }
        ?>

        <?php
        $commande = $this->fetchTable('Commandes')->find('all', [
                    'contain' => ['Clients', 'Commercials']
                ])
                ->where(['Commandes.id   in (' . $tab . ')   ']);



        foreach ($commande as $i => $com) {
            $dat[$i]['id'] = $com['id'];
            $dat[$i]['date'] = $com['date'];
            $dat[$i]['numero'] = $com['numero'];
            $dat[$i]['client_id'] = $com['client_id'];
            $dat[$i]['materieltransport_id'] = $com['materieltransport_id'];
            $dat[$i]['Raison_Sociale'] = $com['client']['Raison_Sociale'];
            $dat[$i]['pointdevente_id	'] = $com['client']['pointdevente_id'];
            $dat[$i]['remise'] = $com['client']['remise'];
            $dat[$i]['name'] = $com['commercial']['name'];
            $dat[$i]['remise'] = $com['remise'];
            $dat[$i]['total'] = $com['total'];
            $dat[$i]['totalttc'] = $com['totalttc'];
            //debug($i) ; die ; 


            $lignecommandes = $this->fetchTable('Lignecommandes')->find('all', [
                        'contain' => ['Articles']
                    ])
                    ->where(['Lignecommandes.commande_id  =  (' . $com['id'] . ')       ']);


            //   echo(json_encode($lignecommandes)) ; die ; 
            foreach ($lignecommandes as $j => $ligne) {
                //  debug($ligne) ; die ;
                $lignebonneliv = $this->fetchTable('Lignebonlivraisons')->find(
                                'all',
                                [
                                    'contain' => ['Bonlivraisons']
                                ]
                        )
                        ->where(['Lignebonlivraisons.article_id  = (' . $ligne['article_id'] . ')  and Bonlivraisons.commande_id  = (' . $ligne['commande_id'] . ')    ']);
                //echo (json_encode($lignebonneliv));

                $ql = 0;

                foreach ($lignebonneliv as $l) {

                    $ql = $ql + $l['quantiteliv'];
                    //debug($ql) ; die ; 
                }



                $quantite = $ligne['qte'] - $ql;
                $quantiteliv = $ql;
                //debug($ql) ; die ; 
                if ($quantite != 0) {

                    $dat[$i]['Ligne'][$j]['qte'] = $ligne['qte'] - $ql;
                    $dat[$i]['Ligne'][$j]['quantiteliv'] = $ligne['quantiteliv'] + $quantiteliv;
                    $dat[$i]['Ligne'][$j]['commande_id'] = $ligne['commande_id'];
                    $dat[$i]['Ligne'][$j]['article_id'] = $ligne['article_id'];
                    $dat[$i]['Ligne'][$j]['nombrepiece'] = $ligne['article']['nombrepiece'];
                    $dat[$i]['Ligne'][$j]['Poids'] = $ligne['article']['Poids'];
                    $dat[$i]['Ligne'][$j]['Dsignation'] = $ligne['article']['Dsignation'];
                    $dat[$i]['Ligne'][$j]['Code'] = $ligne['article']['Code'];
                    $dat[$i]['Ligne'][$j]['remise'] = $ligne['article']['remise'];
                    $dat[$i]['Ligne'][$j]['fodec'] = $ligne['article']['fodec'];
                    $dat[$i]['Ligne'][$j]['TXTPE'] = $ligne['article']['TXTPE'];
                    $dat[$i]['Ligne'][$j]['prix'] = $ligne['prix'];
                    $dat[$i]['Ligne'][$j]['tva'] = $ligne['tva'];
                    $dat[$i]['Ligne'][$j]['total'] = $ligne['total'];
                    $dat[$i]['Ligne'][$j]['totalttc'] = $ligne['totalttc'];
                    $dat[$i]['Ligne'][$j]['qtestock'] = $ligne['qtestock'];
                    $dat[$i]['Ligne'][$j]['montantht'] = $ligne['montantht'];
                    $dat[$i]['Ligne'][$j]['remise'] = $ligne['remise'];
                }
            }
        }



        //debug($dat) ; die ; 


        $chauffeurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id  = 1  "]);
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id  = 5 "]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation  ']);
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $this->set(compact('conffaieurs', 'bonlivraison', 'dat', 'articles', 'materieltransports', 'commande', 'lignecommandes', 'lignebonneliv', 'chauffeurs'));
    }

    public function getpoidsmarticule() {
        $id = $this->request->getQuery('idMarticule');

        $materiel = $this->fetchTable('Materieltransports')->get($id);
        echo (json_encode($materiel));
        //debug($poidsmateriel) ; die() ; 

        die;
    }

}
