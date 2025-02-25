<?php

declare(strict_types=1);

namespace App\Controller;

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

        if ($four != null && $p != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four, 'Factures.pointdevente_id =' . $p]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four, 'Livraisons.pointdevente_id =' . $p]);
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
        // $this->set(compact('reglement'));
        $this->set(compact('mtfact', 'mtbon', 'facreg', 'piecereglements', 'lignesreg', 'pointdeventes', 'valeurs', 'carnetcheques', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
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

        $reglement = 0;
        foreach ($lien_commercialmenus as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'reglementcommercial') {
                $reglement = $liens['ajout'];
            }
        }
        if (($reglement <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }



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
                            $ta['Montant'] = $l['ttc'];
                            // $ta['livraison_id']=0;
                            // Retourne l'article avec l'id 12
                            // debug ($l['ttc']);
                            $mtg = $this->Factures->find()->select(["mtreg" =>
                            'Factures.Montant_Regler'])->where(['Factures.id =' . $l['facture_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factures->get($l['facture_id']);
                            $fact->Montant_Regler = floatval($MontantRegler) + floatval($l['ttc']);

                            $this->Factures->save($fact);




                            // $lignereglement = $this->fetchTable('Lignereglements')->patchEntity($lignereglement, $tab);
                            //  debug($ta);
                            $this->fetchTable('Lignereglements')->save($ta);
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $tabb['reglement_id'] = $reglement_id;
                            $tabb['livraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['ttc'];
                            // $tabb['facture_id']=0;
                            //   debug($tabb);die;
                            $this->fetchTable('Lignereglements')->save($tabb);
                            // Retourne l'article avec l'id 12
                            $mtg = $this->Livraisons->find()->select(["mtreg" =>
                            'Livraisons.Montant_Regler'])->where(['Livraisons.id =' . $l['bonreception_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Livraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['ttc'];
                            $this->Livraisons->save($fact);




                            //$lignereglement = $this->fetchTable('Lignereglements')->patchEntity($lignereglement,$tabb);
                            //  debug($lignereglement);die;

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
        if ($four != null ) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four, 'Factures.ttc > Factures.Montant_Regler'/*,'Factures.pointdevente_id'=>$p*/]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four, 'Livraisons.ttc > Livraisons.Montant_Regler'/*,'Livraisons.pointdevente_id'=>$p*/]);
       
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
        $paiements = $this->Paiements->find('list', ['limit' => 200])->all();
        $this->loadModel('Carnetcheques');
        $carnetcheques = $this->Carnetcheques->find('list', ['limit' => 200])->all();
        $pointdeventes = $this->Reglements->Pointdeventes->find('list', ['limit' => 200])->all();
        $fournisseurs = $this->Reglements->Fournisseurs->find('list', ['limit' => 200])->all();
        $importations = $this->Reglements->Importations->find('list', ['limit' => 200])->all();
        $utilisateurs = $this->Reglements->Utilisateurs->find('list', ['limit' => 200])->all();
        $exercices = $this->Reglements->Exercices->find('list', ['limit' => 200])->all();
        $devises = $this->Reglements->Devises->find('list', ['limit' => 200])->all();
        $this->set(compact('valeurs', 'carnetcheques', 'paiements', 'livraisons', 'factures', 'four', 'p', 'code', 'reglement', 'pointdeventes', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
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
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

        $reglement = 0;
        foreach ($lien_commercialmenus as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'reglementcommercial') {
                $reglement = $liens['modif'];
            }
        }
        if (($reglement <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


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

                    $this->Lignereglements->delete($item);
                }
                if (isset($this->request->getData('data')['Lignereglement']) && (!empty($this->request->getData('data')['Lignereglement']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['Lignereglement'] as $i => $l) {
                        if (isset($l['facture_id'])) {
                            $ta = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $ta['reglement_id'] = $id;
                            $ta['facture_id'] = $l['facture_id'];
                            $ta['Montant'] = $l['ttc'];
                            // $ta['livraison_id']=0;
                            // Retourne l'article avec l'id 12
                            $mtg = $this->Factures->find()->select(["mtreg" =>
                            'Factures.Montant_Regler'])->where(['Factures.id =' . $l['facture_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factures->get($l['facture_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['ttc'];
                            $this->Factures->save($fact);




                            // $lignereglement = $this->fetchTable('Lignereglements')->patchEntity($lignereglement, $tab);
                            //  debug($ta);
                            $this->fetchTable('Lignereglements')->save($ta);
                        }

                        if (isset($l['bonreception_id'])) {
                            $tabb = $this->fetchTable('Lignereglements')->newEmptyEntity();
                            $tabb['reglement_id'] = $id;
                            $tabb['livraison_id'] = $l['bonreception_id'];
                            $tabb['Montant'] = $l['ttc'];
                            // $tabb['facture_id']=0;
                            //   debug($tabb);die;
                            $this->fetchTable('Lignereglements')->save($tabb);
                            // Retourne l'article avec l'id 12
                            $mtg = $this->Livraisons->find()->select(["mtreg" =>
                            'Livraisons.Montant_Regler'])->where(['Livraisons.id =' . $l['bonreception_id']])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Livraisons->get($l['bonreception_id']);
                            $fact->Montant_Regler = $MontantRegler + $l['ttc'];
                            $this->Livraisons->save($fact);




                            //$lignereglement = $this->fetchTable('Lignereglements')->patchEntity($lignereglement,$tabb);
                            //  debug($lignereglement);die;

                        }
                    }
                }
                $lignes2 = $this->Piecereglements->find()->where(["reglement_id" => $id])->all();
                foreach ($lignes2 as $item) {
                    $this->Piecereglements->delete($item);
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

        if ($four != null && $p != null) {
            $this->loadModel('Factures');
            $this->loadModel('Livraisons');
            $factures = $this->Factures->find('all')->where(['Factures.fournisseur_id =' . $four, 'Factures.pointdevente_id =' . $p]);
            $livraisons = $this->Livraisons->find('all')->where(['Livraisons.fournisseur_id =' . $four, 'Livraisons.pointdevente_id =' . $p]);
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
        $this->set(compact('mtfact', 'mtbon', 'facreg', 'piecereglements', 'lignesreg', 'pointdeventes', 'valeurs', 'carnetcheques', 'paiements', 'p', 'four', 'livraisons', 'factures', 'reglement', 'fournisseurs', 'importations', 'utilisateurs', 'exercices', 'devises'));
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
        $lien_commercialmenus = $session->read('lien_commercialmenus' . $abrv);

        $reglement = 0;
        foreach ($lien_commercialmenus as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'reglementcommercial') {
                $reglement = $liens['supp'];
            }
        }
        if (($reglement <> 1)) {
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

            $this->Lignereglements->delete($item);
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
