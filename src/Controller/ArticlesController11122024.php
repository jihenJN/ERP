<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;
use Cake\I18n\FrozenTime;

/**
 * Articles Controlleraaaaaa
 *
 * @property \App\Model\Table\ArticlesTable $Articles
 * @method \App\Model\Entity\Article[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ArticlesController extends AppController
{


    public function editprixarticle()
    {
        error_reporting(E_ERROR | E_PARSE);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $famille_id = $this->request->getData('famille_id');
            $sousfamille_id = $this->request->getData('sousfamille1_id');
            $Nouvelleprix = $this->request->getData('Prix_LastInput');
            $tva = $this->request->getData('tva_id');
            // debug($tva);
            if ($famille_id && $sousfamille_id) {
                $articles = $this->fetchTable('Articles')->find()->where(['famille_id' => $famille_id, 'sousfamille1_id' => $sousfamille_id])->all();
            } elseif ($famille_id) {
                $articles = $this->fetchTable('Articles')->find()->where(['famille_id' => $famille_id])->all();
            }
            foreach ($articles as $article) {
                $article->Prix_LastInput = $Nouvelleprix;
                // $tva_id = $article->tva_id;
                $fodec = $article->fodec;
                if ($tva !== null) {
                    $connection = ConnectionManager::get('default');
                    $tvavalue = $connection->execute('SELECT valeur FROM tvas WHERE tvas.id = ' . $tva)->fetchAll('assoc');
                    $valeurTva = $tvavalue[0]['valeur'];
                    // debug($valeurTva);
                }
                $nouvprixttc = $Nouvelleprix + ($Nouvelleprix * ($valeurTva / 100)) + ($Nouvelleprix * ($fodec / 100));
                $article->prixttc = $nouvprixttc;
                $article->tva_id = $tva;
                $this->fetchTable('Articles')->save($article);
            }
            return $this->redirect(['action' => 'index']);
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyField' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyField' => 'id', 'valueField' => 'valeur']);
        $this->set(compact('familles', 'tvas'));
    }
    public function getInfoFamille()
    {
        $idfamille = $this->request->getQuery('id');
        //debug($idfamille);
        $query = $this->fetchTable('Sousfamille1s')->find('all')->where('Sousfamille1s.famille_id =' . $idfamille);
        $select = "
        <label class='control-label' for='sousfamille1_id'> Sous Famille</label>
        <select name='sousfamille1_id' id='sousfamille1_id' class='form-control sousfamille' style='text-align:right'>
        <option value='' selected='selected' disabled> Veuillez choisir SVP !!</option>";
        foreach ($query as $q) {
            $select = $select . "   <option value ='" . $q['id'] . "'";
            $select = $select . " >" . $q['name'] . "</option>";
        }
        $select = $select . "</select>";
        echo json_encode(['select' => $select]);
        exit;
    }

    public function impavoir()
    {
        error_reporting(E_ERROR | E_PARSE);

        $cond1 = '';
        $cond2 = '';

        if ($this->request->getQuery()) {

            $this->loadModel('Lignebonreceptionstocks');
            $this->loadModel('Bonreceptionstocks');

            if ($this->request->getQuery()['date1'] != '') {
                $date1 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date1'])));
            }

            if ($this->request->getQuery()['date2'] != '') {
                $date2 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date2'])));
            }


            if ($date2) {
                $cond1 = 'Bonreceptionstocks.date  <= ' . "'" . $date2 . " 23:59:59'";
            }
            if ($date1) {
                $cond2 = 'Bonreceptionstocks.date  >= ' . "'" . $date1 . " 00:00:00'";
            }
            $cond00 = 'Bonreceptionstocks.typereception_id = 2 ';


            $bonreceptions = $this->fetchTable('Bonreceptionstocks')->find('all', [
                'contain' => [],
            ])->where([$cond1, $cond2, $cond00]);
            ////debug($bonreceptions);

            $list = '0';
            foreach ($bonreceptions as $i) {

                $depotid = $i->depot_id;

                $list = $list . ',' . $i['id'];
            }
            $condl = 'Lignebonreceptionstocks.bonreceptionstock_id  in (' . $list . ')';
            $lignes = $this->fetchTable('Lignebonreceptionstocks')->find('all', [
                'contain' => [],
            ])->where([$condl]);
            $list2 = '0';
            foreach ($lignes as $i) {

                $list2 = $list2 . ',' . $i['article_id'];
            }
            $condart0 = 'Articles.id  in (' . $list2 . ')';
            $articles = $this->fetchTable('Articles')->find('all', [
                'contain' => [],
            ])->where([$condart0]);
        }
        $this->set(compact('bonreceptions', 'articles', 'depotid', 'date1', 'date2', 'cnt'));
    }



    public function indexavoir()
    {

        error_reporting(E_ERROR | E_PARSE);


        $cond1 = '';
        $cond2 = '';

        if ($this->request->getQuery()) {

            $this->loadModel('Lignebonreceptionstocks');
            $this->loadModel('Bonreceptionstocks');

            if ($this->request->getQuery()['date1'] != '') {
                $date1 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date1'])));
            }

            if ($this->request->getQuery()['date2'] != '') {
                $date2 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date2'])));
            }


            if ($date2) {
                $cond1 = 'Bonreceptionstocks.date  <= ' . "'" . $date2 . " 23:59:59'";
            }
            if ($date1) {
                $cond2 = 'Bonreceptionstocks.date  >= ' . "'" . $date1 . " 00:00:00'";
            }
            $cond00 = 'Bonreceptionstocks.typereception_id = 2 ';


            $bonreceptions = $this->fetchTable('Bonreceptionstocks')->find('all', [
                'contain' => [],
            ])->where([$cond1, $cond2, $cond00]);
            debug($bonreceptions->toarray());

            $list = '0';
            foreach ($bonreceptions as $i) {

                $depotid = $i->depot_id;

                $list = $list . ',' . $i['id'];
            }
            $condl = 'Lignebonreceptionstocks.bonreceptionstock_id  in (' . $list . ')';
            $lignes = $this->fetchTable('Lignebonreceptionstocks')->find('all', [
                'contain' => [],
            ])->where([$condl]);
            $list2 = '0';
            foreach ($lignes as $i) {

                $list2 = $list2 . ',' . $i['article_id'];
            }
            $condart0 = 'Articles.id  in (' . $list2 . ')';
            $articles = $this->fetchTable('Articles')->find('all', [
                'contain' => [],
            ])->where([$condart0]);
            //debug($articlees);

        }
        $this->set(compact('bonreceptions', 'articles', 'depotid', 'date1', 'date2'));
    }

    public function indexspec($article_id = null, $depot_id = null)
    {

        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Lignecommandes');
        $this->loadModel('Lignebonchargements');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Lignefactureclients');
        $this->loadModel('Lignefactureavoirs');
        $this->loadModel('Ligneinventaires');
        $this->loadModel('Lignebondetransferts');
        $this->loadModel('Lignebonreceptionstocks');
        $this->loadModel('Lignebonsortiestocks');
        $this->loadModel('Depots');
        $this->loadModel('Commandes');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Inventaires');
        $this->loadModel('Bondechargements');
        $this->loadModel('Factureclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Bonsortiestocks');
        $this->loadModel('Bonreceptionstocks');
        $this->loadModel('Bondetransferts');
        $this->loadModel('Historiquearticles');
        $this->loadModel('Livraisons');
        $this->loadModel('Lignelivraisons');
        $this->loadModel('Lignefactureavoirfrs');
        $this->loadModel('Factureavoirfrs');




        $date1 =   '0-01-' . date("Y") . ''  . date("h:m:s");
        // var_dump($date1);
        //debug($date1);
        $time = new FrozenTime('now', 'Africa/Tunis');
        $date2 = $time->i18nFormat('yyyy-MM-dd HH:MM:SS');
        // var_dump($date2);
        //debug($date2);

        $historiquearticles = array();
        $commande = 1;
        $livrison = 1;
        $facture = 1;
        $factureavoir = 1;
        $inventaire = 1;
        $bonsortie = 1;
        $bonreception  = 1;
        $bontr = 1;
        $charg = 1;
        $livraison = 1;

        $achattt = 1;
        $factureavoirfr = 1;

        /// $checkbox = "";
        $connn =  '';

        $historiques = $this->Historiquearticles->find('all');
        foreach ($historiques as $h) {
            $this->Historiquearticles->delete($h);
        }

        if ($this->request->getQuery()) {

            //debug($this->request->getQuery()) ;
            $historiques = $this->Historiquearticles->find('all');
            foreach ($historiques as $h) {
                $this->Historiquearticles->delete($h);
            }


            $testdate = 0;
            $solde = 0;


            if ($this->request->getQuery()['date1'] != '') {
                $date1 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date1'])));
                // debug($date1);
                if ($date1 < "2017-01-01") {
                    $date1 = '2017-01-01';
                }
                if ($date1 > "2017-01-01") {

                    $testdate = 1;

                    /// debug($date1);
                    $cond1 = 'Bonlivraisons.date  <  ' . "'" . $date1 . " 23:59:59'";
                    $cond2 = 'Factureclients.date   <  ' . "'" . $date1 . " 23:59:59'";
                    $cond3 = 'Commandes.date  <  ' . "'" . $date1 . " 23:59:59'";
                    $cond4 = 'Inventaires.date  <  ' . "'" . $date1 . " 23:59:59'";
                    $condfav = 'Factureavoirs.date  <  ' . "'" . $date1 . " 23:59:59'";
                    $condst1 = 'Bonsortiestocks.date  <  ' . "'" . $date1 . " 23:59:59'";
                    $condrec1 = 'Bonreceptionstocks.date  <  ' . "'" . $date1 . " 23:59:59'";
                    $condtr1 = 'Bondetransferts.date  <  ' . "'" . $date1 . " 23:59:59'";
                    $condliv1 = 'Livraisons.date  <  ' . "'" . $date1 . " 23:59:59'";
                    $condachat = 'Factures.date  <  ' . "'" . $date1 . " 23:59:59'";
                }
                $cond5 = 'Bonlivraisons.date   >=  ' . "'" . $date1 . " 00:00:00'";
                $cond6 = 'Factureclients.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $cond7 = 'Commandes.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $cond8 = 'Inventaires.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condfav1 = 'Factureavoirs.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condst2 = 'Bonsortiestocks.date  >=  ' . "'" . $date1 . " 23:59:59'";
                $condrec2 = 'Bonreceptionstocks.date  >=  ' . "'" . $date1 . " 23:59:59'";
                $condtr2 = 'Bondetransferts.date  >=  ' . "'" . $date1 . " 23:59:59'";
                $condliv2 = 'Livraisons.date  >=  ' . "'" . $date1 . " 23:59:59'";
                $bnch1 = 'Bondechargements.date   >=  ' . "'" . $date1 . " 00:00:00'";
                $condachat1 = 'Factures.date   >=  ' . "'" . $date1 . " 00:00:00'";
                $condachat1avfr = 'Factureavoirfrs.date   >=  ' . "'" . $date1 . " 00:00:00'";
            }



            if ($this->request->getQuery()['date2'] != '') {
                $date2 = date("Y-m-d", strtotime(str_replace('/', '-', $this->request->getQuery()['date2'])));
                if ($date2 < "2017-01-01") {
                    $date2 = '2017-01-01';
                }
                if ($date2 > "2017-01-01") {

                    $cond9 = 'Bonlivraisons.date  <= ' . "'" . $date2 . " 23:59:59'";
                    $bnch2 = 'Bondechargements.date  <= ' . "'" . $date2 . " 23:59:59'";
                    $cond10 = 'Factureclients.date  <= ' . "'" . $date2 . " 23:59:59'";
                    $cond11 = 'Commandes.date  <= ' . "'" . $date2 . " 23:59:59'";
                    $cond12 = 'Inventaires.date  <= ' . "'" . $date2 . " 23:59:59'";
                    $condfav2 = 'Factureavoirs.date  <= ' . "'" . $date2 . " 23:59:59'";
                    $condst3 = 'Bonsortiestocks.date  <=  ' . "'" . $date2 . " 23:59:59'";
                    $condrec3 = 'Bonreceptionstocks.date  <=  ' . "'" . $date2 . " 23:59:59'";
                    $condtr3 = 'Bondetransferts.date  <=  ' . "'" . $date2 . " 23:59:59'";
                    $condliv3 = 'Livraisons.date  <=  ' . "'" . $date2 . " 23:59:59'";
                    $condaa1 = 'Factures.date  <=  ' . "'" . $date2 . " 23:59:59'";
                    $condaa1avfr = 'Factureavoirfrs.date  <=  ' . "'" . $date2 . " 23:59:59'";




                    $cond13 = 'Bonlivraisons.date  >=  ' . "'" . $date2 . " 23:59:59'";
                    $cond14 = 'Factureclients.date >=  ' . "'" . $date2 . " 23:59:59'";
                    $cond15 = 'Commandes.date >=  ' . "'" . $date2 . " 23:59:59'";
                    $cond16 = 'Inventaires.date >=  ' . "'" . $date2 . " 23:59:59'";
                    $condfav3 = 'Factureavoirs.date >=  ' . "'" . $date2 . " 23:59:59'";

                    $condst4 = 'Bonsortiestocks.date  >=  ' . "'" . $date2 . " 23:59:59'";
                    $condrec4 = 'Bonreceptionstocks.date  >=  ' . "'" . $date2 . " 23:59:59'";
                    $condtr4 = 'Bondetransferts.date  >=  ' . "'" . $date2 . " 23:59:59'";
                    $condliv4 = 'Livraisons.date  >=  ' . "'" . $date2 . " 23:59:59'";
                    $condaa2 = 'Factures.date  >=  ' . "'" . $date2 . " 23:59:59'";
                }
            }

            if ($this->request->getQuery()['client_id'] != '') {
                $clientid = $this->request->getQuery()['client_id'];
                ////debug($clientid);
                /// $cond17 = 'Inventaires.client_id =' . $clientid;
                $cond18 = 'Commandes.client_id =' . $clientid;
                $cond19 = 'Bonlivraisons.client_id =' . $clientid;
                $cond20 = 'Factureclients.client_id =' . $clientid;
                $condfav4 = 'Factureavoirs.client_id =' . $clientid;

                $cl = $this->fetchTable('Clients')->get($clientid, [
                    'contain' => []
                ]);
                // debug($cl);
                $clientcod = $cl->Raison_Sociale;
                $clientID = $cl->id;
            }


            if ($this->request->getQuery()['article_id'] != '') {
                $articleid = $this->request->getQuery()['article_id'];
                //debug($articleid);
                $cond21 = 'Ligneinventaires.article_id =' . $articleid;
                $cond22 = 'Lignecommandes.article_id =' . $articleid;
                $cond23 = 'Lignebonlivraisons.article_id =' . $articleid;
                $bnch3 = 'Lignebonchargements.article_id =' . $articleid;
                $cond24 = 'Lignefactureclients.article_id =' . $articleid;
                $condfav5 = 'Lignefactureavoirs.article_id =' . $articleid;

                $condstart = 'Lignebonsortiestocks.article_id =' . $articleid;
                $condrcart = 'Lignebonreceptionstocks.article_id =' . $articleid;
                $condtrart = 'Lignebondetransferts.article_id =' . $articleid;

                $condlivart = 'Lignelivraisons.article_id =' . $articleid;
                $condartfacachat = 'Lignefactures.article_id =' . $articleid;
                $condartfacachatavfr = 'Lignefactureavoirfrs.article_id =' . $articleid;
            } else {
                $articleid = 0;
            }

            // if ($this->request->getQuery()['fournisseur_id'] != '') {
            //     $fournisseurid = $this->request->getQuery()['fournisseur_id'];
            //     $cond25 = 'Inventaires.fournisseur_id =' . $fournisseurid;
            //     $cond26 = 'Commandes.fournisseur_id =' . $fournisseurid;
            //     $cond27 = 'Bonlivraisons.fournisseur_id =' . $fournisseurid;
            //     $cond28 = 'Factureclients.fournisseur_id =' . $fournisseurid;
            // }

            if ($this->request->getQuery()['depot_id'] != '') {
                $depotid = $this->request->getQuery()['depot_id'];
                /// debug($depotid);
                $conddepot = 'Depots.id =' . $depotid;
                $depots = $this->Depots->find('all')->where([$conddepot]);
            }

            foreach ($depots as $dep) {
                //debug($dep);
                $depotid = $dep->id;
                $depot = $dep->name;
                $condd1 = 'Bonlivraisons.depot_id =' . $depotid;
                $condd2 = 'Factureclients.depot_id =' . $depotid;
                $condd3 = 'Commandes.depot_id =' . $depotid;
                $condd4 = 'Inventaires.depot_id =' . $depotid;
                $condfav6 = 'Factureavoirs.depot_id =' . $depotid;
                $bnch4 = 'Bondechargements.depot_id =' . $depotid;

                $condstd = 'Bonsortiestocks.depot_id =' . $depotid;
                $condrcd = 'Bonreceptionstocks.depot_id =' . $depotid;
                $condtrds = 'Bondetransferts.depotsortie_id =' . $depotid;
                $condtrde = 'Bondetransferts.depotarrive_id =' . $depotid;
                $condlivde = 'Livraisons.depot_id =' . $depotid;
                $condfaccde = 'Factures.depot_id =' . $depotid;
            }

            $ligneinventaires = $this->fetchTable('Ligneinventaires')->find('all', [
                'contain' => ['Inventaires'],
            ])->where([$condd4, $cond21, 'Inventaires.date = "2017-01-01"'])->first();

            //debug($ligneinventaires);

            /// if (!empty($ligneinventaires)) {
            $qte = $ligneinventaires->qteStock;

            if ($testdate == 0) {

                $date12 = "2017-01-01";
                $condi1 = 'Bonlivraisons.date >= ' . "'" . $date12 . " 23:59:59'";
                $condi2 = 'Factureclients.date >= ' . "'" . $date12 . " 23:59:59'";
                $condi3 = 'Commandes.date >= ' . "'" . $date12 . " 23:59:59'";
                $condi4 = 'Inventaires.date >= ' . "'" . $date12 . " 23:59:59'";
                $condliv5 = 'Livraisons.date >= ' . "'" . $date12 . " 23:59:59'";
            }


            $date13 = '2017-01-01';
            $condi5 = 'Bonlivraisons.date >= ' . "'" . $date13 . " 23:59:59'";
            ///  debug($condi5);
            $condi6 = 'Factureclients.date >= ' . "'" . $date13 . " 23:59:59'";
            $condi7 = 'Commandes.date >= ' . "'" . $date13 . " 23:59:59'";
            $condi8 = 'Inventaires.date >= ' . "'" . $date13 . " 23:59:59'";
            $condliv6 = 'Livraisons.date >= ' . "'" . $date13 . " 23:59:59'";

            $condfac88 = 'Factures.date >= ' . "'" . $date13 . " 23:59:59'";

            //debug($condi5);


            // }
            // else {

            //     $qte = 0;
            // }

            $condb777 = 'Bonlivraisons.depot_id =' . $depotid;
            $condliv777 = 'Livraisons.depot_id =' . $depotid;
            $condfacc9999 = 'Factures.depot_id =' . $depotid;
            $condfacc9999avfr = 'Factureavoirfrs.depot_id =' . $depotid;

            //debug($condb777)
            $solde = sprintf("%.3f", $qte);
            //            debug($solde);

            if ($testdate == 1) {
                // debug($cond1);
                // debug($condi5);
                // //debug($cond1);
                // debug($cond23);die ;

                /***************************************solde facture achat******************************************* */
                $lignefacturea = $this->fetchTable('Lignefactures')->find('all', [
                    'contain' => ['Factures'],
                ])->where([$condfacc9999, $condfac88, $condachat, $condartfacachat])->first();
                //debug($lignebonlivraison) ;
                $idlignef = $lignefacturea->id;
                // debug($idligne);

                if ($lignefacturea != null) {
                    $connection = ConnectionManager::get('default');
                    $qte = $connection->execute('SELECT SUM(lignefactures.qte)  as q FROM lignefactures where lignefactures.id=' . $idlignef . ' ;')->fetchAll('assoc');
                    //debug($qte);
                    $soldeblachatttt = $qte[0]['q'];
                    //debug($soldebl);
                }




                if (!empty($soldeblachatttt)) {
                    $solde = $solde + sprintf("%.3f", $soldeblachatttt);

                   // debug($solde);
                }


                // ******************************************solde bl achat****************************************


                //echo $condliv777. $condliv6. $condliv1. $condlivart;
                $lignelivraison = $this->fetchTable('Lignelivraisons')->find('all', [
                    'contain' => ['Livraisons'],
                ])->where([$condliv777, $condliv6, $condliv1, $condlivart, 'Livraisons.facture_id=0'])->first();
                //debug($lignebonlivraison) ;
                $idligne = $lignelivraison->id;
                // debug($idligne);

                if ($lignelivraison != null) {
                    $connection = ConnectionManager::get('default');
                    $qte = $connection->execute('SELECT SUM(lignelivraisons.qteliv)  as q FROM lignelivraisons where lignelivraisons.id=' . $idligne . ' ;')->fetchAll('assoc');
                    //debug($qte);
                    $soldeblachat = $qte[0]['q'];
                    //debug($soldebl);
                }




                if (!empty($soldeblachat)) {
                    $solde = $solde + sprintf("%.3f", $soldeblachat);

                   // debug($solde);
                }




                // ******************************************solde bl vente****************************************

                $lignebonlivraison = $this->fetchTable('Lignebonlivraisons')->find('all', [
                    'contain' => ['Bonlivraisons'],
                ])->where([$condb777, $condi5, $cond1, $cond23])->first();
                //debug($lignebonlivraison) ;
                $idligne = $lignebonlivraison->id;
                // debug($idligne);

                if ($lignebonlivraison != null) {
                    $connection = ConnectionManager::get('default');
                    $qte = $connection->execute('SELECT SUM(lignebonlivraisons.quantiteliv)  as q FROM lignebonlivraisons where lignebonlivraisons.id=' . $idligne . ' ;')->fetchAll('assoc');
                    //debug($qte);
                    $soldebl = $qte[0]['q'];
                    //debug($soldebl);
                }




                if (!empty($soldebl)) {
                    $solde = $solde - sprintf("%.3f", $soldebl);

                    //debug($solde);
                }

                /***************************************************solde facture client *************************************************** */
                $condb7777 = 'Factureclients.depot_id =' . $depotid;

                $lignefactureclient = $this->fetchTable('Lignefactureclients')->find('all', [
                    'contain' => ['Factureclients'],
                ])->where([$condb7777, $condi2, $cond2, $cond24])->first();
                //debug($lignebonlivraison) ;
                $idligne = $lignefactureclient->id;
                // debug($idligne);
                if ($lignefactureclient != null) {
                    $connection = ConnectionManager::get('default');
                    $qte = $connection->execute('SELECT SUM(lignefactureclients.qte)  as q FROM lignefactureclients where lignefactureclients.id=' . $idligne . ' ;')->fetchAll('assoc');
                    //debug($qte);
                    $soldefc = $qte[0]['q'];
                    //  debug($soldefc);
                }


                if (!empty($soldefc)) {
                    $solde = $solde - sprintf("%.3f", $soldefc);

                    // debug($solde);
                }
            }

            /********************************************************************************************************************** */
            //  debug($this->request->getData()) ;
            /***************************inventaire*************************************** */


            $condb99 = 'Inventaires.depot_id =' . $depotid;
            $condb999 = 'Inventaires.valide = 1';

            $ligneinv = $this->fetchTable('Ligneinventaires')->find('all', [
                'contain' => ['Inventaires', 'Articles'],
            ])->where([$cond21, $cond12, $cond8, $condb99, $condb999])
                ->group(['Ligneinventaires.inventaire_id'])
                ->select([
                    "qte" =>
                    'SUM(Ligneinventaires.qteStock)',
                    "inventaire_id" => 'Ligneinventaires.inventaire_id',
                    "date" =>
                    '(Inventaires.date)',
                    "inventaire_id" => 'Ligneinventaires.inventaire_id',
                    "article" =>
                    '(Articles.Dsignation)',
                    "inventaire_id" => 'Ligneinventaires.inventaire_id',
                    "numero" =>
                    '(Inventaires.numero)',
                    "inventaire_id" => 'Ligneinventaires.inventaire_id'
                ]);

            ///debug($ligneinv->toarray());

            if ($inventaire == 0) {
                $ligneinv = array();
            }
            $tabligneinv = array();

            foreach ($ligneinv as $l) {


                $tabligneinv['fournisseur'] = "";
                $tabligneinv['utilisateur'] = "";
                $tabligneinv['date'] = $l['date'];
                $tabligneinv['type'] = "Inventaire";
                $tabligneinv['indice'] = 4;
                $tabligneinv['numero'] = $l['numero'];
                $tabligneinv['article'] = $l['article'];
                $tabligneinv['qte'] = $l['qte'];
                $tabligneinv['mode'] = "Entreé";
                $tabligneinv['depot'] =   $depot;

                ///debug($tabligneinv);

                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tabligneinv);
                $this->Historiquearticles->save($historiquearticles);
                /// debug($historiquearticles);


            }

            /************************************************************************************ */

            /************************************facture achat ***************************************************** */
            $lignefacc = $this->fetchTable('Lignefactures')->find('all', [
                'contain' => ['Factures', 'Articles'],
            ])->where([$condfacc9999, $condachat1, $condaa1, $condartfacachat]);
            /// debug($lignebl->toarray());
            if ($achattt == 0) {
                $lignefa = array();
            }
            $tablignefacs = array();
            foreach ($lignefacc as $l) {

                //debug($l);

                $tablignefacs['fournisseur'] = "";
                $tablignefacs['utilisateur'] = "";
                /// $tablignelivrisons['client'] = $client ;
                $tablignefacs['date'] = $l['facture']['date'];
                $tablignefacs['type'] = "Facture achat";
                $tablignefacs['indice'] = 1;
                $tablignefacs['numero'] = $l['facture']['numero'];
                $tablignefacs['article'] = $l['article']['Dsignation'];
                $tablignefacs['qte'] = $l['qte'];
                $tablignefacs['pu'] = $l['prix'];
                $tablignefacs['remise'] = $l['remise'];
                $tablignefacs['tva'] = $l['tva'];
                $tablignefacs['ptot'] = $l['facture']['ht'];
                $tablignefacs['mode'] = "Entreé";
                $tablignefacs['depot'] =   $depot;

                //debug($tablignelivrisons);

                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignefacs);
                $this->Historiquearticles->save($historiquearticles);

                // debug($historiquearticles);

            }
            /********************************************Avoir Achat*************************************************************** */

            $lignefacavoirfr = $this->fetchTable('Lignefactureavoirfrs')->find('all', [
                'contain' => ['Factureavoirfrs', 'Articles'],
            ])->where([$condfacc9999avfr, $condachat1avfr, $condaa1avfr, $condartfacachatavfr]);
            /// debug($lignebl->toarray());
            if ($factureavoirfr == 0) {
                $lignefavfr = array();
            }
            $tablignefacavfrs = array();
            foreach ($lignefacavoirfr as $l) {

                //debug($l);

                $tablignefacavfrs['fournisseur'] = "";
                $tablignefacavfrs['utilisateur'] = "";
                /// $tablignelivrisons['client'] = $client ;
                $tablignefacavfrs['date'] = $l['factureavoirfr']['date'];
                $tablignefacavfrs['type'] = "Facture avoir achat";
                $tablignefacavfrs['indice'] = 1;
                $tablignefacavfrs['numero'] = $l['factureavoirfr']['numero'];
                $tablignefacavfrs['article'] = $l['article']['Dsignation'];
                $tablignefacavfrs['qte'] = $l['quantite'];
                $tablignefacavfrs['pu'] = $l['prix'];
                $tablignefacavfrs['remise'] = $l['remise'];
                $tablignefacavfrs['tva'] = $l['tva'];
                $tablignefacavfrs['ptot'] = $l['factureavoirfr']['totalht'];
                $tablignefacavfrs['mode'] = "Entreé";
                $tablignefacavfrs['depot'] =   $depot;

                //debug($tablignelivrisons);

                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignefacavfrs);
                $this->Historiquearticles->save($historiquearticles);

                // debug($historiquearticles);

            }
            // *************************************************bl achat******************************************************

            $condliv777 = 'Livraisons.depot_id =' . $depotid;
            // $condliv = 'Livraisons.factureclient_id = 0';
            // echo $condliv777. $condliv2. $condliv3. $condlivart; 

            $ligneblachat = $this->fetchTable('Lignelivraisons')->find('all', [

                'contain' => ['Livraisons' => ['Fournisseurs'], 'Articles']


            ])->where([$condliv777, $condliv2, $condliv3, $condlivart, 'Livraisons.facture_id=0']);
            /// debug($lignebl->toarray());
            if ($livrison == 0) {
                $lignebl = array();
            }
            $tablignelivrisons = array();
            foreach ($ligneblachat as $l) {

                //debug($l);

                $tablignelivrisons['fournisseur'] = $l->livraison->fournisseur->name;
                $tablignelivrisons['utilisateur'] = "";
                $tablignelivrisons['client'] = "";
                $tablignelivrisons['date'] = $l['livraison']['date'];
                $tablignelivrisons['type'] = "Bon livraison achat";
                $tablignelivrisons['indice'] = 1;
                $tablignelivrisons['numero'] = $l['livraison']['numero'];
                $tablignelivrisons['article'] = $l['article']['Dsignation'];
                $tablignelivrisons['qte'] = $l['qteliv'];
                $tablignelivrisons['pu'] = $l['prix'];
                $tablignelivrisons['remise'] = $l['remise'];
                $tablignelivrisons['tva'] = $l['tva'];
                $tablignelivrisons['ptot'] = $l['ht'];
                $tablignelivrisons['mode'] = "Entreé";
                $tablignelivrisons['depot'] =   $depot;

                //debug($tablignelivrisons);

                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignelivrisons);
                $this->Historiquearticles->save($historiquearticles);

                // debug($historiquearticles);

            }
            // *******************************************bl type 1************************************************

            $condb777 = 'Bonlivraisons.depot_id =' . $depotid;
            $condBL = 'Bonlivraisons.factureclient_id = 0';
            $typebl = 'Bonlivraisons.typebl = 1';


            $lignebl = $this->fetchTable('Lignebonlivraisons')->find('all', [
                'contain' => ['Bonlivraisons', 'Articles'],
            ])->where([$condb777, $cond5, $cond9, $cond23, $cond19, $condBL, $typebl]);
            /// debug($lignebl->toarray());
            if ($livrison == 0) {
                $lignebl = array();
            }
            $tablignelivrisons = array();
            foreach ($lignebl as $l) {

                //debug($l);

                $tablignelivrisons['fournisseur'] = "";
                $tablignelivrisons['utilisateur'] = "";
                /// $tablignelivrisons['client'] = $client ;
                $tablignelivrisons['date'] = $l['bonlivraison']['date'];
                $tablignelivrisons['type'] = "Bon livraison vente";
                $tablignelivrisons['indice'] = 1;
                $tablignelivrisons['numero'] = $l['bonlivraison']['numero'];
                $tablignelivrisons['article'] = $l['article']['Dsignation'];
                $tablignelivrisons['qte'] = $l['qte'];
                $tablignelivrisons['pu'] = $l['punht'];
                $tablignelivrisons['remise'] = $l['remise'];
                $tablignelivrisons['tva'] = $l['tva'];
                $tablignelivrisons['ptot'] = $l['punht'] * $l['qte'];
                $tablignelivrisons['mode'] = "Sortie";
                $tablignelivrisons['depot'] =   $depot;

                //debug($tablignelivrisons);

                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignelivrisons);
                $this->Historiquearticles->save($historiquearticles);

                // debug($historiquearticles);

            }
            /********************************************bl type 2 facture proforma****************************************** */
            /*$condb777 = 'Bonlivraisons.depot_id =' . $depotid;
            $condBL = 'Bonlivraisons.factureclient_id = 0';
            $typebl = 'Bonlivraisons.typebl = 2';
            $typecomm = 'Bonlivraisons.commande_id = 0';


            $lignebl = $this->fetchTable('Lignebonlivraisons')->find('all', [
                'contain' => ['Bonlivraisons', 'Articles'],
            ])->where([$condb777, $cond5, $cond9, $cond23, $cond19, $condBL, $typebl, $typecomm]);
            ///debug($lignebl->toarray());
            if ($livrison == 0) {
                $lignebl = array();
            }
            $tablignelivrisons = array();
            foreach ($lignebl as $l) {

                //debug($l);

                $tablignelivrisons['fournisseur'] = "";
                $tablignelivrisons['utilisateur'] = "";
                /// $tablignelivrisons['client'] = $client ;
                $tablignelivrisons['date'] = $l['bonlivraison']['date'];
                $tablignelivrisons['type'] = "Facture proforma";
                $tablignelivrisons['indice'] = 11;
                $tablignelivrisons['numero'] = $l['bonlivraison']['numero'];
                $tablignelivrisons['article'] = $l['article']['Dsignation'];
                $tablignelivrisons['qte'] = $l['qte'];
                $tablignelivrisons['pu'] = $l['punht'];
                $tablignelivrisons['remise'] = $l['remise'];
                $tablignelivrisons['tva'] = $l['tva'];
                $tablignelivrisons['ptot'] = $l['bonlivraison']['totalht'];
                $tablignelivrisons['mode'] = "Sortie";
                $tablignelivrisons['depot'] =   $depot;

                //debug($tablignelivrisons);

                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignelivrisons);
                $this->Historiquearticles->save($historiquearticles);

                // debug($historiquearticles);

            }*/


            /**************************************bl type 3****************************************** */
            $condb777 = 'Bonlivraisons.depot_id =' . $depotid;
            $typebll = 'Bonlivraisons.typebl = 3';



            $lignebl = $this->fetchTable('Lignebonlivraisons')->find('all', [
                'contain' => ['Bonlivraisons', 'Articles'],
            ])->where([$condb777, $cond5, $cond9, $cond23, $cond19, $typebll]);
            ///debug($lignebl->toarray());
            if ($livrison == 0) {
                $lignebl = array();
            }
            $tablignelivrisons = array();
            foreach ($lignebl as $l) {

                //debug($l);

                $tablignelivrisons['fournisseur'] = "";
                $tablignelivrisons['utilisateur'] = "";
                /// $tablignelivrisons['client'] = $client ;
                $tablignelivrisons['date'] = $l['bonlivraison']['date'];
                $tablignelivrisons['type'] = "Bon livraison marchandise";
                $tablignelivrisons['indice'] = 12;
                $tablignelivrisons['numero'] = $l['bonlivraison']['numero'];
                $tablignelivrisons['article'] = $l['article']['Dsignation'];
                $tablignelivrisons['qte'] = $l['quantiteliv'];
                $tablignelivrisons['pu'] = $l['punht'];
                $tablignelivrisons['remise'] = $l['remise'];
                $tablignelivrisons['tva'] = $l['tva'];
                $tablignelivrisons['ptot'] = $l['bonlivraison']['totalht'];
                $tablignelivrisons['mode'] = "Sortie";
                $tablignelivrisons['depot'] =   $depot;

                //debug($tablignelivrisons);

                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignelivrisons);
                $this->Historiquearticles->save($historiquearticles);

                // debug($historiquearticles);

            }



            /*******************************************facture client comptant******************************************** */
            //  debug( $tablignelivrisons);
            $condb78 = 'Factureclients.depot_id =' . $depotid;
            // $typefacclient = 'Factureclients.type = 2';
            $lignefac = $this->fetchTable('Lignefactureclients')->find('all', [
                'contain' => ['Factureclients', 'Articles'],
            ])->where([$cond6, $cond10, $cond24, $condb78, $cond20/*, $typefacclient*/]);
            //  debug($lignefac->toarray());
            //debug($lignefac);
            if ($facture == 0) {
                $lignefac = array();
            }
            $tablignefac = array();
            foreach ($lignefac as $l) {

                /// debug($l);

                $tablignefac['fournisseur'] = "";
                $tablignefac['utilisateur'] = "";
                // $tablignefac['client'] = $client;
                $tablignefac['date'] = $l['factureclient']['date'];
                $tablignefac['type'] = " Facture Client";
                $tablignefac['indice'] = 2;
                $tablignefac['numero'] = $l['factureclient']['numero'];
                $tablignefac['article'] = $l['article']['Dsignation'];
                $tablignefac['qte'] = $l['qte'];
                $tablignefac['pu'] = $l['punht'];
                $tablignefac['remise'] = $l['remise'];
                $tablignefac['tva_id'] = $l['tva'];
                $tablignefac['ptot'] = $l['montantht'];
                $tablignefac['mode'] = "Sortie";
                $tablignefac['depot'] = $depot;
                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignefac);
                $this->Historiquearticles->save($historiquearticles);
                ///debug($historiquearticles);
            }
            /***************************************************facture client aterme***************************************************** */




            /*$condb78 = 'Factureclients.depot_id =' . $depotid;
            $typefacclientt = 'Factureclients.type = 1';
            $lignefac = $this->fetchTable('Lignefactureclients')->find('all', [
                'contain' => ['Factureclients', 'Articles'],
            ])->where([$cond6, $cond10, $cond24, $condb78, $cond20, $typefacclientt]);
            //  debug($lignefac->toarray());
            //debug($lignefac);
            if ($facture == 0) {
                $lignefac = array();
            }
            $tablignefac = array();
            foreach ($lignefac as $l) {

                /// debug($l);

                $tablignefac['fournisseur'] = "";
                $tablignefac['utilisateur'] = "";
                // $tablignefac['client'] = $client;
                $tablignefac['date'] = $l['factureclient']['date'];
                $tablignefac['type'] = " Facture a terme";
                $tablignefac['indice'] = 2;
                $tablignefac['numero'] = $l['factureclient']['numero'];
                $tablignefac['article'] = $l['article']['Dsignation'];
                $tablignefac['qte'] = $l['qte'];
                $tablignefac['pu'] = $l['punht'];
                $tablignefac['remise'] = $l['remise'];
                $tablignefac['tva_id'] = $l['tva'];
                $tablignefac['ptot'] = $l['montantht'];
                $tablignefac['mode'] = "Sortie";
                $tablignefac['depot'] = $depot;
                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignefac);
                $this->Historiquearticles->save($historiquearticles);
                ///debug($historiquearticles);
            }*/
















            /*******************************************Avoir Vente*************************************** */
            $lignefacav = $this->fetchTable('Lignefactureavoirs')->find('all', [
                'contain' => ['Factureavoirs', 'Articles'],
            ])->where([$condfav1, $condfav2, $condfav4, $condfav5, $condfav6]);
            //debug($lignefacav->toarray());
            //debug($lignefac);
            if ($factureavoir == 0) {
                $lignefacav = array();
            }
            $tabavoir = array();
            foreach ($lignefacav as $l) {

                ///debug($l);

                $tabavoir['fournisseur'] = "";
                $tabavoir['utilisateur'] = "";
                $tabavoir['date'] = $l['factureavoir']['date'];
                $tabavoir['type'] = " Facture avoir Vente";
                $tabavoir['indice'] = 11;
                $tabavoir['numero'] = $l['factureavoir']['numero'];
                $tabavoir['article'] = $l['article']['Dsignation'];
                $tabavoir['qte'] = $l['quantite'];
                $tabavoir['pu'] = $l['prix'];
                $tabavoir['remise'] = $l['remise'];
                $tabavoir['tva_id'] = $l['tva_id'];
                $tabavoir['ptot'] = $l['totalht'];
                $tabavoir['mode'] = "Entreé";
                $tabavoir['depot'] = $depot;
                ///debug($tabavoir);
                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tabavoir);
                $this->Historiquearticles->save($historiquearticles);
                ///debug($historiquearticles);
            }

            /***************************************************bonsortie stock****************************** */
            $lignebonsort = $this->fetchTable('Lignebonsortiestocks')->find('all', [
                'contain' => ['Bonsortiestocks', 'Articles'],
            ])->where([$condst2, $condst3, $condstart, $condstd]);

            //debug($lignebonsort);

            if ($bonsortie == 0) {
                $lignebonsort = array();
            }
            $tablignesort = array();
            foreach ($lignebonsort as $l) {

                /// debug($l);

                $tablignesort['fournisseur'] = "";
                $tablignesort['utilisateur'] = "";
                $tablignesort['date'] = $l['bonsortiestock']['date'];
                $tablignesort['type'] = "Bon sortie";
                $tablignesort['indice'] = 5;
                $tablignesort['numero'] = $l['bonsortiestock']['numero'];
                $tablignesort['article'] = $l['article']['Dsignation'];
                $tablignesort['qte'] = $l['qte'];
                $tablignesort['mode'] = "Sortie";
                $tablignesort['depot'] = $depot;
                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignesort);
                $this->Historiquearticles->save($historiquearticles);
                ///debug($historiquearticles);
            }

            $lignebonreception = $this->fetchTable('Lignebonreceptionstocks')->find('all', [
                'contain' => ['Bonreceptionstocks', 'Articles'],
            ])->where([$condrcd, $condrec2, $condrec3, $condrcart]);

            /// debug($lignebonreception);

            if ($bonreception == 0) {
                $lignebonreception = array();
            }
            $tablignereception = array();
            foreach ($lignebonreception as $l) {

                /// debug($l);

                $tablignereception['fournisseur'] = "";
                $tablignereception['utilisateur'] = "";
                // $tablignereception['client'] = $client;
                $tablignereception['date'] = $l['bonreceptionstock']['date'];
                $tablignereception['type'] = "Bon reception";
                $tablignereception['indice'] = 6;
                $tablignereception['numero'] = $l['bonreceptionstock']['numero'];
                $tablignereception['article'] = $l['article']['Dsignation'];
                $tablignereception['qte'] = $l['qte'];
                $tablignereception['mode'] = "Entreé";
                $tablignereception['depot'] = $depot;
                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignereception);
                $this->Historiquearticles->save($historiquearticles);
                ///debug($historiquearticles);
            }



            $cond1212 = '(Bondetransferts.depotsortie_id = ' . $depotid .
                ' or Bondetransferts.depotarrive_id = ' . $depotid . ')';

            $lignetrans = $this->fetchTable('Lignebondetransferts')->find('all', [
                'contain' => ['Bondetransferts', 'Articles'],
            ])->where([$condtr2, $condtr3, $condtrart, $cond1212]);

            // debug($lignetrans);



            if ($bontr == 0) {
                $lignetrans = array();
            }
            $tablignetr = array();
            foreach ($lignetrans as $l) {

                $depotsortie = $l['bondetransfert']['depotsortie_id'];
                $depotS = $this->Depots->get($depotsortie, [
                    'contain' => [],
                ]);
                $depSortie = $depotS->name;
                /////////////////////////////
                $depotarrive = $l['bondetransfert']['depotarrive_id'];
                $depotA = $this->Depots->get($depotarrive, [
                    'contain' => [],
                ]);
                $depArr = $depotA->name;



                $tablignetr['fournisseur'] = "";
                $tablignetr['utilisateur'] = "";
                $tablignetr['date'] = $l['bondetransfert']['date'];
                $tablignetr['type'] = "Bon transfert";
                $tablignetr['numero'] = $l['bondetransfert']['numero'];
                $tablignetr['article'] = $l['article']['Dsignation'];
                $tablignetr['qte'] = $l['qteliv'];

                if ($depotid == $depotarrive) {
                    $tablignetr['mode'] = "Entreé";
                    $tablignetr['indice'] = 7;
                    $tablignetr['depot'] = $depArr;
                }
                if ($depotid == $depotsortie) {
                    $tablignetr['mode'] = "Sortie";
                    $tablignetr['indice'] = 8;
                    $tablignetr['depot'] = $depSortie;
                }
                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tablignetr);
                $this->Historiquearticles->save($historiquearticles);
                ///debug($historiquearticles);
            }


            $lignecharg = $this->fetchTable('Lignebonchargements')->find('all', [
                'contain' => ['Bondechargements', 'Articles'],
            ])->where([$bnch1, $bnch2, $bnch3, $bnch4]);

            //  debug($lignecharg->toarray());



            if ($charg == 0) {
                $lignecharg = array();
            }
            $tabcharg = array();
            foreach ($lignecharg as $l) {


                $tabcharg['fournisseur'] = "";
                $tabcharg['utilisateur'] = "";
                $tabcharg['date'] = $l['bondechargement']['date'];
                $tabcharg['type'] = "Bon chargement";
                $tabcharg['numero'] = $l['bondechargement']['numero'];
                $tabcharg['article'] = $l['article']['Dsignation'];
                $tabcharg['qte'] = $l['qte'];
                $tabcharg['mode'] = "Entreé";
                $tabcharg['indice'] = 9;
                $tabcharg['depot'] = $depot;
                $historiquearticles = $this->fetchTable('Historiquearticles')->newEmptyEntity();
                $historiquearticles = $this->Historiquearticles->patchEntity($historiquearticles, $tabcharg);
                $this->Historiquearticles->save($historiquearticles);
                ///debug($historiquearticles);
            }


            //}

        }

        $historiquearticles = $this->fetchTable('Historiquearticles')->find('all')->order(['Historiquearticles.date' => 'ASC']);
        //debug($fichearticles);//die;à
        /// debug($historiquearticles);
        $count = $this->fetchTable('Historiquearticles')->find('all')->count();



        $clients = $this->fetchTable('Clients')->find('all')->where(['Clients.etat = "TRUE" ']);
        $fournisseurs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articles = $this->Articles->find('all');
        $depots = $this->fetchTable('Depots')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $this->set(compact('clients', 'fournisseurs', 'articles', 'depots', 'historiquearticles', 'client', 'name', 'clientcod', 'articleid', 'clientID', 'count', 'date1', 'date2'));
    }

    public function imphisto()
    {
        error_reporting(E_ERROR | E_PARSE);
        $clientid = $this->request->getQuery('client_id');

        if ($clientid != '') {
            $cl = $this->fetchTable('Clients')->get($clientid, [
                'contain' => []
            ]);
        }
        // debug($cl);
        $clientcod = $cl->Raison_Sociale;

        $historiquearticles = $this->fetchTable('Historiquearticles')->find('all')->order(['Historiquearticles.date' => 'ASC']);
        $this->set(compact('historiquearticles', 'clientcod'));
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function indexrelever()
    {
        $this->loadModel('Relevercommercials');
        $this->loadModel('Commercials');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Reglementcommercials');
        $this->loadModel('Bonusmaluscommercials');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Lignereglementcommercials');
        $this->loadModel('Lignebonusmalus');
        $commercial_id = $this->request->getQuery('commercial_id');
        $Date_debut = 'Y-m-01';
        $Date_debut = date("Y") . '/' . date("m") . '/01';
        $Date_fin = date('Y-m-t');
        if ($this->request->getQuery()) {
            $this->Relevercommercials->deleteAll(array());
            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';
            $cond6 = '';
            $cond7 = '';
            $cond8 = '';
            $cond9 = '';
            $cond11 = '';
            $cond12 = '';
            $cond13 = '';
            $regs = array();
            $regs['0'] = 'Regl�';
            $regs['1'] = 'Non regl�';
            $solde = 0;
            if ($this->request->getQuery()['Date_debut'] != '') {
                $cond1 = 'Bonlivraisons.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $cond2 = 'Reglementcommercials.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $cond3 = 'Bonusmaluscommercials.dateoperation>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $Date_debut = $this->request->getQuery()['Date_debut'];
            }
            if ($this->request->getQuery()['Date_fin'] != '') {
                $cond4 = 'Bonlivraisons.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
                $cond5 = 'Reglementcommercials.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
                $cond6 = 'Bonusmaluscommercials.dateoperation<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
                $Date_fin = $this->request->getQuery()['Date_fin'];
            }
            if ($this->request->getQuery()['commercial_id']) {
                $commercial_id = $this->request->getQuery()['commercial_id'];
                $cond7 = 'Bonlivraisons.commercial_id=' . $commercial_id;
                $cond8 = 'Reglementcommercials.commercial_id=' . $commercial_id;
                $cond9 = 'Bonusmaluscommercials.commercial_id=' . $commercial_id;
            }

            $i = -1;
            $connection = ConnectionManager::get('default');
            $soldes = $connection->execute("select soldecommercial(" . $commercial_id . ",'" . $this->request->getQuery()['Date_debut'] . " 00:00:00' ) as v")->fetchAll('assoc');
            $solde = $soldes[0]['v'];

            $reglementcommercials = $this->Reglementcommercials->find('all')->where([$cond2, $cond5, $cond8]);
            foreach ($reglementcommercials as $com) {
                $i++;
                $Lignereglementcommercials = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id=' . $com['id']]);
                $this->loadModel('Paiements');
                $paiements = $this->Paiements->get($com['paiement_id'], [
                    'contain' => []
                ]);
                // debug($paiements);die;
                $dat[$i]['type'] = "Reglement Com";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['paiements'] = $paiements['name'];
                // debug($com);
                $mnt = 0;
                $j = -1;
                foreach ($Lignereglementcommercials as $ligne) {
                    $j++;
                    //  debug($ligne);die;
                    if ($ligne['lignebonlivraison_id'] != 0) {
                        $this->loadModel('Lignebonlivraisons');
                        $lignebonlivraisons = $this->Lignebonlivraisons->get($ligne['lignebonlivraison_id'], [
                            'contain' => ['Bonlivraisons', 'Articles']
                        ]);
                        $dat[$i]['ligne'][$j]['arti'] = $lignebonlivraisons['article']['Dsignation'];
                        $dat[$i]['ligne'][$j]['numero'] = $lignebonlivraisons['bonlivraison']['numero'];
                        $dat[$i]['ligne'][$j]['lignebonlivraison_id'] = $ligne['lignebonlivraison_id'];
                        $dat[$i]['ligne'][$j]['lignebonusmalu_id'] = 0;
                        $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                        $dat[$i]['ligne'][$j]['typ'] = "1";
                        $mnt += $ligne['montant'];
                        $dat[$i]['ligne'][$j]['montant'] = "1";
                    }
                    if ($ligne['lignebonusmalu_id'] != 0) {
                        $this->loadModel('Lignebonusmalus');
                        $lignebonusmalus = $this->Lignebonusmalus->get($ligne['lignebonusmalu_id'], [
                            'contain' => ['Bonusmaluscommercials', 'Articles']
                        ]);
                        $dat[$i]['ligne'][$j]['arti'] = $lignebonusmalus['article']['Dsignation'];
                        $dat[$i]['ligne'][$j]['num'] = $lignebonusmalus['bonusmaluscommercial']['numero'];
                        $dat[$i]['ligne'][$j]['lignebonlivraison_id'] = 0;
                        $dat[$i]['ligne'][$j]['lignebonusmalu_id'] = $ligne['lignebonusmalu_id'];
                        $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                        $dat[$i]['ligne'][$j]['typ'] = "1";
                        $mnt += $ligne['montant'];
                        $dat[$i]['ligne'][$j]['montant'] = "1";
                    }
                }
                //debug($dat) ; die ;
                $dat[$i]['credit'] = $mnt;
                $dat[$i]['debit'] = 0;
            }
            $bonlivraisons = $this->Bonlivraisons->find('all')->where([$cond1, $cond4, $cond7]);
            foreach ($bonlivraisons as $com) {
                $i++;
                $Lignebonlivraisons = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id=' . $com['id']]);
                //  debug($Lignebonlivraisons);//die;
                $this->loadModel('Clients');
                $clients = $this->Clients->get($com['client_id'], [
                    'contain' => []
                ]);
                //  debug($clients);die;
                $dat[$i]['type'] = "Com BL ";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['clients'] = $clients['Raison_Sociale'];
                $mnt = 0;
                $j = -1;
                // debug($Lignebonlivraisons);die;
                foreach ($Lignebonlivraisons as $ligne) {
                    //  debug($ligne);//die;
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['nouv_client'] = $ligne['nouv_client'];
                    $dat[$i]['ligne'][$j]['nouv_article'] = $ligne['nouv_article'];
                    $dat[$i]['ligne'][$j]['montantcommissions'] = $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['montantcommission'] = "2";
                }
                // debug($mnt);
                $dat[$i]['debit'] = $mnt;
                $dat[$i]['credit'] = 0;
            }
            $bonusmaluscommercials = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9, 'Bonusmaluscommercials.total>0']);
            foreach ($bonusmaluscommercials as $com) { {
                    $i++;
                    $Lignebonusmalus = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id']]);
                    $dat[$i]['type'] = "Cloture période du ";
                    $dat[$i]['id'] = $com['id'];
                    $dat[$i]['numero'] = $com['numero'];
                    $dat[$i]['datedebut'] = $com['datedebut'];
                    $dat[$i]['datefin'] = $com['datefin'];
                    $dat[$i]['date'] = $com['dateoperation'];
                    $dat[$i]['ty'] = "bonus";
                    // debug($com);die;
                    $j = -1;
                    $mnt = 0;
                    foreach ($Lignebonusmalus as $j => $ligne) {
                        $j++;
                        $this->loadModel('Articles');
                        $articles = $this->Articles->get($ligne['article_id'], [
                            'contain' => []
                        ]);
                        //debug($articles);die;
                        $dat[$i]['ligne'][$j]['arti'] = $articles['qtr'];
                        $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                        $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                        $dat[$i]['ligne'][$j]['qtelivre'] = $ligne['qtelivre'];
                        $dat[$i]['ligne'][$j]['montantss'] = $ligne['montant'];
                        $dat[$i]['ligne'][$j]['typ'] = "1";
                        $mnt += $ligne['montant'];
                        $dat[$i]['ligne'][$j]['montant'] = "1";
                        // debug($dataa);die;
                    }
                    $dat[$i]['debit'] = $mnt;
                    $dat[$i]['credit'] = 0;
                }
            }
            $bonusmaluscommercialsmal = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9, 'Bonusmaluscommercials.total<0']);
            foreach ($bonusmaluscommercialsmal as $com) {
                $i++;
                $Lignebonusmaluss = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id']]);
                $dat[$i]['type'] = "Cloture période du ";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['datedebut'] = $com['datedebut'];
                $dat[$i]['datefin'] = $com['datefin'];
                $dat[$i]['date'] = $com['dateoperation'];
                $dat[$i]['ty'] = "malus";
                $j = -1;
                $mnt = 0;
                foreach ($Lignebonusmaluss as $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                    $dat[$i]['ligne'][$j]['montantss'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += - ($ligne['montant']);
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                }
                $dat[$i]['credit'] = $mnt;
                $dat[$i]['debit'] = 0;
            }
        }
        $this->loadModel('Commercials');
        $this->loadModel('Articles');
        $this->loadModel('Paiements');
        $commercials = $this->Commercials->find('list', ['limit' => 200]);

        $this->set(compact('commercial_id', 'Date_debut', 'Date_fin', 'solde', 'dat', 'commercials'));
    }

    public function imprime()
    {
        // {
        //     $this->loadModel('Relevercommercials');
        //     $this->loadModel('Commercials');
        //     $this->loadModel('Bonlivraisons');
        //     $this->loadModel('Reglementcommercials');
        //     $this->loadModel('Bonusmaluscommercials');
        //     $this->loadModel('Lignebonlivraisons');
        //     $this->loadModel('Lignereglementcommercials');
        //     $this->loadModel('Lignebonusmalus');
        //     $commercial_id = $this->request->getQuery('commercial_id');
        //     $commercial_id = $this->request->getQuery('commercial_id');
        //     $Date_debut = 'Y-m-01';
        //     $Date_debut = date("Y") . '/' . date("m") . '/01';
        //     $Date_fin = date('Y-m-t');
        //     if ($this->request->getQuery()) {
        //         $this->Relevercommercials->deleteAll(array());
        //         $cond1 = '';
        //         $cond2 = '';
        //         $cond3 = '';
        //         $cond4 = '';
        //         $cond5 = '';
        //         $cond6 = '';
        //         $cond7 = '';
        //         $cond8 = '';
        //         $cond9 = '';
        //         $cond11 = '';
        //         $cond12 = '';
        //         $cond13 = '';
        //         $regs = array();
        //         $regs['0'] = 'Regl�';
        //         $regs['1'] = 'Non regl�';
        //         $Date_debut = '';
        //         $solde = 0;
        //         // debug($this->request->getQuery());die;
        //         if ($this->request->getQuery()['Date_debut'] == "") {
        //             $this->request->getQuery()['Date_debut'] = '2015-01-01  00:00:00';
        //         }
        //         if ($this->request->getQuery()['Date_fin'] == "") {
        //             $this->request->getQuery()['Date_fin'] = date('d/m/Y');
        //         }
        //         if ($this->request->getQuery()['Date_debut'] != '') {
        //             $cond1 = 'Bonlivraisons.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
        //             $cond2 = 'Reglementcommercials.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
        //             $cond3 = 'Bonusmaluscommercials.dateoperation>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
        //             $Date_debut = $this->request->getQuery()['Date_debut'];
        //         }
        //         if ($this->request->getQuery()['Date_fin'] != '') {
        //             $cond4 = 'Bonlivraisons.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
        //             $cond5 = 'Reglementcommercials.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
        //             $cond6 = 'Bonusmaluscommercials.dateoperation<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
        //             $Date_fin = $this->request->getQuery()['Date_fin'];
        //         }
        //         if ($this->request->getQuery()['commercial_id']) {
        //             $commercial_id = $this->request->getQuery()['commercial_id'];
        //             $cond7 = 'Bonlivraisons.commercial_id=' . $commercial_id;
        //             $cond8 = 'Reglementcommercials.commercial_id=' . $commercial_id;
        //             $cond9 = 'Bonusmaluscommercials.commercial_id=' . $commercial_id;
        //         }
        //         $i = -1;
        //         $connection = ConnectionManager::get('default');
        //         $soldes = $connection->execute("select soldecommercial(" . $commercial_id . ",'" . $this->request->getQuery()['Date_debut'] . " 00:00:00' ) as v")->fetchAll('assoc');
        //         $solde = $soldes[0]['v'];
        //         $reglementcommercials = $this->Reglementcommercials->find('all')->where([$cond2, $cond5, $cond8]);
        //         foreach ($reglementcommercials as  $com) {
        //             $i++;
        //             $Lignereglementcommercials = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id=' . $com['id']]);
        //             $this->loadModel('Paiements');
        //             $paiements = $this->Paiements->get($com['paiement_id'], [
        //                 'contain' => []
        //             ]);
        //             // debug($paiements);die;
        //             $dat[$i]['type'] = "Reglement Com";
        //             $dat[$i]['id'] = $com['id'];
        //             $dat[$i]['numero'] = $com['numero'];
        //             $dat[$i]['date'] = $com['date'];
        //             $dat[$i]['paiements'] = $paiements['name'];
        //             // debug($com);
        //             $mnt = 0;
        //             $j = -1;
        //             foreach ($Lignereglementcommercials as  $ligne) {
        //                 $j++;
        //                 //  debug($ligne);die;
        //                 if ($ligne['lignebonlivraison_id'] != 0) {
        //                     $this->loadModel('Lignebonlivraisons');
        //                     $lignebonlivraisons = $this->Lignebonlivraisons->get($ligne['lignebonlivraison_id'], [
        //                         'contain' =>  ['Bonlivraisons', 'Articles']
        //                     ]);
        //                     $dat[$i]['ligne'][$j]['arti'] = $lignebonlivraisons['article']['Dsignation'];
        //                     $dat[$i]['ligne'][$j]['numero'] = $lignebonlivraisons['bonlivraison']['numero'];
        //                     $dat[$i]['ligne'][$j]['lignebonlivraison_id'] = $ligne['lignebonlivraison_id'];
        //                     $dat[$i]['ligne'][$j]['lignebonusmalu_id'] = 0;
        //                     $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
        //                     $dat[$i]['ligne'][$j]['typ'] = "1";
        //                     $mnt += $ligne['montant'];
        //                     $dat[$i]['ligne'][$j]['montant'] = "1";
        //                 }
        //                 if ($ligne['lignebonusmalu_id'] != 0) {
        //                     $this->loadModel('Lignebonusmalus');
        //                     $lignebonusmalus = $this->Lignebonusmalus->get($ligne['lignebonusmalu_id'], [
        //                         'contain' =>  ['Bonusmaluscommercials', 'Articles']
        //                     ]);
        //                     $dat[$i]['ligne'][$j]['arti'] = $lignebonusmalus['article']['Dsignation'];
        //                     $dat[$i]['ligne'][$j]['numero'] = $lignebonusmalus['Bonusmaluscommercial']['numero'];
        //                     $dat[$i]['ligne'][$j]['lignebonlivraison_id'] = 0;
        //                     $dat[$i]['ligne'][$j]['lignebonusmalu_id'] = $ligne['lignebonusmalu_id'];
        //                     $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
        //                     $dat[$i]['ligne'][$j]['typ'] = "1";
        //                     $mnt += $ligne['montant'];
        //                     $dat[$i]['ligne'][$j]['montant'] = "1";
        //                 }
        //             }
        //             //debug($dat) ; die ;
        //             $dat[$i]['credit'] = $mnt;
        //             $dat[$i]['debit'] = 0;
        //         }
        //         $bonlivraisons = $this->Bonlivraisons->find('all')->where([$cond1, $cond4, $cond7]);
        //         foreach ($bonlivraisons as  $com) {
        //             $i++;
        //             $Lignebonlivraisons = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id=' . $com['id']]);
        //             //  debug($Lignebonlivraisons);//die;
        //             $this->loadModel('Clients');
        //             $clients = $this->Clients->get($com['client_id'], [
        //                 'contain' => []
        //             ]);
        //             //  debug($clients);die;
        //             $dat[$i]['type'] = "Com BL ";
        //             $dat[$i]['id'] = $com['id'];
        //             $dat[$i]['numero'] = $com['numero'];
        //             $dat[$i]['date'] = $com['date'];
        //             $dat[$i]['clients'] = $clients['Raison_Sociale'];
        //             $mnt = 0;
        //             $j = -1;
        //             // debug($Lignebonlivraisons);die;
        //             foreach ($Lignebonlivraisons as  $ligne) {
        //                 //  debug($ligne);//die;
        //                 $j++;
        //                 $this->loadModel('Articles');
        //                 $articles = $this->Articles->get($ligne['article_id'], [
        //                     'contain' => []
        //                 ]);
        //                 $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
        //                 $dat[$i]['ligne'][$j]['nouv_client'] = $ligne['nouv_client'];
        //                 $dat[$i]['ligne'][$j]['nouv_article'] = $ligne['nouv_article'];
        //                 $dat[$i]['ligne'][$j]['montantcommissions'] = $ligne['montantcommission'];
        //                 $dat[$i]['ligne'][$j]['typ'] = "2";
        //                 $mnt += $ligne['montantcommission'];
        //                 $dat[$i]['ligne'][$j]['montantcommission'] = "2";
        //             }
        //             // debug($mnt);
        //             $dat[$i]['debit'] = $mnt;
        //             $dat[$i]['credit'] = 0;
        //         }
        //         //   die;
        //         $bonusmaluscommercials = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9, 'Bonusmaluscommercials.total>0']);
        //         foreach ($bonusmaluscommercials as  $com) { {
        //                 $i++;
        //                 $Lignebonusmalus = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id']]);
        //                 $dat[$i]['type'] = "Cloture de periode";
        //                 $dat[$i]['id'] = $com['id'];
        //                 $dat[$i]['numero'] = $com['numero'];
        //                 $dat[$i]['datedebut'] = $com['dd'];
        //                 $dat[$i]['datefin'] = $com['df'];
        //                 $dat[$i]['date'] = $com['dateoperation'];
        //                 $dat[$i]['ty'] = "bonus";
        //                 $j = -1;
        //                 $mnt = 0;
        //                 foreach ($Lignebonusmalus as $j => $ligne) {
        //                     $j++;
        //                     $this->loadModel('Articles');
        //                     $articles = $this->Articles->get($ligne['article_id'], [
        //                         'contain' => []
        //                     ]);
        //                     //debug($articles);die;
        //                     $dat[$i]['ligne'][$j]['arti'] = $articles['qtr'];
        //                     $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
        //                     $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
        //                     $dat[$i]['ligne'][$j]['qtelivre'] = $ligne['qtelivre'];
        //                     $dat[$i]['ligne'][$j]['montantss'] = $ligne['montant'];
        //                     $dat[$i]['ligne'][$j]['typ'] = "1";
        //                     $mnt += $ligne['montant'];
        //                     $dat[$i]['ligne'][$j]['montant'] = "1";
        //                     // debug($dataa);die;
        //                 }
        //                 $dat[$i]['debit'] = $mnt;
        //                 $dat[$i]['credit'] = 0;
        //             }
        //         }
        //         $bonusmaluscommercialsmal = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9, 'Bonusmaluscommercials.total<0']);
        //         foreach ($bonusmaluscommercialsmal as  $com) {
        //             $i++;
        //             $Lignebonusmaluss = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id']]);
        //             $dat[$i]['type'] = "Cloture de periode";
        //             $dat[$i]['id'] = $com['id'];
        //             $dat[$i]['numero'] = $com['numero'];
        //             $dat[$i]['datedebut'] = $com['dd'];
        //             $dat[$i]['datefin'] = $com['df'];
        //             $dat[$i]['date'] = $com['dateoperation'];
        //             $dat[$i]['ty'] = "malus";
        //             $j = -1;
        //             $mnt = 0;
        //             foreach ($Lignebonusmaluss as  $ligne) {
        //                 $j++;
        //                 $this->loadModel('Articles');
        //                 $articles = $this->Articles->get($ligne['article_id'], [
        //                     'contain' => []
        //                 ]);
        //                 $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
        //                 $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
        //                 $dat[$i]['ligne'][$j]['montantss'] = $ligne['montant'];
        //                 $dat[$i]['ligne'][$j]['typ'] = "2";
        //                 $mnt += - ($ligne['montant']);
        //                 $dat[$i]['ligne'][$j]['montant'] = "1";
        //             }
        //             $dat[$i]['credit'] = $mnt;
        //             $dat[$i]['debit'] = 0;
        //         }
        //     }
        //     $this->loadModel('Commercials');
        //     $this->loadModel('Articles');
        //     $this->loadModel('Paiements');
        //     // $commercials = $this->Commercials->find('list', ['limit' => 200]);
        //     $this->set(compact('solde', 'dat'));
        // }
        $this->loadModel('Relevercommercials');
        $this->loadModel('Commercials');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Reglementcommercials');
        $this->loadModel('Bonusmaluscommercials');
        $this->loadModel('Lignebonlivraisons');
        $this->loadModel('Lignereglementcommercials');
        $this->loadModel('Lignebonusmalus');
        $commercial_id = $this->request->getQuery('commercial_id');
        $Date_debut = 'Y-m-01';
        $Date_debut = date("Y") . '/' . date("m") . '/01';
        $Date_fin = date('Y-m-t');
        if ($this->request->getQuery()) {
            $this->Relevercommercials->deleteAll(array());
            $cond1 = '';
            $cond2 = '';
            $cond3 = '';
            $cond4 = '';
            $cond5 = '';
            $cond6 = '';
            $cond7 = '';
            $cond8 = '';
            $cond9 = '';
            $cond11 = '';
            $cond12 = '';
            $cond13 = '';
            $regs = array();
            $regs['0'] = 'Regl�';
            $regs['1'] = 'Non regl�';
            $solde = 0;
            if ($this->request->getQuery()['Date_debut'] != '') {
                $cond1 = 'Bonlivraisons.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $cond2 = 'Reglementcommercials.date>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $cond3 = 'Bonusmaluscommercials.dateoperation>=' . "'" . $this->request->getQuery()['Date_debut'] . " 00:00:00'";
                $Date_debut = $this->request->getQuery()['Date_debut'];
            }
            if ($this->request->getQuery()['Date_fin'] != '') {
                $cond4 = 'Bonlivraisons.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
                $cond5 = 'Reglementcommercials.date<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
                $cond6 = 'Bonusmaluscommercials.dateoperation<=' . "'" . $this->request->getQuery()['Date_fin'] . " 23:59:59'";
                $Date_fin = $this->request->getQuery()['Date_fin'];
            }
            if ($this->request->getQuery()['commercial_id']) {
                $commercial_id = $this->request->getQuery()['commercial_id'];
                $cond7 = 'Bonlivraisons.commercial_id=' . $commercial_id;
                $cond8 = 'Reglementcommercials.commercial_id=' . $commercial_id;
                $cond9 = 'Bonusmaluscommercials.commercial_id=' . $commercial_id;
            }

            $i = -1;
            $connection = ConnectionManager::get('default');
            $soldes = $connection->execute("select soldecommercial(" . $commercial_id . ",'" . $this->request->getQuery()['Date_debut'] . " 00:00:00' ) as v")->fetchAll('assoc');
            $solde = $soldes[0]['v'];

            $reglementcommercials = $this->Reglementcommercials->find('all')->where([$cond2, $cond5, $cond8]);
            foreach ($reglementcommercials as $com) {
                $i++;
                $Lignereglementcommercials = $this->Lignereglementcommercials->find('all')->where(['Lignereglementcommercials.reglementcommercial_id=' . $com['id']]);
                $this->loadModel('Paiements');
                $paiements = $this->Paiements->get($com['paiement_id'], [
                    'contain' => []
                ]);
                // debug($paiements);die;
                $dat[$i]['type'] = "Reglement Com";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['paiements'] = $paiements['name'];
                // debug($com);
                $mnt = 0;
                $j = -1;
                foreach ($Lignereglementcommercials as $ligne) {
                    $j++;
                    //  debug($ligne);die;
                    if ($ligne['lignebonlivraison_id'] != 0) {
                        $this->loadModel('Lignebonlivraisons');
                        $lignebonlivraisons = $this->Lignebonlivraisons->get($ligne['lignebonlivraison_id'], [
                            'contain' => ['Bonlivraisons', 'Articles']
                        ]);
                        $dat[$i]['ligne'][$j]['arti'] = $lignebonlivraisons['article']['Dsignation'];
                        $dat[$i]['ligne'][$j]['numero'] = $lignebonlivraisons['bonlivraison']['numero'];
                        $dat[$i]['ligne'][$j]['lignebonlivraison_id'] = $ligne['lignebonlivraison_id'];
                        $dat[$i]['ligne'][$j]['lignebonusmalu_id'] = 0;
                        $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                        $dat[$i]['ligne'][$j]['typ'] = "1";
                        $mnt += $ligne['montant'];
                        $dat[$i]['ligne'][$j]['montant'] = "1";
                    }
                    if ($ligne['lignebonusmalu_id'] != 0) {
                        $this->loadModel('Lignebonusmalus');
                        $lignebonusmalus = $this->Lignebonusmalus->get($ligne['lignebonusmalu_id'], [
                            'contain' => ['Bonusmaluscommercials', 'Articles']
                        ]);
                        $dat[$i]['ligne'][$j]['arti'] = $lignebonusmalus['article']['Dsignation'];
                        $dat[$i]['ligne'][$j]['num'] = $lignebonusmalus['Bonusmaluscommercial']['num'];
                        $dat[$i]['ligne'][$j]['lignebonlivraison_id'] = 0;
                        $dat[$i]['ligne'][$j]['lignebonusmalu_id'] = $ligne['lignebonusmalu_id'];
                        $dat[$i]['ligne'][$j]['montants'] = $ligne['montant'];
                        $dat[$i]['ligne'][$j]['typ'] = "1";
                        $mnt += $ligne['montant'];
                        $dat[$i]['ligne'][$j]['montant'] = "1";
                    }
                }
                //debug($dat) ; die ;
                $dat[$i]['credit'] = $mnt;
                $dat[$i]['debit'] = 0;
            }
            $bonlivraisons = $this->Bonlivraisons->find('all')->where([$cond1, $cond4, $cond7]);
            foreach ($bonlivraisons as $com) {
                $i++;
                $Lignebonlivraisons = $this->Lignebonlivraisons->find('all')->where(['Lignebonlivraisons.bonlivraison_id=' . $com['id']]);
                //  debug($Lignebonlivraisons);//die;
                $this->loadModel('Clients');
                $clients = $this->Clients->get($com['client_id'], [
                    'contain' => []
                ]);
                //  debug($clients);die;
                $dat[$i]['type'] = "Com BL ";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['date'] = $com['date'];
                $dat[$i]['clients'] = $clients['Raison_Sociale'];
                $mnt = 0;
                $j = -1;
                // debug($Lignebonlivraisons);die;
                foreach ($Lignebonlivraisons as $ligne) {
                    //  debug($ligne);//die;
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['nouv_client'] = $ligne['nouv_client'];
                    $dat[$i]['ligne'][$j]['nouv_article'] = $ligne['nouv_article'];
                    $dat[$i]['ligne'][$j]['montantcommissions'] = $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += $ligne['montantcommission'];
                    $dat[$i]['ligne'][$j]['montantcommission'] = "2";
                }
                // debug($mnt);
                $dat[$i]['debit'] = $mnt;
                $dat[$i]['credit'] = 0;
            }
            $bonusmaluscommercials = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9, 'Bonusmaluscommercials.total>0']);
            foreach ($bonusmaluscommercials as $com) { {
                    $i++;
                    $Lignebonusmalus = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id']]);
                    $dat[$i]['type'] = "Cloture période du ";
                    $dat[$i]['id'] = $com['id'];
                    $dat[$i]['numero'] = $com['numero'];
                    $dat[$i]['datedebut'] = $com['datedebut'];
                    $dat[$i]['datefin'] = $com['datefin'];
                    $dat[$i]['date'] = $com['dateoperation'];
                    $dat[$i]['ty'] = "bonus";
                    // debug($com);die;
                    $j = -1;
                    $mnt = 0;
                    foreach ($Lignebonusmalus as $j => $ligne) {
                        $j++;
                        $this->loadModel('Articles');
                        $articles = $this->Articles->get($ligne['article_id'], [
                            'contain' => []
                        ]);
                        //debug($articles);die;
                        $dat[$i]['ligne'][$j]['arti'] = $articles['qtr'];
                        $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                        $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                        $dat[$i]['ligne'][$j]['qtelivre'] = $ligne['qtelivre'];
                        $dat[$i]['ligne'][$j]['montantss'] = $ligne['montant'];
                        $dat[$i]['ligne'][$j]['typ'] = "1";
                        $mnt += $ligne['montant'];
                        $dat[$i]['ligne'][$j]['montant'] = "1";
                        // debug($dataa);die;
                    }
                    $dat[$i]['debit'] = $mnt;
                    $dat[$i]['credit'] = 0;
                }
            }
            $bonusmaluscommercialsmal = $this->Bonusmaluscommercials->find('all')->where([$cond3, $cond6, $cond9, 'Bonusmaluscommercials.total<0']);
            foreach ($bonusmaluscommercialsmal as $com) {
                $i++;
                $Lignebonusmaluss = $this->Lignebonusmalus->find('all')->where(['Lignebonusmalus.bonusmaluscommercial_id=' . $com['id']]);
                $dat[$i]['type'] = "Cloture période du ";
                $dat[$i]['id'] = $com['id'];
                $dat[$i]['numero'] = $com['numero'];
                $dat[$i]['datedebut'] = $com['datedebut'];
                $dat[$i]['datefin'] = $com['datefin'];
                $dat[$i]['date'] = $com['dateoperation'];
                $dat[$i]['ty'] = "malus";
                $j = -1;
                $mnt = 0;
                foreach ($Lignebonusmaluss as $ligne) {
                    $j++;
                    $this->loadModel('Articles');
                    $articles = $this->Articles->get($ligne['article_id'], [
                        'contain' => []
                    ]);
                    $dat[$i]['ligne'][$j]['articles'] = $articles['Dsignation'];
                    $dat[$i]['ligne'][$j]['objectif'] = $ligne['objectif'];
                    $dat[$i]['ligne'][$j]['montantss'] = $ligne['montant'];
                    $dat[$i]['ligne'][$j]['typ'] = "2";
                    $mnt += - ($ligne['montant']);
                    $dat[$i]['ligne'][$j]['montant'] = "1";
                }
                $dat[$i]['credit'] = $mnt;
                $dat[$i]['debit'] = 0;
            }
        }
        $this->loadModel('Commercials');
        $this->loadModel('Articles');
        $this->loadModel('Paiements');
        $commercials = $this->Commercials->find('list', ['limit' => 200]);

        $this->set(compact('commercial_id', 'Date_debut', 'Date_fin', 'solde', 'dat', 'commercials'));
    }

    public function index()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        //  debug($liendd);die;
        $artic = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'article') {
                $artic = 1;
            }
            if (@$liens['lien'] == 'fichearticle') {
                $artic = 2;
            }
        }
        // debug($societe);die;
        if (($artic == 0)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $cond1 = '';
        $cond2 = '';
        $cond3 = '';
        $cond4 = '';
        $cond5 = '';
        $cond6 = '';
        $etat = $this->request->getQuery('etat');
        $Code = $this->request->getQuery('Code');
        $Dsignation = $this->request->getQuery('Dsignation');
        $famille_id = $this->request->getQuery('famille_id');
        $sousfamille1_id = $this->request->getQuery('sousfamille1_id');
        $sousfamille2_id = $this->request->getQuery('sousfamille2_id');

        //debug( $this->request->getQuery());die;
        if ($Code) {
            $cond1 = "Articles.Code like  '%" . $Code . "%' ";
        }
        if ($sousfamille1_id) {
            $cond2 = "Articles.sousfamille1_id  = " . $sousfamille1_id;
        }
        if ($sousfamille2_id) {
            $cond3 = "Articles.sousfamille2_id  = " . $sousfamille2_id;
        }
        if ($Dsignation) {
            $cond4 = "Articles.Dsignation  like  '%" . $Dsignation . "%' ";
        }
        if ($famille_id) {
            $cond5 = "Articles.famille_id  = " . $famille_id;
        }
        if ($etat) {
            if ($etat == 'Veuillez choisir !!') {
                $cond6 = '';
            } else {
                $cond6 = "Articles.etat=" . $etat;
            }
        }
        if ($artic == 2) {
            $condtype = "";
        } else if ($artic == 1) {
            $condtype = "";
        }

        $query = $this->Articles->find('all', ['limit' => 200])->where([$cond1, $cond2, $cond3, $cond4, $cond5, $cond6, $condtype]);
        //debug($query);
        $this->paginate = [
            'contain' => ['Familles', 'Tvas', 'Marques'],
            'order' => ['id' => 'ASC']
        ];
        $articles = $this->paginate($query);
        //debug($articles);die;
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
        //     ->where(["Sousfamille1s.famille_id = " . $articles->famille_id . ""]);

        // $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
        //     ->where(["Sousfamille2s.sousfamille1_id = " . $articles->sousfamille1_id . ""]);

        // debug($sousfamille2s);die;
        $marques = $this->fetchTable('Marques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('articles', 'familles', 'marques', 'sousfamille2s', 'sousfamille1s'));
    }

    /**
     * View method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        //   debug($liendd);
        $artic = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'article') {
                $artic = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($artic <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
        'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;



        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
        'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
        'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;





        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
        'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;


        $article = $this->Articles->get($id, [
            'contain' => ['Tvas', 'Familles'],
        ]);
        // debug($article);



        // $codeart = substr($article->codeabarre, -4);
        // debug($article->codeabarre);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $this->loadModel('Uaprincipals');
            $this->loadModel('Clientarticles');
            $data['article_id'] = $this->request->getData('article_id');
            $data['unitearticle_id'] = $this->request->getData('unitearticle_id');
            $data['Correspand'] = $this->request->getData('Correspand');
            $data['client_id'] = $this->request->getData('client_id');
            $data['prix'] = $this->request->getData('prix');
            // $data['article_id'] = $this->request->getData('article_id');
            //debug($this->request->getData());
            // die;
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            // debug($article);
            $codearticle = $this->request->getData('codearticle');
            // debug($codearticle);



            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $codefinale = $codepays . $codeproducteur . $codearticle;

            //  debug($codefinale);
            $article->codeabarre = $codefinale;

            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
            //debug($name) ;//die;

            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }
            //  debug($article);die;

            //$article->image=$name;
            // if ($article_id=($this->Articles->save($article)->id)){
            if ($this->Articles->save($article)) {
                $id = $article['id'];
                $this->misejour("Articles", "edit", $id);
                $article_id = $article->id;
                $uaprincipal = $this->Uaprincipals->find('all')
                    ->where(["Uaprincipals.article_id  ='" . $id . "'"]);
                foreach ($uaprincipal as $ccc) {
                    $this->fetchTable('Uaprincipals')->delete($ccc);
                }
                if (isset($this->request->getData('data')['uaprincipals']) && (!empty($this->request->getData('data')['uaprincipals']))) {
                    foreach ($this->request->getData('data')['uaprincipals'] as $i => $tar) {
                        //debug($this->request->getData());
                        //die;
                        if ($tar['sup0'] != 1) {
                            $data['article_id'] = $article_id;
                            $data['unitearticle_id'] = $tar['unitearticle_id'];
                            $data['Correspand'] = $tar['Correspand'];

                            $uaprincipal = $this->fetchTable('Uaprincipals')->newEmptyEntity();
                            $uaprincipal = $this->Uaprincipals->patchEntity($uaprincipal, $data);
                            if ($this->Uaprincipals->save($uaprincipal)) {
                                // debug($data);
                                // debug($tar);
                                // debug($uaprincipal);
                            } else {
                            }
                        }
                    }
                }

                $clientarticle = $this->fetchTable('Clientarticles')->find('all', [
                    'contain' => ['Clients'],
                ])
                    ->where(["Clientarticles.article_id  ='" . $id . "'"]);
                //debug($clientarticle);
                //die;
                foreach ($clientarticle as $caa) {
                    $this->fetchTable('Clientarticles')->delete($caa);
                }
                $arrticle_id = $article->id;
                if (isset($this->request->getData('data')['clientarticles']) && (!empty($this->request->getData('data')['clientarticles']))) {
                    foreach ($this->request->getData('data')['clientarticles'] as $a => $tarr) {
                        //debug($this->request->getData('data')['clientarticles']);
                        //die;
                        if ($tar['sup1'] != 1) {
                            $data['article_id'] = $arrticle_id;
                            $data['client_id'] = $tarr['client_id'];
                            $data['prix'] = $tarr['prix'];
                            // debug($data);
                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            $clientarticle = $this->Clientarticles->patchEntity($clientarticle, $data);
                            if ($this->Clientarticles->save($clientarticle)) {
                                // debug($clientarticle);die;
                            } else {
                            }
                        }
                    }
                }








                if (isset($this->request->getData('data')['articlefr']) && (!empty($this->request->getData('data')['articlefr']))) {
                    foreach ($this->request->getData('data')['articlefr'] as $j => $p) {

                        //die;

                        if ($p['supfr'] != 1) {


                            $articlefr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                            $data['article_id'] = $id;
                            $data['prix'] = $p['prix'];
                            $data['code'] = $p['code'];
                            $data['fournisseur_id'] = $p['fr_id'];

                            // debug($data);
                            //    debug($p);
                            if (isset($p['id']) && (!empty($p['id']))) {

                                $articlefr = $this->fetchTable('Articlefournisseurs')->get($p['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $articlefr  = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                            };
                            $articlefr = $this->fetchTable('Articlefournisseurs')->patchEntity($articlefr, $data);
                            $this->fetchTable('Articlefournisseurs')->save($articlefr);
                        } else if ($p['supfr'] == 1 && !empty($p['id'])) {
                            $articlefr = $this->fetchTable('Articlefournisseurs')->get($p['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Articlefournisseurs')->delete($articlefr);
                        }
                    }
                }
                $seuilss = $this->fetchTable('Seuilmois')->find('all', [])
                    ->where(["Seuilmois.article_id = " . $id . ""]);

                foreach ($seuilss as $ss) {
                    $this->fetchTable('Seuilmois')->delete($ss);
                }
                $Fichearticles = $this->fetchTable('Fichearticles')->find('all', [])
                    ->where(["Fichearticles.article_id =" . $id]);

                foreach ($Fichearticles as $f) {
                    $this->fetchTable('Fichearticles')->delete($f);
                }

                if (isset($this->request->getData('data')['Ofsfligne']) && (!empty($this->request->getData('data')['Ofsfligne']))) {
                    foreach ($this->request->getData('data')['Ofsfligne'] as $i => $Ofsfligne) {
                        // debug($Ofsfligne);
                        //die;
                        if ($Ofsfligne['sup'] != 1) {
                            if ($Ofsfligne['article_id'] != '') {
                                $d = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                $d['article_id'] = $article->id;
                                $d['article_id1'] = $Ofsfligne['article_id'];
                                $d['article_id2'] = 0;
                                $d['article_id3'] = 0;
                                $d['qte'] = $Ofsfligne['qte'];
                                //         $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                if ($this->fetchTable('Fichearticles')->save($d)) {
                                    //   debug($d);
                                    foreach ($Ofsfligne['Phaseofsf'] as $i => $Phaseofsf) {
                                        //debug($Phaseofsf);
                                        if ($Phaseofsf['supp2'] != 1) {
                                            if ($Phaseofsf['article_idt'] != '') {
                                                $dd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                                $dd['article_id'] = $article->id;
                                                $dd['article_id1'] = $Ofsfligne['article_id'];
                                                $dd['article_id2'] = $Phaseofsf['article_idt'];;
                                                $dd['article_id3'] = 0;
                                                $dd['qte'] = $Phaseofsf['qte'];
                                                //  $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                                if ($this->fetchTable('Fichearticles')->save($dd)) {
                                                    //   debug($dd);
                                                    foreach ($Phaseofsf['Phaseofsfligne'] as $i => $Phaseofsfligne) {
                                                        // debug($Phaseofsfligne);
                                                        if ($Phaseofsfligne['supp3'] != 1) {
                                                            if ($Phaseofsfligne['article_idd'] != '') {
                                                                $ddd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                                                $ddd['article_id'] = $article->id;
                                                                $ddd['article_id1'] = $Ofsfligne['article_id'];
                                                                $ddd['article_id2'] = $Phaseofsf['article_idt'];
                                                                $ddd['article_id3'] = $Phaseofsfligne['article_idd'];
                                                                $ddd['qte'] = $Phaseofsfligne['qte'];
                                                                // $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                                                if ($this->fetchTable('Fichearticles')->save($ddd)) {
                                                                    // debug($ddd);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                //                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                                //
                                //
                                //                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                                //debug($seuil);
                            }
                        }
                    }
                }

                if (isset($this->request->getData('data')['seuil']) && (!empty($this->request->getData('data')['seuil']))) {
                    foreach ($this->request->getData('data')['seuil'] as $i => $b) {
                        //debug($adresseliv);
                        //die;

                        $seuil = $this->fetchTable('Seuilmois')->newEmptyEntity();
                        $data['moi_id'] = $i;
                        $data['min'] = $b['minimum'];
                        $data['max'] = $b['maximum'];
                        $data['alert'] = $b['alert'];
                        $data['article_id'] = $article->id;

                        $seuil = $this->fetchTable('Seuilmois')->patchEntity($seuil, $data);


                        $this->fetchTable('Seuilmois')->save($seuil);
                        //debug($seuil);
                    }
                }



                $objectifrepresentantss = $this->fetchTable('Objectifrepresentants')->find('all', [])
                    ->where(["Objectifrepresentants.article_id = " . $id . ""]);
                //      debug($objectifrepresentantss);die;



                foreach ($objectifrepresentantss as $obj) {
                    $this->fetchTable('Objectifrepresentants')->delete($obj);
                }





                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        //  debug($c);
                        //die;
                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        // $data['mois'] = $i;
                        $dataobj['objectif'] = $c['objectif'];
                        $dataobj['commercial_id'] = $c['commercial'];
                        $dataobj['moi_id'] = $c['mois'];
                        $dataobj['article_id'] = $article->id;
                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                        $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                        //debug($seuil);
                    }
                }
                //  $this->Flash->success(__('Modification effectuée'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('Veuillez réessayer!!!'));
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $frs = $this->fetchTable('Fournisseurs')->find('all', ['contain' => ['Fournisseurs'], 'valueField' => 'name']);



        if ($article->famille_id != null) {
            $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille1s.famille_id = " . $article->famille_id . ""]);
        }

        if ($article->sousfamille1_id != null) {
            $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille2s.sousfamille1_id = " . $article->sousfamille1_id . ""]);
        }

        // $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;
        $charges = $this->fetchTable('Charges')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articlefournisseurs = $this->fetchTable('Articlefournisseurs')->find('all')->where(["Articlefournisseurs.article_id =  $id "]);
        //debug($articlefournisseurs);

        $seuil = $this->fetchTable('Seuilmois')->find('all', ['contain' => ['Mois']])
            ->where(["Seuilmois.article_id = " . $id . ""]);








        $unitearticles = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devices = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $mois = $this->fetchTable('Mois')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');
        $frs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        foreach ($commercials as $com) {
            foreach ($mois as $moi) {

                $objectifrepresentants = $this->fetchTable('Objectifrepresentants')->find('all', [])
                    ->where(["Objectifrepresentants.article_id = " . $id . "", "Objectifrepresentants.commercial_id = " . $com->id . "", "Objectifrepresentants.moi_id = " . $moi->id . "",]);
                //debug($objectifrepresentants);
                if (!empty($objectifrepresentants)) {


                    foreach ($objectifrepresentants as $i) {
                        //    debug($i);

                        $tab[$com->id][$moi->id] = $i->objectif;
                        //   $tab[1][2] = 81;
                        //$tab[1][1] = 8;
                        // $tab[1][2] = 81;
                    }
                } else
                    $tab[$com->id][$moi->id] = 0;
            }
        }
        $fichearticles = $this->fetchTable('Fichearticles')->find('all')
            ->where(['Fichearticles.article_id=' . $id])->group(['Fichearticles.article_id1'])->order(['Fichearticles.id' => 'ASC']);
        //debug($fichearticles);//die;à
        foreach ($fichearticles as $i => $fiche) {
            $dat[$i]['id'] = $fiche['id'];
            $dat[$i]['article_id'] = $fiche['article_id1'];
            $dat[$i]['qte'] = $fiche['qte'];
            $fichearticles1 = $this->fetchTable('Fichearticles')->find('all')
                ->where(['Fichearticles.article_id=' . $id, 'Fichearticles.article_id1=' . $fiche['article_id1'], 'Fichearticles.id!=' . $fiche['id']])->group(['Fichearticles.article_id1', 'Fichearticles.article_id2']);
            // debug($fichearticles1);//die;
            foreach ($fichearticles1 as $j => $fiche1) {
                $dat[$i]['Ligne'][$j]['id'] = $fiche1['id'];
                $dat[$i]['Ligne'][$j]['article_id'] = $fiche1['article_id2'];
                $dat[$i]['Ligne'][$j]['qte'] = $fiche1['qte'];
                $fichearticles2 = $this->fetchTable('Fichearticles')->find('all')
                    ->where(['Fichearticles.article_id=' . $id, 'Fichearticles.article_id1=' . $fiche1['article_id1'], 'Fichearticles.article_id2=' . $fiche1['article_id2'], 'Fichearticles.id!=' . $fiche1['id']])->group(['Fichearticles.article_id1', 'Fichearticles.article_id2', 'Fichearticles.article_id3']);
                // debug($fichearticles2);//die;

                foreach ($fichearticles2 as $k => $fiche2) {
                    $dat[$i]['Ligne'][$j]['ligneligne'][$k]['id'] = $fiche2['id'];
                    $dat[$i]['Ligne'][$j]['ligneligne'][$k]['article_id'] = $fiche2['article_id3'];
                    $dat[$i]['Ligne'][$j]['ligneligne'][$k]['qte'] = $fiche2['qte'];
                }
            }
        }
        // debug($dat);//die;
        // $clientarticle = $this->fetchTable('Clientarticles')->find('all')->where(["Clientarticles.article_id  ='" . $id . "'"]);
        //$clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $clients = $this->fetchTable('Clients')->find('all');
        // debug($clientarticle);
        // die;

        //$articles=$this->Articles->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.vente=0']);
        $articlesss = $this->fetchTable('Articles')->find()->select(['id', 'Dsignation', 'Code'])->where(['Articles.famille_id!=1']);

        foreach ($articlesss as $a) {
            // debug($a->id.' '.$a->Dsignation);
            $articles[$a->id] = $a->Code . ' ' . $a->Dsignation;
        }


        $clientarticles = $this->fetchTable('Clientarticles')->find('all',  [
            'contain' => ['Clients']
        ])
            ->where(["Clientarticles.article_id  ='" . $id . "'"]);
        // debug($clientarticles);
        $famillerotations = $this->fetchTable('Famillerotations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articlees = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.vente=0']);
        //  foreach($mois as $m){debug($m);}
        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $uaprincipals = $this->fetchTable('Uaprincipals')->find('all',  [
            'contain' => ['Unitearticles']
        ])->where(['article_id' => $id]);
        //  debug($uaprincipals);die;
        $marques = $this->fetchTable('Marques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $unitearticless = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //$unitearticless = $this->Unitearticles->Uaprincipals->find('list', ['limit' => 200]);
        // $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
        // ->where(["Sousfamille2s.sousfamille1_id = " . $article->sousfamille1_id . ""]);
        $this->set(compact('clientarticles', 'clients', 'marques', 'uaprincipals', 'unitearticless', 'articlefournisseurs', 'frs', 'articles', 'devices', 'dat', 'charges', 'famillerotations', 'tab', 'articlees', 'objectifrepresentants', 'commercials', 'mois', 'unitearticles', 'sousfamille2s', 'unites', 'tpe', 'seuil', 'codeart', 'article', 'familles', 'sousfamille1s', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->loadModel('Fichearticles');
        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
        'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
        'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;
        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
        'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;
        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
        'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;


        $this->loadModel('Uaprincipals');
        $this->loadModel('Clientarticles');
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        //   debug($liendd);
        $artic = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'article') {
                $artic = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($artic <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }



        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            // debug($this->request->getData());
            $codearticle = $this->request->getData('codearticle');
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $codefinale = $codepays . $codeproducteur . $codearticle;
            // debug($codefinale);
            $article->inserted = '1';
            $article->updated = '0';
            $article->codeabarre = $codefinale;
            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }








            if ($this->Articles->save($article)) {
                $article_id = $article->id;
                $this->loadModel('Uaprincipals');
                if (isset($this->request->getData('data')['uaprincipals']) && (!empty($this->request->getData('data')['uaprincipals']))) {
                    foreach ($this->request->getData('data')['uaprincipals'] as $i => $tar) {
                        //debug($this->request->getData());
                        // die;
                        if ($tar['sup0'] != 1) {
                            $data['article_id'] = $article_id;
                            $data['unitearticle_id'] = $tar['unitearticle_id'];
                            $data['Correspand'] = $tar['Correspand'];

                            $uaprincipal = $this->fetchTable('Uaprincipals')->newEmptyEntity();
                            $uaprincipal = $this->Uaprincipals->patchEntity($uaprincipal, $data);
                            if ($this->Uaprincipals->save($uaprincipal)) {
                                //debug($data);
                                //debug($tar);
                                //debug($uaprincipal);
                            } else {
                            }
                        }
                    }
                }
                if (isset($this->request->getData('data')['clientarticles']) && (!empty($this->request->getData('data')['clientarticles']))) {
                    foreach ($this->request->getData('data')['clientarticles'] as $a => $tarr) {
                        // debug($this->request->getData());
                        // die;
                        if ($tar['sup1'] != 1) {
                            $data['article_id'] = $article_id;
                            $data['client_id'] = $tarr['client_id'];
                            $data['prix'] = $tarr['prix'];
                            $data['inserted'] = '1';
                            $data['updated'] = '0';
                            // debug($data);
                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            $clientarticle = $this->Clientarticles->patchEntity($clientarticle, $data);
                            if ($this->Clientarticles->save($clientarticle)) {
                                // debug($clientarticle);
                            } else {
                            }
                        }
                    }
                }









                //   debug($article);
                $id = $article->id;


                if (isset($this->request->getData('data')['articlefr']) && (!empty($this->request->getData('data')['articlefr']))) {
                    foreach ($this->request->getData('data')['articlefr'] as $j => $p) {
                        // debug($p['prix']);die;
                        //die;

                        if ($p['supfr'] != 1) {
                            $articlefr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();

                            //debug($clientarticle);
                            $data['article_id'] = $id;
                            $data['prix'] = $p['prix'];
                            $data['code'] = $p['code'];
                            $data['fournisseur_id'] = $p['fr_id'];
                            $articlefr = $this->fetchTable('Articlefournisseurs')->patchEntity($articlefr, $data);
                            $this->fetchTable('Articlefournisseurs')->save($articlefr);
                            //  debug($articlefr);
                            //die;
                        }
                    }
                }

                // if (isset($this->request->getData('data')['Ofsfligne']) && (!empty($this->request->getData('data')['Ofsfligne']))) {
                //     foreach ($this->request->getData('data')['Ofsfligne'] as $i => $Ofsfligne) {
                //         // debug($Ofsfligne);
                //         //die;                    
                //         if ($Ofsfligne['sup'] != 1) {
                //             if ($Ofsfligne['article_id'] != '') {
                //                 $d = $this->fetchTable('Fichearticles')->newEmptyEntity();
                //                 $d['article_id'] = $article->id;
                //                 $d['article_id1'] = $Ofsfligne['article_id'];
                //                 $d['article_id2'] = 0;
                //                 $d['article_id3'] = 0;
                //                 $d['qte'] = $Ofsfligne['qte'];

                //                 //         $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);

                //                 if ($this->fetchTable('Fichearticles')->save($d)) {
                //                     //   debug($d);
                //                     foreach ($Ofsfligne['Phaseofsf'] as $i => $Phaseofsf) {
                //                         //debug($Phaseofsf);
                //                         if ($Phaseofsf['supp2'] != 1) {
                //                             if ($Phaseofsf['article_id'] != '') {
                //                                 $dd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                //                                 $dd['article_id'] = $article->id;
                //                                 $dd['article_id1'] = $Ofsfligne['article_id'];
                //                                 $dd['article_id2'] = $Phaseofsf['article_id'];;
                //                                 $dd['article_id3'] = 0;
                //                                 $dd['qte'] = $Phaseofsf['qte'];

                //                                 //  $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);

                //                                 if ($this->fetchTable('Fichearticles')->save($dd)) {
                //                                     //   debug($dd);
                //                                     foreach ($Phaseofsf['Phaseofsfligne'] as $i => $Phaseofsfligne) {
                //                                         // debug($Phaseofsfligne);
                //                                         if ($Phaseofsfligne['supp3'] != 1) {
                //                                             if ($Phaseofsfligne['article_id'] != '') {
                //                                                 $ddd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                //                                                 $ddd['article_id'] = $article->id;
                //                                                 $ddd['article_id1'] = $Ofsfligne['article_id'];
                //                                                 $ddd['article_id2'] = $Phaseofsf['article_id'];
                //                                                 $ddd['article_id3'] = $Phaseofsfligne['article_id'];
                //                                                 $ddd['qte'] = $Phaseofsfligne['qte'];

                //                                                 // $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);

                //                                                 if ($this->fetchTable('Fichearticles')->save($ddd)) {
                //                                                     // debug($ddd);

                //                                                 }
                //                                             }
                //                                         }
                //                                     }
                //                                 }
                //                             }
                //                         }
                //                     }
                //                 }








                //                 //                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                //                 //
                //                 //
                //                 //                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                //                 //debug($seuil);
                //             }
                //         }
                //     }
                // }

                if (isset($this->request->getData('data')['Ofsfligne']) && (!empty($this->request->getData('data')['Ofsfligne']))) {
                    foreach ($this->request->getData('data')['Ofsfligne'] as $i => $Ofsfligne) {
                        // debug($Ofsfligne);
                        //die;
                        if ($Ofsfligne['sup'] != 1) {
                            if ($Ofsfligne['article_id'] != '') {
                                $d = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                $d['article_id'] = $article->id;
                                $d['article_id1'] = $Ofsfligne['article_id'];
                                $d['article_id2'] = 0;
                                $d['article_id3'] = 0;
                                $d['qte'] = $Ofsfligne['qte'];
                                //         $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                if ($this->fetchTable('Fichearticles')->save($d)) {
                                    //   debug($d);
                                    foreach ($Ofsfligne['Phaseofsf'] as $i => $Phaseofsf) {
                                        //debug($Phaseofsf);
                                        if ($Phaseofsf['supp2'] != 1) {
                                            if ($Phaseofsf['article_idt'] != '') {
                                                $dd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                                $dd['article_id'] = $article->id;
                                                $dd['article_id1'] = $Ofsfligne['article_id'];
                                                $dd['article_id2'] = $Phaseofsf['article_idt'];;
                                                $dd['article_id3'] = 0;
                                                $dd['qte'] = $Phaseofsf['qte'];
                                                //  $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                                if ($this->fetchTable('Fichearticles')->save($dd)) {
                                                    //   debug($dd);
                                                    foreach ($Phaseofsf['Phaseofsfligne'] as $i => $Phaseofsfligne) {
                                                        // debug($Phaseofsfligne);
                                                        if ($Phaseofsfligne['supp3'] != 1) {
                                                            if ($Phaseofsfligne['article_idd'] != '') {
                                                                $ddd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                                                $ddd['article_id'] = $article->id;
                                                                $ddd['article_id1'] = $Ofsfligne['article_id'];
                                                                $ddd['article_id2'] = $Phaseofsf['article_idt'];
                                                                $ddd['article_id3'] = $Phaseofsfligne['article_idd'];
                                                                $ddd['qte'] = $Phaseofsfligne['qte'];
                                                                // $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                                                if ($this->fetchTable('Fichearticles')->save($ddd)) {
                                                                    // debug($ddd);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                //                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                                //
                                //
                                //                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                                //debug($seuil);
                            }
                        }
                    }
                }




                if (isset($this->request->getData('data')['seuil']) && (!empty($this->request->getData('data')['seuil']))) {
                    foreach ($this->request->getData('data')['seuil'] as $i => $b) {
                        //debug($adresseliv);
                        //die;
                        //  if($b['minimum'] != '' &&  $b['maximum'] != '' && $b['alert'] != '' ) {




                        $seuil = $this->fetchTable('Seuilmois')->newEmptyEntity();
                        $data['moi_id'] = $i;
                        $data['min'] = $b['minimum'];
                        $data['max'] = $b['maximum'];
                        $data['alert'] = $b['alert'];
                        $data['article_id'] = $article->id;

                        $seuil = $this->fetchTable('Seuilmois')->patchEntity($seuil, $data);


                        $this->fetchTable('Seuilmois')->save($seuil);
                        // }
                        //debug($seuil);
                    }
                }




                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        //debug($adresseliv);
                        //die;
                        // if ($c['objectif'] != '') {




                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        // $data['mois'] = $i;
                        $dataobj['objectif'] = $c['objectif'];
                        $dataobj['commercial_id'] = $c['commercial'];
                        $dataobj['moi_id'] = $c['mois'];
                        $dataobj['article_id'] = $article->id;
                        //  debug($dataobj);



                        if (!empty($c['objectif'])) {
                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                            //debug($objectifrepresentant);
                        }                            //debug($seuil);
                        //}
                    }
                }





















                return $this->redirect(['action' => 'index']);
            }
        }
        /*    $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
        ->where(["Sousfamille2s.sousfamille1_id =  $article->sousfamille1_id "]);*/
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $devices = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $charges = $this->fetchTable('Charges')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $unitearticles = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $frs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        // $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;
        //debug($val);

        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);


        $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //  ->where(["Sousfamille1s.famille_id = " . $article->famille_id . ""]);

        $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //  ->where(["Sousfamille2s.sousfamille1_id = " . $article->sousfamille1_id . ""]);



        $mois = $this->fetchTable('Mois')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');





        $famillerotations = $this->fetchTable('Famillerotations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        //$articles=$this->Articles->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.vente=0']);
        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $articlesss = $this->fetchTable('Articles')->find()->select(['id', 'Dsignation', 'Code'])->where(['Articles.famille_id!=1']);
        // debug($articles);
        foreach ($articlesss as $a) {
            // debug($a->id.' '.$a->Dsignation);
            $articles[$a->id] = $a->Code . ' ' . $a->Dsignation;
        }
        $marques = $this->fetchTable('Marques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        //debug($articles);die;
        $clientt = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $clients = $this->fetchTable('Clients')->find('all');
        $unitearticless = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('clients', 'clientt', 'unitearticless', 'articles', 'marques', 'frs', 'devices', 'charges', 'famillerotations', 'commercials', 'mois', 'unitearticles', 'tpe', 'unites', 'article', 'familles', 'sousfamille2s', 'sousfamille1s', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }
    public function getarticlecmd($id = null)
    {
        $this->loadModel('Commandes');
        $id = $this->request->getQuery('idfournisseur');

        // Count associated records for the client
        $commandeCount = $this->fetchTable('Ligneommandefournisseurs')->find()->where(['Ligneommandefournisseurs.article_id' => $id])->count();
        $bonlivraisonCount = $this->fetchTable('Lignelivraisons')->find()->where(['Lignelivraisons.article_id' => $id])->count();
        $factureCount = $this->fetchTable('Lignefactures')->find()->where(['Lignefactures.article_id' => $id])->count();
        $avoirCount = $this->fetchTable('Lignefactureavoirfrs')->find()->where(['Lignefactureavoirfrs.article_id' => $id])->count();

        $offreCount = $this->fetchTable('Lignedemandeoffredeprixes')->find()->where(['Lignedemandeoffredeprixes.article_id' => $id])->count();

        $commandeCountv = $this->fetchTable('Lignecommandes')->find()->where(['Lignecommandes.article_id' => $id])->count();
        $bonlivraisonCountv = $this->fetchTable('Lignebonlivraisons')->find()->where(['Lignebonlivraisons.article_id' => $id])->count();
        $factureCountv = $this->fetchTable('Lignefactureclients')->find()->where(['Lignefactureclients.article_id' => $id])->count();
        $sortieCountv = $this->fetchTable('Lignebonsortiestocks')->find()->where(['Lignebonsortiestocks.article_id' => $id])->count();
        $avoirCountv = $this->fetchTable('Lignefactureavoirs')->find()->where(['Lignefactureavoirs.article_id' => $id])->count();


        // Check if there are any related records
        $hasDependencies = $commandeCount + $bonlivraisonCount + $factureCount + $offreCount  + $avoirCount + $commandeCountv + $bonlivraisonCountv + $factureCountv + $sortieCountv  + $avoirCountv > 0;

        echo json_encode([
            "hasDependencies" => $hasDependencies,
            "success" => true
        ]);
        die;
    }
    /**
     * Edit method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        //   debug($liendd);
        $artic = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'article') {
                $artic = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($artic <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
        'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;



        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
        'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
        'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;





        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
        'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;


        $article = $this->Articles->get($id, [
            'contain' => ['Tvas', 'Familles'],
        ]);
        /// debug($article);die;



        if ($article->codeabarre != null) {
            $codeart = substr($article->codeabarre, -4);
        }

        // debug($article->codeabarre);

        if ($this->request->is(['patch', 'post', 'put'])) {
            // debug($this->request->getData());
            $codearticle = $this->request->getData('codearticle');
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            $codefinale = $codepays . $codeproducteur . $codearticle;
            // debug($codefinale);
            $article->inserted = '1';
            $article->updated = '0';
            $article->codeabarre = $codefinale;
            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }








            if ($this->Articles->save($article)) {
                $article_id = $article->id;
                $this->loadModel('Uaprincipals');
                if (isset($this->request->getData('data')['uaprincipals']) && (!empty($this->request->getData('data')['uaprincipals']))) {
                    foreach ($this->request->getData('data')['uaprincipals'] as $i => $tar) {
                        //debug($this->request->getData());
                        // die;
                        if ($tar['sup0'] != 1) {
                            $data['article_id'] = $article_id;
                            $data['unitearticle_id'] = $tar['unitearticle_id'];
                            $data['Correspand'] = $tar['Correspand'];

                            $uaprincipal = $this->fetchTable('Uaprincipals')->newEmptyEntity();
                            $uaprincipal = $this->Uaprincipals->patchEntity($uaprincipal, $data);
                            if ($this->Uaprincipals->save($uaprincipal)) {
                                //debug($data);
                                //debug($tar);
                                //debug($uaprincipal);
                            } else {
                            }
                        }
                    }
                }
                if (isset($this->request->getData('data')['clientarticles']) && (!empty($this->request->getData('data')['clientarticles']))) {
                    foreach ($this->request->getData('data')['clientarticles'] as $a => $tarr) {
                        // debug($this->request->getData());
                        // die;
                        if ($tar['sup1'] != 1) {
                            $data['article_id'] = $article_id;
                            $data['client_id'] = $tarr['client_id'];
                            $data['prix'] = $tarr['prix'];
                            $data['inserted'] = '1';
                            $data['updated'] = '0';
                            // debug($data);
                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            $clientarticle = $this->Clientarticles->patchEntity($clientarticle, $data);
                            if ($this->Clientarticles->save($clientarticle)) {
                                // debug($clientarticle);
                            } else {
                            }
                        }
                    }
                }









                //   debug($article);
                $id = $article->id;


                if (isset($this->request->getData('data')['articlefr']) && (!empty($this->request->getData('data')['articlefr']))) {
                    foreach ($this->request->getData('data')['articlefr'] as $j => $p) {
                        // debug($p['prix']);die;
                        //die;

                        if ($p['supfr'] != 1) {
                            $articlefr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();

                            //debug($clientarticle);
                            $data['article_id'] = $id;
                            $data['prix'] = $p['prix'];
                            $data['code'] = $p['code'];
                            $data['fournisseur_id'] = $p['fr_id'];
                            $articlefr = $this->fetchTable('Articlefournisseurs')->patchEntity($articlefr, $data);
                            $this->fetchTable('Articlefournisseurs')->save($articlefr);
                            //  debug($articlefr);
                            //die;
                        }
                    }
                }

                // if (isset($this->request->getData('data')['Ofsfligne']) && (!empty($this->request->getData('data')['Ofsfligne']))) {
                //     foreach ($this->request->getData('data')['Ofsfligne'] as $i => $Ofsfligne) {
                //         // debug($Ofsfligne);
                //         //die;                    
                //         if ($Ofsfligne['sup'] != 1) {
                //             if ($Ofsfligne['article_id'] != '') {
                //                 $d = $this->fetchTable('Fichearticles')->newEmptyEntity();
                //                 $d['article_id'] = $article->id;
                //                 $d['article_id1'] = $Ofsfligne['article_id'];
                //                 $d['article_id2'] = 0;
                //                 $d['article_id3'] = 0;
                //                 $d['qte'] = $Ofsfligne['qte'];

                //                 //         $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);

                //                 if ($this->fetchTable('Fichearticles')->save($d)) {
                //                     //   debug($d);
                //                     foreach ($Ofsfligne['Phaseofsf'] as $i => $Phaseofsf) {
                //                         //debug($Phaseofsf);
                //                         if ($Phaseofsf['supp2'] != 1) {
                //                             if ($Phaseofsf['article_id'] != '') {
                //                                 $dd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                //                                 $dd['article_id'] = $article->id;
                //                                 $dd['article_id1'] = $Ofsfligne['article_id'];
                //                                 $dd['article_id2'] = $Phaseofsf['article_id'];;
                //                                 $dd['article_id3'] = 0;
                //                                 $dd['qte'] = $Phaseofsf['qte'];

                //                                 //  $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);

                //                                 if ($this->fetchTable('Fichearticles')->save($dd)) {
                //                                     //   debug($dd);
                //                                     foreach ($Phaseofsf['Phaseofsfligne'] as $i => $Phaseofsfligne) {
                //                                         // debug($Phaseofsfligne);
                //                                         if ($Phaseofsfligne['supp3'] != 1) {
                //                                             if ($Phaseofsfligne['article_id'] != '') {
                //                                                 $ddd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                //                                                 $ddd['article_id'] = $article->id;
                //                                                 $ddd['article_id1'] = $Ofsfligne['article_id'];
                //                                                 $ddd['article_id2'] = $Phaseofsf['article_id'];
                //                                                 $ddd['article_id3'] = $Phaseofsfligne['article_id'];
                //                                                 $ddd['qte'] = $Phaseofsfligne['qte'];

                //                                                 // $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);

                //                                                 if ($this->fetchTable('Fichearticles')->save($ddd)) {
                //                                                     // debug($ddd);

                //                                                 }
                //                                             }
                //                                         }
                //                                     }
                //                                 }
                //                             }
                //                         }
                //                     }
                //                 }








                //                 //                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                //                 //
                //                 //
                //                 //                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                //                 //debug($seuil);
                //             }
                //         }
                //     }
                // }

                if (isset($this->request->getData('data')['Ofsfligne']) && (!empty($this->request->getData('data')['Ofsfligne']))) {
                    foreach ($this->request->getData('data')['Ofsfligne'] as $i => $Ofsfligne) {
                        // debug($Ofsfligne);
                        //die;
                        if ($Ofsfligne['sup'] != 1) {
                            if ($Ofsfligne['article_id'] != '') {
                                $d = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                $d['article_id'] = $article->id;
                                $d['article_id1'] = $Ofsfligne['article_id'];
                                $d['article_id2'] = 0;
                                $d['article_id3'] = 0;
                                $d['qte'] = $Ofsfligne['qte'];
                                //         $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                if ($this->fetchTable('Fichearticles')->save($d)) {
                                    //   debug($d);
                                    foreach ($Ofsfligne['Phaseofsf'] as $i => $Phaseofsf) {
                                        //debug($Phaseofsf);
                                        if ($Phaseofsf['supp2'] != 1) {
                                            if ($Phaseofsf['article_idt'] != '') {
                                                $dd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                                $dd['article_id'] = $article->id;
                                                $dd['article_id1'] = $Ofsfligne['article_id'];
                                                $dd['article_id2'] = $Phaseofsf['article_idt'];;
                                                $dd['article_id3'] = 0;
                                                $dd['qte'] = $Phaseofsf['qte'];
                                                //  $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                                if ($this->fetchTable('Fichearticles')->save($dd)) {
                                                    //   debug($dd);
                                                    foreach ($Phaseofsf['Phaseofsfligne'] as $i => $Phaseofsfligne) {
                                                        // debug($Phaseofsfligne);
                                                        if ($Phaseofsfligne['supp3'] != 1) {
                                                            if ($Phaseofsfligne['article_idd'] != '') {
                                                                $ddd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                                                $ddd['article_id'] = $article->id;
                                                                $ddd['article_id1'] = $Ofsfligne['article_id'];
                                                                $ddd['article_id2'] = $Phaseofsf['article_idt'];
                                                                $ddd['article_id3'] = $Phaseofsfligne['article_idd'];
                                                                $ddd['qte'] = $Phaseofsfligne['qte'];
                                                                // $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                                                if ($this->fetchTable('Fichearticles')->save($ddd)) {
                                                                    // debug($ddd);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                //                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                                //
                                //
                                //                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                                //debug($seuil);
                            }
                        }
                    }
                }




                if (isset($this->request->getData('data')['seuil']) && (!empty($this->request->getData('data')['seuil']))) {
                    foreach ($this->request->getData('data')['seuil'] as $i => $b) {
                        //debug($adresseliv);
                        //die;
                        //  if($b['minimum'] != '' &&  $b['maximum'] != '' && $b['alert'] != '' ) {




                        $seuil = $this->fetchTable('Seuilmois')->newEmptyEntity();
                        $data['moi_id'] = $i;
                        $data['min'] = $b['minimum'];
                        $data['max'] = $b['maximum'];
                        $data['alert'] = $b['alert'];
                        $data['article_id'] = $article->id;

                        $seuil = $this->fetchTable('Seuilmois')->patchEntity($seuil, $data);


                        $this->fetchTable('Seuilmois')->save($seuil);
                        // }
                        //debug($seuil);
                    }
                }




                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        //debug($adresseliv);
                        //die;
                        // if ($c['objectif'] != '') {




                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        // $data['mois'] = $i;
                        $dataobj['objectif'] = $c['objectif'];
                        $dataobj['commercial_id'] = $c['commercial'];
                        $dataobj['moi_id'] = $c['mois'];
                        $dataobj['article_id'] = $article->id;
                        //  debug($dataobj);



                        if (!empty($c['objectif'])) {
                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                            //debug($objectifrepresentant);
                        }                            //debug($seuil);
                        //}
                    }
                }





















                return $this->redirect(['action' => 'index']);
            }
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $frs = $this->fetchTable('Fournisseurs')->find('all', ['contain' => ['Fournisseurs'], 'valueField' => 'name']);



        if ($article->famille_id != null) {
            $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille1s.famille_id = " . $article->famille_id . ""]);
        }

        if ($article->sousfamille1_id != null) {
            $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille2s.sousfamille1_id = " . $article->sousfamille1_id . ""]);
        }

        // $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;
        $charges = $this->fetchTable('Charges')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articlefournisseurs = $this->fetchTable('Articlefournisseurs')->find('all')->where(["Articlefournisseurs.article_id =  $id "]);
        //debug($articlefournisseurs);

        $seuil = $this->fetchTable('Seuilmois')->find('all', ['contain' => ['Mois']])
            ->where(["Seuilmois.article_id = " . $id . ""]);








        $unitearticles = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devices = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $mois = $this->fetchTable('Mois')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');
        $frs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        foreach ($commercials as $com) {
            foreach ($mois as $moi) {

                $objectifrepresentants = $this->fetchTable('Objectifrepresentants')->find('all', [])
                    ->where(["Objectifrepresentants.article_id = " . $id . "", "Objectifrepresentants.commercial_id = " . $com->id . "", "Objectifrepresentants.moi_id = " . $moi->id . "",]);
                //debug($objectifrepresentants);
                if (!empty($objectifrepresentants)) {

                    foreach ($objectifrepresentants as $i) {
                        //    debug($i);

                        $array[$com->id][$moi->id] = $i->objectif;

                        $tabb[$com->id][$moi->id] = $i->id;
                    }
                    //  debug($tab);
                } else
                    $tab[$com->id][$moi->id] = 0;
            }
        }

        // debug($tab);
        $fichearticles = $this->fetchTable('Fichearticles')->find('all')
            ->where(['Fichearticles.article_id=' . $id])->group(['Fichearticles.article_id1'])->order(['Fichearticles.id' => 'ASC']);
        //debug($fichearticles);//die;à
        foreach ($fichearticles as $i => $fiche) {
            $dat[$i]['id'] = $fiche['id'];
            $dat[$i]['article_id'] = $fiche['article_id1'];
            $dat[$i]['qte'] = $fiche['qte'];
            $fichearticles1 = $this->fetchTable('Fichearticles')->find('all')
                ->where(['Fichearticles.article_id=' . $id, 'Fichearticles.article_id1=' . $fiche['article_id1'], 'Fichearticles.id!=' . $fiche['id']])->group(['Fichearticles.article_id1', 'Fichearticles.article_id2']);
            // debug($fichearticles1);//die;
            foreach ($fichearticles1 as $j => $fiche1) {
                $dat[$i]['Ligne'][$j]['id'] = $fiche1['id'];
                $dat[$i]['Ligne'][$j]['article_id'] = $fiche1['article_id2'];
                $dat[$i]['Ligne'][$j]['qte'] = $fiche1['qte'];
                $fichearticles2 = $this->fetchTable('Fichearticles')->find('all')
                    ->where(['Fichearticles.article_id=' . $id, 'Fichearticles.article_id1=' . $fiche1['article_id1'], 'Fichearticles.article_id2=' . $fiche1['article_id2'], 'Fichearticles.id!=' . $fiche1['id']])->group(['Fichearticles.article_id1', 'Fichearticles.article_id2', 'Fichearticles.article_id3']);
                // debug($fichearticles2);//die;

                foreach ($fichearticles2 as $k => $fiche2) {
                    $dat[$i]['Ligne'][$j]['ligneligne'][$k]['id'] = $fiche2['id'];
                    $dat[$i]['Ligne'][$j]['ligneligne'][$k]['article_id'] = $fiche2['article_id3'];
                    $dat[$i]['Ligne'][$j]['ligneligne'][$k]['qte'] = $fiche2['qte'];
                }
            }
        }
        // debug($dat);//die;
        // $clientarticle = $this->fetchTable('Clientarticles')->find('all')->where(["Clientarticles.article_id  ='" . $id . "'"]);
        //$clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $clients = $this->fetchTable('Clients')->find('all');
        // debug($clientarticle);
        // die;

        //$articles=$this->Articles->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.vente=0']);
        $articlesss = $this->fetchTable('Articles')->find()->select(['id', 'Dsignation', 'Code'])->where(['Articles.famille_id!=1']);

        foreach ($articlesss as $a) {
            // debug($a->id.' '.$a->Dsignation);
            $articles[$a->id] = $a->Code . ' ' . $a->Dsignation;
        }


        $clientarticles = $this->fetchTable('Clientarticles')->find('all',  [
            'contain' => ['Clients']
        ])
            ->where(["Clientarticles.article_id  ='" . $id . "'"]);
        // debug($clientarticles);
        $famillerotations = $this->fetchTable('Famillerotations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articlees = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.vente=0']);
        //  foreach($mois as $m){debug($m);}
        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $uaprincipals = $this->fetchTable('Uaprincipals')->find('all',  [
            'contain' => ['Unitearticles']
        ])->where(['article_id' => $id]);
        //  debug($uaprincipals);die;
        $unitearticless = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //$unitearticless = $this->Unitearticles->Uaprincipals->find('list', ['limit' => 200]);
        // $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
        // ->where(["Sousfamille2s.sousfamille1_id = " . $article->sousfamille1_id . ""]);
        // array 'tabb', 'dat','tab',
        $marques = $this->fetchTable('Marques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('clientarticles', 'clients', 'marques', 'uaprincipals', 'unitearticless', 'articlefournisseurs', 'frs', 'articles', 'devices',  'charges', 'famillerotations',  'articlees', 'objectifrepresentants', 'commercials', 'mois', 'unitearticles', 'sousfamille2s', 'unites', 'tpe', 'seuil', 'codeart', 'article', 'articlee', 'familles', 'sousfamille1s', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }
    public function dupliquer($id = null)
    {
        // $session = $this->request->getSession();
        // $abrv = $session->read('abrvv');
        // $liendd = $session->read('lien_articles' . $abrv);
        // //   debug($liendd);
        // $artic = 0;
        // foreach ($liendd as $k => $liens) {
        //     //  debug($liens);
        //     if (@$liens['lien'] == 'article') {
        //         $artic = $liens['modif'];
        //     }
        // }
        // // debug($societe);die;
        // if (($artic <> 1)) {
        //     $this->redirect(array('controller' => 'users', 'action' => 'login'));
        // }
        $tpes = $this->fetchTable('Tpes')->find()->select(["tpes" =>
        'MAX(Tpes.valeur)'])->first();
        $tpe = $tpes->tpes;



        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
        'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
        'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;





        $fodecs = $this->fetchTable('Fodecs')->find()->select(["fodecs" =>
        'MAX(Fodecs.valeur)'])->first();
        $fodec = $fodecs->fodecs;


        $articlee = $this->Articles->get($id, [
            'contain' => ['Tvas', 'Familles'],
        ]);
        /// debug($article);die;



        if ($articlee->codeabarre != null) {
            $codeart = substr($articlee->codeabarre, -4);
        }

        // debug($article->codeabarre);

        $article = $this->Articles->newEmptyEntity();
        if ($this->request->is('post')) {
            $this->loadModel('Uaprincipals');
            $this->loadModel('Clientarticles');
            $data['article_id'] = $this->request->getData('article_id');
            $data['unitearticle_id'] = $this->request->getData('unitearticle_id');
            $data['Correspand'] = $this->request->getData('Correspand');
            $data['client_id'] = $this->request->getData('client_id');
            $data['prix'] = $this->request->getData('prix');
            // $data['article_id'] = $this->request->getData('article_id');
            // debug($this->request->getData());
            // die;
            $article = $this->Articles->patchEntity($article, $this->request->getData());
            // debug($article);
            $codearticle = $this->request->getData('codearticle');
            // debug($codearticle);



            $codefinale = $codepays . $codeproducteur . $codearticle;

            //  debug($codefinale);
            $article->inserted = '1';
            $article->updated = '1';
            $article->codeabarre = $codefinale;

            $image = $this->request->getData('image_file');
            //  debug($image);die;
            $name = $image->getClientFilename();
            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */

            // $targetPath = WWW_ROOT . 'img' . DS .'imgart' . $name;
            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
            //debug($name) ;//die;

            if (!empty($name)) {
                $image->moveTo($targetPath);
                $article->image = $name;
            }
            //  debug($article);die;

            //$article->image=$name;
            // if ($article_id=($this->Articles->save($article)->id)){
            if ($this->Articles->save($article)) {
                $id = $article['id'];
                $this->misejour("Articles", "add", $id);
                $article_id = $article->id;
                // $uaprincipal = $this->Uaprincipals->find('all')
                //     ->where(["Uaprincipals.article_id  ='" . $id . "'"]);
                // foreach ($uaprincipal as $ccc) {
                //     $this->fetchTable('Uaprincipals')->delete($ccc);
                // }
                if (isset($this->request->getData('data')['uaprincipals']) && (!empty($this->request->getData('data')['uaprincipals']))) {
                    foreach ($this->request->getData('data')['uaprincipals'] as $i => $tar) {
                        //debug($this->request->getData());
                        //die;
                        if ($tar['sup0'] != 1) {
                            $data['article_id'] = $article_id;
                            $data['unitearticle_id'] = $tar['unitearticle_id'];
                            $data['Correspand'] = $tar['Correspand'];

                            $uaprincipal = $this->fetchTable('Uaprincipals')->newEmptyEntity();
                            $uaprincipal = $this->Uaprincipals->patchEntity($uaprincipal, $data);
                            if ($this->Uaprincipals->save($uaprincipal)) {
                                // debug($data);
                                // debug($tar);
                                // debug($uaprincipal);
                            } else {
                            }
                        }
                    }
                }

                // $clientarticle = $this->fetchTable('Clientarticles')->find('all', [
                //     'contain' => ['Clients'],
                // ])
                //     ->where(["Clientarticles.article_id  ='" . $id . "'"]);
                // //debug($clientarticle);
                // //die;
                // foreach ($clientarticle as $caa) {
                //     $this->fetchTable('Clientarticles')->delete($caa);
                // }
                $arrticle_id = $article->id;
                if (isset($this->request->getData('data')['clientarticles']) && (!empty($this->request->getData('data')['clientarticles']))) {
                    foreach ($this->request->getData('data')['clientarticles'] as $a => $tarr) {
                        //debug($this->request->getData('data')['clientarticles']);
                        //die;
                        if ($tar['sup1'] != 1) {
                            $data['article_id'] = $arrticle_id;
                            $data['client_id'] = $tarr['client_id'];
                            $data['prix'] = $tarr['prix'];
                            $data['inserted'] = '1';
                            $data['updated'] = '1';
                            // debug($data);
                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            $clientarticle = $this->Clientarticles->patchEntity($clientarticle, $data);
                            if ($this->Clientarticles->save($clientarticle)) {
                                // debug($clientarticle);die;
                            } else {
                            }
                        }
                    }
                }








                if (isset($this->request->getData('data')['articlefr']) && (!empty($this->request->getData('data')['articlefr']))) {
                    foreach ($this->request->getData('data')['articlefr'] as $j => $p) {

                        //die;

                        if ($p['supfr'] != 1) {


                            $articlefr = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                            $data['article_id'] = $id;
                            $data['prix'] = $p['prix'];
                            $data['code'] = $p['code'];
                            $data['fournisseur_id'] = $p['fr_id'];

                            // debug($data);
                            //    debug($p);
                            if (isset($p['id']) && (!empty($p['id']))) {

                                $articlefr = $this->fetchTable('Articlefournisseurs')->get($p['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $articlefr  = $this->fetchTable('Articlefournisseurs')->newEmptyEntity();
                            };
                            $articlefr = $this->fetchTable('Articlefournisseurs')->patchEntity($articlefr, $data);
                            $this->fetchTable('Articlefournisseurs')->save($articlefr);
                        } else if ($p['supfr'] == 1 && !empty($p['id'])) {
                            $articlefr = $this->fetchTable('Articlefournisseurs')->get($p['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Articlefournisseurs')->delete($articlefr);
                        }
                    }
                }
                // $seuilss = $this->fetchTable('Seuilmois')->find('all', [])
                //     ->where(["Seuilmois.article_id = " . $id . ""]);

                // foreach ($seuilss as $ss) {
                //     $this->fetchTable('Seuilmois')->delete($ss);
                // }
                // $Fichearticles = $this->fetchTable('Fichearticles')->find('all', [])
                //     ->where(["Fichearticles.article_id =" . $id]);

                // foreach ($Fichearticles as $f) {
                //     $this->fetchTable('Fichearticles')->delete($f);
                // }

                if (isset($this->request->getData('data')['Ofsfligne']) && (!empty($this->request->getData('data')['Ofsfligne']))) {
                    foreach ($this->request->getData('data')['Ofsfligne'] as $i => $Ofsfligne) {
                        // debug($Ofsfligne);
                        //die;
                        if ($Ofsfligne['sup'] != 1) {
                            if ($Ofsfligne['article_id'] != '') {
                                $d = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                $d['article_id'] = $article->id;
                                $d['article_id1'] = $Ofsfligne['article_id'];
                                $d['article_id2'] = 0;
                                $d['article_id3'] = 0;
                                $d['qte'] = $Ofsfligne['qte'];
                                //         $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                if ($this->fetchTable('Fichearticles')->save($d)) {
                                    //   debug($d);
                                    foreach ($Ofsfligne['Phaseofsf'] as $i => $Phaseofsf) {
                                        //debug($Phaseofsf);
                                        if ($Phaseofsf['supp2'] != 1) {
                                            if ($Phaseofsf['article_idt'] != '') {
                                                $dd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                                $dd['article_id'] = $article->id;
                                                $dd['article_id1'] = $Ofsfligne['article_id'];
                                                $dd['article_id2'] = $Phaseofsf['article_idt'];;
                                                $dd['article_id3'] = 0;
                                                $dd['qte'] = $Phaseofsf['qte'];
                                                //  $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                                if ($this->fetchTable('Fichearticles')->save($dd)) {
                                                    //   debug($dd);
                                                    foreach ($Phaseofsf['Phaseofsfligne'] as $i => $Phaseofsfligne) {
                                                        // debug($Phaseofsfligne);
                                                        if ($Phaseofsfligne['supp3'] != 1) {
                                                            if ($Phaseofsfligne['article_idd'] != '') {
                                                                $ddd = $this->fetchTable('Fichearticles')->newEmptyEntity();
                                                                $ddd['article_id'] = $article->id;
                                                                $ddd['article_id1'] = $Ofsfligne['article_id'];
                                                                $ddd['article_id2'] = $Phaseofsf['article_idt'];
                                                                $ddd['article_id3'] = $Phaseofsfligne['article_idd'];
                                                                $ddd['qte'] = $Phaseofsfligne['qte'];
                                                                // $fichearticle =  $this->fetchTable('Fichearticles')->patchEntity($fichearticles, $d);
                                                                if ($this->fetchTable('Fichearticles')->save($ddd)) {
                                                                    // debug($ddd);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                //                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                                //
                                //
                                //                            $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                                //debug($seuil);
                            }
                        }
                    }
                }

                if (isset($this->request->getData('data')['seuil']) && (!empty($this->request->getData('data')['seuil']))) {
                    foreach ($this->request->getData('data')['seuil'] as $i => $b) {
                        //debug($adresseliv);
                        //die;

                        $seuil = $this->fetchTable('Seuilmois')->newEmptyEntity();
                        $data['moi_id'] = $i;
                        $data['min'] = $b['minimum'];
                        $data['max'] = $b['maximum'];
                        $data['alert'] = $b['alert'];
                        $data['article_id'] = $article->id;

                        $seuil = $this->fetchTable('Seuilmois')->patchEntity($seuil, $data);


                        $this->fetchTable('Seuilmois')->save($seuil);
                        //debug($seuil);
                    }
                }



                // $objectifrepresentantss = $this->fetchTable('Objectifrepresentants')->find('all', [])
                //     ->where(["Objectifrepresentants.article_id = " . $id . ""]);
                // //      debug($objectifrepresentantss);die;



                // foreach ($objectifrepresentantss as $obj) {
                //     $this->fetchTable('Objectifrepresentants')->delete($obj);
                // }





                if (isset($this->request->getData('data')['objectifrep']) && (!empty($this->request->getData('data')['objectifrep']))) {
                    foreach ($this->request->getData('data')['objectifrep'] as $i => $c) {
                        //  debug($c);
                        //die;
                        $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->newEmptyEntity();
                        // $data['mois'] = $i;
                        $dataobj['objectif'] = $c['objectif'];
                        $dataobj['commercial_id'] = $c['commercial'];
                        $dataobj['moi_id'] = $c['mois'];
                        $dataobj['article_id'] = $article->id;
                        $dataobj['id'] = $c['objectif_id'];
                        //debug($dataobj);

                        if (!empty($c['objectif'])) {
                            $objectifrepresentant = $this->fetchTable('Objectifrepresentants')->patchEntity($objectifrepresentant, $dataobj);
                        }                        //debug($objectifrepresentant);
                        $this->fetchTable('Objectifrepresentants')->save($objectifrepresentant);
                        //debug($seuil);
                    }
                }



                //  $this->Flash->success(__('Modification effectuée'));

                return $this->redirect(['action' => 'index']);
            }
            //  $this->Flash->error(__('Veuillez réessayer!!!'));
        }
        $familles = $this->fetchTable('Familles')->find('list', ['keyfield' => 'id', 'valueField' => 'Nom']);
        $tvas = $this->fetchTable('Tvas')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $frs = $this->fetchTable('Fournisseurs')->find('all', ['contain' => ['Fournisseurs'], 'valueField' => 'name']);



        if ($articlee->famille_id != null) {
            $sousfamille1s = $this->fetchTable('Sousfamille1s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille1s.famille_id = " . $articlee->famille_id . ""]);
        }

        if ($articlee->sousfamille1_id != null) {
            $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(["Sousfamille2s.sousfamille1_id = " . $articlee->sousfamille1_id . ""]);
        }

        // $typearticles = $this->fetchTable('Typearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $val = $codepays . ' ' . $codeproducteur;
        $charges = $this->fetchTable('Charges')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $unites = $this->fetchTable('Unites')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articlefournisseurs = $this->fetchTable('Articlefournisseurs')->find('all')->where(["Articlefournisseurs.article_id =  $id "]);
        //debug($articlefournisseurs);

        $seuil = $this->fetchTable('Seuilmois')->find('all', ['contain' => ['Mois']])
            ->where(["Seuilmois.article_id = " . $id . ""]);








        $unitearticles = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $devices = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $mois = $this->fetchTable('Mois')->find('all');
        $commercials = $this->fetchTable('Commercials')->find('all');
        $frs = $this->fetchTable('Fournisseurs')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        foreach ($commercials as $com) {
            foreach ($mois as $moi) {

                $objectifrepresentants = $this->fetchTable('Objectifrepresentants')->find('all', [])
                    ->where(["Objectifrepresentants.article_id = " . $id . "", "Objectifrepresentants.commercial_id = " . $com->id . "", "Objectifrepresentants.moi_id = " . $moi->id . "",]);
                //debug($objectifrepresentants);
                if (!empty($objectifrepresentants)) {

                    foreach ($objectifrepresentants as $i) {
                        //    debug($i);

                        $array[$com->id][$moi->id] = $i->objectif;

                        $tabb[$com->id][$moi->id] = $i->id;
                    }
                    //  debug($tab);
                } else
                    $tab[$com->id][$moi->id] = 0;
            }
        }

        // debug($tab);
        $fichearticles = $this->fetchTable('Fichearticles')->find('all')
            ->where(['Fichearticles.article_id=' . $id])->group(['Fichearticles.article_id1'])->order(['Fichearticles.id' => 'ASC']);
        //debug($fichearticles);//die;à
        foreach ($fichearticles as $i => $fiche) {
            $dat[$i]['id'] = $fiche['id'];
            $dat[$i]['article_id'] = $fiche['article_id1'];
            $dat[$i]['qte'] = $fiche['qte'];
            $fichearticles1 = $this->fetchTable('Fichearticles')->find('all')
                ->where(['Fichearticles.article_id=' . $id, 'Fichearticles.article_id1=' . $fiche['article_id1'], 'Fichearticles.id!=' . $fiche['id']])->group(['Fichearticles.article_id1', 'Fichearticles.article_id2']);
            // debug($fichearticles1);//die;
            foreach ($fichearticles1 as $j => $fiche1) {
                $dat[$i]['Ligne'][$j]['id'] = $fiche1['id'];
                $dat[$i]['Ligne'][$j]['article_id'] = $fiche1['article_id2'];
                $dat[$i]['Ligne'][$j]['qte'] = $fiche1['qte'];
                $fichearticles2 = $this->fetchTable('Fichearticles')->find('all')
                    ->where(['Fichearticles.article_id=' . $id, 'Fichearticles.article_id1=' . $fiche1['article_id1'], 'Fichearticles.article_id2=' . $fiche1['article_id2'], 'Fichearticles.id!=' . $fiche1['id']])->group(['Fichearticles.article_id1', 'Fichearticles.article_id2', 'Fichearticles.article_id3']);
                // debug($fichearticles2);//die;

                foreach ($fichearticles2 as $k => $fiche2) {
                    $dat[$i]['Ligne'][$j]['ligneligne'][$k]['id'] = $fiche2['id'];
                    $dat[$i]['Ligne'][$j]['ligneligne'][$k]['article_id'] = $fiche2['article_id3'];
                    $dat[$i]['Ligne'][$j]['ligneligne'][$k]['qte'] = $fiche2['qte'];
                }
            }
        }
        // debug($dat);//die;
        // $clientarticle = $this->fetchTable('Clientarticles')->find('all')->where(["Clientarticles.article_id  ='" . $id . "'"]);
        //$clients = $this->fetchTable('Clients')->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        $clients = $this->fetchTable('Clients')->find('all');
        // debug($clientarticle);
        // die;

        //$articles=$this->Articles->find('list',['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.vente=0']);
        $articlesss = $this->fetchTable('Articles')->find()->select(['id', 'Dsignation', 'Code'])->where(['Articles.famille_id!=1']);

        foreach ($articlesss as $a) {
            // debug($a->id.' '.$a->Dsignation);
            $articles[$a->id] = $a->Code . ' ' . $a->Dsignation;
        }


        $clientarticles = $this->fetchTable('Clientarticles')->find('all',  [
            'contain' => ['Clients']
        ])
            ->where(["Clientarticles.article_id  ='" . $id . "'"]);
        // debug($clientarticles);
        $famillerotations = $this->fetchTable('Famillerotations')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $articlees = $this->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where(['Articles.vente=0']);
        //  foreach($mois as $m){debug($m);}
        // $tvas = $this->Articles->Tvas->find('list', ['limit' => 200])->all();
        $uaprincipals = $this->fetchTable('Uaprincipals')->find('all',  [
            'contain' => ['Unitearticles']
        ])->where(['article_id' => $id]);
        //  debug($uaprincipals);die;
        $unitearticless = $this->fetchTable('Unitearticles')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        //$unitearticless = $this->Unitearticles->Uaprincipals->find('list', ['limit' => 200]);
        // $sousfamille2s = $this->fetchTable('Sousfamille2s')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
        // ->where(["Sousfamille2s.sousfamille1_id = " . $article->sousfamille1_id . ""]);
        // array 'tabb', 'dat','tab',
        $marques = $this->fetchTable('Marques')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('clientarticles', 'articlee', 'article', 'clients', 'marques', 'uaprincipals', 'unitearticless', 'articlefournisseurs', 'frs', 'articles', 'devices',  'charges', 'famillerotations',  'articlees', 'objectifrepresentants', 'commercials', 'mois', 'unitearticles', 'sousfamille2s', 'unites', 'tpe', 'seuil', 'codeart', 'article', 'familles', 'sousfamille1s', 'codepays', 'codeproducteur', 'val', 'tvas', 'fodec'));
    }
    /**
     * Delete method
     *
     * @param string|null $id Article id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_articles' . $abrv);
        //   debug($liendd);
        $artic = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'article') {
                $artic = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($artic <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        // $this->request->allowMethod(['post', 'delete']);
        $article = $this->Articles->get($id);
        if ($this->Articles->delete($article)) {
            $this->misejour("Articles", "delete", $id);
        } else {
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getsousfamille1($id = null)
    {
        $id = $this->request->getQuery('idfam');

        $famille = $this->fetchTable('Familles')->get($id);
        //   debug($famille->vente);
        // debug($id);
        // die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));


        $select1 = "

        <label class='control-label' for='sousfamille1-id'>Sous sous famille</label>
        <select name='sousfamille1_id' id='divsous' class='form-control select2' onchange='getsousfamille2(this.value)'   >
					<option value=''  selected='selected' disabled>Veuillez choisir</option> </select> </div> </div> ";



        $query = $this->fetchTable('Sousfamille1s')->find();
        $query->where(['famille_id' => $id]);
        // debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Sous famille</label>
        <select name='sousfamille1_id' id='sous' class='form-control select2' onchange='getsousfamille2(this.value)'   >
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q); 
            $select = $select . "	<option value ='" . $q['id'] . "'";
            $select = $select . " >" . $q['name'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> <script>  $('.select2').select2() </script> ";

        echo json_encode(array('select' => $select, 'select1' => $select1, 'vente' => $famille->vente));
        die;
        //$this->set(compact('query'));





        /* foreach ($query as $q) { 
          json_encode($q);
          debug($q);
          }
         */
    }
    public function getquantite13032024()
    {
        date_default_timezone_set('Africa/Tunis');
        $articleid = $_GET['idarticle'];
        $donnearticle = $this->fetchTable('Articles')->get($articleid, [
            'contain' => ['Tvas'],
        ]);
        $article = [];
        if ($articleid != null) {
            $article = $this->fetchTable('Articles')->find()->where(['Articles.id' => $articleid])->first();
        }
        $sousfamille = [];
        if ($article->sousfamille1_id != null) {
            $sousfamille = $this->fetchTable('Sousfamille1s')->find()->where(['Sousfamille1s.id' => $article->sousfamille1_id])->first();
        }

        $readonly = 0;
        if ($sousfamille->remiseobligatoire == 1) {
            $readonly = 0;
        } else {
            $readonly = 1;
        }


        echo json_encode(array("donnearticle" => $donnearticle, "success" => true, "readonly" => $readonly));
        die;
    }
    public function getquantitedes()
    {
        date_default_timezone_set('Africa/Tunis');
        $articleid = $_GET['idarticle'];
        $idClient = $_GET['idClient'];
        $depotid = $_GET['idadepot'];
        $d = $_GET['date'];

        $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $d)));
        $connection = ConnectionManager::get('default');
        $month = (int) date('m');
        $articleTable = $this->fetchTable('Articles');
        $articlee = $articleTable->find()
            ->where(['Articles.Dsignation' => $articleid])
            ->first();
        $articleid = $articlee->id;
        $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
        $inv = $inventaires[0]['v'];
        $bc = $connection->execute("select stockbassemseuil(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as q")->fetchAll('assoc');
        $qtecommande = $bc[0]['q'];
        $alert = !empty($this->fetchTable('Seuilmois')->find('all')->where(['article_id' => $articleid, 'moi_id' => $month])->first()) ? $this->fetchTable('Seuilmois')->find('all')->where(['article_id' => $articleid, 'moi_id' => $month])->first()->alert : 0;
        if (is_null($alert)) {
            $alert = 0;
        }
        if ($inventaires[0]['v'] == $bc[0]['q']) {
            $qtestock = $inventaires[0]['v'] - $bc[0]['q'] - $alert;
        } else {
            $qtestock = $inventaires[0]['v'] - $bc[0]['q'] - $alert;
        }

        $ligne = $this->prixspeciale($idClient, $articleid);
        $donnearticle = $this->fetchTable('Articles')->get($articleid, [
            'contain' => ['Tvas'],
        ]);
        // debug($donnearticle);
        echo json_encode(array("inv" => $inv, "qtecommande" => $qtecommande, "qtestockx" => $qtestock, "ligne" => $ligne, "donnearticle" => $donnearticle, "success" => true, "alert" => $alert));
        die;
    }
    public function getquantitecode()
    {
        date_default_timezone_set('Africa/Tunis');
        $articleid = $_GET['idarticle'];
        $idClient = $_GET['idClient'];
        $depotid = $_GET['idadepot'];
        $d = $_GET['date'];

        $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $d)));
        $connection = ConnectionManager::get('default');
        $month = (int) date('m');
        $articleTable = $this->fetchTable('Articles');
        $articlee = $articleTable->find()
            ->where(['Articles.Code' => $articleid])
            ->first();
        $articleid = $articlee->id;
        $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
        $inv = $inventaires[0]['v'];
        $bc = $connection->execute("select stockbassemseuil(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as q")->fetchAll('assoc');
        $qtecommande = $bc[0]['q'];
        $alert = !empty($this->fetchTable('Seuilmois')->find('all')->where(['article_id' => $articleid, 'moi_id' => $month])->first()) ? $this->fetchTable('Seuilmois')->find('all')->where(['article_id' => $articleid, 'moi_id' => $month])->first()->alert : 0;
        if (is_null($alert)) {
            $alert = 0;
        }
        if ($inventaires[0]['v'] == $bc[0]['q']) {
            $qtestock = $inventaires[0]['v'] - $bc[0]['q'] - $alert;
        } else {
            $qtestock = $inventaires[0]['v'] - $bc[0]['q'] - $alert;
        }

        $ligne = $this->prixspeciale($idClient, $articleid);
        $donnearticle = $this->fetchTable('Articles')->get($articleid, [
            'contain' => ['Tvas'],
        ]);
        echo json_encode(array("inv" => $inv, "qtecommande" => $qtecommande, "qtestockx" => $qtestock, "ligne" => $ligne, "donnearticle" => $donnearticle, "success" => true, "alert" => $alert));
        die;
    }

    public function getquantite()
    {
        date_default_timezone_set('Africa/Tunis');
        $articleid = $_GET['idarticle'];
        $idClient = $_GET['idClient'];
        $depotid = $_GET['idadepot'];
        $d = $_GET['date'];

        $date = date("Y-m-d H:i:s", strtotime(str_replace('-', '/', $d)));
        $connection = ConnectionManager::get('default');
        $month = (int) date('m');
        $inventaires = $connection->execute("select stockbassem(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as v")->fetchAll('assoc');
        $inv = $inventaires[0]['v'];
        $bc = $connection->execute("select stockbassemseuil(" . $articleid . ",'" . $date . "','0'," . $depotid . " ) as q")->fetchAll('assoc');
        $qtecommande = $bc[0]['q'];
        $alert = !empty($this->fetchTable('Seuilmois')->find('all')->where(['article_id' => $articleid, 'moi_id' => $month])->first()) ? $this->fetchTable('Seuilmois')->find('all')->where(['article_id' => $articleid, 'moi_id' => $month])->first()->alert : 0;
        if (is_null($alert)) {
            $alert = 0;
        }
        if ($inventaires[0]['v'] == $bc[0]['q']) {
            $qtestock = $inventaires[0]['v'] - $bc[0]['q'] - $alert;
        } else {
            $qtestock = $inventaires[0]['v'] - $bc[0]['q'] - $alert;
        }

        $ligne = $this->prixspeciale($idClient, $articleid);
        $donnearticle = $this->fetchTable('Articles')->get($articleid, [
            'contain' => ['Tvas'],
        ]);
        echo json_encode(array("inv" => $inv, "qtecommande" => $qtecommande, "qtestockx" => $qtestock, "ligne" => $ligne, "donnearticle" => $donnearticle, "success" => true, "alert" => $alert));
        die;
    }

    public function getvaleurtva()
    {
        if ($this->request->is('ajax')) {
            $articleid = $_GET['idfam'];

            $ligne = $this->fetchTable('Tvas')->get($articleid);

            $val = $ligne['valeur'];

            echo json_encode(array("valeur" => $val, "ligne" => $ligne, "success" => true));
            //echo (json_encode($ligne));
            exit;
        }
    }

    public function getsousf($id = null)
    {
        $id = $this->request->getQuery('idfam');

        // debug($id);
        // die;
        // var_dump( $t['article_id']);
        // $prix = $ligne->prix->achat;
        //$this->set(compact('prix'));




        $query = $this->fetchTable('Sousfamille2s')->find();
        $query->where(['sousfamille1_id' => $id]);
        // debug($query);
        $select = "

        <label class='control-label' for='sousfamille1-id'>Sous sous famille  </label>
        <select name='sousfamille2_id' id='divsoussous' class='form-control select2 '>
					<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($query as $q) {
            //  debug($q); 
            $select = $select . "	<option value ='" . $q['id'] . "'";
            $select = $select . " >" . $q['name'] . "</option>";
        }
        //    echo $t = (json_encode($query));
        $select = $select . "</select> </div> </div> <script> $('.select2').select2() </script> ";

        echo json_encode(array('select' => $select));
        die;
        //$this->set(compact('query'));





        /* foreach ($query as $q) { 
          json_encode($q);
          debug($q);
          }
         */
    }
    public function verifcode()
    {
        $this->loadModel('Articles');
        $codec = $this->request->getQuery('code');

        $recherecode = $this->Articles->find()
            ->where(['Articles.code' => $codec])
            ->first();

        $test = !empty($recherecode) ? 1 : 0;

        echo json_encode(["test" => $test]);
        exit;
    }

    public function verifcodearticle()
    {
        $id = $this->request->getQuery('idfam');
        $idarticle = $this->request->getQuery('idarticle');
        //  debug($idarticle);




        $codep = $this->fetchTable('Societes')->find()->select(["codepays" =>
        'MAX(Societes.codepays)'])->first();
        $codepays = $codep->codepays;


        $codeproduc = $this->fetchTable('Societes')->find()->select(["codeproducteur" =>
        'MAX(Societes.codeproducteur)'])->first();
        $codeproducteur = $codeproduc->codeproducteur;
        $c = $codepays . $codeproducteur . $id;
        //    debug($c);


        $query = $this->fetchTable('Articles')->find();
        if ($idarticle != null) {
            $query->where(['codeabarre = ' . $c])->where(['id !=' . $idarticle]);
        } else {
            $query->where(['codeabarre = ' => $c]);
        }

        //  debug($query);







        echo json_encode(array("codeexistant" => $query, "success" => true));
        //echo (json_encode($ligne));
        die;
    }

    public function verif()
    {
        $id = $this->request->getQuery('idfam');

        $articlecmds = $this->fetchTable('Lignecommandes')->find('all')->where(['Lignecommandes.article_id=' . $id])->count();
        $articlelivs = $this->fetchTable('Lignelivraisons')->find('all')->where(['Lignelivraisons.article_id=' . $id])->count();
        $articlefacts = $this->fetchTable('Lignefactures')->find('all')->where(['Lignefactures.article_id=' . $id])->count();


        // debug($articles);
        echo json_encode(array('articlecmds' => $articlecmds, 'articlelivs' => $articlelivs, 'articlefacts' => $articlefacts));
        die;
    }

    public function verif0509()
    {
        $id = $this->request->getQuery('id');

        //$Articles = $this->fetchTable('Ticketventes')->find()->where(['Ticketventes.article_id' => $id])->count();


        $Articles = $this->fetchTable('Articles')->find()->where(['Articles.famillerotation_id' => $id])->count();



        echo json_encode(['Articles' => $Articles]);
        die;
    }
    public function verif05092()
    {
        $id = $this->request->getQuery('id');

        //$Articles = $this->fetchTable('Ticketventes')->find()->where(['Ticketventes.article_id' => $id])->count();


        $Articles = $this->fetchTable('Articles')->find()->where(['Articles.unitearticle_id' => $id])->count();



        echo json_encode(['Articles' => $Articles]);
        die;
    }

    public function verif05093()
    {
        $id = $this->request->getQuery('id');

        //$Articles = $this->fetchTable('Ticketventes')->find()->where(['Ticketventes.article_id' => $id])->count();


        $Articles = $this->fetchTable('Articles')->find()->where(['Articles.unite_id' => $id])->count();



        echo json_encode(['Articles' => $Articles]);
        die;
    }




    public function verif0506()
    {
        $id = $this->request->getQuery('id');

        // $Articles = $this->fetchTable('Factures')->find()->where(['Ticketventes.article_id' => $id])->count();


        $Articles = $this->fetchTable('Lignefactures')->find()->where(['Lignefactures.article_id' => $id])->count();


        //   if ($Articles == 0) {
        // $Articles = $this->fetchTable('Lignebonlivraisons')->find()->where(['Lignebonlivraisons.article_id' => $id])->count();
        //   }else

        //   if ($Articles == 0) {
        //  $Articles = $this->fetchTable('lignecommandeclients')->find()->where(['lignecommandeclientsa    .article_id' => $id])->count();
        //   }else

        //   if ($Articles == 0) {
        //$Articles = $this->fetchTable('Ligneinventaires')->find()->where(['Ligneinventaires.article_id' => $id])->count();
        //   }else

        //   if ($Articles == 0) {
        //  $Articles = $this->fetchTable('Lignefactureachat')->find()->where(['Lignefactureachat.article_id' => $id])->count();
        //   }else

        //   if ($Articles == 0) {
        //     $Articles = $this->fetchTable('Ligneunitecontenaires')->find()->where(['Ligneunitecontenaires.article_id' => $id])->count();
        //   }else{
        //     $Articles = $this->fetchTable('Ligneinventaires')->find()->where(['Ligneinventaires.article_id' => $id])->count();
        //   }

        echo json_encode(['Articles' => $Articles]);
        die;
    }
}
