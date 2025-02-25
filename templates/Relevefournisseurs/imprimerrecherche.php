<?php $this->layout = 'AdminLTE.print'; ?>
<style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style>

<!-- <div style="display: flex; justify-content: space-between; align-items: flex-start; border-top: 2px solid black; border-bottom: 2px solid black; padding: 2px 0;">

    <table border="0" cellpadding="0" cellspacing="0" style="border: 0px solid black; width: 100%; ">


        <td align="center" style="width: 25%;border:0;">
            <div>
                <?php
                echo $this->Html->image('imgrose.jpg', ['alt' => 'CakePHP', 'height' => '90px', 'width' => '70%']); ?>
            </div>
        </td>
        <td align="center" style="width: 50%;border:0;"><strong>
              
        </td>
        <td align="center" style="width: 25%;border:0;">
            <div>
                <?php
                // echo $this->Html->image('LOGOISO2023.JPG', ['alt' => 'CakePHP', 'height' => '80px', 'width' => '70%']); 
                ?>
            </div>
        </td>


    </table>
</div> -->
<br>
<br><br>
<h2 style="margin-left: 5px ;">
    Releve Fournisseur
</h2>
&nbsp;
<br> &nbsp;
<table border="1" align="center" cellpadding="2" cellspacing="0" width="100%" class="table">

    <tr bgcolor="#EAEAEA" align="center">
        <th width="10%" align="center"><strong>Date</strong></th>
        <th width="60%" align="center" colspan="2"><strong>Libellé Piece</strong></th>
        <th width="10%" align="center"><strong>Dédit</strong></th>
        <th width="10%" align="center"><strong>Crédit</strong></th>
        <th width="10%" align="center"><strong>Solde</strong></th>
    </tr>


    <?php


    if ($relefescount != 0) {


        $totdebit = 0;
        $totcredit = 0;
        $totimpayer = 0;
        $totreg = 0;
        $totavoir = 0;
        $totsolde = 0;
        $totdebitt = 0;
        $totcreditt = 0;
        $totimpayert = 0;
        $totregt = 0;
        $totavoirt = 0;
        $totsoldet = 0;
        $clt_id = 0;
        //debug($relefes);
        $hh = 0;
        $c = 0;
        $t = 0;
        foreach ($relefes as $i => $relefe) {

            $totdebitt = $totdebitt + @$relefe['debit'];
            $totcreditt = $totcreditt + @$relefe['credit'];
            $totimpayert = $totimpayert + @$relefe['impaye'];
            $totregt = $totregt + @$relefe['reglement'];
            $totavoirt = $totavoirt + @$relefe['avoir'];
            $totsoldet = $totsoldet + @$relefe['solde'];


            if ($relefe['fournisseur_id'] != $clt_id) {

                if ($i != 0) {

    ?>
                    <tr>
                        <td width="70%" colspan="3" bgcolor="#EAEAEA" align="center"><strong> Total </strong></td>
                        <td width="10%" align="right"><strong> <?= number_format(@$totdebit, 3, '.', ' ') ?></strong></td>
                        <td width="10%" align="right"><strong><?= number_format(@$totcredit, 3, '.', ' ') ?></strong></td>
                        <td width="10%" align="right"><strong><?= number_format(@$totsolde, 3, '.', ' ') ?></strong></td>
                    </tr>
                <?php

                    $totdebit = 0;
                    $totcredit = 0;
                    $totimpayer = 0;
                    $totreg = 0;
                    $totavoir = 0;
                    $totsolde = 0;
                }
                $soldedeb=0;
                $soldecred=0;
                $sld=$soldeint;$soldecredd=0;
                $soldedebb=0;
                if($soldeint>0){
                 $soldedeb=$soldeint;  
                 $soldedebb= $soldeint;
                }
                if($soldeint<0){
                 $soldecredd=$soldeint;   
                 $soldecred=$soldeint*(-1);   
                }
                ?>
                <tr>
                    <td bgcolor="#EAEAEA" align="center"><strong> Fournisseur </strong></td>
                    <td colspan="8"><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$relefe['fournisseur']['code'] . '  ' . @$relefe['fournisseur']['name'] ?></strong></td>
                </tr>
                <tr>
                    <td bgcolor="#EAEAEA" width="70%" align="center" colspan="3"><strong> Solde départ </strong></td>
                    <!-- <td width="10%" nobr="nobr" align="right"><?php echo number_format(@$relefe['fournisseur']['soldedebut'], 3, '.', ' ') ?></td>
                    <td width="10%" nobr="nobr" align="right"><?php echo number_format(@$relefe['fournisseur']['Montant_Regler'], 3, '.', ' ') ?></td>

                    <td width="10%" nobr="nobr" align="right"><?php echo number_format(@$relefe['fournisseur']['soldedebut'] - @$relefe['fournisseur']['Montant_Regler'], 3, '.', ' ') ?></td>
                     -->
                    <td width="10%" nobr="nobr" align="right"><?php echo number_format(@$soldedeb, 3, '.', ' ') ?></td>
                    <td width="10%" nobr="nobr" align="right"><?php echo number_format(@$soldecred, 3, '.', ' ') ?></td>

                    <td width="10%" nobr="nobr" align="right"><?php echo number_format(@$soldeint, 3, '.', ' ') ?></td> 
                </tr>

            <?php

            }
            $clt_id = $relefe['fournisseur_id'];
            if ($relefe['debit'] != null) {
                // debug("debit");die;
                $sld = abs($sld) + $relefe['debit'] ; //+  $relefe['fournisseur']['soldedebut'];
            } else {
                // debug("credit");die;
                $sld = abs($sld) - $relefe['credit'] ; ///- $relefe['fournisseur']['Montant_Regler']; //-  (abs($relefe['fournisseur']['soldedebut']- $relefe['fournisseur']['Montant_Regler']) );
            }


    
    
            ?>
            <?php $date = date("Y-m-d", strtotime(str_replace('-', '/', $relefe['date']))); ?>
            <tr align="center">
                <td width="10%" nobr="nobr" align="center"><strong><?php //echo $date ; 
                                                                    ?><?= $this->Time->format(
                                                                            $relefe['date'],
                                                                            'd/MM/y'
                                                                        ); ?></strong></td>
                <td width="60%" nobr="nobr" align="left" colspan="2"> <?php echo @$relefe['type'] ?></td>
                <td width="10%" nobr="nobr" align="right"><?php echo number_format(@$relefe['debit'], 3, '.', ' ') ?></td>
                <td width="10%" nobr="nobr" align="right"><?php echo number_format(@$relefe['credit'], 3, '.', ' ') ?></td>
                <td width="10%" nobr="nobr" align="right"><?php echo number_format(@$sld, 3, '.', ' ') ?></td>
            </tr>

    <?php


            $totdebit = $totdebit + @$relefe['debit'];
            $totcredit = $totcredit + @$relefe['credit'];
            $totimpayer = $totimpayer + @$relefe['impaye'];
            $totreg = $totreg + @$relefe['reglement'];
            $totavoir = $totavoir + @$relefe['avoir'];
            $totsolde = $totsolde + @$relefe['solde'];
            if ($relefe['typ'] == "Reg") {
                $hh = $hh + $relefe['nbligneimp'];
            } else {
                $hh = $hh + 1;
            }
        }
    }

    ?>
    <tr bgcolor="#EAEAEA" align="center">
        <td colspan="3" align="center" width="70%"><strong>Total </strong></td>
        <td align="right" width="10%"><strong><?php echo number_format(($totdebit), 3, '.', ' ') ?></strong></td>
        <td align="right" width="10%"><strong><?php echo number_format(($totcredit), 3, '.', ' ') ?></strong></td>
        <td align="right" width="10%"><strong><?php //echo number_format($sld, 3, '.', ' ') ?></strong></td>
    </tr>
    <tr bgcolor="#EAEAEA" align="center">
        <td colspan="3" align="center" width="70%"><strong>Total Générale</strong></td>
        <td align="right" width="10%"><strong><?php echo number_format(($totdebitt + $soldedebb ), 3, '.', ' ') ?></strong></td>
        <td align="right" width="10%"><strong><?php echo number_format(($totcreditt + $soldecredd ), 3, '.', ' ') ?></strong></td>
        <td align="right" width="10%"><strong><?php echo number_format($sld , 3, '.', ' ') ?></strong></td>
    </tr>



</table>