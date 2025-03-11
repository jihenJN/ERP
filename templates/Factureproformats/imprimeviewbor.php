<?php $this->layout = 'AdminLTE.print'; ?>
<?php
function int2str($a)
{
    $joakim = explode('.', $a);
    if (isset($joakim[1]) && $joakim[1] != '') {
        return int2str($joakim[0]) . ' virgule ' . int2str($joakim[1]);
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
        font-size: 12px;
    }

    table {
        font-size: 12px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<div style="display:flex;margin-top:-18px;height:70px">
    <div style="margin-left:1%">
        <!-- <?php
        echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '70px', 'width' => '110px']); ?> -->
    </div>
    <div style="width: 40%;margin-left:2% ;text-align:center" align="center">
     
    </div>
    <div style="width: 50%;margin-left:8%" align="left">
       
    </div>
</div>
<div style="display:flex;margin-bottom:3px;" align="center">
    <div style="display:flex;width: 1000%;">
        <div style="width: 10000%;border:0px solid black;border-radius: 15px" align="left">
            <br>
            <b style="margin-left:1% ;"> Code: </b><?= h($commande->client->Code) ?> <br>
            <b style="margin-left:1% ;"> Matricule fiscale :</b><?= h($commande->client->Matricule_Fiscale) ?> <br>
            <b style="margin-left:1% ;"> Client : </b> <?php
                                                        if (isset($commande->client)) {
                                                            echo  h($commande->client->Raison_Sociale);
                                                        } ?><br>
            <b style="margin-left:1% ;"> Adresse :</b><?= h($commande->client->Adresse) ?> <br>
        </div>
    </div>
    <div style="display:flex ;width:1000%;margin-left:10%;">
        <div style="width: 10000%;border:0px solid black;border-radius: 15px" align="left">
            <br>
            <b style="margin-left:7% ;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Facture proformat N° : </b><?= h($commande->numero) ?> <br>
            <b style="margin-left:7% ;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Date : </b><?= $this->Time->format(
                                                        $commande->date,
                                                        'dd/MM/y'
                                                    ); ?> <br>
        </div>
    </div>
</div>
<div>
    <br><br>
    <div class="panel-body">
        <div>
            <table style="border:0px solid black;width: 100%;border-radius: 15px 15px 15px 15px;border-collapse: collapse;" height="520px">
               <thead>
                    <tr>
                        <td align="center" style="width: 10%;border:0px solid black;"><strong></strong></td>
                        <td align="center" style="width: 8%;border:0px solid black;"><strong></strong></td>
                        <td align="center" style="width: 30%;border:0px solid black;"><strong></strong></td>
                        <td align="center" style="width: 10%;border:0px solid black;"><strong></strong></td>
                        <td align="center" style="width: 8%;border:0px solid black;"><strong></strong></td>
                        <td align="center" style="width: 8%;border:0px solid black;"><strong></strong></td>
                        <td align="center" style="width: 8%;border:0px solid black;"><strong></strong></td>
                        <td align="center" style="width: 18%;border:0px solid black;"><strong> </strong></td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lignecommandes as $lignecommande) :   ?>
                        <tr class="tr">
                            <td align="left" style="border:0px solid black;vertical-align:top;height:2% !important;font-size:9px;">
                                <?= ($lignecommande->article->codeabarre) ?>&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                            <td align="right" style="border:0px solid black;vertical-align:top;">
                                <?= ($lignecommande->qte) ?>&nbsp;&nbsp;
                            </td>
                            <td align="left" style="border:0px solid black;vertical-align:top;">&nbsp;&nbsp;<?php
                                                                                                    if (isset($lignecommande->article)) {
                                                                                                        echo  h($lignecommande->article->Dsignation);
                                                                                                    }
                                                                                                    ?></td>
                            <td align="right" style="border:0px solid black;vertical-align:top;">
                                <?= $this->Number->format($lignecommande->prix) ?>&nbsp;&nbsp;
                            </td>
                            <td align="right" style="border:0px solid black;vertical-align:top;">
                                <?= ($lignecommande->tva) ?> %&nbsp;&nbsp;
                            </td>
                            <td align="right" style="border:0px solid black;vertical-align:top;">
                                <?= ($lignecommande->tpe) ?>&nbsp;&nbsp;
                            </td>
                            <td align="right" style="border:0px solid black;vertical-align:top;">
                                <?= ($lignecommande->article->remise) ?>&nbsp;&nbsp;
                            </td>
                            <td align="right" style="border:0px solid black;vertical-align:top;">
                                <?= ($lignecommande->montantht) ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td style="border:0px solid black;vertical-align:top;"></td>
                        <td style="border:0px solid black;vertical-align:top;"></td>
                        <td style="border:0px solid black;vertical-align:top;"></td>
                        <td style="border:0px solid black;vertical-align:top;"></td>
                        <td style="border:0px solid black;vertical-align:top;"></td>
                        <td style="border:0px solid black;vertical-align:top;"></td>
                        <td style="border:0px solid black;vertical-align:top;"></td>
                        <td style="border:0px solid black;vertical-align:top;"></td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div style="display:flex" align="center">
                <div style="width: 58%;margin-right:10px;" align="left">
                    <table style="width: 100%;border-collapse: collapse;border-radius: 15px;">
                        <thead>
                            <tr>
                               <th align="center" style="width: 55%;border:0px solid black;"><strong></strong></th>
                                <th align="center" style="width: 15%;border:0px solid black;"><strong></strong></th>
                                <th align="center" style="width: 15%;border:0px solid black;"><strong></strong></th>
                                <th align="center" style="width: 15%;border:0px solid black;"><strong></strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr">
                                <td align="center" height="60px" style="border:0px solid black;">

                                </td>
                                <td align="center" style="border:0px solid black;">
                                    <?= $this->Number->format($lignecommande->tva) ?>
                                </td>
                                <td align="center" style="border:0px solid black;">
                                </td>
                                <td align="center" style="border:0px solid black;width: 20%;">
                                    <?= $this->Number->format($commande->totaltva + $commande->tpe) ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="width: 40%;border:0px solid black;" align="left">
            <table style="border:0px solid black;width: 100%;" >
                <br>       <br>
                <tr>
                   
                    <td align="left"><b align="left" > Total Hors Taxes</td><td align="right"><b align="right"><?= ($commande->total) ?> </b>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>  <tr>
                    <td align="left"><b align="left" > Total Remise </td><td align="right"><b align="right"><?= ($commande->remise) ?> </b>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>  <tr>
                    <td align="left"><b align="left" > Total Fodec </td><td align="right"><b align="right"><?= ($commande->fodec) ?> </b>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>  <tr>
                    <td align="left"><b align="left" > Total TVA </td><td align="right"><b align="right"><?= ($commande->tva) ?> </b>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>  <tr>
                    <td align="left"><b align="left" > Total TPE </td><td align="right"><b align="right"><?= ($commande->tpe) ?> </b>&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>  
    
<!--                    <b align="left"  style="margin-right:3% ;"> Total Remise&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>&nbsp;&nbsp;&nbsp;<?= $this->Number->format($commande->totalremise) ?> <br>-->
<!--                    <b align="left"  style="margin-right:3% ;"> Total Fodec&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $this->Number->format($commande->totalfodec) ?> <br>
                    <b align="left" style="margin-right:3% ;"> Total TVA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;<?= $this->Number->format($commande->totaltva) ?> <br>
                    <b align="left" style="margin-right:3% ;"> Total TPE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $this->Number->format($commande->tpe) ?> <br>
                   -->
                
            </table>
                    </div>
            </div>
        </div>
    </div>
    <br>
    <div style="display:flex">
        <div style="width:3%;border:0px solid black;border-radius: 15px;height:110px">

        </div>
        <br>   <br>
        <div style="width: 53%;">
             <strong>ARRETE LE PRESENT BON DE COMMANDE A LA SOMME DE:</strong><br>
            <?php echo int2str($commande->totalttc, 1, 1) ?>
        </div>
        
        <div style="width: 47%;border:0px solid black;border-radius: 15px;height:30px" align="left">
             <br>   
                         <table style="border:0px solid black;width: 100%;" >
                            
                             <tr>
            <td align="right" style="font-size:15px;">
<!--                <b style="margin-left:10% ;">-->
                    <strong> <?= ($commande->totalttc) ?></strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td></tr>
             </table></div>
    </div>
    
<!--    <div style="width: 100%;border:0px solid black;border-radius: 15px;height:40px;">
        <br>

    </div>-->
</div>


