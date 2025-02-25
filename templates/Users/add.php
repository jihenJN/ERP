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
        <?php echo $this->Form->create($user, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">
            <div class="col-xs-6">
              <?php
              echo $this->Form->control('personnel_id', ['options' => $personnels, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('utilisateur_id', ['label' => 'Profile', 'options' => $utilisateurs, 'empty' => 'Veuillez choisir !!', 'class' => 'form-control select2 ']); ?>
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
              <div>
                <input type="checkbox" id="validationoffre" name="validationoffre" value="0">
                <label for="validationoffre">Droit Validation Offre de prix Vente</label>
              </div>

              <div>
                <input type="checkbox" id="validationcommande" name="validationcommande" value="0">
                <label for="validationcommande">Droit Validation Commande Vente</label>
              </div>
            </div> -->
<!-- 
            <div class="col-xs-6">
              <div>
                <input type="checkbox" id="validationfactureachat" name="validationfactureachat" value="0">
                <label for="validationfactureachat">Droit Validation Facture achat</label>
              </div>
            </div> -->
          </div>
          <div class="col-xs-6" hidden>
            <div class="radio">
              <label>
                <?= $this->Form->radio('poste', [
                  '0' => 'Admin',
                  //  '1' => 'Point de vente',
                  '2' => 'Commercial'
                ]) ?>
              </label>
            </div>
          </div>

          <!-- <div class="col-xs-6">
            <div class="radio">
              <input type="checkbox" id="validationtransfert" name="validationtransfert" value="0">
              <label for="validationtransfert">Droit Validation Transfert Caisse</label>
            </div>
          </div> -->
          <!-- <div class="col-xs-6">
            <br><br><br>
          </div>
          <div id="commercialDiv" style="display:none;" class="col-xs-6 pull-left">
            <?php
            echo $this->Form->control('commercial_id', ['multiple' => true, 'name' => 'commercial_id[]', 'class' => 'form-control select2 ']); ?>
          </div> -->

          <!-- <div id="caisseDiv" style="display:none;" class="col-xs-6 pull-right">
            <?php
            echo $this->Form->control('caisse_id', ['multiple' => true, 'name' => 'caisse_id[]', 'class' => 'form-control select2 ']); ?>
          </div> -->


          <button type="submit" class="pull-right btn btn-success btn-sm log" id="alertuserm" style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box-body -->


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
<?php $this->end(); ?>



<script>
  $(document).ready(function() {

    $('input[name="poste"]').change(function() {

      if ($(this).val() == '2') {

        $('#commercialDiv').show();
      } else {
        // If no, hide the div
        $('#commercialDiv').hide();
        $('#commercialDiv select').val(null).trigger('change');

      }
    });

    $('#validationtransfert').change(function() {

      if ($(this).prop('checked')) {


        $('#caisseDiv').show();
      } else {
        // If no, hide the div
        $('#caisseDiv').hide();
        $('#caisseDiv select').val(null).trigger('change');

      }
    });
  });

  $(function() {
    $(".log").on("mouseover", function() {
      //alert('')
      idlogin = $("#login").val();
      $.ajax({
        type: "GET",
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Users', 'action' => 'getlogin']) ?>",
        dataType: "JSON",
        data: {
          login: idlogin,
        },
        success: function(response) {
          //  console.log(data);
          //alert(response.ligne)
          t = response.ligne;
          if (t == 1) {
            alert(
              " Login est déjà utilisé , Veuillez vous choisir un autre login"
            );
            return false;
          }
        },
      });
    });
  });
</script>