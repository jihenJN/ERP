<?php $this->layout = 'AdminLTE.print'; ?>

<?php
function chifre_en_lettre($montant, $devise1, $devise2)
{
    if(($devise1==1)) $dev1='Dinars';
    if(($devise1==2)) $dev1='dolars';
    if(($devise1==3)) $dev1='euro';
    if(($devise1==1)) $dev2='Millimes';
    if(($devise1==2)) $dev2='Cents';
    if(($devise1==3)) $dev2='Centiems';
    $valeur_entiere=intval($montant);
    $valeur_decimal=(($montant-intval($montant))*1000);
    $dix_c=($valeur_decimal%100/10);
    $cent_c=intval($valeur_decimal%1000/100);
    $unite_c=$valeur_decimal%10;
    $unite[1]=$valeur_entiere%10;
    $dix[1]=intval($valeur_entiere%100/10);
    $cent[1]=intval($valeur_entiere%1000/100);
    $unite[2]=intval($valeur_entiere%10000/1000);
    $dix[2]=intval($valeur_entiere%100000/10000);
    $cent[2]=intval($valeur_entiere%1000000/100000);
    $unite[3]=intval($valeur_entiere%10000000/1000000);
    $dix[3]=intval($valeur_entiere%100000000/10000000);
    $cent[3]=intval($valeur_entiere%1000000000/100000000);
    //echo $unite_c;
    $chif=array('', 'Un', 'Deux', 'Trois', 'Quatre', 'Cinq', 'Six', 'Sept', 'Huit', 'Neuf', 'Dix', 'Onze', 'Douze', 'Treize', 'quatorze', 'Quinze', 'Seize', 'Dix sept', 'Dix huit', 'Dix neuf');
    $secon_c='';
    $trio_c='';
    for($i=1; $i<=3; $i++){
        $prim[$i]='';
        $secon[$i]='';
        $trio[$i]='';
        if($dix[$i]==0){
            $secon[$i]='';
            $prim[$i]=$chif[$unite[$i]];
        }
        else if($dix[$i]==1){
            $secon[$i]='';
            $prim[$i]=$chif[($unite[$i]+10)];
        }
        else if($dix[$i]==2){
            if($unite[$i]==1){
                $secon[$i]='Vingt et';
                $prim[$i]=$chif[$unite[$i]];
            }
            else {
                $secon[$i]='Vingt';
                $prim[$i]=$chif[$unite[$i]];
            }
        }
        else if($dix[$i]==3){
            if($unite[$i]==1){
                $secon[$i]='Trente et';
                $prim[$i]=$chif[$unite[$i]];
            }
            else {
                $secon[$i]='Trente';
                $prim[$i]=$chif[$unite[$i]];
            }
        }
        else if($dix[$i]==4){
            if($unite[$i]==1){
                $secon[$i]='Quarante et';
                $prim[$i]=$chif[$unite[$i]];
            }
            else {
                $secon[$i]='Quarante';
                $prim[$i]=$chif[$unite[$i]];
            }
        }
        else if($dix[$i]==5){
            if($unite[$i]==1){
                $secon[$i]='Cinquante et';
                $prim[$i]=$chif[$unite[$i]];
            }
            else {
                $secon[$i]='Cinquante';
                $prim[$i]=$chif[$unite[$i]];
            }
        }
        else if($dix[$i]==6){
            if($unite[$i]==1){
                $secon[$i]='Soixante et';
                $prim[$i]=$chif[$unite[$i]];
            }
            else {
                $secon[$i]='Soixante';
                $prim[$i]=$chif[$unite[$i]];
            }
        }
        else if($dix[$i]==7){
            if($unite[$i]==1){
                $secon[$i]='Soixante et';
                $prim[$i]=$chif[$unite[$i]+10];
            }
            else {
                $secon[$i]='Soixante';
                $prim[$i]=$chif[$unite[$i]+10];
            }
        }
        else if($dix[$i]==8){
            if($unite[$i]==1){
                $secon[$i]='Quatre-Vingts et';
                $prim[$i]=$chif[$unite[$i]];
            }
            else {
                $secon[$i]='Quatre-Vingt';
                $prim[$i]=$chif[$unite[$i]];
            }
        }
        else if($dix[$i]==9){
            if($unite[$i]==1){
                $secon[$i]='Quatre-Vingts et';
                $prim[$i]=$chif[$unite[$i]+10];
            }
            else {
                $secon[$i]='Quatre-Vingts';
                $prim[$i]=$chif[$unite[$i]+10];
            }
        }
        if($cent[$i]==1) $trio[$i]='Cent';
        else if($cent[$i]!=0 || $cent[$i]!='') $trio[$i]=$chif[$cent[$i]] .' cents';
    }
    $v="";

    $chif2=array('', 'Dix', 'Vingt', 'Trente', 'Quarante', 'Cinquante', 'Soixante', 'Soixante-Dix', 'Quatre-Vingts', 'Quatre-Vingts Dix');
    $secon_c=$chif2[$dix_c];
    if($cent_c==1) $trio_c='cent';
    else if($cent_c!=0 || $cent_c!='') $trio_c=$chif[$cent_c] .' Cents';

    if(($cent[3]==0 || $cent[3]=='') && ($dix[3]==0 || $dix[3]=='') && ($unite[3]==1))
        $v=$v.' '. $trio[3]. '  ' .$secon[3]. ' ' . $prim[3]. ' Million ';
    else if(($cent[3]!=0 && $cent[3]!='') || ($dix[3]!=0 && $dix[3]!='') || ($unite[3]!=0 && $unite[3]!=''))
        $$v=$v.' '. $trio[3]. ' ' .$secon[3]. ' ' . $prim[3]. ' Millions ';
    else
        $v=$v.' '. $trio[3]. ' ' .$secon[3]. ' ' . $prim[3];

    if(($cent[2]==0 || $cent[2]=='') && ($dix[2]==0 || $dix[2]=='') && ($unite[2]==1))
        $v=$v.' '. ' Mille ';
    else if(($cent[2]!=0 && $cent[2]!='') || ($dix[2]!=0 && $dix[2]!='') || ($unite[2]!=0 && $unite[2]!=''))
        $v=$v.' '. $trio[2]. ' ' .$secon[2]. ' ' . $prim[2]. ' Milles ';
    else
        $v=$v.' '. $trio[2]. ' ' .$secon[2]. ' ' . $prim[2];

    $v=$v. $trio[1]. ' ' .$secon[1]. ' ' . $prim[1];

    $v=$v. ' '. $dev1 .' ' ;

    if(($cent_c=='0' || $cent_c=='') && ($dix_c=='0' || $dix_c==''))
        $v=$v.' '. ' et Z&eacute;ro '. $dev2;
    else
        $v=$v.' et '.round( $valeur_decimal,0). ' ' . $dev2;
    return $v;
}
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
    
        body {
        //background: url('<?php //echo $this->webroot;?>cheque/<?php //echo $image;?>'),
            background-repeat: no-repeat,
            margin-left: -150px,
            margin-top: 50px,
            background-size: cover,
    
        }
        .Style1 {font-size: 18px}
        .Style2 {font-size: 16px}
        .Style4 {font-size: 18px}
        .Style3 {font-size: 16px}

.vertical-text {
  writing-mode: vertical-lr; /* or vertical-lr */
  text-orientation: mixed; /* or upright */
}
    </style></head>

<body> <!---->
<?php


// $pieces['Compte']['banque']="Biat";

    //if(($cheque['Compte']['name']=='03 032 1620115004001 12')||($cheque['Compte']['name']=='03 504 0630115004743 23')){ ?>
       <table  style="height:661px;width:302px;left:170px;top:272px; "  border="0" >
        <tr>
            <td  ></td>
            <td   ></td>
            <td  ></td>
            <td id="montant" valign="bottom" class="Style1" style="width: 164px;position: relative;top: 190px; left:150px "><?php if(!empty($pieces->montant)){echo '#'.$pieces->montant.'#' ;} ?></td>
        </tr>
        <tr>
            <td style=""></td>
            <td style=""></td>
            <td style="position: relative;top:90px;left: 48px;" class="Style4" ><?php if(!empty($pieces->montant)){ echo chifre_en_lettre($pieces->montant,1,1);} ?></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="3" class="Style1" style="position: relative;top:102px;left: 17px;"></td>
        </tr>
        <tr>
            <td style=""> </td>
            <td colspan="3" class="Style1" style=" position: relative;top:10px;left: 50px;"><strong><?php echo $fournisseur->name; ?></strong></td>
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
            <td style="position: relative;top: 60px;left: 17px;" class="Style1">
                <table>

                    <tr><td>&nbsp;&nbsp;&nbsp;&nbsp;Sfax:&nbsp;&nbsp; </td>
                        <td>&nbsp;&nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo date("d/m/Y",strtotime(str_replace('-','/',$pieces->echance))); ?></td>
                    </tr>

                </table>
            </td>
            <td></td>
        </tr>
        <tr>
            <td> </td>
            <td></td>
            <td></td>
        </tr>
    </table>

</body>

</html>
