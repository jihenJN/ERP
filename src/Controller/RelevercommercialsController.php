<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Relevercommercials Controller
 *
 * @property \App\Model\Table\RelevercommercialsTable $Relevercommercials
 * @method \App\Model\Entity\Relevercommercial[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RelevercommercialsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {

        $this->loadModel('Commercials');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Reglementcommercials');
        $this->loadModel('Bonusmaluscommercials');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Lignereglementcommercials');
        $this->loadModel('Lignebonusmalus');
        $commercial_id = $this->request->getQuery('commercial_id');
        $Date_debut = $this->request->getQuery('Date_debut');
        $Date_fin = $this->request->getQuery('Date_fin');
        if ($this->request->getQuery()) {
            $this->Relevercommercials->deleteAll(array());
            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';
            $cond6 = '';
            $cond7 = '';
            $cond8 = '';
            $cond9 = '';
            $cond11 = '';
            $cond12 = '';
            $cond13 = '';
            $regs = array();
            $regs['0'] = 'Regl�';
            $regs['1'] = 'Non regl�';
            $Date_debut = '';
            //debug($this->request->getQuery());die;
            if ($this->request->getQuery()['Date_debut'] == "") {
                $this->request->getQuery()['Date_debut'] = '2015-01-01  00:00:00';
            }
            if ($this->request->getQuery()['Date_fin'] == "") {
                $this->request->getQuery()['Date_fin'] = date('d/m/Y');
            }
            if ($this->request->getQuery()['Date_debut'] != '') {
                $cond1 = 'Bonlivraisons.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $cond2 = 'Reglementcommercials.date>=' . "'" . $this->request->getQuery()['Date_debut'] . "'";
                $cond3 = 'Bonusmaluscommercials.dateoperation>=' . "'" . $this->request->getQuery()['Date_debut'] . "'";
                $cond11 = 'Bonlivraisons.date<' . "'" . $this->request->getQuery()['Date_debut'] . " 23:59:59'";
                $cond12 = 'Reglementcommercials.date<' . "'" . $this->request->getQuery()['Date_debut'] . " '";
                $cond13 = 'Bonusmaluscommercials.dateoperation<' . "'" . $this->request->getQuery()['Date_debut'] . " '";
                // debug($this->request->getQuery()['Date_debut']);die;
            }
            if ($this->request->getQuery()['Date_fin'] != '') {
                $cond4 = 'Bonlivraisons.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
                $cond5 = 'Reglementcommercials.date<=' . "'" . $this->request->getQuery()['Date_fin'] . "'";
                $cond6 = 'Bonusmaluscommercials.dateoperation<=' . "'" . $this->request->getQuery()['Date_fin'] . "'";
            }
            if ($this->request->getQuery()['commercial_id']) {
                $commercial_id = $this->request->getQuery()['commercial_id'];
                $cond7 = 'Bonlivraisons.commercial_id=' . $commercial_id;
                $cond8 = 'Reglementcommercials.commercial_id=' . $commercial_id;
                $cond9 = 'Bonusmaluscommercials.commercial_id=' . $commercial_id;
            }
            //
            $i = -1;
            $reglementcommercialss = $this->Reglementcommercials->find('all', array(
                'conditions' => array(@$cond12, @$cond8), 'recursive' => 0
            ));
            foreach ($reglementcommercialss as  $comm) {
                $i++;
                $Lignereglementcommercialss = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id=' . $comm['id']]);
                //debug($Lignereglementcommercials);
                $da[$i]['type'] = "Reglement Com";
                $da[$i]['id'] = $comm['id'];
                $da[$i]['date'] = $comm['date'];
                $mnt = 0;
                $j = -1;
                foreach ($Lignereglementcommercialss as  $ligne) {
                    $j++;
                    $da[$i]['ligne'][$j]['typ'] = "1";
                    $da[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $mnt += $ligne['montant'];
                    $da[$i]['ligne'][$j]['montant'] = "1";
                }

                $da[$i]['credit'] = 0;
                $da[$i]['debit'] = $mnt;
            }
            $reglementcommercials = $this->Reglementcommercials->find('all')->where([$cond2, $cond5, $cond8]);
            foreach ($reglementcommercials as  $com) {
                $i++;
                $Lignereglementcommercials = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id=' . $com['id']]);
                $this->loadModel('Paiements');
                $paiements = $this->Paiements->get($com['paiement_id'], [
                    'contain' => []
                ]);
                // debug($paiements);die;
                $dat[$i]['type'] = "Reglement Com";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['paiements'] = $paiements['name'];
                // debug($com);
                $mnt = 0;
                $j = -1;
                foreach ($Lignereglementcommercials as  $ligne) {
                    $j++;
                    //  debug($ligne);die;
                    $this->loadModel('Lignebonlivraisons');
                    $lignebonlivraisons = $this->Lignebonlivraisons->get($ligne['lignebonlivraison_id'], [
                        'contain' =>  ['Bonlivraisons']
                    ]);
                    $dat[$i]['ligne'][$j]['numero'] = $lignebonlivraisons['bonlivraison']['numero'];
                    $dat[$i]['ligne'][$j]['lignebonlivraison_id'] = $ligne['lignebonlivraison_id'];
                    $dat[$i]['ligne'][$j]['lignebonusmalu_id'] = $ligne['lignebonusmalu_id'];
                    $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "1";
                    $mnt += $ligne['montant'];
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                }
                //debug($dat) ; die ;
                $dat[$i]['debit'] = 0;
                $dat[$i]['credit'] = $mnt;
            }
            $bonlivraisonss = $this->Bonlivraisons->find('all', array(
                'conditions' => array(@$cond11, @$cond7), 'recursive' => 0
            ));
            foreach ($bonlivraisonss as  $comm) {
                $i++;
                $Lignebonlivraisonss = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id=' . $comm['id']]);
                $da[$i]['type'] = "Com BL ";
                $da[$i]['id'] = $comm['id'];
                $da[$i]['date'] = $comm['date'];
                $mnt = 0;
                $j = -1;
                // debug($Lignebonlivraisonss);die;
                foreach ($Lignebonlivraisonss as  $ligne) {
                    // debug($ligne);die;
                    $j++;
                    $da[$i]['ligne'][$j]['typ'] = "2";
                    $da[$i]['ligne'][$j]['montantcommissions'] = $ligne['montantcommission'];
                    $mnt += $ligne['montantcommission'];
                    $da[$i]['ligne'][$j]['montantcommission'] = "2";
                }
                $da[$i]['credit'] = 0;
                $da[$i]['debit'] = $mnt;
            }
            $bonlivraisons = $this->Bonlivraisons->find('all')->where([$cond1, $cond4, $cond7]);
            foreach ($bonlivraisons as  $com) {
                $i++;
                $Lignebonlivraisons = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id=' . $com['id']]);
                $this->loadModel('Clients');
                $clients = $this->Clients->get($com['client_id'], [
                    'contain' => []
                ]);
                //  debug($clients);die;
                $dat[$i]['type'] = "Com BL ";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['clients'] = $clients['Raison_Sociale'];
                $mnt = 0;
                $j = -1;
                // debug($Lignebonlivraisons);die;
                foreach ($Lignebonlivraisons as  $ligne) {
                    //debug($ligne);die;
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['nouv_client'] = $ligne['nouv_client'];
                    $dat[$i]['ligne'][$j]['nouv_article'] = $ligne['nouv_article'];
                    $dat[$i]['ligne'][$j]['montantcommissions'] = $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['montantcommission'] = "2";
                }
                $dat[$i]['debit'] = 0;
                $dat[$i]['credit'] = $mnt;
            }
            $bonusmaluscommercialss = $this->Bonusmaluscommercials->find('all', array(
                'conditions' => array(@$cond13, @$cond9), 'recursive' => 0
            ));
            $bonusmaluscommercials = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9]);
            foreach ($bonusmaluscommercials as  $com) {
                $i++;
                $Lignebonusmalus = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id'], 'Lignebonusmalus.montant>0']);
                $dat[$i]['type'] = "Com Bonus";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['dateoperation'];
                $j = -1;
                $mnt = 0;
                foreach ($Lignebonusmalus as $j => $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    //debug($articles);die;
                    $dat[$i]['ligne'][$j]['arti'] = $articles['qtr'];
                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                    $dat[$i]['ligne'][$j]['qtelivre'] = $ligne['qtelivre'];
                    $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "1";
                    $mnt += $ligne['montant'];
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                    // debug($dataa);die;
                }
                $dat[$i]['debit'] = $mnt;
                $dat[$i]['credit'] = 0;
            }
            foreach ($bonusmaluscommercials as  $com) {
                $i++;
                $Lignebonusmaluss = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id'], 'Lignebonusmalus.montant<0']);
                $dat[$i]['type'] = "Com Malus";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['dateoperation'];
                $j = -1;
                $mnt = 0;
                foreach ($Lignebonusmaluss as  $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                    $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += $ligne['montant'];
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                }
                $dat[$i]['credit'] = $mnt;
                $dat[$i]['debit'] = 0;
            }
            //    debug($dat) ; die ;
            // $sldini = 0;
            // $sldini = $sldini - $reglementcommercialss[0]['solde'];
            // $sldini = $sldini - $bonlivraisonss[0]['solde'];
            // $sldini = $sldini - $bonusmaluscommercialss[0]['solde'];
            // debug($sldini) ; die ;
        }
        // $rel = $this->Relevercommercials->find('all')->order(['Relevercommercials.date,Relevercommercials.typ' => 'desc']);
        $this->loadModel('Commercials');
        $this->loadModel('Articles');
        $this->loadModel('Paiements');
        $commercials = $this->Commercials->find('list', ['limit' => 200]);
        $this->set(compact('dat', 'commercials'));
    }
    public function imprime()
    {

        $this->loadModel('Commercials');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Reglementcommercials');
        $this->loadModel('Bonusmaluscommercials');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Lignereglementcommercials');
        $this->loadModel('Lignebonusmalus');
        $commercial_id = $this->request->getQuery('commercial_id');
        $Date_debut = $this->request->getQuery('Date_debut');
        $Date_fin = $this->request->getQuery('Date_fin');
        // debug($this->request->getQuery());
        // die;
        if ($this->request->getQuery()) {
            $this->Relevercommercials->deleteAll(array());
            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';
            $cond6 = '';
            $cond7 = '';
            $cond8 = '';
            $cond9 = '';
            $regs = array();
            $regs['0'] = 'Regl�';
            $regs['1'] = 'Non regl�';
            $Date_debut = '';
            //debug($this->request->getQuery());die;
            // if ($this->request->getQuery()['Date_debut'] == "") {
            //     $this->request->getQuery()['Date_debut'] = '2015-01-01  00:00:00';
            // }
            // if ($this->request->getQuery()['Date_fin'] == "") {
            //     $this->request->getQuery()['Date_fin'] = date('d/m/Y H:i:s');
            // }
            // if ($this->request->getQuery()['Date_debut'] != '') {
            //     $cond1 = 'Bonlivraisons.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
            //     $cond2 = 'Reglementcommercials.date>=' . "'" . $this->request->getQuery()['Date_debut'] . "'";
            //     $cond3 = 'Bonusmaluscommercials.dateoperation>=' . "'" . $this->request->getQuery()['Date_debut'] . "'";
            // }
            // if ($this->request->getQuery()['Date_fin'] != '') {
            //     $cond4 = 'Bonlivraisons.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
            //     $cond5 = 'Reglementcommercials.date<=' . "'" . $this->request->getQuery()['Date_fin'] . "'";
            //     $cond6 = 'Bonusmaluscommercials.dateoperation<=' . "'" . $this->request->getQuery()['Date_fin'] . "'";
            // }
            // if ($this->request->getQuery()['commercial_id']) {
            //     $commercial_id = $this->request->getQuery()['commercial_id'];
            //     $cond7 = 'Bonlivraisons.commercial_id=' . $commercial_id;
            //     $cond8 = 'Reglementcommercials.commercial_id=' . $commercial_id;
            //     $cond9 = 'Bonusmaluscommercials.commercial_id=' . $commercial_id;
            // }
            $reglementcommercials = $this->Reglementcommercials->find('all')->where([$cond2, $cond5, $cond8]);
            $i = -1;
            foreach ($reglementcommercials as  $com) {
                $i++;
                $Lignereglementcommercials = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id=' . $com['id']]);
                $this->loadModel('Paiements');
                $paiements = $this->Paiements->get($com['paiement_id'], [
                    'contain' => []
                ]);
                // debug($paiements);die;
                $dat[$i]['type'] = "Reglement Commercials";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['paiements'] = $paiements['name'];
                // debug($com);
                $mnt = 0;
                $j = -1;
                foreach ($Lignereglementcommercials as  $ligne) {
                    $j++;
                    $dat[$i]['ligne'][$j]['lignelivraison_id'] = $ligne['lignelivraison_id'];
                    $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "1";
                    $mnt += $ligne['montant'];
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                }
                $dat[$i]['credit'] = 0;
                $dat[$i]['debit'] = $mnt;
            }
            $bonlivraisons = $this->Bonlivraisons->find('all')->where([$cond1, $cond4, $cond7]);

            foreach ($bonlivraisons as  $com) {
                $i++;
                $Lignebonlivraisons = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id=' . $com['id']]);
                // $clients = $this->fetchTable('Clients')->find('list', [
                //     'keyField' => 'id',
                //     'valueField' => 'Contact'
                // ]);
                $this->loadModel('Clients');
                $clients = $this->Clients->get($com['client_id'], [
                    'contain' => []
                ]);
                //  debug($clients);die;
                $dat[$i]['type'] = "Bon Livraisons";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['clients'] = $clients['Raison_Sociale'];
                $mnt = 0;
                $j = -1;
                foreach ($Lignebonlivraisons as  $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    // $articles = $this->Articles->get($ligne['article_id'], [
                    //     'contain' => []
                    // ]);
                    // $dat[$i]['ligne'][$j]['articles'] = $ligne['Dsignation'];
                    $dat[$i]['ligne'][$j]['montantcommissions'] = $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['montantcommission'] = "2";
                }
                $dat[$i]['debit'] = 0;
                $dat[$i]['credit'] = $mnt;
            }
            $bonusmaluscommercials = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9]);
            foreach ($bonusmaluscommercials as  $com) {
                $i++;
                $Lignebonusmalus = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id'], 'Lignebonusmalus.montant>0']);
                $dat[$i]['type'] = "Bonus";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['dateoperation'];
                $j = -1;
                $mnt = 0;
                foreach ($Lignebonusmalus as $j => $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    //debug($articles);die;

                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                    $dat[$i]['ligne'][$j]['qtelivre'] = $ligne['qtelivre'];
                    $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "1";
                    $mnt += $ligne['montant'];
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                    // debug($dataa);die;
                }
                $dat[$i]['debit'] = $mnt;
                $dat[$i]['credit'] = 0;
            }
            foreach ($bonusmaluscommercials as  $com) {
                $i++;
                $Lignebonusmaluss = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id'], 'Lignebonusmalus.montant<0']);
                $dat[$i]['type'] = "Malus";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['dateoperation'];
                $j = -1;
                $mnt = 0;
                foreach ($Lignebonusmaluss as  $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                    $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += $ligne['montant'];
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                }
                $dat[$i]['credit'] = $mnt;
                $dat[$i]['debit'] = 0;
            }
            //    debug($dat) ; die ;
        }
        // $rel = $this->Relevercommercials->find('all')->order(['Relevercommercials.date,Relevercommercials.typ' => 'desc']);
        $this->loadModel('Commercials');
        $this->loadModel('Articles');
        $this->loadModel('Paiements');
        $commercials = $this->Commercials->find('list', ['limit' => 200]);
        $this->set(compact('dat', 'commercials'));
    }


    /**
     * View method
     *
     * @param string|null $id Relevercommercial id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $relevercommercial = $this->Relevercommercials->get($id, [
            'contain' => ['Commercials', 'Bonlivraisons', 'Lignebonlivraisons', 'Bonusmaluscommercials', 'Lignebonusmalus', 'Reglements', 'Lignereglements'],
        ]);

        $this->set(compact('relevercommercial'));
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
        $liendd = $session->read('lien_commercialmenus' . $abrv);

        $relevercommercial = 0;

        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'relevecommercial') {
                $relevercommercial = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($relevercommercial <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $relevercommercial = $this->Relevercommercials->newEmptyEntity();
        if ($this->request->is('post')) {
            $relevercommercial = $this->Relevercommercials->patchEntity($relevercommercial, $this->request->getData());
            if ($this->Relevercommercials->save($relevercommercial)) {
            //    $this->Flash->success(__('The {0} has been saved.', 'Relevercommercial'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Relevercommercial'));
        }
        $commercials = $this->Relevercommercials->Commercials->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Relevercommercials->Bonlivraisons->find('list', ['limit' => 200]);
        $lignebonlivraisons = $this->Relevercommercials->Lignebonlivraisons->find('list', ['limit' => 200]);
        $bonusmaluscommercials = $this->Relevercommercials->Bonusmaluscommercials->find('list', ['limit' => 200]);
        $lignebonusmalus = $this->Relevercommercials->Lignebonusmalus->find('list', ['limit' => 200]);
        $reglements = $this->Relevercommercials->Reglements->find('list', ['limit' => 200]);
        $lignereglements = $this->Relevercommercials->Lignereglements->find('list', ['limit' => 200]);
        $this->set(compact('relevercommercial', 'commercials', 'bonlivraisons', 'lignebonlivraisons', 'bonusmaluscommercials', 'lignebonusmalus', 'reglements', 'lignereglements'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Relevercommercial id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_commercialmenus' . $abrv);

        $relevercommercial = 0;

        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'relevecommercial') {
                $relevercommercial = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($relevercommercial <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $relevercommercial = $this->Relevercommercials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $relevercommercial = $this->Relevercommercials->patchEntity($relevercommercial, $this->request->getData());
            if ($this->Relevercommercials->save($relevercommercial)) {
               // $this->Flash->success(__('The {0} has been saved.', 'Relevercommercial'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Relevercommercial'));
        }
        $commercials = $this->Relevercommercials->Commercials->find('list', ['limit' => 200]);
        $bonlivraisons = $this->Relevercommercials->Bonlivraisons->find('list', ['limit' => 200]);
        $lignebonlivraisons = $this->Relevercommercials->Lignebonlivraisons->find('list', ['limit' => 200]);
        $bonusmaluscommercials = $this->Relevercommercials->Bonusmaluscommercials->find('list', ['limit' => 200]);
        $lignebonusmalus = $this->Relevercommercials->Lignebonusmalus->find('list', ['limit' => 200]);
        $reglements = $this->Relevercommercials->Reglements->find('list', ['limit' => 200]);
        $lignereglements = $this->Relevercommercials->Lignereglements->find('list', ['limit' => 200]);
        $this->set(compact('relevercommercial', 'commercials', 'bonlivraisons', 'lignebonlivraisons', 'bonusmaluscommercials', 'lignebonusmalus', 'reglements', 'lignereglements'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Relevercommercial id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_commercialmenus' . $abrv);

        $relevercommercial = 0;

        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'relevecommercial') {
                $relevercommercial = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($relevercommercial <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->request->allowMethod(['post', 'delete']);
        $relevercommercial = $this->Relevercommercials->get($id);
        if ($this->Relevercommercials->delete($relevercommercial)) {
           // $this->Flash->success(__('The {0} has been deleted.', 'Relevercommercial'));
        } else {
            //$this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Relevercommercial'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
