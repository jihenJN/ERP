<?php

use Cake\I18n\FrozenTime;
use Cake\Datasource\ConnectionManager;

?>
<?php $this->layout = 'AdminLTE.printt'; ?>
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
<!-- <?php //debug($commandeclient->client); 
        ?> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="position: relative; top: -18px;">
    <!-- Bande noire continue -->
    <div style="background-color: black; height: 40px;"></div>

    <!-- Image au-dessus de la bande noire -->
    <div style="position: absolute; top: 10px; left: 10%; transform: translateX(-50%); z-index: 1;">
        <?php echo $this->Html->image('logoggb.png', ['alt' => 'CakePHP', 'height' => '125px', 'width' => '140px']); ?>
    </div>
</div>
<div style="width: 87%;height: 20px;margin-left:10%;margin-right:5%;margin-top: -10px;">
    <div style=" display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.5em; ">
        <strong>Proposition commerciale
        </strong><br>
    </div>
    <div style="display: flex; position: relative; justify-content: flex-end; color: #103458; font-size: 1.5em;">
        <strong>Réf. :</strong>
        (<strong><?= h($commandeclient->code) ?></strong>)
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
        <?= h($commandeclient->client->codeclient) ?>
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
    <div class="boxblanc" style="width: 62%;height: 150px;margin-left:1%;margin-right:3%;font-size: 13px;margin-top:-0.5%;">
        <div style="margin-top:1%; margin-left:1%">
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
<div class="boxbordergris" style="width: 96%; height: 20px; margin-left: 1%; margin-right: 5%;margin-top: 10px;">
    <div style="font-size: 12px;">
        Incoterm :
        <span style="color: red; font-weight: bold;">
            <?= h($commandeclient->incoterm->code); ?>-
            <?= h($commandeclient->client->port); ?>
        </span>
    </div>
</div>
<!-- <?php debug($commandeclient->devise->name); ?> -->
<div style="width: 87%;height: 20px;margin-left:1%;margin-right:5%;font-size: 12px;margin-top: 7px;">
    Montants exprimés en
    <?php if ($commandeclient->devis_id) { ?>
        <?= h($commandeclient->devise->name) ?>
    <?php } ?>
</div>

<div class="box" style="width: 96%;height :600px; margin-left:0%;margin-right:5%;margin-top: -8px;">
    <div class="panel-body">
        <div class="table-responsive ls-table">
            <table height="430px" style="width: 100%;">
                <thead>
                    <tr height="7px">
                        <td align="center" class="solid-border" style="width: 10%;border:1px solid gray;">
                            Référence
                        </td>
                        <td align="center" class="solid-border" style="width: 40%;border:1px solid gray;">
                            Désignation
                        </td>
                        <td align="center" class="solid-border" style="width: 10%;border:1px solid gray;">
                            P.U.H.T
                        </td>
                        <td align="center" class="solid-border" style="width: 9%;border:1px solid gray;">
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
                    <?php
                    // debug($lignecommandeclients);

                    foreach ($lignecommandeclients as $lignecommandeclient) :
                        $connection = ConnectionManager::get('default');
                        $articl = $connection->execute('SELECT * FROM articles where articles.id =' . $lignecommandeclient['article_id'])->fetchAll('assoc');
                        // debug($articl);      
                    ?>
                        <?php

                        $unite = $articl[0]['unite_id'];
                        if ($unite) {
                            // debug($unite);
                            $unitename = $connection->execute('SELECT * FROM unites where unites.id =' . $unite)->fetchAll('assoc');
                        } ?>
                        <tr class="tr">
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>" style="vertical-align:top;height: 1px;">
                                <?php echo h($articl[0]['Refggb']); ?>
                            </td>
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>" style="vertical-align:top;">
                                <?php echo h($articl[0]['Dsignation']); ?>
                            </td>

                            <?php if ($commandeclient->devise->name === 'Dollars US') : ?>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>" style="vertical-align:top;">
                                    <?= $this->Number->format($lignecommandeclient['prixht']) ?> $
                                </td>
                            <?php elseif ($commandeclient->devise->name === 'Euro') : ?>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>" style="vertical-align:top;">
                                    <?= $this->Number->format($lignecommandeclient['prixht']) ?> €
                                </td>
                            <?php else : ?>
                                <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>" style="vertical-align:top;">
                                    <?= $this->Number->format($lignecommandeclient['prixht']) ?>
                                </td>
                            <?php endif; ?>
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>" style="vertical-align:top;">
                                <div style="margin-left: 25% ;">
                                    <?=
                                    $qte = $lignecommandeclient['qte'];
                                    $TotalHT = $lignecommandeclient['prixht'] * $qte;
                                    $this->Number->format($lignecommandeclient->qte) ?>
                                </div>
                            </td>


                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>" style="vertical-align:top;">
                                <?php
                                if ($unitename) {
                                    echo h($unitename[0]['name']);
                                } ?>
                            </td>
                            <!-- <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>"
                                style="vertical-align:top;">
                                <?php if ($commandeclient->devise->name === 'Dollars US') : ?>
                                    <?= $this->Number->format($TotalHT) ?>$
                                <?php elseif ($commandeclient->devise->name === 'Euro') : ?>
                                    <?= $this->Number->format($TotalHT) ?>€
                                <?php else : ?>
                                    <?= $this->Number->format($TotalHT) ?>
                                <?php endif; ?>
                            </td> -->
                            <td align="center" class="<?= ($index === 0) ? 'solid-border' : 'dotted-border' ?>" style="vertical-align:top;">
                                <?php
                                $totalht = $lignecommandeclient['ttc'];
                                if ($commandeclient->devise->name === 'Dollars US') : ?>
                                    <?= $this->Number->format($totalht) ?>$
                                <?php elseif ($commandeclient->devise->name === 'Euro') : ?>
                                    <?= $this->Number->format($totalht) ?>€
                                <?php else : ?>
                                    <?= $this->Number->format($totalht) ?>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border:1px solid gray;vertical-align:top;"></td>
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
            $projet = $connection->execute("SELECT banque_id FROM projets WHERE id = '" . $projet_id . "'")->fetchAll('assoc');
            $banque = $connection->execute("SELECT name FROM banques WHERE id = '" . $projet[0]['banque_id'] . "'")->fetchAll('assoc');
            $banq = $banque[0]['name'];
            ?>

            <div style="display: flex; justify-content: space-between;margin-top: -14px;margin-left: -1.5%;">
                <div style="width: 65%;">
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 12px;">
                        <strong>Arrêter la présente Proposition commerciale à la somme de :</strong>
                    </div>

                    <div class="boxbordergray" style="height: 30px; margin-left: 3%; margin-right: 5%;font-size: 12px;margin-top: 5px;">
                        <div style="margin-left: 3%;"> <?php echo ucfirst(int2str($totalttc)); ?></div>
                    </div>

                    <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;margin-top: -6px;">
                        <strong style="display: inline-block;">Conditions de règlement
                            :</strong>&nbsp;&nbsp;&nbsp;&nbsp;
                        <p style="display: inline-block; margin-left: 10px;">Virement Anticipé</p>
                    </div>
                    <!-- <div style="margin-left: 3%; margin-right: 5%;">
                        <strong style="display: inline-block;">Mode de Transport :</strong>
                        <p style="display: inline-block; margin-left: 10px;">TOTAL TRANSPORT</p>
                    </div> -->
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 11px;">
                        <strong>Délai de livraison :</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <p style="display: inline-block; margin-left: 10px;">A CONVENIR</p>
                    </div>
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 10px;">
                        <strong>Règlement par virement sur le compte bancaire suivant :</strong>
                    </div>
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 10px;margin-top: -6px;">
                        <strong>Code IBAN :</strong>
                        <p style="display: inline-block; margin-left: 10px; margin-bottom: 0;"><strong>TN59 0704 0005
                                8141 0429
                                5479</strong></p>
                    </div><br>
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 10px;margin-top: -18px;">
                        <strong>Code BIC/SWIFT:</strong>
                        <p style="display: inline-block; margin-left: 10px; margin-bottom: 0;">
                            <strong>CFCTTNTTXXX</strong>
                        </p>
                    </div><br>
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 10px;margin-top: -20px;">
                        <strong>Banque:</strong>
                        <p style="display: inline-block; margin-left: 10px; margin-bottom: 0;"><strong>
                                <?php echo $banq ?>
                            </strong></p>
                    </div><br>
                    <div style="margin-left: 3%; margin-right: 5%;font-size: 10px;margin-top: -10px;">
                        <strong>Nom du propriétaire du compte: GENIUS GLOBAL
                            BUSINESS</strong>
                    </div><br>
                    <!-- <div style="margin-left: 3%; margin-right: 5%;font-size: 10px;margin-top: -6px;">
                        <strong>Code IBAN :</strong>
                        <p style="display: inline-block; margin-left: 10px; margin-bottom: 0;"><strong>TN59 0704 0005
                                8141 0429
                                5479</strong></p>
                        <br>
                        <strong>Code BIC/SWIFT:</strong>
                        <p style="display: inline-block; margin-left: 10px; margin-bottom: 0;">
                            <strong>CFCTTNTTXXX</strong>
                        </p><br>
                        <strong>Banque:</strong>
                        <p style="display: inline-block; margin-left: 10px; margin-bottom: 0;"><strong>
                                <?php echo $banq ?>
                            </strong></p><br>
                        <strong>Nom du propriétaire du compte: GENIUS GLOBAL
                            BUSINESS</strong>
                    </div> -->
                </div>
                <div style="width: 50%;">


                    <div style="display: flex; justify-content: space-between;">
                        <div style="margin-left: 60px;">
                            <strong>Total 
                            <?php 
                              $connection = ConnectionManager::get('default');
                              if ($commandeclient['incotermpdf_id']) {
                                # code...
                             
                               $incotermpdf = $connection->execute("SELECT code FROM incoterms  WHERE id='".$commandeclient['incotermpdf_id']."' ;")->fetchAll('assoc');
                            
                            echo $incotermpdf[0]['code'] ;} ?> :</strong>
                        </div>
                        <div>
                            <?php echo sprintf("%01.3f", str_replace(",", ".", $commandeclient->totalttc)); ?>
                            <?php if ($commandeclient->devis_id) {
                                echo $commandeclient->devise->code;
                            } ?>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between;">

                        <div style="margin-left: 60px;">
                            <strong>Total Transport:
                        </div>
                        <div>
                            <?php echo sprintf("%01.3f", str_replace(",", ".", $commandeclient->total_transport)); ?>
                            <?php if ($commandeclient->devis_id) {
                                echo $commandeclient->devise->code;
                            } ?>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between;">

                        <div style="margin-left: 60px;">
                            <?php
                            echo $commandeclient->remarque;
                            ?> </div>

                    </div>
                    <div style="display: flex; justify-content: space-between;">


                        <div style="margin-left: 60px;">
                            <strong>Total :
                                <?php echo $commandeclient->incoterm->code ?>-<?php echo $commandeclient->client->port ?></strong>
                        </div>
                        <div>
                            <?php echo sprintf("%01.3f", str_replace(",", ".", $commandeclient->totalttc + $commandeclient->total_transport)); ?>
                            <?php if ($commandeclient->devis_id) {
                                echo $commandeclient->devise->code;
                            } ?>
                        </div>
                    </div>
                    <!-- <div style="display: flex; justify-content: space-between;">
                        <div style="margin-left: 60px;"><strong>Remise :</strong></div>
                        <div>
                            <?php echo sprintf("%01.3f", str_replace(",", ".", $commandeclient->totalremise)); ?>

                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <div style="margin-left: 60px;"><strong>Total Transport:</strong></div>
                        <div><?php echo $commandeclient->total_transport; ?></div>
                    </div>
                    <div style="display: flex; justify-content: space-between;">
                        <div style="margin-left: 60px;"><strong>Total :
                                <?php echo $commandeclient->incoterm->code; ?>
                            </strong></div>
                        <div>
                            <?php echo sprintf("%01.3f", str_replace(",", ".", $totalttc)); ?>
                        </div>
                    </div> -->
                </div>

            </div>
        </div>
    </div>
    <div style=" margin-top: -70px; " >
        <?php if ($userSignature) : ?>
            <img src="<?= $this->Url->webroot('img/logosignature/' . $userSignature->filename); ?>" width="200px" height="80px" style="float: right; margin-top: -6px; margin-right: 20px;">
        <?php endif; ?>
    </div>
    <div class="footerr-text" >
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
        .footerr-text {
            position: fixed; 
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