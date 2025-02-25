
<div class="row" >
    <div class="col-md-12" >
        <div class="panel panel panel-red">
            <div class="panel-heading">
                <h3 class="panel-title" style="position: relative;">
                    <?php echo __('Recherche'); ?>
                    <ul class="panel-control" style="top:0px;right:0px;">
                    <li><a class="minus active" href="javascript:void(0)"><i class="fa fa-square-o"></i></a></li>
                </ul>
                </h3>
            </div>
            <div class="panel-body" style="display: none;">
        <?php echo $this->Form->create('Stockdepot',array('autocomplete' => 'off','class'=>'form-horizontal ls_form')); ?>

                <div class="col-md-6">                  
                    <?php 
                    echo $this->Form->input('famille_id',array('empty'=>'Familles','div'=>'form-group','label'=>false,'between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                    echo $this->Form->input('article_id',array('value'=>@$articleid,'empty'=>'Articles','div'=>'form-group','label'=>false,'between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                    echo $this->Form->input('typeqte_id',array('multiple'=>'multiple','empty'=>'Type Quantité','div'=>'form-group','label'=>false,'between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                    ?>
                </div>
               <div class="col-md-6">
                <?php
                echo $this->Form->input('fournisseur_id',array('empty'=>'Fournisseurs','div'=>'form-group','label'=>false,'between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                echo $this->Form->input('depot_id',array('empty'=>'Depot','div'=>'form-group','label'=>false,'between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                echo $this->Form->input('typeimpression_id',array('empty'=>'Type Impression','div'=>'form-group','label'=>false,'between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                ?>
 
                </div>      

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn ls-red-btn" id="aff">Chercher</button>  
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
                            <div class="panel panel panel-red">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo __('Stockdepots'); ?></h3>
                                </div>
                  <table class="table table-bordered table-striped" id="">
                      <thead>
	<tr>
	         
		<td style="display: none;" ><?php echo ('Id'); ?></td>
                <td align="center"><?php echo ('Article'); ?></td>
		<td align="center"><?php echo ('Qte'); ?>&nbsp;</td>
                <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                <td align="center"><?php echo ('PMP HT'); ?>&nbsp;</td>
                <td align="center"><?php echo ('PR V HT'); ?>&nbsp;</td>
                <?php } ?>
                <?php //if($typeimpressionid !=1 && $typeimpressionid !=2){ ?>
<!--                <td align="center"><?php //echo ('Dernier prix d\'achat'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td align="center"><?php //echo ('Tot'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>-->
                <?php //} ?>
        </tr></thead><tbody>
	<?php //debug($stockdepots);die;
        $total=0;
        $dernierprix=0;
        if(!empty($stockdepots)){
        foreach (@$stockdepots as $stockdepot): 
            $articleanss=ClassRegistry::init('Article')->find('first', array('recursive'=>-1,'conditions' => array('Article.id' =>$stockdepot['Article']['id'])));
                $qteall=ClassRegistry::init('Stockdepot')->query("select stockbassem('".$stockdepot['Article']['id']."','".date('Y-m-d')."','0','".$depotid."') as v");;
            $qtestock=sprintf('%.2f',$qteall[0][0]['v']);
        if(empty($stockdepot[0]['prix'])) {
            $stockdepot[0]['prix']=0;
        }  
        if(empty($stockdepot[0]['dernierprix'])) {
            $stockdepot[0]['dernierprix']=0;
        }  
        $total=$total+($articleanss['Article']['pmp']*$qtestock);
        $dernierprix=$dernierprix+($stockdepot[0]['dernierprix']*$qtestock);
            ?>
	<tr>
		<td style="display:none"><?php echo h($stockdepot['Article']['id']); ?></td>
                <td >
			<?php echo $stockdepot['Article']['code'].' '.$stockdepot['Article']['name']; ?>
		</td>
		
		<td align="center"><?php 
                $test=strpos($qtestock, ".");
                if($test==true){
                echo sprintf('%.3f',$qtestock);
                }else{
                echo $stockdepot[0]['qte'];    
                }
                 ?></td>
                <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                <td align="right"><?php echo number_format($articleanss['Article']['pmp'],3,'.',''); ?></td>
                <td align="right"><?php echo number_format($articleanss['Article']['prixvente'],3,'.',''); ?></td>
                <?php }?>
                
	</tr>
        <?php endforeach; }?>
                          </tbody>
                          <tfoot>
                          <td colspan="2"><strong><centre>Total</centre></strong></td> 
                          <?php if($typeimpressionid !=1 && $typeimpressionid !=3){ ?>
                          <td colspan="2" align="right"><?php echo number_format($total,3,'.',' ');  ?></td>
                          <?php } ?>
                          <?php //if($typeimpressionid !=1 && $typeimpressionid !=2){ ?>
<!--                          <td><strong></strong></td> 
                          <td><?php //echo number_format($dernierprix,3,'.',' ');  ?></td>-->
                          <?php //} ?>
                          </tfoot>
	</table>
	
                                </div></div></div>	


