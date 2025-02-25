<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;


/**
 * Factureavoirs Controller
 *
 * @property \App\Model\Table\FactureavoirsTable $Factureavoirs
 * @method \App\Model\Entity\Factureavoir[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FactureavoirsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

     public function addfactureavoir($id = null)
    {

        error_reporting(E_ERROR | E_PARSE);


        $bonreception = $this->fetchTable('Bonreceptionstocks')->get($id, [
            'contain' => [
                'Depots', 'Clients'
            ]
        ]);
        $this->loadModel('Clients');
        $this->loadModel('Articles');

        $client = $this->Clients->get($bonreception->client_id, [
            'contain' => [],
        ]);
       //debug($client);
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

         ///   debug($lignes->toarray());

         $currentYear = date('y');
            $num = $this->Factureavoirs->find()->select(["num" =>
            'MAX(Factureavoirs.numero)'])->first();

            $n = $num->num;

            if ($n) {
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                $in = '1111';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $mm = "FA{$currentYear}00{$mm}";
        ///   debug($mm);



        $depots = $this->Factureavoirs->Depots->find('all');
        $clients = $this->Factureavoirs->Clients->find('all');
        $commercials = $this->Factureavoirs->Commercials->find('all');
        $art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles = $this->Articles->find('all');
        $tvas = $this->fetchTable('Tvas')->find('all', ['keyfield' => 'id', 'valueField' => 'valeur']);


        $data = $this->Factureavoirs->newEmptyEntity();

        if ($this->request->is(['post'])) {

            $currentYear = date('y');
            $num = $this->Factureavoirs->find()->select(["num" =>
            'MAX(Factureavoirs.numero)'])->first();

            $n = $num->num;

            if ($n) {
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                $in = '1111';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $mm = "FA{$currentYear}00{$mm}";

            $data->numero = $mm;
            $data->date = $this->request->getData('date');
            $data->client_id = $this->request->getData('client_id');
            $data->depot_id = $this->request->getData('depot_id');
            $data->remise = $this->request->getData('totalremise');
            $data->total = $this->request->getData('total');
            $data->totalttc = $this->request->getData('totalttc');
            $data->fodec = $this->request->getData('fod');
            $data->tva = $this->request->getData('tvacommande');
            $data->commercial_id = $this->request->getData('commercial_id');
            $data->brut = $this->request->getData('brut');
            $data->typef = '2';


           // debug($data); die ;


            //  $factureavoir = $this->Factureavoirs->patchEntity($factureavoir, $data);
            /// debug($factureavoir);
            if ($this->Factureavoirs->save($data)) {
                $this->misejour("Factureavoirs", "add", $data->id);
                $factureavoir_id = $data->id;


                $bonreception->factureavoir_id = $factureavoir_id;
                $this->fetchTable('Bonreceptionstocks')->save($bonreception);


                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    //debug($this->request->getData('data')['ligne']);
                    foreach ($this->request->getData('data')['ligne'] as $i => $l) {
                        if ($l['sup'] != 1) {

                            $tab['factureavoir_id'] = $factureavoir_id;
                            $tab['qte'] = $l['quantite'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['prix'] = $l['prix'];
                            $tab['qtestock'] = $l['qtestock'];
                            $tab['remiseclient'] = $l['remiseclient'];
                            $tab['remise'] = $l['remisearticle'];
                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];

                            $lignefactureavoirs = $this->fetchTable('Lignefactureavoirs')->newEmptyEntity();
                            $lignefactureavoirs = $this->fetchTable('Lignefactureavoirs')->patchEntity($lignefactureavoirs, $tab);

                            $this->fetchTable('Lignefactureavoirs')->save($lignefactureavoirs);
                            //// debug($lignefactureavoirs); die; 

                        }
                    }
                }

                return $this->redirect(['action' => 'index/2']);
            }
        }




        $this->set(compact('factureavoir', 'mm', 'bonreception', 'depots', 'clients', 'commercial', 'commercials', 'lignes', 'art', 'tvas', 'articles'));
    }

    public function addfacavoir($id = null)
    {

        $factureavoir = $this->Factureavoirs->newEmptyEntity();
        if ($this->request->is(['post'])) {

            $num = $this->Factureavoirs->find()->select(["num" =>
            'MAX(Factureavoirs.numero)'])->first();
            // debug($num);
            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $numspecial = str_pad("$in", 6, "0", STR_PAD_LEFT);
            $factureavoir = $this->Factureavoirs->patchEntity($factureavoir, $this->request->getdata());
            $factureavoir->numero = $numspecial;
            //  debug($factureavoir);

            if ($this->Factureavoirs->save($factureavoir)) {


                $fac_id = $factureavoir->id;

                if (isset($this->request->getData('data')['Lignefacture']) && (!empty($this->request->getData('data')['Lignefacture']))) {
                    foreach ($this->request->getData('data')['Lignefacture'] as $i => $f) {

                        $lignef = $this->fetchTable('Lignefactureavoirs')->newEmptyEntity();

                        $Lignefac['factureavoir_id'] = $fac_id;
                        $Lignefac['article_id'] = $f['article_id'];
                        $Lignefac['lignefactureclient_id'] = $f['id'];
                        $Lignefac['quantite'] = $f['qtea'];
                        $Lignefac['qte'] = $f['quantite'];
                        $Lignefac['remise'] = $f['remise'];
                        $Lignefac['tva_id'] = $f['tva_id'];
                        $Lignefac['prix'] = $f['prix'];
                        $Lignefac['fodec'] = $f['fodec'];
                        $Lignefac['totalht'] = $f['totalht'];
                        $Lignefac['totalttc'] = $f['totalttc'];

                        $lignef = $this->fetchTable('Lignefactureavoirs')->patchEntity($lignef, $Lignefac);
                        $this->fetchTable('Lignefactureavoirs')->save($lignef);

                        // debug($lignef);


                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->loadModel('Lignefactureclients');
        $this->loadModel('Factureclients');
        $this->loadModel('Depots');
        $this->loadModel('Articles');

        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Lignefactureclients', 'Clients'],
        ]);
        ///debug($factureclient)  ;
        $lignefactures = $this->Lignefactureclients->find('all', [])->where(['Lignefactureclients.factureclient_id=' . $id]);

        $num = $this->Factureavoirs->find()->select(["num" =>
        'MAX(Factureavoirs.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $numspecial = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $depots = $this->Factureavoirs->Depots->find('all');
        $art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $clients = $this->Factureavoirs->Clients->find('all');
        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);

        $typecl = $clientc->typeclient->grandsurface;
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
        $date = $factureclient->date;
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
            $notgrandsurface = $this->fetchTable('Promoarticles')->find('all', [])->where([$cond1, $cond2, $cond3])->first();
        } else {
            $notgrandsurface == null;
        }
        if ($notgrandsurface != null) {
            $not = $notgrandsurface->id;
        } else {
            $not = 0;
        }


        $grandsurface = $this->fetchTable('Gspromoarticles')->find('all', [])->where([$cond4, $cond5]);
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





        $this->set(compact('factureclient', 'lignefactures', 'art', 'depots', 'numspecial', 'factureavoir', 'clients', 'rz', 'es', 'remcli', 'remes', 'clientc', 'not', 'gs', 'BL', 'cl'));
    }



    public function index($type = null)
    {

        error_reporting(E_ERROR | E_PARSE);



        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '' ;

        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $client_id = $this->request->getQuery('client_id');
        $num = $this->request->getQuery('numero');


        if ($datedebut) {
            $cond1 = 'Factureavoirs.date >= ' . "'" . $datedebut . "'";
        }
        if ($datefin) {
            $cond2 = 'Factureavoirs.date <= ' . "'" . $datefin . "'";
        }
        if ($client_id) {
            $cond3 = "Factureavoirs.client_id  =  '" . $client_id . "' ";
        }

        if ($num) {
            $cond4 = "Factureavoirs.numero like '%" . $num . "%' ";
        }

        $condtyp = "Factureavoirs.typef=" . $type;


        $query = $this->Factureavoirs->find('all', [
            'contain' => ['Clients', 'Typefactures'],
        ])->where([$condtyp,$cond1,$cond2,$cond3,$cond4])->order(['Factureavoirs.id' => 'DESC']);

        //debug($query);

        $factureavoirs = $this->paginate($query);


        ////   debug($factureavoirs);


        $clients = $this->fetchTable('Clients')->find('all');

        $this->set(compact('factureavoirs', 'clients', 'type','client_id'));
    }

    /**
     * View method
     *
     * @param string|null $id Factureavoir id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignefactureavoirs');
        $this->loadModel('Lignefactureclients');
        $this->loadModel('Factureclients');
        $this->loadModel('Tvas');
        $this->loadModel('Fodecs');
        $this->loadModel('Commercials');
        $this->loadModel('Clients');

        $factureavoir = $this->Factureavoirs->get($id, [
            'contain' => []
        ]);

        $client = $this->Clients->get($factureavoir->client_id, [
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


        $type = $factureavoir->factureclient_id;

        $typefac = $factureavoir->typef;

        // debug($type) ;
        $lignefactureavoirs = $this->Lignefactureavoirs->find('all', [])->where(['Lignefactureavoirs.factureavoir_id=' . $id]);


        $art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles = $this->Articles->find('all');
        $commercials = $this->Commercials->find('all');


        $clients = $this->Factureavoirs->Clients->find('all');
        $typefactures = $this->Factureavoirs->Typefactures->find('list', ['limit' => 200]);
        $depots = $this->Factureavoirs->Depots->find('all');

        $tvas = $this->Tvas->find('all');
        $fodecs = $this->Fodecs->find('all');

        $tv = $this->Tvas->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $fod = $this->Fodecs->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);




        $this->set(compact('factureavoir', 'clients', 'typefactures', 'lignefactureavoirs', 'art', 'depots', 'type', 'tvas', 'fodecs', 'tv', 'fod', 'typefac', 'articles', 'commercials', 'commercial'));
    }


    /**
     *  method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    
    {
        $factureavoir = $this->Factureavoirs->newEmptyEntity();


        $currentYear = date('y');
        $num = $this->Factureavoirs->find()->select(["num" => 'MAX(Factureavoirs.numero)'])->first();
        $n = $num->num;

        if ($n) {
            // Extract the last 4 digits from the existing serial number and increment by 1
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            // If no previous record found, start from 1111
            $in = '1111';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $numspecial = "FA{$currentYear}00{$mm}";

        if ($this->request->is('post')) {
            $currentYear = date('y');
        $num = $this->Factureavoirs->find()->select(["num" => 'MAX(Factureavoirs.numero)'])->first();
        $n = $num->num;

        if ($n) {
            // Extract the last 4 digits from the existing serial number and increment by 1
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            // If no previous record found, start from 1111
            $in = '1111';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $numspecial = "FA{$currentYear}00{$mm}";

            $factureavoir = $this->Factureavoirs->patchEntity($factureavoir, $this->request->getData());

            $factureavoir->numero = $numspecial;

            ////debug($factureavoir);
            if ($this->Factureavoirs->save($factureavoir)) {


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData());
                    foreach ($this->request->getData('data')['ligner'] as $i => $f) {

                        if ($f['sup'] != 1) {


                            $lignef = $this->fetchTable('Lignefactureavoirs')->newEmptyEntity();

                            $Lignefac['factureavoir_id'] = $factureavoir->id;
                            $Lignefac['designation'] = $f['designation'];
                            $Lignefac['quantite'] = $f['quantite'];
                            $Lignefac['prix'] = $f['prix'];
                            $Lignefac['fodec'] = $f['fodec'];
                            $Lignefac['tva'] = $f['tva'];
                            $Lignefac['ttc'] = $f['ttc'];
                            //  $Lignefac['remise'] = $f['remise'];

                            ///debug($Lignefac);

                            $lignef = $this->fetchTable('Lignefactureavoirs')->patchEntity($lignef, $Lignefac);
                            $this->fetchTable('Lignefactureavoirs')->save($lignef);

                            ///debug($lignef);

                        }
                    }
                }

                return $this->redirect(['action' => 'index/1']);
            }
        }
        $this->loadModel('Clients');
        $this->loadModel('Factureclients');
        $this->loadModel('Pointdeventes');
        $this->loadModel('Tvas');
        $this->loadModel('Fodecs');

        $clients = $this->Clients->find('all')->where(["Clients.etat " => 'TRUE']);

        $facturescl = $this->Factureclients->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);
        $sites = $this->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $tvas = $this->fetchTable('Tvas')->find('all', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $fodecs = $this->Fodecs->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);


        //debug($tvas->toarray());



        $depots = $this->Factureavoirs->Depots->find('list', ['limit' => 200]);
        $typefactures = $this->Factureavoirs->Typefactures->find('list', ['limit' => 200]);
       

        $now =  new FrozenTime('now', 'Africa/Tunis');
        $this->set(compact('factureavoir', 'clients', 'typefactures', 'depots', 'numspecial', 'facturescl', 'sites', 'now', 'tvas', 'fodecs'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Factureavoir id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Articles');
        $this->loadModel('Depots');
        $this->loadModel('Lignefactureavoirs');
        $this->loadModel('Lignefactureclients');
        $this->loadModel('Factureclients');
        $this->loadModel('Tvas');
        $this->loadModel('Fodecs');
        $this->loadModel('Commercials');
        $this->loadModel('Clients');


        $factureavoir = $this->Factureavoirs->get($id, [
            'contain' => []
        ]);

        //debug($factureavoir) ;


        $client = $this->Clients->get($factureavoir->client_id, [
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

        ///debug($commercial);


        ///debug($factureavoir);

        $type = $factureavoir->factureclient_id;

        $typefac = $factureavoir->typef;

        ///debug($typefac);


        // debug($type) ;
        $lignefactureavoirs = $this->Lignefactureavoirs->find('all', [])->where(['Lignefactureavoirs.factureavoir_id=' . $id]);

        /// debug($lignefactureavoirs->toarray());


        if ($this->request->is(['patch', 'post', 'put'])) {
            $factureavoir = $this->Factureavoirs->patchEntity($factureavoir, $this->request->getData());
            if ($this->Factureavoirs->save($factureavoir)) {


                if (isset($this->request->getData('data')['Lignefacture']) && (!empty($this->request->getData('data')['Lignefacture']))) {
                    // debug($this->request->getData('data')['Lignefacture']);
                    foreach ($this->request->getData('data')['Lignefacture'] as $i => $f) {
                        if ($f['sup'] != 1) {

                            if ($typefac == 1) {

                                $Lignefac['factureavoir_id'] = $factureavoir->id;
                                $Lignefac['designation'] = $f['designation'];
                                $Lignefac['quantite'] = $f['quantite'];
                                $Lignefac['prix'] = $f['prix'];
                                $Lignefac['fodec'] = $f['fodec'];
                                $Lignefac['tva'] = $f['tva'];
                                $Lignefac['ttc'] = $f['ttc'];
                            }

                            if ($typefac == 2) {
                                $Lignefac['factureavoir_id'] = $factureavoir->id;
                                $Lignefac['qte'] = $f['quantite'];
                                $Lignefac['article_id'] = $f['article_id'];
                                $Lignefac['prix'] = $f['prix'];
                                $Lignefac['qtestock'] = $f['qtestock'];
                                $Lignefac['remiseclient'] = $f['remiseclient'];
                                $Lignefac['remise'] = $f['remisearticle'];
                                $Lignefac['tva'] = $f['tva'];
                                $Lignefac['fodec'] = $f['fodec'];
                            }


                            if (isset($f['id']) && (!empty($f['id']))) {
                                $lignefactureavoirs = $this->fetchTable('Lignefactureavoirs')->get($f['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $lignefactureavoirs = $this->fetchTable('Lignefactureavoirs')->newEmptyEntity();
                            }

                            $lignefactureavoirs = $this->fetchTable('Lignefactureavoirs')->patchEntity($lignefactureavoirs, $Lignefac);

                            if ($this->fetchTable('Lignefactureavoirs')->save($lignefactureavoirs)) {
                            } else {
                            }
                            /// debug($lignefactureavoirs);
                        } else {
                            if (!empty($f['id'])) {

                                $lignefactureavoirs = $this->fetchTable('Lignefactureavoirs')->get($f['id']);
                                $this->fetchTable('Lignefactureavoirs')->delete($lignefactureavoirs);
                            }
                        }
                    }
                }


                return $this->redirect(['action' => 'index/' . $factureavoir['typef']]);
            }
        }

        $art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles = $this->Articles->find('all');
        $commercials = $this->Commercials->find('all');


        $clients = $this->Factureavoirs->Clients->find('all');
        $typefactures = $this->Factureavoirs->Typefactures->find('list', ['limit' => 200]);
        $depots = $this->Factureavoirs->Depots->find('all');

        $tvas = $this->Tvas->find('all');
        $fodecs = $this->Fodecs->find('all');

        $tv = $this->Tvas->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $fod = $this->Fodecs->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);




        $this->set(compact('factureavoir', 'clients', 'typefactures', 'lignefactureavoirs', 'art', 'depots', 'type', 'tvas', 'fodecs', 'tv', 'fod', 'typefac', 'articles', 'commercials', 'commercial'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Factureavoir id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $factureavoir = $this->Factureavoirs->get($id);


        $typefac = $factureavoir->typef;

        if ($typefac == 2) {

            $bonreception = $this->fetchTable('Bonreceptionstocks')->find('all', [])
                ->where(['Bonreceptionstocks.factureavoir_id   = (' . $id . ')   ']);

            if ($bonreception) {
                foreach ($bonreception as $b) {

                    $b = $this->fetchTable('Bonreceptionstocks')->get($b['id']);
                    $b->factureavoir_id = 0;
                    $this->fetchTable('Bonreceptionstocks')->save($b);
                }
            }
        }


        $lignefactures = $this->Factureavoirs->Lignefactureavoirs->find('all', [])
            ->where(['factureavoir_id' => $id]);
        foreach ($lignefactures as $c) {
            $this->Factureavoirs->Lignefactureavoirs->delete($c);
        }
        if ($this->Factureavoirs->delete($factureavoir)) {
        } else {
        }

        return $this->redirect(['action' => 'index/' . $factureavoir['typef']]);
    }
}
