<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Factureclients Controller
 *
 * @property \App\Model\Table\FactureclientsTable $Factureclients
 * @method \App\Model\Entity\Factureclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FactureclientsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
      public function imprimeview($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Adresselivraisonclients'],
        ]);

        $lignefactureclients = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);






        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);

        $this->set(compact('lignefactureclients', 'articles', 'factureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs',  'adresselivraisonclients'));
    }
    public function addfacture($tab = null)
    {
        $num = $this->Factureclients->find()->select(["num" =>
        'MAX(Factureclients.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $factureclient = $this->Factureclients->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
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
            $data['payementcomptant'] = $this->request->getData('payementcomptant');
            $data['commande_id'] = $tab;
            // debug($data);
            $factureclient = $this->Factureclients->patchEntity($factureclient, $data);
            //   debug($bonlivraison);
            if ($this->Factureclients->save($factureclient)) {
                $factureclient_id = $factureclient->id;
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($bonlivraison_id);die;
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);
                        $tab = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                        $tab['factureclient_id'] = $factureclient_id;
                        $tab['qtestock'] = $l['qtestock'];
                        $tab['article_id'] = $l['article_id'];
                        $tab['qte'] = $l['qte'];
                        $tab['quantiteliv'] = $l['qte'];
                        $tab['ttc'] = $l['ttc'];
                        $tab['fodec'] = $l['fodec'];
                        $tab['tva'] = $l['tva'];
                        $tab['punht'] = $l['punht'];
                        $tab['remise'] = $l['remise'];
                        $tab['prixht'] = $l['ttc'];
                        //  debug($tab);die;
                        //$lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                        // $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);
                        //debug($lignebonlivraison);
                        $this->fetchTable('Factureclients')->save($tab);
                    }
                }
                $this->Flash->success(__('The {0} has been saved.', 'Facture clients'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture clients'));
        }
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');
        $lignebonlivraisons = $this->Lignebonlivraisons->find('all',['contain' => ['Articles']])
         ->where(["Lignebonlivraisons.bonlivraison_id  = '".$tab."'"]);
       
           
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->fetchTable('Commandes')->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
     //   $bonlivraison = $this->Factureclients->Bonlivraisons->find('first', ['limit' => 200]);
        $bonlivraison=$this->Factureclients->Bonlivraisons->find()
                       ->where(["Bonlivraisons.id ='" ."$tab"."'"])
                       ->first();
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('bonlivraison','lignebonlivraisons', 'mm', 'articles', 'factureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs',  'adresselivraisonclients'));
    }
    public function index()
    {

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
            $cond2 = "Bonlivraisons.date   <= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "Bonlivraisons.date  >= '" . $datefin . "' ";
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
        $query = $this->Factureclients->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9]);

        $this->paginate = [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants'],
        ];
        $factureclients = $this->paginate($query);
        // debug($factureclients);


        $this->loadModel('Personnels');


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($chauffeurs);

        $chauffeurs = $this->fetchTable('Personnels')->find('all')
            ->where(['fonction_id' => 1]);

        //  debug($chauffeurs);die;
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id = 5"]);


        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Factureclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);



        // debug($query);






        $this->set(compact(
            'chauffeurs',
            'conffaieurs',
            'depots',
            'factureclients',
            'clients',
            'pointdeventes',
            'depotsoptions',
            'materieltransports',
            'cartecarburants',


        ));
    }


    /**
     * View method
     *
     * @param string|null $id Factureclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Adresselivraisonclients','Lignefactureclients'],
        ]);

        $lignefactureclients = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);






        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);

        $this->set(compact('lignefactureclients', 'articles', 'factureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs',  'adresselivraisonclients'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $num = $this->Factureclients->find()->select(["num" =>
        'MAX(Factureclients.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $factureclient = $this->Factureclients->newEmptyEntity();

        if ($this->request->is('post')) {
          //  debug($this->request->getData());
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresselivraisonclient_id');
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
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            // $data['bonlivraison_id'] =$tab;
            //  debug($data);
            $factureclient = $this->Factureclients->patchEntity($factureclient, $data);
            //   debug($factureclient);
            if ($this->Factureclients->save($factureclient)) {
                $facture_id = $factureclient->id;

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($bonlivraison_id);die;
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {

                        //debug($l);
                        $tab = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                        $tab['factureclient_id'] = $facture_id;
                        $tab['qtestock'] = $l['qteStock'];
                        $tab['article_id'] = $l['article_id'];
                        $tab['qte'] = $l['qte'];
                        $tab['ttc'] = $l['ttc'];
                        $tab['fodec'] = $l['fodec'];
                        $tab['tva'] = $l['tva'];
                        $tab['punht'] = $l['punht'];
                        $tab['remise'] = $l['remise'];
                        $tab['prixht'] = $l['ttc'];
                        // debug($tab);

                        $this->fetchTable('Lignefactureclients')->save($tab);
                    }
                }
                $this->Flash->success(__('The {0} has been saved.', 'facture'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $this->loadModel('Personnels');

        $chauffeurs = $this->fetchTable('Personnels')->find(
            'all',
        )->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->fetchTable('Factureclients')->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        // $factureclients = $this->Bonlivraisons->Factureclients->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('factureclient', 'mm', 'articles', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Factureclient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');



        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());
            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                      //  debug($l);

                        if ($l['supp'] != 1) {
                            $tab['bonlivraison_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['prixht'] = $l['prixht'];
                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['punht'];
                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };

                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                          //  debug($lignefactureclient);

                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);

                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }









                $this->Flash->success(__('The {0} has been saved.', 'facture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
            debug($l);}*/











        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);

        $this->set(compact('factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs',  'adresselivraisonclients'));
    }
}
