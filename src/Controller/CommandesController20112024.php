<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Bonlivraison;
use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

/**
 * Commandes Controller
 *
 * @property \App\Model\Table\CommandesTable $Commandes
 * @method \App\Model\Entity\Commande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CommandesController extends AppController
{

    public function reglementop($id = null)
    {
        $this->viewBuilder()->setLayout('def');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Commandes');
        $this->loadModel('Bonlivraisons');
        $bonlivraison = $this->Bonlivraisons->find()->where('commande_id=' . $id)->first();
        $commande = $this->Commandes->find()->where('id=' . $id)->first();
        $lignereglements = $this->Lignereglementclients->find()->where(['Lignereglementclients.bonlivraison_id' => $bonlivraison->id]);

        $lignereglementcmds = [];
        if ($commande->id != 0) {
            $lignereglementcmds = $this->Lignereglementclients->find()->where(['Lignereglementclients.commande_id' => $id]);
        }

        // $pieces = $this->Piecereglements->find()->where(['Piecereglements.reglement_id' => $id])->contain(['Paiements'])->all();
        $this->set(compact('pieces', 'lignereglements', 'bonlivraison', 'commande', 'lignereglementcmds'));
    }



    public function listecommandes()
    {
        $this->loadModel('Clients');
        $this->loadModel('Commercials');
        $this->loadModel('Articles');
        $client_id = $this->request->getQuery('client_id');
        $commercial_id = $this->request->getQuery('commercial_id');
        $article = $this->request->getQuery('article_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $depot_id = $this->request->getQuery('depot_id');
        $conditions = [];

        if ($depot_id) {
            $conditions = ["Commandes.depot_id  = '" . $depot_id . "' "];
        }
        if ($historiquede) {
            $conditions[] = ["Commandes.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Commandes.date <='" . $au . " 23:59:59' "];
        }
        if ($client_id) {
            $conditions[] = ["Commandes.client_id = '" . $client_id . "' "];
        }
        if ($commercial_id) {
            $conditions[] = ["Commandes.commercial_id = '" . $commercial_id . "' "];
        }

        if ($article) {
            $subquery = $this->fetchTable('Lignecommandes')
                ->find('list', [
                    'keyField' => 'commande_id',
                    'valueField' => 'commande_id'
                ])
                ->where(['Lignecommandes.article_id' => $article]);
            $conditions[] = ['Commandes.id IN' => $subquery];
        }

        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();
        $condcommercial = '';


        if ($user['poste'] == 2) {
            $usercommercials = $this->fetchTable('Usercommercials')->find()->where('Usercommercials.user_id=' . $user_id);
            if ($usercommercials->count() > 0) {

                $commercialIds = [];
                foreach ($usercommercials as $usercommercial) {
                    $commercialIds[] = $usercommercial->commercial_id;
                }

                $commercialIdsString = implode(',', $commercialIds);



                $condcommercial = 'Commandes.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
        }
        $commandes = $this->fetchTable('Commandes')->find('all')->where([$conditions, $condcommercial])->contain(['Clients', 'Commercials', 'Depots'])->order(['Commandes.id' => 'DESC'])
            ->ToArray();

        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

                if ($art->Tel != null) {
                    return  $art->Tel . ' -- ' . $art->Raison_Sociale;
                } else {
                    return  $art->Raison_Sociale;
                }
            }
        ]);
        if ($user['poste'] == 2) {
            $usercommercials = $this->fetchTable('Usercommercials')->find()->where('Usercommercials.user_id=' . $user_id)->toArray();




            $comIds = [];
            foreach ($usercommercials as $usercom) {
                $comIds[] = $usercom['commercial_id'];
            }

            $comIdsString = implode(',', $comIds);

            $commercials = $this->fetchTable('Commercials')->find('list')
                ->where(['Commercials.id IN (' . $comIdsString . ')']);
        } else {
            $commercials = $this->Commercials->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        }
        $articles = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'Dsignation'])->where('Articles.famille_id=1');
        $depots = $this->fetchTable('Depots')->find('list');

        $this->set(compact('depots', 'clients', 'client_id', 'commercials', 'commercial_id', 'article_id', 'articles', 'commandes', 'historiquede', 'au'));
    }

    public function imprimelistecommandes($id = null)
    {
        $this->loadModel('Clients');
        $this->loadModel('Commercials');
        $this->loadModel('Articles');
        $client_id = $this->request->getQuery('client_id');
        $commercial_id = $this->request->getQuery('commercial_id');
        $article = $this->request->getQuery('article_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $depot_id = $this->request->getQuery('depot_id');
        $conditions = [];

        if ($depot_id) {
            $conditions = ["Commandes.depot_id  = '" . $depot_id . "' "];
        }
        if ($historiquede) {
            $conditions[] = ["Commandes.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Commandes.date <='" . $au . " 23:59:59' "];
        }
        if ($client_id) {
            $conditions[] = ["Commandes.client_id = '" . $client_id . "' "];
        }
        if ($commercial_id) {
            $conditions[] = ["Commandes.commercial_id = '" . $commercial_id . "' "];
        }
        if ($article) {
            $subquery = $this->fetchTable('Lignecommandes')
                ->find('list', [
                    'keyField' => 'commande_id',
                    'valueField' => 'commande_id'
                ])
                ->where(['Lignecommandes.article_id' => $article]);
            $conditions[] = ['Commandes.id IN' => $subquery];
        }
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();
        $condcommercial = '';


        if ($user['poste'] == 2) {
            $usercommercials = $this->fetchTable('Usercommercials')->find()->where('Usercommercials.user_id=' . $user_id);
            if ($usercommercials->count() > 0) {

                $commercialIds = [];
                foreach ($usercommercials as $usercommercial) {
                    $commercialIds[] = $usercommercial->commercial_id;
                }

                $commercialIdsString = implode(',', $commercialIds);



                $condcommercial = 'Commandes.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
        }
        $commandes = $this->fetchTable('Commandes')->find('all')->where([$conditions, $condcommercial])->contain(['Clients', 'Commercials', 'Depots'])->order(['Commandes.id' => 'DESC'])
            ->ToArray();

        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

                if ($art->Tel != null) {
                    return  $art->Tel . ' -- ' . $art->Raison_Sociale;
                } else {
                    return  $art->Raison_Sociale;
                }
            }
        ]);
        $commercials = $this->Commercials->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $articles = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'Dsignation'])->where('Articles.famille_id=1');
        $depots = $this->fetchTable('Depots')->find('list');

        $this->set(compact('depots', 'clients', 'client_id', 'commercials', 'commercial_id', 'article_id', 'articles', 'commandes', 'historiquede', 'au'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function add27()
    {


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

            //debug($this->request->getData());die;
            $data = $this->fetchTable('Commandes')->newEmptyEntity();
            $bonifclient = $this->fetchTable('Nombrecommandes')->find()->select(["nombre" =>
            'MAX(Nombrecommandes.nombrecommande)'])->first();

            $bonCli = $bonifclient->nombre;

            $commandeCli = $this->Commandes->find()
                ->where(["Commandes.client_id=" . $this->request->getData('client_id') . " "])->count();

            if ($commandeCli + 1 == $bonCli) {

                $client = $this->fetchTable('Clients')->get($this->request->getData('client_id'), [
                    'contain' => []
                ]);

                $client->nouveau_client = 'FALSE';
                $this->fetchTable('Clients')->save($client);
                $data->dateupdateclient = $this->request->getData('date');
            }

            $num = $this->Commandes->find()->select(["num" =>
            'MAX(Commandes.numero)'])->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            // debug($n);
            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
            $data->nbligne = $this->request->getData('nbligne');
            $data->numero = $mm;
            $data->date = $this->request->getData('date');
            $data->client_id = $this->request->getData('client_id');
            $data->depot_id = $this->request->getData('depot_id');
            $data->remise = $this->request->getData('totalremise');
            $data->total = $this->request->getData('total');
            $data->totalttc = $this->request->getData('totalttc');
            $data->Coeff = $this->request->getData('Coeff');
            $data->pallette = $this->request->getData('pallette');
            $data->Poids = $this->request->getData('Poids');
            $data->fodec = $this->request->getData('fod');
            $data->escompte = $this->request->getData('escompte');
            $data->tva = $this->request->getData('tvacommande');
            $data->tpe = $this->request->getData('tpecommande');
            $data->payementcomptant = $this->request->getData('checkpayement');
            $data->commercial_id = $this->request->getData('commercial_id');
            $data->dateintdebut = $this->request->getData('dateintdebut');
            $data->dateintfin = $this->request->getData('dateintfin');
            $data->observation = $this->request->getData('observation');
            $data->bl = $this->request->getData('bl');
            $data->dateimp = $this->request->getData('dateimp');
            $data->brut = $this->request->getData('brut');
            $data->nouv_client = $this->request->getData('nouveau_client');

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
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['ttc'] = $l['prix'];
                            $tab['prixEntre'] = $l['prixEntre'];
                            $tab['escompte'] = $l['escompte'];
                            $tab['pourcentageescompte'] = $l['pourcentageescompte'];
                            $tab['remise'] = $l['remisearticle'];
                            $tab['totalttc'] = $l['totalttc'];
                            $tab['categorieclient'] = $l['categorieclient'];


                            $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            //   debug($lignecommande);
                            $this->fetchTable('Lignecommandes')->save($lignecommande);
                            //debug($lignecommande);die;
                        }
                    }
                }




                return $this->redirect(['action' => 'index']);
            }
        }

        $cha = "TRUE";

        $clients = $this->Commandes->Clients->find('all')
            ->where(["Clients.etat='$cha'"]);

        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id=1"])->where(["Articles.etat=0"]);

        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;

        $this->set(compact('dates', 'commande', 'mm', 'clients', 'commercials', 'articles', 'depots', 'pointdeventes', 'timbre', 'escompte'));
    }

    public function addboncom($id = null)
    {



        error_reporting(E_ERROR | E_PARSE);


        $bonreception = $this->fetchTable('Bonreceptionstocks')->get($id, [
            'contain' => [
                'Depots', 'Clients'
            ]
        ]);
        $lignes = $this->fetchTable('Lignebonreceptionstocks')->find('all', ['contain' => ['Articles'],])
            ->where(['Lignebonreceptionstocks.bonreceptionstock_id=' . $id]);


        ////debug($lignes);

        $this->loadModel('Clients');
        $this->loadModel('Articles');

        $client = $this->Clients->get($bonreception->client_id, [
            'contain' => [],
        ]);
        ///debug($client);
        $idd = $client->commercial_id;
        ///debug($idd);
        $this->loadModel('Commercials');
        if ($client->commercial_id) {
            $commercial = $this->Commercials->get($client->commercial_id, [
                'contain' => [],
            ]);
        }

        //debug($commercial);

        $lignes = $this->fetchTable('Lignebonreceptionstocks')->find('all', ['contain' => ['Articles'],])
            ->where(['Lignebonreceptionstocks.bonreceptionstock_id=' . $id]);

        $num = $this->Commandes->find()->select(["num" =>
        'MAX(Commandes.numero)'])->first();
        $n = $num->num;
        $in = intval($n) + 1;
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        //debug($mm);



        $depots = $this->Commandes->Depots->find('all');
        $clients = $this->Commandes->Clients->find('all');
        $commercials = $this->Commandes->Commercials->find('all');
        $art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles = $this->Articles->find('all');
        $tvas = $this->fetchTable('Tvas')->find('all', []);


        $data = $this->Commandes->newEmptyEntity();

        if ($this->request->is(['post'])) {


            $num = $this->Commandes->find()->select(["num" =>
            'MAX(Commandes.numero)'])->first();
            $n = $num->num;
            $in = intval($n) + 1;
            $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
            $data->numero = $mm;
            $data->date = $this->request->getData('date');
            $data->client_id = $this->request->getData('client_id');
            $data->depot_id = $this->request->getData('depot_id');
            $data->total = $this->request->getData('total');
            $data->totalliv = $this->request->getData('totalliv');
            $data->commercial_id = $this->request->getData('commercial_id');
            $data->observation = $this->request->getData('observation');
            $data->typecommande = '2';

            /// debug($commande);
            if ($this->Commandes->save($data)) {
                $this->misejour("Commandes", "add", $data->id);
                $commande_id = $data->id;


                $bonreception->commande_id = $commande_id;
                $this->fetchTable('Bonreceptionstocks')->save($bonreception);


                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    /////  debug($this->request->getData('data')['ligne']); die ;
                    foreach ($this->request->getData('data')['ligne'] as $i => $l) {
                        if ($l['sup'] != 1) {

                            $tab['commande_id'] = $commande_id;
                            $tab['qte'] = $l['quantite'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['prix'] = $l['prix'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['lignebonreceptionstock_id'] = $l['id'];


                            $lignecommandes = $this->fetchTable('Lignecommandes')->newEmptyEntity();
                            $lignecommandes = $this->fetchTable('Lignecommandes')->patchEntity($lignecommandes, $tab);

                            $this->fetchTable('Lignecommandes')->save($lignecommandes);
                            debug($lignecommandes);
                        }
                    }
                }

                return $this->redirect(['action' => 'indexm/']);
            }
        }


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('commande', 'mm', 'bonreception', 'depots', 'clients', 'commercial', 'commercials', 'lignes', 'art', 'tvas', 'articles', 'depots'));
    }

    public function getescomptee()
    {
        $id = $this->request->getQuery('idfam');
        $montant = $this->request->getQuery('montant');
        $connection = ConnectionManager::get('default');
        $escompte = $connection->execute("select escomptecodifa(" . $id . ",'" . $montant . "'  ) as v")->fetchAll('assoc');
        /* $escompte =$connection->execute("select escomptecodifa(" . $id . ",'" . $montant . "'  ) as v")->fetchAll('assoc');
 */

        echo json_encode(array(
            'escompte' => $escompte
        ));
        die;
    }
    public function imprimeviewbor($id = null)
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
                            } else {
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
        $fodeco = $this->fetchTable('Fodecs')->find()->first();
        $fodec = $fodeco->valeur;
        $this->set(compact('lignecommandes', 'articles', 'commande', 'clients', 'timbre', 'fodec'));
    }

    public function imprimesans($id = null)
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
        $fodeco = $this->fetchTable('Fodecs')->find()->first();
        $fodec = $fodeco->valeur;
        $this->set(compact('lignecommandes', 'articles', 'commande', 'clients', 'timbre', 'fodec'));
    }


    public function viewm($id = null)
    {
        $commande = $this->Commandes->get($id, [
            'contain' => ['Clients']
        ]);

        $type = $commande->typecommande;

        /// debug($commande->etatliv);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());die;
            $commande->nbligne = $this->request->getData('nbligne');
            $commande->numero = $this->request->getData('numero');
            $commande->date = date('Y-m-d', strtotime($this->request->getQuery('date')));
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
            $commande->Coeff = $this->request->getData('Coeff');
            $commande->pallette = $this->request->getData('pallette');
            $commande->Poids = $this->request->getData('Poids');
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
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];
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

        ////debug($lignecommandes->toarray());

        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $typecl = $clientc->typeclient->grandsurface;
        $BL = $clientc->bl;
        // debug($clientc->typeclient->grandsurface);//die;
        if ($typecl == 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }
        $escom = $clientc->typeescompte;
        //  debug($escom);
        if ($escom == TRUE) {
            $es = 'avec palier';
        }

        if ($escom == FALSE) {
            $es = 'sans palier';
        }


        $esremise = $clientc->typeremise;
        //debug($esremise) ;
        if ($esremise == TRUE) {
            $rz = 'avec palier';
        }

        if ($esremise == FALSE) {
            $rz = 'sans palier';
        }
        //debug($cl);die;

        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id=1"]);

        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);
        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;
        // debug($escompte);

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

        $this->loadModel('Remiseclients');
        $remiseclient = 0;
        if ($clientc->typeclient->id != null) {
            $remiseclient = $this->fetchTable('Remiseclients')->find('all', [])->where('Remiseclients.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseclient == null;
        }
        if ($remiseclient != null) {
            $remcli = $remiseclient->id;
        } else {
            $remcli = 0;
        }


        $this->loadModel('Remiseescomptes');
        $remiseescompte = 0;
        if ($clientc->typeclient->id != null) {
            $remiseescompte = $this->fetchTable('Remiseescomptes')->find('all', [])->where('Remiseescomptes.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseescompte == null;
        }
        if ($remiseescompte != null) {
            $remes = $remiseescompte->id;
        } else {
            $remes = 0;
        }

        $date = $commande->date;
        // debug($clientc);
        $date = $date->i18nFormat('yyyy-MM-dd');

        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        //debug($cond1);
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond3 = "Promoarticles.typeclient_id=" . $clientc->typeclient->id;
        $cond4 = "Gspromoarticles.datedebut <= '" . $date . "'";
        $cond5 = "Gspromoarticles.datefin >='" . $date . "'";

        $notgrandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $notgrandsurface = $this->fetchTable('Promoarticles')->find('all', [])->where([$cond1, $cond2, $cond3]);
        } else {
            $notgrandsurface == null;
        }
        $not = "";
        if ($notgrandsurface != null) {
            if ($notgrandsurface != array()) {
                foreach ($notgrandsurface as $ng) {
                    $not = $not . $ng['id'] . ",";
                }
            }
        }
        $not = $not . "0";

        $grandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([$cond4, $cond5]);
        } else {
            $grandsurface == null;
        }
        $gs = "";
        if ($grandsurface != null) {
            if ($grandsurface != array()) {
                foreach ($grandsurface as $n) {
                    $gs = $gs . $n['id'] . ",";
                }
            }
        }
        $gs = $gs . "0";


        $this->set(compact('BL', 'gs', 'not', 'remes', 'remcli', 'es', 'rz', 'cl', 'typecl', 'exotva', 'exofodec', 'exotimbre', 'exotpe', 'clientc', 'lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes', 'escompte', 'type'));
    }

    public function editm($id = null)
    {

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

        $type = $commande->typecommande;

        ////debug($type);

        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());//die;
            $commande->numero = $this->request->getData('numero');
            $commande->bl = $this->request->getData('bl');
            $commande->date = date('Y-m-d H:i:s', strtotime($this->request->getData('date')));
            $commande->client_id = $this->request->getData('client_id');
            $commande->depot_id = $this->request->getData('depot_id');
            $commande->total = $this->request->getData('total');
            $commande->totalliv = $this->request->getData('totalliv');
            $commande->commercial_id = $this->request->getData('commercial_id');
            $commande->observation = $this->request->getData('observation');


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
                            $tab['qtestock'] = $l['qtestock'];



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



                return $this->redirect(['action' => 'indexm']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }

        $lignecommandes = $this->Commandes->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $id]);

        /// debug($lignecommandes->toarray()) ;

        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $BL = $clientc->bl;
        // debug($commande);
        $typecl = $clientc->typeclient->grandsurface;
        //debug($clientc->typeclient->grandsurface);//die;
        if ($typecl = 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }
        //  debug($cl);//die;
        $escom = $clientc->typeescompte;
        if ($escom == TRUE) {
            $es = 'avec palier';
        }

        if ($escom == FALSE) {
            $es = 'sans palier';
        }


        $esremise = $clientc->typeremise;
        //debug($esremise) ;
        if ($esremise == TRUE) {
            $rz = 'avec palier';
        }

        if ($esremise == FALSE) {
            $rz = 'sans palier';
        }
        //debug($cl);die;
        //debug( $commande->date);

        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id=1"])->where(["Articles.etat=0"]);


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

        $this->loadModel('Remiseclients');
        $remiseclient = 0;
        if ($clientc->typeclient->id != null) {
            $remiseclient = $this->fetchTable('Remiseclients')->find('all', [])->where('Remiseclients.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseclient == null;
        }
        if ($remiseclient != null) {
            $remcli = $remiseclient->id;
        } else {
            $remcli = 0;
        }


        $this->loadModel('Remiseescomptes');
        $remiseescompte = 0;
        if ($clientc->typeclient->id != null) {
            $remiseescompte = $this->fetchTable('Remiseescomptes')->find('all', [])->where('Remiseescomptes.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseescompte == null;
        }
        if ($remiseescompte != null) {
            $remes = $remiseescompte->id;
        } else {
            $remes = 0;
        }


        $date = $commande->date;
        // debug($clientc);
        $date = $date->i18nFormat('yyyy-MM-dd');

        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        //debug($cond1);
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond3 = "Promoarticles.typeclient_id=" . $clientc->typeclient->id;
        $cond4 = "Gspromoarticles.datedebut <= '" . $date . "'";
        $cond5 = "Gspromoarticles.datefin >='" . $date . "'";

        $notgrandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $notgrandsurface = $this->fetchTable('Promoarticles')->find('all', [])->where([$cond1, $cond2, $cond3]);
        } else {
            $notgrandsurface == null;
        }
        $not = "";
        if ($notgrandsurface != null) {
            if ($notgrandsurface != array()) {
                foreach ($notgrandsurface as $ng) {
                    $not = $not . $ng['id'] . ",";
                }
            }
        }
        $not = $not . "0";


        //     $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([ $cond4,$cond5])->first();
        //     if ($grandsurface != null) { 
        //     $gs=$grandsurface->id;
        //    // debug($gs);
        //     }else{$gs=0;}
        //    // debug($gs);

        $grandsurface = 0;
        if ($clientc->typeclient->id != null) {

            $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([$cond4, $cond5]);
        } else {
            $grandsurface == null;
        }
        $gs = "";
        if ($grandsurface != null) {
            if ($grandsurface != array()) {
                foreach ($grandsurface as $n) {
                    $gs = $gs . $n['id'] . ",";
                }
            }
        }
        $gs = $gs . "0";

        //debug($commande->bl);
        $champ = $commande->client->bl;


        $this->set(compact('champ', 'BL', 'gs', 'not', 'remes', 'remcli', 'es', 'rz', 'cl', 'typecl', 'exotva', 'exofodec', 'exotimbre', 'exotpe', 'clientc', 'lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes', 'escompte', 'type'));
    }

    public function indexm()
    {
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
        if ($article) {
            $cond8 = 'Commandes.id in ( ' . $detarticle . ')';
        }

        $condtype = 'Commandes.typecommande = 2';

        $query = $this->Commandes->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $condtype])->order(['Commandes.id' => 'DESC']);
        ///debug($query);die;
        $this->paginate = [
            'contain' => ['Clients', 'Commercials'],
        ];

        $commandes = $this->paginate($query);
        //debug($commandes) ;
        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);;
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $zones = $this->fetchTable('Zones')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('article', 'articles', 'zones', 'clients', 'commandes', 'commercials', 'clientsoptions', 'commercialsoptions', 'numero', 'client_id', 'commercial_id'));
    }


    public function index()
    {
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


        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();
        $validationcommande = $user->validationcommande;

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $cond8 = '';
        $cond9 = '';
        $cond9999 = '';
        $condetat1 = '';
        $condetat2 = '';
        $condetatm = '';



        $clientsoptions = $this->Commandes->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $commercialsoptions = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $date = date("Y-m-d");
        $m = date('m');
        if ($m != '01') {
            $dateanc = date('Y-m-d', strtotime('-1 day'));
        } else {
            $last = strtotime('-1 year');
            $dateanc =  date("Y-12-d", $last);
        }

        $datefin = $this->request->getQuery('datefin');
        // if ($datefin == null) {
        //     $datefin = $date;
        // }
        $datedebut = $this->request->getQuery('datedebut');
        // if ($datedebut == null) {
        //     $datedebut = $dateanc;
        // }

        //$depot_id = $this->request->getQuery('depot_id');
        $etatliv = $this->request->getQuery('etatliv');

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




        if ($datefin) {
            $cond6 = "Commandes.date <= '" . $datefin . " 23:59:59' ";
        }
        if ($datedebut) {
            $cond2 = "Commandes.date >= '" . $datedebut . " 00:00:00' ";
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
        if ($article) {
            $cond8 = 'Commandes.id in ( ' . $detarticle . ')';
        }

        // if ($depot_id) {
        //     $cond7 = "Commandes.depot_id  = '" . $depot_id . "' ";
        // }
        $condtype = 'Commandes.typecommande = 1';

        if ($etatliv) {

            if ($etatliv == 1) {

                $condetatm = "Commandes.etatliv  = 1";
            }
            if ($etatliv == 2) {

                $condetatm = "Commandes.etatliv  = 0";
            }
        }
        ///////////////////////////////////
        $hechem = 'Commandes.id = 1 ';

        //    $commm = $this->Commandes->find('all');


        $list1 = '0';



        $cond9999 = 'Commandes.id not in (' . $list1 . ')';


        // $etat = $this->request->getQuery('etatliv');


        /// debug($list1);

        //  debug($etat);


        // if ($etat == 0) {
        //     $condetat1 = 'Commandes.id not in (' . $list1 . ')';
        // }


        // if ($etat == 1) {
        //     $condetat2 = 'Commandes.id in (' . $list1 . ')';
        // }




        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find()->where('Users.id=' . $user_id)->first();


        $condcommercial = '';
        if ($user['poste'] == 2) {
            $usercommercials = $this->fetchTable('Usercommercials')->find()->where('Usercommercials.user_id=' . $user_id);
            if ($usercommercials->count() > 0) {
                $commercialIds = [];
                foreach ($usercommercials as $usercommercial) {
                    $commercialIds[] = $usercommercial->commercial_id;
                }

                $commercialIdsString = implode(',', $commercialIds);



                $condcommercial = 'Commandes.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
            //  debug($condcommercial);
        }


        //////////////////////////////////////////////////////////////////////////////////

        // if (!$etat) {
        $query = $this->Commandes->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6,  $cond8, $condtype, $cond9999, $condcommercial, $condetatm])->order(['Commandes.id' => 'DESC']);
        // } else {
        //     $query = $this->Commandes->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $condtype, $condetat1, $condetat2,$condcommercial,$condetatm])->order(['Commandes.id' => 'DESC']);
        // }

        ///debug($query);die;
        $this->paginate = [
            'contain' => ['Clients', 'Commercials', 'Etattransports', 'Depots', 'Users'],
        ];

        $commandes = $this->paginate($query);
        // debug($commandes) ;
        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);;
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $zones = $this->fetchTable('Zones')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $suivi = [];
        if ($this->request->is(['patch', 'post', 'put'])) {
            $commande = $this->fetchTable('Commandes')->get($this->request->getData('iddialog'));
            $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            if (($this->request->getData('autorisationEnlevement') == '1') && ($this->request->getData('validationTransport') == '1')) {
                $commande->confirme = 1;
            }


            if ($this->Commandes->save($commande)) {

                return $this->redirect(['action' => 'index']);
            }
        }
        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $this->set(compact('validationcommande', 'depots', 'suivi', 'datefin', 'datedebut', 'etat', 'article', 'articles', 'zones', 'clients', 'commandes', 'commercials', 'clientsoptions', 'commercialsoptions', 'numero', 'client_id', 'commercial_id'));
    }





    public function imprimerrecherche($id = null)
    {
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
    public function view($id = null)
    {
        $commande = $this->Commandes->get($id, [
            'contain' => ['Clients']
        ]);

        $type = $commande->typecommande;

        /// debug($commande->etatliv);


        $lignecommandes = $this->Commandes->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $id]);

        ///debug($lignecommandes->toarray());

        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $typecl = $clientc->typeclient->grandsurface;
        $BL = $clientc->bl;
        // debug($clientc->typeclient->grandsurface);//die;
        if ($typecl == 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }
        $escom = $clientc->typeescompte;
        //  debug($escom);
        if ($escom == TRUE) {
            $es = 'avec palier';
        }

        if ($escom == FALSE) {
            $es = 'sans palier';
        }


        $esremise = $clientc->typeremise;
        //debug($esremise) ;
        if ($esremise == TRUE) {
            $rz = 'avec palier';
        }

        if ($esremise == FALSE) {
            $rz = 'sans palier';
        }
        //debug($cl);die;

        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.famille_id=1"]);

        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);
        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;
        // debug($escompte);

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

        $this->loadModel('Remiseclients');
        $remiseclient = 0;
        if ($clientc->typeclient->id != null) {
            $remiseclient = $this->fetchTable('Remiseclients')->find('all', [])->where('Remiseclients.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseclient == null;
        }
        if ($remiseclient != null) {
            $remcli = $remiseclient->id;
        } else {
            $remcli = 0;
        }


        $this->loadModel('Remiseescomptes');
        $remiseescompte = 0;
        if ($clientc->typeclient->id != null) {
            $remiseescompte = $this->fetchTable('Remiseescomptes')->find('all', [])->where('Remiseescomptes.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseescompte == null;
        }
        if ($remiseescompte != null) {
            $remes = $remiseescompte->id;
        } else {
            $remes = 0;
        }

        $date = $commande->date;
        // debug($clientc);
        $date = $date->i18nFormat('yyyy-MM-dd');

        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        //debug($cond1);
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond3 = "Promoarticles.typeclient_id=" . $clientc->typeclient->id;
        $cond4 = "Gspromoarticles.datedebut <= '" . $date . "'";
        $cond5 = "Gspromoarticles.datefin >='" . $date . "'";

        $notgrandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $notgrandsurface = $this->fetchTable('Promoarticles')->find('all', [])->where([$cond1, $cond2, $cond3]);
        } else {
            $notgrandsurface == null;
        }
        $not = "";
        if ($notgrandsurface != null) {
            if ($notgrandsurface != array()) {
                foreach ($notgrandsurface as $ng) {
                    $not = $not . $ng['id'] . ",";
                }
            }
        }
        $not = $not . "0";

        $grandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([$cond4, $cond5]);
        } else {
            $grandsurface == null;
        }
        $gs = "";
        if ($grandsurface != null) {
            if ($grandsurface != array()) {
                foreach ($grandsurface as $n) {
                    $gs = $gs . $n['id'] . ",";
                }
            }
        }
        $gs = $gs . "0";
        $paiements = $this->fetchTable('Paiements')->find('list');
        $valeurs = $this->fetchTable('Tos')->find('list');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $etattransports = $this->fetchTable('Etattransports')->find('list');

        $bl = $this->fetchTable('Bonlivraisons')->find()->where('Bonlivraisons.commande_id=' . $id)->first();
        $bl_id = $bl->id;


        $champ = $commande->client->bl;

        // debug($bl_id);


        $this->loadModel('Piecereglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Commandes');
        $this->loadModel('Bonlivraisons');
        $bonlivraison = $this->Bonlivraisons->find()->where('commande_id=' . $id)->first();
        $commande = $this->Commandes->find()->where('id=' . $id)->first();
        // $lignereglements = $this->Lignereglementclients->find()->where(['Lignereglementclients.bonlivraison_id' => $bonlivraison->id]);

        // $lignereglementcmds =[];
        // if ($commande->id!=0){
        // $lignereglementcmds = $this->Lignereglementclients->find()->where(['Lignereglementclients.commande_id' => $id]);
        // }


        $paiements = $this->fetchTable('Paiements')->find('list');
        $valeurs = $this->fetchTable('Tos')->find('list');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $etattransports = $this->fetchTable('Etattransports')->find('list');


        $clientid = $commande->client_id;

        if ($clientid) {
            /////////////echanciere//////// 
            $reglementsf = $this->fetchTable('Reglementclients')->find('all')->where(['Reglementclients.client_id' => $clientid, 'Reglementclients.type=2'])->toArray();
            $echanciere = 0;
            if ($reglementsf) {
                foreach ($reglementsf as $reg) {
                    $pieces = $this->fetchTable('Piecereglementclients')->find('all')->where([
                        'reglementclient_id' => $reg->id,
                        'paiement_id' => 2,
                        'situation' => 'En attente'
                    ])->toArray();
                    $montantTotal = 0;

                    foreach ($pieces as $piece) {
                        $montantTotal += $piece->montant;
                    }
                    $echanciere += $montantTotal;
                }
            }

            /////////////echancierebl////////
            $reglementsbl = $this->fetchTable('Reglementclients')->find('all')->where(['Reglementclients.client_id' => $clientid, 'Reglementclients.type=1'])->toArray();
            $echancierebl = 0;
            if ($reglementsbl) {
                foreach ($reglementsbl as $regg) {
                    $piecesr = $this->fetchTable('Piecereglementclients')->find('all')->where([
                        'reglementclient_id' => $regg->id,
                        'paiement_id' => 2,
                        'situation' => 'En attente'
                    ])->toArray();
                    $mont = 0;

                    foreach ($piecesr as $piece) {
                        $mont += $piece->montant;
                    }
                    $echancierebl += $mont;
                }
            }


            ////////////encours///////////
            $bl = $this->fetchTable('Bonlivraisons')->find('all')->where([
                'client_id' => $clientid,
                'factureclient_id' => 0,
                'typebl' => 1
            ]);
            //debug($bl);die;
            $encours = 0;
            if ($bl) {
                $total = 0;
                foreach ($bl as $ff) {
                    $total += $ff->totalttc;
                }
                $encours += $total;
            }
            //////////////////////////


            $date = date("Y-m-d");
            // 'solde' => $ss,
            $connection = ConnectionManager::get('default');
            $scl = $connection->execute("select soldeclient(" . $clientid . ", '" . $date . "') as s")->fetchAll('assoc');
            $solde = $scl[0]['s'];
            /// debug($ss);die;
            $data = $this->fetchTable('Clients')->find('all')->where(['Clients.id' => $clientid])->first();
        }

        $this->set(compact('bonlivraison', 'lignereglements', 'echanciere', 'solde', 'echancierebl', 'clientc', 'encours', 'lignereglementcmds', 'etattransports', 'piecereglementclientoffres', 'banques', 'caisses', 'valeurs', 'paiements', 'piecereglementclients', 'champ', 'BL', 'gs', 'not', 'remes', 'remcli', 'es', 'rz', 'cl', 'typecl', 'exotva', 'exofodec', 'exotimbre', 'exotpe', 'clientc', 'lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes', 'escompte', 'type'));
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

        $bl = $this->fetchTable('Bonlivraisons')->find()->where('Bonlivraisons.commande_id=' . $id)->first();
        $bl_id = $bl->id;

        $type = $commande->typecommande;

        ////debug($type);
        $result = $this->request->getAttribute('authentication')->getIdentity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());
            $commande->user_id = $result['id'];

            $commande->nbligne = $this->request->getData('nbligne');
            $commande->date = $this->request->getData('date');
            $commande->client_id = $this->request->getData('client_id');
            $commande->depot_id = $this->request->getData('depot_id');
            $commande->remise = $this->request->getData('totalremise');
            $commande->total = $this->request->getData('total');
            $commande->totalttc = $this->request->getData('totalttc');
            $commande->Coeff = $this->request->getData('Coeff');
            $commande->pallette = $this->request->getData('pallette');
            $commande->Poids = $this->request->getData('Poids');
            $commande->fodec = $this->request->getData('totalfodec');
            $commande->escompte = $this->request->getData('escompte');
            $commande->tva = $this->request->getData('totaltva');
            $commande->tpe = $this->request->getData('tpecommande');
            $commande->payementcomptant = $this->request->getData('checkpayement');
            $commande->commercial_id = $this->request->getData('commercial_id');
            $commande->dateintdebut = $this->request->getData('dateintdebut');
            $commande->dateintfin = $this->request->getData('dateintfin');
            $commande->observation = $this->request->getData('observation');
            $commande->bl = $this->request->getData('bl');
            $commande->dateimp = $this->request->getData('dateimp');
            $commande->brut = $this->request->getData('brut');
            $commande->nouv_client = $this->request->getData('nouveau_client');
            $commande->etattransport_id = $this->request->getData('etattransport_id');
            $commande->Montant_Regler = $this->request->getData('Montant_Reglercmd');

            $commande->totalputtc = $this->request->getData('totalputtc');


            // debug($commande);
            //   $commande = $this->Commandes->patchEntity($commande, $data);
            if ($this->Commandes->save($commande)) {
                //debug($commande);
                $this->misejour("Commandes", "edit", $id);

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($this->request->getData());
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        // debug($l);

                        if ($l['sup'] != 1 && (!empty($l['article_idd']))) {
                            // $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();

                            $tab['commande_id'] = $commande->id;
                            $tab['qte'] = $l['qte'];
                            $tab['ml'] = $l['ml'];
                            $tab['article_id'] = $l['article_idd'];
                            $tab['prix'] = $l['prix'];
                            $tab['prixht'] = $l['ht'];
                            $tab['puttc'] = $l['puttc'];

                            $tab['qtestock'] = $l['qteStock'];
                            $tab['montantht'] = $l['motanttotal'];
                            $tab['remise'] = $l['remise'];
                            $tab['tpe'] = $l['tpecommandeclient'];
                            $tab['tva'] = $l['tva'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['prixEntre'] = $l['prixEntre'];
                            $tab['totaltva'] = $l['monatantlignetva'];

                            $tab['totremiseclient'] = $l['totremiseclient'];
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








                /******************************piece reglement*****************************************/
                //  debug($this->request->getData());
                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    //  debug($this->request->getData('data')['pieceregelemnt']);



                    $ligneregs = $this->fetchTable('Lignereglementclients')->find()->where(["Lignereglementclients.commande_id=" . $id]);
                    $lignereg = $this->fetchTable('Lignereglementclients')->find()->where(["Lignereglementclients.commande_id=" . $id])->first();
                    $reglement_id = $lignereg->reglementclient_id;
                    // debug($ligneregs->toArray());die;
                    if ($ligneregs->count() > 0) {
                        foreach ($ligneregs as $item) {


                            if ($item['Bonlivraison_id'] != null) {
                                $mtg = $this->fetchTable('Bonlivraisons')->find()->select(["mtreg" =>
                                'Bonlivraisons.Montant_Regler'])->where(['Bonlivraisons.id =' . $item['bonlivraison_id']])->first();
                                $MontantRegler = $mtg->mtreg;
                                $fact = $this->fetchTable('Bonlivraisons')->get($item['bonlivraison_id']);
                                $fact->Montant_Regler = $MontantRegler - $item['Montanttt'];
                                $this->Bonlivraisons->save($fact);
                            }

                            $this->fetchTable('Lignereglementclients')->delete($item);
                        }
                        $lignes2 = $this->fetchTable('Piecereglementclients')->find()->where(["Piecereglementclients.reglementclient_id =" . $reglement_id]);
                        foreach ($lignes2 as $item) {
                            $this->fetchTable('Piecereglementclients')->delete($item);
                        }

                        // debug($reglement_id);
                        $ligner = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                        // debug($ligner);die;
                        $t['reglementclient_id'] = $reglement_id;
                        $t['commande_id'] = $id;
                        $t['Montant'] = $this->request->getData('Montant_Reglercmd');
                        //    debug($t);
                        $ligner = $this->fetchTable('Lignereglementclients')->patchEntity($ligner, $t);
                        //debug($t);
                        $this->fetchTable('Lignereglementclients')->save($ligner);


                        foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                            if (isset($p['sup2']) && $p['sup2'] != 1) {
                                $table = $this->fetchTable('Piecereglementclients')->newEmptyEntity();

                                $table['reglementclient_id'] = $reglement_id;
                                $table['caisse_id'] = $p['caisse_id'];
                                $table['porteurcheque'] = $p['porteurcheque'];
                                $table['rib'] = $p['rib'];
                                $table['paiement_id'] = $p['paiement_id'];
                                if (isset($p['montant'])) {
                                    if (strpos($p['montant'], ',') !== false) {
                                        // Replace comma with dot if it exists
                                        $table['montant'] = str_replace(',', '.', $p['montant']);
                                    } else {
                                        // No comma found, use the original value
                                        $table['montant'] = $p['montant'];
                                    }
                                }

                                $table['montant_brut'] = $p['montantbrut'];
                                $table['to_id'] = $p['taux'];
                                $table['montant_net'] = $p['montantnet'];
                                $table['num'] = $p['num_piece'];
                                $table['echance'] = $p['echance'];
                                $table['banque_id'] = $p['banque_id'];

                                $table['proprietaire'] = $p['taux'];
                                //   debug($table);die;
                                // dd(json_encode($table)) ;
                                // dd(json_encode($p)) ;
                                //  debug($lignes);
                                $this->fetchTable('Piecereglementclients')->save($table);
                            }
                        }
                    } else {

                        $numeroobj = $this->fetchTable('Reglementclients')->find()->select(["numero" =>
                        'MAX(Reglementclients.numeroconca)'])->first();
                        $numero = $numeroobj->numero;
                        if ($numero != null) {
                            // debug($numero);

                            $n = $numero;

                            $lastnum = $n;
                            $nume = intval($lastnum) + 1;
                            $nn = (string)$nume;

                            $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
                        } else {
                            $code = "00001";
                        }


                        $ligne = $this->fetchTable('Reglementclients')->newEmptyEntity();
                        //debug($l);die;
                        // $ligne['utilisateur_id'] = $result['utilisateur_id'];
                        //  $tab['reglement_id'] = $reglement_id;
                        // $tab2['bonlivraison_id'] = $bonlivraison->id;
                        $tab2['client_id'] =  $commande->client_id;
                        $tab2['numero'] =   $commande->numero;
                        $tab2['numeroconca'] = $code;

                        $frozenTime = FrozenTime::now();
                        $tab2['Date'] = $frozenTime;
                        $tab2['Montant'] = $this->request->getData('Montant_Reglercmd');
                        $tab2['type'] = 0;
                        //    debug($tab2);
                        $ligne = $this->fetchTable('Reglementclients')->patchEntity($ligne, $tab2);
                        // debug($ligne);
                        $this->fetchTable('Reglementclients')->save($ligne);
                        // debug($ligne);

                        /*******enregistrement lignereglement******************************/

                        $reglement_id = $ligne->id;
                        // debug($reglement_id);die;
                        $ligner = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                        // debug($ligner);die;
                        $t['reglementclient_id'] = $ligne->id;
                        $t['commande_id'] = $id;
                        $t['Montant'] = $this->request->getData('Montant_Reglercmd');
                        //    debug($t);
                        $ligner = $this->fetchTable('Lignereglementclients')->patchEntity($ligner, $t);
                        //debug($t);
                        $this->fetchTable('Lignereglementclients')->save($ligner);




                        /******************************piece reglement*****************************************/
                        // debug($this->request->getData());die;
                        if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                            // debug($this->request->getData('data')['pieceregelemnt']);die;
                            $reglement_id = $ligne->id;
                            foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                                if (isset($p['sup2']) && $p['sup2'] != 1) {
                                    $table = $this->fetchTable('Piecereglementclients')->newEmptyEntity();

                                    $table['reglementclient_id'] = $reglement_id;
                                    $table['caisse_id'] = $p['caisse_id'];
                                    $table['porteurcheque'] = $p['porteurcheque'];
                                    $table['rib'] = $p['rib'];
                                    $table['paiement_id'] = $p['paiement_id'];
                                    if (isset($p['montant'])) {
                                        if (strpos($p['montant'], ',') !== false) {
                                            // Replace comma with dot if it exists
                                            $table['montant'] = str_replace(',', '.', $p['montant']);
                                        } else {
                                            // No comma found, use the original value
                                            $table['montant'] = $p['montant'];
                                        }
                                    }

                                    $table['montant_brut'] = $p['montantbrut'];
                                    $table['to_id'] = $p['taux'];
                                    $table['montant_net'] = $p['montantnet'];
                                    $table['num'] = $p['num_piece'];
                                    $table['echance'] = $p['echance'];
                                    $table['banque_id'] = $p['banque'];
                                    $table['acomptetype'] = 2;
                                    $table['proprietaire'] = $p['taux'];
                                    //   debug($table);die;
                                    // dd(json_encode($table)) ;
                                    // dd(json_encode($p)) ;
                                    //  debug($lignes);
                                    $this->fetchTable('Piecereglementclients')->save($table);
                                }
                            }
                        }
                    }
                }








                //   $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                if ($type == 1) {
                    if ($this->request->getData('action') === 'saveAndImprimepdf') {
                        return $this->redirect(['controller' => 'Commandes', 'action' => 'imprimeview/' . $commande['id']]);
                    } else {
                        return $this->redirect(['action' => 'index']);
                    }
                  //  return $this->redirect(['action' => 'index']);
                }
                if ($type == 2) {
                    return $this->redirect(['action' => 'indexm']);
                }
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }

        $lignecommandes = $this->Commandes->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $id]);

        /// debug($lignecommandes) ;

        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        // debug($clientc);



        $BL = $clientc->bl;

        $typecl = $clientc->typeclient->grandsurface;
        //debug($clientc->typeclient->grandsurface);//die;
        if ($typecl = 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }
        //  debug($cl);//die;
        $escom = $clientc->typeescompte;
        if ($escom == TRUE) {
            $es = 'avec palier';
        }

        if ($escom == FALSE) {
            $es = 'sans palier';
        }


        $esremise = $clientc->typeremise;
        //debug($esremise) ;
        if ($esremise == TRUE) {
            $rz = 'avec palier';
        }

        if ($esremise == FALSE) {
            $rz = 'sans palier';
        }
        //debug($cl);die;
        //debug( $commande->date);

        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.famille_id=1"])->where(["Articles.etat=0"]);


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

        $this->loadModel('Remiseclients');
        $remiseclient = 0;
        if ($clientc->typeclient->id != null) {
            $remiseclient = $this->fetchTable('Remiseclients')->find('all', [])->where('Remiseclients.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseclient == null;
        }
        if ($remiseclient != null) {
            $remcli = $remiseclient->id;
        } else {
            $remcli = 0;
        }


        $this->loadModel('Remiseescomptes');
        $remiseescompte = 0;
        if ($clientc->typeclient->id != null) {
            $remiseescompte = $this->fetchTable('Remiseescomptes')->find('all', [])->where('Remiseescomptes.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseescompte == null;
        }
        if ($remiseescompte != null) {
            $remes = $remiseescompte->id;
        } else {
            $remes = 0;
        }


        $date = $commande->date;
        // debug($clientc);
        $date = $date->i18nFormat('yyyy-MM-dd');

        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        //debug($cond1);
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond3 = "Promoarticles.typeclient_id=" . $clientc->typeclient->id;
        $cond4 = "Gspromoarticles.datedebut <= '" . $date . "'";
        $cond5 = "Gspromoarticles.datefin >='" . $date . "'";

        $notgrandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $notgrandsurface = $this->fetchTable('Promoarticles')->find('all', [])->where([$cond1, $cond2, $cond3]);
        } else {
            $notgrandsurface == null;
        }
        $not = "";
        if ($notgrandsurface != null) {
            if ($notgrandsurface != array()) {
                foreach ($notgrandsurface as $ng) {
                    $not = $not . $ng['id'] . ",";
                }
            }
        }
        $not = $not . "0";


        //     $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([ $cond4,$cond5])->first();
        //     if ($grandsurface != null) { 
        //     $gs=$grandsurface->id;
        //    // debug($gs);
        //     }else{$gs=0;}
        //    // debug($gs);

        $grandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([$cond4, $cond5]);
        } else {
            $grandsurface == null;
        }
        $gs = "";
        if ($grandsurface != null) {
            if ($grandsurface != array()) {
                foreach ($grandsurface as $n) {
                    $gs = $gs . $n['id'] . ",";
                }
            }
        }
        $gs = $gs . "0";

        //debug($commande->bl);
        $champ = $commande->client->bl;

        // debug($bl_id);

        $this->loadModel('Piecereglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Commandes');
        $this->loadModel('Bonlivraisons');
        $bonlivraison = $this->Bonlivraisons->find()->where('commande_id=' . $id)->first();
        $commande = $this->Commandes->find()->where('id=' . $id)->first();
        // $lignereglements = $this->Lignereglementclients->find()->where(['Lignereglementclients.bonlivraison_id' => $bonlivraison->id]);

        // $lignereglementcmds =[];
        // if ($commande->id!=0){
        // $lignereglementcmds = $this->Lignereglementclients->find()->where(['Lignereglementclients.commande_id' => $id]);
        // }

        $paiements = $this->fetchTable('Paiements')->find('list')->where('type=0');
        $valeurs = $this->fetchTable('Tos')->find('list');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $etattransports = $this->fetchTable('Etattransports')->find('list');


        $clientid = $commande->client_id;
        if ($clientid) {
            /////////////echanciere//////// 
            $reglementsf = $this->fetchTable('Reglementclients')->find('all')->where(['Reglementclients.client_id' => $clientid, 'Reglementclients.type=2'])->toArray();
            $echanciere = 0;
            if ($reglementsf) {
                foreach ($reglementsf as $reg) {
                    $pieces = $this->fetchTable('Piecereglementclients')->find('all')->where([
                        'reglementclient_id' => $reg->id,
                        'paiement_id' => 2,
                        'situation' => 'En attente'
                    ])->toArray();
                    $montantTotal = 0;

                    foreach ($pieces as $piece) {
                        $montantTotal += $piece->montant;
                    }
                    $echanciere += $montantTotal;
                }
            }

            /////////////echancierebl////////
            $reglementsbl = $this->fetchTable('Reglementclients')->find('all')->where(['Reglementclients.client_id' => $clientid, 'Reglementclients.type=1'])->toArray();
            $echancierebl = 0;
            if ($reglementsbl) {
                foreach ($reglementsbl as $regg) {
                    $piecesr = $this->fetchTable('Piecereglementclients')->find('all')->where([
                        'reglementclient_id' => $regg->id,
                        'paiement_id' => 2,
                        'situation' => 'En attente'
                    ])->toArray();
                    $mont = 0;

                    foreach ($piecesr as $piece) {
                        $mont += $piece->montant;
                    }
                    $echancierebl += $mont;
                }
            }


            ////////////encours///////////
            $bl = $this->fetchTable('Bonlivraisons')->find('all')->where([
                'client_id' => $clientid,
                'factureclient_id' => 0,
                'typebl' => 1
            ]);
            //debug($bl);die;
            $encours = 0;
            if ($bl) {
                $total = 0;
                foreach ($bl as $ff) {
                    $total += $ff->totalttc;
                }
                $encours += $total;
            }
            //////////////////////////


            $date = date("Y-m-d");
            // 'solde' => $ss,
            $connection = ConnectionManager::get('default');
            $scl = $connection->execute("select soldeclient(" . $clientid . ", '" . $date . "') as s")->fetchAll('assoc');
            $solde = $scl[0]['s'];
            /// debug($ss);die;
            $data = $this->fetchTable('Clients')->find('all')->where(['Clients.id' => $clientid])->first();
        }

        $this->set(compact('bonlivraison', 'lignereglements', 'clientc', 'encours', 'solde', 'echancierebl', 'echanciere', 'lignereglementcmds', 'etattransports', 'piecereglementclientoffres', 'banques', 'caisses', 'valeurs', 'paiements', 'piecereglementclients', 'champ', 'BL', 'gs', 'not', 'remes', 'remcli', 'es', 'rz', 'cl', 'typecl', 'exotva', 'exofodec', 'exotimbre', 'exotpe', 'clientc', 'lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes', 'escompte', 'type'));
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

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);

        //   debug($liendd);
        $commande = 0;
        // debug($liendd);die;
        foreach ($liendd as $k => $liens) {

            if (@$liens['lien'] == 'commandes') {
                $commande = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($commande <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }




        $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [])
            ->where(['Bonlivraisons.commande_id   = (' . $id . ')   ']);



        if ($bonlivraison) {
            foreach ($bonlivraison as $b) {

                //if ($b) {
                $b = $this->fetchTable('Bonlivraisons')->get($b['id']);
                $b->commande_id = 0;
                $this->fetchTable('Bonlivraisons')->save($b);

                ///debug($b);die ;

                // }
            }
        }






        $this->loadModel('Historiquecommandes');


        // $this->request->allowMethod(['post', 'delete']);
        $commande = $this->Commandes->get($id);
        if ($commande->type ==  2) {

            $tab['commande_id'] = $commande->id;
            $tab['numero'] = $commande->numero;
            $tab['date'] = $commande->date;
            $tab['num_tab'] = $commande->num_tab;
            $histocommandes = $this->fetchTable('Historiquecommandes')->newEmptyEntity();
            $histocommandes = $this->Historiquecommandes->patchEntity($histocommandes, $tab);
            $this->Historiquecommandes->save($histocommandes);
            // debug($histocommandes);


        }
        $type = $commande->typecommande;
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


    public function deletem($id = null)
    {

        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_vente' . $abrv);

        //   debug($liendd);
        $commande = 0;
        // debug($liendd);die;
        foreach ($liendd as $k => $liens) {

            if (@$liens['lien'] == 'commandes') {
                $commande = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($commande <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $bonreception = $this->fetchTable('Bonreceptionstocks')->find('all', [])
            ->where(['Bonreceptionstocks.commande_id   = (' . $id . ')   ']);

        if ($bonreception) {
            foreach ($bonreception as $b) {

                $b = $this->fetchTable('Bonreceptionstocks')->get($b['id']);
                $b->commande_id = 0;
                $this->fetchTable('Bonreceptionstocks')->save($b);
            }
        }

        $this->request->allowMethod(['post', 'delete']);
        $commande = $this->Commandes->get($id);

        $type = $commande->typecommande;
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



        return $this->redirect(['action' => 'indexm']);
    }



    public function add()
    {


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

        $num = $this->Commandes->find()
            ->select(["num" => 'MAX(Commandes.numero)'])
            // ->where('Bonlivraisons.typebl=2')
            //->where(['Bonlivraisons.date' => $this->Bonlivraisons->find()->select(['max_date' => 'MAX(Besionachats.date)'])])
            ->first();


        $n = $num->num;

        $in = intval($n) + 1;

        $mm = str_pad("$in", 0, "0", STR_PAD_LEFT);


        // $result = $this->request->getAttribute('authentication')->tgeIdentity();

        $user_id = $this->request->getAttribute('identity')->id;







        $commande = $this->Commandes->newEmptyEntity();
        if ($this->request->is('post')) {
            $num = $this->Commandes->find()
                ->select(["num" => 'MAX(Commandes.numero)'])
                // ->where('Bonlivraisons.typebl=2')
                //->where(['Bonlivraisons.date' => $this->Bonlivraisons->find()->select(['max_date' => 'MAX(Besionachats.date)'])])
                ->first();


            $n = $num->num;

            $in = intval($n) + 1;

            $mm = str_pad("$in", 0, "0", STR_PAD_LEFT);
            //debug($this->request->getData());die;
            $data = $this->fetchTable('Commandes')->newEmptyEntity();
            $bonifclient = $this->fetchTable('Nombrecommandes')->find()->select(["nombre" =>
            'MAX(Nombrecommandes.nombrecommande)'])->first();

            $bonCli = $bonifclient->nombre;

            $commandeCli = $this->Commandes->find()
                ->where(["Commandes.client_id=" . $this->request->getData('client_id') . " "])->count();

            if ($commandeCli + 1 == $bonCli) {

                $client = $this->fetchTable('Clients')->get($this->request->getData('client_id'), [
                    'contain' => []
                ]);

                $client->nouveau_client = 'FALSE';
                $this->fetchTable('Clients')->save($client);
                $data->dateupdateclient = $this->request->getData('date');
            }

            $num = $this->Commandes->find()->select(["num" =>
            'MAX(Commandes.numero)'])->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            // debug($n);
            $data['user_id'] = $user_id;

            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
            $data->nbligne = $this->request->getData('nbligne');
            $data->numero = $mm;
            $data->date = $this->request->getData('date');
            $data->client_id = $this->request->getData('client_id');
            $data->depot_id = $this->request->getData('depot_id');
            $data->remise = $this->request->getData('remisee');
            $data->total = $this->request->getData('total');
            $data->tva = $this->request->getData('tva');

            $data->totalttc = $this->request->getData('totalttc');
            $data->Coeff = $this->request->getData('Coeff');
            $data->pallette = $this->request->getData('pallette');
            $data->Poids = $this->request->getData('Poids');
            $data->fodec = $this->request->getData('fodec');
            $data->escompte = 0;
            $data->tva = $this->request->getData('tva');
            $data->tpe = 0;
            $data->payementcomptant = $this->request->getData('checkpayement');
            $data->commercial_id = $this->request->getData('commercial_id');
            $data->dateintdebut = $this->request->getData('dateintdebut');
            $data->dateintfin = $this->request->getData('dateintfin');
            $data->observation = $this->request->getData('observation');
            $data->bl = $this->request->getData('bl');
            $data->dateimp = $this->request->getData('dateimp');
            $data->brut = $this->request->getData('brut');
            $data->nouv_client = $this->request->getData('nouveau_client');
            $data->totalputtc = $this->request->getData('totalputtc');

            if ($this->Commandes->save($data)) {
                //debug($data);

                $this->misejour("Commandes", "add", $commande->id);
                // debug($commande);
                $commande_id = $data->id;

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //debug($l);

                        if ($l['sup'] !=  1 && (!empty($l['article_idd']))) {

                            $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();

                            $tab['commande_id'] = $commande_id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_idd'];
                            $tab['prix'] = $l['prix'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['montantht'] = $l['motanttotal'];
                            $tab['ml'] = $l['ml'];
                            $tab['puttc'] = $l['puttc'];

                            $tab['remise'] = $l['remiseligne'];
                            $tab['tpe'] = $l['tpecommandeclient'];
                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodeccommandeclient'];
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['ttc'] = $l['ht'];
                            $tab['prixEntre'] = $l['prixEntre'];
                            $tab['escompte'] = $l['escompte'];
                            $tab['pourcentageescompte'] = $l['pourcentageescompte'];
                            $tab['remise'] = $l['remise'];
                            $tab['totalttc'] = $l['ttc'];
                            $tab['categorieclient'] = $l['categorieclient'];


                            $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            //   debug($lignecommande);
                            $this->fetchTable('Lignecommandes')->save($lignecommande);
                            //debug($lignecommande);die;
                        }
                    }
                }
                
                // if ($this->request->getData('action') === 'saveAndImprime') {
                //     return $this->redirect(['controller' => 'Commandes', 'action' => 'imprimeproforma/' . $commande->id]);
                // } else
                 if ($this->request->getData('action') === 'saveAndImprimepdf') {
                    return $this->redirect(['controller' => 'Commandes', 'action' => 'imprimeview/' . $data->id]);
                } else {
                    return $this->redirect(['action' => 'index']);
                }

                //return $this->redirect(['action' => 'index']);
            }
        }

        $cha = "TRUE";

        $clients = $this->Commandes->Clients->find('all');
        //->where(["Clients.etat='$cha'"]);

        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.etat=0"]);

        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;




        $this->set(compact('dates', 'commande', 'mm', 'clients', 'commercials', 'articles', 'depots', 'pointdeventes', 'timbre', 'escompte'));
    }

    public function getremise($id = null)
    {
        $id = $this->request->getQuery('idfam');
        $date = date('Y-m-d', strtotime($this->request->getQuery('date')));
        //   debug($date);
        $ligne = $this->fetchTable('Clients')->get($id, [
            'contain' => [],
        ]);
        // $commande = $this->fetchTable('Commandes')->get($id, [
        //     'contain' => ['Clients']
        // ]);

        //    debug($commande);

        //debug($ligne);


        $typeclients = $this->fetchTable('Clients')->get($id, [
            'contain' => ['Typeclients', 'Gouvernorats']
        ]);
        // debug($typeclients);
        $gov = $this->fetchTable('Clients')->get($id, [
            'contain' => ['Gouvernorats']
        ]);
        $typeclientid = $typeclients->typeclient->id;
        if ($typeclientid  == null) {
            $typeclientid = '0';
        }

        $typeclientname = $typeclients->typeclient->type;

        if ($typeclientname  == null) {
            $typeclientname = '0';
        }


        $typeclient = $typeclients->typeclient->grandsurface;

        //        if ($typeclient  == null){
        //            $typeclient = '0' ;
        //        }
        //
        //debug($typeclient);die;
        $govname = $gov->gouvernorat->id;

        if ($govname  == null) {
            $govname = '0';
        }



        $escompte = $typeclients->typeescompte;

        if ($escompte  == null) {
            $escompte = '0';
        }
        //  debug($escompte) ;
        $remise = $typeclients->typeremise;

        if ($remise  == null) {
            $remise = '0';
        }

        $commercial = $this->fetchTable('Commercials')->find('all', [
            'contain' => ['Categories']
        ])
            ->where(["Commercials.id = " . $ligne->commercial_id . ""])->first();
        //debug($commercial);


        $valeurcategorie = $commercial->category->valeur;
        if ($valeurcategorie  == null) {
            $valeurcategorie = 0;
        }


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

        //debug($typeclientid);

        $this->loadModel('Remiseclients');
        if ($typeclientid) {
            $remiseclient = $this->fetchTable('Remiseclients')->find('all', [])->where('Remiseclients.typeclient_id = ' . $typeclientid)->first();
        }
        if ($remiseclient != null) {
            $remcli = $remiseclient->id;
        } else {
            $remcli = 0;
        }
        // debug($remcli);
        //debug($remcli);
        $this->loadModel('Remiseescomptes');
        if ($typeclientid) {
            $remiseescompte = $this->fetchTable('Remiseescomptes')->find('all', [])->where('Remiseescomptes.typeclient_id = ' . $typeclientid)->first();
        }
        if ($remiseescompte != null) {
            $remes = $remiseescompte->id;
        } else {
            $remes = 0;
        }
        // debug($remcli);

        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond3 = "Promoarticles.typeclient_id=" . $typeclientid;
        $cond4 = "Gspromoarticles.datedebut <= '" . $date . "'";
        $cond5 = "Gspromoarticles.datefin >='" . $date . "'";

        $notgrandsurface = 0;
        if ($typeclientid != null) {
            $notgrandsurface = $this->fetchTable('Promoarticles')->find('all', [])->where([$cond1, $cond2, $cond3]);
        } else {
            $notgrandsurface == null;
        }

        $not = "";
        if ($notgrandsurface != null) {
            if ($notgrandsurface != array()) {
                foreach ($notgrandsurface as $ng) {
                    $not = $not . $ng['id'] . ",";
                }
            }
        }
        $not = $not . "0";

        $grandsurface = 0;
        if ($typeclientid != null) {
            $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([$cond4, $cond5]);
        } else {
            $grandsurface == null;
        }
        $gs = "";
        if ($grandsurface != null) {
            if ($grandsurface != array()) {
                foreach ($grandsurface as $n) {
                    $gs = $gs . $n['id'] . ",";
                }
            }
        }
        $gs = $gs . "0";

        $typeclientbl = $typeclients->bl;


        //   $lig = $this->fetchTable('Commandes')->get($id, [
        //     'contain' => [],
        // ]);
        //debug($lig);



        /* $exo = $this->fetchTable('Clientexonerations')->get($id, [
          'contain' => [],
          ]); */

        echo json_encode(array(
            'typeclientname' => $typeclientname, 'typeclientid' => $typeclientid, 'govname' => $govname, 'typeclient' => $typeclient,
            'valeurcategorie' => $valeurcategorie, 'ligne' => $ligne, 'exotva' => $exotva, 'exofodec' => $exofodec, 'exotpe' => $exotpe, 'exotimbre' => $exotimbre, 'remise' => $remise, 'escompte' => $escompte, 'select' => $select,
            'remcli' => $remcli, 'remes' => $remes, 'not' => $not, 'gs' => $gs, 'typeclientbl' => $typeclientbl,
        ));
        die;
    }

    public function getcategorie($id = null)
    {
        $id = $this->request->getQuery('idfam');
        //  debug($id);





        $commercial = $this->fetchTable('Commercials')->get($id, [
            'contain' => ['Categories']
        ]);
        // debug($commercial);



        $valeurcategorie = $commercial->category->valeur;;

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

    public function updatevalidation($id)
    {

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

    public function devalidation($id)
    {

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

    public function receiveLignesCommandes($id = null)
    {
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

    public function getescompte()
    {

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







    public function addcommande($tab = null)
    {
        $result = $this->request->getAttribute('authentication')->getIdentity();


        $bonlivraison = $this->fetchTable('Bonlivraisons')->get($tab, [
            'contain' => ['Clients']
        ]);
        /// debug($bonlivraison);
        $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id' => $bonlivraison->id]);

        $clients = $this->fetchTable('Clients')->find('all');

        $commercials = $this->fetchTable('Commercials')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $depots = $this->Commandes->Depots->find('list', ['limit' => 200]);

        $articles = $this->fetchTable('Articles')->find('all');
        $dates[0] = "Imperative";
        $dates[1] = "Interval";
        // $commercial = $this->fetchTable('Commercials')->get($bonlivraison->commercial_id);
        // debug($commercial);


        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
        'MAX(Bonusnouvclients.valeur)'])->first();
        // debug($num);

        $bonus = $valeur->valeur;
        ///  debug($lignecommandes->toArray()) ;

        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $BL = $clientc->bl;
        $typecl = $clientc->typeclient->grandsurface;
        //debug($clientc->typeclient->grandsurface);//die;
        if ($typecl = 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }
        //  debug($cl);//die;
        $escom = $clientc->typeescompte;
        if ($escom == TRUE) {
            $es = 'avec palier';
        }

        if ($escom == FALSE) {
            $es = 'sans palier';
        }


        $esremise = $clientc->typeremise;
        //debug($esremise) ;
        if ($esremise == TRUE) {
            $rz = 'avec palier';
        }

        if ($esremise == FALSE) {
            $rz = 'sans palier';
        }

        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $typecl = $clientc->typeclient->grandsurface;
        // debug($clientc->typeclient->grandsurface);//die;
        if ($typecl == 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }

        $this->loadModel('Remiseclients');
        $remiseclient = 0;
        if ($clientc->typeclient->id != null) {
            $remiseclient = $this->fetchTable('Remiseclients')->find('all', [])->where('Remiseclients.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseclient == null;
        }
        if ($remiseclient != null) {
            $remcli = $remiseclient->id;
        } else {
            $remcli = 0;
        }


        $this->loadModel('Remiseescomptes');
        $remiseescompte = 0;
        if ($clientc->typeclient->id != null) {
            $remiseescompte = $this->fetchTable('Remiseescomptes')->find('all', [])->where('Remiseescomptes.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseescompte == null;
        }
        if ($remiseescompte != null) {
            $remes = $remiseescompte->id;
        } else {
            $remes = 0;
        }


        $date = $bonlivraison->date;
        // debug($clientc);
        $date = $date->i18nFormat('yyyy-MM-dd');

        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        //debug($cond1);
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond3 = "Promoarticles.typeclient_id=" . $clientc->typeclient->id;
        $cond4 = "Gspromoarticles.datedebut <= '" . $date . "'";
        $cond5 = "Gspromoarticles.datefin >='" . $date . "'";

        $notgrandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $notgrandsurface = $this->fetchTable('Promoarticles')->find('all', [])->where([$cond1, $cond2, $cond3]);
        } else {
            $notgrandsurface == null;
        }
        $not = "";
        if ($notgrandsurface != null) {
            if ($notgrandsurface != array()) {
                foreach ($notgrandsurface as $ng) {
                    $not = $not . $ng['id'] . ",";
                }
            }
        }
        $not = $not . "0";


        $grandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([$cond4, $cond5]);
        } else {
            $grandsurface == null;
        }
        $gs = "";
        if ($grandsurface != null) {
            if ($grandsurface != array()) {
                foreach ($grandsurface as $n) {
                    $gs = $gs . $n['id'] . ",";
                }
            }
        }
        $gs = $gs . "0";

        //debug($commande->bl);
        $champ = $bonlivraison->client->bl;

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

        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;





        $num = $this->Commandes->find()
            ->select(["num" => 'MAX(Commandes.numero)'])
            // ->where('Bonlivraisons.typebl=2')
            //->where(['Bonlivraisons.date' => $this->Bonlivraisons->find()->select(['max_date' => 'MAX(Besionachats.date)'])])
            ->first();


        $n = $num->num;

        $in = intval($n) + 1;

        $mm = str_pad("$in", 0, "0", STR_PAD_LEFT); 
        //debug($mm);
        $commande = $this->Commandes->newEmptyEntity();
        if ($this->request->is('post')) {
            $num = $this->Commandes->find()
                ->select(["num" => 'MAX(Commandes.numero)'])
                // ->where('Bonlivraisons.typebl=2')
                //->where(['Bonlivraisons.date' => $this->Bonlivraisons->find()->select(['max_date' => 'MAX(Besionachats.date)'])])
                ->first();


            $n = $num->num;

            $in = intval($n) + 1;

            $mm = str_pad("$in", 0, "0", STR_PAD_LEFT);
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

            // $yearf = date('Y');
            // $currentYear = date('y');
            $num = $this->Commandes->find()
                ->select(["num" => 'MAX(Commandes.numero)'])
                // ->where('Bonlivraisons.typebl=2')
                //->where(['Bonlivraisons.date' => $this->Bonlivraisons->find()->select(['max_date' => 'MAX(Besionachats.date)'])])
                ->first();


            $n = $num->num;

            $in = intval($n) + 1;

            $mm = str_pad("$in", 0, "0", STR_PAD_LEFT);
            $data->user_id = $result['id'];

            $data->nbligne = $this->request->getData('nbligne');
            $data->numero = $mm;
            $data->date = $this->request->getData('date');
            $data->client_id = $this->request->getData('client_id');
            $data->depot_id = $this->request->getData('depot_id');
            $data->remise = $this->request->getData('remisee');
            $data->total = $this->request->getData('total');
            $data->totalttc = $this->request->getData('totalttc');
            $data->Coeff = $this->request->getData('Coeff');
            $data->pallette = $this->request->getData('pallette');
            $data->Poids = $this->request->getData('Poids');
            $data->fodec = $this->request->getData('fodec');
            $data->escompte = 0;
            $data->tva = $this->request->getData('tva');
            $data->tpe = 0;
            $data->payementcomptant = $this->request->getData('checkpayement');
            $data->commercial_id = $this->request->getData('commercial_id');
            $data->dateintdebut = $this->request->getData('dateintdebut');
            $data->dateintfin = $this->request->getData('dateintfin');
            $data->observation = $this->request->getData('observation');
            $data->bl = $this->request->getData('bl');
            $data->dateimp = $this->request->getData('dateimp');
            $data->brut = $this->request->getData('brut');
            $data->nouv_client = $this->request->getData('nouveau_client');
            $data->etattransport_id = $this->request->getData('etattransport_id');
            $data->Montant_Regler = $this->request->getData('Montant_Reglercmd');
            $data->totalputtc = $this->request->getData('totalputtc');


            //debug($this->request->getData('totalfodec'));

            // $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            // debug($data);
            if ($this->Commandes->save($data)) {


                $commande_id = $data->id;


                $bonlivraison->commande_id = $commande_id;
                $this->fetchTable('Bonlivraisons')->save($bonlivraison);
                // debug($bonlivraison);

                $this->misejour("Commandes", "add", $commande_id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);die;
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //                        debug($l);


                        if ($l['sup'] != 1) {



                            $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();
                            $lignecommande->commande_id = $data->id;
                            if ($l['qte'] == '') {
                                $lignecommande->qte = 0;
                            } else {
                                $lignecommande->qte = $l['qte'];
                            }

                            $lignecommande->article_id = $l['article_id'];
                            // $lignecommande->prixEntre = @$l['prixEntre'];
                            $lignecommande->ml = $l['ml'];

                            $lignecommande->prix = $l['prix'];
                            $lignecommande->qtestock = $l['qteStock'];
                            $lignecommande->montantht = $l['motanttotal'];
                            $lignecommande->remise = $l['remise'];
                            $lignecommande->tpe = @$l['tpecommandeclient'];
                            $lignecommande->tva = $l['tva'];
                            $lignecommande->puttc = $l['puttc'];

                            $lignecommande->fodec = $l['fodec'];

                            $lignecommande->prixht = $l['ht'];

                            $lignecommande->totaltva = $l['monatantlignetva'];
                            $lignecommande->ttc = $l['ttc'];

                            //  $tab['remisearticle'] = $l['remisearticle'];

                            $lignecommande->totalttc = $l['ttc'];
                            //debug($tab);
                            //  $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();
                            // $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            //  debug($lignecommande);
                            $this->fetchTable('Lignecommandes')->save($lignecommande);
                            //debug($lignecommande); */
                        }
                    }
                }


                // if ($this->request->getData('Montant_Regler') != '0' || $this->request->getData('Montant_Regler') != 0) {

                //     /*******enregistrement reglement******************************/


                //     $numeroobj = $this->fetchTable('Reglementclients')->find()->select(["numero" =>
                //     'MAX(Reglementclients.numeroconca)'])->first();
                //     $numero = $numeroobj->numero;
                //     if ($numero != null) {
                //         // debug($numero);

                //         $n = $numero;

                //         $lastnum = $n;
                //         $nume = intval($lastnum) + 1;
                //         $nn = (string)$nume;

                //         $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
                //     } else {
                //         $code = "00001";
                //     }


                //     $ligne = $this->fetchTable('Reglementclients')->newEmptyEntity();

                //     // $ligne['utilisateur_id'] = $result['utilisateur_id'];
                //     //  $tab['reglement_id'] = $reglement_id;
                //     // $tab2['bonlivraison_id'] = $bonlivraison->id;
                //     $tab2['client_id'] = $data->client_id;
                //     $tab2['numero'] =  $data->numero;
                //     $tab2['numeroconca'] = $code;

                //     $frozenTime = FrozenTime::now();
                //     $tab2['Date'] = $frozenTime;
                //     $tab2['Montant'] = $this->request->getData('Montant_Reglercmd');
                //     $tab2['type'] = 0;
                //     //    debug($tab2);
                //     $ligne = $this->fetchTable('Reglementclients')->patchEntity($ligne, $tab2);
                //     // debug($ligne);
                //     $this->fetchTable('Reglementclients')->save($ligne);
                //     // debug($ligne);

                //     /*******enregistrement lignereglement******************************/

                //     $reglement_id = $ligne->id;
                //     // debug($reglement_id);die;
                //     $ligner = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                //     // debug($ligner);die;
                //     $t['reglementclient_id'] = $ligne->id;
                //     $t['commande_id'] = $commande_id;
                //     $t['Montant'] = $this->request->getData('Montant_Reglercmd');
                //     //    debug($t);
                //     $ligner = $this->fetchTable('Lignereglementclients')->patchEntity($ligner, $t);
                //     //debug($t);
                //     $this->fetchTable('Lignereglementclients')->save($ligner);




                //     /******************************piece reglement*****************************************/
                //     // debug($this->request->getData());die;
                //     if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                //         // debug($this->request->getData('data')['pieceregelemnt']);die;
                //         $reglement_id = $ligne->id;
                //         foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                //             if (isset($p['sup2']) && $p['sup2'] != 1) {
                //                 $table = $this->fetchTable('Piecereglementclients')->newEmptyEntity();

                //                 $table['reglementclient_id'] = $reglement_id;
                //                 $table['caisse_id'] = $p['caisse_id'];
                //                 $table['porteurcheque'] = $p['porteurcheque'];
                //                 $table['rib'] = $p['rib'];
                //                 $table['paiement_id'] = $p['paiement_id'];
                //                 if (isset($p['montant'])) {
                //                     if (strpos($p['montant'], ',') !== false) {
                //                         // Replace comma with dot if it exists
                //                         $table['montant'] = str_replace(',', '.', $p['montant']);
                //                     } else {
                //                         // No comma found, use the original value
                //                         $table['montant'] = $p['montant'];
                //                     }
                //                 }

                //                 $table['montant_brut'] = $p['montantbrut'];
                //                 $table['to_id'] = $p['taux'];
                //                 $table['montant_net'] = $p['montantnet'];
                //                 $table['num'] = $p['num_piece'];
                //                 $table['echance'] = $p['echance'];
                //                 $table['banque_id'] = $p['banque'];
                //                 $table['acomptetype'] = 2;
                //                 $table['proprietaire'] = $p['taux'];
                //                 //   debug($table);die;
                //                 // dd(json_encode($table)) ;
                //                 // dd(json_encode($p)) ;
                //                 //  debug($lignes);
                //                 $this->fetchTable('Piecereglementclients')->save($table);
                //             }
                //         }
                //     }
                // }


                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }





        // $lignereglementclient = $this->fetchTable('Lignereglementclients')->find('all')->where(['Lignereglementclients.bonlivraison_id =' . $tab]);
        // $lignereglementclientcmd = $this->fetchTable('Lignereglementclients')->find('all')->where(['Lignereglementclients.commande_id =' . $commande_id])->first();


        // $reglementclientIds = [];

        // Iterate through the results and collect reglementclient_id values
        // foreach ($lignereglementclient as $row) {
        //     $reglementclientIds[] = $row->reglementclient_id;
        // }

        // Convert the array to a string separated by commas
        // $list = '(' . implode(',', $reglementclientIds) . ')';
        //  debug($lignereglementclient->toarray());
        //  $piecereglementclientoffres = [];
        // if ( $list !='()') {
        //     $piecereglementclientoffres = $this->fetchTable('Piecereglementclients')
        //         ->find('all')
        //         ->where(['Piecereglementclients.reglementclient_id in' . $list])
        //         ->contain(['Caisses', 'Banques', 'Paiements', 'Tos']);
        // }

        $paiements = $this->fetchTable('Paiements')->find('list')->where('type=0');
        $valeurs = $this->fetchTable('Tos')->find('list');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $etattransports = $this->fetchTable('Etattransports')->find('list');


        //$clientid =$bonlivraison->client_id;

        $clientid = $bonlivraison->client_id;
        if ($clientid) {
            /////////////echanciere//////// 
            $reglementsf = $this->fetchTable('Reglementclients')->find('all')->where(['Reglementclients.client_id' => $clientid, 'Reglementclients.type=2'])->toArray();
            $echanciere = 0;
            if ($reglementsf) {
                foreach ($reglementsf as $reg) {
                    $pieces = $this->fetchTable('Piecereglementclients')->find('all')->where([
                        'reglementclient_id' => $reg->id,
                        'paiement_id' => 2,
                        'situation' => 'En attente'
                    ])->toArray();
                    $montantTotal = 0;

                    foreach ($pieces as $piece) {
                        $montantTotal += $piece->montant;
                    }
                    $echanciere += $montantTotal;
                }
            }

            /////////////echancierebl////////
            $reglementsbl = $this->fetchTable('Reglementclients')->find('all')->where(['Reglementclients.client_id' => $clientid, 'Reglementclients.type=1'])->toArray();
            $echancierebl = 0;
            if ($reglementsbl) {
                foreach ($reglementsbl as $regg) {
                    $piecesr = $this->fetchTable('Piecereglementclients')->find('all')->where([
                        'reglementclient_id' => $regg->id,
                        'paiement_id' => 2,
                        'situation' => 'En attente'
                    ])->toArray();
                    $mont = 0;

                    foreach ($piecesr as $piece) {
                        $mont += $piece->montant;
                    }
                    $echancierebl += $mont;
                }
            }


            ////////////encours///////////
            $bl = $this->fetchTable('Bonlivraisons')->find('all')->where([
                'client_id' => $clientid,
                'factureclient_id' => 0,
                'typebl' => 1
            ]);
            //debug($bl);die;
            $encours = 0;
            if ($bl) {
                $total = 0;
                foreach ($bl as $ff) {
                    $total += $ff->totalttc;
                }
                $encours += $total;
            }
            //////////////////////////


            $date = date("Y-m-d");
            // 'solde' => $ss,
            $connection = ConnectionManager::get('default');
            $scl = $connection->execute("select soldeclient(" . $clientid . ", '" . $date . "') as s")->fetchAll('assoc');
            $solde = $scl[0]['s'];
            /// debug($ss);die;
            $data = $this->fetchTable('Clients')->find('all')->where(['Clients.id' => $clientid])->first();
        }


        $this->set(compact('etattransports', 'echanciere', 'encours', 'solde', 'echancierebl', 'piecereglementclientoffres', 'banques', 'piecereglementclients', 'caisses', 'valeurs', 'paiements', 'cl', 'escompte', 'exotva', 'exofodec', 'exotpe', 'bonus', 'clientc', 'dates', 'commande', 'bonlivraison', 'lignebonlivraisons', 'mm', 'articles', 'commercials', 'clients', 'depots', 'es', 'rz', 'typecl', 'remcli', 'not'));
    }
    public function getsremise()
    {
        $id = $this->request->getQuery('idfam');
        $montant = $this->request->getQuery('montant');
        $connection = ConnectionManager::get('default');



        $remise = $connection->execute("select codifaremise(" . $id . ",'" . $montant . "'  ) as v")->fetchAll('assoc');
        /* $escompte =$connection->execute("select escomptecodifa(" . $id . ",'" . $montant . "'  ) as v")->fetchAll('assoc');
 */
        echo json_encode(array(
            'remise' => $remise
        ));
        die;
    }
    public function getpromonotgrandesurface()
    {
        $typeclient = $this->request->getQuery('typeclient');
        $gouvernorat_id = $this->request->getQuery('gouvernerat');
        $article_id = $this->request->getQuery('articleid');
        $date = date('Y-m-d', strtotime($this->request->getQuery('date')));
        $qte = $this->request->getQuery('qte');
        $connection = ConnectionManager::get('default');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond3 = "Promoarticles.typeclient_id=" . $typeclient;
        $cond4 = "Natlignepromoarticles.article_id=" . $article_id;
        $cond5 = "Natlignepromoarticles.qte <=" . $qte;
        $cond6 = "Lignepromoarticles.min <=" . $qte;
        $cond7 = "Lignepromoarticles.max >=" . $qte;
        $cond8 = "Lignepromoarticles.article_id=" . $article_id;
        $cond9 = "Gouvpromoarticles.gouvernorat_id=" . $gouvernorat_id;
        $cond10 = "Gouvpromoarticles.toutgouv=1";
        $typeqte = 2;
        //             $type = $this->fetchtable('Promoarticles')->find('all')->where([$cond1, $cond2, $cond3])->first();
        $nat = $this->fetchtable('Natlignepromoarticles')->find('all')->where([$cond4])->group(['promoarticle_id']);
        $li = $this->fetchtable('Lignepromoarticles')->find('all')->where([$cond8])->group(['promoarticle_id']);


        $list_id = "(0";
        if ($nat != null) {
            if ($nat != array()) {
                foreach ($nat as $natid) {
                    $list_id = $list_id . "," . $natid['promoarticle_id'];
                    // mb_eregi(",".$natid['promoarticle_id']."," ,$list_id)
                }
            }
        }
        if ($li != null) {
            if ($li != array()) {
                foreach ($li as $natid) {
                    $list_id = $list_id . "," . $natid['promoarticle_id'];
                    // mb_eregi(",".$natid['promoarticle_id']."," ,$list_id)
                }
            }
        }
        $list_id = $list_id . ",0)";

        //  debug($list_id);//die;
        $condd = "Promoarticles.id in " . $list_id;
        $type = $this->fetchtable('Promoarticles')->find('all')->where([$cond1, $cond2, $cond3, $condd])->first();
        debug($type);
        die;
        if ($type != null) {
            if ($type['gouv'] == 0) {
                if ($type['type'] == 0) {
                    $typeqte = 0;
                } else {
                    $typeqte = 1;
                }
            } else {
                if ($type['type'] == 0) {
                    $typeqte = 0;
                } else {
                    $typeqte = 1;
                }
            }
        }
        //   debug($typeqte);die;
        $qtepromo = $this->promonotgrandsurface($typeclient, $gouvernorat_id, $article_id, $date, $qte);
        $query = $this->fetchTable('Articles')->find();
        $query->where(['id' => $article_id]);
        foreach ($query as $i => $v) {
            $art = $v->Dsignation;
        }








        /* $escompte =$connection->execute("select escomptecodifa(" . $id . ",'" . $montant . "'  ) as v")->fetchAll('assoc');
 */
        echo json_encode(array(
            'type' => $typeqte, 'name' => $art,
            'qtepromo' => $qtepromo
        ));
        die;
    }
    public function getpromograndesurface()
    {
        $clientid = $this->request->getQuery('clientid');

        $articleid = $this->request->getQuery('articleid');

        $date = date('Y-m-d', strtotime($this->request->getQuery('date')));
        $qte = $this->request->getQuery('qte');
        $connection = ConnectionManager::get('default');
        //       debug($typeclient);
        //         debug($gouvernerat);
        //          debug($articleid);
        //            debug($date);
        //           debug($qte);

        $qtepromo = $this->promogs($date, $clientid, $articleid, $qte);

        $query = $this->fetchTable('Articles')->find();
        $query->where(['id' => $articleid]);
        foreach ($query as $i => $v) {
            $art = $v->Dsignation;
        }








        /* $escompte =$connection->execute("select escomptecodifa(" . $id . ",'" . $montant . "'  ) as v")->fetchAll('assoc');
 */
        echo json_encode(array(
            'name' => $art,
            'qtepromo' => $qtepromo
        ));
        die;
    }



    public function notification($id = null)
    {
        $commande = $this->Commandes->get($id, [
            'contain' => ['Clients']
        ]);

        if ($this->request->is(['patch', 'post', 'put'])) {

            $commande->valide = $this->request->getData('1');
            $commande->bl = $this->request->getData('bl');

            if ($this->Commandes->save($commande)) {

                return $this->redirect(['action' => 'index']);
            }
        }

        $lignecommandes = $this->Commandes->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $id]);

        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $typecl = $clientc->typeclient->grandsurface;
        $BL = $clientc->bl;
        if ($typecl == 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }
        $escom = $clientc->typeescompte;
        //  debug($escom);
        if ($escom == TRUE) {
            $es = 'avec palier';
        }

        if ($escom == FALSE) {
            $es = 'sans palier';
        }

        $esremise = $clientc->typeremise;
        //debug($esremise) ;
        if ($esremise == TRUE) {
            $rz = 'avec palier';
        }

        if ($esremise == FALSE) {
            $rz = 'sans palier';
        }
        //debug($cl);die;

        $count = $this->Commandes->Lignecommandes->find('all')->where(["Lignecommandes.commande_id=" . $id])->count();

        $clients = $this->Commandes->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $commercials = $this->Commandes->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id=1"]);

        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);
        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;
        $time = $commande->date;
        $m = $time->i18nFormat('Y-MM-d');

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $commande->client_id . "' ";

        $exo = $this->fetchTable('Clientexonerations')->find('all', [
            'contain' => ['Typeexons']
        ])->where([$cond3, $cond1, $cond2]);

        $exotpe = '';
        $exotimbre = '';
        $exofodec = '';
        $exotva = '';

        foreach ($exo as $ex) {

            if (strtoupper($ex->typeexon->name) == 'TVA')
                $exotva = $ex->typeexon->name;


            if (strtoupper($ex->typeexon->name) == 'FODEC')
                $exofodec = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TIMBRE')
                $exotimbre = $ex->typeexon->name;

            if (strtoupper($ex->typeexon->name) == 'TPE')
                $exotpe = $ex->typeexon->name;
        }

        $this->loadModel('Remiseclients');
        $remiseclient = 0;
        if ($clientc->typeclient->id != null) {
            $remiseclient = $this->fetchTable('Remiseclients')->find('all', [])->where('Remiseclients.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseclient == null;
        }
        if ($remiseclient != null) {
            $remcli = $remiseclient->id;
        } else {
            $remcli = 0;
        }


        $this->loadModel('Remiseescomptes');
        $remiseescompte = 0;
        if ($clientc->typeclient->id != null) {
            $remiseescompte = $this->fetchTable('Remiseescomptes')->find('all', [])->where('Remiseescomptes.typeclient_id = ' . $clientc->typeclient->id)->first();
        } else {
            $remiseescompte == null;
        }
        if ($remiseescompte != null) {
            $remes = $remiseescompte->id;
        } else {
            $remes = 0;
        }

        $date = $commande->date;
        // debug($clientc);
        $date = $date->i18nFormat('yyyy-MM-dd');

        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
        //debug($cond1);
        $cond2 = "Promoarticles.datefin >='" . $date . "'";
        $cond3 = "Promoarticles.typeclient_id=" . $clientc->typeclient->id;
        $cond4 = "Gspromoarticles.datedebut <= '" . $date . "'";
        $cond5 = "Gspromoarticles.datefin >='" . $date . "'";

        $notgrandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $notgrandsurface = $this->fetchTable('Promoarticles')->find('all', [])->where([$cond1, $cond2, $cond3]);
        } else {
            $notgrandsurface == null;
        }
        $not = "";
        if ($notgrandsurface != null) {
            if ($notgrandsurface != array()) {
                foreach ($notgrandsurface as $ng) {
                    $not = $not . $ng['id'] . ",";
                }
            }
        }
        $not = $not . "0";

        $grandsurface = 0;
        if ($clientc->typeclient->id != null) {
            $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([$cond4, $cond5]);
        } else {
            $grandsurface == null;
        }
        $gs = "";
        if ($grandsurface != null) {
            if ($grandsurface != array()) {
                foreach ($grandsurface as $n) {
                    $gs = $gs . $n['id'] . ",";
                }
            }
        }
        $gs = $gs . "0";


        $this->set(compact('count', 'BL', 'gs', 'not', 'remes', 'remcli', 'es', 'rz', 'cl', 'typecl', 'exotva', 'exofodec', 'exotimbre', 'exotpe', 'clientc', 'lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes', 'escompte'));
    }



    public function getClientmarch($id = null)
    {

        $id = $this->request->getQuery('client');
        $valid = '';
        ///        debug($id);
        $cond = "Commandes.typecommande = 2 ";
        $commandes = $this->Commandes->find('all')->where([$cond]);

        //debug($commandes->toarray()) ;
        $tab = array();
        foreach ($commandes as $i => $c) {
            array_push($tab, $c['client_id']);
        }


        if (in_array($id, $tab)) {

            $valid = 'TRUE';
        } else {
            $valid = 'FALSE';
        }

        ///debug($valid);

        echo json_encode(array(
            'valid' => $valid,

        ));
        die;
    }

    public function verif()
    {
        $id = $this->request->getQuery('id');
        $lignereg = $this->fetchTable('Lignereglementclients')->find('all')->where(['Lignereglementclients.commande_id =' . $id])->count();


        echo json_encode(array('lignereg' => $lignereg));
        die;
    }
}
