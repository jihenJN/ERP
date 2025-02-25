<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Factures Controller
 *
 * @property \App\Model\Table\FacturesTable $Factures
 * @method \App\Model\Entity\Facture[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FacturesController extends AppController
{
    
    
     public function imprimeview($id = null)
    {
      
        $facture= $this->Factures->get($id, [
            'contain' => [ 'Fournisseurs']
        ]);
        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['limit' => 200]);
        // $this->set(compact('commande','commercials','clients'));
      

        $this->loadModel('Lignefactures');
        $lignefactures = $this->Lignefactures->find('all')->contain(['Articles'])->where(["Lignefactures.facture_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $factures = $this->Factures->find('all')->contain(['Fournisseurs']);
        $this->set(compact('lignefactures', 'articles', 'facture', 'fournisseurs'));
    }
//    function imprimeview($id = null)
//    {
//        $factureclient = $this->Factureclients->get($id, [
//            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Materieltransports', 'Cartecarburants', 'Adresselivraisonclients', 'Lignefactureclients'],
//        ]);
//
//        $lignefactureclients = $this->Factureclients->Lignefactureclients->find('all', [
//            'contain' => ['Articles']
//        ])
//            ->where(['factureclient_id' => $id]);
//
//
//
//
//
//
//        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
//        $chauffeurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
//        //debug($chauffeurs);
//        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
//
//        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
//        //debug($clients);
//        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
//        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
//        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
//        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
//        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
//        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
//        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['limit' => 200]);
//        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
//
//        $this->set(compact('lignefactureclients', 'articles', 'factureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs',  'adresselivraisonclients'));
//    }
 public function addindirect($tab = null)
    {
        $facture = $this->Factures->newEmptyEntity();
        $last = $this->Factures->find()->order(['id' => "desc"])->first();
        $numero = 1;
        if ($last != null) {
            preg_match_all('!\d+!', $last->numero, $numero);
            $numero = $numero[0][0];
        }
        $facture = $this->Factures->newEmptyEntity();
        
      if ($this->request->is('post')) {
            //debug($this->request->getData());
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonfournisseur_id'] = $this->request->getData('adresselivraisonfournisseur_id');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['kilometragedepart'] = $this->request->getData('kilm_depart');
            $data['kilometragearrive'] = $this->request->getData('kilm_arrive');
            $data['ht'] = $this->request->getData('ht');
            $data['tva'] = $this->request->getData('tva');
            $data['fodec'] = $this->request->getData('fodec');
            $data['remise'] = $this->request->getData('remise');
            $data['ttc'] = $this->request->getData('ttc');
            // debug($data);
            $facture = $this->Factures->patchEntity($facture, $data);
            //debug($facture);
            if ($this->Factures->save($facture)) {
                $facture_id = $facture->id;
                // debug($facture_id);
                $d = $this->fetchTable('Livraisons')->get($tab, [
                    'contain' => []
                ]);
                $d['facture_id'] = $facture_id;
                // debug($d);
                $this->fetchTable('Livraisons')->save($d);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // die;
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);
                        $tab = $this->fetchTable('Lignefactures')->newEmptyEntity();
                        $tab['facture_id'] = $facture_id;
                        $tab['article_id'] = $l['article_id'];
                        $tab['qte'] = $l['qte'];
                        $tab['ttc'] = $l['ttc'];
                        $tab['fodec'] = $l['fodec'];
                        $tab['tva'] = $l['tva'];
                        $tab['ht'] = $l['ht'];
                        $tab['remise'] = $l['remise'];
                        $tab['prix'] = $l['prix'];
                        //debug($tab);die;
                        //$lignefactures = $this->fetchTable('Lignefactures')->newEmptyEntity();
                        //$lignefactures = $this->Lignefactures->patchEntity($lignefactures, $tab);
                        $this->fetchTable('Lignefactures')->save($tab);
                    }
                }
                $this->Flash->success(__('The {0} has been saved.', 'factures'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Lignefactures'));
        }
        $this->loadModel('Personnels');
        $this->loadModel('Lignelivraisons');
        $lignelivraisons = $this->Lignelivraisons->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['livraison_id' => $tab]);
        $livraison = $this->fetchTable('Livraisons')->get($tab);
        $fournisseurs = $this->fetchTable('Livraisons')->Fournisseurs->find('list', ['keyfield' => 'id']);
        $this->loadModel('Pointdeventes');
        $pointdeventes = $this->Pointdeventes->find('list', ['limit' => 200]);
        $this->loadModel('Depots');
        $depots = $this->Depots->find('list', ['limit' => 200]);
        $this->loadModel('Materieltransports');
        $materieltransports = $this->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $this->loadModel('Cartecarburants');
        $cartecarburants = $this->Cartecarburants->find('list', ['limit' => 200]);
        $this->loadModel('Adresselivraisonfournisseurs');
        $adresselivraisonfournisseurs = $this->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $this->loadModel('Personnels');
   $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
       $timbre= $this->Timbres->find('list');
        $this->set(compact('lignelivraisons','timbre','livraison', 'numero', 'articles', 'facture', 'fournisseurs', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonfournisseurs'));
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


        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $numero = $this->request->getQuery('numero');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $depot_id = $this->request->getQuery('depot_id');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');


        if ($depot_id) {
            $cond1 = "Factures.depot_id =  '" . $depot_id . "'";
        }
        if ($numero) {
            $cond2 = "Factures.numero =  '" . $numero . "' ";
        }
        if ($historiquede) {
            $cond3 = "Factures.date >=  '%" . $historiquede . "%' ";
        }
        if ($au) {
            $cond4 = "Factures.date <=  '%" . $au . "%' ";
        }
        if ($fournisseur_id) {
            $cond5 = "Factures.fournisseur_id =  '" . $fournisseur_id . "' ";
        }
        if ($pointdevente_id) {
            $cond6 = "Factures.pointdevente_id =  '" . $pointdevente_id . "' ";
        }

        $this->paginate = [
            'contain' => ['Fournisseurs', 'Adresselivraisonfournisseurs', 'Pointdeventes', 'Depots', 'Cartecarburants', 'Materieltransports'],
        ];
        $query = $this->Factures->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6])
     ->order(["Factures.id"=>'DESC']);

                        
        $factures = $this->paginate($query);

        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $pointdeventes = $this->Factures->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Factures->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $confaieurs = $this->Factures->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="5"'), 'fields' => array('Personnels.code', 'Personnels.nom', 'Personnels.prenom')));
        $chauffeurs = $this->Factures->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="1"')));
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);


        $this->set(compact('confaieurs', 'factures', 'fournisseurs', 'chauffeurs', 'materieltransports', 'pointdeventes', 'depots', 'cartecarburants'));
    }

    /**
     * View method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $facture = $this->Factures->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Lignefactures');

        if ($this->request->is(['patch', 'post', 'put'])) {
            //    debug($this->request->getData());die;
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
                $this->loadModel('Lignefactures');
                $articles_ids = $this->request->getData('articles_ids');
                $codefs = $this->request->getData('codef');
                $qtes = $this->request->getData('qte');
                $prixhts = $this->request->getData('prixht');
                $remises = $this->request->getData('remise');
                $prixunhts = $this->request->getData('prixunht');
                $fodecs = $this->request->getData('fodec');
                $tvas = $this->request->getData('tva');
                $ttcs = $this->request->getData('ttc');
                $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
                foreach ($lignes as $item) {
                    $this->Lignefactures->delete($item);
                }
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    $this->loadModel('Lignefactures');

                    foreach ($this->request->getData('data')['tabligne3'] as $i => $liv) {
                        if ($liv['sup'] != 1) {

                            $data['article_id'] = $liv['article_id'];

                            $data['facture_id'] = $id;

                            $data['qteliv'] = $liv['qte'];
                            $data['prix'] = $liv['prix'];
                            $data['remise'] = $liv['remise'];
                            $data['ht'] = $liv['ht'];
                            $data['tva'] = $liv['tva'];
                            $data['fodec'] = $liv['fodec'];
                            $data['ttc'] = $liv['ttc'];  //   debug($data);die;


                            $lignefactures = $this->fetchTable('Lignefactures')->newEmptyEntity();
                            $Lignefactures = $this->Lignefactures->patchEntity($lignefactures, $data);


                            if ($this->Lignefactures->save($lignefactures)) {

                                $this->Flash->success("Lignefactures has been created successfully");
                            } else {


                                $this->Flash->error("Failed to create Lignefactures");
                            }
                        }
                        $this->set(compact("Lignefactures"));
                    }
                }
                $this->Flash->success(__('The {0} has been saved.', 'Facture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture'));
        }
        //$commandes = $this->Factures->Commandes->find('list', ['limit' => 200]);

        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Factures->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factures->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['limit' => 200]);
        $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
        $count = $this->Lignefactures->find()->where(["Facture_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $this->loadModel('Personnels');
        $articles = $this->Articles->find('all');

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
        $this->set(compact('conffaieurs', 'chauffeurs', 'facture', 'lignes', 'count', 'articles', 'fournisseurs', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $facture = $this->Factures->newEmptyEntity();
        $last = $this->Factures->find()->order(['id' => "desc"])->first();
        $numero = 1;
        if ($last != null) {
            preg_match_all('!\d+!', $last->numero, $numero);

            $numero = $numero[0][0];
        }

        if ($this->request->is('post')) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
            
                if ($this->request->is('post')) {

                    $facture = $this->Factures->patchEntity($facture, $this->request->getData());
                    if ($this->Factures->save($facture)) {
                        $this->loadModel('Livraisons');
                        $facture_id = $facture->id;
                        if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                            $this->loadModel('Lignefactures');
                            foreach ($this->request->getData('data')['tabligne3'] as $i => $facture) {
                                if ($facture['sup'] != 1) {

                                     //debug($facture_id);die;
                                     $data = $this->fetchTable('Lignefactures')->newEmptyEntity();
                                    $data['facture_id'] = $facture_id;
                                    $data['article_id'] = $facture['article_id'];
                                    $data['qte'] = $facture['qte'];
                                    $data['prix'] = $facture['prix'];
                                    $data['remise'] = $facture['remise'];
                                    $data['ht'] = $facture['ht'];
                                    $data['tva'] = $facture['tva'];
                                    $data['fodec'] = $facture['fodec'];
                                    $data['ttc'] = $facture['ttc'];

                                  //  $lignefactures = $this->fetchTable('Lignefactures')->newEmptyEntity();
                                  //  $lignefactures = $this->Lignefactures->patchEntity($lignefactures, $data);
//debug($data);die;

                                    if ($this->Lignefactures->save($data)) {

                                        $this->Flash->success("lignefactures has been created successfully");
                                    } else {
                                        $this->Flash->error("Failed to create lignefactures");
                                    }
                                }
                                
                            }
                        }
                    }
                    $this->Flash->success(__('The {0} has been saved.', 'Facture'));

                    return $this->redirect(['action' => 'index']);
                }
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture'));
        }
        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Factures->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factures->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['limit' => 200]);
        $livraisons = $this->Factures->Livraisons->find('list', ['limit' => 200]);
        //$adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        //$personnels = $this->Factures->Personnels->find('list', ['limit' => 200]);
        $chauffeurs = $this->Factures->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 1]);
        $conffaieurs = $this->Factures->Personnels->find('list', ['limit' => 200])->where(['fonction_id' => 5]);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        $this->set(compact('conffaieurs', 'chauffeurs', 'articles', 'facture', 'numero', 'livraisons', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }

    public function getadresselivraison($id = null)
    {
        $id = $this->request->getQuery('idfam');

        $ligne = $this->fetchTable('fournisseurs')->get($id, [
            'contain' => [],
        ]);
        $query = $this->fetchTable('adresselivraisonfournisseurs')->find();
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
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $facture = $this->Factures->get($id, [
            'contain' => []
        ]);
        $this->loadModel('Lignefactures');

        if ($this->request->is(['patch', 'post', 'put'])) {
            $facture = $this->Factures->patchEntity($facture, $this->request->getData());
            if ($this->Factures->save($facture)) {
                $this->loadModel('Lignefactures');
                $articles_ids = $this->request->getData('articles_ids');
                $codefs = $this->request->getData('codef');
                $qtes = $this->request->getData('qte');
                $prixhts = $this->request->getData('prixht');
                $remises = $this->request->getData('remise');
                $prixunhts = $this->request->getData('prixunht');
                $fodecs = $this->request->getData('fodec');
                $tvas = $this->request->getData('tva');
                $ttcs = $this->request->getData('ttc');
                $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
              
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    $this->loadModel('Lignefactures');

                    foreach ($this->request->getData('data')['tabligne3'] as $i => $liv) {
                        

                            $data['article_id'] = $liv['article_id'];
                            $data['facture_id'] = $id;
                            $data['qte'] = $liv['qte'];
                            $data['prix'] = $liv['prix'];
                            $data['remise'] = $liv['remise'];
                            $data['punht'] = $liv['ht'];
                            $data['tva'] = $liv['tva'];
                            $data['fodec'] = $liv['fodec'];
                            $data['ttc'] = $liv['ttc'];  //   debug($data);die;

                            
                             
                            $lignefactures = $this->fetchTable('Lignefactures')->get($liv['id']);
                            $Lignefactures = $this->Lignefactures->patchEntity($lignefactures, $data);
                                  $lignefacture = $this->fetchTable('Lignefactures')->patchEntity($lignefactureclient, $tab);
                                   $this->fetchTable('Lignefactures')->save($lignefacture);
                          
                        
                        $this->set(compact("Lignefactures"));
                    }
                }
                 $lignefacture = $this->Factures->Lignefactures->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['facture_id' => $id]);
                $this->Flash->success(__('The {0} has been saved.', 'Facture'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture'));
        }
        //$commandes = $this->Factures->Commandes->find('list', ['limit' => 200]);

        $fournisseurs = $this->Factures->Fournisseurs->find('list', ['limit' => 200]);
        $pointdeventes = $this->Factures->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factures->Depots->find('list', ['limit' => 200]);
        $cartecarburants = $this->Factures->Cartecarburants->find('list', ['limit' => 200]);
        $materieltransports = $this->Factures->Materieltransports->find('list', ['limit' => 200]);
        $lignes = $this->Lignefactures->find()->where(["Facture_id" => $id])->all();
        $count = $this->Lignefactures->find()->where(["Facture_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Factures->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $this->loadModel('Personnels');
        $articles = $this->Articles->find('all');

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);
        $this->set(compact('conffaieurs', 'chauffeurs', 'facture', 'lignes', 'count', 'articles', 'fournisseurs', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    
     public function editsalma($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Pointdeventes', 'Depots', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');



        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());
            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {



                $this->misejour("Factureclients", "edit", $id);


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









                // $this->Flash->success(__('The {0} has been saved.', 'facture'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);
    }

        /* foreach($lignebonlivraisons as $l){
            debug($l);}*/







    
    
    
    
    
    /**
     * Delete method
     *
     * @param string|null $id Facture id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->loadModel('Lignefactures');
        $this->request->allowMethod(['post', 'delete']);
        $facture = $this->Factures->get($id);
        $lignefactures = $this->Lignefactures->find('all', [])
            ->where(['facture_id' => $id]);
        foreach ($lignefactures as $c) {

            $this->Lignefactures->delete($c);
        }
        if ($this->Factures->delete($facture)) 
        {
            $livraison=$this->Livraisons->find('all', [])
            ->where(['facture_id' => $id]);
            $livraison->facture_id='';
            $this->fetchTable('Livraisons')->save($livraison);
            
        } else {
           // $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Facture'));
        }
         
        
        return $this->redirect(['action' => 'index']);
    }

    public function getLigneLivraisons()
    {
        $this->loadModel('Livraisons');
        $livraison = $this->Livraisons->get($_GET['livraison_id']);
        $this->loadModel('Lignelivraisons');
        $lignes = $this->Lignelivraisons->find()->where(["Livraison_id" => $_GET['livraison_id']])->all();
        $count = $this->Lignelivraisons->find()->where(["Livraison_id" => $_GET['livraison_id']])->count();
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');
        echo json_encode(array("lignes" => $lignes, 'count' => $count, 'articles' => $articles, 'livraison' => $livraison, "success" => true));
        exit;
    }
}
