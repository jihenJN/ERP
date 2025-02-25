<?php

declare(strict_types=1);

namespace App\Controller;


/**
 * FactureproformatsController Controller
 *
 * @property \App\Model\Table\FactureproformatsTable $Factureproformats
 * @method \App\Model\Entity\Commande[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FactureproformatsController extends AppController
{

    public function imprimeview($id = null)
    {

        $commande = $this->Factureproformats->get($id, [
            'contain' => ['Lignefactureproformats', 'Clients', 'Commercials']
        ]);
        $clients = $this->Factureproformats->Clients->find('list', ['limit' => 200]);
        $commercials = $this->Factureproformats->Commercials->find('list', ['limit' => 200]);

        $clients = $this->Factureproformats->Clients->find('list', ['limit' => 200]);

        $this->loadModel('Lignefactureproformats');
        $lignecommandes = $this->Factureproformats->Lignefactureproformats->find('all')->contain(['Articles'])->where(["Lignefactureproformats.factureproformat_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $commandes = $this->Factureproformats->find('all')->contain(['Clients', 'Commercials']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->set(compact('lignecommandes', 'articles', 'commande', 'clients', 'timbre'));
    }
    public function imprimeviewbor($id = null)
    {

        $commande = $this->Factureproformats->get($id, [
            'contain' => ['Lignefactureproformats', 'Clients', 'Commercials']
        ]);
        $clients = $this->Factureproformats->Clients->find('list', ['limit' => 200]);
        $commercials = $this->Factureproformats->Commercials->find('list', ['limit' => 200]);

        $clients = $this->Factureproformats->Clients->find('list', ['limit' => 200]);

        $this->loadModel('Lignefactureproformats');
        $lignecommandes = $this->Factureproformats->Lignefactureproformats->find('all')->contain(['Articles'])->where(["Lignefactureproformats.factureproformat_id=" . $id . " "]);
        //debug($lignecommandeclients);
        $this->loadModel('Articles');
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $commandes = $this->Factureproformats->find('all')->contain(['Clients', 'Commercials']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->set(compact('lignecommandes', 'articles', 'commande', 'clients', 'timbre'));
    }
    public function view($id = null)
    {
        $commande = $this->Factureproformats->get($id, [
            'contain' => ['Clients']
        ]);



        $lignecommandes = $this->Factureproformats->Lignefactureproformats->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureproformat_id' => $id]);

        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $typecl = $clientc->typeclient->grandsurface;
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

        $clients = $this->Factureproformats->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $commercials = $this->Factureproformats->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
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

        $BL = $clientc->bl;


        $this->set(compact('BL', 'gs', 'not', 'remes', 'remcli', 'es', 'rz', 'cl', 'typecl', 'exotva', 'exofodec', 'exotimbre', 'exotpe', 'clientc', 'lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes', 'escompte'));
    }

    public function index()
    {

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';
        $cond8 = '';

        $clientsoptions = $this->Factureproformats->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $commercialsoptions = $this->Factureproformats->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $commercial_id = $this->request->getQuery('commercial_id');
        $client_id = $this->request->getQuery('client_id');
        $numero = $this->request->getQuery('numero');
        $zone = $this->request->getQuery('zone_id'); //debug($zone);


        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id" => 1]);
        $article = $this->request->getQuery('article_id');


        if ($article) {
            $lignecommandes = $this->fetchTable('Lignefactureproformats')->find('all')->where(["Lignefactureproformats.article_id=" . $article]);
            //debug($lignecommandes);
            $detarticle = "0";
            foreach ($lignecommandes as $art) {
                //dd($art);
                //$detarticle = $detarticle . ',' . $art->commande_id;
                $detarticle = $detarticle . "," . $art->factureproformat_id;
            }
            // debug($lignecommandes);
        }
        $detarticle = $detarticle . ",0";
        //debug($detarticle);

        $chaine = substr($detarticle, 1);
        //debug($chaine);
        $multiid = explode(",", $chaine);
        //debug($multiid[1]);die;

        //  $ligne = $this->fetchTable('Lignefactureproformats')->find('list',['keyfield' => 'factureproformat_id'])->where("Lignefactureproformats.article_id =".$multiid[1]);
        //debug($ligne->toArray());die;



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
            $cond6 = "Factureproformats.date <= '" . $datefin . "' ";
        }
        if ($datedebut) {
            $cond2 = "Factureproformats.date >= '" . $datedebut . "' ";
        }
        if ($commercial_id) {
            $cond3 = "Factureproformats.commercial_id ='" . $commercial_id . "' ";
        }
        if ($client_id) {
            $cond4 = "Factureproformats.client_id = '" . $client_id . "' ";
        }
        if ($numero) {
            $cond5 = "Factureproformats.numero like '%" . $numero . "%' ";
        }
        if ($article) {
            //  $cond8 = "Factureproformats.id ='" . $ligne . "' ";
            $cond8 = 'Factureproformats.id in ( ' . $detarticle . ')';
        }
        // debug($cond8);die;

        $query = $this->Factureproformats->find('all')->where([$cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8]);
        //->order(["Factureproformats.id" => 'DESC']);
        //dd($cond8);
        //debug($query);die;
        $this->paginate = [
            'contain' => ['Clients', 'Commercials']
        ];
        $facturepros = $this->paginate($query);

        // debug($facturepros);
        $clients = $this->Factureproformats->Clients->find('all')->where(["Clients.etat " => 'TRUE']);;
        $commercials = $this->Factureproformats->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $zones = $this->fetchTable('Zones')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('article', 'articles', 'zones', 'clients', 'facturepros', 'commercials', 'clientsoptions', 'commercialsoptions', 'numero', 'client_id', 'commercial_id'));
    }




    public function add()
    {

        $dates[0] = "Impérative";
        $dates[1] = "Interval";

        $num = $this->Factureproformats->find()->select(["num" =>
        'MAX(Factureproformats.numero)'])->first();

        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        // debug($n);
        $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
        // debug($mm);
        $facturepro = $this->Factureproformats->newEmptyEntity();
        if ($this->request->is('post')) {

            ///debug($this->request->getData());die;
            $data = $this->fetchTable('Factureproformats')->newEmptyEntity();
            $bonifclient = $this->fetchTable('Nombrecommandes')->find()->select(["nombre" =>
            'MAX(Nombrecommandes.nombrecommande)'])->first();

            $bonCli = $bonifclient->nombre;
            //debug($bonCli);
            $commandeCli = $this->Factureproformats->find()
                ->where(["Factureproformats.client_id=" . $this->request->getData('client_id') . " "])->count();
            //  $commandeCli->select(['count' => $commandeCli->func()->count('*')]);
            //debug($commandeCli + 1);
            //    die;
            if ($commandeCli + 1 == $bonCli) {
                //debug('hh');
                $client = $this->fetchTable('Clients')->get($this->request->getData('client_id'), [
                    'contain' => []
                ]);
                $client->nouveau_client = 'FALSE';
                $this->fetchTable('Clients')->save($client);
                $data->dateupdateclient = $this->request->getData('date');
            }


            $num = $this->Factureproformats->find()->select(["num" =>
            'MAX(Factureproformats.numero)'])->first();

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            // debug($n);
            $mm = str_pad("$in", 5, "0", STR_PAD_LEFT);
            $data->nbligne = $this->request->getData('nbligne');
            $data->numero = $this->request->getData('numero');
            $data->date = $this->request->getData('date');
            $data->client_id = $this->request->getData('client_id');
            $data->depot_id = $this->request->getData('depot_id');
            $data->remise = $this->request->getData('totalremise');
            $data->total = $this->request->getData('totalht');
            $data->totalttc = $this->request->getData('totalttc');
            $data->Coeff = $this->request->getData('Coeff');
            $data->pallette = $this->request->getData('pallette');
            $data->Poids = $this->request->getData('Poids');
            $data->fodec = $this->request->getData('totalfodec');
            $data->escompte = 0;
            $data->tva = $this->request->getData('totaltva');
            $data->tpe = 0;
            $data->payementcomptant = $this->request->getData('checkpayement');
            $data->commercial_id = $this->request->getData('commercial_id');
            $data->dateintdebut = $this->request->getData('dateintdebut');
            $data->dateintfin = $this->request->getData('dateintfin');
            $data->observation = $this->request->getData('observation');
            $data->dateimp = $this->request->getData('dateimp');
            $data->brut = $this->request->getData('brut');
            $data->nouv_client = $this->request->getData('nouveau_client');


            if ($this->Factureproformats->save($data)) {

                $this->misejour("Factureproformats", "add", $facturepro->id);
                // debug($commande);
                $fac_id = $data->id;

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //debug($l);

                        if ($l['sup'] != 1) {

                            $lignefac = $this->fetchTable('Lignefactureproformats')->newEmptyEntity();

                            $tab['factureproformat_id'] = $fac_id;
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

                            $lignefac = $this->fetchTable('Lignefactureproformats')->patchEntity($lignefac, $tab);

                            $this->fetchTable('Lignefactureproformats')->save($lignefac);

                            ///debug($lignefac);
                        }
                    }
                }

                return $this->redirect(['action' => 'index']);
            }
        }

        $cha = "TRUE";
        $clients = $this->Factureproformats->Clients->find('all')
            ->where(["Clients.etat='$cha'"]);
        $commercials = $this->Factureproformats->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id=1"]);
        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['limit' => 200]);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;

        $this->set(compact('dates', 'facturepro', 'mm', 'clients', 'commercials', 'articles', 'depots', 'pointdeventes', 'timbre', 'escompte'));
    }


    public function updatevalidation($id)
    {

        $commande = $this->Factureproformats->get($id, [
            'contain' => ['Clients']
        ]);

        $commande->valide = 1;
        //  $this->fetchTable('Commandes')->save($commande);

        if ($this->Factureproformats->save($commande)) {
            // debug($commande);
            return $this->redirect(['action' => 'index']);
        }
        die;
    }

    public function edit($id = null)
    {

        $commande = $this->Factureproformats->get($id, [
            'contain' => ['Clients']
        ]);

        //   debug($commande);
        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());//die;
            $commande->nbligne = $this->request->getData('nbligne');
            $commande->numero = $this->request->getData('numero');
            $commande->date = date('Y-m-d H:i:s', strtotime($this->request->getData('date')));
            $commande->client_id = $this->request->getData('client_id');
            $commande->depot_id = $this->request->getData('depot_id');
            $commande->remise = $this->request->getData('totalremise');
            $commande->total = $this->request->getData('totalht');
            $commande->totalttc = $this->request->getData('totalttc');
            $commande->fodec = $this->request->getData('totalfodec');
            $commande->escompte = $this->request->getData('escompte');
            $commande->tva = $this->request->getData('totaltva');
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
            if ($this->Factureproformats->save($commande)) {
                //debug($commande);
                $this->misejour("Factureproformats", "edit", $id);

                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        // debug($l);

                        if ($l['sup'] != 1) {
                            // $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();

                            $tab['factureproformat_id'] = $commande->id;
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
                            $tab['remise'] = $l['remisearticle'];

                            $tab['totalttc'] = $l['totalttc'];
                            //debug($tab);
                            // debug($tab);


                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignecommande = $this->fetchTable('Lignefactureproformats')->get($l['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignecommande = $this->fetchTable('Lignefactureproformats')->newEmptyEntity();
                            }

                            $lignecommande = $this->fetchTable('Lignefactureproformats')->patchEntity($lignecommande, $tab);
                            //debug($lignecommande);

                            if ($this->fetchTable('Lignefactureproformats')->save($lignecommande)) {

                                // $this->Flash->success("Ligne bon de commande has been modified successfully");
                            } else {
                                // $this->Flash->error("Failed to midify ligne bon de chyargements");
                            }
                        } else if (!empty($l['id'])) {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignecommande = $this->fetchTable('Lignefactureproformats')->get($l['id']);

                            $this->fetchTable('Lignefactureproformats')->delete($lignecommande);
                        }
                    }
                }



                //   $this->Flash->success(__('The {0} has been saved.', 'Commande'));

                return $this->redirect(['action' => 'index']);
            }
            // $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }

        $lignecommandes = $this->Factureproformats->Lignefactureproformats->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureproformat_id' => $id]);

        ///  debug($lignecommandes->toArray()) ;

        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($commande->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
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

        $clients = $this->Factureproformats->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $commercials = $this->Factureproformats->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id=1"]);

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

        $BL = $clientc->bl;


        $this->set(compact('BL', 'gs', 'not', 'remes', 'remcli', 'es', 'rz', 'cl', 'typecl', 'exotva', 'exofodec', 'exotimbre', 'exotpe', 'clientc', 'lignecommandes', 'commande', 'depots', 'clients', 'commercials', 'articles', 'timbre', 'pointdeventes', 'escompte'));
    }


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

        // Factureproformats->Lignefactureproformats


        $this->request->allowMethod(['post', 'delete']);
        $commande = $this->Factureproformats->get($id);
        $lignecommandes = $this->Factureproformats->Lignefactureproformats->find('all', [])
            ->where(['factureproformat_id' => $id]);
        foreach ($lignecommandes as $c) {
            $this->Factureproformats->Lignefactureproformats->delete($c);
        }

        if ($this->Factureproformats->delete($commande)) {
            $this->misejour("Commandes", "delete", $id);
            // $this->Flash->success(__('The {0} has been deleted.', 'Commande'));
        } else {
            // $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Commande'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
