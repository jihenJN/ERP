<?php

use App\Model\Entity\Demandeoffredeprix;

error_reporting(E_ERROR | E_PARSE);

use Cake\Datasource\ConnectionManager; ?>

<section style="width: 99%">

    <div id="projets" style="display:block;margin-top: 1px;">
        <?php
         $wr =$this->Url->build('/', ['fullBase' => true]);
        $session = $this->request->getSession();
        $com = $session->write('com', null);
        echo $this->Form->create($commandeclient, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']);

        $tauxchan = 1;
        if ($commandeclient->tauxdechange) {
            $tauxchan = (float) $commandeclient->tauxdechange;
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box ">
                    <div class="box-body table-responsive " style="font-size: 15px;">
                        <div class="row">
                            <div class="col-xs-5" style="margin-top: 1%;
    margin-left: 2%;
    border: 1px solid #CCC;
    -webkit-box-shadow: 3px 3px 4px #DDD;
    box-shadow: 3px 3px 4px #DDD;
    padding: 4px;
    height: 111px;
    width: 125px;
    object-fit: contain;text-align:center">
                                <?php echo $this->Html->image('commande_' . $commandeclient->code . '.jpg', ['alt' => 'CakePHP', 'style' => 'max-width:112px; max-height: 98px;', 'height' => '98px', 'width' => '80px']); ?>
                       
                            </div>
                            <div class="col-xs-7" style="margin:1%">
                                <div style="font-weight: bold;
    color: rgb(90, 90, 90);
    font-size: 160%;"><b>
                                        <?php echo ($commandeclient->code); ?>
                                    </b></div>
                                <div style="font-size: 15px;"> <label> Réf. client : </label>

                                    <?php echo $commandeclient->client->codeclient; ?>

                                    <?php //echo ($projet->client->nom); ?>
                                </div>
                                <div style="font-size: 15px;"> <label> Tiers: </label>

                                    <?php echo $this->Html->link($commandeclient->client->nom, ['controller' => 'Clients', 'action' => 'view', $commandeclient->client->id], ['escape' => false]); ?>

                                    <?php //echo ($projet->client->nom); ?>
                                </div>
                                <div style="font-size: 15px;"> <label> Projet: </label>

                                    <?php echo $this->Html->link($commandeclient->projet->libelle . '-' . $commandeclient->projet->name, ['controller' => 'Projets', 'action' => 'view', $commandeclient->projet->id], ['escape' => false]); ?>

                                    <?php //echo ($projet->client->nom); ?>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <div style="display:flex;width: 100%;">
                                    <table style="width: 50%; " class="table table-bordered table-striped">
                                        <tr>
                                            <td
                                                style="border-top: solid;width: 26%; text-align: left; vertical-align: middle;">
                                                Remises</td>
                                            <td
                                                style="border-top: solid;width: 24%; text-align: left ; vertical-align: middle;">

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">
                                                Date
                                            </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $commandeclient->date->format("d/m/Y"); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">Date de
                                                fin de validité
                                            </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $client->codeclient; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">
                                                Conditions de règlement</td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $commandeclient->conditionreglement->conditionn; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">
                                                Date de livraison</td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php
                                                if ($commandeclient->datelivraison) {
                                                    echo $commandeclient->datelivraison->format("d/m/Y");
                                                }
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">
                                                Délai de livraison (après commande)</td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $commandeclient->delailivraison->name; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">
                                                Méthode d'expédition </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $commandeclient->methodeexpedition->methode; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">
                                                Origine</td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $projet->budget; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">
                                                Mode de règlement </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $projet->budget; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">Devise
                                            </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $commandeclient->devise->code . '-' . $commandeclient->devise->name; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">Compte
                                                bancaire</td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $comptesBank->name; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">Incoterms
                                            </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $commandeclient->incoterm->code . '-' . $commandeclient->pay; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">Incoterm
                                                du total en pdf </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $Incoterm->code; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">Montant de
                                                remise relative sur le total </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php
                                                if ($commandeclient->typeremise_id == 1 && $commandeclient->remisetotal != '') {
                                                    echo $commandeclient->remisetotal;
                                                } else {
                                                    echo '0';
                                                }
                                                if ($commandeclient->devise->name === 'Dollars US'):
                                                    echo ' $';
                                                elseif ($commandeclient->devise->name === 'Euro'):
                                                    echo ' €';
                                                else:
                                                    echo '';
                                                endif; ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">Montant de
                                                remise fixe sur total </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php
                                                if ($commandeclient->typeremise_id == 2 && $commandeclient->remisetotalval != '') {
                                                    echo $commandeclient->remisetotalval;
                                                } else {
                                                    echo '0';
                                                }
                                                if ($commandeclient->devise->name === 'Dollars US'):
                                                    echo ' $';
                                                    $dev = ' $';
                                                elseif ($commandeclient->devise->name === 'Euro'):
                                                    echo ' €';
                                                    $dev = ' €';
                                                else:
                                                    echo '';
                                                    $dev = '';
                                                endif;
                                                ?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="width: 10%; text-align: left; vertical-align: middle;">Nombre de
                                                chiffre après la virgule </td>
                                            <td style="width: 20%; text-align: left;">
                                                <?php echo $commandeclient->nbfergule; ?>
                                            </td>
                                        </tr>


                                    </table>
                                    <div style="width: 50%;margin-left: 2%;">

                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <td colspan="3"
                                                    style=" border-top: solid;width: 10%; text-align: left; vertical-align: middle;background-color: white;">
                                                    Montant HT </td>
                                                <td colspan="3"
                                                    style="border-top: solid;width: 20%; text-align: left;  vertical-align: middle;background-color: white;">
                                                    <?php
                                                    $virg = 3;
                                                    if ($commandeclient->nbfergule) {
                                                        $virg = $commandeclient->nbfergule;
                                                    }
                                                    echo sprintf("%01." . $virg . "f", str_replace(",", ".", (float) $commandeclient->totalttc - (float) $commandeclient->totaltva)) . '' . $dev;

                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="width: 10%; text-align: left; vertical-align: middle;background-color: white;">
                                                    Montant TVA
                                                </td>
                                                <td colspan="3"
                                                    style="width: 20%; text-align: left; vertical-align: middle;background-color: white;">
                                                    <?php
                                                    echo sprintf("%01." . $virg . "f", str_replace(",", ".", (float) $commandeclient->totaltva)) . '' . $dev; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"
                                                    style="width: 10%; text-align: left; vertical-align: middle;background-color: white;">
                                                    Montant TTC
                                                </td>
                                                <td colspan="3"
                                                    style="width: 20%; text-align: left; vertical-align: middle;background-color: white;">
                                                    <?php echo sprintf("%01." . $virg . "f", str_replace(",", ".", (float) $commandeclient->totalttc)) . '' . $dev; ?>
                                                </td>
                                            </tr>
                                            <?php $pvproduit = $connection->execute("SELECT sum(coutrevient*$tauxchan*qte) as pr ,sum(prixht*qte) as pv , sum(prixht*qte*tauxdemarge) as pmarge,sum(prixht*qte*tauxdemarque) as pmarque FROM lignecommandeclients lc  WHERE  lc.type=1 and lc.commandeclient_id='" . $commandeclient->id . "'")->fetch('assoc');
                                            $pvservice = $connection->execute("SELECT sum(coutrevient*$tauxchan*qte) as pr ,sum(prixht*qte) as pv , sum(prixht*qte*tauxdemarge) as pmarge,sum(prixht*qte*tauxdemarque) as pmarque FROM lignecommandeclients lc  WHERE  lc.type=2 and lc.commandeclient_id='" . $commandeclient->id . "'")->fetch('assoc');
                                            $sumpv = $pvproduit['pv'] + $pvservice['pv'];
                                            $margepr = $pvproduit['pv'] - $pvproduit['pr'];
                                            $margeserv = $pvservice['pv'] - $pvservice['pr'];
                                            $sumpr = $pvproduit['pr'] + $pvservice['pr'];
                                            $summarge = $margeserv + $margepr;
                                            if ($pvproduit['pv'] != 0 && $pvproduit['pmarque'] != 0) {
                                                $marqueprtot = $pvproduit['pmarque'] / $pvproduit['pv'];
                                            }
                                            if ($pvproduit['pv'] != 0 && $pvproduit['pmarge'] != 0) {
                                                $margeprtot = $pvproduit['pmarge'] / $pvproduit['pv'];
                                            }


                                            if ($pvservice['pv'] != 0 && $pvservice['pmarque'] != 0) {
                                                $marquesertot = $pvservice['pmarque'] / $pvservice['pv'];
                                            }
                                            if ($pvservice['pv'] != 0 && $pvservice['pmarge'] != 0) {
                                                $margesertot = $pvservice['pmarge'] / $pvservice['pv'];
                                            }

                                            $margetotal = $connection->execute("SELECT sum(prixht*qte) as pv , sum(prixht*qte*tauxdemarge) as pmarge,sum(prixht*qte*tauxdemarque) as pmarque FROM lignecommandeclients lc  WHERE   lc.commandeclient_id='" . $commandeclient->id . "'")->fetch('assoc');
                                            if ($margetotal['pv'] != 0 && $margetotal['pmarque'] != 0) {
                                                $marquetotal = $margetotal['pmarque'] / $margetotal['pv'];
                                            }
                                            if ($margetotal['pv'] != 0 && $margetotal['pmarge'] != 0) {
                                                $margetotall = $margetotal['pmarge'] / $margetotal['pv'];
                                            }
                                            ?>
                                            <tr style="    background: rgb(240, 240, 240);">
                                                <td
                                                    style=" border-top: solid;width: 10%; text-align: left; vertical-align: middle;">
                                                    Marges</td>
                                                <td
                                                    style="border-top: solid;width: 20%; text-align: left;  vertical-align: middle;">
                                                    Prix de vente </td>
                                                <td
                                                    style="border-top: solid;width: 20%; text-align: left;  vertical-align: middle;">
                                                    Prix de revient </td>
                                                <td
                                                    style="border-top: solid;width: 20%; text-align: left;  vertical-align: middle;">
                                                    Marge</td>
                                                <td
                                                    style="border-top: solid;width: 20%; text-align: left;  vertical-align: middle;">
                                                    Taux de <br> marge </td>
                                                <td
                                                    style="border-top: solid;width: 20%; text-align: left;  vertical-align: middle;">
                                                    Taux de <br>marque </td>
                                            </tr>
                                            <tr style="    background: white;">
                                                <td style="text-align: left; vertical-align: middle;">Marge / Produits
                                                </td>
                                                <td style=" text-align: left; ">
                                                    <?php echo sprintf("%01." . $virg . "f", $pvproduit['pv']); ?>
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo sprintf("%01." . $virg . "f", $pvproduit['pr']); ?>
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo sprintf("%01." . $virg . "f", $margepr); ?>
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo ($margeprtot) ? sprintf("%01.2f", $margeprtot) : 0; ?> %
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo ($marqueprtot) ? sprintf("%01.2f", $marqueprtot) : 0; ?>
                                                    %
                                                </td>
                                            </tr>
                                            <tr style="    background:white;">
                                                <td style=" text-align: left; vertical-align: middle;">Marge / Services
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo sprintf("%01." . $virg . "f", $pvservice['pv']); ?>
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo sprintf("%01." . $virg . "f", $pvservice['pr']); ?>
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo sprintf("%01." . $virg . "f", $margeserv); ?>
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo ($margesertot) ? sprintf("%01.2f", $margesertot) : 0; ?>
                                                    %
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo ($marquesertot) ? sprintf("%01.2f", $marquesertot) : 0; ?>
                                                    %
                                                </td>
                                            </tr>
                                            <tr style="    background: white;">
                                                <td style=" text-align: left; vertical-align: middle;">Marge totale
                                                </td>
                                                <td style="text-align: left;">
                                                    <?php echo sprintf("%01." . $virg . "f", $sumpv); ?>
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo sprintf("%01." . $virg . "f", $sumpr); ?>
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo sprintf("%01." . $virg . "f", $summarge); ?>
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo ($margetotall) ? sprintf("%01.2f", $margetotall) : 0; ?>
                                                    %
                                                </td>
                                                <td style=" text-align: left;">
                                                    <?php echo ($marquetotal) ? sprintf("%01.2f", $marquetotal) : 0; ?>
                                                    %
                                                </td>
                                            </tr>


                                        </table>
                                        <div class="row">
                                            <div class="boutons-container">
                                                <?php if ($mail == 1) { ?>
                                                    <!-- <a href="<?php echo $this->Url->build(['action' => 'index']); ?>" class="button"><i
                                    class="fa fa-envelope"></i> Email</a> -->
                                                <?php } ?>
                                                <?php //if ($validation == 1) { ?>
                                                <a href="<?php echo $this->Url->build(['action' => 'editcomcli/', $commandeclient->id]); ?>"
                                                    class="button"><i class="fa fa-edit"></i> Modifier</a>
                                                <a href="<?php echo $this->Url->build(['action' => 'duplicate/', $commandeclient->id]); ?>"
                                                    class="button"><i class="fa fa-copy"></i> Dupliquer</a>
                                                <?php //} ?>
                                                <?php if ($commandeclient->valider != 1) { ?>
                                                    <a href="<?php echo $this->Url->build(['action' => 'deletecomcli', $commandeclient->id]); ?>"
                                                        class="button"><i class="fa fa-times"></i> Supprimer</a>
                                                <?php } ?>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <table style="width: 100%; " class="table table-bordered table-striped">
                                    <tr style="    background: rgb(240, 240, 240);">
                                        <td
                                            style="border-top: solid;width: 25%; text-align: left; vertical-align: middle;">
                                            Description</td>
                                        <td
                                            style="border-top: solid;width: 15%; text-align: left ; vertical-align: middle;">
                                            Fournisseur</td>
                                        <td
                                            style="border-top: solid;width: 5%; text-align: left ; vertical-align: middle;">
                                            TVA</td>
                                        <td
                                            style="border-top: solid;width: 10%; text-align: left ; vertical-align: middle;">
                                            P.U. HT </td>
                                        <td
                                            style="border-top: solid;width: 9%; text-align: left ; vertical-align: middle;">
                                            Qté </td>
                                        <td
                                            style="border-top: solid;width: 5%; text-align: left ; vertical-align: middle;">
                                            Unité</td>
                                        <td
                                            style="border-top: solid;width: 10%; text-align: left ; vertical-align: middle;">
                                            Prix de revient </td>
                                        <td
                                            style="border-top: solid;width:6%; text-align: left ; vertical-align: middle;">
                                            Taux de <br> marge </td>
                                        <td
                                            style="border-top: solid;width: 5%; text-align: left ; vertical-align: middle;">
                                            Taux de <br>marque </td>
                                        <td
                                            style="border-top: solid;width: 10%; text-align: left ; vertical-align: middle;">
                                            Total HT </td>
                                    </tr>
                                    <?php

                                    foreach ($lignecommandeclientss as $i => $lig) {
                                        if ($lig->article->unite_id) {
                                            // debug($unite);
                                    
                                            $unitename = $connection->execute('SELECT * FROM unites where unites.id =' . $lig->article->unite_id)->fetchAll('assoc');
                                        }
                                        ?>
                                        <tr>
                                            <td style=" text-align: left ;">
                                                <?php echo $this->Html->link($lig->article->Reffourni, ['controller' => 'Articles', 'action' => 'view', $lig->article->id], ['escape' => false]) . ' - ' . $lig->article->Dsignation; ?>
                                            </td>
                                            <td style=" text-align: left ;">
                                                <?php echo $this->Html->link($lig->fournisseur->name, ['controller' => 'Fournisseurs', 'action' => 'view', $lig->fournisseur->id], ['escape' => false]); ?>
                                            </td>
                                            <td style=" text-align: left ;"> <?php echo ($lig->tva) ? $lig->tva : 0; ?> %
                                            </td>
                                            <td style=" text-align: center ;">
                                                <?= sprintf("%01." . $virg . "f", $lig['prixht']) ?>
                                            </td>
                                            <td style=" text-align: center ;"> <?php echo ($lig->qte); ?></td>
                                            <td style=" text-align: center ;"> <?php if ($unitename) {
                                                echo h($unitename[0]['name']);
                                            } ?></td>
                                            <td style=" text-align: right ;">
                                                <?php echo sprintf("%01." . $virg . "f", $lig['coutrevient'] * $tauxchan); ?>
                                            </td>
                                            <td style=" text-align: center ;">
                                                <?php echo ($lig->tauxdemarge) ? $lig->tauxdemarge : 0; ?> %
                                            </td>
                                            <td style=" text-align: center ;">
                                                <?php echo ($lig->tauxdemarque) ? $lig->tauxdemarque : 0; ?> %
                                            </td>
                                            <td style=" text-align: right ;"> <?php
                                            $TotalHT = $lig['prixht'] * $lig->qte;
                                            echo sprintf("%01." . $virg . "f", $TotalHT); ?></td>
                                        </tr>
                                    <?php } ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="box">

                <div class="row" style="    margin-left: 0%;width: 98%;">
                    <div class="col-xs-12">

                        <div style="display:flex;width: 100%;">
                            <div style="width: 50%;">
                                <h3>Fichiers joints </h3>
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr style="background-color: #f4f4f4;">
                                            <td
                                                style="border-top: solid;width: 26%; text-align: left; vertical-align: middle;">
                                            </td>
                                            <td
                                                style="border-top: solid;width: 24%; text-align: left ; vertical-align: middle;">

                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr style="background-color: white;">
                                            <td style="text-align: left; "><a style="text-decoration: underline;"
                                                    href="../../projets/downloadPdfimp/<?php echo $commandeclient->id; ?>">
                                                    <strong>Proposition_commerciale_<?php echo $commandeclient->code; ?>.pdf</strong></a>
                                                &thinsp;&thinsp;&thinsp;&thinsp;&thinsp; <i class="fa fa-search-plus"
                                                    onclick='openWindow(1000, 1000, `<?php echo $wr; ?>/projets/downloadPdfnew/<?php echo @$commandeclient->id; ?>`)'></i>
                                            </td>
                                            <td style="font-size: 16px; ">
                                                <?php
                                                $pdfFilePath = $wr.'/pdfs/Proposition_commerciale_' . $commandeclient->code . '.pdf';

                                                // Vérifiez si le fichier existe en utilisant get_headers
                                                $headers = get_headers($pdfFilePath, 1);
                                                if (strpos($headers[0], '200') !== false) {
                                                    // Obtenez la taille du fichier en utilisant curl
                                                    $ch = curl_init($pdfFilePath);
                                                    curl_setopt($ch, CURLOPT_NOBODY, true);
                                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                                    curl_setopt($ch, CURLOPT_HEADER, true);
                                                    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
                                                    curl_exec($ch);
                                                    $fileSize = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
                                                    curl_close($ch);
                                                    $fileSizeInKB = $fileSize / 1024; // En Ko
                                                    echo "<strong>" . ceil($fileSizeInKB) . " Ko </strong>";
                                                } else {
                                                    // echo "Le fichier n'existe pas.";
                                                } ?>


                                            </td>
                                        </tr>

                                    </tbody>



                                </table>
                            </div>
                            <div style="width: 50%;margin-left: 2%;">
                                <h3>Historique Offre GGB </h3>
                                <table class="table table-bordered table-striped">

                                    <tr>
                                        <td align="center" style="width: 10%;border-top: solid;width: 26%; ">
                                            <strong>Personnel</strong>
                                        </td>
                                        <!-- <td align="center" style="width: 10%;"><strong>date de création</strong></td> -->
                                        <td align="center" style="width: 10%;border-top: solid;width: 26%;"><strong>date
                                                d'opération</strong></td>
                                        <td align="center" style="width: 10%;border-top: solid;width: 26%; ">
                                            <strong>Opération</strong>
                                        </td>
                                    </tr>
                                    <?php
                                    $connection = ConnectionManager::get('default');
                                    foreach ($tracemisejours as $t => $tracemisejour) {
                                        $personnel = $connection->execute('SELECT * FROM personnels WHERE id=' . $tracemisejour['user']['personnel_id'] . '; ')->fetch('assoc');
                                        $operation = "";
                                        if ($tracemisejour['operation'] == 'edit' || $tracemisejour['operation'] == 'modification') {
                                            $operation = "modification";
                                        } else if ($tracemisejour['operation'] == 'add' || $tracemisejour['operation'] == 'ajout') {
                                            $operation = "creation";
                                        } else if ($tracemisejour['operation'] == 'duplicate') {
                                            $operation = "duplication";
                                        } else {
                                            $operation = "suppression";
                                        }
                                        ?>
                                        <tr>
                                            <td> <a href="../../personnels/view/<?php echo $tracemisejour['user']['personnel_id'] ?>"
                                                    style="text-decoration: underline;">
                                                    <?php echo $personnel['nom'] . ' ' . $personnel['prenom'] ?></a>
                                            </td>
                                            <td><?php echo $tracemisejour['date']->format("Y-m-d") . ' ' . $tracemisejour['heure']; ?>
                                            </td>
                                            <td><?php echo $operation ?></td>
                                        </tr>
                                    <?php } ?>




                                </table>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

</section>
<script>
    function openWindow(h, w, url) {
        leftOffset = screen.width / 2 - w / 2;
        topOffset = screen.height / 2 - h / 2;
        window.open(
            url,
            this.target,
            "left=" +
            leftOffset +
            ",top=" +
            topOffset +
            ",width=" +
            w +
            ",height=" +
            h +
            ",resizable,scrollbars=yes"
        );
    }
</script>
<script>
    $(document).ready(function () {
        $('.telimp').on('click', function () {
            id = $(this).attr('index');
            var currentUrl = window.location.href;
            var parentUrl = currentUrl.split('/').slice(0, 4).join('/');
            var link = parentUrl + "/Projets/downloadPdfimp/" + id;
            window.location.href = link;
        });
        $('.envoyerbuttonfr').on('click', function () {

            id = $(this).attr("demande"); //alert(id)
            type = $(this).attr("typeof");
            idf = $(this).attr("idf");
            idfour = $(this).attr("idfour");
            fmail = $(this).attr("fmail");
            $('#id_demande').val(id);
            $('#typeof').val(type);
            $('#name').val(idf);
            $('#email').val(fmail);
            $('#four_id').val(idfour);
            //console.log(id)
            //document.getElementById('action-button').addEventListener('click', function() {
            //});
            togglePopup111111();

        });
        $('.envoyerbuttoncom').on('click', function () {
            // alert('2222');
            id = $(this).attr("demande"); //alert(id)
            type = $(this).attr("typeof");
            idf = $(this).attr("idf");
            idfour = $(this).attr("idfour");
            fmail = $(this).attr("fmail");
            $('#id_comm').val(id);
            $('#typecom').val(type);
            $('#namecom').val(idf);
            $('#emailcom').val(fmail);
            $('#fourni_id').val(idfour);
            //console.log(id)
            //document.getElementById('action-button').addEventListener('click', function() {
            //});
            togglePopupcom();
        });
        $('.impfichier').on('click', function () {

            idprojet = $(this).attr("index"); //alert(id)
            idcommande = $(this).attr("indexx");
            $('#projectid').val(idprojet);
            $('#commandeclientid').val(idcommande);
            popupOverlayimp();
        });
        $('.envoyerbuttoncomcli').on('click', function () {
            // alert('2222');
            id = $(this).attr("demande"); //alert(id)
            type = $(this).attr("typeof");
            idf = $(this).attr("idf");
            idfour = $(this).attr("idfour");
            fmail = $(this).attr("fmail");
            $('#id_commcli').val(id);
            $('#typecomcli').val(type);
            $('#namecomcli').val(idf);
            $('#emailcomcli').val(fmail);
            $('#cli_id').val(idfour);
            //console.log(id)
            //document.getElementById('action-button').addEventListener('click', function() {
            //});
            togglePopupcomcli();
        });
        $('.envoyer').on('click', function () {
            // imprimer();
            id = $('#id_demande').val(); //alert(id)
            type = $('#typeof').val(); //alert(type)
            name = $('#name').val(); //alert(name)
            mail = $('#email').val(); //alert(mail)
            four_id = $('#four_id').val(); //alert(mail)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'commandefournisseurs', 'action' => 'envoyer']) ?>",
                dataType: "html",
                data: {
                    id: id,
                    type: type,
                    name: name,
                    mail: mail,
                    four_id: four_id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    togglePopup111111();
                    //$('#categclient').val(data.valeurcategorie);
                }
            })
        });
        $('.envoyercom').on('click', function () {
            // imprimer();
            id = $('#id_comm').val(); //alert(id)
            type = $('#typecom').val(); //alert(type)
            name = $('#namecom').val(); //alert(name)
            mail = $('#emailcom').val(); //alert(mail)
            four_id = $('#fourni_id').val(); //alert(mail)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'commandefournisseurs', 'action' => 'envoyercom']) ?>",
                dataType: "html",
                data: {
                    id: id,
                    type: type,
                    name: name,
                    mail: mail,
                    four_id: four_id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    togglePopupcom();
                    //$('#categclient').val(data.valeurcategorie);
                }
            })
        });
        $('.envoyercomcli').on('click', function () {
            // imprimer();
            id = $('#id_commcli').val(); //alert(id)
            type = $('#typecomcli').val(); //alert(type)
            name = $('#namecomcli').val(); //alert(name)
            mail = $('#emailcomcli').val(); //alert(mail)
            four_id = $('#cli_id').val(); //alert(mail)
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'commandeclients', 'action' => 'envoyercomcli']) ?>",
                dataType: "html",
                data: {
                    id: id,
                    type: type,
                    name: name,
                    mail: mail,
                    four_id: four_id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    togglePopupcomcli();
                    //$('#categclient').val(data.valeurcategorie);
                }
            })
        });
    });

    function togglePopup111111() {

        //console.log(id)
        const overlay = document.getElementById('popupOverlay');
        overlay.classList.toggle('show');
    }

    function togglePopupcom() {
        //console.log(id)
        const overlay = document.getElementById('popupOverlaycom');
        overlay.classList.toggle('show');
    }

    function togglePopupcomcli() {
        //console.log(id)
        const overlay = document.getElementById('popupOverlaycomcli');
        overlay.classList.toggle('show');
    }
    function popupOverlayimp() {
        const overlay = document.getElementById('popupOverlayimp');
        overlay.classList.remove('hide'); // Assurez-vous que 'hide' est retiré
        overlay.classList.add('show'); // Ajoutez 'show'
    }

    function despopupOverlayimp() {
        const overlay = document.getElementById('popupOverlayimp');
        overlay.classList.remove('show'); // Assurez-vous que 'show' est retiré
        overlay.classList.add('hide'); // Ajoutez 'hide'
    }
    /*   function popupOverlayimp() {
           //console.log(id)
           
           const overlay = document.getElementById('popupOverlayimp');
           overlay.classList.toggle('show');
       }   function despopupOverlayimp() {
           //console.log(id)
           const overlay = document.getElementById('popupOverlayimp');
           overlay.classList.toggle('hide');
       }*/
</script>
<div id="popupOverlay" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: green;">Envoyer vers le fournisseur</h2>
        <div class="form-container">
            <label class="form-label" for="name">
                Nom du Fournisseur:
            </label>
            <input class="form-input" type="text" placeholder="Enter Your Fournisseur" id="name" name="name" required>

            <label class="form-label" for="email">Email:</label>
            <input class="form-input" type="email" placeholder="Enter Your Email" id="email" name="email" required>
            <input class="form-input" type="hidden" id="id_demande" name="id_demande">
            <input class="form-input" type="hidden" id="typeof" name="typeof">
            <input class="form-input" type="hidden" id="four_id" name="four_id">
            <button class="btn-envoyer envoyer">
                Envoyer
            </button>
        </div>

        <button class="btn-close-popup" onclick="togglePopup111111()">
            Close
        </button>
    </div>
</div>
<div id="popupOverlaycom" class="overlay-container">
    <div class="popup-box">
        <h2 style="color: green;">Envoyer vers le fournisseur</h2>
        <div class="form-container">
            <label class="form-label" for="namecom">
                Nom du Fournisseur:
            </label>
            <input class="form-input" type="text" placeholder="Enter Your Fournisseur" id="namecom" name="namecom"
                required>

            <label class="form-label" for="emailcom">Email:</label>
            <input class="form-input" type="email" placeholder="Enter Your Email" id="emailcom" name="emailcom"
                required>
            <input class="form-input" type="hidden" id="id_comm" name="id_comm">
            <input class="form-input" type="hidden" id="typecom" name="typecom">
            <input class="form-input" type="hidden" id="fourni_id" name="fourni_id">
            <button class="btn-envoyer envoyercom">
                Envoyer
            </button>
        </div>

        <button class="btn-close-popup" onclick="togglePopupcom()">
            Close
        </button>
    </div>
</div>
<script>
    $(document).ready(function () {
        var param;
        $(".closepop").on("click", function () {
            //alert(client);

            despopupOverlayimp();
        });
        $(".besach").on("click", function () {
            ligne = $(this).attr("ligne");
            // alert(ligne);
            index = $("#indexx").val();
            // alert(index);
            param = $('#projet_id' + ligne).val();
            // alert(param);
            test = 0;
            for (i = 0; i <= Number(index); i++) {
                if ($("#check" + i).is(":checked")) {
                    test = test + 1;
                    // alert(test);
                }
            }
            if (test == 1) {
                // alert();
                $('.testcheck').show();
                fournisseur = $('#fournisseur_id' + ligne).val();
                article = $('#article_id').val();
                if ($('.tes').val() == 0) {
                    $('.tes').val(fournisseur);
                    $('.tes').val(article);
                }
            }
            if (test == 0) {
                $('.tes').val(0);
                $('.testcheck').hide();
            }
        });


    });
    $('input').on('keyup', function () {
        $('.btn').show();
    });
    $('input').on('keyup', function () {
        $('.btn').show();
    });
    $('#commandee').on('click', function () {

        // console.log(ind);
        param = $('#projet_id' + ligne).val();
        // console.log(param);
        var tab = new Array;
        var conteur = $('.nombre').val();
        for (var i = 0; i <= conteur; i++) {
            var val = ($('#check' + i).attr('checked'));
            var v = $('#check' + i).val();
            if ($('#check' + i).is(':checked')) {
                tab[i] = v;
            }
        }
        var removeItem = undefined;
        tab = jQuery.grep(tab, function (value) {
            return value != removeItem;
        });

        var client = $('.tes').val();
        // alert(tab);
        var currentUrl = window.location.href;
        var parentUrl = currentUrl.split('/').slice(0, 4).join('/');
        // window.open("https://codifaerp.isofterp.com/demo/demandeoffredeprixes/etatcomparatif/" + param + "/" + tab);
        window.location.href = parentUrl+"/projets/etatcomparatif/" + tab + "/" + param;

    });
    $('input').on('keyup', function () {
        $('.btn').show();
    });
    $('input').on('keyup', function () {
        $('.btn').show();
    });
</script>

<!-- <script>
    $(document).ready(function () {
        $('.envoyerbutton').on('click', function () {
            id = $(this).attr("demande");
            type = $(this).attr("typeof");
            $('#id_demande').val(id);
            $('#typeof').val(type);
            //console.log(id)
            togglePopup();

        });
        $('.envoyer').on('click', function () {

            id = $('#id_demande').val();
            type = $('#typeof').val();
            name = $('#name').val();
            mail = $('#email').val();
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'envoyer']) ?>",
                dataType: "html",
                data: {
                    id: id,
                    type: type,
                    name: name,
                    mail: mail,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    togglePopup();
                    //$('#categclient').val(data.valeurcategorie);
                }
            })

        });

    });
    function togglePopup() {

        //console.log(id)
        const overlay = document.getElementById('popupOverlay');
        overlay.classList.toggle('show');
    }
</script> -->
<style>
    .btn-open-popup:hover {
        background-color: #4C58AF;
    }

    .overlay-container {
        display: none;
        position: fixed;
        top: 20%;
        left: 0;
        width: 100%;
        height: 100%;
        background: transparent;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        margin-left: 40%;

    }

    .popup-box {
        background: #fff;
        padding: 24px;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.4);
        width: 320px;
        text-align: center;
        opacity: 0;
        transform: scale(0.8);
        animation: fadeInUp 0.5s ease-out forwards;
    }

    .form-container {
        display: flex;
        flex-direction: column;
    }

    .form-label {
        margin-bottom: 10px;
        font-size: 16px;
        color: #444;
        text-align: left;
    }

    .form-input {
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
        width: 100%;
        box-sizing: border-box;
    }

    .btn-envoyer,
    .btn-close-popup {
        padding: 12px 24px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-envoyer {
        background-color: green;
        color: #fff;
    }

    .btn-close-popup {
        margin-top: 12px;
        background-color: #e74c3c;
        color: #fff;
    }

    .btn-envoyer:hover,
    .btn-close-popup:hover {
        background-color: #4caf50;
    }

    /* Keyframes for fadeInUp animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Animation for popup */
    .overlay-container.show {
        display: flex;
        opacity: 1;
    }

    .btn-purple {
        background-color: #43899E;
        /* Changer la couleur de fond en violet */
        color: white;
        /* Changer la couleur du texte en blanc ou autre couleur lisible */
    }
</style>

<script>
    $(function () {
        $('.deletedof').on('click', function () {
            ind = $(this).attr('index');
            id = $('#id' + ind).val();
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'verifdeldof']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    if (data.bande != 0) {
                        alert('Demande offre de prix  déja existe dans un bande de consultation');
                    } else {
                        if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
                            var currentUrl = window.location.href;
                            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
                            var link = parentUrl + "/Projets/deletedof/" + id;
                            window.location.href = link;
                        }
                    }
                }
            })
        });
        $('.deletefacclient').on('click', function () {
            ind = $(this).attr('index');
            id = $('#idfaccli' + ind).val();
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'veriffacclient']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    if (data.lignereg != 0) {
                        alert('Facture déja existe dans un reglement');
                    } else {
                        if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
                            var currentUrl = window.location.href;
                            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
                            var link = parentUrl + "/Projets/deletefaccli/" + id;
                            window.location.href = link;
                        }
                    }
                }
            })
        });
        $('.deletefacfour').on('click', function () {
            ind = $(this).attr('index');
            id = $('#idfacfour' + ind).val();
            $.ajax({
                method: "GET",
                url: "<?= $this->Url->build(['controller' => 'Projets', 'action' => 'veriffacfour']) ?>",
                dataType: "json",
                data: {
                    id: id,
                },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
                },
                success: function (data) {
                    if (data.regl != 0) {
                        alert('Facture achat  déja existe dans un reglement');
                    } else {
                        if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
                            var currentUrl = window.location.href;
                            var parentUrl = currentUrl.split('/').slice(0, -3).join('/');
                            var link = parentUrl + "/Projets/deletefacfour/" + id;
                            window.location.href = link;
                        }
                    }
                }
            })
        });
    });
</script>
<style>
    .boutons-container {
        padding: 5px 10px;

        display: flex;
        align-items: center;
        justify-content: flex-end;
    }

    .color {
        background-color: #2A8403;
        color: green;
    }



    .button {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-left: 5px;
        margin-right: 5px;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .button:hover {
        background-color: #2980b9;
    }
</style>
<style>
    .btn-animated {
        animation: moveInBottom 5s ease-out;
        animation-fill-mode: backwards;
    }

    @keyframes moveInBottom {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }

        100% {
            opacity: 1;
            transform: translateY(0px);
        }
    }
</style>