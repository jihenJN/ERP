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
