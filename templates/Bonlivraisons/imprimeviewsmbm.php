<?php

use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

$connection = ConnectionManager::get('default');


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


// Configuration de la mise en page
$this->layout = 'AdminLTE.print';

?>

<style>
    body {
        font-size: 10px;
    }

    table {
        font-size: 13px;
    }

    .page-break {
        page-break-before: always;
    }

    @media print {

        /* Masquer l'en-tête et le pied de page sur chaque page */
        .content {
            display: block !important;
            /* Afficher normalement */
            page-break-inside: avoid;
            /* Éviter les sauts de page à l'intérieur du contenu */
        }

        .page-break {
            page-break-before: always;
            /* Forcer un saut de page avant chaque section */
        }

        /* .table-container {
        max-height: 500px; 
        overflow-y: auto; 
         }*/
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>

<?php

$lignebonlivraisonsArray = $lignebonlivraisons->toArray();
// var_dump($lignebonlivraisonsArray);

$maxLinesPerPage = 12;
$totalLines = count($lignebonlivraisonsArray);

$totalPages = ceil($totalLines / $maxLinesPerPage);
$page = 0;
?>

<?php for ($page = 0; $page < $totalPages; $page++) : ?>
    <section class="content" style="font-family: 'Times New Roman', Times, serif;<?php echo $page > 0 ? ' page-break' : ''; ?>">
        <div style="display:flex;">
            <table cellpadding="0" cellspacing="0" style=" margin-top:10%; border: 0px solid #002E50;border-left:none;border-right:none;border-collapse: collapse; width: 100%; ">
                <td align="center" style="width: 40%;border: none;">
                </td>
                <td align="center" style="width: 25%;border: none;">
                    <b><?php echo 'BON DE LIVRAISON'; ?></b><br>
                    <b style="font-weight: normal;">
                        <?php echo 'N° : ' . '' . $bonlivraison->numero; ?>
                    </b><br>
                    <b style="font-weight: normal;">
                        <?php echo 'Date : ' . $this->Time->format($bonlivraison->date, 'dd/MM/y'); ?>
                    </b>
                </td>
                <td align="left" style="width: 35%;border: none;font-size: 15px;height:4% !important;">
                    <b style="font-size: 18px!important;  display: block; margin-bottom: 0.5em;">&nbsp;

                        <?php
                        if (isset($bonlivraison->client)) {

                            if ($bonlivraison->client_id == 12) {
                                $nom_prenom = h($bonlivraison->nomprenom);


                                if (str_word_count($nom_prenom) < 6) {
                                    $nom_prenom .= str_repeat('<br>', 2);
                                }

                                $raison_sociale = $nom_prenom;
                            } else {

                                $raison_sociale = h($bonlivraison->client->Raison_Sociale);

                                if (str_word_count($raison_sociale) < 6) {
                                    $raison_sociale .= str_repeat('<br>', 2);
                                }
                            }
                        } else {
                            $raison_sociale = '';
                        }
                        ?>
                        <?php echo $raison_sociale;   ?>
                    </b>
                    <b style="font-size: 16px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                        <?php
                        if (isset($bonlivraison->client)) {
                            if ($bonlivraison->client_id != 12) {
                                echo h($bonlivraison->client->Adresse);
                            } else {
                                echo h($bonlivraison->adressediv);
                            }
                        }
                        ?>
                    </b>
                    <b style="font-size: 16px!important; font-weight: normal; display: block; margin-bottom: 0.5em;">&nbsp;
                        <?php
                        if ($bonlivraison->client_id != 12) {
                            echo 'M.F : ';
                            if (!empty($bonlivraison->client)) {
                                echo h($bonlivraison->client->Matricule_Fiscale);
                            }
                        } else {
                            echo 'I.D : ';
                            if (!empty($bonlivraison->client)) {
                                echo h($bonlivraison->numeroidentite);
                            }
                        }
                        ?>

                    </b>
                </td>
            </table>
        </div>
        <div style="margin-top:-17%;">
            <table style="border-width: 0px; border-color: #ffffff; width: 100%; border-collapse: collapse; margin-top:28%;">
                <thead>
                    <!-- En-tête du tableau -->
                </thead>
                <tbody>
                    <?php
                    $start = $page * $maxLinesPerPage;
                    //  var_dump($page);
                    $end = min(($page + 1) * $maxLinesPerPage, $totalLines);
                    // var_dump($totalLines);
                    $pp = 0;
                    for ($i = $start; $i < $end; $i++) :
                        $pp++;
                        $lignecommande = $lignebonlivraisonsArray[$i];
                        $qte = $lignecommande->qte;
                        $prix = $lignecommande->punht;
                        $ml = $lignecommande->ml;
                        $montant = $qte * $prix * $ml;
                    ?>
                        <tr class="tr" height="25px">
                            <td align="left" style="border:1px solid #ffffff ;width:40%;vertical-align:top;">
                                <b style="font-weight: normal; text-align: left;">
                                    <?php
                                    if (isset($lignecommande->article)) {
                                        echo h($lignecommande->article->Dsignation);
                                    }
                                    ?>
                                </b>
                            </td>
                            <td style=" border:1px solid #ffffff ;vertical-align:top;width:5%">
                                <b style="margin-left: 88% !important;font-weight: normal;">
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
                            <td align="center" style="border:1px solid #ffffff ; vertical-align:top;width:15%;font-weight: normal;">
                                <b style="font-weight: normal;">
                                    <?= $this->Number->format($lignecommande->qte) ?>
                                </b>
                            </td>
                            <td align="center" style="border:1px solid #ffffff ; vertical-align:top;text-align:left;width:15%">
                                <b style="margin-left: 45% !important;font-weight: normal;">
                                    <?php echo number_format(abs($lignecommande->punht), 3, ',', ' '); ?>
                                </b>
                            </td>
                            <td align="center" style="vertical-align:top;width:9.5%;">
                                <b style="font-weight: normal;padding-right: 40% !important;">
                                    <?php
                                    if ($lignecommande->remise === 0 || empty($lignecommande->remise)) {
                                        echo '';
                                    } else {
                                        echo $this->Number->format($lignecommande->remise) . '%';
                                    }
                                    ?><?php  //= $this->Number->format($lignecommande->remise) . '%' 
                                        ?>
                                </b>
                            </td>
                            <td align="center" style="vertical-align:top;text-align:center;width:15%">
                                <b style="font-weight: normal;margin-left:20.5% !important;">
                                    <?php echo number_format(abs($montant), 3, ',', ' '); ?>
                                </b>
                            </td>
                        </tr>
                    <?php endfor;

                    if ($pp < $maxLinesPerPage) {
                        $rest = $maxLinesPerPage - $pp;
                        $h = 25 * $rest; ?>
                        <tr height="<?php echo $h ?>px">
                            <td align="left" style="height:<?php echo $h ?>px !important;border:1px solid #ffffff ;width:40%;vertical-align:top;">
                                <b style="font-weight: normal; text-align: left;">
                                    <?php  //echo 'tt';
                                    ?><?php //echo $h 
                                        ?>
                                </b>
                            </td>
                            <td height="<?php echo $h ?>px" style=" border:1px solid #ffffff ;vertical-align:top;width:5%">
                                <b style="margin-left: 124% !important;font-weight: normal;">

                                </b>
                            </td>
                            <td align="center" style="border:1px solid #ffffff ; vertical-align:top;width:15%;font-weight: normal;">
                                <b style="font-weight: normal;">
                                </b>
                            </td>
                            <td align="center" style="border:1px solid #ffffff ; vertical-align:top;text-align:left;width:15%">
                                <b style="margin-left: 75% !important;font-weight: normal;">
                                </b>
                            </td>
                            <td align="center" style="border:1px solid #ffffff ;vertical-align:top;width:11%;">
                                <b style="margin-left: 67% !important;font-weight: normal;">
                                </b>
                            </td>
                            <td align="center" style="border:1px solid #ffffff ;vertical-align:top;text-align:right;width:15%;">
                                <b style="font-weight: normal;">
                                </b>
                            </td>
                        </tr>
                    <?php   }  ?>


                </tbody>
            </table>

            <?php     //var_dump($page);
            //  echo $page .'=='. ($totalPages - 1) ;
            if ($page == ($totalPages - 1)) {

            ?>
                <table style="margin-top:900px">
                    <tr>
                        <td>
                            <div style="display:flex" align="center">

                                <div style="width:400px;margin-right:10px; margin-top :-35%;" align="left">

                                    <table style="width: 100%;border-collapse: collapse;border-radius: 15px;margin-top:5%">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <?php
                                            ?>
                                            <tr class="tr">
                                                <td align="center" nowrap height="20px" style="border:1px solid #ffffff;">
                                                    <?php echo  'Arrêté  le présent BL  à la somme de :'; ?>
                                                </td>
                                            </tr>
                                            <tr class="tr">

                                                <td align="center" height="20px" style="border:1px solid #ffffff;">
                                                    <?php echo int2str($bonlivraison->totalttc, 1, 1) ?>
                                                </td>

                                            </tr>
                                            <?php
                                            ?>

                                        </tbody>
                                    </table>

                                </div>

                                <div style="width: 300px;border:1px solid #ffffff;margin-top:-36%;" align="center">

                                    <table style="width: 80%;border-collapse: collapse;border-radius: 15px;" border="0">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: left; width: 50%; vertical-align: top;">
                                                    <br>
                                                    <?php if ($bonlivraison->totalremise = 0 || $bonlivraison->totalremise = '') { ?>
                                                        <b style=" width: 100px;margin-left:-10!important; line-height: 1.5;"><?php echo 'Rem Mt:'; ?><br></b>
                                                    <?php } ?>
                                                    <b style="width: 100px;margin-left:-10!important; line-height: 1.5;"><?php echo 'Total HT:'; ?><br></b>
                                                    <b style="width: 100px;margin-left:-10!important; line-height: 1.5;"><?php echo 'Total TVA:'; ?><br></b>
                                                    <b style="width: 100px;margin-left:-10!important; line-height: 1.5;"><?php //echo 'Timbre:'; 
                                                                                                                            ?><br></b>
                                                    <b><br></b>
                                                </td>
                                                <td style="text-align: left; width: 50%; vertical-align: top;">
                                                    <br>
                                                    <?php if ($bonlivraison->totalremise = 0 || $bonlivraison->totalremise = '') { ?>
                                                        <b style="display: inline-block; width: 130px; text-align: right; line-height: 1.5;">
                                                            <?php echo number_format(abs($bonlivraison->totalremise), 2, ',', ' '); ?><br>
                                                        </b>
                                                    <?php } ?>
                                                    <b style="display: inline-block; width: 130px; text-align: right; line-height: 1.5;">
                                                        <?php echo number_format(abs($bonlivraison->totalht), 3, ',', ' '); ?><br>
                                                    </b>
                                                    <b style="display: inline-block; width: 130px; text-align: right; line-height: 1.5;">
                                                        <?php echo number_format(abs($bonlivraison->totaltva), 3, ',', ' '); ?><br>
                                                    </b>
                                                    <b style="display: inline-block; width: 130px; text-align: right; line-height: 1.5;">
                                                        <?php echo '0.000' ?><br>
                                                    </b>
                                                    <b style="font-size: 16px!important; margin-top: -6.8px!important; font-weight: bold; display: inline-block; width: 130px; text-align: right;">

                                                        <br> <?php // $this->Number->format($bonlivraison->totalttc) 
                                                                echo number_format(abs($bonlivraison->totalttc), 3, ',', ' '); ?>
                                                    </b>
                                                    <br> <br>

                                                </td>
                                            </tr>

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </td>
                        <td>
                            <div style="display:flex" align="center">

                                <div style="width: 60%; margin-top :-20%;" align="left">

                                    <table style="width: 100%;border-collapse: collapse;border-radius: 15px;margin-top:5%">
                                        <thead>
                                        </thead>
                                        <tbody>

                                            <tr class="tr">

                                                <td align="center" height="20px" style="border:1px solid #ffffff;margin-left:1% !important;">
                                                    <b style="margin-left: -45%;font-weight: normal;">
                                                        <?php
                                                        if (isset($bonlivraison->transporteur)) {
                                                            if ($bonlivraison->transporteur == 3) {
                                                                echo  h($bonlivraison->nom);
                                                            } else {
                                                                echo  h($bonlivraison->transporteur->name);
                                                            }
                                                        } ?>
                                                    </b>
                                                </td>
                                                <td align="center" height="20px" style="border:1px solid #ffffff;">
                                                    <?php
                                                    if (isset($bonlivraison->commercial)) {
                                                        echo  h($bonlivraison->commercial->name);
                                                    } ?>
                                                </td>

                                            </tr>


                                        </tbody>
                                    </table>

                                </div>



                            </div>
                        </td>
                    </tr>
                </table>
            <?php }      ?>
        </div>
    </section>
<?php endfor; ?>