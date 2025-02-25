<script language="JavaScript" type="text/JavaScript">

    function flvFPW1(){

var v1=arguments,v2=v1[2].split(","),v3=(v1.length>3)?v1[3]:false,v4=(v1.length>4)?parseInt(v1[4]):0,v5=(v1.length>5)?parseInt(v1[5]):0,v6,v7=0,v8,v9,v10,v11,v12,v13,v14,v15,v16;v11=new Array("width,left,"+v4,"height,top,"+v5);for (i=0;i<v11.length;i++){v12=v11[i].split(",");l_iTarget=parseInt(v12[2]);if (l_iTarget>1||v1[2].indexOf("%")>-1){v13=eval("screen."+v12[0]);for (v6=0;v6<v2.length;v6++){v10=v2[v6].split("=");if (v10[0]==v12[0]){v14=parseInt(v10[1]);if (v10[1].indexOf("%")>-1){v14=(v14/100)*v13;v2[v6]=v12[0]+"="+v14;}}if (v10[0]==v12[1]){v16=parseInt(v10[1]);v15=v6;}}if (l_iTarget==2){v7=(v13-v14)/2;v15=v2.length;}else if (l_iTarget==3){v7=v13-v14-v16;}v2[v15]=v12[1]+"="+v7;}}v8=v2.join(",");v9=window.open(v1[0],v1[1],v8);if (v3){v9.focus();}document.MM_returnValue=false;return v9;

}

</script>
<?php /* $add="";$edit="";$delete="";$imprimer="";$addindirect="";
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
if($add==1){ */ ?>

<?php //} 
?>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo __('Recherche'); ?></h3>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('Stockdepot', array('autocomplete' => 'off', 'class' => 'form-horizontal ls_form')); ?>

                <div class="col-md-6">
                    <?php
                    echo $this->Form->input('famille_id', array('empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Famille', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    echo $this->Form->input('article_id', array('empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Article', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    echo $this->Form->input('typeqte_id', array('multiple' => 'multiple', 'empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Type Quantité', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    ?>
                </div>
                <div class="col-md-6">
                    <?php
                    echo $this->Form->input('fournisseur_id', array('empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Fournisseur', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    echo $this->Form->input('depot_id', array('empty' => 'veuillez choisir', 'div' => 'form-group', 'label' => 'Depot', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
                    ?>

                </div>

                <div class="form-group">
                    <div class="col-lg-9 col-lg-offset-3">
                        <button type="submit" class="btn btn-primary" id="aff">Chercher</button>
                        <a class="btn btn-primary" href="<?php echo $this->webroot; ?>Stockdepots/indexpardepot" />Afficher Tout </a>
                        <?php //if($imprimer==1){ 
                        ?>
                        <a onClick="flvFPW1(wr+'Stockdepots/imprimerpardepot?article_id=<?php echo @$articleid; ?>&depot_id=<?php echo @$depotid; ?>&type=<?php echo @$type; ?>&familleid=<?php echo @$familleid; ?>&fournisseurid=<?php echo @$fournisseurid; ?>','UPLOAD','width=800,height=1150,scrollbars=yes',0,2,2);return document.MM_returnValue" href="javascript:;"><button class="btn btn-primary">Imprimer</button> </a>
                        <?php // }
                        ?>
                        <a onClick="flvFPW1(wr+'Stockdepots/exp_etatexcelpardepot?article_id=<?php echo @$articleid; ?>&depot_id=<?php echo @$depotid; ?>&type=<?php echo @$type; ?>&familleid=<?php echo @$familleid; ?>&fournisseurid=<?php echo @$fournisseurid; ?>','UPLOAD','width=800,height=1150,scrollbars=yes',0,2,2);return document.MM_returnValue" href="javascript:;"><button class="btn btn-primary">Imprimer Excel</button> </a>


                    </div>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>
<br><input type="hidden" id="page" value="1" />
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo __('Stock depots'); ?></h3>
            </div>
            <div class="panel-body">
                <div class="ls-editable-table table-responsive ls-table">
                    <table class="table table-bordered table-striped table-bottomless" id="ls-editable-table">
                        <thead>
                            <tr>

                                <td style="display: none;"><?php echo ('Id'); ?></td>

                                <td align="center"><?php echo ('Article'); ?></td>
                                <?php foreach ($depotalls as $depot) { ?>
                                    <td align="left"><?php echo $depot['Depot']['name']; ?></td>
                                <?php } ?>
                                <td align="left"><?php echo ('Qte ToT'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                        </thead>
                        <tbody>
                            <?php 
                            if (!empty($articless)) {

                                foreach ($articless as $stockdepot) :

                                    $articleanss = ClassRegistry::init('Article')->find('first', array('recursive' => -1, 'conditions' => array('Article.id' => $stockdepot['Article']['id'])));


                            ?>
                                    <tr>
                                        <td style="display:none"><?php echo h($stockdepot['Article']['codeabarre']); ?></td>
                                        <td>
                                            <?php echo $stockdepot['Article']['codeabarre'] . " " . $stockdepot['Article']['designiation'];
                                            if ($stockdepot['Article']['image']) { ?><br />
                                                <img src="<?php echo $this->webroot; ?>files/article/<?php echo $stockdepot['Article']['image']; ?>" width="150px" height="150px">
                                            <?php } ?>
                                        </td>
                                        <?php $total = 0;
                                        foreach ($depotalls as $d => $depot) {

                                            $dep = $depot['Depot']['id'];
                                            date_default_timezone_set('Africa/Tunis');
                                            $datef = date('Y-m-d H:i:s');
                                            $st = ClassRegistry::init('Stockdepot')->query("select stockbassem(" . $stockdepot['Article']['id'] . ",'" . $datef . "','0','" . $dep . "') as v"); //debug($st[0][0]['v']);die;*/*/*/*/*/
                                            //debug($st[0][0]); die;
                                            if (!empty($st)) {
                                                $qtestock = $st[0][0]['v']; 
                                                $total = $total + $st[0][0]['v'];
                                            } else {
                                                $qtestock = 0;
                                            }
                                        ?>
                                            <td align="center">

                                                <?php echo $this->Html->link($qtestock, array('controller' => 'etathistoriquearticles', 'action' => 'indexspecial', $stockdepot['Article']['id'], @$dep)); ?>
                                            </td>
                                        <?php } ?>
                                        <td align="center">

                                            <?php echo $this->Html->link($total, array('controller' => 'etathistoriquearticles', 'action' => 'indexspecial', $stockdepot['Article']['id'], @$dep)); ?>
                                        </td>
                                        
                                    </tr>
                            <?php endforeach;
                            } ?>
                        </tbody>
                       
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>