<script language="JavaScript" type="text/JavaScript">

    function flvFPW1(){

        var v1=arguments,v2=v1[2].split(","),v3=(v1.length>3)?v1[3]:false,v4=(v1.length>4)?parseInt(v1[4]):0,v5=(v1.length>5)?parseInt(v1[5]):0,v6,v7=0,v8,v9,v10,v11,v12,v13,v14,v15,v16;v11=new Array("width,left,"+v4,"height,top,"+v5);for (i=0;i<v11.length;i++){v12=v11[i].split(",");l_iTarget=parseInt(v12[2]);if (l_iTarget>1||v1[2].indexOf("%")>-1){v13=eval("screen."+v12[0]);for (v6=0;v6<v2.length;v6++){v10=v2[v6].split("=");if (v10[0]==v12[0]){v14=parseInt(v10[1]);if (v10[1].indexOf("%")>-1){v14=(v14/100)*v13;v2[v6]=v12[0]+"="+v14;}}if (v10[0]==v12[1]){v16=parseInt(v10[1]);v15=v6;}}if (l_iTarget==2){v7=(v13-v14)/2;v15=v2.length;}else if (l_iTarget==3){v7=v13-v14-v16;}v2[v15]=v12[1]+"="+v7;}}v8=v2.join(",");v9=window.open(v1[0],v1[1],v8);if (v3){v9.focus();}document.MM_returnValue=false;return v9;

    }
</script>





<head>

</head>

<table align="center" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%" >

                      <thead>
	<tr>

	        <td align="center"><?php echo ('Code'); ?></td>
                <td align="center"><?php echo ('Article'); ?></td>
		<td align="center"><?php echo ('Quantite'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <?php if(CakeSession::read('imp_val_inventaire')==1){ ?>
                <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                <td align="center"><?php echo ('PR Vente'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center"><?php echo ('Prix Achat'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
              <td align="center"><?php echo ('TOT Achat '); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center"><?php echo ('ToT Vente '); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <?php }} ?>
                <?php //if($typeimpressionid !=1 && $typeimpressionid !=2){ ?>
<!--                <td align="center"><?php //echo ('Dernier prix d\'achat'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center"><?php //echo ('Tot'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
                <?php //} ?>
        </tr></thead><tbody>
	<?php //debug($stockdepots);die;
        $total=0;
        $dernierprix=0;
		date_default_timezone_set('Africa/Tunis');

        foreach ($articless as $stockdepot):
			$stt = ClassRegistry::init('Stockdepot')->query("select coutbassem(".$stockdepot['Article']['id']. ",'" . date('Y-m-d H:i:s') . "') as j");

			$articleanss=ClassRegistry::init('Article')->find('first', array('recursive'=>-1,'conditions' => array('Article.id' =>$stockdepot['Article']['id'])));
            $qteall=ClassRegistry::init('Stockdepot')->query("select stockbassem('".$stockdepot['Article']['id']."','".date('Y-m-d H:i:s')."','0','".$depotid."') as v");;
            $qtestock=sprintf('%.2f',$qteall[0][0]['v']);
if($qtestock<0) $qtestock=0;

		   //$total=$total+($stockdepot[0]['prix']*$qtestock);

            if(empty($stockdepot[0]['prix'])) {
            $stockdepot[0]['prix']=0;
        }
        if(empty($stockdepot[0]['dernierprix'])) {
            $stockdepot[0]['dernierprix']=0;
        }
        $total=$total+($articleanss['Article']['pmp']*$qtestock);
        $dernierprix=$dernierprix+($stockdepot[0]['dernierprix']*$qtestock);
           
if($qtestock>0) { ?>
	<tr>
                <td >
			<?php echo $stockdepot['Article']['code']; ?>
		</td>
		<td >
			<?php echo $stockdepot['Article']['name']; ?>
		</td>
<td >
			<?php echo $stockdepot['Article']['prix_vente']; ?>
		</td>
		<td align="center"><?php
                $test=strpos($qtestock, ".");
                if($test==true){
                echo sprintf('%.3f',$qtestock);
                }else{
                echo $qtestock;
                }
                 ?></td>


                <?php if(CakeSession::read('imp_val_inventaire')==1){ ?>
                <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                <td align="center"><?php  $pv+=$articleanss['Article']['prixvente']; echo number_format($articleanss['Article']['prixvente'],3,'.',''); ?></td>
                <td align="center"><?php  $cr+=$stt[0][0]['j']; echo number_format($stt[0][0]['j'],3,'.',''); ?></td>
                <td align="center"><?php $tcr+=$stt[0][0]['j']*$qteall[0][0]['v']; echo number_format($stt[0][0]['j']*$qteall[0][0]['v'],3,'.',''); ?></td> <?php }}?>
			<td align="center"><?php $tv+=$articleanss['Article']['prixvente']*$qtestock; echo number_format($articleanss['Article']['prixvente']*$qtestock,3,'.',''); ?></td>

		<?php //if($typeimpressionid !=1 && $typeimpressionid !=2){ ?>
<!--                <td align="center"><?php //echo number_format($stockdepot[0]['dernierprix'],3,'.',' '); ?></td>
                <td align="center"><?php //echo number_format($stockdepot[0]['dernierprix']*$stockdepot[0]['qte'],3,'.',' '); ?></td>-->
                <?php //} ?>
	</tr>
<?php } endforeach; ?>
                          </tbody>
                          <tfoot>
                          <td colspan="3"><strong><centre>Total</centre></strong></td>
                          <?php if(CakeSession::read('imp_val_inventaire')==1){ ?>
                          <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                          <td><?php echo number_format($pv,3,'.',' ');  ?></td>
                          <td><?php echo number_format($cr,3,'.',' ');  ?></td>
						<td><?php echo number_format($tcr,3,'.',' ');  ?></td>
						 <td><?php echo number_format($tv,3,'.',' ');  ?></td>
                          <?php }} ?>

                          <?php //if($typeimpressionid !=1 && $typeimpressionid !=2){ ?>
<!--                          <td><strong></strong></td>
                          <td><?php //echo number_format($dernierprix,3,'.',' ');  ?></td>-->
                          <?php //} ?>
                          </tfoot>
	</table>

<?php
App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel.php'));
header("Content-type: application/vnd.ms-excel");

header("Content-Disposition: attachment; filename=etatstock.xls");
?>
