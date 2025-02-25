<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php echo $this->Html->css('select2'); ?>

<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <h1>
    Utilisateurs
    <small><?php echo __(''); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i><?php echo __('Retour'); ?></a></li>
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
        <?php echo $this->Form->create($user, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('personnel_id', ['options' => $personnels, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('utilisateur_id', ['label' => 'Profile', 'options' => $utilisateurs, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
            </div>

            <div class="col-xs-6">
              <?php
              echo $this->Form->control('login',['class'=>'form-control']); ?>
            </div>
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('password',['class'=>'form-control']); ?>
            </div>
            <!-- <div class="col-xs-6">
              <input type="checkbox" id="validationoffre" name="validationoffre" value="0" <?php if ($user->validationoffre == 1) {
                                                                                              $style = 'true'; ?> checked <?php } ?>>
              <label for="validationoffre">Validation Offre de prix Vente</label>
              <br>
              <input type="checkbox" id="validationcommande" name="validationcommande" value="0" <?php if ($user->validationcommande == 1) {
                                                                                                    $style = 'true'; ?> checked <?php } ?>>
              <label for="validationcommande">Validation Commande Vente</label>
            </div>
            <div class="col-xs-6">
              <input type="checkbox" id="validationfactureachat" name="validationfactureachat" value="0" <?php if ($user->validatiofactureachat == 1) {
                                                                                                            $style = 'true'; ?> checked <?php } ?>>
              <label for="validationfactureachat">Validation Facture Achat</label>

            </div> -->
          </div>
          <div class="col-xs-6" hidden>
            <div class="radio">
              <label>
                <?= $this->Form->radio('poste', [
                  '0' => 'Admin',
                  // '1' => 'Point de vente',
                  '2' => 'Commercial',
                ]) ?>
              </label>
            </div>
          </div>
          <!-- <div class="col-xs-6">
            <div class="radio">
              <input type="checkbox" id="validationtransfert" name="validationtransfert" value="0" <?php if ($user->validationtransfert == 1) {
                                                                                                      $style = 'true'; ?> checked <?php } ?>>
              <label for="validationtransfert">Validation Transfert Caisse</label>
            </div>
          </div>

          <div class="col-xs-6">
            <br><br><br><br><br>
          </div>
          <?php
          $style = 'none';
          if ($user->poste == 2) {
            $style = 'true';
          }
          ?>

          <div id="commercialDiv" style="display:<?php echo $style; ?>" class="col-xs-6 pull-left">
            <?php
            echo $this->Form->control('commercial_id', [
              'multiple' => true,
              'name' => 'commercial_id[]',
              'class' => 'form-control select2 ',
              'default' => $selectedCommercialIds
            ]); ?>
          </div> -->
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<?php echo $this->Html->script('alert'); ?>
<script>
  $('.select2').select2();

  $("form").submit(function() {
    $('#alertuserm').attr('disabled', 'disabled');
  })
</script>

<script>
  $(document).ready(function() {
    // Disable all input and select elements
    $('input, select').prop('disabled', true);
  });
</script>
<?php $this->end(); ?>