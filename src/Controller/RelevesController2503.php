<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Releves Controller
 *
 * @property \App\Model\Table\RelevesTable $Releves
 * @method \App\Model\Entity\Relef[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RelevesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function index() {
        error_reporting(E_ERROR | E_PARSE);
        $relefescount = $this->Releves->find('all', [
            'contain' => ['Clients']
        ], array('order' => array('Releves.date,Releves.typ' => 'asc'),
            'recursive' => 0))->count();

       // debug($relefescount);
            
        $session = $this->request->getSession();

        $this->loadModel('Exercices');
        $this->loadModel('Clients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Factureclients');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Piecereglementclients');
        $this->loadModel('Lignereglementclients');

        $this->loadModel('Personnels');

        $exercices = $this->Exercices->find('list');
        @$exe = @date('Y');

        $exercicet = $this->Exercices->find('all', array('conditions' => array('Exercices.name' => $exe)))->first();

        if($exercicet){

            $exerciceid = $exercicet['id'];

        }else{
            $exerciceid = " ";
        }

        $condb4 = 'Bonlivraisons.exercice_id =' . $exe;
        $condf4 = 'Factureclients.exercice_id =' . $exe;
        $condfa4 = 'Factureavoirs.exercice_id =' . $exe;
        $condr4 = 'Reglementclients.exercice_id =' . $exe;
        $c1 = 'releves.exercice_id =' . $exe;

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

        $this->Releves->deleteAll(array('1 = 1'));
          

        //$this->Relefe->deleteAll(array('Relefe.id >'=>0),false);
        $c5 = "";
        if ($this->request->is('post') || $this->request->getQuery()) {

            //$this->Relefe->query('TRUNCATE releves;');


            $session->delete('soldeint');

            if (empty($this->request->getQuery()['date1']) )  {
                $this->request->getQuery()['date1']  = '2015-01-01';
            }
            if (empty($this->request->getQuery()['date2'] )) {
                $this->request->getQuery()['date2'] = date('d/m/Y');
            }


            if ($this->request->getQuery()['date1'] != "__/__/____") {
                $date1 = $this->request->getQuery()['date1'];
                $condb1 = 'Bonlivraisons.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condf1 = 'Factureclients.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condfa1 = 'Factureavoirs.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condbb1 = 'Reglementclients.date  >=  ' . "'" . $date1 . " 00:00:00'";
                $condss1 = 'Piecereglementclients.datesituation  >=  ' . "'" . $date1 . " 00:00:00'";
                $condbs = 'Bonlivraisons.date < ' . "'" . $date1 . "'";
                $condfs = 'Factureclients.date < ' . "'" . $date1 . "'";
                $condfas = 'Factureavoirs.date < ' . "'" . $date1 . "'";
                $condbbs = 'Reglementclients.date < ' . "'" . $date1 . "'";
                $condss = 'Piecereglementclients.datesituation < ' . "'" . $date1 . "'";
                $c2 = 'releves.date  >=  ' . "'" . $date1 . " 00:00:00'";

                $condb4 = "";
                $condf4 = "";
                $condfa4 = "";
                $condr4 = "";
            }

            if ($this->request->getQuery()['date2'] != "__/__/____") {
                $date2 =  $this->request->getQuery()['date2'];
                $condb2 = 'Bonlivraisons.date <  ' . "'" . $date2 . " 23:59:59'";
                $condf2 = 'Factureclients.date <  ' . "'" . $date2 . " 23:59:59'";
                $condfa2 = 'Factureavoirs.date <  ' . "'" . $date2 . " 23:59:59'";
                $condbr2 = 'Reglementclients.date <  ' . "'" . $date2 . " 23:59:59'";
                $condss2 = 'Piecereglementclients.datesituation <  ' . "'" . $date2 . " 23:59:59'";

                $c3 = 'releves.date <  ' . "'" . $date2 . " 23:59:59'";

                $condb4 = "";
                $condf4 = "";
                $condfa4 = "";
                $condr4 = "";
            }
            $clientid = "";

            if ( $this->request->getQuery()['client_id']) {

                $clientid = $this->request->getQuery()['client_id'];
                
                $condb3 = 'Bonlivraisons.client_id =' . $clientid;
                $condf3 = 'Factureclients.client_id =' . $clientid;
                $condfa3 = 'Factureavoirs.client_id =' . $clientid;
                $condr3 = 'Reglementclients.client_id =' . $clientid;
            }
            if ($this->request->getQuery()['detail_id']) {

                $detailid = $this->request->getQuery()['detail_id'];
            }


       /*      if ($this->request->data['Recherche']['personnel_id']) {
                $personnelid = $this->request->data['Recherche']['personnel_id'];
                $cond5 = 'Client.personnel_id =' . $personnelid;
                $personnel = $this->Personnel->find('all', array('conditions' => array('Personnel.id' => $personnelid), false));
                $name = $personnel[0]['Personnel']['name'];
            } */

            $solde = 0;
            $factureavoirs=$this->Factureavoirs->find() ;
            $soldeavoir =$factureavoirs->select(['sum' => $factureavoirs->func()->sum('Factureavoirs.totalttc')])

            ->where([@$condfas, $condfa3])->first();
           /*  $soldeavoir = $this->Factureavoir->find('first', array(
                'fields' => array('sum(Factureavoir.totalttc) as solde'),
                'conditions' => array(@$condfas, $condfa3), 'recursive' => 0));
                */
            if (!empty($soldeavoir)) {
                $solde = $solde - $soldeavoir->solde;

            }
            $bonlivraisons=$this->Bonlivraisons->find() ;
            $soldebl =$bonlivraisons->select(['sum' => $bonlivraisons->func()->sum('Bonlivraisons.totalttc')])

            ->where([@$condbs,$condb3,'Bonlivraisons.factureclient_id' => 0])->first();

           /*  $soldebl = $this->Bonlivraisons->find('all', array(
                'fields' => array('sum((Bonlivraisons.totalttc)) as solde'),
                'conditions' => array(@$condbs, $condb3, 'Bonlivraisons.factureclient_id' => 0), 'recursive' => 0))->first(); */
            if (!empty($soldebl)) {
                $solde = $solde +$soldebl->sum;
            }

            $factureclients=$this->Factureclients->find() ;
            $soldefac =$factureclients->select(['sum' => $factureclients->func()->sum('Factureclients.totalttc')])

            ->where([@$condfs,$condf3])->first();

            /* $soldefac = $this->Factureclients->find('all', array(
                'fields' => array('sum((Factureclients.totalttc)) as solde'),
                'conditions' => array(@$condfs, $condf3), 'recursive' => 0))->first(); */
            if (!empty($soldefac)) {
                $solde = $solde + $soldefac->sum;
            }
            $reglementclients=$this->Reglementclients->find() ;
            $soldereg =$reglementclients->select(['sum' => $reglementclients->func()->sum('Reglementclients.Montant')])

            ->where([@$condbbs, $condr3])->first();
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

            $piecereglementclients=$this->Piecereglementclients->find("all", [
                'contain' => ['Reglementclients']
            ]) ;
     
            $soldepiece =$piecereglementclients->select(['sum' => $piecereglementclients->func()->sum('Piecereglementclients.montant')])

            ->where([@$condss, $condr3, 'Piecereglementclients.paiement_id in (2,3)', '(Piecereglementclients.situation="Impayé" or Reglementclients.emi="052")'])->first();

            if (!empty($soldepiece)) {
                $solde = $solde - $soldepiece->sum;
            }
            $tim = $this->fetchTable('Timbres')->find()->select(["timbre" =>
            'MAX(Timbres.timbre)'])->first();
            $timbre = $tim->timbre;

            $factureavoirs = $this->Factureavoirs->find('all', array(
            'conditions' => array(@$condfa1, @$condfa2, @$condfa3, @$condfa4/* , @$cond5 */), 'contain' => array('Clients'), 'recursive' => 0));

        foreach ($factureavoirs as $factureavoir) {
            $tablignedevis = $this->fetchTable('Releves')->newEmptyEntity();

            $tablignedevis['client_id'] = $factureavoir->client_id;
            $tablignedevis['date'] = $factureavoir->date;
            $tablignedevis['numero'] = $factureavoir->numero;
            $tablignedevis['type'] = '<a onClick="flvFPW1(wr+`Factureavoirs/imprimerfavr/`+' . $factureavoir->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Factureavoir N°     :' . $factureavoir->numero . '</strong></a>';
            $tablignedevis['debit'] = "";
            $tablignedevis['credit'] = $factureavoir->totalttc;
            $tablignedevis['impaye'] = "";
            $tablignedevis['reglement'] = "";
            $tablignedevis['avoir'] = $factureavoir->totalttc;
            $tablignedevis['solde'] = 0 - $factureavoir->totalttc;
            $tablignedevis['exercice_id'] = $factureavoir->exercice_id;
            $tablignedevis['typ'] = "FR";

            $this->Releves->save($tablignedevis);
        }

          $conditionbl = 'Bonlivraisons.bl = 1';

            $bonlivraisons = $this->Bonlivraisons->find('all', array('conditions' => array(
                    'Bonlivraisons.factureclient_id' => 0,$conditionbl,@$condb1, @$condb2, @$condb3, @$condb4/* , @$cond5 */), 'contain' => array('Clients'), 'recursive' => 0));
                   // debug($bonlivraisons->toarray());

            foreach ($bonlivraisons as $bonlivraison) {
                $tablignelivraisons = $this->fetchTable('Releves')->newEmptyEntity();

                $tablignelivraisons['client_id'] = $bonlivraison->client_id;
                $tablignelivraisons['date'] = $bonlivraison->date;
                $tablignelivraisons['numero'] = $bonlivraison->numero;
                $tablignelivraisons['type'] = '<a onClick="flvFPW1(wr+`Bonlivraisons/imprimer/`+' . $bonlivraison->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Bonlivraison N°     :' . $bonlivraison->numero . '</strong></a>';
                $tablignelivraisons['debit'] = $bonlivraison->totalttc+$timbre;
                $tablignelivraisons['credit'] = "";
                $tablignelivraisons['impaye'] = "";
                $tablignelivraisons['reglement'] = $bonlivraison->Montant_Regler;
                $tablignelivraisons['avoir'] = "";
                $tablignelivraisons['typ'] = "BL";
                $tablignelivraisons['solde'] = $bonlivraison->totalttc+$timbre- $bonlivraison->Montant_Regler;
                $tablignelivraisons['exercice_id'] = $bonlivraison->exercice_id;
                $this->Releves->save($tablignelivraisons);
            }

            $factureclients = $this->Factureclients->find('all', array('conditions' => array(
                    @$condf1, @$condf2, @$condf3, @$condf4/* , @$cond5 */), 'contain' => array('Clients'), 'recursive' => 0));
           //debug($factureclients);die;
                        
                    foreach ($factureclients as $factureclient) {

                $nom = "Factureclients";
                $tablignefactureclients = $this->fetchTable('Releves')->newEmptyEntity();

                    /*                 if ($factureclient['Factureclient']['source'] == "bl") {
                    $nom = "Facture";
                }
                if ($factureclient['Factureclient']['source'] == "fac") {
                    $nom = "BlFacture";
                } */
                $tablignefactureclients['client_id'] = $factureclient->client_id;
                $tablignefactureclients['date'] = $factureclient->date;
                $tablignefactureclients['numero'] = $factureclient->numero;
                $tablignefactureclients['type'] = '<a onClick="flvFPW1(wr+`Factureclients/imprimer/`+' . $factureclient->id. ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>' . $nom . ' N°     :' . $factureclient->numero . '</strong></a>';
                $tablignefactureclients['debit'] = $factureclient->totalttc+$timbre;
                $tablignefactureclients['credit'] = "";
                $tablignefactureclients['impaye'] = "";
                $tablignefactureclients['reglement'] = $factureclient->Montant_Regler;
                $tablignefactureclients['avoir'] = "";
                $tablignefactureclients['solde'] = $factureclient->totalttc+$timbre- $factureclient->Montant_Regler;
                $tablignefactureclients['exercice_id'] = $factureclient->exercice_id;
                $tablignefactureclients['typ'] = "Fac";

                $this->Releves->save($tablignefactureclients);
            }
                //debug($condr3);die;
                //            $reglementlibres = $this->Reglementclients->find('all', [
                //                'contain' => ['Lignereglementclients','Clients']
                //            ], array('conditions' => array(
                //                     @$condbr2, @$condr3, $condbb1)));
                ////               debug(json_encode($reglementlibres));die;
                //                 $reglementlibres = $this->Reglementclients->find('all', array('conditions' => array(
                //                  @$condbr2, @$condr3, $condbb1/* , @$cond5 */), 'contain' => array('Lignereglementclients','Clients')));
                                        $reglementlibres = $this->fetchTable('Reglementclients')->find('all', [
                                            'contain' => ['Lignereglementclients','Clients'] ])->where([@$condbr2, @$condr3, $condbb1]);
                                    // debug($reglementlibres->toarray());
                            foreach ($reglementlibres as $reglementlibre) {

                        
                                // debug($reglementlibre);
                


                $tablignereglementlibres['client_id'] = $reglementlibre->client_id;
                $tablignereglementlibres['date'] = $reglementlibre->Date;
                $tablignereglementlibres['numero'] = $reglementlibre->numeroconca;
                $liste = "<table width='100%' >";
                //$liste="";
                $idd=$Piecereglementclients=$reglementlibre->id;
              
                $Piecereglementclients = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.reglementclient_id='.$idd), 'contain' => array('Paiements','Reglementclients'), 'recursive' => 0));
      //debug($Piecereglementclients);die;
                foreach ($Piecereglementclients as $k => $Piece) {
                    ///debug($Piece);
               if($k==0){
               $liste=$liste."".$Piece['Paiement']['name'];
               if(!empty($Piece['Piecereglementclient']['num'])){
               $liste=$liste." : ".$Piece['Piecereglementclient']['num'];
               }
               if((!empty($Piece['Piecereglementclient']['echance']))&&($Piece['Piecereglementclient']['echance']!="1970-01-01")){
               $liste=$liste." /echéance ".$Piece['Piecereglementclient']['echance'];
               }
              // $liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
               }else{
               $liste=$liste." ".$Piece['Paiement']['name'];
               if(!empty($Piece['Piecereglementclient']['num'])){
               $liste=$liste." : ".$Piece['Piecereglementclient']['num'];
               }
               if((!empty($Piece['Piecereglementclient']['echance']))&&($Piece['Piecereglementclient']['echance']!="1970-01-01")){
               $liste=$liste." /echéance ".$Piece['Piecereglementclient']['echance'];
               }
               //$liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
               }
                    $liste = $liste . "<tr>";
                    $liste = $liste . "<td><strong>" . @$Piece->Paiement->name . "</strong></td>";
                    $nnr = "";
                    //debug($Piece);die;
                    if ($Piece->num == "") {
                        $nnr = $Piece->reglementclient->numeroconca;
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
                    $liste = $liste . "<td><strong>Montant ====> " . @$Piece->montant. "</strong></td>";
                    $liste = $liste . "</tr>";
                }


                $liste = $liste . "<tr><td colspan='4' style='height: 10px;' ></td></tr>";

              


               



                // $list = '(0';
                // foreach ($reglementlibres as $reglementlibre) {
                //     $list = $list . "," . $reglementlibre['id']; 
                // }
                // $list = $list . ",0)" ;
                //debug($list);

                $condreg1 = 'Lignereglementclients.reglementclient_id ='.$reglementlibre['id'] ;
                
                $lignereglementclients = $this->fetchTable('Lignereglementclients')->find('all', [
                    'contain' => ['Factureclients','Bonlivraisons']])->where([@$condreg1]);
                // $lignereglementclients = $this->Lignereglementclients->find('all', [
                //     'contain' => ['Factureclients']
                // ], array('conditions' => array('Lignereglementclients.reglementclient_id='.$reglementlibre->id), 'recursive' => 0));
             //debug($lignereglementclients->toArray());

                if (@$detailid != 2) {
                    if (!empty($lignereglementclients)) {
                        $nn = "";
                        $liste=$liste."<br>";
                        //debug($lignereglementclients->toArray());die;
                        foreach ($lignereglementclients as $k => $ligne) {
                           // debug($ligne);
                            if ((!empty($ligne->factureclient_id))||(!empty($ligne->bonlivraison_id))) {
                               // debug($ligne);
                                // $liste=$liste." > BLFacture ".@$ligne['Factureclient']['numero'] ."  " .@$ligne['Lignereglementclient']['Montant']."<br>"  ;
                               
                                if($ligne->bonlivraison_id == 0){
                                    $liste = $liste . "<tr>";
                                    $liste = $liste . '<td colspan="2"><a onClick="flvFPW1(wr+`Factureclients/imprimer/`+' . @$ligne->factureclient->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Facture </strong></a></td>';
                                    $liste = $liste . "<td> N&deg; : " . @$ligne->factureclient->numero. "</td>";
                                    $liste = $liste . "<td>Montant : " . @$ligne->Montant. "</td>";
                                    $liste = $liste . "</tr>";
                                }else if ($ligne->factureclient_id == 0){
                                    $liste = $liste . "<tr>";
                                    $liste = $liste . '<td colspan="2"><a onClick="flvFPW1(wr+`Bonlivraisons/imprimer/`+' . @$ligne->bonlivraison->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Bon livraison </strong></a></td>';
                                    $liste = $liste . "<td> N&deg; : " . @$ligne->bonlivraison->numero. "</td>";
                                    $liste = $liste . "<td>Montant : " . @$ligne->Montant. "</td>";
                                    $liste = $liste . "</tr>";

                                }
                            } else {
                                $liste=$liste." > Impayé Client ".@$ligne['Piecereglementclient']['num'] ."  " .@$ligne['Lignereglementclient']['Montant']."<br>"  ;
                                $liste = $liste . "<tr>";
                                $liste = $liste . "<td colspan='2'> > Impay&eacute; Client </td>";
                                $ligne = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $ligne->piecereglementclient_id), 'recursive' => 0));

                               // debug($ligne);die;
                               if(!empty($ligne->Piecereglementclient)){
                                if ($ligne->num == "") {
                                    $ans_reg = $this->Reglementclients->find('first', [
                                        'contain' => ['Lignereglementclients']
                                    ], array('conditions' => array('Reglementclients.id' => $ligne->Piecereglementclient->reglementclient_id), 'recursive' => -1));
                                    $nn = $ans_reg->numero;
                                } else {
                                    $nn = $ligne->num;
                                }
                            }
                                $liste = $liste . "<td> N&deg; : " . @$nn . "</td>";
                                $liste = $liste . "<td>Montant : " . @$ligne->lignereglementclient->Montant . "</td>";
                                $liste = $liste . "</tr>";
                            }
                        }
                    }
                }


                $liste.="</table>";
            //debug($liste);//die;
                $tablignereglementlibres = $this->fetchTable('Releves')->newEmptyEntity();

                $tablignereglementlibres['nbligneimp'] = $k + 3;
                $tablignereglementlibres['type'] = $liste;
                $tablignereglementlibres['debit'] = "";
                $tablignereglementlibres['credit'] = $reglementlibre->Montant;
                $tablignereglementlibres['impaye'] = "";
                $tablignereglementlibres['reglement'] = $reglementlibre->Montant;
                $tablignereglementlibres['avoir'] = "";
                $tablignereglementlibres['solde'] = $reglementlibre->montantaffecte - $reglementlibre->Montant;
             //   $tablignereglementlibres['exercice_id'] = $reglementlibre->exercice_id;
                $tablignereglementlibres['typ'] = "Reg";
              //  if ($reglementlibre->emi != '052') {
              //  debug($tablignereglementlibres);die;
               $this->Releves->save($tablignereglementlibres);
               // }
            }
         //
              $piecereglements = $this->fetchTable('Piecereglementclients')->find('all', [
                           'contain' => ['Paiements', 'Reglementclients']
                       ])
                       ->where([ 'Piecereglementclients.paiement_id in (2,3)', /*@$condr1, @$condss2,*/ @$condr3, @$condr4/* , @$cond5 , $condss1*/]);

           foreach ($piecereglements as $piecereglement) {
               //debug($piecereglement);die;
               $tablignepiecereglementzs = $this->fetchTable('Releves')->newEmptyEntity();

               $tablignepiecereglementzs['client_id'] = $piecereglement->reglementclient->client_id;
               $tablignepiecereglementzs['date'] = $piecereglement->reglementclient->date;
               $tablignepiecereglementzs['numero'] =$piecereglement->numero;
               $tablignepiecereglementzs['type'] =$piecereglement->paiement->name . ' : ' . @$piecereglement->piecereglementclient->num;
               $tablignepiecereglementzs['debit'] =$piecereglement->montant;
               $tablignepiecereglements['credit'] = "";
               $tablignepiecereglementzs['impaye'] =$piecereglement->montant;
               $tablignepiecereglementzs['reglement'] = "";
               $tablignepiecereglementzs['avoir'] = "";
               $tablignepiecereglementzs['solde'] = 2;//$piecereglement->montant;
            //   $tablignepiecereglementzs['exercice_id'] = 1;//$piecereglement->reglementclient->exercice_id;
               $tablignepiecereglementzs['typ'] = "Reg";
             //  debug($tablignepiecereglements);die;
                 $this->Releves->save($tablignepiecereglementzs) ;
                    //debug($tablignepiecereglementzs->id);//die; 
               

           }
        }


        $cha = "TRUE";
        $clients = $this->Clients->find("all")->where(["Clients.etat='$cha'"]);

        $personnels = $this->Personnels->find('list');
        $relefes = $this->Releves->find('all', [
            'contain' => ['Clients']
        ],array('order' => array('Releves.date,Releves.typ' => 'asc'),
            'recursive' => 0));

        $countt = $this->Releves->find('all', [
                'contain' => ['Clients']
            ],array('order' => array('Releves.date,Releves.typ' => 'asc'),
                'recursive' => 0))->count();

              //  dd($countt);

           /*  $relefes = $this->Releves->find('all', [
                'contain' => ['Clients']
            ], array('order' => array('Releves.date,Releves.typ' => 'asc'),
                'recursive' => 0))->where(['Releves.client_id >' => 0]); */
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
        $cli=$this->Clients->find('all')->where("Clients.id=".$clientid)->first();
       // debug($cli->Code);
        }
      

        @$this->set(compact('cli','timbre','relefescount','details', 'relefes', 'soldeint', 'solde', 'clientid', 'c5', 'c4', 'c3', 'c2', 'c1', 'piecereglements', 'factureavoirs', 'bonlivraisons', 'factureclients', 'reglementlibres', 'articles', 'clients', 'personnels', 'exercices', 'exerciceid', 'date1', 'clientid', 'marque_id', 'date2', 'name','countt'));
    }


    public function imprimerrecherche() {
        
        //$this->response->type('pdf');
        //$this->layout = 'pdf';
/*         $soldeint=$this->request->query['soldeint'];
 */        if (!empty($this->request->getQuery()['date1']) ) {
            $date1 = $this->request->getQuery()['date1'] ;
        }

        if (!empty($this->request->getQuery()['date2']) ) {
            $date2 = $this->request->getQuery()['date2'];
        }
            

       /*  if ($this->request->query['name']) {
            $name = $this->request->query['name'];
        } */
        $relefes = $this->Releves->find('all', [
            'contain' => ['Clients']
        ], array('order' => array('Releves.date,Releves.typ' => 'asc'),
            'recursive' => 0));
            $relefescount = $this->Releves->find('all', [
                'contain' => ['Clients']
            ], array('order' => array('Releves.date,Releves.typ' => 'asc'),
                'recursive' => 0))->count();
                
          
            $soldeint=0 ;
        $this->set(compact('relefes', 'date1', 'date2','soldeint','relefescount'));
    }
 /*    public function index()
    {
        $this->loadModel('Client');
        $this->loadModel('Exercice');
        $this->loadModel('Personnel');
        $this->loadModel('Lignefactureavoir');
        $this->loadModel('Factureclient');
        $this->loadModel('Bonlivraison');
        $this->loadModel('Reglementclient');
        $this->loadModel('Factureavoir');
        $this->loadModel('Piecereglementclient');
        $this->loadModel('Lignereglementclient');


        $this->paginate = [
            'contain' => ['Clients', 'Exercices'],
        ];
        $releves = $this->paginate($this->Releves);

        $this->set(compact('releves'));
    } */

    /**
     * View method
     *
     * @param string|null $id Relef id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $relef = $this->Releves->get($id, [
            'contain' => ['Clients', 'Exercices'],
        ]);

        $this->set(compact('relef'));
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $relef = $this->Releves->newEmptyEntity();
        if ($this->request->is('post')) {
            $relef = $this->Releves->patchEntity($relef, $this->request->getData());
            if ($this->Releves->save($relef)) {
                $this->Flash->success(__('The {0} has been saved.', 'Relef'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Relef'));
        }
        $clients = $this->Releves->Clients->find('list', ['limit' => 200]);
        $exercices = $this->Releves->Exercices->find('list', ['limit' => 200]);
        $this->set(compact('relef', 'clients', 'exercices'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Relef id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $relef = $this->Releves->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $relef = $this->Releves->patchEntity($relef, $this->request->getData());
            if ($this->Releves->save($relef)) {
                $this->Flash->success(__('The {0} has been saved.', 'Relef'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Relef'));
        }
        $clients = $this->Releves->Clients->find('list', ['limit' => 200]);
        $exercices = $this->Releves->Exercices->find('list', ['limit' => 200]);
        $this->set(compact('relef', 'clients', 'exercices'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Relef id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $relef = $this->Releves->get($id);
        if ($this->Releves->delete($relef)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Relef'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Relef'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
