<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

/**
 * Statistiques Controller
 *
 * @property \App\Model\Table\StatistiquesTable $Statistiques
 * @method \App\Model\Entity\Statistique[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatistiquesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function statistiquezone()
    {

        $connection = ConnectionManager::get('default');
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $cond15 = '';




        // debug($datedebut);
        if ($this->request->getQuery('datedebut')) {
            $datedebut = $this->request->getQuery('datedebut');
        } else {
            $datedebut = date('01-m-Y');
        }
        if ($this->request->getQuery('datefin')) {
            $datefin = $this->request->getQuery('datefin');
        } else {
            $datefin = date('d-m-Y');
        }
        if ($this->request->getQuery()) {
            $gouvernorat_id = $this->request->getQuery('gouvernorat_id');
            $zone = $this->request->getQuery('zone_id');
            if ($zone) {
                // $det = '0';
                // $zonedelegations = $this->fetchTable('Zonedelegations')->find('all')
                //     ->where(['zone_id =' . $zone]);
                // //  debug($zonedelegations);
                // foreach ($zonedelegations as $a) {
                //     //debug($a);
                //     $det = $det . ',' . $a->id;
                // }


                // $lignezonedelegations = $this->fetchTable('Lignezonedelegations')->find('all')
                //     ->where(['Lignezonedelegations.zonedelegation_id  in ( ' . $det . ')']);

                // $det1 = '0';
                // foreach ($lignezonedelegations as $b) {

                //     $det1 = $det1 . ',' . $b->delegation_id;
                // }


                /// debug($det1);
                // $cond10 = 'Clients.delegation_id in ( ' . $det1 . ')';
                $conds = " AND zones.id=" . $zone . "";
            }

            $article = $this->request->getQuery('article_id');
            // if ($article) {
            //     $lignefact = $this->fetchTable('Lignefactureclients')->find('all')->where(["Lignefactureclients.article_id=" . $article]);
            //     $detarticle = '0';
            //     foreach ($lignefact as $art) {
            //         //   debug($art);
            //         $detarticle = $detarticle . ',' . $art->factureclient_id;
            //     }
            //     //  debug($lignecommandes);
            // }
            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
            }
            // $query = $this->fetchTable('Factureclients')->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9, $cond10, $cond12, $cond14, $cond15])
            // ->order(['Factureclients.numero' => 'DESC']);

            // $this->paginate = [
            //     'contain' => ['Clients', 'Depots']
            // ];
            $cond = "";
            $condd = "";
            $conartt = "";
            $conart = "";
            if ($article) {
                $factt = "";
                $lignfactclients = $connection->execute('SELECT  factureclient_id FROM lignefactureclients WHERE article_id =' . $article . ';')->fetchAll('assoc');
                foreach ($lignfactclients as $key => $lignfactt) {
                    if ($lignfactt['factureclient_id'] != null) {
                        $factt = $factt . ',' . $lignfactt['factureclient_id'];
                    }
                }
                $conart = "Articles.id=" . $article;

                if ($factt != "") {
                    $det3 = substr($factt, 1);
                    $cond = " AND lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
                    $condd = " lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
                }
            }
            $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);

            // echo "SELECT  lignefactureclients.article_id FROM lignefactureclients,factureclients WHERE factureclients.id=lignefactureclients.factureclient_id AND  $cond4 AND $cond  $cond2 $cond3 GROUP BY lignefactureclients.article_id;";//die;
            $tabs = array();
            $j = -1;
            foreach ($articless as $i => $art) {

                // echo "SELECT  clients.Raison_Sociale as name,lignefactureclients.article_id,factureclients.client_id,sum(lignefactureclients.qte) as qte FROM lignefactureclients,factureclients,articles,clients WHERE lignefactureclients.article_id=articles.id and factureclients.client_id=clients.id and factureclients.id=lignefactureclients.factureclient_id  AND  $condss AND lignefactureclients.article_id =$art->id  $cond2 $cond3 GROUP BY factureclients.client_id;";die;
                $arts = $connection->execute("SELECT  zones.name as name,zones.id as id, lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons,bonlivraisons,articles,clients,delegations,zonedelegations,zones,lignezonedelegations WHERE lignebonlivraisons.article_id=articles.id AND clients.delegation_id=delegations.id AND delegations.id=lignezonedelegations.delegation_id AND zonedelegations.id=lignezonedelegations.zonedelegation_id And zonedelegations.zone_id=zones.id  and bonlivraisons.client_id=clients.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $conds GROUP BY zones.id ORDER BY qte DESC;")->fetchAll('assoc');

                $j++;
                //  debug($art);die;

                foreach ($arts as $j => $cl) {
                    if ($cl['qte'] != 0 && $cl['qte'] != '') {
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];

                        $tabs[$i]['client'][$j]['client_id'] = $cl['client_id'];
                        $tabs[$i]['client'][$j]['name'] = $cl['name'];
                        $tabs[$i]['client'][$j]['qte'] = $cl['qte'];
                    }
                }
                //$tab[$i]['article_id'][$j]['qte']=$art['qte'];
            }
            if (!empty($article) && empty($zone)) {
                $conartt = " AND articles.id = '" . $article . "' ";
                $articles = $connection->execute("SELECT articles.Code as Code, lignebonlivraisons.article_id, sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons, bonlivraisons, articles WHERE lignebonlivraisons.article_id = articles.id AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id $conartt GROUP BY article_id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
                // debug($articles);
                foreach ($articles as $article) {
                    $article_id = $article['article_id'];
                    $arts1 = $connection->execute("SELECT  zones.name as name,zones.id as id, lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons,bonlivraisons,articles,clients,delegations,zonedelegations,zones,lignezonedelegations WHERE lignebonlivraisons.article_id=articles.id AND clients.delegation_id=delegations.id AND delegations.id=lignezonedelegations.delegation_id AND zonedelegations.id=lignezonedelegations.zonedelegation_id And zonedelegations.zone_id=zones.id  and bonlivraisons.client_id=clients.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$article_id $cond2 $cond3 $conds GROUP BY zones.id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
                    // debug($arts1);
                    foreach ($arts1 as $j => $cl1) {

                        if ($cl1['qte'] != '') {
                            $tabs1[$i]['article_id'] = $art['id'];
                            $tabs1[$i]['nom'] = $art['Dsignation'];
                            $tabs1[$i]['client'][$j]['client_id'] = $cl1['client_id'];
                            $tabs1[$i]['client'][$j]['name'] = $cl1['name'];
                            $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];
                        }
                    }
                }
            }
            if (!empty($zone) && empty($article)) {

                $conartt = ' zones.id = ' . $zone;
                $arts1 = $connection->execute("SELECT articles.Dsignation ,zones.id as id, lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons,bonlivraisons,articles,clients,delegations,zonedelegations,zones,lignezonedelegations WHERE lignebonlivraisons.article_id=articles.id AND clients.delegation_id=delegations.id AND delegations.id=lignezonedelegations.delegation_id AND zonedelegations.id=lignezonedelegations.zonedelegation_id And zonedelegations.zone_id=zones.id  and bonlivraisons.client_id=clients.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND $conartt $cond2 $cond3 $conds GROUP BY lignebonlivraisons.article_id, articles.Dsignation ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');

                foreach ($arts1 as $j => $cl1) {
                    if ($cl1['qte'] != '') {
                        $tabs1[$i]['article_id'] = $cl1['article_id'];
                        $tabs1[$i]['nom'] = $cl1['Dsignation']; // Utiliser la bonne clé
                        $tabs1[$i]['client'][$j]['client_id'] = $cl1['client_id'];
                        $tabs1[$i]['client'][$j]['name'] = $cl1['Dsignation'];
                        $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];
                    }
                }
            }
            foreach ($tabs1 as $i => $art) {
                usort($tabs1[$i]['client'], function ($a, $b) {
                    return $b['qte'] - $a['qte'];
                });
                $tabs1[$i]['client'] = array_slice($tabs1[$i]['client'], 0, 15, true);
            }
        }
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
        $zones = $this->fetchTable('Zones')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $zoness = $this->fetchTable('Zones')->find('all')->where([$conds]);

        $this->set(compact('tabs', 'tabs1', 'datedebut', 'datefin', 'zoness', 'cond2', 'cond3', 'condd', 'cond', 'articles', 'benefice', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'zones', 'datedebut', 'datefin', 'client_id'));
    }

    public function chiffreaffaire()
    {
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $conds = '';
        $cond15 = '';
        $datedebut = date('01-m-Y');
        $datefin = date('d-m-Y');
        $condFamille = '';

        $client_id = $this->request->getQuery('client_id');
        $article = $this->request->getQuery('article_id');
        $commercial_id = $this->request->getQuery('commercial_id');
        $famille_id = $this->request->getQuery('famille_id');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $annee = $this->request->getQuery('annee');

        $connection = ConnectionManager::get('default');
        $cond4 = "";
        $condf4 = "";
        $cond = "1=1";
        $condd = "1=1";
        $conart = "";
        $conartt = "";
        $condss = "";
        $condannee = "";
        $condFamille = "";

        $condcom = "1=1";
        $condcomss = "";
        $condcomsss = "";

        $condp = "";
        $condpp = "1=1";
        $condppp = "";

        if ($this->request->getQuery()) {
            $datedebut = $this->request->getQuery('datedebut');
            $datefin = $this->request->getQuery('datefin');
            if ($famille_id) {
                $condFamille = "AND articles.famille_id = '" . $famille_id . "' ";
            }
            if ($article) {
                $conart = "Articles.id = '" . $article . "' ";
            }
            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = " AND bonlivraisons.date <= '" . $datefin . " 23:59:59' ";
            }
            if ($annee) {
                $condannee = " AND YEAR(bonlivraisons.date) = '" . $annee . "'";
            }
            if ($client_id) {
                $conds = "clients.id = '" . $client_id . "' ";
                $condss = ' AND clients.id = ' . $client_id;
            }
            if ($commercial_id) {
                $condcomss = "commercials.id = '" . $commercial_id . "' ";
                $condcomsss = ' AND commercials.id = ' . $commercial_id;
            }
            if ($pointdevente_id) {
                $condp = " AND depots.pointdevente_id = '" . $pointdevente_id . "' ";
                // debug($condp);die;
                $condpp = "depots.pointdevente_id = '" . $pointdevente_id . "' ";
                $condppp = ' AND pointdeventes.id = ' . $pointdevente_id;
            }
            $articless = $this->fetchTable('Articles')->find('all')->where([$conart]);

            $tabs = array();
            $j = -1;
            $totalqte = 0;
            $totalttc = 0;
            $totalht = 0;
            foreach ($articless as $i => $art) {
                $arts = $connection->execute("SELECT articles.id as article_id, SUM(lignebonlivraisons.prixht) as prixht, SUM(lignebonlivraisons.ttc) as ttc,
             SUM(lignebonlivraisons.qte) as qte FROM lignebonlivraisons 
             LEFT JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
             LEFT JOIN articles ON articles.id = lignebonlivraisons.article_id  
            LEFT JOIN clients ON clients.id = bonlivraisons.client_id  
         
            LEFT JOIN depots ON depots.id = bonlivraisons.depot_id  


             WHERE lignebonlivraisons.article_id = $art->id  $cond2 $cond3  $condss $condannee $condFamille AND bonlivraisons.factureclient_id !=0 GROUP BY lignebonlivraisons.article_id;")->fetchAll('assoc');
                $j++;

                foreach ($arts as $j => $cl) {
                    if ($cl['qte'] != '') {
                        $tabs[$i]['prixht'] = $cl['prixht'];
                        $tabs[$i]['ttc'] = $cl['ttc'];
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];
                        $tabs[$i]['qte'] = $cl['qte'];
                        $totalht += $tabs[$i]['prixht'];
                        $totalqte += $tabs[$i]['qte'];
                        $totalttc += $tabs[$i]['ttc'];
                    }
                }
            }

            $tabs1 = array();

            if (!empty($article) && empty($annee)) {
                $conartt = " AND articles.id = '" . $article . "' ";
                $articles = $connection->execute(
                    "
                SELECT articles.Code as Code, lignebonlivraisons.article_id, SUM(lignebonlivraisons.qte) as qte 
                FROM lignebonlivraisons, bonlivraisons, articles , clients  , depots 
                WHERE lignebonlivraisons.article_id = articles.id 
                AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
                AND bonlivraisons.factureclient_id != 0
                $conartt $condss $condFamille 
             
                GROUP BY article_id 
                ORDER BY qte DESC 
                LIMIT 15;"
                )->fetchAll('assoc');
                foreach ($articles as $article) {
                    $article_id = $article['article_id'];
                    $arts1 = $connection->execute(
                        "
                    SELECT articles.Code as Code, articles.Dsignation as name, lignebonlivraisons.article_id,
                    SUM(lignebonlivraisons.qte) as qte
                    FROM lignebonlivraisons, bonlivraisons,articles  ,clients ,depots 
                    WHERE lignebonlivraisons.article_id = articles.id
                    AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id
                    AND bonlivraisons.factureclient_id != 0
                    AND lignebonlivraisons.article_id = $article_id

                    GROUP BY lignebonlivraisons.article_id
                    ORDER BY qte DESC
                    LIMIT 15;"
                    )->fetchAll('assoc');

                    foreach ($arts1 as $j => $cl1) {
                        if ($cl1['qte'] != '') {
                            $tabs1[] = array(
                                'article_id' => $article_id,
                                'nom' => $cl1['name'],
                                'qte' => $cl1['qte']
                            );
                        }
                    }
                }
            }

            $cout = 0;
            $cha = "TRUE";
            $benefice = $totalttc - $cout;

            $cond = "";
            $condd = "";
        }
        $cha = "TRUE";
       // $articles = $this->fetchTable('Articles')->find('all');
       // $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);
        $articles = $this->fetchTable('Articles')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['code'] . ' ' . $row['Dsignation'];
            }
        ]);
        $familles = $this->fetchTable('Familles')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');
        $sites = $this->fetchTable('Pointdeventes')->find('all');

        $this->set(compact('tabs', 'tabs1', 'sites', 'famille_id', 'commercial_id', 'pointdevente_id', 'familles', 'commercials', 'articless', 'benefice', 'condannee', 'annee', 'totalht', 'totalqte', 'totalttc', 'cond3', 'cond2', 'cond', 'condd', 'cout', 'article', 'totalttc', 'articles', 'clients', 'datedebut', 'datefin', 'client_id'));
    }
    public function impca()
    {
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $conds = '';
        $cond15 = '';
        $datedebut = date('01-m-Y');
        $datefin = date('d-m-Y');
        $condFamille = '';

        $client_id = $this->request->getQuery('client_id');
        $article = $this->request->getQuery('article_id');
        $commercial_id = $this->request->getQuery('commercial_id');
        $famille_id = $this->request->getQuery('famille_id');
        $pointdevente_id = $this->request->getQuery('pointdevente_id');
        $annee = $this->request->getQuery('annee');

        $connection = ConnectionManager::get('default');
        $cond4 = "";
        $condf4 = "";
        $cond = "1=1";
        $condd = "1=1";
        $conart = "";
        $conartt = "";
        $condss = "";
        $condannee = "";
        $condFamille = "";

        $condcom = "1=1";
        $condcomss = "";
        $condcomsss = "";

        $condp = "";
        $condpp = "1=1";
        $condppp = "";

        if ($this->request->getQuery()) {
            $datedebut = $this->request->getQuery('datedebut');
            $datefin = $this->request->getQuery('datefin');
            if ($famille_id) {
                $condFamille = "AND articles.famille_id = '" . $famille_id . "' ";
            }
            if ($article) {
                $conart = "Articles.id = '" . $article . "' ";
            }
            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = " AND bonlivraisons.date <= '" . $datefin . " 23:59:59' ";
            }
            if ($annee) {
                $condannee = " AND YEAR(bonlivraisons.date) = '" . $annee . "'";
            }
            if ($client_id) {
                $conds = "clients.id = '" . $client_id . "' ";
                $condss = ' AND clients.id = ' . $client_id;
            }
            if ($commercial_id) {
                $condcomss = "commercials.id = '" . $commercial_id . "' ";
            }
            if ($pointdevente_id) {
                $condp = " AND depots.pointdevente_id = '" . $pointdevente_id . "' ";
                // debug($condp);die;
                $condpp = "depots.pointdevente_id = '" . $pointdevente_id . "' ";
                $condppp = ' AND pointdeventes.id = ' . $pointdevente_id;
            }
            $articless = $this->fetchTable('Articles')->find('all')->where([$conart]);

            $tabs = array();
            $j = -1;
            $totalqte = 0;
            $totalttc = 0;
            $totalht = 0;
            foreach ($articless as $i => $art) {
                $arts = $connection->execute("SELECT articles.id as article_id, SUM(lignebonlivraisons.prixht) as prixht, SUM(lignebonlivraisons.ttc) as ttc,
             SUM(lignebonlivraisons.qte) as qte FROM lignebonlivraisons 
             LEFT JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
             LEFT JOIN articles ON articles.id = lignebonlivraisons.article_id  
            LEFT JOIN clients ON clients.id = bonlivraisons.client_id  
             LEFT JOIN commercials ON commercials.id = bonlivraisons.commercial_id  
            LEFT JOIN depots ON depots.id = bonlivraisons.depot_id  


             WHERE lignebonlivraisons.article_id = $art->id  $cond2 $cond3  $condss $condannee $condFamille AND bonlivraisons.factureclient_id !=0 GROUP BY lignebonlivraisons.article_id;")->fetchAll('assoc');
                $j++;

                foreach ($arts as $j => $cl) {
                    if ($cl['qte'] != '') {
                        $tabs[$i]['prixht'] = $cl['prixht'];
                        $tabs[$i]['ttc'] = $cl['ttc'];
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];
                        $tabs[$i]['qte'] = $cl['qte'];
                        $totalht += $tabs[$i]['prixht'];
                        $totalqte += $tabs[$i]['qte'];
                        $totalttc += $tabs[$i]['ttc'];
                    }
                }
            }

            $tabs1 = array();

            if (!empty($article) && empty($annee)) {
                $conartt = " AND articles.id = '" . $article . "' ";
                $articles = $connection->execute(
                    "
                SELECT articles.Code as Code, lignebonlivraisons.article_id, SUM(lignebonlivraisons.qte) as qte 
                FROM lignebonlivraisons, bonlivraisons, articles , clients , depots 
                WHERE lignebonlivraisons.article_id = articles.id 
                AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
                AND bonlivraisons.factureclient_id != 0
                $conartt  $condss $condFamille 
             
                GROUP BY article_id 
                ORDER BY qte DESC 
                LIMIT 15;"
                )->fetchAll('assoc');
                foreach ($articles as $article) {
                    $article_id = $article['article_id'];
                    $arts1 = $connection->execute(
                        "
                    SELECT articles.Code as Code, articles.Dsignation as name, lignebonlivraisons.article_id,
                    SUM(lignebonlivraisons.qte) as qte
                    FROM lignebonlivraisons, bonlivraisons,articles  ,clients ,depots 
                    WHERE lignebonlivraisons.article_id = articles.id
                    AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id
                    AND bonlivraisons.factureclient_id != 0
                    AND lignebonlivraisons.article_id = $article_id

                    GROUP BY lignebonlivraisons.article_id
                    ORDER BY qte DESC
                    LIMIT 15;"
                    )->fetchAll('assoc');

                    foreach ($arts1 as $j => $cl1) {
                        if ($cl1['qte'] != '') {
                            $tabs1[] = array(
                                'article_id' => $article_id,
                                'nom' => $cl1['name'],
                                'qte' => $cl1['qte']
                            );
                        }
                    }
                }
            }

            $cout = 0;
            $cha = "TRUE";
            $benefice = $totalttc - $cout;

            $cond = "";
            $condd = "";
        }
        $cha = "TRUE";
       // $articles = $this->fetchTable('Articles')->find('all');
       // $clients = $this->fetchTable('Clients')->find('list', ['keyField' => 'id', 'valueField' => 'Raison_Sociale']);
        $clients = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);
        $articles = $this->fetchTable('Articles')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['code'] . ' ' . $row['Dsignation'];
            }
        ]);
        $familles = $this->fetchTable('Familles')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');
        $sites = $this->fetchTable('Pointdeventes')->find('all');

        $this->set(compact('tabs', 'tabs1','annee', 'sites', 'famille_id', 'commercial_id', 'pointdevente_id', 'familles', 'commercials', 'articless', 'benefice', 'condannee', 'annee', 'totalht', 'totalqte', 'totalttc', 'cond3', 'cond2', 'cond', 'condd', 'cout', 'article', 'totalttc', 'articles', 'clients', 'datedebut', 'datefin', 'client_id'));
    }
    public function getclient()
    {
        $id = $this->request->getQuery('idfam'); // Récupérer l'ID du commercial depuis la requête
    
        // Assurez-vous de remplacer 'Clients' par le nom réel de votre table de clients
        $query = $this->fetchTable('Clients')->find()->where(['commercial_id' => $id]);
    
        // Récupérer tous les clients correspondants à la condition
        $clients = $query->all();
    
        if ($clients->isEmpty()) {
            // Gérer le cas où aucun enregistrement n'est trouvé
            echo json_encode(array('error' => 'Aucun enregistrement trouvé dans la table "Clients" pour l\'ID commercial donné'));
            die;
        }
    
        // Construire le sélecteur HTML pour les clients
        $select = "
            <label class='control-label' for='client_id'>Client</label>
            <select name='client_id' id='client_id' class='form-control '>
                <option value='' selected disabled>Veuillez choisir</option>";
    
        foreach ($clients as $client) {
            $select .= "<option value='" . $client['id'] . "'>" . $client['Code'] . ' - ' . $client['Raison_Sociale'] . "</option>";
        }
    
        $select .= "</select>";
    
        // Retourner la réponse JSON avec le sélecteur HTML
        echo json_encode(array('select' => $select));
        die;
    }
    
    public function getarticle()
    {
        $id = $this->request->getQuery('idfam'); // Récupérer l'ID du commercial depuis la requête
    
        // Assurez-vous de remplacer 'Clients' par le nom réel de votre table de clients
        $query = $this->fetchTable('Articles')->find()->where(['famille_id' => $id]);
    
        // Récupérer tous les clients correspondants à la condition
        $articles = $query->all();
    
        if ($articles->isEmpty()) {
            // Gérer le cas où aucun enregistrement n'est trouvé
            echo json_encode(array('error' => 'Aucun enregistrement trouvé dans la table "Articles" pour l\'ID famille donné'));
            die;
        }
    
        // Construire le sélecteur HTML pour les clients
        $select = "
            <label class='control-label' for='article_id'>Article</label>
            <select name='article_id' id='article_id' class='form-control '>
                <option value='' selected disabled>Veuillez choisir</option>";
    
        foreach ($articles as $aa) {
            $select .= "<option value='" . $aa['id'] . "'>" . $aa['Code'] . ' - ' . $aa['Dsignation'] . "</option>";
        }
    
        $select .= "</select>";
    
        // Retourner la réponse JSON avec le sélecteur HTML
        echo json_encode(array('select' => $select));
        die;
    }
    public function imprimestatistiquezone()
    {
        $connection = ConnectionManager::get('default');
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $cond15 = '';
        // debug($datedebut);
        if ($this->request->getQuery('datedebut')) {
            $datedebut = $this->request->getQuery('datedebut');
        } else {
            $datedebut = date('01-m-Y');
        }
        if ($this->request->getQuery('datefin')) {
            $datefin = $this->request->getQuery('datefin');
        } else {
            $datefin = date('d/m/Y');
        }
        if ($this->request->getQuery()) {
            $gouvernorat_id = $this->request->getQuery('gouvernorat_id');
            $zone = $this->request->getQuery('zone_id');
            if ($zone) {
                $conds = " AND zones.id=" . $zone . "";
            }
            $article = $this->request->getQuery('article_id');
            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
            }
            $cond = "";
            $condd = "";
            $conart = "";
            if ($article) {
                $factt = "";
                $lignfactclients = $connection->execute('SELECT  factureclient_id FROM lignefactureclients WHERE article_id =' . $article . ';')->fetchAll('assoc');
                foreach ($lignfactclients as $key => $lignfactt) {
                    if ($lignfactt['factureclient_id'] != null) {
                        $factt = $factt . ',' . $lignfactt['factureclient_id'];
                    }
                }
                $conart = "Articles.id=" . $article;

                if ($factt != "") {
                    $det3 = substr($factt, 1);
                    $cond = " AND lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
                    $condd = " lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
                }
            }
            $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);
            $tabs = array();
            $j = -1;
            foreach ($articless as $i => $art) {
                $arts = $connection->execute("SELECT  zones.name as name,zones.id as id, lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons,bonlivraisons,articles,clients,delegations,zonedelegations,zones,lignezonedelegations WHERE lignebonlivraisons.article_id=articles.id AND clients.delegation_id=delegations.id AND delegations.id=lignezonedelegations.delegation_id AND zonedelegations.id=lignezonedelegations.zonedelegation_id And zonedelegations.zone_id=zones.id  and bonlivraisons.client_id=clients.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $conds GROUP BY zones.id;")->fetchAll('assoc');
                $j++;

                foreach ($arts as $j => $cl) {
                    if ($cl['qte'] != 0 && $cl['qte'] != '') {
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];

                        $tabs[$i]['client'][$j]['client_id'] = $cl['client_id'];
                        $tabs[$i]['client'][$j]['name'] = $cl['name'];
                        $tabs[$i]['client'][$j]['qte'] = $cl['qte'];
                    }
                }
            }
        }
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
        $zones = $this->fetchTable('Zones')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $zoness = $this->fetchTable('Zones')->find('all')->where([$conds]);

        $this->set(compact('tabs', 'datedebut', 'datefin', 'zoness', 'cond2', 'cond3', 'condd', 'cond', 'articles', 'benefice', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'zones', 'datedebut', 'datefin', 'client_id'));
    }
    // public function statistiquegouvernorat()
    // {

    //     $connection = ConnectionManager::get('default');
    //     $cond1 = '';
    //     $cond2 = '';
    //     $cond3 = '';
    //     $cond4 = '';
    //     $cond5 = '';
    //     $cond6 = '';
    //     $cond7 = '';

    //     $cond8 = '';

    //     $cond9 = '';

    //     $cond10 = '';
    //     $cond12 = '';
    //     $cond13 = '';
    //     $cond14 = '';
    //     $cond15 = '';
    //     $conds = '';
    //     $conartt = "";
    //     $datedebut = date('01-m-Y');
    //     $datefin = date('d/m/Y');
    //     if ($this->request->getQuery()) {
    //         if ($this->request->getQuery('datedebut')) {
    //             $datedebut = $this->request->getQuery('datedebut');
    //         } else {
    //             $datedebut = date('01-m-Y');
    //         }
    //         if ($this->request->getQuery('datefin')) {
    //             $datefin = $this->request->getQuery('datefin');
    //         } else {
    //             $datefin = date('d/m/Y');
    //         }
    //         $gouvernorat_id = $this->request->getQuery('gouvernorat_id');
    //         if ($gouvernorat_id) {

    //             $clis = $this->fetchTable('Clients')->find('all')
    //                 ->where('Clients.gouvernorat_id=' . $gouvernorat_id);

    //             if ($clis) {
    //                 $detcl2 = '';
    //                 foreach ($clis as $cli) {
    //                     if ($cli->id != null) {
    //                         $detcl2 = $detcl2 . ',' . $cli->id;
    //                     }
    //                 }
    //                 $det2 = substr($detcl2, 1);
    //             }

    //             if (!empty($det2)) {
    //                 $cond16 = "bonlivraisons.client_id IN ($det2)";
    //             } else {
    //                 $cond16 = "1 = 0";
    //             }
    //             $conds = " AND gouvernorats.id=" . $gouvernorat_id . "";
    //             // $condss = 'AND gouvernorats.id = ' . $gouvernorat_id;
    //         }
    //         $article = $this->request->getQuery('article_id');

    //         if ($datedebut) {
    //             $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
    //         }
    //         if ($datefin) {
    //             $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
    //         }
    //         $cond = "";
    //         $condd = "";
    //         $condss = "";
    //         $conart = "";

    //         $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);
    //         $tabs = array();
    //         $tabs1 = array();
    //         $j = -1;
    //         if ($article) {
    //             $factt = "";
    //             $lignfactclients = $connection->execute('SELECT  factureclient_id FROM lignefactureclients WHERE article_id =' . $article . ';')->fetchAll('assoc');
    //             foreach ($lignfactclients as $key => $lignfactt) {
    //                 if ($lignfactt['factureclient_id'] != null) {
    //                     $factt = $factt . ',' . $lignfactt['factureclient_id'];
    //                 }
    //             }
    //             if ($factt != "") {
    //                 $det3 = substr($factt, 1);
    //                 $cond = " AND lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
    //                 $condd = " lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
    //             }
    //             $conart = "Articles.id = '" . $article . "' ";
    //         }
    //         foreach ($articless as $i => $art) {
    //             // $totalQuantity = 0;
    //             // $currentArticleId = $art->id;
    //             ///echo "SELECT  gouvernorats.name as name,lignefactureclients.article_id,factureclients.client_id,sum(lignefactureclients.qte) as qte FROM lignefactureclients,factureclients,articles,clients,gouvernorats WHERE lignefactureclients.article_id=articles.id and factureclients.client_id=clients.id AND clients.gouvernorat_id=gouvernortas.id and factureclients.id=lignefactureclients.factureclient_id   AND lignefactureclients.article_id =$art->id  $cond2 $cond3 GROUP BY gouvernorats.id;";//die;
    //             // echo "SELECT  clients.Raison_Sociale as name,lignefactureclients.article_id,factureclients.client_id,sum(lignefactureclients.qte) as qte FROM lignefactureclients,factureclients,articles,clients WHERE lignefactureclients.article_id=articles.id and factureclients.client_id=clients.id and factureclients.id=lignefactureclients.factureclient_id  AND  $condss AND lignefactureclients.article_id =$art->id  $cond2 $cond3 GROUP BY factureclients.client_id;";die;
    //             $arts = $connection->execute("SELECT  gouvernorats.name as name, clients.gouvernorat_id,lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons,bonlivraisons,articles,clients,gouvernorats WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.client_id=clients.id AND clients.gouvernorat_id=gouvernorats.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $conds GROUP BY gouvernorats.id;")->fetchAll('assoc');
    //             // debug($arts);
    //             $j++;
    //             foreach ($arts as $j => $cl) {
    //                 if ($cl['qte'] != '' && $cl['qte'] != 0) {
    //                     $tabs[$i]['article_id'] = $art['id'];
    //                     $tabs[$i]['nom'] = $art['Dsignation'];
    //                     $tabs[$i]['client'][$j]['gouvernorat_id'] = $cl['gouvernorat_id'];
    //                     $tabs[$i]['client'][$j]['name'] = $cl['name'];
    //                     $tabs[$i]['client'][$j]['qte'] = $cl['qte'];

    //                 }

    //             }
    //             // $totalQuantity = array_sum(array_column($arts, 'qte'));
    //             // $articleTotalQuantities[$currentArticleId] = $totalQuantity;
    //             //$tab[$i]['article_id'][$j]['qte']=$art['qte'];
    //         }
    //         if ($article) {

    //             $conartt = " AND articles.id = '" . $article . "' ";

    //             $articles = $connection->execute("SELECT articles.Code as Code, lignebonlivraisons.article_id, sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons, bonlivraisons, articles WHERE lignebonlivraisons.article_id = articles.id AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id $conartt GROUP BY article_id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
    //             debug($articles);
    //             foreach ($articles as $article) {
    //                 $article_id = $article['article_id'];

    //                 $arts1 = $connection->execute("
    //                 SELECT gouvernorats.name as name, clients.gouvernorat_id, lignebonlivraisons.article_id, bonlivraisons.client_id, sum(lignebonlivraisons.qte) as qte
    //                 FROM lignebonlivraisons, bonlivraisons, articles, clients, gouvernorats
    //                 WHERE lignebonlivraisons.article_id = articles.id
    //                 AND bonlivraisons.client_id = clients.id
    //                 AND clients.gouvernorat_id = gouvernorats.id
    //                 AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id
    //                 AND lignebonlivraisons.article_id = $article_id
    //                 $cond2 $cond3 $conds
    //                 GROUP BY clients.gouvernorat_id
    //                 ORDER BY qte DESC
    //                 LIMIT 15
    //             ")->fetchAll('assoc');

    //                 debug($arts1);

    //                 foreach ($arts1 as $j => $cl1) {
    //                     if ($cl1['qte'] != '' && $cl1['qte'] != 0) {
    //                         $tabs1[$i]['article_id'] = $art['id'];
    //                         $tabs1[$i]['nom'] = $art['Dsignation'];
    //                         $tabs1[$i]['client'][$j]['gouvernorat_id'] = $cl1['gouvernorat_id'];
    //                         $tabs1[$i]['client'][$j]['name'] = $cl1['name'];
    //                         $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];

    //                     }

    //                 }
    //             }
    //         }
    //         foreach ($tabs1 as $i => $art) {
    //             usort($tabs1[$i]['client'], function ($a, $b) {
    //                 return $b['qte'] - $a['qte'];
    //             });
    //             $tabs1[$i]['client'] = array_slice($tabs1[$i]['client'], 0, 15, true);
    //         }

    //         // arsort($articleTotalQuantities);
    //         // $topArticles = array_slice($articleTotalQuantities, 0, 15, true);
    //         // $tabs = array_filter($tabs, function ($tab) use ($topArticles) {
    //         //     return isset($topArticles[$tab['article_id']]);
    //         // });
    //         // foreach ($tabs as $i => $art) {
    //         //     usort($tabs[$i]['client'], function ($a, $b) {
    //         //         return $b['qte'] - $a['qte'];
    //         //     });
    //         //     $tabs[$i]['client'] = array_slice($tabs[$i]['client'], 0, 15, true);
    //         // }

    //     }
    //     //die;
    //     //debug($tabs);die;
    //     // $factureclients = $this->paginate($query);
    //     $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
    //     $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
    //     $gouvernoratss = $this->fetchTable('Gouvernorats')->find('all')->where([$conds]);
    //     $this->set(compact('datedebut', 'datefin', 'cond2', 'tabs', 'tabs1', 'cond3', 'condd', 'cond', 'articles', 'gouvernoratss', 'benefice', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'gouvernorats', 'datedebut', 'datefin', 'client_id'));

    // }
    public function statistiquegouvernorat()
    {

        $connection = ConnectionManager::get('default');
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $cond15 = '';
        $conds = '';
        $datedebut = date('01-m-Y');
        $datefin = date('d-m-Y');
        if ($this->request->getQuery()) {
            if ($this->request->getQuery('datedebut')) {
                $datedebut = $this->request->getQuery('datedebut');
            } else {
                $datedebut = date('01-m-Y');
            }
            if ($this->request->getQuery('datefin')) {
                $datefin = $this->request->getQuery('datefin');
            } else {
                $datefin = date('d/m/Y');
            }
            $gouvernorat_id = $this->request->getQuery('gouvernorat_id');
            if ($gouvernorat_id) {

                $clis = $this->fetchTable('Clients')->find('all')
                    ->where('Clients.gouvernorat_id=' . $gouvernorat_id);

                if ($clis) {
                    $detcl2 = '';
                    foreach ($clis as $cli) {
                        if ($cli->id != null) {
                            $detcl2 = $detcl2 . ',' . $cli->id;
                        }
                    }
                    $det2 = substr($detcl2, 1);
                }

                if (!empty($det2)) {
                    $cond16 = "bonlivraisons.client_id IN ($det2)";
                } else {
                    $cond16 = "1 = 0";
                }
                $conds = " AND gouvernorats.id=" . $gouvernorat_id . "";
            }
            $article = $this->request->getQuery('article_id');

            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
            }
            $cond = "";
            $condd = "";
            $conart = "";
            if ($article) {
                $factt = "";
                $lignfactclients = $connection->execute('SELECT  factureclient_id FROM lignefactureclients WHERE article_id =' . $article . ';')->fetchAll('assoc');
                foreach ($lignfactclients as $key => $lignfactt) {
                    if ($lignfactt['factureclient_id'] != null) {
                        $factt = $factt . ',' . $lignfactt['factureclient_id'];
                    }
                }
                if ($factt != "") {
                    $det3 = substr($factt, 1);
                    $cond = " AND lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
                    $condd = " lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
                }
                $conart = "Articles.id = '" . $article . "' ";
            }

            $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);
            $tabs = array();
            $tabs1 = array();
            $j = -1;
            foreach ($articless as $i => $art) {
                ///echo "SELECT  gouvernorats.name as name,lignefactureclients.article_id,factureclients.client_id,sum(lignefactureclients.qte) as qte FROM lignefactureclients,factureclients,articles,clients,gouvernorats WHERE lignefactureclients.article_id=articles.id and factureclients.client_id=clients.id AND clients.gouvernorat_id=gouvernortas.id and factureclients.id=lignefactureclients.factureclient_id   AND lignefactureclients.article_id =$art->id  $cond2 $cond3 GROUP BY gouvernorats.id;";//die;
                // echo "SELECT  clients.Raison_Sociale as name,lignefactureclients.article_id,factureclients.client_id,sum(lignefactureclients.qte) as qte FROM lignefactureclients,factureclients,articles,clients WHERE lignefactureclients.article_id=articles.id and factureclients.client_id=clients.id and factureclients.id=lignefactureclients.factureclient_id  AND  $condss AND lignefactureclients.article_id =$art->id  $cond2 $cond3 GROUP BY factureclients.client_id;";die;
                $arts = $connection->execute("SELECT articles.Dsignation, gouvernorats.name as name, clients.gouvernorat_id,lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons,bonlivraisons,articles,clients,gouvernorats WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.client_id=clients.id AND clients.gouvernorat_id=gouvernorats.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $conds GROUP BY gouvernorats.id ORDER BY qte DESC;")->fetchAll('assoc');
                // debug($arts);
                $j++;


                foreach ($arts as $j => $cl) {
                    if ($cl['qte'] != '' && $cl['qte'] != 0) {
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];
                        $tabs[$i]['client'][$j]['gouvernorat_id'] = $cl['gouvernorat_id'];
                        $tabs[$i]['client'][$j]['name'] = $cl['name'];
                        $tabs[$i]['client'][$j]['qte'] = $cl['qte'];
                    }
                }
                //$tab[$i]['article_id'][$j]['qte']=$art['qte'];
            }

            if (!empty($article) && empty($gouvernorat_id)) {

                $conartt = " AND articles.id = '" . $article . "' ";

                $articles = $connection->execute("SELECT articles.Code as Code, lignebonlivraisons.article_id, sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons, bonlivraisons, articles WHERE lignebonlivraisons.article_id = articles.id AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id $conartt GROUP BY article_id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
                debug($articles);
                foreach ($articles as $article) {
                    $article_id = $article['article_id'];

                    $arts1 = $connection->execute("
                    SELECT gouvernorats.name as name, clients.gouvernorat_id, lignebonlivraisons.article_id, bonlivraisons.client_id, sum(lignebonlivraisons.qte) as qte
                    FROM lignebonlivraisons, bonlivraisons, articles, clients, gouvernorats
                    WHERE lignebonlivraisons.article_id = articles.id
                    AND bonlivraisons.client_id = clients.id
                    AND clients.gouvernorat_id = gouvernorats.id
                    AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id
                    AND lignebonlivraisons.article_id = $article_id
                    $cond2 $cond3 $conds
                    GROUP BY clients.gouvernorat_id
                    ORDER BY qte DESC
                    LIMIT 15
                ")->fetchAll('assoc');

                    // debug($arts1);

                    foreach ($arts1 as $j => $cl1) {
                        if ($cl1['qte'] != '' && $cl1['qte'] != 0) {
                            $tabs1[$i]['article_id'] = $art['id'];
                            $tabs1[$i]['nom'] = $art['Dsignation'];
                            $tabs1[$i]['client'][$j]['gouvernorat_id'] = $cl1['gouvernorat_id'];
                            $tabs1[$i]['client'][$j]['name'] = $cl1['name'];
                            $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];
                        }
                    }
                }
            }
            if (!empty($gouvernorat_id) && empty($article)) {

                $conartt = ' gouvernorats.id = ' . $gouvernorat_id;

                $arts1 = $connection->execute(
                    "SELECT articles.Dsignation, clients.gouvernorat_id, lignebonlivraisons.article_id, SUM(lignebonlivraisons.qte) as qte
                    FROM lignebonlivraisons 
                    JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
                    JOIN articles ON articles.id = lignebonlivraisons.article_id
                    JOIN clients ON bonlivraisons.client_id = clients.id 
                    JOIN gouvernorats ON clients.gouvernorat_id = gouvernorats.id
                    where $conartt $cond2 $cond3
                    GROUP BY lignebonlivraisons.article_id, articles.Dsignation 
                    ORDER BY qte DESC 
                    LIMIT 15;"
                )->fetchAll('assoc');

                // debug($arts1);
                foreach ($arts1 as $j => $cl1) {
                    if ($cl1['qte'] != '') {
                        $tabs1[$i]['article_id'] = $cl1['article_id'];
                        $tabs1[$i]['nom'] = $cl1['Dsignation']; // Utiliser la bonne clé
                        $tabs1[$i]['client'][$j]['client_id'] = $cl1['client_id'];
                        $tabs1[$i]['client'][$j]['name'] = $cl1['Dsignation'];
                        $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];
                    }
                }
            }
            foreach ($tabs1 as $i => $art) {
                usort($tabs1[$i]['client'], function ($a, $b) {
                    return $b['qte'] - $a['qte'];
                });
                $tabs1[$i]['client'] = array_slice($tabs1[$i]['client'], 0, 15, true);
            }
        }
        //die;
        //debug($tabs);die;
        // $factureclients = $this->paginate($query);
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
        $gouvernoratss = $this->fetchTable('Gouvernorats')->find('all')->where([$conds]);
        $this->set(compact('datedebut', 'datefin', 'cond2', 'tabs', 'tabs1', 'cond3', 'condd', 'cond', 'articles', 'gouvernoratss', 'benefice', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'gouvernorats', 'datedebut', 'datefin', 'client_id'));
    }
    public function imprimestatistiquegouvernorat()
    {
        $connection = ConnectionManager::get('default');
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $cond15 = '';
        $conds = '';
        $datedebut = date('01-m-Y');
        $datefin = date('d/m/Y');
        if ($this->request->getQuery()) {
            if ($this->request->getQuery('datedebut')) {
                $datedebut = $this->request->getQuery('datedebut');
            } else {
                $datedebut = date('01-m-Y');
            }
            if ($this->request->getQuery('datefin')) {
                $datefin = $this->request->getQuery('datefin');
            } else {
                $datefin = date('d/m/Y');
            }
            $gouvernorat_id = $this->request->getQuery('gouvernorat_id');
            if ($gouvernorat_id) {

                $clis = $this->fetchTable('Clients')->find('all')
                    ->where('Clients.gouvernorat_id=' . $gouvernorat_id);

                if ($clis) {
                    $detcl2 = '';
                    foreach ($clis as $cli) {
                        if ($cli->id != null) {
                            $detcl2 = $detcl2 . ',' . $cli->id;
                        }
                    }
                    $det2 = substr($detcl2, 1);
                }

                if (!empty($det2)) {
                    $cond16 = "bonlivraisons.client_id IN ($det2)";
                } else {
                    $cond16 = "1 = 0";
                }
                $conds = " AND gouvernorats.id=" . $gouvernorat_id . "";
            }
            $article = $this->request->getQuery('article_id');

            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
            }
            $cond = "";
            $condd = "";
            $conart = "";
            if ($article) {
                $factt = "";
                $lignfactclients = $connection->execute('SELECT  factureclient_id FROM lignefactureclients WHERE article_id =' . $article . ';')->fetchAll('assoc');
                foreach ($lignfactclients as $key => $lignfactt) {
                    if ($lignfactt['factureclient_id'] != null) {
                        $factt = $factt . ',' . $lignfactt['factureclient_id'];
                    }
                }
                if ($factt != "") {
                    $det3 = substr($factt, 1);
                    $cond = " AND lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
                    $condd = " lignebonlivraisons.bonlivraison_id in(" . $det3 . ")";
                }
                $conart = "Articles.id = '" . $article . "' ";
            }
            $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);
            $tabs = array();
            $j = -1;
            foreach ($articless as $i => $art) {
                $arts = $connection->execute("SELECT  gouvernorats.name as name, clients.gouvernorat_id,lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons,bonlivraisons,articles,clients,gouvernorats WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.client_id=clients.id AND clients.gouvernorat_id=gouvernorats.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $conds GROUP BY gouvernorats.id;")->fetchAll('assoc');
                $j++;
                foreach ($arts as $j => $cl) {
                    if ($cl['qte'] != '' && $cl['qte'] != 0) {
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];
                        $tabs[$i]['client'][$j]['gouvernorat_id'] = $cl['gouvernorat_id'];
                        $tabs[$i]['client'][$j]['name'] = $cl['name'];
                        $tabs[$i]['client'][$j]['qte'] = $cl['qte'];
                    }
                }
            }
        }
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
        $gouvernoratss = $this->fetchTable('Gouvernorats')->find('all')->where([$conds]);
        $this->set(compact('datedebut', 'datefin', 'cond2', 'tabs', 'cond3', 'condd', 'cond', 'articles', 'gouvernoratss', 'benefice', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'gouvernorats', 'datedebut', 'datefin', 'client_id'));
    }

    public function statistiqueartclient()
    {
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $conds = '';
        $cond15 = '';
        $datedebut = date('01-m-Y');
        $datefin = date('d-m-Y');
        // debug($datedebut);

        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        $article = $this->request->getQuery('article_id');
        $connection = ConnectionManager::get('default');
        $cond4 = "1=1";
        $cond = "1=1";
        $condd = "1=1";
        $conart = "";
        $conartt = "";
        $condss = "";

        if ($this->request->getQuery()) {
            $datedebut = $this->request->getQuery('datedebut');
            // debug($datedebut);
            $datefin = $this->request->getQuery('datefin');
            if ($article) {
                $conart = "Articles.id = '" . $article . "' ";
                $factt = "";
                $lignfactclients = $connection->execute('SELECT  factureclient_id FROM lignefactureclients WHERE article_id =' . $article . ';')->fetchAll('assoc');
                foreach ($lignfactclients as $key => $lignfactt) {
                    if ($lignfactt['factureclient_id'] != null) {
                        $factt = $factt . ',' . $lignfactt['factureclient_id'];
                    }
                }
                if ($factt != "") {
                    $det3 = substr($factt, 1);
                    $cond = " AND lignebonlivraisons.factureclient_id in(" . $det3 . ")";
                    $condd = " lignebonlivraisons.factureclient_id in(" . $det3 . ")";
                }
            }
            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
            }
            // if ($datedebut) {
            //     $cond2 = "Factureclients.date   <= '" . $datedebut . " 00:00:00' ";
            // }
            // if ($datefin) {
            //     $cond3 = "Factureclients.date  >= '" . $datefin . " 23:59:59' ";
            // }
            if ($client_id) {
                $cond4 = "Bonlivraisons.client_id = '" . $client_id . "' ";
                $conds = "Clients.id = '" . $client_id . "' ";
                $condss = 'AND clients.id = ' . $client_id;
            }
            $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);

            // echo "SELECT  lignefactureclients.article_id FROM lignefactureclients,factureclients WHERE factureclients.id=lignefactureclients.factureclient_id AND  $cond4 AND $cond  $cond2 $cond3 GROUP BY lignefactureclients.article_id;";//die;
            $tabs = array();
            $j = -1;
            $totalqte = 0;
            $totalttc = 0;
            $totalht = 0;
            foreach ($articless as $i => $art) {

                // echo "SELECT  clients.Raison_Sociale as name,lignefactureclients.article_id,factureclients.client_id,sum(lignefactureclients.qte) as qte FROM lignefactureclients,factureclients,articles,clients WHERE lignefactureclients.article_id=articles.id and factureclients.client_id=clients.id and factureclients.id=lignefactureclients.factureclient_id  AND  $condss AND lignefactureclients.article_id =$art->id  $cond2 $cond3 GROUP BY factureclients.client_id;";die;
                $arts = $connection->execute("SELECT  clients.Code as Code,clients.Raison_Sociale as name,lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte ,sum(lignebonlivraisons.prixht) as prixht  , sum(lignebonlivraisons.ttc) as ttc FROM lignebonlivraisons,bonlivraisons,articles,clients WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.client_id=clients.id and bonlivraisons.factureclient_id !=0  and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $condss GROUP BY bonlivraisons.client_id ORDER BY qte DESC;")->fetchAll('assoc');

                $j++;
                // debug($arts);//die;

                foreach ($arts as $j => $cl) {

                    if ($cl['qte'] != '') {
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];
                        $tabs[$i]['client'][$j]['client_id'] = $cl['client_id'];
                        $tabs[$i]['client'][$j]['name'] = $cl['Code'] . ' ' . $cl['name'];
                        $tabs[$i]['client'][$j]['qte'] = $cl['qte'];
                        $tabs[$i]['client'][$j]['prixht'] = $cl['prixht'];
                        $tabs[$i]['client'][$j]['ttc'] = $cl['ttc'];
                        $totalht += $tabs[$i]['client'][$j]['prixht'];
                        $totalqte += $tabs[$i]['client'][$j]['qte'];
                        $totalttc +=  $tabs[$i]['client'][$j]['ttc'];
                    }
                }
                // $tab[$i]['article_id'][$j]['qte']=$art['qte'];
                // debug($tabs);
            }
            // debug($article);
            //  debug($client_id);
            $conartt = " AND articles.id = '" . $article . "' ";
            // debug($conartt);
            $articles = $connection->execute("SELECT articles.Code as Code, lignebonlivraisons.article_id, sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons, bonlivraisons, articles WHERE lignebonlivraisons.article_id = articles.id AND bonlivraisons.factureclient_id !=0 AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id $conartt GROUP BY article_id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
            //debug($articles);die;

            if (!empty($article) && empty($client_id)) {
                $conartt = " AND articles.id = '" . $article . "' ";

                $articles = $connection->execute("SELECT articles.Code as Code, lignebonlivraisons.article_id, sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons, bonlivraisons, articles WHERE lignebonlivraisons.article_id = articles.id AND bonlivraisons.factureclient_id !=0 AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id $conartt GROUP BY article_id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
                /// debug($articles);die;

                foreach ($articles as $article) {
                    $article_id = $article['article_id'];

                    $arts1 = $connection->execute("
                SELECT clients.Code as Code, clients.Raison_Sociale as name, lignebonlivraisons.article_id, bonlivraisons.client_id,
                sum(lignebonlivraisons.qte) as qte
                FROM lignebonlivraisons, bonlivraisons, articles, clients
                WHERE lignebonlivraisons.article_id = articles.id
                AND bonlivraisons.client_id = clients.id
                AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id
                AND lignebonlivraisons.article_id = $article_id
                AND bonlivraisons.factureclient_id !=0
                $cond2 $cond3 $condss
                GROUP BY bonlivraisons.client_id
                ORDER BY qte DESC
                LIMIT 15
            ")->fetchAll('assoc');
                    //  debug($arts1);
                    foreach ($arts1 as $j => $cl1) {

                        if ($cl1['qte'] != '') {
                            $tabs1[$i]['article_id'] = $art['id'];
                            $tabs1[$i]['nom'] = $art['Dsignation'];
                            $tabs1[$i]['client'][$j]['client_id'] = $cl1['client_id'];
                            $tabs1[$i]['client'][$j]['name'] = $cl1['Code'] . ' ' . $cl1['name'];
                            $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];
                        }
                    }
                }
            }
            if (!empty($client_id) && empty($article)) {

                $conartt = 'clients.id = ' . $client_id;
                $arts1 = $connection->execute("SELECT articles.Dsignation,lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons,bonlivraisons,articles,clients WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.client_id=clients.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND $conartt $cond2 $cond3 $condss GROUP BY lignebonlivraisons.article_id, articles.Dsignation ORDER BY lignebonlivraisons.qte DESC LIMIT 15;")->fetchAll('assoc');

                // $arts1 = $connection->execute(
                //     "SELECT articles.Dsignation, bonlivraisons.client_id, lignebonlivraisons.article_id, lignebonlivraisons.qte as qte 
                //     FROM lignebonlivraisons 
                //     JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
                //     JOIN articles ON articles.id = lignebonlivraisons.article_id
                //     JOIN clients ON bonlivraisons.client_id = clients.id 
                //     $conartt $cond2 $cond3
                //     GROUP BY lignebonlivraisons.article_id, articles.Dsignation 
                //     ORDER BY lignebonlivraisons.qte DESC 
                //     LIMIT 15;"
                // )->fetchAll('assoc');
                // debug($arts1);
                // $arts1 = $connection->execute(
                //     "SELECT articles.Dsignation, lignebonlivraisons.article_id, lignebonlivraisons.qte as qte 
                // FROM lignebonlivraisons,articles 
                // JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
                // JOIN clients ON bonlivraisons.client_id = clients.id 
                // $conartt 
                // GROUP BY lignebonlivraisons.article_id 
                // ORDER BY lignebonlivraisons.qte DESC 
                // LIMIT 15;"
                // )->fetchAll('assoc');
                // debug($articles);
                //  debug($arts1);
                foreach ($arts1 as $j => $cl1) {
                    if ($cl1['qte'] != '') {
                        $tabs1[$i]['article_id'] = $cl1['article_id'];
                        $tabs1[$i]['nom'] = $cl1['Dsignation']; // Utiliser la bonne clé
                        $tabs1[$i]['client'][$j]['client_id'] = $cl1['client_id'];
                        $tabs1[$i]['client'][$j]['name'] = $cl1['Dsignation'];
                        $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];
                    }
                }
            }
            foreach ($tabs1 as $i => $art) {
                usort($tabs1[$i]['client'], function ($a, $b) {
                    return $b['qte'] - $a['qte'];
                });
                $tabs1[$i]['client'] = array_slice($tabs1[$i]['client'], 0, 15, true);
            }
            //   debug($tabs);die;
            //      if($arts){$lp='0,';
            //      foreach ($arts as $i => $art) {
            //      $lp=$lp.$art['article_id'].',';   
            //  }
            //      $lp=$lp.'0';
            //      
            //      }
            //      else{$lp='0';}
            //  debug($arts);die;
            // $cls = $connection->execute("SELECT  factureclients.client_id FROM lignefactureclients,factureclients WHERE factureclients.id=lignefactureclients.factureclient_id AND $cond4 AND $cond $cond2 $cond3 GROUP BY factureclients.client_id;")->fetchAll('assoc');
            //debug($cls);die;
            //       if($cls){$lpc='0,';
            //      foreach ($cls as $i => $cl) {
            //      $lpc=$lpc.$cl['client_id'].',';   
            //  }
            //      $lpc=$lpc.'0';
            //      
            //      }
            //      else{$lpc='0';}
            // $query = $this->fetchTable('Factureclients')->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9, $cond10, $cond12, $cond14, $cond15])
            // ->order(['Factureclients.numero' => 'DESC']);

            // $this->paginate = [
            //     'contain' => ['Clients', 'Depots']
            // ];
            // $factureclients = $this->paginate($query);
            // $totalttc = 0;
            // foreach ($factureclients as $dd => $facc) {
            // 	//debug($facc);die;
            // 	$totalttc+=(float) $facc['totalttc'];

            // }
            $cout = 0;
            $cha = "TRUE";
            $benefice = $totalttc - $cout;

            //        $clientss = $this->fetchTable('Clients')->find('all')->where(["Clients.etat=".'"'.$cha.'"'])->where([$conds,'Clients.id in ('.$lpc.')']);
            //          
            //        debug($articless);die;
            $cond = "";
            $condd = "";
        }
        $cha = "TRUE";
        $articles = $this->fetchTable('Articles')->find('all'); //->where(["Articles.vente " => 1]);
        $clients = $this->fetchTable('Clients')->find('all'); //->where(["Clients.etat=" . '"' . $cha . '"']);

        $this->set(compact('tabs', 'tabs1', 'articless', 'benefice', 'cond3', 'cond2', 'totalttc', 'totalht', 'totalqte', 'cond', 'condd', 'clientss', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'clients', 'datedebut', 'datefin', 'client_id'));
    }
    public function imprimestatiqtiqueartclient()
    {
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $conds = '';
        $cond15 = '';
        $client_id = $this->request->getQuery('client_id');
        $article = $this->request->getQuery('article_id');
        $datedebut = $this->request->getQuery('datedebut');
        $datefin = $this->request->getQuery('datefin');
        $connection = ConnectionManager::get('default');
        if ($article) {
            $conart = "Articles.id = '" . $article . "' ";
            $factt = "";
            $lignfactclients = $connection->execute('SELECT  factureclient_id FROM lignefactureclients WHERE article_id =' . $article . ';')->fetchAll('assoc');
            foreach ($lignfactclients as $key => $lignfactt) {
                if ($lignfactt['factureclient_id'] != null) {
                    $factt = $factt . ',' . $lignfactt['factureclient_id'];
                }
            }
            if ($factt != "") {
                $det3 = substr($factt, 1);
                $cond = " AND lignebonlivraisons.factureclient_id in(" . $det3 . ")";
                $condd = " lignebonlivraisons.factureclient_id in(" . $det3 . ")";
            }
        }
        if ($datedebut) {
            $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
        }
        if ($datefin) {
            $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
        }
        if ($client_id) {
            $cond4 = "Bonlivraisons.client_id = '" . $client_id . "' ";
            $conds = "Clients.id = '" . $client_id . "' ";
            $condss = 'AND clients.id = ' . $client_id;
        }

        $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);

        $tabs = array();
        $j = -1;
        foreach ($articless as $i => $art) {
            $arts = $connection->execute("SELECT  clients.Code as Code,clients.Raison_Sociale as name,lignebonlivraisons.article_id,bonlivraisons.client_id,sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons,bonlivraisons,articles,clients WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.client_id=clients.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $condss GROUP BY bonlivraisons.client_id;")->fetchAll('assoc');

            $j++;
            //debug($arts);//die;
            foreach ($arts as $j => $cl) {
                if ($cl['qte'] != '') {
                    $tabs[$i]['article_id'] = $art['id'];
                    $tabs[$i]['nom'] = $art['Dsignation'];
                    $tabs[$i]['client'][$j]['client_id'] = $cl['client_id'];
                    $tabs[$i]['client'][$j]['name'] = $cl['Code'] . ' ' . $cl['name'];
                    $tabs[$i]['client'][$j]['qte'] = $cl['qte'];
                }
            }
        }
        $totalttc = 0;
        $cout = 0;
        $cha = "TRUE";
        $benefice = $totalttc - $cout;
        $cond = "";
        $condd = "";
        $cha = "TRUE";
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
        $clients = $this->fetchTable('Clients')->find('all')->where(["Clients.etat=" . '"' . $cha . '"']);

        $this->set(compact('tabs', 'articless', 'benefice', 'cond3', 'cond2', 'cond', 'condd', 'clientss', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'clients', 'datedebut', 'datefin', 'client_id'));
    }
    //     public function statistiquecommercial()
    //     {
    //         $cond1 = '';
    //         $cond2 = '';
    //         $cond3 = '';
    //         $cond4 = '';
    //         $cond5 = '';
    //         $cond6 = '';
    //         $cond7 = '';

    //         $cond8 = '';

    //         $cond9 = '';

    //         $cond10 = '';
    //         $cond12 = '';
    //         $cond13 = '';
    //         $cond14 = '';
    //         $conds = '';
    //         $cond15 = '';
    //         $datedebut = date('01-m-Y');
    //         $datefin = date('d/m/Y');
    //         // debug($datedebut);

    //         // debug($datefin);
    //         $commercial_id = $this->request->getQuery('commercial_id');
    //         $article = $this->request->getQuery('article_id');
    //         $connection = ConnectionManager::get('default');
    //         $cond4 = "1=1";
    //         $cond = "1=1";
    //         $condd = "1=1";
    //         $conart = "1=1";
    //         $condss = "1=1";
    //         if ($this->request->getQuery()) {
    //             $datedebut = $this->request->getQuery('datedebut');
    //             // debug($datedebut);
    //             $datefin = $this->request->getQuery('datefin');

    //             if ($datedebut) {
    //                 $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
    //             }
    //             if ($datefin) {
    //                 $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
    //             }
    //             $conds = "";
    //             if ($commercial_id) {
    //                 $conds = " AND bonlivraisons.commercial_id = '" . $commercial_id . "' ";
    //             }
    //             $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);

    //             // echo "SELECT  lignefactureclients.article_id FROM lignefactureclients,factureclients WHERE factureclients.id=lignefactureclients.factureclient_id AND  $cond4 AND $cond  $cond2 $cond3 GROUP BY lignefactureclients.article_id;";//die;
    //             $tabs = array();
    //             $tabs1 = array();
    //             $j = -1;
    //             foreach ($articless as $i => $art) {
    //                 // $totalQuantity = 0;
    //                 // $currentArticleId = $art->id;
    //                 // echo "SELECT  clients.Raison_Sociale as name,lignefactureclients.article_id,factureclients.client_id,sum(lignefactureclients.qte) as qte FROM lignefactureclients,factureclients,articles,clients WHERE lignefactureclients.article_id=articles.id and factureclients.client_id=clients.id and factureclients.id=lignefactureclients.factureclient_id  AND  $condss AND lignefactureclients.article_id =$art->id  $cond2 $cond3 GROUP BY factureclients.client_id;";die;
    //                 $arts = $connection->execute("SELECT  commercials.name as name,lignebonlivraisons.article_id,bonlivraisons.commercial_id,sum((lignebonlivraisons.quantiteliv*lignebonlivraisons.punht)-(lignebonlivraisons.quantiteliv*lignebonlivraisons.punht*(lignebonlivraisons.remise/100))) as ttc ,sum(lignebonlivraisons.quantiteliv) as qte FROM lignebonlivraisons,bonlivraisons,articles,commercials WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.commercial_id=commercials.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $conds GROUP BY bonlivraisons.commercial_id;")->fetchAll('assoc');

    //                 $j++;
    //                 //  debug($art);die;

    //                 foreach ($arts as $j => $cl) {
    //                     if ($cl['qte'] != 0 && $cl['qte'] != '') {
    //                         # code...
    //                         $tabs[$i]['article_id'] = $art['id'];
    //                         $tabs[$i]['nom'] = $art['Dsignation'];
    //                         $tabs[$i]['client'][$j]['commercial_id'] = $cl['commercial_id'];
    //                         $tabs[$i]['client'][$j]['name'] = $cl['name'];
    //                         $tabs[$i]['client'][$j]['qte'] = $cl['qte'];
    //                         $tabs[$i]['client'][$j]['ttc'] = $cl['ttc'];
    //                     }
    //                     // $totalQuantity = array_sum(array_column($arts, 'qte'));
    //                     // $articleTotalQuantities[$currentArticleId] = $totalQuantity;
    //                 }
    //             }
    //             if ($article) {
    //                 $conart = "Articles.id = '" . $article . "' ";
    //                 $conartt = " AND articles.id = '" . $article . "' ";
    //                 $articles = $connection->execute("SELECT articles.Code as Code, lignebonlivraisons.article_id, sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons, bonlivraisons, articles WHERE lignebonlivraisons.article_id = articles.id AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id $conartt GROUP BY article_id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
    //                 debug($articles);
    //                 foreach ($articles as $article) {
    //                     $article_id = $article['article_id'];
    //                     $arts1 = $connection->execute("SELECT  commercials.name as name,lignebonlivraisons.article_id,bonlivraisons.commercial_id,sum((lignebonlivraisons.quantiteliv*lignebonlivraisons.punht)-(lignebonlivraisons.quantiteliv*lignebonlivraisons.punht*(lignebonlivraisons.remise/100))) as ttc ,sum(lignebonlivraisons.quantiteliv) as qte FROM lignebonlivraisons,bonlivraisons,articles,commercials WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.commercial_id=commercials.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$article_id  $cond2 $cond3 $conds GROUP BY bonlivraisons.commercial_id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
    //                     debug($arts1);
    //                     foreach ($arts1 as $j => $cl1) {

    //                         if ($cl1['qte'] != '') {
    //                             $tabs1[$i]['article_id'] = $art['id'];
    //                             $tabs1[$i]['nom'] = $art['Dsignation'];
    //                             $tabs1[$i]['client'][$j]['commercial_id'] = $cl1['commercial_id'];
    //                             $tabs1[$i]['client'][$j]['name'] = $cl1['Code'] . ' ' . $cl1['name'];
    //                             $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];
    //                             $tabs1[$i]['client'][$j]['ttc'] = $cl1['ttc'];
    //                         }
    //                     }
    //                 }

    //             }
    //             foreach ($tabs1 as $i => $art) {
    //                 usort($tabs1[$i]['client'], function ($a, $b) {
    //                     return $b['qte'] - $a['qte'];
    //                 });
    //                 $tabs1[$i]['client'] = array_slice($tabs1[$i]['client'], 0, 15, true);
    //             }
    //             // arsort($articleTotalQuantities);
    //             // $topArticles = array_slice($articleTotalQuantities, 0, 15, true);
    //             // $tabs = array_filter($tabs, function ($tab) use ($topArticles) {
    //             //     return isset($topArticles[$tab['article_id']]);
    //             // });
    //             // foreach ($tabs as $i => $art) {
    //             //     usort($tabs[$i]['client'], function ($a, $b) {
    //             //         return $b['qte'] - $a['qte'];
    //             //     });
    //             //     $tabs[$i]['client'] = array_slice($tabs[$i]['client'], 0, 15, true);
    //             // }
    //             //   debug($tabs);die;
    // //      if($arts){$lp='0,';
    // //      foreach ($arts as $i => $art) {
    // //      $lp=$lp.$art['article_id'].',';   
    // //  }
    // //      $lp=$lp.'0';
    // //      
    // //      }
    // //      else{$lp='0';}
    //             //  debug($arts);die;
    //             // $cls = $connection->execute("SELECT  factureclients.client_id FROM lignefactureclients,factureclients WHERE factureclients.id=lignefactureclients.factureclient_id AND $cond4 AND $cond $cond2 $cond3 GROUP BY factureclients.client_id;")->fetchAll('assoc');
    //             //debug($cls);die;
    // //       if($cls){$lpc='0,';
    // //      foreach ($cls as $i => $cl) {
    // //      $lpc=$lpc.$cl['client_id'].',';   
    // //  }
    // //      $lpc=$lpc.'0';
    // //      
    // //      }
    // //      else{$lpc='0';}
    //             // $query = $this->fetchTable('Factureclients')->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9, $cond10, $cond12, $cond14, $cond15])
    //             // ->order(['Factureclients.numero' => 'DESC']);

    //             // $this->paginate = [
    //             //     'contain' => ['Clients', 'Depots']
    //             // ];
    //             // $factureclients = $this->paginate($query);
    //             $totalttc = 0;
    //             // foreach ($factureclients as $dd => $facc) {
    //             // 	//debug($facc);die;
    //             // 	$totalttc+=(float) $facc['totalttc'];

    //             // }
    //             $cout = 0;
    //             $cha = "TRUE";
    //             $benefice = $totalttc - $cout;
    //             $cond = "";
    //             $condd = "";
    //         }
    //         $cha = "TRUE";
    //         $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
    //         $clients = $this->fetchTable('Commercials')->find('all');

    //         $this->set(compact('commercial_id', 'tabs', 'tabs1', 'articless', 'benefice', 'cond3', 'cond2', 'cond', 'condd', 'clientss', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'clients', 'datedebut', 'datefin', 'client_id'));

    //     }
    public function statistiquecommercial()
    {
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $conds = '';
        $cond15 = '';
        $datedebut = date('01-m-Y');
        $datefin = date('d-m-Y');
        // debug($datedebut);

        // debug($datefin);
        $commercial_id = $this->request->getQuery('commercial_id');
        $article = $this->request->getQuery('article_id');
        $connection = ConnectionManager::get('default');
        $cond4 = "1=1";
        $cond = "1=1";
        $condd = "1=1";
        $conart = "1=1";
        $conartt = " ";
        $condss = "1=1";
        if ($this->request->getQuery()) {
            $datedebut = $this->request->getQuery('datedebut');
            // debug($datedebut);
            $datefin = $this->request->getQuery('datefin');
            if ($article) {
                $conart = "Articles.id = '" . $article . "' ";
            }
            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
            }
            $conds = "";
            if ($commercial_id) {
                $conds = " AND bonlivraisons.commercial_id = '" . $commercial_id . "' ";
            }
            $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);

            // echo "SELECT  lignefactureclients.article_id FROM lignefactureclients,factureclients WHERE factureclients.id=lignefactureclients.factureclient_id AND  $cond4 AND $cond  $cond2 $cond3 GROUP BY lignefactureclients.article_id;";//die;
            $tabs = array();
            $j = -1;
            foreach ($articless as $i => $art) {

                // echo "SELECT  clients.Raison_Sociale as name,lignefactureclients.article_id,factureclients.client_id,sum(lignefactureclients.qte) as qte FROM lignefactureclients,factureclients,articles,clients WHERE lignefactureclients.article_id=articles.id and factureclients.client_id=clients.id and factureclients.id=lignefactureclients.factureclient_id  AND  $condss AND lignefactureclients.article_id =$art->id  $cond2 $cond3 GROUP BY factureclients.client_id;";die;
                $arts = $connection->execute("SELECT  commercials.name as name,lignebonlivraisons.article_id,bonlivraisons.commercial_id,sum((lignebonlivraisons.quantiteliv*lignebonlivraisons.punht)-(lignebonlivraisons.quantiteliv*lignebonlivraisons.punht*(lignebonlivraisons.remise/100))) as ttc ,sum(lignebonlivraisons.quantiteliv) as qte FROM lignebonlivraisons,bonlivraisons,articles,commercials WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.commercial_id=commercials.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $conds GROUP BY bonlivraisons.commercial_id ORDER BY qte DESC;")->fetchAll('assoc');

                $j++;
                //  debug($art);die;

                foreach ($arts as $j => $cl) {
                    if ($cl['qte'] != 0 && $cl['qte'] != '') {
                        # code...
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];
                        $tabs[$i]['client'][$j]['commercial_id'] = $cl['commercial_id'];
                        $tabs[$i]['client'][$j]['name'] = $cl['name'];
                        $tabs[$i]['client'][$j]['qte'] = $cl['qte'];
                        $tabs[$i]['client'][$j]['ttc'] = $cl['ttc'];
                    }
                }
                //$tab[$i]['article_id'][$j]['qte']=$art['qte'];
            }
            if (!empty($article) && empty($commercial_id)) {
                $conartt = " AND articles.id = '" . $article . "' ";
                $articles = $connection->execute("SELECT articles.Code as Code, lignebonlivraisons.article_id, sum(lignebonlivraisons.qte) as qte FROM lignebonlivraisons, bonlivraisons, articles WHERE lignebonlivraisons.article_id = articles.id AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id $conartt GROUP BY article_id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
                debug($articles);
                foreach ($articles as $article) {
                    $article_id = $article['article_id'];
                    $arts1 = $connection->execute("SELECT  commercials.name as name,lignebonlivraisons.article_id,bonlivraisons.commercial_id,sum((lignebonlivraisons.quantiteliv*lignebonlivraisons.punht)-(lignebonlivraisons.quantiteliv*lignebonlivraisons.punht*(lignebonlivraisons.remise/100))) as ttc ,sum(lignebonlivraisons.quantiteliv) as qte FROM lignebonlivraisons,bonlivraisons,articles,commercials WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.commercial_id=commercials.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$article_id  $cond2 $cond3 $conds GROUP BY bonlivraisons.commercial_id ORDER BY qte DESC LIMIT 15;")->fetchAll('assoc');
                    debug($arts1);
                    foreach ($arts1 as $j => $cl1) {

                        if ($cl1['qte'] != '') {
                            $tabs1[$i]['article_id'] = $art['id'];
                            $tabs1[$i]['nom'] = $art['Dsignation'];
                            $tabs1[$i]['client'][$j]['commercial_id'] = $cl1['commercial_id'];
                            $tabs1[$i]['client'][$j]['name'] = $cl1['Code'] . ' ' . $cl1['name'];
                            $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];
                            $tabs1[$i]['client'][$j]['ttc'] = $cl1['ttc'];
                        }
                    }
                }
            }
            if (!empty($commercial_id) && empty($article)) {

                $conartt = ' commercials.id = ' . $commercial_id;
                $arts1 = $connection->execute("SELECT  articles.Dsignation,lignebonlivraisons.article_id,bonlivraisons.commercial_id,sum((lignebonlivraisons.quantiteliv*lignebonlivraisons.punht)-(lignebonlivraisons.quantiteliv*lignebonlivraisons.punht*(lignebonlivraisons.remise/100))) as ttc ,sum(lignebonlivraisons.quantiteliv) as qte FROM lignebonlivraisons,bonlivraisons,articles,commercials WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.commercial_id=commercials.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id and $conartt $cond2 $cond3 $conds GROUP BY lignebonlivraisons.article_id, articles.Dsignation ;")->fetchAll('assoc');


                // debug($arts1);
                foreach ($arts1 as $j => $cl1) {
                    if ($cl1['qte'] != '') {
                        $tabs1[$i]['article_id'] = $cl1['article_id'];
                        $tabs1[$i]['nom'] = $cl1['Dsignation']; // Utiliser la bonne clé
                        $tabs1[$i]['client'][$j]['client_id'] = $cl1['client_id'];
                        $tabs1[$i]['client'][$j]['name'] = $cl1['Dsignation'];
                        $tabs1[$i]['client'][$j]['qte'] = $cl1['qte'];
                        $tabs1[$i]['client'][$j]['ttc'] = $cl1['ttc'];
                    }
                }
            }
            foreach ($tabs1 as $i => $art) {
                usort($tabs1[$i]['client'], function ($a, $b) {
                    return $b['qte'] - $a['qte'];
                });
                $tabs1[$i]['client'] = array_slice($tabs1[$i]['client'], 0, 15, true);
            }
            //   debug($tabs);die;
            //      if($arts){$lp='0,';
            //      foreach ($arts as $i => $art) {
            //      $lp=$lp.$art['article_id'].',';   
            //  }
            //      $lp=$lp.'0';
            //      
            //      }
            //      else{$lp='0';}
            //  debug($arts);die;
            // $cls = $connection->execute("SELECT  factureclients.client_id FROM lignefactureclients,factureclients WHERE factureclients.id=lignefactureclients.factureclient_id AND $cond4 AND $cond $cond2 $cond3 GROUP BY factureclients.client_id;")->fetchAll('assoc');
            //debug($cls);die;
            //       if($cls){$lpc='0,';
            //      foreach ($cls as $i => $cl) {
            //      $lpc=$lpc.$cl['client_id'].',';   
            //  }
            //      $lpc=$lpc.'0';
            //      
            //      }
            //      else{$lpc='0';}
            // $query = $this->fetchTable('Factureclients')->find('all')->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $cond7, $cond8, $cond9, $cond10, $cond12, $cond14, $cond15])
            // ->order(['Factureclients.numero' => 'DESC']);

            // $this->paginate = [
            //     'contain' => ['Clients', 'Depots']
            // ];
            // $factureclients = $this->paginate($query);
            $totalttc = 0;
            // foreach ($factureclients as $dd => $facc) {
            // 	//debug($facc);die;
            // 	$totalttc+=(float) $facc['totalttc'];

            // }
            $cout = 0;
            $cha = "TRUE";
            $benefice = $totalttc - $cout;
            $cond = "";
            $condd = "";
        }
        $cha = "TRUE";
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
        $clients = $this->fetchTable('Commercials')->find('all');

        $this->set(compact('commercial_id', 'tabs', 'tabs1', 'articless', 'benefice', 'cond3', 'cond2', 'cond', 'condd', 'clientss', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'clients', 'datedebut', 'datefin', 'client_id'));
    }
    public function imprimestatistiquecommercial()
    {
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $conds = '';
        $cond15 = '';
        $datedebut = date('01-m-Y');
        $datefin = date('d/m/Y');

        $commercial_id = $this->request->getQuery('commercial_id');
        $article = $this->request->getQuery('article_id');
        $connection = ConnectionManager::get('default');
        $cond4 = "1=1";
        $cond = "1=1";
        $condd = "1=1";
        $conart = "1=1";
        $condss = "1=1";
        if ($this->request->getQuery()) {
            $datedebut = $this->request->getQuery('datedebut');
            // debug($datedebut);
            $datefin = $this->request->getQuery('datefin');
            if ($article) {
                $conart = "Articles.id = '" . $article . "' ";
            }
            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
            }
            $conds = "";
            if ($commercial_id) {
                $conds = " AND bonlivraisons.commercial_id = '" . $commercial_id . "' ";
            }
            $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);
            $tabs = array();
            $j = -1;
            foreach ($articless as $i => $art) {
                $arts = $connection->execute("SELECT  commercials.name as name,lignebonlivraisons.article_id,bonlivraisons.commercial_id,sum((lignebonlivraisons.quantiteliv*lignebonlivraisons.punht)-(lignebonlivraisons.quantiteliv*lignebonlivraisons.punht*(lignebonlivraisons.remise/100))) as ttc ,sum(lignebonlivraisons.quantiteliv) as qte FROM lignebonlivraisons,bonlivraisons,articles,commercials WHERE lignebonlivraisons.article_id=articles.id and bonlivraisons.commercial_id=commercials.id and bonlivraisons.id=lignebonlivraisons.bonlivraison_id   AND lignebonlivraisons.article_id =$art->id  $cond2 $cond3 $conds GROUP BY bonlivraisons.commercial_id;")->fetchAll('assoc');
                $j++;

                foreach ($arts as $j => $cl) {
                    if ($cl['qte'] != 0 && $cl['qte'] != '') {
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];
                        $tabs[$i]['client'][$j]['commercial_id'] = $cl['commercial_id'];
                        $tabs[$i]['client'][$j]['name'] = $cl['name'];
                        $tabs[$i]['client'][$j]['qte'] = $cl['qte'];
                        $tabs[$i]['client'][$j]['ttc'] = $cl['ttc'];
                    }
                }
            }
            $totalttc = 0;
            $cout = 0;
            $cha = "TRUE";
            $benefice = $totalttc - $cout;
            $cond = "";
            $condd = "";
        }
        $cha = "TRUE";
        $articles = $this->fetchTable('Articles')->find('all')->where(["Articles.vente " => 1]);
        $clients = $this->fetchTable('Commercials')->find('all');
        $this->set(compact('commercial_id', 'tabs', 'articless', 'benefice', 'cond3', 'cond2', 'cond', 'condd', 'clientss', 'cout', 'article', 'totalttc', 'articles', 'factureclients', 'clients', 'datedebut', 'datefin', 'client_id'));
    }
    public function statistiqueart()
    {
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
        $cond12 = '';
        $cond13 = '';
        $cond14 = '';
        $conds = '';
        $cond15 = '';
        $datedebut = date('01-m-Y');
        $datefin = date('d-m-Y');
        // debug($datedebut);

        // debug($datefin);
        $client_id = $this->request->getQuery('client_id');
        $article = $this->request->getQuery('article_id');
        $annee = $this->request->getQuery('annee');
        // debug($annee);

        $connection = ConnectionManager::get('default');
        $cond4 = "1=1";
        $cond = "1=1";
        $condd = "1=1";
        $conart = "";
        $conartt = "";
        $condss = "";
        $condannne = "";

        if ($this->request->getQuery()) {
            $datedebut = $this->request->getQuery('datedebut');
            // debug($datedebut);
            $datefin = $this->request->getQuery('datefin');
            if ($article) {
                $conart = "Articles.id = '" . $article . "' ";
                $factt = "";
                $lignfactclients = $connection->execute('SELECT  factureclient_id FROM lignefactureclients WHERE article_id =' . $article . ';')->fetchAll('assoc');
                foreach ($lignfactclients as $key => $lignfactt) {
                    if ($lignfactt['factureclient_id'] != null) {
                        $factt = $factt . ',' . $lignfactt['factureclient_id'];
                    }
                }
                if ($factt != "") {
                    $det3 = substr($factt, 1);
                    $cond = " AND lignebonlivraisons.factureclient_id in(" . $det3 . ")";
                    $condd = " lignebonlivraisons.factureclient_id in(" . $det3 . ")";
                }
            }
            if ($datedebut) {
                $cond2 = " AND bonlivraisons.date   >= '" . $datedebut . " 00:00:00' ";
            }
            if ($datefin) {
                $cond3 = "AND bonlivraisons.date  <= '" . $datefin . " 23:59:59' ";
            }
            if ($annee) {
                $condannee = "AND YEAR(bonlivraisons.date) = '" . $annee . "'";
            }

            // if ($datedebut) {
            //     $cond2 = "Factureclients.date   <= '" . $datedebut . " 00:00:00' ";
            // }
            // if ($datefin) {
            //     $cond3 = "Factureclients.date  >= '" . $datefin . " 23:59:59' ";
            // }
            if ($client_id) {
                $cond4 = "Bonlivraisons.client_id = '" . $client_id . "' ";
                $conds = "Clients.id = '" . $client_id . "' ";
                $condss = 'AND clients.id = ' . $client_id;
            }
            $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);

            // echo "SELECT  lignefactureclients.article_id FROM lignefactureclients,factureclients WHERE factureclients.id=lignefactureclients.factureclient_id AND  $cond4 AND $cond  $cond2 $cond3 GROUP BY lignefactureclients.article_id;";//die;

            $tabs = array();
            $j = -1;
            $totalqte = 0;
            $totalttc = 0;
            $totalht = 0;
            foreach ($articless as $i => $art) {

                // Requête pour obtenir les détails de l'article en fonction des conditions de date
                $arts = $connection->execute("SELECT articles.id as article_id, SUM(lignebonlivraisons.prixht) as prixht, SUM(lignebonlivraisons.ttc) as ttc, SUM(lignebonlivraisons.qte) as qte FROM lignebonlivraisons left JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id left JOIN articles ON articles.id = lignebonlivraisons.article_id WHERE lignebonlivraisons.article_id = $art->id $cond2 $cond3 $condannee AND bonlivraisons.factureclient_id !=0 GROUP BY lignebonlivraisons.article_id;")->fetchAll('assoc');
                // echo "SELECT articles.id as article_id, lignebonlivraisons.punht, lignebonlivraisons.ttc, SUM(lignebonlivraisons.qte) as qte FROM lignebonlivraisons INNER JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id INNER JOIN articles ON articles.id = lignebonlivraisons.article_id WHERE lignebonlivraisons.article_id = $art->id $cond2 $cond3";
                // debug($arts);
                $j++;

                foreach ($arts as $j => $cl) {
                    if ($cl['qte'] != '') {
                        $tabs[$i]['prixht'] = $cl['prixht'];
                        $tabs[$i]['ttc'] = $cl['ttc'];
                        $tabs[$i]['article_id'] = $art['id'];
                        $tabs[$i]['nom'] = $art['Dsignation'];
                        $tabs[$i]['qte'] = $cl['qte'];
                        $totalht += $tabs[$i]['prixht'];
                        $totalqte += $tabs[$i]['qte'];
                        $totalttc +=  $tabs[$i]['ttc'];
                    }
                }
                // debug($tabs);
            }
            // debug($article);
            // debug($annee);

            // Initialisation du tableau $tabs1
            $tabs1 = array();

            if (!empty($article) && empty($annee)) {
                $conartt = " AND articles.id = '" . $article . "' ";

                $articles = $connection->execute(
                    "
                    SELECT articles.Code as Code, lignebonlivraisons.article_id, sum(lignebonlivraisons.qte) as qte 
                    FROM lignebonlivraisons, bonlivraisons, articles 
                    WHERE lignebonlivraisons.article_id = articles.id 
                    AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
                    AND  bonlivraisons.factureclient_id != 0
                    $conartt 
                    GROUP BY article_id 
                    ORDER BY qte DESC 
                    LIMIT 15;"
                )->fetchAll('assoc');
                //debug($articles);
                foreach ($articles as $article) {
                    $article_id = $article['article_id'];

                    $arts1 = $connection->execute(
                        "
                        SELECT articles.Code as Code, articles.Dsignation as name, lignebonlivraisons.article_id,
                        sum(lignebonlivraisons.qte) as qte
                        FROM lignebonlivraisons, bonlivraisons, articles
                        WHERE lignebonlivraisons.article_id = articles.id
                        AND bonlivraisons.id = lignebonlivraisons.bonlivraison_id
                        AND  bonlivraisons.factureclient_id != 0
                        AND lignebonlivraisons.article_id = $article_id
                        $cond2 $cond3 $condannee
                        GROUP BY lignebonlivraisons.article_id
                        ORDER BY qte DESC
                        LIMIT 15;"
                    )->fetchAll('assoc');

                    foreach ($arts1 as $j => $cl1) {
                        if ($cl1['qte'] != '') {
                            // Remplissage du tableau $tabs1 avec les données récupérées
                            $tabs1[] = array(
                                'article_id' => $article_id,
                                'nom' => $cl1['name'],
                                'qte' => $cl1['qte']
                            );
                        }
                    }
                }
            }



            $cout = 0;
            $cha = "TRUE";
            $benefice = $totalttc - $cout;

            //        $clientss = $this->fetchTable('Clients')->find('all')->where(["Clients.etat=".'"'.$cha.'"'])->where([$conds,'Clients.id in ('.$lpc.')']);
            //          
            //        debug($articless);die;
            $cond = "";
            $condd = "";
        }
        $cha = "TRUE";
        $articles = $this->fetchTable('Articles')->find('all'); //->where(["Articles.vente " => 1]);
        $clients = $this->fetchTable('Clients')->find('all'); //->where(["Clients.etat=" . '"' . $cha . '"']);

        $this->set(compact('tabs', 'tabs1', 'articless', 'benefice', 'condannee', 'annee', 'totalht', 'totalqte', 'totalttc', 'cond3', 'cond2', 'cond', 'condd', 'cout', 'article', 'totalttc', 'articles', 'clients', 'datedebut', 'datefin', 'client_id'));
    }


    // public function statistiqueartannee()
    // {
    //     $client_id = $this->request->getQuery('client_id');
    //     $article_id = $this->request->getQuery('article_id');
    //     $anneedebut = $this->request->getQuery('anneedebut');
    //     $anneefin = $this->request->getQuery('anneefin');
    //     $moi_id = $this->request->getQuery('moi_id');

    //     $connection = ConnectionManager::get('default');

    //     $conditions = [];
    //     if ($client_id) {
    //         $conditions[] = "bonlivraisons.client_id = $client_id";
    //     }
    //     if ($article_id) {
    //         $conditions[] = "lignebonlivraisons.article_id = $article_id";
    //     }
    //     if ($anneedebut) {
    //         $conditions[] = "YEAR(bonlivraisons.date) >= $anneedebut";
    //     }
    //     if ($anneefin) {
    //         $conditions[] = "YEAR(bonlivraisons.date) <= $anneefin";
    //     }
    //     if ($moi_id) {
    //         $conditions[] = "MONTH(bonlivraisons.date) = $moi_id";
    //     }

    //     $whereClause = implode(' AND ', $conditions);

    //     $query = "
    //         SELECT 
    //             MONTH(bonlivraisons.date) AS mois,
    //             YEAR(bonlivraisons.date) AS annee,
    //             SUM(lignebonlivraisons.ttc) AS total_ttc
    //         FROM 
    //             lignebonlivraisons
    //         LEFT JOIN 
    //             bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id
    //         WHERE 
    //             $whereClause
    //         GROUP BY 
    //             MONTH(bonlivraisons.date), YEAR(bonlivraisons.date)
    //     ";

    //     $stats = $connection->execute($query)->fetchAll('assoc');
    //     $articles = $this->fetchTable('Articles')->find('list'); //->where(["Articles.vente " => 1]);
    //     $clients = $this->fetchTable('Clients')->find('list'); //->where(["Clients.etat=" . '"' . $cha . '"']);
    //     $mois = $this->fetchTable('Mois')->find('list'); //->where(["Mois.id=" . '"' . $condmois . '"']);
    //     $this->set(compact('stats', 'client_id', 'article_id','mois','clients','articles', 'anneedebut', 'anneefin', 'moi_id'));
    // }


    public function statistiqueartannee()
    {

        $cond4 = '';
        $conds = '';


        $client_id = $this->request->getQuery('client_id');
        $article = $this->request->getQuery('article_id');
        $anneedebut = $this->request->getQuery('anneedebut');
        $anneefin = $this->request->getQuery('anneefin');
        $mois = $this->request->getQuery('mois');
        // debug($annee);

        $connection = ConnectionManager::get('default');
        $cond4 = " AND 1=1";
        $cond = "1=1";
        $condd = "1=1";
        $conart = "";
        $conartt = "";
        $condss = "";
        $condannnedeb = " AND 1=1";
        $condannnefin = " AND 1=1";
        $condmois = " AND 1=1";
        if ($this->request->getQuery()) {
            $anneedebut = $this->request->getQuery('anneedebut');
            // debug($anneedebut);
            $adeb = $this->fetchTable('Annees')->find()->where(['Annees.id' => $anneedebut])->first();

            $anneefin = $this->request->getQuery('anneefin');
            // debug($anneefin);

            $afin = $this->fetchTable('Annees')->find()->where(['Annees.id' => $anneefin])->first();
            //  debug($afin);

            // debug($anneefin);
            $article = $this->request->getQuery('article_id');
            // debug($article);
            $moi_id = $this->request->getQuery('moi_id');
            //  debug($moi_id);
            $amoi = $this->fetchTable('Mois')->find()->where(['Mois.id' => $moi_id])->first();
            /// debug($amoi->name);

            if ($anneedebut) {
                $condannnedeb = "AND YEAR(bonlivraisons.date)  >= '" . $adeb->name . "'";
                // debug($condannnedeb);
            }
            if ($anneefin) {
                $condannnefin = "AND YEAR(bonlivraisons.date) <= '" . $afin->name . "'";
                // debug($condannnefin);
            }
            if ($moi_id) {
                $condmois = "AND MONTH(bonlivraisons.date) = '" . $moi_id . "'";
                // debug(  $condmois );
            }
            //   debug(MONTH(bonlivraisons.date));
            $client_id = $this->request->getQuery('client_id');

            if ($client_id) {
                $cond4 = " AND bonlivraisons.client_id = '" . $client_id . "' ";
                $conds = "Clients.id = '" . $client_id . "' ";
                $condss = 'AND clients.id = ' . $client_id;
            }

            $conart = "Articles.id = '" . $article . "' ";
            $condm = "Mois.id = '" . $moi_id . "' ";
            // $condann = "Annees.id = '" . $anneefin . "' ";
            $articless = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"])->where([$conart]);
            //debug($articless->toarray());

            $moiss = $this->fetchTable('Mois')->find('list')->where(["Mois.id=" . '"' . $condm . '"']);
            $anneess = $this->fetchTable('Annees')->find('list'); // ->where(["Annees.id=" . '"' . $condann . '"']);

            $tabs = array();
            $j = -1;

            $totalttc = 0;
            if ($article) {
                foreach ($articless as $i => $art) {
                    //debug($art->id);
                    // Requête pour obtenir les détails de l'article en fonction des conditions de date
                    $arts = $connection->execute("SELECT articles.id as article_id,bonlivraisons.date as date ,  SUM(lignebonlivraisons.ttc) as ttc
                  FROM lignebonlivraisons left JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
                  left JOIN articles ON articles.id = lignebonlivraisons.article_id 
                  WHERE lignebonlivraisons.article_id = $art->id $cond4 $condannnedeb $condannnefin $condmois 
                  AND bonlivraisons.factureclient_id !=0  GROUP BY lignebonlivraisons.article_id;")->fetchAll('assoc');


                    $j++;

                    foreach ($arts as $j => $cl) {
                        if ($cl['ttc'] != '') {
                            $tabs[$i]['ttc'] = $cl['ttc'];
                            $tabs[$i]['date'] = $cl['date'];
                            $totalttc +=  $tabs[$i]['ttc'];
                        }
                    }
                    // debug($tabs);
                }
            }
            //debug($totalttc);
        }

        $articlesss = $this->fetchTable('Articles')->find('all')->where(["Articles.vente=1"]);
        foreach ($articlesss as $i => $art) {
            // debug($art->id);
            // Requête pour obtenir les détails de l'article en fonction des conditions de date
            $arts = $connection->execute("SELECT articles.id as article_id,bonlivraisons.date as date ,   SUM(lignebonlivraisons.ttc) as ttc
      FROM lignebonlivraisons left JOIN bonlivraisons ON bonlivraisons.id = lignebonlivraisons.bonlivraison_id 
      left JOIN articles ON articles.id = lignebonlivraisons.article_id 
      WHERE lignebonlivraisons.article_id = $art->id $cond4 $condannnedeb $condannnefin $condmois 
      AND bonlivraisons.factureclient_id !=0  ;")->fetchAll('assoc');


            $j++;

            foreach ($arts as $j => $cl) {
                if ($cl['ttc'] != '') {
                    $tabs[$i]['ttc'] = $cl['ttc'];
                    $tabs[$i]['date'] = $cl['date'];

                    $totalttc +=  $tabs[$i]['ttc'];
                }
            }
           //  debug($tabs);
        }

        $articles = $this->fetchTable('Articles')->find('all'); //->where(["Articles.vente " => 1]);
        $clients = $this->fetchTable('Clients')->find('all'); //->where(["Clients.etat=" . '"' . $cha . '"']);
        if ($moi_id) {
            $mois = $this->fetchTable('Mois')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Mois.id=" . '"' . $moi_id . '"']);
        } else {
            $mois = $this->fetchTable('Mois')->find('list', ['keyfield' => 'id', 'valueField' => 'name']); //->where(["Mois.id=" . '"' . $moi_id . '"']);

        }
        if ($adeb->name && $afin->name) {
            $annees = $this->fetchTable('Annees')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Annees.name >=" => $adeb->name, "Annees.name <=" => $afin->name]);
        } elseif ($adeb->name) {
            $annees = $this->fetchTable('Annees')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Annees.name >=" => $adeb->name]);
        } elseif ($afin->name) {
            $annees = $this->fetchTable('Annees')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Annees.name <=" => $afin->name]);
        } else {
            $annees = $this->fetchTable('Annees')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        }

        $anneess = $this->fetchTable('Annees')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $moiss = $this->fetchTable('Mois')->find('list', ['keyfield' => 'id', 'valueField' => 'name']); //->where(["Mois.id=" . '"' . $moi_id . '"']);

        $this->set(compact('tabs', 'tabs1', 'articless', 'moiss', 'anneess', 'adeb', 'arts', 'mois', 'totalttc', 'annees', 'cond4', 'condannnefin', 'condannnefin', 'articles', 'clients', '', 'anneefin', 'anneedebut', 'moi_id', 'article_id', 'client_id'));
    }
    public function imprimestatistiqueart()
    {
    }
    /**
     * View method
     *
     * @param string|null $id Statistique id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
}
