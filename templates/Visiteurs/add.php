<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Typecontact $typecontact
 */
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
  <section class="content-header">
    <h1>
    Ajout Visiteur
      <small><?php echo __(''); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box ">
          
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($visiteur, ['role' => 'form']); ?>
            <div class="box-body">
                    <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
                                <div class="col-xs-6">
              <?php
                echo $this->Form->control('nom',['label'=>'Nom et prénom']);
                echo $this->Form->control('telephone',['label'=>'Téléphone']);
              ?>
                                </div>
                         </div>
               <button type="submit" class="pull-right btn btn-success" id="testde" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
            </div>
            
            <!-- /.box-body -->

        
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
<?php echo $this->Html->script('alert'); ?>