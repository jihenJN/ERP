<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

use Cake\Datasource\ConnectionManager;

/**
 * Relevefournisseurs Controller
 *
 * @property \App\Model\Table\RelevefournisseursTable $Relevefournisseurs
 * @method \App\Model\Entity\Relevefournisseur[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RelevefournisseursController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index0501()
    {
        $relevefournisseurs = $this->paginate($this->Relevefournisseurs);

        $this->set(compact('relevefournisseurs'));
    }
    public function index()
    {
        error_reporting(E_ERROR | E_PARSE);
        $this->loadModel('Relevefournisseurs');
        $relefescount = $this->Relevefournisseurs->find('all', [
            'contain' => ['Fournisseurs']
        ], array(
            'order' => array('Relevefournisseurs.date,Relevefournisseurs.typ' => 'asc'),
            'recursive' => 0
        ))->count();

        // debug($relefescount);

        $session = $this->request->getSession();

        $this->loadModel('Exercices');
        $this->loadModel('Fournisseurs');
        $this->loadModel('Livraisons');
        $this->loadModel('Factures');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        $this->loadModel('Factureavoirfrs');
        $this->loadModel('Piecereglements');
        $this->loadModel('Lignereglements');

        $this->loadModel('Personnels');

        $exercices = $this->Exercices->find('list');
        @$exe = @date('Y');

        $exercicet = $this->Exercices->find('all', array('conditions' => array('Exercices.name' => $exe)))->first();

        if ($exercicet) {

            $exerciceid = $exercicet['id'];
        } else {
            $exerciceid = " ";
        }

        $condb4 = 'Livraisons.exercice_id =' . $exe;
        $condf4 = 'Factures.exercice_id =' . $exe;
        $condfa4 = 'Factureavoirfrs.exercice_id =' . $exe;
        $condr4 = 'Reglements.exercice_id =' . $exe;
        $c1 = 'Relevefournisseurs.exercice_id =' . $exe;

        $tablignedevis = array();
        $tablignelivraisons = array();
        $tablignefactureclients = array();
        $tablignereglementlibres = array();
        $tablignepiecereglements = array();
        $factureavoirs = array();
        $bonlivraisons = array();
        $factureclients = array();
        $reglementlibres = array();
        $piecereglements = array();
        //$this->layout = null;
        //echo '<script>alert()</script>';
        //$this->Relefe->query('TRUNCATE releves;');
        //$this->Relefe->query("INSERT INTO `thermeco`.`releves` (`id` ,`numclt` ,`client_id` ,`date` ,`numero` ,`type` ,`debit` ,`credit` ,`impaye` ,`reglement` ,`avoir` ,`solde` ,`exercice_id` ,`typ` ,`nbligneimp`) VALUES (NULL , '1', '1', '2019-11-25', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');");
        /*
        CakeSession::delete('soldeint'); */
        $session->delete('soldeint');

        $this->Relevefournisseurs->deleteAll(array('1 = 1'));


        //$this->Relefe->deleteAll(array('Relefe.id >'=>0),false);
        $c5 = "";
        $this->request->getQuery()['bl'] = 1;
        if ($this->request->is('post') || $this->request->getQuery()) {
            $this->request->getQuery()['bl'] = 1;
            //$this->Relefe->query('TRUNCATE releves;');


            $session->delete('soldeint');

            if (empty($this->request->getQuery()['date1'])) {
                $this->request->getQuery()['date1']  = '2015-01-01';
            }
            if (empty($this->request->getQuery()['date2'])) {
                $this->request->getQuery()['date2'] = date('d/m/Y');
            }


            if ($this->request->getQuery()['date1'] != "__/__/____") {
                $date1 = $this->request->getQuery()['date1'];
                $condb1 = 'Livraisons.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condf1 = 'Factures.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condfa1 = 'Factureavoirfrs.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condbb1 = 'Reglements.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condss1 = 'Piecereglements.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condbs = 'Livraisons.date < ' . "'" . $date1 . "'";
                $condfs = 'Factures.date < ' . "'" . $date1 . "'";
                $condfas = 'Factureavoirfrs.date < ' . "'" . $date1 . "'";
                $condbbs = 'Reglements.date < ' . "'" . $date1 . "'";
                $condss = 'Piecereglements.date < ' . "'" . $date1 . "'";
                $c2 = 'Relevefournisseurs.date  >=  ' . "'" . $date1 . " 00:00:00'";

                $condb4 = "";
                $condf4 = "";
                $condfa4 = "";
                $condr4 = "";
            }

            if ($this->request->getQuery()['date2'] != "__/__/____") {
                $date2 =  $this->request->getQuery()['date2'];
                $condb2 = 'Livraisons.date <  ' . "'" . $date2 . " 23:59:59'";
                $condf2 = 'Factures.date <  ' . "'" . $date2 . " 23:59:59'";
                $condfa2 = 'Factureavoirfrs.date <  ' . "'" . $date2 . " 23:59:59'";
                $condbr2 = 'Reglements.date <  ' . "'" . $date2 . " 23:59:59'";
                $condss2 = 'Piecereglements.date <  ' . "'" . $date2 . " 23:59:59'";

                $c3 = 'Relevefournisseurs.date <  ' . "'" . $date2 . " 23:59:59'";

                $condb4 = "";
                $condf4 = "";
                $condfa4 = "";
                $condr4 = "";
            }
            $fournisseur_id = "";

            if ($this->request->getQuery()['fournisseur_id']) {

                $fournisseur_id = $this->request->getQuery()['fournisseur_id'];

                $condb3 = 'Livraisons.fournisseur_id =' . $fournisseur_id;
                $condf3 = 'Factures.fournisseur_id =' . $fournisseur_id;
                $condfa3 = 'Factureavoirfrs.fournisseur_id =' . $fournisseur_id;
                $condr3 = 'Reglements.fournisseur_id =' . $fournisseur_id;
            }

            $affichebl = 1;
            if ($affichebl) {
                $condaffbl = "";
            } else {
                $condaffbl = "Reglements.type=2";
            }



            $solde = 0;
            $factureavoirs = $this->Factureavoirfrs->find();
            $soldeavoir = $factureavoirs->select(['sum' => $factureavoirs->func()->sum('Factureavoirfrs.totalttc')])

                ->where([@$condfas, @$condfa2, @$condfa3/*,'Factureavoirfrs.facture_id'=>0*/])->first();
            /*  $soldeavoir = $this->Factureavoir->find('first', array(
                'fields' => array('sum(Factureavoir.totalttc) as solde'),
                'conditions' => array(@$condfas, $condfa3), 'recursive' => 0));
                */
            if (!empty($soldeavoir)) {
                $solde = $solde - $soldeavoir->solde;
            }


            $factures = $this->Factures->find();
            $soldefac = $factures->select(['sum' => $factures->func()->sum('Factures.ttc')])

                ->where([@$condfs, @$condf3, @$condf2])->first();

            if (!empty($soldefac)) {
                $solde = $solde + $soldefac->sum;
            }
            ///////////////solde bl////////////////
            if ($affichebl) {
                $livraisonss = $this->Livraisons->find();
                $soldebl = $livraisonss->select(['sum' => $livraisonss->func()->sum('Livraisons.ttc')])

                    ->where([@$condbs, $condb2, $condb3, 'Livraisons.facture_id' => 0])->first();

                if (!empty($soldebl)) {
                    $solde = $solde + $soldebl->sum;
                }
            }

            /////////////////

            $reglements = $this->Reglements->find();
            $soldereg = $reglements->select(['sum' => $reglements->func()->sum('Reglements.Montant')])

                ->where([@$condbbs, $condr3])->first();
            if (!empty($soldereg)) {
                $solde = $solde - $soldereg->sum;
            }




            $piecereglements = $this->Piecereglements->find("all", [
                'contain' => ['Reglements']
            ]);

            $soldepiece = $piecereglements->select(['sum' => $piecereglements->func()->sum('Piecereglements.montant')])

                ->where([@$condss, $condr3, 'Piecereglements.paiement_id in (2,3)', '(Piecereglements.situation="Impayé")'])->first();
            // or Reglements.emi="052"
            if (!empty($soldepiece)) {
                $solde = $solde - $soldepiece->sum;
            }
            $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
            'MAX(Timbres.timbre)'])->first();
            $timbre = $tim->timbre;

            //    var_dump($condf1);
            //    var_dump($condf2);
            //    var_dump($condf3);
            //    var_dump($condf4);

            $factures = $this->Factures->find('all', array('conditions' => array(
                @$condf1,
                @$condf2,
                @$condf3,
                @$condf4
            ), 'contain' => array('Fournisseurs'), 'recursive' => 0));

            foreach ($factures as $facture) {

                $nom = "Factures";
                $tablignefacturefournisseurs = $this->fetchTable('Relevefournisseurs')->newEmptyEntity();


                $tablignefacturefournisseurs['fournisseur_id'] = $facture->fournisseur_id;
                $tablignefacturefournisseurs['date'] = $facture->date;
                $tablignefacturefournisseurs['numero'] = $facture->numero;
                $tablignefacturefournisseurs['type'] = '<a onClick="flvFPW1(wr+`Factures/imprimeview/`+' . $facture->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>' . $nom . ' N°     :' . $facture->numero . '</strong></a>';
                $tablignefacturefournisseurs['debit'] = $facture->ttc;
                $tablignefacturefournisseurs['credit'] = "";
                $tablignefacturefournisseurs['impaye'] = "";
                $tablignefacturefournisseurs['reglement'] = $facture->Montant_Regler;
                $tablignefacturefournisseurs['avoir'] = "";
                $tablignefacturefournisseurs['solde'] = $facture->ttc - $facture->Montant_Regler;
                $tablignefacturefournisseurs['exercice_id'] = $facture->exercice_id;
                $tablignefacturefournisseurs['typ'] = "Fac";

                $this->Relevefournisseurs->save($tablignefacturefournisseurs);
            }



            ////////////////////////bl ////////////////////////
            // var_dump($condb1);
            // var_dump($condb2);
            // var_dump($condb3);
            // var_dump($condb4);
            $conditions = [
                'Livraisons.facture_id' => 0,
                // 'Livraisons.typelivraison' => 1,
            ];
            if ($affichebl) {
                $Livraisons = $this->Livraisons->find('all', array(
                    'conditions' => array(
                        'Livraisons.facture_id' => 0,
                        // $conditions,
                        @$condb1,
                        @$condb2,
                        @$condb3,
                        @$condb4/* , @$cond5 */
                    ),
                    'contain' => array('Fournisseurs'),
                    'recursive' => 0
                ));
                // debug($bonlivraisons->toarray());

                // foreach ($Livraisons as $bonlivraison) {
                //     $tablignelivraisons = $this->fetchTable('Relevefournisseurs')->newEmptyEntity();

                //     $tablignelivraisons['fournisseur_id'] = $bonlivraison->fournisseur_id;
                //     $tablignelivraisons['date'] = $bonlivraison->date;
                //     $tablignelivraisons['numero'] = $bonlivraison->numero;
                //     $tablignelivraisons['type'] = '<a onClick="flvFPW1(wr+`Livraisons/imprimeview/`+' . $bonlivraison->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Bon livraison N°     :' . $bonlivraison->numero . '</strong></a>';
                //     $tablignelivraisons['debit'] = $bonlivraison->ttc;
                //     $tablignelivraisons['credit'] = "";
                //     $tablignelivraisons['impaye'] = "";
                //     $tablignelivraisons['reglement'] = $bonlivraison->Montant_Regler;
                //     $tablignelivraisons['avoir'] = "";
                //     $tablignelivraisons['typ'] = "BL";
                //     $tablignelivraisons['solde'] = $bonlivraison->ttc - $bonlivraison->Montant_Regler;
                //     $tablignelivraisons['exercice_id'] = $bonlivraison->exercice_id;
                //     $this->Relevefournisseurs->save($tablignelivraisons);
                // }
            }











            //////////////
            $factureavoirfrs = $this->Factureavoirfrs->find('all', array(
                'conditions' => array(@$condfa1, @$condfa2, @$condfa3, @$condfa4/*,'Factureavoirfrs.facture_id'=>0*/),
                'contain' => array('Fournisseurs'),
                'recursive' => 0
            ));

            foreach ($factureavoirfrs as $factureavoir) {
                $tablignedevis = $this->fetchTable('Relevefournisseurs')->newEmptyEntity();

                $tablignedevis['fournisseur_id'] = $factureavoir->fournisseur_id;
                $tablignedevis['date'] = $factureavoir->date;
                $tablignedevis['numero'] = $factureavoir->numero;
                $tablignedevis['type'] = '<a onClick="flvFPW1(wr+`Factureavoirfrs/imprimerfavr/`+' . $factureavoir->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Factureavoir N°     :' . $factureavoir->numero . '</strong></a>';
                $tablignedevis['debit'] = "";
                $tablignedevis['credit'] = $factureavoir->totalttc;
                $tablignedevis['impaye'] = "";
                $tablignedevis['reglement'] = "";
                $tablignedevis['avoir'] = $factureavoir->totalttc;
                $tablignedevis['solde'] = 0 - $factureavoir->totalttc;
                $tablignedevis['exercice_id'] = $factureavoir->exercice_id;
                $tablignedevis['typ'] = "FR";

                $this->Relevefournisseurs->save($tablignedevis);
            }







            //////////////////////////////////
            $reglementlibres = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Lignereglements', 'Fournisseurs']
            ])->where([@$condbr2, @$condr3, $condbb1]);
            // debug($reglementlibres->toArray());

            foreach ($reglementlibres as $reglementlibre) {


                $liste = "<table width='100%' >";
                //$liste="";
                $idd = $Piecereglements = $reglementlibre->id;

                $Piecereglements = $this->Piecereglements->find('all', array('conditions' => array('Piecereglements.reglement_id=' . $idd), 'contain' => array('Paiements', 'Reglements'), 'recursive' => 0));
                // debug($Piecereglements);
                // die;
                foreach ($Piecereglements as $k => $Piece) {
                    ///debug($Piece);
                    // if ($k == 0) {
                    //     $liste = $liste . "" . $Piece['Paiement']['name'];
                    //     if (!empty($Piece['Piecereglement']['num'])) {
                    //         $liste = $liste . " : " . $Piece['Piecereglement']['num'];
                    //     }
                    //     if ((!empty($Piece['Piecereglement']['echance'])) && ($Piece['Piecereglement']['echance'] != "1970-01-01")) {
                    //         $liste = $liste . " /echéance " . $Piece['Piecereglement']['echance'];
                    //     }
                    //     // $liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
                    // } else {
                    //     $liste = $liste . " " . $Piece['Paiement']['name'];
                    //     if (!empty($Piece['Piecereglement']['num'])) {
                    //         $liste = $liste . " : " . $Piece['Piecereglement']['num'];
                    //     }
                    //     if ((!empty($Piece['Piecereglement']['echance'])) && ($Piece['Piecereglement']['echance'] != "1970-01-01")) {
                    //         $liste = $liste . " /echéance " . $Piece['Piecereglement']['echance'];
                    //     }
                    //     //$liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
                    // }
                    $liste = $liste . "<tr>";
                    $liste = $liste . "<td><strong>" . @$Piece->paiement->name . "</strong></td>";
                    $nnr = "";
                    //debug($Piece);die;
                    if ($Piece->num == "") {
                        $nnr = $Piece->reglement->numeroconca;
                    } else {
                        $nnr = $Piece->num;
                    }
                    $liste = $liste . "<td><strong>N&deg; : " . @$nnr . "</strong></td>";
                    if ((!empty($Piece->echance)) && ($Piece->echance != "1970-01-01")) {


                        $frozenTime = new FrozenTime($Piece->echance);
                        $formattedDate = $frozenTime->format('d-m-Y');
                        $Piece->echance = $formattedDate;
                    } else {
                        $Piece->echance = "";
                    }
                    $liste = $liste . "<td><strong> Ech&eacute;ance : " . @$Piece->echance . "</strong></td>";
                    $liste = $liste . "<td><strong>Montant ====> " . @$Piece->montant . "</strong></td>";
                    $liste = $liste . "</tr>";
                }


                $liste = $liste . "<tr><td colspan='4' style='height: 10px;' ></td></tr>";








                // $list = '(0';
                // foreach ($reglementlibres as $reglementlibre) {
                //     $list = $list . "," . $reglementlibre['id']; 
                // }
                // $list = $list . ",0)" ;
                //debug($list);

                $condreg1 = 'Lignereglements.reglement_id =' . $reglementlibre['id'];

                $lignereglements = $this->fetchTable('Lignereglements')->find('all', [
                    'contain' => ['Factures', 'Livraisons']
                ])->where([@$condreg1]);
                // $lignereglementclients = $this->Lignereglementclients->find('all', [
                //     'contain' => ['Factureclients']
                // ], array('conditions' => array('Lignereglementclients.reglementclient_id='.$reglementlibre->id), 'recursive' => 0));
                //debug($lignereglementclients->toArray());

                if (@$detailid != 2) {
                    if (!empty($lignereglements)) {
                        $nn = "";
                        $liste = $liste . "<br>";
                        //debug($lignereglementclients->toArray());die;
                        foreach ($lignereglements as $k => $ligne) {
                            // debug($ligne);
                            if ((!empty($ligne->facture_id)) || (!empty($ligne->livraison_id))) {
                                // debug($ligne);
                                // $liste=$liste." > BLFacture ".@$ligne['Factureclient']['numero'] ."  " .@$ligne['Lignereglementclient']['Montant']."<br>"  ;

                                if ($ligne->livraison_id == 0) {
                                    $liste = $liste . "<tr>";
                                    $liste = $liste . '<td colspan="2"><a onClick="flvFPW1(wr+`Factures/imprimeview/`+' . @$ligne->facture->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Facture </strong></a></td>';
                                    $liste = $liste . "<td> N&deg; : " . @$ligne->facture->numero . "</td>";
                                    $liste = $liste . "<td>Montant : " . @$ligne->Montant . "</td>";
                                    $liste = $liste . "</tr>";
                                } else if ($ligne->facture_id == 0) {
                                    $liste = $liste . "<tr>";
                                    $liste = $liste . '<td colspan="2"><a onClick="flvFPW1(wr+`Livraisons/imprimeview/`+' . @$ligne->livraison->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Bon livraison </strong></a></td>';
                                    $liste = $liste . "<td> N&deg; : " . @$ligne->livraison->numero . "</td>";
                                    $liste = $liste . "<td>Montant : " . @$ligne->Montant . "</td>";
                                    $liste = $liste . "</tr>";
                                }
                            } else {
                                // $liste = $liste . "  Impayé Fournisseur " . @$ligne['Piecereglement']['num'] . "  " . @$ligne['Lignereglement']['Montant'] . "<br>";
                                // $liste = $liste . "<tr>";
                                // $liste = $liste . "<td colspan='2'>  Impay&eacute; Fournisseur </td>";
                                // $ligne = $this->Piecereglements->find('all', array('conditions' => array('Piecereglements.id' => $ligne->piecereglement_id), 'recursive' => 0));

                                // // debug($ligne);die;
                                // if (!empty($ligne->Piecereglement)) {
                                //     if ($ligne->num == "") {
                                //         $ans_reg = $this->Reglements->find('first', [
                                //             'contain' => ['Lignereglements']
                                //         ], array('conditions' => array('Reglements.id' => $ligne->Piecereglement->reglement_id), 'recursive' => -1));
                                //         $nn = $ans_reg->numero;
                                //     } else {
                                //         $nn = $ligne->num;
                                //     }
                                // }
                                // $liste = $liste . "<td> N&deg; : " . @$nn . "</td>";
                                // $liste = $liste . "<td>Montant : " . @$ligne->lignereglement->Montant . "</td>";
                                // $liste = $liste . "</tr>";
                            }
                        }
                    }
                }


                $liste .= "</table>";
                //debug($liste);//die;
                // var_dump($reglementlibre->Montant);
                //  var_dump($reglementlibre->date);
                $tablignereglementlibres = $this->fetchTable('Relevefournisseurs')->newEmptyEntity();
                $tablignereglementlibres['fournisseur_id'] = $reglementlibre->fournisseur_id;
                $tablignereglementlibres['date'] = $reglementlibre->Date;
                $tablignereglementlibres['numero'] = $reglementlibre->numeroconca;
                $tablignereglementlibres['nbligneimp'] = $k + 3;
                $tablignereglementlibres['type'] = $liste;
                $tablignereglementlibres['debit'] = "";
                $tablignereglementlibres['credit'] = $reglementlibre->Montant + $reglementlibre->differance;
                $tablignereglementlibres['impaye'] = "";
                $tablignereglementlibres['reglement'] = $reglementlibre->Montant;
                $tablignereglementlibres['avoir'] = "";
                $tablignereglementlibres['solde'] = $reglementlibre->montantaffecte - $reglementlibre->Montant;
                //   $tablignereglementlibres['exercice_id'] = $reglementlibre->exercice_id;
                $tablignereglementlibres['typ'] = "Reg";
                //  if ($reglementlibre->emi != '052') {
                //  debug($tablignereglementlibres);die;
                $this->Relevefournisseurs->save($tablignereglementlibres);
                // }
            }
            //
            /*    $piecereglementsz = $this->fetchTable('Piecereglements')->find('all', [
                'contain' => ['Paiements','Reglements']
            ])
                ->where(['Piecereglements.paiement_id in (2,3)', @$condr3, @$condr4/* , @$cond5 , $condss1*//*]);
              // print_r( $piecereglementsz->toarray());
           //   echo $condr3.'--'.@$condr4.'--'.count($piecereglementsz) ;
        /*    foreach ($piecereglementsz as $piecereglement) {
               // print_r($piecereglement);die;
                $tablignepiecereglementzs = $this->fetchTable('Relevefournisseurs')->newEmptyEntity();

                $tablignepiecereglementzs['client_id'] = $piecereglement->reglement->fournisseur_id;
                $tablignepiecereglementzs['date'] = $piecereglement->reglement->Date;
                $tablignepiecereglementzs['numero'] = $piecereglement->numero;
                $tablignepiecereglementzs['type'] = $piecereglement->paiement->name . ' : ' . @$piecereglement->piecereglement->num;
                $tablignepiecereglementzs['debit'] = $piecereglement->montant;
                $tablignepiecereglements['credit'] = "";
                $tablignepiecereglementzs['impaye'] = $piecereglement->montant;
                $tablignepiecereglementzs['reglement'] = "";
                $tablignepiecereglementzs['avoir'] = "";
                $tablignepiecereglementzs['solde'] = 2; //$piecereglement->montant;
                //   $tablignepiecereglementzs['exercice_id'] = 1;//$piecereglement->reglementclient->exercice_id;
                $tablignepiecereglementzs['typ'] = "Reg";
                //  debug($tablignepiecereglements);die;
                $this->Relevefournisseurs->save($tablignepiecereglementzs);
                //debug($tablignepiecereglementzs->id);//die; 


            }*/
        }


        $cha = "TRUE";
        $fournisseurs = $this->Fournisseurs->find("all");
        /// ->where(["Fournisseurs.etat='$cha'"]);

        $personnels = $this->Personnels->find('list');
        $relefes = $this->Relevefournisseurs->find('all', [
            'contain' => ['Fournisseurs']
        ], array(
            'order' => array('Relevefournisseurs.date,Relevefournisseurs.typ' => 'asc'),
            'recursive' => 0
        ));

        $countt = $this->Relevefournisseurs->find('all', [
            'contain' => ['Fournisseurs']
        ], array(
            'order' => array('Relevefournisseurs.date,Relevefournisseurs.typ' => 'asc'),
            'recursive' => 0
        ))->count();
        if (!empty($fournisseur_id)) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find('all', array('conditions' => array('Fournisseurs.id' => $fournisseur_id), 'recursive' => 0))->first();

            $soldeint = $fournisseur->soldedebut + $solde;
            $session->write('soldeint', $soldeint);
        }

        // var_dump($soldeint);
        $details = array();
        $details[1] = "Avec details";
        $details[2] = "Sans details";

        if (!empty($fournisseur_id)) {
            $cli = $this->Fournisseurs->find('all')->where("Fournisseurs.id=" . $fournisseur_id)->first();
            // debug($cli->Code);
        }


        @$this->set(compact('cli', 'timbre', 'relefescount', 'details', 'relefes', 'soldeint', 'solde', 'fournisseur_id', 'c5', 'c4', 'c3', 'c2', 'c1', 'piecereglements', 'livraisons', 'fournisseurs', 'reglementlibres', 'articles', 'personnels', 'exercices', 'exerciceid', 'date1', 'fournisseur_id', 'marque_id', 'date2', 'name', 'countt'));
    }
    public function imprimerrecherche()

    {

        //$this->response->type('pdf');
        //$this->layout = 'pdf';
        /*         $soldeint=$this->request->query['soldeint'];
      */
        if (!empty($this->request->getQuery()['date1'])) {
            $date1 = $this->request->getQuery()['date1'];
        }

        if (!empty($this->request->getQuery()['date2'])) {
            $date2 = $this->request->getQuery()['date2'];
        }
        if (!empty($this->request->getQuery()['fournisseur_id'])) {
            $fournisseur_id = $this->request->getQuery()['fournisseur_id'];
        }


        /*  if ($this->request->query['name']) {
            $name = $this->request->query['name'];
        } */
        $relefes = $this->Relevefournisseurs->find('all', [
            'contain' => ['Fournisseurs']
        ], array(
            'order' => array('Relevefournisseurs.date,Relevefournisseurs.typ' => 'asc'),
            'recursive' => 0
        ));

        $this->loadModel('Fournisseurs');
        //   $fournisseur = $this->Fournisseurs->find()->where(['Fournisseurs.id' => $fournisseur_id])->first();
        //  $fournisseur = $this->Fournisseurs->get($fournisseur_id);
        //$fournisseur_id = $fournisseur->id;
        $relefescount = $this->Relevefournisseurs->find('all', [
            'contain' => ['Fournisseurs']
        ], array(
            'order' => array('Relevefournisseurs.date,Relevefournisseurs.typ' => 'asc'),
            'recursive' => 0
        ))->count();


        $relefesfirst = $this->Relevefournisseurs->find('all', [
            'contain' => ['Fournisseurs']
        ], array(
            'order' => array('Relevefournisseurs.date,Relevefournisseurs.typ' => 'asc'),
            'recursive' => 0
        ))->first();
        $fournisseurid =  $relefesfirst->fournisseur_id;
        $solde = 0;
        $session = $this->request->getSession();

        if (!empty($fournisseurid)) {
            $fournisseur = $this->fetchTable('Fournisseurs')->find('all', array('conditions' => array('Fournisseurs.id' => $fournisseurid), 'recursive' => 0))->first();

            $soldeint = $fournisseur->soldedebut + $solde;
            //  var_dump($soldeint);
            $session->write('soldeint', $soldeint);
        }

        $this->set(compact('relefes', 'fournisseur_id', 'date1', 'date2', 'soldeint', 'relefescount'));
    }
    public function indexbl()
    {
        error_reporting(E_ERROR | E_PARSE);
        $relefescount = $this->Relevefournisseurs->find('all', [
            'contain' => ['Fournisseurs']
        ], array(
            'order' => array('Relevefournisseurs.date,Relevefournisseurs.typ' => 'asc'),
            'recursive' => 0
        ))->count();

        // debug($relefescount);

        $session = $this->request->getSession();

        $this->loadModel('Exercices');
        $this->loadModel('Clients');
        $this->loadModel('Livraisons');
        // $this->loadModel('Factureclients');
        $this->loadModel('Reglements');
        $this->loadModel('Piecereglements');
        //$this->loadModel('Factureavoirs');
        $this->loadModel('Lignereglements');

        $this->loadModel('Personnels');

        $exercices = $this->Exercices->find('list');
        @$exe = @date('Y');

        $exercicet = $this->Exercices->find('all', array('conditions' => array('Exercices.name' => $exe)))->first();

        if ($exercicet) {

            $exerciceid = $exercicet['id'];
        } else {
            $exerciceid = " ";
        }

        $condb4 = 'Livraisons.exercice_id =' . $exe;
        // $condf4 = 'Factureclients.exercice_id =' . $exe;
        //$condfa4 = 'Factureavoirs.exercice_id =' . $exe;
        $condr4 = 'Reglements.exercice_id =' . $exe;
        $c1 = 'relevefournisseurs.exercice_id =' . $exe;

        // $tablignedevis = array();
        $tablignelivraisons = array();
        // $tablignefactureclients = array();
        $tablignereglementlibres = array();
        $tablignepiecereglements = array();
        // $factureavoirs = array();
        $bonlivraisons = array();
        //$factureclients = array();
        $reglementlibres = array();
        $piecereglements = array();
        //$this->layout = null;
        //echo '<script>alert()</script>';
        //$this->Relefe->query('TRUNCATE releves;');
        //$this->Relefe->query("INSERT INTO `thermeco`.`releves` (`id` ,`numclt` ,`client_id` ,`date` ,`numero` ,`type` ,`debit` ,`credit` ,`impaye` ,`reglement` ,`avoir` ,`solde` ,`exercice_id` ,`typ` ,`nbligneimp`) VALUES (NULL , '1', '1', '2019-11-25', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1', '1');");
        /*
        CakeSession::delete('soldeint'); */
        $session->delete('soldeint');

        $this->Relevefournisseurs->deleteAll(array('1 = 1'));


        //$this->Relefe->deleteAll(array('Relefe.id >'=>0),false);
        $c5 = "";
        if ($this->request->is('post') || $this->request->getQuery()) {

            //$this->Relefe->query('TRUNCATE releves;');


            $session->delete('soldeint');

            if (empty($this->request->getQuery()['date1'])) {
                $this->request->getQuery()['date1']  = '2015-01-01';
            }
            if (empty($this->request->getQuery()['date2'])) {
                $this->request->getQuery()['date2'] = date('d/m/Y');
            }


            if ($this->request->getQuery()['date1'] != "__/__/____") {
                $date1 = $this->request->getQuery()['date1'];
                $condb1 = 'Livraisons.date  >=  ' . "'" . $date1 . " 00:00:00'";
                // $condf1 = 'Factureclients.date  >=  ' . "'" . $date1 . " 00:00:00'";
                // $condfa1 = 'Factureavoirs.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condbb1 = 'Reglements.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condss1 = 'Piecereglements.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condbs = 'Livraisons.date < ' . "'" . $date1 . "'";
                // $condfs = 'Factureclients.date < ' . "'" . $date1 . "'";
                //$condfas = 'Factureavoirs.date < ' . "'" . $date1 . "'";
                $condbbs = 'Reglements.date < ' . "'" . $date1 . "'";
                $condss = 'Piecereglements.date < ' . "'" . $date1 . "'";
                $c2 = 'relevefournisseurs.date  >=  ' . "'" . $date1 . " 00:00:00'";

                $condb4 = "";
                $condf4 = "";
                $condfa4 = "";
                $condr4 = "";
            }

            if ($this->request->getQuery()['date2'] != "__/__/____") {
                $date2 =  $this->request->getQuery()['date2'];
                $condb2 = 'Livraisons.date <  ' . "'" . $date2 . " 23:59:59'";
                // $condf2 = 'Factureclients.date <  ' . "'" . $date2 . " 23:59:59'";
                // $condfa2 = 'Factureavoirs.date <  ' . "'" . $date2 . " 23:59:59'";
                $condbr2 = 'Reglements.date <  ' . "'" . $date2 . " 23:59:59'";
                $condss2 = 'Piecereglements.date <  ' . "'" . $date2 . " 23:59:59'";

                $c3 = 'relevefournisseurs.date <  ' . "'" . $date2 . " 23:59:59'";

                $condb4 = "";
                $condf4 = "";
                $condfa4 = "";
                $condr4 = "";
            }
            $fournisseur_id = "";

            if ($this->request->getQuery()['fournisseur_id']) {

                $fournisseur_id = $this->request->getQuery()['fournisseur_id'];

                $condb3 = 'Livraisons.fournisseur_id =' . $fournisseur_id;
                // $condf3 = 'Factureclients.client_id =' . $clientid;
                // $condfa3 = 'Factureavoirs.client_id =' . $clientid;
                $condr3 = 'Reglements.fournisseur_id =' . $fournisseur_id;
            }




            $solde = 0;
            /*  $factureavoirs=$this->Factureavoirs->find() ;
            $soldeavoir =$factureavoirs->select(['sum' => $factureavoirs->func()->sum('Factureavoirs.totalttc')])

            ->where([@$condfas,$condfa2, $condfa3])->first();
           /*  $soldeavoir = $this->Factureavoir->find('first', array(
                'fields' => array('sum(Factureavoir.totalttc) as solde'),
                'conditions' => array(@$condfas, $condfa3), 'recursive' => 0));
                
            if (!empty($soldeavoir)) {
                $solde = $solde - $soldeavoir->solde;

            } */
            $Livraisons = $this->Livraisons->find();
            $soldebl = $Livraisons->select(['sum' => $Livraisons->func()->sum('Livraisons.ttc')])

                ->where([@$condbs, $condb2, $condb3, 'Livraisons.facture_id' => 0, 'Livraisons.bl' => 1])->first();

            if (!empty($soldebl)) {
                $solde = $solde + $soldebl->sum;
            }

            /*  $factureclients=$this->Factureclients->find() ;
            $soldefac =$factureclients->select(['sum' => $factureclients->func()->sum('Factureclients.totalttc')])

            ->where([@$condfs,$condf2,$condf3])->first();

         
            if (!empty($soldefac)) {
                $solde = $solde + $soldefac->sum;
            } */
            $reglements = $this->Reglements->find();
            $soldereg = $reglements->select(['sum' => $reglements->func()->sum('Reglements.Montant')])

                ->where([@$condbbs, $condr3, 'Reglements.type=1'])->first();
            if (!empty($soldereg)) {
                $solde = $solde - $soldereg->sum;
            }



            /* $soldereg = $this->Reglementclient->find('first', array(
                'fields' => array('sum((Reglementclient.Montant)) as solde'),
                'conditions' => array(@$condbbs, $condr3, "Reglementclient.emi!='052'"), 'recursive' => 0));
            if (!empty($soldereg)) {
                $solde = $solde - $soldereg[0]['solde'];
            }
            $soldepiece = $this->Piecereglementclient->find('first', array(
                'fields' => array('sum(Piecereglementclient.montant) as solde'),
                'conditions' => array(@$condss, $condr3, 'Piecereglementclient.paiement_id in (2,3)', '(Piecereglementclient.situation="Impayé" or Reglementclient.emi="052")'), 'recursive' => 0));
            if (!empty($soldepiece)) {
                $solde = $solde + $soldepiece[0]['solde'];
            } */

            $piecereglements = $this->Piecereglements->find("all", [
                'contain' => ['Reglements']
            ]);

            $soldepiece = $piecereglements->select(['sum' => $piecereglements->func()->sum('Piecereglements.montant')])

                ->where([@$condss, $condr3, 'Piecereglements.paiement_id in (2,3)', '(Piecereglements.situation="Impayé" )', 'Reglements.type=1'])->first();
            // or Reglements.emi="052"
            if (!empty($soldepiece)) {
                $solde = $solde - $soldepiece->sum;
            }
            $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
            'MAX(Timbres.timbre)'])->first();
            $timbre = $tim->timbre;



            $conditionbl = 'Livraisons.bl = 1';

            $livraisons = $this->Livraisons->find('all', array('conditions' => array(
                'Livraisons.facture_id' => 0,
                $conditionbl,
                @$condb1,
                @$condb2,
                @$condb3,
                @$condb4/* , @$cond5 */
            ), 'contain' => array('Fournisseurs'), 'recursive' => 0));
            // debug($bonlivraisons->toarray());

            foreach ($livraisons as $bonlivraison) {
                $tablignelivraisons = $this->fetchTable('Relevefournisseurs')->newEmptyEntity();

                $tablignelivraisons['fournisseur_id'] = $bonlivraison->fournisseur_id;
                $tablignelivraisons['date'] = $bonlivraison->date;
                $tablignelivraisons['numero'] = $bonlivraison->numero;
                $tablignelivraisons['type'] = '<a onClick="flvFPW1(wr+`Livraisons/imprimer/`+' . $bonlivraison->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Livraison N°     :' . $bonlivraison->numero . '</strong></a>';
                $tablignelivraisons['debit'] = $bonlivraison->ttc + $timbre;
                $tablignelivraisons['credit'] = "";
                $tablignelivraisons['impaye'] = "";
                $tablignelivraisons['reglement'] = $bonlivraison->Montant_Regler;
                $tablignelivraisons['avoir'] = "";
                $tablignelivraisons['typ'] = "BL";
                $tablignelivraisons['solde'] = $bonlivraison->ttc + $timbre - $bonlivraison->Montant_Regler;
                $tablignelivraisons['exercice_id'] = $bonlivraison->exercice_id;
                $this->Relevefournisseurs->save($tablignelivraisons);
            }

            $reglementlibres = $this->fetchTable('Reglements')->find('all', [
                'contain' => ['Lignereglements', 'Fournisseurs']
            ])->where([@$condbr2, @$condr3, $condbb1, 'Reglements.type=1']);
            // debug($reglementlibres->toarray());
            foreach ($reglementlibres as $reglementlibre) {


                // debug($reglementlibre);



                $tablignereglementlibres['fournisseur_id'] = $reglementlibre->fournisseur_id;
                $tablignereglementlibres['date'] = $reglementlibre->Date;
                $tablignereglementlibres['numero'] = $reglementlibre->numeroconca;
                $liste = "<table width='100%' >";
                //$liste="";
                // $idd = $Piecereglementclients = $reglementlibre->id;

                $Piecereglements = $this->Piecereglements->find('all', array('conditions' => array('Piecereglements.reglement_id=' . $reglementlibre->id), 'contain' => array('Paiements', 'Reglements'), 'recursive' => 0));
                //debug($Piecereglementclients);die;
                foreach ($Piecereglements as $k => $Piece) {
                    ///debug($Piece);
                    if ($k == 0) {
                        $liste = $liste . "" . $Piece['Paiement']['name'];
                        if (!empty($Piece['Piecereglement']['num'])) {
                            $liste = $liste . " : " . $Piece['Piecereglement']['num'];
                        }
                        if ((!empty($Piece['Piecereglement']['echance'])) && ($Piece['Piecereglement']['echance'] != "1970-01-01")) {
                            $liste = $liste . " /echéance " . $Piece['Piecereglement']['echance'];
                        }
                        // $liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
                    } else {
                        $liste = $liste . " " . $Piece['Paiement']['name'];
                        if (!empty($Piece['Piecereglement']['num'])) {
                            $liste = $liste . " : " . $Piece['Piecereglement']['num'];
                        }
                        if ((!empty($Piece['Piecereglement']['echance'])) && ($Piece['Piecereglement']['echance'] != "1970-01-01")) {
                            $liste = $liste . " /echéance " . $Piece['Piecereglement']['echance'];
                        }
                        //$liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
                    }
                    $liste = $liste . "<tr>";
                    $liste = $liste . "<td><strong>" . @$Piece->Paiement->name . "</strong></td>";
                    $nnr = "";
                    //debug($Piece);die;
                    if ($Piece->num == "") {
                        $nnr = $Piece->reglement->numeroconca;
                    } else {
                        $nnr = $Piece->num;
                    }
                    $liste = $liste . "<td><strong>N&deg; : " . @$nnr . "</strong></td>";
                    if ((!empty($Piece->echance)) && ($Piece->echance != "1970-01-01")) {

                        $Piece->echance = @$Piece->echance;
                    } else {
                        $Piece->echance = "";
                    }
                    $liste = $liste . "<td><strong> Ech&eacute;ance : " . @$Piece->echance . "</strong></td>";
                    $liste = $liste . "<td><strong>Montant ====> " . @$Piece->montant . "</strong></td>";
                    $liste = $liste . "</tr>";
                }


                $liste = $liste . "<tr><td colspan='4' style='height: 10px;' ></td></tr>";








                // $list = '(0';
                // foreach ($reglementlibres as $reglementlibre) {
                //     $list = $list . "," . $reglementlibre['id']; 
                // }
                // $list = $list . ",0)" ;
                //debug($list);

                $condreg1 = 'Lignereglements.reglement_id =' . $reglementlibre['id'];

                $lignereglements = $this->fetchTable('Lignereglements')->find('all', [
                    'contain' => ['Factures', 'Livraisons']
                ])->where([@$condreg1]);
                // $lignereglementclients = $this->Lignereglementclients->find('all', [
                //     'contain' => ['Factureclients']
                // ], array('conditions' => array('Lignereglementclients.reglementclient_id='.$reglementlibre->id), 'recursive' => 0));
                //debug($lignereglementclients->toArray());

                if (@$detailid != 2) {
                    if (!empty($lignereglements)) {
                        $nn = "";
                        $liste = $liste . "<br>";
                        //debug($lignereglementclients->toArray());die;
                        foreach ($lignereglements as $k => $ligne) {
                            // debug($ligne);
                            if ((!empty($ligne->livraison_id))) {


                                $liste = $liste . "<tr>";
                                $liste = $liste . '<td colspan="2"><a onClick="flvFPW1(wr+`Livraisons/imprimer/`+' . @$ligne->livraison->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong> Livraison </strong></a></td>';
                                $liste = $liste . "<td> N&deg; : " . @$ligne->livraison->numero . "</td>";
                                $liste = $liste . "<td>Montant : " . @$ligne->Montant . "</td>";
                                $liste = $liste . "</tr>";
                            } else {
                                $liste = $liste . "  Impayé Fournisseur " . @$ligne['Piecereglement']['num'] . "  " . @$ligne['Lignereglement']['Montant'] . "<br>";
                                $liste = $liste . "<tr>";
                                $liste = $liste . "<td colspan='2'>  Impay&eacute; Fournisseur </td>";
                                $ligne = $this->Piecereglements->find('all', array('conditions' => array('Piecereglements.id' => $ligne->piecereglement_id), 'recursive' => 0));

                                // debug($ligne);die;
                                if (!empty($ligne->Piecereglement)) {
                                    if ($ligne->num == "") {
                                        $ans_reg = $this->Reglements->find('first', [
                                            'contain' => ['Lignereglements']
                                        ], array('conditions' => array('Reglements.id' => $ligne->Piecereglement->reglement_id), 'recursive' => -1));
                                        $nn = $ans_reg->numero;
                                    } else {
                                        $nn = $ligne->num;
                                    }
                                }
                                $liste = $liste . "<td> N&deg; : " . @$nn . "</td>";
                                $liste = $liste . "<td>Montant : " . @$ligne->lignereglement->Montant . "</td>";
                                $liste = $liste . "</tr>";
                            }
                        }
                    }
                }


                $liste .= "</table>";
                //debug($liste);//die;
                $tablignereglementlibres = $this->fetchTable('Relevefournisseurs')->newEmptyEntity();
                $tablignereglementlibres['fournisseur_id'] = $reglementlibre->fournisseur_id;
                $tablignepiecereglementzs['numero'] = $reglementlibre->numero;

                $tablignereglementlibres['nbligneimp'] = $k + 3;
                $tablignereglementlibres['type'] = $liste;
                $tablignereglementlibres['debit'] = "";
                $tablignereglementlibres['date'] =  $reglementlibre->Date;
                $tablignereglementlibres['credit'] = $reglementlibre->Montant;
                $tablignereglementlibres['impaye'] = "";
                $tablignereglementlibres['reglement'] = $reglementlibre->Montant;
                $tablignereglementlibres['avoir'] = "";
                $tablignereglementlibres['solde'] = $reglementlibre->montantaffecte - $reglementlibre->Montant;
                //   $tablignereglementlibres['exercice_id'] = $reglementlibre->exercice_id;
                $tablignereglementlibres['typ'] = "Reg";
                //  if ($reglementlibre->emi != '052') {
                //  debug($tablignereglementlibres);die;
                $this->Relevefournisseurs->save($tablignereglementlibres);
                // }
            }
            //
            $piecereglements = $this->fetchTable('Piecereglements')->find('all', [
                'contain' => ['Paiements', 'Reglements']
            ])
                ->where(['Piecereglements.paiement_id in (2,3)', @$condr3, @$condr4, 'Reglements.type=1']);

            foreach ($piecereglements as $piecereglement) {
                //debug($piecereglement);die;
                $tablignepiecereglementzs = $this->fetchTable('Relevefournisseurs')->newEmptyEntity();

                $tablignepiecereglementzs['fournisseur_id'] = $piecereglement->reglement->fournisseur_id;
                $tablignepiecereglementzs['date'] = $piecereglement->reglement->Date;
                $tablignepiecereglementzs['numero'] = $piecereglement->numero;
                $tablignepiecereglementzs['type'] = $piecereglement->paiement->name . ' : ' . @$piecereglement->piecereglement->num;
                $tablignepiecereglementzs['debit'] = $piecereglement->montant;
                $tablignepiecereglements['credit'] = "";
                $tablignepiecereglementzs['impaye'] = $piecereglement->montant;
                $tablignepiecereglementzs['reglement'] = "";
                $tablignepiecereglementzs['avoir'] = "";
                $tablignepiecereglementzs['solde'] = 2; //$piecereglement->montant;
                //   $tablignepiecereglementzs['exercice_id'] = 1;//$piecereglement->reglementclient->exercice_id;
                $tablignepiecereglementzs['typ'] = "Reg";
                //  debug($tablignepiecereglements);die;
                $this->Relevefournisseurs->save($tablignepiecereglementzs);
                //debug($tablignepiecereglementzs->id);//die; 


            }
        }


        $cha = "TRUE";
        $fournisseurs = $this->Fournisseurs->find("all")->where(["Fournisseurs"]);
        // .etat='$cha'"
        $personnels = $this->Personnels->find('list');
        $relefes = $this->Relevefournisseurs->find('all', [
            'contain' => ['Fourisseurs']
        ], array(
            'order' => array('Relevefournisseurs.date,Relevefournisseurs.typ' => 'asc'),
            'recursive' => 0
        ));

        $countt = $this->Relevefournisseurs->find('all', [
            'contain' => ['Fourisseurs']
        ], array(
            'order' => array('Relevefournisseurs.date,Relevefournisseurs.typ' => 'asc'),
            'recursive' => 0
        ))->count();

        if (!empty($clientid)) {
            $client = $this->Clients->find('all', array('conditions' => array('Clients.id' => $clientid), 'recursive' => 0))->first();

            $soldeint = $client->solde + $solde;
            $session->write('soldeint', $soldeint);
        }

        //debug($solde);die;
        $details = array();
        $details[1] = "Avec details";
        $details[2] = "Sans details";

        if (!empty($clientid)) {
            $cli = $this->Clients->find('all')->where("Clients.id=" . $clientid)->first();
            // debug($cli->Code);
        }


        $this->set(compact('cli', 'timbre', 'relefescount', 'details', 'relefes', 'soldeint', 'solde', 'clientid', 'c5', 'c4', 'c3', 'c2', 'c1', 'piecereglements', 'factureavoirs', 'bonlivraisons', 'factureclients', 'reglementlibres', 'articles', 'clients', 'personnels', 'exercices', 'exerciceid', 'date1', 'clientid', 'marque_id', 'date2', 'name', 'countt'));
    }
    /**
     * View method
     *
     * @param string|null $id Relevefournisseur id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $relevefournisseur = $this->Relevefournisseurs->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('relevefournisseur'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $relevefournisseur = $this->Relevefournisseurs->newEmptyEntity();
        if ($this->request->is('post')) {
            $relevefournisseur = $this->Relevefournisseurs->patchEntity($relevefournisseur, $this->request->getData());
            if ($this->Relevefournisseurs->save($relevefournisseur)) {
                $this->Flash->success(__('The relevefournisseur has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The relevefournisseur could not be saved. Please, try again.'));
        }
        $this->set(compact('relevefournisseur'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Relevefournisseur id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $relevefournisseur = $this->Relevefournisseurs->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $relevefournisseur = $this->Relevefournisseurs->patchEntity($relevefournisseur, $this->request->getData());
            if ($this->Relevefournisseurs->save($relevefournisseur)) {
                $this->Flash->success(__('The relevefournisseur has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The relevefournisseur could not be saved. Please, try again.'));
        }
        $this->set(compact('relevefournisseur'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Relevefournisseur id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $relevefournisseur = $this->Relevefournisseurs->get($id);
        if ($this->Relevefournisseurs->delete($relevefournisseur)) {
            $this->Flash->success(__('The relevefournisseur has been deleted.'));
        } else {
            $this->Flash->error(__('The relevefournisseur could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
