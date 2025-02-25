<?php $this->layout = 'AdminLTE.print'; ?>

<?php
function int2str($a)
{
    $joakim = explode('.', $a);

    if (isset($joakim[1]) && $joakim[1] != '') {
        if (($joakim[1] != '000')){
        return int2str($joakim[0]) . ' Dinars et ' . ($joakim[1]) . ' Millimes';
        }
        else{
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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Document sans titre</title>
    <style type="text/css">
        <?php
        if(($cheque['Compte']['Num_Compte']=='03 032 1620115004001 12')||($cheque['Compte']['Num_Compte']=='03 504 0630115004743 23')){
            $image='bna.jpg';
        }
        if(($cheque['Compte']['Num_Compte']=='01 020 0571100001680 88')||($cheque['Compte']['Num_Compte']=='24 010 0106332512301 27')){
           $image='atb-a4.jpg';
        }
        if($cheque['Compte']['Num_Compte']=='14 054 0541017000149 40'){
           $image='bh.jpg';
        }
        if($cheque['Compte']['Num_Compte']=='04 507 0294047001815 57'){
          $image='tijeri.jpg';
        }
        ?>
        body {
        //background: url('<?php //echo $this->webroot;?>cheque/<?php //echo $image;?>'),
            background-repeat: no-repeat,
            margin-left: 0px,
            margin-top: 0px,
            background-size: cover,
    
        }
        .Style1 {font-size: 16px}
        .Style2 {font-size: 16px}
        .Style4 {font-size: 16px}
        .Style3 {font-size: 16px}

.vertical-text {
  writing-mode: vertical-rl; /* or vertical-lr */
  text-orientation: mixed; /* or upright */
}
    </style></head>

<body>
<?php


// $pieces['Compte']['banque']="Biat";

    //if(($cheque['Compte']['name']=='03 032 1620115004001 12')||($cheque['Compte']['name']=='03 504 0630115004743 23')){ ?>
<br>
<table align="center" class="vertical-text"  style="width: 100px;height:676px;position: relative;top: 50px;" border="0" >
    <tr>
        <td style="width: 84px;height: 71px;"></td>
        <td style="width: 114px;height: 71px;"></td>
        <td style="width: 314px;"></td>
        <td id="montant" class="Style1" style="width: 164px;position: relative;top: -10px;left: 32px;"><?php if(!empty($pieces->montant)){echo '#'.$pieces->montant.'#' ;} ?></td>
    </tr>
    <tr>
        <td style=""></td>
        <td style=""></td>
        <td style="height: 1px;position: relative;top:-37px;left: 48px;" class="Style4" >_____________________________</td>
        <td></td>
    </tr>
    <tr >
        <td nowrap colspan="3" class="Style1" style="height: 10px;position: relative;top:-28px;left: 33px;"><?php if(!empty($pieces->montant)){ echo int2str($pieces->montant);} ?></td>
    </tr>
    <tr>
        <td style=""></td>
        <td colspan="3" class="Style1" style="height: 22px;position: relative;top:-25px;left: 90px;"><strong><?php echo $client->Raison_Sociale; ?></strong></td>
    </tr>
    <tr>
        <td style=""></td>
        <td style=""></td>
        <td style=""></td>
        <td></td>
    </tr>
    <tr>
        <td style=""></td>
        <td style=""></td>
        <td style="position: relative;top: -24px;left: 23px;" class="Style1">
            <table>

                <tr><td>Sfax&emsp;</td>
                    <td>&emsp;<?php  if(!empty($pieces->echance)  && $pieces->echance  !='1970-01-01') echo date("d/m/Y",strtotime(str_replace('-','/',$pieces->echance))); ?></td>
                </tr>

            </table>
        </td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

</body>

</html>
