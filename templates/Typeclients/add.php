<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Ville $ville
 */
?>
<!-- Content Header (Page header) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script> 
<?php echo $this->Html->script('alert'); ?>
<section class="content-header">
    <h1>
  Ajouter  type Clients
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
        <?php echo $this->Form->create($typeclient, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
            <div class="box-body">
            <div class="col-xs-6">
              <?php
                echo $this->Form->control('type');
              ?>
            </div>
            <div class="col-xs-6" style="margin-top: 2.5%;">
                <label class="control-label" style="margin-right: 20px">grandsurface</label>
                oui <input type="radio" name="radio" value="0" id="active" class="choix1" style="margin-right: 20px ">
                non <input type="radio" name="radio" value="0" id="desactive" class="choix2">
                <?php echo $this->Form->control('grandsurface', ['type'=>'hidden','value' => 0,'label' => '', 'id' => 'grandsurface','required'=>'off', 'div' => 'form-group',   'class' => 'form-control ']); ?>
            </div>
            
            <button type="submit" class="pull-right btn btn-success " id="pvr" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>