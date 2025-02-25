<?php $this->layout = 'def'; ?>
<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Unite $unite
 */
?>
<!-- Content Header (Page header) -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('salma'); ?>
<section class="content-header">
  <h1>
   Ajouter Unite
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($unite, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('name',['label'=>'Nom']); ?>
          </div>
      <div align="center">
                    <button type="submit" class="pull-right btn btn-success btn-sm  " id="btnunite" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>

                </div>
        </div>
       

           
    

            <?php echo $this->Form->end(); ?> </div>
      </div>
    </div>
    <!-- /.row -->
</section>




<!-- /.box -->
</div>
</div>



<!-- /.row -->
</section>