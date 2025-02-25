<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

/**
 * Factureclients Controller
 *
 * @property \App\Model\Table\FactureclientsTable $Factureclients
 * @method \App\Model\Entity\Factureclient[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FactureclientsController extends AppController
{


    public function addf($type = null)
    {



        error_reporting(E_ERROR | E_PARSE);
        // $yearf = date('Y');
        // $currentYear = date('y');
        // $num = $this->Bonlivraisons->find()->select(["num" => 'MAX(Bonlivraisons.numero)'])->where('Bonlivraisons.typebl=2')
        //     ->where('YEAR(Bonlivraisons.date)=' . $yearf)->first();
        // $n = $num->num;
        // if ($n) {
        //     $lastFourDigits = substr($n, -4);
        //     $in = intval($lastFourDigits) + 1;
        // } else {
        //     $in = '0001';
        // }
        // $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        // $mm = "DE{$currentYear}00{$mm}";

        $num = $this->Factureclients->find()
            ->select(["num" => 'MAX(Factureclients.numero)'])
            //// ->where(['Factureclients.type=' . $type])

            //->where(['Bonlivraisons.date' => $this->Bonlivraisons->find()->select(['max_date' => 'MAX(Besionachats.date)'])])
            ->first();

        // debug($num);
        $n = $num->num;

        $in = intval($n) + 1;

        $mm = str_pad("$in", 0, "0", STR_PAD_LEFT);
        // debug($mm);

        $dates[0] = "Imperative";
        $dates[1] = "Interval";
        $result = $this->request->getAttribute('authentication')->getIdentity();
        // debug($result);
        // $result = 0;
        $factureclient = $this->Factureclients->newEmptyEntity();
        if ($this->request->is('post')) {
            $num = $this->Factureclients->find()
                ->select(["num" => 'MAX(Factureclients.numero)'])
                ->where(['Factureclients.type=' . $type])
                //->where(['Bonlivraisons.date' => $this->Bonlivraisons->find()->select(['max_date' => 'MAX(Besionachats.date)'])])
                ->first();


            $n = $num->num;

            $in = intval($n) + 1;

            $mm = str_pad("$in", 0, "0", STR_PAD_LEFT);
            //debug(  $mm );
            //  debug($this->request->getData());die;
            $data['user_id'] = $result['id'];
            $data['nomprenom'] = $this->request->getData('nomprenom');
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['dateimp'] = $this->request->getData('dateimp');
            $data['dateintdebut'] = $this->request->getData('dateintdebut');
            $data['dateintfin'] = $this->request->getData('dateintfin');
            $data['observation'] = $this->request->getData('observation');
            $data['client_id'] = $this->request->getData('client_id');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['totalht'] = $this->request->getData('total');
            $data['totaltva'] = $this->request->getData('tva');
            $data['totalfodec'] = $this->request->getData('fodec');
            $data['totalremise'] = $this->request->getData('remisee');
            $data['escompte'] = $this->request->getData('escompte');
            $data['escompte'] = $this->request->getData('escompte');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['bl'] = $this->request->getData('bl');
            $data['type'] = $type;
            $data['tpe'] = 0;
            $data['nouv_client'] = $this->request->getData('nouveau_client');
            $data['Montant_Regler'] = $this->request->getData('Montant_Regler');
            $data['transporteur_id'] = $this->request->getData('transporteur_id');

            $data['chauffeurname'] = $this->request->getData('chauffeurname');
            $data['matricule'] = $this->request->getData('matricule');
            $data['totalputtc'] = $this->request->getData('totalputtc');
            $data['timbre_id'] = $this->request->getData('timbre_id');

            $data['nomprenom'] = $this->request->getData('nomprenom');
            $data['numeroidentite'] = $this->request->getData('numeroidentite');
            $data['adressediv'] = $this->request->getData('adressediv');

            $data['user_id'] = $result['id'];


            $factureclient = $this->Factureclients->patchEntity($factureclient, $data);

            if ($this->Factureclients->save($factureclient)) {
                $this->misejour("Factureclients", "add", $factureclient->id);
                $factureclient_id = $factureclient->id;


                /*******enregistrement lignebonlivraison******************************/
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        /// print_r(value: $l); die;
                        if ($l['sup'] != 1 && (!empty($l['article_idd']))) {
                            $tab['factureclient_id'] = $factureclient_id;
                            $tab['article_id'] = $l['article_idd'];
                            $tab['qte'] = $l['qte'];
                            $tab['ml'] = $l['ml'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['punht'] = $l['prix'];
                            $tab['remise'] = $l['remise'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['tva'] = $l['tva'];
                            $tab['prixht'] = $l['ht'];
                            $tab['ttc'] = $l['ttc'];

                            $tab['puttc'] = $l['puttc'];
                            $tab['puttcapr'] = $l['puttcapr'];
                            $tab['ttchidden'] = $l['ttchidden'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        }
                    }
                }
                if ($this->request->getData('Montant_Regler') != '0' || $this->request->getData('Montant_Regler') != 0) {
                    /*******enregistrement reglement******************************/
                    $numeroobj = $this->fetchTable('Reglementclients')->find()->select([
                        "numero" =>
                        'MAX(Reglementclients.numeroconca)'
                    ])->first();
                    $numero = $numeroobj->numero;
                    if ($numero != null) {
                        $n = $numero;
                        $lastnum = $n;
                        $nume = intval($lastnum) + 1;
                        $nn = (string) $nume;
                        $code = str_pad($nn, 5, "0", STR_PAD_LEFT);
                    } else {
                        $code = "00001";
                    }
                    $ligne = $this->fetchTable('Reglementclients')->newEmptyEntity();
                    $tab2['client_id'] = $factureclient->client_id;
                    $tab2['numero'] = $factureclient->numero;
                    $tab2['numeroconca'] = $code;
                    $frozenTime = FrozenTime::now();
                    $tab2['date'] = $frozenTime;
                    $tab2['Montant'] = $this->request->getData('Montant_Regler');
                    $tab2['type'] = 2;
                    $tab2['user_id'] = $result['id'];

                    $ligne = $this->fetchTable('Reglementclients')->patchEntity($ligne, $tab2);
                    $this->fetchTable('Reglementclients')->save($ligne);
                    /*******enregistrement lignereglement******************************/
                    $reglement_id = $ligne->id;
                    $ligner = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                    $t['reglementclient_id'] = $reglement_id;
                    $t['factureclient_id'] = $factureclient_id;
                    $t['Montant'] = $this->request->getData('Montant_Regler');
                    $ligner = $this->fetchTable('Lignereglementclients')->patchEntity($ligner, $t);
                    $this->fetchTable('Lignereglementclients')->save($ligner);
                    /******************************piece reglement*****************************************/
                    if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
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
                                        $table['montant'] = str_replace(',', '.', $p['montant']);
                                    } else {
                                        $table['montant'] = $p['montant'];
                                    }
                                }
                                $table['montant_brut'] = $p['montantbrut'];
                                $table['to_id'] = $p['taux'];
                                $table['montant_net'] = $p['montantnet'];
                                $table['num'] = $p['num_piece'];
                                if ($p['paiement_id'] != 1) {
                                    $table['echance'] = $p['echance'];
                                }
                                $table['banque_id'] = $p['banque'];
                                $table['acomptetype'] = 1;
                                $table['proprietaire'] = $p['taux'];
                                $this->fetchTable('Piecereglementclients')->save($table);
                            }
                        }
                    }
                }

                if ($this->request->getData('action') === 'saveAndImprime') {
                    return $this->redirect(['controller' => 'Factureclients', 'action' => 'imprimeviewsmbm/' . $factureclient->id]);
                } else if ($this->request->getData('action') === 'saveAndImprimepdf') {
                    return $this->redirect(['controller' => 'Factureclients', 'action' => 'imprimeviewf/' . $factureclient->id]);
                } else {
                    return $this->redirect(['action' => 'indexf/2']);
                }
                //return $this->redirect(['action' => 'index/' . $type]);
            }
        }
        $this->loadModel('Personnels');
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clientss = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($art) {
                if ($art->Tel != null) {
                    return $art->Tel . ' -- ' . $art->Raison_Sociale;
                } else {
                    return $art->Raison_Sociale;
                }
            }
        ]);
        $paiements = $this->fetchTable('Paiements')->find('list')->where(['id NOT IN' => [6, 7, 8, 9]]);

        // $paiements = $this->fetchTable('Paiements')->find('list'); //->where('type=0');
        $valeurs = $this->fetchTable('Tos')->find('list');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list');
        $depots = $this->Factureclients->Depots->find('list');
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list');
        // $commercials = $this->Factureclients->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $factureclients = $this->fetchTable('Factureclients')->find('list');
        // $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list');
        $articles = $this->fetchTable('Articles')->find('all', [
            'contain' => [],
        ]);
        $esCompte = $this->fetchTable('Societes')->find()->select([
            "escompte" =>
            'MAX(Societes.escompte)'
        ])->first();
        $escompte = $esCompte->escompte;
        // $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
        //     'contain' => ['Articles']
        // ])
        //     ->where(['bonlivraison_id =' . $id]);
        $clients = $this->Factureclients->Clients->find('all', [
            'contain' => [],
        ]); //->where(["Clients.etat " => 'TRUE']);
        //print_r($clients);die;
        $transporteurs = $this->fetchTable('Transporteurs')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['matricule'] . ' ' . $row['name'];
            }
        ]);
        // $tim = $this->fetchTable('Timbres')->find()->select(["id" => "Timbres.id", "timbre" => 'MAX(Timbres.timbre)'])->first();
        $tim = $this->fetchTable('Timbres')->find()
            ->select(['id', 'timbre' => 'MAX(Timbres.timbre)'])
            ->first();

        // Récupérer l'ID et la valeur maximale du timbre
        $timbre_max = $tim->timbre;
        $timbre_id = $tim->id;

        //    debug($tim);
        // $timbre = $tim->id;
        // var_dump($timbre);
        $this->set(compact('escompte', 'timbre_max', 'timbre_id', 'paiements', 'mm', 'transporteurs', 'type', 'valeurs', 'caisses', 'banques', 'type', 'dates', 'mm', 'articles', 'factureclient', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'factureclients', 'adresselivraisonclients'));
    }

    public function etatcomptant20082024()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Transferecaisses');

        // Retrieve query parameters
        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');

        // Initialize variables
        $clientData = [];
        $conditionsBonlivraison = [];
        $conditionsFactureclient = [];

        // Build conditions for Bonlivraisons
        if ($client_id) {
            $conditionsBonlivraison['Bonlivraisons.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) <= '" . $au . "'"];
        }
        $conditionsBonlivraison['Bonlivraisons.typebl'] = 1; // Assuming 'typebl = 1' is fixed

        // Build conditions for Factureclients
        if ($client_id) {
            $conditionsFactureclient['Factureclients.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsFactureclient[] = ["date(Factureclients.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsFactureclient[] = ["date(Factureclients.date) <= '" . $au . "'"];
        }
        $conditionsFactureclient['Factureclients.type'] = 2; // Assuming 'type = 2' is fixed

        // Fetch Factureclients data
        $factures = $this->Factureclients->find('all')
            ->where($conditionsFactureclient)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Factureclient
        foreach ($factures as $facture) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $facture->client_id])
                ->first();

            if ($client && $facture->date) {
                $connection = ConnectionManager::get('default');

                if ($facture->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $facture->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $clientData[] = [
                    'id' => $facture->id,

                    'fac' => 'FAC : ' . $facture->numero,
                    'code' => $facture->client->Code,
                    'name' => $client->Raison_Sociale,
                    'date' => $facture->date->format('Y-m-d'),
                    'debit' => $facture->totalttc,
                    'credit' => '',

                    'personnel' => $mm,
                    'num' => $facture->numero,
                    'type' => 'Facture Comptant',
                    'index' => '2',
                    'observation' => $facture->observation,

                ];
            }
        }

        // Fetch Bonlivraisons data
        $bonlivraisons = $this->Bonlivraisons->find('all')
            ->where($conditionsBonlivraison)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Bonlivraison
        foreach ($bonlivraisons as $bonlivraison) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $bonlivraison->client_id])
                ->first();

            if ($client && $bonlivraison->date) {
                $connection = ConnectionManager::get('default');

                if ($bonlivraison->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $nameee = $client->id != 12 ? $client->Raison_Sociale : $bonlivraison->nomprenom;

                $clientData[] = [
                    'id' => $bonlivraison->id,

                    'bl' => 'BL : ' . $bonlivraison->numero,
                    'code' => $bonlivraison->client->Code,
                    'name' => $nameee,
                    'date' => $bonlivraison->date->format('Y-m-d'),
                    'credit' => $bonlivraison->totalttc,
                    'debit' => '',
                    'personnel' => $mm,
                    'num' => $bonlivraison->numero,
                    'type' => 'Bon de Livraison',
                    'index' => '1',
                    'observation' => $bonlivraison->observation,

                ];
                // debug($clientData);
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);

        // Set data for view
        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }
    public function etatcomptantd()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Transferecaisses');

        // Retrieve query parameters
        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');

        // Initialize variables
        $clientData = [];
        $conditionsBonlivraison = [];
        $conditionsFactureclient = [];

        // Build conditions for Bonlivraisons
        if ($client_id) {
            $conditionsBonlivraison['Bonlivraisons.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) <= '" . $au . "'"];
        }
        $conditionsBonlivraison['Bonlivraisons.typebl'] = 1; // Assuming 'typebl = 1' is fixed

        // Build conditions for Factureclients
        if ($client_id) {
            $conditionsFactureclient['Factureclients.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsFactureclient[] = ["date(Factureclients.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsFactureclient[] = ["date(Factureclients.date) <= '" . $au . "'"];
        }
        $conditionsFactureclient['Factureclients.type'] = 2; // Assuming 'type = 2' is fixed

        // Fetch Factureclients data
        $factures = $this->Factureclients->find('all')
            ->where($conditionsFactureclient)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Factureclient
        foreach ($factures as $facture) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $facture->client_id])
                ->first();

            if ($client && $facture->date) {
                $connection = ConnectionManager::get('default');

                if ($facture->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $facture->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }


                if ($facture->totalttc ==  $facture->Montant_Regler) {
                    $payerr = 'Oui';
                } else if ($facture->totalttc >  $facture->Montant_Regler) {
                    $payerr = 'NON';
                }
                $clientData[] = [
                    'idfac' => $facture->id,

                    'fac' => 'FAC : ' . $facture->numero,
                    'code' => $facture->client->Code,
                    'name' => $client->Raison_Sociale,

                    'date' => $facture->date->format('Y-m-d'),
                    'debit' => $facture->totalttc,
                    'credit' => '',

                    'personnel' => $mm,
                    'num' => $facture->numero,
                    'type' => 'Facture Comptant',
                    'index' => '2',
                    'observation' => $facture->observation,
                    'payerfac' => 'RF : ' . $payerr,
                ];
            }
        }

        // Fetch Bonlivraisons data
        $bonlivraisons = $this->Bonlivraisons->find('all')
            ->where($conditionsBonlivraison)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Bonlivraison
        foreach ($bonlivraisons as $bonlivraison) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $bonlivraison->client_id])
                ->first();

            if ($client && $bonlivraison->date) {
                $connection = ConnectionManager::get('default');

                if ($bonlivraison->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $nameee = $client->id != 12 ? $client->Raison_Sociale : $bonlivraison->nomprenom;

                if ($bonlivraison->totalttc ==  $bonlivraison->Montant_Regler) {
                    $payer = 'Oui';
                } else if ($bonlivraison->totalttc > $bonlivraison->Montant_Regler) {
                    $payer = 'NON';
                }


                $clientData[] = [
                    'idbl' => $bonlivraison->id,

                    'bl' => 'BL : ' . $bonlivraison->numero,
                    'code' => $bonlivraison->client->Code,
                    'name' => $nameee,
                    'date' => $bonlivraison->date->format('Y-m-d'),
                    'credit' => $bonlivraison->totalttc,
                    'debit' => '',
                    'personnel' => $mm,
                    'num' => $bonlivraison->numero,
                    'type' => 'Bon de Livraison',
                    'index' => '1',
                    'observation' => $bonlivraison->observation,
                    'payerbl' => 'Rl : ' . $payer,

                ];
                // debug($clientData);
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->fetchTable('Clients')->find('all');

        // Set data for view
        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }
    public function etatcomptant()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Transferecaisses');

        // Retrieve query parameters
        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');

        // Initialize variables
        $clientData = [];
        $conditionsBonlivraison = [];
        $conditionsFactureclient = [];

        // Build conditions for Bonlivraisons
        if ($client_id) {
            $conditionsBonlivraison['Bonlivraisons.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) <= '" . $au . "'"];
        }
        $conditionsBonlivraison['Bonlivraisons.typebl'] = 1; // Assuming 'typebl = 1' is fixed

        // Build conditions for Factureclients
        if ($client_id) {
            $conditionsFactureclient['Factureclients.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsFactureclient[] = ["date(Factureclients.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsFactureclient[] = ["date(Factureclients.date) <= '" . $au . "'"];
        }
        $conditionsFactureclient['Factureclients.type'] = 2; // Assuming 'type = 2' is fixed

        // Fetch Factureclients data
        $factures = $this->Factureclients->find('all')
            ->where($conditionsFactureclient)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Factureclient
        foreach ($factures as $facture) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $facture->client_id])
                ->first();

            if ($client && $facture->date) {
                $connection = ConnectionManager::get('default');

                if ($facture->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $facture->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }


                if ($facture->totalttc ==  $facture->Montant_Regler) {
                    $payerr = 'Oui';
                } else if ($facture->totalttc >  $facture->Montant_Regler) {
                    $payerr = 'NON';
                }
                $clientData[] = [
                    'idfac' => $facture->id,

                    'fac' => 'FAC : ' . $facture->numero,
                    'code' => $facture->client->Code,
                    'name' => $client->Raison_Sociale,

                    'date' => $facture->date->format('Y-m-d'),
                    'debit' => $facture->totalttc,
                    'credit' => '',

                    'personnel' => $mm,
                    'num' => $facture->numero,
                    'type' => 'Facture Comptant',
                    'index' => '2',
                    'observation' => $facture->observation,
                    'payerfac' => 'RF : ' . $payerr,
                ];
            }
        }

        // Fetch Bonlivraisons data
        $bonlivraisons = $this->Bonlivraisons->find('all')
            ->where($conditionsBonlivraison)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Bonlivraison
        foreach ($bonlivraisons as $bonlivraison) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $bonlivraison->client_id])
                ->first();

            if ($client && $bonlivraison->date) {
                $connection = ConnectionManager::get('default');

                if ($bonlivraison->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $nameee = $client->id != 12 ? $client->Raison_Sociale : $bonlivraison->nomprenom;

                if ($bonlivraison->totalttc ==  $bonlivraison->Montant_Regler) {
                    $payer = 'Oui';
                } else if ($bonlivraison->totalttc > $bonlivraison->Montant_Regler) {
                    $payer = 'NON';
                }


                $clientData[] = [
                    'idbl' => $bonlivraison->id,

                    'bl' => 'BL : ' . $bonlivraison->numero,
                    'code' => $bonlivraison->client->Code,
                    'name' => $nameee,
                    'date' => $bonlivraison->date->format('Y-m-d'),
                    'credit' => $bonlivraison->totalttc,
                    'debit' => '',
                    'personnel' => $mm,
                    'num' => $bonlivraison->numero,
                    'type' => 'Bon de Livraison',
                    'index' => '1',
                    'observation' => $bonlivraison->observation,
                    'payerbl' => 'Rl : ' . $payer,

                ];
                // debug($clientData);
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);

        // Set data for view
        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }
    public function etatcomptant03102024()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Transferecaisses');

        // Retrieve query parameters
        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');

        // Initialize variables
        $clientData = [];
        $conditionsBonlivraison = [];
        $conditionsFactureclient = [];

        // Build conditions for Bonlivraisons
        if ($client_id) {
            $conditionsBonlivraison['Bonlivraisons.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) <= '" . $au . "'"];
        }
        $conditionsBonlivraison['Bonlivraisons.typebl'] = 1; // Assuming 'typebl = 1' is fixed

        // Build conditions for Factureclients
        if ($client_id) {
            $conditionsFactureclient['Factureclients.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsFactureclient[] = ["date(Factureclients.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsFactureclient[] = ["date(Factureclients.date) <= '" . $au . "'"];
        }
        $conditionsFactureclient['Factureclients.type'] = 2; // Assuming 'type = 2' is fixed

        // Fetch Factureclients data
        $factures = $this->Factureclients->find('all')
            ->where($conditionsFactureclient)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Factureclient
        foreach ($factures as $facture) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $facture->client_id])
                ->first();

            if ($client && $facture->date) {
                $connection = ConnectionManager::get('default');

                if ($facture->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $facture->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }


                if ($facture->totalttc ==  $facture->Montant_Regler) {
                    $payerr = 'Oui';
                } else if ($facture->totalttc >  $facture->Montant_Regler) {
                    $payerr = 'NON';
                }
                $clientData[] = [
                    'idfac' => $facture->id,

                    'fac' => 'FAC : ' . $facture->numero,
                    'code' => $facture->client->Code,
                    'name' => $client->Raison_Sociale,
                    'date' => $facture->date->format('Y-m-d'),
                    'debit' => $facture->totalttc,
                    'credit' => '',

                    'personnel' => $mm,
                    'num' => $facture->numero,
                    'type' => 'Facture Comptant',
                    'index' => '2',
                    'observation' => $facture->observation,
                    'payerfac' => 'RF : ' . $payerr,
                ];
            }
        }

        // Fetch Bonlivraisons data
        $bonlivraisons = $this->Bonlivraisons->find('all')
            ->where($conditionsBonlivraison)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Bonlivraison
        foreach ($bonlivraisons as $bonlivraison) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $bonlivraison->client_id])
                ->first();

            if ($client && $bonlivraison->date) {
                $connection = ConnectionManager::get('default');

                if ($bonlivraison->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $nameee = $client->id != 12 ? $client->Raison_Sociale : $bonlivraison->nomprenom;

                if ($bonlivraison->totalttc ==  $bonlivraison->Montant_Regler) {
                    $payer = 'Oui';
                } else if ($bonlivraison->totalttc > $bonlivraison->Montant_Regler) {
                    $payer = 'NON';
                }


                $clientData[] = [
                    'idbl' => $bonlivraison->id,

                    'bl' => 'BL : ' . $bonlivraison->numero,
                    'code' => $bonlivraison->client->Code,
                    'name' => $nameee,
                    'date' => $bonlivraison->date->format('Y-m-d'),
                    'credit' => $bonlivraison->totalttc,
                    'debit' => '',
                    'personnel' => $mm,
                    'num' => $bonlivraison->numero,
                    'type' => 'Bon de Livraison',
                    'index' => '1',
                    'observation' => $bonlivraison->observation,
                    'payerbl' => 'Rl : ' . $payer,

                ];
                // debug($clientData);
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);

        // Set data for view
        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }
    public function etatcomptant02102024()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Transferecaisses');

        // Retrieve query parameters
        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');

        // Initialize variables
        $clientData = [];
        $conditionsBonlivraison = [];
        $conditionsFactureclient = [];

        // Build conditions for Bonlivraisons
        if ($client_id) {
            $conditionsBonlivraison['Bonlivraisons.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) <= '" . $au . "'"];
        }
        $conditionsBonlivraison['Bonlivraisons.typebl'] = 1; // Assuming 'typebl = 1' is fixed

        // Build conditions for Factureclients
        if ($client_id) {
            $conditionsFactureclient['Factureclients.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsFactureclient[] = ["date(Factureclients.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsFactureclient[] = ["date(Factureclients.date) <= '" . $au . "'"];
        }
        $conditionsFactureclient['Factureclients.type'] = 2; // Assuming 'type = 2' is fixed

        // Fetch Factureclients data
        $factures = $this->Factureclients->find('all')
            ->where($conditionsFactureclient)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Factureclient
        foreach ($factures as $facture) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $facture->client_id])
                ->first();

            if ($client && $facture->date) {
                $connection = ConnectionManager::get('default');

                if ($facture->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $facture->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $clientData[] = [
                    'idfac' => $facture->id,

                    'fac' => 'FAC : ' . $facture->numero,
                    'code' => $facture->client->Code,
                    'name' => $client->Raison_Sociale,
                    'date' => $facture->date->format('Y-m-d'),
                    'debit' => $facture->totalttc,
                    'credit' => '',

                    'personnel' => $mm,
                    'num' => $facture->numero,
                    'type' => 'Facture Comptant',
                    'index' => '2',
                    'observation' => $facture->observation,

                ];
            }
        }

        // Fetch Bonlivraisons data
        $bonlivraisons = $this->Bonlivraisons->find('all')
            ->where($conditionsBonlivraison)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Bonlivraison
        foreach ($bonlivraisons as $bonlivraison) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $bonlivraison->client_id])
                ->first();

            if ($client && $bonlivraison->date) {
                $connection = ConnectionManager::get('default');

                if ($bonlivraison->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $nameee = $client->id != 12 ? $client->Raison_Sociale : $bonlivraison->nomprenom;

                $clientData[] = [
                    'idbl' => $bonlivraison->id,

                    'bl' => 'BL : ' . $bonlivraison->numero,
                    'code' => $bonlivraison->client->Code,
                    'name' => $nameee,
                    'date' => $bonlivraison->date->format('Y-m-d'),
                    'credit' => $bonlivraison->totalttc,
                    'debit' => '',
                    'personnel' => $mm,
                    'num' => $bonlivraison->numero,
                    'type' => 'Bon de Livraison',
                    'index' => '1',
                    'observation' => $bonlivraison->observation,

                ];
                // debug($clientData);
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);

        // Set data for view
        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }

    public function impetatcomptant()
    {
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Transferecaisses');

        // Retrieve query parameters
        $client_id = $this->request->getQuery('client_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');

        // Initialize variables
        $clientData = [];
        $conditionsBonlivraison = [];
        $conditionsFactureclient = [];

        // Build conditions for Bonlivraisons
        if ($client_id) {
            $conditionsBonlivraison['Bonlivraisons.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsBonlivraison[] = ["date(Bonlivraisons.date) <= '" . $au . "'"];
        }
        $conditionsBonlivraison['Bonlivraisons.typebl'] = 1; // Assuming 'typebl = 1' is fixed

        // Build conditions for Factureclients
        if ($client_id) {
            $conditionsFactureclient['Factureclients.client_id'] = $client_id;
        }
        if ($historiquede) {
            $conditionsFactureclient[] = ["date(Factureclients.date) >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsFactureclient[] = ["date(Factureclients.date) <= '" . $au . "'"];
        }
        $conditionsFactureclient['Factureclients.type'] = 2; // Assuming 'type = 2' is fixed

        // Fetch Factureclients data
        $factures = $this->Factureclients->find('all')
            ->where($conditionsFactureclient)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Factureclient
        foreach ($factures as $facture) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $facture->client_id])
                ->first();

            if ($client && $facture->date) {
                $connection = ConnectionManager::get('default');

                if ($facture->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $facture->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }
                if ($facture->totalttc ==  $facture->Montant_Regler) {
                    $payerr = 'Oui';
                } else if ($facture->totalttc > $facture->Montant_Regler) {
                    $payerr = 'NON';
                }

                $clientData[] = [
                    'idfac' => $facture->id,

                    'fac' => 'FAC : ' . $facture->numero,
                    'code' => $facture->client->Code,
                    'name' => $client->Raison_Sociale,
                    'date' => $facture->date->format('Y-m-d'),
                    'debit' => $facture->totalttc,
                    'credit' => '',

                    'personnel' => $mm,
                    'num' => $facture->numero,
                    'type' => 'Facture Comptant',
                    'index' => '2',
                    'observation' => $facture->observation,
                    'payerfac' => 'RF : ' . $payerr,

                ];
            }
        }

        // Fetch Bonlivraisons data
        $bonlivraisons = $this->Bonlivraisons->find('all')
            ->where($conditionsBonlivraison)
            ->contain(['Users', 'Clients'])
            ->all();

        // Process each Bonlivraison
        foreach ($bonlivraisons as $bonlivraison) {
            $client = $this->Clients->find()
                ->select(['Raison_Sociale', 'id'])
                ->where(['id' => $bonlivraison->client_id])
                ->first();

            if ($client && $bonlivraison->date) {
                $connection = ConnectionManager::get('default');

                if ($bonlivraison->user_id != null) {
                    $uu = $connection->execute('SELECT * FROM personnels WHERE personnels.id = ' . $bonlivraison->user->personnel_id . ';')->fetchAll('assoc');
                }

                if ($uu) {
                    $mm = $uu[0]['code'] . ' ' . $uu[0]['nom'];
                }

                $nameee = $client->id != 12 ? $client->Raison_Sociale : $bonlivraison->nomprenom;
                if ($bonlivraison->totalttc ==  $bonlivraison->Montant_Regler) {
                    $payer = 'Oui';
                } else if ($bonlivraison->totalttc > $bonlivraison->Montant_Regler) {
                    $payer = 'NON';
                }

                $clientData[] = [
                    'idbl' => $bonlivraison->id,

                    'bl' => 'BL : ' . $bonlivraison->numero,
                    'code' => $bonlivraison->client->Code,
                    'name' => $nameee,
                    'date' => $bonlivraison->date->format('Y-m-d'),
                    'credit' => $bonlivraison->totalttc,
                    'debit' => '',
                    'personnel' => $mm,
                    'num' => $bonlivraison->numero,
                    'type' => 'Bon de Livraison',
                    'index' => '1',
                    'observation' => $bonlivraison->observation,
                    'payerbl' => 'Rl : ' . $payer,
                ];
                // debug($clientData);
            }
        }

        // Fetch Paiements data
        $paiements = $this->Paiements->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);

        // Set data for view
        $this->set(compact('clientData', 'clients', 'historiquede', 'au', 'paiements', 'client_id'));
    }
    public function listefactureclient()
    {

        // $max = $this->getmax();
        // debug($max);

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';

        $cond8 = '';

        $cond9 = '';

        $cond10 = '';
        $condnumdeb = '';
        $condnumfin = '';

        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        // debug($client_id);
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        //  debug($pointdevente_id);
        $chauffeur_id = $this->request->getQuery('chauffeur_id');
        // debug($chauffeur_id);
        // $depot_id = $this->request->getQuery('depot_id');
        //debug($depot_id);
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        //debug($cartecarburant_id);
        $convoyeur_id = $this->request->getQuery('convoyeur_id');

        $materieltransport_id = $this->request->getQuery('materieltransport_id');
        $numdeb = $this->request->getQuery('numdeb');
        $numfin = $this->request->getQuery('numfin');


        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.vente " => 1]);
        $article = $this->request->getQuery('article_id');
        if ($article) {
            $lignefact = $this->fetchTable('Lignefactureclients')->find('all')->where(["Lignefactureclients.article_id=" . $article]);
            $detarticle = '0';
            foreach ($lignefact as $art) {
                //   debug($art);
                $detarticle = $detarticle . ',' . $art->factureclient_id;
            }
            //  debug($lignecommandes);
        }



        if ($datedebut) {
            $cond2 = "date(Factureclients.date)   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "date(Factureclients.date ) <=  '" . $datefin . "' ";
        }
        if ($client_id) {
            $cond4 = "Factureclients.client_id = '" . $client_id . "' ";
        }
        if ($pointdevente_id) {
            $cond5 = "Factureclients.pointdevente_id  =  '" . $pointdevente_id . "' ";
        }


        if ($numdeb) {
            $condnumdeb = "Factureclients.numero   >= '" . $numdeb . "' ";
        }

        if ($numfin) {
            $condnumfin = "Factureclients.numero   <= '" . $numfin . "' ";
        }


        // if ($depot_id) {
        //     $cond7 = "Factureclients.depot_id  = '" . $depot_id . "' ";
        // }
        if ($article) {
            $cond10 = 'Factureclients.id in ( ' . $detarticle . ')';
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



                $condcommercial = 'Clients.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
            //debug($condcommercial);
        }



        $query = $this->Factureclients->find('all')->where([$condcommercial, $cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond8, $cond9, $cond10, $condnumdeb, $condnumfin])
            ->order(['Factureclients.id' => 'DESC']);

        $this->paginate = [
            'contain' => ['Clients', 'Depots', 'Users']
        ];
        $factureclients = $this->paginate($query);
        // debug($factureclients);


        $this->loadModel('Personnels');


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($chauffeurs);

        $chauffeurs = $this->fetchTable('Personnels')->find('all')
            ->where(['fonction_id' => 1]);

        //  debug($chauffeurs);die;
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id = 5"]);


        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);

        $clients = $this->Factureclients->Clients->find('all')->where(["Clients.etat" => 'TRUE']);

        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Factureclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        //debug($timbre);






        $this->set(compact(
            'article',
            'articles',
            'chauffeurs',
            'conffaieurs',
            'depots',
            'factureclients',
            'clients',
            'pointdeventes',
            'depotsoptions',
            'materieltransports',
            'cartecarburants',
            'timbre',
            'numdeb',
            'numfin',
            'client_id'
        ));
    }

    public function imprimelistefactureclient0704($id = null)
    {
        $this->loadModel('Clients');
        $this->loadModel('Articles');
        $client_id = $this->request->getQuery('client_id');
        $commercial_id = $this->request->getQuery('commercial_id');
        $article = $this->request->getQuery('article_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $depot_id = $this->request->getQuery('depot_id');
        $conditions = [];

        if ($depot_id) {
            $conditions = ["Factureclients.depot_id  = '" . $depot_id . "' "];
        }
        if ($historiquede) {
            $conditions[] = ["Factureclients.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Factureclients.date <='" . $au . " 23:59:59' "];
        }
        if ($client_id) {
            $conditions[] = ["Factureclients.client_id = '" . $client_id . "' "];
        }

        if ($article) {
            $subquery = $this->fetchTable('Lignefactureclients')
                ->find('list', [
                    'keyField' => 'factureclient_id',
                    'valueField' => 'factureclient_id'
                ])
                ->where(['Lignefactureclients.article_id' => $article]);
            $conditions[] = ['Factureclients.id IN' => $subquery];
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



                $condcommercial = 'Clients.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
        }
        $factureclients = $this->fetchTable('Factureclients')->find('all')->where([$conditions, $condcommercial])->contain(['Clients', 'Depots'])->ToArray();
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
        $articles = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'Dsignation'])->where('Articles.famille_id=1');
        $depots = $this->fetchTable('Depots')->find('list');

        $this->set(compact('clients', 'client_id', 'article_id', 'articles', 'factureclients', 'historiquede', 'au', 'depots'));
    }
    public function etatjournal()
    {

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Factureclients');
        $this->loadModel('Clients');

        $cond1 = "";
        $cond2 = "";
        $date1 = '0-01-' . date("Y") . '' . date("h:m:s");
        //debug($date1);
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');
        if ($this->request->getQuery()) {
            if ($this->request->getQuery()['date1'] != '') {
                $date1 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date1'])));
            }

            if ($this->request->getQuery()['date2'] != '') {
                $date2 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date2'])));
            }


            if ($date2) {
                $cond1 = 'Factureclients.date  <= ' . "'" . $date2 . " 23:59:59'";
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        // debug($client_id);
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        //  debug($pointdevente_id);
        $chauffeur_id = $this->request->getQuery('chauffeur_id');
        // debug($chauffeur_id);
        // $depot_id = $this->request->getQuery('depot_id');
        //debug($depot_id);
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        //debug($cartecarburant_id);
        $convoyeur_id = $this->request->getQuery('convoyeur_id');

        $materieltransport_id = $this->request->getQuery('materieltransport_id');
        $numdeb = $this->request->getQuery('numdeb');
        $numfin = $this->request->getQuery('numfin');


        $reglee = $this->request->getQuery('reglee');



        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.vente " => 1]);
        $article = $this->request->getQuery('article_id');
        if ($article) {
            $lignefact = $this->fetchTable('Lignefactureclients')->find('all')->where(["Lignefactureclients.article_id=" . $article]);
            $detarticle = '0';
            foreach ($lignefact as $art) {
                //   debug($art);
                $detarticle = $detarticle . ',' . $art->factureclient_id;
            }
            //  debug($lignecommandes);
        }



        if ($datedebut) {
            $cond2 = "date(Factureclients.date)   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "date(Factureclients.date ) <=  '" . $datefin . "' ";
        }
        if ($client_id) {
            $cond4 = "Factureclients.client_id = '" . $client_id . "' ";
        }
        if ($pointdevente_id) {
            $cond5 = "Factureclients.pointdevente_id  =  '" . $pointdevente_id . "' ";
        }


        if ($numdeb) {
            $condnumdeb = "Factureclients.numero   >= '" . $numdeb . "' ";
        }

        if ($numfin) {
            $condnumfin = "Factureclients.numero   <= '" . $numfin . "' ";
        }


        // if ($depot_id) {
        //     $cond7 = "Factureclients.depot_id  = '" . $depot_id . "' ";
        // }
        if ($article) {
            $cond10 = 'Factureclients.id in ( ' . $detarticle . ')';
        }

        if ($reglee) {
            if ($reglee == 1) {
                $condrr = "Lignereglementclients.factureclient_id IS NOT NULL";
                // debug($condrr);
            } elseif ($reglee == 2) {
                $condnn = "Lignereglementclients.factureclient_id IS NULL";
                // debug($condnn);
            }
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



                $condcommercial = 'Clients.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
            //debug($condcommercial);
        }



        $query = $this->Factureclients->find('all')->where([$condcommercial, $condrr, $condnn, $cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond8, $cond9, $cond10, $condnumdeb, $condnumfin])
            ->leftJoinWith('Lignereglementclients')

            ->order(['Factureclients.id' => 'DESC']);

        $this->paginate = [
            'contain' => ['Clients', 'Depots', 'Users']
        ];
        $factureclients = $this->paginate($query);
        // debug($factureclients);

        $this->loadModel('Personnels');


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->first();
        // debug($depots);

        $chauffeurs = $this->fetchTable('Personnels')->find('all')
            ->where(['fonction_id' => 1]);

        //  debug($chauffeurs);die;
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id = 5"]);


        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);

        $clients = $this->Factureclients->Clients->find('all')->where(["Clients.etat" => 'TRUE']);

        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Factureclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        //debug($timbre);






        $this->set(compact(
            'article',
            'articles',
            'reglee',
            'chauffeurs',
            'conffaieurs',
            'depots',
            'factureclients',
            'clients',
            'pointdeventes',
            'depotsoptions',
            'materieltransports',
            'cartecarburants',
            'timbre',
            'client_id',
            'numdeb',
            'numfin',
            'datedebut',
            'datefin',


        ));
    }
    public function imprimelistefactureclientf()
    {

        // $max = $this->getmax();
        // debug($max);

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';

        $cond8 = '';

        $cond9 = '';

        $cond10 = '';
        $condnumdeb = '';
        $condnumfin = '';
        $condrr = '';
        $condnn = '';
        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        // debug($client_id);
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        //  debug($pointdevente_id);
        $chauffeur_id = $this->request->getQuery('chauffeur_id');
        // debug($chauffeur_id);
        // $depot_id = $this->request->getQuery('depot_id');
        //debug($depot_id);
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        //debug($cartecarburant_id);
        $convoyeur_id = $this->request->getQuery('convoyeur_id');

        $materieltransport_id = $this->request->getQuery('materieltransport_id');
        $numdeb = $this->request->getQuery('numdeb');
        $numfin = $this->request->getQuery('numfin');


        $reglee = $this->request->getQuery('reglee');



        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.vente " => 1]);
        $article = $this->request->getQuery('article_id');
        if ($article) {
            $lignefact = $this->fetchTable('Lignefactureclients')->find('all')->where(["Lignefactureclients.article_id=" . $article]);
            $detarticle = '0';
            foreach ($lignefact as $art) {
                //   debug($art);
                $detarticle = $detarticle . ',' . $art->factureclient_id;
            }
            //  debug($lignecommandes);
        }



        if ($datedebut) {
            $cond2 = "date(Factureclients.date)   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "date(Factureclients.date ) <=  '" . $datefin . "' ";
        }
        if ($client_id) {
            $cond4 = "Factureclients.client_id = '" . $client_id . "' ";
        }
        if ($pointdevente_id) {
            $cond5 = "Factureclients.pointdevente_id  =  '" . $pointdevente_id . "' ";
        }


        if ($numdeb) {
            $condnumdeb = "Factureclients.numero   >= '" . $numdeb . "' ";
        }

        if ($numfin) {
            $condnumfin = "Factureclients.numero   <= '" . $numfin . "' ";
        }


        // if ($depot_id) {
        //     $cond7 = "Factureclients.depot_id  = '" . $depot_id . "' ";
        // }
        if ($article) {
            $cond10 = 'Factureclients.id in ( ' . $detarticle . ')';
        }

        if ($reglee) {
            if ($reglee == 1) {
                $condrr = "Lignereglementclients.factureclient_id IS NOT NULL";
                // debug($condrr);
            } elseif ($reglee == 2) {
                $condnn = "Lignereglementclients.factureclient_id IS NULL";
                // debug($condnn);
            }
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



                $condcommercial = 'Clients.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
            //debug($condcommercial);
        }



        $query = $this->Factureclients->find('all')->where([$condcommercial, $condrr, $condnn, $cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond8, $cond9, $cond10, $condnumdeb, $condnumfin])
            ->leftJoinWith('Lignereglementclients')

            ->order(['Factureclients.id' => 'DESC']);

        $this->paginate = [
            'contain' => ['Clients', 'Depots', 'Users']
        ];
        $factureclients = $this->paginate($query);
        // debug($factureclients);

        $this->loadModel('Personnels');


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->first();
        // debug($depots);

        $chauffeurs = $this->fetchTable('Personnels')->find('all')
            ->where(['fonction_id' => 1]);

        //  debug($chauffeurs);die;
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id = 5"]);


        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);

        $clients = $this->Factureclients->Clients->find('all')->where(["Clients.etat" => 'TRUE']);

        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Factureclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        //debug($timbre);






        $this->set(compact(
            'article',
            'articles',
            'reglee',
            'chauffeurs',
            'conffaieurs',
            'depots',
            'factureclients',
            'clients',
            'pointdeventes',
            'depotsoptions',
            'materieltransports',
            'cartecarburants',
            'timbre',
            'client_id',
            'numdeb',
            'numfin',
            'datedebut',
            'datefin',


        ));
    }

    public function impetatechance()

    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factureclients');
        $this->loadModel('Clients');

        $date1 = '0-01-' . date("Y") . ' ' . date("H:i:s");
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');

        $client_id = null;
        $banque_id = null;
        $paiement_id = null;

        $conditions = [];
        $pieceConditions = [];

        if ($this->request->getQuery()) {
            if ($this->request->getQuery('date1') != '') {
                $date1 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }

            if ($this->request->getQuery('date2') != '') {
                $date2 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }

            $conditions[] = 'date(Reglementclients.date) >= ' . "'" . $date1 . " 00:00:00'";
            $conditions[] = 'date(Reglementclients.date) <= ' . "'" . $date2 . " 23:59:59'";

            if ($this->request->getQuery('client_id') != '') {
                $client_id = $this->request->getQuery('client_id');
                $conditions[] = 'Reglementclients.client_id = ' . $client_id;
            }

            if ($this->request->getQuery('banque_id') != '') {
                $banque_id = $this->request->getQuery('banque_id');
                $pieceConditions[] = 'Piecereglementclients.banque_id = ' . $banque_id;
            }

            if ($this->request->getQuery('paiement_id') != '') {
                $paiement_id = $this->request->getQuery('paiement_id');
                $pieceConditions[] = 'Piecereglementclients.paiement_id = ' . $paiement_id;
            }
        }

        $reglementclients = $this->fetchTable('Reglementclients')->find('all', [
            'contain' => ['Clients'],
        ])->where($conditions);

        $tablignelachats = [];
        foreach ($reglementclients as $f) {
            $pieceConditionsWithRegId = array_merge(['Piecereglementclients.reglementclient_id' => $f->id], $pieceConditions);
            $piecereglementclients = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Paiements', 'Comptes', 'Banques'],
            ])->where([$pieceConditionsWithRegId, 'Paiements.id NOT IN' => [5, 6, 7, 8, 9]]);

            foreach ($piecereglementclients as $p) {
                $tablignelachats[] = [
                    'client' => $f['client']['Raison_Sociale'],
                    'date' => $f['date'],
                    'numero' => $f['numeroconca'],
                    'Montantreg' => $f['Montant'],
                    'Montantpiece' => $p['montant'],
                    'paiement' => $p['paiement']['name'],
                    'compte' => $p['compte']['numero'],
                    'banque' => $p['banque']['name'],
                    'num' => $p['num'],
                    'echance' => $p['echance'],
                ];
            }
        }

        $tim = $this->fetchTable('Timbres')->find()->select(['timbre' => 'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $clientss = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => 'Raison_Sociale'
        ]);

        $paiementss = $this->fetchTable('Paiements')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);

        $Banquess = $this->fetchTable('Banques')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);

        $this->set(compact('clientss', 'paiementss', 'paiement_id', 'client_id', 'banque_id', 'timbre', 'Banquess', 'tablignelachats', 'factureclients', 'date1', 'date2'));
    }

    /////
    public function etatecheance11062024()
    {

        error_reporting(E_ERROR | E_PARSE);


        $this->loadModel('Factureclients');
        $this->loadModel('Clients');

        $cond1 = "";
        $cond2 = "";
        $conde1 = "";
        $conde2 = "";
        $condb = "";
        $condp = "";

        $clientid = "";

        $banqueid = "";

        $date1 = '0-01-' . date("Y") . '' . date("h:m:s");
        //debug($date1);
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');
        if ($this->request->getQuery()) {
            if ($this->request->getQuery()['date1'] != '') {
                $date1 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date1'])));
            }

            if ($this->request->getQuery()['date2'] != '') {
                $date2 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date2'])));
            }


            if ($date2) {
                $cond1 = 'date(Reglementclients.date)  <= ' . "'" . $date2 . " 23:59:59'";
                $conde1 = 'date(Piecereglementclients.echance)  <= ' . "'" . $date2 . " 23:59:59'";
            }
            if ($date1) {
                $cond2 = 'date(Reglementclients.date ) >= ' . "'" . $date1 . " 00:00:00'";
                $conde2 = 'date(Piecereglementclients.echance)  <= ' . "'" . $date2 . " 23:59:59'";
            }
            $clientid = "";

            if ($this->request->getQuery()['client_id'] != '') {

                $client_id = $this->request->getQuery()['client_id'];
                $conddd = 'Reglementclients.client_id = ' . $client_id;
            }

            $banqueid = "";

            if ($this->request->getQuery()['banque_id'] != '') {

                $banque_id = $this->request->getQuery()['banque_id'];
                $condb = 'Piecereglementclients.banque_id = ' . $banque_id;
            }



            $paiementid = "";

            if ($this->request->getQuery()['paiement_id'] != '') {

                $paiement_id = $this->request->getQuery()['paiement_id'];
                $condp = 'Piecereglementclients.paiement_id = ' . $paiement_id;
            }



            $clientss = $this->Clients->find('list', [
                'keyField' => 'id',
                'valueField' => 'Raison_Sociale'
            ]);


            $reglementclients = $this->fetchTable('Reglementclients')->find('all', [
                'contain' => ['Clients'],
            ])
                ->where([$conddd]);
        }

        $reglementclients = $this->fetchTable('Reglementclients')->find('all', [
            'contain' => ['Clients'],
        ]);
        //debug($reglementclients->toarray());
        // Check if $reglementclients is empty
        if ($reglementclients->isEmpty()) {
            $lignereg = array();
        } else {
            $lignereg = $reglementclients->toArray(); // Convert the result set to an array
        }

        $tablignelachats = array();
        foreach ($lignereg as $f) {
            $piecereglementclients = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Paiements', 'Comptes', 'Banques'],
            ])->where(['Piecereglementclients.reglementclient_id' => $f->id, $conde1, $conde2, $condb, $condp]);
            //debug($piecereglementclients->toarray());
            foreach ($piecereglementclients as $p) {
                $tablignelachats[] = [
                    'client' => $f['client']['Raison_Sociale'],
                    'date' => $f['date'],
                    'numero' => $f['numero'],
                    'Montantreg' => $f['Montant'],
                    'Montantpiece' => $p['montant'],
                    'paiement' => $p['paiement']['name'],
                    'compte' => $p['compte']['numero'],
                    'banque' => $p['banque']['name'],
                    'num' => $p['num'],
                    'echance' => $p['echance'],
                    // 'timbre' => $f['timbre'], // Uncomment if needed
                ];
            }
        }

        // debug($tablignelachats);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $clientss = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => 'Raison_Sociale'
        ]);
        $paiementss = $this->fetchTable('Paiements')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        $Banquess = $this->fetchTable('Banques')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
        //debug($Banquess);
        $this->set(compact('clientss', 'paiementss', 'paiement_id', 'client_id', 'banque_id', 'timbre', 'Banquess', 'tablignelachats', 'factureclients', 'date1', 'date2'));
    }
    public function etatecheance()
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factureclients');
        $this->loadModel('Clients');

        $date1 = '0-01-' . date("Y") . ' ' . date("H:i:s");
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');

        $client_id = null;
        $banque_id = null;
        $paiement_id = null;

        $conditions = [];
        $pieceConditions = [];

        if ($this->request->getQuery()) {
            if ($this->request->getQuery('date1') != '') {
                $date1 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }

            if ($this->request->getQuery('date2') != '') {
                $date2 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }

            $conditions[] = 'date(Reglementclients.date) >= ' . "'" . $date1 . " 00:00:00'";
            $conditions[] = 'date(Reglementclients.date) <= ' . "'" . $date2 . " 23:59:59'";

            if ($this->request->getQuery('client_id') != '') {
                $client_id = $this->request->getQuery('client_id');
                $conditions[] = 'Reglementclients.client_id = ' . $client_id;
            }

            if ($this->request->getQuery('banque_id') != '') {
                $banque_id = $this->request->getQuery('banque_id');
                $pieceConditions[] = 'Piecereglementclients.banque_id = ' . $banque_id;
            }

            if ($this->request->getQuery('paiement_id') != '') {
                $paiement_id = $this->request->getQuery('paiement_id');
                $pieceConditions[] = 'Piecereglementclients.paiement_id = ' . $paiement_id;
            }
        }

        $reglementclients = $this->fetchTable('Reglementclients')->find('all', [
            'contain' => ['Clients'],
        ])->where($conditions);

        $tablignelachats = [];
        foreach ($reglementclients as $f) {
            $pieceConditionsWithRegId = array_merge(['Piecereglementclients.reglementclient_id' => $f->id], $pieceConditions);
            $piecereglementclients = $this->fetchTable('Piecereglementclients')->find('all', [
                'contain' => ['Reglementclients', 'Paiements', 'Comptes', 'Banques'],
            ])->where([$pieceConditionsWithRegId, 'Paiements.id NOT IN' => [5, 6, 7, 8, 9]]);

            foreach ($piecereglementclients as $p) {
                $tablignelachats[] = [
                    'client' => $f['client']['Raison_Sociale'],
                    'date' => $f['date'],
                    'numero' => $f['numeroconca'],
                    'Montantreg' => $f['Montant'],
                    'Montantpiece' => $p['montant'],
                    'paiement' => $p['paiement']['name'],
                    'compte' => $p['compte']['numero'],
                    'banque' => $p['banque']['name'],
                    'num' => $p['num'],
                    'echance' => $p['echance'],
                ];
            }
        }

        $tim = $this->fetchTable('Timbres')->find()->select(['timbre' => 'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        $clientss = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => 'Raison_Sociale'
        ]);

        $paiementss = $this->fetchTable('Paiements')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);

        $Banquess = $this->fetchTable('Banques')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);

        $this->set(compact('clientss', 'paiementss', 'paiement_id', 'client_id', 'banque_id', 'timbre', 'Banquess', 'tablignelachats', 'factureclients', 'date1', 'date2'));
    }

    public function etatsoldeclient()
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_stat' . $abrv);

        // $unite = 0;
        // foreach ($liendd as $k => $liens) {
        //     if (@$liens['lien'] == 'etatsoldeclient') {
        //         $unite = 1;
        //     }
        // }
        // if (($unite <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Bonlivraisons');

        $date1 = '2023-01-01 00:00:00';
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        if ($this->request->getQuery()) {
            if (!empty($this->request->getQuery('date1'))) {
                $date1 = date("Y-m-d 00:00:00", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }
            if (!empty($this->request->getQuery('date2'))) {
                $date2 = date("Y-m-d 23:59:59", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }
        }

        $clients = $this->Clients->find('all')->toArray();
        $data = [];

        foreach ($clients as $client) {
            $clientId = $client->id;

            $livraisonsSum = $this->Bonlivraisons->find()
                ->where(['Bonlivraisons.client_id' => $clientId, 'Bonlivraisons.date >=' => $date1, 'Bonlivraisons.factureclient_id=0', 'Bonlivraisons.date <=' => $date2])
                ->sumOf('totalttc');

            $facturesSum = $this->Factureclients->find()
                ->where(['Factureclients.client_id' => $clientId, 'Factureclients.date >=' => $date1, 'Factureclients.date <=' => $date2])
                ->sumOf('totalttc');

            $avoirsSum = $this->Factureavoirs->find()
                ->where(['Factureavoirs.client_id' => $clientId, 'Factureavoirs.date >=' => $date1, 'Factureavoirs.date <=' => $date2/*,'Factureavoirs.factureclient_id'=>0*/])
                ->sumOf('totalttc');

            $paymentsSum = $this->Piecereglementclients->find()
                ->contain(['Reglementclients'])
                ->where(['Reglementclients.client_id' => $clientId, 'Reglementclients.date >=' => $date1, 'Reglementclients.date <=' => $date2])
                ->sumOf('montant');

            $data[$clientId] = [
                'client' => $client->Raison_Sociale,
                'code' => $client->Code,
                'soldedepart' => $client->soldedebut,
                'Debit' => $facturesSum + $livraisonsSum,
                'Credit' => $paymentsSum + $avoirsSum,
                // 'Solde' => $paymentsSum + $avoirsSum,
            ];
        }

        $this->set(compact('clients', 'data', 'date1', 'date2'));
    }

    public function impetatdivers()
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Bonlivraisons');

        $date1 = '2023-01-01 00:00:00';
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        if ($this->request->getQuery()) {
            if (!empty($this->request->getQuery('date1'))) {
                $date1 = date("Y-m-d 00:00:00", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }
            if (!empty($this->request->getQuery('date2'))) {
                $date2 = date("Y-m-d 23:59:59", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }
        }


        $client = $this->Clients->find('all')->where(['Clients.Raison_Sociale like' => 'Divers'])->first();
        $blnonreg = [];
        $livraisons = [];
        $factures = [];
        $avoirs = [];
        $payments = [];
        if ($client) {
            $blnonreg = $this->Bonlivraisons->find()
                ->select([
                    'nomprenom' => 'Bonlivraisons.nomprenom',
                    'adressediv' => 'Bonlivraisons.adressediv',
                    'numeroidentite' => 'Bonlivraisons.numeroidentite',
                    'blnumeros' => 'GROUP_CONCAT(Bonlivraisons.numero)', // Concaténation des numéros
                    'totalttc_sumnreg' => 'SUM(Bonlivraisons.totalttc)',  // Somme des totaux TTC
                ])
                ->join([
                    'table' => 'clients',
                    'alias' => 'Clients',
                    'type' => 'INNER',
                    'conditions' => 'Clients.id = Bonlivraisons.client_id',
                ])
                ->where([
                    'Bonlivraisons.client_id' => $client->id,
                    'Bonlivraisons.date >=' => $date1,
                    'Bonlivraisons.date <=' => $date2,
                    'Bonlivraisons.factureclient_id' => 0,
                    'Bonlivraisons.typebl' => 1,
                    'Bonlivraisons.Montant_Regler != Bonlivraisons.totalttc',
                ])
                ->group(['Bonlivraisons.numeroidentite', /*'Clients.adressediv', */ 'Bonlivraisons.nomprenom']) // Regrouper par client
                ->toArray();

            // debug($blnonreg);

            $livraisons = $this->Bonlivraisons->find()
                ->select([
                    'nomprenom',
                    'adressediv',
                    'numeroidentite',
                    'totalttc_sum' => 'SUM(Bonlivraisons.totalttc)'
                ])
                ->where([
                    'Bonlivraisons.client_id' => $client->id,
                    'Bonlivraisons.date >=' => $date1,
                    'Bonlivraisons.factureclient_id' => 0,
                    'Bonlivraisons.typebl' => 1,
                    'Bonlivraisons.date <=' => $date2
                ])
                ->group(['Bonlivraisons.numeroidentite',/* 'Bonlivraisons.adressediv', */ 'Bonlivraisons.nomprenom'])
                ->toArray();

            $factures = $this->Factureclients->find()
                ->select([
                    'nomprenom',
                    'adressediv',
                    'numeroidentite',
                    'totalttc_sum' => 'SUM(Factureclients.totalttc)'
                ])
                ->where([
                    'Factureclients.client_id' => $client->id,
                    'Factureclients.date >=' => $date1,
                    'Factureclients.date <=' => $date2
                ])
                ->group(['Factureclients.numeroidentite',/* 'Factureclients.adressediv', */ 'Factureclients.nomprenom'])
                ->toArray();

            $avoirs = $this->Factureavoirs->find()
                ->select([
                    'nomprenom',
                    'adressediv',
                    'numeroidentite',
                    'totalttc_sum' => 'SUM(Factureavoirs.totalttc)'
                ])
                ->where([
                    'Factureavoirs.client_id' => $client->id,
                    'Factureavoirs.date >=' => $date1,
                    'Factureavoirs.date <=' => $date2
                ])
                ->group(['Factureavoirs.nomprenom', /*'Factureavoirs.adressediv',*/ 'Factureavoirs.nomprenom'])
                ->toArray();

            $payments = $this->Piecereglementclients->find()
                ->contain(['Reglementclients'])
                ->select([
                    'Reglementclients.nomprenom',
                    'Reglementclients.adressediv',
                    'Reglementclients.numeroidentite',
                    'montant_sum' => 'SUM(Piecereglementclients.montant)'
                ])
                ->where([
                    'Reglementclients.client_id' => $client->id,
                    'Reglementclients.date >=' => $date1,
                    'Reglementclients.date <=' => $date2
                ])
                ->group(['Reglementclients.numeroidentite',/* 'Reglementclients.adressediv',*/ 'Reglementclients.nomprenom'])
                ->toArray();
        }
        // debug($payments);
        $data = [];

        // Create a helper function for grouping keys
        function generateKey($nomprenom, $adressediv, $numeroidentite)
        {
            return trim(strtolower($nomprenom)) . '-' . trim(strtolower($adressediv)) . '-' . trim(strtolower($numeroidentite));
        }

        // Process Bonlivraisons (Livraisons)
        foreach ($livraisons as $livraison) {
            $key = generateKey($livraison->nomprenom, $livraison->adressediv, $livraison->numeroidentite);
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $livraison->nomprenom,
                    'adressediv' => $livraison->adressediv,
                    'numeroidentite' => $livraison->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumero' => '',

                ];
            }
            $data[$key]['Debit'] += $livraison->totalttc_sum;
        }
        foreach ($blnonreg as $bl) {
            $key = generateKey($bl->nomprenom, $bl->adressediv, $bl->numeroidentite);
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $bl->nomprenom,
                    'adressediv' => $bl->adressediv,
                    'numeroidentite' => $bl->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumeros' => '', // Initialise blnumeros comme une chaîne vide
                ];
            }
            // Ajout des numéros séparés par " - "
            $data[$key]['blnumeros'] = trim($data[$key]['blnumeros'] . ' - ' . $bl->blnumeros, ' -');
            // $data[$key]['Debit'] += $bl->totalttc_sumnreg;
        }
        // debug($blnonreg);
        // debug($data);
        // Process Factureclients (Factures)
        foreach ($factures as $facture) {
            $key = generateKey($facture->nomprenom, $facture->adressediv, $facture->numeroidentite);
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $facture->nomprenom,
                    'adressediv' => $facture->adressediv,
                    'numeroidentite' => $facture->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumero' => '',

                ];
            }
            $data[$key]['Debit'] += $facture->totalttc_sum;
        }

        // Process Factureavoirs (Avoirs)
        foreach ($avoirs as $avoir) {
            $key = generateKey($avoir->nomprenom, $avoir->adressediv, $avoir->numeroidentite);
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $avoir->nomprenom,
                    'adressediv' => $avoir->adressediv,
                    'numeroidentite' => $avoir->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumero' => '',
                ];
            }
            $data[$key]['Credit'] += $avoir->totalttc_sum;
        }

        // Process Piecereglementclients (Payments)
        foreach ($payments as $payment) {
            $key = generateKey(
                $payment->reglementclient->nomprenom,
                $payment->reglementclient->adressediv,
                $payment->reglementclient->numeroidentite
            );
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $payment->reglementclient->nomprenom,
                    'adressediv' => $payment->reglementclient->adressediv,
                    'numeroidentite' => $payment->reglementclient->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumero' => '',
                ];
            }
            $data[$key]['Credit'] += $payment->montant_sum;
        }



        //  debug($payments);
        $this->set(compact('client', 'data', 'date1', 'date2'));
    }

    public function etatsoldedivers()
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Bonlivraisons');

        $date1 = '2023-01-01 00:00:00';
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        if ($this->request->getQuery()) {
            if (!empty($this->request->getQuery('date1'))) {
                $date1 = date("Y-m-d 00:00:00", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }
            if (!empty($this->request->getQuery('date2'))) {
                $date2 = date("Y-m-d 23:59:59", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }
        }


        $client = $this->Clients->find('all')->where(['Clients.Raison_Sociale like' => 'Divers'])->first();
        $blnonreg = [];
        $livraisons = [];
        $factures = [];
        $avoirs = [];
        $payments = [];
        if ($client) {
            $blnonreg = $this->Bonlivraisons->find()
                ->select([
                    'nomprenom' => 'Bonlivraisons.nomprenom',
                    'adressediv' => 'Bonlivraisons.adressediv',
                    'numeroidentite' => 'Bonlivraisons.numeroidentite',
                    'blnumeros' => 'GROUP_CONCAT(Bonlivraisons.numero)', // Concaténation des numéros
                    'totalttc_sumnreg' => 'SUM(Bonlivraisons.totalttc)',  // Somme des totaux TTC
                ])
                ->join([
                    'table' => 'clients',
                    'alias' => 'Clients',
                    'type' => 'INNER',
                    'conditions' => 'Clients.id = Bonlivraisons.client_id',
                ])
                ->where([
                    'Bonlivraisons.client_id' => $client->id,
                    'Bonlivraisons.date >=' => $date1,
                    'Bonlivraisons.date <=' => $date2,
                    'Bonlivraisons.factureclient_id' => 0,
                    'Bonlivraisons.typebl' => 1,
                    'Bonlivraisons.Montant_Regler != Bonlivraisons.totalttc',
                ])
                ->group(['Bonlivraisons.numeroidentite', /*'Clients.adressediv', */ 'Bonlivraisons.nomprenom']) // Regrouper par client
                ->toArray();

            // debug($blnonreg);

            $livraisons = $this->Bonlivraisons->find()
                ->select([
                    'nomprenom',
                    'adressediv',
                    'numeroidentite',
                    'totalttc_sum' => 'SUM(Bonlivraisons.totalttc)'
                ])
                ->where([
                    'Bonlivraisons.client_id' => $client->id,
                    'Bonlivraisons.date >=' => $date1,
                    'Bonlivraisons.factureclient_id' => 0,
                    'Bonlivraisons.typebl' => 1,
                    'Bonlivraisons.date <=' => $date2
                ])
                ->group(['Bonlivraisons.numeroidentite',/* 'Bonlivraisons.adressediv', */ 'Bonlivraisons.nomprenom'])
                ->toArray();

            $factures = $this->Factureclients->find()
                ->select([
                    'nomprenom',
                    'adressediv',
                    'numeroidentite',
                    'totalttc_sum' => 'SUM(Factureclients.totalttc)'
                ])
                ->where([
                    'Factureclients.client_id' => $client->id,
                    'Factureclients.date >=' => $date1,
                    'Factureclients.date <=' => $date2
                ])
                ->group(['Factureclients.numeroidentite',/* 'Factureclients.adressediv', */ 'Factureclients.nomprenom'])
                ->toArray();

            $avoirs = $this->Factureavoirs->find()
                ->select([
                    'nomprenom',
                    'adressediv',
                    'numeroidentite',
                    'totalttc_sum' => 'SUM(Factureavoirs.totalttc)'
                ])
                ->where([
                    'Factureavoirs.client_id' => $client->id,
                    'Factureavoirs.date >=' => $date1,
                    'Factureavoirs.date <=' => $date2
                ])
                ->group(['Factureavoirs.nomprenom', /*'Factureavoirs.adressediv',*/ 'Factureavoirs.nomprenom'])
                ->toArray();

            $payments = $this->Piecereglementclients->find()
                ->contain(['Reglementclients'])
                ->select([
                    'Reglementclients.nomprenom',
                    'Reglementclients.adressediv',
                    'Reglementclients.numeroidentite',
                    'montant_sum' => 'SUM(Piecereglementclients.montant)'
                ])
                ->where([
                    'Reglementclients.client_id' => $client->id,
                    'Reglementclients.date >=' => $date1,
                    'Reglementclients.date <=' => $date2
                ])
                ->group(['Reglementclients.numeroidentite',/* 'Reglementclients.adressediv',*/ 'Reglementclients.nomprenom'])
                ->toArray();
        }
        // debug($payments);
        $data = [];

        // Create a helper function for grouping keys
        function generateKey($nomprenom, $adressediv, $numeroidentite)
        {
            return trim(strtolower($nomprenom)) . '-' . trim(strtolower($adressediv)) . '-' . trim(strtolower($numeroidentite));
        }

        // Process Bonlivraisons (Livraisons)
        foreach ($livraisons as $livraison) {
            $key = generateKey($livraison->nomprenom, $livraison->adressediv, $livraison->numeroidentite);
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $livraison->nomprenom,
                    'adressediv' => $livraison->adressediv,
                    'numeroidentite' => $livraison->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumero' => '',

                ];
            }
            $data[$key]['Debit'] += $livraison->totalttc_sum;
        }
        foreach ($blnonreg as $bl) {
            $key = generateKey($bl->nomprenom, $bl->adressediv, $bl->numeroidentite);
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $bl->nomprenom,
                    'adressediv' => $bl->adressediv,
                    'numeroidentite' => $bl->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumeros' => '', // Initialise blnumeros comme une chaîne vide
                ];
            }
            // Ajout des numéros séparés par " - "
            $data[$key]['blnumeros'] = trim($data[$key]['blnumeros'] . ' - ' . $bl->blnumeros, ' -');
            // $data[$key]['Debit'] += $bl->totalttc_sumnreg;
        }
        // debug($blnonreg);
        // debug($data);
        // Process Factureclients (Factures)
        foreach ($factures as $facture) {
            $key = generateKey($facture->nomprenom, $facture->adressediv, $facture->numeroidentite);
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $facture->nomprenom,
                    'adressediv' => $facture->adressediv,
                    'numeroidentite' => $facture->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumero' => '',

                ];
            }
            $data[$key]['Debit'] += $facture->totalttc_sum;
        }

        // Process Factureavoirs (Avoirs)
        foreach ($avoirs as $avoir) {
            $key = generateKey($avoir->nomprenom, $avoir->adressediv, $avoir->numeroidentite);
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $avoir->nomprenom,
                    'adressediv' => $avoir->adressediv,
                    'numeroidentite' => $avoir->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumero' => '',
                ];
            }
            $data[$key]['Credit'] += $avoir->totalttc_sum;
        }

        // Process Piecereglementclients (Payments)
        foreach ($payments as $payment) {
            $key = generateKey(
                $payment->reglementclient->nomprenom,
                $payment->reglementclient->adressediv,
                $payment->reglementclient->numeroidentite
            );
            if (!isset($data[$key])) {
                $data[$key] = [
                    'nomprenom' => $payment->reglementclient->nomprenom,
                    'adressediv' => $payment->reglementclient->adressediv,
                    'numeroidentite' => $payment->reglementclient->numeroidentite,
                    'Debit' => 0,
                    'Credit' => 0,
                    'blnumero' => '',
                ];
            }
            $data[$key]['Credit'] += $payment->montant_sum;
        }



        //  debug($payments);
        $this->set(compact('client', 'data', 'date1', 'date2'));
    }


    public function etatsoldedivers1012()
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_stat' . $abrv);

        // $unite = 0;
        // foreach ($liendd as $k => $liens) {
        //     if (@$liens['lien'] == 'etatsoldeclient') {
        //         $unite = 1;
        //     }
        // }
        // if (($unite <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Bonlivraisons');

        $date1 = '2023-01-01 00:00:00';
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        if ($this->request->getQuery()) {
            if (!empty($this->request->getQuery('date1'))) {
                $date1 = date("Y-m-d 00:00:00", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }
            if (!empty($this->request->getQuery('date2'))) {
                $date2 = date("Y-m-d 23:59:59", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }
        }

        $clients = $this->Clients->find('all');
        $data = [];

        foreach ($clients as $client) {
            $clientId = $client->id;

            $livraisonsSum = $this->Bonlivraisons->find()
                ->where(['Bonlivraisons.client_id' => $clientId, 'Bonlivraisons.date >=' => $date1, 'Bonlivraisons.factureclient_id=0', 'Bonlivraisons.date <=' => $date2])
                ->sumOf('totalttc');

            $facturesSum = $this->Factureclients->find()
                ->where(['Factureclients.client_id' => $clientId, 'Factureclients.date >=' => $date1, 'Factureclients.date <=' => $date2])
                ->sumOf('totalttc');

            $avoirsSum = $this->Factureavoirs->find()
                ->where(['Factureavoirs.client_id' => $clientId, 'Factureavoirs.date >=' => $date1, 'Factureavoirs.date <=' => $date2/*,'Factureavoirs.factureclient_id'=>0*/])
                ->sumOf('totalttc');

            $paymentsSum = $this->Piecereglementclients->find()
                ->contain(['Reglementclients'])
                ->where(['Reglementclients.client_id' => $clientId, 'Reglementclients.date >=' => $date1, 'Reglementclients.date <=' => $date2])
                ->sumOf('montant');

            $data[$clientId] = [
                'client' => $client->Raison_Sociale,
                'code' => $client->Code,
                'soldedepart' => $client->soldedebut,
                'Debit' => $facturesSum + $livraisonsSum,
                'Credit' => $paymentsSum + $avoirsSum,
                // 'Solde' => $paymentsSum + $avoirsSum,
            ];
        }

        $this->set(compact('clients', 'data', 'date1', 'date2'));
    }
    public function etatsoldeclient1610()
    {
        // Set error reporting
        error_reporting(E_ERROR | E_PARSE);

        // Load necessary models
        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $cond1 = "";
        $cond2 = "";
        $conde1 = "";
        $conde2 = "";
        $condb = "";
        $condp = "";
        // Set default dates
        $date1 = '2023-01-01 00:00:00';
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        // Initialize conditions array
        // $conditions = [];

        // Check for query parameters and update dates if provided
        if ($this->request->getQuery()) {
            if (!empty($this->request->getQuery('date1'))) {
                $date1 = date("Y-m-d 00:00:00", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }

            if (!empty($this->request->getQuery('date2'))) {
                $date2 = date("Y-m-d 23:59:59", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }

            // Add date conditions
            if ($date2) {
                $cond1 = 'date(Reglementclients.date)  <= ' . "'" . $date2 . " 23:59:59'";
                $conde1 = 'date(Factureclients.date)  <= ' . "'" . $date2 . " 23:59:59'";
            }
            if ($date1) {
                $cond2 = 'date(Reglementclients.date ) >= ' . "'" . $date1 . " 00:00:00'";
                $conde2 = 'date(Factureclients.date)  <= ' . "'" . $date2 . " 23:59:59'";
            }
        }

        // Fetch list of suppliers
        $suppliers = $this->Clients->find('list', [
            'keyField' => 'id',
            'valueField' => 'Raison_Sociale'
        ]);

        // Fetch unpaid invoices for the specified period
        $unpaidInvoices = $this->Factureclients->find()
            ->contain(['Clients'])
            ->where([
                'Factureclients.Montant_Regler' => 0,
                $conde1,
                $conde2
            ])
            ->toArray();

        // Fetch payment pieces for the specified period
        $payments = $this->Piecereglementclients->find()
            ->contain(['Reglementclients' => ['Clients']])
            ->where([$cond1, $cond2])
            ->toArray();

        // Initialize an array to hold the results
        $supplierBalances = [];

        // Process unpaid invoices
        foreach ($unpaidInvoices as $invoice) {
            $supplierId = $invoice->client_id;

            // Initialize supplier entry if not already set
            if (!isset($supplierBalances[$supplierId])) {
                $supplierBalances[$supplierId] = [
                    'client' => $invoice->client->Raison_Sociale,
                    'code' => $invoice->client->Code,
                    'soldedepart' => $invoice->client->soldedebut,
                    'Debit' => $invoice->totalttc,
                    'Credit' => 0,
                    'Solde' => $invoice->client->soldedebut - $invoice->totalttc
                ];
            } else {
                // Update the supplier's financial entries
                $supplierBalances[$supplierId]['Debit'] += $invoice->totalttc;
                $supplierBalances[$supplierId]['Solde'] -= $invoice->totalttc;
            }
        }

        // Process payments
        foreach ($payments as $payment) {
            $supplierId = $payment->reglement->client_id;

            // Initialize supplier entry if not already set
            if (!isset($supplierBalances[$supplierId])) {
                $supplierBalances[$supplierId] = [
                    'client' => $payment->reglement->client->Raison_Sociale,
                    'code' => $payment->reglement->client->Code,
                    'soldedepart' => $payment->reglement->client->soldedebut,
                    'Debit' => 0,
                    'Credit' => $payment->montant,
                    'Solde' => $payment->reglement->client->soldedebut + $payment->montant
                ];
            } else {
                // Update the supplier's financial entries
                $supplierBalances[$supplierId]['Credit'] += $payment->montant;
                $supplierBalances[$supplierId]['Solde'] += $payment->montant;
            }
        }

        // Set variables for the view
        $this->set(compact('suppliers', 'supplierBalances', 'date1', 'date2'));
    }
    public function impetatsolde()
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_stat' . $abrv);

        // $unite = 0;
        // foreach ($liendd as $k => $liens) {
        //     if (@$liens['lien'] == 'etatsoldeclient') {
        //         $unite = 1;
        //     }
        // }
        // if (($unite <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Bonlivraisons');

        $date1 = '2023-01-01 00:00:00';
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:mm:ss');

        if ($this->request->getQuery()) {
            if (!empty($this->request->getQuery('date1'))) {
                $date1 = date("Y-m-d 00:00:00", strtotime(str_replace('/', '-', $this->request->getQuery('date1'))));
            }
            if (!empty($this->request->getQuery('date2'))) {
                $date2 = date("Y-m-d 23:59:59", strtotime(str_replace('/', '-', $this->request->getQuery('date2'))));
            }
        }

        $clients = $this->Clients->find('all')->toArray();
        $data = [];

        foreach ($clients as $client) {
            $clientId = $client->id;

            $livraisonsSum = $this->Bonlivraisons->find()
                ->where(['Bonlivraisons.client_id' => $clientId, 'Bonlivraisons.date >=' => $date1, 'Bonlivraisons.factureclient_id=0', 'Bonlivraisons.date <=' => $date2])
                ->sumOf('totalttc');

            $facturesSum = $this->Factureclients->find()
                ->where(['Factureclients.client_id' => $clientId, 'Factureclients.date >=' => $date1, 'Factureclients.date <=' => $date2])
                ->sumOf('totalttc');

            $avoirsSum = $this->Factureavoirs->find()
                ->where(['Factureavoirs.client_id' => $clientId, 'Factureavoirs.date >=' => $date1, 'Factureavoirs.date <=' => $date2/*,'Factureavoirs.factureclient_id'=>0*/])
                ->sumOf('totalttc');

            $paymentsSum = $this->Piecereglementclients->find()
                ->contain(['Reglementclients'])
                ->where(['Reglementclients.client_id' => $clientId, 'Reglementclients.date >=' => $date1, 'Reglementclients.date <=' => $date2])
                ->sumOf('montant');

            $data[$clientId] = [
                'client' => $client->Raison_Sociale,
                'code' => $client->Code,
                'soldedepart' => $client->soldedebut,
                'Debit' => $facturesSum + $livraisonsSum,
                'Credit' => $paymentsSum + $avoirsSum,
                // 'Solde' => $paymentsSum + $avoirsSum,
            ];
        }

        $this->set(compact('clients', 'data', 'date1', 'date2'));
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function imprimeviewbor($id = null)
    {

        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');



        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());
            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {



                $this->misejour("Factureclients", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);

                        if ($l['supp'] != 1) {
                            $tab['bonlivraison_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['prixht'] = $l['prixht'];
                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['punht'];

                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };

                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            //  debug($lignefactureclient);

                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);

                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }









                // $this->Flash->success(__('The {0} has been saved.', 'facture'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);





        ////////////////////////////////////////////////////////////////

        $client = $this->fetchTable('Clients')->get($factureclient->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);
        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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

        $this->set(compact('exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'client', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function imprimeview($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients', 'Timbres'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');



        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());
            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {



                $this->misejour("Factureclients", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);

                        if ($l['supp'] != 1) {
                            $tab['bonlivraison_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['prixht'] = $l['prixht'];
                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['punht'];

                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };

                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            //  debug($lignefactureclient);

                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);

                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }









                // $this->Flash->success(__('The {0} has been saved.', 'facture'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);





        ////////////////////////////////////////////////////////////////

        $client = $this->fetchTable('Clients')->get($factureclient->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);
        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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

        $this->set(compact('exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'client', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function imprimeviewf($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients', 'Timbres'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');




        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);





        ////////////////////////////////////////////////////////////////

        $client = $this->fetchTable('Clients')->get($factureclient->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);
        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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

        $this->set(compact('exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'client', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function imprimeviewsmbm($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');



        if ($this->request->is(['patch', 'post', 'put'])) {
            //  debug($this->request->getData());
            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {



                $this->misejour("Factureclients", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);

                        if ($l['supp'] != 1) {
                            $tab['bonlivraison_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['prixht'] = $l['prixht'];
                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['punht'];

                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };

                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            //  debug($lignefactureclient);

                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);

                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }









                // $this->Flash->success(__('The {0} has been saved.', 'facture'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);





        ////////////////////////////////////////////////////////////////

        $client = $this->fetchTable('Clients')->get($factureclient->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);
        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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

        $this->set(compact('exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'client', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }

    public function imprimeviewall($factureIds = null)
    {

        $factureclient = $this->fetchTable('Factureclients')->find('all', [

            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],
        ])
            ->where(['Factureclients.id   in (' . $factureIds . ')   ']);
        // debug($factureclient->toarray());die;

        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');




        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id in (' . $factureIds . ')']);

        //  debug($lignefactureclient->toarray());die;

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Factureclients->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);



        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;


        //  $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);






        // debug($factureIds);die;

        $this->set(compact('timbre', 'factureclient', 'factureIds', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs'));
    }
    public function addfacture($tab = null)
    {

        error_reporting(E_ERROR | E_PARSE);
        //debug($tab);die;
        $this->loadModel('Bonlivraisons');

        $bonlivrai = $this->fetchTable('Bonlivraisons')->find('all', [

            'contain' => ['Clients']
        ])
            ->where(['Bonlivraisons.id   in (' . $tab . ')   '])->first();
        $bonliv = $this->fetchTable('Bonlivraisons')->find('all', [

            'contain' => ['Clients']
        ])
            ->where(['Bonlivraisons.id   in (' . $tab . ')   ']);

        foreach ($bonliv as $i => $bb) {

            $remisecli = $bb->client->remise;
        }


        $yearf = date('Y');
        $currentYear = date('y');
        $num = $this->Factureclients->find()->select(["num" => 'MAX(Factureclients.numero)'])
            ->where('YEAR(Factureclients.date)=' . $yearf)->first();
        $n = $num->num;

        if ($n) {
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            $in = '0001';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $mm = "FC{$currentYear}00{$mm}";


        /// debug($mm);


        $result = $this->request->getAttribute('authentication')->getIdentity();

        $factureclient = $this->Factureclients->newEmptyEntity();
        if ($this->request->is('post')) {
            //// debug( $this->request->getData());
            // $yearf = date('Y');
            // $currentYear = date('y');
            $inputDate = $this->request->getData('date');

            $yearf = date('Y', strtotime($inputDate));

            $currentYear = date('y', strtotime($inputDate));

            $num = $this->Factureclients->find()->select(["num" => 'MAX(Factureclients.numero)'])
                ->where('YEAR(Factureclients.date)=' . $yearf)->first();
            $n = $num->num;

            if ($n) {
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                $in = '0001';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $mm = "FC{$currentYear}00{$mm}";

            $data['user_id'] = $result['id'];

            ////
            ///  debug($this->request->getData());
            $data['numero'] = $mm;
            $data['type'] = 1;

            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['pointdevente_id'] = $this->request->getData('pointdevente_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['totalht'] = $this->request->getData('totalht');
            $data['totaltva'] = $this->request->getData('totaltva');
            $data['totalfodec'] = $this->request->getData('totalfodec');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['escompte'] = $this->request->getData('escompte');
            $data['tpe'] = $this->request->getData('tpecommande');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['observation'] = $this->request->getData('observation');
            $data['poste'] = $this->request->getData('poste');
            $data['timbre'] = $this->request->getData('timbre');

            //  $data['bonlivraison_id'] = $tab;
            //debug($data);
            $factureclient = $this->Factureclients->patchEntity($factureclient, $data);
            // debug($factureclient);
            if ($this->Factureclients->save($factureclient)) {
                $this->misejour("Factureclients", "addfacture", $tab);
                $factureclient_id = $factureclient->id;
                foreach ($bonliv as $i => $com) {

                    $bl = $this->Bonlivraisons->get($com['id'], [
                        'contain' => [],
                    ]);

                    $bl->factureclient_id = $factureclient_id;
                    $this->fetchTable('Bonlivraisons')->save($bl);
                }



                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($bonlivraison_id);die;
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //debug($l);
                        if ($l['sup'] != 1) {
                            $tab = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            $tab['factureclient_id'] = $factureclient_id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            //$tab['qtestock'] = $l['qteStock'];
                            $tab['punht'] = $l['prix'];
                            $tab['prixht'] = $l['ht'];
                            $tab['ml'] = $l['ml'];
                            $tab['remise'] = $l['remise'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['montantht'] = $l['motanttotal'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['tva'] = $l['tva'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['totalttc'] = $l['totalttc'];
                            ///  debug($tab);die;
                            //$lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            // $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);
                            //debug($lignebonlivraison);
                            $this->fetchTable('Lignefactureclients')->save($tab);
                        }
                    }
                }
                // $this->Flash->success(__('The {0} has been saved.', 'Facture clients'));
                return $this->redirect(['action' => 'index']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Facture clients'));
        }
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');
        $lignebonlivraisons = $this->Lignebonlivraisons->find('all', ['contain' => ['Articles']])
            ->where(['Lignebonlivraisons.bonlivraison_id   in (' . $tab . ')   ']);
        //// debug($lignebonlivraisons->toarray());

        // $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')
        //     ->find('all', [
        //         'contain' => ['Articles'],
        //     ])
        //     ->select([
        //         'article_id', 'prixht',
        //         'ml', 'punht', 'remise', 'tva', 'fodec', 'lignecommande_id', 'bonlivraison_id',
        //         'total_qte' => $this->fetchTable('Lignebonlivraisons')->query()->func()->sum('qte'),
        //     ])
        //     ->where(['Lignebonlivraisons.bonlivraison_id   in (' . $tab . ')   '])
        //     ->group(['article_id'])
        //     ->order(['Lignebonlivraisons.id' => 'ASC'])
        //     ->toArray();


        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->fetchTable('Commandes')->Clients->find('all');
        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);
        //   $bonlivraison = $this->Factureclients->Bonlivraisons->find('first', ['limit' => 200]);
        // $bonlivraison = $this->fetchTable('Bonlivraisons')->get($tab, [
        //     'contain' => [
        //         'Lignebonlivraisons', 'Clients' ,'Commandes'
        //     ]
        // ]);

        ///
        //debug($bonlivraison->client_id);
        // die;
        foreach ($bonliv as $i => $com) {

            $date = $com->date;
            $client_id = $com->client_id;
            //debug($client_id);
            $depot_id = $com->depot_id;
        }

        $clientc = $this->fetchTable('Clients')->get($client_id, [
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
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;



        $time = $date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $bonlivrai->client_id . "' ";


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




        $$BL = $clientc->bl;
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

        // $date=$bonlivraison->date;
        // debug($factureclient->toArray());die;
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


        $adresselivraisonclients = $this->fetchTable('Adresselivraisonclients')->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.famille_id=1"]);
        $clientid = $bonlivrai->client_id;

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
        $this->set(compact('remisecli', 'BL', 'gs', 'bonlivrai', 'encours', 'echanciere', 'solde', 'echancierebl', 'not', 'remes', 'remcli', 'exotpe', 'exotva', 'exofodec', 'exotimbre', 'clientc', 'timbre', 'bonlivraison', 'lignebonlivraisons', 'mm', 'articles', 'factureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients', 'cl', 'rz', 'es', 'depot_id', 'client_id', 'bonliv'));
    }

    public function index()
    {

        // $max = $this->getmax();
        // debug($max);

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';

        $cond8 = '';

        $cond9 = '';

        $cond10 = '';
        $condnumdeb = '';
        $condnumfin = '';
        $condrr = '';
        $condnn = '';
        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        // debug($client_id);
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        //  debug($pointdevente_id);
        $chauffeur_id = $this->request->getQuery('chauffeur_id');
        // debug($chauffeur_id);
        // $depot_id = $this->request->getQuery('depot_id');
        //debug($depot_id);
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        //debug($cartecarburant_id);
        $convoyeur_id = $this->request->getQuery('convoyeur_id');

        $materieltransport_id = $this->request->getQuery('materieltransport_id');
        $numdeb = $this->request->getQuery('numdeb');
        $numfin = $this->request->getQuery('numfin');
        $reglee = $this->request->getQuery('reglee');






        if ($datedebut) {
            $cond2 = "date(Factureclients.date)   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "date(Factureclients.date ) <=  '" . $datefin . "' ";
        }
        if ($client_id) {
            $cond4 = "Factureclients.client_id = '" . $client_id . "' ";
        }
        if ($pointdevente_id) {
            $cond5 = "Factureclients.pointdevente_id  =  '" . $pointdevente_id . "' ";
        }


        if ($numdeb) {
            $condnumdeb = "Factureclients.numero   >= '" . $numdeb . "' ";
        }

        if ($numfin) {
            $condnumfin = "Factureclients.numero   <= '" . $numfin . "' ";
        }




        if ($reglee) {
            if ($reglee == 1) {
                $condrr = "Lignereglementclients.factureclient_id IS NOT NULL";
                // debug($condrr);
            } elseif ($reglee == 2) {
                $condnn = "Lignereglementclients.factureclient_id IS NULL";
                // debug($condnn);
            }
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



                $condcommercial = 'Clients.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
            //debug($condcommercial);
        }
        $regle[1] = 'Réglée';
        $regle[2] = 'non Réglée';


        $query = $this->Factureclients->find('all')->where([$condcommercial, $condrr, $condnn, $cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond8, $cond9, $cond10, $condnumdeb, $condnumfin, 'Factureclients.type=1'])
            ->leftJoinWith('Lignereglementclients')

            ->order(['Factureclients.id' => 'DESC']);

        $this->paginate = [
            'contain' => ['Clients', 'Depots', 'Users']
        ];
        $factureclients = $this->paginate($query);
        // debug($factureclients);
        $count = $query->count();
        ///debug($count);

        $this->loadModel('Personnels');


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($chauffeurs);

        $chauffeurs = $this->fetchTable('Personnels')->find('all')
            ->where(['fonction_id' => 1]);

        //  debug($chauffeurs);die;
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id = 5"]);


        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);

        $clients = $this->Factureclients->Clients->find('all')->where(["Clients.etat" => 'TRUE']);

        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Factureclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        //debug($timbre);






        $this->set(compact(

            'reglee',
            'regle',
            'chauffeurs',
            'conffaieurs',
            'depots',
            'factureclients',
            'clients',
            'pointdeventes',
            'depotsoptions',
            'materieltransports',
            'cartecarburants',
            'timbre',
            'count',
            'datefin',
            'client_id',
            'numdeb',
            'numfin',
            'datedebut'
        ));
    }
    public function indexf()
    {

        // $max = $this->getmax();
        // debug($max);

        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';

        $cond8 = '';

        $cond9 = '';

        $cond10 = '';
        $condnumdeb = '';
        $condnumfin = '';
        $condrr = '';
        $condnn = '';
        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        // debug($client_id);
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        //  debug($pointdevente_id);
        $chauffeur_id = $this->request->getQuery('chauffeur_id');
        // debug($chauffeur_id);
        // $depot_id = $this->request->getQuery('depot_id');
        //debug($depot_id);
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        //debug($cartecarburant_id);
        $convoyeur_id = $this->request->getQuery('convoyeur_id');

        $materieltransport_id = $this->request->getQuery('materieltransport_id');
        $numdeb = $this->request->getQuery('numdeb');
        $numfin = $this->request->getQuery('numfin');
        $reglee = $this->request->getQuery('reglee');






        if ($datedebut) {
            $cond2 = "date(Factureclients.date)   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "date(Factureclients.date ) <=  '" . $datefin . "' ";
        }
        if ($client_id) {
            $cond4 = "Factureclients.client_id = '" . $client_id . "' ";
        }
        if ($pointdevente_id) {
            $cond5 = "Factureclients.pointdevente_id  =  '" . $pointdevente_id . "' ";
        }


        if ($numdeb) {
            $condnumdeb = "Factureclients.numero   >= '" . $numdeb . "' ";
        }

        if ($numfin) {
            $condnumfin = "Factureclients.numero   <= '" . $numfin . "' ";
        }




        if ($reglee) {
            if ($reglee == 1) {
                $condrr = "Lignereglementclients.factureclient_id IS NOT NULL";
                // debug($condrr);
            } elseif ($reglee == 2) {
                $condnn = "Lignereglementclients.factureclient_id IS NULL";
                // debug($condnn);
            }
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



                $condcommercial = 'Clients.commercial_id IN (' . $commercialIdsString . ')';
            } else {
                $condcommercial = '1=0';
            }
            //debug($condcommercial);
        }
        $regle[1] = 'Réglée';
        $regle[2] = 'non Réglée';


        $query = $this->Factureclients->find('all')->where([$condcommercial, $condrr, $condnn, $cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond8, $cond9, $cond10, $condnumdeb, $condnumfin, 'Factureclients.type=2'])
            ->leftJoinWith('Lignereglementclients')

            ->order(['Factureclients.id' => 'DESC']);

        $this->paginate = [
            'contain' => ['Clients', 'Depots', 'Users']
        ];
        $factureclients = $this->paginate($query);
        // debug($factureclients);
        $count = $query->count();
        ///debug($count);

        $this->loadModel('Personnels');


        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($chauffeurs);

        $chauffeurs = $this->fetchTable('Personnels')->find('all')
            ->where(['fonction_id' => 1]);

        //  debug($chauffeurs);die;
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id = 5"]);


        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);

        $clients = $this->Factureclients->Clients->find('all')->where(["Clients.etat" => 'TRUE']);

        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Factureclients->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);

        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;

        //debug($timbre);






        $this->set(compact(

            'reglee',
            'regle',
            'chauffeurs',
            'conffaieurs',
            'depots',
            'factureclients',
            'clients',
            'pointdeventes',
            'depotsoptions',
            'materieltransports',
            'cartecarburants',
            'timbre',
            'count',
            'datefin',
            'client_id',
            'numdeb',
            'numfin',
            'datedebut'
        ));
    }

    public function imprimeviewb($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');
        $connection = ConnectionManager::get('default');
        $lignefactureclient = $connection->execute("SELECT  * FROM lignefactureclients,lignebonlivraisons WHERE lignefactureclients.lignebonlivraison_id=lignebonlivraisons.id and  factureclient_id=" . $id . "  GROUP BY lignebonlivraisons.bonlivraison_id ;")->fetchAll('assoc');
        /// var_dump($lignefactureclient);
        $unitearticles = $this->fetchTable('Unitearticles')->find('all', ['keyfield' => 'id', 'valueField' => 'name']);
        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;
        $this->set(compact('id',  'unitearticles', 'timbre', 'factureclient', 'lignefactureclient'));
    }

    /**
     * View method
     *
     * @param string|null $id Factureclient id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');

        $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
            'contain' => ['Commandes']
        ])
            ->where(['Bonlivraisons.id = ' . $factureclient->bonlivraison_id . '   ']);



        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->fetchTable('Clients')->find('all', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

                if ($art->Code != null) {
                    return  $art->Code . ' -- ' . $art->Raison_Sociale;
                } else {
                    return  $art->Raison_Sociale;
                }
            }
        ]);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        // $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        // 'MAX(Timbres.timbre)'])->first();
        // $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.famille_id=1"]);





        ////////////////////////////////////////////////////////////////

        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, [
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

        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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
        $BL = $clientc->bl;

        ////////////////////////////////////
        $clientid = $factureclient->client_id;


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
        $tim = $this->fetchTable('Timbres')->find('list', ['keyfield' => 'id', 'valueField' => 'timbre'])

            ->where(['Timbres.id' => $factureclient->timbre_id])
            ->toArray();


        /***************************bloc info client******************************************* */

        $clientid = $factureclient->client_id;
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
            ->where(["Adresselivraisonclients.client_id = " . $factureclient->client_id . ""])->first();
        $adresse = $adresses->adresse;
        /********************************************************************** */
        $this->set(compact('BL', 'adresse', 'typeclientid', 'lignebloc', 'typeclientname', 'bonlivraison', 'tim', 'remcli', 'echanciere', 'echancierebl', 'solde', 'encours', 'remes', 'not', 'gs',  'cl', 'es', 'rz', 'exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'clientc', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function viewf($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');

        $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
            'contain' => ['Commandes']
        ])
            ->where(['Bonlivraisons.id = ' . $factureclient->bonlivraison_id . '   ']);


        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->fetchTable('Clients')->find('all', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

                if ($art->Code != null) {
                    return  $art->Code . ' -- ' . $art->Raison_Sociale;
                } else {
                    return  $art->Raison_Sociale;
                }
            }
        ]);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        // $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        // 'MAX(Timbres.timbre)'])->first();
        // $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.famille_id=1"]);





        ////////////////////////////////////////////////////////////////

        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, [
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

        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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
        $BL = $clientc->bl;

        ////////////////////////////////////
        $clientid = $factureclient->client_id;


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
        $tim = $this->fetchTable('Timbres')->find('list', ['keyfield' => 'id', 'valueField' => 'timbre'])

            ->where(['Timbres.id' => $factureclient->timbre_id])
            ->toArray();

        /***************************bloc info client******************************************* */

        $clientid = $factureclient->client_id;
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
            ->where(["Adresselivraisonclients.client_id = " . $factureclient->client_id . ""])->first();
        $adresse = $adresses->adresse;
        /********************************************************************** */


        $this->set(compact('BL', 'lignebloc', 'typeclientid', 'typeclientname', 'adresse', 'tim', 'bonlivraison', 'remcli', 'echanciere', 'echancierebl', 'solde', 'encours', 'remes', 'not', 'gs',  'cl', 'es', 'rz', 'exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'clientc', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function viewf1710($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');

        $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
            'contain' => ['Commandes']
        ])
            ->where(['Bonlivraisons.id = ' . $factureclient->bonlivraison_id . '   ']);


        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());
            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {



                $this->misejour("Factureclients", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);

                        if ($l['sup'] != 1) {
                            $tab['bonlivraison_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];
                            //$tab['qtestock'] = $l['qteStock'];
                            $tab['prixht'] = $l['prix'];
                            $tab['remise'] = $l['remiseligne'];
                            //$tab['punht'] = $l['punht'];

                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];

                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };

                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            //  debug($lignefactureclient);

                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);

                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }









                // $this->Flash->success(__('The {0} has been saved.', 'facture'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->fetchTable('Clients')->find('all', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

                if ($art->Code != null) {
                    return  $art->Code . ' -- ' . $art->Raison_Sociale;
                } else {
                    return  $art->Raison_Sociale;
                }
            }
        ]);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.famille_id=1"]);





        ////////////////////////////////////////////////////////////////

        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, [
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

        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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
        $BL = $clientc->bl;

        ////////////////////////////////////
        $clientid = $factureclient->client_id;


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

        $this->set(compact('BL', 'bonlivraison', 'remcli', 'echanciere', 'echancierebl', 'solde', 'encours', 'remes', 'not', 'gs',  'cl', 'es', 'rz', 'exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'clientc', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }

    public function editf($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');

        $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
            'contain' => ['Commandes']
        ])
            ->where(['Bonlivraisons.id = ' . $factureclient->bonlivraison_id . '   ']);

        $result = $this->request->getAttribute('authentication')->getIdentity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());
            //  $data['user_id'] = $result['id'];

            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {



                $this->misejour("Factureclients", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);

                        if ($l['sup'] != 1 && (!empty($l['article_idd']))) {
                            $tab['factureclient_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_idd'];
                            $tab['ml'] = $l['ml'];
                            $tab['puttc'] = $l['puttc'];

                            $tab['qtestock'] = $l['qteStock'];

                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['prix'];
                            $tab['prixht'] = $l['ht'];

                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];

                            $tab['puttc'] = $l['puttc'];
                            $tab['puttcapr'] = $l['puttcapr'];
                            $tab['ttchidden'] = $l['ttchidden'];






                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };

                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            //  debug($lignefactureclient);

                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);

                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }









                // $this->Flash->success(__('The {0} has been saved.', 'facture'));

                if ($this->request->getData('action') === 'saveAndImprime') {
                    return $this->redirect(['controller' => 'Factureclients', 'action' => 'imprimeviewsmbm/' . $factureclient['id']]);
                } else if ($this->request->getData('action') === 'saveAndImprimepdf') {
                    return $this->redirect(['controller' => 'Factureclients', 'action' => 'imprimeviewf/' . $factureclient['id']]);
                } else {
                    return $this->redirect(['action' => 'indexf/2']);
                }
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->fetchTable('Clients')->find('all', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

                if ($art->Code != null) {
                    return  $art->Code . ' -- ' . $art->Raison_Sociale;
                } else {
                    return  $art->Raison_Sociale;
                }
            }
        ]);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        // $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        // 'MAX(Timbres.timbre)'])->first();
        // $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('all');





        ////////////////////////////////////////////////////////////////

        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, [
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

        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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
        $BL = $clientc->bl;
        $clientid = $factureclient->client_id;

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
        $tim = $this->fetchTable('Timbres')->find('list', ['keyfield' => 'id', 'valueField' => 'timbre'])

            ->where(['Timbres.id' => $factureclient->timbre_id])
            ->toArray();

        // Debug pour vérifier les données récupérées
        // debug($tim);

        // $timbre_max = $tim->timbre_id;
        // $timbre_id = $tim->id;

        /***************************bloc info client******************************************* */

        $clientid = $factureclient->client_id;
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
            ->where(["Adresselivraisonclients.client_id = " . $factureclient->client_id . ""])->first();
        $adresse = $adresses->adresse;
        /********************************************************************** */
        $this->set(compact('BL', 'tim', 'adresse', 'typeclientname', 'typeclientid', 'lignebloc', 'bonlivraison', 'encours', 'echanciere', 'solde', 'echancierebl', 'remcli', 'remes', 'not', 'gs',  'cl', 'es', 'rz', 'exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'clientc', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Factureclient id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit03122024($id = null)
    {
        $factureclient = $this->Factureclients->get($id, [
            'contain' => ['Clients', 'Depots', 'Adresselivraisonclients'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');

        $bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
            'contain' => ['Commandes']
        ])
            ->where(['Bonlivraisons.id = ' . $factureclient->bonlivraison_id . '   ']);

        $result = $this->request->getAttribute('authentication')->getIdentity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            //debug($this->request->getData());
            //  $data['user_id'] = $result['id'];

            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {



                $this->misejour("Factureclients", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);

                        if ($l['sup'] != 1 && (!empty($l['article_id']))) {
                            $tab['factureclient_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['ml'] = $l['ml'];
                            $tab['puttc'] = $l['puttc'];

                            $tab['qtestock'] = $l['qteStock'];

                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['prix'];
                            $tab['prixht'] = $l['ht'];

                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];








                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };

                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            //  debug($lignefactureclient);

                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);

                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }









                // $this->Flash->success(__('The {0} has been saved.', 'facture'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->fetchTable('Clients')->find('all', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

                if ($art->Code != null) {
                    return  $art->Code . ' -- ' . $art->Raison_Sociale;
                } else {
                    return  $art->Raison_Sociale;
                }
            }
        ]);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        'MAX(Timbres.timbre)'])->first();
        $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('all');





        ////////////////////////////////////////////////////////////////

        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, [
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

        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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
        $BL = $clientc->bl;
        $clientid = $factureclient->client_id;

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
        $this->set(compact('BL', 'bonlivraison', 'encours', 'echanciere', 'solde', 'echancierebl', 'remcli', 'remes', 'not', 'gs',  'cl', 'es', 'rz', 'exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'clientc', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }

    public function edit($id = null)
    {
        // debug($id);die;
        $factureclient = $this->fetchTable('Factureclients')->get($id, [
            'contain' => ['Clients', 'Depots'],
        ]);
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');

        /*$bonlivraison = $this->fetchTable('Bonlivraisons')->find('all', [
            'contain' => ['Commandes']
        ])
            ->where(['Bonlivraisons.id = ' . $factureclient->bonlivraison_id . '   ']);*/
        // debug($bonlivraison->toarray());

        $result = $this->request->getAttribute('authentication')->getIdentity();

        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());die;
            //  $data['user_id'] = $result['id'];

            $factureclient = $this->Factureclients->patchEntity($factureclient, $this->request->getData());
            if ($this->Factureclients->save($factureclient)) {

                /*****  mis ajout id client dans BL*******/
                $bonlivraisonlist = $this->fetchTable('Bonlivraisons')->find('all', [
                    'contain' => ['Commandes']
                ])
                    ->where(['Bonlivraisons.factureclient_id' => $factureclient->id]);

                foreach ($bonlivraisonlist as $bonlivraison) {
                    if ($factureclient->client_id) {
                        $bonlivraison->nomprenom = $factureclient->nomprenom;
                        $bonlivraison->numeroidentite = $factureclient->numeroidentite;
                        $bonlivraison->adressediv = $factureclient->adressediv;
                    }

                    $bonlivraison->client_id = $factureclient->client_id;
                    $this->fetchTable('Bonlivraisons')->save($bonlivraison);
                }

                /*******************mis ajout id client dans reg********************* */

                // $blreglements = $this->fetchTable('Lignereglementclients')->find('all', [
                //     'contain' => ['Commandes']
                // ])
                //     ->where(['Lignereglementclients.bonlivraison_id' => $factureclient->bonlivraison_id]);

                // foreach ($bonlivraisonlist as $bonlivraison) {
                //     $bonlivraison->client_id = $factureclient->client_id;
                //     $this->fetchTable('Bonlivraisons')->save($bonlivraison);
                // }
                /***************************************************************************/
                $this->misejour("Factureclients", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //  debug($l);

                        if ($l['sup'] != 1 && (!empty($l['article_idd']))) {
                            $tab['factureclient_id'] = $id;
                            $tab['qte'] = $l['qte'];
                            $tab['article_id'] = $l['article_idd'];
                            $tab['ml'] = $l['ml'];
                            $tab['puttc'] = $l['puttc'];

                            $tab['qtestock'] = $l['qteStock'];

                            $tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['prix'];
                            $tab['prixht'] = $l['ht'];

                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];

                            $tab['puttc'] = $l['puttc'];
                            $tab['puttcapr'] = $l['puttcapr'];
                            $tab['ttchidden'] = $l['ttchidden'];






                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignefactureclient = $this->fetchTable('Lignefactureclients')->newEmptyEntity();
                            };

                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->patchEntity($lignefactureclient, $tab);
                            //  debug($lignefactureclient);

                            $this->fetchTable('Lignefactureclients')->save($lignefactureclient);
                        } else if (isset($l['id']) && (!empty($l['id']))) {

                            //S  $this->request->allowMethod(['post', 'delete']);
                            $lignefactureclient = $this->fetchTable('Lignefactureclients')->get($l['id']);

                            $this->fetchTable('Lignefactureclients')->delete($lignefactureclient);
                        }
                    }
                }









                // $this->Flash->success(__('The {0} has been saved.', 'facture'));

                if ($this->request->getData('action') === 'saveAndImprime') {
                    return $this->redirect(['controller' => 'Factureclients', 'action' => 'imprimeviewsmbm/' . $factureclient['id']]);
                } else if ($this->request->getData('action') === 'saveAndImprimepdf') {
                    return $this->redirect(['controller' => 'Factureclients', 'action' => 'imprimeview/' . $factureclient['id']]);
                } else {
                    return $this->redirect(['action' => 'index']);
                }
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'facture'));
        }
        $lignefactureclient = $this->Factureclients->Lignefactureclients->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['factureclient_id' => $id]);


        /* foreach($lignebonlivraisons as $l){
          debug($l);} */












        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->fetchTable('Clients')->find('all', [
            'keyField' => 'id',
            'valueField' =>  function ($art) {

                if ($art->Code != null) {
                    return  $art->Code . ' -- ' . $art->Raison_Sociale;
                } else {
                    return  $art->Raison_Sociale;
                }
            }
        ]);

        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        //debug($clients);
        $pointdeventes = $this->Factureclients->Pointdeventes->find('list', ['limit' => 200]);
        $depots = $this->Factureclients->Depots->find('list', ['limit' => 200]);
        $materieltransports = $this->Factureclients->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Factureclients->Cartecarburants->find('list', ['limit' => 200]);
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list', ['limit' => 200]);
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list', ['limit' => 200]);

        $client_id = $factureclient->client_id;


        // $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
        // 'MAX(Timbres.timbre)'])->first();
        // $timbre = $tim->timbre;


        $adresselivraisonclients = $this->Factureclients->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);;
        $articles = $this->fetchTable('Articles')->find('all');





        ////////////////////////////////////////////////////////////////

        $clientc = $this->fetchTable('Clients')->get($factureclient->client_id, [
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

        $time = $factureclient->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        $cond3 = "Clientexonerations.client_id = '" . $factureclient->client_id . "' ";


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
        $BL = $clientc->bl;
        $clientid = $factureclient->client_id;


        /******************reglement ************** */
        $this->loadModel('Lignereglementclients');
        $lignereglements = $this->Lignereglementclients->find()->where(['Lignereglementclients.factureclient_id' => $id]);

        $lignereglementcmds = [];
        if ($factureclient->id != 0) {
            $lignereglementcmds = $this->Lignereglementclients->find()->where(['Lignereglementclients.factureclient_id' => $factureclient->id]);
        }
        /****************************************** */


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

        $tim = $this->fetchTable('Timbres')->find('list', ['keyfield' => 'id', 'valueField' => 'timbre'])

            ->where(['Timbres.id' => $factureclient->timbre_id])
            ->toArray();



        /***************************bloc info client******************************************* */

        $clientid = $factureclient->client_id;
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
            ->where(["Adresselivraisonclients.client_id = " . $factureclient->client_id . ""])->first();
        $adresse = $adresses->adresse;
        /********************************************************************** */
        $this->set(compact('BL', 'adresse', 'typeclientid', 'lignebloc', 'typeclientname', 'bonlivraison', 'tim', 'lignereglements', 'lignereglementclient', 'encours', 'echanciere', 'solde', 'echancierebl', 'remcli', 'remes', 'not', 'gs',  'cl', 'es', 'rz', 'exotimbre', 'exofodec', 'exotpe', 'exotva', 'timbre', 'clientc', 'factureclient', 'articles', 'lignefactureclient', 'clients', 'pointdeventes', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);


        $this->loadModel('Bonlivraisons');
        // $query = $this->fetchTable('Bonlivraisons')->find('all')
        //     ->where(['factureclient_id' => $id]);
        $bonlivraison = $this->Bonlivraisons->find('all')->where(['factureclient_id' => $id]);


        /// debug($bonlivraison);

        //debug($bonlivraison);

        // if(isset($bonlivraison)&& !empty($bonlivraison) )
        // {
        // $bonlivraison->factureclient_id = 0;
        // $this->Bonlivraisons->save($bonlivraison);
        // }
        foreach ($bonlivraison as $bl) {


            $bonliv = $this->Bonlivraisons->get($bl['id'], [
                'contain' => [],
            ]);

            $bonliv->factureclient_id = 0;
            $this->fetchTable('Bonlivraisons')->save($bonliv);

            //// debug($bonliv);

        }




        $factureclient = $this->Factureclients->get($id);


        $this->loadModel('Lignefactureclients');

        $lignefactureclients = $this->fetchTable('Lignefactureclients')->find('all')
            ->where(['Lignefactureclients.factureclient_id=' . $id]);
        foreach ($lignefactureclients as $l) {
            $this->Lignefactureclients->delete($l);
        }




        if ($this->Factureclients->delete($factureclient)) {


            $this->misejour("Factureclients", "delete", $id);

            //  $this->Flash->success(__('The {0} has been deleted.', 'facture client'));
        } else {
            //  $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'facture client'));
        }

        return $this->redirect(['action' => 'index/1']);
    }
    public function deletef($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);


        $this->loadModel('Bonlivraisons');
        // $query = $this->fetchTable('Bonlivraisons')->find('all')
        //     ->where(['factureclient_id' => $id]);
        $bonlivraison = $this->Bonlivraisons->find('all')->where(['factureclient_id' => $id]);


        /// debug($bonlivraison);

        //debug($bonlivraison);

        // if(isset($bonlivraison)&& !empty($bonlivraison) )
        // {
        // $bonlivraison->factureclient_id = 0;
        // $this->Bonlivraisons->save($bonlivraison);
        // }
        if ($bonlivraison) {
            foreach ($bonlivraison as $bl) {


                $bonliv = $this->Bonlivraisons->get($bl['id'], [
                    'contain' => [],
                ]);

                $bonliv->factureclient_id = 0;
                $this->fetchTable('Bonlivraisons')->save($bonliv);

                //// debug($bonliv);

            }
        }

        $factureclient = $this->Factureclients->get($id);


        $this->loadModel('Lignefactureclients');

        $lignefactureclients = $this->fetchTable('Lignefactureclients')->find('all')
            ->where(['Lignefactureclients.factureclient_id=' . $id]);
        foreach ($lignefactureclients as $l) {
            $this->Lignefactureclients->delete($l);
        }




        if ($this->Factureclients->delete($factureclient)) {


            $this->misejour("Factureclients", "delete", $id);

            //  $this->Flash->success(__('The {0} has been deleted.', 'facture client'));
        } else {
            //  $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'facture client'));
        }

        return $this->redirect(['action' => 'indexf/2']);
    }
}
