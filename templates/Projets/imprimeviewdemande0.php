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
<!-- <?php debug($facture->numero); ?> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="position: relative; top: -18px;">
    <!-- Bande noire continue -->
    <div style="background-color: black; height: 40px;"></div>

    <!-- Image au-dessus de la bande noire -->
    <div style="position: absolute; top: 10px; left: 10%; transform: translateX(-50%); z-index: 1;">
        <?php echo $this->Html->image('logoggb.png', ['alt' => 'CakePHP', 'height' => '125px', 'width' => '140px']); ?>
    </div>
    <div style="position: absolute; top: 10px; right: 10%; z-index: 1;">
    <a onclick='openWindow(1000, 1000, `/genuis/projets/imprimeviewdemande/<?php echo @$id ; ?>/<?php echo @$idfr ; ?>`)'>
                                                   
                                                
       <button type="button" style="    font-size: 20px;" class="btn btn-xm btn-primary glow-on-hover">Imprimer</button></a>
    </div>
</div>
<div style="width: 87%;height: 20px;margin-left:10%;margin-right:5%;margin-top: 12px;">
    <div style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.5em; ">
        <strong>Demande fournisseur
            <?php echo $dmd->numero ?>
        </strong><br>
    </div>
    <div style="display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.5em;">
        <strong> Code fournisseur:</strong>
        (<strong><?= h($fournisseur->code) ?></strong>)
    </div>

    <div style="display: flex; position: relative; justify-content: flex-end; font-size:1em; color: #103458;">
        Date :
        <?php echo ($dmd->date) ?>
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
    <div class="boxgris" style="width: 46%;height: 150px;margin-left:1%;margin-top:-0.5%;">
        <div style="background:#E6E6E6;margin-top:1%; margin-left:1%;font-size: 13px;">
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
        style="width: 62%;height: 150px;margin-left:1%;margin-right:3%;font-size: 13px;margin-top:-0.5%;">
        <div style="margin-top:1%; margin-left:1%">
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
<?php $projet_id = $commandeclient->projet_id;
$connection = ConnectionManager::get('default');
$projet = $connection->execute('SELECT client_id FROM projets where id =' . $projet_id)->fetchAll('assoc');
$client_id = $projet[0]['client_id'];
// debug($client_id);
$cli = $connection->execute('SELECT devise_id,incoterms,port FROM clients where id =' . $client_id)->fetchAll('assoc');
// debug($cli);
$devise_id = $cli[0]['devise_id'];
$incoterm_id = $cli[0]['incoterms'];
// debug($incoterm_id);
$port = $cli[0]['port'];
// debug($port);
if ($devise_id) {
    $devise = $connection->execute('SELECT name FROM devises where id =' . $devise_id)->fetchAll('assoc');
    // debug($devise[0]['name']);
}
if ($incoterm_id) {
    $incoterm = $connection->execute('SELECT code FROM incoterms where id =' . $incoterm_id)->fetchAll('assoc');
    // debug($incoterm);
}
?>
<div class="boxbordergris" style="width: 96%; height: 20px; margin-left: 1%; margin-right: 5%;margin-top: 10px;">
    <div style="font-size: 12px;">
        Incoterm :
        <span style="color: red; font-weight: bold;">
            <?= h($incoterm[0]['code']); ?>-<?= h($port); ?>

        </span>
    </div>
</div>
<!-- <?php debug($commandeclient->devise->name); ?> -->
<div style="width: 87%;height: 20px;margin-left:1%;margin-right:5%;font-size: 12px;margin-top: 7px;">
    Montants exprimés en
    <?= h($devise[0]['name']) ?>
</div>

<div class="box" style="width: 96%;height :600px; margin-left:0%;margin-right:5%;margin-top: -8px;">
    <div class="panel-body">
        <div class="">
            <table height="453px" style="width: 100%;">
                <thead>
                    <tr height="7px">
                        <td align="center" class="solid-border" style="width: 10%;border:1px solid gray;">
                            Référence
                        </td>
                        <td align="center" class="solid-border" style="width: 40%;border:1px solid gray;">
                            Désignation
                        </td>
                        <td align="center" class="solid-border" style="width: 9%;border:1px solid gray;">
                            Qté
                        </td>
                        <td align="center" class="solid-border" style="width: 5%;border:1px solid gray;">
                            Unité
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ligneas as $ligne):
                        $connection = ConnectionManager::get('default');
                        if ($ligne->article_id != null) {
                            $art = $connection->execute('SELECT * FROM articles where articles.id =' . $ligne->article_id)->fetchAll('assoc');
                            debug($art);
                            $code = $art[0]['Refggb'];
                            debug($code);
                        } else {
                            $art[0]['Dsignation'] = $ligne->DsignationA;
                            $art[0]['Description'] = '';
                        }
                        ?>
                        <tr class="tr">
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;height: 1px;">
                                <?php echo $code; ?>
                            </td>
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;">
                                <?php echo h($art[0]['Dsignation'].' '.$art[0]['Description']); ?>
                            </td>
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;">
                                <div style="margin-left: 25% ;">
                                    <?= $this->Number->format($ligne->qte) ?>
                                </div>
                            </td>
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;">
                                <?php $connection = ConnectionManager::get('default');
                                $art = $connection->execute("SELECT unite_id FROM articles WHERE id = '" . $ligne->article_id . "'")->fetchAll('assoc');
                                $unite_id = $art[0]['unite_id'];
                                // debug($art);
                                $unite = $connection->execute("SELECT name FROM unites ")->fetchAll('assoc');
                                $name = $unite[0]['name'];
                                // debug($unite);
                                echo $name;
                                ?>
                            </td>


                        </tr>
                    <?php endforeach; ?>
                    <tr>
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
            $projet = $connection->execute("SELECT banque_id FROM projets WHERE id = '" . $projet_id . "'")->fetchAll('assoc');
           
            ?>
                 <?php 
            
            $connection = ConnectionManager::get('default');
            if ($projet[0]['banque_id']!=null) {
                # code...
           
            $banque = $connection->execute("SELECT * FROM banques WHERE id = '" . $projet[0]['banque_id'] . "'")->fetchAll('assoc');
            $banq = $banque[0]['name'];
            $proprietaire = $banque[0]['proprietaire'];
            $bicswift = $banque[0]['codeBicswift'];
            $condreg = $banque[0]['conditionReglement'];
        }
            ?>
            <div style="display: flex; justify-content: space-between;margin-top: -14px;margin-left: -1.5%;">
                <div style="width: 65%;">
                    <!-- <div style="margin-left: 3%; margin-right: 5%;font-size: 12px;">
                        <strong>Arrêter la présente commande à la somme de :</strong>
                    </div>
                    <div class="boxbordergray"
                        style="height: 30px; margin-left: 3%; margin-right: 5%;font-size: 12px;margin-top: 5px;">
                        <div style="margin-left: 3%;"> <?php echo ucfirst(int2str($total)); ?></div>
                    </div> -->
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;margin-top: -6px;">
                        <strong style="display: inline-block;">Conditions de règlement 
                            :</strong> <?php echo $condreg ?>
                            
                        <!--&nbsp;&nbsp;&nbsp;&nbsp; <p style="display: inline-block; margin-left: 10px;">30% Avance , 70% Contre Documents</p> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if ($userSignature): ?>
    <div style="margin-top: -80px;">
       
            <img src="<?= $this->Url->webroot('img/logosignature/' . $userSignature->filename); ?>" width="200px"
                height="80px" style="float: right; margin-top: 70px; margin-right: 20px;">
     
    </div>
    <?php endif; ?>
    <div class="footerr-text">
        <?php echo $this->Html->image('footer.png', ['width' => '700', 'height' => '85']); ?>
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
        left:-2px;
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
        0% { background-position: 0 0; }
        50% { background-position: 400% 0; }
        100% { background-position: 0 0; }
    }
    </style>
    <style>
        .footerr-text {
           /*  position: fixed; */
            bottom: 10px;
            left: 35px;
            width: 30px;
            text-align: left;
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
    function int2str($a)
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