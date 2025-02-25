<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Inventaire $inventaire
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('mahdi'); ?>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->fetch('script'); ?>

<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     Consultation Inventaire
    </h1>
    <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type ]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
           
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($inventaire, ['role' => 'form','onkeypress'=>"return event.keyCode!=13"]); ?>
      
          <div class="box-body">
            <div class="col-xs-6">
                          <?php
                            echo $this->Form->control('numero',['label'=>'Numéro','readonly']);?>
              </div>
              <div class="col-xs-6">
                          <?php
                         echo $this->Form->control('date',['label'=>'Date','id'=>'date','readonly']);?>
              </div> 
              

              <div class="col-xs-6">
                          <?php
                 echo $this->Form->control('pointdevente_id',['label'=>'Site',  'id'=>'pointdevente_id','class'=>'form-control select2 ','disabled'=>true]);?>
              </div> 

              <div class="col-xs-6">
                          <?php
                         echo $this->Form->control('depot_id',['label'=>'Dépot','empty' => 'Veuillez choisir un dépot !!','id'=>'depot_id','class'=>'form-control select2','disabled'=>true]);?>
              </div> 
            
     
            </div>

            <section class="content-header">
                        <h1 class="box-title"><?php echo __('Articles'); ?></h1>  
                    </section>  

                    <section class="content" style="width: 99%" >
                        <div class="row">
                            <div class="box">
                              
                                <div class="panel-body">
                                    <div class="table-responsive ls-table">
                                        <table class="table table-bordered table-striped table-bottomless" id="tabligne">
                                            <thead>
                                                <tr width:"20px">
                                                <td align="center" style="width: 60%;"><strong>Article</strong></td>
                                                    <td align="center" style="width: 20%;"><strong>Qte Théorique</strong></td>
                                                    <td align="center" style="width: 20%;"><strong>Qte Stock</strong></td>
                                                   
                                                </tr>
                                            </thead>
                                            <tbody>
                                               
                                                <?php
                                                $i = -1;

                                                foreach ($lignes as $i => $li) :
                                                 // debug($li);
                                                    ?>
                                                    <tr>
                                                        <td align="center">
                                                            <?php echo $this->Form->input('sup1', array('name' => 'data[ligner][' . $i . '][sup1]', 'id' => 'sup1' . $i, 'champ' => 'sup1', 'table' => 'ligner', 'index' => $i, 'div' => 'form-group','type' => 'hidden', 'class' => 'form-control'));
                                                            ?>
                                                        <?php echo $this->Form->input('id', array('label' => '', 'value' => $li->id, 'name' => 'data[ligner][' . $i . '][id]', 'type' => 'hidden', 'id' => 'name' . $i, 'table' => 'ligner', 'index' => $i, 'div' => 'form-group', 'class' => 'form-control')); ?>
                                                              
                                                        <label></label>
                                              <select name="<?php echo "data[ligner][" . $i . "][article_id]" ?>"  width="200px" id="<?php echo 'article_id' . $i ?>" style="width:200px" table="ligner" index="<?php echo $i ?>" champ="article_id" class="js-example-responsive select2 " disabled>
                                                  <option value="" selected="selected" disabled>Veuillez choisir !!</option>

                                                  <?php foreach ($articles as $id => $article) {
                                                      ?>
                                                      <option <?php if ($li->article_id == $article->id) { ?> selected="selected" <?php } ?> value="<?php echo $article->id; ?>"><?php echo $article->Code . ' ' . $article->Dsignation ?></option>
                                                  <?php } ?>
                                              </select>   
                                                        <?php // echo $this->Form->control('article_id', array('class' => 'form-control  select2','label' => '','empty'=>'Veuillez choisir !!', 'value' => $li->article_id, 'champ' =>'article_id' ,'name' => 'data[ligner][' . $i . '][article_id]', 'id' => 'article_id' .$i, 'table' => 'ligner', 'index' => $i,'disabled'=>true)); ?>
                                                        </td>
                                                        <td align="center">
                                                        <?php echo $this->Form->control('qteTheorique', array('class' => 'form-control','label' => '', 'value' => $li->qteTheorique, 'champ' =>'qteTheorique' ,'name' => 'data[ligner][' . $i . '][qteTheorique]', 'id' => 'qteTheorique' .$i, 'table' => 'ligner', 'index' => $i,'readonly')); ?>

                                                        </td>
                                                        <td align="center">
                                                        <?php echo $this->Form->control('qteStock', array('class' => 'form-control','label' => '', 'value' => sprintf("%01.3f",$li->qteStock), 'champ' =>'qteStock' ,'name' => 'data[ligner][' . $i . '][qteStock]', 'id' => 'qteStock' .$i, 'table' => 'ligner', 'index' => $i,'readonly')); ?>

                                                        </td>


                                                      
                                                       
                                                       
                                                       
                                                         </tr>
                                                <?php endforeach; ?>
                                                <input type="hidden" value="<?php echo $i ?>" id="index">

                                              </tbody>
                                        </table><br>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </section>   


          


            <!-- /.box-body -->
         
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>

<script>
   
    $('.select2').select2({
        
    })
    

    

</script>
<?php $this->end(); ?>





