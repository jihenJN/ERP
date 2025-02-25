<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
  <h1>
    Consultation base poste 
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
        <?php echo $this->Form->create($basepostes, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="col-xs-6">
            <?php
            echo $this->Form->control('codepostale',["readonly"]);
            ?>
          </div>
          <div class="col-xs-6">
            <?php
      echo $this->Form->input('gouvernorat', array('value' => $basepostes->gouvernorat->name , 'readonly' => 'readonly', 'label' => 'Gouvernorat', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));  ?>
          </div>
          <div class="col-xs-6">
            <?php
      echo $this->Form->input('delegtaion', array('value' => $basepostes->delegation->name , 'readonly' => 'readonly', 'label' => 'Delegation', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));  ?>
      
          </div>
          <div class="col-xs-6">
            <?php
      echo $this->Form->input('localite', array('value' => $basepostes->localite->name , 'readonly' => 'readonly', 'label' => 'Localite','div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));  ?>
      
          </div>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>