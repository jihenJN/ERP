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
        <?php echo $this->Form->create('Stockdepot',array('type' => 'get','autocomplete' => 'off','class'=>'form-horizontal ls_form')); ?>

                <div class="col-md-6">
                    <?php
			echo $this->Form->input('code',array('value'=>@$code,'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control ','type'=>'text','label'=>'Code') ); 
						//	echo $this->Form->input('annee',array('value'=>@$annee,'div'=>'form-group','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control ','type'=>'text','label'=>'AnnÃ©e') ); 
              //  echo $this->Form->input('name',array('value'=>$name,'div'=>'form-group','label'=>'Titre','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));

               //     echo $this->Form->input('famille_id',array('value'=>@$famille_id,'empty'=>'veuillez choisir','div'=>'form-group','label'=>'SpecialitÃ©','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control getsousfamille select','id'=>'famille_id'));
                                    echo $this->Form->input('famille_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Famille','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));

 ?>
				 
				    
				 <?php

				     //      echo $this->Form->input('typeqte_id',array('multiple'=>'multiple','empty'=>'veuillez choisir','div'=>'form-group','label'=>'Type QuantitÃ©','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                   // echo $this->Form->input('categoriearticle_id',array('value'=>$categoriearticle_id,'empty'=>'veuillez choisir','div'=>'form-group','label'=>'Categorie Article','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                    ?>
                </div>
               <div class="col-md-6">
                <?php
                echo $this->Form->input('fournisseur_id',array('value'=>@$fournisseur_id,'empty'=>'veuillez choisir','div'=>'form-group','label'=>'Fournisseur','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));

               // echo $this->Form->input('editeur_id',array('value'=>@$editeur_id,'empty'=>'veuillez choisir','div'=>'form-group','label'=>'Editeur','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                echo $this->Form->input('depot_id',array('value'=>@$depotid,'empty'=>'veuillez choisir','div'=>'form-group','label'=>'Depot','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
              //  echo $this->Form->input('typeimpression_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Type Impression','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
               // echo $this->Form->input('typeetatarticle_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Type Article','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
            //     echo $this->Form->input('choi_id', array('value' => explode(',', @$chaine), 'selected' => 'selected', 'label' => 'CritÃ¨res Ã  choisir', 'multiple' => 'multiple', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'empty' => '--Veuillez choisir--', 'id' => 'operateur_id'));
      //   echo 'tt'.$famille_id; ?>

                </div>

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary" id="aff">Chercher</button>
                 <a class="btn btn-primary" href="<?php echo $this->webroot;?>Stockdepots/index"/>Afficher Tout </a>
                    <?php //if($imprimer==1){ ?>
      <a  onClick="flvFPW1(wr+'Stockdepots/imprimer?annee=<?php echo @$annee;?>&code=<?php echo @$code;?>&depot_id=<?php echo @$depotid;?>&type=<?php echo @$type;?>&familleid=<?php echo @$famille_id;?>&sousfamille_id=<?php echo @$sousfamille_id;?>&typeimpressionid=<?php echo @$typeimpressionid;?>&categoriearticle_id=<?php echo @$categoriearticle_id;?>','UPLOAD','width=800,height=1150,scrollbars=yes',0,2,2);return document.MM_returnValue" href="javascript:;" ><button class="btn btn-primary">Imprimer</button> </a>
                    <?php // }?>
      <a  onClick="flvFPW1(wr+'Stockdepots/exp_etatexcel?annee=<?php echo @$annee;?>&code=<?php echo @$code;?>&depot_id=<?php echo @$depotid;?>&chaine=<?php echo @$chaine;?>&type=<?php echo @$type;?>&familleid=<?php echo @$famille_id;?>&sousfamille_id=<?php echo @$sousfamille_id;?>&typeimpressionid=<?php echo @$typeimpressionid;?>','UPLOAD','width=800,height=1150,scrollbars=yes',0,2,2);return document.MM_returnValue" href="javascript:;" ><button class="btn btn-primary">Imprimer Excel</button> </a>


                    </div>
                </div>
            </div>
<div>
				<?php echo $this->Form->input('search', array('type'=>'hidden','value'=>1)); ?>
				<?php echo $this->Form->end(); ?>
			</div>
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
									 
						  
						  
                  <table class="table table-bordered table-striped table-bottomless" id="table">
                      <thead>
	<tr>

		  <td align="center"><?php echo ('Code'); ?></td>
                <td align="center"><?php echo ('Article'); ?></td>
		<td align="center"><?php echo ('Quantite'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center"><?php echo ('Prix Vente'); //PR Moy Pon HT?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	      
        </tr></thead><tbody>
	<?php //debug($stockdepots);die;
        $total=0;
        $dernierprix=0;
        foreach ($stockdepots as $stockdepot):
 
            $articleanss=ClassRegistry::init('Article')->find('first', array('recursive'=>-1,'conditions' => array('Article.id' =>$stockdepot['Stockdepot']['article_id'])));

date_default_timezone_set('Africa/Tunis');
                $dateff=date('Y-m-d H:i:s');
//debug($dateff);
				$stt = ClassRegistry::init('Stockdepot')->query("select coutbassem(".$stockdepot['Article']['id']. ",'" .$dateff. "') as j");
				//debug($stt[0][0]['j']);die;
				//echo "select coutbassem(".$stockdepot['Article']['id'].",'".date('Y-m-d H:i:s')."') as j" ;

				//	echo	$stt[0][0]['j'];
//debug($stockdepot['Article']['id'] );
//debug($depotid);
//echo "select stockbassem('" .$stockdepot['Article']['id'] . "','" .$dateff. "','0','" . $depotid . "') as v";
 //echo  "select testsirine('" .$stockdepot['Article']['id'] . "','" .$dateff. "','0','" . $depotid . "') as v";
//echo $depotid;
$qteall = ClassRegistry::init('Stockdepot')->query("select stockbassem('" .$stockdepot['Article']['id']."','" .$dateff. "','0','" . $depotid . "') as v");
	
$qtestock = sprintf('%.2f',$qteall[0][0]['v']);


if($qtestock<0) $qtestock=0;
        if(empty($stockdepot[0]['prix'])) {
            $stockdepot[0]['prix']=0;
        }
        if(empty($stockdepot[0]['dernierprix'])) {
            $stockdepot[0]['dernierprix']=0;
        }
        $total=$total+($articleanss['Article']['prixvente']*$stockdepot[0]['qte']);
        $dernierprix=$dernierprix+($stockdepot[0]['dernierprix']*$stockdepot[0]['qte']);
            ?>
	<tr>
		
        <td >
			<?php echo $this->Html->link($stockdepot['Article']['code'], array('controller' => 'etathistoriquearticles', 'action' => 'indexspecial', $stockdepot['Article']['code'],@$depotid)); ?>

		  </td>
		<td >
			<?php echo $this->Html->link($stockdepot['Article']['name'], array('controller' => 'etathistoriquearticles', 'action' => 'indexspecial', $stockdepot['Article']['code'],@$depotid)); ?>

		  </td>
	 
	 <td align="center"><?php
               echo $qtestock
                 ?></td> 
<td >
			<?php echo  $articleanss['Article']['prixvente']; 
			
			
			
		?>
		</td>
                <?php
                /*$cond1f = 'Commande.validite_id <>3';
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
                $qte_theorique=$stockdepot[0]['qte']-$qtecom_sortie+$qtecom_entre;
                $test=strpos($qtecom_entre, ".");
                if($test==true){
                $qtecom_entre= sprintf('%.3f',$qtecom_entre);
                }else{
                $qtecom_entre= $qtecom_entre;
                }*/
                ?>
               <!-- <td align="center">
                <?php
                echo $qtecom_entre;
                ?>
                </td>-->
                <?php if(CakeSession::read('imp_val_inventaire')==1){ ?>
                <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
              <!--  <td align="center"><?php echo number_format($articleanss['Article']['prixvente'],3,'.',''); ?></td>-->
                <td align="center"><?php              if($stockdepot[0]['qte']>0)  echo number_format($articleanss['Article']['prixvente']*$stockdepot[0]['qte'],3,'.',''); ?></td>
                <?php }}?>
                <?php //if($typeimpressionid !=1 && $typeimpressionid !=2){ ?>
<!--                <td align="center"><?php //echo number_format($stockdepot[0]['dernierprix'],3,'.',' '); ?></td>
                <td align="center"><?php //echo number_format($stockdepot[0]['dernierprix']*$stockdepot[0]['qte'],3,'.',' '); ?></td>-->
                <?php //} ?>
	</tr>
<?php endforeach; ?>
                          </tbody>
                          <tfoot>
                          <td colspan="5"><strong><center>Total</center></strong></td>
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
	
	

                         <div class="col-md-12">
						<?php echo $this->BootstrapPaginator->paginate(); ?>
					</div>       </div></div></div></div></div>


