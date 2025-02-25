<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

/**
 * Retenus Controller
 *
 * @property \App\Model\Table\RetenusTable $Retenus
 * @method \App\Model\Entity\Retenus[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RetenusController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function index($type = null)
    {
        error_reporting(E_ERROR | E_PARSE);

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';

        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $client_id = $this->request->getQuery('client_id');


        if ($datedebut != '') {
            $cond1 = 'date(Retenus.date) >= ' . "'" . $datedebut . "'";
        }
        if ($datefin != '') {
            $cond2 = 'date(Retenus.date) <= ' . "'" . $datefin . "'";
        }
        if ($client_id) {
            $cond3 = "Retenus.client_id  =  '" . $client_id . "' ";
        }



        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $query = $this->Retenus->find('all')->where([$cond1, $cond2, $cond3])->order(['Retenus.id' => 'DESC']);

        //debug($query);



        $retenus = $this->paginate($query);


        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        // debug($depots->toarray());
        $this->set(compact('retenus', 'clients'));
    }

    /**
     * View method
     *
     * @param string|null $id Retenus id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $retenu = $this->Retenus->get($id, [
            'contain' => []
        ]);

        ///
        //debug($type);

        $this->loadModel('Ligneretenus');

        $lignes = $this->fetchTable('Ligneretenus')->find()->where(['Ligneretenus.retenu_id' => $id]);
        $l = [0];
        foreach ($lignes as $li) {
            if ($li['factureclient_id'] != 0) {
                $l[] = (int)$li['factureclient_id'];
            }
        }

        $factureclients = $this->fetchTable('Factureclients')->find('all')
            ->where([
                'Factureclients.client_id' => $retenu->client_id,
                'OR' => [
                    'Factureclients.Montant_Regler < Factureclients.totalttc',
                    'Factureclients.id IN' => $l
                ],
                // 'Factureclients.type' => 1
            ]);
        $tos = $this->fetchTable('Tos')->find('list', ['limit' => 200]);
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($art) {
                if ($art->Code != null) {
                    return $art->Code . ' -- ' . $art->Raison_Sociale;
                } else {
                    return $art->Raison_Sociale;
                }
            }
        ]);

        $this->set(compact('retenu', 'clients', 'lignes', 'tos', 'factureclients'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add1211()
    {
        $retenus = $this->Retenus->newEmptyEntity();
        if ($this->request->is('post')) {
            $retenus = $this->Retenus->patchEntity($retenus, $this->request->getData());
            if ($this->Retenus->save($retenus)) {
                $this->Flash->success(__('The retenus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The retenus could not be saved. Please, try again.'));
        }
        $clients = $this->Retenus->Clients->find('list', ['limit' => 200])->all();
        $this->set(compact('retenus', 'clients'));
    }
    public function add($idclient = null)
    {
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureclients');

        error_reporting(E_ERROR | E_PARSE);
        $retenu = $this->Retenus->newEmptyEntity();

        if ($this->request->is('post')) {

            $numeroobj = $this->Retenus->find()->select(["numerox" =>
            'MAX(Retenus.numero)'])->first();
            $numero = $numeroobj->numerox;
            if ($numero != null) {
                // debug($numero);

                $n = $numero;

                $lastnum = $n;
                $nume = intval($lastnum) + 1;
                $nn = (string)$nume;

                $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
                // debug($code);die;

            } else {
                $code = "00001";
            }
            $result = $this->request->getAttribute('authentication')->getIdentity();


            $retenu = $this->Retenus->patchEntity($retenu, $this->request->getData());
            //debug($retenu);
            if ($this->Retenus->save($retenu)) {

                $ret_id = ($this->Retenus->save($retenu)->id);

                $this->misejour("Retenus", "add", $ret_id);

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {

                    $this->loadModel('Ligneretenus');

                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {
                        if ($li['sup'] != 1 && (!empty($li['factureclient_id']))) {
                            //debug($dep['sup1']);
                            $data1['retenu_id'] = $retenu->id;
                            $data1['factureclient_id'] = $li['factureclient_id'];
                            $data1['date'] = $li['date'];
                            $data1['timbre_id'] = $li['timbre_id'];

                            $data1['montant'] = $li['montant'];
                            $data1['totalttc'] = $li['totalttc'];
                            $data1['to_id'] = $li['taux'];
                            $data1['montant_net'] = $li['montant_net'];



                            //debug($data1);die();
                            $ligneinv = $this->fetchTable('Ligneretenus')->newEmptyEntity(); //fetchtable pour creer une ligne vide avant de la remplir

                            $ligneinv = $this->Ligneretenus->patchEntity($ligneinv, $data1);
                            //debug($ligneinv);die ;

                            if ($this->Ligneretenus->save($ligneinv)) {
                                // $fact = $this->fetchTable('Factureclients')->get($data1['factureclient_id']);
                                // // debug($article);die;
                                // $fact->Montant_Regler =  $fact->Montant_Regler + $data1['montant'];
                                // $fact->testretenu =  1;
                                // $this->fetchTable('Factureclients')->save($fact);
                                // debug($lignelivraisons);
                            } else {
                            }
                        }
                    }
                }
                /**********************************/
                if ($this->request->getData('total') != '0' || $this->request->getData('total') != 0) {
                    /*******enregistrement reglement******************************/
                    $numeroobj = $this->fetchTable('Reglementclients')->find()->select(["numero" =>
                    'MAX(Reglementclients.numeroconca)'])->where(['Reglementclients.type=3'])->first();
                    $numero = $numeroobj->numero;
                    if ($numero != null) {

                        $nss = $numero;
                        $lastnum = $nss;
                        $nume = intval($lastnum) + 1;
                        $nn = (string)$nume;
                        $codee = str_pad($nn, 5, "0", STR_PAD_LEFT);
                    } else {
                        $codee = "00001";
                    }
                    $ligne = $this->fetchTable('Reglementclients')->newEmptyEntity();
                    $tab2['retenu_id'] = $retenu->id;
                    $tab2['client_id'] = $this->request->getData('client_id');
                    $tab2['numero'] = $nss;
                    $tab2['numeroconca'] = $codee;
                    $frozenTime = FrozenTime::now();
                    $tab2['date'] = $frozenTime;
                    $tab2['Montant'] = $this->request->getData('total');
                    $tab2['type'] = 3;
                    $tab2['user_id'] = $result['id'];
                    $tab2['differance'] = 0;
                    $tab2['dif']  = 0;

                    $ligne = $this->fetchTable('Reglementclients')->patchEntity($ligne, $tab2);
                    $this->fetchTable('Reglementclients')->save($ligne);
                    /*******enregistrement lignereglement******************************/
                    if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                        foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                            if (isset($l['factureclient_id'])) {
                                // Insertion dans Lignereglementclients
                                $ta = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                                $ta['reglementclient_id'] = $ligne->id; // ID du règlement inséré
                                $ta['factureclient_id'] = $l['factureclient_id'];
                                $ta['Montant'] = $l['montant'];

                                // Mettre à jour la facture
                                $fact = $this->Factureclients->get($l['factureclient_id']);
                                $fact->Montant_Regler = $fact->Montant_Regler + $l['montant'];
                                $fact->testretenu =  1;
                                $this->Factureclients->save($fact);

                                if ($this->fetchTable('Lignereglementclients')->save($ta)) {
                                    // Insertion immédiate dans Piecereglementclients
                                    $piece = $this->fetchTable('Piecereglementclients')->newEmptyEntity();
                                    $piece['reglementclient_id'] = $ligne->id; // Lien avec le règlement
                                    $piece['paiement_id'] = 5; // Par exemple, code fixe
                                    $piece['montant'] = $l['montant'];
                                    $piece['montant_brut'] = $l['totalttc']; // Valeur brute
                                    $piece['to_id'] = $l['taux'];
                                    $piece['montant_net'] = $l['montant_net']; // Montant net équivalent

                                    $this->fetchTable('Piecereglementclients')->save($piece);
                                }
                            }
                        }
                    }
                }
                //   $this->Flash->success(__('The {0} has been saved.', 'retenu'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'retenu'));
        }

        $numeroobj = $this->Retenus->find()->select(["numerox" =>
        'MAX(Retenus.numero)'])->first();
        $numero = $numeroobj->numerox;
        if ($numero != null) {
            // debug($numero);

            $n = $numero;

            $lastnum = $n;
            $nume = intval($lastnum) + 1;
            $nn = (string)$nume;

            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
            // debug($code);die;

        } else {
            $code = "00001";
        }

        $factureclients = $this->fetchTable('Factureclients')->find('all')->where(['Factureclients.client_id' => $idclient, 'Factureclients.Montant_Regler=0', 'Factureclients.testretenu=0']);
        $tos = $this->fetchTable('Tos')->find('list', ['limit' => 200]);
        $clientss = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($art) {
                if ($art->Code != null) {
                    return $art->Code . ' -- ' . $art->Raison_Sociale;
                } else {
                    return $art->Raison_Sociale;
                }
            }
        ])->where(['Clients.id !=12']);

        $now =  new FrozenTime('now', 'Africa/Tunis');
        $this->set(compact('retenu', 'clientss', 'factureclients', 'idclient', 'now', 'code', 'tos'));
    }
    public function imprimret($id = NULL)
    {
        //  $pieces =  $this->fetchTable('Ligneretenus')->get($id);
        $retenu = $this->Retenus->get($id);

        //debug( $reglement);die;
        $societe = $this->fetchTable('Societes')->find('all')->first();
        $client = $this->fetchTable('Clients')->find()->where('Clients.id=' . $retenu->client_id)->first();
        $pieces = $this->fetchTable('Ligneretenus')->find('all')->where('Ligneretenus.retenu_id=' . $retenu->id)
            ->contain(['Factureclients' => ['Timbres']]); //->first();
// debug($pieces->toarray());
        $this->set(compact('retenu', 'societe', 'pieces', 'client'));
    }
    public function modepaie($id = null)
    {
        $this->viewBuilder()->setLayout('def');
        $this->loadModel('Ligneretenus');

        $pieces = $this->Ligneretenus->find()->where(['Ligneretenus.retenu_id' => $id])->contain(['Factureclients'])->all();
        $this->set(compact('pieces'));
    }
    /**
     * Edit method
     *
     * @param string|null $id Retenus id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Ligneretenus');
        $this->loadModel('Factureclients');

        $retenu = $this->Retenus->get($id, [
            'contain' => []
        ]);
        $result = $this->request->getAttribute('authentication')->getIdentity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            $retenu = $this->Retenus->patchEntity($retenu, $this->request->getData());

            if ($this->Retenus->save($retenu)) {
                $re_id = $retenu->id;
                $this->misejour("Retenus", "edit", $re_id);

                $reg = $this->Reglementclients->find()->where(['Reglementclients.retenu_id' => $retenu->id])->first();

                if ($reg) {
                    $reg->retenu_id = $retenu->id;

                    $reg->Montant = $this->request->getData('total');
                    $reg->client_id = $this->request->getData('client_id');
                    $this->Reglementclients->save($reg);


                    $lignes = $this->Lignereglementclients->find()->where(['Lignereglementclients.reglementclient_id' => $reg->id])->all();
                    foreach ($lignes as $item) {
                        if ($item->factureclient_id != null) {
                            $mtg = $this->Factureclients->find()->select(['mtreg' => 'Factureclients.Montant_Regler'])->where(['Factureclients.id' => $item->factureclient_id])->first();
                            $MontantRegler = $mtg->mtreg;
                            $fact = $this->Factureclients->get($item->factureclient_id);
                            $fact->Montant_Regler = $MontantRegler - $item->Montant;
                            $this->Factureclients->save($fact);
                        }
                        $this->Lignereglementclients->delete($item);
                    }

                    $lignes2 = $this->Piecereglementclients->find()->where(['Piecereglementclients.reglementclient_id' => $reg->id])->all();
                    foreach ($lignes2 as $item) {
                        $this->Piecereglementclients->delete($item);
                    }
                }
                if (isset($this->request->getData('data')['ligner']) && !empty($this->request->getData('data')['ligner'])) {
                    $this->loadModel('Ligneretenus');
                    foreach ($this->request->getData('data')['ligner'] as $li) {
                        if ($li['sup'] != 1 && !empty($li['factureclient_id'])) {
                            $data1 = [
                                'retenu_id' => $retenu->id,
                                'factureclient_id' => $li['factureclient_id'],
                                'montant' => $li['montant'],
                                'totalttc' => $li['totalttc'],
                                'timbre_id' => $li['timbre_id'],
                                'date' => $li['date'],
                                'to_id' => $li['taux'],
                                'montant_net' => $li['montant_net'],
                            ];

                            if (!empty($li['id'])) {
                                $ligneinv = $this->Ligneretenus->get($li['id']);
                            } else {
                                $ligneinv = $this->Ligneretenus->newEmptyEntity();
                            }

                            $ligneinv = $this->Ligneretenus->patchEntity($ligneinv, $data1);

                            if ($this->Ligneretenus->save($ligneinv)) {
                                //     $fact = $this->Factureclients->get($data1['factureclient_id']);
                                //    $fact->Montant_Regler += $data1['montant'];
                                //     $fact->testretenu = 1;
                                //     $this->Factureclients->save($fact);
                            }
                        } else {
                            if (!empty($li['id'])) {
                                $ligneinv = $this->Ligneretenus->get($li['id']);
                                $this->Ligneretenus->delete($ligneinv);
                            }
                        }
                    }
                }

                if ($this->request->getData('total') != 0) {
                    $regg = $this->Reglementclients->find()->where(['Reglementclients.retenu_id' => $retenu->id])->first();

                    if ($regg) {
                        $regg->total = $this->request->getData('total');
                        $this->Reglementclients->save($regg);

                        // Handle Lignereglementclients saving
                        if (isset($this->request->getData('data')['ligner']) && !empty($this->request->getData('data')['ligner'])) {
                            foreach ($this->request->getData('data')['ligner'] as $l) {
                                if (isset($l['factureclient_id'])) {
                                    $ta = $this->Lignereglementclients->newEmptyEntity();
                                    $ta['reglementclient_id'] = $regg->id;
                                    $ta['factureclient_id'] = $l['factureclient_id'];
                                    $ta['Montant'] = $l['montant'];

                                    $fact = $this->Factureclients->get($l['factureclient_id']);
                                    $fact->Montant_Regler += $l['montant'];
                                    $fact->testretenu = 1;
                                    $this->Factureclients->save($fact);

                                    if ($this->Lignereglementclients->save($ta)) {
                                        // Insertion into Piecereglementclients
                                        $piece = $this->Piecereglementclients->newEmptyEntity();
                                        $piece['reglementclient_id'] = $regg->id;
                                        $piece['paiement_id'] = 5;  // Example fixed code
                                        $piece['montant'] = $l['montant'];
                                        $piece['montant_brut'] = $l['totalttc'];
                                        $piece['to_id'] = $l['taux'];
                                        $piece['montant_net'] = $l['montant_net'];

                                        $this->Piecereglementclients->save($piece);
                                    }
                                }
                            }
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
        } // Fermeture de l'accolade du if ($this->request->is(['patch', 'post', 'put']))

        // Fetch related data for the view
        $this->loadModel('Ligneretenus');
        $this->loadModel('Factureclients');
        $this->loadModel('Tos');
        $this->loadModel('Clients');

        $lignes = $this->Ligneretenus->find()->where(['Ligneretenus.retenu_id' => $id])->contain([ 'Factureclients.Timbres']);
        $l = [0];
        foreach ($lignes as $li) {
            if ($li->factureclient_id != 0) {
                $l[] = (int)$li->factureclient_id;
            }
        }

        $factureclients = $this->Factureclients->find('all')
            ->where([
                'Factureclients.client_id' => $retenu->client_id,
                'OR' => [
                    'Factureclients.Montant_Regler < Factureclients.totalttc',
                    'Factureclients.id IN' => $l
                ],
                // 'Factureclients.type' => 1
            ]);

        $tos = $this->Tos->find('list', ['limit' => 200]);
        $clients = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => function ($art) {
                return $art->Code ? $art->Code . ' -- ' . $art->Raison_Sociale : $art->Raison_Sociale;
            }
        ]);

        $this->set(compact('retenu', 'clients', 'lignes', 'tos', 'factureclients'));
    } // Fermeture de la fonction edit



    public function edit19112024($id = null)
    {
        $retenu = $this->Retenus->get($id, [
            'contain' => []
        ]);

        ///
        //debug($type);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $retenu = $this->Retenus->patchEntity($retenu, $this->request->getData());
            if ($this->Retenus->save($retenu)) {
                $re_id = ($this->Retenus->save($retenu)->id);

                $this->misejour("Retenus", "edit", $re_id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $li) {


                        $this->loadModel('Ligneretenus');
                        if ($li['sup'] != 1  && (!empty($li['factureclient_id']))) {

                            $data1['retenu_id'] = $retenu->id;
                            $data1['factureclient_id'] = $li['factureclient_id'];
                            $data1['montant'] = $li['montant'];
                            $data1['totalttc'] = $li['totalttc'];
                            $data1['date'] = $li['date'];

                            $data1['to_id'] = $li['taux'];



                            //debug($data1);die;
                            if (isset($li['id']) && (!empty($li['id']))) {

                                $ligneinv = $this->fetchTable('Ligneretenus')->get($li['id'], [
                                    'contain' => []
                                ]);

                                //debug('rrr');

                            } else {
                                //debug('uuu');
                                $ligneinv  = $this->fetchTable('Ligneretenus')->newEmptyEntity();
                            };
                            $ligneinv = $this->fetchTable('Ligneretenus')->patchEntity($ligneinv, $data1);


                            if ($this->fetchTable('Ligneretenus')->save($ligneinv)) {
                                $fact = $this->fetchTable('Factureclients')->get($data1['factureclient_id']);
                                // debug($article);die;
                                $fact->Montant_Regler =  $fact->Montant_Regler + $data1['montant'];
                                $fact->testretenu =  1;
                                $this->fetchTable('Factureclients')->save($fact);
                                // debug($lignes2);
                            } else {
                            }
                        } else {
                            if (!empty($li['id'])) {


                                // $this->request->allowMethod(['post', 'delete']);
                                $ligneinv = $this->fetchTable('Ligneretenus')->get($li['id']);
                                $this->fetchTable('Ligneretenus')->delete($ligneinv);
                            }
                        }
                    }
                }


                // $this->Flash->success(__('The {0} has been saved.', 'retenu'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'retenu'));
        }
        $this->loadModel('Ligneretenus');

        $lignes = $this->fetchTable('Ligneretenus')->find()->where(['Ligneretenus.retenu_id' => $id]);
        $l = [0];
        foreach ($lignes as $li) {
            if ($li['factureclient_id'] != 0) {
                $l[] = (int)$li['factureclient_id'];
            }
        }

        $factureclients = $this->fetchTable('Factureclients')->find('all')
            ->where([
                'Factureclients.client_id' => $retenu->client_id,
                'OR' => [
                    'Factureclients.Montant_Regler < Factureclients.totalttc',
                    'Factureclients.id IN' => $l
                ],
                'Factureclients.type' => 1
            ]);

        $tos = $this->fetchTable('Tos')->find('list', ['limit' => 200]);
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($art) {
                if ($art->Code != null) {
                    return $art->Code . ' -- ' . $art->Raison_Sociale;
                } else {
                    return $art->Raison_Sociale;
                }
            }
        ]);

        $this->set(compact('retenu', 'clients', 'lignes', 'tos', 'factureclients'));
    }

    public function edit1211($id = null)
    {
        $retenus = $this->Retenus->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $retenus = $this->Retenus->patchEntity($retenus, $this->request->getData());
            if ($this->Retenus->save($retenus)) {
                $this->Flash->success(__('The retenus has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The retenus could not be saved. Please, try again.'));
        }
        $clients = $this->Retenus->Clients->find('list', ['limit' => 200])->all();
        $this->set(compact('retenus', 'clients'));
    }
    public function getttcfacture()
    {
        $idd = $this->request->getQuery('idfacture');

        if ($idd) {
            $facture = $this->fetchTable('Factureclients')->find()
                ->where(['Factureclients.id' => $idd])
                ->first();
            $timbre = $this->fetchTable('Timbres')->find()
                ->where(['Timbres.id' => $facture->timbre_id])
                ->first();
            if ($facture) {
                $totalttc = $facture->totalttc - $timbre->timbre;
                $date = $facture->date->format('Y-m-d H:i:s');
                $timv = $timbre->timbre;
                $timbre_id = $timbre->id;

            }
        }

        echo json_encode(['ttc' => $totalttc, 'timbre' => $timv,'timbre_id'=>$timbre_id,'date' => $date]);
        exit;
    }


    /**
     * Delete method
     *
     * @param string|null $id Retenus id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */


    public function delete10122024($id = null)
    {
        //         $this->request->allowMethod(['post', 'delete']);

        $this->loadModel("Ligneretenus");
        $lignes = $this->Ligneretenus->find('all')->where(['Ligneretenus.retenu_id' => $id]);

        foreach ($lignes as $li) {
            $this->Ligneretenus->delete($li);

            $lignefacture = $this->fetchTable('Factureclients')->get($li['factureclient_id']);
            $lignefacture->testretenu = '0';
            $lignefacture->Montant_Regler =  $lignefacture->Montant_Regler - $li['montant'];


            $this->fetchTable('Factureclients')->save($lignefacture);
        }

        /*************************reg**************** */
        $reg = $this->Reglementclients->find()->where(['Reglementclients.retenu_id' => $id])->first();

        if ($reg) {

            $lignes = $this->Lignereglementclients->find()->where(['Lignereglementclients.reglementclient_id' => $reg->id])->all();
            foreach ($lignes as $item) {
                if ($item->factureclient_id != null) {
                    $mtg = $this->Factureclients->find()->select(['mtreg' => 'Factureclients.Montant_Regler'])->where(['Factureclients.id' => $item->factureclient_id])->first();
                    $MontantRegler = $mtg->mtreg;
                    $fact = $this->Factureclients->get($item->factureclient_id);
                    $fact->Montant_Regler = $MontantRegler - $item->Montant;
                    $this->Factureclients->save($fact);
                }
                $this->Lignereglementclients->delete($item);
            }

            $lignes2 = $this->Piecereglementclients->find()->where(['Piecereglementclients.reglementclient_id' => $reg->id])->all();
            foreach ($lignes2 as $item) {
                $this->Piecereglementclients->delete($item);
            }
        }
        $this->Reglementclients->delete($reg->id);

        /***************************************** */

        $retenu = $this->Retenus->get($id);
        if ($this->Retenus->delete($retenu)) {
            $this->misejour("retenus", "delete", $id);
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete($id = null)
    {

        $this->loadModel('Ligneretenus');
        $this->loadModel('Factureclients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Piecereglementclients');

        // Delete associated Ligneretenus
        $lignes = $this->Ligneretenus->find()->where(['retenu_id' => $id]);
        foreach ($lignes as $ligne) {
            $this->Ligneretenus->delete($ligne);
        }

        // Handle Reglementclients
        $reg = $this->Reglementclients->find()->where(['retenu_id' => $id])->first();
        if ($reg) {
            $lignesReg = $this->Lignereglementclients->find()->where(['reglementclient_id' => $reg->id]);
            foreach ($lignesReg as $itemm) {
                if ($itemm->factureclient_id) {
                    $facture = $this->Factureclients->get($itemm->factureclient_id);
                    $facture->Montant_Regler -= $itemm->Montant;
                    $facture->testretenu = '0';
                    $this->Factureclients->save($facture);
                }
                $this->Lignereglementclients->delete($itemm);
            }

            $pieces = $this->Piecereglementclients->find()->where(['reglementclient_id' => $reg->id]);
            foreach ($pieces as $piece) {
                $this->Piecereglementclients->delete($piece);
            }

            $this->Reglementclients->delete($reg);
        }

        // Delete Retenu
        $retenu = $this->Retenus->get($id);
        if ($this->Retenus->delete($retenu)) {
            $this->misejour('retenus', 'delete', $id);
        }




        return $this->redirect(['action' => 'index']);
    }
}
