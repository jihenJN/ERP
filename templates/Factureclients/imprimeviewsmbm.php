<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

?>


<?php
$connection = ConnectionManager::get('default');
?>
<?php $this->layout = 'AdminLTE.print'; ?>
<?php
function int2str($a)
{
    $joakim = explode('.', $a);

    if (isset($joakim[1]) && $joakim[1] != '') {
        if (($joakim[1] != '000')) {
            if ($joakim[0] == '0') {
                return  'zero Dinars et ' . ($joakim[1]) . ' Millimes';
            }
            return int2str($joakim[0]) . ' Dinars et ' . ($joakim[1]) . ' Millimes';
        } else {
            return int2str($joakim[0]) . ' Dinars et 0 Millimes';
        }
    }


    if ($a == 0) return '';
    if ($a < 0) return 'moins ' . int2str(-$a);
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
            if (((int)($a / 10) * 10) < 70) {
                return int2str((int)($a / 10) * 10) . '-et-un';
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
        return int2str((int)($a / 100)) . ' ' . int2str(100) . ' ' . int2str($a % 100);
    } else if ($a == 1000) {
        return 'mille';
    } else if ($a < 2000) {
        return int2str(1000) . ' ' . int2str($a % 1000) . ' ';
    } else if ($a < 1000000) {
        return int2str((int)($a / 1000)) . ' ' . int2str(1000) . ' ' . int2str($a % 1000);
    }
}
?>
<style>
    body {
        font-size: 10px;
    }

    table {
        font-size: 13px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>

<section class="content" style="font-family: 'Times New Roman', Times, serif;">
    <table style="border-width: 0px; border-color: #ffffff; width: 100%; border-collapse: collapse; margin-top:29%;" height="650px">
        <thead>

        </thead>

        <tbody>
            <?php foreach ($lignefactureclient as $lignecommande) :
                ///  debug( $lignecommande);
                $qte = $lignecommande->qte;
                $prix = $lignecommande->punht;
                $ml = $lignecommande->ml;
                $montant = $qte * $prix * $ml;
            ?>
                <tr class="tr">

                    <td align="left" style="border:1px solid #ffffff ;vertical-align:top;height:2% !important;">
                        <b style="text-align: left;font-weight: normal;">
                            <?php
                            if (isset($lignecommande->article)) {
                                echo  h($lignecommande->article->Dsignation);
                            }
                            ?>
                        </b>
                    </td>

                    <td style="border:1px solid #ffffff ;vertical-align:top;width:5%">
                        <b style="margin-left: 124% !important;font-weight: normal;">
                            <?php
                            $unite = [];
                            if (isset($lignecommande->article->unite_id) && ($lignecommande->article->unite_id != 0)) {
                                $unite = $connection->execute('SELECT * FROM unites where unites.id=' . $lignecommande->article->unite_id . ';')->fetchAll('assoc');
                                if ($unite[0]['name'] = 'Piéce') {
                                    echo 'P';
                                } else {
                                    echo ($unite[0]['name']);
                                }
                            } else echo ''; ?>
                        </b>
                    </td>
                    <td align="center" style="border:1px solid #ffffff ; vertical-align:top;width:15%">
                        <b style="font-weight: normal;">
                            <?= $this->Number->format($lignecommande->qte) ?>
                        </b>
                    </td>


                    <td align="center" style="border:1px solid #ffffff ; vertical-align:top;text-align:left;width:15%">
                        <b style="margin-left: 75% !important;font-weight: normal;">
                            <?php
                            // $this->Number->format($lignecommande->punht) 
                            echo number_format(abs($lignecommande->punht), 3, ',', ' '); ?>
                        </b>
                    </td>


                    <td align="center" style="border:1px solid #ffffff ;vertical-align:top;width:11%">
                        <b style="margin-left: 70% !important;font-weight: normal;">
                            <?= $this->Number->format($lignecommande->remise) . '%' ?>
                        </b>
                    </td>

                    <td align="center" style="border:1px solid #ffffff ;vertical-align:top;text-align:right;width:15%">
                        <b style="font-weight: normal;"> <?php // $this->Number->format($montant)  
                            echo number_format(abs($montant), 3, ',', ' '); ?></b>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr>
                <td style="border:1px solid  #ffffff;vertical-align:top;"></td>
                <td style="border:1px solid  #ffffff;vertical-align:top;"></td>
                <td style="border:1px solid  #ffffff;vertical-align:top;"></td>
                <td style="border:1px solid  #ffffff;vertical-align:top;"></td>
                <td style="border:1px solid  #ffffff;vertical-align:top;"></td>
                <td style="border:1px solid  #ffffff;vertical-align:top;"></td>
            </tr>
        </tbody>
    </table>
    <div style="display:flex" align="center">

        <div style="width: 58%;margin-right:10px; margin-top :-55px;" align="left">

            <table style="width: 100%;border-collapse: collapse;border-radius: 15px;margin-top:5%">
                <thead>
                </thead>
                <tbody>
                    <?php $lignestable = TableRegistry::getTableLocator()->get('Lignefactureclients');
                    $query = $lignestable->find();
                    $query->select([
                        'tva' => 'Lignefactureclients.tva',
                        'base' => $query->func()->sum('(qte*ml*punht - (qte*ml*punht)* (remise / 100) + (qte*ml*punht - (qte*ml*punht)* (remise / 100)) * ifnull(fodec,0) / 100)'),
                        'total' => $query->func()->sum('((qte*ml*punht - (qte*ml*punht)* (remise / 100) + (qte*ml*punht - (qte*ml*punht)* (remise / 100)) * ifnull(fodec,0) / 100)) * tva / 100')
                    ])
                        ->where(['Lignefactureclients.factureclient_id' => $factureclient->id])
                        ->group('Lignefactureclients.tva');

                    // Execute the query
                    $results = $query->toArray();
                    $fodquery = $lignestable->find();
                    $fodquery->select([
                        'fodec' => 'Lignefactureclients.fodec',
                        'base' => $query->func()->sum('qte*ml*punht - (qte*ml*punht)* (remise / 100)'),
                        'total' => $query->func()->sum('(qte*ml*punht - (qte*ml*punht)* (remise / 100)) *ifnull(fodec,0) / 100')
                    ])
                        ->where(['Lignefactureclients.factureclient_id' => $factureclient->id])
                        ->group('Lignefactureclients.fodec');

                    // Execute the query
                    $fodresults = $fodquery->toArray();
                    // print_r($results);
                    foreach ($results as $rrr) {
                        if ($rrr->tva != 0) {
                    ?>
                            <tr class="tr">
                                <td align="center" height="20px" style="border:1px solid #ffffff;">

                                </td>
                                <td align="center" style="border:1px solid #ffffff;">
                                    <b style="margin-left: 125% !important;font-weight: normal;">

                                        <?= $this->Number->format($rrr->tva) ?>
                                    </b>
                                </td>
                                <td align="center" style="border:1px solid #ffffff;">
                                    <b style="margin-left:65%;font-weight: normal;">
                                        <?php
                                        echo number_format(abs($rrr->base), 3, ',', ' '); ?>
                                    </b>
                                </td>
                                <td align="center" style="border:1px solid #ffffff;">
                                    <b style="margin-left:14%;font-weight: normal;">
                                        <?php // $this->Number->format($rrr->total)
                                        echo number_format(abs($rrr->total), 3, ',', ' '); ?>
                                    </b>
                                </td>
                                <td align="center" style="border:1px solid #ffffff;">

                                </td>
                            </tr>
                    <?php }
                    } ?>
                    <?php
                    foreach ($fodresults as $frrr) {
                        if ($frrr->fodec != 0) {
                    ?>
                            <tr class="tr">
                                <td align="center" height="20px" style="border:1px solid black;">
                                </td>
                                <td align="center" style="border:1px solid black;">
                                    <b style="margin-left: 100% !important;font-weight: normal;">

                                        <?php
                                        echo number_format(abs($frrr->base), 3, ',', ' '); ?>
                                    </b>
                                </td>
                                <td align="center" style="border:1px solid black;width: 20%;">
                                    <b style="font-weight: normal;">
                                        <?php
                                        echo number_format(abs($frrr->total), 3, ',', ' ');
                                        ?>
                                    </b>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>

        </div>

        <div style="width: 40%;border:1px solid #ffffff;" align="right">

            <table style="width: 40%;border-collapse: collapse;border-radius: 15px;">
                <thead>
                </thead>
                <tbody>

                    <tr>
                        <td>
                            <div style="margin-left: 6%;"><strong></strong></div>
                        </td>
                        <td align="right">
                            <div style="margin-left: 22% !important;margin-top:29px;font-weight: normal;"><?php // $this->Number->format($factureclient->totalttc) 
                                                                    echo number_format(abs($factureclient->totalttc), 3, ',', ' '); ?></div>
                        </td>
                    </tr>
                </tbody>

            </table>

        </div>

    </div>

    <div style="width: 60%; font-size: 14px!important;margin-top:-26px;font-weight: normal;" align="center">



        <?php echo int2str($factureclient->totalttc, 1, 1) ?>
    </div>
</section>