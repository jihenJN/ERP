<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

/**
 * Commandes Controller
 *
 * @property \App\Model\Table\CommandesTable $Commandes
 * @method \App\Model\Entity\Commande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommandesController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function imprimeview($id = null) {
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
            'contain' => ['Lignecommandes', 'Clients', 'Commercials']
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

//    public function addcommande($tab = null) {
//        $num = $this->Commandes->find()->select(["num" =>
//                    'MAX(Commandes.numero)'])->first();
//        //debug($num);
//
//        $n = $num->num;
//        $int = intval($n);
//        $in = intval($n) + 1;
//        //debug($in);
//        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
//        //debug($mm);
//        $commande = $this->Commandes->newEmptyEntity();
//        if ($this->request->is('post')) {
//            //debug($this->request->getData());die;
//            $num = $this->Commandes->find()->select(["num" =>
//                        'MAX(Commandes.numero)'])->first();
//            //debug($num);
//
//            $n = $num->num;
//            $int = intval($n);
//            $in = intval($n) + 1;
//            //debug($in);
//            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
//
//            $data = $this->fetchTable('Commandes')->newEmptyEntity();
//
//            $data['numero'] = $this->request->getData('numero');
//            $data['date'] = $this->request->getData('date');
//            $data['client_id'] = $this->request->getData('client_id');
//            $data['depot_id'] = $this->request->getData('depot_id');
//            $data['total'] = $this->request->getData('total');
//            $data['totalttc'] = $this->request->getData('totalttc');
//            $data['payementcomptant'] = $this->request->getData('checkpayement');
//            $data['commercial_id'] = $this->request->getData('commercial_id');
//            $data['bondereservation_id'] = $tab;
//
//
//
//
//
//
//
//
//
//            // $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
//            // debug($commande);
//            if ($this->Commandes->save($data)) {
//
//
//                $commande_id = $data->id;
//
//
//                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
//                    //debug($this->request->getData('data')['ligner']);
//                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
//                        //  debug($l);
//
//
//                        $tab = $this->fetchTable('Lignecommandes')->newEmptyEntity();
//
//
//                        $tab['commande_id'] = $commande_id;
//                        $tab['qte'] = $l['qte'];
//                        $tab['article_id'] = $l['article_id'];
//
//                        $tab['prix'] = $l['prix'];
//                        $tab['qtestock'] = $l['qteStock'];
//
//
//                        $tab['tva'] = $l['tva'];
//                        $tab['total'] = $l['total'];
//
//                        $tab['totalttc'] = $l['ttc'];
//                        //debug($tab);
//                        //    $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();
//                        // $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
//                        // debug($lignecommande);
//                        $this->fetchTable('Lignecommandes')->save($tab);
//                    }
//                }
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//                //  $this->Flash->success(__('The {0} has been saved.', 'Commande'));
//
//                return $this->redirect(['action' => 'index']);
//            }
//            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
//        }
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//        $lignebonreservations = $this->fetchTable('Bondereservations')->Lignebondereservations->find('all', [
//                    'contain' => ['Articles']
//                ])
//                ->where(['bondereservation_id' => $tab]);
//
//
//
//
//
//        $bondereservation = $this->fetchTable('Bondereservations')->get($tab, [
//            'contain' => [
//                'Lignebondereservations'
//            ]
//        ]);
//
//
//        $clients = $this->fetchTable('Commandes')->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
//        $commercials = $this->fetchTable('Commandes')->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
//
//
//        $depots = $this->Commandes->Depots->find('list', ['limit' => 200]);
//
//
//        $articles = $this->fetchTable('Articles')->find('list', [
//            'keyfield' => 'id', 'valueField' => 'Dsignation'
//        ]);
//        $this->set(compact('commande', 'bondereservation', 'lignebonreservations', 'mm', 'articles', 'commercials', 'clients', 'depots'));
//    }

    public function index() {
             $session = $this->request->getSession();
          $abrv = $session->read('abrvv');
          $liendd = $session->read('lien_vente' . $abrv);

          //   debug($liendd);
          $societe = 0;
          foreach ($liendd as $k => $liens) {
          //  debug($liens);
          if (@$liens['lien'] == 'commandes') {
          $societe = 1;
          }
          }
          // debug($societe);die;
          if (($societe <> 1)) {
          $this->redirect(array('controller' => 'users', 'action' => 'login'));
          }
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $cond8 = '';

        $clientsoptions = $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $commercialsoptions = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $commercial_id = $this->request->getQuery('commercial_id');
        $client_id = $this->request->getQuery('client_id');
        $numero = $this->request->getQuery('numero');
        $zone = $this->request->getQuery('zone_id'); //debug($zone);
        // debug($this->request->getQuery(''));//die;

        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id" => 1]);
        
        $article = $this->request->getQuery('article_id');



        if ($article) {
            $lignecommandes = $this->fetchTable('Lignecommandes')->find('all')->where(["Lignecommandes.article_id=" . $article]);
            $detarticle = '0';
            foreach ($lignecommandes as $art) {
                //   debug($art);
                $detarticle = $detarticle . ',' . $art->commande_id;
            }
            //  debug($lignecommandes);
        }





        ////

        if ($zone) {
            $det = '0';
            $zonedelegations = $this->fetchTable('Zonedelegations')->find('all')
                    ->where(['zone_id =' . $zone]);
            //  debug($zonedelegations);
            foreach ($zonedelegations as $a) {

                $det = $det . ',' . $a->id;
            }


            $lignezonedelegations = $this->fetchTable('Lignezonedelegations')->find('all')
                    ->where(['Lignezonedelegations.zonedelegation_id  in ( ' . $det . ')']);

            $det1 = '';
            foreach ($lignezonedelegations as $b) {

                $det1 = $det1 . ',' . $b->delegation_id;
            }
            $dett = substr($det1, 1);



            $cond7 = 'Clients.delegation_id in(' . $dett . ')';
        }


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
         if($article){
            $cond8 = 'Commandes.id in ( ' . $detarticle . ')';
        }
        $query = $this->Commandes->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6, $cond7,$cond8])->order(['Commandes.id' => 'DESC']);
        //  debug($query);die;
        $this->paginate = [
            'contain' => ['Clients', 'Commercials'],
        ];
        $commandes = $this->paginate($query);
        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        ;
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $zones = $this->fetchTable('Zones')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('article','articles','zones', 'clients', 'commandes', 'commercials', 'clientsoptions', 'commercialsoptions', 'numero', 'client_id', 'commercial_id'));
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



    public function imprimerrecherche($id = null) {
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';

        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);

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

        $clients = $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clients.etat " => 'TRUE']);
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
    public function view($id = null) {
        $commande = $this->Commandes->get($id, [
            'contain' => ['Clients']
        ]);

        $client = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);

        $lignecommandes = $this->Commandes->Lignecommandes->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['commande_id' => $id]);

        $clients = $this->Commandes->Clients->find('all');
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
        ;
        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
                    'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);

        $time = $commande->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $commande->client_id . "' ";

        $exo = $this->fetchTable('Clientexonerations')->find('all', [
                    'contain' => ['Typeexons']
                ])->where([$cond3, $cond1, $cond2]);
        // debug($exo);

        $exotpe = '';
        $exotimbre = '';
        $exofodec = '';
        $exotva = '';

        foreach ($exo as $ex) {
            // debug($ex);
            // die;
            if (strtoupper($ex->typeexon->name) == 'TVA')
                $exotva = $ex->typeexon->name;


            if (strtoupper($ex->typeexon->name) == 'FODEC')
                $exofodec = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TIMBRE')
                $exotimbre = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TPE')
                $exotpe = $ex->typeexon->name;
        }


        $this->set(compact('client', 'exotva', 'exofodec', 'exotimbre', 'exotpe', 'lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null) {

             $session = $this->request->getSession();
          $abrv = $session->read('abrvv');
          $liendd = $session->read('lien_vente' . $abrv);

          //   debug($liendd);
          $societe = 0;
          foreach ($liendd as $k => $liens) {
          //  debug($liens);
          if (@$liens['lien'] == 'commandes') {
          $societe = $liens['modif'];
          }
          }
          // debug($societe);die;
          if (($societe <> 1)) {
          $this->redirect(array('controller' => 'users', 'action' => 'login'));
          }




        $commande = $this->Commandes->get($id, [
            'contain' => ['Clients']
        ]);

        //   debug($commande);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());

            $commande->numero = $this->request->getData('numero');
            $commande->date = $this->request->getData('date');
            $commande->client_id = $this->request->getData('client_id');
            $commande->depot_id = $this->request->getData('depot_id');
            $commande->remise = $this->request->getData('totalremise');
            $commande->total = $this->request->getData('total');

            $commande->totalttc = $this->request->getData('totalttc');

            $commande->fodec = $this->request->getData('fod');
            $commande->escompte = $this->request->getData('escompte');
            $commande->tva = $this->request->getData('tvacommande');
            $commande->tpe = $this->request->getData('tpecommande');

            $commande->payementcomptant = $this->request->getData('checkpayement');
            $commande->commercial_id = $this->request->getData('commercial_id');

            $commande->dateintdebut = $this->request->getData('dateintdebut');
            $commande->dateintfin = $this->request->getData('dateintfin');

            $commande->dateimp = $this->request->getData('dateimp');

            $commande->nouv_client = $this->request->getData('nouveau_client');

            //  debug($commande);
            //   $commande = $this->Commandes->patchEntity($commande, $data);
            if ($this->Commandes->save($commande)) {
                //debug($commande);
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
                $tab['prixEntre'] = $l['prixEntre'];
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
                            }

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

        $this->loadModel('Clients');
        $client = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);
        // debug($client);



        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);

        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
                    'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);
        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
                    'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $time = $commande->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $commande->client_id . "' ";

        $exo = $this->fetchTable('Clientexonerations')->find('all', [
                    'contain' => ['Typeexons']
                ])->where([$cond3, $cond1, $cond2]);
        // debug($exo);

        $exotpe = '';
        $exotimbre = '';
        $exofodec = '';
        $exotva = '';

        foreach ($exo as $ex) {
            // debug($ex);
            // die;
            if (strtoupper($ex->typeexon->name) == 'TVA')
                $exotva = $ex->typeexon->name;


            if (strtoupper($ex->typeexon->name) == 'FODEC')
                $exofodec = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TIMBRE')
                $exotimbre = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TPE')
                $exotpe = $ex->typeexon->name;
        }


        $this->set(compact('exotva', 'exofodec', 'exotimbre', 'exotpe', 'client', 'lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes', 'escompte'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Commande id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null) {
        
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
          } 




        $this->request->allowMethod(['post', 'delete']);
        $commande = $this->Commandes->get($id);
        $lignecommandes = $this->Commandes->Lignecommandes->find('all', [])
                ->where(['commande_id' => $id]);
        foreach ($lignecommandes as $c) {
            $this->Commandes->Lignecommandes->delete($c);
        }

        if ($this->Commandes->delete($commande)) {
            $this->misejour("Commandes", "delete", $id);
            // $this->Flash->success(__('The {0} has been deleted.', 'Commande'));
        } else {
            // $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commande'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function add() {
        

          $session = $this->request->getSession();
          $abrv = $session->read('abrvv');
          $liendd = $session->read('lien_vente' . $abrv);

          //   debug($liendd);
          $societe = 0;
          foreach ($liendd as $k => $liens) {
          //  debug($liens);
          if (@$liens['lien'] == 'commandes') {
          $societe = $liens['ajout'];
          }
          }
          // debug($societe);die;
          if (($societe <> 1)) {
          $this->redirect(array('controller' => 'users', 'action' => 'login'));
          }

       










        $dates[0] = "Impérative";
        $dates[1] = "Interval";

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
            $data = $this->fetchTable('Commandes')->newEmptyEntity();
            $bonifclient = $this->fetchTable('Nombrecommandes')->find()->select(["nombre" =>
                        'MAX(Nombrecommandes.nombrecommande)'])->first();

            $bonCli = $bonifclient->nombre;
            //debug($bonCli);
            $commandeCli = $this->Commandes->find()
                            ->where(["Commandes.client_id=" . $this->request->getData('client_id') . " "])->count();
            //  $commandeCli->select(['count' => $commandeCli->func()->count('*')]);
            //debug($commandeCli + 1);
            //    die;
            if ($commandeCli + 1 == $bonCli) {
                // debug('hh');
                $client = $this->fetchTable('Clients')->get($this->request->getData('client_id'), [
                    'contain' => []
                ]);
                $client->nouveau_client = 'FALSE';
                $this->fetchTable('Clients')->save($client);
                $data->dateupdateclient = $this->request->getData('date');
            }


/////////////////////////
            $num = $this->Commandes->find()->select(["num" =>
                        'MAX(Commandes.numero)'])->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            // debug($n);
            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);

            $data->numero = $this->request->getData('numero');
            $data->date = $this->request->getData('date');
            $data->client_id = $this->request->getData('client_id');
            $data->depot_id = $this->request->getData('depot_id');
            $data->remise = $this->request->getData('totalremise');
            $data->total = $this->request->getData('total');

            $data->totalttc = $this->request->getData('totalttc');

            $data->fodec = $this->request->getData('fod');
            $data->escompte = $this->request->getData('escompte');
            $data->tva = $this->request->getData('tvacommande');
            $data->tpe = $this->request->getData('tpecommande');

            $data->payementcomptant = $this->request->getData('checkpayement');
            $data->commercial_id = $this->request->getData('commercial_id');

            $data->dateintdebut = $this->request->getData('dateintdebut');
            $data->dateintfin = $this->request->getData('dateintfin');

            $data->dateimp = $this->request->getData('dateimp');

            $data->nouv_client = $this->request->getData('nouveau_client');

            //  debug($data);
            // $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            // debug($commande);
            if ($this->Commandes->save($data)) {
                //debug($data);


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
                            $tab['ttc'] = $l['prix'];
                            $tab['prixEntre'] = $l['prixEntre'];
                            //  $tab['remisearticle'] = $l['remisearticle'];

                            $tab['totalttc'] = $l['totalttc'];
                            //debug($tab);
                            //  $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();


//debug($tab);//die;
                            $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                           //   debug($lignecommande);
                            $this->fetchTable('Lignecommandes')->save($lignecommande);
                           // debug($lignecommande);die;
                        }
                    }
                }





























                // $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            //   $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }

        $cha = "TRUE";
        // $demandeoffredeprixes = $this->Commandes->Demandeoffredeprixes->find('list', ['limit' => 200]);
        $clients = $this->Commandes->Clients->find('all')
                ->where(["Clients.etat='$cha'"]);
        // debug($clients);die;
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        //$this->fetchTable('Articles')->virtualFields['myField'] = "CONCAT('code', Articles.Code, 'des', Articles.Dsignation)";
        //    debug($this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' =>"CONCAT('code', Articles.Code, 'des', Articles.Dsignation)"]));




        /*  $connection = ConnectionManager::get('default');
          $results = $connection->execute('SELECT * FROM articles')->fetchAll('assoc');
          $virtualFields = array(
          'nom' => 'CONCAT (Articles.Code, " ", Articles.Dsignation)');
          $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => $virtualFields]);
          debug($articles); */
        /*
         */

        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1])
        ;

        //////
        //   $articles = $this->fetchTable('Articles')->find('list');
        //  $articles = $this->fetchTable('Articles')->find('list', array(
        //  'fields' => array('Dsignation')));
        //  $articles = $this->fetchTable('Articles')->find('all') ->select(['id', 'Articles.Code, " ", Articles.Dsignation']);
        //$data = $articles->toList();
        ////////
        //debug($data);
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
        $this->set(compact('dates', 'commande', 'mm', 'clients', 'commercials', 'articles', 'depots', 'pointdeventes', 'timbre', 'escompte'));
    }

    public function getremise($id = null) {
        $id = $this->request->getQuery('idfam');
        $date = $this->request->getQuery('date');
        //   debug($date);
        $ligne = $this->fetchTable('Clients')->get($id, [
            'contain' => [],
        ]);

        //debug($ligne);





        $commercial = $this->fetchTable('Commercials')->find('all', [
                            'contain' => ['Categories']
                        ])
                        ->where(["Commercials.id = " . $ligne->commercial_id . ""])->first();
        //debug($commercial);


        $valeurcategorie = $commercial->category->valeur;

        $commercialoptions = $this->Commandes->Commercials->find('all');

        $select = "

           <label class='control-label' for='sousfamille1-id'>Commercials</label>
           <select name='commercial_id' id='commercial_id' class='form-control select2' onchange='getcategorie(this.value)'   >
                       <option value=''   disabled>Veuillez choisir</option>";

        foreach ($commercialoptions as $c) {
            //debug($c);
            $select = $select . "	<option value ='" . $c->id . "'";

            if ($commercial->id == $c->id) {
                $select = $select . " selected='selected' >" . $c->name . "</option>";
            } else {
                $select = $select . "  >" . $c->name . "</option>";
            }
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> ";

        $cond1 = "Clientexonerations.date_debut <= '" . $date . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $date . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $id . "' ";

        $exo = $this->fetchTable('Clientexonerations')->find('all', [
                    'contain' => ['Typeexons']
                ])->where([$cond3, $cond1, $cond2]);
        //    debug($exo);

        $exotpe = '';
        $exotimbre = '';
        $exofodec = '';
        $exotva = '';

        foreach ($exo as $ex) {
            //   debug($ex->typeexon->name);
            if (strtoupper($ex->typeexon->name) == 'TVA')
                $exotva = $ex->typeexon->name;


            if (strtoupper($ex->typeexon->name) == 'FODEC')
                $exofodec = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TIMBRE')
                $exotimbre = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TPE')
                $exotpe = $ex->typeexon->name;
        }






        /* $exo = $this->fetchTable('Clientexonerations')->get($id, [
          'contain' => [],
          ]); */

        echo json_encode(array(
            'valeurcategorie' => $valeurcategorie, 'ligne' => $ligne, 'exotva' => $exotva, 'exofodec' => $exofodec, 'exotpe' => $exotpe, 'exotimbre' => $exotimbre, 'select' => $select
        ));
        die;
    }

    public function getcategorie($id = null) {
        $id = $this->request->getQuery('idfam');
        //  debug($id);





        $commercial = $this->fetchTable('Commercials')->get($id, [
            'contain' => ['Categories']
        ]);
        // debug($commercial);



        $valeurcategorie = $commercial->category->valeur;
        ;

        /* $exo = $this->fetchTable('Clientexonerations')->get($id, [
          'contain' => [],
          ]); */

        echo json_encode(array(
            'valeurcategorie' => $valeurcategorie
        ));
        die;
    }

    /* public function receiveLignesCommandes($id = null)
      {
      $id = $this->request->getQuery('idCommande');
      $lignecommande = $this->Commandes->Lignecommandes->find('all', [
      'contain' => ['Articles']
      ])
      ->where(['commande_id' => $id]);


      $somme = 0;

      foreach ($lignecommande as $l) {
      //debug($l['article_id']);
      $this->loadModel('Bonlivraisons');
      $bon =  $this->Bonlivraisons->find('all')
      ->where(['commande_id' => $id]);
      //  debug($bon);die;
      $ch = '0';
      if ($bon != array()) {
      foreach ($bon as $b) {
      $ch = $ch + ',' + $b['id'];

      //debug($ql) ; die() ;
      }
      }
      $lignebonneliv = $this->fetchTable('Lignebonlivraisons')->find(
      'all'
      )
      ->where(['article_id' => $l['article_id'], 'bonlivraison_id in (' . $ch . ')']);
      // debug($lignebonneliv);die;
      //echo (json_encode($lignebonneliv));
      //debug($lignebonneliv) ; die() ;
      $ql = 0;
      if ($lignebonneliv != array()) {
      foreach ($lignebonneliv as $liv) {
      $ql = $ql + $liv['qte'];

      //debug($ql) ; die() ;
      }
      }
      $q = $l['qte'] - $ql;
      $p = $l['article']['Poids'];


      $total = $q * $p;

      $somme = $somme + $total;
      } //die;


      echo (json_encode($somme));
      die;
      } */

    public function updatevalidation($id) {

        $commande = $this->Commandes->get($id, [
            'contain' => ['Clients']
        ]);

        // debug($commande);



        $commande->valide = 1;
        //  $this->fetchTable('Commandes')->save($commande);

        if ($this->Commandes->save($commande)) {
            // debug($commande);
            return $this->redirect(['action' => 'index']);
        }
        die;
    }

    public function devalidation($id) {

        $commande = $this->Commandes->get($id, [
            'contain' => ['Clients']
        ]);

        // debug($commande);



        $commande->valide = 0;
        //  $this->fetchTable('Commandes')->save($commande);

        if ($this->Commandes->save($commande)) {
            // debug($commande);
            return $this->redirect(['action' => 'index']);
        }
        die;
    }

    public function receiveLignesCommandes($id = null) {
        $id = $this->request->getQuery('idCommande');
        $lignecommande = $this->Commandes->Lignecommandes->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['commande_id' => $id]);
        $somme = 0;
        foreach ($lignecommande as $l) {
            //debug($l) ;
            $idcomm = $id;
            //debug($idcomm);//die;
            $this->loadModel('Bonlivraisons');
            $bon = $this->Bonlivraisons->find('all')
                    ->where(['Bonlivraisons.commande_id=' . $idcomm]);
            //debug($bon);die;
            $ch = '0';
            if ($bon != array()) {
                foreach ($bon as $bb) {
                    //debug($ch) ; die() ;
                    // debug($bb['id']) ; //die() ;
                    $ch = $ch . ',' . $bb['id'];
                    //    debug($ch) ; die() ;
                }
            }
            $lignebonneliv = $this->fetchTable('Lignebonlivraisons')->find(
                            'all'
                    )
                    ->where(['article_id' => $l['article_id'], 'bonlivraison_id in (' . $ch . ')']);
            //debug($lignebonneliv);die;
            //echo (json_encode($lignebonneliv));
            //debug($lignebonneliv) ; die() ;
            $ql = 0;
            if ($lignebonneliv != array()) {
                foreach ($lignebonneliv as $liv) {
                    $ql = $ql + $liv['quantiteliv'];
                    // debug($liv['quantiteliv']) ;
                }
                //die ;
            }
            $q = $l['qte'] - $ql;
            //debug($l['qte']) ; die ;
            $p = $l['article']['Poids'];
            // debug($l['article']['Poids']) ; die ;
            $total = $q * $p;
            //debug($total) ; die ;
            $somme = $somme + $total;
        }
        //die;
        echo (json_encode($somme));
        die;
    }

    public function getescompte() {

        $qte = $this->request->getQuery('qte');
        $cond1 = "Remiseqtes.qtemax >= '" . $qte . "' ";
        $cond2 = "Remiseqtes.qtemin <= '" . $qte . "' ";

        // debug($qte);

        $valeur = $this->fetchTable('Remiseqtes')->find('all');
        //  debug($valeur->toArray());die;



        foreach ($valeur as $i => $v) {
            $tab[$i] = [
                'qtemin' => $v->qtemin,
                'qtemax' => $v->qtemax,
                'pourcentage' => $v->pourcentage,
            ];
        }
        // debug($tab);


        echo json_encode(array('tab' => $tab));
        die;
    }

//    public function getescompte() {
//
//        $qte = $this->request->getQuery('qte');
//        $cond1 = "Remiseqtes.qtemax >= '" . $qte . "' ";
//        $cond2 = "Remiseqtes.qtemin <= '" . $qte . "' ";
//
//        // debug($qte);
//
//        $valeur = $this->fetchTable('Remiseqtes')->find('all')->where([$cond1, $cond2])->first();
//        // debug($valeur);
//        if ($valeur != null) {
//            $remise = $valeur->pourcentage;
//        }
//        //  debug($remise);
//        else {
//            $r = $this->fetchTable('Remiseqtes')->find()->select(["pourcentage" =>
//                        'MAX(Remiseqtes.pourcentage)'])->first();
//            $remise = $r->pourcentage;
//        }
//        /*    $ligne = $this->fetchTable('Clients')->get($id, [
//          'contain' => [],
//          ]); */
//        //  debug($remise);
//        echo json_encode(array('remise' => $remise));
//        die;
//    }







    public function addcommande($tab = null) {

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
            // debug($this->request->getData());
            $data = $this->fetchTable('Commandes')->newEmptyEntity();
            $bonifclient = $this->fetchTable('Nombrecommandes')->find()->select(["nombre" =>
                        'MAX(Nombrecommandes.nombrecommande)'])->first();

            $bonCli = $bonifclient->nombre;
            //debug($bonCli);
            $commandeCli = $this->Commandes->find()
                            ->where(["Commandes.client_id=" . $this->request->getData('client_id') . " "])->count();
            //  $commandeCli->select(['count' => $commandeCli->func()->count('*')]);
            //debug($commandeCli + 1);
            //    die;
            if ($commandeCli + 1 == $bonCli) {
                // debug('hh');
                $client = $this->fetchTable('Clients')->get($this->request->getData('client_id'), [
                    'contain' => []
                ]);
                $client->nouveau_client = 'FALSE';
                $this->fetchTable('Clients')->save($client);
                $data->dateupdateclient = $this->request->getData('date');
            }


            /////////////////////////
            $num = $this->Commandes->find()->select(["num" =>
                        'MAX(Commandes.numero)'])->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            // debug($n);
            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);

            $data->numero = $this->request->getData('numero');
            $data->date = $this->request->getData('date');
            $data->client_id = $this->request->getData('client_id');
            $data->depot_id = $this->request->getData('depot_id');
            $data->remise = $this->request->getData('totalremise');
            $data->total = $this->request->getData('total');

            $data->totalttc = $this->request->getData('totalttc');

            $data->fodec = $this->request->getData('fod');
            $data->escompte = $this->request->getData('escompte');
            $data->tva = $this->request->getData('tvacommande');
            $data->tpe = $this->request->getData('tpecommande');

            $data->payementcomptant = $this->request->getData('checkpayement');
            $data->commercial_id = $this->request->getData('commercial_id');

            $data->dateintdebut = $this->request->getData('dateintdebut');
            $data->dateintfin = $this->request->getData('dateintfin');

            $data->dateimp = $this->request->getData('dateimp');
            $data->nouv_client = $this->request->getData('nouveau_client');

            // $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            // debug($commande);
            if ($this->Commandes->save($data)) {


                $commande_id = $data->id;
//                debug($commande_id);

                $this->misejour("Commandes", "add", $commande_id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
//                        debug($l);


                        if ($l['sup'] != 1) {


                            /* $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();



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
                              debug($lignecommande); */

                            $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();
                            $lignecommande->commande_id = $data->id;
                            $lignecommande->qte = $l['qte'];
                            $lignecommande->article_id = $l['article_id'];

                            $lignecommande->prix = $l['prix'];
                            // $lignecommande->qtestock = $l['qteStock'];
                            $lignecommande->montantht = $l['motanttotal'];
                            $lignecommande->remise = $l['remiseligne'];
                            $lignecommande->tpe = $l['tpecommandeclient'];
                            $lignecommande->tva = $l['tva'];

                            $lignecommande->fodec = $l['fodeccommandeclient'];

//                              debug($l['ttc']);

                            $lignecommande->totaltva = $l['monatantlignetva'];
                            $lignecommande->ttc = $l['prix'];

                            //  $tab['remisearticle'] = $l['remisearticle'];

                            $lignecommande->totalttc = $l['totalttc'];
                            //debug($tab);
                            //  $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();
                            // $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            //  debug($lignecommande);
                            $this->fetchTable('Lignecommandes')->save($lignecommande);
                            //debug($lignecommande); */
                        }
                    }
                }





























                //  $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }


        $bonlivraison = $this->fetchTable('Bonlivraisons')->get($tab, [
            'contain' => ['Clients']
        ]);
        $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
                    'contain' => ['Articles']
                ])
                ->where(['bonlivraison_id' => $bonlivraison->id]);

        $clients = $this->fetchTable('Commandes')->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale'])->where(["Clients.etat " => 'FALSE']);
        $commercials = $this->fetchTable('Commandes')->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $depots = $this->Commandes->Depots->find('list', ['limit' => 200]);

        $articles = $this->fetchTable('Articles')->find('list', [
            'keyfield' => 'id', 'valueField' => 'Dsignation'
        ]);
        $dates[0] = "Imperative";
        $dates[1] = "Interval";
        $commercial = $this->fetchTable('Commercials')->get($bonlivraison->commercial_id, [
            'contain' => [
                'Categories'
            ]
        ]);
        // debug($commercial);




        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
                    'MAX(Bonusnouvclients.valeur)'])->first();
        // debug($num);

        $bonus = $valeur->valeur;

        $client = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Delegations', 'Localites']
        ]);

        $time = $bonlivraison->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $bonlivraison->client_id . "' ";

        $exo = $this->fetchTable('Clientexonerations')->find('all', [
                    'contain' => ['Typeexons']
                ])->where([$cond3, $cond1, $cond2]);
        // debug($exo);

        $exotpe = '';
        $exotimbre = '';
        $exofodec = '';
        $exotva = '';

        foreach ($exo as $ex) {
            // debug($ex);
            // die;
            if (strtoupper($ex->typeexon->name) == 'TVA')
                $exotva = $ex->typeexon->name;


            if (strtoupper($ex->typeexon->name) == 'FODEC')
                $exofodec = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TIMBRE')
                $exotimbre = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TPE')
                $exotpe = $ex->typeexon->name;
        }





        $this->set(compact('exotva', 'exofodec', 'exotpe', 'bonus', 'client', 'dates', 'commande', 'bonlivraison', 'lignebonlivraisons', 'mm', 'articles', 'commercials', 'clients', 'depots'));
    }

}
