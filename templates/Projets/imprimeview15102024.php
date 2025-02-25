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
    .tabstyle {
        width: 100%;
        height: 400px !important;
        /*         border: 1px solid black; */
    }

    .tabstyle>tbody>td {
        border-bottom: 1px solid black;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        /*margin-bottom: 20px;*/
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
        width: 100%;
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
    <div style="background-color: black; height: 28px;width:110%;margin-top:-29px;margin-left:-20px"></div>

    <div style="position: absolute; top: -10px; left: 9%; transform: translateX(-50%); z-index: 1;">

        <?php echo '<img src="' . $base64Image . '" alt="Image" height="125px" width="140px">'; ?>
    </div>
</div>



<div style="width: 87%;float:right;height: 20px;margin-top: 5px;margin-right: 2%;">
    <div
        style=" display: flex;text-align:right; position: relative; justify-content: flex-end;/*  color: #103458;  */font-size: 1.3em; ">
        <strong>Proposition commerciale

        </strong><br>
    </div>
    <div
        style=" display: flex; text-align:right;position: relative; justify-content: flex-end !important; /* color: #103458; */ font-size: 1.2em; ">
        <strong>Réf. :</strong>
        <strong><?= h($commandeclient->code) ?></strong>
    </div>
    <div
        style="display: flex; text-align:right; position: relative; justify-content: flex-end; font-size:1em; /* color: #103458; */">
        Date :
        <?php echo ($commandeclient->date) ?>
    </div>
    <div
        style="display: flex; text-align:right; position: relative; justify-content: flex-end; font-size:1em; /* color: #103458; */">
        Validité de l'offre :
        <?= h($commandeclient->duree_validite) ?> Jours
    </div>
    <div
        style="display: flex; text-align:right; position: relative; justify-content: flex-end; font-size:1em;/*  color: #103458; */">
        Code client :
        <?= h($commandeclient->client->codeclient)

            ?>
    </div>

</div>
<br><br>
<br><br><br><br>
<div style="display:flex; width: 100%; ">
    <div style="width: 50%; margin-left:1%;font-size: 12px;margin-top:1%;">
        Émetteur:
    </div>
    <div style=" width: 50%; margin-left:48%;font-size: 12px;margin-top:-4%;">
        Adressé à:
    </div>
</div>
<div style="display:flex; width: 90%; margin-left:1%;">
    <div class="boxgris" style="width:47%;height: 160px;">
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
    <div class="boxblanc" style="margin-left:51%;width: 58%;height: 160px;font-size: 13px;margin-top:-23.4%; ">
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


<div class="boxbordergray" style="width: 98%;/*  height: 19px; */ margin-left: 1%; margin-right: 5%;margin-top: 2%;">
    <div style="font-size: 13px;">
        Incoterm : 
        <span style="font-weight: bold;">
            <?php
             if ($commandeclient['incotermpdf_id']) {
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
<!-- <div class="boxbordergray" style="width: 98%; height: 19px; margin-left: 2%; margin-right: 5%;margin-top: 1%;">
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
<br> -->
<div style="width: 98%;height: 20px;margin-left:1%;margin-right:5%;/* margin-top:-1.5%; */">
    <div style="font-size: 12px;">
        Montants exprimés en
        <?php if ($commandeclient->devis_id) { ?>
            <?= h($commandeclient->devise->name) ?>
        <?php } ?>
    </div>
</div>

<table class="tabstyle" style="margin-left:1%;width: 98%;" border="0" height="500px">
    <thead>
        <tr height="7px">
            <td align="center" class="solid-border" style="width: 13% !important;border:1px solid gray;">
                Référence
            </td>
            <!--  <td align="center" class="solid-border" style="width: 30%;border:1px solid gray;">
                                Désignation
                            </td> -->
            <td align="center" class="solid-border"
                style="width:47% !important;  word-wrap: break-word;white-space: normal; border:1px solid gray;">
                Désignation
            </td>
            <td align="center" class="solid-border"
                style="text-align:center;width: 12% !important;border:1px solid gray;">
                P.U.H.T
            </td>
            <td align="center" class="solid-border"
                style="text-align:center;width:8% !important;border:1px solid gray;">
                Qté
            </td>
            <td align="center" class="solid-border"
                style="text-align:center;width: 5% !important; border:1px solid gray;">
                Unité
            </td>
            <td align="center" class="solid-border"
                style="text-align:center;width: 15% !important;border:1px solid gray;">
                Total HT
            </td>
        </tr>
    </thead>
    <tbody>
        <?php
        $ki=14;
        $nbpage=0;
        if ($indexcc<=14) {
            $ki=12; 
        }else{
            $nbpage+=1;
        }
        $nbpage+=ceil(($indexcc-$ki)/21);
       $resteligne= ($indexcc-$ki)%21;
       
        $virg = 3;
        if ($commandeclient->nbfergule) {
            $virg = $commandeclient->nbfergule;
        }
        $pag = 0;
        $i = 0;
        $total_transportt = 0;
        //debug($commandeclient->lignecommandeclients);die;
        $total_produit = 0;
        $tot_remisetransport = 0;
        $k = 0;
        $tl = 0;
        $tt_TotalHT = 0;
        $tot_remiseproduit = 0;
        foreach ($commandeclient->lignecommandeclients as $lignecommandeclient):
            if ($lignecommandeclient['article_id']) {
                $articl = $connection->execute('SELECT * FROM articles where articles.id =' . $lignecommandeclient['article_id'])->fetchAll('assoc');
            }
            // debug($articl);  
        

            if ($lignecommandeclient['type'] == 2) {
                //print_r($lignecommandeclient['ttc']);die;
                // $total_transportt = $total_transportt + (float) $lignecommandeclient['ttc'];
                $total_transportt = $total_transportt + (float) ($lignecommandeclient['prixht'] * $lignecommandeclient['qte']);
                $remiseservice = (float) ($lignecommandeclient['prixht'] * $lignecommandeclient['qte']) - (float) $lignecommandeclient['ttc'];
                $tot_remisetransport += $remiseservice;
            }
            if ($lignecommandeclient['type'] == 1) {
                $total_produit = $total_produit + (float) $lignecommandeclient['ttc'];
            }

            ?>
            <?php
            if ($lignecommandeclient->type == 1) {
                $k++;
                $i++;
                if ($articl[0]['unite_id']) {
                    // debug($unite);
        
                    $unitename = $connection->execute('SELECT * FROM unites where unites.id =' . $articl[0]['unite_id'])->fetchAll('assoc');
                }
                ?>
                <tr class="tr">
                    <td align="center" style="vertical-align:top;height: 1px;"
                        class="<?= (($k === $ki) || ($k === 21)|| ($k === 17)) ? 'solid-border2' : 'dotted-border' ?>">
                        <?php echo $indexcc.  h($articl[0]['Refggb']); ?>
                    </td>
                    <td align="center" style="height: 1px;vertical-align:top; word-break: break-word;  white-space: normal; "
                        class="<?= (($k === $ki) || ($k === 21)|| ($k === 17)) ? 'solid-border2' : 'dotted-border' ?>">
                        <?php echo h($articl[0]['Dsignation'] . ' ' . $articl[0]['Description']); ?><br>
                        <?php if ($lignecommandeclient['description'] != null) {
                            $leng = strlen($lignecommandeclient['description']);
                            if ($leng > 48) {
                                $tl++;
                            }
                            echo h($lignecommandeclient['description']);
                        } else {
                            echo '<br>';
                        } ?>
                    </td>
                    <?php if ($commandeclient->devise->name === 'Dollars US'): ?>
                        <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                            class="<?= (($k === $ki) || ($k === 21)|| ($k === 17)) ? 'solid-border2' : 'dotted-border' ?>">
                            <!-- <?= $lignecommandeclient['prixht'] ?> -->
                            <?= sprintf("%01." . $virg . "f", $lignecommandeclient['prixht']) ?>
                            $
                        </td>
                    <?php elseif ($commandeclient->devise->name === 'Euro'): ?>
                        <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                            class="<?= (($k === $ki) || ($k === 21)|| ($k === 17)) ? 'solid-border2' : 'dotted-border' ?>">
                            <?= sprintf("%01." . $virg . "f", $lignecommandeclient['prixht']) ?> €
                        </td>
                    <?php else: ?>
                        <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                            class="<?= (($k === $ki) || ($k === 21)|| ($k === 17)) ? 'solid-border2' : 'dotted-border' ?>">
                            <?= sprintf("%01." . $virg . "f", $lignecommandeclient['prixht']) ?>
                        </td>
                    <?php endif; ?>
                    <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                        class="<?= (($k === $ki) || ($k === 21)|| ($k === 17)) ? 'solid-border2' : 'dotted-border' ?>">
                        <div style="margin-left: 25% ;">
                            <?php
                            $qte = $lignecommandeclient['qte'];
                            $TotalHT = $lignecommandeclient['prixht'] * $qte;
                            echo $lignecommandeclient->qte ?>
                        </div>
                    </td>


                    <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                        class="<?= (($k === $ki) || ($k === 21)|| ($k === 17)) ? 'solid-border2' : 'dotted-border' ?>">
                        <?php
                        if ($unitename) {
                            echo h($unitename[0]['name']);
                        } ?>
                    </td>

                    <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                        class="<?= (($k === $ki) || ($k === 21)|| ($k === 17)) ? 'solid-border2' : 'dotted-border' ?>">
                        <?php
                        $tt_TotalHT += $TotalHT;
                        $totalht = $lignecommandeclient['ttc'];
                        $remiseproduit = (float) $TotalHT - (float) $totalht;
                        $tot_remiseproduit += $remiseproduit;
                        if ($commandeclient->devise->name === 'Dollars US'): ?>
                            <?= sprintf("%01." . $virg . "f", $TotalHT) ?> $
                        <?php elseif ($commandeclient->devise->name === 'Euro'): ?>
                            <?= sprintf("%01." . $virg . "f", $TotalHT) ?> €
                        <?php else: ?>
                            <?= sprintf("%01." . $virg . "f", $TotalHT) ?>
                        <?php endif; ?>
                    </td>

                </tr>
                <?php
                $kn=21;
                if (($pag==$nbpage-1)&& $resteligne <= 21 && $resteligne >= 18 ) {
                  $kn=17;
                }
                if (($k == $ki && $pag == 0) || ($pag != 0 && $k == $kn)) {

                    $pag++;
                    
                    $k = 0; ?>

            </table>
            <div style="margin-top:<?php if ($pag == 0 && $k==14) { ?>65px<?php }else if ($pag == 1 && $ki==14) {echo "100px";}else if ($pag == 1 && $ki==12){ echo "170px";}else if ($pag !=0 && $kn==17){ echo "180px";} else { ?>40px<?php } ?>">
                <hr style="color: black;border: 2px solid;width:80%;" />
                <div align="center" class="footerr-text">
                    <table border="0">
                        <thead>
                            <tr>
                                <td style="width:5%;padding: 5px;"> </td>
                                <td style="width:5%;padding: 5px;">
                                    <?php

                                    $mail_jpg = file_get_contents('https://geniusbusiness.isofterp.com/genuis/webroot/img/mail.png');
                                    $maps_jpg = file_get_contents('https://geniusbusiness.isofterp.com/genuis/webroot/img/maps.png');
                                    if ($mail_jpg !== false) {
                                        $imgmail = 'data:image/png;base64,' . base64_encode($mail_jpg);
                                    }
                                    if ($maps_jpg !== false) {
                                        $imgmaps = 'data:image/png;base64,' . base64_encode($maps_jpg);
                                    }
                                    echo '<img src="' . $imgmail . '" alt="Image" height="20px" width="30px" style="">'; ?>
                                </td>
                                <td style="width:5%"> <span>
                                        <strong style="    font-family: 'FontAwesome';
    font-size: 18px;">contact@genuisgb.net</strong> </span></td>
                                <td style="width:20%"></td>

                                <td style="width:10%">
                                    <?php echo '<img src="' . $imgmaps . '" alt="Image" height="30px" width="27px" style=" ">'; ?>

                                </td>
                                <td style="width:30%">
                                    <strong> 50,
                                        Rue 8600, Escaliers C, 2éme étage, <br> C-2-4 ,Z.I Charguia 1, 2035,
                                        Tunis </strong>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <p style="page-break-after: always;"></p>
            <div style="position: relative; top: 0;">
                <!-- Bande noire continue -->
                <div style="background-color: black; height: 28px;width:110%;margin-top:-14px;margin-left:-20px"></div>

                <div style="position: absolute; top: -10px; left: 8%; transform: translateX(-50%); z-index: 1;">

                    <?php echo '<img src="' . $base64Image . '" alt="Image" height="125px" width="140px">'; ?>
                </div>
            </div>
            <br><br>
            <br><br><br><br><br>
            <table class="tabstyle" style="margin-left:1%;width: 98%;" height="1000px">
                <thead>
                    <tr height="7px">
                        <td align="center" class="solid-border" style="width: 15% !important;border:1px solid gray;">
                            Référence
                        </td>
                        <!--  <td align="center" class="solid-border" style="width: 30%;border:1px solid gray;">
                                Désignation
                            </td> -->
                        <td align="center" class="solid-border"
                            style="width: 45% !important;  word-wrap: break-word;white-space: normal; border:1px solid gray;">
                            Désignation
                        </td>
                        <td align="center" class="solid-border"
                            style="text-align:center;width: 10% !important;border:1px solid gray;">
                            P.U.H.T
                        </td>
                        <td align="center" class="solid-border"
                            style="text-align:center;width:10% !important;border:1px solid gray;">
                            Qté
                        </td>
                        <td align="center" class="solid-border"
                            style="text-align:center;width: 5% !important; border:1px solid gray;">
                            Unité
                        </td>
                        <td align="center" class="solid-border"
                            style="text-align:center;width: 15% !important;border:1px solid gray;">
                            Total HT
                        </td>
                    </tr>
                </thead>
                <tbody>
                <?php }
            }
        endforeach;
        switch ($k) {
            case 10:
                $topdiv = '';
                $heighttd = '<br><br><br><br><br><br>';
                $heighttd1 = '<br><br><br>';
                break;
                case 15:
                    $topdiv = '';
                    $heighttd = '<br><br><br>';
                    $heighttd1 = '<br><br><br>';
                    break;
                    case 16:
                        $topdiv = '';
                        $heighttd = '<br><br>';
                        $heighttd1 = '<br><br><br>';
                        break;
                        case 17:
                            $topdiv = '';
                            $heighttd = '<br><br><br><br><br><br>';
                            $heighttd1 = '<br><br><br>';
                            break;
            case 11:
                    $topdiv = '';
                    $heighttd = '<br><br><br><br><br><br>';
                    $heighttd1 = '<br><br>';
                break;

            case 0:
                $topdiv = '-8%';
                $heighttd = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                $heighttd1 = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                break;
            case 1:
                $topdiv = '-6%';
                $heighttd = '<br><br><br><br><br><br><br><br><br><br<br><br><br><br><br><br><br><br><br><br><br><br><br>';
                $heighttd1 = '<br><br><br><br><br><br><br><br><br><br<br><br><br><br><br><br>';
                break;
            case 2:
                $topdiv = '-7%';
                $heighttd = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                $heighttd1 = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                break;
            case 3:
                $heighttd = '<br><br><br><br><br><br><br><br><br><br><br><br><br>';
                $heighttd1 = '<br><br><br><br><br><br><br><br><br><br><br><br><br>';
                break;
            case 4:
                $heighttd = '<br><br><br><br><br><br><br><br><br><br><br><br>';
                $heighttd1 = '<br><br><br><br><br><br><br><br><br><br><br>';
                break;
            case 5:
                $heighttd = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                $heighttd1 = '<br><br><br><br><br><br><br><br><br><br>';
                break;
            case 6:
                $heighttd = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                $heighttd1 = '<br><br><br><br><br><br><br><br><br>';
                break;
            case 7:
                $heighttd1 = '<br><br><br><br><br><br><br>';
                $heighttd = '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>';
                break;
            case 8:
                $topdiv = '-6%';
                $heighttd = '<br><br><br><br>';
                $heighttd1 = '<br><br><br><br><br><br>';
                break;
            case 9:
                $heighttd = '<br><br><br><br><br><br>';
                $heighttd1 = '<br><br><br><br><br>';
                break;
        }
        for ($s = 0; $s <= $tl; $s++) {
            $heighttd = preg_replace('/<br>/', '', $heighttd, 1);  // Remplace une seule occurrence
        }
        for ($s = 0; $s <= $tl; $s++) {
            $heighttd1 = preg_replace('/<br>/', '', $heighttd1, 1);  // Remplace une seule occurrence
        }
        // if ($k != 8) { ?>
        <tr>

            <td style="border-left:1px solid gray;border-bottom:1px solid gray;vertical-align:top;">
                <?php if ($pag==0) {?><?= $heighttd1 . $heighttd1 ?>   <?php     }else{ ?> <?= $heighttd . $heighttd ?> <?php     } ?>
                
            </td>
            <td style="border-left:1px solid gray;border-bottom:1px solid gray;vertical-align:top;">
            </td>
            <td style="border-left:1px solid gray;border-bottom:1px solid gray;vertical-align:top;">
            </td>
            <td style="border-left:1px solid gray;border-bottom:1px solid gray;vertical-align:top;">
            </td>
            <td style="border-left:1px solid gray;border-bottom:1px solid gray;vertical-align:top;">
            </td>
            <td
                style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray;vertical-align:top;">
            </td>

        </tr>
        <tr>
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
            <td colspan="2" style="border: none; vertical-align: top;padding-left: 0 !important;">
                <div style="margin-left:1%; font-size: 12px;">
                    <strong>Arrêter la présente Proposition commerciale à la somme de :</strong>
                </div>
                <div class="boxbordergray" style="height: 35px;width:99% !important;  font-size: 12px;">
                    <div style="margin-left: 1%;">
                        <?php echo ucfirst(int2str(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)))); ?>
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
                        <?php  echo $lignecommandeclient2sdes['description']; 
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
                <!-- <div style="display: flex; justify-content: space-between;">

                    <div style="margin-left: 60px;">
                        <?php
                        echo $commandeclient->remarque;
                        ?>
                    </div>

                </div> -->
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
                    if ($commandeclient->client->port) { ?>-<?php echo $commandeclient->client->port;
                    }
                    if ($commandeclient['pay'] != '') {
                        #
                        ?>- <?php }
                    echo $commandeclient['pay'] ?>
                </div>

            </td>
            <td rowspan="2" colspan="2" align="end" style="vertical-align: top;text-align:right">
                <div>
                    <?php echo sprintf("%01." . $virg . "f", str_replace(",", ".", $tt_TotalHT)); ?>
                    <?php if ($commandeclient->devis_id) {
                        echo $commandeclient->devise->code;
                    } ?>
                </div>
                <?php if ($total_transportt != 0) { ?>
                    <div style="margin-top:5%">
                        <?php



                        //$total_transportt=(float)$commandeclient->total_transport*(float)$i;
                        echo sprintf("%01." . $virg . "f", str_replace(",", ".", $total_transportt)); ?>
                        <?php if ($commandeclient->devis_id) {
                            echo $commandeclient->devise->code;
                        } ?>
                    </div>
                <?php } ?>
                <?php if ($total_transportt != 0 && $tot_remisetransport != 0 && $commandeclient->activeremisetransport == 1) { ?>

                    <div style="margin-top:5%">
                        <?php



                        //$total_transportt=(float)$commandeclient->total_transport*(float)$i;
                        echo sprintf("%01." . $virg . "f", str_replace(",", ".", $tot_remisetransport)); ?>
                        <?php if ($commandeclient->devis_id) {
                            echo $commandeclient->devise->code;
                        } ?>
                    </div>

                <?php } ?>
                <?php $remiseglobale = $commandeclient->totalremise - $tot_remisetransport;
                if ($remiseglobale != 0 && $commandeclient->activeremise == 1) { ?>

                    <div style="margin-top:5%">
                        <?php echo sprintf("%01." . $virg . "f", str_replace(",", ".", ($remiseglobale))); ?>
                        <?php if ($commandeclient->devis_id) {
                            echo $commandeclient->devise->code;
                        } ?>
                    </div>

                <?php } ?>

                <div style="margin-top:5%">
                    <?php echo sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)); ?>
                    <?php if ($commandeclient->devis_id) {
                        echo $commandeclient->devise->code;
                    } ?>
                </div>
               
               
            </td>
        </tr>


        <tr>
            <td colspan="2" style="padding: 0px !important;">
                <div style="margin-left: 0%; margin-right: 5%;padding-top: -2%;">
                    <strong>Conditions de règlement : </strong>
                    <?php echo $commandeclient->conditionreglement->conditionn; ?>
                </div>
                <div style="margin-right: 2%;margin-top: 1%;font-size: 11px;">
                    <strong>Mode de transport : <?php
                    $connection = ConnectionManager::get('default');

                    if ($commandeclient['modetransport_id']) {
                        # code...
                    
                        $modetransportt = $connection->execute("SELECT * FROM modetransports  WHERE id='" . $commandeclient['modetransport_id'] . "' ;")->fetchAll('assoc');

                        echo $modetransportt[0]['name'];
                    } ?></strong>
                </div>
                <div style="margin-right: 5%;font-size: 11px;margin-top: 1.5%;">
                    <strong>Délai de livraison :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php echo $commandeclient->delailivraison->name; ?></strong>
                </div>

                <div style=" margin-right: 5%;font-size: 11px;margin-top: 1.5%;">
                    <strong>Règlement par virement sur le compte bancaire suivant :</strong>
                </div>
                <div style="margin-right: 5%;font-size: 11px ;">
                    <strong>Code IBAN : <?php echo $compbanq ?></strong>

                </div>
                <div style=" margin-right: 5%;font-size: 11px; ">
                    <strong>Code BIC/SWIFT :</strong> <strong><?php echo $bicswift; ?></strong>

                </div>
                <div style="margin-right: 5%;font-size: 11px;">
                    <strong>Banque: <?php echo $banq ?></strong>

                </div>
                <div style=" margin-right: 5%;font-size: 11px;">
                    <strong>Nom du propriétaire du compte : <?php echo $proprietaire; ?>
                    </strong>
                </div>
                <!-- <div style="margin-top:-1000px">
                    <?php if ($userSignature):
                        $marginright = "20px";
                        $topsignature = "-50px";
                        if ($commandeclient->activeremise == 1) {

                            if ($tot_remisetransport == 0 && $tot_remiseproduit == 0 && $remiseglobale == 0) {
                                $topsignature = "-120px";
                            } else if (($tot_remisetransport != 0 && $tot_remiseproduit != 0 && $remiseglobale == 0) || ($tot_remisetransport != 0 && $tot_remiseproduit == 0 && $remiseglobale != 0) || ($tot_remisetransport == 0 && $tot_remiseproduit != 0 && $remiseglobale != 0)) {
                                $topsignature = "0px";
                            } else if (($tot_remisetransport != 0 && $tot_remiseproduit == 0 && $remiseglobale == 0) || ($tot_remisetransport == 0 && $tot_remiseproduit != 0 && $remiseglobale == 0) || ($tot_remisetransport == 0 && $tot_remiseproduit == 0 && $remiseglobale != 0)) {
                                $topsignature = "-100px";
                            } else if ($tot_remisetransport != 0 && $tot_remiseproduit != 0 && $remiseglobale != 0) {
                                $topsignature = "-80px";
                                $marginright = "92px";
                            }
                        }

                        ?>
                        <?php echo '<img src="' . $base64Signature . '" alt="Image" height="50px" width="130px" style="">'; ?>
                    <?php endif; ?>
                </div> -->
            </td>
        </tr>
        <?php //} ?>
    </tbody>
</table>




<div style="">
    <hr style="color: black;border: 2px solid;width:80%; " />
    <div align="center" class="footerr-text" style=" ">
        <table border="0">
            <thead>
                <tr>
                    <td style="width:5%"></td>
                    <td style="width:5%">
                        <?php

                        $mail_jpg = file_get_contents('https://geniusbusiness.isofterp.com/genuis/webroot/img/mail.png');
                        $maps_jpg = file_get_contents('https://geniusbusiness.isofterp.com/genuis/webroot/img/maps.png');
                        if ($mail_jpg !== false) {
                            $imgmail = 'data:image/png;base64,' . base64_encode($mail_jpg);
                        }
                        if ($maps_jpg !== false) {
                            $imgmaps = 'data:image/png;base64,' . base64_encode($maps_jpg);
                        }
                        echo '<img src="' . $imgmail . '" alt="Image" height="20px" width="30px" style="">'; ?>
                    </td>
                    <td style="width:5%"> <span style="margin-top:-20%">
                            <strong style="    font-family: 'FontAwesome';
    font-size: 18px;">contact@genuisgb.net</strong> </span></td>
                    <td style="width:20%"></td>

                    <td style="width:10%">
                        <?php echo '<img src="' . $imgmaps . '" alt="Image" height="30px" width="27px" style=" ">'; ?>

                    </td>
                    <td style="width:30%">
                        <strong> 50,
                            Rue 8600, Escaliers C, 2éme étage, <br> C-2-4 ,Z.I Charguia 1, 2035,
                            Tunis </strong>
                    </td>
                </tr>
            </thead>
        </table>
    </div>

    <?php //echo $this->Html->image('footer.png', ['width' => '700', 'height' => '70']); 
    ?>
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

    .solid-border2 {
        border-left-width: 1px;
        border-bottom-width: 1px;
        border-bottom-style: solid;
        border-right-width: 1px;
        border-top-width: 1px;
        border-left-style: solid;
        border-right-style: solid;
        border-top-style: dotted;
        border-bottom-style: solid;
        border-color: gray;
    }

    .dotted-border {
        border-left-width: 1px;
        border-right-width: 1px;
        border-top-width: 1px;
        border-bottom-width: 1px;

        border-left-style: solid;
        border-right-style: solid;
        border-top-style: dashed;
        border-bottom-style: dashed;
        border-right-color: gray;
        border-left-color: gray;
        border-bottom-color: black;
        border-top-color: black;
    }
</style>

<style>
    .footerr-text {
        position: fixed;
        /* bottom: -1px; */

        margin-left: 15%;
        /* left: 35px; */
        /* width: 30px; */
        text-align: center;
    }

    .footerr-textt {
        position: fixed;
        /* bottom: -1px; */
        /* margin-top: 170px; */
        margin-right: 10%;
        margin-left: 10%;
        /* left: 35px; */
        width: 5%;
        text-align: center;
    }
</style>
<style>
    /* CSS pour la bordure pointillée */
    table tr:nth-child(even) {
        /* border-bottom: 0.5px dashed gray;*/
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