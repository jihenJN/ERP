<?php $this->layout = 'AdminLTE.print'; ?>
<style>
    body {
        font-size: 11px;

    }

    table {
        font-size: 12px;

    }
</style>

<div>
    <div>
        <?php
       // echo $this->Html->image('mm.png', ['alt' => 'CakePHP', 'height' => '110px', 'width' => '200px']); ?>
    </div>
    <div align="left">
        <!-- Société CODIFA <br>        
        Rte Fouchana 1.8 km 1135 naassen <br>
        Phone : (+216) 71 398 404 / (+216) 71 398 158 <br>
        Mail : codifa@gnet.tn <br> -->
    </div>
</div>
<br><br><br>
<h2 style="margin-left: 5px ;">
Relevé Client
</h2>
&nbsp;
<br> &nbsp;
<table border="1" align="center" cellpadding="2" cellspacing="0"  width="100%" class="table" >       

<tr bgcolor="#EAEAEA" align="center">
        <th width="8%" align="center"  ><strong>Date</strong></th>
        <th width="62%" colspan="2" align="center"  ><strong>Libellé Piece</strong></th>
        <th width="10%" align="center"  ><strong>Dédit</strong></th>
        <th width="10%" align="center"  ><strong>Crédit</strong></th>
        <th width="10%" align="center"  ><strong>Solde</strong></th>
    </tr>


            <?php
        
   
        if($relefescount != 0){
              
           
        $totdebit=0;
        $totcredit=0;
        $totimpayer=0;
        $totreg=0; 
        $totavoir=0;
        $totsolde=0;
        $totdebitt=0;
        $totcreditt=0;
        $totimpayert=0;
        $totregt=0; 
        $totavoirt=0;
        $totsoldet=0;
        $clt_id=0; 
        //debug($relefes);
        $hh=0;
        $c=0;$t=0;
        foreach ($relefes as $i=>$relefe){
         
        $totdebitt=$totdebitt+@$relefe['debit'];
        $totcreditt=$totcreditt+@$relefe['credit'];
        $totimpayert=$totimpayert+@$relefe['impaye'];
        $totregt=$totregt+@$relefe['reglement'];
        $totavoirt=$totavoirt+@$relefe['avoir'];
        $totsoldet=$totsoldet+@$relefe['solde'];
        
                    
if ($relefe['client']['id']!=$clt_id){
    
        if($i!=0){ 
                    
                ?>
       <tr>
        <td width="70%" colspan="3" bgcolor="#EAEAEA" align="center"><strong> Total  </strong></td>    
        <td width="10%" align="right"><strong> <?= number_format(@$totdebit,3, '.', ' ') ?></strong></td>
        <td width="10%" align="right"><strong><?=  number_format(@$totcredit,3, '.', ' ')?></strong></td>
        <td width="10%" align="right"><strong><?= number_format(@$totsolde,3, '.', ' ')?></strong></td>
      </tr>
                <?php 
            
        $totdebit=0;
        $totcredit=0;
        $totimpayer=0;
        $totreg=0; 
        $totavoir=0;
        $totsolde=0;
        
}
// var_dump($soldeint);
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
    <td bgcolor="#EAEAEA" align="center"><strong> Client </strong></td>    <td colspan="8"  ><strong>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$relefe['client']['Code'].'  '.@$relefe['client']['Raison_Sociale'] ?></strong></td>
</tr>
<tr>
    <td bgcolor="#EAEAEA" width="70%" align="center" colspan="3"><strong> Solde départ </strong></td> 
       
        <td width="10%" nobr="nobr" align="center"   ><?php echo number_format(@$soldedeb,3, '.', ' ') ?></td>
        <td width="10%" nobr="nobr" align="center"   ><?php echo number_format(@$soldecred,3, '.', ' ')?></td>
       
        <td width="10%" nobr="nobr" align="center"  ><?php echo number_format(@$soldeint,3, '.', ' ')?></td> 
</tr>

<?php

}
$clt_id=$relefe['client']['id'];                    
   if($relefe['debit']!=null) {
           // debug("debit");die;
         $sld=$sld+$relefe['debit'];
        }   else{
            // debug("credit");die;
             $sld=$sld-$relefe['credit'];
        }
                        
     
            
        
        ?>
           <?php $date = date("Y-m-d", strtotime(str_replace('-', '/', $relefe['date']))); ?>
    <tr  align="center">    
        <td width="10%" nobr="nobr" align="center"  > <?php echo 
                                        $this->Time->format(
                                            $relefe['date'],
                                            'dd/MM/y'
                                        );
                                        ?></td>
        <td width="60%" nobr="nobr" align="left" colspan="2"  > <?php echo @$relefe['type'] ?></td>    
        <td width="10%" nobr="nobr" align="center"   ><?php echo number_format(@$relefe['debit'],3, '.', ' ') ?></td>
        <td width="10%" nobr="nobr" align="center"   ><?php echo number_format(@$relefe['credit'],3, '.', ' ') ?></td>
        <td width="10%" nobr="nobr" align="center"  ><?php echo number_format(@$sld,3, '.', ' ') ?></td> 
    </tr>
    
            <?php
 
 
        $totdebit=$totdebit+@$relefe['debit'];
        $totcredit=$totcredit+@$relefe['credit'];
        $totimpayer=$totimpayer+@$relefe['impaye'];
        $totreg=$totreg+@$relefe['reglement'];
        $totavoir=$totavoir+@$relefe['avoir'];
        $totsolde=$totsolde+@$relefe['solde'];
        if($relefe['typ']=="Reg"){
        $hh=$hh+$relefe['nbligneimp'];  
        }else{
        $hh=$hh+1;
        }
        }}
      
        ?>
           <tr bgcolor="#EAEAEA" align="center">  
                <td colspan="3" align="center" width="70%"   ><strong>Total </strong></td>
                <td  align="center" width="10%"><strong><?php echo number_format(($totdebit),3, '.', ' ')?></strong></td>
                <td  align="center" width="10%"><strong><?php echo number_format(($totcredit),3, '.', ' ')?></strong></td>     
                <td  align="center" width="10%"><strong><?php echo number_format($sld,3, '.', ' ')?></strong></td>
           </tr>
            <tr bgcolor="#EAEAEA" align="center">  
                <td colspan="3" align="center" width="70%"   ><strong>Total Générale</strong></td>
                <td  align="center" width="10%"><strong><?php echo number_format(($totdebitt+$soldedebb),3, '.', ' ')?></strong></td>
                <td  align="center" width="10%"><strong><?php echo number_format(($totcreditt+$soldecredd),3, '.', ' ')?></strong></td>     
                <td  align="center" width="10%"><strong><?php echo number_format($sld,3, '.', ' ')?></strong></td>
           </tr>
           
        

</table> 

