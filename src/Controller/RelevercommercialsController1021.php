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
    // {

    //     $this->loadModel('Commercials');
    //     $this->loadModel('Bonlivraisons');
    //     $this->loadModel('Reglementcommercials');
    //     $this->loadModel('Bonusmaluscommercials');
    //     $this->loadModel('Lignebonlivraisons');
    //     $this->loadModel('Lignereglementcommercials');
    //     $this->loadModel('Lignebonusmalus');

    //     $commercial_id = $this->request->getQuery('commercial_id');
    //     $Date_debut = $this->request->getQuery('Date_debut');
    //     $Date_fin = $this->request->getQuery('Date_fin');
    //     // debug($this->request->getQuery());
    //     // die;
    //     if ($this->request->getQuery()) {

    //         $this->Relevercommercials->query('TRUNCATE Relevercommercials;');
    //         $cond1 = '';
    //         $cond2 = '';
    //         $cond3 = '';
    //         $cond4 = '';
    //         $cond5 = '';
    //         $cond6 = '';
    //         $cond7 = '';
    //         $cond8 = '';
    //         $cond9 = '';
    //         $regs = array();
    //         $regs['0'] = 'Regl�';
    //         $regs['1'] = 'Non regl�';
    //         $Date_debut = '';
    //         if ($this->request->getQuery()['Date_debut'] == "__/__/____") {
    //             $this->request->getQuery()['Date_debut'] = '01/01/2015';
    //         }
    //         if ($this->request->getQuery()['Date_fin'] == "__/__/____") {
    //             $this->request->getQuery()['Date_fin'] = date('d/m/Y');
    //         }

    //         if ($this->request->getQuery()['Date_debut'] != '__/__/____') {
    //             // $Date_debut = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery['Date_debut'])));
    //             $cond1 = 'Bonlivraisons.date>=' . "'" . $Date_debut . "'";
    //             $cond2 = 'Reglementcommercials.date>=' . "'" . $Date_debut . "'";
    //             $cond3 = 'Bonusmaluscommercials.dateoperation>=' . "'" . $Date_debut . "'";
    //         }

    //         if ($this->request->getQuery()['Date_fin'] != '__/__/____') {
    //             // $Date_fin = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery['Date_fin'])));
    //             $cond4 = 'Bonlivraisons.date<=' . "'" . $Date_fin . "'";
    //             $cond5 = 'Reglementcommercials.date<=' . "'" . $Date_fin . "'";
    //             $cond6 = 'Bonusmaluscommercials.dateoperation<=' . "'" . $Date_fin . "'";
    //         }
    //         if ($this->request->getQuery()['commercial_id']) {
    //             $commercial_id = $this->request->getQuery()['commercial_id'];
    //             $cond7 = 'Bonlivraisons.commercial_id=' . $commercial_id;
    //             $cond8 = 'Reglementcommercials.commercial_id=' . $commercial_id;
    //             $cond9 = 'Bonusmaluscommercials.commercial_id=' . $commercial_id;
    //         }
    //         $reglementcommercials = $this->Reglementcommercials->find('all')->where([$cond2, $cond5, $cond8]);

    //         $reglist = 0;
    //         foreach ($reglementcommercials as $reg) {
    //             $reglist = $reglist . ',' . $reg->id;
    //         }
    //         $Lignereglementcommercials = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id   in (' . $reglist . ')']);
    //         // debug($Lignereglementcommercials);
    //         // debug($reglementcommercials);
    //         $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
    //         foreach ($Lignereglementcommercials as $ligre) {
    //             $regs = $this->Reglementcommercials->find('all')->where(['Reglementcommercials.id=' . $ligre['reglementcommercial_id']]);
    //             foreach ($regs as $li) {
    //                 $tablignelivraisons['numero'] = $li['numero'];
    //                 $tablignelivraisons['date'] = $li['date'];
    //             }
    //             $tablignelivraisons['type'] = "Reglement";
    //             $tablignelivraisons['debit'] = $ligre['montant'];
    //             $tablignelivraisons['credit'] = 0;
    //             $tablignelivraisons['typ'] = "1";
    //             $this->fetchTable('Relevercommercials')->save($tablignelivraisons);
    //         }
    //         $bonlivraisons = $this->Bonlivraisons->find('all')->where([$cond1, $cond4, $cond7]);
    //         $bonlist = 0;
    //         foreach ($bonlivraisons as $liv) {
    //             $bonlist = $bonlist . ',' . $liv->id;
    //         }
    //         $Lignebonlivraisons = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id   in (' . $bonlist . ')']);
    //         // debug($Lignebonlivraisons);
    //         // debug($bonlivraisons);
    //         $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
    //         foreach ($Lignebonlivraisons as $ligliv) {
    //             $liv = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.id=' . $ligliv['bonlivraison_id']]);
    //             foreach ($liv as $li) {
    //                 $tablignelivraisons['numero'] = $ligliv['numero'];
    //                 $tablignelivraisons['date'] = $ligliv['date'];
    //             }
    //             $tablignelivraisons['type'] = "Bon Livraisons";
    //             $tablignelivraisons['debit'] = $ligliv['montantcommission'];
    //             $tablignelivraisons['credit'] = 0;
    //             $tablignelivraisons['typ'] = "2";
    //             $this->fetchTable('Relevercommercials')->save($tablignelivraisons);
    //         }
    //         $bonusmaluscommercials = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9]);
    //         $bonuslist = 0;
    //         foreach ($bonusmaluscommercials as $bo) {
    //             $bonuslist = $bonuslist . ',' . $bo->id;
    //         }

    //         $Lignebonusmalus = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id   in (' . $bonuslist . ')', 'Lignebonusmalus.montant>0']);
    //         debug($Lignebonusmalus);
    //         // debug($bonuslist);
    //         $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
    //         foreach ($Lignebonusmalus as $lbm) {
    //             $liv = $this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.id=' . $lbm['bonusmaluscommercial_id']]);
    //             foreach ($liv as $li) {
    //                 $tablignelivraisons['numero'] = $li['numero'];
    //                 $tablignelivraisons['date'] = $li['date'];
    //             }
    //             $tablignelivraisons['type'] = "Bonus";
    //             $tablignelivraisons['debit'] = $lbm['montant'];
    //             $tablignelivraisons['credit'] = 0;
    //             $tablignelivraisons['typ'] = "2";
    //             $this->fetchTable('Relevercommercials')->save($tablignelivraisons);
    //         }
    //         $Lignebonusmaluss = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id   in (' . $bonuslist . ')', 'Lignebonusmalus.montant<0']);
    //         $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
    //         foreach ($Lignebonusmaluss as $lbms) {
    //             $livv = $this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.id=' . $lbms['bonusmaluscommercial_id']]);
    //             foreach ($livv as $li) {
    //                 $tablignelivraisons['numero'] = $li['numero'];
    //                 $tablignelivraisons['date'] = $li['date'];
    //             }
    //             $tablignelivraisons['type'] = "Malus";
    //             $tablignelivraisons['debit'] = 0;
    //             $tablignelivraisons['credit'] = $lbm['montant'];
    //             $tablignelivraisons['typ'] = "1";


    //             $this->fetchTable('Relevercommercials')->save($tablignelivraisons);
    //         }
    //         $rel = $this->Relevercommercials->find('all')->order(['Relevercommercials.date,Relevercommercials.typ' => 'desc']);
    //     }

    //     $this->loadModel('Commercials');
    //     //debug($relefes); 
    //     //  die;
    //     $commercials = $this->Commercials->find('list', ['limit' => 200]);
    //     $this->set(compact('rel', 'relevercommercials', 'commercials'));
    // }
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
            if ($this->request->getQuery()['Date_debut'] == "") {
                $this->request->getQuery()['Date_debut'] = '2015-01-01  00:00:00';
            }
            if ($this->request->getQuery()['Date_fin'] == "") {
                $this->request->getQuery()['Date_fin'] = date('d/m/Y H:i:s');
            }
            if ($this->request->getQuery()['Date_debut'] != '') {
                $cond1 = 'Bonlivraisons.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $cond2 = 'Reglementcommercials.date>=' . "'" . $this->request->getQuery()['Date_debut'] . "'";
                $cond3 = 'Bonusmaluscommercials.dateoperation>=' . "'" . $this->request->getQuery()['Date_debut'] . "'";
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
            $reglementcommercials = $this->Reglementcommercials->find('all')->where([$cond2, $cond5, $cond8]);
            $reglist = 0;
            foreach ($reglementcommercials as $reg) {
                $reglist = $reglist . ',' . $reg->id;
            }
            $Lignereglementcommercials = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id   in (' . $reglist . ')']);
            // debug($Lignereglementcommercials);
            // debug($reglementcommercials);
            $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
            foreach ($Lignereglementcommercials as $ligre) {
                $regs = $this->Reglementcommercials->find('all')->where(['Reglementcommercials.id=' . $ligre['reglementcommercial_id']]);
                foreach ($regs as $li) {
                    $tablignelivraisons['numero'] = $li['numero'];
                    $tablignelivraisons['date'] = $li['date'];
                }
                $tablignelivraisons['type'] = "Reglement";
                $tablignelivraisons['debit'] = $ligre['montant'];
                $tablignelivraisons['credit'] = 0;
                $tablignelivraisons['typ'] = "1";
                $this->fetchTable('Relevercommercials')->save($tablignelivraisons);
            }
            $bonlivraisons = $this->Bonlivraisons->find('all')->where([$cond1, $cond4, $cond7]);
            $bonlist = 0;
            // debug($bonlivraisons);die;
            foreach ($bonlivraisons as $liv) {
                $bonlist = $bonlist . ',' . $liv->id;
            }
            $Lignebonlivraisons = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id   in (' . $bonlist . ')']);
            // debug($Lignebonlivraisons);
            // debug($bonlivraisons);
            $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
            //debug($Lignebonlivraisons);
            foreach ($Lignebonlivraisons as $ligliv) {
                $liv = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.id=' . $ligliv['bonlivraison_id']]);
                foreach ($liv as $li) {

                    $tablignelivraisons['numero'] = $li['numero'];
                    $tablignelivraisons['date'] = $li['date'];
                }
                $tablignelivraisons['type'] = "Bon Livraisons";
                $tablignelivraisons['debit'] = $ligliv['montantcommission'];
                $tablignelivraisons['credit'] = 0;
                $tablignelivraisons['typ'] = "2";
                $this->fetchTable('Relevercommercials')->save($tablignelivraisons);
            }
            $bonusmaluscommercials = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9]);
            $bonuslist = 0;
            foreach ($bonusmaluscommercials as $bo) {
                $bonuslist = $bonuslist . ',' . $bo->id;
            }
            $Lignebonusmalus = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id   in (' . $bonuslist . ')', 'Lignebonusmalus.montant>0']);
            // debug($Lignebonusmalus); 
            $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
            foreach ($Lignebonusmalus as $lbm) {
                $liv = $this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.id=' . $lbm['bonusmaluscommercial_id']]);
                foreach ($liv as $li) {
                    $tablignelivraisons['numero'] = $li['numero'];
                    $tablignelivraisons['date'] = $li['dateoperation'];
                }
                $tablignelivraisons['type'] = "Bonus";
                $tablignelivraisons['debit'] = $lbm['montant'];
                $tablignelivraisons['credit'] = 0;
                $tablignelivraisons['typ'] = "2";
                $this->fetchTable('Relevercommercials')->save($tablignelivraisons);
            }
            $Lignebonusmaluss = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id   in (' . $bonuslist . ')', 'Lignebonusmalus.montant<0']);
            $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
            foreach ($Lignebonusmaluss as $lbms) {
                $livv = $this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.id=' . $lbms['bonusmaluscommercial_id']]);
                foreach ($livv as $li) {
                    $tablignelivraisons['numero'] = $li['numero'];
                    $tablignelivraisons['date'] = $li['dateoperation'];
                }
                $tablignelivraisons['type'] = "Malus";
                $tablignelivraisons['debit'] = 0;
                $tablignelivraisons['credit'] = $lbms['montant'];
                $tablignelivraisons['typ'] = "1";
                $this->fetchTable('Relevercommercials')->save($tablignelivraisons);
            }
            $rel = $this->Relevercommercials->find('all')->order(['Relevercommercials.date,Relevercommercials.typ' => 'desc']);
        }
        $this->loadModel('Commercials');
        //debug($relefes);
        //  die;
        $commercials = $this->Commercials->find('list', ['limit' => 200]);
        $this->set(compact('rel', 'relevercommercials', 'commercials'));
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

            $this->Relevercommercials->query('TRUNCATE Relevercommercials;');
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
            // if ($this->request->getQuery()['Date_debut'] == "__/__/____") {
            //     $this->request->getQuery()['Date_debut'] = '01/01/2015';
            // }
            // if ($this->request->getQuery()['Date_fin'] == "__/__/____") {
            //     $this->request->getQuery()['Date_fin'] = date('d/m/Y');
            // }

            // if ($this->request->getQuery()['Date_debut'] != '__/__/____') {
            //     // $Date_debut = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery['Date_debut'])));
            //     $cond1 = 'Bonlivraisons.date>=' . "'" . $Date_debut . "'";
            //     $cond2 = 'Reglementcommercials.date>=' . "'" . $Date_debut . "'";
            //     $cond3 = 'Bonusmaluscommercials.dateoperation>=' . "'" . $Date_debut . "'";
            // }

            // if ($this->request->getQuery()['Date_fin'] != '__/__/____') {
            //     // $Date_fin = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery['Date_fin'])));
            //     $cond4 = 'Bonlivraisons.date<=' . "'" . $Date_fin . "'";
            //     $cond5 = 'Reglementcommercials.date<=' . "'" . $Date_fin . "'";
            //     $cond6 = 'Bonusmaluscommercials.dateoperation<=' . "'" . $Date_fin . "'";
            // }
            if ($this->request->getQuery()['commercial_id']) {
                $commercial_id = $this->request->getQuery()['commercial_id'];
                $cond7 = 'Bonlivraisons.commercial_id=' . $commercial_id;
                $cond8 = 'Reglementcommercials.commercial_id=' . $commercial_id;
                $cond9 = 'Bonusmaluscommercials.commercial_id=' . $commercial_id;
            }
            $reglementcommercials = $this->Reglementcommercials->find('all')->where([$cond2, $cond5, $cond8]);

            $reglist = 0;
            foreach ($reglementcommercials as $reg) {
                $reglist = $reglist . ',' . $reg->id;
            }
            $Lignereglementcommercials = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id   in (' . $reglist . ')']);
            // debug($Lignereglementcommercials);
            // debug($reglementcommercials);
            $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
            foreach ($Lignereglementcommercials as $ligre) {
                $regs = $this->Reglementcommercials->find('all')->where(['Reglementcommercials.id=' . $ligre['reglementcommercial_id']]);
                foreach ($regs as $li) {
                    $tablignelivraisons['numero'] = $li['numero'];
                    $tablignelivraisons['date'] = $li['date'];
                }
                $tablignelivraisons['type'] = "Reglement";
                $tablignelivraisons['debit'] = $ligre['montant'];
                $tablignelivraisons['credit'] = 0;
                $tablignelivraisons['typ'] = "1";
                //$this->fetchTable('Relevercommercials')->save($tablignelivraisons);
            }
            $bonlivraisons = $this->Bonlivraisons->find('all')->where([$cond1, $cond4, $cond7]);
            $bonlist = 0;
            foreach ($bonlivraisons as $liv) {
                $bonlist = $bonlist . ',' . $liv->id;
            }
            $Lignebonlivraisons = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id   in (' . $bonlist . ')']);
            // debug($Lignebonlivraisons);
            // debug($bonlivraisons);
            $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
            foreach ($Lignebonlivraisons as $ligliv) {
                $liv = $this->Bonlivraisons->find('all')->where(['Bonlivraisons.id=' . $ligliv['bonlivraison_id']]);
                foreach ($liv as $li) {
                    $tablignelivraisons['numero'] = $ligliv['numero'];
                    $tablignelivraisons['date'] = $ligliv['date'];
                }
                $tablignelivraisons['type'] = "Bon Livraisons";
                $tablignelivraisons['debit'] = $ligliv['montantcommission'];
                $tablignelivraisons['credit'] = 0;
                $tablignelivraisons['typ'] = "2";
                //$this->fetchTable('Relevercommercials')->save($tablignelivraisons);
            }
            $bonusmaluscommercials = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9]);
            $bonuslist = 0;
            foreach ($bonusmaluscommercials as $bo) {
                $bonuslist = $bonuslist . ',' . $bo->id;
            }
            $Lignebonusmalus = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id   in (' . $bonuslist . ')', 'Lignebonusmalus.montant>0']);
            // debug($Lignebonusmalus); 
            $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
            foreach ($Lignebonusmalus as $lbm) {
                $liv = $this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.id=' . $lbm['bonusmaluscommercial_id']]);
                foreach ($liv as $li) {
                    $tablignelivraisons['numero'] = $li['numero'];
                    $tablignelivraisons['date'] = $li['date'];
                }
                $tablignelivraisons['type'] = "Bonus";
                $tablignelivraisons['debit'] = $lbm['montant'];
                $tablignelivraisons['credit'] = 0;
                $tablignelivraisons['typ'] = "2";
                //$this->fetchTable('Relevercommercials')->save($tablignelivraisons);
            }
            $Lignebonusmaluss = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id   in (' . $bonuslist . ')', 'Lignebonusmalus.montant<0']);
            $tablignelivraisons = $this->fetchTable('Relevercommercials')->newEmptyEntity();
            foreach ($Lignebonusmaluss as $lbms) {
                $livv = $this->Bonusmaluscommercials->find('all')->where(['Bonusmaluscommercials.id=' . $lbms['bonusmaluscommercial_id']]);
                foreach ($livv as $li) {
                    $tablignelivraisons['numero'] = $li['numero'];
                    $tablignelivraisons['date'] = $li['date'];
                }
                $tablignelivraisons['type'] = "Malus";
                $tablignelivraisons['debit'] = 0;
                $tablignelivraisons['credit'] = $lbm['montant'];
                $tablignelivraisons['typ'] = "1";


                //$this->fetchTable('Relevercommercials')->save($tablignelivraisons);
            }
            $rel = $this->Relevercommercials->find('all')->order(['Relevercommercials.date,Relevercommercials.typ' => 'desc']);
        }

        $this->loadModel('Commercials');
        //debug($relefes); 
        //  die;
        $commercials = $this->Commercials->find('list', ['limit' => 200]);




        $this->set(compact('rel',  'commercials'));
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
        $relevercommercial = $this->Relevercommercials->newEmptyEntity();
        if ($this->request->is('post')) {
            $relevercommercial = $this->Relevercommercials->patchEntity($relevercommercial, $this->request->getData());
            if ($this->Relevercommercials->save($relevercommercial)) {
                $this->Flash->success(__('The {0} has been saved.', 'Relevercommercial'));

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
        $relevercommercial = $this->Relevercommercials->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $relevercommercial = $this->Relevercommercials->patchEntity($relevercommercial, $this->request->getData());
            if ($this->Relevercommercials->save($relevercommercial)) {
                $this->Flash->success(__('The {0} has been saved.', 'Relevercommercial'));

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
        $this->request->allowMethod(['post', 'delete']);
        $relevercommercial = $this->Relevercommercials->get($id);
        if ($this->Relevercommercials->delete($relevercommercial)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Relevercommercial'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Relevercommercial'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
