<?php

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;
use App\Model\Table\SignaturesTable; ?>
<?php $this->layout = 'AdminLTE.printt';
$connection = ConnectionManager::get('default');

$session = $this->request->getSession();

$authData = $session->read('Auth');
//$Projets = new ProjetsTable();
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

$domainName = $_SERVER['HTTP_HOST'];
$requestUri = $_SERVER['REQUEST_URI'];
$segments = explode('/', trim($requestUri, '/')); // Découpe l'URL en segments

$baseSegment = isset($segments[0]) ? '/' . $segments[0]  : '/';

$wr = $protocol . $domainName.$baseSegment;
//$projet = $connection->execute('Select * from projets,devises where projets.id=' . $commandeclient->id . ' and projets.devise_id=devises.id');

if ($authData && is_object($authData)) {
    $personnelId = $authData->personnel_id;
    $signaturesTable = new SignaturesTable();
    $userSignature = $signaturesTable->find()
        ->where(['personnel_id' => $personnelId])
        ->first();
    if ($userSignature) {
        // $filename = urlencode($userSignature->filename);
        // debug($userSignature->filename);
        $signatureData = file_get_contents($wr.'/webroot/img/logosignature/' . $userSignature->filename);
        if ($signatureData !== false) {
            $base64Signature = 'data:image/png;base64,' . base64_encode($signatureData);
        } else {
            echo 'Impossible de charger la signature.';
        }
    }
}

?>
<?php
$imageUrl = $wr.'/webroot/img/logoggb.png';
$imageData = file_get_contents($imageUrl);
if ($imageData !== false) {
    $base64Image = 'data:image/png;base64,' . base64_encode($imageData);
}
$footerUrl =  $wr.'/webroot/img/footer.png';
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
        <strong>Commande fournisseur <?php echo $commandefournisseur->numero ?>

        </strong><br>
    </div>
    <div
        style=" display: flex; text-align:right;position: relative; justify-content: flex-end !important; /* color: #103458; */ font-size: 1.2em; ">
        Date prévue de livraison :
            <?php $dateprev = $commandefournisseur->dateprev;
            if ($dateprev) {
                $date = $dateprev->format('Y-m-d');
                echo $date;
            } ?>
        
    </div>
    <div
        style="display: flex; text-align:right; position: relative; justify-content: flex-end; font-size:1em; /* color: #103458; */">
        Code fournisseur :
        <?= h($commandefournisseur->fournisseur->code) ?>
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
           
        <?= h($fournisseur->name) ?>
                </strong>
                <br>
                <?= h($fournisseur->adresse) ?>
                <br>
                <?= h($fournisseur->port) ?>
                <br>
                <?= h($fournisseur->Code_VilleL) ?>
                <?php if($fournisseur->tel){ ?>
                Téléphone:
                <?= h($fournisseur->tel) ?><?php } ?>
                <br><?php if($fournisseur->fax){ ?>
                Fax :
                <?= h($fournisseur->fax) ?><?php } ?>
                <br><?php if($fournisseur->mail){ ?>
                Email :
                <?= h($fournisseur->mail) ?><?php } ?>
        </div>
    </div>
</div>


<div class="boxbordergray" style="width: 98%;/*  height: 19px; */ margin-left: 1%; margin-right: 5%;margin-top: 2%;">
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

<div style="width: 98%;height: 20px;margin-left:1%;margin-right:5%;/* margin-top:-1.5%; */">
    <div style="font-size: 12px;">
        Montants exprimés en
        <?php $devise = $commandefournisseur->devise_id;
            if ($devise) {
                $Devise = $commandefournisseur->devise->name; ?>
                <?= h($Devise) ?>
            <?php } ?>
    </div>
</div>
<?php
$indexcc = 0;
$heii = 0;
$nblignetotal=0;
foreach ($commandeclient->lignecommandeclients as $lignecommandeclient) {
   
        $nblignetotal++;
        if ($lignecommandeclient['article_id']) {
            $articl = $connection->execute('SELECT * FROM articles where articles.id =' . $lignecommandeclient['article_id'])->fetchAll('assoc');
        }

        $designation = $articl[0]['Dsignation'] . ' ' . $articl[0]['Description'];
        $designationLength = strlen($designation ?? '');

        $additionalRows1 = ceil($designationLength / 62);
        $descriptionLength = strlen($lignecommandeclient['description'] ?? '');
        $additionalRows = ceil($descriptionLength / 62);  // 50 chars per line estimate
        $additionalRows2 = ceil((strlen($articl[0]['Refggb']) ?? '') / 14);
        if ($additionalRows2 >= $additionalRows1) {
            $indexcc += $additionalRows2;
        } else {
            $indexcc += $additionalRows1;
        }
        $indexcc += $additionalRows;
        $chaine = $articl[0]['Dsignation'] . ' ' . $articl[0]['Description'];
        $vmpp = calculateTdHeight($chaine, 16, 1.5, 62);
        if ($vmpp <= 24) {
            $chaine = $articl[0]['Refggb'];
            $vmpp = calculateTdHeight($chaine, 16, 1.5, 14);
        }
       // $heii += $vmpp1;
        $heii += $vmpp;
        if ($vmpp==0 ) {
            $heii +=24;
        }
    

}


if ($heii > 500) {

    $heitab = 700-$nbpxnote;
} else {
    $heitab = 560-$nbpxnote;
}

?>
<table class="tabstyle" style="margin-left:1%;width: 98%;height: <?php echo $heitab; ?>px !important" border="0">
    <thead>
        <tr height="7px">
            <td align="center" class="solid-border" style="width: 15% !important;border:1px solid gray;">
                <?php //echo $heitab; ?> Référence
            </td>
            <!--  <td align="center" class="solid-border" style="width: 30%;border:1px solid gray;">
                                Désignation
                            </td> -->
            <td align="center" class="solid-border"
                style="width:47% !important;  word-wrap: break-word;white-space: normal; border:1px solid gray;">
                Déscription
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
                style="text-align:center;width: 3% !important; border:1px solid gray;">
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
        $indexcc = 0;
        $nbpage = 0;
        $tabheight=[];
        $nbtr=0;
        $l=0;
        $heiii1=0;
        foreach ($lignecommandefournisseurs as $lignecommandeclient) {
            $nbtr++;
            $qte = $lignecommande->qte;
            $prix = $lignecommande->prix;
            $montant = $qte * $prix;
          
                if ($lignecommandeclient['article_id']) {
                    $articl = $connection->execute('SELECT * FROM articles where articles.id =' . $lignecommandeclient['article_id'])->fetchAll('assoc');
                }

                $designation = $articl[0]['Dsignation'] . ' ' . $articl[0]['Description'];
                $designationLength = strlen($designation ?? '');

                $additionalRows1 = ceil($designationLength / 62);
                $descriptionLength = strlen($lignecommandeclient['description'] ?? '');
                $additionalRows = ceil($descriptionLength / 62);  // 50 chars per line estimate
                $additionalRows2 = ceil((strlen($articl[0]['Refggb']) ?? '') / 11);
                if ($additionalRows2 >= $additionalRows1) {
                    $indexcc += $additionalRows2;
                } else {
                    $indexcc += $additionalRows1;
                }
                $indexcc += $additionalRows;
                $chaine = $articl[0]['Dsignation'] . ' ' . $articl[0]['Description'];
                $vmp = calculateTdHeight($chaine, 16, 1.5, 62);
                if ($vmp <= 24) {
                    $chaine = $articl[0]['Refggb'];
                    $vmp = calculateTdHeight($chaine, 16, 1.5, 14);
                }
                $heiii += $vmp;
                $heiii1 += $vmp;
              
                if ($vmp==0 ) {
                    $heiii1 +=24;
                }
              
                if (($heiii1 >= 400 && $nbpage == 0)|| ($heiii1 >= 700 && $nbpage != 0) ) {
                    $nbpage += 1;
                    $tabheight[$l]['height']=$heiii1;
                    $tabheight[$l]['nbtr']=$nbtr;
                    $l++;
                    $heiii1 = 0;
                    $nbtr=0;
                }
          

        }
        $ki = 30;
        
        //$nbpage = 0;
        if ($heiii <= 500) {
            $rs = $indexcc - 18;
            //  if($rs>=0){
            //     $ki=33; 
            //  }else{
            //     $ki=18; }
            $ki = 18;

        } else {
           /// $nbpage += 1;
        }

      
       // $nbpage += ceil(($indexcc - $ki) / 40);
        $resteligne = ($indexcc - $ki) % 40;

        $virg = 3;
        if ($commandefournisseur->nbfergule) {
            $virg = $commandefournisseur->nbfergule;
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
        $hei = 0;
        $at = 0;
        $heipin = 0;
        foreach ($lignecommandefournisseurs as $lignecommandeclient):

            $qte = $lignecommandeclient->qte;
            $prix = $lignecommandeclient->prix;
            $montant = $qte * $prix;

            ?>
            <?php

          //  if ($lignecommandeclient->type == 1) {
                // $k++;
                $i++;
                $articl = array();
                if ($lignecommandeclient['article_id']) {
                    $articl = $connection->execute('SELECT * FROM articles where articles.id =' . $lignecommandeclient['article_id'])->fetchAll('assoc');
                }
                if ($articl[0]['unite_id']) {
                    // debug($unite);
        
                    $unitename = $connection->execute('SELECT * FROM unites where unites.id =' . $articl[0]['unite_id'])->fetchAll('assoc');
                }
                $designation = $articl[0]['Dsignation'] . ' ' . $articl[0]['Description'];
                $designationLength = strlen($designation ?? '');
                $chaine = $articl[0]['Dsignation'] . ' ' . $articl[0]['Description'];

                $additionalRows1 = ceil($designationLength / 62);
                $descriptionLength = strlen($lignecommandeclient['description'] ?? '');
                $additionalRows = ceil($descriptionLength / 62);  // 50 chars per line estimate
                $additionalRows2 = ceil((strlen($articl[0]['Refggb']) ?? '') / 11);
                if ($additionalRows2 >= $additionalRows1) {//;die;
                    if ($additionalRows2 == 1) {
                        // $hei+=2;
                        $at = 1;
                        $k += $additionalRows2;
                    } else {
                        //   $hei+=$additionalRows2*13+2;
                        $k += $additionalRows2;
                    }

                } else {
                    //  $hei+=$additionalRows1*13+2;
                    $k += $additionalRows1;
                }
                if ($additionalRows) {
                    // $hei+=$additionalRows*13;
                    $k += $additionalRows;
                } else {
                    $at = 1;
                    // $hei+=2;
                }
                $vmp = calculateTdHeight($chaine, 16, 1.5, 62);
                if ($vmp <= 24) {
                    $chaine = $articl[0]['Refggb'];
                    $vmp = calculateTdHeight($chaine, 16, 1.5, 14);
                }
                $hei += $vmp;
                
                if ($vmp==0) {
                    $hei +=24;
                }
                ?>
                <tr class="tr">
                    <td align="center"
                        style="        <?php $heitd0=''; if ($heitab>$tabheight[0]['height'] && $pag==0 && $nbpage!=0){ $heitd0=500/(float)$tabheight[0]['nbtr'];} else if ($heipin>$tabheight[$pag]['height'] && $pag!=$nbpage && $nbpage!=0 ) {
                          $heitd0=680/(float)$tabheight[$pag]['nbtr'];
                        }?>height:<?php echo $heitd0; ?>px !important;<?php //}?>vertical-align:top;fontSieze;: 16px !important;word-break: break-word;  white-space: normal; "
                        class="<?= (($k === $ki) || ($k === 40) || ($k === 38) || ((float)$tabheight[0]['nbtr']==$i) ) ? 'solid-border2' : 'dotted-border' ?>">
                        <?php echo h($articl[0]['Refggb']); ?>
                    </td>
                    <td align="center" style="vertical-align:top; word-break: break-word;  white-space: normal; "
                        class="<?= (($k === $ki) || ($k === 40) || ($k === 38) || ((float)$tabheight[0]['nbtr']==$i)) ? 'solid-border2' : 'dotted-border' ?>">
                        <?php echo h( $designation); 
                        
                        ?>
                        <!-- <?= (($k === $ki) || ($k === 40) || ($k === 38)) ? 'solid-border2' : 'dotted-border' ?> -->
                     
                    </td>
                    <?php if ($Devise === 'Dollars US'): ?>
                        <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                            class="<?= (($k === $ki) || ($k === 40) || ($k === 38) || ((float)$tabheight[0]['nbtr']==$i)) ? 'solid-border2' : 'dotted-border' ?>">
                            <!-- <?= $lignecommandeclient['prix'] ?> -->
                            <?= sprintf("%01." . $virg . "f", $lignecommandeclient['prix']) ?>
                            $
                        </td>
                    <?php elseif ($Devise === 'Euro'): ?>
                        <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                            class="<?= (($k === $ki) || ($k === 40) || ($k === 38) || ((float)$tabheight[0]['nbtr']==$i)) ? 'solid-border2' : 'dotted-border' ?>">
                            <?= sprintf("%01." . $virg . "f", $lignecommandeclient['prix']) ?> €
                        </td>
                    <?php else: ?>
                        <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                            class="<?= (($k === $ki) || ($k === 40) || ($k === 38) || ((float)$tabheight[0]['nbtr']==$i)) ? 'solid-border2' : 'dotted-border' ?>">
                            <?= sprintf("%01." . $virg . "f", $lignecommandeclient['prix']) ?>
                        </td>
                    <?php endif; ?>
                    <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                        class="<?= (($k === $ki) || ($k === 40) || ($k === 38) || ((float)$tabheight[0]['nbtr']==$i)) ? 'solid-border2' : 'dotted-border' ?>">
                        <div style="margin-left: 25% ;">
                            <?php
                            $qte = $lignecommandeclient['qte'];
                            $TotalHT = $lignecommandeclient['prix'] * $qte;
                            echo  $lignecommandeclient->qte ?>
                        </div>
                    </td>


                    <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                        class="<?= (($k === $ki) || ($k === 40) || ($k === 38) || ((float)$tabheight[0]['nbtr']==$i)) ? 'solid-border2' : 'dotted-border' ?>">
                        <?php //echo $tabheight[0]['height'].' '.$heitab;
                        if ($unitename) {
                            echo h($unitename[0]['name']);
                        } ?>
                    </td>

                    <td align="center" style="text-align:right ;height: 1px;vertical-align:top;"
                        class="<?= (($k === $ki) || ($k === 40) || ($k === 38) || ((float)$tabheight[0]['nbtr']==$i)) ? 'solid-border2' : 'dotted-border' ?>">
                        <?php
                        $tt_TotalHT += $TotalHT;
                        $totalht = $lignecommandeclient['ttc'];
                        $remiseproduit = (float) $TotalHT - (float) $totalht;
                        $tot_remiseproduit += $remiseproduit;
                        if ($Devise === 'Dollars US'): ?>
                            <?= sprintf("%01." . $virg . "f", $montant) ?> $
                        <?php elseif ($Devise === 'Euro'): ?>
                            <?= sprintf("%01." . $virg . "f", $montant) ?> €
                        <?php else: ?>
                            <?= sprintf("%01." . $virg . "f", $montant) ?>
                        <?php endif; ?>
                    </td>

                </tr>
                <?php
                $kn = 40;
               
                if (($hei >= 500 && $pag == 0)|| ($hei >= 700 && $pag != 0) ) {


                    $pag++;


                    $resteligne = ($indexcc - $ki) % 40;
                    if ($resteligne <= 0 && $pag == 0) {

                        $heipin = 450;

                    } else if ($resteligne > 0 && $pag == 0) {
                        $heipin = 800;
                    }  else if ($resteligne > 0 && $pag != 0 && ($nbpage-1) == $pag) {
                        $heipin = 700;
                    } else if ($pag < ($nbpage-1) && $pag != 0) {
                        $heipin = 900;
                    }else{
                        $heipin = 700;
                    }
                    $hei = 0;
                    $k = 0;

                    ?>

            </table>
            <div style="">

                <!-- <div style="margin-top:<?php if ($pag == 0 && $k == 30) { ?>65px<?php } else if ($pag == 1 && $ki == 30) {
                    echo "50px";
                } else if ($pag == 1 && $ki == 18) {
                    echo "170px";
                } else if ($pag != 0 && $kn == 28) {
                    echo "180px";
                } else { ?>40px<?php } ?>"> -->
                <hr style="color: black;border: 2px solid;width:80%;" />
                <div align="center" class="footerr-text">
                    <table border="0">
                        <thead>
                            <tr>
                                <td style="width:5%;padding: 5px;"> </td>
                                <td style="width:5%;padding: 5px;">
                                    <?php

                                    $mail_jpg = file_get_contents( $wr.'/webroot/img/mail.png');
                                    $maps_jpg = file_get_contents( $wr.'/webroot/img/maps.png');
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
            <table class="tabstyle" style="margin-left:1%;width: 98%;height: <?php echo $heipin; ?>px !important">
                <thead>
                    <tr height="7px">
                        <td align="center" class="solid-border" style="width: 15% !important;border:1px solid gray;">
                            <?php //echo $nbpage . ' ' . $heipin; ?> Référence
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
                <?php } else {
                    $kn = 10;
               
            }


        endforeach;
        if($nbpage>0){
            $heighttd1 = $heipin - $hei;//-100;
        }else{
            $heighttd1 = $heitab - $hei;
        }
        
        // if ($k != 8) { ?>
        <tr>

            <td
                style="border-left:1px solid gray;border-bottom:1px solid gray;vertical-align:top; height:<?php echo $heighttd1; ?>px !important; ">
                <?php //echo $heipin; ?> <?php //echo $resteligne; ?> <?php //echo $heighttd1; ?> <?php //echo $hei; ?>
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
            <?php 
            $connection = ConnectionManager::get('default');
          
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

                        if ($Devise === 'Dollars US'):
                            echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $tt_TotalHT)), 2, ''));
                        elseif ($Devise === 'Euro'):
                            echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $tt_TotalHT)), 3, ''));

                        else:
                            echo ucfirst_minuscule(chifre_en_lettre11(sprintf("%01." . $virg . "f", str_replace(",", ".", $tt_TotalHT)), 1, ''));

                        endif;
                        //echo ucfirst(int2str(sprintf("%01." . $virg . "f", str_replace(",", ".", $commandeclient->totalttc)))); ?>
                    </div>
                </div>



            </td>
            <td colspan="2" rowspan="2" style="vertical-align: top;text-align:left">

               
                

                

                <div >
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

            </td>
            <td rowspan="2" colspan="2" align="end" style="vertical-align: top;text-align:right">
                <div>
                    <?php echo number_format((float) str_replace(",", ".", $tt_TotalHT), $virg, '.', ' ');
                    //   echo sprintf("%01." . $virg . "f", str_replace(",", ".", ' ',$tt_TotalHT)); ?>
                    <?php if ($commandefournisseur->devise_id) {
                                    echo $commandefournisseur->devise->code;
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
                    <strong>Mode de règlement : <?php
                    $connection = ConnectionManager::get('default');

                    if ($commandeclient['modetransport_id']) {
                        # code...
                    
                        $modetransportt = $connection->execute("SELECT * FROM modetransports  WHERE id='" . $commandeclient['modetransport_id'] . "' ;")->fetchAll('assoc');

                        echo $modetransportt[0]['name'];
                    } ?></strong>
                </div>
              
              
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

                        $mail_jpg = file_get_contents( $wr.'/webroot/img/mail.png');
                        $maps_jpg = file_get_contents( $wr.'/webroot/img/maps.png');
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
function chifre_en_lettre($montant, $devise1, $devise2)
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
        $dev2 = 'Cents';
    if (($devise1 == 3))
        $dev2 = 'Centimes';
    $valeur_entiere = intval($montant);
    $valeur_decimal = (($montant - intval($montant)) * 1000);
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
    //echo $unite_c;
    $chif = array('', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf', 'Dix', 'Onze', 'Douze', 'Treize', 'Quatorze', 'Quinze', 'Seize', 'Dix-sept', 'Dix-huit', 'Dix-neuf');
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
        else if ($cent[$i] != 0 || $cent[$i] != '')
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
        $v = $v . ' ' . ' et z&eacute;ro ' . $dev2;
    else
        $v = $v . ' et ' . round($valeur_decimal, 0) . ' ' . $dev2;
    return $v;
}
//echo chifre_en_lettre($commandeclient->totalttc,3,'');





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
function calculateTdHeight($content, $fontSize, $lineHeight, $charsPerLine)
{
    // Calculer le nombre de lignes
    
    $lines = ceil(strlen( preg_replace('/\s+/', ' ', $content)) / $charsPerLine);

    // Calculer la hauteur estimée (en pixels)
    $estimatedHeight = $lines * $fontSize * $lineHeight;

    return $estimatedHeight;
}
// Exemple d'utilisation

?>