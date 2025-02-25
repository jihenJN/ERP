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
class BonlivraisonsController extends AppController
{
     public function imprimeview($id = null)
    {
        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Adresselivraisonclients', 'Commandeclients', 'Lignebonlivraisons'],
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

        $this->set(compact('lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs',  'adresselivraisonclients'));
    }
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
        $query = $this->Bonlivraisons->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9]);

        $this->paginate = [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Adresselivraisonclients'],
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



      


        $this->set(compact(
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
    public function view($id = null)
    {
        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Adresselivraisonclients', 'Commandeclients', 'Lignebonlivraisons'],
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

        $this->set(compact('lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs',  'adresselivraisonclients'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {



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
            // debug($data);










            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            //debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {

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






















                $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
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
        $this->set(compact('mm', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'factureclients', 'adresselivraisonclients'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');


        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Adresselivraisonclients'],
        ]);
        // debug($bonlivraison);


        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());
            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $this->request->getData());
            if ($this->Bonlivraisons->save($bonlivraison)) {
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        // debug($l);

                        if ($l['supp'] != 1) {
                            $tab['bonlivraison_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['quantiteliv'] = $l['qteliv'];
                            $tab['prixht'] = $l['prixht'];
                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['punht'];
                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            };

                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);

                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id']);

                            $this->fetchTable('Lignebonlivraisons')->delete($lignebonlivraison);
                        }
                    }
                }









                $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $lignebonlivraisons = $this->Bonlivraisons->Lignebonlivraisons->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
            debug($l);}*/











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
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);

        $this->set(compact('lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs',  'adresselivraisonclients'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bonlivraison = $this->Bonlivraisons->get($id);


        $lignebonlivraisons = $this->Bonlivraisons->Lignebonlivraisons->find('all', [])
        ->where(['bonlivraison_id' => $id]);






      
        if ($this->Bonlivraisons->delete($bonlivraison)) {
            foreach ($lignebonlivraisons as $l) {
                $this->Bonlivraisons->Lignebonlivraisons->delete($l);
            }
            $this->Flash->success(__('The {0} has been deleted.', 'Bonlivraison'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Bonlivraison'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function getadresselivraison($id = null)
    {
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
        // debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Adresse livraison</label>
        <select name='adresse' id='adresselivraison-id' class='form-control select2'  onchange='getsousfamille2(this.value)'>
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q); 
            $select =  $select . "	<option value ='" . $q['id'] . "'";
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


    // get prix article aprés la selectin 
    public function receive()
    {
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



    public function addbonlivraison($tab = null)
    {

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
            $data['commande_id'] =$tab;

            // debug($data);



            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
         //   debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {

                $bonlivraison_id = $bonlivraison->id;
            
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($bonlivraison_id);die;
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);

                        $tab = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();


                        $tab['bonlivraison_id'] = $bonlivraison_id;


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
                        $this->fetchTable('Lignebonlivraisons')->save($tab);
                    }
                }

                $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $this->loadModel('Personnels');




        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $tab]);





        $commande = $this->fetchTable('Commandes')->get($tab, [
            'contain' => [
                'Lignecommandes'
            ]
        ]);
























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
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['limit' => 200]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('lignecommandes', 'commande', 'mm', 'articles', 'bonlivraison', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'factureclients', 'adresselivraisonclients'));
    }
}
