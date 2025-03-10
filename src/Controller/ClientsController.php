<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

/**
 * Clients Controller
 *
 * @property \App\Model\Table\ClientsTable $Clients
 * @method \App\Model\Entity\Client[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ClientsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function imprimetest($id = null)
    {
        $this->loadModel('Clientarticles');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        //debug($this->request->getData());
        $client = $this->Clients->get($id, [
            'contain' => [],
        ]);
        $date1 = date('Y-01-01');
        $date2 = date('Y-12-31');
        $condb1 = 'date(Bonlivraisons.date)  >=  ' . "'" . $date1 . "'";
        $condf1 = 'date(Factureclients.date)  >=  ' . "'" . $date1 . "'";
        $condfa1 = 'date(Factureavoirs.date)  >=  ' . "'" . $date1 . "'";
        $condbb1 = 'date(Reglementclients.date)  >=  ' . "'" . $date1 . "'";

        $condb2 = 'date(Bonlivraisons.date) <=  ' . "'" . $date2 . "'";
        $condf2 = 'date(Factureclients.date) <=  ' . "'" . $date2 . "'";
        $condfa2 = 'date(Factureavoirs.date) <=  ' . "'" . $date2 . "'";
        $condbr2 = 'date(Reglementclients.date) <=  ' . "'" . $date2 . "'";

        $factureavoirs = $this->Factureavoirs->find('all', array(
            'conditions' => array("Factureavoirs.client_id" => $id, $condfa1, @$condfa2),
            'contain' => array('Clients'),
            'recursive' => 0
        ));
        $tabligne = [];
        $i = 0;
        foreach ($factureavoirs as $i => $factureavoir) {
            $tablignedevis = $this->fetchTable('Releves')->newEmptyEntity();

            $tabligne[$i]['client_id'] = $factureavoir->client_id;
            $tabligne[$i]['date'] = $factureavoir->date->format("Y-m-d");
            $tablignedevis['numero'] = $factureavoir->numero;
            $tabligne[$i]['type'] = '<a onClick="flvFPW1(wr+`Factureavoirs/imprimerfavr/`+' . $factureavoir->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Factureavoir N°     :' . $factureavoir->numero . '</strong></a>';
            $tabligne[$i]['debit'] = "";
            $tabligne[$i]['credit'] = $factureavoir->totalttc;
            $tabligne[$i]['impaye'] = "";
            $tabligne[$i]['reglement'] = "";
            $tabligne[$i]['avoir'] = $factureavoir->totalttc;
            $tabligne[$i]['solde'] = 0 - $factureavoir->totalttc;
            $tabligne[$i]['exercice_id'] = $factureavoir->exercice_id;
            $tabligne[$i]['typ'] = "FR";

            //$this->Releves->save($tablignedevis);
        }
        $factureclients = $this->Factureclients->find('all', array(
            'conditions' => array(
                "Factureclients.client_id" => $id,
                $condf1,
                @$condf2
            ),
            'contain' => array('Clients'),
            'recursive' => 0
        ));

        foreach ($factureclients as $i => $factureclient) {

            $nom = "Factureclients";
            $tablignefactureclients = $this->fetchTable('Releves')->newEmptyEntity();


            $tabligne[$i]['client_id'] = $factureclient->client_id;
            $tabligne[$i]['date'] = $factureclient->date->format("Y-m-d");
            $tabligne[$i]['numero'] = $factureclient->numero;
            $tabligne[$i]['type'] = 'Facture';
            $tabligne[$i]['debit'] = $factureclient->totalttc;
            $tabligne[$i]['credit'] = "";
            $tabligne[$i]['impaye'] = "";
            $tabligne[$i]['reglement'] = $factureclient->Montant_Regler;
            $tabligne[$i]['avoir'] = "";
            $tabligne[$i]['solde'] = $factureclient->totalttc - $factureclient->Montant_Regler;
            $tabligne[$i]['exercice_id'] = $factureclient->exercice_id;
            $tabligne[$i]['typ'] = "Fac";

            //$this->Releves->save($tablignefactureclients);
        }
        $bonlivraisons = $this->Bonlivraisons->find('all', array(
            'conditions' => array(
                'Bonlivraisons.factureclient_id' => 0,
                "Bonlivraisons.client_id" => $id,
                $condb1,
                @$condb2
            ),
            'contain' => array('Clients'),
            'recursive' => 0
        ));
        // debug($bonlivraisons->toarray());

        foreach ($bonlivraisons as $i => $bonlivraison) {
            $tablignelivraisons = $this->fetchTable('Releves')->newEmptyEntity();

            $tabligne[$i]['client_id'] = $bonlivraison->client_id;
            $tabligne[$i]['date'] = $bonlivraison->date->format("Y-m-d");
            $tabligne[$i]['numero'] = $bonlivraison->numero;
            $tabligne[$i]['type'] = 'BL';
            $tabligne[$i]['debit'] = $bonlivraison->totalttc;
            $tabligne[$i]['credit'] = "";
            $tabligne[$i]['impaye'] = "";
            $tabligne[$i]['reglement'] = $bonlivraison->Montant_Regler;
            $tabligne[$i]['avoir'] = "";
            $tabligne[$i]['typ'] = "BL";
            $tabligne[$i]['solde'] = $bonlivraison->totalttc - $bonlivraison->Montant_Regler;
            $tabligne[$i]['exercice_id'] = $bonlivraison->exercice_id;
            // $this->Releves->save($tablignelivraisons);
        }
        $reglementlibres = $this->fetchTable('Reglementclients')->find('all', [
            'contain' => ['Lignereglementclients', 'Clients']
        ])->where(["Reglementclients.client_id" => $id, $condbb1, @$condbr2]);
        foreach ($reglementlibres as $i => $reglementlibre) {


            $liste = "<table width='100%' >";
            //$liste="";
            $liste1 = "";
            $idd = $Piecereglementclients = $reglementlibre->id;

            $Piecereglementclients = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.reglementclient_id=' . $idd), 'contain' => array('Paiements', 'Reglementclients', 'Banques', 'Comptes'), 'recursive' => 0));
            //  debug($Piecereglementclients->toArray());die;

            foreach ($Piecereglementclients as $k => $Piece) {


                if ($k == 0) {
                    $liste = $liste . "" . $Piece['Paiement']['name'];
                    if (!empty($Piece['Piecereglementclient']['num'])) {
                        $liste = $liste . " : " . $Piece['Piecereglementclient']['num'];
                    }
                    if ((!empty($Piece['Piecereglementclient']['echance'])) && ($Piece['Piecereglementclient']['echance'] != "1970-01-01")) {
                        $liste = $liste . " /echéance " . $Piece['Piecereglementclient']['echance'];
                    }
                    // $liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
                } else {
                    $liste = $liste . " " . $Piece['Paiement']['name'];
                    if (!empty($Piece['Piecereglementclient']['num'])) {
                        $liste = $liste . " : " . $Piece['Piecereglementclient']['num'];
                    }
                    if ((!empty($Piece['Piecereglementclient']['echance'])) && ($Piece['Piecereglementclient']['echance'] != "1970-01-01")) {
                        $liste = $liste . " /echéance " . $Piece['Piecereglementclient']['echance'];
                    }
                    //$liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
                }
                $liste = $liste . "<tr>";
                $liste = $liste . "<td width='30%'>Reg: " . @$Piece->paiement->name . "</td>";

                // $liste = $liste . "<td><strong>" . @$Piece->Paiement->name . "</strong></td>";
                $nnr = "";
                //debug($Piece);die;
                if ($Piece->num == "") {
                    $nnr = $Piece->reglementclient->numeroconca;
                } else {
                    $nnr = $Piece->num;
                }
                $liste = $liste . "<td colspan='2'>N&deg; : " . @$nnr . "</td></tr>";
                if ((!empty($Piece->echance)) && ($Piece->echance != "1970-01-01")) {

                    $Piece->echance = @$Piece->echance->format('Y-m-d');
                } else {
                    $Piece->echance = "";
                }

                // debug($Piece->compte->numero);
                $liste1 = $liste1 . " Reg: " . @$Piece->paiement->name . " N&deg;" . $Piece->compte->numero . " , " . $Piece->banque->name . " : Ech:" . $Piece->echance . "<br>";

                $liste = $liste . "<tr><td width='30%'> Ech : " . @$Piece->echance . "</td>";
                $liste = $liste . "<td colspan='2'></td>";
                $liste = $liste . "</tr>";
            }


            // $liste = $liste . "<tr><td colspan='2' style='height: 10px;' ></td></tr>";

            $condreg1 = 'Lignereglementclients.reglementclient_id =' . $reglementlibre['id'];

            $lignereglementclients = $this->fetchTable('Lignereglementclients')->find('all', [
                'contain' => ['Factureclients', 'Bonlivraisons']
            ])->where([@$condreg1]);
            //debug($lignereglementclients->toArray());
            // $lignereglementclients = $this->Lignereglementclients->find('all', [
            //     'contain' => ['Factureclients']
            // ], array('conditions' => array('Lignereglementclients.reglementclient_id='.$reglementlibre->id), 'recursive' => 0));
            //debug($lignereglementclients->toArray());


            if (!empty($lignereglementclients)) {
                $nn = "";
                //  $liste = $liste ;
                //debug($lignereglementclients->toArray());die;
                foreach ($lignereglementclients as $k => $ligne) {
                    // debug($ligne);
                    if ((!empty($ligne->factureclient_id)) || (!empty($ligne->bonlivraison_id))) {

                        // $liste=$liste." > BLFacture ".@$ligne['Factureclient']['numero'] ."  " .@$ligne['Lignereglementclient']['Montant']."<br>"  ;

                        if ($ligne->bonlivraison_id == 0) {
                            $liste = $liste . "<tr>";
                            $liste = $liste . '<td width="30%">--> Facture :</td>';
                            $liste = $liste . "<td width='30%'> " . @$ligne->factureclient->date . " :</td>";
                            $liste = $liste . "<td width='40%'>" . @$ligne->Montant . "</td>";
                            $liste = $liste . "</tr>";
                            if ($ligne->factureclient->date) {
                                $ligne->factureclient->date = $ligne->factureclient->date->format("Y-m-d");
                            }
                            $liste1 = $liste1 . " --> Facture :" . @$ligne->factureclient->date  . " :" . @$ligne->Montant . "<br>";
                        } else if ($ligne->factureclient_id == 0) {
                            $liste = $liste . "<tr>";
                            $liste = $liste . '<td  width="30%">BL</td>';
                            $liste = $liste . "<td width='30%'>: " . @$ligne->bonlivraison->date->format("Y-m-d") . "</td>";
                            $liste = $liste . "<td width='40%'>: " . @$ligne->Montant . "</td>";
                            $liste = $liste . "</tr>";
                            $liste1 = $liste1 . " --> BL :" . @$ligne->bonlivraison->date->format("Y-m-d") . " :" . @$ligne->Montant . "<br>";
                        }
                        // debug($liste1);

                    } else {
                        $liste = $liste . " > Impayé Client " . @$ligne['Piecereglementclient']['num'] . "  " . @$ligne['Lignereglementclient']['Montant'] . "<br>";
                        $liste = $liste . "<tr>";
                        $liste = $liste . "<td colspan='2'> > Impay&eacute; Client </td>";
                        $liste1 = $liste1 . "<br>Impayé Client :" . @$ligne['Piecereglementclient']['num'] . "";

                        $ligne = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $ligne->piecereglementclient_id), 'recursive' => 0));

                        // debug($ligne);die;
                        if (!empty($ligne->Piecereglementclient)) {
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
                        $liste1 = $liste1 . "<br>N&deg; :" . @$nn . " : Montant:" . @$ligne->lignereglementclient->Montant . "";
                    }
                }
            }


            // var_dump( $reglementlibre->Montant) ;
            // var_dump($reglementlibre->montantaffecte);
            $liste .= "</table><br>";
            // debug($liste1);//die;
            // $liste1 .= "</p>";

            $tablignereglementlibres = $this->fetchTable('Releves')->newEmptyEntity();
            $tabligne[$i]['client_id'] = $reglementlibre->client_id;
            $tabligne[$i]['date'] = $reglementlibre->date->format("Y-m-d");
            $tabligne[$i]['numero'] = $reglementlibre->numeroconca;
            $tabligne[$i]['nbligneimp'] = $k + 3;

            $tabligne[$i]['type'] = $liste1;
            //debug($tabligne[$i]['type']);
            $tabligne[$i]['debit'] = "";
            $tabligne[$i]['credit'] = $reglementlibre->Montant;
            $tabligne[$i]['impaye'] = "";
            $tabligne[$i]['reglement'] = $reglementlibre->Montant;
            $tabligne[$i]['avoir'] = "";
            $tabligne[$i]['solde'] = $reglementlibre->montantaffecte - $reglementlibre->Montant;
            $tabligne[$i]['typ'] = "Reg";

            //  if ($reglementlibre->emi != '052') {
            //  debug($tablignereglementlibres);die;
            //$this->Releves->save($tablignereglementlibres);
            // }
        }


        $unpaidInvoices = $this->Factureclients->find()
            ->contain(['Clients'])
            ->where([
                'Factureclients.Montant_Regler' => 0,
                'Factureclients.client_id' => $id
            ])
            ->toArray();

        // Fetch payment pieces for the specified period
        $payments = $this->Piecereglementclients->find()
            ->contain(['Reglementclients' => ['Clients']])
            ->where(['Reglementclients.client_id' => $id])
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
        $soldef = 0;
        foreach ($supplierBalances as $client_data) {

            $soldef = $client_data['soldedepart'] + $client_data['Debit'] -  $client_data['Credit'];
        }
        debug($soldef);

        $this->set(compact('client', 'soldef', 'tabligne', 'date2', 'date1'));
    }

    public function imprime($id = null)
    {
        $this->loadModel('Clientarticles');
        $this->loadModel('Factureavoirs');
        $this->loadModel('Factureclients');
        $this->loadModel('Bonlivraisons');
        $this->loadModel('Reglementclients');
        $this->loadModel('Piecereglementclients');
        //debug($this->request->getData());
        $client = $this->Clients->get($id, [
            'contain' => [],
        ]);
        $date1 = date('Y-01-01');
        $date2 = date('Y-12-31');
        $condb1 = 'date(Bonlivraisons.date)  >=  ' . "'" . $date1 . "'";
        $condf1 = 'date(Factureclients.date)  >=  ' . "'" . $date1 . "'";
        $condfa1 = 'date(Factureavoirs.date)  >=  ' . "'" . $date1 . "'";
        $condbb1 = 'date(Reglementclients.date)  >=  ' . "'" . $date1 . "'";

        $condb2 = 'date(Bonlivraisons.date) <=  ' . "'" . $date2 . "'";
        $condf2 = 'date(Factureclients.date) <=  ' . "'" . $date2 . "'";
        $condfa2 = 'date(Factureavoirs.date) <=  ' . "'" . $date2 . "'";
        $condbr2 = 'date(Reglementclients.date) <=  ' . "'" . $date2 . "'";

        $factureavoirs = $this->Factureavoirs->find('all', array(
            'conditions' => array("Factureavoirs.client_id" => $id, $condfa1, @$condfa2),
            'contain' => array('Clients'),
            'recursive' => 0
        ));
        $tabligne = [];
        $i = 0;
        foreach ($factureavoirs as $i => $factureavoir) {
            $tablignedevis = $this->fetchTable('Releves')->newEmptyEntity();

            $tabligne[$i]['client_id'] = $factureavoir->client_id;
            $tabligne[$i]['date'] = $factureavoir->date->format("Y-m-d");
            $tablignedevis['numero'] = $factureavoir->numero;
            $tabligne[$i]['type'] = '<a onClick="flvFPW1(wr+`Factureavoirs/imprimerfavr/`+' . $factureavoir->id . ',`UPLOAD`,`width=800,height=1150,scrollbars=yes`,0,2,2);return document.MM_returnValue" href="javascript:;" ><strong>Factureavoir N°     :' . $factureavoir->numero . '</strong></a>';
            $tabligne[$i]['debit'] = "";
            $tabligne[$i]['credit'] = $factureavoir->totalttc;
            $tabligne[$i]['impaye'] = "";
            $tabligne[$i]['reglement'] = "";
            $tabligne[$i]['avoir'] = $factureavoir->totalttc;
            $tabligne[$i]['solde'] = 0 - $factureavoir->totalttc;
            $tabligne[$i]['exercice_id'] = $factureavoir->exercice_id;
            $tabligne[$i]['typ'] = "FR";

            //$this->Releves->save($tablignedevis);
        }
        $factureclients = $this->Factureclients->find('all', array(
            'conditions' => array(
                "Factureclients.client_id" => $id,
                $condf1,
                @$condf2
            ),
            'contain' => array('Clients'),
            'recursive' => 0
        ));

        foreach ($factureclients as $i => $factureclient) {

            $nom = "Factureclients";
            $tablignefactureclients = $this->fetchTable('Releves')->newEmptyEntity();


            $tabligne[$i]['client_id'] = $factureclient->client_id;
            $tabligne[$i]['date'] = $factureclient->date->format("Y-m-d");
            $tabligne[$i]['numero'] = $factureclient->numero;
            $tabligne[$i]['type'] = 'Facture';
            $tabligne[$i]['debit'] = $factureclient->totalttc;
            $tabligne[$i]['credit'] = "";
            $tabligne[$i]['impaye'] = "";
            $tabligne[$i]['reglement'] = $factureclient->Montant_Regler;
            $tabligne[$i]['avoir'] = "";
            $tabligne[$i]['solde'] = $factureclient->totalttc - $factureclient->Montant_Regler;
            $tabligne[$i]['exercice_id'] = $factureclient->exercice_id;
            $tabligne[$i]['typ'] = "Fac";

            //$this->Releves->save($tablignefactureclients);
        }
        $bonlivraisons = $this->Bonlivraisons->find('all', array(
            'conditions' => array(
                'Bonlivraisons.factureclient_id' => 0,
                "Bonlivraisons.client_id" => $id,
                $condb1,
                @$condb2
            ),
            'contain' => array('Clients'),
            'recursive' => 0
        ));
        // debug($bonlivraisons->toarray());

        foreach ($bonlivraisons as $i => $bonlivraison) {
            $tablignelivraisons = $this->fetchTable('Releves')->newEmptyEntity();

            $tabligne[$i]['client_id'] = $bonlivraison->client_id;
            $tabligne[$i]['date'] = $bonlivraison->date->format("Y-m-d");
            $tabligne[$i]['numero'] = $bonlivraison->numero;
            $tabligne[$i]['type'] = 'BL';
            $tabligne[$i]['debit'] = $bonlivraison->totalttc;
            $tabligne[$i]['credit'] = "";
            $tabligne[$i]['impaye'] = "";
            $tabligne[$i]['reglement'] = $bonlivraison->Montant_Regler;
            $tabligne[$i]['avoir'] = "";
            $tabligne[$i]['typ'] = "BL";
            $tabligne[$i]['solde'] = $bonlivraison->totalttc - $bonlivraison->Montant_Regler;
            $tabligne[$i]['exercice_id'] = $bonlivraison->exercice_id;
            // $this->Releves->save($tablignelivraisons);
        }
        $reglementlibres = $this->fetchTable('Reglementclients')->find('all', [
            'contain' => ['Lignereglementclients', 'Clients']
        ])->where(["Reglementclients.client_id" => $id, $condbb1, @$condbr2]);
        foreach ($reglementlibres as $i => $reglementlibre) {


            $liste = "<table width='100%' >";
            //$liste="";
            $liste1 = "";
            $idd = $Piecereglementclients = $reglementlibre->id;

            $Piecereglementclients = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.reglementclient_id=' . $idd), 'contain' => array('Paiements', 'Reglementclients', 'Banques', 'Comptes'), 'recursive' => 0));
            //  debug($Piecereglementclients->toArray());die;

            foreach ($Piecereglementclients as $k => $Piece) {


                if ($k == 0) {
                    $liste = $liste . "" . $Piece['Paiement']['name'];
                    if (!empty($Piece['Piecereglementclient']['num'])) {
                        $liste = $liste . " : " . $Piece['Piecereglementclient']['num'];
                    }
                    if ((!empty($Piece['Piecereglementclient']['echance'])) && ($Piece['Piecereglementclient']['echance'] != "1970-01-01")) {
                        $liste = $liste . " /echéance " . $Piece['Piecereglementclient']['echance'];
                    }
                    // $liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
                } else {
                    $liste = $liste . " " . $Piece['Paiement']['name'];
                    if (!empty($Piece['Piecereglementclient']['num'])) {
                        $liste = $liste . " : " . $Piece['Piecereglementclient']['num'];
                    }
                    if ((!empty($Piece['Piecereglementclient']['echance'])) && ($Piece['Piecereglementclient']['echance'] != "1970-01-01")) {
                        $liste = $liste . " /echéance " . $Piece['Piecereglementclient']['echance'];
                    }
                    //$liste=$liste."==>".$Piece['Piecereglementclient']['montant']."<br>";
                }
                $liste = $liste . "<tr>";
                $liste = $liste . "<td width='30%'>Reg: " . @$Piece->paiement->name . "</td>";

                // $liste = $liste . "<td><strong>" . @$Piece->Paiement->name . "</strong></td>";
                $nnr = "";
                //debug($Piece);die;
                if ($Piece->num == "") {
                    $nnr = $Piece->reglementclient->numeroconca;
                } else {
                    $nnr = $Piece->num;
                }
                $liste = $liste . "<td colspan='2'>N&deg; : " . @$nnr . "</td></tr>";
                if ((!empty($Piece->echance)) && ($Piece->echance != "1970-01-01")) {

                    $Piece->echance = @$Piece->echance->format('Y-m-d');
                } else {
                    $Piece->echance = "";
                }

                // debug($Piece->compte->numero);
                $liste1 = $liste1 . " Reg: " . @$Piece->paiement->name . " N&deg;" . $Piece->compte->numero . " , " . $Piece->banque->name . " : Ech:" . $Piece->echance . "<br>";

                $liste = $liste . "<tr><td width='30%'> Ech : " . @$Piece->echance . "</td>";
                $liste = $liste . "<td colspan='2'></td>";
                $liste = $liste . "</tr>";
            }


            // $liste = $liste . "<tr><td colspan='2' style='height: 10px;' ></td></tr>";

            $condreg1 = 'Lignereglementclients.reglementclient_id =' . $reglementlibre['id'];

            $lignereglementclients = $this->fetchTable('Lignereglementclients')->find('all', [
                'contain' => ['Factureclients', 'Bonlivraisons']
            ])->where([@$condreg1]);
            //debug($lignereglementclients->toArray());
            // $lignereglementclients = $this->Lignereglementclients->find('all', [
            //     'contain' => ['Factureclients']
            // ], array('conditions' => array('Lignereglementclients.reglementclient_id='.$reglementlibre->id), 'recursive' => 0));
            //debug($lignereglementclients->toArray());


            if (!empty($lignereglementclients)) {
                $nn = "";
                //  $liste = $liste ;
                //debug($lignereglementclients->toArray());die;
                foreach ($lignereglementclients as $k => $ligne) {
                    // debug($ligne);
                    if ((!empty($ligne->factureclient_id)) || (!empty($ligne->bonlivraison_id))) {

                        // $liste=$liste." > BLFacture ".@$ligne['Factureclient']['numero'] ."  " .@$ligne['Lignereglementclient']['Montant']."<br>"  ;

                        if ($ligne->bonlivraison_id == 0) {
                            $liste = $liste . "<tr>";
                            $liste = $liste . '<td width="30%">--> Facture :</td>';
                            $liste = $liste . "<td width='30%'> " . @$ligne->factureclient->date . " :</td>";
                            $liste = $liste . "<td width='40%'>" . @$ligne->Montant . "</td>";
                            $liste = $liste . "</tr>";
                            if ($ligne->factureclient->date) {
                                $ligne->factureclient->date = $ligne->factureclient->date->format("Y-m-d");
                            }
                            $liste1 = $liste1 . " --> Facture :" . @$ligne->factureclient->date  . " :" . @$ligne->Montant . "<br>";
                        } else if ($ligne->factureclient_id == 0) {
                            $liste = $liste . "<tr>";
                            $liste = $liste . '<td  width="30%">BL</td>';
                            $liste = $liste . "<td width='30%'>: " . @$ligne->bonlivraison->date->format("Y-m-d") . "</td>";
                            $liste = $liste . "<td width='40%'>: " . @$ligne->Montant . "</td>";
                            $liste = $liste . "</tr>";
                            $liste1 = $liste1 . " --> BL :" . @$ligne->bonlivraison->date->format("Y-m-d") . " :" . @$ligne->Montant . "<br>";
                        }
                        // debug($liste1);

                    } else {
                        $liste = $liste . " > Impayé Client " . @$ligne['Piecereglementclient']['num'] . "  " . @$ligne['Lignereglementclient']['Montant'] . "<br>";
                        $liste = $liste . "<tr>";
                        $liste = $liste . "<td colspan='2'> > Impay&eacute; Client </td>";
                        $liste1 = $liste1 . "<br>Impayé Client :" . @$ligne['Piecereglementclient']['num'] . "";

                        $ligne = $this->Piecereglementclients->find('all', array('conditions' => array('Piecereglementclients.id' => $ligne->piecereglementclient_id), 'recursive' => 0));

                        // debug($ligne);die;
                        if (!empty($ligne->Piecereglementclient)) {
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
                        $liste1 = $liste1 . "<br>N&deg; :" . @$nn . " : Montant:" . @$ligne->lignereglementclient->Montant . "";
                    }
                }
            }


            // var_dump( $reglementlibre->Montant) ;
            // var_dump($reglementlibre->montantaffecte);
            $liste .= "</table><br>";
            // debug($liste1);//die;
            // $liste1 .= "</p>";

            $tablignereglementlibres = $this->fetchTable('Releves')->newEmptyEntity();
            $tabligne[$i]['client_id'] = $reglementlibre->client_id;
            $tabligne[$i]['date'] = $reglementlibre->date->format("Y-m-d");
            $tabligne[$i]['numero'] = $reglementlibre->numeroconca;
            $tabligne[$i]['nbligneimp'] = $k + 3;

            $tabligne[$i]['type'] = $liste1;
            //debug($tabligne[$i]['type']);
            $tabligne[$i]['debit'] = "";
            $tabligne[$i]['credit'] = $reglementlibre->Montant;
            $tabligne[$i]['impaye'] = "";
            $tabligne[$i]['reglement'] = $reglementlibre->Montant;
            $tabligne[$i]['avoir'] = "";
            $tabligne[$i]['solde'] = $reglementlibre->montantaffecte - $reglementlibre->Montant;
            $tabligne[$i]['typ'] = "Reg";

            //  if ($reglementlibre->emi != '052') {
            //  debug($tablignereglementlibres);die;
            //$this->Releves->save($tablignereglementlibres);
            // }
        }


        $unpaidInvoices = $this->Factureclients->find()
            ->contain(['Clients'])
            ->where([
                'Factureclients.Montant_Regler' => 0,
                'Factureclients.client_id' => $id
            ])
            ->toArray();

        // Fetch payment pieces for the specified period
        $payments = $this->Piecereglementclients->find()
            ->contain(['Reglementclients' => ['Clients']])
            ->where(['Reglementclients.client_id' => $id])
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
        // $soldef = 0;
        // foreach ($supplierBalances as $client_data)
        //     {

        //     $soldef = $client_data['soldedepart'] + $client_data['Debit'] -  $client_data['Credit'];
        // }
        $connection = ConnectionManager::get('default');
        $scl = $connection->execute("SELECT soldeclient(" . $id . ", '" . $date2 . "') AS s")->fetchAll('assoc');

        $soldef = $scl[0]['s'] + $client->soldedebut;
        debug($soldef);
        $reglementsf = $this->fetchTable('Reglementclients')->find('all')->where(['Reglementclients.client_id' => $id/* , 'Reglementclients.type=2' */])->toArray();
        $echeancier = 0;
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
                $echeancier += $montantTotal;
            }
        }

        $this->set(compact('client', 'soldef', 'tabligne', 'date2', 'date1', 'echeancier'));
    }
    public function view($id = null)
    {
        $this->loadModel('Clientarticles');
        //debug($this->request->getData());
        $client = $this->Clients->get($id, [
            'contain' => [],
        ]);

        // debug($client);
        // debug($this->request->getData());
        if ($this->request->is(['patch', 'post', 'put'])) {


            //debug($this->request->getData('client_id'));
            //            $c = $this->Clients->get($this->request->getData('client_id'), [
            //                'contain' => [],
            //            ]);
            //            
            //            
            //            
            //            $c->etat = 'TRUE';
            //            $this->Clients->save($c);
            //
            //
            // debug($this->request->getData());
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($client->nouveau_client == 'TRUE') {
                $client->client_id = 0;
                $client->nouveau_client == 'TRUE';
            }



            if ($this->Clients->save($client)) {
                //debug($client);die;
                $this->misejour("Clients", "edit", $id);
                if (isset($this->request->getData('data')['prixarticle']) && (!empty($this->request->getData('data')['prixarticle']))) {
                    foreach ($this->request->getData('data')['prixarticle'] as $j => $p) {

                        //die;

                        if ($p['supprix'] != 1) {


                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            $data['article_id'] = $p['article_id'];
                            $data['prix'] = $p['prix'];
                            $data['client_id'] = $id;

                            // debug($data);
                            //    debug($p);
                            if (isset($p['id']) && (!empty($p['id']))) {

                                $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            };
                            $clientarticle = $this->fetchTable('Clientarticles')->patchEntity($clientarticle, $data);
                            $this->fetchTable('Clientarticles')->save($clientarticle);
                        } else if ($p['supprix'] == 1 && !empty($p['id'])) {

                            $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientarticles')->delete($clientarticle);
                        }
                    }
                }







                if (isset($this->request->getData('data')['adresse']) && (!empty($this->request->getData('data')['adresse']))) {
                    foreach ($this->request->getData('data')['adresse'] as $i => $b) {


                        if ($b['supadresse'] != 1) {


                            $adresseliv = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
                            $data['adresse'] = $b['adresse'];
                            $data['client_id'] = $id;

                            //debug($dat);
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
                            };
                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->patchEntity($adresselivraisonclient, $data);
                            $this->fetchTable('Adresselivraisonclients')->save($adresselivraisonclient);
                        } else if ($b['supadresse'] == 1 && !empty($b['id'])) {
                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Adresselivraisonclients')->delete($adresselivraisonclient);
                        }
                    }
                }





                if (isset($this->request->getData('data')['banque']) && (!empty($this->request->getData('data')['banque']))) {
                    foreach ($this->request->getData('data')['banque'] as $i => $b) {


                        if ($b['supbanque'] != 1) {
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            };

                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['client_id'] = $id;
                            $document = $b['documen'];
                            $name = $document->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $clientbanque->document = $name;
                            }


                            //debug($dat);

                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);


                            $this->fetchTable('Clientbanques')->save($clientbanque);
                        } else if ($b['supbanque'] == 1 && !empty($b['id'])) {
                            $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientbanques')->delete($clientbanque);
                        }
                    }
                }






                if (isset($this->request->getData('data')['responsable']) && (!empty($this->request->getData('data')['responsable']))) {
                    foreach ($this->request->getData('data')['responsable'] as $i => $b) {
                        // debug($b['tel']);


                        if ($b['supresponsable'] != 1) {

                            $dataa['name'] = $b['name'];
                            $dataa['mail'] = $b['mail'];
                            $dataa['tel'] = $b['tel'];
                            $dataa['poste'] = $b['poste'];
                            $dataa['client_id'] = $client->id;

                            //debug($dat);
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientresponsable = $this->fetchTable('Clientresponsables')->newEmptyEntity();
                            };
                            $clientresponsable = $this->fetchTable('Clientresponsables')->patchEntity($clientresponsable, $dataa);



                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
                            //                            debug($clientresponsable);die;
                        } else if ($b['supresponsable'] == 1 && !empty($b['id'])) {
                            $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientresponsables')->delete($clientresponsable);
                        }
                    }
                }





                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                        //debug($exon);
                        $this->loadModel('Clientexonerations');



                        if ($exon['sup2'] != 1) {
                            if (isset($exon['id']) && (!empty($exon['id']))) {
                                //debug("old");
                                $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                //debug("new");
                                $exonerations = $this->fetchTable('Clientexonerations')->newEmptyEntity();
                            };
                            $data2['typeexon_id'] = $exon['typeexon_id'];
                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
                            $data2['date_debut'] = $exon['date_debut'];
                            $data2['date_fin'] = $exon['date_fin'];
                            $data2['client_id'] = $id;
                            //debug($data2);die;

                            $document = $exon['documenttt'];
                            //  debug($document);

                            $name = $document->getClientFilename();
                            //debug($name);

                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $exonerations->document = $name;
                            }
                            // debug($data2);

                            $exonerations = $this->fetchTable('Clientexonerations')->patchEntity($exonerations, $data2);

                            $this->fetchTable('Clientexonerations')->save($exonerations);
                        } else if ($exon['sup2'] == 1 && !empty($exon['id'])) {
                            $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientexonerations')->delete($exonerations);
                        }
                    }
                }
                $this->set(compact('exonerations'));

                //$this->Flash->success(__('The client has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            //   $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }



        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $this->loadModel('Clientexonerations');
        $this->loadModel('Articles');
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }
        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }

        //$articless = $this->Tarifs->Articles->find('all')->where([$cond100]);
        $articless = $this->Tarifs->Articles->find('all')->where(["Articles.vente=1"]);


        //$ar = array();
        // $i=0;
        /* foreach ($articles as $ar) {

          $ar = $articles;
          } */
        //debug($ar);
        $typeexonerations[1] = 'exonore';
        $typeexonerations[2] = 'non exonore';
        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
        $exoclients = $this->fetchTable('Clientexonerations')->find('all', ['keyfield' => 'id'])->where(["Clientexonerations.client_id = " . $id . ""]);;
        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');
        $this->loadModel('Localites');

        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $client['gouvernorat_id'] . '"']);
        $i = 0;
        $tab = array();
        foreach ($del as $i => $tab) {
            $tab = $del;
        }
        //debug($tab);
        //        $deleg=$this->Delegations->find()->select(['Delegations.name'])
        //                ->where(['Delegations.id  in (' . $tab . ')']);
        if ($tab != array()) {
            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(['Delegations.id  in (' . $tab . ')']);
        } else {
            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        }



        // debug($deleg) ;    

        $loc = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)'])->where(['id_deleg  ="' . $client['delegation_id'] . '"']);
        $j = 0;
        $tab1 = array();
        foreach ($loc as $j => $tab1) {
            $tab1 = $loc;
        }
        if ($tab1 != array()) {
            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(['Localites.id  in (' . $tab1 . ')']);
        } else {
            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        }


        $clientdoc = $this->fetchTable('Clientdocuments')->find('all')
            ->where(["Clientdocuments.client_id = " . $id . ""]);





        $exoner = $this->Clientexonerations->find('all')->where(["Clientexonerations.client_id = " . $id . ""]);
        $this->loadModel('Clientarticles');
        $clientarticles = $this->Clientarticles->find('all')->where(["Clientarticles.client_id = " . $id . ""]);
        //debug($clientarticles);
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //$gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();

        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //$typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();

        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $this->loadModel('Typeexons');

        $type = $this->fetchTable('Typeexons')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $cli = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        // ->where(["Clients.etat " => 'TRUE'])
        // ->where(['Clients.nouveau_client="FALSE"']);

        $bureaupostes = $this->fetchTable('Bureaupostes')->find('list', ['valueField' => 'codepostal'])->where(["Bureaupostes.gouvernorat_id = " . $client->gouvernorat_id . ""]);
        // debug($bureaupostes);
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $types = $this->fetchTable('Types')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('pays', 'clientdoc', 'types', 'articless', 'bureaupostes', 'cli', 'ar', 'localite', 'deleg', 'gouvernorats', 'type', 'tab', 'articles', 'clientarticles', 'exoner', 'gouvernorats', 'pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
    }

    public function index01082024()
    {
        $query = $this->Clients->find('all');
        $this->paginate = [
            'maxLimit' => 5500,
            'limit' => 3000,
            'order' => ['Code' => 'desc'] // Specify the order condition here
        ];
        $clients = $this->paginate($query);
        $this->set(compact("clients"));

        //print_r($clients);
    }
    public function index()
    {
        // Assurez-vous que les erreurs de niveau E_ERROR et E_PARSE sont reportées
        error_reporting(E_ERROR | E_PARSE);

        // Récupérer l'ID de l'utilisateur actuel
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->get($user_id);

        // Récupérer le paramètre client_id de la requête GET
        $client_id = $this->request->getQuery('client_id');

        // Construire les conditions de recherche pour la requête
        $conditions = [];
        if ($client_id) {
            $conditions['Clients.id'] = $client_id;
        }

        // Construire la requête pour récupérer les clients
        $query = $this->Clients->find('all')
            ->where($conditions)
            ->order(['Code' => 'desc']); // Ajouter un ordre par 'Code' en descendant

        // Configurer la pagination
        $this->paginate = [
            'maxLimit' => 5500,
            'limit' => 3000,
        ];

        // Paginer les résultats
        $clients = $this->paginate($query);
        $this->Clients = $this->loadModel('Clients');
        $clients = $this->Clients->find('all')
            ->select(['id', 'Code', 'Raison_Sociale'])
            ->order(['Code' => 'asc'])
            ->toArray();

        $clientOptionsCode = [];
        $clientOptionsRaison = [];

        // Préparez les options pour les deux menus déroulants
        foreach ($clients as $client) {
            $clientOptionsCode[$client->id] = $client->Code;
            $clientOptionsRaison[$client->id] = $client->Raison_Sociale;
        }


        $this->set(compact(
            'client_id',
            'clients',
            'clientss',
            'clientOptionsCode',
            'clientOptionsRaison'
        ));
    }

    /**
     * View method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    //    public function view($id = null) {
    //        $this->loadModel('Clientarticles');
    //        //debug($this->request->getData());
    //        $client = $this->Clients->get($id, [
    //            'contain' => [],
    //        ]);
    //
    //        if ($this->request->is(['patch', 'post', 'put'])) {
    //
    //            $client = $this->Clients->patchEntity($client, $this->request->getData());
    //
    //            if ($this->Clients->save($client)) {
    //                //debug($this->request->getData());die;
    //                $this->misejour("Clients", "edit", $id);
    //
    //                if (isset($this->request->getData('data')['prixarticle']) && (!empty($this->request->getData('data')['prixarticle']))) {
    //                    foreach ($this->request->getData('data')['prixarticle'] as $j => $p) {
    //
    //                        //die;
    //
    //                        if ($p['supprix'] != 1) {
    //
    //
    //                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
    //                            $data['article_id'] = $p['article_id'];
    //                            $data['prix'] = $p['prix'];
    //                            $data['client_id'] = $id;
    //
    //                            // debug($data);
    //                            //    debug($p);
    //                            if (isset($p['id']) && (!empty($p['id']))) {
    //
    //                                $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
    //                                    'contain' => []
    //                                ]);
    //                            } else {
    //                                $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
    //                            };
    //                            $clientarticle = $this->fetchTable('Clientarticles')->patchEntity($clientarticle, $data);
    //                            $this->fetchTable('Clientarticles')->save($clientarticle);
    //                        } else if ($p['supprix'] == 1 && !empty($p['id'])) {
    //
    //                            $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
    //                                'contain' => []
    //                            ]);
    //                            $this->fetchTable('Clientarticles')->delete($clientarticle);
    //                        }
    //                    }
    //                }
    //
    //
    //
    //
    //
    //
    //
    //                if (isset($this->request->getData('data')['adresse']) && (!empty($this->request->getData('data')['adresse']))) {
    //                    foreach ($this->request->getData('data')['adresse'] as $i => $b) {
    //
    //
    //                        if ($b['supadresse'] != 1) {
    //
    //
    //                            $adresseliv = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
    //                            $data['adresse'] = $b['adresse'];
    //                            $data['client_id'] = $id;
    //
    //                            //debug($dat);
    //                            if (isset($b['id']) && (!empty($b['id']))) {
    //
    //                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
    //                                    'contain' => []
    //                                ]);
    //                            } else {
    //                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
    //                            };
    //                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->patchEntity($adresselivraisonclient, $data);
    //
    //
    //                            $this->fetchTable('Adresselivraisonclients')->save($adresselivraisonclient);
    //                        } else if ($b['supadresse'] == 1 && !empty($b['id'])) {
    //                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
    //                                'contain' => []
    //                            ]);
    //                            $this->fetchTable('Adresselivraisonclients')->delete($adresselivraisonclient);
    //                        }
    //                    }
    //                }
    //
    //
    //
    //
    //
    //                if (isset($this->request->getData('data')['banque']) && (!empty($this->request->getData('data')['banque']))) {
    //                    foreach ($this->request->getData('data')['banque'] as $i => $b) {
    //                        // debug($b);die;
    //
    //                        if ($b['supbanque'] != 1) {
    //
    //
    //                            $datee['banque_id'] = $b['banque_id'];
    //                            $datee['agence'] = $b['agence'];
    //                            $datee['code_banque'] = $b['code_banque'];
    //                            $datee['swift'] = $b['swift'];
    //                            $datee['compte'] = $b['compte'];
    //                            $datee['rib'] = $b['rib'];
    //                            $datee['client_id'] = $id;
    //                            $document = $b['documen'];
    //                            $name = $document->getClientFilename();
    //                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
    //                            if (!empty($name)) {
    //                                $document->moveTo($targetPath);
    //                                $clientbanque->document = $name;
    //                            }
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //
    //                            //debug($dat);
    //                            if (isset($b['id']) && (!empty($b['id']))) {
    //
    //                                $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
    //                                    'contain' => []
    //                                ]);
    //                            } else {
    //                                $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
    //                            };
    //                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);
    //
    //
    //                            $this->fetchTable('Clientbanques')->save($clientbanque);
    //                        } else if ($b['supbanque'] == 1 && !empty($b['id'])) {
    //                            $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
    //                                'contain' => []
    //                            ]);
    //                            $this->fetchTable('Clientbanques')->delete($clientbanque);
    //                        }
    //                    }
    //                }
    //
    //
    //
    //
    //
    //
    //                if (isset($this->request->getData('data')['responsable']) && (!empty($this->request->getData('data')['responsable']))) {
    //                    foreach ($this->request->getData('data')['responsable'] as $i => $b) {
    //                        //debug($b);
    //
    //
    //                        if ($b['supresponsable'] != 1) {
    //
    //
    //
    //
    //
    //
    //
    //
    //                            $dataa['name'] = $b['name'];
    //                            $dataa['mail'] = $b['mail'];
    //                            $dataa['tel'] = $b['tel'];
    //                            $dataa['poste'] = $b['poste'];
    //                            $dataa['client_id'] = $client->id;
    //
    //                            //debug($dat);
    //                            if (isset($b['id']) && (!empty($b['id']))) {
    //
    //                                $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
    //                                    'contain' => []
    //                                ]);
    //                            } else {
    //                                $clientresponsable = $this->fetchTable('Clientresponsables')->newEmptyEntity();
    //                            };
    //                            $clientresponsable = $this->fetchTable('Clientresponsables')->patchEntity($clientresponsable, $dataa);
    //
    //
    //
    //                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
    //                        } else if ($b['supresponsable'] == 1 && !empty($b['id'])) {
    //                            $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
    //                                'contain' => []
    //                            ]);
    //                            $this->fetchTable('Clientresponsables')->delete($clientresponsable);
    //                        }
    //                    }
    //                }
    //
    //
    //                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
    //
    //                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
    //                        //debug($exon);
    //                        $this->loadModel('Clientexonerations');
    //                        if ($exon['sup2'] != 1) {
    //                            $data2['typeexon_id'] = $exon['typeexon_id'];
    //                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
    //                            $data2['date_debut'] = $exon['date_debut'];
    //                            $data2['date_fin'] = $exon['date_fin'];
    //                            $data2['client_id'] = $id;
    //                            //debug($data2);die;
    //
    //                            $document = $exon['documenttt'];
    //
    //                            $name = $document->getClientFilename();
    //
    //                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
    //                            if (!empty($name)) {
    //                                $document->moveTo($targetPath);
    //                                $exonerations->document = $name;
    //                            }
    //                            // debug($data2);
    //                            if (isset($exon['id']) && (!empty($exon['id']))) {
    //
    //                                $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
    //                                    'contain' => []
    //                                ]);
    //                            } else {
    //
    //                                $exonerations = $this->fetchTable('Clientexonerations')->newEmptyEntity();
    //                            };
    //                            $exonerations = $this->fetchTable('Clientexonerations')->patchEntity($exonerations, $data2);
    //                            //debug($exonerations);
    //                            $this->fetchTable('Clientexonerations')->save($exonerations);
    //                            //debug($exonerations);
    //                        } else if ($exon['sup2'] == 1 && !empty($exon['id'])) {
    //                            $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
    //                                'contain' => []
    //                            ]);
    //                            $this->fetchTable('Clientexonerations')->delete($exonerations);
    //                        }
    //                    }
    //                }
    //                $this->set(compact("exonerations"));
    //
    //                //$this->Flash->success(__('The client has been saved.'));
    //                return $this->redirect(['action' => 'index']);
    //            }
    //
    //            //   $this->Flash->error(__('The client could not be saved. Please, try again.'));
    //        }
    //
    //
    //
    //        $this->loadModel('Tarifs');
    //        $this->loadModel('Articles');
    //        $this->loadModel('Clientexonerations');
    //        $this->loadModel('Articles');
    //        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
    //        $dett = '0';
    //        foreach ($fam as $f) {
    //            //debug($f); //die;
    //            $dett = $dett . ',' . $f->id;
    //        }
    //        // $dett=implode(',',$fam);
    //        //debug($dett); //die;
    //        if ($dett != '') {
    //            $cond100 = 'Articles.famille_id in (' . $dett . ')';
    //        }
    //
    //        $articles = $this->Tarifs->Articles->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation'])->where([$cond100]);
    //
    //
    //
    //        $ar = array();
    //        // $i=0;
    //        foreach ($articles as $ar) {
    //
    //            $ar = $articles;
    //        }
    //        $cli = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
    //              //  ->where(['Clients.nouveau_client="FALSE"']);
    //        $typeexonerations[1] = 'exonore';
    //        $typeexonerations[2] = 'non exonore';
    //        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
    //        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
    //        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
    //        $exoclients = $this->fetchTable('Clientexonerations')->find('all', ['keyfield' => 'id'])->where(["Clientexonerations.client_id = " . $id . ""]);
    //        ;
    //        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
    //        $this->loadModel('Basepostes');
    //        $this->loadModel('Delegations');
    //        $this->loadModel('Localites');
    //
    //        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $client['gouvernorat_id'] . '"']);
    //        $i = 0;
    //        $tab = array();
    //        foreach ($del as $i => $tab) {
    //            $tab = $del;
    //        }
    //        //debug($tab);
    ////        $deleg=$this->Delegations->find()->select(['Delegations.name'])
    ////                ->where(['Delegations.id  in (' . $tab . ')']);
    //        if ($tab != array()) {
    //            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
    //                    ->where(['Delegations.id  in (' . $tab . ')']);
    //        } else {
    //            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
    //            ;
    //        }
    //
    //
    //
    //        // debug($deleg) ;    
    //
    //        $loc = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)'])->where(['id_deleg  ="' . $client['delegation_id'] . '"']);
    //        $j = 0;
    //        $tab1 = array();
    //        foreach ($loc as $j => $tab1) {
    //            $tab1 = $loc;
    //        }
    //        if ($tab1 != array()) {
    //            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
    //                    ->where(['Localites.id  in (' . $tab1 . ')']);
    //        } else {
    //            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
    //        }
    //
    //
    //
    //
    //
    //
    //        $exoner = $this->Clientexonerations->find('all')->where(["Clientexonerations.client_id = " . $id . ""]);
    //        $this->loadModel('Clientarticles');
    //        $clientarticles = $this->Clientarticles->find('all')->where(["Clientarticles.client_id = " . $id . ""]);
    //        //debug($clientarticles);
    //        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
    //        //$gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
    //
    //        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
    ////        $typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
    //
    //        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
    //        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
    //        $this->loadModel('Typeexons');
    //
    //        $type = $this->fetchTable('Typeexons')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
    //
    //        $bureaupostes = $this->fetchTable('Bureaupostes')->find('list', ['valueField' => 'codepostal'])->where(["Bureaupostes.gouvernorat_id = " . $client->gouvernorat_id . ""])
    //        ;
    //        // debug($bureaupostes);
    //        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
    //        $this->set(compact('bureaupostes', 'cli', 'ar', 'localite', 'deleg', 'gouvernorats', 'type', 'tab', 'articles', 'clientarticles', 'exoner', 'gouvernorats', 'pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
    //    }
    //    public function view($id = null) {
    //        
    //        
    //        
    //        
    //        
    //        
    //        
    //        
    //        
    //        
    //        
    //        
    //        $client = $this->Clients->get($id, [
    //            'contain' => ['Commercials', 'Gouvernorats', 'Adresselivraisonclients', 'Bondereservations', 'Bonlivraisons', 'Clientbanques', 'Clientexonerations', 'Clientfourchettes', 'Clientresponsables', 'Commandeclients', 'Factureclients', 'Fourchettes'],
    //        ]);
    //        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
    //        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
    //        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
    //        //  debug($banquess);
    //
    //        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
    //
    //        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
    //        $typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
    //
    //        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
    //        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
    //
    //
    //        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
    //        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'Description'])->all();
    //        $this->set(compact('pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
    //    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function addclient($index = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_prévisionnement' . $abrv);
        $client = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'clients') {
                $client = $liens['ajout'];
            }
        }
        if (($client <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        // $this->loadModel('Clients');
        $num = $this->Clients->find()->select([
            "num" =>
                'MAX(Clients.codeclient)'
        ])->first();
        $numero = $num->num;

        if ($numero != null) {

            $currentNumber = intval(substr($numero, 1, 5));

            $newNumber = $currentNumber + 1;

            $formattedNumber = str_pad((string) $newNumber, 5, '0', STR_PAD_LEFT);


            $code = 'C' . $formattedNumber;
        } else {
            $code = "C00001";
        }

        // echo $code;
        // $dhouha = $prospect_id;
        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['nom'] = $this->request->getData('nom');
            $data['Raison_Sociale'] = $this->request->getData('Raison_Sociale');
            $data['client'] = $this->request->getData('prospect_id');
            $data['codeclient'] = $this->request->getData('codeclient');
            $data['fournisseur'] = $this->request->getData('fournisseur');
            $data['codefr'] = $this->request->getData('codefr');
            $data['etat'] = $this->request->getData('etat');
            $data['Adresse'] = $this->request->getData('Adresse');
            $data['Code_Ville'] = $this->request->getData('Code_Ville');
            $data['pay_id'] = $this->request->getData('pay_id');
            $data['gouvernorat_id'] = $this->request->getData('gouvernorat_id');
            $data['Tel'] = $this->request->getData('Tel');
            $data['Fax'] = $this->request->getData('Fax');
            $data['modalite'] = $this->request->getData('modalite');
            $data['Contact'] = $this->request->getData('Contact');
            $data['RC'] = $this->request->getData('RC');
            $data['Matricule_Fiscale'] = $this->request->getData('Matricule_Fiscale');
            $data['codedouane'] = $this->request->getData('codedouane');
            $data['BAN'] = $this->request->getData('BAN');
            $data['R_TVA'] = $this->request->getData('R_TVA');
            $data['numerotva'] = $this->request->getData('numerotva');
            $data['typetiers'] = $this->request->getData('typetier_id');
            $data['salaris'] = $this->request->getData('salari_id');
            $data['typeentite'] = $this->request->getData('typeentite_id');
            $data['Capital'] = $this->request->getData('Capital');
            $data['incoterms'] = $this->request->getData('incoterm_id');
            $data['devise_id'] = $this->request->getData('devise_id');
            $data['port'] = $this->request->getData('port');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $logo = $this->request->getData('logo');
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
            if ($name) {
                $logo->moveTo($targetPath);
                $data['logo'] = $name;
            }
            $client = $this->Clients->patchEntity($client, $data);
            if ($this->Clients->save($client)) {
                $this->loadModel('Modalites');
                $client_id = $client->id;
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    foreach ($this->request->getData('data')['tabligne3'] as $i => $l) {
                        if (isset($client_id)) {
                            $ta = $this->fetchTable('Modalites')->newEmptyEntity();
                            $ta['client_id'] = $client_id;
                            $ta['paiement_id'] = $l['paiement_id'];
                            $ta['duree'] = $l['duree'];
                            $this->fetchTable('Modalites')->save($ta);
                        }
                    }
                }

                $this->loadModel('Tags');
                $client_id = $client->id;
                if ((!empty($this->request->getData('tag_id')))) {
                    $this->loadModel('Tags');
                    foreach ($this->request->getData('tag_id') as $j => $l) {
                        $tags = $this->fetchTable('Tags')->newEmptyEntity();
                        $dataa['client_id'] = $client_id;
                        $dataa['listetag_id'] = $l;
                        $tags = $this->Tags->patchEntity($tags, $dataa);
                        $this->Tags->save($tags);
                    }
                }
                // $this->loadModel('Clients');
                $id = $client->id;
                $clients = $this->Clients->query('SELECT clients.id id, clients.nom name from clients');
                $select = "<select   name='data[lignec][" . $index . "][nameC]' class='form-control'  champ='nameC' id='nameC" . $index . "' style = 'text-align:left'>";
                $select = $select . "<option value=''></option>";
                foreach ($clients as $cl) {
                    if ($cl['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $cl['id'] . " " . $selected . " >" . $cl['nom'] . " </option>";
                }
                $select = $select . '</select>';
                ?>
                <script>
                    //  aler                t(); 
                    //   var select = "<? php// echo $select;        ?>"; 
                    window.opener.document.getElementById('cliselect<?php echo $index; ?>').innerHTML = "<?php echo $select; ?>";
                    window.close();
                </script>
                <?php
            }
        }
        $this->loadModel('Gouvernorats');
        $this->loadModel('Pays');
        $this->loadModel('Devises');
        $this->loadModel('Personnels');
        $this->loadModel('Typetiers');
        $this->loadModel('Salaris');
        $this->loadModel('Typeentites');
        $this->loadModel('Incoterms');
        $this->loadModel('Prospects');
        $this->loadModel('Paiements');
        $this->loadModel('Listetags');
        $tags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $prospects = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code'])->all();
        $typeentites = $this->fetchTable('Typeentites')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $salaris = $this->fetchTable('Salaris')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typetiers = $this->fetchTable('Typetiers')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $commercials = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9])->all();
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find('all')->where(['id' => $user_id])->first();
        $personnel_id = $user->personnel_id;
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        // $typoo = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where('Prospects.id =' . $prospect_id);
        // foreach ($typoo as $typ) {
        //     $dd = $typ;
        // }
        $this->set(compact('code', 'paiements', 'personnel_id', 'dd', 'client', 'dhouha', 'gouvernorats', 'pays', 'devises', 'commercials', 'tags', 'typetiers', 'salaris', 'typeentites', 'incoterms', 'prospects'));
    }
    public function addcli()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_prévisionnement' . $abrv);
        $client = 0;
        foreach ($liendd as $k => $liens) {
            if (@$liens['lien'] == 'clients') {
                $client = $liens['ajout'];
            }
        }
        if (($client <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        // $this->loadModel('Clients');
        $num = $this->Clients->find()->select([
            "num" =>
                'MAX(Clients.codeclient)'
        ])->first();
        $numero = $num->num;

        if ($numero != null) {

            $currentNumber = intval(substr($numero, 1, 5));

            $newNumber = $currentNumber + 1;

            $formattedNumber = str_pad((string) $newNumber, 5, '0', STR_PAD_LEFT);


            $code = 'C' . $formattedNumber;
        } else {
            $code = "C00001";
        }

        // echo $code;
        // $dhouha = $prospect_id;
        $client = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {
            $data['nom'] = $this->request->getData('nom');
            $data['Raison_Sociale'] = $this->request->getData('Raison_Sociale');
            $data['client'] = $this->request->getData('prospect_id');
            $data['codeclient'] = $this->request->getData('codeclient');
            $data['fournisseur'] = $this->request->getData('fournisseur');
            $data['codefr'] = $this->request->getData('codefr');
            $data['etat'] = $this->request->getData('etat');
            $data['Adresse'] = $this->request->getData('Adresse');
            $data['Code_Ville'] = $this->request->getData('Code_Ville');
            $data['pay_id'] = $this->request->getData('pay_id');
            $data['gouvernorat_id'] = $this->request->getData('gouvernorat_id');
            $data['Tel'] = $this->request->getData('Tel');
            $data['Fax'] = $this->request->getData('Fax');
            $data['modalite'] = $this->request->getData('modalite');
            $data['Contact'] = $this->request->getData('Contact');
            $data['RC'] = $this->request->getData('RC');
            $data['Matricule_Fiscale'] = $this->request->getData('Matricule_Fiscale');
            $data['codedouane'] = $this->request->getData('codedouane');
            $data['BAN'] = $this->request->getData('BAN');
            $data['R_TVA'] = $this->request->getData('R_TVA');
            $data['numerotva'] = $this->request->getData('numerotva');
            $data['typetiers'] = $this->request->getData('typetier_id');
            $data['salaris'] = $this->request->getData('salari_id');
            $data['typeentite'] = $this->request->getData('typeentite_id');
            $data['Capital'] = $this->request->getData('Capital');
            $data['incoterms'] = $this->request->getData('incoterm_id');
            $data['devise_id'] = $this->request->getData('devise_id');
            $data['port'] = $this->request->getData('port');
            $data['commercial_id'] = $this->request->getData('commercial_id');
            $logo = $this->request->getData('logo');
            $name = $logo->getClientFilename();
            $targetPath = WWW_ROOT . 'img' . DS . 'logoclients' . DS . $name;
            if ($name) {
                $logo->moveTo($targetPath);
                $data['logo'] = $name;
            }
            $client = $this->Clients->patchEntity($client, $data);
            if ($this->Clients->save($client)) {
                $this->loadModel('Modalites');
                $client_id = $client->id;
                if (isset($this->request->getData('data')['tabligne3']) && (!empty($this->request->getData('data')['tabligne3']))) {
                    foreach ($this->request->getData('data')['tabligne3'] as $i => $l) {
                        if (isset($client_id)) {
                            $ta = $this->fetchTable('Modalites')->newEmptyEntity();
                            $ta['client_id'] = $client_id;
                            $ta['paiement_id'] = $l['paiement_id'];
                            $ta['duree'] = $l['duree'];
                            $this->fetchTable('Modalites')->save($ta);
                        }
                    }
                }

                $this->loadModel('Tags');
                $client_id = $client->id;
                if ((!empty($this->request->getData('tag_id')))) {
                    $this->loadModel('Tags');
                    foreach ($this->request->getData('tag_id') as $j => $l) {
                        $tags = $this->fetchTable('Tags')->newEmptyEntity();
                        $dataa['client_id'] = $client_id;
                        $dataa['listetag_id'] = $l;
                        $tags = $this->Tags->patchEntity($tags, $dataa);
                        $this->Tags->save($tags);
                    }
                }
                // $this->loadModel('Clients');
                $id = $client->id;
                $clients = $this->Clients->query('SELECT clients.id id, clients.Raison_Sociale name from clients');
                $select = "<select   name='data[Clients][client_id]' class='form-control'  champ='client_id' id='client_id' style = 'text-align:right'>";
                $select = $select . "<option value=''></option>";
                foreach ($clients as $cl) {
                    if ($cl['id'] == $id) {
                        $selected = "selected";
                    } else {
                        $selected = "";
                    }
                    $select = $select . "<option value=" . $cl['id'] . " " . $selected . " >" . $cl['Raison_Sociale'] . " </option>";
                }
                $select = $select . '</select>';
                ?>
                <script>

                    window.opener.document.getElementById('client_id').innerHTML = "<?php echo $select; ?>";
                    window.close();
                </script>
                <?php
            }
        }
        $this->loadModel('Gouvernorats');
        $this->loadModel('Pays');
        $this->loadModel('Devises');
        $this->loadModel('Personnels');
        $this->loadModel('Typetiers');
        $this->loadModel('Salaris');
        $this->loadModel('Typeentites');
        $this->loadModel('Incoterms');
        $this->loadModel('Prospects');
        $this->loadModel('Paiements');
        $this->loadModel('Listetags');
        $tags = $this->fetchTable('Listetags')->find('list', ['keyfield' => 'id', 'valueField' => 'tag'])->all();
        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $prospects = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $incoterms = $this->fetchTable('Incoterms')->find('list', ['keyfield' => 'id', 'valueField' => 'code'])->all();
        $typeentites = $this->fetchTable('Typeentites')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $salaris = $this->fetchTable('Salaris')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typetiers = $this->fetchTable('Typetiers')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $commercials = $this->fetchTable('Personnels')->find('list', ['keyfield' => 'id', 'valueField' => 'nom'])->where(['fonction_id' => 9])->all();
        $user_id = $this->request->getAttribute('identity')->id;
        $user = $this->fetchTable('Users')->find('all')->where(['id' => $user_id])->first();
        $personnel_id = $user->personnel_id;
        $devises = $this->fetchTable('Devises')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $gouvernorats = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        // $typoo = $this->fetchTable('Prospects')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->where('Prospects.id =' . $prospect_id);
        // foreach ($typoo as $typ) {
        //     $dd = $typ;
        // }
        $this->set(compact('code', 'paiements', 'personnel_id', 'dd', 'client', 'dhouha', 'gouvernorats', 'pays', 'devises', 'commercials', 'tags', 'typetiers', 'salaris', 'typeentites', 'incoterms', 'prospects'));
    }
 
    public function add()
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'clients') {
                $societe = $liens['ajout'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        //  $clients = $this->Clients->find()->last(); debug($clients);die;
        $this->loadModel('Typeexons');
        $this->loadModel('Delegations');
        $this->loadModel('Localites');
        $client = $this->Clients->newEmptyEntity();

       /* $prefix = "4113"; 
        $numeroobj = $this->Clients->find()->select(["numerox" => 'MAX(Clients.Code)'])->first();
        $lastCode = $numeroobj ? $numeroobj->numerox : null;

        if ($lastCode !== null) {
            $lastCodeAsString = strval($lastCode); 
            $lastNumber = intval(substr($lastCodeAsString, strlen($prefix))); 
            $newNumber = $lastNumber + 1;
            $code = $prefix . str_pad((string)$newNumber, 4, "0", STR_PAD_LEFT);
        } else {
            $code = $prefix . "0001";
        }*/


        $prefix = "4113"; 
        $maxLimit = $prefix . "9999"; // Limite supérieure 41199999
        
        // Rechercher le plus grand Code qui est en dessous de la limite
        $numeroobj = $this->Clients->find()
            ->select(["numerox" => 'MAX(Clients.Code)'])
            ->where(["Clients.Code <" => $maxLimit]) // Exclure les codes >= 41199999
            ->first();
        
        $lastCode = $numeroobj ? $numeroobj->numerox : null;
        
        if ($lastCode !== null) {
            $lastCodeAsString = strval($lastCode); // Convertir $lastCode en chaîne
            $lastNumber = intval(substr($lastCodeAsString, strlen($prefix))); // Extraire la partie numérique
            $newNumber = $lastNumber + 1;
            $code = $prefix . str_pad((string)$newNumber, 4, "0", STR_PAD_LEFT);
        } else {
            $code = $prefix . "0001";
        }
        

        

        // Now $newCode contains the desired serial number as a string
        // Use $newCode as needed in your application


        if ($this->request->is('post')) {


            /*$prefix = "4113"; // Définissez le préfixe
            $numeroobj = $this->Clients->find()->select(["numerox" => 'MAX(Clients.Code)'])->first();
            $lastCode = $numeroobj ? $numeroobj->numerox : null;

            if ($lastCode !== null) {
                $lastCodeAsString = strval($lastCode); // Convertir $lastCode en une chaîne de caractères
                $lastNumber = intval(substr($lastCodeAsString, strlen($prefix))); // Extraire la partie numérique
                $newNumber = $lastNumber + 1;
                $code = $prefix . str_pad((string)$newNumber, 4, "0", STR_PAD_LEFT);
            } else {
                $code = $prefix . "0001";
            }*/
            $prefix = "4113"; 
            $maxLimit = $prefix . "9999"; // Limite supérieure 41199999
            
            // Rechercher le plus grand Code qui est en dessous de la limite
            $numeroobj = $this->Clients->find()
                ->select(["numerox" => 'MAX(Clients.Code)'])
                ->where(["Clients.Code <" => $maxLimit]) // Exclure les codes >= 41199999
                ->first();
            
            $lastCode = $numeroobj ? $numeroobj->numerox : null;
            
            if ($lastCode !== null) {
                $lastCodeAsString = strval($lastCode); // Convertir $lastCode en chaîne
                $lastNumber = intval(substr($lastCodeAsString, strlen($prefix))); // Extraire la partie numérique
                $newNumber = $lastNumber + 1;
                $code = $prefix . str_pad((string)$newNumber, 4, "0", STR_PAD_LEFT);
            } else {
                $code = $prefix . "0001";
            }
            
            // Affichage ou utilisation du nouveau code
           // echo "Nouveau Code Client : " . $code;
            
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            $client->Code = $code;
            //debug($this->request->getData('data')['lignes']);die;
            if ($this->Clients->save($client)) {

                /*********************************************** **************************************************/
                $datainsert['inserted'] = '1';
                $cl = $this->fetchTable('Clients')->patchEntity($client, $datainsert);
                $this->Clients->save($cl);
                /*********************************************** **************************************************/

                //debug($cl);die;

                // debug($client);
                $this->misejour("Clients", "add", $client->id);
                $id = $client->id;
                if ($id < 10000) {
                    $id = '0' . $id;
                }

                $client->compte_comptable = '411' . $id;
                $this->Clients->save($client);
                //debug($client);
                //debug($this->request->getData());
                if (isset($this->request->getData('data')['prixarticle']) && (!empty($this->request->getData('data')['prixarticle']))) {
                    foreach ($this->request->getData('data')['prixarticle'] as $j => $p) {
                        //debug($p['prix']);die;
                        //die;

                        if ($p['supprix'] != 1) {
                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();

                            //debug($clientarticle);
                            $data['article_id'] = $p['article'];
                            $data['prix'] = $p['prix'];
                            $data['client_id'] = $id;
                            $clientarticle = $this->fetchTable('Clientarticles')->patchEntity($clientarticle, $data);
                            //debug($clientarticle);
                            if ($this->fetchTable('Clientarticles')->save($clientarticle)) {

                                $insert['inserted'] = '1';
                                $ca = $this->fetchTable('Clientarticles')->patchEntity($clientarticle, $insert);
                                $this->fetchTable('Clientarticles')->save($ca);

                                //    debug($ca);
                                //     die;
                            }
                        }
                    }
                }





                if (isset($this->request->getData('data')['banque']) && (!empty($this->request->getData('data')['banque']))) {
                    foreach ($this->request->getData('data')['banque'] as $i => $b) {
                        //  debug($b);
                        //die;
                        if ($b['supbanque'] != 1) {
                            $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['client_id'] = $id;
                            $document = $b['documen'];
                            //   debug($document);
                            $namedoc = $document->getClientFilename();
                            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . $namedoc;
                            //                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($namedoc)) {
                                $document->moveTo($targetPath);
                                $clientbanque->document = $namedoc;
                            }
                            // debug($namedoc);








                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);


                            $this->fetchTable('Clientbanques')->save($clientbanque);
                            //debug($clientbanque);die;
                        }
                    }
                }



                if (isset($this->request->getData('data')['adresse']) && (!empty($this->request->getData('data')['adresse']))) {
                    foreach ($this->request->getData('data')['adresse'] as $i => $b) {


                        if ($b['supadresse'] != 1) {


                            $adresseliv = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
                            $data['adresse'] = $b['adresse'];
                            $data['client_id'] = $id;

                            $adresseliv = $this->fetchTable('Adresselivraisonclients')->patchEntity($adresseliv, $data);

                            $this->fetchTable('Adresselivraisonclients')->save($adresseliv);
                        }
                    }
                }


                if (isset($this->request->getData('data')['responsable']) && (!empty($this->request->getData('data')['responsable']))) {
                    foreach ($this->request->getData('data')['responsable'] as $i => $b) {
                        //  debug($b);


                        if ($b['supresponsable'] != 1) {


                            $clientresponsable = $this->fetchTable('Clientresponsables')->newEmptyEntity();
                            $dataa['name'] = $b['name'];
                            $dataa['mail'] = $b['mail'];
                            $dataa['tel'] = $b['télèphone'];
                            $dataa['poste'] = $b['poste'];
                            $dataa['client_id'] = $id;
                            $clientresponsable = $this->fetchTable('Clientresponsables')->patchEntity($clientresponsable, $dataa);
                            // debug($clientresponsable);die;

                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
                        }
                    }
                }

                if (isset($this->request->getData('data')['document']) && (!empty($this->request->getData('data')['document']))) {
                    foreach ($this->request->getData('data')['document'] as $i => $doc) {
                        // debug($doc);
                        if ($doc['suprdoc'] != 1) {

                            $docclients = $this->fetchTable('Clientdocuments')->newEmptyEntity();
                            $dataa['name'] = $doc['name'];
                            $dataa['client_id'] = $id;
                            $document = $doc['fichier'];

                            $namedoc = $document->getClientFilename();
                            //debug($namedoc) ; 
                            $targetPath = WWW_ROOT . 'img' . DS . 'logo' . $namedoc;

                            if (!empty($namedoc)) {
                                $document->moveTo($targetPath);
                                //debug($document) ; 
                                $docclients->fichier = $namedoc;
                                //  debug($docclients->fichier);
                            }


                            $docclients = $this->fetchTable('Clientdocuments')->patchEntity($docclients, $dataa);
                            //

                            $this->fetchTable('Clientdocuments')->save($docclients);
                            //  debug($docclients);
                        }
                    }
                }







                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                    $this->loadModel('Clientexonerations');
                    // debug($this->request->getData('data')['lignes']);die;
                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                        // debug($exon); die;
                        if ($exon['sup2'] != 1) {
                            $data2['typeexon_id'] = $exon['typeexon_id'];
                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
                            $data2['date_debut'] = $exon['date_debut'];
                            $data2['date_fin'] = $exon['date_fin'];
                            $data2['client_id'] = $id;
                            $exonerations = $this->fetchTable('Clientexonerations')->newEmptyEntity();
                            $documenttt = $exon['documenttt'];
                            //   debug($document);
                            $namedoc = $documenttt->getClientFilename();
                            /* if (!is_dir(WWW_ROOT . 'img' . DS . 'user-img'))
                              mkdir(WWW_ROOT . 'img' . DS . 'user-img', 0775); */
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . $namedoc;
                            //                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($namedoc)) {
                                $documenttt->moveTo($targetPath);
                                $exonerations->document = $namedoc;
                            }
                            $exonerations = $this->Clientexonerations->patchEntity($exonerations, $data2);
                            // debug($exonerations);

                            $this->Clientexonerations->save($exonerations);
                            //  debug($exonerations);die;
                            $this->set(compact("exonerations"));
                            //   debug($exonerations);die;
                        }
                    }
                }


                return $this->redirect(['action' => 'index']);
            }
        }
        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        // $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();

        //$delegations = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //debug($clien);
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente = 1 "]);
        //debug($fam);
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }
        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {


            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }
        //  $articles = $this->Tarifs->Articles->find('all')->where([$cond100]);
        $articles = $this->Tarifs->Articles->find('all')->where(['Articles.vente=1']);

        $ar = array();
        // $i=0;
        foreach ($articles as $ar) {
            $ar = $articles;
        }

        // debug($ar);die;
        //        $articles = $this->fetchTable('Articles')->find('list', ['keyfield' => 'id', 'valueField' => 'Dsignation']);
        //        $tab = array();
        //
        //        foreach ($articles as $tab) {
        //            $tab = $articles;
        //        }
        //debug($tab);
        $typeexonerations[1] = 'exonore';
        $typeexonerations[2] = 'non exonore';

        //$localites = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //  $typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $type = $this->fetchTable('Typeexons')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        // debug($type);
        $cli = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        //  ->where(['Clients.nouveau_client="FALSE"'])
        //  ->where(["Clients.etat " => 'TRUE']);
        $types = $this->fetchTable('Types')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $bureaupostes = $this->fetchTable('Bureaupostes')->find('list', ['keyfield' => 'id', 'valueField' => 'codepostal'])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $this->set(compact('code', 'pays', 'client', 'types', 'cli', 'ar', 'articles', 'type', 'delegations', 'localites', 'commercials', 'gouvernorats', 'typeexonerations', 'banques', 'paiements', 'typeclients', 'pointdeventes', 'bureaupostes'));
    }
 
    /**
     * Edit method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'clients') {
                $societe = $liens['modif'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        $this->loadModel('Clientarticles');
        //   debug($this->request->getData());die;
        $client = $this->Clients->get($id, [
            'contain' => ['Gouvernorats', 'Delegations', 'Localites'],
        ]);
        // debug($this->request->getData());
        if ($this->request->is(['patch', 'post', 'put'])) {

            //            debug($this->request->getData());
            //debug($this->request->getData('client_id'));
            //            $c = $this->Clients->get($this->request->getData('client_id'), [
            //                'contain' => [],
            //            ]);
            //            
            //            
            //            
            //            $c->etat = 'TRUE';
            //            $this->Clients->save($c);
            //
            //
            // debug($this->request->getData());
            $client = $this->Clients->patchEntity($client, $this->request->getData());
            if ($client->nouveau_client == 'TRUE') {
                $client->client_id = 0;
                $client->nouveau_client == 'TRUE';
            }



            if ($this->Clients->save($client)) {

                /*********************************************** **************************************************/
                $datainsert['updated'] = '1';
                $cl = $this->fetchTable('Clients')->patchEntity($client, $datainsert);
                $this->Clients->save($cl);
                /*********************************************** **************************************************/


                //debug($this->request->getData());die;

                $this->misejour("Clients", "edit", $id);
                if (isset($this->request->getData('data')['prixarticle']) && (!empty($this->request->getData('data')['prixarticle']))) {
                    foreach ($this->request->getData('data')['prixarticle'] as $j => $p) {

                        //die;

                        if ($p['supprix'] != 1) {


                            $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            $data['article_id'] = $p['article_id'];
                            $data['prix'] = $p['prix'];
                            $data['inserted'] = $p['inserted'];
                            $data['updated'] = $p['updated'];
                            $data['client_id'] = $id;

                            // debug($data);
                            //    debug($p);
                            if (isset($p['id']) && (!empty($p['id']))) {

                                $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientarticle = $this->fetchTable('Clientarticles')->newEmptyEntity();
                            }
                            $clientarticle = $this->fetchTable('Clientarticles')->patchEntity($clientarticle, $data);
                            if ($this->fetchTable('Clientarticles')->save($clientarticle)) {


                                //debug($cau);
                            } else {
                            }
                        } else if ($p['supprix'] == 1 && !empty($p['id'])) {

                            $clientarticle = $this->fetchTable('Clientarticles')->get($p['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientarticles')->delete($clientarticle);
                        }
                    }
                }







                if (isset($this->request->getData('data')['adresse']) && (!empty($this->request->getData('data')['adresse']))) {
                    foreach ($this->request->getData('data')['adresse'] as $i => $b) {


                        if ($b['supadresse'] != 1) {


                            $adresseliv = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
                            $data['adresse'] = $b['adresse'];
                            $data['client_id'] = $id;

                            //debug($dat);
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->newEmptyEntity();
                            };
                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->patchEntity($adresselivraisonclient, $data);
                            $this->fetchTable('Adresselivraisonclients')->save($adresselivraisonclient);
                        } else if ($b['supadresse'] == 1 && !empty($b['id'])) {
                            $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Adresselivraisonclients')->delete($adresselivraisonclient);
                        }
                    }
                }





                if (isset($this->request->getData('data')['banque']) && (!empty($this->request->getData('data')['banque']))) {
                    foreach ($this->request->getData('data')['banque'] as $i => $b) {
                        if ($b['supbanque'] != 1) {
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            };

                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['client_id'] = $id;
                            $document = $b['documen'];
                            $name = $document->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $clientbanque->document = $name;
                            }

                            //debug($dat);

                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);


                            $this->fetchTable('Clientbanques')->save($clientbanque);
                        } else if ($b['supbanque'] == 1 && !empty($b['id'])) {
                            $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientbanques')->delete($clientbanque);
                        }
                    }
                }


                if (isset($this->request->getData('data')['document']) && (!empty($this->request->getData('data')['document']))) {
                    foreach ($this->request->getData('data')['document'] as $i => $b) {
                        if ($b['supbanque'] != 1) {
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientbanque = $this->fetchTable('Clientbanques')->newEmptyEntity();
                            };

                            $datee['banque_id'] = $b['banque_id'];
                            $datee['agence'] = $b['agence'];
                            $datee['code_banque'] = $b['code_banque'];
                            $datee['swift'] = $b['swift'];
                            $datee['compte'] = $b['compte'];
                            $datee['rib'] = $b['rib'];
                            $datee['client_id'] = $id;
                            $document = $b['documen'];
                            $name = $document->getClientFilename();
                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $clientbanque->document = $name;
                            }

                            //debug($dat);

                            $clientbanque = $this->fetchTable('Clientbanques')->patchEntity($clientbanque, $datee);


                            $this->fetchTable('Clientbanques')->save($clientbanque);
                        } else if ($b['supbanque'] == 1 && !empty($b['id'])) {
                            $clientbanque = $this->fetchTable('Clientbanques')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientbanques')->delete($clientbanque);
                        }
                    }
                }




                if (isset($this->request->getData('data')['responsable']) && (!empty($this->request->getData('data')['responsable']))) {
                    foreach ($this->request->getData('data')['responsable'] as $i => $b) {
                        // debug($b['tel']);


                        if ($b['supresponsable'] != 1) {

                            $dataa['name'] = $b['name'];
                            $dataa['mail'] = $b['mail'];
                            $dataa['tel'] = $b['tel'];
                            $dataa['poste'] = $b['poste'];
                            $dataa['client_id'] = $client->id;

                            //debug($dat);
                            if (isset($b['id']) && (!empty($b['id']))) {

                                $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                $clientresponsable = $this->fetchTable('Clientresponsables')->newEmptyEntity();
                            };
                            $clientresponsable = $this->fetchTable('Clientresponsables')->patchEntity($clientresponsable, $dataa);



                            $this->fetchTable('Clientresponsables')->save($clientresponsable);
                            //                            debug($clientresponsable);die;
                        } else if ($b['supresponsable'] == 1 && !empty($b['id'])) {
                            $clientresponsable = $this->fetchTable('Clientresponsables')->get($b['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientresponsables')->delete($clientresponsable);
                        }
                    }
                }


                if (isset($this->request->getData('data')['lignes']) && (!empty($this->request->getData('data')['lignes']))) {
                    foreach ($this->request->getData('data')['lignes'] as $i => $exon) {
                        //debug($exon);
                        $this->loadModel('Clientexonerations');



                        if ($exon['sup2'] != 1) {
                            if (isset($exon['id']) && (!empty($exon['id']))) {
                                //debug("old");
                                $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
                                    'contain' => []
                                ]);
                            } else {
                                //debug("new");
                                $exonerations = $this->fetchTable('Clientexonerations')->newEmptyEntity();
                            };
                            $data2['typeexon_id'] = $exon['typeexon_id'];
                            $data2['num_att_taxes'] = $exon['num_att_taxes'];
                            $data2['date_debut'] = $exon['date_debut'];
                            $data2['date_fin'] = $exon['date_fin'];
                            $data2['client_id'] = $id;
                            //debug($data2);die;

                            $document = $exon['documenttt'];
                            //  debug($document);

                            $name = $document->getClientFilename();
                            //debug($name);

                            $targetPath = WWW_ROOT . 'img' . DS . 'imgart' . DS . $name;
                            if (!empty($name)) {
                                $document->moveTo($targetPath);
                                $exonerations->document = $name;
                            }
                            // debug($data2);

                            $exonerations = $this->fetchTable('Clientexonerations')->patchEntity($exonerations, $data2);

                            $this->fetchTable('Clientexonerations')->save($exonerations);
                        } else if ($exon['sup2'] == 1 && !empty($exon['id'])) {
                            $exonerations = $this->fetchTable('Clientexonerations')->get($exon['id'], [
                                'contain' => []
                            ]);
                            $this->fetchTable('Clientexonerations')->delete($exonerations);
                        }
                    }
                }
                // if ($exonerations!= null){
                // $this->set(compact('exonerations'));
                // }

                //$this->Flash->success(__('The client has been saved.'));
                return $this->redirect(['action' => 'index']);
            }

            //   $this->Flash->error(__('The client could not be saved. Please, try again.'));
        }



        $this->loadModel('Tarifs');
        $this->loadModel('Articles');
        $this->loadModel('Clientexonerations');
        $this->loadModel('Articles');
        $fam = $this->Tarifs->Familles->find('all')->where(["Familles.vente =  '" . 1 . "' "]);
        $dett = '0';
        foreach ($fam as $f) {
            //debug($f); //die;
            $dett = $dett . ',' . $f->id;
        }
        // $dett=implode(',',$fam);
        //debug($dett); //die;
        if ($dett != '') {
            $cond100 = 'Articles.famille_id in (' . $dett . ')';
        }

        //$articless = $this->Tarifs->Articles->find('all')->where([$cond100]);
        $articless = $this->Tarifs->Articles->find('all')->where(["Articles.vente=1"]);


        //$ar = array();
        // $i=0;
        /* foreach ($articles as $ar) {

          $ar = $articles;
          } */
        //debug($ar);
        $typeexonerations[1] = 'exonore';
        $typeexonerations[2] = 'non exonore';
        $adressees = $this->fetchTable('Adresselivraisonclients')->find('all', ['keyfield' => 'id', 'valueField' => 'adresse'])->where(["Adresselivraisonclients.client_id =  '" . $id . "' "]);
        $responsable = $this->fetchTable('Clientresponsables')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientresponsables.client_id =  '" . $id . "' "]);
        $banquess = $this->fetchTable('Clientbanques')->find('all', ['keyfield' => 'id', 'valueField' => 'name'])->where(["Clientbanques.client_id = " . $id . ""]);
        $exoclients = $this->fetchTable('Clientexonerations')->find('all', ['keyfield' => 'id'])->where(["Clientexonerations.client_id = " . $id . ""]);;
        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');
        $this->loadModel('Localites');

        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $client['gouvernorat_id'] . '"']);
        $i = 0;
        $tab = array();
        foreach ($del as $i => $tab) {
            $tab = $del;
        }
        //debug($tab);
        //        $deleg=$this->Delegations->find()->select(['Delegations.name'])
        //                ->where(['Delegations.id  in (' . $tab . ')']);
        if ($tab != array()) {
            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(['Delegations.id  in (' . $tab . ')']);
        } else {
            $deleg = $this->Delegations->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        }



        // debug($deleg) ;    

        $loc = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)'])
            ->where(['id_deleg  ="' . $client['delegation_id'] . '"'])
            ->where(['id_gouv  ="' . $client['gouvernorat_id'] . '"']);
        $j = 0;
        $tab1 = array();
        foreach ($loc as $j => $tab1) {
            $tab1 = $loc;
        }
        if ($tab1 != array()) {
            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
                ->where(['Localites.id  in (' . $tab1 . ')']);
        } else {
            $localite = $this->Localites->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        }


        $clientdoc = $this->fetchTable('Clientdocuments')->find('all')
            ->where(["Clientdocuments.client_id = " . $id . ""]);





        $exoner = $this->Clientexonerations->find('all')->where(["Clientexonerations.client_id = " . $id . ""]);
        $this->loadModel('Clientarticles');
        $clientarticles = $this->Clientarticles->find('all')->where(["Clientarticles.client_id = " . $id . ""]);
        //debug($clientarticles);
        $pointdeventes = $this->fetchTable('Pointdeventes')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //$gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();

        $banques = $this->fetchTable('Banques')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        //$typeexonerations = $this->fetchTable('Typeexonerations')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();

        $paiements = $this->fetchTable('Paiements')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $typeclients = $this->fetchTable('Typeclients')->find('list', ['keyfield' => 'id', 'valueField' => 'type'])->all();
        $this->loadModel('Typeexons');

        $type = $this->fetchTable('Typeexons')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $cli = $this->Clients->find('list', ['keyfield' => 'id', 'valueField' => 'Raison_Sociale']);
        // ->where(["Clients.etat " => 'TRUE'])
        // ->where(['Clients.nouveau_client="FALSE"']);

        $bureaupostes = $this->fetchTable('Bureaupostes')->find('list', ['valueField' => 'codepostal'])->where(["Bureaupostes.gouvernorat_id = " . $client->gouvernorat_id . ""]);
        // debug($bureaupostes);
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $pays = $this->fetchTable('Pays')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $gouvp = $this->fetchTable('Gouvernorats')->find('list', ['keyfield' => 'id', 'valueField' => 'name'])
            ->where('Gouvernorats.pay_id=' . $client->pay_id);
        $types = $this->fetchTable('Types')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $this->set(compact('gouvp', 'pays', 'clientdoc', 'types', 'articless', 'bureaupostes', 'cli', 'ar', 'localite', 'deleg', 'gouvernorats', 'type', 'tab', 'articles', 'clientarticles', 'exoner', 'gouvernorats', 'pointdeventes', 'typeclients', 'client', 'commercials', 'gouvernorats', 'typeexonerations', 'paiements', 'adressees', 'responsable', 'banquess', 'banques'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Client id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $session = $this->request->getSession();
        $abrv = $session->read('abrvv');
        $liendd = $session->read('lien_clients' . $abrv);
        // Vérifier si le client est lié à une visite
        $visiteCount = $this->Clients->Visites->find()
        ->where(['client_id' => $id])
        ->count();

        //   debug($liendd);
        $societe = 0;
        foreach ($liendd as $k => $liens) {
            //  debug($liens);
            if (@$liens['lien'] == 'clients') {
                $societe = $liens['supp'];
            }
        }
        // debug($societe);die;
        if (($societe <> 1)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
        //  $this->request->allowMethod(['post', 'delete']);

        $adresselivraisonclient = $this->fetchTable('Adresselivraisonclients')->find('all', [])
            ->where(['client_id' => $id]);

        $clientbanques = $this->fetchTable('Clientbanques')->find('all', [])
            ->where(['client_id' => $id]);


        $clientarticles = $this->fetchTable('Clientarticles')->find('all', [])
            ->where(['client_id' => $id]);





        $clientresponsables = $this->fetchTable('Clientresponsables')->find('all', [])
            ->where(['client_id' => $id]);

        $this->loadModel('Clientbanques');
        $this->loadModel('Adresselivraisonclients');
        $this->loadModel('Clientresponsables');
        $this->loadModel('Clientarticles');


        foreach ($clientarticles as $b) {
            $this->Clientarticles->delete($b);
        }



        foreach ($clientbanques as $b) {
            $this->Clientbanques->delete($b);
        }



        foreach ($clientresponsables as $client) {

            $this->Clientresponsables->delete($client);
        }



        foreach ($adresselivraisonclient as $adresse) {
            $this->Adresselivraisonclients->delete($adresse);
        }









        $client = $this->Clients->get($id);

        if ($visiteCount > 0) {
            // S'il y a des visites associées, afficher un message d'erreur
            $this->Flash->error("Ce Client ne peut pas être supprimé car il est associé à des visites.");
            return $this->redirect(['action' => 'index']);  // ou la page appropriée
        }
        if ($this->Clients->delete($client)) {
            $this->misejour("Clients", "delete", $id);

            //   $this->Flash->success(__('The client has been deleted.'));
        } else {
            //  $this->Flash->error(__('The client could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function clientcommercial()
    {

        $clientCom = $this->Clients->newEmptyEntity();
        if ($this->request->is('post')) {

            // $client = $this->Clients->patchEntity($client, $this->request->getData(), ['associated' => ['Adresselivraisonclients' => ['validate' => false]]]);
            $commercial = $this->request->getData('commercial_id');
            //  debug($this->request->getData()['data']);die;

            if (isset($this->request->getData()['data']) && (!empty($this->request->getData()['data']))) {
                //  debug('hh');
                foreach ($this->request->getData()['data']['lignec'] as $i => $c) {
                    //debug($c['checkclient']);

                    if (isset($c['checkclient']) && (!empty($c['checkclient'])) && $c['checkclient'] == 1) {
                        $client = $this->Clients->get($c['client_id'], [
                            'contain' => [],
                        ]);
                        //debug($client);

                        $client->commercial_id = $commercial;

                        $this->Clients->save($client);
                    }
                } //die; 
            }
        }
        //  $clients = $this->Clients->find('list', ['limit' => 200]);
        //Configure::write('debug',2); 
        $commercials = $this->Clients->Commercials->find('list', ['limit' => 200])->all();
        $gouvernorats = $this->Clients->Gouvernorats->find('list', ['keyfield' => 'id', 'valueField' => 'name'])->all();
        $this->set(compact('commercials', 'gouvernorats', 'clientCom'));
    }

    public function clientgouv()
    {
        $id = $this->request->getQuery('idfam');
        // debug($id);





        $dealIdStr = implode(", ", $id);

        $clients = $this->Clients->find('all', ['keyfield' => 'id', 'valueField' => 'nameF'])
            ->where(['Clients.gouvernorat_id  in (' . $dealIdStr . ')'])->order(['left(Clients.Code,1),cast(right(Clients.Code,length(Clients.Code)-1) as Unsigned)']);
        $this->layout = '';

        $this->set(compact('clients'));
    }

    public function getbureaupostegouvs($id = null)
    {
        $this->loadModel('Basepostes');
        $this->loadModel('Delegations');
        $id = $this->request->getQuery('idgouv');
        $ligne = $this->fetchTable('Gouvernorats')->get($id, [
            'contain' => [],
        ]);

        $del = $this->Basepostes->find()->select(["id_deleg" => '(Basepostes.id_deleg)'])->where(['id_gouv  ="' . $id . '"']);
        //debug($del);

        $i = 0;
        $tab = array();
        foreach ($del as $i => $tab) {
            $tab = $del;
        }
        $deleg = $this->Delegations->find() //->select(["namedeleg" => '(Delegations.name)'])
            ->where(['Delegations.id  in (' . $tab . ')']);

        $query = $this->fetchTable('Gouvernorats')->find();
        $query->where(['Gouvernorats.id  ="' . $id . '"']);
        //debug($query);
        foreach ($query as $qr) {
            //   debug($qr);
            $code = $qr['codepostale'];
            $name = $qr['name'];
            $c = $qr['code'];
        }
        //debug($c);






        // debug($c);die;
        //  $queryyy = $this->Clients->find()->select(["code" =>
        //                    'MAX(Clients.Code)']) ->first();
        $queryyy = $this->fetchTable('Clients')->find()->select(["code" => '(Clients.Code)'])->where(['Clients.Code like' . "'" . $c . "%'"]);
        //   debug($queryyy);
        $i = 0;
        $res = array();
        foreach ($queryyy as $i => $q) {
            $res[$i] = intval(substr($q['code'], 1, 9));
        }

        if (!empty($res)) {
            $p = max($res); //debug($p);
            if (!empty($p)) {
                $f = $c . ($p + 1);
            }
        } else {
            $f = $c . "001";
        }
        //debug($f);


        //            $t=$p+1;
        //            $cc = str_pad("$t", 4, '0', STR_PAD_LEFT);
        //            $f= str_pad("$cc", 5,$c, STR_PAD_LEFT); 





        $select = "

        <label class='control-label' for=''>Delegation</label>
        <select name='delegation_id' id='deleg' class='form-control select2 ' Onchange='delegation(this.value," . $id . ")'  >
		<option value=''  selected='selected' disabled>Veuillez choisir</option>";
        foreach ($deleg as $q) {
            //  debug($q); die;
            $select = $select . "	<option value ='" . $q->id . "'";
            $select = $select . " >" . $q->name . "</option>";
        }
        $select = $select . "</select> </div> </div> ";

        echo json_encode(array("query" => $code, "queryyy" => $f, "queryy" => $c, "select" => $select, "name" => $name, "success" => true));
        die;
    }

    public function getclientscmd($id = null)
    {
        $this->loadModel('Commandes');
        $id = $this->request->getQuery('idclient');

        // Count associated records for the client
        $commandeCount = $this->fetchTable('Commandes')->find()->where(['Commandes.client_id' => $id])->count();
        $bonlivraisonCount = $this->fetchTable('Bonlivraisons')->find()->where(['Bonlivraisons.client_id' => $id])->count();
        $factureCount = $this->fetchTable('Factureclients')->find()->where(['Factureclients.client_id' => $id])->count();
        $reglementCount = $this->fetchTable('Lignereglementclients')->find()->where(['Lignereglementclients.client_id' => $id])->count();
        $avoirCount = $this->fetchTable('Factureavoirs')->find()->where(['Factureavoirs.client_id' => $id])->count();
        $adresselivraisonclients = $this->fetchTable('Adresselivraisonclients')->find()->where(['Adresselivraisonclients.client_id' => $id])->count();
        $clientresponsables = $this->fetchTable('Clientresponsables')->find()->where(['Clientresponsables.client_id' => $id])->count();
        $clientdocuments = $this->fetchTable('Clientdocuments')->find()->where(['Clientdocuments.client_id' => $id])->count();
        // Check if there are any related records
        $clientbanques = $this->fetchTable('Clientbanques')->find()->where(['Clientbanques.client_id' => $id])->count();
        $clientexonerations = $this->fetchTable('Clientexonerations')->find()->where(['Clientexonerations.client_id' => $id])->count();

        $clientarticles = $this->fetchTable('Clientarticles')->find()->where(['Clientarticles.client_id' => $id])->count();
        $hasDependencies = $commandeCount + $bonlivraisonCount + $factureCount + $reglementCount + $avoirCount + $adresselivraisonclients + $clientresponsables + $clientdocuments + $clientbanques +  $clientexonerations  + $clientarticles > 0;

        echo json_encode([
            "hasDependencies" => $hasDependencies,
            "success" => true
        ]);
        die;
    }




    public function getbureaupostedelegs($id = null, $idgouv = null)
    {
        $this->loadModel('Localites');
        $this->loadModel('Basepostes');
        $id = $this->request->getQuery('iddeleg');
        $idgouv =  $this->request->getQuery('idgouv');
        $ligne = $this->fetchTable('Delegations')->get($id, [
            'contain' => [],
        ]);

        //$del=$this->fetchTable('Base_postes')->find()->where(['gouvernorats.id  ="' .$id.'"']);


        $query = $this->fetchTable('Delegations')->find();
        $query->where(['Delegations.id  ="' . $id . '"']);
        foreach ($query as $qr) {
            //     debug($qr)
            $code = $qr['codepostale'];
            $name = $qr['name'];
        }
        // debug($name);



        $loc = $this->Basepostes->find()->select(["id_loc" => '(Basepostes.id_loc)'])->where(['id_deleg  ="' . $id . '"']);
        $j = 0;
        $tab1 = array();
        foreach ($loc as $j => $tab1) {
            $tab1 = $loc;
        }

        $localite = $this->Localites->find() //->select(["namedeleg" => '(Delegations.name)'])
            ->where(['Localites.id  in (' . $tab1 . ')']);
        //debug($localite);





        $select = "
        <label class='control-label' for='sousfamille1-id'>Localite</label>
        <select name='localite_id' id='loc'  class='form-control select2' Onchange='localite(this.value," . $id . "," . $idgouv . ")'>
					<option value=''  selected='selected'>Veuillez choisir</option>";
        foreach ($localite as $q) {
            //  debug($q); die;
            $select = $select . "	<option value ='" . $q->id . "'";
            $select = $select . " >" . $q->name . "</option>";
        }
        $select = $select . "</select>  ";
        echo json_encode(array("name" => $name, "query" => $code, "select" => $select, "success" => true));

        //        echo json_encode(array('select' => $select));
        //echo json_encode(array('select' => $select, 'ligne' => $ligne));
        die;
        //  $this->set(compact('query'));
    }

    public function getbureaupostelocs($id = null, $idgouv = null, $iddeleg = null)
    {
        $this->loadModel('Basepostes');
        $id = $this->request->getQuery('idloc');
        $iddeleg = $this->request->getQuery('iddeleg');
        $idgouv =  $this->request->getQuery('idgouv');
        $query = $this->fetchTable('Basepostes')->find();
        $query->where(['id_loc="' . $id . '"', 'id_gouv="' . $idgouv . '"', 'id_deleg="' . $iddeleg . '"']);

        $q = $this->fetchTable('Localites')->find();
        $q->where(['id="' . $id . '"']);

        foreach ($q as $a) {
            //  debug($a);
            $name = $a['name'];
        }



        foreach ($query as $qr) {
            $code = $qr['codepostale'];
            //$name=$qr['name'];
        }

        //  debug($code);die;
        echo json_encode(array("name" => $name, "query" => $code, "success" => true));

        die;
        //  $this->set(compact('query'));
    }


    public function getgouv($id = null)
    {

        $id = $this->request->getQuery('id');

        //debug($id);
        //die;

        $query = $this->fetchTable('Gouvernorats')->find();
        $query->where(['pay_id' => $id]);


        $select = "

        <label class='control-label' for='gouvernorat-id'>Gouvernorat</label>
        <select name='gouvernorat_id' id='gouvernorat' class='form-control select2'  onchange=gouv(this.value) >
					<option value=''  selected='selected' disabled>Veuillez choisir !!</option>";
        foreach ($query as $q) {
            $select =  $select . "	<option value ='" . $q['id'] . "'";
            $select =  $select . " >" . $q['name'] . "</option>";
        }
        $select = $select . "</select> </div> </div> ";

        echo json_encode(array('select' => $select));
        exit;
    }

    public function gtcode()
    {

        if ($this->request->is('ajax')) {
            $code = $_GET['code'];

            $codes = $this->fetchTable('Clients')->find('all')
                ->where(["Clients.Code  ='" . $code . "'"]);

            $c = '';
            foreach ($codes as $li) {
                // debug($li);die;
                $c = $li['Code'];
            }
            $test = 0;
            if ($c != '') {
                $test = 1;
            } // debug($test);die;
            echo json_encode(array("codes" => $test, "success" => true));
            exit;
        }
        die;
    }


    public function checktel()
    {
        if ($this->request->is('ajax')) {
            $id = $_GET['id'];
            $condid = "";
            if ($id) {
                $condid = "Clients.id!=" . $id . "";
            }

            $tel = $_GET['tel'];
            //debug($idlogin);die;
            $ligne = $this->fetchTable('Clients')->find('all')
                ->where(["Clients.Tel  ='" . $tel . "'", $condid]);

            foreach ($ligne as $li) {
                // debug($li);die; 
                $numtel = $li['Tel'];
            }

            $test = 0;
            if ($numtel != '') {
                $test = 1;
            }
            // debug($test);die;
            echo json_encode(array("ligne" => $test, "success" => true));
            exit;
        }
        die;
    }

    public function etatnonsolde12122024()
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
    
        $client_id = $this->request->getQuery('client_id');
    
        $conditions = [
            'Clients.soldedebut IS NOT' => null,
            'Clients.soldedebut !=' => 0
        ];
    
        if (!empty($client_id)) {
            $conditions['Clients.id'] = $client_id;
        }
    
        $clients = $this->fetchTable('Clients')->find('all')->where($conditions);
        $clientss = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);
        $mois = $this->fetchTable('Mois')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
    
        $moiss = $this->fetchTable('Mois')->find('all', [
            'keyField' => 'id',
            'valueField' => 'num'
        ]);
    
        $this->set(compact('clients','clientss','client_id', 'mois', 'moiss'));
    }
    function etatnonsolde()
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
        $client_id = $this->request->getQuery('client_id');

        if (!empty($client_id)) {
            $conditions['Clients.id'] = $client_id;

        }
    
        $clients = $this->fetchTable('Clients')->find('all')->where([
            'Clients.id !=' => 12,
            $conditions
        ]);
                $mois = $this->fetchTable('Mois')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientss = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ])->where(['Clients.id !=12']);
        // $clients = $this->fetchTable('Clients')->find('all');
        // debug($clients);
        $moiss = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'num']);

        $this->set(compact("clients",'client_id',"clientss","mois","moiss"));



    }

    function impnonsolde()
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
        $client_id = $this->request->getQuery('client_id');

        if (!empty($client_id)) {
            $conditions['Clients.id'] = $client_id;

        }
    
        $clients = $this->fetchTable('Clients')->find('all')->where([
            'Clients.id !=' => 12,
            $conditions
        ]);
                $mois = $this->fetchTable('Mois')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);
        $clientss = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ])->where(['Clients.id !=12']);
        // $clients = $this->fetchTable('Clients')->find('all');
        // debug($clients);
        $moiss = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'num']);

        $this->set(compact("clients","clientss","mois","moiss"));



    }
    function impnonsolde12122024()
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Clients');
    
        $client_id = $this->request->getQuery('client_id');
    
        $conditions = [
            'Clients.soldedebut IS NOT' => null,
            'Clients.soldedebut !=' => 0
        ];
    
        if (!empty($client_id)) {
            $conditions['Clients.id'] = $client_id;
        }
    
        $clients = $this->fetchTable('Clients')->find('all')->where($conditions);
        $clientss = $this->fetchTable('Clients')->find('list', [
            'keyField' => 'id',
            'valueField' => function ($row) {
                return $row['Code'] . ' ' . $row['Raison_Sociale'];
            }
        ]);
        $mois = $this->fetchTable('Mois')->find('list', [
            'keyField' => 'id',
            'valueField' => 'name'
        ]);
    
        $moiss = $this->fetchTable('Mois')->find('all', [
            'keyField' => 'id',
            'valueField' => 'num'
        ]);
    
        $this->set(compact('clients','clientss','client_id', 'mois', 'moiss'));
    }


    function etatchiffreaffaire()
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Clients');

        $mois = $this->fetchTable('Mois')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $clients = $this->fetchTable('Clients')->find('all');
        // debug($clients);
        $moiss = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'num']);

        $this->set(compact("clients", "mois", "moiss"));
    }
    function impetatchiffre()
    {
        $this->loadModel('Factureclients');
        $this->loadModel('Clients');

        $mois = $this->fetchTable('Mois')->find('list', ['keyfield' => 'id', 'valueField' => 'name']);

        $clients = $this->fetchTable('Clients')->find('all');
        // debug($clients);
        $moiss = $this->fetchTable('Mois')->find('all', ['keyfield' => 'id', 'valueField' => 'num']);

        $this->set(compact("clients", "mois", "moiss"));
    }
}
