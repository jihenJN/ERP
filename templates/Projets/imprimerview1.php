<?php

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

?>
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



<style>
    .glow-on-hover {
        width: 220px;
        height: 50px;
        border: none;
        outline: none;
        color: #fff;
        background: #111;
        cursor: pointer;
        position: relative;
        z-index: 0;
        border-radius: 10px;
    }

    .glow-on-hover:before {
        content: '';
        background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
        position: absolute;
        top: -2px;
        left: -2px;
        background-size: 400%;
        z-index: -1;
        filter: blur(5px);
        width: calc(100% + 4px);
        height: calc(100% + 4px);
        animation: glowing 20s linear infinite;
        opacity: 0;
        transition: opacity .3s ease-in-out;
        border-radius: 10px;
    }

    .glow-on-hover:active {
        color: #000
    }

    .glow-on-hover:active:after {
        background: transparent;
    }

    .glow-on-hover:hover:before {
        opacity: 1;
    }

    .glow-on-hover:after {
        z-index: -1;
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: #55ebcb;
        left: 0;
        top: 0;
        border-radius: 10px;
    }

    @keyframes glowing {
        0% {
            background-position: 0 0;
        }

        50% {
            background-position: 400% 0;
        }

        100% {
            background-position: 0 0;
        }
    }
</style>
<?php $this->layout = 'def'; ?>
<?php

use App\Model\Table\SignaturesTable;

$session = $this->request->getSession();

$authData = $session->read('Auth');

if ($authData && is_object($authData)) {
    $personnelId = $authData->personnel_id;
    $signaturesTable = new SignaturesTable();
    $userSignature = $signaturesTable->find()
        ->where(['personnel_id' => $personnelId])
        ->first();
}
/* $commandeclient->devis_id=$projet->devise_id;
$commandeclient->devise->name=$projet->devise->name;
$commandeclient->devise->code=$projet->devise->code; */
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
        /* border: 1px solid #ddd; */
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
<?php //debug($facture->numero); 
$connection = ConnectionManager::get('default');

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert');
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$domainName = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

$baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

$wr = $protocol . $domainName.$baseSegment; ?>
<div style="position: relative; top: 0;">
    <!-- Bande noire continue -->
    <div style="background-color: black; height: 60px;width:110%;margin-top:-30px;margin-left:-10px"></div>

    <!-- Image au-dessus de la bande noire -->
    <div style="position: absolute; top: 20px; left: 10%; transform: translateX(-50%); z-index: 1;">
        <?php echo $this->Html->image('logoggb.png', ['alt' => 'CakePHP', 'height' => '125px', 'width' => '140px']); ?>
    </div>
    <div style="position: absolute; top: 20px; right: 10%; z-index: 1;">
        <a onclick='openWindow(1000, 1000, `<?php echo $wr; ?>/projets/downloadcmdclient/<?php echo @$id; ?>`)'>


            <button type="button" style="    font-size: 20px;"
                class="btn btn-xm btn-primary glow-on-hover">Imprimer</button></a>
    </div>
</div>
<div style="margin:30px">

    <div style="width: 87%;height: 20px;margin-left:10%;margin-right:5%;margin-top: -10px;">
        <div style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.5em; ">
            <strong>Commande
            </strong><br>
        </div>
        <div style="display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.5em;">
            <strong>Réf. :</strong>
            <strong><?= h($commandeclient->code) ?></strong>
        </div>
        
        <div style="display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1em;">
            Réf.client :
            <?= h($commandeclient->client->codeclient) ?>
        </div>
        <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
            Date de commande:
            <?php echo $commandeclient->date->format(('d-m-Y')); ?>
        </div>
        <!-- <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
        Validité de l'offre :
        <?= h($commandeclient->duree_validite) ?> Jours
    </div> -->
        <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
            Réf.proposition commercial :

        </div>
    </div>
    <br><br>
    <br><br><br><br>
    <div style="display:flex">
        <div style="width: 30%; margin-left:3%;font-size: 12px;">
            Émetteur:
        </div>
        <div style=" width: 60%; margin-left:13%;font-size: 12px;">
            Adressé à:
        </div>
    </div>
    <br>
    <div style="display:flex">
        <div class="boxblanc" style="width: 46%;height: 150px;margin-left:1%;margin-top:-0.5%;">
            <div style="background:;margin-top:1%; margin-left:1%;font-size: 13px;">
                <strong>
                    <?= h($commandeclient->client->nom) ?>
                </strong>
                <br>
                <?= h($commandeclient->client->Adresse) ?>
                <br>
                <?= h($commandeclient->client->port) ?>
                <br>
             
                <?= h($commandeclient->client->Code_VilleL) ?>
                <?php
            if ($commandeclient->client->Tel) {?>
                Téléphone:
                <?= h($commandeclient->client->Tel) ?>   <?php } ?>
                <br>
                <?php
            if ($commandeclient->client->Fax) {?>
                <strong>Fax :</strong>
                <?= h($commandeclient->client->Fax) ?>   <?php } ?>
                <br>
                <?php
            if ($commandeclient->client->Email) {?>
                <strong>Email :</strong>
                <?= h($commandeclient->client->Email) ?>
                <?php } ?>
            </div>
            <br>
        </div>
        <div class="boxgris"
            style="width: 62%;height: 150px;margin-left:1%;margin-right:3%;font-size: 13px;margin-top:-0.5%;">
            <div style="margin-top:1%; margin-left:1%">
                <br>
                <strong>
                    <?= h($societes->nom) ?>
                </strong>
                <br>
                <?= h($societes->adresse) ?>
                <br><br>
                
                <strong>Tél.:</strong>
                <?= h($societes->tel) ?>
                <br>
                <strong> Email :</strong>
                <?= h($societes->mail) ?>
                <br>
                <strong>WEB :</strong>
                <?= h($societes->site) ?>
                <br>
            </div>
        </div>
    </div>
    <div class="boxbordergris" style="width: 96%; height: 20px; margin-left: 1%; margin-right: 5%;margin-top: 10px;">
        <div style="font-size: 12px;">
            Incoterm :
            <span style="color: red; font-weight: bold;">
                <?php if ($commandeclient['incotermpdf_id']) {
                    # code...
                
                    $incotermpdf = $connection->execute("SELECT code FROM incoterms  WHERE id='" . $commandeclient['incotermpdf_id'] . "' ;")->fetchAll('assoc');

                    echo $incotermpdf[0]['code'];
                } ?>
                <?php if ($commandeclient->client->port != '') {

                    ?>-
                <?php }
                echo $commandeclient->client->port; ?>
                <?php if ($commandeclient['pay'] != '') {
                    #
                    ?>- <?php }
                echo $commandeclient['pay'] ?>
            </span>
        </div>
    </div>
    <!-- <?php //debug($commandeclient->devise->name); 
    ?> -->
    <div style="width: 87%;height: 20px;margin-left:1%;margin-right:5%;font-size: 12px;margin-top: 7px;">
        Montants exprimés en
        <?php if ($commandeclient->devis_id) { ?>
            <?= h($commandeclient->devise->name) ?>
        <?php } ?>
    </div>
    <br>
    <div style="width: 96%; margin-left:0%;margin-right:5%;margin-top: -8px;border-color:transparant;">
        <div class="panel-body" style="border-color:transparant">
            <div class="table-responsive ls-table" style="border-color:transparant">
                <table height="500px" style="width: 100%;">
                    <thead>
                        <tr height="7px">
                            <!-- <td align="center" class="solid-border" style="width: 15%;border:1px solid gray;">
                            Référence
                        </td> -->
                            <td align="center" class="solid-border" style="width: 40%;border:1px solid gray;">
                                Désignation
                            </td>
                            <td align="center" class="solid-border"
                                style="width: 10%;border:1px solid gray;text-align:center">
                                P.U.H.T
                            </td>
                            <td align="center" class="solid-border"
                                style="width: 9%;border:1px solid gray;text-align:center">
                                Qté
                            </td>
                            <td align="center" class="solid-border"
                                style="width: 5%;border:1px solid gray;text-align:center">
                                Unité
                            </td>
                            <td align="center" class="solid-border"
                                style="width: 10%;border:1px solid gray;text-align:center">
                                Total HT
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         $virg=3;
                         if ($commandeclient->nbfergule) {
                             $virg=$commandeclient->nbfergule;
                         }
                        $total_transportt = 0;
                        $total_produit;
                        $tot_remisetransport = 0;
                        foreach ($commandeclient->lignecommandeclients as $lignecommandeclient):
                            // debug($lignecommandeclient);
                            $connection = ConnectionManager::get('default');
                            $articl = array();
                            if ($lignecommandeclient['article_id']) {
                                $articl = $connection->execute('SELECT * FROM articles where articles.id =' . $lignecommandeclient->article_id)->fetchAll('assoc');
                                // debug($articl); 
                            }


                            ?>
                            <?php
                            if ($lignecommandeclient->type == 2) {
                                $total_transportt = $total_transportt + (float) $lignecommandeclient['ttc'];
                                $remiseservice = (float) ($lignecommandeclient['prixht'] * $lignecommandeclient['qte']) - (float) $lignecommandeclient['ttc'];
                                $tot_remisetransport += $remiseservice;
                            }
                           
                            if ($lignecommandeclient->type == 1) {
                                $total_produit = $total_produit + (float) $lignecommandeclient['ttc'];
                            }
                            $unite = $lignecommandeclient['unite_id'];
                            if ($articl[0]['unite_id']) {
                                // debug($unite);
                                $unitename = $connection->execute('SELECT * FROM unites where unites.id =' . $articl[0]['unite_id'])->fetchAll('assoc');
                            }
                            if ($lignecommandeclient->type == 1) {
                                ?>
                                <tr class="tr">
                                    <!-- <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;height: 1px;">
                                <?php echo h($articl[0]['Refggb']); ?>
                            </td> -->
                                    <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                        style="border-color:gray;vertical-align:top;height: 1px;text-align:left">
                                        <?php echo h($articl[0]['Dsignation'] . ' ' . $articl[0]['Description']); ?>
                                    </td>

                                    <?php if ($commandeclient->devise->name === 'Dollars US'): ?>
                                        <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                            style="border-color:gray;vertical-align:top;">
                                            <?= $this->Number->format($lignecommandeclient->prixht) ?> $
                                        </td>
                                    <?php elseif ($commandeclient->devise->name === 'Euro'): ?>
                                        <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                            style="border-color:gray;vertical-align:top;">
                                            <?= $this->Number->format($lignecommandeclient->prixht) ?> €
                                        </td>
                                    <?php else: ?>
                                        <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                            style="border-color:gray;vertical-align:top;">
                                            <?= $this->Number->format($lignecommandeclient->prixht) ?>
                                        </td>
                                    <?php endif; ?>
                                    <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                        style="border-color:gray;vertical-align:top;">
                                        <div style="margin-left: 25% ;">
                                            <?=
                                                $qte = $lignecommandeclient->qte;
                                            $TotalHT = $lignecommandeclient->prixht * $qte;
                                            $this->Number->format($lignecommandeclient->qte) ?>
                                        </div>
                                    </td>


                                    <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                        style="border-color:gray;vertical-align:top;">
                                        <?php
                                        if ($unitename) {
                                            echo h($unitename[0]['name']);
                                        } ?>
                                    </td>
                                    <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                        style="border-color:gray;vertical-align:top;">
                                        <?php if ($commandeclient->devise->name === 'Dollars US'): ?>
                                            <?= $this->Number->format($TotalHT) ?>$
                                        <?php elseif ($commandeclient->devise->name === 'Euro'): ?>
                                            <?= $this->Number->format($TotalHT) ?>€
                                        <?php else: ?>
                                            <?= $this->Number->format($TotalHT) ?>
                                        <?php endif; ?>
                                    </td>


                                </tr>
                            <?php }
                        endforeach; ?>
                        <tr>
                            <!-- <td style="border:1px solid gray;vertical-align:top;"></td> -->
                            <td style="border:1px solid gray;vertical-align:top;"></td>
                            <td style="border:1px solid gray;vertical-align:top;"></td>
                            <td style="border:1px solid gray;vertical-align:top;"></td>
                            <td style="border:1px solid gray;vertical-align:top;"></td>
                            <td style="border:1px solid gray;vertical-align:top;"></td>
                        </tr>
                    </tbody>
                </table>

                <?php $totalttc = $commandeclient->totalht + $commandeclient->total_transport;
                if ($commandeclient->devise_id) {
                    $totalttcTN = $totalttc * $commandeclient->devise->taux;
                }
                $projet_id = $commandeclient->projet_id;
                $connection = ConnectionManager::get('default');
                // $projet = $connection->execute("SELECT banque_id FROM projets WHERE id = '" . $projet_id . "'")->fetchAll('assoc');
                $projet = $connection->execute("SELECT banque_id,comptesBank_id FROM commandeclients WHERE id = '" . $commandeclient->id . "'")->fetchAll('assoc');

                if ($projet[0]['banque_id']) {
                    $banque = $connection->execute("SELECT * FROM banques WHERE id = '" . $projet[0]['banque_id'] . "'")->fetchAll('assoc');
                    $banq = $banque[0]['name'];
                    $banq = $banque[0]['name'];
                    $proprietaire = $banque[0]['proprietaire'];
                    $bicswift = $banque[0]['codeBicswift'];
                    $condreg = $banque[0]['conditionReglement'];
                }
                if ($projet[0]['comptesBank_id']) {
                    $comptesBank = $connection->execute("SELECT compte FROM comptes_bank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                    if ($comptesBank) {
                        $compbanq = $comptesBank[0]['compte'];
                    }
                }
                ?>

                <div style="display: flex; justify-content: space-between;margin-top: -12px;margin-left: -1.5%;">
                    <div style="width: 50%;">
                        <div style="margin-left: 3%; margin-right: 5%;font-size: 12px;">
                            <strong>Arrêter la présente Proposition commerciale à la somme de :</strong>
                        </div>

                        <div class="boxbordergray"
                            style="height: 40px; margin-left: 3%; margin-right: 5%;font-size: 12px;margin-top: 5px;">
                            <div style="margin-left: 3%;">
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
                                
                                
                                
                                //echo int2str(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc))) //int2str($totalttc); ?>
                            </div>
                        </div><br>

                        <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;margin-top: -2px;">
                            <strong style="display: inline-block;">Conditions de règlement
                                :</strong>&nbsp;&nbsp;&nbsp;&nbsp; <?php
                                debug($commandeclient);
                                echo $commandeclient->conditionreglement->conditionn; ?>

                        </div>
                        <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;">
                            <strong>Mode de transport : <?php
                            $connection = ConnectionManager::get('default');

                            if ($commandeclient['modetransport_id']) {
                                # code...
                            
                                $modetransportt = $connection->execute("SELECT * FROM modetransports  WHERE id='" . $commandeclient['modetransport_id'] . "' ;")->fetchAll('assoc');

                                echo $modetransportt[0]['name'];
                            } ?></strong>
                        </div>
                        <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;">
                            <strong>Délai de livraison :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php echo $commandeclient->delailivraison->name; ?></strong>
                        </div>

                        <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;">
                            <strong>Règlement par virement sur le compte bancaire suivant :</strong>
                        </div>
                        <div style="margin-left: 3%; margin-right: 5%;font-size: 11px ;">
                            <strong>Code IBAN : <?php echo $compbanq ?></strong>

                        </div>
                        <div style="margin-left: 3%; margin-right: 5%;font-size: 11px; ">
                            <strong>Code BIC/SWIFT :</strong> <strong><?php echo $bicswift; ?></strong>

                        </div>
                        <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;">
                            <strong>Banque: <?php echo $banq ?></strong>

                        </div>
                        <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;">
                            <strong>Nom du propriétaire du compte : <?php echo $proprietaire; ?>
                            </strong>
                        </div>

                    </div>
                    <div style="width: 50%;">


                        <div style="display: flex; justify-content: space-between;">
                            <div style="margin-left: 60px;width:50%">
                                Total
                                <?php echo $commandeclient->incoterm->code; ?>
                            </div>
                            <div>
                                <?php echo sprintf("%01." . $commandeclient->nbfergule . "f", str_replace(",", ".", $total_produit)); ?>
                                <?php if ($commandeclient->devis_id) {
                                    echo $commandeclient->devise->code;
                                } ?>
                            </div>
                        </div>
                        <?php    foreach ($lignecommandeclient2sdes as $key => $ligne2) { 
                            $total_transp_ligne = $ligne2['prixht'] * $ligne2['qte'];
                            if ($total_transp_ligne != 0) { ?>
                        <div style="display: flex; justify-content: space-between;">

                            <div style="margin-left: 60px;width:50%">
                                <?php echo $ligne2['description']; ?>
                            </div>
                            <div>
                                <?php echo sprintf("%01." . $commandeclient->nbfergule . "f", str_replace(",", ".", $total_transp_ligne)); ?>
                                <?php if ($commandeclient->devis_id) {
                                    echo $commandeclient->devise->code;
                                } ?>
                            </div>
                        </div>
                        <?php }} ?>
                        <?php if ($total_transportt != 0 && $tot_remisetransport != 0 /*  && $commandeclient->activeremisetransport == 1 */) { ?>

                            <div style="display: flex; justify-content: space-between;">

                                <div style="margin-left: 60px;width:50%">

                                    <div >
                                        Remise Transport:
                                    </div>



                                </div>
                                <div>
                                    <?php echo sprintf("%01." . $commandeclient->nbfergule . "f", str_replace(",", ".", $tot_remisetransport)); ?>
                                    <?php if ($commandeclient->devis_id) {
                                        echo $commandeclient->devise->code;
                                    } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php $remiseglobale = $commandeclient->totalremise - $tot_remisetransport;
                        if ($remiseglobale != 0  /* && $commandeclient->activeremise == 1 */) { ?>

                            <div style="display: flex; justify-content: space-between;">

                                <div style="margin-left: 60px;width:50%">

                                    <div >
                                        Remise :
                                    </div>



                                </div>
                                <div>
                                    <?php echo sprintf("%01." . $commandeclient->nbfergule . "f", str_replace(",", ".", $remiseglobale)); ?>
                                    <?php if ($commandeclient->devis_id) {
                                        echo $commandeclient->devise->code;
                                    } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <div style="display: flex; justify-content: space-between;">


                            <div style="margin-left: 60px;width:50%">
                                Total :
                                <?php if ($commandeclient['incotermpdf_id']) {
                                    # code...
                                
                                    $incotermpdf = $connection->execute("SELECT code FROM incoterms  WHERE id='" . $commandeclient['incotermpdf_id'] . "' ;")->fetchAll('assoc');

                                    echo $incotermpdf[0]['code'];
                                }
                                ?>
                                <?php if ($commandeclient->client->port != '') {

                                    ?>-
                                <?php }
                                echo $commandeclient->client->port; ?>
                                <?php if ($commandeclient['pay'] != '') {
                                    #
                                    ?>- <?php }
                                echo $commandeclient['pay'] ?>

                            </div>
                            <div>
                                <?php echo sprintf("%01." . $commandeclient->nbfergule . "f", str_replace(",", ".", $commandeclient->totalttc)); ?>
                                <?php if ($commandeclient->devis_id) {
                                    echo $commandeclient->devise->code;
                                } ?>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- <div style="margin-top: -100px;">
            <?php if ($userSignature): ?>
                <img src="<?= $this->Url->webroot('img/logosignature/' . $userSignature->filename); ?>" width="200px" height="80px" style="float: right; margin-top: -20px; margin-right: 20px;">
            <?php endif; ?>
        </div> -->
        <!-- <div class="footerr-text">
            <?php echo $this->Html->image('footercmdclient.png', ['width' => '700', 'height' => '70']); ?>
        </div> -->
        <div>
            <?php if ($userSignature): ?>
                <img src="<?= $this->Url->webroot('img/logosignature/' . $userSignature->filename); ?>" width="200px"
                    height="80px" style="float: right; margin-top: -150px; margin-right: 20px;">
            <?php endif; ?>
        </div>
        <div>
            <hr style="color: black;border: 2px solid;" />
            <div align="center">
                <table border="0">
                    <thead>
                        <tr>
                            <td style="width:20%"></td>
                            <td style="width:5%"> <img src="<?= $this->Url->webroot('img/mail.png'); ?>" width="40px"
                                    height="30px" style=""></td>
                            <td style="width:5%">
                                <span>
                                    <strong>contact@genuisgb.net</strong> </span>
                            </td>
                            <td style="width:5%"></td>
                            <td style="width:5%"><img src="<?= $this->Url->webroot('img/maps.png'); ?>" width="30px"
                                    height="40px" style=""></td>
                            <td style="width:60%">
                                <strong> 50,
                                    Rue 8600, Escaliers C, 2éme étage,<br>C-2-4 ,Z.I Charguia 1, 2035, Tunis </strong>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>

            <?php //echo $this->Html->image('footer.png', ['width' => '700', 'height' => '70']); ?>
        </div>
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
        /*  position: fixed; */
        bottom: 10px;
        left: 50px;
        width: 30px;
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
    }

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