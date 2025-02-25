<?php

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
use App\Model\Table\SignaturesTable; ?>
<?php $this->layout = 'AdminLTE.printt';
$connection = ConnectionManager::get('default');

$session = $this->request->getSession();

$authData = $session->read('Auth');
//$Projets = new ProjetsTable();

//$projet = $connection->execute('Select * from projets,devises where projets.id=' . $commandeclient->id . ' and projets.devise_id=devises.id');
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$domainName = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

$baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

$wr = $protocol . $domainName.$baseSegment;
if ($authData && is_object($authData)) {
    $personnelId = $authData->personnel_id;
    $signaturesTable = new SignaturesTable();
    $userSignature = $signaturesTable->find()
        ->where(['personnel_id' => $personnelId])
        ->first();
    if ($userSignature) {
        // $filename = urlencode($userSignature->filename);
        // debug($userSignature->filename);
        $signatureData = file_get_contents( $wr.'/webroot/img/logosignature/' . $userSignature->filename);
        if ($signatureData !== false) {
            $base64Signature = 'data:image/png;base64,' . base64_encode($signatureData);
        } else {
            echo 'Impossible de charger la signature.';
        }
    }
}

?>
<?php
$imageUrl =  $wr.'/webroot/img/logoggb.png';
$imageData = file_get_contents($imageUrl);
if ($imageData !== false) {
    $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
}
$footerUrl = $wr.'/webroot/img/footer.png';
$footerData = file_get_contents($footerUrl);
if ($footerData !== false) {
    $base64footer = 'data:image/png;base64,' . base64_encode($footerData);
}
$lignecommandeclient2s = $connection->execute("SELECT lc.* FROM lignecommandeclients lc INNER JOIN ( SELECT article_id, MAX(prixht) AS max_price FROM lignecommandeclients WHERE lignecommandeclients.type=2 and commandeclient_id='" . $commandeclient->id . "' GROUP BY article_id) AS max_prices ON lc.article_id = max_prices.article_id AND lc.prixht = max_prices.max_price WHERE lc.commandeclient_id='" . $commandeclient->id . "'")->fetchAll('assoc');
/* $commandeclient->devis_id=$projets[0]['projets']['devise_id'];
$commandeclient->devise->name=$projets[0]['devises']['name'];
$commandeclient->devise->code=$projets[0]['devises']['code']; */
?>
<br>

<style>
    @media print {
        .content-header {
            page-break-before: always;
            display: none;

        }
    }

    #tabligne1 {
        border-collapse: collapse;
        width: 100%;
    }

    #tabligne1 th,
    #tabligne1 td {
        padding: 5px;
        text-align: center;
        border: 1px solid #ccc;
    }

    #tabligne1 th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: -30px;
    }

    .header {
        display: flex;
        margin-bottom: 20px;
    }

    .logo {
        margin-left: 6%;
    }

    .company-info {
        width: 75%;
        margin-left: 23%;
        font-size: 14px;
        line-height: 1.5;
    }

    .box {
        border: 1px solid #FFFFFF;
        padding: 5px;
    }

    h3 {
        color: red;
        font-family: monospace;
        text-align: center;
        margin-top: 40px;
    }

    .row {
        margin: 0 auto;
        margin-left: 20px;
        margin-right: 20px;
        position: static;
    }

    .col-xs-6 {
        width: 50%;
        float: left;
    }

    .field-container {
        border: 1px solid black;
        padding: 5px;
        margin-bottom: 10px;
    }

    .field-container .field-label {
        font-weight: bold;
    }

    .field-container .field-value {
        margin-top: 5px;
    }

    .field-value {
        border: 1px solid black;
        padding: 5px;
        min-height: 20px;
    }
</style>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 5px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    /* tr:nth-child(even) {
        background-color: #f2f2f2;
    } */
</style>
<style>
    .boxgris {
        position: relative;
        background: #E6E6E6;
        width: 50%;
        color: #000040;
    }

    .boxblanc {
        position: relative;
        border: 1px solid #B3B4B2;
        background: #ffffff;
        width: 50%;
        color: #000000;
    }

    .boxbordergray {
        position: relative;
        border: 1px solid #B3B4B2;
        /* Utilisation d'une teinte de gris plus claire */
        background: #FFFFFF;
        width: 99%;
        color: #000000;
    }


    .boxbordergris {
        position: relative;
        border: 1px solid #DADADA;
        background: #ffffff;
        width: 99%;
        color: #000000;
    }
</style>
<?php //debug($fournisseur);
$connection = ConnectionManager::get('default');

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<div style="position: relative; top: 0;">
    <!-- Bande noire continue -->
    <div style="background-color: black; height: 60px;width:110%;margin-top:-30px;margin-left:-20px"></div>

    <div style="position: absolute; top: 20px; left: 10%; transform: translateX(-50%); z-index: 1;">

        <?php echo '<img src="' . $base64Image . '" alt="Image" height="125px" width="140px">'; ?>
    </div>
</div>

<div style="margin:30px">

    <div style="width: 87%;height: 20px;margin-left:70%;margin-right:20%; margin-top: -30px;">
        <div style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.3em; ">
            <strong>Commande fournisseur <?php echo $commandefournisseur->numero ?>

            </strong><br>
        </div>

        <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
            Date prévue de livraison :
            <?php $dateprev = $commandefournisseur->dateprev;
            if ($dateprev) {
                $date = $dateprev->format('Y-m-d');
                echo $date;
            } ?>
        </div>
        <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
            Code fournisseur :
            <?= h($commandefournisseur->fournisseur->code) ?>
        </div>

    </div>
    <br><br>
    <br><br><br><br>
    <div style="display:flex">
        <div style="width: 60%; margin-left:-1%;font-size: 12px;margin-top:1%;">
            Émetteur:
        </div>
        <div style=" width: 60%; margin-left:48%;font-size: 12px;margin-top:-4%;">
            Adressé à:
        </div>
    </div>
    <div style="display:flex">
        <div class="boxgris" style="width: 47%;height: 160px;margin-left:-1%;">
            <div style="margin-top:1%; margin-left:3%;font-size: 13px;">
                <br>
                <strong>
                    <?= h($societes->nom) ?>
                </strong>
                <br>
                <?= h($societes->adresse) ?>
                <br><br>
                Tél.:
                <?= h($societes->tel) ?>
                <br>
                Email :
                <?= h($societes->mail) ?>
                <br>
                WEB :
                <?= h($societes->site) ?>
                <br>
            </div>
            <br>
        </div>
        <div class="boxblanc" style="width: 55%;height: 160px;margin-left:48%;font-size: 13px;margin-top:-22.59%; ">
            <div style="margin-left:1%">
                <strong>
                    <?= h($fournisseur->name) ?>
                </strong>
                <br>
                <?= h($fournisseur->adresse) ?>
                <br>
                <?= h($fournisseur->port) ?>
                <br>
                <?= h($fournisseur->Code_VilleL) ?>
                Téléphone:
                <?= h($fournisseur->tel) ?>
                <br>
                Fax :
                <?= h($fournisseur->fax) ?>
                <br>
                Email :
                <?= h($fournisseur->mail) ?>
            </div>
        </div>
    </div>


    <div class="boxbordergray" style="width: 104%; height: 19px; margin-left: -1%; margin-right: 5%;margin-top: -3%;">
        <div style="font-size: 13px;">
            Incoterm :
            <span style="color: red; font-weight: bold;">
                <?= h($commandefournisseur->incoterm->code); ?>
                <?php if ($commandefournisseur->fournisseur->port != '') {

                    ?>-
                <?php }
                h($commandefournisseur->fournisseur->port); ?>
                <?php if ($commandefournisseur['pay'] != '') {
                    #
                    ?>- <?php }
                echo $commandefournisseur['pay'] ?>
            </span>
        </div>
    </div>
    <br>
    <div style="width: 87%;height: 20px;margin-left:-1%;margin-right:5%;margin-top:-1.5%;">
        <div style="font-size: 12px;">
            Montants exprimés en
            <?php $devise = $commandefournisseur->devise_id;
            if ($devise) {
                $Devise = $commandefournisseur->devise->name; ?>
                <?= h($Devise) ?>
            <?php } ?>
        </div>
    </div>
    <br>
    <div class="" style="width: 104%;height :600px; margin-left:-1%;margin-right:5%;">
        <div class="panel-body">
            <div class="table-responsive ls-table">
                <table style="width: 100%; min-height: 600px;">
                    <thead>
                        <tr height="7px">
                            <td align="center" class="solid-border" style="width: 10%;border:1px solid gray;">
                                Référence
                            </td>
                            <!--  <td align="center" class="solid-border" style="width: 30%;border:1px solid gray;">
                                Désignation
                            </td> -->
                            <td align="center" class="solid-border" style="width: 30%;border:1px solid gray;">
                                Déscription
                            </td>
                            <td align="center" class="solid-border" style="width: 10%;border:1px solid gray;">
                                P.U.H.T
                            </td>
                            <td align="center" class="solid-border" style="width: 5%;border:1px solid gray;">
                                Qté
                            </td>
                            <td align="center" class="solid-border" style="width: 5%;border:1px solid gray;">
                                Unité
                            </td>
                            <td align="center" class="solid-border" style="width: 10%;border:1px solid gray;">
                                Total HT
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lignecommandefournisseurs as $lignecommande):
                            $qte = $lignecommande->qte;
                            $prix = $lignecommande->prix;
                            $montant = $qte * $prix;
                            // debug($lignecommande);
                            ?>
                            <tr class="tr">
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                    style="vertical-align:top;height: 1px;">
                                    <?php echo h($lignecommande->article->Refggb); ?>
                                </td>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                    style="vertical-align:top;">
                                    <?php
                                    if (isset($lignecommande->article)) {
                                        echo h($lignecommande->article->Dsignation . ' ' . $lignecommande->article->Description);
                                    }
                                    // debug($lignecommande->article->Dsignation);
                                    ?>
                                </td>

                                <?php if ($Devise === 'Dollars US'): ?>
                                    <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                        style="vertical-align:top;">
                                        <?= $lignecommande->prix ?> $
                                    </td>
                                <?php elseif ($Devise === 'Euro'): ?>
                                    <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                        style="vertical-align:top;">
                                        <?= $lignecommande->prix ?> €
                                    </td>
                                <?php else: ?>
                                    <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                        style="vertical-align:top;">
                                        <?= $lignecommande->prix ?>
                                    </td>
                                <?php endif; ?>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                    style="vertical-align:top;">
                                    <div style="margin-left: 25% ;">
                                        <?= $lignecommande->qte;
                                        // debug($lignecommande->qte); ?>
                                    </div>
                                </td>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                    style="vertical-align:top;">
                                    <?php $connection = ConnectionManager::get('default');
                                    $art = $connection->execute("SELECT unite_id FROM articles WHERE id = '" . $lignecommande->article_id . "'")->fetchAll('assoc');
                                    $unite_id = $art[0]['unite_id'];
                                    // debug($art);
                                    $unite = $connection->execute("SELECT name FROM unites ")->fetchAll('assoc');
                                    $name = $unite[0]['name'];
                                    // debug($unite);
                                    echo $name;
                                    ?>
                                </td>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                    style="vertical-align:top;">
                                    <?php if ($Devise === 'Dollars US'): ?>
                                        <?php echo sprintf("%01.2f", str_replace(",", ".", $montant)) ?> $
                                    <?php elseif ($Devise === 'Euro'): ?>
                                        <?php echo sprintf("%01.2f", str_replace(",", ".", $montant)) ?> €
                                    <?php else: ?>
                                        <?php echo sprintf("%01.2f", str_replace(",", ".", $montant)) ?>
                                    <?php endif; ?>
                                </td>
                                <?php
                                $total = $total + $montant;
                                // debug($total);
                                ?>

                            </tr>
                        <?php endforeach; ?>
                        <tr>

                            <td style="border:1px solid gray;vertical-align:top;height: max-content;"></td>
                            <td style="border:1px solid gray;vertical-align:top;height: max-content;"></td>
                            <td style="border:1px solid gray;vertical-align:top;height: max-content;"></td>
                            <td style="border:1px solid gray;vertical-align:top;height: max-content;"></td>
                            <td style="border:1px solid gray;vertical-align:top;height: max-content;"></td>
                            <td style="border:1px solid gray;vertical-align:top;height: max-content;"></td>


                        </tr>
                        <tr>
                            <?php $totalttc = $commandeclient->totalht + $commandeclient->total_transport;
                if ($commandeclient->devise_id) {
                    $totalttcTN = $totalttc * $commandeclient->devise->taux;
                }
                $projet_id = $commandeclient->projet_id;
                $connection = ConnectionManager::get('default');
                $projet = $connection->execute("SELECT banque_id FROM projets WHERE id = '" . $projet_id . "'")->fetchAll('assoc');
                $banq = $banque[0]['name'];
                $connection = ConnectionManager::get('default');
                if ($projet[0]['banque_id'] != null) {
                    # code...
                
                    $banque = $connection->execute("SELECT * FROM banques WHERE id = '" . $projet[0]['banque_id'] . "'")->fetchAll('assoc');
                    $banq = $banque[0]['name'];
                    $proprietaire = $banque[0]['proprietaire'];
                    $bicswift = $banque[0]['codeBicswift'];
                    $condreg = $banque[0]['conditionReglement'];
                }
                            ?>
                            <td colspan="2" style="border: none; vertical-align: top;padding-left: 0 !important;">
                                <div style="margin-left:1%; font-size: 12px;">
                                    <strong>Arrêter la présente Proposition commerciale à la somme de :</strong>
                                </div>
                                <div class="boxbordergray" style="height: 35px;width:99% !important;  font-size: 12px;">
                                    <div style="margin-left: 1%;">
                                        <?php

                                        function ucfirst_minuscule($phrase)
                                        {
                                            // Supprimer les espaces inutiles avant et après la chaîne
                                            $phrase = trim($phrase);

                                            // Met tout en minuscules (gestion UTF-8)
                                            $phrase = mb_strtolower($phrase, 'UTF-8');

                                            // Met le premier caractère en majuscule (gestion UTF-8)
                                            $phrase = mb_ucfirst($phrase);

                                            return $phrase;
                                        }

                                        // Fonction personnalisée pour ucfirst avec gestion UTF-8
                                        function mb_ucfirst($string, $encoding = 'UTF-8')
                                        {
                                            if (empty($string)) {
                                                return $string; // Si la chaîne est vide, on la retourne directement
                                            }

                                            // Extraire le premier caractère et le reste de la chaîne
                                            $firstChar = mb_substr($string, 0, 1, $encoding);
                                            $rest = mb_substr($string, 1, null, $encoding);

                                            // Retourner le premier caractère en majuscule + le reste de la chaîne
                                            return mb_strtoupper($firstChar, $encoding) . $rest;
                                        }

                                        if ($commandeclient->devise->name === 'Dollars US'):
                                            echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)), 2, ''));
                                        elseif ($commandeclient->devise->name === 'Euro'):
                                            echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)), 3, ''));

                                        else:
                                            echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)), 1, ''));

                                        endif;
                                        //echo ucfirst(int2str(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)))); ?>
                                    </div>
                                </div>



                            </td>
                            <td colspan="2" rowspan="2" style="vertical-align: top;text-align:left">

                                <div>
                                    Total
                                    <?php
                                    echo $commandeclient->incoterm->code;
                                    $connection = ConnectionManager::get('default');
                                    if ($commandeclient['pay_id']) {
                                        # code...
                                    
                                        $payy = $connection->execute("SELECT * FROM pays  WHERE id='" . $commandeclient['pay_id'] . "' ;")->fetchAll('assoc');
                                        $nampayy = $payy[0]['name'];
                                    }

                                    // echo  $commandeclient['pay']
                                    ?>

                                </div>
                                <?php
                                //echo $total_transportt;
                                if ($total_transportt != 0 && $total_transportt != '') { ?>
                                    <div style="margin-top:5%">
                                        <?php echo $lignecommandeclient2sdes['description'];
                                        if ($lignecommandeclient2sdes['description'] == '') {
                                            echo "<br>";
                                        }

                                        ?>

                                    </div>

                                <?php } ?>


                                <?php if ($total_transportt != 0 && $tot_remisetransport != 0 && $commandeclient->activeremisetransport == 1) { ?>

                                    <div style="margin-top:5%">
                                        Remise :
                                    </div>


                                <?php } ?>
                              
                                <?php $remiseglobale = $commandeclient->totalremise - $tot_remisetransport;
                                if ($remiseglobale != 0 && $commandeclient->activeremise == 1) { ?>

                                    <div style="margin-top:5%">
                                        Remise :


                                    </div>
                                <?php } ?>

                                <div style="margin-top:5%">
                                    Total :

                                    <?php

                                    if ($commandeclient['incotermpdf_id']) {
                                        # code...
                                    
                                        $incotermpdf = $connection->execute("SELECT code FROM incoterms  WHERE id='" . $commandeclient['incotermpdf_id'] . "' ;")->fetchAll('assoc');

                                        echo $incotermpdf[0]['code'];
                                    }
                                    // if ($commandeclient->client->port) { ?><?php //echo $commandeclient->client->port;
                                    // }
                                    if ($commandeclient['pay'] != '') {
                                        #
                                        ?>- <?php }
                                    echo $commandeclient['pay'] ?>
                                </div>

                            </td>
                            <td rowspan="2" colspan="2" align="end" style="vertical-align: top;text-align:right">
                                <div>
                                    <?php echo number_format((float) str_replace(",", ".", $tt_TotalHT), $virg, '.', ' ');
                                    //   echo sprintf("%01." . $virg . "f", str_replace(",", ".", ' ',$tt_TotalHT)); ?>
                                    <?php if ($commandeclient->devis_id) {
                                        echo $commandeclient->devise->code;
                                    } ?>
                                </div>
                                <?php if ($total_transportt != 0) { ?>
                                    <div style="margin-top:5%">
                                        <?php



                                        //$total_transportt=(float)$commandeclient->total_transport*(float)$i;
                                        echo number_format((float) str_replace(",", ".", $total_transportt), $virg, '.', ' ');
                                        //echo sprintf("%01." . $virg . "f", str_replace(",", ".", $total_transportt)); ?>
                                        <?php if ($commandeclient->devis_id) {
                                            echo $commandeclient->devise->code;
                                        } ?>
                                    </div>
                                <?php } ?>
                                <?php if ($total_transportt != 0 && $tot_remisetransport != 0 && $commandeclient->activeremisetransport == 1) { ?>

                                    <div style="margin-top:5%">
                                        <?php



                                        //$total_transportt=(float)$commandeclient->total_transport*(float)$i;
                                        echo number_format((float) str_replace(",", ".", $tot_remisetransport), $virg, '.', ' ');
                                        //echo sprintf("%01." . $virg . "f", str_replace(",", ".", $tot_remisetransport)); ?>
                                        <?php if ($commandeclient->devis_id) {
                                            echo $commandeclient->devise->code;
                                        } ?>
                                    </div>

                                <?php } ?>
                                <?php $remiseglobale = $commandeclient->totalremise - $tot_remisetransport;
                                if ($remiseglobale != 0 && $commandeclient->activeremise == 1) { ?>

                                    <div style="margin-top:5%">
                                        <?php
                                        echo number_format((float) str_replace(",", ".", $remiseglobale), $virg, '.', ' ');
                                        // echo sprintf("%01." . $virg . "f", str_replace(",", ".", ($remiseglobale))); ?>
                                        <?php if ($commandeclient->devis_id) {
                                            echo $commandeclient->devise->code;
                                        } ?>
                                    </div>

                                <?php } ?>

                                <div style="margin-top:5%">
                                    <?php
                                    echo number_format((float) str_replace(",", ".", $commandeclient->totalttc), $virg, '.', ' ');
                                    //echo sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)); ?>
                                    <?php if ($commandeclient->devis_id) {
                                        echo $commandeclient->devise->code;
                                    } ?>
                                </div>


                            </td>
                        </tr>

                    </tbody>
                </table>

                <?php $totalttc = $commandeclient->totalht + $commandeclient->total_transport;
                if ($commandeclient->devise_id) {
                    $totalttcTN = $totalttc * $commandeclient->devise->taux;
                }
                $projet_id = $commandeclient->projet_id;
                $connection = ConnectionManager::get('default');
                $projet = $connection->execute("SELECT banque_id FROM projets WHERE id = '" . $projet_id . "'")->fetchAll('assoc');
                $banque = $connection->execute("SELECT name FROM banques WHERE id = '" . $projet[0]['banque_id'] . "'")->fetchAll('assoc');
                $banq = $banque[0]['name'];
                ?>

                <div style="display: flex; justify-content: space-between;">
                    <div style="width: 60%;">

                        <?php

                        $connection = ConnectionManager::get('default');
                        if ($projet[0]['banque_id'] != null) {
                            # code...
                        
                            $banque = $connection->execute("SELECT * FROM banques WHERE id = '" . $projet[0]['banque_id'] . "'")->fetchAll('assoc');
                            $banq = $banque[0]['name'];
                            $proprietaire = $banque[0]['proprietaire'];
                            $bicswift = $banque[0]['codeBicswift'];
                            $condreg = $banque[0]['conditionReglement'];
                        }
                        ?>
                        <div style="margin-left: 3%; margin-right: 5%;font-size: 12px;">
                            <strong>Arrêter la présente Proposition commerciale à la somme de :</strong>
                        </div>

                        <div class="boxbordergray" style="height: 30px;  margin-right: 5%;font-size: 12px;">
                            <div style="margin-left: 3%;">
                                <?php

                              

                                if ($commandeclient->devise->name === 'Dollars US'):
                                    echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)), 2, ''));
                                elseif ($commandeclient->devise->name === 'Euro'):
                                    echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)), 3, ''));

                                else:
                                    echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)), 1, ''));

                                endif;
                                //echo ucfirst(int2str(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)))); ?>
                                <?php //echo ucfirst(int2str(sprintf("%01.3f", str_replace(",", ".", $total)))); ?>
                            </div>
                        </div>
                        <div style="margin-left: 0%; margin-right: 5%;padding-top: -2%;">
                            <strong>Conditions de règlement : </strong>
                            <?php echo $commandeclient->conditinreglement->condionn; ?>
                        </div><br>
                        <div style="margin-left: 0%; margin-right: 5%;padding-top: -2%;">
                            <strong style="display: inline-block;">Mode de reglement :
                            </strong>&nbsp;&nbsp;&nbsp;&nbsp;
                            Virement bancaire
                        </div><br>


                    </div>
                    <div style="width: 50%;margin-left: 59%;margin-top:-23%;font-size: 13px;">
                        <div style="display: flex; justify-content: space-between;">
                            <div style="margin-left: 40px;width:50%">
                                Total
                                <?php echo $commandefournisseur->incoterm->code ?>
                                <?php if ($commandefournisseur->fournisseur->port != '') {

                                    ?>-
                                <?php }
                                echo $commandefournisseur->fournisseur->port ?>
                                <?php if ($commandefournisseur['pay'] != '') {
                                    #
                                    ?>- <?php }
                                echo $commandefournisseur['pay'] ?>
                            </div>
                            <div style="margin-left: 180px;margin-top: -5%;">
                                <?php echo sprintf("%01.3f", str_replace(",", ".", $total)); ?>
                                <?php if ($commandefournisseur->devise_id) {
                                    echo $commandefournisseur->devise->code;
                                } ?>
                            </div>






                        </div>



                    </div>
                </div>
                <?php if ($userSignature): ?>
                    <?php echo '<img src="' . $base64Signature . '" alt="Image" height="80px" width="200px" style="float: right; margin-top: 20px; margin-right: 10px;">'; ?>
                <?php endif; ?>
            </div>
        </div>
        <!-- <div class="footerr-text">
            <?php echo '<img src="' . $base64footer . '" alt="Image" height="65px" width="650px">'; ?>
        </div> -->
    </div>
</div>
<style>
    #border {
        border-left-width: 1px;
        border-right-width: 1px;
        border-top-width: 2px;
        border-bottom-width: 2px;
        border-left-style: solid;
        border-right-style: solid;
        border-top-style: dotted;
        border-bottom-style: dotted;
        border-color: gray;
    }

    #bordertop {
        border-left-width: 1px;
        border-right-width: 1px;
        border-top-width: 1px;
        border-bottom-width: 1px;
        border-left-style: solid;
        border-right-style: solid;
        border-top-style: solid;
        border-bottom-style: solid;
        border-color: gray;
    }
</style>
<style>
    .solid-border {
        border-width: 1px;
        border-style: solid;
        border-color: gray;
    }

    .dotted-border {
        border-left-width: 1px;
        border-right-width: 1px;
        border-top-width: 1px;
        border-bottom-width: 2px;
        border-left-style: solid;
        border-right-style: solid;
        border-top-style: dotted;
        border-bottom-style: dotted;
        border-color: gray;
    }
</style>

<style>
    .footerr-text {
        position: fixed;
        /* bottom: -1px; */
        /*margin-top: 200px;
        margin-left: 50px;
        /* left: 35px; */
        /* width: 30px; */
        text-align: center;
    }
</style>
<style>
    /* CSS pour la bordure pointillée */
    table tr:nth-child(even) {
        border-bottom: 0.01px dotted black;
        /* Ligne pointillée entre chaque paire de lignes */
    }
</style>
<?php
function chifre_en_lettre11($montant, $devise1, $devise2)
{

    if (($devise1 == 1))
        $dev1 = 'Dinars';
    if (($devise1 == 2))
        $dev1 = 'Dollars';
    if (($devise1 == 3))
        $dev1 = 'Euro';
    if (($devise1 == 1))
        $dev2 = 'Millimes';
    if (($devise1 == 2))
        $dev2 = 'Centimes';
    if (($devise1 == 3))
        $dev2 = 'Centimes';
    $parts = explode('.', $montant);
    $valeur_entiere = intval($parts[0]); // Integer part
    $valeur_decimal = intval($parts[1]); // Decimal part as an integer
//  $valeur_entiere=intval($montant);
//  $valeur_decimal=(($montant-intval($montant))*1000);
    //echo $parts[1];
    $dix_c = ($valeur_decimal % 100 / 10);
    $cent_c = intval($valeur_decimal % 1000 / 100);
    $unite_c = $valeur_decimal % 10;
    $unite[1] = $valeur_entiere % 10;
    $dix[1] = intval($valeur_entiere % 100 / 10);
    $cent[1] = intval($valeur_entiere % 1000 / 100);
    $unite[2] = intval($valeur_entiere % 10000 / 1000);
    $dix[2] = intval($valeur_entiere % 100000 / 10000);
    $cent[2] = intval($valeur_entiere % 1000000 / 100000);
    $unite[3] = intval($valeur_entiere % 10000000 / 1000000);
    $dix[3] = intval($valeur_entiere % 100000000 / 10000000);
    $cent[3] = intval($valeur_entiere % 1000000000 / 100000000);

    $dizaines = [
        '',
        'Dix',
        'Vingt',
        'Trente',
        'Quarante',
        'Cinquante',
        'Soixante',
        'Soixante-dix',
        'Quatre-vingts',
        'Quatre-vingt-dix'
    ];
    //echo $unite_c;
    $chif = array('', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf', 'Dix', 'Onze', 'Douze', 'Treize', 'Quatorze', 'Quinze', 'Seize', 'Dix-sept', 'Dix-huit', 'Dix-neuf');
    if (!function_exists('convertir_centaines')) {
    function convertir_centaines($nombre, $chif, $dizaines)
    {
        $centaine = intval($nombre / 100);
        $reste = $nombre % 100;
        $result = '';

        if ($centaine > 0) {
            $result .= ($centaine == 1 ? 'Cent' : $chif[$centaine] . ' Cents');
        }
        if ($reste > 0) {
            if ($reste < 20) {
                $result .= ' ' . $chif[$reste];
            } else {
                $dizaine = intval($reste / 10);
                $unite = $reste % 10;
                $result .= ' ' . $dizaines[$dizaine];
                if ($unite == 1 && $dizaine != 8) {
                    $result .= ' et Un';
                } elseif ($unite > 1) {
                    $result .= '-' . $chif[$unite];
                }
            }
        }
        return trim($result);
    }}

    $secon_c = '';
    $trio_c = '';
    for ($i = 1; $i <= 3; $i++) {
        $prim[$i] = '';
        $secon[$i] = '';
        $trio[$i] = '';
        if ($dix[$i] == 0) {
            $secon[$i] = '';
            $prim[$i] = $chif[$unite[$i]];
        } else if ($dix[$i] == 1) {
            $secon[$i] = '';
            $prim[$i] = $chif[($unite[$i] + 10)];
        } else if ($dix[$i] == 2) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Vingt et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Vingt';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 3) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Trente et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Trente';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 4) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Quarante et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Quarante';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 5) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Cinquante et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Cinquante';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 6) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Soixante et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Soixante';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 7) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Soixante et';
                $prim[$i] = $chif[$unite[$i] + 10];
            } else {
                $secon[$i] = 'Soixante';
                $prim[$i] = $chif[$unite[$i] + 10];
            }
        } else if ($dix[$i] == 8) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Quatre-vingts et';
                $prim[$i] = $chif[$unite[$i]];
            } else {
                $secon[$i] = 'Quatre-vingts';
                $prim[$i] = $chif[$unite[$i]];
            }
        } else if ($dix[$i] == 9) {
            if ($unite[$i] == 1) {
                $secon[$i] = 'Quatre-vingts et';
                $prim[$i] = $chif[$unite[$i] + 10];
            } else {
                $secon[$i] = 'Quatre-vingts';
                $prim[$i] = $chif[$unite[$i] + 10];
            }
        }
        //echo $cent[$i];
        if ($cent[$i] == 1)
            $trio[$i] = 'Cent';
        else if (($cent[$i] != 0 || $cent[$i] != '') && $chif[$cent[$i]] != 0 && $chif[$cent[$i]] != '')
            $trio[$i] = $chif[$cent[$i]] . ' cents';
    }
    $v = "";
    $chif2 = array('', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante-dix', 'Quatre-vingts', 'Quatre-vingt-dix');
    $secon_c = $chif2[$dix_c];
    if ($cent_c == 1)
        $trio_c = 'Cent';
    else if ($cent_c != 0 || $cent_c != '')
        $trio_c = $chif[$cent_c] . ' Cents';
    if (($cent[3] == 0 || $cent[3] == '') && ($dix[3] == 0 || $dix[3] == '') && ($unite[3] == 1))
        $v = $v . ' ' . $trio[3] . '  ' . $secon[3] . ' ' . $prim[3] . ' Million ';
    else if (($cent[3] != 0 && $cent[3] != '') || ($dix[3] != 0 && $dix[3] != '') || ($unite[3] != 0 && $unite[3] != ''))
        $$v = $v . ' ' . $trio[3] . ' ' . $secon[3] . ' ' . $prim[3] . ' Millions ';
    else
        $v = $v . ' ' . $trio[3] . ' ' . $secon[3] . ' ' . $prim[3];
    if (($cent[2] == 0 || $cent[2] == '') && ($dix[2] == 0 || $dix[2] == '') && ($unite[2] == 1))
        $v = $v . ' ' . ' Mille ';
    else if (($cent[2] != 0 && $cent[2] != '') || ($dix[2] != 0 && $dix[2] != '') || ($unite[2] != 0 && $unite[2] != ''))
        $v = $v . ' ' . $trio[2] . ' ' . $secon[2] . ' ' . $prim[2] . ' Milles ';
    else
        $v = $v . ' ' . $trio[2] . ' ' . $secon[2] . ' ' . $prim[2];
    $v = $v . $trio[1] . ' ' . $secon[1] . ' ' . $prim[1];
    $v = $v . ' ' . $dev1 . ' ';
    if (($cent_c == '0' || $cent_c == '') && ($dix_c == '0' || $dix_c == ''))
        // $v=$v.' '. ' et z&eacute;ro '. $dev2;
        $v = $v . ' ';
    else
        //echo $valeur_decimal;
        $v = $v . ' et ' . convertir_centaines($valeur_decimal, $chif, $dizaines) . ' ' . $dev2;
    //$v=$v.' et '.round( $valeur_decimal,0). ' ' . $dev2;
    return $v;
}
function int2strr($a)
{
    $joakim = explode('.', $a);
    if (isset($joakim[1]) && $joakim[1] != '') {
        return int2str($joakim[0]) . ' virgule ' . int2str($joakim[1]);
    }
    if ($a == 0)
        return '';
    if ($a < 0)
        return 'moins ' . int2str(-$a);
    if ($a < 17) {
        switch ($a) {
            case 0:
                return 'zero';
            case 1:
                return 'un';
            case 2:
                return 'deux';
            case 3:
                return 'trois';
            case 4:
                return 'quatre';
            case 5:
                return 'cinq';
            case 6:
                return 'six';
            case 7:
                return 'sept';
            case 8:
                return 'huit';
            case 9:
                return 'neuf';
            case 10:
                return 'dix';
            case 11:
                return 'onze';
            case 12:
                return 'douze';
            case 13:
                return 'treize';
            case 14:
                return 'quatorze';
            case 15:
                return 'quinze';
            case 16:
                return 'seize';
        }
    } else if ($a < 20) {
        return 'dix-' . int2str($a - 10);
    } else if ($a < 100) {
        if ($a % 10 == 0) {
            switch ($a) {
                case 20:
                    return 'vingt';
                case 30:
                    return 'trente';
                case 40:
                    return 'quarante';
                case 50:
                    return 'cinquante';
                case 60:
                    return 'soixante';
                case 70:
                    return 'soixante-dix';
                case 80:
                    return 'quatre-vingt';
                case 90:
                    return 'quatre-vingt-dix';
            }
        } elseif (substr($a, -1) == 1) {
            if (((int) ($a / 10) * 10) < 70) {
                return int2str((int) ($a / 10) * 10) . '-et-un';
            } elseif ($a == 71) {
                return 'soixante-et-onze';
            } elseif ($a == 81) {
                return 'quatre-vingt-un';
            } elseif ($a == 91) {
                return 'quatre-vingt-onze';
            }
        } elseif ($a < 70) {
            return int2str($a - $a % 10) . '-' . int2str($a % 10);
        } elseif ($a < 80) {
            return int2str(60) . '-' . int2str($a % 20);
        } else {
            return int2str(80) . '-' . int2str($a % 20);
        }
    } else if ($a == 100) {
        return 'cent';
    } else if ($a < 200) {
        return int2str(100) . ' ' . int2str($a % 100);
    } else if ($a < 1000) {
        return int2str((int) ($a / 100)) . ' ' . int2str(100) . ' ' . int2str($a % 100);
    } else if ($a == 1000) {
        return 'mille';
    } else if ($a < 2000) {
        return int2str(1000) . ' ' . int2str($a % 1000) . ' ';
    } else if ($a < 1000000) {
        return int2str((int) ($a / 1000)) . ' ' . int2str(1000) . ' ' . int2str($a % 1000);
    }
}
?>
<?php
function int2str($a)
{
    $joakim = explode('.', $a);
    //debug($a);
    if (isset($joakim[1]) && $joakim[1] != '') {
        return int2str($joakim[0]) . ' virgule ' . int2str($joakim[1]);
    }
    if ($a == 0)
        return 'zéro';
    if ($a < 0)
        return 'moins ' . int2str(-$a);
    if ($a < 17) {
        switch ($a) {
            case 0:
                return 'zéro';
            case 1:
                return 'un';
            case 2:
                return 'deux';
            case 3:
                return 'trois';
            case 4:
                return 'quatre';
            case 5:
                return 'cinq';
            case 6:
                return 'six';
            case 7:
                return 'sept';
            case 8:
                return 'huit';
            case 9:
                return 'neuf';
            case 10:
                return 'dix';
            case 11:
                return 'onze';
            case 12:
                return 'douze';
            case 13:
                return 'treize';
            case 14:
                return 'quatorze';
            case 15:
                return 'quinze';
            case 16:
                return 'seize';
        }
    } else if ($a < 20) {
        return 'dix-' . int2str($a - 10);
    } else if ($a < 100) {
        if ($a % 10 == 0) {
            switch ($a) {
                case 20:
                    return 'vingt';
                case 30:
                    return 'trente';
                case 40:
                    return 'quarante';
                case 50:
                    return 'cinquante';
                case 60:
                    return 'soixante';
                case 70:
                    return 'soixante-dix';
                case 80:
                    return 'quatre-vingts';
                case 90:
                    return 'quatre-vingt-dix';
            }
        } elseif ($a % 10 == 1 && $a != 71 && $a != 81 && $a != 91) {
            return int2str($a - 1) . '-et-un';
        } elseif ($a < 70) {
            return int2str($a - $a % 10) . '-' . int2str($a % 10);
        } elseif ($a < 80) {
            return 'soixante-' . int2str($a % 20);
        } else {
            return 'quatre-vingt-' . int2str($a % 20);
        }
    } else if ($a < 200) {
        if ($a == 100) {
            return 'cent';
        } else {
            return 'cent ' . int2str($a % 100);
        }
    } else if ($a < 1000) {
        if ($a % 100 == 0) {
            return int2str($a / 100) . ' cents';
        } else {
            return int2str((int) ($a / 100)) . ' cent ' . int2str($a % 100);
        }
    } else if ($a < 2000) {
        if ($a == 1000) {
            return 'mille';
        } else {
            return 'mille ' . int2str($a % 1000);
        }
    } else if ($a < 1000000) {
        return int2str((int) ($a / 1000)) . ' mille ' . int2str($a % 1000);
    } else if ($a < 2000000) {
        return 'un million ' . int2str($a % 1000000);
    } else if ($a < 1000000000) {
        return int2str((int) ($a / 1000000)) . ' millions ' . int2str($a % 1000000);
    } else if ($a < 2000000000) {
        return 'un milliard ' . int2str($a % 1000000000);
    } else {
        return int2str((int) ($a / 1000000000)) . ' milliards ' . int2str($a % 1000000000);
    }
}

// Exemple d'utilisation

?>