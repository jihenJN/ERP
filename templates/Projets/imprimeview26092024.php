<?php

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
use App\Model\Table\SignaturesTable; ?>
<?php $this->layout = 'AdminLTE.printt';
$connection = ConnectionManager::get('default');

$session = $this->request->getSession();

$authData = $session->read('Auth');
//$Projets = new ProjetsTable();

$projet = $connection->execute('Select * from projets,devises where projets.id=' . $commandeclient->id . ' and projets.devise_id=devises.id');

if ($authData && is_object($authData)) {
    $personnelId = $authData->personnel_id;
    $signaturesTable = new SignaturesTable();
    $userSignature = $signaturesTable->find()
        ->where(['personnel_id' => $personnelId])
        ->first();
    if ($userSignature) {
        // $filename = urlencode($userSignature->filename);
        // debug($userSignature->filename);
        $signatureData = file_get_contents('https://geniusbusiness.isofterp.com/genuis/webroot/img/logosignature/' . $userSignature->filename);
        if ($signatureData !== false) {
            $base64Signature = 'data:image/png;base64,' . base64_encode($signatureData);
        } else {
            echo 'Impossible de charger la signature.';
        }
    }
}

?>
<?php
$imageUrl = 'https://geniusbusiness.isofterp.com/genuis/webroot/img/logoggb.png';
$imageData = file_get_contents($imageUrl);
if ($imageData !== false) {
    $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
}
$footerUrl = 'https://geniusbusiness.isofterp.com/genuis/webroot/img/footer.png';
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

    <div style="width: 87%;height: 20px;margin-left:80%;margin-right:5%; margin-top: -30px;">
        <div style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.3em; ">
            <strong>Proposition commerciale

            </strong><br>
        </div>
        <div style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.2em; ">
            <strong>Réf. :</strong>
            <strong><?= h($commandeclient->code) ?></strong>
        </div>
        <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
            Date :
            <?php echo ($commandeclient->date) ?>
        </div>
        <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
            Validité de l'offre :
            <?= h($commandeclient->duree_validite) ?> Jours
        </div>
        <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
            Code client :
            <?= h($commandeclient->client->codeclient)

                ?>
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
                    <?= h($commandeclient->client->nom) ?>
                </strong>
                <br>
                <?= h($commandeclient->client->Adresse) ?>
                <br>
                <?= h($commandeclient->client->port) ?>
                <br>
                <?= h($commandeclient->client->Code_VilleL) ?>
                Téléphone:
                <?= h($commandeclient->client->Tel) ?>
                <br>
                Fax :
                <?= h($commandeclient->client->Fax) ?>
                <br>
                Email :
                <?= h($commandeclient->client->Email) ?>
            </div>
        </div>
    </div>


    <div class="boxbordergray" style="width: 104%; height: 19px; margin-left: -1%; margin-right: 5%;margin-top: -3%;">
        <div style="font-size: 13px;">
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
    <div class="boxbordergray" style="width: 104%; height: 19px; margin-left: -1%; margin-right: 5%;">
        <div style="font-size: 13px;">
            Note Publique :
            <span style="color: red; font-weight: bold;">
                <?php
                $note = $connection->execute("SELECT * FROM notes  WHERE commandeclient_id='" . $commandeclient['id'] . "' ;")->fetchAll('assoc');

                if ($note) {

                    echo $note[0]['notepub'];
                } ?>

            </span>
        </div>
    </div>
    <br>
    <div style="width: 87%;height: 20px;margin-left:-1%;margin-right:5%;margin-top:-1.5%;">
        <div style="font-size: 12px;">
            Montants exprimés en
            <?php if ($commandeclient->devis_id) { ?>
                <?= h($commandeclient->devise->name) ?>
            <?php } ?>
        </div>
    </div>
    <br>
    <div class="" style="width: 104%;height :600px; margin-left:-1%;margin-right:5%;">
        <div class="panel-body">
            <div class="table-responsive ls-table">
                <table style="width: 100%; min-height: 450px;">
                    <thead>
                        <tr height="7px">
                            <td align="center" class="solid-border" style="width: 10% !important;border:1px solid gray;">
                                Référence
                            </td>
                            <!--  <td align="center" class="solid-border" style="width: 30%;border:1px solid gray;">
                                Désignation
                            </td> -->
                            <td align="center" class="solid-border" style="width: 50% !important;  word-wrap: break-word;
    white-space: normal; border:1px solid gray;">
                                Déscription
                            </td>
                            <td align="center" class="solid-border" style="width: 10% !important;border:1px solid gray;">
                                P.U.H.T
                            </td>
                            <td align="center" class="solid-border" style="width:10% !important;border:1px solid gray;">
                                Qté
                            </td>
                            <td align="center" class="solid-border" style="width: 10% !important; border:1px solid gray;">
                                Unité
                            </td>
                            <td align="center" class="solid-border" style="width: 10% !important;border:1px solid gray;">
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
                        $i = 0;
                        $total_transportt = 0;
                        //debug($commandeclient->lignecommandeclients);die;
                        $total_produit = 0;
                        $k = 0;
                        foreach ($commandeclient->lignecommandeclients as $lignecommandeclient):
                            if ($lignecommandeclient['article_id']) {
                                $articl = $connection->execute('SELECT * FROM articles where articles.id =' . $lignecommandeclient['article_id'])->fetchAll('assoc');

                            }
                            // debug($articl);  
                            $i++;

                            if ($lignecommandeclient['type'] == 2) {
                                //print_r($lignecommandeclient['ttc']);die;
                                $total_transportt = $total_transportt + (float) $lignecommandeclient['ttc'];
                            }
                            if ($lignecommandeclient['type'] == 1) {
                                $total_produit = $total_produit + (float) $lignecommandeclient['ttc'];
                            }

                            ?>
                            <?php
                            if ($lignecommandeclient->type == 1) {
                                $k++;

                                if ($articl[0]['unite_id']) {
                                    // debug($unite);

                                    $unitename = $connection->execute('SELECT * FROM unites where unites.id =' . $articl[0]['unite_id'])->fetchAll('assoc');
                                }
                                ?>
                                <tr class="tr">
                                    <td align="center" style="vertical-align:top;" class="dotted-border">
                                        <?php echo h($articl[0]['Refggb']); ?>
                                    </td>
                                    <td align="center" style="vertical-align:top; word-break: break-word;  
    white-space: normal; " class="dotted-border">
                                        <?php echo h($articl[0]['Dsignation'] . ' ' . $articl[0]['Description']); ?><br>
                                        <?php echo h($lignecommandeclient['description']); ?>
                                    </td>
                                    <!--  <td align="center" style="vertical-align:top;" class="dotted-border">
                                        <?php echo h($lignecommandeclient['description']); ?>
                                    </td> -->

                                    <?php if ($commandeclient->devise->name === 'Dollars US'): ?>
                                        <td align="center" style="vertical-align:top;" class="dotted-border">
                                            <!-- <?= $lignecommandeclient['prixht'] ?> -->
                                            <?= sprintf("%01.".$virg."f",$lignecommandeclient['prixht']) ?>
                                             $
                                        </td>
                                    <?php elseif ($commandeclient->devise->name === 'Euro'): ?>
                                        <td align="center" style="vertical-align:top;" class="dotted-border">
                                        <?= sprintf("%01.".$virg."f",$lignecommandeclient['prixht']) ?> €
                                        </td>
                                    <?php else: ?>
                                        <td align="center" style="vertical-align:top;" class="dotted-border">
                                        <?= sprintf("%01.".$virg."f",$lignecommandeclient['prixht']) ?>
                                        </td>
                                    <?php endif; ?>
                                    <td align="center" style="vertical-align:top;" class="dotted-border">
                                        <div style="margin-left: 25% ;">
                                            <?php
                                            $qte = $lignecommandeclient['qte'];
                                            $TotalHT = $lignecommandeclient['prixht'] * $qte;
                                            echo $lignecommandeclient->qte ?>
                                        </div>
                                    </td>


                                    <td align="center" style="vertical-align:top;" class="dotted-border">
                                        <?php
                                        if ($unitename) {
                                            echo h($unitename[0]['name']);
                                        } ?>
                                    </td>

                                    <td align="center" style="vertical-align:top;" class="dotted-border">
                                        <?php
                                        $totalht = $lignecommandeclient['ttc'];
                                        if ($commandeclient->devise->name === 'Dollars US'): ?>
                                              <?= sprintf("%01.".$virg."f", $totalht) ?> $
                                        <?php elseif ($commandeclient->devise->name === 'Euro'): ?>
                                            <?= sprintf("%01.".$virg."f", $totalht) ?> €
                                        <?php else: ?>
                                            <?= sprintf("%01.".$virg."f", $totalht) ?>
                                        <?php endif; ?>
                                    </td>

                                </tr>
                                <?php

                                if ($k== 12) { $k=0;?>
                            </table>
                            <p style="page-break-after: always;"></p>
                            <?php //echo '<tr><td colspan="6" style="border:none;"><p style="page-break-after: always;"></p></td></tr>'; ?>

                            <div style="position: relative; top: 0;">
                                <!-- Bande noire continue -->
                                <div style="background-color: black; height: 60px;width:110%;margin-top:-30px;margin-left:-6%">
                                </div>

                                <div style="position: absolute; top: 20px; left: 10%; transform: translateX(-50%); z-index: 1;">

                                    <?php echo '<img src="' . $base64Image . '" alt="Image" height="125px" width="140px">'; ?>
                                </div>
                            </div>

                            <div style="margin:30px">

                                <div style="width: 87%;height: 20px;margin-left:80%;margin-right:5%; margin-top: -30px;">
                                    <div
                                        style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.3em; ">
                                        <strong>Proposition commerciale

                                        </strong><br>
                                    </div>
                                    <div
                                        style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.2em; ">
                                        <strong>Réf. :</strong>
                                        <strong><?= h($commandeclient->code) ?></strong>
                                    </div>
                                    <div
                                        style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
                                        Date :
                                        <?php echo ($commandeclient->date) ?>
                                    </div>
                                    <div
                                        style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
                                        Validité de l'offre :
                                        <?= h($commandeclient->duree_validite) ?> Jours
                                    </div>
                                    <div
                                        style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
                                        Code client :
                                        <?= h($commandeclient->client->codeclient)

                                            ?>
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
                                    <div class="boxblanc"
                                        style="width: 55%;height: 160px;margin-left:48%;font-size: 13px;margin-top:-22.59%; ">
                                        <div style="margin-left:1%">
                                            <strong>
                                                <?= h($commandeclient->client->nom) ?>
                                            </strong>
                                            <br>
                                            <?= h($commandeclient->client->Adresse) ?>
                                            <br>
                                            <?= h($commandeclient->client->port) ?>
                                            <br>
                                            <?= h($commandeclient->client->Code_VilleL) ?>
                                            Téléphone:
                                            <?= h($commandeclient->client->Tel) ?>
                                            <br>
                                            Fax :
                                            <?= h($commandeclient->client->Fax) ?>
                                            <br>
                                            Email :
                                            <?= h($commandeclient->client->Email) ?>
                                        </div>
                                    </div>
                                </div>


                                <div class="boxbordergray"
                                    style="width: 104%; height: 19px; margin-left: -1%; margin-right: 5%;margin-top: -3%;">
                                    <div style="font-size: 13px;">
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
                                <div class="boxbordergray" style="width: 104%; height: 19px; margin-left: -1%; margin-right: 5%;">
                                    <div style="font-size: 13px;">
                                        Note Publique :
                                        <span style="color: red; font-weight: bold;">
                                            <?php
                                            $note = $connection->execute("SELECT * FROM notes  WHERE commandeclient_id='" . $commandeclient['id'] . "' ;")->fetchAll('assoc');

                                            if ($note) {

                                                echo $note[0]['notepub'];
                                            } ?>

                                        </span>
                                    </div>
                                </div>
                                <br>
                                <div style="width: 87%;height: 20px;margin-left:-1%;margin-right:5%;margin-top:-1.5%;">
                                    <div style="font-size: 12px;">
                                        Montants exprimés en
                                        <?php if ($commandeclient->devis_id) { ?>
                                            <?= h($commandeclient->devise->name) ?>
                                        <?php } ?>
                                    </div>
                                </div>
                                <br>
                                <div class="" style="width: 104%;height :600px; margin-left:-1%;margin-right:5%;">
                                    <div class="panel-body">
                                        <div class="table-responsive ls-table">

                                            <table style="width: 100%; min-height: 450px;">
                                                <thead>
                                                    <tr height="7px">
                                                        <td align="center" class="solid-border"
                                                            style="width: 10%;border:1px solid gray;">
                                                            Référence
                                                        </td>
                                                        <!--  <td align="center" class="solid-border" style="width: 30%;border:1px solid gray;">
                                Désignation
                            </td> -->
                                                        <td align="center" class="solid-border"
                                                            style="width: 50%;border:1px solid gray;">
                                                            Déscription
                                                        </td>
                                                        <td align="center" class="solid-border"
                                                            style="width: 10%;border:1px solid gray;">
                                                            P.U.H.T
                                                        </td>
                                                        <td align="center" class="solid-border"
                                                            style="width: 10%;border:1px solid gray;">
                                                            Qté
                                                        </td>
                                                        <td align="center" class="solid-border"
                                                            style="width: 10%;border:1px solid gray;">
                                                            Unité
                                                        </td>
                                                        <td align="center" class="solid-border"
                                                            style="width: 10%;border:1px solid gray;">
                                                            Total HT
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php }
                            }
                        endforeach; ?>
                                        <tr>

                                            <td style="border:1px solid gray;vertical-align:top;height: max-content;">
                                            </td>
                                            <td style="border:1px solid gray;vertical-align:top;height: max-content;">
                                            </td>
                                            <td style="border:1px solid gray;vertical-align:top;height: max-content;">
                                            </td>
                                            <td style="border:1px solid gray;vertical-align:top;height: max-content;">
                                            </td>
                                            <td style="border:1px solid gray;vertical-align:top;height: max-content;">
                                            </td>
                                            <td style="border:1px solid gray;vertical-align:top;height: max-content;">
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
                                $projet = $connection->execute("SELECT banque_id FROM commandeclients WHERE id = '" . $commandeclient->id . "'")->fetchAll('assoc');
                                $banque = $connection->execute("SELECT name FROM banques WHERE id = '" . $projet[0]['banque_id'] . "'")->fetchAll('assoc');
                                $banq = $banque[0]['name'];
                                ?>

                                <div style="display: flex; justify-content: space-between;margin-top: -100px;">
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
                                        if ($projet[0]['comptesBank_id']) {
                                            $comptesBank = $connection->execute("SELECT compte FROM comptes_bank WHERE id = '" . $projet[0]['comptesBank_id'] . "'")->fetchAll('assoc');
                                            if ($comptesBank) {
                                                $compbanq = $comptesBank[0]['compte'];
                                            }
                                        }
                                        ?>
                                        <div style="margin-left: 3%; margin-right: 5%;font-size: 12px;">
                                            <strong>Arrêter la présente Proposition commerciale à la somme de :</strong>
                                        </div>

                                        <div class="boxbordergray"
                                            style="height: 30px;  margin-right: 5%;font-size: 12px;margin-top: 5px;">
                                            <div style="margin-left: 3%;">
                                                <?php echo ucfirst(int2str(sprintf("%01.".$virg."f", str_replace(",", ".", $commandeclient->totalttc)))); ?>
                                            </div>
                                        </div>
                                        <div style="margin-left: 0%; margin-right: 5%;padding-top: -2%;">
                                            <strong>Conditions de règlement : </strong>
                                            <?php echo $commandeclient->conditionreglement->conditionn; ?>
                                        </div><br>
                                        <div style="margin-left: 0%; margin-right: 5%;margin-top: -2%;font-size: 12px;">
                                            <strong>Délai de livraison :</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php echo $commandeclient->delailivraison->name; ?>
                                        </div><br>
                                        <div style="margin-left: 0%; margin-right: 5%;margin-top: -2%;font-size: 10px;">
                                            <strong>Règlement par virement sur le compte bancaire suivant :</strong>
                                        </div><br>

                                        <div style="margin-left: 0%; margin-right: 5%;margin-top: -2%;font-size: 10px;">
                                            <strong>Code IBAN :</strong>
                                            <p style="display: inline-block; margin-left: 10px; margin-bottom: 0;">
                                                <strong>
                                                    <?php echo $compbanq ?>
                                                </strong></p>
                                        </div><br>
                                        <div style="margin-left: 0%; margin-right: 5%;margin-top: -2%;font-size: 10px;">
                                            <strong>Code BIC/SWIFT :</strong><?php echo $bicswift ?>
                                        </div><br>
                                        <div style="margin-left: 0%; margin-right: 5%;font-size: 10px;margin-top: -2%;">
                                            <strong>Banque:</strong>
                                            <p style="display: inline-block; margin-left: 10px; margin-bottom: 0;">
                                                <strong>
                                                    <?php echo $banq ?>
                                                </strong></p>
                                        </div><br>
                                        <div style="margin-left: 0%; margin-right: 5%;font-size: 10px;margin-top: -2%;">
                                            <strong>Nom du propriétaire du compte : <?php echo $proprietaire; ?>
                                            </strong>
                                            
                                        </div><br>


                                    </div>
                                    <div style="width: 50%;margin-left: 59%;margin-top:-23%;font-size: 13px;">
                                        <div style="display: flex; justify-content: space-between;">
                                            <div style="margin-left: 40px;width:50%">
                                                Total
                                                <?php echo $commandeclient->incoterm->code; ?>
                                            </div>
                                            <div style="margin-left: 180px;margin-top: -5%;">
                                                <?php echo sprintf("%01.".$virg."f", str_replace(",", ".", $total_produit)); ?>
                                                <?php if ($commandeclient->devis_id) {
                                                    echo $commandeclient->devise->code;
                                                } ?>
                                            </div>





                                            <!-- <div style="margin-left: 40px; ">Total :
                        </div>
                        <div style="margin-left: 180px;margin-top: -5%;">
                            <?php echo sprintf("%01.3f", str_replace(",", ".", $commandeclient->totalht)); ?>
                            <?php if ($commandeclient->devis_id) {
                                echo $commandeclient->devise->code;
                            } ?>
                        </div>

                    </div> -->
                                        </div>
                                        <div style="display: flex; justify-content: space-between;">

                                            <div style="margin-left: 40px;width:50%">
                                                <?php echo $lignecommandeclient2s[0]['description']; ?>
                                            </div>
                                            <div style="margin-left: 180px;margin-top: -5%;">
                                                <?php echo sprintf("%01.".$virg."f", str_replace(",", ".", $total_transportt)); ?>
                                                <?php if ($commandeclient->devis_id) {
                                                    echo $commandeclient->devise->code;
                                                } ?>
                                            </div>
                                        </div>
                                        <div style="display: flex; justify-content: space-between;">


                                            <div style="margin-left: 40px;width:50%">
                                                Total :
                                                <?php
                                                if ($commandeclient['incotermpdf_id']) {
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
                                            <div style="margin-left: 180px;margin-top: -5%;">
                                                <?php echo sprintf("%01.3f", str_replace(",", ".", $commandeclient->totalttc)); ?>
                                                <?php if ($commandeclient->devis_id) {
                                                    echo $commandeclient->devise->code;
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
                        <div class="footerr-text">
                            <?php echo '<img src="' . $base64footer . '" alt="Image" height="65px" width="650px">'; ?>
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
                        position: fixed;
                        /* bottom: -1px; */
                        margin-top: 180px;
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