<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

use Cake\Datasource\ConnectionManager;

/**
 * Comptes Controller
 *
 * @property \App\Model\Table\ComptesTable $Comptes
 * @method \App\Model\Entity\Compte[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComptesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function recap_scomptetraitecof($id = null)
    {
        $this->layout = 'defaulltop2';
        $this->loadModel("Piecereglementclient");
        $this->loadModel("Etat");
        $this->loadModel("Compte");
        $this->loadModel("Lignebordereauescompte");
        $this->loadModel("Lignebordereauversementtraite");
        $this->loadModel("Coffre");


        $piecereglementcheques = $this->Coffre->find('first', array('conditions' => array('Coffre.id' => $id)));
        $comptes = $this->Compte->find('list');
        //$piecereglementcheques = $this->Piecereglementclient->find('first',array('conditions'=>array('Piecereglementclient.id'=>$id)));

        $lignebordereauescomptes = $this->Lignebordereauescompte->find('first', array('conditions' => array('Lignebordereauescompte.coffre_id' => $id)));
        // debug($lignebordereaucessioncreances);   
        $lignebordereauversementtraites = $this->Lignebordereauversementtraite->find('first', array('conditions' => array('Lignebordereauversementtraite.coffre_id' => $id)));
        //debug($lignebordereauversementcheques);        die();
        if ($lignebordereauescomptes || $lignebordereauversementtraites) {
            $etatsf = $this->Etat->find('all', array('conditions' => array('Etat.type' => 1)));
            $test = 1;
        } else {
            $etatsf = $this->Etat->find('all', array('conditions' => array('Etat.type' => 1)));
            $test = 0;
        }
        $test = 0;
        $comptes = $this->Compte->find('list');

        $etats['En attente'] = 'En attente';
        foreach ($etatsf as $e) {
            $etats[$e['Etat']['id']] = $e['Etat']['name'];
        }
        //debug($piecereglementcheques);die;
        $this->set(compact('piecereglementcheques', 'etats', 'comptes', 'test'));
    }
    public function recapscomptetraite()
    {
        //$this->layout = 'defaultpop'; 
        //$this->layout = 'defaulltop2'; 
        $this->loadModel("Piecereglementclients");
        $this->loadModel("Etats");
        $this->loadModel("Comptes");
        $this->loadModel("Lignebordereauescomptes");
        $this->loadModel("Lignebordereauversementtraites");

        $id = $this->request->getQuery('id');

        $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $id)))->first();
        // $etats=$this->Etat->find('list',array('conditions'=>array('Etat.type'=>1)));
        $comptes = $this->Comptes->find('list');
        //$piecereglementcheques = $this->Piecereglementclients->find('first',array('conditions'=>array('Piecereglementclient.id'=>$id)));

        $lignebordereauescomptes = $this->Lignebordereauescomptes->find('all', array('conditions' => array('Lignebordereauescomptes.piecereglementclient_id' => $id)))->first();
        // debug($lignebordereaucessioncreances);   
        $lignebordereauversementtraites = $this->Lignebordereauversementtraites->find('all', array('conditions' => array('Lignebordereauversementtraites.piecereglementclient_id' => $id)))->first();
        //debug($lignebordereauversementcheques);        die();
        if ($lignebordereauescomptes || $lignebordereauversementtraites) {
            $etatsf = $this->Etats->find('all', array('conditions' => array('Etats.type' => 1, 'Etats.id !=1', 'Etats.id !=10')));
            $test = 1;
        } else {
            $etatsf = $this->Etats->find('all', array('conditions' => array('Etats.type' => 1, 'Etats.id' => 1)));
            $test = 0;
        }
        $etats['En attente'] = 'En attente';
        foreach ($etatsf as $e) {
            $etats[$e['id']] = $e['name'];
        }
        //debug($piecereglementcheques);die;
        $this->set(compact('piecereglementcheques', 'etats', 'comptes', 'test'));
    }
    public function ajoutvaleur()
    {           //$this->layout = null;  
        //debug($etat);die;
        $this->loadModel("Etats");
        $this->loadModel("Piecereglementclients");
        $this->loadModel("Comptes");
        $this->loadModel("Etatcheques");
        $this->loadModel("Etattraites");
        //  $data = $this->request->data; //debug($data);
        //  $json = null;
        //  $id = $data['id'];
        //  $val = $data['val'];
        //  $etat = $data['etat'];
        //  $compte = $data['compte'];
        //  $j = $data['j'];
        //  $m = $data['m'];
        //  $a = $data['a'];
        $id = $this->request->getQuery('id');
        $val = $this->request->getQuery('val');
        $etat = $this->request->getQuery('etat');
        $idcompte = $this->request->getQuery('compte');
        $j = $this->request->getQuery('j');
        $m = $this->request->getQuery('m');
        $a = $this->request->getQuery('a');
        $date = $a . '-' . $m . '-' . $j;


        $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $id)))->first();
        //debug($id);
        //debug($val);
        //debug($etat);debug($date);
        //
        //debug($piecereglementcheques);
        if (!$val) {
            $val = 0;
        } else
            $val = $val;
        $ligne['compte_id'] = @$idcompte;
        $ligne['etat_id'] = @$etat;
        $ligne['piecereglementclient_id'] = @$id;
        $ligne['date'] = date("Y-m-d", strtotime(str_replace('/', '-', @$date)));
        if ($etat == 'En attente') {
            @$val = 0;
        }
        $ligne['valeur'] = @$val;
        if ($piecereglementcheques['paiement_id'] == 2) {

            $compte = $this->Etatcheques->newEmptyEntity();

            $compte = $this->Etatcheques->patchEntity($compte, $ligne);

            $this->Etatcheques->save($compte);

            //  $this->Etatcheques->create();
            //  $this->Etatcheques->save($ligne);
        } else
            if ($piecereglementcheques['paiement_id'] == 3) {
            $comptee = $this->Etattraites->newEmptyEntity();
            $comptee = $this->Etattraites->patchEntity($comptee, $ligne);
            $this->Etattraites->save($comptee);
            // $this->Etattraites->create();
            // $this->Etattraites->save($ligne);
        }

        if ($etat == 'En attente') {
            @$val = null;
            $compte = null;
            $etatn = 'En attente';
            $etat = null;

            //$this->Piecereglementclients->query("update piecereglementclients set etat_id=7,compte_id=NULL,datesituation='$date',situation='$etatn' where id=".$id);
            $piecereglementcheques->etat_id = Null;
            $piecereglementcheques->compte_id = Null;
            $piecereglementcheques->datesituation = $date;
            $piecereglementcheques->situation = $etatn;
            $this->Piecereglementclients->save($piecereglementcheques);
        } else {
            $etatp = $this->Etats->find('all', array('conditions' => array('Etats.id' => @$etat)))->first();
            $etatn = $etatp['name'];
            //$this->Piecereglementclients->query("update piecereglementclients set valeur=$val ,etat_id=$etat,compte_id=$compte,datesituation='$date',situation='$etatn' where id=".$id);
            $piecereglementcheques->etat_id = $etat;
            $piecereglementcheques->valeur = $val;
            $piecereglementcheques->compte_id = (int)$idcompte;
            $piecereglementcheques->datesituation = $date;
            $piecereglementcheques->situation = $etatn;

            $this->Piecereglementclients->save($piecereglementcheques);
        } // $this->Piecereglementclient->updateAll(array('Piecereglementclient.valeur' => $val,'Piecereglementclient.etat_id' => @$etat,'Piecereglementclient.compte_id' => @$compte,"Piecereglementclient.datesituation="."'".$ligne['date']."'",'Piecereglementclient.situation'=>"'".$etatp['Etat']['name']."'"), array('Piecereglementclient.id' =>$id));  
        //debug($piecereglementcheques);

        $test = 1;
        //  debug($test);die;
        // $this->set(compact('test'));
        echo json_encode(array('success' => true, 'test' => $test));
        die;
    }

    public function recapscomptecheque()
    {
        //$this->layout = 'defaulltop2';       
        $this->loadModel("Piecereglementclients");
        $this->loadModel("Etats");
        $this->loadModel("Comptes");
        $this->loadModel("Lignebordereaucessioncreances");
        $this->loadModel("Lignebordereauversementcheques");

        $id = $this->request->getQuery('id');
        $type = $this->request->getQuery('type');
        $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $id)))->first();

        $lignebordereaucessioncreances = $this->Lignebordereaucessioncreances->find('all', array('conditions' => array('Lignebordereaucessioncreances.piecereglementclient_id' => $id)))->first();
        // debug($lignebordereaucessioncreances);   
        $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.piecereglementclient_id' => $id)))->first();
        //debug($lignebordereauversementcheques);        die();
        if ($lignebordereaucessioncreances || $lignebordereauversementcheques) {
            $etatsf = $this->Etats->find('all', array('conditions' => array('Etats.type' => 0, 'Etats.id !=4', 'Etats.id !=9')));
            $test = 1;
        } else {
            $etatsf = $this->Etats->find('all', array('conditions' => array('Etats.type' => 0, 'Etats.id' => 4)));
            $test = 0;
        }
        $test = 0;
        $etats['En attente'] = 'En attente';
        foreach ($etatsf as $e) {
            $etats[$e['id']] = $e['name'];
        }
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);


        $this->set(compact('piecereglementcheques', 'etats', 'comptes', 'test'));
    }
    public function recapscomptechequecof($id = null)
    {
        //        debug($id);die;
        $this->layout = 'defaulltop2';
        $this->loadModel("Coffre");
        $this->loadModel("Etat");
        $this->loadModel("Compte");
        $this->loadModel("Lignebordereaucessioncreance");
        $this->loadModel("Lignebordereauversementcheque");



        $piecereglementcheques = $this->Coffre->find('first', array('conditions' => array('Coffre.id' => $id)));
        $lignebordereaucessioncreances = $this->Lignebordereaucessioncreance->find('first', array('conditions' => array('Lignebordereaucessioncreance.coffre_id' => $id)));
        // debug($lignebordereaucessioncreances);   
        $lignebordereauversementcheques = $this->Lignebordereauversementcheque->find('first', array('conditions' => array('Lignebordereauversementcheque.coffre_id' => $id)));
        //debug($piecereglementcheques);die;    
        if ($lignebordereaucessioncreances || $lignebordereauversementcheques) {
            $etatsf = $this->Etat->find('all', array('conditions' => array('Etat.type' => 0)));
            $test = 1;
        } else {
            $etatsf = $this->Etat->find('all', array('conditions' => array('Etat.type' => 0)));
            $test = 0;
        }
        $comptes = $this->Compte->find('list');
        $etats['En attente'] = 'En attente';
        foreach ($etatsf as $e) {
            $etats[$e['Etat']['id']] = $e['Etat']['name'];
        }
        //    debug($piecereglementcheques);die;
        $this->set(compact('piecereglementcheques', 'etats', 'comptes', 'test'));
    }

    public function listecheque()
    {
        $vente = "";
        if (!empty($lien)) {
            foreach ($lien as $k => $liens) {
                if (@$liens['lien'] == 'engagementcomptes') {
                    $vente = 1;
                }
            }
        }
        //    if (( $vente <> 1)||(empty($lien))){
        //    $this->redirect(array('controller' => 'utilisateurs','action' => 'login'));
        //         }      
        $this->loadModel('Fournisseurs');
        // $this->loadModel('Etatpiecereglements');  
        $this->loadModel('Exercices');
        $this->loadModel('Piecereglements');
        $this->loadModel('Comptes');
        $this->loadModel('Piecereglementclients');
        // $this->loadModel('Bordereaus');
        // $this->loadModel('Versements');
        // $this->loadModel('Situationpiecereglement');
        // $this->loadModel('Situationpiecereglementclient');
        // $this->loadModel('Traitecredit');
        // $this->loadModel('Paiement');
        // $this->loadModel('Reglement');
        // $this->loadModel('Cheque');       
        // $this->loadModel('Client');  
        // $this->loadModel('Etat');       
        // $this->loadModel('Traitecredit');       
        // $this->loadModel('Piecereglementclient');
        // $this->loadModel('Coffre');
        $date1 = $this->request->getQuery('date1');
        $date2 = $this->request->getQuery('date2');
        $client_id = $this->request->getQuery('client_id');
        $etat_id = $this->request->getQuery('etat_id');


        if ($date1) {
            $cond1 = "Piecereglementclients.echance >='" . $date1 . "'";
            $cond11 = 'Coffre.Echance >=' . "'" . $date1 . "'";
        }
        if ($date2) {
            $cond2 = "Piecereglementclients.echance <=  '" . $date2 . "' ";
            $cond22 = 'Coffre.Echance <=' . "'" . $date2 . "'";
        }
        if ($client_id) {
            $cond3 = "Reglementclients.client_id =  '" . $client_id . "' ";
            $cond33 = "Coffre.client_id='" . $client_id . "'";
        }
        if ($etat_id) {
            $cond44 = "Coffre.etat_id='" . $etat_id . "'";
            if ($etat_id == 10) {
                $cond4 = "Piecereglementclients.etat_id is null";

                $cond5 = "Piecereglementclients.reglement =0";
            } else {
                if ($etat_id == 11) {
                    $cond5 = "Piecereglementclients.reglement!=0";
                    //$cond4="Piecereglementclient.etat_id=6";  
                } else {
                    $cond4 = "Piecereglementclients.etat_id='" . $etat_id . "'";
                    $cond5 = "Piecereglementclients.reglement =0";
                }
            }
        }


        $piecereglementcheques = array();
        $reglementclients = $this->fetchTable('Reglementclients')->find('all', array('conditions' => array($cond3)));
        $idreg = "";
        foreach ($reglementclients as $key => $value) {
            $idreg = $idreg . ',' . $value['id'];
        }
        $condd = "";
        if ($idreg != "") {
            $condd = "Piecereglementclients.reglementclient_id in (" . $idreg . ")";
        }
        $piecereglementcheques = $this->fetchTable('Piecereglementclients')->find('all', ['contain' => ['Banques', 'Reglementclients' => ['Clients']]])->where(['Piecereglementclients.paiement_id' => 2, $cond3, @$cond1, @$cond2, @$cond4, @$cond5])->order(['Piecereglementclients.echance' => 'ASC']);
        //array('conditions'=>array('Piecereglementclients.paiement_id'=>2,@$cond1,@$cond2,@$cond4,@$cond5,$condd),'order'=>array('Piecereglementclients.echance ASC')));
        //   $coffres = $this->fetchTable('Coffres')->find('all',array('conditions'=>array('Coffre.paiement_id'=>2,@$cond11,@$cond22,@$cond33,@$cond44),'order'=>array('Coffre.Echance ASC')));

        $comptes = $this->fetchTable('Comptes')->find('all');
        $etats = $this->fetchTable('Etats')->find('all', array('conditions' => array('Etats.type' => 0)));

        // array_push($etats, "En attente");
        //  array_push($etats, "Remplacer");
        //  

        // $cheques = $this->fetchTable('Cheque')->find('all');
        // $traitecredits = $this->fetchTable('Traitecredit')->find('all');
        // debug($piecereglementcheques);           die();
        $clients = $this->fetchTable('Clients')->find('all');

        //debug($piecereglementcheques->toArray());die;
        $this->set(compact('date1', 'date2', 'etat_id', 'client_id', 'coffres', 'clients', 'comptes', 'cheques', 'traitecredits', 'piecereglementcheques', 'piecereglementtraites', 'etats'));
    }
    public function listetraite()
    {
        $vente = "";
        if (!empty($lien)) {
            foreach ($lien as $k => $liens) {
                if (@$liens['lien'] == 'engagementcomptes') {
                    $vente = 1;
                }
            }
        }
        //    if (( $vente <> 1)||(empty($lien))){
        //    $this->redirect(array('controller' => 'utilisateurs','action' => 'login'));
        //         }      
        $this->loadModel('Fournisseurs');
        // $this->loadModel('Etatpiecereglements');  
        $this->loadModel('Exercices');
        $this->loadModel('Piecereglements');
        $this->loadModel('Comptes');
        $this->loadModel('Piecereglementclients');
        // $this->loadModel('Bordereaus');
        // $this->loadModel('Versements');
        // $this->loadModel('Situationpiecereglement');
        // $this->loadModel('Situationpiecereglementclient');
        // $this->loadModel('Traitecredit');
        // $this->loadModel('Paiement');
        // $this->loadModel('Reglement');
        // $this->loadModel('Cheque');       
        // $this->loadModel('Client');  
        // $this->loadModel('Etat');       
        // $this->loadModel('Traitecredit');       
        // $this->loadModel('Piecereglementclient');
        // $this->loadModel('Coffre');
        $date1 = $this->request->getQuery('date1');
        $date2 = $this->request->getQuery('date2');
        $client_id = $this->request->getQuery('client_id');
        $etat_id = $this->request->getQuery('etat_id');


        if ($date1) {
            $cond1 = "Piecereglementclients.echance >='" . $date1 . "'";
            $cond11 = 'Coffre.Echance >=' . "'" . $date1 . "'";
        }
        if ($date2) {
            $cond2 = "Piecereglementclients.echance <=  '" . $date2 . "' ";
            $cond22 = 'Coffre.Echance <=' . "'" . $date2 . "'";
        }
        if ($client_id) {
            $cond3 = "Reglementclients.client_id =  '" . $client_id . "' ";
            $cond33 = "Coffre.client_id='" . $client_id . "'";
        }
        if ($etat_id) {
            $cond44 = "Coffre.etat_id='" . $etat_id . "'";
            if ($etat_id == 10) {
                $cond4 = "Piecereglementclients.etat_id is null";

                $cond5 = "Piecereglementclients.reglement =0";
            } else {
                if ($etat_id == 11) {
                    $cond5 = "Piecereglementclients.reglement!=0";
                    //$cond4="Piecereglementclient.etat_id=6";  
                } else {
                    $cond4 = "Piecereglementclients.etat_id='" . $etat_id . "'";
                    $cond5 = "Piecereglementclients.reglement =0";
                }
            }
        }


        $piecereglementcheques = array();
        $reglementclients = $this->fetchTable('Reglementclients')->find('all', array('conditions' => array($cond3)));
        $idreg = "";
        foreach ($reglementclients as $key => $value) {
            $idreg = $idreg . ',' . $value['id'];
        }
        $condd = "";
        if ($idreg != "") {
            $condd = "Piecereglementclients.reglementclient_id in (" . $idreg . ")";
        }
        $piecereglementcheques = $this->fetchTable('Piecereglementclients')->find('all', ['contain' => ['Banques', 'Reglementclients' => ['Clients']]])->where(['Piecereglementclients.paiement_id' => 3, $cond3, @$cond1, @$cond2, @$cond4, @$cond5])->order(['Piecereglementclients.echance' => 'ASC']);
        //array('conditions'=>array('Piecereglementclients.paiement_id'=>2,@$cond1,@$cond2,@$cond4,@$cond5,$condd),'order'=>array('Piecereglementclients.echance ASC')));
        //   $coffres = $this->fetchTable('Coffres')->find('all',array('conditions'=>array('Coffre.paiement_id'=>2,@$cond11,@$cond22,@$cond33,@$cond44),'order'=>array('Coffre.Echance ASC')));

        $comptes = $this->fetchTable('Comptes')->find('all');
        $etats = $this->fetchTable('Etats')->find('all', array('conditions' => array('Etats.type' => 0)));

        // array_push($etats, "En attente");
        //  array_push($etats, "Remplacer");
        //  

        // $cheques = $this->fetchTable('Cheque')->find('all');
        // $traitecredits = $this->fetchTable('Traitecredit')->find('all');
        // debug($piecereglementcheques);           die();
        $clients = $this->fetchTable('Clients')->find('all');

        //debug($piecereglementcheques->toArray());die;
        $this->set(compact('date1', 'date2', 'etat_id', 'client_id', 'coffres', 'clients', 'comptes', 'cheques', 'traitecredits', 'piecereglementcheques', 'piecereglementtraites', 'etats'));
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Banques', 'Agences'],
            'order' => ['Comptes.id' => 'DESC'],
        ];
        $comptes = $this->paginate($this->Comptes);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('comptes', 'banques'));
    }

    /**
     * View method
     *
     * @param string|null $id Compte id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $compte = $this->Comptes->get($id, [
            'contain' => ['Agences', 'Banques'],
        ]);
        // $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $lignecompte = $this->fetchTable('Lignecomptes')->find('all')->where(["Lignecomptes.compte_id =" . $id]);
        $typecredits = $this->fetchTable('Typecredits')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $agences = $this->Comptes->Agences->find('list', ['limit' => 200])->all();
        $agences = $this->fetchTable('Agences')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('compte','agences', 'banques','typecredits', 'lignecompte'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */

    public function addcompte($index = null)
    {
        //  $session = $this->request->getSession();
        //  $abrv = $session->read('abrvv');
        //  $liendd = $session->read('lien_articles' . $abrv);
        //  $article = 0;
        //  foreach ($liendd as $k => $liens) {
        //      if (@$liens['lien'] == 'article') {
        //          $article = $liens['ajout'];
        //      }
        //  }
        //  if (($article <> 1)) {
        //      $this->redirect(array('controller' => 'users', 'action' => 'login'));
        //  }
        $this->loadModel('Comptes');
        $compte = $this->Comptes->newEmptyEntity();
        if ($this->request->is('post')) {
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData());
            if ($this->Comptes->save($compte)) {
                $id = $compte->id;



                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {

                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {

                        if ($l['sup'] == '') {

                            $tab = $this->fetchTable('Lignecomptes')->newEmptyEntity();
                            //debug($l);die;
                            $tab['compte_id'] = $compte->id;

                            $tab['typecredit_id'] = $l['typecredit_id'];

                            $this->fetchTable('Lignecomptes')->save($tab);
                            //debug($tab);
                        }
                    }
                }



                $comptesQuery = $this->Comptes->find()->select(['id', 'numero', 'agence_id']);
                $comptes = $comptesQuery->toArray();

                $agencesQuery = $this->Comptes->Agences->find()->select(['id', 'name']);
                $agences = $agencesQuery->toArray();

                $select = "<select name='data[ligner][" . $index . "][compte_id]' class='form-control' champ='compte_id' id='compte_id" . $index . "' style='text-align:right'>";
                $select .= "<option value=''></option>";

                foreach ($comptes as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }

                    // Find the agence name associated with this compte
                    $agenceName = "";
                    foreach ($agences as $agence) {
                        if ($agence['id'] == $f['agence_id']) {
                            $agenceName = $agence['name'];
                            break;
                        }
                    }

                    // Add an option with both numero and agence name
                    $select .= "<option value=" . $f['id'] . " " . $selected . " >" . $f['numero'] . " - " . $agenceName . "</option>";
                }

                $select .= '</select>';


?>
                <script>
                    var select = `<?php echo $select; ?>`;
                    window.opener.document.getElementById('compte_id<?php echo $index; ?>').innerHTML = select;
                    window.close();
                </script>
            <?php




                // return $this->redirect(['action' => 'index']);
            }
        }
        $agences = $this->fetchTable('Agences')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('compte', 'agences'));
    }
    public function addcompte11()
    {
        //  $session = $this->request->getSession();
        //  $abrv = $session->read('abrvv');
        //  $liendd = $session->read('lien_finance' . $abrv);
        //  $societe = 0;
        //  foreach ($liendd as $k => $liens) {
        //      if (@$liens['lien'] == 'comptes') {
        //          $societe = $liens['ajout'];
        //      }
        //  }
        //  if (($societe <> 1)) {
        //      $this->redirect(array('controller' => 'users', 'action' => 'login'));
        //  }
        $this->loadModel('Comptes');
        $compte = $this->Comptes->newEmptyEntity();
        if ($this->request->is('post')) {
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData());

            if ($this->Comptes->save($compte)) {

                $id = $compte->id;
                // debug($id);
                $Compte = $this->Comptes->query('SELECT comptes.id id, comptes.numero from comptes');

                // debug($Compte->toArray()); 
                $select = "<select   name='data[Comptes][compte_id]' class='form-control'  champ='compteid' id='compte_id' style = 'text-align:right'>";
                $select = $select . "<option value=''></option>";
                foreach ($compte as $f) {
                    if ($f['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $f['id'] . " " . $selected . " >" . $f['numero'] . " </option>";
                }
                $select = $select . '</select>';
                // debug($select);
            ?>
                <script language="javascript">
                    window.opener.document.getElementById('compte_id').innerHTML = "<?php echo $select; ?>";
                </script>
                <script language="javascript">
                    window.close();
                </script>
<?php
            }
        }


        $agences = $this->Comptes->Agences->find('list', ['limit' => 200])->all();
        $agences = $this->fetchTable('Agences')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('compte', 'agences'));

        // $this->set(compact('pays', 'compte', 'cli', 'ar', 'articles', 'type', 'delegations', 'localites', 'commercials', 'gouvernorats', 'typeexonerations', 'banques', 'paiements', 'typeclients', 'pointdeventes', 'bureaupostes'));
        // $this->set(compact('client','mm'));
    }
    public function edit($id = null)
    {
        // $this->loadModel('Lignecomptes');
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        // //   debug($liendd);
        // $ff = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'comptes') {
        //         $ff = $liens['modif'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        $compte = $this->Comptes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData());
            if ($this->Comptes->save($compte)) {
                $compte_id = $compte->id;

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    $lignedevi = $this->fetchTable('Lignecomptes')->find('all')->where(["Lignecomptes.compte_id =" . $id]);
                    //debug($ligneinventaire);die;
                    //  $this->fetchTable('Ligneinventaires')->deleteMany($ligneinventaire);
                    //  debug($this->request->getData('data')['ligner']);die;
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {

                        if ($l['sup'] != '1') {


                            $tab['compte_id'] = $compte_id;


                            $tab['typecredit_id'] = $l['typecredit_id'];


                            //$lignet['id'] = $l['id'];

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $ligneinv = $this->fetchTable('Lignecomptes')->get($l['id'], [
                                    'contain' => []
                                ]);
                            } else {

                                $ligneinv  = $this->fetchTable('Lignecomptes')->newEmptyEntity();

                                //// debug($ligneinv);
                            }
                            $ligneinv = $this->fetchTable('Lignecomptes')->patchEntity($ligneinv, $tab);


                            if ($this->fetchTable('Lignecomptes')->save($ligneinv)) {
                            } else {
                            }
                        } else {
                            if (!empty($l['id'])) {
                                $ligneinv = $this->fetchTable('Lignecomptes')->get($l['id']);
                                $this->fetchTable('Lignecomptes')->delete($ligneinv);
                            }
                        }
                    }
                }

                //  $this->Flash->success(__('The compte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The compte could not be saved. Please, try again.'));
        }
        $lignecompte = $this->fetchTable('Lignecomptes')->find('all')->where(["Lignecomptes.compte_id =" . $id]);
        $typecredits = $this->fetchTable('Typecredits')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $agences = $this->Comptes->Agences->find('list', ['limit' => 200])->all();
        $agences = $this->fetchTable('Agences')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('compte', 'banques', 'agences', 'lignecompte', 'typecredits'));
    }
    public function add()
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        // /// debug($liendd);die;
        // $f = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'comptes') {
        //         $f = $liens['ajout'];
        //     }
        // }
        // // debug($societe);die;
        // if (($f <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        $compte = $this->Comptes->newEmptyEntity();
        if ($this->request->is('post')) {
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData());
            if ($this->Comptes->save($compte)) {
                $compte_id = $compte->id;

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {

                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {

                        if ($l['sup'] == '') {

                            $tab = $this->fetchTable('Lignecomptes')->newEmptyEntity();
                            //debug($l);die;
                            $tab['compte_id'] = $compte->id;

                            $tab['typecredit_id'] = $l['typecredit_id'];

                            $this->fetchTable('Lignecomptes')->save($tab);
                            //debug($tab);
                        }
                    }
                }
                //   $this->Flash->success(__('The compte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The compte could not be saved. Please, try again.'));
        }
        $agences = $this->Comptes->Agences->find('list', ['limit' => 200])->all();
        $agences = $this->fetchTable('Agences')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $typecredits = $this->fetchTable('Typecredits')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('compte', 'agences', 'banques', 'typecredits'));
    }
    public function add2904()
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_finance' . $abrv);
        /// debug($liendd);die;
        $f = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'comptes') {
                $f = $liens['ajout'];
            }
        }
        // debug($societe);die;
        // if (($f <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        $compte = $this->Comptes->newEmptyEntity();
        if ($this->request->is('post')) {
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData());
            if ($this->Comptes->save($compte)) {
                $compte_id = $compte->id;


                //   $this->Flash->success(__('The compte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The compte could not be saved. Please, try again.'));
        }
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('compte', 'banques'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Compte id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function edit2904($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_finance' . $abrv);
        //   debug($liendd);
        $ff = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'comptes') {
                $ff = $liens['modif'];
            }
        }
        // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        $compte = $this->Comptes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $compte = $this->Comptes->patchEntity($compte, $this->request->getData());
            if ($this->Comptes->save($compte)) {
                $compte_id = $compte->id;



                //  $this->Flash->success(__('The compte has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The compte could not be saved. Please, try again.'));
        }

        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('compte', 'banques', 'lignecompte'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Compte id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_finance' . $abrv);
        // //   debug($liendd);
        // $ff = 0;
        // foreach ($liendd as $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'comptes') {
        //         $ff = $liens['delete'];
        //     }
        // }
        // // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }



        $lignes = $this->fetchTable('Lignecomptes')->find('all', [])->where(['Lignecomptes.compte_id =' . $id]);
        foreach ($lignes as $art) {
            $this->fetchTable('Lignecomptes')->delete($art);
        }
        // $this->request->allowMethod(['post', 'delete']);
        $compte = $this->Comptes->get($id);
        $this->Comptes->delete($compte);
        //$this->Flash->success(__('The commandefournisseur has been deleted.'));

        return $this->redirect(['action' => 'index']);
    }
    public function delete2904($id = null)
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_finance' . $abrv);
        //   debug($liendd);
        $ff = 0;
        foreach ($liendd as $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'comptes') {
                $ff = $liens['delete'];
            }
        }
        // debug($societe);die;
        // if (($ff <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }



        // $lignes = $this->fetchTable('Lignecomptes')->find('all', [])->where(['Lignecomptes.compte_id =' . $id]);
        // foreach ($lignes as $art) {
        //     $this->fetchTable('Lignecomptes')->delete($art);
        // }
        // $this->request->allowMethod(['post', 'delete']);
        $compte = $this->Comptes->get($id);
        $this->Comptes->delete($compte);
        //$this->Flash->success(__('The commandefournisseur has been deleted.'));

        return $this->redirect(['action' => 'index']);
    }

    public function delete11($id = null)
    {


        $lignes = $this->fetchTable('Lignecommandefournisseurs')->find('all', [])->where(['Lignecommandefournisseurs.commandefournisseur_id =' . $id]);
        foreach ($lignes as $art) {
            $this->fetchTable('Lignecommandefournisseurs')->delete($art);
        }
        // $this->request->allowMethod(['post', 'delete']);
        $commandefournisseur = $this->Commandefournisseurs->get($id);
        $this->fetchTable('Devis')->updateAll(['commandefournisseur_id' => 0], ['commandefournisseur_id' => $id]);
        $this->Commandefournisseurs->delete($commandefournisseur);
        //$this->Flash->success(__('The commandefournisseur has been deleted.'));

        return $this->redirect(['action' => 'index']);
    }


    public function indexengcompte2908()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');
        if ($this->request->getQuery()) {

            $cond7 = '';
            $cond1 = '';
            $cond6 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';


            $compteid = $this->request->getQuery('compte_id');
            if (!empty($compteid)) {
                $cond3 = 'Piecereglements.compte_id =' . $compteid;
            }
            // if (!empty($compteid)) {
            //     $cond4 = 'Piecereglementclients.compte_id =' . $compteid;
            // }
            $date1 = $this->request->getQuery('date1');
            $date2 = $this->request->getQuery('date2');
            // debug($echance);

            if (!empty($date1)) {
                //$conditions1['Piecereglements.echance'] = $echance;
                $cond5 = 'Reglements.date >=  ' . "'" . $date1 . "'";
            }
            // if (!empty($date1)) {
            //     $cond6 = 'Piecereglementclients.echance >=  ' . "'" . $date1 . "'";
            // }
            if (!empty($date2)) {
                //$conditions1['Piecereglements.echance'] = $echance;
                $cond1 = 'Reglements.date <=  ' . "'" . $date2 . "'";
            }
            if (!empty($date2)) {
                //$conditions1['Piecereglements.echance'] = $echance;
                $cond7 = 'Piecereglements.echance <=  ' . "'" . $date2 . "'";
            }
            if (!empty($date1)) {
                $cond6 = 'Piecereglements.echance >=  ' . "'" . $date1 . "'";
            }
            $reglements = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Fournisseurs'],
            ])
                ->where([$cond1, $cond5])
                ->toArray(); // Fetch results as an array

            $piecereglements = $this->Piecereglements->find('all')
                ->contain(['Comptes', 'Paiements', 'Reglements' => ['Fournisseurs']])
                ->where([$cond7, $cond6, $cond3])
                ->toArray(); // Fetch results as an array


        }



        if ($this->request->is('post')) {
            $data = [
                'date' => $this->request->getData('date'),
                'etat_id' => $this->request->getData('etat_id'),
                'reglement_id' => $this->request->getData('reglement_id'),
                'piecereglement_id' => $this->request->getData('piecereglement_id'),

            ];

            $etatpiecereglement = $this->fetchTable('Etatpieceregelemnts')->newEntity($data);

            if ($this->fetchTable('Etatpieceregelemnts')->save($etatpiecereglement)) {
                //  $this->Flash->success(__('The data has been saved.'));
            } else {
                //$this->Flash->error(__('The data could not be saved. Please, try again.'));
            }

            // Redirect to a suitable page after the save
            return $this->redirect(['action' => 'indexengcompte']);
        }

        $comptes = $this->fetchTable('Comptes')
            ->find()
            ->contain('Agences')
            //  ->select(['Agences.name'])
            ->toArray();

        // $lignes = $this->getTableLocator()->get('Lignebanques')
        //     ->find()
        //     ->contain(['Comptes', 'Banques'])
        //     ->select(['Comptes.numero', 'Banques.name'])
        //     ->toArray();

        // debug($comptes);
        // debug($lignes);

        // ... Rest of your code ...

        // $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);

        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('reglements', 'etatpiecereglement', 'date1', 'date2', 'piecereglements', 'etats', 'combinedData', 'comptes', 'modes', 'fournisseurs', 'echance', 'modeid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
    }
    public function indexengcompte($compte_id = null)
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');
        $this->loadModel('Historiquecomptes');
    
        $date1 = $this->request->getQuery('date1');
        $date2 = $this->request->getQuery('date2');
        $compteid = $this->request->getQuery('compte_id');
    
        $historiquecomptes = [];
        $commande = 1;
        $livrison = 1;
    
        $historiques = $this->Historiquecomptes->find('all');
        foreach ($historiques as $h) {
            $this->Historiquecomptes->delete($h);
        }
    
        if ($this->request->getQuery()) {
            $historiques = $this->Historiquecomptes->find('all');
            foreach ($historiques as $h) {
                $this->Historiquecomptes->delete($h);
            }
    
            $testdate = 0;
    
            if ($this->request->getQuery('date1') != '') {
                $date1 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
                $testdate = 1;
    
                $cond3 = 'date(Piecereglements.echance) >= ' . "'" . $date1 . " 00:00:00'";
                $cond4 = 'date(Piecereglementclients.echance) >= ' . "'" . $date1 . " 00:00:00'";
                $cond7 = 'date(Piecereglements.echance) >= ' . "'" . $date1 . " 00:00:00'";
                $cond8 = 'date(Piecereglementclients.echance) >= ' . "'" . $date1 . " 00:00:00'";
            }
    
            if ($this->request->getQuery('date2') != '') {
                $date2 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
    
                $cond11 = 'date(Piecereglements.echance) <= ' . "'" . $date2 . " 23:59:59'";
                $cond12 = 'date(Piecereglementclients.echance) <= ' . "'" . $date2 . " 23:59:59'";
                $cond15 = 'date(Piecereglements.echance) >= ' . "'" . $date2 . " 23:59:59'";
                $cond16 = 'date(Piecereglementclients.echance) >= ' . "'" . $date2 . " 23:59:59'";
            }
    
            if ($this->request->getQuery('compte_id') != '') {
                $compteid = $this->request->getQuery('compte_id');
                $conddcompte = 'Comptes.id =' . $compteid;
                $comptes = $this->Comptes->find('all')->where([$conddcompte]);
            } else {
                $compteid = 0;
            }
    
            foreach ($comptes as $dep) {
                $compteid = $dep->id;
                $compte = $dep->numero;
    
                $cond21 = 'Piecereglementclients.compte_id =' . $compteid;
                $cond22 = 'Piecereglements.compte_id =' . $compteid;
            }
    
            $reglements = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Fournisseurs'],
            ]);
    
            $piecereglements = $this->Piecereglements->find('all')
                ->contain(['Comptes', 'Paiements', 'Reglements' => ['Fournisseurs']])
                ->where([$cond7, $cond11, $cond3, $cond15, $cond22]);
    
            $reglementclients = $this->fetchTable('Reglementclients')->find('all', [
                'contain' => ['Clients'],
            ]);
    
            $piecereglementclients = $this->Piecereglementclients->find('all')
                ->contain(['Paiements', 'Comptes', 'Reglementclients' => ['Clients']])
                ->where([$cond4, $cond8, $cond21, $cond12, $cond16]);
    
            if ($livrison == 0) {
                $piecereglements = [];
            }
    
            $tablignelivrisons = [];
            foreach ($piecereglements as $l) {
                $tablignelivrisons['date'] = $l['reglement']['Date'];
                $tablignelivrisons['type'] = "Réglement Achat";
                $tablignelivrisons['indice'] = 1;
                $tablignelivrisons['numero'] = $l['numero'];
                $tablignelivrisons['mode'] = $l['paiement']['name'];
                $tablignelivrisons['montant'] = $l['montant'];
                $tablignelivrisons['credit'] = '';
                $tablignelivrisons['debit'] = $l['montant'];
                $tablignelivrisons['compte'] = $compte;
    
                $historiquecomptes = $this->fetchTable('Historiquecomptes')->newEmptyEntity();
                $historiquecomptes = $this->Historiquecomptes->patchEntity($historiquecomptes, $tablignelivrisons);
                $this->Historiquecomptes->save($historiquecomptes);
            }
    
            if ($commande == 0) {
                $piecereglementclients = [];
            }
    
            $tablignecom = [];
            foreach ($piecereglementclients as $l) {
                $tablignecom['date'] = $l['reglementclient']['date'];
                $tablignecom['type'] = "Réglement Vente";
                $tablignecom['indice'] = 2;
                $tablignecom['numero'] = $l['numero'];
                $tablignecom['mode'] = $l['paiement']['name'];
                $tablignecom['montant'] = $l['montant'];
                $tablignecom['credit'] = $l['montant'];
                $tablignecom['debit'] = '';
                $tablignecom['compte'] = $compte;
    
                $historiquecomptes = $this->fetchTable('Historiquecomptes')->newEmptyEntity();
                $historiquecomptes = $this->Historiquecomptes->patchEntity($historiquecomptes, $tablignecom);
                $this->Historiquecomptes->save($historiquecomptes);
            }
        }
    
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $modepaiments = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
    
        $historiquecomptes = $this->fetchTable('Historiquecomptes')->find('all')->order(['Historiquecomptes.date' => 'ASC']);
        $count = $this->fetchTable('Historiquecomptes')->find('all')->count();
    
        $comptes = $this->fetchTable('Comptes')->find()->contain('Agences')->toArray();
    
        $soldetc = 0;
        if ($compteid != null) {
            $compte = $this->fetchTable('Comptes')->find('all', ['contain' => ['Agences']])->where(['Comptes.id' => $compteid])->first();
            $connection = ConnectionManager::get('default');
            $ss = $connection->execute('SELECT SUM(comptes.montant) as m FROM comptes WHERE comptes.id = :id', ['id' => $compteid])->fetchAll('assoc');
    
            if (!empty($ss)) {
                $soldetc = $ss[0]['m'];
            }
        }
    
        $this->set(compact('soldetc', 'count', 'historiquecomptes', 'fournisseurs', 'comptes', 'compteid', 'date1', 'date2', 'modepaiments'));
    }
    public function imprimeeng($compte_id = null)
    {
     
        $this->loadModel('Historiquecomptes');
    
        $date1 = $this->request->getQuery('date1');
        $date2 = $this->request->getQuery('date2');
        $compteid = $this->request->getQuery('compte_id');
    
   
        // $historiquearticles = $this->fetchTable('Historiquearticles')->find('all')->order(['Historiquearticles.date' => 'ASC']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $modepaiments = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
    
        $historiquecomptes = $this->fetchTable('Historiquecomptes')->find('all')->order(['Historiquecomptes.date' => 'ASC']);
        $count = $this->fetchTable('Historiquecomptes')->find('all')->count();
    
        $comptes = $this->fetchTable('Comptes')->find()->contain('Agences')->toArray();
    
        $soldetc = 0;
        if ($compteid != null) {
            $compte = $this->fetchTable('Comptes')->find('all', ['contain' => ['Agences']])->where(['Comptes.id' => $compteid])->first();
            $connection = ConnectionManager::get('default');
            $ss = $connection->execute('SELECT SUM(comptes.montant) as m FROM comptes WHERE comptes.id = :id', ['id' => $compteid])->fetchAll('assoc');
    
            if (!empty($ss)) {
                $soldetc = $ss[0]['m'];
            }
        }
    
        $this->set(compact('soldetc', 'count', 'historiquecomptes', 'fournisseurs', 'comptes', 'compteid', 'date1', 'date2', 'modepaiments'));
    }  

    public function indexengcompte18062024($compte_id = null)
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Comptes');
        $this->loadModel('Historiquecomptes');


        // $date1 = '01-01-' . date("Y") . ''  . date("h:m:s");
        $date1 = $this->request->getQuery()['date1'];
        // debug($date1);
        $date2 = $this->request->getQuery()['date2'];
        $compteid = $this->request->getQuery()['compte_id'];
        /// debug($compteid);
        // $time = new FrozenTime('now', 'Africa/Tunis');
        // $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');

        /// debug($date2);

        $historiquecomptes = array();
        $commande = 1;
        //debug()
        $livrison = 1;


        $historiques = $this->Historiquecomptes->find('all');
        // debug($historiques->toarray());die;
        foreach ($historiques as $h) {
            $this->Historiquecomptes->delete($h);
        }
        //debug($historiques->toarray());die;
        if ($this->request->getQuery()) {

            //  debug($this->request->getQuery()) ;
            $historiques = $this->Historiquecomptes->find('all');
            foreach ($historiques as $h) {
                $this->Historiquecomptes->delete($h);
            }


            $testdate = 0;
            //$solde = 0;


            if ($this->request->getQuery()['date1'] != '') {
                $date1 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date1'])));
                // debug($date1);


                $testdate = 1;


                $cond3 = 'date(Piecereglements.echance) <  ' . "'" . $date1 . " 23:59:59'";

                $cond4 = 'date(Piecereglementclients.echance) <  ' . "'" . $date1 . " 23:59:59'";


                $cond7 = 'date(Piecereglements.echance)  >=  ' . "'" . $date1 . " 00:00:00'";
                $cond8 = 'date(Piecereglementclients.echance) >=  ' . "'" . $date1 . " 00:00:00'";
            }



            if ($this->request->getQuery()['date2'] != '') {
                $date2 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date2'])));

                $cond11 = 'date(Piecereglements.echance)  <= ' . "'" . $date2 . " 23:59:59'";
                $cond12 = 'date(Piecereglementclients.echance)  <= ' . "'" . $date2 . " 23:59:59'";


                $cond15 = 'date(Piecereglements.echance) >=  ' . "'" . $date2 . " 23:59:59'";
                $cond16 = 'date(Piecereglementclients.echance) >=  ' . "'" . $date2 . " 23:59:59'";
                //}
            }






            if ($this->request->getQuery()['compte_id'] != '') {
                $compteid = $this->request->getQuery()['compte_id'];
                $conddcompte = 'Comptes.id =' . $compteid;
                $comptes = $this->Comptes->find('all')->where([$conddcompte]);
                // debug($compteid);

                // debug($cond22);
            } else {
                $compteid = 0;
            }
            foreach ($comptes as $dep) {
                //debug($dep);
                $compteid = $dep->id;

                $compte = $dep->numero;

                $cond21 = 'Piecereglementclients.compte_id =' . $compteid;
                // debug($cond21);
                $cond22 = 'Piecereglements.compte_id =' . $compteid;
            }

            $reglements = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Fournisseurs'],
            ]);
            //  ->where([$cond2, $cond6, $cond10]);
            // ->toArray(); // Fetch results as an array
            //   debug($reglements->toarray());
            $piecereglements = $this->Piecereglements->find('all')
                ->contain(['Comptes', 'Paiements', 'Reglements' => ['Fournisseurs']])
                ->where([$cond7, $cond11, $cond3, $cond15, $cond22]);
            //->toArray();

            // debug($piecereglements->toarray());

            // debug($piecereglements);
            // Fetch results as an array
            $reglementclients = $this->fetchTable('Reglementclients')->find('all', [
                'contain' => ['Clients'],
            ]);
            //   ->where([$cond1, $cond5, $cond9]);
            // ->toArray(); // Fetch results as an array
            //   debug($reglementclients->toArray());
            $piecereglementclients = $this->Piecereglementclients->find('all')
                ->contain(['Paiements', 'Comptes', 'Reglementclients' => ['Clients']])
                ->where([$cond4, $cond8, $cond21, $cond12, $cond16]);
            // ->toArray();


            // ->toArray();
            // ,'Paiements.id'=>2
            //  debug($piecereglementclients->toarray());



            //  }



            if ($livrison == 0) {
                $piecereglements = array();
                //debug($piecereglementachats);
            }

            $tablignelivrisons = array();

            foreach ($piecereglements as $l) {
                $tablignelivrisons['date'] = $l['reglement']['Date'];
                $tablignelivrisons['type'] = "Réglement Achat";
                $tablignelivrisons['indice'] = 1;
                $tablignelivrisons['numero'] = $l['numero'];
                $tablignelivrisons['mode'] = $l['paiement']['name'];
                $tablignelivrisons['montant'] = $l['montant'];
                $tablignelivrisons['credit'] = '' ;//$l['montant'];
                $tablignelivrisons['debit'] = $l['montant'];
                //  debug($l);die;
                $tablignelivrisons['compte'] = $compte;

                // debug($tablignelivrisons);die;
                $historiquecomptes = $this->fetchTable('Historiquecomptes')->newEmptyEntity();
                $historiquecomptes = $this->Historiquecomptes->patchEntity($historiquecomptes, $tablignelivrisons);

                $this->Historiquecomptes->save($historiquecomptes);
                //  debug($historiquecomptes);die;


            }
            //  debug($historiquecomptes);
            if ($commande == 0) {
                $piecereglementclients = array();
            }
            $tablignecom = array();
            foreach ($piecereglementclients as $l) {

                //debug($l);   
                $tablignecom['date'] = $l['reglementclient']['date'];
                $tablignecom['type'] = "Réglement Vente";
                $tablignecom['indice'] = 2;
                $tablignecom['numero'] = $l['numero'];
                $tablignecom['mode'] = $l['paiement']['name'];

                $tablignecom['montant'] = $l['montant'];
                $tablignecom['credit'] = $l['montant'];
                $tablignecom['debit'] = '' ;//$l['montant'];
                $tablignecom['compte'] = $compte;


                $historiquecomptes = $this->fetchTable('Historiquecomptes')->newEmptyEntity();
                $historiquecomptes = $this->Historiquecomptes->patchEntity($historiquecomptes, $tablignecom);
                // debug($historiquecomptes);
                $this->Historiquecomptes->save($historiquecomptes);
            }
            //  debug($historiquecomptes);
        }
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $modepaiments = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $historiquecomptes = $this->fetchTable('Historiquecomptes')->find('all')->order(['Historiquecomptes.date' => 'ASC']);
        // debug($historiquecomptes->toArray());
        $count = $this->fetchTable('Historiquecomptes')->find('all')->count();

        $comptes = $this->fetchTable('Comptes')
            ->find()
            ->contain('Agences')
            ->toArray();

        // debug($compteid);
        $soldetc=0;
        if ($compteid != null) {
            $compte = $this->fetchTable('Comptes')->find('all', [
                'contain' => ['Agences'],
            ])->where(['Comptes.id' => $compteid])->first();
            // debug($compteid);
          //  if ($compteid !== null) {
                $connection = ConnectionManager::get('default');
                $ss = $connection->execute('SELECT SUM(comptes.montant) as m FROM comptes WHERE comptes.id =  . $compte->id.')->fetchAll('assoc');

                if (!empty($qte)) {
                    $soldetc = $ss[0]['m'];
                }
           // }
             debug($soldetc);
        }

        $this->set(compact('ligneinv', 'comptes', 'soldetc', 'modepaiments', 'fournisseurs', 'count', 'ligneinv1', 'historiquecomptes', 'name', 'compteid', 'count', 'date1', 'date2'));
    }
}
