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
                echo $this->Form->input('depot_id',array('empty'=>'veuillez choisir','div'=>'form-group','label'=>'Depot','between'=>'<div class="col-sm-10">','after'=>'</div>','class'=>'form-control'));
                   ?>
                </div>
                 

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary" id="aff">Chercher</button>  
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
                                    <h3 class="panel-title"><?php echo __('Articles'); ?></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="ls-editable-table table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="ls-editable-table">
                      <thead>
	<tr>
	         
	        <td align="center"><?php echo ('Code'); ?></td>
                <td align="center"><?php echo ('Article'); ?></td>
		<td align="center"><?php echo ('Quantite historique'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	        <td align="center"><?php echo ('Quantite stock'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        </tr></thead><tbody>
	<?php //debug($stockdepots);die;
        if(!empty($depotid)){
        $articles=ClassRegistry::init('Article')->find('all',array('recursive'=>-1));
        foreach ($articles as $article):
        $articleid=$article['Article']['id'];
        $solde=0;
        $solde=$this->requestAction('/App/qtestock/'.$depotid.'/'.$articleid);

        $stckdepot = ClassRegistry::init('Stockdepot')->find('first', array(
        'conditions' => array('Stockdepot.article_id' =>$articleid, 'Stockdepot.depot_id' =>$depotid), false));
         if($stckdepot==array()){
               $stckdepot['Stockdepot']['quantite']=0;
        }
        if(sprintf("%.3f",$solde) != $stckdepot['Stockdepot']['quantite']){
        ?>
	<tr>
                <td >
			<?php echo $this->Html->link($article['Article']['code'], array('controller' => 'etathistoriquearticles', 'action' => 'index', $stockdepot['Article']['id'],@$depotid)); ?>
		</td>
		<td >
			<?php echo $this->Html->link($article['Article']['name'], array('controller' => 'etathistoriquearticles', 'action' => 'index', $stockdepot['Article']['id'],@$depotid)); ?>
		</td>
		<td align="center"><?php echo sprintf("%.3f",$solde) ; ?></td>
                <td align="center"><?php echo $stckdepot['Stockdepot']['quantite'] ;?></td>
	</tr>
        <?php } endforeach; }?>
            </tbody>
                         
	</table>
	
                                </div></div></div></div></div>	


