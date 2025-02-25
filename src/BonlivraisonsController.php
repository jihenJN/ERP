<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;
use Cake\ORM\TableRegistry;

/**
 * Bonlivraisons Controller
 *
 * @property \App\Model\Table\BonlivraisonsTable $Bonlivraisons
 * @method \App\Model\Entity\Bonlivraison[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class BonlivraisonsController extends AppController

{


    public function imprimerview()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Caisses');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Depenses');
        $caisse_id = $this->request->getQuery('caisse_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $clientData = [];
        $clientNames = [];
        $clientDates = [];
        $conditions = [];
        if ($historiquede) {
            $conditions[] = ["Reglementclients.date >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditions[] = ["Reglementclients.date <='" . $au . "'"];
        }
        $conditionsdepense = [];
        if ($historiquede) {
            $conditionsdepense[] = ["Depenses.date >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsdepense[] = ["Depenses.date <='" . $au . "'"];
        }
        $conditionstransfert = [];
        if ($historiquede) {
            $conditionstransfert[] = ["Transferecaisses.date >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionstransfert[] = ["Transferecaisses.date <='" . $au . "'"];
        }
        if ($caisse_id !== null) {
            // ************************** Pour Calcul total Debit/credit sans periode***************************************//
            $reglementstot = $this->Piecereglementclients->find()->select(['montant', 'reglementclient_id', 'paiement_id', 'num'])->where(['caisse_id' => $caisse_id])->all();
            $depensestot  = $this->Depenses->find()->where(['caisse_id' => $caisse_id])->all();
            $transfertdepartstot  = $this->fetchTable('Transferecaisses')->find()->where(['caisse_id' => $caisse_id])->all();
            $transfertarrivestot  =  $this->fetchTable('Transferecaisses')->find()->where(['id_caisse' => $caisse_id])->all();
            $thiscaisse = $this->Caisses->find()->where('Caisses.id=' . $caisse_id)->first();
            $credit_all = $thiscaisse->montant;
            $debit_all = 0;
            foreach ($reglementstot as $reglement) {
                $reglement_id = $reglement->reglementclient_id;
                $reglementclient = [];
                $lignereg = [];
                $numeroBon = [];
                if ($reglement_id != null) {
                    $reglementclient = $this->Reglementclients->find()->select(['client_id', 'Date', 'numeroconca'])->where(['id' => $reglement_id])->first();
                    $lignereg = $this->Lignereglementclients->find()->select(['Montant', 'bonlivraison_id', 'commande_id'])->where(['Lignereglementclients.reglementclient_id' => $reglement_id])->first();
                    $numeroBon = $this->Bonlivraisons->find()->select(['numero'])->where(['id' => $lignereg->bonlivraison_id])->first();
                }
                if ($reglementclient) {
                    $credit_all += $reglement->montant;
                }
            }
            foreach ($depensestot as $depense) {
                $debit_all += $depense->montant;
            }
            foreach ($transfertdepartstot as $transfertdepart) {
                $debit_all += $transfertdepart->montant;
            }
            foreach ($transfertarrivestot as $transfertarrive) {
                $credit_all += $transfertarrive->montant;
            }
            // *****************************************************************//
            $reglements = $this->Piecereglementclients->find()->select(['montant', 'reglementclient_id', 'paiement_id', 'num'])->where(['caisse_id' => $caisse_id])->all();
            // debug($reglements);
            $depenses = $this->Depenses->find()->where(['caisse_id' => $caisse_id, $conditionsdepense])->all();
            $transfertdeparts = $this->fetchTable('Transferecaisses')->find()->where(['caisse_id' => $caisse_id, $conditionstransfert])->all();
            $transfertarrives =  $this->fetchTable('Transferecaisses')->find()->where(['id_caisse' => $caisse_id, $conditionstransfert])->all();
            $thiscaisse = $this->Caisses->find()->where('Caisses.id=' . $caisse_id)->first();
            $clientData[] = [
                'type' => '<strong>Solde initial</strong>',
                'credit' => $thiscaisse->montant,
                'index' => '1',
            ];
            foreach ($reglements as $reglement) {
                $reglement_id = $reglement->reglementclient_id;
                $paiement_id = $reglement->paiement_id;
                $reglementclient = [];
                $lignereg = [];
                $numeroBon = [];
                if ($reglement_id != null) {
                    $reglementclient = $this->Reglementclients->find()->select(['client_id', 'Date', 'numeroconca'])->where(['id' => $reglement_id, $conditions])->first();
                    $lignereg = $this->Lignereglementclients->find()->select(['Montant', 'bonlivraison_id', 'commande_id'])->where(['Lignereglementclients.reglementclient_id' => $reglement_id])->first();
                    $numeroBon = $this->Bonlivraisons->find()->select(['numero'])->where(['id' => $lignereg->bonlivraison_id])->first();
                }
                if ($reglementclient) {
                    $client = $this->Clients->find()->select(['Raison_Sociale'])->where(['id' => $reglementclient->client_id])->first();
                }
                $paiement = $this->Paiements->find()->select(['name'])->where(['id' => $paiement_id])->first();
                if ($lignereg && isset($client->Raison_Sociale) && $reglementclient && $reglementclient->Date) {
                    // debug($lignereg);
                    if ($lignereg->bonlivraison_id != null) {
                        $bl = $this->fetchTable('Bonlivraisons')->find()->where(['id' => $lignereg->bonlivraison_id])->first();
                    }
                    if ($lignereg->commande_id != null) {
                        $cmd = $this->fetchTable('Commandes')->find()->where(['id' => $lignereg->commande_id])->first();
                    }
                    $clientData[] = [
                        'cmd' =>  $cmd->numero,
                        'bl' => $bl->numero,
                        'name' => $client->Raison_Sociale,
                        'date' => $reglementclient->Date->format('Y-m-d'),
                        'paiement_name' => $paiement->name,
                        'credit' => $reglement->montant,
                        'num' => $reglementclient->numeroconca,
                        'type' => 'Réglement',
                        'index' => '2',
                    ];
                }
            }
            foreach ($depenses as $depense) {
                // debug($depense);
                $paiement = $this->Paiements->find()->select(['name'])->where(['id' => $depense->paiement_id])->first();
                $caissedepart = $this->fetchTable('Caisses')->find()->where(['id' => $depense->caisse_id])->first();
                $clientData[] = [
                    'caissedep' => $caissedepart->name,
                    'name' => '',
                    'date' => $depense->date,
                    'paiement_name' => $paiement->name,
                    'debit' => $depense->montant,
                    'num' => $depense->numero,
                    'type' => 'Dépense',
                    'index' => '3',
                ];
            }
            foreach ($transfertdeparts as $transfertdepart) {
                //  debug($transfertdepart);
                $caissedepart = $this->fetchTable('Caisses')->find()->where(['id' => $transfertdepart->caisse_id])->first();
                $caissearrive = $this->fetchTable('Caisses')->find()->where(['id' => $transfertdepart->id_caisse])->first();
                $clientData[] = [
                    'caissedep' => $caissedepart->name,
                    'caissearr' => $caissearrive->name,
                    'name' => '',
                    'date' => $transfertdepart->date,
                    // 'paiement_name' => $paiement->name,
                    'debit' => $transfertdepart->montant,
                    'num' => $transfertdepart->numero,
                    'type' => 'Transfert caisse/caisse',
                    'index' => '4',
                ];
            }
            foreach ($transfertarrives as $transfertarrive) {
                // debug($depense);
                $caissedepart = $this->fetchTable('Caisses')->find()->where(['id' => $transfertarrive->caisse_id])->first();
                $caissearrive = $this->fetchTable('Caisses')->find()->where(['id' => $transfertarrive->id_caisse])->first();
                $clientData[] = [
                    'caissedep' => $caissedepart->name,
                    'caissearr' => $caissearrive->name,
                    'name' => '',
                    'date' => $transfertarrive->date,
                    // 'paiement_name' => $paiement->name,
                    'credit' => $transfertarrive->montant,
                    'num' => $transfertarrive->numero,
                    'type' => 'Transfert caisse/caisse',
                    'index' => '5',
                ];
            }
        }
        $caisses = $this->Caisses->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $this->set(compact('caisses', 'caisse_id', 'clientData', 'credit_all', 'debit_all', 'thiscaisse'));
    }

    public function imprimelistebl($id = null)
    {
        $client = $this->request->getQuery('client_id');
        $commercial = $this->request->getQuery('commercial_id');
        $historiquede = $this->request->getQuery('historiquede');
        $article = $this->request->getQuery('article_id');
        // debug($historiquede);
        $au = $this->request->getQuery('au');
        // debug($au);
        $conditions = [];

        if ($client) {
            $bonlivraisons = $this->fetchTable('Bonlivraisons')->find('all')->where(['Bonlivraisons.client_id' => $client]);
            $detlp = [];
            foreach ($bonlivraisons as $bon) {
                $detlp[] = "'" . $bon->id . "'";
            }
            $conditions[] = ['Bonlivraisons.id IN (' . implode(',', $detlp) . ')'];
        }
        if ($commercial) {
            $bonlivraisons = $this->fetchTable('Bonlivraisons')->find('all')->where(['Bonlivraisons.commercial_id' => $commercial]);
            $detlp = [];
            foreach ($bonlivraisons as $bon) {
                $detlp[] = "'" . $bon->id . "'";
            }
            $conditions[] = ['Bonlivraisons.id IN (' . implode(',', $detlp) . ')'];
        }
        if ($historiquede) {
            $conditions[] = ["Bonlivraisons.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Bonlivraisons.date <='" . $au . " 23:59:59' "];
        }
        if ($article) {
            $subquery = $this->fetchTable('Lignebonlivraisons')
                ->find('list', [
                    'keyField' => 'bonlivraison_id',
                    'valueField' => 'bonlivraison_id'
                ])
                ->where(['Lignebonlivraisons.article_id' => $article]);
            $conditions[] = ['Bonlivraisons.id IN' => $subquery];
        }

        $condtype = 'Bonlivraisons.typebl = 1';
        $query = $this->Bonlivraisons->find('all')->where([$condtype, $conditions])->order(['Bonlivraisons.id' => 'DESC']);
        $this->paginate = [
            'contain' => [],
        ];
        $bonlivraison = $this->paginate($query);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $commercials = $this->fetchTable('Commercials')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('article', 'client', 'historiquede', 'au', 'bonlivraison', 'clients', 'commercial', 'commercials'));
    }

    public function imprimeofprix($id = null)
    {
        $client = $this->request->getQuery('client_id');
        $commercial = $this->request->getQuery('commercial_id');
        $historiquede = $this->request->getQuery('historiquede');
        $article = $this->request->getQuery('article_id');
        // debug($historiquede);
        $au = $this->request->getQuery('au');
        // debug($au);
        $conditions = [];

        if ($client) {
            $bonlivraisons = $this->fetchTable('Bonlivraisons')->find('all')->where(['Bonlivraisons.client_id' => $client]);
            $detlp = [];
            foreach ($bonlivraisons as $bon) {
                $detlp[] = "'" . $bon->id . "'";
            }
            $conditions[] = ['Bonlivraisons.id IN (' . implode(',', $detlp) . ')'];
        }
        if ($commercial) {
            $bonlivraisons = $this->fetchTable('Bonlivraisons')->find('all')->where(['Bonlivraisons.commercial_id' => $commercial]);
            $detlp = [];
            foreach ($bonlivraisons as $bon) {
                $detlp[] = "'" . $bon->id . "'";
            }
            $conditions[] = ['Bonlivraisons.id IN (' . implode(',', $detlp) . ')'];
        }
        if ($historiquede) {
            $conditions[] = ["Bonlivraisons.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Bonlivraisons.date <='" . $au . " 23:59:59' "];
        }
        if ($article) {
            $subquery = $this->fetchTable('Lignebonlivraisons')
                ->find('list', [
                    'keyField' => 'bonlivraison_id',
                    'valueField' => 'bonlivraison_id'
                ])
                ->where(['Lignebonlivraisons.article_id' => $article]);
            $conditions[] = ['Bonlivraisons.id IN' => $subquery];
        }
        $condtype = 'Bonlivraisons.typebl = 2';
        $query = $this->Bonlivraisons->find('all')->where([$condtype, $conditions])->order(['Bonlivraisons.id' => 'DESC']);
        $this->paginate = [
            'contain' => [],
        ];
        $bonlivraison = $this->paginate($query);
        $clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'code']);
        $commercials = $this->fetchTable('Commercials')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('article', 'client', 'historiquede', 'au', 'bonlivraison', 'clients', 'commercial', 'commercials'));
    }

    public function listeoffreprix()
    {
        $this->loadModel('Clients');
        $this->loadModel('Commercials');
        $this->loadModel('Articles');
        $client_id = $this->request->getQuery('client_id');
        $commercial_id = $this->request->getQuery('commercial_id');
        $article_id = $this->request->getQuery('article_id');
        $article = $this->request->getQuery('article_id');
        $historiquede = $this->request->getQuery('historiquede');
        // debug($historiquede);   
        $au = $this->request->getQuery('au');
        // debug($au);
        $conditions = [];
        if ($historiquede) {
            $conditions[] = ["Bonlivraisons.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Bonlivraisons.date <='" . $au . " 23:59:59' "];
        }
        if ($client_id) {
            $conditions[] = ["Bonlivraisons.client_id = '" . $client_id . "' "];
        }
        if ($commercial_id) {
            $conditions[] = ["Bonlivraisons.commercial_id = '" . $commercial_id . "' "];
        }
        if ($article) {
            $subquery = $this->fetchTable('Lignebonlivraisons')
                ->find('list', [
                    'keyField' => 'bonlivraison_id',
                    'valueField' => 'bonlivraison_id'
                ])
                ->where(['Lignebonlivraisons.article_id' => $article]);
            $conditions[] = ['Bonlivraisons.id IN' => $subquery];
        }
        $conditions[] = ["Bonlivraisons.typebl" => 2];
        $offprix1 = $this->fetchTable('Bonlivraisons')->find('all')->where(['typebl' => 2, $conditions])->contain(['Clients', 'Commercials'])->ToArray();
        // debug($offprix1->ToArray());
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
        $articles = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('article', 'clients', 'client_id', 'commercials', 'commercial_id', 'article_id', 'articles', 'offprix1', 'historiquede', 'au'));
    }
    public function listebl()
    {
        $this->loadModel('Clients');
        $this->loadModel('Commercials');
        $this->loadModel('Articles');
        $client_id = $this->request->getQuery('client_id');
        $commercial_id = $this->request->getQuery('commercial_id');
        $article_id = $this->request->getQuery('article_id');
        $historiquede = $this->request->getQuery('historiquede');
        $article = $this->request->getQuery('article_id');
        // debug($historiquede);   
        $au = $this->request->getQuery('au');
        // debug($au);
        $conditions = [];
        if ($historiquede) {
            $conditions[] = ["Bonlivraisons.date >= '" . $historiquede . " 00:00:00'"];
        }
        if ($au) {
            $conditions[] = ["Bonlivraisons.date <='" . $au . " 23:59:59' "];
        }
        if ($client_id) {
            $conditions[] = ["Bonlivraisons.client_id = '" . $client_id . "' "];
        }
        if ($commercial_id) {
            $conditions[] = ["Bonlivraisons.commercial_id = '" . $commercial_id . "' "];
        }

        if ($article) {
            $subquery = $this->fetchTable('Lignebonlivraisons')
                ->find('list', [
                    'keyField' => 'bonlivraison_id',
                    'valueField' => 'bonlivraison_id'
                ])
                ->where(['Lignebonlivraisons.article_id' => $article]);
            $conditions[] = ['Bonlivraisons.id IN' => $subquery];
        }
        $conditions[] = ["Bonlivraisons.typebl" => 1];
        $offprix1 = $this->fetchTable('Bonlivraisons')->find('all')->where(['typebl' => 1, $conditions])->contain(['Clients', 'Commercials'])->ToArray();
        // debug($offprix1->ToArray());
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
        $articles = $this->Articles->find('list', ['keyField' => 'id', 'valueField' => 'Dsignation']);
        $this->set(compact('article_id', 'clients', 'client_id', 'commercials', 'commercial_id', 'article_id', 'articles', 'offprix1', 'historiquede', 'au'));
    }

    public function imprimeviewbyfamille($id = null)
    {
        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');
        $bonlivraison = $this->Bonlivraisons->get($id, ['contain' => ['Clients', 'Depots'],]);
        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" => 'MAX(Bonusnouvclients.valeur)'])->first();
        // debug($num);
        $bonus = $valeur->valeur;
        $lignebonlivraisonsTable = TableRegistry::getTableLocator()->get('Lignebonlivraisons');
        $lignebonlivraisons = $lignebonlivraisonsTable->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id' => $id])
            ->select([
                'punht',

                'total_ml' => $lignebonlivraisonsTable->query()->func()->sum('Articles.ml*qte'),
                'sousfamille1_id' => 'Articles.sousfamille1_id'
            ])
            ->group(['Articles.sousfamille1_id']);
        // debug($lignebonlivraisons->toArray());
        $client_id = $bonlivraison->client_id;
        $type = $bonlivraison->typebl;
        $this->loadModel('Clients');
        $client = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $depots = $this->Bonlivraisons->Depots->find('list');
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
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
        $allclients = $this->fetchTable('Clients')->find('all')->order(['Clients.id' => 'DESC']);
        $dett1 = '' . $client_id;
        if ($client->client_id != 0) {
            $dett1 = $dett1 . ',' . $client->client_id;
            /*             * det nzid fiha id ancien client */
            $c = $this->fetchTable('Clients')->get($client->client_id);
            foreach ($allclients as $cli) {
                if ($cli->client_id == $c->id && $c->client_id != 0) {
                    $dett1 = $dett1 . ',' . $c->client_id;
                    $c = $this->fetchTable('Clients')->get($cli->client_id);
                    // debug($c);
                }
            }
        }
        $cond3 = 'Commandes.client_id in ( ' . $dett1 . ')';
        $comclient = $this->fetchTable('Commandes')->find('all')
            ->where([$cond3]);
        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $bonlivraison->commande_id]);
        foreach ($lignecommandes as $li) {
            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id]);
            $dett = '0';
            foreach ($ligness as $f) {
                $dett = $dett . ',' . $f->commande_id;
            }
            if ($dett != '') {
                $cond100 = 'Commandes.id in (' . $dett . ')';
            }
            $cond101 = 'Commandes.client_id in ( ' . $dett1 . ')';
            //   debug($dett);
            $coms = $this->fetchTable('Commandes')->find()
                ->select(["date" => 'Min(Commandes.date)'])
                ->where([$cond100, $cond101]);
            $d = '';
            foreach ($coms as $c) {
                $d = $c->date;
            }
            $time = new FrozenTime($d);
            $m = $time->i18nFormat('Y-MM-d');
            $aujourdhui = date("Y-m-d");
            $date1 = date("Y-m-d", strtotime($m . '+  2 days'));
            if ($aujourdhui > $date1) {
                //debug('hh');
                $coeff = 0;
            } else {
                //debug('kk');
                $coeff = $li->article->coefficient;
            }
            $tab[$li->article_id] = [
                'majarticle' => $coeff
            ];
        }
        $this->set(compact('exotpe', 'exotva', 'exofodec', 'exotimbre', 'bonus', 'type', 'client', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }

    public function addbonliv($id = null)
    {

        $commande = $this->fetchTable('Commandes')->get($id, [
            'contain' => [
                'Depots', 'Clients'
            ]
        ]);
        $this->loadModel('Clients');
        $this->loadModel('Articles');

        $client = $this->Clients->get($commande->client_id, [
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

        $lignes = $this->fetchTable('Lignecommandes')->find('all', ['contain' => ['Articles'],])
            ->where(['Lignecommandes.commande_id=' . $id]);

        $num = $this->Bonlivraisons->find()->select(["num" =>
        'MAX(Bonlivraisons.numero)'])->first();
        // debug($num);
        $n = $num->num;
        $in = intval($n) + 1;
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

        ///   debug($mm);



        $depots = $this->Bonlivraisons->Depots->find('all');
        $clients = $this->Bonlivraisons->Clients->find('all');
        $commercials = $this->Bonlivraisons->Commercials->find('all');
        $art = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        $articles = $this->Articles->find('all');
        $tvas = $this->fetchTable('Tvas')->find('all', []);


        $bonlivraison = $this->Bonlivraisons->newEmptyEntity();

        if ($this->request->is(['post'])) {



            $num = $this->Bonlivraisons->find()->select(["num" =>
            'MAX(Bonlivraisons.numero)'])->first();
            $n = $num->num;
            $in = intval($n) + 1;
            $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

            $data['numero'] = $mm;
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['typebl'] = '3';
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['totalht'] = $this->request->getData('totalht');
            // $data['totaltva'] = $this->request->getData('tva');
            // $data['totalfodec'] = $this->request->getData('totalfodec');
            // $data['totalremise'] = $this->request->getData('remise');
            // $data['totalttc'] = $this->request->getData('totalttc');
            $data['commande_id'] = $id;
            $data['observation'] = $this->request->getData('observation');



            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            /// debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {
                $this->misejour("Bonlivraisons", "add", $bonlivraison->id);
                $bonlivraison_id = $bonlivraison->id;



                $commande->etatliv = '1';
                $this->fetchTable('Commandes')->save($commande);

                /// debug($commande);


                if (isset($this->request->getData('data')['ligne']) && (!empty($this->request->getData('data')['ligne']))) {
                    //debug($this->request->getData('data')['ligne']);
                    foreach ($this->request->getData('data')['ligne'] as $i => $l) {
                        if ($l['sup'] != 1) {

                            $tab['bonlivraison_id'] = $bonlivraison_id;
                            $tab['qtestock'] = $l['qtestock'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            $tab['quantiteliv'] = $l['quantite'];
                            $tab['punht'] = $l['prix'];



                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);

                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                            /// debug($lignebonlivraison);

                        }
                    }
                }

                return $this->redirect(['action' => 'index/3']);
            }
        }




        $this->set(compact('bonlivraison', 'mm', 'commande', 'depots', 'clients', 'commercial', 'commercials', 'lignes', 'art', 'tvas', 'articles'));
    }


    public function deletebr($id = null)
    {
        // $this->request->allowMethod(['post', 'delete']);
        $bonlivraison = $this->Bonlivraisons->get($id);
        $type = $bonlivraison->typebl;
        $lignelivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [])
            ->where(['Lignebonlivraisons.bonlivraison_id=' . $id]);

        if ($type == 2) {
            if ($this->Bonlivraisons->delete($bonlivraison)) {
                $this->misejour("offredeprix", "delete", $id);
                foreach ($lignelivraisons as $l) {
                    $this->Bonlivraisons->Lignebonlivraisons->delete($l);
                }

                $integration = $this->fetchTable('Bonlivraisons')->find()->where('Bonlivraisons.id_offredeprix=' . $bonlivraison->id)->first();
                $integration->id_offredeprix = 0;
                $this->fetchTable('Bonlivraisons')->save($integration);
            } else {
            }
        } else {
            if ($this->Bonlivraisons->delete($bonlivraison)) {
                $this->misejour("Bonlivraisons", "delete", $id);
                foreach ($lignelivraisons as $l) {
                    $this->Bonlivraisons->Lignebonlivraisons->delete($l);
                }
            } else {
            }
        }



        return $this->redirect(['action' => 'index/' . $type]);
    }

    public function deletebrece($id = null)
    {

        $this->loadModel('Commandes');

        $this->request->allowMethod(['post', 'delete']);
        $bonlivraison = $this->Bonlivraisons->get($id);

        $commande = $this->fetchTable('Commandes')->find('all', ['contain' => [],])

            ->where(['Commandes.id=' . $bonlivraison->commande_id]);

        foreach ($commande as $key => $value) {

            $cmde = $this->Commandes->get($value['id'], [
                'contain' => [],
            ]);
            $cmde->etatliv = '0';
            $this->fetchTable('Commandes')->save($cmde);
        }

        ///        debug($cmde);



        $lignelivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [])
            ->where(['Lignebonlivraisons.bonlivraison_id=' . $id]);
        if ($this->Bonlivraisons->delete($bonlivraison)) {
            $this->misejour("Bonlivraisons", "delete", $id);
            foreach ($lignelivraisons as $l) {
                $this->Bonlivraisons->Lignebonlivraisons->delete($l);
            }
        } else {
        }

        return $this->redirect(['action' => 'index/3']);
    }

    ///////////
    public function add($type = null)
    {
        $num = $this->Bonlivraisons->find()->select(["num" =>
        'MAX(Bonlivraisons.numero)'])->first();
        // debug($num);
        $n = $num->num;
        // $int=intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {
            $num = $this->Bonlivraisons->find()->select(["num" =>
            'MAX(Bonlivraisons.numero)'])->first();
            // debug($num);
            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
            // debug($this->request->getData());
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['totalht'] = $this->request->getData('totalht');
            $data['totaltva'] = $this->request->getData('totaltva');
            $data['totalfodec'] = $this->request->getData('totalfodec');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['escompte'] = $this->request->getData('escompte');
            $data['escompte'] = $this->request->getData('tpecommande');
            $data['escompte'] = $this->request->getData('escompte');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['poste'] = $this->request->getData('poste');
            $data['bl'] = $this->request->getData('bl');
            $data['typebl'] = $type;



            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            ///debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {
                $this->misejour("Bonlivraisons", "add", $bonlivraison->id);
                $bonlivraison_id = $bonlivraison->id;
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //  debug($this->request->getData('data')['ligner']);
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        // debug($l);
                        if ($l['sup'] != 1) {
                            $tab['bonlivraison_id'] = $bonlivraison_id;
                            $tab['qte'] = $l['qteStock'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['quantiteliv'] = $l['qte'];
                            $tab['qte'] = $l['qte'];
                            // $tab['prixht'] = $l['prix'];
                            //$tab['remise'] = $l['remise'];
                            $tab['punht'] = $l['prix'];
                            // $tab['punht'] = $l['punht'];
                            $tab['tva'] = $l['tva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['tpe'] = $l['tpecommandeclient'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['montantht'] = $l['motanttotal'];
                            $tab['totalttc'] = $l['totalttc'];
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);

                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                            ///debug($lignebonlivraison);
                        }
                    }
                }
                //   $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));
                return $this->redirect(['action' => 'index/' . $type]);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $this->loadModel('Personnels');
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $depots = $this->Bonlivraisons->Depots->find('list');
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        $commercials = $this->Bonlivraisons->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $factureclients = $this->Bonlivraisons->Factureclients->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list');
        $articles = $this->fetchTable('Articles')->find('all');
        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;
        $this->set(compact('escompte', 'commercials', 'type', 'mm', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'factureclients', 'adresselivraisonclients'));
    }
    public function addexcl($type = null)
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Ligneexcs');
        $currentYear = date('y');
        $yearf = date('Y');
        $num = $this->Bonlivraisons->find()->select(["num" => 'MAX(Bonlivraisons.numero)'])->where('Bonlivraisons.typebl=4')
        ->where('YEAR(Bonlivraisons.date)=' . $yearf)->first();
        $n = $num->num;

        if ($n) {
            // Extract the last 4 digits from the existing serial number and increment by 1
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            // If no previous record found, start from 1111
            $in = '0001';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $mm = "IN{$currentYear}00{$mm}";



        $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {
            $currentYear = date('y');
        $yearf = date('Y');
        $num = $this->Bonlivraisons->find()->select(["num" => 'MAX(Bonlivraisons.numero)'])->where('Bonlivraisons.typebl=4')
        ->where('YEAR(Bonlivraisons.date)=' . $yearf)->first();
            $n = $num->num;

            if ($n) {
                // Extract the last 4 digits from the existing serial number and increment by 1
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                // If no previous record found, start from 1111
                $in = '0001';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $mm = "IN{$currentYear}00{$mm}";


            // debug($this->request->getData());
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['typebl'] = 4;
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $data['escompte'] = $this->request->getData('escompte');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['totalht'] = $this->request->getData('total');
            $data['totaltva'] = $this->request->getData('tvacommande');
            $data['totalfodec'] = $this->request->getData('fod');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['nbligne'] = $this->request->getData('nbligne');
            $data['Poids'] = $this->request->getData('Poids');
            $data['Coeff'] = $this->request->getData('Coeff');
            $data['pallette'] = $this->request->getData('pallette');
            $data['observation'] = $this->request->getData('observation');
            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            $bonlivraison->excel = 1;
            if ($this->Bonlivraisons->save($bonlivraison)) {
                $this->misejour("Bonlivraisons", "add", $bonlivraison->id);
                $bonlivraison_id = $bonlivraison->id;
                // debug($bonlivraison->excel);
                foreach ($this->request->getData('data')['ligneexcs'] as $i => $tar) {
                    if ($i != 0) {
                        $data['bonlivraison_id'] = $bonlivraison_id;
                        $data['N'] = $tar['N°'];
                        $data['REP'] = $tar['REP'];
                        $data['DESIGNATION'] = $tar['DESIGNATION'];
                        $data['TYPE'] = $tar['TYPE'];
                        $data['qte'] = $tar['Quantité'];
                        $data['Unite'] = $tar['Unité'];
                        $data['POIDS'] = $tar['POIDS'];
                        $data['PU'] = $tar['P.U.'];
                        $data['CODE'] = $tar['CODE'];
                        $data['ml'] = $tar['ml'];
                        // debug($tar);
                        // debug($data);
                        // $ligneexc = $this->fetchTable('Ligneexcs')->newEmptyEntity();
                        // $ligneexc = $this->fetchTable('Ligneexcs')->patchEntity($ligneexc, $data);

                        $ligneexc = $this->fetchTable('Ligneexcs')->newEmptyEntity();
                        $ligneexc = $this->fetchTable('Ligneexcs')->patchEntity($ligneexc, $data);
                        if ($this->Ligneexcs->save($ligneexc)) {
                        }
                    }
                }
                return $this->redirect(['action' => 'index/' . $type]);
            }
        }
        $this->loadModel('Personnels');
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $depots = $this->Bonlivraisons->Depots->find('list');
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        $commercials = $this->Bonlivraisons->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $factureclients = $this->Bonlivraisons->Factureclients->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list');
        $articles = $this->fetchTable('Articles')->find('all');
        $esCompte = $this->fetchTable('Societes')->find()->select(["escompte" =>
        'MAX(Societes.escompte)'])->first();
        $escompte = $esCompte->escompte;
        $this->set(compact('escompte', 'commercials', 'type', 'mm', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'factureclients', 'adresselivraisonclients'));
    }
    public function editxcl($id = null)
    {

        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Personnels');
        $this->loadModel('Commandes');
        $this->loadModel('Lignebonlivraisons');
        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients'],
        ]);
        $commercial = $this->fetchTable('Commercials')->get($bonlivraison->commercial_id);
        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
        'MAX(Bonusnouvclients.valeur)'])->first();
        $bonus = $valeur->valeur;

        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['totalht'] = $this->request->getData('totalht');
            $data['totaltva'] = $this->request->getData('totaltva');
            $data['totalfodec'] = $this->request->getData('totalfodec');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['escompte'] = $this->request->getData('escompte');
            $data['escompte'] = $this->request->getData('tpecommande');
            $data['escompte'] = $this->request->getData('escompte');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['poste'] = $this->request->getData('poste');
            $data['bl'] = $this->request->getData('bl');
            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            //debug($bonlivraison);
            $bonlivraison->excel = null;
            if ($this->Bonlivraisons->save($bonlivraison)) {
                $this->misejour("Bonlivraisons", "edit", $id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        $tab = [];
                        if ($l['sup'] != 1) {
                            $tab['bonlivraison_id'] = $bonlivraison->id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            $tab['ml'] = $l['ml'];

                            $tab['qtestock'] = $l['qteStock'];
                            $tab['punht'] = $l['prix'];
                            $tab['remise'] = $l['remiseligne'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['remise'] = $l['remise'];
                            $tab['fodec'] = $l['fodeccommandeclient'];
                            $tab['tva'] = $l['tva'];
                            $tab['prixht'] = $l['ht'];

                            $tab['ttc'] = $l['ttc'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];

                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();

                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);
                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                        } else if (!empty($l['id'])) {
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id']);
                            $this->fetchTable('Lignebonlivraisons')->delete($lignebonlivraison);
                        }
                    }
                }




                $ligneexcs = $this->fetchTable('Ligneexcs')->find('all')
                    ->where(['bonlivraison_id =' . $id]);

                foreach ($ligneexcs as $lex) {

                    $this->fetchTable('Ligneexcs')->delete($lex);
                }


                return $this->redirect(['action' => 'index/' . $bonlivraison['typebl']]);
            }
        }
        // $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
        //     'contain' => ['Articles']
        // ])
        //     ->where(['bonlivraison_id =' . $id]);
        $this->loadModel('Ligneexcs');
        $lignebonlivraisons = $this->fetchTable('Ligneexcs')->find('all')
            ->where(['bonlivraison_id =' . $id]);
        $client_id = $bonlivraison->client_id;
        $type = $bonlivraison->typebl;
        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $BL = $clientc->bl;
        $typecl = $clientc->typeclient->grandsurface;
        if ($typecl == 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }
        $escom = $clientc->typeescompte;
        if ($escom == TRUE) {
            $es = 'avec palier';
        }
        if ($escom == FALSE) {
            $es = 'sans palier';
        }
        $esremise = $clientc->typeremise;
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
        $date = $bonlivraison->date;
        $date = $date->i18nFormat('yyyy-MM-dd');
        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
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
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $depots = $this->Bonlivraisons->Depots->find('list');
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);
        //  $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id=1"]);
        $articles = $this->fetchTable('Articles')->find('all');
        $time = $bonlivraison->date;
        $m = $time->i18nFormat('Y-MM-d');
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
        $allclients = $this->fetchTable('Clients')->find('all')->order(['Clients.id' => 'DESC']);
        $dett1 = '' . $client_id;
        if ($clientc->client_id != 0) {
            $dett1 = $dett1 . ',' . $clientc->client_id;
            $c = $this->fetchTable('Clients')->get($clientc->client_id);
            foreach ($allclients as $cli) {
                if ($cli->client_id == $c->id && $c->client_id != 0) {
                    $dett1 = $dett1 . ',' . $c->client_id;
                    $c = $this->fetchTable('Clients')->get($cli->client_id);
                    // debug($c);
                }
            }
        }
        $cond3 = 'Commandes.client_id in ( ' . $dett1 . ')';
        $comclient = $this->fetchTable('Commandes')->find('all')
            ->where([$cond3]);
        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $bonlivraison->commande_id]);
        foreach ($lignecommandes as $li) {
            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id]);
            $dett = '0';
            foreach ($ligness as $f) {
                $dett = $dett . ',' . $f->commande_id;
            }
            if ($dett != '') {
                $cond100 = 'Commandes.id in (' . $dett . ')';
            }
            $cond101 = 'Commandes.client_id in ( ' . $dett1 . ')';
            $coms = $this->fetchTable('Commandes')->find()
                ->select(["date" => 'Min(Commandes.date)'])
                ->where([$cond100, $cond101]);
            $d = '';
            foreach ($coms as $c) {
                $d = $c->date;
            }
            $time = new FrozenTime($d);
            $m = $time->i18nFormat('Y-MM-d');
            $aujourdhui = date("Y-m-d");
            $date1 = date("Y-m-d", strtotime($m . '+  2 days'));
            if ($aujourdhui > $date1) {
                //debug('hh');
                $coeff = 0;
            } else {
                //debug('kk');
                $coeff = $li->article->coefficient;
            }
            // $tab[$li->article_id] = [
            //     'majarticle' => $coeff
            // ];
        }
        $commercials = $this->Bonlivraisons->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('BL', 'not', 'gs', 'cl', 'commercials', 'commercial', 'exotpe', 'exotva', 'exofodec', 'exotimbre', 'bonus', 'type', 'clientc', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients', 'es', 'rz', 'remcli', 'remes', 'cmde', 'commande'));
    }
    public function viewxcl($id = null)
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Personnels');
        $this->loadModel('Commandes');
        $this->loadModel('Lignebonlivraisons');
        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients'],
        ]);
        $commercial = $this->fetchTable('Commercials')->get($bonlivraison->commercial_id);
        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
        'MAX(Bonusnouvclients.valeur)'])->first();
        $bonus = $valeur->valeur;

        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());
            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['totalht'] = $this->request->getData('total');
            $data['totaltva'] = $this->request->getData('tvacommande');
            $data['totalfodec'] = $this->request->getData('fod');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['escompte'] = $this->request->getData('escompte');
            $data['escompte'] = $this->request->getData('tpecommande');
            $data['escompte'] = $this->request->getData('escompte');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['poste'] = $this->request->getData('poste');
            $data['bl'] = $this->request->getData('bl');
            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            //debug($bonlivraison);
            // $bonlivraison->excel = null;
            if ($this->Bonlivraisons->save($bonlivraison)) {
                $this->misejour("Bonlivraisons", "edit", $id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        if ($l['sup'] != 1) {
                            $tab['bonlivraison_id'] = $bonlivraison->id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['punht'] = $l['prix'];
                            $tab['remise'] = $l['remiseligne'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['remise'] = $l['remise'];
                            $tab['fodec'] = $l['fodeccommandeclient'];
                            $tab['tva'] = $l['tva'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];

                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();

                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);
                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                        } else if (!empty($l['id'])) {
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id']);
                            $this->fetchTable('Lignebonlivraisons')->delete($lignebonlivraison);
                        }
                    }
                }
                return $this->redirect(['action' => 'index/' . $bonlivraison['typebl']]);
            }
        }
        // $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
        //     'contain' => ['Articles']
        // ])
        //     ->where(['bonlivraison_id =' . $id]);
        $this->loadModel('Ligneexcs');
        $lignebonlivraisons = $this->fetchTable('Ligneexcs')->find('all')
            ->where(['bonlivraison_id =' . $id]);
        // debug($lignebonlivraisons->toArray());
        $client_id = $bonlivraison->client_id;
        $type = $bonlivraison->typebl;
        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $BL = $clientc->bl;
        $typecl = $clientc->typeclient->grandsurface;
        if ($typecl == 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }
        $escom = $clientc->typeescompte;
        if ($escom == TRUE) {
            $es = 'avec palier';
        }
        if ($escom == FALSE) {
            $es = 'sans palier';
        }
        $esremise = $clientc->typeremise;
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
        $date = $bonlivraison->date;
        $date = $date->i18nFormat('yyyy-MM-dd');
        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');
        $cond1 = "Promoarticles.datedebut <= '" . $date . "'";
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
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);
        $depots = $this->Bonlivraisons->Depots->find('list');
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);
        //   $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id=1"]);
        $articles = $this->fetchTable('Articles')->find('all');
        $time = $bonlivraison->date;
        $m = $time->i18nFormat('Y-MM-d');
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
        $allclients = $this->fetchTable('Clients')->find('all')->order(['Clients.id' => 'DESC']);
        $dett1 = '' . $client_id;
        if ($clientc->client_id != 0) {
            $dett1 = $dett1 . ',' . $clientc->client_id;
            $c = $this->fetchTable('Clients')->get($clientc->client_id);
            foreach ($allclients as $cli) {
                if ($cli->client_id == $c->id && $c->client_id != 0) {
                    $dett1 = $dett1 . ',' . $c->client_id;
                    $c = $this->fetchTable('Clients')->get($cli->client_id);
                    // debug($c);
                }
            }
        }
        $cond3 = 'Commandes.client_id in ( ' . $dett1 . ')';
        $comclient = $this->fetchTable('Commandes')->find('all')
            ->where([$cond3]);
        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $bonlivraison->commande_id]);
        foreach ($lignecommandes as $li) {
            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id]);
            $dett = '0';
            foreach ($ligness as $f) {
                $dett = $dett . ',' . $f->commande_id;
            }
            if ($dett != '') {
                $cond100 = 'Commandes.id in (' . $dett . ')';
            }
            $cond101 = 'Commandes.client_id in ( ' . $dett1 . ')';
            $coms = $this->fetchTable('Commandes')->find()
                ->select(["date" => 'Min(Commandes.date)'])
                ->where([$cond100, $cond101]);
            $d = '';
            foreach ($coms as $c) {
                $d = $c->date;
            }
            $time = new FrozenTime($d);
            $m = $time->i18nFormat('Y-MM-d');
            $aujourdhui = date("Y-m-d");
            $date1 = date("Y-m-d", strtotime($m . '+  2 days'));
            if ($aujourdhui > $date1) {
                //debug('hh');
                $coeff = 0;
            } else {
                //debug('kk');
                $coeff = $li->article->coefficient;
            }
            $tab[$li->article_id] = [
                'majarticle' => $coeff
            ];
        }
        $commercials = $this->Bonlivraisons->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('BL', 'not', 'gs', 'cl', 'commercials', 'tab', 'commercial', 'exotpe', 'exotva', 'exofodec', 'exotimbre', 'bonus', 'type', 'clientc', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients', 'es', 'rz', 'remcli', 'remes', 'cmde', 'commande'));
    }

    public function imprimerprep($tab = null)
    {


        $preparatif = $this->fetchTable('Bonlivraisons')->find('all', [
            'contain' => ['Clients', 'Commandes', 'Materieltransports', 'Preparatifs']
        ])
            ->where(['Bonlivraisons.preparatif_id in (' . $tab . ')   ']);

        foreach ($preparatif as $p) {
            $p['date'] = date('Y-m-d');
        }




        foreach ($preparatif as $p) {
            $chauffeur_id = $p['chauffeur_id'];
            $convoyeur_id = $p['convoyeur_id'];
            //debug($chauffeur_id) ;die ;
        }
        $chauffeur = $this->fetchTable('Personnels')->find()->select(["id" =>
        '(' . $chauffeur_id . ') ', "nom" => "nom"])->first();
        //debug($chauffeur) ; die ; 
        $chauffeur = $this->fetchTable('Personnels')->find('all', [])
            ->where(['Personnels.id' => $chauffeur_id]);
        foreach ($chauffeur as $ch) {
            $chauff = $ch['nom'];
        }


        //debug($namech) ; die ; 

        $convoyeur = $this->fetchTable('Personnels')->find()->select(["id" =>
        '(' . $chauffeur_id . ') ', "nom" => "nom"])->first();
        //debug($chauffeur) ; die ; 
        $convoyeur = $this->fetchTable('Personnels')->find('all', [])
            ->where(['Personnels.id' => $convoyeur_id]);
        foreach ($convoyeur as $cv) {
            $conv = $cv['nom'];
        }




        $this->set(compact('preparatif', 'chauffeur', 'convoyeur', 'chauff', 'conv'));
    }
    public function imprimeviewbor($id = null)
    {

        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');

        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Depots'],
        ]);

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

        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());


            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');

            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');

            $data['totalht'] = $this->request->getData('total');
            $data['totaltva'] = $this->request->getData('tvacommande');
            $data['totalfodec'] = $this->request->getData('fod');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['escompte'] = $this->request->getData('escompte');
            $data['escompte'] = $this->request->getData('tpecommande');
            $data['escompte'] = $this->request->getData('escompte');

            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['poste'] = $this->request->getData('poste');

            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            if ($this->Bonlivraisons->save($bonlivraison)) {



                $this->misejour("Bonlivraisons", "edit", $id);

                if ($bonlivraison['typebl'] == 1) {
                    $commande = $this->fetchTable('Commandes')->get($bonlivraison->commande_id);
                }
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //   debug($l);
                        if ($l['sup'] != 1) {
                            $tab['bonlivraison_id'] = $bonlivraison->id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['punht'] = $l['prix'];
                            $tab['remise'] = $l['remiseligne'];
                            $tab['totaltva'] = $l['monatantlignetva'];

                            $tab['fodec'] = $l['fodeccommandeclient'];
                            $tab['tva'] = $l['tva'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            }

                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);

                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                        } else if (!empty($l['id'])) {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            //  debug(intval($l['id']));
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id']);

                            $this->fetchTable('Lignebonlivraisons')->delete($lignebonlivraison);
                        }

                        if ($bonlivraison['typebl'] == 1) {

                            $lignecommandes = $this->fetchTable('Lignecommandes')->find('all', [])
                                ->where(['commande_id=' . $commande->id]);

                            foreach ($lignecommandes as $lignecommande) {
                                if ($l['article_id'] == $lignecommande['article_id']) {
                                    $ligneupdate = $this->fetchTable('Lignecommandes')->get($lignecommande['id']);

                                    $ligneupdate->quantiteliv = $l['quantiteliv'];
                                    $this->fetchTable('Lignecommandes')->save($ligneupdate);
                                }
                            }
                        }
                    }
                }

                //  debug($bonlivraison['typebl']);

                return $this->redirect(['action' => 'index/' . $bonlivraison['typebl']]);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id =' . $id]);

        //debug($lignebonlivraisons);
        //debug($bonlivraison);die;

        $client_id = $bonlivraison->client_id;

        $type = $bonlivraison->typebl;

        $this->loadModel('Clients');

        $client = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //
        //
        //
        //
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        //  $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);


        $depots = $this->Bonlivraisons->Depots->find('list');
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list');
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);

        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);

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

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $allclients = $this->fetchTable('Clients')->find('all')->order(['Clients.id' => 'DESC']);

        /** ken l client 3andou ancien client yodkhel lel if */
        /*         * det nhot fiha id mtaa commande->client_id */
        $dett1 = '' . $client_id;
        //  debug($dett1);

        /** ken l client 3andou ancien client yodkhel lel if */
        if ($client->client_id != 0) {

            $dett1 = $dett1 . ',' . $client->client_id;
            /*             * det nzid fiha id ancien client */
            $c = $this->fetchTable('Clients')->get($client->client_id);
            foreach ($allclients as $cli) {
                if ($cli->client_id == $c->id && $c->client_id != 0) {

                    $dett1 = $dett1 . ',' . $c->client_id;
                    $c = $this->fetchTable('Clients')->get($cli->client_id);
                    // debug($c);
                }
            }
        }
        //debug($dett1);

        /*         * *****fin */ //















        $cond3 = 'Commandes.client_id in ( ' . $dett1 . ')';

        $comclient = $this->fetchTable('Commandes')->find('all')
            ->where([$cond3]);
        //debug($comclient);
        // $nbjour = 0;

        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $bonlivraison->commande_id]);

        foreach ($lignecommandes as $li) {
            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id]);
            //  ->order(['Lignecommandes.commande_id' => 'DESC']);;
            $dett = '0';
            foreach ($ligness as $f) {
                // debug($f->commande_id); //die;
                $dett = $dett . ',' . $f->commande_id;

                //$dett = implode(", ", $f->commande_id);
            }
            // $dett=implode(',',$fam);
            // debug($dett);
            if ($dett != '') {
                $cond100 = 'Commandes.id in (' . $dett . ')';
            }
            $cond101 = 'Commandes.client_id in ( ' . $dett1 . ')';

            //   debug($dett);
            $coms = $this->fetchTable('Commandes')->find()
                ->select(["date" => 'Min(Commandes.date)'])
                ->where([$cond100, $cond101]);

            //   debug($coms);
            //debug($coms->select(["date" => 'Min(Commandes.date)']));
            $d = '';
            foreach ($coms as $c) {
                // debug($c->date);

                $d = $c->date;
                // debug($d);
            }


            // debug($d);

            $time = new FrozenTime($d);

            $m = $time->i18nFormat('Y-MM-d');
            //  debug($m);
            $aujourdhui = date("Y-m-d");
            // debug($aujourdhui);
            //debug($li->article->nbjour);


            $date1 = date("Y-m-d", strtotime($m . '+  2 days'));
            //  debug($date1);
            //  debug($aujourdhui);
            // $sumdate=$aujourdhui+$m;
            // debug($sumdate);
            if ($aujourdhui > $date1) {
                //debug('hh');
                $coeff = 0;
            } else {
                //debug('kk');
                $coeff = $li->article->coefficient;
                //  break;
                // exit;
            }


            // debug($m);
            $tab[$li->article_id] = [
                'majarticle' => $coeff
            ];
            // 'date' => $m,
            //            debug($tab);






            /*
              $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
              'contain' => ['Articles']
              ])
              ->where(['article_id' => $li->article_id])
              ->order(['Lignecommandes.commande_id' => 'DESC']);;


              foreach ($ligness as $ii) {

              // debug($commande->date);

              $cmd = $this->fetchTable('Commandes')->find()

              //   ->where(['id' => $ii->commande_id, 'client_id' => $client_id])
              ->where(["Commandes.client_id ='" . $client_id . "'"])
              ->order(['Commandes.date' => 'ASC']);
              //   debug($cmd);


              foreach ($cmd as $c) {


              //  debug($m);

              $time = new FrozenTime($c->date);

              $m = $time->i18nFormat('Y-MM-d');
              $aujourdhui = date("Y-m-d");




              $date1 = date("Y-m-d", strtotime($m . '+ ' . $ii->article->nbjour . 'days'));
              // debug($date1);
              // $sumdate=$aujourdhui+$m;
              // debug($sumdate);
              if ($aujourdhui > $date1) {
              //    debug('hh');
              $coeff = 0;
              } else {
              // debug('kk');
              $coeff = $ii->article->coefficient;
              break;
              // exit;
              }


              // debug($m);
              $tab[$ii->article_id] = [
              // 'date' => $m,
              'majarticle' => $coeff
              ];

              }
              } */
        }



        $commercials = $this->Bonlivraisons->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('commercials', 'tab', 'commercial', 'exotpe', 'exotva', 'exofodec', 'exotimbre', 'bonus', 'type', 'client', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
    public function imprimeview($id = null)
    {

        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');

        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Depots'],
        ]);

        // $commercial = $this->fetchTable('Commercials')->get($bonlivraison->commercial_id, [
        //     'contain' => [
        //         'Categories'
        //     ]
        // ]);
        // debug($commercial);




        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
        'MAX(Bonusnouvclients.valeur)'])->first();
        // debug($num);

        $bonus = $valeur->valeur;

      
        $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id =' . $id]);

        //debug($lignebonlivraisons);
        //debug($bonlivraison);die;

        $client_id = $bonlivraison->client_id;

        $type = $bonlivraison->typebl;

        $this->loadModel('Clients');

        $client = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations']
        ]);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //
        //
        //
        //
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        //  $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);


        $depots = $this->Bonlivraisons->Depots->find('list');
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list');
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);

        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);

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

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $allclients = $this->fetchTable('Clients')->find('all')->order(['Clients.id' => 'DESC']);

        /** ken l client 3andou ancien client yodkhel lel if */
        /*         * det nhot fiha id mtaa commande->client_id */
        $dett1 = '' . $client_id;
        //  debug($dett1);

        /** ken l client 3andou ancien client yodkhel lel if */
        if ($client->client_id != 0) {

            $dett1 = $dett1 . ',' . $client->client_id;
            /*             * det nzid fiha id ancien client */
            $c = $this->fetchTable('Clients')->get($client->client_id);
            foreach ($allclients as $cli) {
                if ($cli->client_id == $c->id && $c->client_id != 0) {

                    $dett1 = $dett1 . ',' . $c->client_id;
                    $c = $this->fetchTable('Clients')->get($cli->client_id);
                    // debug($c);
                }
            }
        }
        //debug($dett1);

        /*         * *****fin */ //















        $cond3 = 'Commandes.client_id in ( ' . $dett1 . ')';

        $comclient = $this->fetchTable('Commandes')->find('all')
            ->where([$cond3]);
        //debug($comclient);
        // $nbjour = 0;

        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $bonlivraison->commande_id]);

        foreach ($lignecommandes as $li) {
            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id]);
            //  ->order(['Lignecommandes.commande_id' => 'DESC']);;
            $dett = '0';
            foreach ($ligness as $f) {
                // debug($f->commande_id); //die;
                $dett = $dett . ',' . $f->commande_id;

                //$dett = implode(", ", $f->commande_id);
            }
            // $dett=implode(',',$fam);
            // debug($dett);
            if ($dett != '') {
                $cond100 = 'Commandes.id in (' . $dett . ')';
            }
            $cond101 = 'Commandes.client_id in ( ' . $dett1 . ')';

            //   debug($dett);
            $coms = $this->fetchTable('Commandes')->find()
                ->select(["date" => 'Min(Commandes.date)'])
                ->where([$cond100, $cond101]);

            //   debug($coms);
            //debug($coms->select(["date" => 'Min(Commandes.date)']));
            $d = '';
            foreach ($coms as $c) {
                // debug($c->date);

                $d = $c->date;
                // debug($d);
            }


            // debug($d);

            $time = new FrozenTime($d);

            $m = $time->i18nFormat('Y-MM-d');
            //  debug($m);
            $aujourdhui = date("Y-m-d");
            // debug($aujourdhui);
            //debug($li->article->nbjour);


            $date1 = date("Y-m-d", strtotime($m . '+  2 days'));
            //  debug($date1);
            //  debug($aujourdhui);
            // $sumdate=$aujourdhui+$m;
            // debug($sumdate);
            if ($aujourdhui > $date1) {
                //debug('hh');
                $coeff = 0;
            } else {
                //debug('kk');
                $coeff = $li->article->coefficient;
                //  break;
                // exit;
            }


            // debug($m);
            $tab[$li->article_id] = [
                'majarticle' => $coeff
            ];
            // 'date' => $m,
            //            debug($tab);
        }



        // $commercials = $this->Bonlivraisons->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('commercials', 'tab', 'commercial', 'exotpe', 'exotva', 'exofodec', 'exotimbre', 'bonus', 'type', 'client', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }




    public function imprimeviewbl($id = null)
    {

        $this->loadModel('Personnels');
        $this->loadModel('Lignebonlivraisons');

        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients', 'Depots'],
        ]);

        // $commercial = $this->fetchTable('Commercials')->get($bonlivraison->commercial_id, [
        //     'contain' => [
        //         'Categories'
        //     ]
        // ]);
        // debug($commercial);




        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
        'MAX(Bonusnouvclients.valeur)'])->first();
        // debug($num);

        $bonus = $valeur->valeur;

      
        $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id =' . $id]);

        //debug($lignebonlivraisons);
        //debug($bonlivraison);die;

        $client_id = $bonlivraison->client_id;

        $type = $bonlivraison->typebl;

        $this->loadModel('Clients');

        $client = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations','Gouvernorats']
        ]);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //
        //
        //
        //
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
        //debug($chauffeurs);
        $convoyeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id" => 5]);
        //debug($chauffeurs);
        $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

        //  $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //debug($clients);


        $depots = $this->Bonlivraisons->Depots->find('list');
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list');
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);

        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);

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

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $allclients = $this->fetchTable('Clients')->find('all')->order(['Clients.id' => 'DESC']);

        /** ken l client 3andou ancien client yodkhel lel if */
        /*         * det nhot fiha id mtaa commande->client_id */
        $dett1 = '' . $client_id;
        //  debug($dett1);

        /** ken l client 3andou ancien client yodkhel lel if */
        if ($client->client_id != 0) {

            $dett1 = $dett1 . ',' . $client->client_id;
            /*             * det nzid fiha id ancien client */
            $c = $this->fetchTable('Clients')->get($client->client_id);
            foreach ($allclients as $cli) {
                if ($cli->client_id == $c->id && $c->client_id != 0) {

                    $dett1 = $dett1 . ',' . $c->client_id;
                    $c = $this->fetchTable('Clients')->get($cli->client_id);
                    // debug($c);
                }
            }
        }
        //debug($dett1);

        /*         * *****fin */ //















        $cond3 = 'Commandes.client_id in ( ' . $dett1 . ')';

        $comclient = $this->fetchTable('Commandes')->find('all')
            ->where([$cond3]);
        //debug($comclient);
        // $nbjour = 0;

        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $bonlivraison->commande_id]);

        foreach ($lignecommandes as $li) {
            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id]);
            //  ->order(['Lignecommandes.commande_id' => 'DESC']);;
            $dett = '0';
            foreach ($ligness as $f) {
                // debug($f->commande_id); //die;
                $dett = $dett . ',' . $f->commande_id;

                //$dett = implode(", ", $f->commande_id);
            }
            // $dett=implode(',',$fam);
            // debug($dett);
            if ($dett != '') {
                $cond100 = 'Commandes.id in (' . $dett . ')';
            }
            $cond101 = 'Commandes.client_id in ( ' . $dett1 . ')';

            //   debug($dett);
            $coms = $this->fetchTable('Commandes')->find()
                ->select(["date" => 'Min(Commandes.date)'])
                ->where([$cond100, $cond101]);

            //   debug($coms);
            //debug($coms->select(["date" => 'Min(Commandes.date)']));
            $d = '';
            foreach ($coms as $c) {
                // debug($c->date);

                $d = $c->date;
                // debug($d);
            }


            // debug($d);

            $time = new FrozenTime($d);

            $m = $time->i18nFormat('Y-MM-d');
            //  debug($m);
            $aujourdhui = date("Y-m-d");
            // debug($aujourdhui);
            //debug($li->article->nbjour);

//' . $li->article->nbjour . '
            $date1 = date("Y-m-d", strtotime($m . '+  2 days'));
            //  debug($date1);
            //  debug($aujourdhui);
            // $sumdate=$aujourdhui+$m;
            // debug($sumdate);
            if ($aujourdhui > $date1) {
                //debug('hh');
                $coeff = 0;
            } else {
                //debug('kk');
                $coeff = $li->article->coefficient;
                //  break;
                // exit;
            }


            // debug($m);
            $tab[$li->article_id] = [
                'majarticle' => $coeff
            ];
            // 'date' => $m,
            //            debug($tab);
        }

        $chauff=$this->fetchTable('Personnels')->find()->where('Personnels.id='.$bonlivraison->chauffeur_id)->first();
        $mat=$this->fetchTable('Materieltransports')->find()->where('Materieltransports.id='.$bonlivraison->materieltransport_id)->first();


        // $commercials = $this->Bonlivraisons->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('mat','chauff','commercials', 'tab', 'commercial', 'exotpe', 'exotva', 'exofodec', 'exotimbre', 'bonus', 'type', 'client', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients'));
    }
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
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $cond7 = '';

        $cond8 = '';

        $cond9 = '';
        $cond10 = '';
        $cond11 = '';
        $cond12 = '';

        $datedebut = $this->request->getQuery('datedebut');
        // debug($datedebut);
        $datefin = $this->request->getQuery('datefin');
        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        // debug($client_id);
        //  debug($pointdevente_id);
        $chauffeur_id = $this->request->getQuery('chauffeur_id');
        // debug($chauffeur_id);
        $depot_id = $this->request->getQuery('depot_id');
        //debug($depot_id);
        $cartecarburant_id = $this->request->getQuery('cartecarburant_id');
        //debug($cartecarburant_id);
        $convoyeur_id = $this->request->getQuery('convoyeur_id');
        $num = $this->request->getQuery('numero');
        // debug($convoyeur_id);

        $zone = $this->request->getQuery('zone_id');

        $materieltransport_id = $this->request->getQuery('materieltransport_id');
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.famille_id " => 1]);
        $article = $this->request->getQuery('article_id');
        ////
        if ($article) {
            $lignecommandes = $this->fetchTable('Lignebonlivraisons')->find('all')->where(["Lignebonlivraisons.article_id=" . $article]);
            $detarticle = '0';
            foreach ($lignecommandes as $art) {
                //   debug($art);
                $detarticle = $detarticle . ',' . $art->bonlivraison_id;
            }
            //  debug($lignecommandes);
        }







        /////

        if ($zone) {
            $det = '0';
            $zonedelegations = $this->fetchTable('Zonedelegations')->find('all')
                ->where(['zone_id =' . $zone]);
            //  debug($zonedelegations);
            foreach ($zonedelegations as $a) {
                debug($a);
                $det = $det . ',' . $a->id;
            }


            $lignezonedelegations = $this->fetchTable('Lignezonedelegations')->find('all')
                ->where(['Lignezonedelegations.zonedelegation_id  in ( ' . $det . ')']);

            $det1 = '0';
            foreach ($lignezonedelegations as $b) {

                $det1 = $det1 . ',' . $b->delegation_id;
            }


            /// debug($det1);
            $cond10 = 'Clients.delegation_id in ( ' . $det1 . ')';
        }

        if ($materieltransport_id) {
            $cond1 = "Bonlivraisons.materieltransport_id =  '" . $materieltransport_id . "' ";
        }


        if ($datedebut) {
            $cond2 = "Bonlivraisons.date   >= '" . $datedebut . "' ";
        }
        if ($datefin) {
            $cond3 = "Bonlivraisons.date  <= '" . $datefin . "' ";
        }
        if ($client_id) {
            $cond4 = "Bonlivraisons.client_id = '" . $client_id . "' ";
        }

        if ($chauffeur_id) {
            $cond6 = "Bonlivraisons.chauffeur_id  = '" . $chauffeur_id . "' ";
        }
        if ($depot_id) {
            $cond7 = "Bonlivraisons.depot_id  = '" . $depot_id . "' ";
        }
        if ($cartecarburant_id) {
            $cond8 = "Bonlivraisons.cartecarburant_id  = '" . $cartecarburant_id . "' ";
        }
        if ($convoyeur_id) {
            $cond9 = "Bonlivraisons.convoyeur_id  '=" . $convoyeur_id . "' ";
        }

        if ($article) {
            $cond11 = 'Bonlivraisons.id in ( ' . $detarticle . ')';
        }

        if ($num) {
            $cond12 = 'Bonlivraisons.numero in ( ' . $num . ')';
        }



        //  debug($type);
        $condtyp = "Bonlivraisons.typebl=" . $type;
        //debug($condtyp);
        $query = $this->Bonlivraisons->find('all')->where([$condtyp, $cond1, $cond2, $cond3, $cond4, $cond6, $cond7, $cond8, $cond9, $cond10, $cond11, $cond12])->order(['Bonlivraisons.id' => 'DESC'])->contain(['Clients', 'Depots']);
        ///  debug($bonlivraisons->toArray());
        //
        //        $this->paginate = [
        //            'contain' => ['Clients'],
        //        ];
        $bonlivraisons = $this->paginate($query);
        //          debug($bonlivraisons);die;


        $this->loadModel('Personnels');

        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //debug($chauffeurs);

        $chauffeurs = $this->fetchTable('Personnels')->find('all')
            ->where(['fonction_id' => 1]);

        //  debug($chauffeurs);die;
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id = 5"]);

        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);

        $clients = $this->Bonlivraisons->Clients->find('all');
        // debug($clients->toArray());

        $pointdeventes = $this->Bonlivraisons->Pointdeventes->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $depotsoptions = $this->Bonlivraisons->Depots->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list', ['keyfield' => 'id', 'valueField' => 'num']);

        $Factureclientsoptions = $this->Bonlivraisons->Factureclients->find('list', ['keyfield' => 'id', 'valueField' => 'numero']);

        $adresselivraisonclientsoptions = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse']);
        $zones = $this->fetchTable('Zones')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $suivi = [];
        if ($this->request->is(['patch', 'post', 'put'])) {
			echo iddialog;
            $bonlivraison = $this->fetchTable('Bonlivraisons')->get($this->request->getData('iddialog'));
            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $this->request->getData());
            $bonlivraison->confirme = 1;
            if ($this->Bonlivraisons->save($bonlivraison)) {

                return $this->redirect(['action' => 'index/' . $type]);
            }
        }





        $this->set(compact(
            'suivi',
            'articles',
            'article',
            'zones',
            'type',
            'chauffeurs',
            'client_id',
            'chauffeur_id',
            'depot_id',
            'cartecarburant_id',
            'convoyeur_id',
            'conffaieurs',
            'depots',
            'bonlivraisons',
            'clients',
            'depotsoptions',
            'materieltransports',
            'cartecarburants',
            'Factureclientsoptions',
            'adresselivraisonclientsoptions'
        ));
    }

    /**
     * View method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Personnels');
        $this->loadModel('Commandes');
        $this->loadModel('Lignebonlivraisons');


        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients'],
        ]);
        /// debug($bonlivraison);
        if ($bonlivraison->typebl == '1') {
            $commande = $this->fetchTable('Commandes')->find('all', [])
                ->where(['Commandes.bonlivraison_id=' . $id]);
            //debug($commande);
            foreach ($commande as $com) {
                $date = $com->date;
            }

            // debug($clientc);
        }


        //debug($cmde);

        //debug($bonlivraison);

        $commercial = $this->fetchTable('Commercials')->get($bonlivraison->commercial_id);
        // debug($commercial);




        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
        'MAX(Bonusnouvclients.valeur)'])->first();
        // debug($num);

        $bonus = $valeur->valeur;

        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());


            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['totalht'] = $this->request->getData('totalht');
            $data['totaltva'] = $this->request->getData('totaltva');
            $data['totalfodec'] = $this->request->getData('totalfodec');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['escompte'] = $this->request->getData('escompte');
            $data['escompte'] = $this->request->getData('tpecommande');
            $data['escompte'] = $this->request->getData('escompte');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['poste'] = $this->request->getData('poste');
            $data['bl'] = $this->request->getData('bl');


            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);

            //debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {



                $this->misejour("Bonlivraisons", "edit", $id);

                if ($bonlivraison['typebl'] == 1) {
                    $commande = $this->fetchTable('Commandes')->get($bonlivraison->commande_id);
                }
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //ebug($this->request->getData());
                        if ($l['sup'] != 1) {
                            $tab['bonlivraison_id'] = $bonlivraison->id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['punht'] = $l['prix'];
                            $tab['remise'] = $l['remise'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['remise'] = $l['remise'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['tva'] = $l['tva'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];
                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                                // debug($this->request->getData());
                            } else {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            }

                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);
                            // debug($this->request->getData());
                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                        } else if (!empty($l['id'])) {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            //  debug(intval($l['id']));
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id']);

                            $this->fetchTable('Lignebonlivraisons')->delete($lignebonlivraison);
                        }

                        if ($bonlivraison['typebl'] == 1) {

                            $lignecommandes = $this->fetchTable('Lignecommandes')->find('all', [])
                                ->where(['commande_id=' . $commande->id]);

                            foreach ($lignecommandes as $lignecommande) {
                                if ($l['article_id'] == $lignecommande['article_id']) {
                                    $ligneupdate = $this->fetchTable('Lignecommandes')->get($lignecommande['id']);

                                    $ligneupdate->quantiteliv = $l['quantiteliv'];
                                    $this->fetchTable('Lignecommandes')->save($ligneupdate);
                                }
                            }
                        }
                    }
                }

                //  debug($bonlivraison['typebl']);

                return $this->redirect(['action' => 'index/' . $bonlivraison['typebl']]);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id =' . $id]);

        //  debug($lignebonlivraisons->toArray());
        //debug($bonlivraison);die;

        $client_id = $bonlivraison->client_id;

        $type = $bonlivraison->typebl;

        $this->loadModel('Clients');

        //        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
        //            'contain' => ['Localites', 'Delegations']
        //        ]);
        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $BL = $clientc->bl;
        $typecl = $clientc->typeclient->grandsurface;
        // debug($clientc->typeclient->grandsurface);//die;
        if ($typecl == 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }


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

        //$commande = $this->fetchTable('Commandes')->get($bonlivraison->commande_id);
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
        // debug($gs);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //
        //
        //
        //
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      
        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id" => 5 ]);
        
        $depots = $this->Bonlivraisons->Depots->find('list');
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list');
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);

        $articles = $this->fetchTable('Articles')->find('all');
        //->where(["Articles.famille_id=1"]);

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

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $allclients = $this->fetchTable('Clients')->find('all')->order(['Clients.id' => 'DESC']);

        /** ken l client 3andou ancien client yodkhel lel if */
        /*         * det nhot fiha id mtaa commande->client_id */
        $dett1 = '' . $client_id;
        //  debug($dett1);

        /** ken l client 3andou ancien client yodkhel lel if */
        if ($clientc->client_id != 0) {

            $dett1 = $dett1 . ',' . $clientc->client_id;
            /*             * det nzid fiha id ancien client */
            $c = $this->fetchTable('Clients')->get($clientc->client_id);
            foreach ($allclients as $cli) {
                if ($cli->client_id == $c->id && $c->client_id != 0) {

                    $dett1 = $dett1 . ',' . $c->client_id;
                    $c = $this->fetchTable('Clients')->get($cli->client_id);
                    // debug($c);
                }
            }
        }
        //debug($dett1);

        /*         * *****fin */ //


        $cond3 = 'Commandes.client_id in ( ' . $dett1 . ')';

        $comclient = $this->fetchTable('Commandes')->find('all')
            ->where([$cond3]);
        //debug($comclient);
        // $nbjour = 0;

        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $bonlivraison->commande_id]);

        foreach ($lignecommandes as $li) {
            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id]);
            //  ->order(['Lignecommandes.commande_id' => 'DESC']);;
            $dett = '0';
            foreach ($ligness as $f) {
                // debug($f->commande_id); //die;
                $dett = $dett . ',' . $f->commande_id;

                //$dett = implode(", ", $f->commande_id);
            }
            // $dett=implode(',',$fam);
            // debug($dett);
            if ($dett != '') {
                $cond100 = 'Commandes.id in (' . $dett . ')';
            }
            $cond101 = 'Commandes.client_id in ( ' . $dett1 . ')';

            //   debug($dett);
            $coms = $this->fetchTable('Commandes')->find()
                ->select(["date" => 'Min(Commandes.date)'])
                ->where([$cond100, $cond101]);

            //   debug($coms);
            //debug($coms->select(["date" => 'Min(Commandes.date)']));
            $d = '';
            foreach ($coms as $c) {
                // debug($c->date);

                $d = $c->date;
                // debug($d);
            }


            // debug($d);

            $time = new FrozenTime($d);

            $m = $time->i18nFormat('Y-MM-d');
            //  debug($m);
            $aujourdhui = date("Y-m-d");
            // debug($aujourdhui);
            //debug($li->article->nbjour);


            $date1 = date("Y-m-d", strtotime($m . '+  2 days'));
            //  debug($date1);
            //  debug($aujourdhui);
            // $sumdate=$aujourdhui+$m;
            // debug($sumdate);
            if ($aujourdhui > $date1) {
                //debug('hh');
                $coeff = 0;
            } else {
                //debug('kk');
                $coeff = $li->article->coefficient;
                //  break;
                // exit;
            }


            // debug($m);
            $tab[$li->article_id] = [
                'majarticle' => $coeff
            ];
        }

        $lignereglementclient = $this->fetchTable('Lignereglementclients')->find('all')->where(['Lignereglementclients.bonlivraison_id =' . $id])->first();
        //    debug($lignereglementclient);
        $piecereglementclients = [];
        if ($lignereglementclient->reglementclient_id != null) {
            $piecereglementclients = $this->fetchTable('Piecereglementclients')->find('all')->where(['Piecereglementclients.reglementclient_id =' . $lignereglementclient->reglementclient_id]);
        }
        $paiements = $this->fetchTable('Paiements')->find('list');
        $valeurs = $this->fetchTable('Tos')->find('list');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);



        $commercials = $this->Bonlivraisons->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('piecereglementclients', 'paiements', 'valeurs', 'caisses', 'banques', 'BL', 'not', 'gs', 'cl', 'commercials', 'tab', 'commercial', 'exotpe', 'exotva', 'exofodec', 'exotimbre', 'bonus', 'type', 'clientc', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients', 'es', 'rz', 'remcli', 'remes', 'cmde', 'commande'));
    }

    public function viewm($id = null)
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Commandes');


        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients'],
        ]);
        // debug($bonlivraison);



        $lignebonlivraisons = $this->Bonlivraisons->Lignebonlivraisons->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id' => $id]);


        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);


        if ($bonlivraison->typebl == '1') {

            $commande = $this->fetchTable('Commandes')->find('all', [])
                ->where(['Commandes.bonlivraison_id=' . $id]);
            //debug($commande->toarray());
            foreach ($commande as $com) {
                $date = $com->date;
            }

            // debug($clientc);
            $date = $date->i18nFormat('yyyy-MM-dd');
        }





        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);

        $clients = $this->Bonlivraisons->Clients->find('all');
        //debug($clients);

        $depots = $this->Bonlivraisons->Depots->find('list');

        $articles = $this->fetchTable('Articles')->find('all');



        $this->set(compact('BL', 'gs', 'not',  'remcli', 'remes', 'cl', 'exotva', 'exotpe', 'exofodec', 'clientc', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients', 'rz', 'es', 'cmde', 'commande'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    /*  public function add($type = null) {



      $num = $this->Bonlivraisons->find()->select(["num" =>
      'MAX(Bonlivraisons.numero)'])->first();
      // debug($num);

      $n = $num->num;
      // $int=intval($n);
      $in = intval($n) + 1;
      //debug($in);
      $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

      $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
      if ($this->request->is('post')) {

      $num = $this->Bonlivraisons->find()->select(["num" =>
      'MAX(Bonlivraisons.numero)'])->first();
      // debug($num);

      $n = $num->num;
      // $int=intval($n);
      $in = intval($n) + 1;
      //debug($in);
      $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
      //debug($this->request->getData());
      $data['numero'] = $this->request->getData('numero');
      $data['date'] = $this->request->getData('date');
      $data['client_id'] = $this->request->getData('client_id');
      $data['typebl'] = $type;
      $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
      $data['adresselivraisonclient_id'] = $this->request->getData('adresselivraison');
      $data['chauffeur_id'] = $this->request->getData('chauffeur_id');

      $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
      $data['depot_id'] = $this->request->getData('depot_id');
      $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
      $data['kilometragedepart'] = $this->request->getData('kilm_depart');
      $data['kilometragearrive'] = $this->request->getData('kilm_arrive');
      $data['totalht'] = $this->request->getData('totalht');
      $data['totaltva'] = $this->request->getData('totaltva');
      $data['totalfodec'] = $this->request->getData('Totalfodec');
      $data['totalremise'] = $this->request->getData('Totalremise');
      $data['totalttc'] = $this->request->getData('Totalttc');
      //
      //
      //
      //   debug($bonlivraison);//die;










      $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
      // debug($bonlivraison);
      if ($this->Bonlivraisons->save($bonlivraison)) {
      $this->misejour("Bonlivraisons", "add", $bonlivraison->id);

      $bonlivraison_id = $bonlivraison->id;


























      if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
      //debug($this->request->getData('data')['ligner']);
      foreach ($this->request->getData('data')['ligner'] as $i => $l) {
      // debug($l);

      if ($l['supp'] != 1) {




      $tab['bonlivraison_id'] = $bonlivraison_id;
      $tab['qte'] = $l['qteStock'];
      $tab['article_id'] = $l['article_id'];
      $tab['quantiteliv'] = $l['qte'];
      $tab['qte'] = $l['qte'];
      $tab['prixht'] = $l['prixht'];
      $tab['remise'] = $l['remise'];
      $tab['punht'] = $l['punht'];
      $tab['tva'] = $l['tva'];
      $tab['fodec'] = $l['fodec'];

      $tab['ttc'] = $l['ttc'];
      // debug($tab);





      $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();


      $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);
      //debug($lignebonlivraison);
      $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
      }
      }
      }






















      //   $this->Flash->success(__('The {0} has been saved.', 'Bonlivraison'));

      return $this->redirect(['action' => 'index/' . $type]);
      }
      //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
      }
      $this->loadModel('Personnels');


      $chauffeurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 5 . "%' "]);
      //debug($chauffeurs);
      $conffaieurs = $this->Personnels->find('all')->where(["Personnels.fonction_id like  '%" . 1 . "%' "]);

      $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
      //debug($clients);

      $depots = $this->Bonlivraisons->Depots->find('list');
      $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
      $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
      // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list');
      //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list');
      $factureclients = $this->Bonlivraisons->Factureclients->find('list');
      $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list');
      $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
      $this->set(compact('type', 'mm', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'factureclients', 'adresselivraisonclients'));
      }

      /**
     * Edit method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */

    public function editm($id = null)
    {

        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Commandes');


        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients'],
        ]);
        // debug($bonlivraison);



        $lignebonlivraisons = $this->Bonlivraisons->Lignebonlivraisons->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id' => $id]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());

            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['typebl'] = '3';
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['totalht'] = $this->request->getData('totalht');
            $data['observation'] = $this->request->getData('observation');


            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);

            //debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {



                $this->misejour("Bonlivraisons", "edit", $id);


                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //   debug($l);
                        if ($l['sup'] != 1) {

                            $tab['bonlivraison_id'] = $bonlivraison->id;
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['punht'] = $l['prix'];
                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                            } else {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            }

                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);

                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                        } else if (!empty($l['id'])) {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            //  debug(intval($l['id']));
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id']);

                            $this->fetchTable('Lignebonlivraisons')->delete($lignebonlivraison);
                        }
                    }
                }

                //  debug($bonlivraison['typebl']);

                return $this->redirect(['action' => 'index/' . $bonlivraison['typebl']]);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }


        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $clients = $this->Bonlivraisons->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);

        $clients = $this->Bonlivraisons->Clients->find('all');

        $depots = $this->Bonlivraisons->Depots->find('list');

        $articles = $this->fetchTable('Articles')->find('all');



        $this->set(compact('BL', 'gs', 'not',  'remcli', 'remes', 'cl', 'exotva', 'exotpe', 'exofodec', 'clientc', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients', 'rz', 'es', 'cmde', 'commande'));
    }

    public function edit($id = null)
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Personnels');
        $this->loadModel('Commandes');
        $this->loadModel('Lignebonlivraisons');


        $bonlivraison = $this->Bonlivraisons->get($id, [
            'contain' => ['Clients'],
        ]);
        /// debug($bonlivraison);
        if ($bonlivraison->typebl == '1') {
            $commande = $this->fetchTable('Commandes')->find('all', [])
                ->where(['Commandes.bonlivraison_id=' . $id]);
            //debug($commande);
            foreach ($commande as $com) {
                $date = $com->date;
            }

            // debug($clientc);
        }


        //debug($cmde);

        //debug($bonlivraison);

        $commercial = $this->fetchTable('Commercials')->get($bonlivraison->commercial_id);
        // debug($commercial);


     

        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
        'MAX(Bonusnouvclients.valeur)'])->first();
        // debug($num);

        $bonus = $valeur->valeur;

        if ($this->request->is(['patch', 'post', 'put'])) {
             debug($this->request->getData());


            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['totalht'] = $this->request->getData('totalht');
            $data['totaltva'] = $this->request->getData('totaltva');
            $data['totalfodec'] = $this->request->getData('totalfodec');
            $data['totalremise'] = $this->request->getData('totalremise');
            $data['escompte'] = $this->request->getData('escompte');
            $data['escompte'] = $this->request->getData('tpecommande');
            $data['escompte'] = $this->request->getData('escompte');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['poste'] = $this->request->getData('poste');
            $data['bl'] = $this->request->getData('bl');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            


            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);

            //debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {



                $this->misejour("Bonlivraisons", "edit", $id);

                if ($bonlivraison['typebl'] == 1) {
                    $commande = $this->fetchTable('Commandes')->get($bonlivraison->commande_id);
                }
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //ebug($this->request->getData());
                        if ($l['sup'] != 1) {
                            $tab['bonlivraison_id'] = $bonlivraison->id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            $tab['ml'] = $l['ml'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['punht'] = $l['prix'];
                            $tab['remise'] = $l['remise'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['remise'] = $l['remise'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['tva'] = $l['tva'];
                            $tab['prixht'] = $l['ht'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];
                            if (isset($l['id']) && (!empty($l['id']))) {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id'], [
                                    'contain' => ['Articles']
                                ]);
                                // debug($this->request->getData());
                            } else {
                                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            }

                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->patchEntity($lignebonlivraison, $tab);
                            // debug($this->request->getData());
                            $this->fetchTable('Lignebonlivraisons')->save($lignebonlivraison);
                        } else if (!empty($l['id'])) {
                            //S  $this->request->allowMethod(['post', 'delete']);
                            //  debug(intval($l['id']));
                            $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->get($l['id']);

                            $this->fetchTable('Lignebonlivraisons')->delete($lignebonlivraison);
                        }

                        if ($bonlivraison['typebl'] == 1) {

                            $lignecommandes = $this->fetchTable('Lignecommandes')->find('all', [])
                                ->where(['commande_id=' . $commande->id]);

                            foreach ($lignecommandes as $lignecommande) {
                                if ($l['article_id'] == $lignecommande['article_id']) {
                                    $ligneupdate = $this->fetchTable('Lignecommandes')->get($lignecommande['id']);

                                    $ligneupdate->quantiteliv = $l['quantiteliv'];
                                    $this->fetchTable('Lignecommandes')->save($ligneupdate);
                                }
                            }
                        }
                    }
                }

                $ligneregs = $this->fetchTable('Lignereglementclients')->find()->where(["Lignereglementclients.bonlivraison_id=" . $id]);
                $lignereg = $this->fetchTable('Lignereglementclients')->find()->where(["Lignereglementclients.bonlivraison_id=" . $id])->first();
                $reglement_id = $lignereg->reglementclient_id;
                // debug($ligneregs->toArray());die;
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
                $lignes2 = [];
                if ($reglement_id) {
                    $lignes2 = $this->fetchTable('Piecereglementclients')->find()->where(["Piecereglementclients.reglementclient_id =" . $reglement_id]);
                }
                foreach ($lignes2 as $item) {
                    $this->fetchTable('Piecereglementclients')->delete($item);
                }

                // debug($reglement_id);
                $ligner = $this->fetchTable('Lignereglementclients')->newEmptyEntity();
                // debug($ligner);die;
                $t['reglementclient_id'] = $reglement_id;
                $t['bonlivraison_id'] = $id;
                $t['Montant'] = $this->request->getData('Montant_Regler');
                //    debug($t);
                $ligner = $this->fetchTable('Lignereglementclients')->patchEntity($ligner, $t);
                //debug($t);
                $this->fetchTable('Lignereglementclients')->save($ligner);




                /******************************piece reglement*****************************************/
                //  debug($this->request->getData());
                if (isset($this->request->getData('data')['pieceregelemnt']) && (!empty($this->request->getData('data')['pieceregelemnt']))) {
                    debug($this->request->getData('data')['pieceregelemnt']);

                    foreach ($this->request->getData('data')['pieceregelemnt'] as $j => $p) {
                        if (isset($p['sup2']) && $p['sup2'] != 1) {
                            $table = $this->fetchTable('Piecereglementclients')->newEmptyEntity();

                            $table['reglementclient_id'] = $reglement_id;
                            $table['caisse_id'] = $p['caisse_id'];
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
                }
                return $this->redirect(['action' => 'index/' . $bonlivraison['typebl']]);
            }
            //  $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Bonlivraison'));
        }
        $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id =' . $id]);

        //debug($lignebonlivraisons);
        //debug($bonlivraison);die;

        $client_id = $bonlivraison->client_id;

        $type = $bonlivraison->typebl;

        $this->loadModel('Clients');

        //        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
        //            'contain' => ['Localites', 'Delegations']
        //        ]);
        $this->loadModel('Clients');
        $clientc = $this->fetchTable('Clients')->get($bonlivraison->client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $BL = $clientc->bl;
        $typecl = $clientc->typeclient->grandsurface;
        // debug($clientc->typeclient->grandsurface);//die;
        if ($typecl == 'false') {
            $cl = 'false';
        } else {
            $cl = 'true';
        }


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

        //$commande = $this->fetchTable('Commandes')->get($bonlivraison->commande_id);
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
        // debug($gs);
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //
        //
        //
        //
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

      
        $clients = $this->Bonlivraisons->Clients->find('all')->where(["Clients.etat " => 'TRUE']);
  

        $depots = $this->Bonlivraisons->Depots->find('list');
       
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        // $chauffeurs = $this->Bonlivraisons->Chauffeurs->find('list');
        //$convoyeurs = $this->Bonlivraisons->Convoyeurs->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);

        $articles = $this->fetchTable('Articles')->find('all');

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

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        $allclients = $this->fetchTable('Clients')->find('all')->order(['Clients.id' => 'DESC']);

        /** ken l client 3andou ancien client yodkhel lel if */
        /*         * det nhot fiha id mtaa commande->client_id */
        $dett1 = '' . $client_id;
        //  debug($dett1);

        /** ken l client 3andou ancien client yodkhel lel if */
        if ($clientc->client_id != 0) {

            $dett1 = $dett1 . ',' . $clientc->client_id;
            /*             * det nzid fiha id ancien client */
            $c = $this->fetchTable('Clients')->get($clientc->client_id);
            foreach ($allclients as $cli) {
                if ($cli->client_id == $c->id && $c->client_id != 0) {

                    $dett1 = $dett1 . ',' . $c->client_id;
                    $c = $this->fetchTable('Clients')->get($cli->client_id);
                    // debug($c);
                }
            }
        }
        //debug($dett1);

        /*         * *****fin */ //


        $cond3 = 'Commandes.client_id in ( ' . $dett1 . ')';

        $comclient = $this->fetchTable('Commandes')->find('all')
            ->where([$cond3]);
        //debug($comclient);
        // $nbjour = 0;

        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['commande_id' => $bonlivraison->commande_id]);

        foreach ($lignecommandes as $li) {
            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id]);
            //  ->order(['Lignecommandes.commande_id' => 'DESC']);;
            $dett = '0';
            foreach ($ligness as $f) {
                // debug($f->commande_id); //die;
                $dett = $dett . ',' . $f->commande_id;

                //$dett = implode(", ", $f->commande_id);
            }
            // $dett=implode(',',$fam);
            // debug($dett);
            if ($dett != '') {
                $cond100 = 'Commandes.id in (' . $dett . ')';
            }
            $cond101 = 'Commandes.client_id in ( ' . $dett1 . ')';

            //   debug($dett);
            $coms = $this->fetchTable('Commandes')->find()
                ->select(["date" => 'Min(Commandes.date)'])
                ->where([$cond100, $cond101]);

            //   debug($coms);
            //debug($coms->select(["date" => 'Min(Commandes.date)']));
            $d = '';
            foreach ($coms as $c) {
                // debug($c->date);

                $d = $c->date;
                // debug($d);
            }


            // debug($d);

            $time = new FrozenTime($d);

            $m = $time->i18nFormat('Y-MM-d');
            //  debug($m);
            $aujourdhui = date("Y-m-d");
            // debug($aujourdhui);
            //debug($li->article->nbjour);


            $date1 = date("Y-m-d", strtotime($m . '+  2 days'));
            //  debug($date1);
            //  debug($aujourdhui);
            // $sumdate=$aujourdhui+$m;
            // debug($sumdate);
            if ($aujourdhui > $date1) {
                //debug('hh');
                $coeff = 0;
            } else {
                //debug('kk');
                $coeff = $li->article->coefficient;
                //  break;
                // exit;
            }


            // debug($m);
            $tab[$li->article_id] = [
                'majarticle' => $coeff
            ];
            // 'date' => $m,
            //            debug($tab);






        }

        $lignereglementclient = $this->fetchTable('Lignereglementclients')->find('all')->where(['Lignereglementclients.bonlivraison_id =' . $id])->first();
        //    debug($lignereglementclient);die;
        $piecereglementclients = [];
        if ($lignereglementclient->reglementclient_id != null) {
            $piecereglementclients = $this->fetchTable('Piecereglementclients')->find('all')->where(['Piecereglementclients.reglementclient_id =' . $lignereglementclient->reglementclient_id]);
        }
        $paiements = $this->fetchTable('Paiements')->find('list');
        $valeurs = $this->fetchTable('Tos')->find('list');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id" => 5 ]);
        
        $commercials = $this->Bonlivraisons->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('banques', 'piecereglementclients', 'paiements', 'valeurs', 'caisses', 'BL', 'not', 'gs', 'cl', 'commercials', 'tab', 'commercial', 'exotpe', 'exotva', 'exofodec', 'exotimbre', 'bonus', 'type', 'clientc', 'lignebonlivraisons', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'adresselivraisonclients', 'es', 'rz', 'remcli', 'remes', 'cmde', 'commande'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Bonlivraison id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */



    public function delete($id = null)

    {



        $lignelivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [])
            ->where(['Lignebonlivraisons.bonlivraison_id   = (' . $id . ')   ']);



        foreach ($lignelivraisons as $liv) {
            if ($liv->lignecommande_id != null) {
                $lignecommandes = $this->fetchTable('Lignecommandes')->find('all', [])
                    ->where(['Lignecommandes.id   = (' . $liv->lignecommande_id . ')   ']);
            }

            ///debug($lignecommandes->toarray());

            $test = 0;
            foreach ($lignecommandes as $lignec) {

                $lignev = $this->fetchTable('Lignebonlivraisons')->find('all', [])
                    ->where(['Lignebonlivraisons.lignecommande_id   = (' . $lignec->id . ')   ']);

                // debug($lignev);

                foreach ($lignev as $l) {

                    if ($l->lignecommande_id == $lignec->id) {
                        $test += 1;

                        if ($test > 1) {
                            $ligneupdate = $this->fetchTable('Lignecommandes')->get($lignec['id']);
                            $cmde = $this->fetchTable('Commandes')->get($ligneupdate['commande_id']);
                            $cmde->etatliv = '1';
                            $this->fetchTable('Commandes')->save($cmde);
                            ///debug($cmde);
                        }

                        if ($test == 1) {
                            $ligneupdate = $this->fetchTable('Lignecommandes')->get($lignec['id']);
                            $cmde = $this->fetchTable('Commandes')->get($ligneupdate['commande_id']);
                            $cmde->etatliv = '0';
                            $this->fetchTable('Commandes')->save($cmde);
                            /// debug($cmde);
                        }
                    }
                }
            }
        }


        $bonlivraison = $this->Bonlivraisons->get($id);

        if ($this->Bonlivraisons->delete($bonlivraison)) {
            $this->misejour("Bonlivraisons", "delete", $id);
            foreach ($lignelivraisons as $l) {
                $this->Bonlivraisons->Lignebonlivraisons->delete($l);
            }
        } else {
        }

        return $this->redirect(['action' => 'index/1']);
    }



    public function getadresselivraison($id = null)
    {
        $id = $this->request->getQuery('idfam');

        //  debug($id);
        // die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));



        $ligne = $this->fetchTable('Clients')->get($id, [
            'contain' => [],
        ]);

        $query = $this->fetchTable('Adresselivraisonclients')->find();
        $query->where(['client_id' => $id]);
        //debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Adresse livraison</label>
        <select name='adresse' id='adresselivraison-id' class='form-control select2'  onchange='getsousfamille2(this.value)'>
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q); 
            $select = $select . "	<option value ='" . $q['id'] . "'";
            $select = $select . " >" . $q['adresse'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> ";

        echo json_encode(array('select' => $select, 'ligne' => $ligne));
        die;
        //$this->set(compact('query'));





        /* foreach ($query as $q) { 
          json_encode($q);
          debug($q);
          }
         */
    }

    // get prix article aprés la selectin 
    public function receive()
    {
        $id = $this->request->getQuery('idfam');

        //$id = $this->request->getData('idfam');
        // debug($id);

        $ligne = $this->fetchTable('Articles')->get($id);
        // $query = "call stockbassem(@art=1,@terikh=29/08/2022, @interv = 1,@depot = 1)";
        // debug($query);
        //  $a = $this->fetchTable('Inventaires')->query("exec stockbassem @art=1,@terikh=29/08/2022, @interv = 1,@depot = 1");
        // debug($a);
        //$result = $this->query($query);
        //  $st = ClassRegistry::init('Inventaire')->query("select stockbassem(" . $id . ",'" . $datef . "','0'," . $depotid . ") as v"); //debug($st[0][0]['v']);die;*/*/*/*/*/


        echo (json_encode($ligne));
        //debug($t);die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));
        //$this->set(compact('ligne'));
        //   $query = $this->fetchTable('Articles')->find();
        //  $query->where(['id_article' => $id]);
        //foreach ($query->all() as $row) {
        // debug($row->title);
        //  $prix_achat = ($row->prix_achat);
        //  $tva = $row->tva;
        // $this->set(compact('prix_achat'));
        // var_dump($row->prix_achat);
        // $prix_achat = ($row->prix_achat);
        // $ligne = $row;
        //  $this->set(compact('ligne'));
        // }
        // var_dump($query);
        die;
    }

    public function addbonlivraison($ids = null)
    {

        error_reporting(E_ERROR | E_PARSE);

        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
        'MAX(Bonusnouvclients.valeur)'])->first();
        // debug($num);

        $bonus = $valeur->valeur;
        $this->loadModel('Commandes');

        $commande = $this->fetchTable('Commandes')->find('all', [
            'contain' => ['Clients', 'Lignecommandes']
        ])
            ->where(['Commandes.id   in (' . $ids . ')   ']);

        /// debug($commande->toarray());

        foreach ($commande as $i => $com) {
            $com_id = $com->commercial_id;
            $client_id = $com->client_id;
            $depot_id = $com->depot_id;
            $date = $com->date;
            $nv_client = $com->nouv_client;
            $payment = $com->payementcomptant;
        }


        $commercial = $this->fetchTable('Commercials')->get($com_id);

        // debug($commercial);

        $currentYear = date('y');
        $yearf = date('Y');
        $num = $this->Bonlivraisons->find()->select(["num" => 'MAX(Bonlivraisons.numero)'])->where('Bonlivraisons.typebl=1')
        ->where('YEAR(Bonlivraisons.date)=' . $yearf)->first();
        
      
       
        $n = $num->num;

        if ($n) {
            // Extract the last 4 digits from the existing serial number and increment by 1
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            // If no previous record found, start from 1111
            $in = '0001';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $mm = "BL{$currentYear}00{$mm}";


        $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
        //  debug($bonlivraison);die;

        if ($this->request->is(['patch', 'post', 'put'])) {

            //  debug($this->request->getData());die;
            // die;
            $currentYear = date('y');
            $yearf = date('Y');
            $num = $this->Bonlivraisons->find()->select(["num" => 'MAX(Bonlivraisons.numero)'])->where('Bonlivraisons.typebl=1')
            ->where('YEAR(Bonlivraisons.date)=' . $yearf)->first();
            $n = $num->num;

            if ($n) {
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                $in = '0001';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $mm = "BL{$currentYear}00{$mm}";

            $data['numero'] = $this->request->getData('numero');
            $data['date'] = $this->request->getData('date');
            $data['client_id'] = $this->request->getData('client_id');
            $data['bl'] = $this->request->getData('bl');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');
            $data['adresselivraisonclient_id'] = $this->request->getData('adresse');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['convoyeur_id'] = $this->request->getData('convoyeur_id');
            $data['depot_id'] = $this->request->getData('depot_id');
            $data['cartecarburant_id'] = $this->request->getData('cartecarburant_id');
            $data['totalht'] = $this->request->getData('total');
            $data['totaltva'] = $this->request->getData('tva');
            $data['totalfodec'] = $this->request->getData('fodec');
            $data['totalremise'] = $this->request->getData('remisee');
            $data['escompte'] = $this->request->getData('escompte');
            $data['tpe'] = $this->request->getData('tpecommande');
            $data['totalttc'] = $this->request->getData('totalttc');
            $data['payementcomptant'] = $this->request->getData('checkpayement');
            $data['poste'] = $this->request->getData('poste');
            $data['commande_id'] = $ids;
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $data['nbligne'] = $this->request->getData('nbligne');
            $data['Poids'] = $this->request->getData('Poids');
            $data['Coeff'] = $this->request->getData('Coeff');
            $data['pallette'] = $this->request->getData('pallette');
            $data['observation'] = $this->request->getData('observation');
            $data['chauffeur_id'] = $this->request->getData('chauffeur_id');
            $data['materieltransport_id'] = $this->request->getData('materieltransport_id');



            ///debug($data);



            $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $data);
            /// debug($bonlivraison);
            if ($this->Bonlivraisons->save($bonlivraison)) {
                //  debug($bonlivraison);
                $this->misejour("Bonlivraisons", "addbonlivraison", $ids);

                $bonlivraison_id = $bonlivraison->id;

                /// debug( $bonlivraison_id);

                // $commande->etatliv = '1';
                // $this->fetchTable('Commandes')->save($commande);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($bonlivraison_id);
                    // die;
                    $sommeqte = 0;
                    $sommeqtev = 0;

                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {

                        //  debug(intval($l['coefficientarticle']));

                        if ($l['sup'] != 1) {

                            $ligne = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            // debug($lignebonlivraisonn);


                            $tab['nouv_client'] = $this->request->getData('nouveau_client');
                            if (intval($l['coefficientarticle']) != 0) {
                                //  debug("jj");
                                $tab['nouv_article'] = "TRUE";
                            } else {
                                //   debug("false");
                                $tab['nouv_article'] = "FALSE";
                            }


                            $tab['bonlivraison_id'] = $bonlivraison_id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['lignecommande_id'] = $l['id'];
                            $tab['qte'] = $l['qte'];
                            $tab['ml'] = $l['ml'];

                            $tab['qtestock'] = $l['qteStock'];
                            $tab['punht'] = $l['prix'];
                            $tab['remise'] = $l['remise'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            // $tab['remise'] = $l['remise'];
                            $tab['fodec'] = $l['fodeccommandeclient'];
                            $tab['tva'] = $l['tva'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['prixht'] = $l['ht'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['montantht'] = $l['motanttotal'];
                            $tab['totalttc'] = $l['totalttc'];
                            $tab['escompte'] = $l['escompte'];
                            $tab['pourcentageescompte'] = $l['pourcentageescompte'];
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];
                            $tab['montantcommission'] = $l['montantcommission'];
                            $tab['commission'] = "FALSE";

                            // debug($tab);
                            // $lignecommande = $this->fetchTable('Lignecommandes')->get($l['id'], [
                            //     'contain' => []
                            // ]);

                            // $donne = $l['quantiteliv'] + $lignecommande['quantiteliv'];
                            // // debug($donne);
                            // $lignecommande->quantiteliv = $donne;

                            // $this->fetchTable('Lignecommandes')->save($lignecommande);
                            // //  debug($lignecommande);die;
                            // //  debug($tab);
                            // //$lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();


                            $ligne = $this->fetchTable('Lignebonlivraisons')->patchEntity($ligne, $tab);
                            //  debug($ligne);
                            $this->fetchTable('Lignebonlivraisons')->save($ligne);

                            foreach ($commande as $i => $com) {

                                $cmde = $this->Commandes->get($com['id'], [
                                    'contain' => [],
                                ]);

                                $cmde->bonlivraison_id = $bonlivraison_id;
                                $cmde->etatliv = '1';
                                $this->fetchTable('Commandes')->save($cmde);
                            }
                        }
                    }
                }






                // $lign = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                //     'contain' => ['Articles']
                // ])
                //     ->where(['commande_id' => $id]);

                // $test = 0;
                // foreach ($lign as $li) {
                //     if ($li['qte'] != $li['quantiteliv'])
                //         $test = 1;
                //     //  debug($li);
                //     //  die;
                // }

                // if ($test == 0) {
                //     //debug("hh");
                //     $commande->etatliv = '2';
                //     $this->fetchTable('Commandes')->save($commande);
                // }


                return $this->redirect(['action' => 'index/1']);
            }
        }
        $this->loadModel('Personnels');

        $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['Lignecommandes.commande_id   in (' . $ids . ')   ']);




        /*         * ************** Ensenble des clients (le nouveau et les anciens **** */


        $allclients = $this->fetchTable('Clients')->find('all')->order(['Clients.id' => 'DESC']);

        //        $clientc = $this->fetchTable('Clients')->get($commande->client_id, [
        //            'contain' => ['Delegations', 'Localites']
        //        ]);
        $clientc = $this->fetchTable('Clients')->get($client_id, [
            'contain' => ['Localites', 'Delegations', 'Typeclients']
        ]);
        $BL = $clientc->bl;
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

        // debug($clientc->typeclient->grandsurface);//die;
        // if ($typecl == 'false') {
        //     $cl = 'false';
        // } else {
        //     $cl = 'true';
        // }
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
        /*         * det nhot fiha id mtaa commande->client_id */
        $dett1 = '' . $client_id;
        //  debug($dett1);

        /** ken l client 3andou ancien client yodkhel lel if */
        if ($clientc->client_id != 0) {

            $dett1 = $dett1 . ',' . $clientc->client_id;
            /*             * det nzid fiha id ancien client */
            $c = $this->fetchTable('Clients')->get($clientc->client_id);
            foreach ($allclients as $cli) {
                if ($cli->client_id == $c->id && $c->client_id != 0) {

                    $dett1 = $dett1 . ',' . $c->client_id;
                    $c = $this->fetchTable('Clients')->get($cli->client_id);
                    // debug($c);
                }
            }
        }

        //   die;

        /*         * *****fin */ //
        //debug($client_id);
        ///////////////////////////////////////////////////////////////////////////////
        //    $cond3 = "Commandes.client_id = '" . $commande->client_id . "' ";
        $cond3 = 'Commandes.client_id in ( ' . $dett1 . ')';

        $comclient = $this->fetchTable('Commandes')->find('all')
            ->where([$cond3]);

        //debug($comclient);
        // $nbjour = 0;


        foreach ($lignecommandes as $li) {
            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id]);
            //  ->order(['Lignecommandes.commande_id' => 'DESC']);;
            $dett = '0';
            foreach ($ligness as $f) {
                // debug($f->commande_id); //die;
                $dett = $dett . ',' . $f->commande_id;

                //$dett = implode(", ", $f->commande_id);
            }
            // $dett=implode(',',$fam);
            // debug($dett);
            if ($dett != '') {
                $cond100 = 'Commandes.id in (' . $dett . ')';
            }
            $cond101 = 'Commandes.client_id in ( ' . $dett1 . ')';
            //   debug($dett);
            $coms = $this->fetchTable('Commandes')->find()
                ->select(["date" => 'Min(Commandes.date)'])
                ->where([$cond100]);

            $d = '';
            foreach ($coms as $c) {
                //     debug($c);

                $d = $c->date;
                // debug($d);
            }

            //   debug($d);


            $time = new FrozenTime($d);

            $m = $time->i18nFormat('Y-MM-dd');
            // debug($m);


            // $timecmd = new FrozenTime($commande->date);
            // $datecommande = $timecmd->i18nFormat('Y-MM-dd');

            //   debug($datecommande);die;
            //debug($li->article->nbjour);
            //debug($m);
            //  die;
            $date1 = date("Y-m-d H:i:s");//, strtotime($m . '+  2 days'));

            // if ($datecommande >= $date1) {
            //     $coeff = 0;
            // } else {

            //     $coeff = $li->article->coefficient; //echo 'else';
            // }

            // $tab[$li->article_id] = [
            //     'majarticle' => $coeff
            // ];


            $ligness = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['article_id' => $li->article_id])
                ->order(['Lignecommandes.commande_id' => 'DESC']);;


            foreach ($ligness as $ii) {

                // debug($commande->date);

                $cmd = $this->fetchTable('Commandes')->find()

                    //   ->where(['id' => $ii->commande_id, 'client_id' => $client_id])
                    ->where(["Commandes.client_id ='" . $client_id . "'"])
                    ->order(['Commandes.date' => 'ASC']);
                //   debug($cmd);


                foreach ($cmd as $c) {


                    //  debug($m);

                    $time = new FrozenTime($c->date);

                    $m = $time->i18nFormat('Y-MM-d');
                    $aujourdhui = date("Y-m-d");




                    $date1 = $date1 = date("Y-m-d H:i:s");;//date("Y-m-d", strtotime($m . '+ ' . $ii->article->nbjour . 'days'));
                    // debug($date1);
                    // $sumdate=$aujourdhui+$m;
                    // debug($sumdate);
                    if ($aujourdhui > $date1) {
                        //    debug('hh');
                        $coeff = 0;
                    } else {
                        // debug('kk');
                        $coeff = $ii->article->coefficient;
                        break;
                        // exit;
                    }


                    // debug($m);
                    $tab[$ii->article_id] = [
                        // 'date' => $m,
                        'majarticle' => $coeff
                    ];
                }
            }
        }










        foreach ($comclient as $com) {

            $lignecmds = $this->fetchTable('Commandes')->Lignecommandes->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['commande_id' => $com->id]);
            // debug($lignecmds);


            foreach ($lignecmds as $li) {
                // debug($li);

                foreach ($lignecommandes as $l) {
                    //debug($l);
                    if ($li->article_id == $l->article_id) {
                        /// debug($li->article->nbjour);
                        $nbjour = $li->article->nbjour;
                        //debug($nbjour);die;

                    }
                    if (!empty($nbjour)) {
                        //exit;
                    }
                }
            }


            /// debug($nbjour);
        }

        //      debug($tab);


        ////////////////////////////////////////////////////////////////////////////////
        // $a = $lignecommandes->count();
        //debug($a);


        /* $lignecommandes = $this->fetchTable('Commandes')->Lignecommandes->find('list')
          ->where(['commande_id' => $tab]);
          $data = $lignecommandes->toArray();


          debug(sizeof($data));
          die; */

        //$time = $commande->date;
        $m = $time->i18nFormat('Y-MM-d');
        // debug($m);

        $cond1 = "Clientexonerations.date_debut <= '" . $m . "' ";
        $cond2 = "Clientexonerations.date_fin >= '" . $m . "' ";
        // $cond3 = "Clientexonerations.client_id = '" . $commande->client_id . "' ";

        $exo = $this->fetchTable('Clientexonerations')->find('all', [
            'contain' => ['Typeexons']
        ])->where([$cond3, $cond1, $cond2]);
        // debug($exo);

        $exotpe = '';
        $exotimbre = '';
        $exofodec = '';
        $exotva = '';

        // foreach ($exo as $ex) {
        //     // debug($ex);
        //     // die;
        //     if (strtoupper($ex->typeexon->name) == 'TVA')
        //         $exotva = $ex->typeexon->name;

        //     if (strtoupper($ex->typeexon->name) == 'FODEC')
        //         $exofodec = $ex->typeexon->name;

        //     if (strtoupper($ex->typeexon->name) == 'TIMBRE')
        //         $exotimbre = $ex->typeexon->name;

        //     if (strtoupper($ex->typeexon->name) == 'TPE')
        //         $exotpe = $ex->typeexon->name;
        // }



       
        $clients = $this->fetchTable('Commandes')->Clients->find('all')->where(["Clients.etat " => 'TRUE']);

        //debug($clients);

        $depots = $this->Bonlivraisons->Depots->find('all');
        //debug($depots);
        $cartecarburants = $this->Bonlivraisons->Cartecarburants->find('list');
        
        $materieltransports = $this->fetchTable('Materieltransports')->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $chauffeurs = $this->Personnels->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(["Personnels.fonction_id" => 5 ]);
        
        $factureclients = $this->Bonlivraisons->Factureclients->find('list');
        $adresselivraisonclients = $this->Bonlivraisons->Adresselivraisonclients->find('list', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(['client_id' => $client_id]);

        $articles = $this->fetchTable('Articles')->find('all');



        $this->loadModel('Promoarticles');
        $this->loadModel('Gspromoarticles');


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

        
        $this->set(compact('payment', 'nv_client', 'remes', 'remcli', 'BL', 'not', 'gs', 'es', 'rz', 'cl', 'exotva', 'exofodec', 'exotpe', 'tab', 'bonus', 'commercial', 'clientc', 'lignecommandes', 'commande', 'mm', 'articles', 'bonlivraison', 'clients', 'depots', 'materieltransports', 'cartecarburants', 'chauffeurs', 'conffaieurs', 'factureclients', 'adresselivraisonclients', 'client_id', 'depot_id', 'tab'));
    }

    //////////////////////////////////


    public function addpreparatif($tab = null)
    {

        $commande = $this->fetchTable('Commandes')->find('all', [
            'contain' => ['Clients', 'Commercials', 'Depots']
        ])
            ->where(['Commandes.id   in (' . $tab . ')   ']);


        $valeur = $this->fetchTable('Bonusnouvclients')->find()->select(["valeur" =>
        'MAX(Bonusnouvclients.valeur)'])->first();
        // debug($num);

        $bonus = $valeur->valeur;
        $this->loadModel('Commandes');



        foreach ($commande as $i => $com) {





            // debug($com); 
            $dat[$i]['id'] = $com['id'];
            $dat[$i]['date'] = $com['date'];
            $dat[$i]['numero'] = $com['numero'];
            $dat[$i]['client_id'] = $com['client_id'];
            $dat[$i]['commercial_id'] = $com['commercial_id'];
            $dat[$i]['depot_id'] = $com['depot_id'];
            $dat[$i]['materieltransport_id'] = $com['materieltransport_id'];
            $dat[$i]['Raison_Sociale'] = $com['client']['Raison_Sociale'];
            $dat[$i]['commercial'] = $com['commercial']['name'];
            $dat[$i]['pointdevente_id	'] = $com['client']['pointdevente_id'];
            $dat[$i]['remise'] = $com['client']['remise'];
            $dat[$i]['name'] = $com['commercial']['name'];
            $dat[$i]['depot'] = $com['depot']['name'];
            $dat[$i]['remise'] = $com['remise'];
            $dat[$i]['total'] = $com['total'];
            $dat[$i]['totalttc'] = $com['totalttc'];
            $dat[$i]['escompte'] = $com['escompte'];
            $dat[$i]['pallette'] = $com['pallette'];
            $dat[$i]['Coeff'] = $com['Coeff'];
            $dat[$i]['Poids'] = $com['Poids'];
            $dat[$i]['nbligne'] = $com['nbligne'];
            $dat[$i]['etatliv'] = $com['etatliv'];
            $dat[$i]['nouv_client'] = $com['client']['nouveau_client'];




            $lignecommandes = $this->fetchTable('Lignecommandes')->find('all', [
                'contain' => ['Articles']
            ])
                ->where(['Lignecommandes.commande_id  =  (' . $com['id'] . ')       ']);

            ///debug($lignecommandes->toarray());


            //echo (json_encode($lignebonneliv));

            //   echo(json_encode($lignecommandes)) ; die ; 

            foreach ($lignecommandes as $j => $ligne) {
                // debug($ligne) ; 
                $lignebonneliv = $this->fetchTable('Lignebonlivraisons')->find(
                    'all',
                    [
                        'contain' => ['Bonlivraisons']
                    ]
                )
                    ->where(['Lignebonlivraisons.article_id  = (' . $ligne['article_id'] . ')  and Bonlivraisons.commande_id  = (' . $ligne['commande_id'] . ')    ']);


                $lignesbl = $this->fetchTable('Lignebonlivraisons')->find(
                    'all',
                    ['contain' => ['Bonlivraisons']]
                )->where(['Lignebonlivraisons.lignecommande_id  = (' . $ligne['id'] . ') and Bonlivraisons.commande_id  = (' . $ligne['commande_id'] . ') and Lignebonlivraisons.article_id  = (' . $ligne['article_id'] . ') ']);
                //echo (json_encode($lignesbl));


                //if ($quantite != 0) {

                $dat[$i]['Ligne'][$j]['qte'] = $ligne['qte'];
                $dat[$i]['Ligne'][$j]['quantiteliv'] = $ligne['quantiteliv'];
                $dat[$i]['Ligne'][$j]['lignecommande_id'] = $ligne['id'];
                $dat[$i]['Ligne'][$j]['commande_id'] = $ligne['commande_id'];
                $dat[$i]['Ligne'][$j]['article_id'] = $ligne['article_id'];
                $dat[$i]['Ligne'][$j]['nombrepiece'] = $ligne['article']['nombrepiece'];
                $dat[$i]['Ligne'][$j]['Poids'] = $ligne['article']['Poids'];
                $dat[$i]['Ligne'][$j]['Dsignation'] = $ligne['article']['Dsignation'];
                $dat[$i]['Ligne'][$j]['Code'] = $ligne['article']['Code'];
                $dat[$i]['Ligne'][$j]['remise'] = $ligne['article']['remise'];
                $dat[$i]['Ligne'][$j]['fodec'] = $ligne['article']['fodec'];
                $dat[$i]['Ligne'][$j]['TXTPE'] = $ligne['article']['TXTPE'];
                $dat[$i]['Ligne'][$j]['prix'] = $ligne['prix'];
                $dat[$i]['Ligne'][$j]['tva'] = $ligne['tva'];
                $dat[$i]['Ligne'][$j]['ttc'] = $ligne['ttc'];
                $dat[$i]['Ligne'][$j]['totalttc'] = $ligne['totalttc'];
                $dat[$i]['Ligne'][$j]['qtestock'] = $ligne['qtestock'];
                $dat[$i]['Ligne'][$j]['montantht'] = $ligne['montantht'];
                $dat[$i]['Ligne'][$j]['remise'] = $ligne['remise'];
                $dat[$i]['Ligne'][$j]['escompte'] = $ligne['escompte'];
                $dat[$i]['Ligne'][$j]['pourcentageescompte'] = $ligne['pourcentageescompte'];
                $dat[$i]['Ligne'][$j]['totremiseclient'] = $ligne['totremiseclient'];
                $dat[$i]['Ligne'][$j]['remiseclient'] = $ligne['remiseclient'];
                $dat[$i]['Ligne'][$j]['categorieclient'] = $ligne['categorieclient'];
                $dat[$i]['Ligne'][$j]['nbpoint'] = $ligne['article']['nbpoint'];
                $dat[$i]['valeurdepts'] =  $ligne['categorieclient'];


                //debug($dat);
                //}
            }
        }


        $this->loadModel('Preparatifs');
        $lis = '0';
        $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {



            ///////debug($this->request->getData());die;
            $p = $this->fetchTable('Preparatifs')->newEmptyEntity();

            $num = $this->Preparatifs->find()->select(["num" =>
            'MAX(Preparatifs.numero)'])->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            //debug($in);
            $mmm = str_pad("$in", 6, "0", STR_PAD_LEFT);

            $p['numero'] = $mmm;
            $p['date'] = date('Y-m-d H:i:s');
            $p['materieltransport_id'] = $this->request->getData('dat')['materieltransport_id'];
            $p['chauffeur_id'] = $this->request->getData('dat')['chauffeur_id'];
            $p['convoyeur_id'] = $this->request->getData('dat')['convoyeur_id'];
            $p['poidstotal'] = $this->request->getData('dat')['poids'];
            $p['nbcartons'] = $this->request->getData('dat')['nbcarton'];

            ///debug($p) ; die  ;
            ///
            $this->fetchTable('Preparatifs')->save($p);

            $preparatif_id = $p->id;
            $lis = $lis . ',' . $preparatif_id;
            // debug($this->request->getData()); 
            if (isset($this->request->getData('dat')['ligner']) && (!empty($this->request->getData('dat')['ligner']))) {

                foreach ($this->request->getData('dat')['ligner'] as $i => $com) {

                    ////debug($com);

                    $bonlivraison = $this->Bonlivraisons->newEmptyEntity();
                    //

                    $num = $this->Bonlivraisons->find()->select(["num" =>
                    'MAX(Bonlivraisons.numero)'])->first();
                    // debug($num);

                    $n = $num->num;
                    // $int=intval($n);
                    $in = intval($n) + 1;
                    //debug($in);
                    $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

                    $d['numero'] = $mm; //preparatif_id
                    $d['date'] = date('Y-m-d H:i:s');
                    $d['preparatif_id'] = $preparatif_id;
                    $d['commande_id'] = $com['id'];
                    $d['materieltransport_id'] = $this->request->getData('dat')['materieltransport_id'];
                    $d['chauffeur_id'] = $this->request->getData('dat')['chauffeur_id'];
                    $d['convoyeur_id'] = $this->request->getData('dat')['convoyeur_id'];
                    $d['client_id'] = $com['client_id'];
                    $d['commercial_id'] = $com['commercial_id'];
                    $d['depot_id'] = $com['depot_id'];
                    $d['total'] = $com['total'];
                    $d['totalttc'] = $com['totalttc'];
                    $d['totalht'] = $com['totalht'];
                    $d['totalfodec'] = $com['totalfodec'];
                    $d['totalremise'] = $com['totalremise'];
                    $d['totaltva'] = $com['totaltva'];
                    $d['poidstotal'] = $com['poidstotal'];
                    $d['nbcartons'] = $com['nbcartons'];
                    $d['pallette'] = $com['pallette'];
                    $d['Coeff'] = $com['Coeff'];
                    $d['Poids'] = $com['Poids'];
                    $d['nbligne'] = $com['nbligne'];
                    $d['escompte'] = $com['escompte'];
                    $d['typebl'] = 1;


                    //             debug($d); die ;


                    $bonlivraison = $this->Bonlivraisons->patchEntity($bonlivraison, $d);

                    // debug($bonlivraison);


                    if ($this->Bonlivraisons->save($bonlivraison)) {

                        ///debug($test);
                        $bonlivraison_id = $bonlivraison->id;

                        //  foreach ($lignecommandes as $j => $ligg) { 

                        if (isset($com['article']) && (!empty($com['article']))) {

                            $sommeqte = 0;
                            $sommeqtev = 0;
                            foreach ($com['article'] as $j => $bl) {
                                //debug($lignebonneliv->toarray());
                                // debug($cd);

                                ///  debug($bl);
                                $t = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();

                                $t['bonlivraison_id'] = $bonlivraison_id;
                                $t['qte'] = $bl['qte'];
                                $t['quantiteliv'] = $bl['quantiteliv'];
                                $t['qtestock'] = $bl['qtestock'];
                                $t['article_id'] = $bl['article_id'];
                                $t['remise'] = $bl['remise'];
                                $t['punht'] = $bl['prix'];
                                $t['tva'] = $bl['tva'];
                                $t['fodec'] = $bl['fodec'];
                                $t['totalttc'] = $bl['totalttc'];
                                $t['ttc'] = $bl['ttc'];
                                $t['montantht'] = $bl['montantht'];
                                $t['nombrepiece'] = $bl['nombrepiece'];
                                $t['TXTPE'] = $bl['TXTPE'];
                                $t['lignecommande_id'] =  $bl['ligneid'];
                                $t['escompte'] = $bl['escompte'];
                                $t['pourcentageescompte'] = $bl['pourcentageescompte'];
                                $t['totremiseclient'] = $bl['totremiseclient'];
                                $t['remiseclient'] = $bl['remiseclient'];
                                $t['montantcommission'] = $bl['montantcommission'];
                                $t['commission'] = "FALSE";

                                $this->fetchTable('Lignebonlivraisons')->save($t);
                                debug($t);
                                $test = 0;

                                $connection = ConnectionManager::get('default');
                                $qq = $connection->execute('SELECT SUM(lignebonlivraisons.quantiteliv)  as q FROM lignebonlivraisons where lignebonlivraisons.lignecommande_id=' . $bl['ligneid'] . ' ;')->fetchAll('assoc');
                                $q = $connection->execute('SELECT SUM(lignecommandes.qte)  as q FROM lignecommandes where lignecommandes.id=' . $bl['ligneid'] . ' ;')->fetchAll('assoc');

                                $quantitelivre = $qq[0]['q'];
                                $sommeqtev +=    $quantitelivre;

                                $quantitecomm = $q[0]['q'];
                                $sommeqte +=    $quantitecomm;

                                $this->loadModel('Commandes');

                                $cmde = $this->Commandes->get($com['id'], [
                                    'contain' => [],
                                ]);
                                $cmde->bonlivraison_id = $bonlivraison_id;
                                $this->fetchTable('Commandes')->save($cmde);
                                // debug($cmde);

                                if ($sommeqtev >= $sommeqte) {
                                    $test = 1;
                                }
                                /// debug($test);
                                if ($test == 1) {

                                    $cmde = $this->Commandes->get($com['id'], [
                                        'contain' => [],
                                    ]);
                                    $cmde->etatliv = '2';
                                    $this->fetchTable('Commandes')->save($cmde);

                                    ///   debug($cmde);
                                } else {
                                    $cmde = $this->Commandes->get($com['id'], [
                                        'contain' => [],
                                    ]);

                                    $cmde->etatliv = '1';
                                    $this->fetchTable('Commandes')->save($cmde);
                                    ///debug($cmde);

                                }
                            }
                        }
                    }
                }

                $lis = $lis;

?>

               

        <?php
            }
        }

        ?>


<?php




        //debug($dat) ; die ; 


        $chauffeurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id  = 1  "]);
        $conffaieurs = $this->fetchTable('Personnels')->find('all')->where(["Personnels.fonction_id  = 5 "]);
        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation  ']);
        $materieltransports = $this->Bonlivraisons->Materieltransports->find('list', ['keyfield' => 'id', 'valueField' => 'matricule']);
        $this->set(compact('conffaieurs', 'bonlivraison', 'dat', 'articles', 'materieltransports', 'commande', 'lignecommandes', 'lignebonneliv', 'chauffeurs', 'bonus'));
    }

    public function getpoidsmarticule()
    {
        $id = $this->request->getQuery('idMarticule');

        $materiel = $this->fetchTable('Materieltransports')->get($id);
        echo (json_encode($materiel));
        //debug($poidsmateriel) ; die() ; 

        die;
    }



    public function addoffre($tab = null)
    {
        error_reporting(E_ERROR | E_PARSE);
        $bonlivraison = $this->fetchTable('Bonlivraisons')->get($tab, [
            'contain' => ['Clients']
        ]);
        /// debug($bonlivraison);
        $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id' => $bonlivraison->id]);

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
        $commercials = $this->fetchTable('Bonlivraisons')->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $depots = $this->fetchTable('Depots')->find('list');

        $articles = $this->fetchTable('Articles')->find('all');
        $dates[0] = "Imperative";
        $dates[1] = "Interval";
        $commercial = $this->fetchTable('Commercials')->find()->where('Commercials.id=' . $bonlivraison->commercial_id);
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
        $yearf = date('Y');
       
        $currentYear = date('y');
        $num = $this->Bonlivraisons->find()->select(["num" => 'MAX(Bonlivraisons.numero)'])->where('Bonlivraisons.typebl=2')
        ->where('YEAR(Bonlivraisons.date)=' . $yearf)->first();
        $n = $num->num;

        if ($n) {
            // Extract the last 4 digits from the existing serial number and increment by 1
            $lastFourDigits = substr($n, -4);
            $in = intval($lastFourDigits) + 1;
        } else {
            // If no previous record found, start from 1111
            $in = '0001';
        }

        $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
        $mm = "DE{$currentYear}00{$mm}";
        //debug($mm);
        $commande = $this->Bonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());die;
            //  debug($this->request->getData());
            $data = $this->fetchTable('Bonlivraisons')->newEmptyEntity();
            $bonifclient = $this->fetchTable('Nombrecommandes')->find()->select(["nombre" =>
            'MAX(Nombrecommandes.nombrecommande)'])->first();

            $bonCli = $bonifclient->nombre;



            $yearf = date('Y');
       
        $currentYear = date('y');
        $num = $this->Bonlivraisons->find()->select(["num" => 'MAX(Bonlivraisons.numero)'])->where('Bonlivraisons.typebl=2')
        ->where('YEAR(Bonlivraisons.date)=' . $yearf)->first();
            $n = $num->num;

            if ($n) {
                // Extract the last 4 digits from the existing serial number and increment by 1
                $lastFourDigits = substr($n, -4);
                $in = intval($lastFourDigits) + 1;
            } else {
                // If no previous record found, start from 1111
                $in = '0001';
            }

            $mm = str_pad("$in", 4, "0", STR_PAD_LEFT);
            $mm = "DE{$currentYear}00{$mm}";


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
            $data->typebl = 2;
            $data->Montant_Regler = $this->request->getData('Montant_Regler');
            $data->totalht = $this->request->getData('total');
            $data->totaltva = $this->request->getData('tva');
            $data->totalfodec = $this->request->getData('fodec');
            $data->totalremise = $this->request->getData('remisee');
            $data->escompte = $this->request->getData('escompte');
            $data->totalttc = $this->request->getData('totalttc');



            if ($this->Bonlivraisons->save($data)) {


                $commande_id = $data->id;

                $bonlivraison->id_offredeprix = $commande_id;


                $this->Bonlivraisons->save($bonlivraison);





                $this->misejour("offre", "add", $commande_id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    // debug($this->request->getData('data')['ligner']);die;
                    $tab = [];
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //                        debug($l);


                        if ($l['sup'] != 1) {




                            $lignecommande = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();

                            $tab['bonlivraison_id'] = $commande_id;
                            $tab['article_id'] = $l['article_id'];
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
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];

                            //debug($tab);
                            //  $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();
                            $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            //  debug($lignecommande);
                            $this->fetchTable('Lignebonlivraisons')->save($lignecommande);
                            //debug($lignecommande); */
                        }
                    }
                }



                // debug($this->request->getData('Montant_Regler'));

                if ($this->request->getData('Montant_Regler') != '0' || $this->request->getData('Montant_Regler') != 0) {

                    /*******enregistrement reglement******************************/

                    $numeroobj = $this->fetchTable('Reglementclients')->find()->select(["numero" =>
                    'MAX(Reglementclients.numeroconca)'])->where('Reglementclients.type=0')->first();
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
                    $tab2['client_id'] = $data->client_id;
                    $tab2['numero'] =  $data->numero;
                    $tab2['numeroconca'] = $code;

                    $frozenTime = FrozenTime::now();
                    $tab2['Date'] = $frozenTime;
                    $tab2['Montant'] = $this->request->getData('Montant_Regler');
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
                    $t['reglementclient_id'] = $reglement_id;
                    $t['bonlivraison_id'] = $data->id;
                    $t['Montant'] = $this->request->getData('Montant_Regler');
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
                                if ($p['paiement_id'] != 1) {
                                    $table['echance'] = $p['echance'];
                                }
                                $table['banque_id'] = $p['banque'];
                                $table['acomptetype'] = 1;
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



                return $this->redirect(['action' => 'index/2']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }




        $paiements = $this->fetchTable('Paiements')->find('list');
        $valeurs = $this->fetchTable('Tos')->find('list');
        $caisses = $this->fetchTable('Caisses')->find('list');
        $banques = $this->fetchTable('Banques')->find('list');





        $this->set(compact('banques', 'caisses', 'valeurs', 'paiements', 'cl', 'escompte', 'exotva', 'exofodec', 'exotpe', 'bonus', 'clientc', 'dates', 'commande', 'bonlivraison', 'lignebonlivraisons', 'mm', 'articles', 'commercials', 'clients', 'depots', 'es', 'rz', 'typecl', 'remcli', 'not'));
    }






    public function adddevis($tab = null)
    {


        $bonlivraison = $this->fetchTable('Bonlivraisons')->get($tab, [
            'contain' => ['Clients']
        ]);
        /// debug($bonlivraison);
        $lignebonlivraisons = $this->fetchTable('Lignebonlivraisons')->find('all', [
            'contain' => ['Articles']
        ])
            ->where(['bonlivraison_id' => $bonlivraison->id]);

        $clients = $this->fetchTable('Bonlivraisons')->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale'])->where(["Clients.etat " => 'TRUE']);
        $commercials = $this->fetchTable('Bonlivraisons')->Commercials->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $depots = $this->fetchTable('Depots')->find('list');

        $articles = $this->fetchTable('Articles')->find('all');
        $dates[0] = "Imperative";
        $dates[1] = "Interval";
        $commercial = $this->fetchTable('Commercials')->get($bonlivraison->commercial_id);
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

        $num = $this->Bonlivraisons->find()->select(["num" =>
        'MAX(Bonlivraisons.numero)'])->where('Bonlivraisons.typebl=2')->first();
        //debug($num);


        $n = $num->num;
        $int = intval($n);
        $in = intval($n) + 1;
        //debug($in);
        $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);
        //debug($mm);
        $commande = $this->Bonlivraisons->newEmptyEntity();
        if ($this->request->is('post')) {
            //debug($this->request->getData());die;
            // debug($this->request->getData());
            $data = $this->fetchTable('Bonlivraisons')->newEmptyEntity();
            $bonifclient = $this->fetchTable('Nombrecommandes')->find()->select(["nombre" =>
            'MAX(Nombrecommandes.nombrecommande)'])->first();

            $bonCli = $bonifclient->nombre;
            // $commandeCli = $this->Commandes->find()
            //   ->where(["Commandes.client_id=" . $this->request->getData('client_id') . " "])->count();

            // if ($commandeCli + 1 == $bonCli) {
            //     // debug('hh');
            //     $client = $this->fetchTable('Clients')->get($this->request->getData('client_id'), [
            //         'contain' => []
            //     ]);
            //     $client->nouveau_client = 'FALSE';
            //     $this->fetchTable('Clients')->save($client);
            //     $data->dateupdateclient = $this->request->getData('date');
            // }


            /////////////////////////
            $num = $this->Bonlivraisons->find()->select(["num" =>
            'MAX(Bonlivraisons.numero)'])->where('Bonlivraisons.typebl=2')->first();
            // debug($num);

            $n = $num->num;
            // $int=intval($n);
            $in = intval($n) + 1;
            // debug($n);
            $mm = str_pad("$in", 6, "0", STR_PAD_LEFT);

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
            $data->typebl = 2;
            //debug($this->request->getData('totalfodec'));

            // $commande = $this->Commandes->patchEntity($commande, $this->request->getData());
            // debug($data);
            if ($this->Bonlivraisons->save($data)) {


                $commande_id = $data->id;



                $this->misejour("devis", "add", $commande_id);
                if (isset($this->request->getData('data')['ligner']) && (!empty($this->request->getData('data')['ligner']))) {
                    //debug($this->request->getData('data')['ligner']);die;
                    $tab = [];
                    foreach ($this->request->getData('data')['ligner'] as $i => $l) {
                        //                        debug($l);


                        if ($l['sup'] != 1) {




                            $lignecommande = $this->fetchTable('Lignebonlivraisons')->newEmptyEntity();
                            $tab['bonlivraison_id'] = $commande_id;
                            $tab['article_id'] = $l['article_id'];
                            $tab['qte'] = $l['qte'];
                            $tab['qtestock'] = $l['qteStock'];
                            $tab['punht'] = $l['prix'];
                            $tab['remise'] = $l['remise'];
                            $tab['totaltva'] = $l['monatantlignetva'];
                            $tab['fodec'] = $l['fodec'];
                            $tab['tva'] = $l['tva'];
                            $tab['ttc'] = $l['ttc'];
                            $tab['quantiteliv'] = $l['quantiteliv'];
                            $tab['totremiseclient'] = $l['totremiseclient'];
                            $tab['remiseclient'] = $l['remiseclient'];
                            //debug($tab);
                            //  $lignecommande = $this->fetchTable('Lignecommandes')->newEmptyEntity();
                            $lignecommande = $this->fetchTable('Lignecommandes')->patchEntity($lignecommande, $tab);
                            //  debug($lignecommande);
                            $this->fetchTable('Lignebonlivraisons')->save($lignecommande);
                            //debug($lignecommande); */
                        }
                    }
                }


                return $this->redirect(['action' => 'index/2']);
            }
            //$this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Commande'));
        }

        $paiements = $this->fetchTable('Paiements')->find('list');





        $this->set(compact('paiements', 'cl', 'escompte', 'exotva', 'exofodec', 'exotpe', 'bonus', 'clientc', 'dates', 'commande', 'bonlivraison', 'lignebonlivraisons', 'mm', 'articles', 'commercials', 'clients', 'depots', 'es', 'rz', 'typecl', 'remcli', 'not'));
    }

    public function verif()
    {
        $id = $this->request->getQuery('id');
        $lignereg = $this->fetchTable('Lignereglementclients')->find('all')->where(['Lignereglementclients.bonlivraison_id =' . $id])->count();


        echo json_encode(array('lignereg' => $lignereg));
        die;
    }


    public function etatcaisse()
    {
        error_reporting(E_ERROR | E_PARSE);

        $this->loadModel('Piecereglementclients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Lignereglementclients');
        $this->loadModel('Caisses');
        $this->loadModel('Clients');
        $this->loadModel('Paiements');
        $this->loadModel('Depenses');
        $caisse_id = $this->request->getQuery('caisse_id');
        $historiquede = $this->request->getQuery('historiquede');
        $au = $this->request->getQuery('au');
        $clientData = [];
        $clientNames = [];
        $clientDates = [];
        $conditions = [];
        if ($historiquede) {
            $conditions[] = ["Reglementclients.date >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditions[] = ["Reglementclients.date <='" . $au . "'"];
        }
        $conditionsdepense = [];
        if ($historiquede) {
            $conditionsdepense[] = ["Depenses.date >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionsdepense[] = ["Depenses.date <='" . $au . "'"];
        }
        $conditionstransfert = [];
        if ($historiquede) {
            $conditionstransfert[] = ["Transferecaisses.date >= '" . $historiquede . "'"];
        }
        if ($au) {
            $conditionstransfert[] = ["Transferecaisses.date <='" . $au . "'"];
        }
        if ($caisse_id !== null) {

            // ************************** Pour Calcul total Debit/credit sans periode***************************************//
            $reglementstot = $this->Piecereglementclients->find()->select(['montant', 'reglementclient_id', 'paiement_id', 'num'])->where(['caisse_id' => $caisse_id])->all();
            $depensestot  = $this->Depenses->find()->where(['caisse_id' => $caisse_id])->all();
            $transfertdepartstot  = $this->fetchTable('Transferecaisses')->find()->where(['caisse_id' => $caisse_id])->all();
            $transfertarrivestot  =  $this->fetchTable('Transferecaisses')->find()->where(['id_caisse' => $caisse_id])->all();
            $thiscaisse = $this->Caisses->find()->where('Caisses.id=' . $caisse_id)->first();

            $credit_all = $thiscaisse->montant;
            $debit_all = 0;


            foreach ($reglementstot as $reglement) {
                $reglement_id = $reglement->reglementclient_id;

                $reglementclient = [];
                $lignereg = [];
                $numeroBon = [];
                if ($reglement_id != null) {
                    $reglementclient = $this->Reglementclients->find()->select(['client_id', 'Date', 'numeroconca'])->where(['id' => $reglement_id])->first();
                    $lignereg = $this->Lignereglementclients->find()->select(['Montant', 'bonlivraison_id', 'commande_id'])->where(['Lignereglementclients.reglementclient_id' => $reglement_id])->first();
                    $numeroBon = $this->Bonlivraisons->find()->select(['numero'])->where(['id' => $lignereg->bonlivraison_id])->first();
                }
                if ($reglementclient) {

                    $credit_all += $reglement->montant;
                }
            }

            foreach ($depensestot as $depense) {
                $debit_all += $depense->montant;
            }


            foreach ($transfertdepartstot as $transfertdepart) {

                $debit_all += $transfertdepart->montant;
            }


            foreach ($transfertarrivestot as $transfertarrive) {

                $credit_all += $transfertarrive->montant;
            }

            // *****************************************************************//
            $reglements = $this->Piecereglementclients->find()->select(['montant', 'reglementclient_id', 'paiement_id', 'num'])->where(['caisse_id' => $caisse_id])->all();
            debug($reglements);
            $depenses = $this->Depenses->find()->where(['caisse_id' => $caisse_id, $conditionsdepense])->all();
            $transfertdeparts = $this->fetchTable('Transferecaisses')->find()->where(['caisse_id' => $caisse_id, $conditionstransfert])->all();
            $transfertarrives =  $this->fetchTable('Transferecaisses')->find()->where(['id_caisse' => $caisse_id, $conditionstransfert])->all();

            $thiscaisse = $this->Caisses->find()->where('Caisses.id=' . $caisse_id)->first();


            $clientData[] = [
                'type' => '<strong style="color:green">Solde initial</strong>',
                'credit' => $thiscaisse->montant,
                'index' => '1',
            ];
            foreach ($reglements as $reglement) {
                $reglement_id = $reglement->reglementclient_id;
                $paiement_id = $reglement->paiement_id;
                $reglementclient = [];
                $lignereg = [];
                $numeroBon = [];
                if ($reglement_id != null) {
                    $reglementclient = $this->Reglementclients->find()->select(['client_id', 'Date', 'numeroconca'])->where(['id' => $reglement_id, $conditions])->first();
                    $lignereg = $this->Lignereglementclients->find()->select(['Montant', 'bonlivraison_id', 'commande_id'])->where(['Lignereglementclients.reglementclient_id' => $reglement_id])->first();
                    $numeroBon = $this->Bonlivraisons->find()->select(['numero'])->where(['id' => $lignereg->bonlivraison_id])->first();
                }

                if ($reglementclient) {
                    $client = $this->Clients->find()->select(['Raison_Sociale'])->where(['id' => $reglementclient->client_id])->first();
                }
                $paiement = $this->Paiements->find()->select(['name'])->where(['id' => $paiement_id])->first();
                if ($lignereg && isset($client->Raison_Sociale) && $reglementclient && $reglementclient->Date) {

                    // debug($lignereg);

                    if ($lignereg->bonlivraison_id != null) {
                        $bl = $this->fetchTable('Bonlivraisons')->find()->where(['id' => $lignereg->bonlivraison_id])->first();
                    }

                    if ($lignereg->commande_id != null) {
                        $cmd = $this->fetchTable('Commandes')->find()->where(['id' => $lignereg->commande_id])->first();
                    }
                    $clientData[] = [
                        'cmd' =>  $cmd->numero,
                        'bl' => $bl->numero,
                        'name' => $client->Raison_Sociale,
                        'date' => $reglementclient->Date->format('Y-m-d'),
                        'paiement_name' => $paiement->name,
                        'credit' => $reglement->montant,
                        'num' => $reglementclient->numeroconca,
                        'type' => 'Réglement',
                        'index' => '2',

                    ];
                }
            }

            foreach ($depenses as $depense) {

                // debug($depense);

                $paiement = $this->Paiements->find()->select(['name'])->where(['id' => $depense->paiement_id])->first();
                $caissedepart = $this->fetchTable('Caisses')->find()->where(['id' => $depense->caisse_id])->first();


                $clientData[] = [
                    'caissedep' => $caissedepart->name,
                    'name' => '',
                    'date' => $depense->date,
                    'paiement_name' => $paiement->name,
                    'debit' => $depense->montant,
                    'num' => $depense->numero,
                    'type' => 'Dépense',
                    'index' => '3',

                ];
            }


            foreach ($transfertdeparts as $transfertdepart) {

                //  debug($transfertdepart);

                $caissedepart = $this->fetchTable('Caisses')->find()->where(['id' => $transfertdepart->caisse_id])->first();

                $caissearrive = $this->fetchTable('Caisses')->find()->where(['id' => $transfertdepart->id_caisse])->first();

                $clientData[] = [
                    'caissedep' => $caissedepart->name,
                    'caissearr' => $caissearrive->name,
                    'name' => '',
                    'date' => $transfertdepart->date,
                    // 'paiement_name' => $paiement->name,
                    'debit' => $transfertdepart->montant,
                    'num' => $transfertdepart->numero,
                    'type' => 'Transfert caisse/caisse',
                    'index' => '4',

                ];
            }


            foreach ($transfertarrives as $transfertarrive) {

                // debug($depense);
                $caissedepart = $this->fetchTable('Caisses')->find()->where(['id' => $transfertarrive->caisse_id])->first();

                $caissearrive = $this->fetchTable('Caisses')->find()->where(['id' => $transfertarrive->id_caisse])->first();

                $clientData[] = [
                    'caissedep' => $caissedepart->name,
                    'caissearr' => $caissearrive->name,
                    'name' => '',
                    'date' => $transfertarrive->date,
                    // 'paiement_name' => $paiement->name,
                    'credit' => $transfertarrive->montant,
                    'num' => $transfertarrive->numero,
                    'type' => 'Transfert caisse/caisse',
                    'index' => '5',

                ];
            }
        }
        $caisses = $this->Caisses->find('list', ['keyField' => 'id', 'valueField' => 'name']);
        $this->set(compact('caisses', 'caisse_id', 'clientData', 'credit_all', 'debit_all'));
    }
}
