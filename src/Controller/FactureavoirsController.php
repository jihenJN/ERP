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

        $facture = $this->fetchTable('Factureclients')->get($id, [
            'contain' => [
                'Clients',
                'Depots'
            ]
        ]);

        $lignes = $this->fetchTable('Lignebonreceptionstocks')->find('all', ['contain' => ['Articles'],])
            ->where(['Lignebonreceptionstocks.bonreceptionstock_id=' . $id]);
        $bonreception = $this->fetchTable('Bonreceptionstocks')->get($id, [
            'contain' => [
                'Depots',
                'Clients'
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

        $val =   $this->getmax();

        $in = $val + 1;

        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        ///   debug($mm);



        $depots = $this->Factureavoirs->Depots->find('all');
        $clients = $this->Factureavoirs->Clients->find('all');
        $commercials = $this->Factureavoirs->Commercials->find('all');
        $art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles = $this->Articles->find('all');
        $tvas = $this->fetchTable('Tvas')->find('all', ['keyfield' => 'id', 'valueField' => 'valeur']);


        $data = $this->Factureavoirs->newEmptyEntity();

        if ($this->request->is(['post'])) {

            $val =   $this->getmax();

            $in = $val + 1;

            $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);


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
                            $tab['qterlx'] = $l['qterlx'];

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
    public function imprimeview($id = null)
    {
        $facture = $this->Factureavoirs->get($id, [
            'contain' => ['Clients']
        ]);
        $clients = $this->Factureavoirs->Clients->find('list', ['limit' => 200]);
        $this->loadModel('Lignefactureavoirs');
        $lignefactures = $this->Lignefactureavoirs->find('all')->contain(['Articles'])->where(["Lignefactureavoirs.factureavoir_id=" . $id . " "]);
        $this->loadModel('Articles');
        $this->loadModel('Charges');
        $charges = $this->Charges->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'designiation']);
        $factures = $this->Factureavoirs->find('all')->contain(['Fournisseurs']);
        // $timbre = $this->fetchTable('Timbres')->find('all')->first();
        ///debug($timbre->timbre);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->set(compact('charges', 'lignefactures', 'timbre', 'articles', 'facture', 'clients'));
    }
    public function addfacavoir($id = null)
    {

        $factureavoir = $this->Factureavoirs->newEmptyEntity();

        $facture = $this->fetchTable('Factureclients')->get($id, [
            'contain' => [
                'Clients',
                'Depots',
                'Timbres'
            ]
        ]);
        if ($this->request->is(['post'])) {

            $num = $this->Factureavoirs->find()->select(["num" =>
            'MAX(Factureavoirs.numero)'])->first();
            // debug($num);
            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $numspecial = str_pad("$in", 6, "0", STR_PAD_LEFT);
            $data = $this->Factureavoirs->patchEntity($factureavoir, $this->request->getdata());
            //  debug($factureavoir);

            $data['factureclient_id'] = $facture->id;

            $data['numero'] = $numspecial;;
            $data['client_id'] = $this->request->getdata('client_id');
            $depot = $data['depot_id'] = $this->request->getdata('depot_id');
            $data['totalremise'] = $this->request->getdata('remise');
            $data['remise'] = $this->request->getdata('remisee');

            $data['depot_id'] = $this->request->getdata('depot_id');
            $data['fodec1'] = $this->request->getdata('fodec');
            $data['tva1'] = $this->request->getdata('tva');
            $data['totalttc1'] = $this->request->getdata('totalttc');
            $data['totalht1'] = $this->request->getdata('totalht');
            $data['totalputtc'] = $this->request->getData('totalputtc');
            $data['timbre_id'] = $this->request->getData('timbre_id');
            $data['nomprenom'] = $this->request->getData('nomprenom');
            $data['numeroidentite'] = $this->request->getData('numeroidentite');
            $data['adressediv'] = $this->request->getData('adressediv');
            //  $data['factureclient_id'] = $facture->id;
            if ($this->Factureavoirs->save($data)) {
                $facture->typefac = 1;
                $this->fetchTable('Factureclients')->save($facture);
                // debug($facture);die;

                $fac_id = $factureavoir->id;









                if (isset($this->request->getData('data')['Lignefacture']) && (!empty($this->request->getData('data')['Lignefacture']))) {
                    foreach ($this->request->getData('data')['Lignefacture'] as $i => $f) {
                        if (!empty($f['article_id']) && !empty($f['quantite'])) {
                            //debug($f);
                            if ($f['quantite'] != 0 && $f['sup'] != 1) {
                                $lignef = $this->fetchTable('Lignefactureavoirs')->newEmptyEntity();

                                $Lignefac['factureavoir_id'] = $fac_id;
                                $Lignefac['article_id'] = $f['article_id'];
                                $Lignefac['lignefactureclient_id'] = $f['id'];

                                $Lignefac['quantite'] = $f['quantite'];
                                $Lignefac['ml'] = $f['ml'];
                                $Lignefac['qte'] = $f['qte'];
                                $Lignefac['depot_id'] = $depot;
                                $Lignefac['remise'] = $f['remise'];
                                $Lignefac['tva_id'] = $f['tva_id'];
                                $Lignefac['prix'] = $f['prix'];
                                $Lignefac['fodec'] = $f['fodec'];
                                $Lignefac['totalht'] = $f['totalht'];
                                $Lignefac['totalttc'] = $f['ttc'];
                                $Lignefac['puttc'] = $f['puttc'];
                                $Lignefac['puttcapr'] = $f['puttcapr'];
                                $Lignefac['ttchidden'] = $f['ttchidden'];
                                $lignef = $this->fetchTable('Lignefactureavoirs')->patchEntity($lignef, $Lignefac);
                                $this->fetchTable('Lignefactureavoirs')->save($lignef);

                                // debug($lignef);
                            }
                        }
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
        $lignefactures = $this->fetchTable('Lignefactureclients')->find('all', ['Articles'])->where(['Lignefactureclients.factureclient_id=' . $id]);
        //  debug($lignefactures->toarray());
        $num = $this->Factureavoirs->find()->select(["num" =>
        'MAX(Factureavoirs.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $numspecial = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $depots = $this->Factureavoirs->Depots->find('all');
        // $art = $this->fetchTable('Articles')->find('all');
        $art = $this->fetchTable('Articles')->find('all');
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



        // $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        // 'MAX(Timbres.timbre)'])->first();
        // $timbre = $tim->timbre;
        $tim =[];
        if ($facture->timbre_id!=null){
        $tim = $this->fetchTable('Timbres')->find('list', ['keyfield' => 'id', 'valueField' => 'timbre'])

            ->where(['Timbres.id' => $facture->timbre_id])
            ->toArray();
        }
        /***************************bloc info client******************************************* */

        $clientid = $facture->client_id;
        $lignebloc = $this->fetchTable('Clients')->get($clientid, [
            'contain' => ['Types'],
        ]);
        $typeclients = $this->fetchTable('Clients')->get($clientid, [
            'contain' => ['Typeclients', 'Gouvernorats', 'Types']
        ]);

        $typeclientid = $typeclients->type->id;
        if ($typeclientid  == null) {
            $typeclientid = ' ';
        }

        $typeclientname = $typeclients->type->name;
        $adresses = $this->fetchTable('Adresselivraisonclients')->find('all', [
            'contain' => ['Clients']
        ])
            ->where(["Adresselivraisonclients.client_id = " . $facture->client_id . ""])->first();
        $adresse = $adresses->adresse;
        /********************************************************************** */
        $this->set(compact('factureclient', 'adresse', 'typeclientname', 'typeclientid', 'lignebloc', 'tim', 'lignefactures', 'art', 'depots', 'numspecial', 'factureavoir', 'clients', 'rz', 'es', 'remcli', 'remes', 'clientc', 'not', 'gs', 'BL', 'cl'));
    }
    public function addfacavoirdd($id = null)
    {

        $factureavoir = $this->Factureavoirs->newEmptyEntity();
        $facture = $this->fetchTable('Factureclients')->get($id, [
            'contain' => [
                'Clients',
                'Depots',
                'Timbres'
            ]
        ]);
        if ($this->request->is(['post'])) {
            // debug($this->request->getdata());die;
            $num = $this->Factureavoirs->find()->select(["num" =>
            'MAX(Factureavoirs.numero)'])->first();
            // debug($num);
            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $numspecial = str_pad("$in", 6, "0", STR_PAD_LEFT);
            //  debug($factureavoir);


            $data['factureclient_id'] = $facture->id;

            $data['numero'] = $numspecial;;
            $data['client_id'] = $this->request->getdata('client_id');
            $depot = $data['depot_id'] = $this->request->getdata('depot_id');
            $data['totalremise'] = $this->request->getdata('remise');
            $data['remise'] = $this->request->getdata('remise');

            $data['depot_id'] = $this->request->getdata('depot_id');
            $data['fodec1'] = $this->request->getdata('fodec');
            $data['tva1'] = $this->request->getdata('tva');
            $data['totalttc1'] = $this->request->getdata('totalttc');
            $data['totalht1'] = $this->request->getdata('totalht');
            $data['totalputtc'] = $this->request->getData('totalputtc');
            $data['timbre_id'] = $this->request->getData('timbre_id');
            // $data = $this->Factureavoirs->patchEntity($factureavoir, $this->request->getdata());

            $factureavoir = $this->Factureavoirs->patchEntity($factureavoir, $data);

            //  $data['factureclient_id'] = $facture->id;
            if ($this->Factureavoirs->save($factureavoir)) {
                $facture->typefac = 1;
                $this->fetchTable('Factureclients')->save($facture);
                // debug($facture);die;

                $fac_id = $factureavoir->id;









                if (isset($this->request->getData('data')['Lignefacture']) && (!empty($this->request->getData('data')['Lignefacture']))) {
                    foreach ($this->request->getData('data')['Lignefacture'] as $i => $f) {
                        if (!empty($f['article_id']) && !empty($f['quantite'])) {
                            //debug($f);
                            if ($f['quantite'] != 0) {
                                $lignef = $this->fetchTable('Lignefactureavoirs')->newEmptyEntity();

                                $Lignefac['factureavoir_id'] = $fac_id;
                                $Lignefac['article_id'] = $f['article_id'];
                                $Lignefac['lignefactureclient_id'] = $f['id'];

                                $Lignefac['quantite'] = $f['quantite'];
                                $Lignefac['ml'] = $f['ml'];
                                $Lignefac['qte'] = $f['qte'];
                                $Lignefac['depot_id'] = $depot;
                                $Lignefac['remise'] = $f['remise'];
                                $Lignefac['tva_id'] = $f['tva_id'];
                                $Lignefac['prix'] = $f['prix'];
                                $Lignefac['fodec'] = $f['fodec'];
                                $Lignefac['totalht'] = $f['totalht'];
                                $Lignefac['totalttc'] = $f['ttc'];
                                $Lignefac['puttc'] = $f['puttc'];
                                $Lignefac['puttcapr'] = $f['puttcapr'];
                                $Lignefac['ttchidden'] = $f['ttchidden'];
                                $lignef = $this->fetchTable('Lignefactureavoirs')->patchEntity($lignef, $Lignefac);
                                $this->fetchTable('Lignefactureavoirs')->save($lignef);

                                // debug($lignef);
                            }
                        }
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
        $lignefactures = $this->fetchTable('Lignefactureclients')->find('all', ['Articles'])->where(['Lignefactureclients.factureclient_id=' . $id]);
        //  debug($lignefactures->toarray());
        $num = $this->Factureavoirs->find()->select(["num" =>
        'MAX(Factureavoirs.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $numspecial = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $depots = $this->Factureavoirs->Depots->find('all');
        // $art = $this->fetchTable('Articles')->find('all');
        $art = $this->fetchTable('Articles')->find('all');
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



        // $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        // 'MAX(Timbres.timbre)'])->first();
        // $timbre = $tim->timbre;
        // $tim = $this->fetchTable('Timbres')->find()
        //     ->select(['id', 'timbre' => 'MAX(Timbres.timbre)'])
        //     ->first();

        // $timbre_max = $tim->timbre;
        // $timbre_id = $tim->id;
        $tim = $this->fetchTable('Timbres')->find('list', ['keyfield' => 'id', 'valueField' => 'timbre'])

            ->where(['Timbres.id' => $facture->timbre_id])
            ->toArray();


        $this->set(compact('factureclient', 'facture', 'tim', 'lignefactures', 'art', 'depots', 'numspecial', 'factureavoir', 'clients', 'rz', 'es', 'remcli', 'remes', 'clientc', 'not', 'gs', 'BL', 'cl'));
    }


    public function index($type = null)
    {

        error_reporting(E_ERROR | E_PARSE);



        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';

        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $client_id = $this->request->getQuery('client_id');
        $num = $this->request->getQuery('numero');


        if ($datedebut) {
            $cond1 = 'Date(Factureavoirs.date) >= ' . "'" . $datedebut . "'";
        }
        if ($datefin) {
            $cond2 = 'Date(Factureavoirs.date) <= ' . "'" . $datefin . "'";
        }
        if ($client_id) {
            $cond3 = "Factureavoirs.client_id  =  '" . $client_id . "' ";
        }

        if ($num) {
            $cond4 = "Factureavoirs.numero like '%" . $num . "%' ";
        }

        $condtyp = "Factureavoirs.typef=" . $type;


        $query = $this->Factureavoirs->find('all', [
            'contain' => ['Clients', 'Typefactures', 'Factureclients'],
        ])->where([$cond1, $cond2, $cond3, $cond4])->order(['Factureavoirs.id' => 'DESC']);

        //debug($query);

        $factureavoirs = $this->paginate($query);


        ////   debug($factureavoirs);


        $clients = $this->fetchTable('Clients')->find('all');

        $this->set(compact('factureavoirs', 'clients', 'type', 'client_id'));
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
        // debug($factureavoir);
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
        $lignefactureavoirs = $this->Lignefactureavoirs->find('all', ['Articles'])->where(['Lignefactureavoirs.factureavoir_id=' . $id]);


        $art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles = $this->fetchTable('Articles')->find('all');
        $commercials = $this->Commercials->find('all');


        $clients = $this->Factureavoirs->Clients->find('all');
        $typefactures = $this->Factureavoirs->Typefactures->find('list', ['limit' => 200]);
        $depots = $this->Factureavoirs->Depots->find('all');

        $tvas = $this->Tvas->find('all');
        $fodecs = $this->Fodecs->find('all');

        $tv = $this->Tvas->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $fod = $this->Fodecs->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);



        // $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        // 'MAX(Timbres.timbre)'])->first();
        // $timbre = $tim->timbre;
        $tim = $this->fetchTable('Timbres')->find('list', ['keyfield' => 'id', 'valueField' => 'timbre'])

            ->where(['Timbres.id' => $factureavoir->timbre_id])
            ->toArray();
        /***************************bloc info client******************************************* */

        $clientid = $factureavoir->client_id;
        $lignebloc = $this->fetchTable('Clients')->get($clientid, [
            'contain' => ['Types'],
        ]);
        $typeclients = $this->fetchTable('Clients')->get($clientid, [
            'contain' => ['Typeclients', 'Gouvernorats', 'Types']
        ]);

        $typeclientid = $typeclients->type->id;
        if ($typeclientid  == null) {
            $typeclientid = ' ';
        }

        $typeclientname = $typeclients->type->name;
        $adresses = $this->fetchTable('Adresselivraisonclients')->find('all', [
            'contain' => ['Clients']
        ])
            ->where(["Adresselivraisonclients.client_id = " . $factureavoir->client_id . ""])->first();
        $adresse = $adresses->adresse;
        /********************************************************************** */
        $this->set(compact('factureavoir', 'tim', 'adresse', 'typeclientname', 'lignebloc', 'typeclientid', 'clients', 'typefactures', 'lignefactureavoirs', 'art', 'depots', 'type', 'tvas', 'fodecs', 'tv', 'fod', 'typefac', 'articles', 'commercials', 'commercial'));
    }


    /**
     *  method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    public function add()
    {

        $factureavoir = $this->Factureavoirs->newEmptyEntity();
        if ($this->request->is(['post'])) {

            $num = $this->Factureavoirs->find()->select(["num" =>
            'MAX(Factureavoirs.numero)'])->first();
            // debug($num);
            if (!empty($num)) {
                $n = $num->num;
                // $int=intval($n);
                $in = intval($n) + 1;
                //debug($in);
                $numspecial = str_pad("$in", 6, "0", STR_PAD_LEFT);
            } else {
                $numspecial = "00001";
            }


            $data = $this->Factureavoirs->patchEntity($factureavoir, $this->request->getdata());
            //  debug($factureavoir);


            //   $data['factureclient_id'] = $facture->id;

            $data['numero'] = $numspecial;;
            $data['client_id'] = $this->request->getdata('client_id');
            $depot = $data['depot_id'] = $this->request->getdata('depot_id');
            $data['totalremise'] = $this->request->getdata('remise');
            $data['remise'] = $this->request->getdata('remise');

            $data['depot_id'] = $this->request->getdata('depot_id');
            $data['fodec1'] = $this->request->getdata('fodec');
            $data['tva1'] = $this->request->getdata('tva');
            $data['totalttc1'] = $this->request->getdata('totalttc');
            $data['totalht1'] = $this->request->getdata('totalht');
            //  $data['factureclient_id'] = $facture->id;
            if ($this->Factureavoirs->save($data)) {


                $fac_id = $factureavoir->id;







                if (isset($this->request->getData('data')['Lignefacture']) && (!empty($this->request->getData('data')['Lignefacture']))) {
                    foreach ($this->request->getData('data')['Lignefacture'] as $i => $f) {

                        $lignef = $this->fetchTable('Lignefactureavoirs')->newEmptyEntity();

                        $Lignefac['factureavoir_id'] = $fac_id;
                        $Lignefac['article_id'] = $f['article_id'];
                        $Lignefac['lignefactureclient_id'] = $f['id'];

                        $Lignefac['quantite'] = $f['qte'];
                        // $Lignefac['qtekg'] = $f['qtekg'];
                        $Lignefac['qte'] = $f['qte'];
                        // $Lignefac['qterlx'] = $f['qterlx'];
                        $Lignefac['remise'] = $f['remise'];
                        $Lignefac['tva_id'] = $f['tva'];
                        $Lignefac['prix'] = $f['prix'];
                        $Lignefac['fodec'] = $f['fodec'];
                        $Lignefac['totalht'] = $f['ht'];
                        $Lignefac['totalttc'] = $f['ttc'];

                        $lignef = $this->fetchTable('Lignefactureavoirs')->patchEntity($lignef, $Lignefac);
                        $this->fetchTable('Lignefactureavoirs')->save($lignef);

                        // debug($lignef);


                    }
                }
                return $this->redirect(['action' => 'index']);
            }
        }

        $this->loadModel('Lignefactureclients');
        $this->loadModel('Commercials');
        $this->loadModel('Depots');
        $this->loadModel('Articles');
        $this->loadModel('Tvas');
        $this->loadModel('Fodecs');

        ///debug($factureclient)  ;
        //$lignefactures = $this->fetchTable('Lignefactureclients')->find('all', [])->where(['Lignefactureclients.factureclient_id=' . $id]);
        //  debug($lignefactures->toarray());
        $num = $this->Factureavoirs->find()->select(["num" =>
        'MAX(Factureavoirs.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $numspecial = str_pad("$in", 6, "0", STR_PAD_LEFT);

        $art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles = $this->fetchTable('Articles')->find('all')
            ->where(['Articles.typearticle_id =' => 3]);
        $commercials = $this->Commercials->find('all');


        $clients = $this->Factureavoirs->Clients->find('all');
        $typefactures = $this->Factureavoirs->Typefactures->find('list', ['limit' => 200]);
        $depots = $this->Factureavoirs->Depots->find('all');

        $tvas = $this->Tvas->find('all');
        $fodecs = $this->Fodecs->find('all');

        $tv = $this->Tvas->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);
        $fod = $this->Fodecs->find('list', ['keyfield' => 'id', 'valueField' => 'valeur']);







        $this->set(compact('factureclient', 'lignefactures', 'art', 'depots', 'numspecial', 'factureavoir', 'clients', 'articles', 'es', 'remcli', 'remes', 'clientc', 'fod', 'gs', 'commercials', 'cl'));
    }


    public function add2()
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


        //  $factureavoir = $this->Factureavoirs->get($id, [
        //      'contain' => []
        //  ]);

        //  //debug($factureavoir) ;


        //  $client = $this->Clients->get($factureavoir->client_id, [
        //      'contain' => [],
        //  ]);
        //  ///debug($client);
        //  $idd = $client->commercial_id;
        //  ///debug($idd);
        //  $this->loadModel('Commercials');
        //  if ($client->commercial_id) {
        //      $commercial = $this->Commercials->get($client->commercial_id, [
        //          'contain' => [],
        //      ]);
        //  }

        ///debug($commercial);


        ///debug($factureavoir);

        //  $type = $factureavoir->factureclient_id;

        //  $typefac = $factureavoir->typef;

        ///debug($typefac);


        // debug($type) ;
        //$lignefactureavoirs = $this->Lignefactureavoirs->find('all', [])->where(['Lignefactureavoirs.factureavoir_id=' . $id]);

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
    public function delete11112024($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $factureavoir = $this->Factureavoirs->get($id);
        // debug($factureavoir);die;

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
            if ($factureavoir->factureclient_id) {
                $ligneupdate = $this->fetchTable('Factureclients')->get($factureavoir['factureclient_id']);

                $ligneupdate->typefac = '0';
                $this->fetchTable('Factureclients')->save($ligneupdate);
                /// debug($cmde);
            }
        } else {
        }

        return $this->redirect(['action' => 'index']); //. $factureavoir['typef']]);
    }

    public function delete($id = null)
    {
        $this->loadModel('Lignefactureavoirs');



        $factureavoir = $this->Factureavoirs->get($id);
        //debug($factureavoirfr);die;

        if ($this->Factureavoirs->delete($factureavoir)) {
            // debug($factureavoirfr);die;
            $lignefactureavoir = $this->Lignefactureavoirs->find('all', [])->where(['Lignefactureavoirs.factureavoir_id =' . $id]);
            //debug($lignefactureavoirfr);die;
            foreach ($lignefactureavoir as $c) {

                $this->Lignefactureavoirs->delete($c);
            }
            // if ($type == 1) {
            // 	$this->redirect(array('action' => 'index/1'));
            // } else if ($type == 2) {
            $this->redirect(array('action' => 'index'));
            //}
        }
    }
}
