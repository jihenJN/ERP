<?php

declare(strict_types=1);

namespace App\Controller;


use Cake\Http\Session;
use Cake\ORM\TableRegistry;
/**
 * Reglements Controller
 *
 * @property \App\Model\Table\ReglementsTable $Reglements
 * @method \App\Model\Entity\Reglement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReglementsController extends AppController
{
    public function chequepaye($id = null)
    {
        $etatcheque = $this->fetchTable('Etatchequeexcels')->get($id, [
            'contain' => [],
        ]);

        $data['etat'] = 1;



        $etatcheque = $this->fetchTable('Etatchequeexcels')->patchEntity($etatcheque, $data);
        if ($this->fetchTable('Etatchequeexcels')->save($etatcheque)) {
        }



        return $this->redirect(['action' => 'indexcheque']);
    }
    public function chequeimpaye($id = null)
    {
        $etatcheque = $this->fetchTable('Etatchequeexcels')->get($id, [
            'contain' => [],
        ]);

        $data['etat'] = 2;



        $etatcheque = $this->fetchTable('Etatchequeexcels')->patchEntity($etatcheque, $data);
        if ($this->fetchTable('Etatchequeexcels')->save($etatcheque)) {
        }



        return $this->redirect(['action' => 'indexcheque']);
    }
    public function traitepaye($id = null)
    {
        $etattraite = $this->fetchTable('Etattraiteexcels')->get($id, [
            'contain' => [],
        ]);

        $data['etat'] = 1;



        $etattraite = $this->fetchTable('Etattraiteexcels')->patchEntity($etattraite, $data);
        if ($this->fetchTable('Etattraiteexcels')->save($etattraite)) {
        }



        return $this->redirect(['action' => 'indextraite']);
    }
    public function traiteimpaye($id = null)
    {
        $etattraite = $this->fetchTable('Etattraiteexcels')->get($id, [
            'contain' => [],
        ]);

        $data['etat'] = 2;



        $etattraite = $this->fetchTable('Etattraiteexcels')->patchEntity($etattraite, $data);
        if ($this->fetchTable('Etattraiteexcels')->save($etattraite)) {
        }



        return $this->redirect(['action' => 'indextraite']);
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

    public function getpaiement()
    {
        $this->request->allowMethod(['ajax']);

        $id = $this->request->getQuery('id');

        $paiementData = $this->fetchTable('Paiementfactures')->find('all', [
            'conditions' => ['facture_id' => $id],
            'contain' => ['Paiements'],
        ])->toArray();


        $this->set([
            'success' => true,
            'data' => $paiementData,
            '_serialize' => ['success', 'data'],
        ]);
    }

    public function imprimengagement()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Comptes');
        $this->loadModel('Etatpiecereglements');
        // $this->loadModel('Etats');

        if ($this->request->getQuery()) {

            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';
            $cond6 = '';


            $modeid = $this->request->getQuery('modepaiement-id');
            if (!empty($modeid)) {

                $cond1 = 'Piecereglements.paiement_id =' . $modeid;
            }
            // debug($modeid);

            $fournisseurid = $this->request->getQuery('fournisseur-id');
            if (!empty($fournisseurid)) {
                //$conditions2['Reglementachats.fournisseur_id'] = $fournisseurid;
                $cond2 = 'Reglements.fournisseur_id =' . $fournisseurid;
            }

            $compteid = $this->request->getQuery('compte-id');

            if (!empty($compteid)) {
                $cond3 = 'Piecereglements.compte_id =' . $compteid;
            }

            $echance = $this->request->getQuery('echance');

            // debug($echance);

            if (!empty($echance)) {
                //$conditions1['Piecereglementachats.echance'] = $echance;
                $cond4 = 'Piecereglements.echance >=  ' . "'" . $echance . "'";
            }


            $datereg = $this->request->getQuery('date');

            if (!empty($datereg)) {
                $cond5 = 'Reglements.date >=  ' . "'" . $datereg . "'";
            }

            $etatpiece_id = $this->request->getQuery('etatpiece-id');

            if (!empty($etatpiece_id)) {
                $cond6 = 'Piecereglements.etatpiecereglement_id =' . $etatpiece_id;
            }


            $reglements = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Fournisseurs'],
            ])
                ->where([$cond2, $cond5])
                ->toArray(); // Fetch results as an array
            $condd = "";
            if ($reglements) {
                $regid = "";
                foreach ($reglements as $key => $reg) {
                    $regid = $regid . ',' . $reg['id'];
                }
                $condd = "Piecereglements.reglement_id in (" . substr($regid, 1, strlen($regid)) . ")";
            }

            // $piecereglements = $this->Piecereglements->find('all')
            //     ->where([$cond1, $cond3, $cond4, $condd,$cond6])
            //     ->toArray(); 
           

            $piecereglementsTable = TableRegistry::getTableLocator()->get('Piecereglements');

            $piecereglements = $piecereglementsTable->find()
                ->select([
                    'month' => $piecereglementsTable->func()->extract('MONTH', 'echance'),
                    'total' => $piecereglementsTable->func()->count('*')
                ])
                ->where([$cond1, $cond3, $cond4, $condd, $cond6])
                ->group(['month'])
                ->toArray();

            $session = new Session();
            $session->write('searchParams', [
                'date' => $datereg,
                'echance' => $echance,
                'fournisseur-id' => $fournisseurid,
                'compte-id' => $compteid,
                'modepaiement-id' => $modeid,
                'etatpiece-id' => $etatpiece_id,


            ]);
        }

        $etatpieceregelemntt = $this->fetchTable('Situationpiecereglements')->newEmptyEntity();



        $etatpiece_id = $this->request->getQuery('etatpiece-id');
        $datereg = $this->request->getQuery('date');
        $echance = $this->request->getQuery('echance');
        $compteid = $this->request->getQuery('compte-id');
        $fournisseurid = $this->request->getQuery('fournisseur-id');
        $modeid = $this->request->getQuery('modepaiement-id');




        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);

        $etats = $this->fetchTable('Etatpiecereglements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);

        $this->set(compact('etatpiece_id', 'reglements', 'etatpiecereglement', 'agences', 'piecereglements', 'etats', 'combinedData', 'comptes', 'modes', 'fournisseurs', 'echance', 'modeid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
    }
    public function indexeng()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Comptes');
        $this->loadModel('Etatpiecereglements');
        // $this->loadModel('Etats');

        if ($this->request->getQuery()) {

            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';
            $cond6 = '';


            $modeid = $this->request->getQuery('modepaiement-id');
            if (!empty($modeid)) {

                $cond1 = 'Piecereglements.paiement_id =' . $modeid;
            }
            // debug($modeid);

            $fournisseurid = $this->request->getQuery('fournisseur-id');
            if (!empty($fournisseurid)) {
                //$conditions2['Reglementachats.fournisseur_id'] = $fournisseurid;
                $cond2 = 'Reglements.fournisseur_id =' . $fournisseurid;
            }

            $compteid = $this->request->getQuery('compte-id');

            if (!empty($compteid)) {
                $cond3 = 'Piecereglements.compte_id =' . $compteid;
            }

            $echance = $this->request->getQuery('echance');

            // debug($echance);

            if (!empty($echance)) {
                //$conditions1['Piecereglementachats.echance'] = $echance;
                $cond4 = 'Piecereglements.echance >=  ' . "'" . $echance . "'";
            }


            $datereg = $this->request->getQuery('date');

            if (!empty($datereg)) {
                $cond5 = 'Reglements.date >=  ' . "'" . $datereg . "'";
            }

            $etatpiece_id = $this->request->getQuery('etatpiece-id');

            if (!empty($etatpiece_id)) {
                $cond6 = 'Piecereglements.etatpiecereglement_id =' . $etatpiece_id;
            }


            $reglements = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Fournisseurs'],
            ])
                ->where([$cond2, $cond5])
                ->toArray(); // Fetch results as an array
            $condd = "";
            if ($reglements) {
                $regid = "";
                foreach ($reglements as $key => $reg) {
                    $regid = $regid . ',' . $reg['id'];
                }
                $condd = "Piecereglements.reglement_id in (" . substr($regid, 1, strlen($regid)) . ")";
            }

            $piecereglements = $this->Piecereglements->find('all')
                // ->contain(['Comptes', 'Modepaiements', 'Etats', 'Reglementachats' => ['Fournisseurs']])
                ->where([$cond1, $cond3, $cond4, $condd, $cond6])
                ->toArray(); // Fetch results as an array


            $session = new Session();
            $session->write('searchParams', [
                'date' => $datereg,
                'echance' => $echance,
                'fournisseur-id' => $fournisseurid,
                'compte-id' => $compteid,
                'modepaiement-id' => $modeid,
                'etatpiece-id' => $etatpiece_id,


            ]);

            // return $this->redirect(['action' => 'indexeng?date='.$datereg.'&echance='.$echance.'&fournisseur-id='.$fournisseurid.'&compte-id='.$compteid.'&modepaiement-id='.$modeid.'&etatpiece-id='.$etatpiece_id]);


        }

        $etatpieceregelemntt = $this->fetchTable('Situationpiecereglements')->newEmptyEntity();
        //debug($this->request->getData());


        $etatpiece_id = $this->request->getQuery('etatpiece-id');
        $datereg = $this->request->getQuery('date');
        $echance = $this->request->getQuery('echance');
        $compteid = $this->request->getQuery('compte-id');
        $fournisseurid = $this->request->getQuery('fournisseur-id');
        $modeid = $this->request->getQuery('modepaiement-id');

        if ($this->request->is('post')) {
            //  debug($etatpieceregelemntt);
            $etatpieceregelemnt = $this->fetchTable('Situationpiecereglements')->patchEntity($etatpieceregelemntt, $this->request->getData());

            // debug( $this->request->getData());die;
            //// mise ajour solde compte
            // $compte = $this->Comptes->get($etatpieceregelemnt['compte_id'], [
            //     'contain' => []
            // ]);


            // $pv = $etatpieceregelemnt['montant'];

            // // $compte->montant = $pv;
            // $compte->montant += $pv;
            // $this->fetchTable('Comptes')->save($compte);

            //// mise ajour etat piece
            $piece = $this->Piecereglements->get($etatpieceregelemnt->piecereglement_id, [
                'contain' => []
            ]);



            $pv = $etatpieceregelemnt['etatpiecereglement_id'];
            // debug()
            $piece->etatpiecereglement_id = $pv;
            $this->fetchTable('Piecereglements')->save($piece);



            if ($this->fetchTable('Situationpiecereglements')->save($etatpieceregelemnt)) {

                $s_id = ($this->fetchTable('Situationpiecereglements')->save($etatpieceregelemnt)->id);
                $this->misejour("Situationpiecereglements", "add", $s_id);


                //   debug($etatpieceregelemnt);
                //  $this->Flash->success(__('The data has been saved.'));

                $session = new Session();
                $searchParams = $session->read('searchParams');

                // Check if search parameters are available
                if ($searchParams) {
                    // Redirect back to the search results page with the saved parameters
                    return $this->redirect([
                        'controller' => 'Reglements',
                        'action' => 'indexeng',
                        '?' => $searchParams
                    ]);
                } else {
                    // If search parameters are not available, redirect to a default page
                    return $this->redirect(['controller' => 'Reglements', 'action' => 'indexeng']);
                }
                // return $this->redirect(['action' => 'indexeng?date='.$datereg.'&echance='.$echance.'&fournisseur-id='.$fournisseurid.'&compte-id='.$compteid.'&modepaiement-id='.$modeid.'&etatpiece-id='.$etatpiece_id]);
                // } else {
                //$this->Flash->error(__('The data could not be saved. Please, try again.'));
            }

            // Redirect to a suitable page after the save
            // return $this->redirect(['action' => 'indexeng']);
        }
        // if ($this->request->is('post')) {
        //     //  debug($this->request->getData('data')['etatpieceregelemnts']);
        //     $data = [
        //         'date' => $this->request->getData('date'),
        //         'etat_id' => $this->request->getData('etat_id'),
        //         'reglementachat_id' => $this->request->getData('reglementachat_id'),
        //         'piecereglementachat_id' => $this->request->getData('piecereglementachat_id'),
        //         'compte_id' => $this->request->getData('compte_id'),
        //        // 'montant' => $this->request->getData('montant'),

        //     ];
        //       debug($data);die;

        //     //  debug($data);die;
        //     $etatpiecereglement = $this->fetchTable('Etatpieceregelemnts')->newEntity($data);

        //     if ($this->fetchTable('Etatpieceregelemnts')->save($etatpiecereglement)) {
        //         //     $compte = $this->Comptes->get($data['compte_id'], [
        //         //         'contain' => []
        //         //     ]);

        //         //     $m = $compte['montant'];

        //         //     $pv = $this->request->getData('montant') ; 
        //         //    // debug($pv);
        //         //     $compte->montant = $pv;

        //         //     $this->fetchTable('Comptes')->save($compte);

        //         //  $this->Flash->success(__('The data has been saved.'));
        //     } else {
        //         //$this->Flash->error(__('The data could not be saved. Please, try again.'));
        //     }

        //     // Redirect to a suitable page after the save
        //     return $this->redirect(['action' => 'indexeng']);
        // }

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero']);
        //->contain('Agences');
        // debug($comptes);
        $etats = $this->fetchTable('Etatpiecereglements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //$etatss = $this->fetchTable('Etatpieceregelemnts')->find('list');
        //debug($etatss->toArray());
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //   $modes = $this->fetchTable('Modepaiements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        // $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //->where(['Paiements.id' => '2']);

        $this->set(compact('etatpiece_id', 'reglements', 'etatpiecereglement', 'agences', 'piecereglements', 'etats', 'combinedData', 'comptes', 'modes', 'fournisseurs', 'echance', 'modeid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
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
        //debug($this->request->getData());die;
        $datedebut = $this->request->getQuery('datedebut');
        //   debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        $fournisseur_id = $this->request->getQuery('fournisseur_id');
        //debug($fournisseur_id);
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        if ($fournisseur_id != '') {
            $cond1 = "Reglements.fournisseur_id = " . $fournisseur_id;
        }
        if ($pointdevente_id != '') {
            $cond2 = "Reglements.pointdevente_id like  '%" . $pointdevente_id . "%' ";
        }
        if ($datedebut != '') {
            $cond3 = 'Reglements.Date >= ' . "'" . $datedebut . "'";
        }
        // debug($cond3);
        if ($datefin != '') {
            $cond4 = 'Reglements.Date <= ' . "'" . $datefin . "'";
        }
        //         debug($cond3);
        //         debug($cond4);
        //        $this->paginate = [
        //            'contain' => ['Fournisseurs', 'Importations', 'Utilisateurs', 'Exercices', 'Devises'],
        //        ];
        $query = $this->Reglements->find('all', [
            'conditions' => [$cond1, $cond2, $cond3, $cond4],
            'contain' => ['Fournisseurs'],
            'order' => ['Reglements.id' => 'DESC']
        ]);
        //debug($query);
        $cmd = $this->paginate($query);

        $reglements = $this->paginate($this->Reglements);
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $this->set(compact('reglements', 'pointdeventes', 'fournisseurs', 'cmd'));
    }

    /**
     * View method
     *
     * @param string|null $id Reglement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        //   debug($liendd);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'reglements') {
                $fournisseur = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

        // $reglement = 0;
        // foreach ($lien_commercialmenus as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementcommercial') {
        //         $reglement = $liens['modif'];
        //     }
        // }
        // if (($reglement <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }


        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');
        $reglement = $this->Reglements->get($id, [
            'contain' => [],
        ]);

        $four = $reglement->fournisseur_id;
        $p = $reglement->pointdevente_id;
        $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id]);

        $piecereglements = $this->Piecereglements->find('all')->where(['Piecereglements.reglement_id =' . $id]);
        $mtbon = 0.000;
        $mtfact = 0.000;
        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['facture_id'] != null) {
                $facreg[$ligne['facture_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['livraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
            // debug($ligne);die;
        }
        $factures = [];
        if ($four != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where('Factures.fournisseur_id =' . $four);
            // $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four,'Factures.valide=1']);

            $livraisons = $this->Livraisons->find('all')->where('Livraisons.fournisseur_id =' . $four);
        }
        // if ($four != null && $p == null) {
        //     $this->loadModel('Factures');
        //     $this->loadModel('Livraisons');
        //     $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four/*,'Factures.pointdevente_id'=>$p*/]);
        //     $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four/*,'Livraisons.pointdevente_id'=>$p*/]);
        // }
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {
                if ($art->banque_id != null) {
                    $bnq = $this->fetchTable('Banques')->find()
                        ->select(['name'])
                        ->where(['id' => $art->banque_id])
                        ->first();
                } else {
                    $bnq = '';
                }

                return $bnq->name . ' - ' . $art->rib;
            }
        ]);

        $this->set(compact('comptes', 'banques', 'caisses', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglements', 'lignesreg', 'pointdeventes', 'valeurs', 'carnetcheques', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($four = null, $fac = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        //   debug($liendd);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'reglements') {
                $fournisseur = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

        // $reglement = 0;
        // foreach ($lien_commercialmenus as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementcommercial') {
        //         $reglement = $liens['ajout'];
        //     }
        // }
        // if (($reglement <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }



        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');

        $reglement = $this->Reglements->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());die;
            $data['numeroconca'] = $this->request->getData('numeroconca');
            $data['Date'] = $this->request->getData('Date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['Montant'] = $this->request->getData('data')['Reglement']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglement']['ttpayer'];

            //debug($this->request->getData());die;
            $reglement = $this->Reglements->patchEntity($reglement, $data);
            if ($this->Reglements->save($reglement)) {

                $reglement_id = ($this->fetchTable('Reglements')->save($reglement)->id);
                $this->misejour("Reglements", "add", $reglement_id);
                $reglement_id = $reglement->id;
                if (isset($this->request->getData('data')['Lignereglement']) && (!empty($this->request->getData('data')['Lignereglement']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['Lignereglement'] as $i => $l) {
                        if (isset($l['facture_id'])) {
                            $ta = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $ta['reglement_id'] = $reglement_id;
                            $ta['facture_id'] = $l['facture_id'];
                            $ta['Montant'] = $l['Montanttt'];
                            // $ta['livraison_id']=0;
                            // Retourne l'article avec l'id 12
                            // debug ($l['ttc']);
                            $fact = $this->fetchTable('Factures')->get($l['facture_id']);
                            $fact->Montant_Regler =  $fact->Montant_Regler + $l['Montanttt'];
                            $this->fetchTable('Factures')->save($fact);


                            $this->fetchTable('Lignereglements')->save($ta);
                        }
                    }
                }



                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    // debug($this->request->getData('data')['pieceregelemnt']);die;
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglements')->newEmptyEntity();
                            $tab['reglement_id'] = $reglement_id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = $p['montant'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $tab['caisse_id'] = $p['caisse_id'];
                            $tab['compte_id'] = $p['compte_id'];

                            if ($p['compte_id'] != null) {
                                $compte = $this->fetchTable('Comptes')->find()->where('Comptes.id=' . $p['compte_id'])->first();
                                $tab['banque_id'] = $compte->banque_id;
                            }

                            $name =   $p['piecejointe']->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'reglement' . DS . $name;
                            if ($name) {
                                $p['piecejointe']->moveTo($targetPath);
                                $tab['piecejointe'] = $name;
                            };
                            // debug($tab);die;
                            $this->fetchTable('Piecereglements')->save($tab);
                            //$piecereglement = $this->fetchTable('Piecereglements')->newEmptyEntity();



                            // $piecereglement = $this->fetchTable('Piecereglements')->patchEntity($piecereglement, $tab);
                            // debug($lignecommande);

                        }
                    }
                }
                //  $this->Flash->success(__('The reglement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The reglement could not be saved. Please, try again.'));
        }
        $factures = '';
        $livraisons = '';
        // if ($four != null && $p != null) {
        //     $this->loadModel('Factures');
        //     $this->loadModel('Livraisons');
        //     $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four, 'Factures.ttc > Factures.Montant_Regler', 'Factures.pointdevente_id =' . $p]);
        //     $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four, 'Livraisons.ttc > Livraisons.Montant_Regler', 'Livraisons.pointdevente_id =' . $p]);
        //     debug($factures);
        // }

        $numeroobj = $this->Reglements->find()->select(["numerox" =>
        'MAX(Reglements.numeroconca)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            //debug($code);die;

        } else {
            $code = "00001";
        }

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {
                if ($art->banque_id != null) {
                    $bnq = $this->fetchTable('Banques')->find()
                        ->select(['name'])
                        ->where(['id' => $art->banque_id])
                        ->first();
                } else {
                    $bnq = '';
                }

                return $bnq->name . ' - ' . $art->rib;
            }
        ]);
        $listefactures = $this->fetchTable('Factures')->find('list', ['keyfield' => 'id', 'valueField' => 'numero'])->where('Factures.valide=1');




        // debug( $condclbl);

        // if ($four != null) {
        //     $this->loadModel('Factures');
        //     $this->loadModel('Livraisons');
        //     $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four, 'Factures.ttc > Factures.Montant_Regler', 'Factures.valide=1 ']);
        //     // debug($factures->toarray());   
        //     $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four, 'Livraisons.ttc > Livraisons.Montant_Regler'/*,'Livraisons.pointdevente_id'=>$p*/]);
        // }
        $paiements = $this->fetchTable('Paiements')->find('list');

        $factures = [];
        if ($fac != 0) {

            $condfac1 = "Factures.id=" . $fac;
            $facobj = $this->fetchTable('Factures')->find()->where($condfac1)->first();
            $four = $facobj->fournisseur_id;

            $this->loadModel('Factures');
            $factures = $this->Factures->find('all')->where(['Factures.id =' . $fac, 'Factures.ttc > Factures.Montant_Regler', 'Factures.valide=1 ']);
            $paiementfactures = $this->fetchTable('Paiementfactures')->find()->where('Paiementfactures.facture_id=' . $fac);
            $paiementfacturesIds = [];

            foreach ($paiementfactures as $row) {
                $paiementfacturesIds[] = $row->paiement_id;
            }

            $list = '(' . implode(',', $paiementfacturesIds) . ')';
            if ($list != '()') {
                $paiements = $this->fetchTable('Paiements')->find('list')->where('Paiements.id in ' . $list);
            }
        }



        // debug($comptes->toarray());
        $this->set(compact('facobj', 'fac', 'listefactures', 'comptes', 'banques', 'caisses', 'valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factures', 'four', 'p', 'code', 'reglement', 'pointdeventes', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises', 'timbre'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Reglement id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);
        //   debug($liendd);
        $fournisseur = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'reglements') {
                $fournisseur = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($fournisseur <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

        // $reglement = 0;
        // foreach ($lien_commercialmenus as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementcommercial') {
        //         $reglement = $liens['modif'];
        //     }
        // }
        // if (($reglement <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }


        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');
        $reglement = $this->Reglements->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());die;
            $data['numeroconca'] = $this->request->getData('numeroconca');
            $data['Date'] = $this->request->getData('Date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['Montant'] = $this->request->getData('data')['Reglement']['Montant'];
            $data['ttpayer'] = $this->request->getData('data')['Reglement']['ttpayer'];
            $reglement = $this->Reglements->patchEntity($reglement, $data);
            if ($this->Reglements->save($reglement)) {
                $reglement_id = ($this->fetchTable('Reglements')->save($reglement)->id);
                $this->misejour("Reglements", "edit", $reglement_id);
                $lignes = $this->Lignereglements->find()->where(["reglement_id" => $id])->all();
                foreach ($lignes as $item) {
                    // debug($item);die;
                    if ($item['facture_id'] != null) {
                        $mtg = $this->Factures->find()->select(["mtreg" =>
                        'Factures.Montant_Regler'])->where(['Factures.id =' . $item['facture_id']])->first();
                        $MontantRegler = $mtg->mtreg;
                        $fact = $this->Factures->get($item['facture_id']);
                        $fact->Montant_Regler = $MontantRegler - $item['Montant'];

                        $this->Factures->save($fact);
                    }

                    $this->Lignereglements->delete($item);
                }
                $lignes2 = $this->Piecereglements->find()->where(["Piecereglements.reglement_id =" . $id])->all();
                foreach ($lignes2 as $item) {
                    $this->Piecereglements->delete($item);
                }
                if (isset($this->request->getData('data')['Lignereglement']) && (!empty($this->request->getData('data')['Lignereglement']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['Lignereglement'] as $i => $l) {
                        if (isset($l['facture_id'])) {



                            $ta = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $ta['reglement_id'] = $id;
                            $ta['facture_id'] = $l['facture_id'];
                            $ta['Montant'] = $l['Montanttt'];
                            $mtg = $this->Factures->find()->select(["mtreg" =>
                            'Factures.Montant_Regler'])->where(['Factures.id =' . $l['facture_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factures->get($l['facture_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Factures->save($fact);


                            $this->fetchTable('Lignereglements')->save($ta);
                        }
                    }
                }

                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    // debug($this->request->getData('data')['pieceregelemnt']);die;
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglements')->newEmptyEntity();
                            $tab['reglement_id'] = $id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = $p['montant'];
                            $tab['to_id'] = $p['taux'];
                            $tab['montant_net'] = $p['montantnet'];
                            $tab['echance'] = $p['echance'];
                            $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                            $tab['num'] = $p['num_piece'];
                            $tab['caisse_id'] = $p['caisse_id'];
                            $tab['compte_id'] = $p['compte_id'];

                            if ($p['compte_id'] != null) {
                                $compte = $this->fetchTable('Comptes')->find()->where('Comptes.id=' . $p['compte_id'])->first();
                                $tab['banque_id'] = $compte->banque_id;
                            }

                            if (isset($p['piecejointe']) && $p['piecejointe'] !== null) {
                                $name = $p['piecejointe']->getClientFilename();
                                $targetPath = WWW_ROOT . 'img' . DS . 'reglement' . DS . $name;
                                if ($name) {
                                    $p['piecejointe']->moveTo($targetPath);
                                    $tab['piecejointe'] = $name;
                                }
                            }
                            // debug($tab);die;
                            $this->fetchTable('Piecereglements')->save($tab);
                            //$piecereglement = $this->fetchTable('Piecereglements')->newEmptyEntity();



                            // $piecereglement = $this->fetchTable('Piecereglements')->patchEntity($piecereglement, $tab);
                            // debug($lignecommande);

                        }
                    }
                }

                //  $this->Flash->success(__('The reglement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The reglement could not be saved. Please, try again.'));
        }
        $four = $reglement->fournisseur_id;
        $p = $reglement->pointdevente_id;
        $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id]);

        $piecereglements = $this->Piecereglements->find('all')->where(['Piecereglements.reglement_id =' . $id]);
        $mtbon = 0.000;
        $mtfact = 0.000;
        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['facture_id'] != null) {
                $facreg[$ligne['facture_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else {
                $facreg[$ligne['livraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
            // debug($ligne);die;
        }
        $factures = [];
        if ($four != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where('Factures.fournisseur_id =' . $four);
            // $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four,'Factures.valide=1']);

            $livraisons = $this->Livraisons->find('all')->where('Livraisons.fournisseur_id =' . $four);
        }
        // if ($four != null && $p == null) {
        //     $this->loadModel('Factures');
        //     $this->loadModel('Livraisons');
        //     $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four/*,'Factures.pointdevente_id'=>$p*/]);
        //     $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four/*,'Livraisons.pointdevente_id'=>$p*/]);
        // }
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {
                if ($art->banque_id != null) {
                    $bnq = $this->fetchTable('Banques')->find()
                        ->select(['name'])
                        ->where(['id' => $art->banque_id])
                        ->first();
                } else {
                    $bnq = '';
                }

                return $bnq->name . ' - ' . $art->rib;
            }
        ]);

        $this->set(compact('comptes', 'banques', 'caisses', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglements', 'lignesreg', 'pointdeventes', 'valeurs', 'carnetcheques', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Reglement id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {

        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

        // $reglement = 0;
        // foreach ($lien_commercialmenus as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementcommercial') {
        //         $reglement = $liens['supp'];
        //     }
        // }
        // if (($reglement <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }

        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');
        $this->request->allowMethod(['post', 'delete']);
        $lignes = $this->Lignereglements->find()->where(["reglement_id" => $id])->all();
        foreach ($lignes as $item) {
            // debug($item);die;
            if ($item['facture_id'] != null) {
                $mtg = $this->Factures->find()->select(["mtreg" =>
                'Factures.Montant_Regler'])->where(['Factures.id =' . $item['facture_id']])->first();
                $MontantRegler = $mtg->mtreg;
                $fact = $this->Factures->get($item['facture_id']);
                $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                $this->Factures->save($fact);
            }
            if ($item['livraison_id'] != null) {
                $mtg = $this->Livraisons->find()->select(["mtreg" =>
                'Livraisons.Montant_Regler'])->where(['Livraisons.id =' . $item['livraison_id']])->first();
                $MontantRegler = $mtg->mtreg;
                $fact = $this->Livraisons->get($item['livraison_id']);
                $fact->Montant_Regler = $MontantRegler - $item['Montant'];
                $this->Livraisons->save($fact);
            }

            $this->Lignereglements->delete($item);
        }

        $lignes2 = $this->Piecereglements->find()->where(["Piecereglements.reglement_id=" . $id])->all();
        foreach ($lignes2 as $pi) {
            $this->Piecereglements->delete($pi);
        }
        $reglement = $this->Reglements->get($id);
        if ($this->Reglements->delete($reglement)) {
            //  $this->Flash->success(__('The reglement has been deleted.'));
        } else {
            // $this->Flash->error(__('The reglement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function indexcheque()
    {


        $this->loadModel('Fournisseurs');
        $this->loadModel('Comptes');


        $date1 = $this->request->getQuery('date1');
        $date2 = $this->request->getQuery('date2');
        $fournisseur = $this->request->getQuery('fournisseur');
        $compte = $this->request->getQuery('compte');
        $etat_id = $this->request->getQuery('etat_id');


        if ($fournisseur) {
            $cond3 = "Etatchequeexcels.fournisseur_name like  '%" . $fournisseur . "%' ";
        }
        if ($compte) {
            $cond4 = "Etatchequeexcels.compte_numero like  '%" . $compte . "%' ";
        }

        if ($etat_id) {
            $et = intval($etat_id) - 1;
            $cond5 = "Etatchequeexcels.etat =  '" . $et . "' ";
        }


        if ($date1) {
            $cond1 = "Etatchequeexcels.echeance >='" . $date1 . "'";
        }
        if ($date2) {
            $cond2 = "Etatchequeexcels.echeance <=  '" . $date2 . "' ";
        }
        // if ($client_id) {
        //     $cond3 = "Reglementclients.client_id =  '" . $client_id . "' ";
        //     $cond33 = "Coffre.client_id='" . $client_id . "'";
        // }



        $listcheques = array();
        $listcheques = $this->fetchTable('Etatchequeexcels')->find()->where([@$cond1, @$cond2, @$cond3, @$cond4, @$cond5])->order(['Etatchequeexcels.echeance' => 'ASC']);

        // $comptes = $this->fetchTable('Comptes')->find('all');
        // $etats = $this->fetchTable('Etats')->find('all', array('conditions' => array('Etats.type' => 0)));



        // $clients = $this->fetchTable('Clients')->find('all');
        // $caisses = $this->fetchTable('Caisses')->find('list');

        $this->set(compact('etat_id', 'fournisseur', 'compte', 'listcheques', 'caisses', 'date1', 'date2', 'client_id', 'coffres', 'clients', 'comptes', 'cheques', 'traitecredits', 'piecereglementcheques', 'piecereglementtraites', 'etats'));
    }
    public function indextraite()
    {


        $this->loadModel('Fournisseurs');
        $this->loadModel('Comptes');


        $date1 = $this->request->getQuery('date1');
        $date2 = $this->request->getQuery('date2');
        $fournisseur = $this->request->getQuery('fournisseur');
        $compte = $this->request->getQuery('compte');
        $etat_id = $this->request->getQuery('etat_id');

        if ($fournisseur) {
            $cond3 = "Etattraiteexcels.fournisseur_name like  '%" . $fournisseur . "%' ";
        }
        // if ($compte) {
        //     $cond4 = "Etattraiteexcels.compte_numero like  '%" . $compte . "%' ";
        // }

        if ($etat_id) {
            $et = intval($etat_id) - 1;
            $cond5 = "Etattraiteexcels.etat =  '" . $et . "' ";
        }
        if ($date1) {
            $cond1 = "Etattraiteexcels.echeance >='" . $date1 . "'";
        }
        if ($date2) {
            $cond2 = "Etattraiteexcels.echeance <=  '" . $date2 . "' ";
        }
        // if ($client_id) {
        //     $cond3 = "Reglementclients.client_id =  '" . $client_id . "' ";
        //     $cond33 = "Coffre.client_id='" . $client_id . "'";
        // }



        $listtraites = array();
        $listtraites = $this->fetchTable('Etattraiteexcels')->find()->where([@$cond1, @$cond2, @$cond3, @$cond5])->order(['Etattraiteexcels.echeance' => 'ASC']);

        // $comptes = $this->fetchTable('Comptes')->find('all');
        // $etats = $this->fetchTable('Etats')->find('all', array('conditions' => array('Etats.type' => 0)));



        // $clients = $this->fetchTable('Clients')->find('all');
        // $caisses = $this->fetchTable('Caisses')->find('list');

        $this->set(compact('fournisseur', 'compte', 'listtraites', 'caisses', 'date1', 'date2', 'etat_id', 'client_id', 'coffres', 'clients', 'comptes', 'cheques', 'traitecredits', 'piecereglementcheques', 'piecereglementtraites', 'etats'));
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

        $date1 = $this->request->getQuery('date1');
        $date2 = $this->request->getQuery('date2');
        $client_id = $this->request->getQuery('client_id');
        $etat_id = $this->request->getQuery('etat_id');
        $caisse_id = $this->request->getQuery('caisse_id');

        if ($caisse_id) {
            $condcaisse = "Piecereglementclients.caisse_id =  '" . $caisse_id . "' ";
        }

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
        $piecereglementcheques = $this->fetchTable('Piecereglementclients')->find('all', ['contain' => ['Banques', 'Caisses', 'Reglementclients' => ['Clients']]])->where(['Piecereglementclients.paiement_id' => 2, $cond3, @$cond1, @$cond2, @$cond4, @$cond5, @$condcaisse])->order(['Piecereglementclients.echance' => 'ASC']);
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
        $caisses = $this->fetchTable('Caisses')->find('list');

        //debug($piecereglementcheques->toArray());die;
        $this->set(compact('caisses', 'date1', 'date2', 'etat_id', 'client_id', 'coffres', 'clients', 'comptes', 'cheques', 'traitecredits', 'piecereglementcheques', 'piecereglementtraites', 'etats'));
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

    public function recapscomptetraite()
    {
        //$this->layout = 'defaultpop'; 
        //$this->layout = 'defaulltop2'; 
        $this->loadModel("Piecereglementclients");
        $this->loadModel("Etats");
        $this->loadModel("Comptes");
        // $this->loadModel("Lignebordereauescomptes");       
        // $this->loadModel("Lignebordereauversementtraites");

        $id = $this->request->getQuery('id');

        $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $id)))->first();
        $comptes = $this->Comptes->find('list');

        //  $lignebordereauescomptes= $this->Lignebordereauescomptes->find('all',array('conditions'=>array('Lignebordereauescomptes.piecereglementclient_id'=>$id)))->first();
        //  $lignebordereauversementtraites= $this->Lignebordereauversementtraites->find('all',array('conditions'=>array('Lignebordereauversementtraites.piecereglementclient_id'=>$id)))->first();
        //  if($lignebordereauescomptes || $lignebordereauversementtraites)
        //  {
        //          $etatsf=$this->Etats->find('all',array('conditions'=>array('Etats.type'=>1,'Etats.id !=1','Etats.id !=10')));
        //              $test=1;

        //  }
        //  else
        //  {
        $etatsf = $this->Etats->find('all', array('conditions' => array('Etats.type' => 1, 'Etats.id' => 1)));
        $test = 0;
        // }
        $etats['En attente'] = 'En attente';
        foreach ($etatsf as $e) {
            $etats[$e['id']] = $e['name'];
        }
        //debug($piecereglementcheques);die;
        $this->set(compact('piecereglementcheques', 'etats', 'comptes', 'test'));
    }
    public function recapscomptecheque()
    {
        //$this->layout = 'defaulltop2';       
        $this->loadModel("Piecereglementclients");
        $this->loadModel("Etats");
        $this->loadModel("Comptes");
        // $this->loadModel("Lignebordereaucessioncreances");
        // $this->loadModel("Lignebordereauversementcheques");

        $id = $this->request->getQuery('id');
        $type = $this->request->getQuery('type');
        $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $id)))->first();

        // $lignebordereaucessioncreances = $this->Lignebordereaucessioncreances->find('all', array('conditions' => array('Lignebordereaucessioncreances.piecereglementclient_id' => $id)))->first();
        // $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.piecereglementclient_id' => $id)))->first();
        // if ($lignebordereaucessioncreances || $lignebordereauversementcheques) {
        //     $etatsf = $this->Etats->find('all', array('conditions' => array('Etats.type' => 0, 'Etats.id !=4', 'Etats.id !=9')));
        //     $test = 1;
        // } else {
        $etatsf = $this->Etats->find('all', array('conditions' => array('Etats.type' => 0)));
        $test = 0;

        // }
        $test = 0;
        $etats['En attente'] = 'En attente';
        foreach ($etatsf as $e) {
            $etats[$e['id']] = $e['name'];
        }
        $comptes = $this->fetchTable('Comptes')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {
                if ($art->banque_id != null) {
                    $bnq = $this->fetchTable('Banques')->find()
                        ->select(['name'])
                        ->where(['id' => $art->banque_id])
                        ->first();
                } else {
                    $bnq = '';
                }

                return $bnq->name . ' - ' . $art->rib;
            }
        ]);


        $this->set(compact('piecereglementcheques', 'etats', 'comptes', 'test'));
    }


    public function imprimstb($id = null)
    {
        // $this->viewBuilder()->setLayout('');
        $this->loadModel('Piecereglements');

        $pieces = $this->Piecereglements->get($id);
        $reglement = $this->fetchTable('Reglements')->find()->where('Reglements.id=' . $pieces->reglement_id)->first();
        $fournisseur = [];
        if ($reglement->fournisseur_id != null) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find()->where('Fournisseurs.id=' . $reglement->fournisseur_id)->first();
        }

        $this->set(compact('pieces', 'reglement', 'fournisseur'));
    }

    public function imprimvir($id = null)
    {
        $this->loadModel('Piecereglements');

        $pieces = $this->Piecereglements->get($id);
        $reglement = $this->fetchTable('Reglements')->find()->where('Reglements.id=' . $pieces->reglement_id)->first();
        $this->set(compact('pieces', 'reglement'));
    }

    public function imprimtr($id = null)
    {

        $this->loadModel('Piecereglements');
        $pieces = $this->Piecereglements->get($id);
        $banque = [];
        if ($pieces->banque_id != null) {
            $banque = $this->fetchTable('Banques')->find()->where('Banques.id=' . $pieces->banque_id)->first();
        }
        if ($pieces->compte_id != null) {
            $compte = $this->fetchTable('Comptes')->find()->where('Comptes.id=' . $pieces->compte_id)->first();
        }
        $societe = $this->fetchTable('Societes')->find()->where('Societes.id=1')->first();

        $reglement = $this->fetchTable('Reglements')->find()->where('Reglements.id=' . $pieces->reglement_id)->first();
        $fournisseur = [];
        if ($reglement->fournisseur_id != null) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find()->where('Fournisseurs.id=' . $reglement->fournisseur_id)->first();
        }

        $this->set(compact('pieces', 'reglement', 'fournisseur', 'societe', 'banque', 'compte'));
    }

    public function modepaie($id = null)
    {
        $this->viewBuilder()->setLayout('def');
        $this->loadModel('Piecereglements');

        $pieces = $this->Piecereglements->find()->where(['Piecereglements.reglement_id' => $id])->contain(['Paiements'])->all();
        $this->set(compact('pieces'));
    }

    public function imprimret($id = null)
    {
        $this->viewBuilder()->setLayout('');
        $this->loadModel('Piecereglements');

        $pieces = $this->Piecereglements->get($id);
        $this->set(compact('pieces'));
    }
}
