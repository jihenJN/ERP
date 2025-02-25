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

    public function imprimelistebl()
    {
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
        $article_id = $this->request->getQuery('article_id');
        $historiquede = $this->request->getQuery('historiquede');
        $article = $this->request->getQuery('article_id');
        $achat = $this->request->getQuery('achat');
        $service = $this->request->getQuery('service_id');
        $machine = $this->request->getQuery('machine_id');

        // debug($historiquede);   
        $au = $this->request->getQuery('au');
        // debug($au);
        $conditions = [];
        if ($historiquede) {
            $conditions[] = ["Livraisons.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Livraisons.date <='" . $au . " 23:59:59' "];
        }
        if ($fournisseur_id) {
            $conditions[] = ["Livraisons.fournisseur_id = '" . $fournisseur_id . "' "];
        }
        if ($achat) {
            $conditions[] = ["Livraisons.typelivraison = '" . $achat . "' "];
        }

        if ($service) {
            $conditions[] = ["Livraisons.service_id = '" . $service . "'"];
           // $conditions[] = ["Besionachats.service_id = '" . $service . "'"];
        }

        if ($machine) {
            $conditions[] = ["Livraisons.machine_id = '" . $machine . "'"];
        }

      

        if ($article) {
            $subquery = $this->fetchTable('Lignelivraisons')
                ->find('list', [
                    'keyField' => 'livraison_id',
                    'valueField' => 'livraison_id'
                ])
                ->where(['Lignelivraisons.article_id' => $article]);
            $conditions[] = ['Livraisons.id IN' => $subquery];
        }
       // $conditions[] = ["Livraisons.typebl" => 1];


        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();




        $bonlivraisons = $this->fetchTable('Livraisons')->find('all')->where([ $conditions])->contain(['Fournisseurs','Machines','Services'])->order(['Livraisons.id' => 'DESC'])->ToArray();
        // debug($bonlivraisons->ToArray());
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

              
                    return  $art->name;
                
            }
        ]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.famille_id = 2']);

        // $articles = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('article_id', 'fournisseurs', 'fournisseur_id','article_id', 'articles', 'bonlivraisons', 'historiquede', 'au'));
    }



    public function listebl()
    {
        $this->loadModel('Fournisseurs');
        $this->loadModel('Articles');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
        $article_id = $this->request->getQuery('article_id');
        $historiquede = $this->request->getQuery('historiquede');
        $article = $this->request->getQuery('article_id');
        $achat = $this->request->getQuery('achat');
        $service = $this->request->getQuery('service_id');
        $machine = $this->request->getQuery('machine_id');

        // debug($historiquede);   
        $au = $this->request->getQuery('au');
        // debug($au);
        $conditions = [];
        if ($historiquede) {
            $conditions[] = ["Livraisons.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Livraisons.date <='" . $au . " 23:59:59' "];
        }
        if ($fournisseur_id) {
            $conditions[] = ["Livraisons.fournisseur_id = '" . $fournisseur_id . "' "];
        }
        if ($achat) {
            $conditions[] = ["Livraisons.typelivraison = '" . $achat . "' "];
        }
      
        if ($service) {
            $conditions[] = ["Livraisons.service_id = '" . $service . "'"];
           // $conditions[] = ["Besionachats.service_id = '" . $service . "'"];
        }

        if ($machine) {
            $conditions[] = ["Livraisons.machine_id = '" . $machine . "'"];
        }

        if ($article) {
            $subquery = $this->fetchTable('Lignelivraisons')
                ->find('list', [
                    'keyField' => 'livraison_id',
                    'valueField' => 'livraison_id'
                ])
                ->where(['Lignelivraisons.article_id' => $article]);
            $conditions[] = ['Livraisons.id IN' => $subquery];
        }
       // $conditions[] = ["Livraisons.typebl" => 1];


        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();




        $bonlivraisons = $this->fetchTable('Livraisons')->find('all')->where([ $conditions])->contain(['Fournisseurs','Machines','Services'])->order(['Livraisons.id' => 'DESC'])->ToArray();
        // debug($bonlivraisons->ToArray());
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

              
                    return  $art->name;
                
            }
        ]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.famille_id = 2']);
        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $articles = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('machines','services','article_id', 'fournisseurs', 'fournisseur_id','article_id', 'articles', 'bonlivraisons', 'historiquede', 'au'));
    }









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
        $fournisseurs = $this->Livraisons->Fournisseurs->find('list');
      

        $this->loadModel('Lignelivraisons');
        $lignelivraisons = $this->Lignelivraisons->find('all')->contain(['Articles'])->where(["Lignelivraisons.livraison_id=" . $id . " "]);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $livraisons = $this->Livraisons->find('all')->contain(['Fournisseurs']);
        $this->set(compact('lignelivraisons', 'articles', 'livraison', 'fournisseurs'));
    }
    public function index($typebl = null)
    {

       // debug($type);

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $condtype = '';


        $this->loadModel('Personnels');


        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $numero = $this->request->getQuery('numero');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
       // $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $depot_id = $this->request->getQuery('depot_id');
        $blfournisseur = $this->request->getQuery('blfournisseur');

       // $typebl = $this->request->getQuery('typelivraison');


        if ($historiquede) {
            $cond2 = "Livraisons.date  >='" . $historiquede . "' ";
        }
        if ($au) {
            $cond6 = "Livraisons.date <='" . $au . "' ";
        }
        // if ($pointdevente_id) {
        //     $cond3 = "Livraisons.pointdevente_id = '" . $pointdevente_id . "' ";
        // }
        if ($fournisseur_id) {
            $cond4 = "Livraisons.fournisseur_id =  '" . $fournisseur_id . "' ";
        }
        if ($depot_id) {
            $cond5 = "Livraisons.depot_id =  '" . $depot_id . "' ";
        }
        if ($numero) {
            $cond1 = "Livraisons.numero like  '%" . $numero . "%' ";
        }
        if ($blfournisseur) {
            $cond7 = "Livraisons.blfournisseur like  '%" . $blfournisseur . "%' ";
        }

        $condtype = "Livraisons.typelivraison=" . $typebl;

        //debug($typebl);

       // debug($condtype);


        $query = $this->Livraisons->find('all')->where([$condtype, $cond1, $cond2, $cond3, $cond4, $cond5, $cond6,$cond7])
                  ->order(["Livraisons.id"=>'DESC']);
                ;

                //debug($query);
        
        $this->paginate = [
            'contain' => ['Fournisseurs', 'Adresselivraisonfournisseurs',  'Depots', 'Cartecarburants', 'Materieltransports'],
        ];
        $livraisons = $this->paginate($query);
        ///debug($livraisons);

        $fournisseurs = $this->Livraisons->Fournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
      //  $pointdeventes = $this->Livraisons->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depots = $this->Livraisons->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //$chauffeurs= $this->Commandes->Personnels->find('list',array('conditions'=>array('Personnels.fonction_id="1"'),'fields'=>array('Commandes->Personnels.code','Commandes->Personnels.nom','Commandes->Personnels.prenom')));
        $chauffeurs = $this->Livraisons->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="1"'), 'fields' => array('Personnels.code', 'Personnels.nom', 'Personnels.prenom')));
        $confaieurs = $this->Livraisons->Personnels->find('list', array('conditions' => array('Personnels.fonction_id="5"'), 'fields' => array('Personnels.code', 'Personnels.nom', 'Personnels.prenom')));
        //$chauffeurs=$this->Personnel->find('list',array('conditions'=>array('Personnel.fonction_id="1"')));
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);
       

        $this->set(compact('typebl','confaieurs', 'fournisseurs', 'livraisons', 'chauffeurs', 'materieltransports', 'pointdeventes', 'depots', 'cartecarburants'));
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

       $type=$livraison->typelivraison;
        $commandes = $this->Livraisons->Commandes->find('list');

        $fournisseurs = $this->Livraisons->Fournisseurs->find('list');
      ///  $pointdeventes = $this->Livraisons->Pointdeventes->find('list');
        $depots = $this->Livraisons->Depots->find('list');
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list');
        $materieltransports = $this->Livraisons->Materieltransports->find('list');
        $lignes = $this->Lignelivraisons->find()->where(["Livraison_id" => $id])->all();
        $count = $this->Lignelivraisons->find()->where(["Livraison_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('all');

        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('machines','services','type','livraison', 'lignes', 'count', 'articles', 'fournisseurs', 'commandes', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($typebl = null)
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
                                ///debug($livraison);
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

                                      ///  $this->Flash->success("lignelivraisons has been created successfully");
                                    } else {


                                      //  $this->Flash->error("Failed to create lignelivraisons");
                                    }
                                }
                                $this->set(compact("lignelivraisons"));
                            }
                        }
                 
                        }

                 //   $this->Flash->success(__('The {0} has been saved.', 'livraison'));

                    return $this->redirect(['action' => 'index/' . $typebl]);
                }
            }
            ///$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'livraison'));
        }
        $fournisseurs = $this->Livraisons->Fournisseurs->find('list');
       /// $pointdeventes = $this->Livraisons->Pointdeventes->find('list');
        $depots = $this->Livraisons->Depots->find('list');
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list');
        $materieltransports = $this->Livraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
       // $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);

        $this->loadModel('Articles');
        $cond = 'Articles.famille_id != 1 ';

        $articles = $this->Articles->find('all')
        ->where([$cond]) ; 
        //debug($articles);
        $chauffeurs = $this->Livraisons->Personnels->find('list')->where(['fonction_id' => 1]);
        $conffaieurs = $this->Livraisons->Personnels->find('list')->where(['fonction_id' => 5]);
        $this->set(compact('conffaieurs', 'chauffeurs', 'livraison', 'articles', 'numero', 'fournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports','typebl'));
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
       // debug($livraison->toArray());
        $type = $livraison->typelivraison;
        // debug($type);
        $this->loadModel('Lignelivraisons');

        if ($this->request->is(['patch', 'post', 'put'])) {
         //debug($this->request->getData());die;
            $livraison = $this->Livraisons->patchEntity($livraison, $this->request->getData());
            if ($this->Livraisons->save($livraison)) {
                $liv_id = ($this->Livraisons->save($livraison)->id);
                $this->misejour("Livraisons", "edit", $liv_id);
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

                return $this->redirect(['action' => 'index/' . $type]);
            }
           // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Livraison'));
        }
        $commandes = $this->Livraisons->Commandes->find('list');

        $fournisseurs = $this->Livraisons->Fournisseurs->find('list');
      ////  $pointdeventes = $this->Livraisons->Pointdeventes->find('list');
        $depots = $this->Livraisons->Depots->find('list');
        $cartecarburants = $this->Livraisons->Cartecarburants->find('list');
        $materieltransports = $this->Livraisons->Materieltransports->find('list');
        $lignes = $this->Lignelivraisons->find()->where(["Livraison_id" => $id])->all();
        $count = $this->Lignelivraisons->find()->where(["Livraison_id" => $id])->count();
        $adresselivraisonfournisseurs = $this->Livraisons->Adresselivraisonfournisseurs->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $this->loadModel('Articles');
         $this->loadModel('Personnels');
        $articles = $this->Articles->find('all');
//        $chauffeurs = $this->Livraisons->Personnels->find('list')->where(['fonction_id' => 1]);
//    
//        $conffaieurs = $this->Livraisons->Personnels->find('list')->where(['fonction_id' => 5]);
              $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id  ='" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id ='" . 1 . "%' "]);

        $services = $this->fetchTable('Services')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $machines = $this->fetchTable('Machines')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
       
        $this->set(compact('machines','services','conffaieurs','chauffeurs','livraison', 'lignes', 'count', 'articles', 'fournisseurs', 'commandes', 'adresselivraisonfournisseurs', 'pointdeventes', 'depots', 'cartecarburants', 'materieltransports','type'));
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
        $type=$livraison->typelivraison;
         $commande = $this->fetchTable('Commandefournisseurs')->get($livraison->commandefournisseur_id);
         $commande->valide =0;
         $this->fetchTable('Commandefournisseurs')->save($commande);
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
            $liv_id = ($this->Livraisons->save($livraison)->id);
            $this->misejour("Livraisons", "delete", $liv_id);
        } else {
        }

    
        
        
        
        
        
        return $this->redirect(['action' => 'index/'.$type]);
    }
    
    
    
    
}