<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

use Cake\Datasource\ConnectionManager;
use Cake\Core\Configure;

/**
 * Bordereauversementcheques Controller
 *
 * @property Bordereauversementcheque $Bordereauversementcheque
 */
class BordereauversementchequesController extends AppController
{

    /**
     * index method
     *
     * @return void
     */
    public function index($type = null)
    {
        error_reporting(E_ERROR | E_PARSE);

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';

        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $compte_id = $this->request->getQuery('compte_id');
        $bordereauversementcheque_id = $this->request->getQuery('bordereauversementcheque_id');
        $montant = $this->request->getQuery('montant');

        if ($montant) {
            $cond5 = "Bordereauversementcheques.montanttotal  =  '" .     $montant . "' ";
        }
        if ($bordereauversementcheque_id) {
            $cond4 = "Bordereauversementcheques.id  =  '" .     $bordereauversementcheque_id . "' ";
        }
        if ($datedebut != '') {
            $cond1 = 'date(Bordereauversementcheques.date) >= ' . "'" . $datedebut . "'";
        }
        if ($datefin != '') {
            $cond2 = 'date(Bordereauversementcheques.date) <= ' . "'" . $datefin . "'";
        }
        if ($compte_id) {
            $cond3 = "Bordereauversementcheques.compte_id  =  '" . $compte_id . "' ";
        }

        $condtyp = "Bordereauversementcheques.type=" . $type;

        $this->paginate = [
            'contain' => ['Comptes'],
        ];
        $query = $this->Bordereauversementcheques->find('all')->where([$cond1, $cond2, $cond3, $condtyp, $cond4, $cond5])->order(['Bordereauversementcheques.id' => 'DESC']);

        //debug($query);



        $bordereauversementcheques = $this->paginate($query);


        $comptes = $this->fetchTable('Comptes')->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        // debug($depots->toarray());
        $bordereaus = $this->fetchTable('Bordereauversementcheques')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return  $row['numero'];
            }
        ]);
        $this->set(compact('bordereauversementcheques', 'bordereaus', 'comptes', 'type'));
    }
    public function index29122024()
    {
        //Configure::write('debug', true);
        $query = $this->Bordereauversementcheques->find('all', array('recursive' => 2, 'order' => array('Bordereauversementcheques.numero ASC')));
        $this->paginate = [
            'contain' => ['Comptes'],
        ];
        $bordereauversementcheques = $this->paginate($query);
        $this->set(compact('bordereauversementcheques'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        //  Configure::write('debug', true);

        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');
        $this->loadModel('Coffres');
        $bordereauversementcheque = $this->Bordereauversementcheques->get($id, [
            'contain' => [],
        ]);
        $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
        $codeobj = $this->Bordereauversementcheques->find()->select(["numero" =>
        'MAX(Bordereauversementcheques.numero)'])->first();
        $num = $codeobj->numero;
        if ($num != null) {

            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $mm = str_pad($nn, 6, "0", STR_PAD_LEFT);
            //debug($numero);
        } else {
            $mm = "000001";
        }


        $comptes = $this->Bordereauversementcheques->Comptes->find('list', [
            'contain' => ['Agences'], // Inclut les données des agences
            'keyField' => 'id', // Remplace 'id' par la clé primaire que tu utilises
            'valueField' => function ($row) {
                return $row->numero . ' - ' . $row->agence->name;
            }
        ]);

        $this->set(compact('comptes', 'bordereauversementcheque', 'piecereglementtraites', 'date', 'compte_id', 'mm', 'lignebordereauversementcheques'));
    }
    public function imprimer($id = null)
    {
        //Configure::write('debug', true);
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');
        $this->loadModel('Coffres');
        $bordereauversementcheque = $this->Bordereauversementcheques->get($id, [
            'contain' => ['Comptes'],
        ]);
        $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));


        $this->set(compact('bordereauversementcheque',  'lignebordereauversementcheques'));
        $this->viewBuilder()->setLayout('print');
    }
    public function imprimertr($id = null)
    {
        //Configure::write('debug', true);
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');
        $this->loadModel('Coffres');
        $bordereauversementcheque = $this->Bordereauversementcheques->get($id, [
            'contain' => ['Comptes'],
        ]);
        $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));


        $this->set(compact('bordereauversementcheque',  'lignebordereauversementcheques'));
        $this->viewBuilder()->setLayout('print');
    }
    /**
     * add method
     *
     * @return void
     */
    public function add($type = null, $compte_id = null, $date = null, $datefin = null, $dateimp = null)
    {
       // Configure::write('debug', true);

        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');

        $this->loadModel('Coffres');
        $this->loadModel('Comptes');

        $connection = ConnectionManager::get('default');
        $bordereauversementcheque = $this->Bordereauversementcheques->newEmptyEntity();
        if ($this->request->is('post')) {
            // debug($this->request->getData('data'));die;

            $bordereauversementcheque = $this->Bordereauversementcheques->patchEntity($bordereauversementcheque, $this->request->getData());
            if ($this->Bordereauversementcheques->save($bordereauversementcheque)) {
                $bordereauvers = $bordereauversementcheque->id;
                $mnt = 0;
                $k = 0;

                if (isset($this->request->getData('data')['lignebordereauversementcheques']) && (!empty($this->request->getData('data')['lignebordereauversementcheques']))) {

                    foreach ($this->request->getData('data')['lignebordereauversementcheques'] as $i => $lc) {



                        if (@$lc['coffre_id_hidden'] != '0') {
                            $k++;
                            // $tab[1] = $lc['coffre_id'];
                            $tab[1] = $lc['piecereglementclient_id'];
                            $piecereglementcheques = $this->Piecereglementclients->find('all', [
                                'conditions' => ['Piecereglementclients.id' => $lc['piecereglementclient_id']],
                                'contain' => ['Reglementclients']
                            ])->first();
                            $Ligne['bordereauversementcheque_id'] = $bordereauvers;
                            $Ligne['client_id'] = @$piecereglementcheques->reglementclient->client_id;
                            $Ligne['numpiece'] = @$piecereglementcheques->num;
                            $Ligne['coffre_id'] = 0;
                            $Ligne['piecereglementclient_id'] = @$tab[1];

                            $Ligne['etat_id'] = @$piecereglementcheques->etat_id;
                            $Ligne['echance'] = $piecereglementcheques->echance;
                            $Ligne['banque'] = @$piecereglementcheques->banque_id;
                            $Ligne['situation'] = @$piecereglementcheques->situation;
                            $Ligne['montant'] = @$piecereglementcheques->montant;
                            $mnt = $mnt + @$piecereglementcheques->montant;

                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->newEmptyEntity();
                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->patchEntity($lignebordereauversementcheque, $Ligne);

                            $this->Lignebordereauversementcheques->save($lignebordereauversementcheque);

                            $ligne['compte_id'] = $this->request->getData('compte_id');
                            $ligne['etat_id'] = 9;
                            $ligne['coffre_id'] = 0;
                            $ligne['piecereglementclient_id'] = @$tab[1];
                            $ligne['date'] = $this->request->getData('date');

                            $ligntraite = $this->Etattraites->newEmptyEntity();
                            $ligntraite = $this->Etattraites->patchEntity($ligntraite, $ligne);

                            $this->Etattraites->save($ligntraite);

                            $compte_id = $ligne['compte_id'];
                            $connection = ConnectionManager::get('default');

                            $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte_id=" . $compte_id . "  WHERE id=" . $tab[1] . ";")->fetchAll('assoc');
                        }
                    }
                }
                $connection = ConnectionManager::get('default');
                $requetteupdate = $connection->execute("UPDATE `bordereauversementcheques` SET `montanttotal`=" . $mnt . " , Nomberpiece=" . $k . "  WHERE id=" . $bordereauvers . ";")->fetchAll('assoc');

                if ($this->request->getQuery('print')) {
                    return $this->redirect(['action' =>'index/' . $type, '?' => ['print' => 1,'id'=>$bordereauversementcheque->id]]);
                }
                //$this->Session->setFlash(__('The Bordereauversementcheque has been saved'));
                $this->redirect(array('action' => 'index/' . $type));
            } else {
                //$this->Session->setFlash(__('The Bordereauversementcheque could not be saved. Please, try again.'));
            }
        }

        $numero =$this->fetchTable('Bordereauversementcheques')->find()
            ->select([
                'numero' => $this->fetchTable('Bordereauversementcheques')->find()->func()->max('CAST(numero AS UNSIGNED)')
            ])
            ->where(['type' => $type])
            ->first();

        $num = $numero->numero;
        //debug($num);
        if ($num != null) {

            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $mm = str_pad($nn, 0, "0", STR_PAD_LEFT);
            //debug($numero);
        } else {
            $mm = "1";
        }
        $comptes = $this->Bordereauversementcheques->Comptes->find('list', [
            'contain' => ['Agences'], // Inclut les données des agences
            'keyField' => 'id', // Remplace 'id' par la clé primaire que tu utilises
            'valueField' => function ($row) {
                return $row->numero . ' - ' . $row->agence->name;
            }
        ]);
        //  if ($date == null) {
        // $date = date('Y-m-d');
        // }
        // if ($datefin == null) {
        // $datefin =date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));

        //}
        // if ($dateimp == null) {
        $dateimp = date('dd/MM/Y');
        // }
        if ($compte_id && $date) {

            $aas = $this->Piecereglementclients->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where([
                    'Piecereglementclients.paiement_id' => 2,
                    'Piecereglementclients.etat_id !=' => 9,
                    //'Piecereglementclients.etat_id IS NULL',
                    //  'Piecereglementclients.situation' => 'En attente',
                    'Date(Piecereglementclients.echance) ="' . $date . '"',
                    // 'Date(Piecereglementclients.echance) <="'.$datefin.'"' // assuming $date is properly formatted
                ]);
        }
        //  if ($compte_id) {
        //     $connection = ConnectionManager::get('default');
        //     $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));


        //     $aas = $this->fetchTable('Piecereglementclients')->find('all', [
        //         'contain' => ['Reglementclients', 'Banques']
        //     ])
        //         ->where(['echance' => $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
        //         ->all();
        // }
        //if ($compte_id) {
        //if ($type == 2) {
        /* $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));


        $aas = $this->fetchTable('Piecereglementclients')->find('all', [
            'contain' => ['Reglementclients', 'Banques']
        ])
            ->where([
                'Piecereglementclients.echance <=' => $dateauj,
                'Piecereglementclients.paiement_id IN' => [2],
                'Piecereglementclients.etat_id !=' => 9
            ])
            ->all();*/

        $stituation = 'En Attente';


        $this->set(compact('dateimp', 'datefin', 'type', 'date', 'compte_id', 'stituation', 'aas', 'cofs', 'bordereauversementcheque', 'comptes', 'compte_id', 'mm'));
    }

    public function addtr($type = null, $compte_id = null, $date = null, $datefin = null, $dateimp = null)
    {

        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');

        $this->loadModel('Coffres');
        $this->loadModel('Comptes');

        $connection = ConnectionManager::get('default');
        $bordereauversementcheque = $this->Bordereauversementcheques->newEmptyEntity();
        if ($this->request->is('post')) {
            //  debug($this->request->getData('data')); die;

            $bordereauversementcheque = $this->Bordereauversementcheques->patchEntity($bordereauversementcheque, $this->request->getData());
            if ($this->Bordereauversementcheques->save($bordereauversementcheque)) {
                $bordereauvers = $bordereauversementcheque->id;
                $mnt = 0;
                $k = 0;

                if (isset($this->request->getData('data')['lignebordereauversementcheques']) && (!empty($this->request->getData('data')['lignebordereauversementcheques']))) {

                    foreach ($this->request->getData('data')['lignebordereauversementcheques'] as $i => $lc) {



                        if (@$lc['coffre_id_hidden'] != '0') {
                            $k++;
                            // $tab[1] = $lc['coffre_id'];
                            $tab[1] = $lc['piecereglementclient_id'];
                            $piecereglementcheques = $this->Piecereglementclients->find('all', [
                                'conditions' => ['Piecereglementclients.id' => $lc['piecereglementclient_id']],
                                'contain' => ['Reglementclients']
                            ])->first();
                            $Ligne['bordereauversementcheque_id'] = $bordereauvers;
                            $Ligne['client_id'] = @$piecereglementcheques->reglementclient->client_id;
                            $Ligne['numpiece'] = @$piecereglementcheques->num;
                            $Ligne['coffre_id'] = 0;
                            $Ligne['piecereglementclient_id'] = @$tab[1];

                            $Ligne['etat_id'] = @$piecereglementcheques->etat_id;
                            $Ligne['echance'] = $piecereglementcheques->echance;
                            $Ligne['banque'] = @$piecereglementcheques->banque_id;
                            $Ligne['situation'] = @$piecereglementcheques->situation;
                            $Ligne['montant'] = @$piecereglementcheques->montant;
                            $mnt = $mnt + @$piecereglementcheques->montant;

                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->newEmptyEntity();
                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->patchEntity($lignebordereauversementcheque, $Ligne);

                            $this->Lignebordereauversementcheques->save($lignebordereauversementcheque);

                            $ligne['compte_id'] = $this->request->getData('compte_id');
                            $ligne['etat_id'] = 9;
                            $ligne['coffre_id'] = 0;
                            $ligne['piecereglementclient_id'] = @$tab[1];
                            $ligne['date'] = $this->request->getData('date');

                            $ligntraite = $this->Etattraites->newEmptyEntity();
                            $ligntraite = $this->Etattraites->patchEntity($ligntraite, $ligne);

                            $this->Etattraites->save($ligntraite);

                            $compte_id = $ligne['compte_id'];
                            $connection = ConnectionManager::get('default');

                            $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte_id=" . $compte_id . "  WHERE id=" . $tab[1] . ";")->fetchAll('assoc');
                        }
                    }
                }
                $connection = ConnectionManager::get('default');
                $requetteupdate = $connection->execute("UPDATE `bordereauversementcheques` SET `montanttotal`=" . $mnt . " , Nomberpiece=" . $k . "  WHERE id=" . $bordereauvers . ";")->fetchAll('assoc');

                if ($this->request->getQuery('print')) {
                    return $this->redirect(['action' =>'index/' . $type, '?' => ['print' => 1,'id'=>$bordereauversementcheque->id]]);
                }
                //$this->Session->setFlash(__('The Bordereauversementcheque has been saved'));
                $this->redirect(array('action' => 'index/' . $type));
            } else {
                //$this->Session->setFlash(__('The Bordereauversementcheque could not be saved. Please, try again.'));
            }
        }
        $numero =$this->fetchTable('Bordereauversementcheques')->find()
        ->select([
            'numero' => $this->fetchTable('Bordereauversementcheques')->find()->func()->max('CAST(numero AS UNSIGNED)')
        ])
        ->where(['type' => $type])
        ->first();

        $num = $numero->numero;
        if ($num != null) {

            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $mm = str_pad($nn, 0, "0", STR_PAD_LEFT);
            //debug($numero);
        } else {
            $mm = "1";
        }
        $comptes = $this->Bordereauversementcheques->Comptes->find('list', [
            'contain' => ['Agences'], // Inclut les données des agences
            'keyField' => 'id', // Remplace 'id' par la clé primaire que tu utilises
            'valueField' => function ($row) {
                return $row->numero . ' - ' . $row->agence->name;
            }
        ]);
        if (empty($date)) {
            $date = date('Y-m-d');
            // var_dump($date);
        }
        //if ($datefin === null) {
        $datefin = date('Y-m-d', strtotime($date . ' +20 day'));
        //ar_dump($datefin);
        // }

        // if ($datefin == null) {
        //     $datefin = date('dd/MM/Y');
        // }
        // if ($dateimp == null) {
        $dateimp = date('dd/MM/Y');
        //}
        // if ($compte_id && $date) {

        //     $aas = $this->Piecereglementclients->find('all', [
        //         'contain' => ['Reglementclients', 'Banques']
        //     ])
        //         ->where([
        //             'Piecereglementclients.paiement_id' => 2,
        //             'Piecereglementclients.etat_id IS NULL',
        //             'Piecereglementclients.situation' => 'En attente',
        //             'Date(Piecereglementclients.echance) >="'.$date.'"',
        //             'Date(Piecereglementclients.echance) <="'.$datefin.'"' // assuming $date is properly formatted
        //         ]);
        // }
        /* if ($compte_id) {
            $connection = ConnectionManager::get('default');
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));


            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance' => $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
                ->all();
        }*/
        // if ($compte_id) {
        //     if ($type == 2) {
        //         $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));

        //         $aas = $this->fetchTable('Piecereglementclients')->find('all', [
        //             'contain' => ['Reglementclients', 'Banques']
        //         ])
        //             ->where(['echance <=' . $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
        //             ->all();
        //     } else {
        $dateauj = date('Y-m-d', strtotime($date . '+20 days'));

        $aas = $this->fetchTable('Piecereglementclients')->find('all', [
            'contain' => ['Reglementclients', 'Banques']
        ])
            ->where([
                'Piecereglementclients.echance >=' => $date,
                'Piecereglementclients.paiement_id IN' => [3],
                'Piecereglementclients.etat_id !=' => 9
            ])
            ->all();

        // }
        // debug($aas->toArray());
        // }
        $stituation = 'En Attente';


        $this->set(compact('dateimp', 'datefin', 'type', 'date', 'compte_id', 'stituation', 'aas', 'cofs', 'bordereauversementcheque', 'comptes', 'compte_id', 'mm'));
    }
    public function addes($type = null, $compte_id = null, $date = null, $datefin = null, $dateimp = null)
    {

        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');

        $this->loadModel('Coffres');
        $this->loadModel('Comptes');

        $connection = ConnectionManager::get('default');
        $bordereauversementcheque = $this->Bordereauversementcheques->newEmptyEntity();
        if ($this->request->is('post')) {
            //  debug($this->request->getData('data')); die;

            $bordereauversementcheque = $this->Bordereauversementcheques->patchEntity($bordereauversementcheque, $this->request->getData());
            if ($this->Bordereauversementcheques->save($bordereauversementcheque)) {
                $bordereauvers = $bordereauversementcheque->id;
                $mnt = 0;
                $k = 0;

                if (isset($this->request->getData('data')['lignebordereauversementcheques']) && (!empty($this->request->getData('data')['lignebordereauversementcheques']))) {

                    foreach ($this->request->getData('data')['lignebordereauversementcheques'] as $i => $lc) {



                        if (@$lc['coffre_id_hidden'] != '0') {
                            $k++;
                            // $tab[1] = $lc['coffre_id'];
                            $tab[1] = $lc['piecereglementclient_id'];
                            $piecereglementcheques = $this->Piecereglementclients->find('all', [
                                'conditions' => ['Piecereglementclients.id' => $lc['piecereglementclient_id']],
                                'contain' => ['Reglementclients']
                            ])->first();
                            $Ligne['bordereauversementcheque_id'] = $bordereauvers;
                            $Ligne['client_id'] = @$piecereglementcheques->reglementclient->client_id;
                            $Ligne['numpiece'] = @$piecereglementcheques->num;
                            $Ligne['coffre_id'] = 0;
                            $Ligne['piecereglementclient_id'] = @$tab[1];

                            $Ligne['etat_id'] = @$piecereglementcheques->etat_id;
                            $Ligne['echance'] = $piecereglementcheques->echance;
                            $Ligne['banque'] = @$piecereglementcheques->banque_id;
                            $Ligne['situation'] = @$piecereglementcheques->situation;
                            $Ligne['montant'] = @$piecereglementcheques->montant;
                            $mnt = $mnt + @$piecereglementcheques->montant;

                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->newEmptyEntity();
                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->patchEntity($lignebordereauversementcheque, $Ligne);

                            $this->Lignebordereauversementcheques->save($lignebordereauversementcheque);

                            $ligne['compte_id'] = $this->request->getData('compte_id');
                            $ligne['etat_id'] = 9;
                            $ligne['coffre_id'] = 0;
                            $ligne['piecereglementclient_id'] = @$tab[1];
                            $ligne['date'] = $this->request->getData('date');

                            $ligntraite = $this->Etattraites->newEmptyEntity();
                            $ligntraite = $this->Etattraites->patchEntity($ligntraite, $ligne);

                            $this->Etattraites->save($ligntraite);

                            $compte_id = $ligne['compte_id'];
                            $connection = ConnectionManager::get('default');

                            $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte_id=" . $compte_id . "  WHERE id=" . $tab[1] . ";")->fetchAll('assoc');
                        }
                    }
                }
                $connection = ConnectionManager::get('default');
                $requetteupdate = $connection->execute("UPDATE `bordereauversementcheques` SET `montanttotal`=" . $mnt . " , Nomberpiece=" . $k . "  WHERE id=" . $bordereauvers . ";")->fetchAll('assoc');

                if ($this->request->getQuery('print')) {
                    return $this->redirect(['action' =>'index/' . $type, '?' => ['print' => 1,'id'=>$bordereauversementcheque->id]]);
                }
                //$this->Session->setFlash(__('The Bordereauversementcheque has been saved'));
                $this->redirect(array('action' => 'index/' . $type));
            } else {
                //$this->Session->setFlash(__('The Bordereauversementcheque could not be saved. Please, try again.'));
            }
        }
        $numero =$this->fetchTable('Bordereauversementcheques')->find()
        ->select([
            'numero' => $this->fetchTable('Bordereauversementcheques')->find()->func()->max('CAST(numero AS UNSIGNED)')
        ])
        ->where(['type' => $type])
        ->first();

        $num = $numero->numero;
        if ($num != null) {

            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $mm = str_pad($nn, 0, "0", STR_PAD_LEFT);
            //debug($numero);
        } else {
            $mm = "1";
        }
        $comptes = $this->Bordereauversementcheques->Comptes->find('list', [
            'contain' => ['Agences'], // Inclut les données des agences
            'keyField' => 'id', // Remplace 'id' par la clé primaire que tu utilises
            'valueField' => function ($row) {
                return $row->numero . ' - ' . $row->agence->name;
            }
        ]);
        if (empty($date)) {
            $date = date('Y-m-d');
            // var_dump($date);
        }
        //if ($datefin === null) {
        $datefin = date('Y-m-d', strtotime($date . ' +20 day'));
        //ar_dump($datefin);
        // }

        // if ($datefin == null) {
        //     $datefin = date('dd/MM/Y');
        // }
        // if ($dateimp == null) {
        $dateimp = date('dd/MM/Y');
        //}
        // if ($compte_id && $date) {

        //     $aas = $this->Piecereglementclients->find('all', [
        //         'contain' => ['Reglementclients', 'Banques']
        //     ])
        //         ->where([
        //             'Piecereglementclients.paiement_id' => 2,
        //             'Piecereglementclients.etat_id IS NULL',
        //             'Piecereglementclients.situation' => 'En attente',
        //             'Date(Piecereglementclients.echance) >="'.$date.'"',
        //             'Date(Piecereglementclients.echance) <="'.$datefin.'"' // assuming $date is properly formatted
        //         ]);
        // }
        /* if ($compte_id) {
            $connection = ConnectionManager::get('default');
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));


            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance' => $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
                ->all();
        }*/
        // if ($compte_id) {
        //     if ($type == 2) {
        //         $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));

        //         $aas = $this->fetchTable('Piecereglementclients')->find('all', [
        //             'contain' => ['Reglementclients', 'Banques']
        //         ])
        //             ->where(['echance <=' . $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
        //             ->all();
        //     } else {
        $dateauj = date('Y-m-d', strtotime($date . '+20 days'));

        $aas = $this->fetchTable('Piecereglementclients')->find('all', [
            'contain' => ['Reglementclients', 'Banques']
        ])
            ->where([
                'Piecereglementclients.echance >=' => $date,
                'Piecereglementclients.paiement_id IN' => [3],
                'Piecereglementclients.etat_id !=' => 9
            ])
            ->all();

        // }
        // debug($aas->toArray());
        // }
        $stituation = 'En Attente';


        $this->set(compact('dateimp', 'datefin', 'type', 'date', 'compte_id', 'stituation', 'aas', 'cofs', 'bordereauversementcheque', 'comptes', 'compte_id', 'mm'));
    }
    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null, $compte_id = null, $date = null, $datefin = null, $dateimp = null)
    {
        // Configure::write('debug', true);
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');
        $this->loadModel('Coffres');
        $bordereauversementcheque = $this->Bordereauversementcheques->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is('post') || $this->request->is('put')) {
            $bordereauversementcheque = $this->Bordereauversementcheques->patchEntity($bordereauversementcheque, $this->request->getData());

            if ($this->Bordereauversementcheques->save($bordereauversementcheque)) {

                $bordereauvers = $bordereauversementcheque->id;
                $ligne = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
                foreach ($ligne as $l) {

                    $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $l['piecereglementclient_id'])))->first();
                    $connection = ConnectionManager::get('default');

                    $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=1 , compte_id=NULL  WHERE id=" . $l['piecereglementclient_id'] . ";")->fetchAll('assoc');

                    $this->Etattraites->deleteAll(array('Etattraites.piecereglementclient_id' => $l['piecereglementclient_id'], 'Etattraites.etat_id' => 9), false);

                    $this->Lignebordereauversementcheques->delete($l);
                }
                $mnt = 0;
                $k = 0;
                if (isset($this->request->getData('data')['lignebordereauversementcheques']) && (!empty($this->request->getData('data')['lignebordereauversementcheques']))) {

                    foreach ($this->request->getData('data')['lignebordereauversementcheques'] as $i => $lc) {



                        if (@$lc['coffre_id_hidden'] != '0') {
                            $k++;
                            $tab[1] = $lc['piecereglementclient_id'];


                            $piecereglementcheques = $this->Piecereglementclients->find('all', [
                                'conditions' => ['Piecereglementclients.id' => $tab[1]],
                                'contain' => ['Reglementclients']
                            ])->first();
                            $Ligne['bordereauversementcheque_id'] = $bordereauvers;
                            $Ligne['client_id'] = @$piecereglementcheques->reglementclient->client_id;
                            $Ligne['numpiece'] = @$piecereglementcheques->num;
                            $Ligne['coffre_id'] = 0;
                            $Ligne['piecereglementclient_id'] = @$tab[1];

                            $Ligne['etat_id'] = @$piecereglementcheques->etat_id;
                            $Ligne['echance'] = $piecereglementcheques->echance;
                            $Ligne['banque'] = @$piecereglementcheques->banque_id;
                            $Ligne['situation'] = @$piecereglementcheques->situation;
                            $Ligne['montant'] = @$piecereglementcheques->montant;
                            $mnt = $mnt + @$piecereglementcheques->montant;

                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->newEmptyEntity();
                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->patchEntity($lignebordereauversementcheque, $Ligne);

                            $this->Lignebordereauversementcheques->save($lignebordereauversementcheque);
                            $compte_id = $this->request->getData('compte_id');
                            $lignee['compte_id'] = $compte_id;
                            $lignee['etat_id'] = 9;
                            $lignee['coffre_id'] = 0;
                            $lignee['piecereglementclient_id'] = @$tab[1];
                            $lignee['date'] = $this->request->getData('date');

                            $ligntraite = $this->Etattraites->newEmptyEntity();
                            $ligntraite = $this->Etattraites->patchEntity($ligntraite, $lignee);

                            $this->Etattraites->save($ligntraite);

                            $compte_id = $lignee['compte_id'];
                            $connection = ConnectionManager::get('default');

                            $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte_id=" . $compte_id . "  WHERE id=" . $tab[1] . ";")->fetchAll('assoc');
                        }
                    }
                }
                $connection = ConnectionManager::get('default');
                $requetteupdate = $connection->execute("UPDATE `bordereauversementcheques` SET `montanttotal`=" . $mnt . " , Nomberpiece=" . $k . "  WHERE id=" . $bordereauvers . ";")->fetchAll('assoc');


                //   $this->Session->setFlash(__('The Bordereauversementcheque has been saved'));
                $this->redirect(array('action' => 'index/' . $bordereauversementcheque->type));
            } else {
                //$this->Session->setFlash(__('The Bordereauversementcheque could not be saved. Please, try again.'));
            }
        }
        $type = $bordereauversementcheque->type;
        $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
        $codeobj = $this->Bordereauversementcheques->find()->select(["numero" =>
        'MAX(Bordereauversementcheques.numero)'])
            ->where(['Bordereauversementcheques.type=' . $bordereauversementcheque->type])
            ->first();
        $num = $codeobj->numero;
        if ($num != null) {

            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $mm = str_pad($nn, 6, "0", STR_PAD_LEFT);
            //debug($numero);
        } else {
            $mm = "000001";
        }


        $comptes = $this->Bordereauversementcheques->Comptes->find('list', [
            'contain' => ['Agences'], // Inclut les données des agences
            'keyField' => 'id', // Remplace 'id' par la clé primaire que tu utilises
            'valueField' => function ($row) {
                return $row->numero . ' - ' . $row->agence->name;
            }
        ]);

        if (empty($date)) {
            $time = new FrozenTime($bordereauversementcheque->date);
            $date = $time->i18nFormat('Y-MM-dd');
        }
        if (empty($datefin)) {
            $time1 = new FrozenTime($bordereauversementcheque->datefin);
            $datefin = $time1->i18nFormat('Y-MM-dd');
        }
        if (empty($dateimp)) {
            $time2 = new FrozenTime($bordereauversementcheque->dateimp);
            $dateimp = $time2->i18nFormat('Y-MM-dd');
        }
        // var_dump($datefin);
        // $aas = $this->Piecereglementclients->find('all', [
        //     'contain' => ['Reglementclients', 'Banques']
        // ])
        //     ->where([
        //         'Piecereglementclients.paiement_id' => 2,
        //         'Piecereglementclients.etat_id IS NULL',
        //         'Piecereglementclients.situation="En attente"',
        //         'Date(Piecereglementclients.echance) >="' . $date . '"',
        //         'Date(Piecereglementclients.echance) <="' . $datefin . '"' // assuming $date is properly formatted
        //     ]);
        //debug($aas);
        $connection = ConnectionManager::get('default');

        // $echeances = $connection->execute("SELECT * from piecereglementclients where  echance ='" . $dateauj . "' and  paiement_id in (2,3)")->fetchAll('assoc');
        if ($type == 2) {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
                ->all();
        } else {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' -20 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 3, 'Piecereglementclients.etat_id =1'])
                ->all();
        }
        $this->set(compact('dateimp', 'datefin', 'aas', 'type', 'comptes', 'bordereauversementcheque', 'date', 'compte_id', 'mm', 'lignebordereauversementcheques'));
    }
    public function edittr($id = null, $compte_id = null, $date = null, $datefin = null, $dateimp = null)
    {
        // Configure::write('debug', true);
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');
        $this->loadModel('Coffres');
        $bordereauversementcheque = $this->Bordereauversementcheques->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is('post') || $this->request->is('put')) {
            $bordereauversementcheque = $this->Bordereauversementcheques->patchEntity($bordereauversementcheque, $this->request->getData());

            if ($this->Bordereauversementcheques->save($bordereauversementcheque)) {

                $bordereauvers = $bordereauversementcheque->id;
                $ligne = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
                foreach ($ligne as $l) {

                    $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $l['piecereglementclient_id'])))->first();
                    $connection = ConnectionManager::get('default');

                    $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=1 , compte_id=NULL  WHERE id=" . $l['piecereglementclient_id'] . ";")->fetchAll('assoc');

                    $this->Etattraites->deleteAll(array('Etattraites.piecereglementclient_id' => $l['piecereglementclient_id'], 'Etattraites.etat_id' => 9), false);

                    $this->Lignebordereauversementcheques->delete($l);
                }
                $mnt = 0;
                $k = 0;
                if (isset($this->request->getData('data')['lignebordereauversementcheques']) && (!empty($this->request->getData('data')['lignebordereauversementcheques']))) {

                    foreach ($this->request->getData('data')['lignebordereauversementcheques'] as $i => $lc) {



                        if (@$lc['coffre_id_hidden'] != '0') {
                            $k++;
                            $tab[1] = $lc['piecereglementclient_id'];


                            $piecereglementcheques = $this->Piecereglementclients->find('all', [
                                'conditions' => ['Piecereglementclients.id' => $tab[1]],
                                'contain' => ['Reglementclients']
                            ])->first();
                            $Ligne['bordereauversementcheque_id'] = $bordereauvers;
                            $Ligne['client_id'] = @$piecereglementcheques->reglementclient->client_id;
                            $Ligne['numpiece'] = @$piecereglementcheques->num;
                            $Ligne['coffre_id'] = 0;
                            $Ligne['piecereglementclient_id'] = @$tab[1];

                            $Ligne['etat_id'] = @$piecereglementcheques->etat_id;
                            $Ligne['echance'] = $piecereglementcheques->echance;
                            $Ligne['banque'] = @$piecereglementcheques->banque_id;
                            $Ligne['situation'] = @$piecereglementcheques->situation;
                            $Ligne['montant'] = @$piecereglementcheques->montant;
                            $mnt = $mnt + @$piecereglementcheques->montant;

                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->newEmptyEntity();
                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->patchEntity($lignebordereauversementcheque, $Ligne);

                            $this->Lignebordereauversementcheques->save($lignebordereauversementcheque);
                            $compte_id = $this->request->getData('compte_id');
                            $lignee['compte_id'] = $compte_id;
                            $lignee['etat_id'] = 9;
                            $lignee['coffre_id'] = 0;
                            $lignee['piecereglementclient_id'] = @$tab[1];
                            $lignee['date'] = $this->request->getData('date');

                            $ligntraite = $this->Etattraites->newEmptyEntity();
                            $ligntraite = $this->Etattraites->patchEntity($ligntraite, $lignee);

                            $this->Etattraites->save($ligntraite);

                            $compte_id = $lignee['compte_id'];
                            $connection = ConnectionManager::get('default');

                            $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte_id=" . $compte_id . "  WHERE id=" . $tab[1] . ";")->fetchAll('assoc');
                        }
                    }
                }
                $connection = ConnectionManager::get('default');
                $requetteupdate = $connection->execute("UPDATE `bordereauversementcheques` SET `montanttotal`=" . $mnt . " , Nomberpiece=" . $k . "  WHERE id=" . $bordereauvers . ";")->fetchAll('assoc');


                //   $this->Session->setFlash(__('The Bordereauversementcheque has been saved'));
                $this->redirect(array('action' => 'index/' . $bordereauversementcheque->type));
            } else {
                //$this->Session->setFlash(__('The Bordereauversementcheque could not be saved. Please, try again.'));
            }
        }
        $type = $bordereauversementcheque->type;
        $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
        $codeobj = $this->Bordereauversementcheques->find()->select(["numero" =>
        'MAX(Bordereauversementcheques.numero)'])
            ->where(['Bordereauversementcheques.type=' . $bordereauversementcheque->type])
            ->first();
        $num = $codeobj->numero;
        if ($num != null) {

            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $mm = str_pad($nn, 6, "0", STR_PAD_LEFT);
            //debug($numero);
        } else {
            $mm = "000001";
        }


        $comptes = $this->Bordereauversementcheques->Comptes->find('list', [
            'contain' => ['Agences'], // Inclut les données des agences
            'keyField' => 'id', // Remplace 'id' par la clé primaire que tu utilises
            'valueField' => function ($row) {
                return $row->numero . ' - ' . $row->agence->name;
            }
        ]);

        if (empty($date)) {
            $time = new FrozenTime($bordereauversementcheque->date);
            $date = $time->i18nFormat('Y-MM-dd');
        }
        if (empty($datefin)) {
            $time1 = new FrozenTime($bordereauversementcheque->datefin);
            $datefin = $time1->i18nFormat('Y-MM-dd');
        }
        if (empty($dateimp)) {
            $time2 = new FrozenTime($bordereauversementcheque->dateimp);
            $dateimp = $time2->i18nFormat('Y-MM-dd');
        }
        // var_dump($datefin);
        // $aas = $this->Piecereglementclients->find('all', [
        //     'contain' => ['Reglementclients', 'Banques']
        // ])
        //     ->where([
        //         'Piecereglementclients.paiement_id' => 2,
        //         'Piecereglementclients.etat_id IS NULL',
        //         'Piecereglementclients.situation="En attente"',
        //         'Date(Piecereglementclients.echance) >="' . $date . '"',
        //         'Date(Piecereglementclients.echance) <="' . $datefin . '"' // assuming $date is properly formatted
        //     ]);
        //debug($aas);
        $connection = ConnectionManager::get('default');

        // $echeances = $connection->execute("SELECT * from piecereglementclients where  echance ='" . $dateauj . "' and  paiement_id in (2,3)")->fetchAll('assoc');
        if ($type == 2) {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
                ->all();
        } else {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' -20 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 3, 'Piecereglementclients.etat_id =1'])
                ->all();
        }
        $this->set(compact('dateimp', 'datefin', 'aas', 'type', 'comptes', 'bordereauversementcheque', 'date', 'compte_id', 'mm', 'lignebordereauversementcheques'));
    }
    public function viewtr($id = null, $compte_id = null, $date = null, $datefin = null, $dateimp = null)
    {
        // Configure::write('debug', true);
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');
        $this->loadModel('Coffres');
        $bordereauversementcheque = $this->Bordereauversementcheques->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is('post') || $this->request->is('put')) {
            $bordereauversementcheque = $this->Bordereauversementcheques->patchEntity($bordereauversementcheque, $this->request->getData());

            if ($this->Bordereauversementcheques->save($bordereauversementcheque)) {

                $bordereauvers = $bordereauversementcheque->id;
                $ligne = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
                foreach ($ligne as $l) {

                    $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $l['piecereglementclient_id'])))->first();
                    $connection = ConnectionManager::get('default');

                    $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=1 , compte_id=NULL  WHERE id=" . $l['piecereglementclient_id'] . ";")->fetchAll('assoc');

                    $this->Etattraites->deleteAll(array('Etattraites.piecereglementclient_id' => $l['piecereglementclient_id'], 'Etattraites.etat_id' => 9), false);

                    $this->Lignebordereauversementcheques->delete($l);
                }
                $mnt = 0;
                $k = 0;
                if (isset($this->request->getData('data')['lignebordereauversementcheques']) && (!empty($this->request->getData('data')['lignebordereauversementcheques']))) {

                    foreach ($this->request->getData('data')['lignebordereauversementcheques'] as $i => $lc) {



                        if (@$lc['coffre_id_hidden'] != '0') {
                            $k++;
                            $tab[1] = $lc['piecereglementclient_id'];


                            $piecereglementcheques = $this->Piecereglementclients->find('all', [
                                'conditions' => ['Piecereglementclients.id' => $tab[1]],
                                'contain' => ['Reglementclients']
                            ])->first();
                            $Ligne['bordereauversementcheque_id'] = $bordereauvers;
                            $Ligne['client_id'] = @$piecereglementcheques->reglementclient->client_id;
                            $Ligne['numpiece'] = @$piecereglementcheques->num;
                            $Ligne['coffre_id'] = 0;
                            $Ligne['piecereglementclient_id'] = @$tab[1];

                            $Ligne['etat_id'] = @$piecereglementcheques->etat_id;
                            $Ligne['echance'] = $piecereglementcheques->echance;
                            $Ligne['banque'] = @$piecereglementcheques->banque_id;
                            $Ligne['situation'] = @$piecereglementcheques->situation;
                            $Ligne['montant'] = @$piecereglementcheques->montant;
                            $mnt = $mnt + @$piecereglementcheques->montant;

                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->newEmptyEntity();
                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->patchEntity($lignebordereauversementcheque, $Ligne);

                            $this->Lignebordereauversementcheques->save($lignebordereauversementcheque);
                            $compte_id = $this->request->getData('compte_id');
                            $lignee['compte_id'] = $compte_id;
                            $lignee['etat_id'] = 9;
                            $lignee['coffre_id'] = 0;
                            $lignee['piecereglementclient_id'] = @$tab[1];
                            $lignee['date'] = $this->request->getData('date');

                            $ligntraite = $this->Etattraites->newEmptyEntity();
                            $ligntraite = $this->Etattraites->patchEntity($ligntraite, $lignee);

                            $this->Etattraites->save($ligntraite);

                            $compte_id = $lignee['compte_id'];
                            $connection = ConnectionManager::get('default');

                            $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte_id=" . $compte_id . "  WHERE id=" . $tab[1] . ";")->fetchAll('assoc');
                        }
                    }
                }
                $connection = ConnectionManager::get('default');
                $requetteupdate = $connection->execute("UPDATE `bordereauversementcheques` SET `montanttotal`=" . $mnt . " , Nomberpiece=" . $k . "  WHERE id=" . $bordereauvers . ";")->fetchAll('assoc');


                //   $this->Session->setFlash(__('The Bordereauversementcheque has been saved'));
                $this->redirect(array('action' => 'index/' . $bordereauversementcheque->type));
            } else {
                //$this->Session->setFlash(__('The Bordereauversementcheque could not be saved. Please, try again.'));
            }
        }
        $type = $bordereauversementcheque->type;
        $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
        $codeobj = $this->Bordereauversementcheques->find()->select(["numero" =>
        'MAX(Bordereauversementcheques.numero)'])
            ->where(['Bordereauversementcheques.type=' . $bordereauversementcheque->type])
            ->first();
        $num = $codeobj->numero;
        if ($num != null) {

            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $mm = str_pad($nn, 6, "0", STR_PAD_LEFT);
            //debug($numero);
        } else {
            $mm = "000001";
        }


        $comptes = $this->Bordereauversementcheques->Comptes->find('list', [
            'contain' => ['Agences'], // Inclut les données des agences
            'keyField' => 'id', // Remplace 'id' par la clé primaire que tu utilises
            'valueField' => function ($row) {
                return $row->numero . ' - ' . $row->agence->name;
            }
        ]);

        if (empty($date)) {
            $time = new FrozenTime($bordereauversementcheque->date);
            $date = $time->i18nFormat('Y-MM-dd');
        }
        if (empty($datefin)) {
            $time1 = new FrozenTime($bordereauversementcheque->datefin);
            $datefin = $time1->i18nFormat('Y-MM-dd');
        }
        if (empty($dateimp)) {
            $time2 = new FrozenTime($bordereauversementcheque->dateimp);
            $dateimp = $time2->i18nFormat('Y-MM-dd');
        }
        // var_dump($datefin);
        // $aas = $this->Piecereglementclients->find('all', [
        //     'contain' => ['Reglementclients', 'Banques']
        // ])
        //     ->where([
        //         'Piecereglementclients.paiement_id' => 2,
        //         'Piecereglementclients.etat_id IS NULL',
        //         'Piecereglementclients.situation="En attente"',
        //         'Date(Piecereglementclients.echance) >="' . $date . '"',
        //         'Date(Piecereglementclients.echance) <="' . $datefin . '"' // assuming $date is properly formatted
        //     ]);
        //debug($aas);
        $connection = ConnectionManager::get('default');

        // $echeances = $connection->execute("SELECT * from piecereglementclients where  echance ='" . $dateauj . "' and  paiement_id in (2,3)")->fetchAll('assoc');
        if ($type == 2) {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
                ->all();
        } else {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' -20 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 3, 'Piecereglementclients.etat_id =1'])
                ->all();
        }
        $this->set(compact('dateimp', 'datefin', 'aas', 'type', 'comptes', 'bordereauversementcheque', 'date', 'compte_id', 'mm', 'lignebordereauversementcheques'));
    }
    public function edites($id = null, $compte_id = null, $date = null, $datefin = null, $dateimp = null)
    {
        // Configure::write('debug', true);
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');
        $this->loadModel('Coffres');
        $bordereauversementcheque = $this->Bordereauversementcheques->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is('post') || $this->request->is('put')) {
            $bordereauversementcheque = $this->Bordereauversementcheques->patchEntity($bordereauversementcheque, $this->request->getData());

            if ($this->Bordereauversementcheques->save($bordereauversementcheque)) {

                $bordereauvers = $bordereauversementcheque->id;
                $ligne = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
                foreach ($ligne as $l) {

                    $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $l['piecereglementclient_id'])))->first();
                    $connection = ConnectionManager::get('default');

                    $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=1 , compte_id=NULL  WHERE id=" . $l['piecereglementclient_id'] . ";")->fetchAll('assoc');

                    $this->Etattraites->deleteAll(array('Etattraites.piecereglementclient_id' => $l['piecereglementclient_id'], 'Etattraites.etat_id' => 9), false);

                    $this->Lignebordereauversementcheques->delete($l);
                }
                $mnt = 0;
                $k = 0;
                if (isset($this->request->getData('data')['lignebordereauversementcheques']) && (!empty($this->request->getData('data')['lignebordereauversementcheques']))) {

                    foreach ($this->request->getData('data')['lignebordereauversementcheques'] as $i => $lc) {



                        if (@$lc['coffre_id_hidden'] != '0') {
                            $k++;
                            $tab[1] = $lc['piecereglementclient_id'];


                            $piecereglementcheques = $this->Piecereglementclients->find('all', [
                                'conditions' => ['Piecereglementclients.id' => $tab[1]],
                                'contain' => ['Reglementclients']
                            ])->first();
                            $Ligne['bordereauversementcheque_id'] = $bordereauvers;
                            $Ligne['client_id'] = @$piecereglementcheques->reglementclient->client_id;
                            $Ligne['numpiece'] = @$piecereglementcheques->num;
                            $Ligne['coffre_id'] = 0;
                            $Ligne['piecereglementclient_id'] = @$tab[1];

                            $Ligne['etat_id'] = @$piecereglementcheques->etat_id;
                            $Ligne['echance'] = $piecereglementcheques->echance;
                            $Ligne['banque'] = @$piecereglementcheques->banque_id;
                            $Ligne['situation'] = @$piecereglementcheques->situation;
                            $Ligne['montant'] = @$piecereglementcheques->montant;
                            $mnt = $mnt + @$piecereglementcheques->montant;

                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->newEmptyEntity();
                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->patchEntity($lignebordereauversementcheque, $Ligne);

                            $this->Lignebordereauversementcheques->save($lignebordereauversementcheque);
                            $compte_id = $this->request->getData('compte_id');
                            $lignee['compte_id'] = $compte_id;
                            $lignee['etat_id'] = 9;
                            $lignee['coffre_id'] = 0;
                            $lignee['piecereglementclient_id'] = @$tab[1];
                            $lignee['date'] = $this->request->getData('date');

                            $ligntraite = $this->Etattraites->newEmptyEntity();
                            $ligntraite = $this->Etattraites->patchEntity($ligntraite, $lignee);

                            $this->Etattraites->save($ligntraite);

                            $compte_id = $lignee['compte_id'];
                            $connection = ConnectionManager::get('default');

                            $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte_id=" . $compte_id . "  WHERE id=" . $tab[1] . ";")->fetchAll('assoc');
                        }
                    }
                }
                $connection = ConnectionManager::get('default');
                $requetteupdate = $connection->execute("UPDATE `bordereauversementcheques` SET `montanttotal`=" . $mnt . " , Nomberpiece=" . $k . "  WHERE id=" . $bordereauvers . ";")->fetchAll('assoc');


                //   $this->Session->setFlash(__('The Bordereauversementcheque has been saved'));
                $this->redirect(array('action' => 'index/' . $bordereauversementcheque->type));
            } else {
                //$this->Session->setFlash(__('The Bordereauversementcheque could not be saved. Please, try again.'));
            }
        }
        $type = $bordereauversementcheque->type;
        $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
        $codeobj = $this->Bordereauversementcheques->find()->select(["numero" =>
        'MAX(Bordereauversementcheques.numero)'])
            ->where(['Bordereauversementcheques.type=' . $bordereauversementcheque->type])
            ->first();
        $num = $codeobj->numero;
        if ($num != null) {

            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $mm = str_pad($nn, 6, "0", STR_PAD_LEFT);
            //debug($numero);
        } else {
            $mm = "000001";
        }


        $comptes = $this->Bordereauversementcheques->Comptes->find('list', [
            'contain' => ['Agences'], // Inclut les données des agences
            'keyField' => 'id', // Remplace 'id' par la clé primaire que tu utilises
            'valueField' => function ($row) {
                return $row->numero . ' - ' . $row->agence->name;
            }
        ]);

        if (empty($date)) {
            $time = new FrozenTime($bordereauversementcheque->date);
            $date = $time->i18nFormat('Y-MM-dd');
        }
        if (empty($datefin)) {
            $time1 = new FrozenTime($bordereauversementcheque->datefin);
            $datefin = $time1->i18nFormat('Y-MM-dd');
        }
        if (empty($dateimp)) {
            $time2 = new FrozenTime($bordereauversementcheque->dateimp);
            $dateimp = $time2->i18nFormat('Y-MM-dd');
        }
       
        $connection = ConnectionManager::get('default');

        // $echeances = $connection->execute("SELECT * from piecereglementclients where  echance ='" . $dateauj . "' and  paiement_id in (2,3)")->fetchAll('assoc');
        if ($type == 2) {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
                ->all();
        } else {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' -20 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 3, 'Piecereglementclients.etat_id =1'])
                ->all();
        }
        $this->set(compact('dateimp', 'datefin', 'aas', 'type', 'comptes', 'bordereauversementcheque', 'date', 'compte_id', 'mm', 'lignebordereauversementcheques'));
    }
    public function viewes($id = null, $compte_id = null, $date = null, $datefin = null, $dateimp = null)
    {
        // Configure::write('debug', true);
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Clients');
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Etattraites');
        $this->loadModel('Coffres');
        $bordereauversementcheque = $this->Bordereauversementcheques->get($id, [
            'contain' => [],
        ]);

        if ($this->request->is('post') || $this->request->is('put')) {
            $bordereauversementcheque = $this->Bordereauversementcheques->patchEntity($bordereauversementcheque, $this->request->getData());

            if ($this->Bordereauversementcheques->save($bordereauversementcheque)) {

                $bordereauvers = $bordereauversementcheque->id;
                $ligne = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
                foreach ($ligne as $l) {

                    $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $l['piecereglementclient_id'])))->first();
                    $connection = ConnectionManager::get('default');

                    $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=1 , compte_id=NULL  WHERE id=" . $l['piecereglementclient_id'] . ";")->fetchAll('assoc');

                    $this->Etattraites->deleteAll(array('Etattraites.piecereglementclient_id' => $l['piecereglementclient_id'], 'Etattraites.etat_id' => 9), false);

                    $this->Lignebordereauversementcheques->delete($l);
                }
                $mnt = 0;
                $k = 0;
                if (isset($this->request->getData('data')['lignebordereauversementcheques']) && (!empty($this->request->getData('data')['lignebordereauversementcheques']))) {

                    foreach ($this->request->getData('data')['lignebordereauversementcheques'] as $i => $lc) {



                        if (@$lc['coffre_id_hidden'] != '0') {
                            $k++;
                            $tab[1] = $lc['piecereglementclient_id'];


                            $piecereglementcheques = $this->Piecereglementclients->find('all', [
                                'conditions' => ['Piecereglementclients.id' => $tab[1]],
                                'contain' => ['Reglementclients']
                            ])->first();
                            $Ligne['bordereauversementcheque_id'] = $bordereauvers;
                            $Ligne['client_id'] = @$piecereglementcheques->reglementclient->client_id;
                            $Ligne['numpiece'] = @$piecereglementcheques->num;
                            $Ligne['coffre_id'] = 0;
                            $Ligne['piecereglementclient_id'] = @$tab[1];

                            $Ligne['etat_id'] = @$piecereglementcheques->etat_id;
                            $Ligne['echance'] = $piecereglementcheques->echance;
                            $Ligne['banque'] = @$piecereglementcheques->banque_id;
                            $Ligne['situation'] = @$piecereglementcheques->situation;
                            $Ligne['montant'] = @$piecereglementcheques->montant;
                            $mnt = $mnt + @$piecereglementcheques->montant;

                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->newEmptyEntity();
                            $lignebordereauversementcheque = $this->Lignebordereauversementcheques->patchEntity($lignebordereauversementcheque, $Ligne);

                            $this->Lignebordereauversementcheques->save($lignebordereauversementcheque);
                            $compte_id = $this->request->getData('compte_id');
                            $lignee['compte_id'] = $compte_id;
                            $lignee['etat_id'] = 9;
                            $lignee['coffre_id'] = 0;
                            $lignee['piecereglementclient_id'] = @$tab[1];
                            $lignee['date'] = $this->request->getData('date');

                            $ligntraite = $this->Etattraites->newEmptyEntity();
                            $ligntraite = $this->Etattraites->patchEntity($ligntraite, $lignee);

                            $this->Etattraites->save($ligntraite);

                            $compte_id = $lignee['compte_id'];
                            $connection = ConnectionManager::get('default');

                            $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=9 , compte_id=" . $compte_id . "  WHERE id=" . $tab[1] . ";")->fetchAll('assoc');
                        }
                    }
                }
                $connection = ConnectionManager::get('default');
                $requetteupdate = $connection->execute("UPDATE `bordereauversementcheques` SET `montanttotal`=" . $mnt . " , Nomberpiece=" . $k . "  WHERE id=" . $bordereauvers . ";")->fetchAll('assoc');


                //   $this->Session->setFlash(__('The Bordereauversementcheque has been saved'));
                $this->redirect(array('action' => 'index/' . $bordereauversementcheque->type));
            } else {
                //$this->Session->setFlash(__('The Bordereauversementcheque could not be saved. Please, try again.'));
            }
        }
        $type = $bordereauversementcheque->type;
        $lignebordereauversementcheques = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));
        $codeobj = $this->Bordereauversementcheques->find()->select(["numero" =>
        'MAX(Bordereauversementcheques.numero)'])
            ->where(['Bordereauversementcheques.type=' . $bordereauversementcheque->type])
            ->first();
        $num = $codeobj->numero;
        if ($num != null) {

            $n = $num;
            $lastnum = $n;
            $numo = intval($lastnum) + 1;
            $nn = (string)$numo;
            $mm = str_pad($nn, 6, "0", STR_PAD_LEFT);
            //debug($numero);
        } else {
            $mm = "000001";
        }


        $comptes = $this->Bordereauversementcheques->Comptes->find('list', [
            'contain' => ['Agences'], // Inclut les données des agences
            'keyField' => 'id', // Remplace 'id' par la clé primaire que tu utilises
            'valueField' => function ($row) {
                return $row->numero . ' - ' . $row->agence->name;
            }
        ]);

        if (empty($date)) {
            $time = new FrozenTime($bordereauversementcheque->date);
            $date = $time->i18nFormat('Y-MM-dd');
        }
        if (empty($datefin)) {
            $time1 = new FrozenTime($bordereauversementcheque->datefin);
            $datefin = $time1->i18nFormat('Y-MM-dd');
        }
        if (empty($dateimp)) {
            $time2 = new FrozenTime($bordereauversementcheque->dateimp);
            $dateimp = $time2->i18nFormat('Y-MM-dd');
        }
        // var_dump($datefin);
        // $aas = $this->Piecereglementclients->find('all', [
        //     'contain' => ['Reglementclients', 'Banques']
        // ])
        //     ->where([
        //         'Piecereglementclients.paiement_id' => 2,
        //         'Piecereglementclients.etat_id IS NULL',
        //         'Piecereglementclients.situation="En attente"',
        //         'Date(Piecereglementclients.echance) >="' . $date . '"',
        //         'Date(Piecereglementclients.echance) <="' . $datefin . '"' // assuming $date is properly formatted
        //     ]);
        //debug($aas);
        $connection = ConnectionManager::get('default');

        // $echeances = $connection->execute("SELECT * from piecereglementclients where  echance ='" . $dateauj . "' and  paiement_id in (2,3)")->fetchAll('assoc');
        if ($type == 2) {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' +1 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 2, 'Piecereglementclients.etat_id =1'])
                ->all();
        } else {
            $dateauj = date('Y-m-d', strtotime(date("Y-m-d") . ' -20 day'));

            $aas = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Banques']
            ])
                ->where(['echance <=' . $dateauj, 'paiement_id ' => 3, 'Piecereglementclients.etat_id =1'])
                ->all();
        }
        $this->set(compact('dateimp', 'datefin', 'aas', 'type', 'comptes', 'bordereauversementcheque', 'date', 'compte_id', 'mm', 'lignebordereauversementcheques'));
    }
    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete07012025($id = null)
    {
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Coffres');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Etattraites');

        $bordereauversementcheques = $this->Bordereauversementcheques->get($id);
        if ($this->Bordereauversementcheques->delete($bordereauversementcheques)) {
            $ligne = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));

            foreach ($ligne as $l) {

                $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $l['piecereglementclient_id'])))->first();
                //if ($piecereglementcheques['situation'] == "En attente") {
                $connection = ConnectionManager::get('default');

                $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=NULL , compte_id=NULL  WHERE id=" . $l['piecereglementclient_id'] . ";")->fetchAll('assoc');
                //}
                $etattraite = $this->FetchTable('Etattraites')->find('all')->where(['Etattraites.piecereglementclient_id' => $l['piecereglementclient_id'], 'Etattraites.etat_id' => 9]);
                $this->fetchTable('Etattraites')->deleteMany($etattraite);
            }
            $this->fetchTable('Lignebordereauversementcheques')->deleteMany($ligne);
            $this->redirect(array('action' => 'index/' . $bordereauversementcheques->type));
        }
        $this->redirect(array('action' => 'index'));
    }
    public function delete($id = null)
    {
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Coffres');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Etattraites');

        $bordereauversementcheques = $this->Bordereauversementcheques->get($id);
        if ($this->Bordereauversementcheques->delete($bordereauversementcheques)) {
            $ligne = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));

            foreach ($ligne as $l) {

                $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $l['piecereglementclient_id'])))->first();
                //if ($piecereglementcheques['situation'] == "En attente") {
                $connection = ConnectionManager::get('default');

                $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=1 , compte_id=NULL  WHERE id=" . $l['piecereglementclient_id'] . ";")->fetchAll('assoc');
                //}
                $etattraite = $this->FetchTable('Etattraites')->find('all')->where(['Etattraites.piecereglementclient_id' => $l['piecereglementclient_id'], 'Etattraites.etat_id' => 9]);
                $this->fetchTable('Etattraites')->deleteMany($etattraite);
            }
            $this->fetchTable('Lignebordereauversementcheques')->deleteMany($ligne);
            $this->redirect(array('action' => 'index/' . $bordereauversementcheques->type));
        }
        $this->redirect(array('action' => 'index'));
    }
    public function deletetr($id = null)
    {
        $this->loadModel('Lignebordereauversementcheques');
        $this->loadModel('Coffres');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Etattraites');

        $bordereauversementcheques = $this->Bordereauversementcheques->get($id);
        if ($this->Bordereauversementcheques->delete($bordereauversementcheques)) {
            $ligne = $this->Lignebordereauversementcheques->find('all', array('conditions' => array('Lignebordereauversementcheques.bordereauversementcheque_id' => $id)));

            foreach ($ligne as $l) {

                $piecereglementcheques = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $l['piecereglementclient_id'])))->first();
                //if ($piecereglementcheques['situation'] == "En attente") {
                $connection = ConnectionManager::get('default');

                $requetteupdate = $connection->execute("UPDATE `piecereglementclients` SET `etat_id`=1 , compte_id=NULL  WHERE id=" . $l['piecereglementclient_id'] . ";")->fetchAll('assoc');
                //}
                $etattraite = $this->FetchTable('Etattraites')->find('all')->where(['Etattraites.piecereglementclient_id' => $l['piecereglementclient_id'], 'Etattraites.etat_id' => 9]);
                $this->fetchTable('Etattraites')->deleteMany($etattraite);
            }
            $this->fetchTable('Lignebordereauversementcheques')->deleteMany($ligne);
            $this->redirect(array('action' => 'index/' . $bordereauversementcheques->type));
        }
        $this->redirect(array('action' => 'index'));
    }
}
