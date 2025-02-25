<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;


/**
 * Reglements Controller
 *
 * @property \App\Model\Table\ReglementsTable $Reglements
 * @method \App\Model\Entity\Reglement[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ReglementsController extends AppController
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
        $query = $this->Reglements->find('all')->where([$cond1, $cond2, $cond3, $cond4])->order(["Reglements.id" => 'desc'])->contain('Fournisseurs');

        //debug($query);
        $cmd = $this->paginate($query);

        $reglements = $this->paginate($this->Reglements);
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $this->set(compact('reglements', 'pointdeventes', 'fournisseurs', 'cmd'));
    }

    public function indexeng()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Comptes');
        $this->loadModel('Etatpieceregelemnts');
        $this->loadModel('Etats');

        if ($this->request->getQuery()) {

            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';

            $modeid = $this->request->getQuery('paiement_id');
            if (!empty($modeid)) {

                $cond1 = 'Piecereglements.paiement_id =' . $modeid;
            }
            // debug($modeid);

            $fournisseurid = $this->request->getQuery('fournisseur_id');
            if (!empty($fournisseurid)) {
                //$conditions2['Reglementachats.fournisseur_id'] = $fournisseurid;
                $cond2 = 'Reglements.fournisseur_id =' . $fournisseurid;
            }

            $compteid = $this->request->getQuery('compte_id');
            if (!empty($compteid)) {
                $cond3 = 'Piecereglements.compte_id =' . $compteid;
            }

            $echance = $this->request->getQuery('echance');
            // debug($echance);

            if (!empty($echance)) {
                //$conditions1['Piecereglementachats.echance'] = $echance;
                $cond4 = 'date(Piecereglements.echance) >=  ' . "'" . $echance . "'";
            }


            $datereg = $this->request->getQuery('date');
            if (!empty($datereg)) {
                $cond5 = 'date(Reglements.Date) >=  ' . "'" . $datereg . "'";
            }

            $reglements = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Fournisseurs'],
            ])
                ->where([$cond2, $cond5])
                ->toArray(); // Fetch results as an array
            // debug($reglements);
            $piecereglements = $this->Piecereglements->find('all')
                ->contain(['Comptes', 'Paiements', 'Etats', 'Reglements' => ['Fournisseurs']])
                ->where([$cond1, $cond3, $cond4, $cond2, $cond5, 'Paiements.id' => '2'])
                ->toArray(); // Fetch results as an array
            // debug($piecereglements);


        }

        $etatpieceregelemntt = $this->fetchTable('Etatpieceregelemnts')->newEmptyEntity();
        //debug($this->request->getData());

        if ($this->request->is('post')) {
            //  debug($etatpieceregelemntt);
            $etatpieceregelemnt = $this->fetchTable('Etatpieceregelemnts')->patchEntity($etatpieceregelemntt, $this->request->getData());

            //// mise ajour solde compte
            $compte = $this->Comptes->get($etatpieceregelemnt['compte_id'], [
                'contain' => []
            ]);


            $pv = $etatpieceregelemnt['montant'];

            // $compte->montant = $pv;
            $compte->montant += $pv;
            $this->fetchTable('Comptes')->save($compte);

            //// mise ajour etat piece
            $piece = $this->Piecereglements->get($etatpieceregelemnt['piecereglement_id'], [
                'contain' => []
            ]);


            $pv = $etatpieceregelemnt['etat_id'];
            // debug()
            $piece->etat_id = $pv;
            // debug( $pvs);
            $this->fetchTable('Piecereglements')->save($piece);


            if ($this->fetchTable('Etatpieceregelemnts')->save($etatpieceregelemnt)) {
                //   debug($etatpieceregelemnt);
                //  $this->Flash->success(__('The data has been saved.'));
                return $this->redirect(['action' => 'indexeng']);
                // } else {
                //$this->Flash->error(__('The data could not be saved. Please, try again.'));
            }

            // Redirect to a suitable page after the save
            // return $this->redirect(['action' => 'indexeng']);
        }


        $reglements = $this->fetchTable('Reglements')->find('all', [
            'contain' => ['Fournisseurs'],
        ])
            // ->where([$cond2, $cond5])
            ->toArray(); // Fetch results as an array
        // debug($reglements);
        $piecereglements = $this->fetchTable('Piecereglements')->find('all')
            ->contain(['Comptes', 'Paiements', 'Etats', 'Reglements' => ['Fournisseurs']])
            ->where(['Paiements.id' => '2'])
            ->toArray();
        $count = count($piecereglements);  // Utilisation de count() pour compter les résultats

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero'])->contain('Agences');
        // debug($comptes);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //$etatss = $this->fetchTable('Etatpieceregelemnts')->find('list');
        //debug($etatss->toArray());
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //   $modes = $this->fetchTable('Modepaiements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => '2']);

        $this->set(compact('reglements', 'etatpiecereglement', 'count', 'agences', 'piecereglements', 'etats', 'combinedData', 'comptes', 'modes', 'fournisseurs', 'echance', 'modeid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
    }


    public function imprimereng()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Paiements');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Comptes');
        $this->loadModel('Etatpieceregelemnts');
        $this->loadModel('Etats');

        if ($this->request->getQuery()) {

            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';

            $modeid = $this->request->getQuery('paiement_id');
            if (!empty($modeid)) {

                $cond1 = 'Piecereglements.paiement_id =' . $modeid;
            }
            // debug($modeid);

            $fournisseurid = $this->request->getQuery('fournisseur_id');
            if (!empty($fournisseurid)) {
                //$conditions2['Reglementachats.fournisseur_id'] = $fournisseurid;
                $cond2 = 'Reglements.fournisseur_id =' . $fournisseurid;
            }

            $compteid = $this->request->getQuery('compte_id');
            if (!empty($compteid)) {
                $cond3 = 'Piecereglements.compte_id =' . $compteid;
            }

            $echance = $this->request->getQuery('echance');
            // debug($echance);

            if (!empty($echance)) {
                //$conditions1['Piecereglementachats.echance'] = $echance;
                $cond4 = 'date(Piecereglements.echance) >=  ' . "'" . $echance . "'";
            }


            $datereg = $this->request->getQuery('date');
            if (!empty($datereg)) {
                $cond5 = 'date(Reglements.Date) >=  ' . "'" . $datereg . "'";
            }

            $reglements = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Fournisseurs'],
            ])
                ->where([$cond2, $cond5])
                ->toArray(); // Fetch results as an array
            // debug($reglements);
            $piecereglements = $this->Piecereglements->find('all')
                ->contain(['Comptes', 'Paiements', 'Etats', 'Reglements' => ['Fournisseurs']])
                ->where([$cond1, $cond3, $cond4, $cond2, $cond5, 'Paiements.id' => '2'])
                ->toArray(); // Fetch results as an array
            // debug($piecereglements);


        }


        $piecereglements = $this->fetchTable('Piecereglements')->find('all')
            ->contain(['Comptes', 'Paiements', 'Etats', 'Reglements' => ['Fournisseurs']])
            ->where(['Paiements.id' => '2'])
            ->toArray();

        $comptes = $this->fetchTable('Comptes')->find('list', ['keyField' => 'id', 'valueField' => 'numero'])->contain('Agences');
        // debug($comptes);
        $etats = $this->fetchTable('Etats')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //$etatss = $this->fetchTable('Etatpieceregelemnts')->find('list');
        //debug($etatss->toArray());
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        //   $modes = $this->fetchTable('Modepaiements')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $agences = $this->fetchTable('Agences')->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $modes = $this->fetchTable('Paiements')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->where(['Paiements.id' => '2']);

        $this->set(compact('reglements', 'etatpiecereglement', 'count', 'agences', 'piecereglements', 'etats', 'combinedData', 'comptes', 'modes', 'fournisseurs', 'echance', 'modeid', 'compteid', 'modes', 'datereg', 'fournisseurid'));
    }
    public function modepaie($id = null)
    {
        $this->viewBuilder()->setLayout('def');
        $this->loadModel('Piecereglements');

        $pieces = $this->Piecereglements->find()->where(['Piecereglements.reglement_id' => $id])->contain(['Paiements'])->all();
        $this->set(compact('pieces'));
    }

    public function imprimstb($id = null)
    {
        // $this->viewBuilder()->setLayout('');
        $this->loadModel('Piecereglements');

        $pieces = $this->Piecereglements->get($id);
        $reglement = $this->fetchTable('Reglements')->find()->where('Reglements.id=' . $pieces->reglement_id)->first();
        $fournisseur = [];
        if ($reglement->fournisseur_id != null) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find('all')->where('Fournisseurs.id=' . $reglement->fournisseur_id)->first();
            //  debug
        }

        $this->set(compact('pieces', 'reglement', 'fournisseur'));
    }
    public function imprimret($id = NULL)
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_vente' . $abrv);
        // //   debug($liendd);
        // $com1 = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'reglementclients') {
        //         $com1 = $liens['imprimer'];
        //     }
        // }
        // // debug($com1);die;
        // if (($com1 <> 1)) {    
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));            
        // }                  
        $this->loadModel('Piecereglements');
        $this->loadModel('Fournisseurs');
        $pieces = $this->Piecereglements->get($id);
        $reglement = $this->fetchTable('Reglements')->get($pieces->reglement_id);
        // debug( $pieces->to_id);die;
        $societe = $this->fetchTable('Societes')->find('all')->first();
        $fournisseur = $this->fetchTable('Fournisseurs')->find()->where('Fournisseurs.id=' . $reglement->fournisseur_id)->first();
        //    var_dump($fournisseur->adresse);
        $ligne = $this->fetchTable('Lignereglements')->find('all')->where('Lignereglements.reglement_id=' . $reglement->id)->contain('Factures')->first();
        $lignep = $this->fetchTable('Piecereglements')->find('all')->where('Piecereglements.reglement_id=' . $reglement->id)->first();
        ///  var_dump($lignep->echance);
        $this->set(compact('pieces', 'societe', 'fournisseur', 'reglement', 'ligne', 'lignep'));
    }
    public function imprimeview($id = null)
    {

        error_reporting(E_ERROR | E_PARSE);

        // debug($id);die;
        $this->loadModel('Factures');
        $this->loadModel('Factureavoirfrs');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');

        $reglement = $this->Reglements->get($id, [
            'contain' => ['Fournisseurs'],
        ]);

        $cli = $reglement->fournisseur_id;


        $lignesreg = $this->Lignereglements->find('all', [
            'contain' => ['Factures', 'Livraisons'],
        ])->where(['Lignereglements.reglement_id =' . $id]);
        //debug(($lignesreg->toArray())) ;die;

        $l = '(0';
        $lb = '(0';
        $la = '(0';
        foreach ($lignesreg as  $li) {


            if ($li['facture_id'] != 0) {
                $l = $l . ',' . $li['facture_id'];
            } else if ($li['livraison_id'] != 0) {
                $lb = $lb . ',' . $li['livraison_id'];
            } else if ($li['factureavoirfr_id'] != 0) {
                $la = $la . ',' . $li['factureavoirfr_id'];
            }
        }
        $l = $l . ',0)';
        $lb = $lb . ',0)';
        $la = $la . ',0)';





        $piecereglements = $this->Piecereglements->find('all', [
            'contain' => ['Paiements', 'Carnetcheques', 'Cheques', 'Comptes', 'Banques'],
        ])->where(['Piecereglements.reglement_id =' . $id, 'Piecereglements.paiement_id NOT IN' => [6, 7, 8, 9]]);
        //debug($piecereglementclients->toarray());
        $mtbon = 0.000;
        $mtfact = 0.000;




        foreach ($lignesreg as $k => $ligne) {
            if ($ligne['facture_id'] != null) {
                $facreg[$ligne['facture_id']] = 1;
                $mtfact = $mtfact + $ligne['Montant'];
            } else if ($ligne['factureavoirfr_id'] != null) {
                $facreg[$ligne['factureavoirfr_id']] = 1;
                $mtfact = $mtfact - $ligne['Montant'];
            } else {
                $facreg[$ligne['livraison_id']] = 1;
                $mtbon = $mtbon + $ligne['Montant'];
            }
        }

        if ($cli != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');

            $connection = ConnectionManager::get('default');

            // $factures = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $cli , 'Factureclients.totalttc > Factureclients.Montant_Regler']);
            $factures = $connection->execute("select * from factures where (factures.fournisseur_id=" . $cli . " ) and (( factures.ttc > factures.Montant_Regler) OR (factures.id in" . $l . "));");
            $factureavoirfrs = $connection->execute("select * from factureavoirfrs where (factureavoirfrs.fournisseur_id=" . $cli . ") and (factureavoirfrs.id in" . $la . ");")->fetchAll('assoc');

            $livraisons = $connection->execute("select * from livraisons where (livraisons.fournisseur_id=" . $cli . " and livraisons.typelivraison=1 and livraisons.ttc > livraisons.Montant_Regler) OR (livraisons.id in" . $lb . ");")->fetchAll('assoc');
            // debug($factures);
        }


        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])->where(['Paiements.id not in (6,7,8,9)'])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $cha = "TRUE";
        $clients = $this->Reglements->Fournisseurs->find('all');
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->loadModel('Banques');
        $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $facturesav = $this->fetchTable('Factureavoirfrs')->find('all');


        $this->set(compact('factureavoirfrs', 'timbre', 'banques', 's', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglements', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients', 'facturesav'));
    }
    // public function imprimeview($type = null, $id = null)
    // {

    //     error_reporting(E_ERROR | E_PARSE);

    //    // debug($id);die;
    //     $this->loadModel('Factures');
    //     $this->loadModel('Factureavoirfrs');
    //     // $this->loadModel('Livraisons');
    //     $this->loadModel('Lignereglements');
    //     $this->loadModel('Piecereglements');

    //     $reglement = $this->Reglements->get($id, [
    //         'contain' => ['Fournisseurs'],
    //     ]);

    //     $cli = $reglement->fournisseur_id;


    //     $lignesreg = $this->Lignereglements->find('all', [
    //         'contain' => ['Factures'],
    //     ])->where(['Lignereglements.reglement_id =' . $id]);
    //     //debug(($lignesreg->toArray())) ;die;

    //     $l = '(0';
    //     $lb = '(0';
    //     $la = '(0';
    //     foreach ($lignesreg as  $li) {


    //         if ($li['facture_id'] != 0) {
    //             $l = $l . ',' . $li['facture_id'];

    //         } else if ($li['factureavoirfr_id'] != 0) {
    //             $la = $la . ',' . $li['factureavoirfr_id'];
    //         }
    //     }
    //     $l = $l . ',0)';
    //     $lb = $lb . ',0)';
    //     $la = $la . ',0)';





    //     $piecereglements = $this->Piecereglements->find('all', [
    //         'contain' => ['Paiements','Banques'],
    //     ])->where(['Piecereglements.reglement_id =' . $id]);
    //     //debug($piecereglementclients->toarray());
    //     $mtbon = 0.000;
    //     $mtfact = 0.000;




    //     foreach ($lignesreg as $k => $ligne) {
    //         if ($ligne['facture_id'] != null) {
    //             $facreg[$ligne['facture_id']] = 1;
    //             $mtfact = $mtfact + $ligne['Montant'];
    //         } else if ($ligne['factureavoirfr_id'] != null) {
    //             $facreg[$ligne['factureavoirfr_id']] = 1;
    //             $mtfact = $mtfact - $ligne['Montant'];
    //         } else{

    //         }

    //     }

    //     if ($cli != null) {
    //         $this->loadModel('Factures');
    //         $this->loadModel('Bonlivraisons');

    //         $connection = ConnectionManager::get('default');

    //         // $factures = $this->Factureclients->find('all')->where(['Factureclients.client_id =' . $cli , 'Factureclients.totalttc > Factureclients.Montant_Regler']);
    //         $factures = $connection->execute("select * from factures where (factures.fournisseur_id=" . $cli . " ) and (( factures.ttc > factures.Montant_Regler) OR (factures.id in" . $l . "));");
    //         $factureavoirs = $connection->execute("select * from factureavoirfrs where (factureavoirfrs.fournisseur_id=" . $cli . ") and ((factureavoirfrs.totalttc > factureavoirfrs.montant_regle) OR (factureavoirfrs.id in" . $la . "));")->fetchAll('assoc');

    //         // debug($factures);
    //     }


    //     $this->loadModel('Tos');
    //     $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
    //     $this->loadModel('Paiements');
    //     $paiements = $this->Paiements->find('list', ['limit' => 200])->where(['Paiements.id not in (6,7)'])->all();
    //     $this->loadModel('Carnetcheques');
    //     $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
    //     $cha = "TRUE";
    //     $clients = $this->Reglements->Clients->find('all');
    //     $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
    //     'MAX(Timbres.timbre)'])->first();
    //     $timbre = $tim->timbre;
    //     $this->loadModel('Banques');
    //     $banques = $this->Banques->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

    //     $facturesav = $this->fetchTable('Factureavoirfrs')->find('all');


    //     $this->set(compact('factureavoirs', 'timbre', 'banques', 'type', 's', 'id', 'mtfact', 'mtbon', 'facreg', 'piecereglementclients', 'lignesreg', 'valeurs', 'carnetcheques', 'paiements', 'cli', 'livraisons', 'factures', 'reglement', 'clients', 'facturesav'));
    // }

    public function imprimretdalanda($id = null)
    {
        //$this->viewBuilder()->setLayout('');
        $this->loadModel('Piecereglements');
        $societes = $this->fetchTable('Societes')->find('all', ['keyfield' => 'id', 'valueField' => 'codetva'])->first();
        // var_dump($societes->codetva);
        $pieces = $this->Piecereglements->get($id);
        $this->set(compact('pieces', 'societes'));
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
            $fournisseur = $this->fetchTable('Clients')->find()->where('Clients.id=' . $reglement->fournisseur_id)->first();
        }

        $this->set(compact('pieces', 'reglement', 'fournisseur', 'societe', 'banque', 'compte'));
    }

    public function imprimvir($id = null)
    {
        $this->loadModel('Piecereglements');

        $pieces = $this->Piecereglements->get($id);
        $reglement = $this->fetchTable('Reglements')->find()->where('Reglements.id=' . $pieces->reglement_id)->first();
        $this->set(compact('pieces', 'reglement'));
    }
    /**
     * View method
     *
     * @param string|null $id Reglement id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view21062024($id = null)
    {
        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');
        $reglement = $this->Reglements->get($id, [
            'contain' => ['Fournisseurs', 'Importations', 'Utilisateurs', 'Exercices', 'Devises', 'Lignereglements', 'Piecereglements'],
        ]);
        $four = $reglement->fournisseur_id;
        $p = $reglement->pointdevente_id;
        $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id]);

        $piecereglements = $this->Piecereglements->find('all')->where(['Piecereglements.reglement_id =' . $id]);
        // debug($piecereglements->toarray());
        // die;

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
            //  debug($ligne);die;
        }

        if ($four != null && $p != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four /*, 'Factures.pointdevente_id =' . $p*/]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four /*, 'Livraisons.pointdevente_id =' . $p*/]);
        }
        if ($four != null && $p == null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four/*,'Factures.pointdevente_id'=>$p*/]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four/*,'Livraisons.pointdevente_id'=>$p*/]);
        }
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])
            ->where(['Paiements.id NOT IN' => [6, 7, 8, 9]])
            ->all();
        //    $this->loadModel('Carnetcheques');
        //    $carnetcheques= $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        // $this->set(compact('reglement'));
        $carnetcheques = $this->fetchTable('Carnetcheques')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);

        $cheques = $this->fetchTable('Cheques')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $this->set(compact('mtfact', 'mtbon', 'comptes', 'cheques', 'banques', 'facreg', 'piecereglements', 'carnetcheques', 'lignesreg', 'pointdeventes', 'valeurs', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    public function view($id = null)
    {



        $this->loadModel('Factures');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignereglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Fournisseurs');

        $reglement = $this->Reglements->get($id, [
            'contain' => [],
        ]);
        $idd = $id;


        $four = $reglement->fournisseur_id;
        $p = $reglement->pointdevente_id;
        // $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id]);
        $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id]);

        $l = '(0';
        $lb = '(0';
        $la = '(0';
        foreach ($lignesreg as  $li) {


            if ($li['facture_id'] != 0) {
                $l = $l . ',' . $li['facture_id'];
            } else if ($li['livraison_id'] != 0) {
                $lb = $lb . ',' . $li['livraison_id'];
            } else if ($li['factureavoir_id'] != 0) {
                $la = $la . ',' . $li['factureavoir_id'];
            }
        }
        $l = $l . ',0)';
        $lb = $lb . ',0)';
        $la = $la . ',0)';


        foreach ($lignesreg as $s => $si) {

            if ($si['facture_id'] != 0) {
                $s = $si['reglement_id'];
            } else if ($si['livraison_id'] != 0) {
                $s = $si['reglement_id'];
            }
        }
        $piecereglements = $this->Piecereglements->find('all')->where(['Piecereglements.reglement_id =' . $id, 'Piecereglements.paiement_id not in(6,7,8,9)']);
        //debug($piecereglementclients->toarray());
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
        }
        // bug($ligne);die;


        if ($four != null && $p != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $this->loadModel('Fournisseurs');


            $connection = ConnectionManager::get('default');
            $factures = $connection->execute("select * from factures where (factures.fournisseur_id=" . $four . " ) and (( factures.ttc > factures.Montant_Regler) OR (factures.id in" . $l . "));");
            $compte = $this->Fournisseurs->find('all')->where(['Fournisseurs.id =' . $four, 'Fournisseurs.soldedebut - Fournisseurs.Montant_Regler !=0'])->first();

            // $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four /*, 'Factures.pointdevente_id =' . $p*/]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four/*, 'Livraisons.pointdevente_id =' . $p*/]);
        }
        if ($four != null && $p == null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $this->loadModel('Fournisseurs');

            $connection = ConnectionManager::get('default');

            $factures = $connection->execute("select * from factures where (factures.fournisseur_id=" . $four . " ) and (( factures.ttc > factures.Montant_Regler) OR (factures.id in" . $l . "));");
            $compte = $this->Fournisseurs->find('all')->where(['Fournisseurs.id =' . $four, 'Fournisseurs.soldedebut - Fournisseurs.Montant_Regler !=0'])->first();

            //  $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four/*,'Factures.pointdevente_id'=>$p*/]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four/*,'Livraisons.pointdevente_id'=>$p*/]);
        }
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])
            ->where(['Paiements.id NOT IN' => [6, 7, 8, 9]])
            ->all();
        //    $this->loadModel('Carnetcheques');
        //    $carnetcheques= $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $carnetcheques = $this->fetchTable('Carnetcheques')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $carnetcheques = $this->fetchTable('Carnetcheques')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);

        $cheques = $this->fetchTable('Cheques')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $this->set(compact('mtfact', 'mtbon', 'idd', 'compte', 'banques', 'comptes', 'cheques', 'facreg', 'piecereglements', 'lignesreg', 'pointdeventes', 'carnetcheques', 'valeurs', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
    }
    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add($four = null, $p = null)
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

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

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
        $this->loadModel('Fournisseurs');

        $reglement = $this->Reglements->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());die;
            $data['numeroconca'] = $this->request->getData('numeroconca');
            $data['Date'] = $this->request->getData('Date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['Montant'] = $this->request->getData('data')['Reglement']['Montant'];
            $data['differance'] = $this->request->getData('differance');
            $data['dif'] = $this->request->getData('diff');
            //debug($this->request->getData());die;
            $reglement = $this->Reglements->patchEntity($reglement, $data);
            if ($this->Reglements->save($reglement)) {
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
                            // $mtg = $this->Factures->find()
                            //     ->select(["mtreg" => 'Factures.Montant_Regler'])
                            //     ->where(['Factures.id =' . $l['facture_id']])
                            //     ->first();

                            // $MontantRegler = is_numeric($mtg->mtreg) ? floatval($mtg->mtreg) : 0;

                            // // Assuming $l['ttc'] is already a numeric type; if not, convert it appropriately
                            // $ttc = is_numeric($l['ttc']) ? floatval($l['ttc']) : 0;

                            // $fact = $this->Factures->get($l['facture_id']);
                            // $fact->Montant_Regler = $MontantRegler + $ttc;
                            // $this->Factures->save($fact);
                            $mtg = $this->Factures->find()->select(["mtreg" =>
                            'Factures.Montant_Regler'])->where(['Factures.id =' . $l['facture_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factures->get($l['facture_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Factures->save($fact);



                            // $mtg = $this->Factures->find()->select(["mtreg" =>
                            // 'Factures.Montant_Regler'])->where(['Factures.id =' . $l['facture_id']])->first();
                            // $MontantRegler = $mtg->mtreg;
                            // $fact = $this->Factures->get($l['facture_id']);
                            // $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            // $this->Factures->save($fact);




                            // $lignereglement = $this->fetchTable('Lignereglements')->patchEntity($lignereglement, $tab);
                            //  debug($ta);
                            $this->fetchTable('Lignereglements')->save($ta);
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $tabb['reglement_id'] = $reglement_id;
                            $tabb['livraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['Montanttt'];
                            // $tabb['facture_id']=0;
                            //   debug($tabb);die;
                            // Retourne l'article avec l'id 12
                            $mtg = $this->Livraisons->find()->select(["mtreg" =>
                            'Livraisons.Montant_Regler'])->where(['Livraisons.id =' . $l['bonreception_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Livraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Livraisons->save($fact);

                            $this->fetchTable('Lignereglements')->save($tabb);



                            //$lignereglement = $this->fetchTable('Lignereglements')->patchEntity($lignereglement,$tabb);
                            //  debug($lignereglement);die;

                        }
                        if (isset($l['fournisseur_id'])) {
                            $tabbs = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $tabbs['reglement_id'] = $reglement_id;
                            $tabbs['fournisseur_id'] = $l['fournisseur_id'];
                            $tabbs['Montant'] = $l['Montanttt'];

                            $mtg = $this->Fournisseurs->find()->select(["mtreg" =>
                            'Fournisseurs.Montant_Regler'])->where(['Fournisseurs.id =' . $l['fournisseur_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $four = $this->Fournisseurs->get($l['fournisseur_id']);
                            $four->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Fournisseurs->save($four);

                            $this->fetchTable('Lignereglements')->save($tabbs);
                        }
                    }
                }

                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglements')->newEmptyEntity();

                            // Common fields
                            $tab['reglement_id'] = $reglement_id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = $p['montant'];

                            // Specific fields based on paiement_id
                            switch ($p['paiement_id']) {
                                case 2:
                                    $tab['echance'] = $p['echance'];
                                    $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                    $tab['cheque_id'] = $p['cheque_id'];
                                    $tab['compte_id'] = $p['compte_id'];
                                    $tab['banque_id'] = $p['banque_id'];
                                    $tab['num'] = $p['num_piece'];
                                    break;
                                case 1:
                                case 7:
                                    // No additional fields for paiement_id 1 or 7
                                    break;
                                case 3:
                                case 4:
                                case 6:
                                case 8:
                                    $tab['echance'] = $p['echance'];
                                    $tab['num'] = $p['num_piece'];
                                    break;
                                case 5:
                                    $tab['to_id'] = $p['taux'];
                                    $tab['montant_brut'] = $p['montantbrut'];
                                    $tab['montant_net'] = $p['montantnet'];
                                    $tab['echance'] = $p['echance'];
                                    $tab['num'] = $p['num_piece'];
                                    break;
                            }

                            // Save the piece
                            if ($this->fetchTable('Piecereglements')->save($tab)) {
                                if (isset($p['cheque_id']) && $p['cheque_id']) {
                                    $cheque = $this->fetchTable('Cheques')->get($p['cheque_id']);
                                    $cheque->etat = 1;
                                    $this->fetchTable('Cheques')->save($cheque);
                                }
                            }
                        }
                    }
                }


                // if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                //     //  debug($this->request->getData('data')['pieceregelemnt']);die;
                //     foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                //         if (isset($p['sup']) && $p['sup'] != 1) {
                //             $tab = $this->fetchTable('Piecereglements')->newEmptyEntity();
                //             if ($p['paiement_id'] == 2) {
                //                 $tab['reglement_id'] = $reglement_id;
                //                 $tab['paiement_id'] = $p['paiement_id'];
                //                 $tab['montant'] = $p['montant'];

                //                 $tab['echance'] = $p['echance'];
                //                 $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                //                 $tab['cheque_id'] = $p['cheque_id'];
                //                 $tab['compte_id'] = $p['compte_id'];
                //                 $tab['banque_id'] = $p['banque_id'];
                //                 $tab['num'] = $p['num_piece'];
                //             } else if ($p['paiement_id'] == 1 || $p['paiement_id'] == 7) {
                //                 $tab['reglement_id'] = $reglement_id;
                //                 $tab['paiement_id'] = $p['paiement_id'];
                //                 $tab['montant'] = $p['montant'];
                //             } else if ($p['paiement_id'] == 3 || $p['paiement_id'] == 4 || $p['paiement_id'] == 6 || $p['paiement_id'] == 8) {
                //                 $tab['reglement_id'] = $reglement_id;
                //                 $tab['paiement_id'] = $p['paiement_id'];
                //                 $tab['montant'] = $p['montant'];
                //                 $tab['echance'] = $p['echance'];
                //                 $tab['num'] = $p['num_piece'];
                //             } elseif ($p['paiement_id'] == 5) {
                //                 $tab['reglement_id'] = $reglement_id;
                //                 $tab['paiement_id'] = $p['paiement_id'];
                //                 $tab['montant'] = $p['montant'];
                //                 $tab['to_id'] = $p['taux'];
                //                 $tab['montant_brut'] = $p['montantbrut'];

                //                 $tab['montant_net'] = $p['montantnet'];
                //                 $tab['echance'] = $p['echance'];

                //                 $tab['num'] = $p['num_piece'];
                //             }

                //             // debug($tab);die;
                //             // $this->fetchTable('Piecereglements')->save($tab);
                //             if ($this->fetchTable('Piecereglements')->save($tab)) {
                //                 if ($p['cheque_id']) {
                //                     $cheque = $this->fetchTable('Cheques')->get($p['cheque_id']);
                //                     // debug($article);die;
                //                     $cheque->etat = 1;
                //                     $this->fetchTable('Cheques')->save($cheque);
                //                 }
                //                 // debug($lignelivraisons);
                //             } else {
                //             }
                //             //$piecereglement = $this->fetchTable('Piecereglements')->newEmptyEntity();



                //             // $piecereglement = $this->fetchTable('Piecereglements')->patchEntity($piecereglement, $tab);
                //             // debug($lignecommande);

                //         }
                //     }
                // }
                $diff = $this->request->getData('diff');
                $difference = $this->request->getData('differance');

                if (isset($diff) && $diff == 1) {



                    if ($difference) {
                        $tabb = $this->fetchTable('Piecereglements')->newEmptyEntity();

                        $tabb['reglement_id'] = $reglement_id;
                        $tabb['montant'] = $difference;
                        $tabb['paiement_id'] = 9;
                        $this->fetchTable('Piecereglements')->save($tabb);
                    }

                    // if ($difference > 0) {
                    //     $tabb['reglement_id'] = $reglement_id;
                    //     $tabb['montant'] = $difference;
                    //     $tabb['paiement_id'] = 6;
                    // }


                    //   
                }
                //  $this->Flash->success(__('The reglement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The reglement could not be saved. Please, try again.'));
        }
        $factures = '';
        $livraisons = '';
        $compte = '';

        if ($four != null && $p != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $this->loadModel('Fournisseurs');

            $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four, 'Factures.ttc > Factures.Montant_Regler', 'Factures.pointdevente_id =' . $p]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four, 'Livraisons.ttc > Livraisons.Montant_Regler', 'Livraisons.pointdevente_id =' . $p, 'Livraisons.facture_id' => 0]);
            $compte = $this->Fournisseurs->find('all')->where(['Fournisseurs.id =' . $four, 'Fournisseurs.soldedebut - Fournisseurs.Montant_Regler !=0'])->first();
        }
        if ($four != null && $p == null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $this->loadModel('Fournisseurs');

            $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four, 'Factures.ttc > Factures.Montant_Regler'/*,'Factures.pointdevente_id'=>$p*/]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four, 'Livraisons.ttc > Livraisons.Montant_Regler'/*,'Livraisons.pointdevente_id'=>$p*/, 'Livraisons.facture_id' => 0]);
            $compte = $this->Fournisseurs->find('all')->where(['Fournisseurs.id =' . $four, 'Fournisseurs.soldedebut - Fournisseurs.Montant_Regler !=0'])->first();
        }
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
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])
            ->where(['Paiements.id NOT IN' => [6, 7, 8, 9]])
            ->all();
        //    $this->loadModel('Carnetcheques');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $carnetcheques = $this->fetchTable('Carnetcheques')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        //  $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $this->set(compact('valeurs', 'paiements', 'compte', 'livraisons', 'banques', 'factures', 'four', 'p', 'code', 'reglement', 'carnetcheques', 'pointdeventes', 'fournisseurs', 'utilisateurs', 'exercices', 'devises'));
    }
    public function getcompte()
    {
        $id = $this->request->getQuery('banque_id');
        // debug($id);
        $ind = $this->request->getQuery('ind');

        $compte = $this->fetchTable('Comptes')->find('all')->where(['Comptes.banque_id' => $id]);
        //debug($famille->toArray());
        $select1 = "<br>
        <select name='data[pieceregelemnt][" . $ind . "][compte_id]' champ='compte_id' id='compte_id" . $ind . "' class='form-control ' onchange='getcarnet(this.value,$ind)'   >
                    <option value=''  selected='selected' disabled>Veuillez choisir</option> ";
        foreach ($compte as $q) {
            //  debug($q);
            $select1 = $select1 . " <option value ='" . $q['id'] . "'";
            $select1 = $select1 . " >" . $q['numero'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select1 = $select1 . "</select> <script>  $('.select2').select2() </script> ";
        echo json_encode(array('select1' => $select1));
        die;
    }
    public function getc()
    {
        $id = $this->request->getQuery('id');
        $ind = $this->request->getQuery('ind');
        $famille = $this->fetchTable('Carnetcheques')->find('all')->where(['Carnetcheques.compte_id' => $id]);
        //debug($famille->toArray());
        $select2 = "<br>
        <select name='data[pieceregelemnt][" . $ind . "][carnetcheque_id]' champ='carnetcheque_id' id='carnetcheque_id" . $ind . "' class='form-control ' onchange='getcheque(this.value,$ind)'   >
                    <option value=''  selected='selected' disabled>Veuillez choisir</option> ";
        foreach ($famille as $q) {
            //  debug($q);
            $select2 = $select2 . " <option value ='" . $q['id'] . "'";
            $select2 = $select2 . " >" . $q['numero'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select2 = $select2 . "</select> <script>  $('.select2').select2() </script> ";
        echo json_encode(array('select2' => $select2));
        die;
    }
    public function getchequess()
    {
        $id = $this->request->getQuery('id');
        $ind = $this->request->getQuery('ind');
        $famille = $this->fetchTable('Cheques')->find('all')->where(['Cheques.carnetcheque_id' => $id, 'Cheques.etat =0']);
        //debug($famille->toArray());
        $select3 = "<br>
        <select name='data[pieceregelemnt][" . $ind . "][cheque_id]' champ='cheque_id' id='cheque_id" . $ind . "' class='form-control ' onchange='getnumcheque(this.value,$ind)'   >
                    <option value=''  selected='selected' disabled>Veuillez choisir</option> ";
        foreach ($famille as $q) {
            //  debug($q);
            $select3 = $select3 . " <option value ='" . $q['id'] . "'";
            $select3 = $select3 . " >" . $q['numero'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select3 = $select3 . "</select> <script>  $('.select2').select2() </script> ";
        echo json_encode(array('select3' => $select3));
        die;
    }


    public function getnum()
    {
        $id = $this->request->getQuery('id');
        $ind = $this->request->getQuery('ind');
        $famille = $this->fetchTable('Cheques')->find('all')->where(['Cheques.id' => $id])->first();
        $numeroc =  $famille->numero;
        echo json_encode(array('numeroc' => $numeroc));
        die;
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
        $this->loadModel('Fournisseurs');

        $reglement = $this->Reglements->get($id, [
            'contain' => [],
        ]);
        $idd = $id;

        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());die;
            $data['numeroconca'] = $this->request->getData('numeroconca');
            $data['Date'] = $this->request->getData('Date');
            $data['fournisseur_id'] = $this->request->getData('fournisseur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['Montant'] = $this->request->getData('data')['Reglement']['Montant'];

            $data['differance'] = $this->request->getData('differance');
            $data['dif'] = $this->request->getData('diff');

            $reglement = $this->Reglements->patchEntity($reglement, $data);
            if ($this->Reglements->save($reglement)) {
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
                    if ($item['fournisseur_id'] != null) {
                        $mtgg = $this->fetchTable('Fournisseurs')->find()->select(["soldedebut" =>
                        'Fournisseurs.soldedebut'])->where(['Fournisseurs.id =' . $item['fournisseur_id']])->first();
                        $solde_debut = $mtgg->soldedebut;
                        $dd = $this->fetchTable('Fournisseurs')->get($item['fournisseur_id']);
                        $dd->Montant_Regler = $dd->Montant_Regler - $item['Montant'];
                        //   debug($dd);die;
                        $this->fetchTable('Fournisseurs')->save($dd);
                        //  debug($fact);die;
                    }

                    $this->Lignereglements->delete($item);
                }
                if (isset($this->request->getData('data')['Lignereglement']) && (!empty($this->request->getData('data')['Lignereglement']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['Lignereglement'] as $i => $l) {
                        if (isset($l['facture_id'])) {
                            $ta = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $ta['reglement_id'] = $id;
                            $ta['facture_id'] = $l['facture_id'];
                            $ta['Montant'] = $l['Montanttt'];
                            // $ta['livraison_id']=0;


                            // Retourne l'article avec l'id 12
                            $mtg = $this->Factures->find()->select(["mtreg" =>
                            'Factures.Montant_Regler'])->where(['Factures.id =' . $l['facture_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factures->get($l['facture_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Factures->save($fact);




                            // $lignereglement = $this->fetchTable('Lignereglements')->patchEntity($lignereglement, $tab);
                            //  debug($ta);
                            $this->fetchTable('Lignereglements')->save($ta);
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $tabb['reglement_id'] = $id;
                            $tabb['livraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['Montanttt'];
                            // $tabb['facture_id']=0;
                            //   debug($tabb);die;
                            // $this->fetchTable('Lignereglements')->save($tabb);
                            // Retourne l'article avec l'id 12
                            $mtg = $this->Livraisons->find()->select(["mtreg" =>
                            'Livraisons.Montant_Regler'])->where(['Livraisons.id =' . $l['bonreception_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Livraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Livraisons->save($fact);

                            $this->fetchTable('Lignereglements')->save($tabb);



                            //$lignereglement = $this->fetchTable('Lignereglements')->patchEntity($lignereglement,$tabb);
                            //  debug($lignereglement);die;

                        }
                        if (isset($l['fournisseur_id'])) {
                            $tabb = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $tabb['reglement_id'] = $id;
                            $tabb['fournisseur_id'] = $l['fournisseur_id'];
                            $tabb['Montant'] = $l['Montanttt'];
                            // $tabb['facture_id']=0;
                            //   debug($tabb);die;
                            // $this->fetchTable('Lignereglements')->save($tabb);
                            // Retourne l'article avec l'id 12
                            $mtg = $this->Fournisseurs->find()->select(["mtreg" =>
                            'Fournisseurs.Montant_Regler'])->where(['Fournisseurs.id =' . $l['fournisseur_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $four = $this->Fournisseurs->get($l['fournisseur_id']);
                            $four->Montant_Regler = $MontantRegler + $l['Montanttt'];
                            $this->Fournisseurs->save($four);

                            $this->fetchTable('Lignereglements')->save($tabb);
                        }
                    }
                }
                $lignes2 = $this->Piecereglements->find()->where(["reglement_id" => $id])->all();
                foreach ($lignes2 as $item) {
                    if ($item->cheque_id) {
                        $chequesp = $this->fetchTable('Cheques')->get($item->cheque_id);
                        // debug($article);die;
                        $chequesp->etat = 0;
                        $this->fetchTable('Cheques')->save($chequesp);
                        $this->Piecereglements->delete($item);
                    }
                }
                // if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {

                //     foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                //         if (isset($p['sup']) && $p['sup'] != 1) {
                //             $tab = $this->fetchTable('Piecereglements')->newEmptyEntity();
                //             if ($p['paiement_id'] == 2) {
                //                 $tab['reglement_id'] = $id;
                //                 $tab['paiement_id'] = $p['paiement_id'];
                //                 $tab['montant'] = $p['montant'];

                //                 $tab['echance'] = $p['echance'];
                //                 $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                //                 $tab['cheque_id'] = $p['cheque_id'];
                //                 $tab['compte_id'] = $p['compte_id'];
                //                 $tab['banque_id'] = $p['banque_id'];
                //                 $tab['num'] = $p['num_piece'];
                //             } else if ($p['paiement_id'] == 1 || $p['paiement_id'] == 7) {
                //                 $tab['reglement_id'] = $id;
                //                 $tab['paiement_id'] = $p['paiement_id'];
                //                 $tab['montant'] = $p['montant'];
                //             } else if ($p['paiement_id'] == 3 || $p['paiement_id'] == 4 || $p['paiement_id'] == 6 || $p['paiement_id'] == 8) {
                //                 $tab['reglement_id'] = $id;
                //                 $tab['paiement_id'] = $p['paiement_id'];
                //                 $tab['montant'] = $p['montant'];
                //                 $tab['echance'] = $p['echance'];
                //                 $tab['num'] = $p['num_piece'];
                //             } elseif ($p['paiement_id'] == 5) {
                //                 $tab['reglement_id'] = $id;
                //                 $tab['paiement_id'] = $p['paiement_id'];
                //                 $tab['montant'] = $p['montant'];
                //                 $tab['to_id'] = $p['taux'];
                //                 $tab['montant_brut'] = $p['montantbrut'];

                //                 $tab['montant_net'] = $p['montantnet'];
                //                 $tab['echance'] = $p['echance'];

                //                 $tab['num'] = $p['num_piece'];
                //             }

                //             // debug($tab);die;
                //             // $this->fetchTable('Piecereglements')->save($tab);
                //             if ($this->fetchTable('Piecereglements')->save($tab)) {
                //                 $cheque = $this->fetchTable('Cheques')->get($p['cheque_id']);
                //                 // debug($article);die;
                //                 $cheque->etat = 1;
                //                 $this->fetchTable('Cheques')->save($cheque);
                //                 // debug($lignelivraisons);
                //             } else {
                //             }
                //             //$piecereglement = $this->fetchTable('Piecereglements')->newEmptyEntity();



                //             // $piecereglement = $this->fetchTable('Piecereglements')->patchEntity($piecereglement, $tab);
                //             // debug($lignecommande);

                //         }
                //     }
                // }
                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup']) && $p['sup'] != 1) {
                            $tab = $this->fetchTable('Piecereglements')->newEmptyEntity();

                            // Common fields
                            $tab['reglement_id'] = $id;
                            $tab['paiement_id'] = $p['paiement_id'];
                            $tab['montant'] = $p['montant'];

                            // Specific fields based on paiement_id
                            switch ($p['paiement_id']) {
                                case 2:
                                    $tab['echance'] = $p['echance'];
                                    $tab['carnetcheque_id'] = $p['carnetcheque_id'];
                                    $tab['cheque_id'] = $p['cheque_id'];
                                    $tab['compte_id'] = $p['compte_id'];
                                    $tab['banque_id'] = $p['banque_id'];
                                    $tab['num'] = $p['num_piece'];
                                    break;
                                case 1:
                                case 7:
                                    // No additional fields for paiement_id 1 or 7
                                    break;
                                case 3:
                                case 4:
                                case 6:
                                case 8:
                                    $tab['echance'] = $p['echance'];
                                    $tab['num'] = $p['num_piece'];
                                    break;
                                case 5:
                                    $tab['to_id'] = $p['taux'];
                                    $tab['montant_brut'] = $p['montantbrut'];
                                    $tab['montant_net'] = $p['montantnet'];
                                    $tab['echance'] = $p['echance'];
                                    $tab['num'] = $p['num_piece'];
                                    break;
                            }

                            // Save the piece
                            if ($this->fetchTable('Piecereglements')->save($tab)) {
                                if (isset($p['cheque_id']) && $p['cheque_id']) {
                                    $cheque = $this->fetchTable('Cheques')->get($p['cheque_id']);
                                    $cheque->etat = 1;
                                    $this->fetchTable('Cheques')->save($cheque);
                                }
                            }
                        }
                    }
                }
                //  $this->Flash->success(__('The reglement has been saved.'));

                $diff = $this->request->getData('diff');
                $difference = $this->request->getData('differance');

                if (isset($diff) && $diff == 1) {



                    if ($difference) {
                        $tabb = $this->fetchTable('Piecereglements')->newEmptyEntity();

                        $tabb['reglement_id'] = $id;
                        $tabb['montant'] = $difference;
                        $tabb['paiement_id'] = 9;
                        $this->fetchTable('Piecereglements')->save($tabb);
                    }

                    //   
                }


                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The reglement could not be saved. Please, try again.'));
        }
        $four = $reglement->fournisseur_id;
        $p = $reglement->pointdevente_id;
        // $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id]);
        $lignesreg = $this->Lignereglements->find('all')->where(['Lignereglements.reglement_id =' . $id]);

        $l = '(0';
        $lb = '(0';
        $la = '(0';
        foreach ($lignesreg as  $li) {


            if ($li['facture_id'] != 0) {
                $l = $l . ',' . $li['facture_id'];
            } else if ($li['livraison_id'] != 0) {
                $lb = $lb . ',' . $li['livraison_id'];
            } else if ($li['factureavoir_id'] != 0) {
                $la = $la . ',' . $li['factureavoir_id'];
            }
        }
        $l = $l . ',0)';
        $lb = $lb . ',0)';
        $la = $la . ',0)';


        foreach ($lignesreg as $s => $si) {

            if ($si['facture_id'] != 0) {
                $s = $si['reglement_id'];
            } else if ($si['livraison_id'] != 0) {
                $s = $si['reglement_id'];
            }
        }
        $piecereglements = $this->Piecereglements->find('all')->where(['Piecereglements.reglement_id =' . $id, 'Piecereglements.paiement_id not in(6,7,8,9)']);
        //debug($piecereglementclients->toarray());
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
        }
        // bug($ligne);die;


        if ($four != null && $p != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $this->loadModel('Fournisseurs');


            $connection = ConnectionManager::get('default');
            $factures = $connection->execute("select * from factures where (factures.fournisseur_id=" . $four . " ) and (( factures.ttc > factures.Montant_Regler) OR (factures.id in" . $l . "));");
            $compte = $this->Fournisseurs->find('all')->where(['Fournisseurs.id =' . $four, 'Fournisseurs.soldedebut - Fournisseurs.Montant_Regler !=0'])->first();

            // $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four /*, 'Factures.pointdevente_id =' . $p*/]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four/*, 'Livraisons.pointdevente_id =' . $p*/]);
        }
        if ($four != null && $p == null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $this->loadModel('Fournisseurs');

            $connection = ConnectionManager::get('default');

            $factures = $connection->execute("select * from factures where (factures.fournisseur_id=" . $four . " ) and (( factures.ttc > factures.Montant_Regler) OR (factures.id in" . $l . "));");
            $compte = $this->Fournisseurs->find('all')->where(['Fournisseurs.id =' . $four, 'Fournisseurs.soldedebut - Fournisseurs.Montant_Regler !=0'])->first();

            //  $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four/*,'Factures.pointdevente_id'=>$p*/]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four/*,'Livraisons.pointdevente_id'=>$p*/]);
        }
        $this->loadModel('Tos');
        $valeurs = $this->Tos->find('list', ['limit' => 200])->all();
        $this->loadModel('Paiements');
        $paiements = $this->Paiements->find('list', ['limit' => 200])
            ->where(['Paiements.id NOT IN' => [6, 7, 8, 9]])
            ->all();
        //    $this->loadModel('Carnetcheques');
        //    $carnetcheques= $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $carnetcheques = $this->fetchTable('Carnetcheques')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $carnetcheques = $this->fetchTable('Carnetcheques')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);

        $cheques = $this->fetchTable('Cheques')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);

        $this->set(compact('mtfact', 'mtbon', 'idd', 'compte', 'banques', 'comptes', 'cheques', 'facreg', 'piecereglements', 'lignesreg', 'pointdeventes', 'carnetcheques', 'valeurs', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
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

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_achat' . $abrv);

        //   debug($liendd);
        $user = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'reglements') {
                $user = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($user <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
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
            if ($item['fournisseur_id'] != null) {
                $this->loadModel('Fournisseurs');
                $mtg = $this->Fournisseurs->find()->select(["mtreg" =>
                'Fournisseurs.Montant_Regler'])->where(['Fournisseurs.id =' . $item['fournisseur_id']])->first();
                $MontantRegler = $mtg->mtreg;
                $four = $this->Fournisseurs->get($item['fournisseur_id']);
                $four->Montant_Regler = $MontantRegler - $item['Montant'];

                $this->Fournisseurs->save($four);

                ///debug($fact);
            }
            $this->Lignereglements->delete($item);
        }


        $lignes2 = $this->Piecereglements->find()->where(["Piecereglements.reglement_id=" . $id])->all();
        foreach ($lignes2 as $item) {
            ///debug($item) ;
            if ($item['factureavoir_id'] != null) {
                $avoir = $this->Factureavoirs->find()->where(['Factureavoirs.id =' . $item['factureavoir_id']])->first();
                $avoir->valide = '0';
                $this->Factureavoirs->save($avoir);
                //  debug($avoir) ;        

            }


            ///////////////
            if ($item['cheque_id']) {
                $chequesp = $this->fetchTable('Cheques')->get($item['cheque_id']);
                // debug($article);die;
                $chequesp->etat = 0;
                $this->fetchTable('Cheques')->save($chequesp);
                $this->Piecereglements->delete($item);
            }
            $this->Piecereglements->delete($item);
        }


        $reglement = $this->Reglements->get($id);
        if ($this->Reglements->delete($reglement)) {
            //  $this->Flash->success(__('The reglement has been deleted.'));
        } else {
            // $this->Flash->error(__('The reglement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
