<script language="JavaScript" type="text/JavaScript">

    function flvFPW1(){

        var v1=arguments,v2=v1[2].split(","),v3=(v1.length>3)?v1[3]:false,v4=(v1.length>4)?parseInt(v1[4]):0,v5=(v1.length>5)?parseInt(v1[5]):0,v6,v7=0,v8,v9,v10,v11,v12,v13,v14,v15,v16;v11=new Array("width,left,"+v4,"height,top,"+v5);for (i=0;i<v11.length;i++){v12=v11[i].split(",");l_iTarget=parseInt(v12[2]);if (l_iTarget>1||v1[2].indexOf("%")>-1){v13=eval("screen."+v12[0]);for (v6=0;v6<v2.length;v6++){v10=v2[v6].split("=");if (v10[0]==v12[0]){v14=parseInt(v10[1]);if (v10[1].indexOf("%")>-1){v14=(v14/100)*v13;v2[v6]=v12[0]+"="+v14;}}if (v10[0]==v12[1]){v16=parseInt(v10[1]);v15=v6;}}if (l_iTarget==2){v7=(v13-v14)/2;v15=v2.length;}else if (l_iTarget==3){v7=v13-v14-v16;}v2[v15]=v12[1]+"="+v7;}}v8=v2.join(",");v9=window.open(v1[0],v1[1],v8);if (v3){v9.focus();}document.MM_returnValue=false;return v9;

    } 
</script>



<?php 


$ModelSociete = ClassRegistry::init('Societe');
$soc = $ModelSociete->find('first');


$ModelSocietedep = ClassRegistry::init('Depot');
$dep = $ModelSocietedep->find('first',array('conditions'=>array('Depot.id'=>$depotid)));
?>

<head>

</head>


<table width="100%">

                <tr>
                    <td width="45%">
                         <table>
                            <tr>
                                <td style="font-size:15;" align="left"><strong><?php echo $soc['Societe']['nom'] ;?></strong></td>
                            </tr>
                            <tr>
                            <td  align="left"><?php echo  $soc['Societe']['adresse'] ;?></td>
                            </tr>
                            <tr>
                            <td align="left"   ><b> M.F. : <?php //echo  $soc['Societe']['codetva'] ;?></b> </td>
                            </tr>
                             <tr>
                            <td align="left"   ><b>  R.C. : <?php //echo  $soc['Societe']['rc']  ;?> </b></td>
                            </tr>
                            <tr>
                            <td align="left"   > T&eacute;l : <?php echo  $soc['Societe']['tel']  ;?></td>
                            </tr>
                            <tr>
                            <td align="left"   > Fax : <?php echo  $soc['Societe']['fax']  ;?> </td>
                            </tr>
                            <tr>
                            <td align="left"   > Email : <?php echo  $soc['Societe']['mail'] ;?></td>
                            </tr>
                             <tr>
                            <td align="left"   >Site web : <?php echo  $soc['Societe']['site']  ;?></td>
                            </tr>
                           
                        </table>
                    </td>

                    <td width="55%">
                        <br><br><br>
                        <table>
                            <tr>
                                <td align="centre" width="100%" style="font-size:16;"  ><strong>Etat stock  <?php echo  date("d/m/Y").'<br>'.$dep['Depot']['name']  ;?> </strong></td>
                                
                            </tr>
                            
                            
                        </table>
                    </td>
                </tr>
            </table>
<table align="center" border="1" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%" >

                      <thead>
	<tr>
								<th   style="background-color:#b8b8b8" align="center" $zz width="12%" ><strong>N</strong></th>
								<th   style="background-color:#b8b8b8" align="center" $zz width="12%" ><strong>Code</strong></th>

	         
	       <th style="background-color:#b8b8b8" align="center" $zz width="32%" ><strong>Article</strong></th>
 
                       <th  style="background-color:#b8b8b8" align="center" $zz width="5%" ><strong>Qt&eacute;</strong></th>
                       <th  style="background-color:#b8b8b8" align="center" $zz width="10%" ><strong>Prix unitaire</strong></th>
                        
                       <th  style="background-color:#b8b8b8" align="center" $zz ><strong>Total TTC </strong></th>              
        </tr></thead><tbody>
	<?php //debug($stockdepots);die;
        $total=0;
		$i=0;
        $dernierprix=0;
        foreach ($stockdepots as $stockdepot): 
              $articleanss=ClassRegistry::init('Article')->find('first', array('recursive'=>-1,'conditions' => array('Article.id' =>$stockdepot['Article']['id'])));
          
        if(empty($stockdepot[0]['prix'])) {
            $stockdepot[0]['prix']=0;
        }  
        if(empty($stockdepot[0]['dernierprix'])) {
            $stockdepot[0]['dernierprix']=0;
        }  
      			   $qteall = ClassRegistry::init('Stockdepot')->query("select stockbassem('" . $stockdepot['Article']['id'] . "','" . date('Y-m-d H:i:s') . "','0','" . $depotid . "') as v");;
		   $qte = sprintf('%.2f', $qteall[0][0]['v']); 
  if($qte >0) 
  {
  $i++;
   $total=$total+($stockdepot['Article']['prixafodec']*$qte );
        $dernierprix=$dernierprix+($stockdepot[0]['dernierprix']*$qte );
   ?>
	<tr>
	
               	  <td   nobr="nobr" align="right" width="12%"  $zz><?php echo  $i;?></td>  
               	  <td   nobr="nobr" align="right" width="12%"  $zz><?php echo  $stockdepot['Article']['codeabarre']?></td>  

		<td >
			<?php echo utf8_decode($stockdepot['Article']['name']); ?>
		</td>
           <td align="center"><?php //$qteall=ClassRegistry::init('Stockdepot')->query("select stockbassem('".$stockdepot['Article']['id']."','".date('Y-m-d H:i:s')."','0','".$depotid."') as v");;
            $qtestock=sprintf('%.2f',$qte );
if($qtestock<0) $qtestock=0;

     echo $qt=$qtestock;

                 ?></td>
         <td width="10%" nobr="nobr" align="right" height="10px" $zz><?php echo  $stockdepot['Article']['prixafodec'];?></td>
        
       <td   nobr="nobr" align="right"  $zz><?php echo number_format($stockdepot['Article']['prixafodec']*$qt,3,'.',' ');?></td> 
           
	</tr>
<?php } endforeach; ?>
                          </tbody>
                          <tfoot>
                          <td colspan="3"><strong><center>Total</center></strong></td> 
                          <?php if(CakeSession::read('imp_val_inventaire')==1){ ?>
                          <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                          <td><strong></strong></td> 
                          <td><?php echo number_format($total,3,'.',' ');  ?></td>
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