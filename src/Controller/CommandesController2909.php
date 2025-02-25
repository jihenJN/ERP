<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Commandes Controller
 *
 * @property \App\Model\Table\CommandesTable $Commandes
 * @method \App\Model\Entity\Commande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommandesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    
    public function imprimeview($id = null)
    {
        //     $commande = $this->Commandes->get($id, [
        //         'contain' => ['Lignecommandes'],
        //     ]);
        //     $clients =  $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //    $this->loadModel('Lignecommandes');
        //     $lignecommandes = $this->Commandes->Lignecommandes->find('all')->where(["Lignecommandes.commande_id=" . $id . " "]);
        //     //->where(["Lignecommandes.commandeclient_id=" . $id . " "])
        //     //debug($lignecommandeclients);
        //     $this->loadModel('articles');
        //     $articles = $this->articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        //     $commercials = $this->Commandes->Commercials->find('list', ['limit' => 200]);
        //     $commandes = $this->Commandes->find();
        //     $this->set(compact('lignecommandes','commandes', 'articles', 'clients','commercials'));
        $commande = $this->Commandes->get($id, [
            'contain' => ['Lignecommandes', 'Clients']
        ]);
        $clients = $this->Commandes->Clients->find('list', ['limit' => 200]);
        $commercials = $this->Commandes->Commercials->find('list', ['limit' => 200]);
        // $this->set(compact('commande','commercials','clients'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commande = $this->Commandes->patchEntity($commandes, $this->request->getData(), ['associated' => ['Lignecommandes' => ['validate' => false]]]);
            if ($this->Commandes->save($commande)) {
                if (isset($this->request->getData('data')['Lignecommandes']) && (!empty($this->request->getData('data')['Lignecommandes']))) {
                    foreach ($this->request->getData('data')['Lignecommandes'] as $i => $res) {
                        // debug($res);
                        //  die;

                        if ($res['sup0'] != 1) {
                            $dat['article_id'] = $res['article_id'];
                            $dat['qte'] = $res['qte'];
                            $dat['prix'] = $res['prix'];
                            $dat['total'] = $res['total'];
                            $dat['commandeclient_id'] = $id;
                            //debug($dat);
                            if (isset($res['id']) && (!empty($res['id']))) {

                                $lignecommande = $this->fetchTable('lignecommandes')->get($res['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignecommande = $this->fetchTable('lignecommandes')->newEmptyEntity();
                            };
                            $lignecommande = $this->fetchTable('lignecommandes')->patchEntity($lignecommande, $dat);
                            //debug($lignecommandeclient);

                            if ($this->fetchTable('lignecommandes')->save($lignecommande)) {
                                // debug($lignecommandeclient);
                                // $this->Flash->success("lignecommande has been edited successfully");
                            } else {
                                //$this->Flash->error("Failed to edit");
                            }
                        }

                        $this->set(compact("lignecommande"));
                    }
                }
                //$this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commandeclient'));
        }
        $clients = $this->Commandes->Clients->find('list', ['limit' => 200]);

        $this->loadModel('Lignecommandes');
        $lignecommandes = $this->Commandes->Lignecommandes->find('all')->contain(['Articles'])->where(["Lignecommandes.commande_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $commandes = $this->Commandes->find('all')->contain(['Clients', 'Commercials']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->set(compact('lignecommandes', 'articles', 'commande', 'clients', 'timbre'));
    }
    public function addcommande($tab = null)
    {

        $num = $this->Commandes->find()->select(["num" =>
        'MAX(Commandes.numero)'])->first();
        //debug($num);

        $n = $num->num;
        $int = intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
        //debug($mm);
        $commande = $this->Commandes->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());die;
            $num = $this->Commandes->find()->select(["num" =>
        'MAX(Commandes.numero)'])->first();
        //debug($num);

        $n = $num->num;
        $int = intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);

            $data = $this->fetchTable('Commandes')->newEmptyEntity();

            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['total'] = $this->request->getData('total');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $data['bondereservation_id'] = $tab;









            // $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            // debug($commande);
            if ($this->Commandes->save($data)) {


                $commande_id = $data->id;


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);


                        $tab = $this->fetchTable('Lignecommandes')->newEmptyEntity();


                        $tab['commande_id'] = $commande_id;
                        $tab['qte'] = $l['qte'];
                        $tab['article_id'] = $l['article_id'];

                        $tab['prix'] = $l['prix'];
                        $tab['qtestock'] = $l['qteStock'];


                        $tab['tva'] = $l['tva'];
                        $tab['total'] = $l['total'];

                        $tab['totalttc'] = $l['ttc'];
                        //debug($tab);




                        //    $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();



                        // $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                        // debug($lignecommande);
                        $this->fetchTable('Lignecommandes')->save($tab);
                    }
                }





























              //  $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }




















        $lignebonreservations = $this->fetchTable('Bondereservations')->Lignebondereservations->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bondereservation_id' => $tab]);





        $bondereservation = $this->fetchTable('Bondereservations')->get($tab, [
            'contain' => [
                'Lignebondereservations'
            ]
        ]);


        $clients = $this->fetchTable('Commandes')->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $commercials = $this->fetchTable('Commandes')->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $depots = $this->Commandes->Depots->find('list', ['limit' => 200]);


        $articles = $this->fetchTable('Articles')->find('list', [
            'keyfield' => 'id', 'valueField' => 'Dsignation'

        ]);
        $this->set(compact('commande', 'bondereservation', 'lignebonreservations', 'mm', 'articles', 'commercials', 'clients', 'depots'));
    }
    public function index()
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $clientsoptions = $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $commercialsoptions = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $commercial_id = $this->request->getQuery('commercial_id');
        $client_id = $this->request->getQuery('client_id');
        $numero = $this->request->getQuery('numero');
        // debug($this->request->getQuery(''));//die;
        if ($datefin) {
            //
            //  debug($this->request->getQuery(''));
            die;
            $cond6 = "Commandes.date <= '" . $datefin . "' ";
        }
        if ($datedebut) {
            $cond2 = "Commandes.date >= '" . $datedebut . "' ";
        }
        if ($commercial_id) {
            $cond3 = "Commandes.commercial_id ='" . $commercial_id . "' ";
        }
        if ($client_id) {
            $cond4 = "Commandes.client_id = '" . $client_id . "' ";
        }
        if ($numero) {
            $cond5 = "Commandes.numero like '%" . $numero . "%' ";
        }
        $query = $this->Commandes->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6])->order(['Commandes.id' => 'DESC']);
        $this->paginate = [
            'contain' => ['Clients', 'Commercials'],
        ];
        $commandes = $this->paginate($query);
        $clients =  $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('clients', 'commandes', 'commercials', 'clientsoptions', 'commercialsoptions', 'numero', 'client_id', 'commercial_id'));
    }
    //    public function imprimeview($id = null)
    //    {
    //        //     $commande = $this->Commandes->get($id, [
    //        //         'contain' => ['Lignecommandes'],
    //        //     ]);
    //        //     $clients =  $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
    //        //    $this->loadModel('Lignecommandes');
    //        //     $lignecommandes = $this->Commandes->Lignecommandes->find('all')->where(["Lignecommandes.commande_id=" . $id . " "]);
    //        //     //->where(["Lignecommandes.commandeclient_id=" . $id . " "])
    //        //     //debug($lignecommandeclients);
    //        //     $this->loadModel('articles');
    //        //     $articles = $this->articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
    //        //     $commercials = $this->Commandes->Commercials->find('list', ['limit' => 200]);
    //        //     $commandes = $this->Commandes->find();
    //        //     $this->set(compact('lignecommandes','commandes', 'articles', 'clients','commercials'));
    //        $commandes = $this->Commandes->get($id, [
    //            'contain' => ['Lignecommandes','Clients']
    //        ]);
    //        $clients = $this->Commandes->Clients->find('list', ['limit' => 200]);
    //        $commercials = $this->Commandes->Commercials->find('list', ['limit' => 200]);
    //        // $this->set(compact('commande','commercials','clients'));
    //        if ($this->request->is(['patch', 'post', 'put'])) {
    //            $commande = $this->Commandes->patchEntity($commandes, $this->request->getData(), ['associated' => ['Lignecommandes' => ['validate' => false]]]);
    //            if ($this->Commandes->save($commande)) {
    //                if (isset($this->request->getData('data')['Lignecommandes']) && (!empty($this->request->getData('data')['Lignecommandes']))) {
    //                    foreach ($this->request->getData('data')['Lignecommandes'] as $i => $res) {
    //                        // debug($res);
    //                        //  die;
    //
    //                        if ($res['sup0'] != 1) {
    //                            $dat['article_id'] = $res['article_id'];
    //                            $dat['qte'] = $res['qte'];
    //                            $dat['prix'] = $res['prix'];
    //                            $dat['total'] = $res['total'];
    //                            $dat['commandeclient_id'] = $id;
    //                            //debug($dat);
    //                            if (isset($res['id']) && (!empty($res['id']))) {
    //
    //                                $lignecommande = $this->fetchTable('lignecommandes')->get($res['id'], [
    //                                    'contain' => []
    //                                ]);
    //                            } else {
    //                                $lignecommande = $this->fetchTable('lignecommandes')->newEmptyEntity();
    //                            };
    //                            $lignecommande = $this->fetchTable('lignecommandes')->patchEntity($lignecommande, $dat);
    //                            //debug($lignecommandeclient);
    //
    //                            if ($this->fetchTable('lignecommandes')->save($lignecommande)) {
    //                                // debug($lignecommandeclient);
    //                                $this->Flash->success("lignecommande has been edited successfully");
    //                            } else {
    //                                $this->Flash->error("Failed to edit");
    //                            }
    //                        }
    //
    //                        $this->set(compact("lignecommande"));
    //                    }
    //                }
    //                $this->Flash->success(__('The {0} has been saved.', 'Commande'));
    //
    //                return $this->redirect(['action' => 'index']);
    //            }
    //            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commandeclient'));
    //        }
    //        $clients = $this->Commandes->Clients->find('list', ['limit' => 200]);
    //
    //        $this->loadModel('Lignecommandes');
    //        $lignecommandes = $this->Commandes->Lignecommandes->find('all')->contain(['Articles'])->where(["Lignecommandes.commande_id=" . $id . " "]);
    //        //debug($lignecommandeclients);
    //        $this->loadModel('Articles');
    //        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
    //        $commandes = $this->Commandes->find('all')->contain(['Clients', 'Commercials']);
    //        $this->set(compact('lignecommandes', 'articles', 'commandes', 'clients'));
    //    }



    public function imprimerrecherche($id = null)
    {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';

        $clientsoptions = $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $commercialsoptions = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $commercial_id = $this->request->getQuery('commercial_id');
        $client_id = $this->request->getQuery('client_id');
        $numero = $this->request->getQuery('numero');
        $total = $this->request->getQuery('total');
        if ($au) {
            // $cond6 = "Commandes.date like  '%" . $au . "%' ";
        }
        if ($historiquede) {
            // $cond2 = "Commandes.date like  '%" . $historiquede . "%' ";
        }

        if ($commercial_id) {
            $cond3 = "Commandes.commercial_id = '" . $commercial_id . "' ";
        }
        if ($client_id) {
            $cond4 = "Commandes.client_id = '" . $client_id . "' ";
        }
        if ($numero) {
            $cond5 = "Commandes.numero =  '" . $numero . "' ";
        }

        $query = $this->Commandes->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6]);
        $this->paginate = [
            'contain' => ['Clients'],
        ];
        $commandes = $this->paginate($query);
        $clients =  $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('clients', 'commandes', 'commercials', 'clientsoptions', 'commercialsoptions', 'numero', 'total', 'client_id', 'commercial_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $commande = $this->Commandes->get($id, [
            'contain' => ['Clients']
        ]);



        $lignecommandes = $this->Commandes->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $id]);

        $clients = $this->Commandes->Clients->find('list',  ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $commercials = $this->Commandes->Commercials->find('list',  ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);



        $this->set(compact('lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {

        /* $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $commande = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'commandes') {
                $commande = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($commande <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
*/



















        $commande = $this->Commandes->get($id, [
            'contain' => ['Clients']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());

            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['remise'] = $this->request->getData('totalremise');
            $data['total'] = $this->request->getData('total');

            $data['totalttc'] = $this->request->getData('totalttc');

            $data['fodec'] = $this->request->getData('fod');
            $data['escompte'] = $this->request->getData('escompte');
            $data['tva'] = $this->request->getData('tvacommande');
            $data['tpe'] = $this->request->getData('tpecommande');

            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');

            // debug($data);


            $commande = $this->Commandes->patchEntity($commande, $data);
            if ($this->Commandes->save($commande)) {
                // debug($commande);
                $this->misejour("Commandes", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        // debug($l);

                        if ($l['sup'] != 1) {
                            // $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();

                            $tab['commande_id'] = $commande->id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];

                            $tab['prix'] = $l['prix'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['montantht'] = $l['motanttotal'];
                            $tab['remise'] = $l['remiseligne'];
                            $tab['tpe'] = $l['tpecommandeclient'];
                            $tab['tva'] = $l['tva'];


                            $tab['fodec'] = $l['fodeccommandeclient'];


                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['ttc'] = $l['ttc'];

                            //  $tab['remisearticle'] = $l['remisearticle'];

                            $tab['totalttc'] = $l['totalttc'];
                            //debug($tab);


                            // debug($tab);


                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignecommande = $this->fetchTable('Lignecommandes')->get($l['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();
                            };

                            $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            //debug($lignecommande);

                            if ($this->fetchTable('Lignecommandes')->save($lignecommande)) {

                                // $this->Flash->success("Ligne bon de commande has been modified successfully");
                            } else {
                                // $this->Flash->error("Failed to midify ligne bon de chyargements");
                            }
                        } else if (!empty($l['id'])) {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignecommande = $this->fetchTable('Lignecommandes')->get($l['id']);

                            $this->fetchTable('Lignecommandes')->delete($lignecommande);
                        }
                    }
                }










                //   $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }

        $lignecommandes = $this->Commandes->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $id]);


        $clients = $this->Commandes->Clients->find('list',  ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $commercials = $this->Commandes->Commercials->find('list',  ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);
        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;



        $this->set(compact('lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes', 'escompte'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        /*
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $commande = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'commandes') {
                $commande = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($commande <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }*/




        $this->request->allowMethod(['post', 'delete']);
        $commande = $this->Commandes->get($id);
        $lignecommandes = $this->Commandes->Lignecommandes->find('all', [])
            ->where(['commande_id' => $id]);

        if ($this->Commandes->delete($commande)) {
            $this->misejour("Commandes", "delete", $id);
            // $this->Flash->success(__('The {0} has been deleted.', 'Commande'));
            foreach ($lignecommandes as $c) {
                $this->Commandes->Lignecommandes->delete($c);
            }
        } else {
            // $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commande'));
        }

        return $this->redirect(['action' => 'index']);
    }



    public function add()
    {
        /*

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_parametrage' . $abrv);

        //   debug($liendd);
        $commande = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'commandes') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($commande <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

*/


















        $num = $this->Commandes->find()->select(["num" =>
        'MAX(Commandes.numero)'])->first();
        // debug($num);

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        // debug($n);
        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
        // debug($mm);
        $commande = $this->Commandes->newEmptyEntity();
        if ($this->request->is('post')) {
            // debug($this->request->getData());



            $num = $this->Commandes->find()->select(["num" =>
            'MAX(Commandes.numero)'])->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            // debug($n);
            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);

            $data = $this->fetchTable('Commandes')->newEmptyEntity();

            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['remise'] = $this->request->getData('totalremise');
            $data['total'] = $this->request->getData('total');

            $data['totalttc'] = $this->request->getData('totalttc');

            $data['fodec'] = $this->request->getData('fod');
            $data['escompte'] = $this->request->getData('escompte');
            $data['tva'] = $this->request->getData('tvacommande');
            $data['tpe'] = $this->request->getData('tpecommande');

            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');







            // $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            // debug($commande);
            if ($this->Commandes->save($data)) {

                $this->misejour("Commandes", "add", $commande->id);
                // debug($commande);





                $commande_id = $data->id;


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //debug($l);

                        if ($l['sup'] != 1) {

                            $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();



                            $tab['commande_id'] = $commande_id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];

                            $tab['prix'] = $l['prix'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['montantht'] = $l['motanttotal'];
                            $tab['remise'] = $l['remiseligne'];
                            $tab['tpe'] = $l['tpecommandeclient'];
                            $tab['tva'] = $l['tva'];


                            $tab['fodec'] = $l['fodeccommandeclient'];


                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['ttc'] = $l['ttc'];

                            //  $tab['remisearticle'] = $l['remisearticle'];

                            $tab['totalttc'] = $l['totalttc'];
                            //debug($tab);




                            //  $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();



                            $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            //  debug($lignecommande);
                            $this->fetchTable('Lignecommandes')->save($lignecommande);
                            //debug($lignecommande);
                        }
                    }
                }





























                // $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            //   $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }


        // $demandeoffredeprixes = $this->Commandes->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $clients = $this->Commandes->Clients->find('list',  ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $commercials = $this->Commandes->Commercials->find('list',  ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);

        // $timbre = $this->Commandes->Commercials->find('list',  ['keyfield' => 'id', 'valueField' => 'timbre']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;



        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;

        //$pointdeventes = $this->Commandes->Pointdeventes->find('list', ['limit' => 200]);
        // $depots = $this->Commandes->Depots->find('list', ['limit' => 200]);
        //$cartecarburants = $this->Commandes->Cartecarburants->find('list', ['limit' => 200]);
        // $materieltransports = $this->Commandes->Materieltransports->find('list', ['limit' => 200]);
        $this->set(compact('commande', 'mm', 'clients', 'commercials', 'articles', 'depots', 'pointdeventes', 'timbre', 'escompte'));
    }



    public function getremise($id = null)
    {
        $id = $this->request->getQuery('idfam');
        $ligne = $this->fetchTable('Clients')->get($id, [
            'contain' => [],
        ]);
        echo json_encode(array('ligne' => $ligne));
        die;
    }
        public function receiveLignesCommandes($id = null)
    {
        $id = $this->request->getQuery('idCommande'); 
        $lignecommande = $this->Commandes->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $id]);
            

        $somme = 0 ;
       
        foreach ( $lignecommande as  $l) {

            $lignebonneliv = $this->fetchTable('Lignebonlivraisons')->find('all' , [

                'contain' => ['Bonlivraisons']
            ]
            )
            
            ->where(['lignebonlivraisons.article_id  = (' . $l['article_id'] . ')  and bonlivraisons.commande_id  = (' . $l['commande_id'] . ')    ' ]     );
            //echo (json_encode($lignebonneliv));               


                //debug($lignebonneliv) ; die() ; 
            $ql=0;
          foreach($lignebonneliv as  $liv) {
              $ql = $ql+  $liv['qte'];

              //debug($ql) ; die() ; 
            
            
            }

            $q = $l['qte']-$ql;
            $p = $l['article']['Poids'];
            
           
           $total=$q*$p;

           $somme = $somme+$total ;
           
     
                      
        } 

        
         echo (json_encode   ($somme));               
        die;

}
}
