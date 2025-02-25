<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Societe $societe
 */
?>
<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
  Consultation Remise/comptant
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a></li>
  </ol>
</section>
<br />
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($remiseqtes, [
          'role' => 'form', 'type' => 'file', 'onkeypress' => "return event.keyCode!=13"
        ]); ?>
        <div class="box-body">
          <table class="table table-bordered table-striped table-bottomless" id="tabligne3">
            <thead>
              <tr>
                <!-- <th><?= ('Article') ?></th> -->
                <th><?= ('Montant MIN') ?></th>
                <th><?= ('Montant MAX') ?></th>
                <th><?= ('Pourcentage') ?></th>
              </tr>
            </thead>
            <tbody>
            <?php foreach ($remiseqtes as $remiseqte) : ?>
              <tr class="tr">
                <!-- style="display: none !important" -->
                <td align="center">
                  <?php echo $this->Form->control('qtemin',["value"=>$remiseqte->qtemin,"label"=>"","readonly"]); ?>
                </td>
                <td align="center">
                <?php echo $this->Form->control('qtemax',["value"=>$remiseqte->qtemax ,"label"=>"","readonly"]); ?>
              </td>
                <td align="center">
                <?php echo $this->Form->control('pourcentage',["value"=>$remiseqte->pourcentage ,"label"=>"","readonly"]); ?>
                </td>
                
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <input type="hidden" value=-1 id="in">
          <br><br>
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
