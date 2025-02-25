<script language="JavaScript" type="text/JavaScript">

function flvFPW1(){

var v1=arguments,v2=v1[2].split(","),v3=(v1.length>3)?v1[3]:false,v4=(v1.length>4)?parseInt(v1[4]):0,v5=(v1.length>5)?parseInt(v1[5]):0,v6,v7=0,v8,v9,v10,v11,v12,v13,v14,v15,v16;v11=new Array("width,left,"+v4,"height,top,"+v5);for (i=0;i<v11.length;i++){v12=v11[i].split(",");l_iTarget=parseInt(v12[2]);if (l_iTarget>1||v1[2].indexOf("%")>-1){v13=eval("screen."+v12[0]);for (v6=0;v6<v2.length;v6++){v10=v2[v6].split("=");if (v10[0]==v12[0]){v14=parseInt(v10[1]);if (v10[1].indexOf("%")>-1){v14=(v14/100)*v13;v2[v6]=v12[0]+"="+v14;}}if (v10[0]==v12[1]){v16=parseInt(v10[1]);v15=v6;}}if (l_iTarget==2){v7=(v13-v14)/2;v15=v2.length;}else if (l_iTarget==3){v7=v13-v14-v16;}v2[v15]=v12[1]+"="+v7;}}v8=v2.join(",");v9=window.open(v1[0],v1[1],v8);if (v3){v9.focus();}document.MM_returnValue=false;return v9;

}

</script>
 <?php $add="";$edit="";$delete="";$imprimer="";$addindirect="";
$lien=  CakeSession::read('lien_stock');
foreach($lien as $k=>$liens){
    //debug($liens);die;
	if(@$liens['lien']=='stockdepot'){
		$add=$liens['add'];
		$edit=$liens['edit'];
		$delete=$liens['delete'];
		$imprimer=$liens['imprimer'];
	}
if(@$liens['lien']=='factureclients'){
		$addindirect=$liens['add'];
	}

}
if($add==1){?>

<?php } ?>
<br>
<div class="row" >
    <div class="col-md-12" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo __('Recherche'); ?></h3>
            </div>
            <div class="panel-body">
        <?php echo $this->Form->create('Stockdepot',array('autocomplete' => 'off','class'=>'form-horizontal ls_form')); ?>

                <div class="col-md-6">
                    <?php
                    echo $this->Form->input('famille_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Famille','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
					                    echo $this->Form->input('sousfamille_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Sous Famille','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));

                    echo $this->Form->input('article_id',array('value'=>@$articleid,'empty'=>'veuillez choisir','div'=>'form-group','label'=>'Article','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                    echo $this->Form->input('typeqte_id',array('multiple'=>'multiple','empty'=>'veuillez choisir','div'=>'form-group','label'=>'Type Quantité','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                    echo $this->Form->input('categoriearticle_id',array('value'=>$categoriearticle_id,'empty'=>'veuillez choisir','div'=>'form-group','label'=>'Categorie Article','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                    ?>
                </div>
               <div class="col-md-6">
                <?php
                echo $this->Form->input('fournisseur_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Fournisseur','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                echo $this->Form->input('depot_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Depot','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                echo $this->Form->input('typeimpression_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Type Impression','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                echo $this->Form->input('typeetatarticle_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Type Article','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                ?>

                </div>

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary" id="aff">Chercher</button>
                 <a class="btn btn-primary" href="<?php echo $this->webroot;?>Stockdepots/index"/>Afficher Tout </a>
                    <?php //if($imprimer==1){ ?>
      <a  onClick="flvFPW1(wr+'Stockdepots/imprimer?article_id=<?php echo @$articleid;?>&depot_id=<?php echo @$depotid;?>&type=<?php echo @$type;?>&familleid=<?php echo @$familleid;?>&fournisseurid=<?php echo @$fournisseurid;?>&typeimpressionid=<?php echo @$typeimpressionid;?>&categoriearticle_id=<?php echo @$categoriearticle_id;?>&sousfamille_id=<?php echo @$sousfamille_id;?>','UPLOAD','width=800,height=1150,scrollbars=yes',0,2,2);return document.MM_returnValue" href="javascript:;" ><button class="btn btn-primary">Imprimer</button> </a>
                    <?php // }?>
      <a  onClick="flvFPW1(wr+'Stockdepots/exp_etatexcel?article_id=<?php echo @$articleid;?>&depot_id=<?php echo @$depotid;?>&type=<?php echo @$type;?>&familleid=<?php echo @$familleid;?>&fournisseurid=<?php echo @$fournisseurid;?>&typeimpressionid=<?php echo @$typeimpressionid;?>&sousfamille_id=<?php echo @$sousfamille_id;?>','UPLOAD','width=800,height=1150,scrollbars=yes',0,2,2);return document.MM_returnValue" href="javascript:;" ><button class="btn btn-primary">Imprimer Excel</button> </a>


                    </div>
                </div>
            </div>
<?php echo $this->Form->end();?>
        </div>
    </div>
</div>
<br><input type="hidden" id="page" value="1"/>
<div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo __('Stockdepots'); ?></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="ls-editable-table table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="ls-editable-table">
                      <thead>
	<tr>

		<td style="display: none;" ><?php echo ('Id'); ?></td>
	        <td align="center"><?php echo ('Code'); ?></td>
                <td align="center"><?php echo ('Article'); ?></td>
		<td align="center"><?php echo ('Quantite'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	        <td align="center"><?php echo ('Qte CMD FRS'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <?php if(CakeSession::read('imp_val_inventaire')==1){ ?>
                <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                <td align="center"><?php echo ('Prix achat'); //PR Moy Pon HT?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td align="center"><?php echo ('Prix vente'); ?></td>
                <td align="center"><?php echo ('TOT Achat'); //PR Moy Pon HT?></td>

            <td align="center"><?php echo ('TOT Vente'); ?></td>
                <?php }} ?>
                <?php //if($typeimpressionid !=1 && $typeimpressionid !=2){ ?>
<!--                <td align="center"><?php //echo ('Dernier prix d\'achat'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center"><?php //echo ('Tot'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
                <?php //} ?>
        </tr></thead><tbody>
	<?php //debug($stockdepots);die;
        $total=0;
        $dernierprix=0;

			foreach ($articless as $stockdepot) :
				$stt = ClassRegistry::init('Stockdepot')->query("select coutbassem(".$stockdepot['Article']['id']. ",'" . date('Y-m-d H:i:s') . "') as j");
				//debug($stt[0][0]['j']);die;
				//echo "select coutbassem(".$stockdepot['Article']['id'].",'".date('Y-m-d H:i:s')."') as j" ;

				//	echo	$stt[0][0]['j'];
date_default_timezone_set('Africa/Tunis');
                $dateff=date('Y-m-d H:i:s');
//echo  "select stockbassem('" .$stockdepot['Article']['id'] . "','" .$dateff. "','0','" . $depotid . "') as v";
				$qteall = ClassRegistry::init('Stockdepot')->query("select stockbassem('" .$stockdepot['Article']['id'] . "','" .$dateff. "','0','" . $depotid . "') as v");;
				
$qtestock = sprintf('%.2f',$qteall[0][0]['v']);


if($qtestock<0) $qtestock=0;

		//   $total=$total+($stockdepot[0]['prix']*$qtestock);


            $articleanss=ClassRegistry::init('Article')->find('first', array('recursive'=>-1,'conditions' => array('Article.id' =>$stockdepot['Article']['id'])));

       /* if(empty($stockdepot[0]['prix'])) {
            $stockdepot[0]['prix']=0;
        }
        if(empty($stockdepot[0]['dernierprix'])) {
            $stockdepot[0]['dernierprix']=0;
        }

        $total=$total+($articleanss['Article']['pmp']*$qtestock);
        $dernierprix=$dernierprix+($stockdepot[0]['dernierprix']*$qtestock);
           */?>
	<tr>
		<td style="display:none"><?php echo h($stockdepot['Article']['id']); ?></td>
                <td >
			<?php echo $this->Html->link($stockdepot['Article']['code'], array('controller' => 'etathistoriquearticles', 'action' => 'index', $stockdepot['Article']['id'],@$depotid)); ?>
		</td>
		<td >
			<?php echo $this->Html->link($stockdepot['Article']['name'], array('controller' => 'etathistoriquearticles', 'action' => 'index', $stockdepot['Article']['id'],@$depotid)); ?>
		</td>

		<td align="center"><?php
                $test=strpos($qtestock, ".");
                if($test==true){
                echo sprintf('%.3f',$qtestock);
                }else{
                echo $qtestock;
                }
                 ?></td>

                <?php
                $cond1f = 'Commande.validite_id <>3';
                $lignecommandes=ClassRegistry::init('Lignecommande')->find('all', array('fields'=>array('sum(Lignecommande.quantite) as qte')
                ,'conditions' => array('Lignecommande.article_id' =>$stockdepot['Article']['id'],@$cond1f,'Commande.exercice_id >=2017')
                ,'group'=>array('Lignecommande.article_id')));
                $commandeclts =ClassRegistry::init('Lignecommandeclient')->find('all', array('fields'=>array('sum(Lignecommandeclient.quantite) as qte'),'conditions' => array('Lignecommandeclient.id > ' => 0,'Lignecommandeclient.article_id' =>$stockdepot['Article']['id'],@$cond1c, @$cond3c, @$cond4c )
                ,'group'=>array('Lignecommandeclient.article_id')));
                //debug($commandeclts);
                if(!empty($lignecommandes)){
                $qtecom_entre=$lignecommandes[0][0]['qte'];
                }else{
                $qtecom_entre=0;
                }
                if(!empty($commandeclts)){
                $qtecom_sortie=$commandeclts[0][0]['qte'];
                }else{
                $qtecom_sortie=0;
                }
                $qte_theorique=$qtestock-$qtecom_sortie+$qtecom_entre;
                $test=strpos($qtecom_entre, ".");
                if($test==true){
                $qtecom_entre= sprintf('%.3f',$qtecom_entre);
                }else{
                $qtecom_entre= $qtecom_entre;
                }
                ?>
                <td align="center">
                <?php
                echo $qtecom_entre;
                ?>
                </td>
                <?php if(CakeSession::read('imp_val_inventaire')==1){ ?>
                <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                <td align="center"><?php

					echo number_format($stt[0][0]['j'],3,'.',''); ?></td>
                <!--<td align="center"><?php  //$cr+=$articleanss['Article']['coutrevient']; echo number_format($articleanss['Article']['coutrevient'],3,'.',''); ?></td>  <td align="center"><?php $tv+=$articleanss['Article']['prixvente']*$stockdepot[0]['qte']; echo number_format($articleanss['Article']['prixvente']*$stockdepot[0]['qte'],3,'.',''); ?></td>
                <td align="center"><?php //$tcr+=$articleanss['Article']['coutrevient']*$stockdepot[0]['qte']; echo number_format($articleanss['Article']['coutrevient']*$stockdepot[0]['qte'],3,'.',''); ?></td>
               --> <?php }}?>
                <?php //if($typeimpressionid !=1 && $typeimpressionid !=2){ ?>
                <td align="center">
					<?php  echo number_format($articleanss['Article']['prixvente'],3,'.',''); ?></td>
		<?php //echo number_format($stockdepot['dernierprix'],3,'.',' '); ?></td>


		<td align="center"><?php 	echo number_format($stt[0][0]['j']*$qteall[0][0]['v'],3,'.',''); ?>      <?php //} ?>
		<td>
			<?php
			echo number_format($articleanss['Article']['prixvente']*$qteall[0][0]['v'],3,'.',' '); ?></td>



		</td>
	</tr>
<?php endforeach; ?>
                          </tbody>
                         <!-- <tfoot>
                          <td colspan="4"><strong><centre>Total</centre></strong></td>
                          <?php if(CakeSession::read('imp_val_inventaire')==1){ ?>
                          <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                           <td><?php echo number_format($pv,3,'.',' ');  ?></td>
                          <td><?php echo number_format($cr,3,'.',' ');  ?></td>
                          <td><?php echo number_format($tv,3,'.',' ');  ?></td>
                          <td><?php echo number_format($tcr,3,'.',' ');  ?></td>
                          <?php }} ?>
                          <?php //if($typeimpressionid !=1 && $typeimpressionid !=2){ ?>
<!--                          <td><strong></strong></td>
                          <td><?php //echo number_format($dernierprix,3,'.',' ');  ?></td>-->
                          <?php //} ?>
                        <!--  </tfoot>-->
	</table>

                                </div></div></div></div></div>


