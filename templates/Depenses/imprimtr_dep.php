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
     
    </style></head>
<?php

$dd = explode(' ', $compte->rib);
$ab = $dd[0];
$ab1 = $dd[1];
$ab2 = $dd[2];
$ab3 = $dd[3];
?>
<body onLoad="a()">
<table width="659" border="0" background="" cellpadding="0" cellspacing="0" style="position:relative;top: 10px; left:65px; font-family:Arial, Helvetica, sans-serif; font-size:16px;">
    <tr>
        <td width="35" height="8">&nbsp;</td>
        <td width="52">&nbsp;</td>
        <td width="3">&nbsp;</td>
        <td width="66">&nbsp;</td>
        <td width="22">&nbsp;</td>
        <td width="1">&nbsp;</td>
        <td width="43">&nbsp;</td>
        <td width="22">&nbsp;</td>
        <td width="4">&nbsp;</td>
        <td width="47">&nbsp;</td>
        <td width="32">&nbsp;</td>
        <td width="32">&nbsp;</td>
        <td width="32">&nbsp;</td>
        <td width="1">&nbsp;</td>
        <td width="46">&nbsp;</td>
        <td width="22">&nbsp;</td>
        <td width="22">&nbsp;</td>
        <td width="22">&nbsp;</td>
        <td width="22">&nbsp;</td>
        <td width="51">&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4" rowspan="2" align="center" nowrap="nowrap" style=" position: relative; top: -10px; left:-20px "><?php
        if(!empty($depense->echeance) && $depense->echeance!='0000-00-00' && $depense->echeance!='1970-01-01')
            $echeance=$this->Time->format($depense->echeance,'dd/MM/y');
        else  $echeance='' ; echo $echeance; ?></td>
        <td>&nbsp;</td>
        <td colspan="3" style="position:relative;top: -20px;">Sfax</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td colspan="5" rowspan="2">&nbsp;</td>
        <td height="26">&nbsp;</td>
        <td colspan="3" valign="top" style=" position: relative; top: -13px; "><?php  echo date("d/m/Y"); ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

        <td  colspan="3"  valign="top" style=" position: relative; top: -12px; ; position: relative;  font-size:9px"><strong><?php  // echo $fournisseur['Fournisseur']['name'];?></td>
    </tr>
    <tr>
        <td colspan="" align="center" style=" position: relative; top: 5px;left: -12px;"><?php  echo $ab; ?></td>
        <td colspan="" align="center" style=" position: relative; top: 5px;left: 5px;"> <?php  echo $ab1; ?></td>
        <td colspan="7" align="center" style=" position: relative; top: 5px;left: 15px;"><?php   echo $ab2; ?></td>
        <td colspan="" align="left" style=" position: relative; top: 5px;left: 25px;"><?php  echo $ab3; ?></td>
        <td colspan="5" rowspan="2" align="center" valign="middle" style=" position: relative; top: -10px; padding-left:25px"> # <?php  if(!empty($depense->montant)){ echo sprintf("%01.3f",$depense->montant);}?> # </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>

        <td colspan="11" rowspan="2" align="center" valign="bottom" style=" position: relative; top: 8px; font-size:14px"><strong><?php   echo $fournisseur->name;?></strong></td>
        <td>&nbsp;</td>
        <td colspan="5" rowspan="2" align="center" valign="middle" style=" position: relative; top: 15px; padding-left:25px"># <?php  if(!empty($depense->montant)){echo sprintf("%01.3f",$depense->montant);}?> # </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    <td colspan="20" align="center" style="font-size:16px">
    <script src="<?= $this->Url->assetUrl('js/script_money.js') ?>"></script>

            <script>var ddl= ConvNumberLetter('<?php   echo sprintf("%01.3f",$depense->montant);?>', 1, 0);
                var maj = ddl.substring( 0,1);
                var maju = maj.toUpperCase();
                var mini = ddl.substring( 1,ddl.length);
                var dd = maju+mini;
                //alert(dd);

                function a(){
//alert("aa");
                    document.getElementById('textfield').value=dd;
                }
            </script>
            
      
        <form style=" position: relative;top: 18px;" >

<?php

//echo "rr".$depense['Piecereglementfournisseur']['echeance'];

$montant=sprintf("%01.3f",$depense->montant);
if(!empty($depense->echeance) && $depense->echeance!='0000-00-00' && $depense->echeance!='1970-01-01') {
    $echeaance = $this->Time->format($depense->echeance,'dd/MM/y');
}else  $echeaance='';
//echo "rr".$depense['Piecereglementfournisseur']['echeance'];

//echo $devis1."aa";
$v= int2str($montant);?>
<strong><?php  if(!empty($montant)){echo $v;} ?></strong>
</form>
        
        </td>
    </tr>
    <tr>
        <td colspan="3" rowspan="2" nowrap="nowrap" style=" position: relative; left: -35px;top: 30px;"><div align="center"><?php   echo   "Sfax";;?></div></td>
        <td colspan="3" rowspan="2" align="left" style=" position: relative; left: 5px;top: 30px;"></td>
        <td colspan="4" rowspan="2" align="left" style=" position: relative; left: 5px;top: 30px;"><?php  echo $echeaance; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="6" rowspan="4" align="left" style=" position: relative; top: 24px;left: 12px;font-size:12px "><?php echo  $banque->name ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td height="36" colspan="" align="center" valign="top" style=" position: relative; top: 32px;left: -22px;"><?php  echo $ab; ?></td>
        <td height="36" colspan="" align="center" valign="top" style=" position: relative; top: 32px;left:-20px;"><?php  echo $ab1; ?></td>
        <td height="36" colspan="5" align="center" nowrap="nowrap" valign="top" style=" position: relative; top:32px;left:-10px;"><?php  echo $ab2; ?></td>
        <td height="36" colspan="" align="center" valign="top" style=" position: relative; top: 32px;left:0px;"><?php  echo $ab3; ?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="6" rowspan="4" align="center" style=" position: relative; top: 24px;left: 22px;font-size:12px "> </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="5" rowspan="3"><div align="center"  style=" position: relative; top: 18px; font-size:12px">
                <p  ><?php   echo   $societe->nom ;?></p>
                <p  ><?php   //echo   $societe['Societe']['adresse'];;?><br>  </p>
            </div></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>
</body>
</html>
