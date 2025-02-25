<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Factureavoirfr $factureavoirfr
 * @var \Cake\Collection\CollectionInterface|string[] $utilisateurs
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('hechem'); ?>

<section class="content-header">
  <h1>
    Ajout facture à voir
  </h1>
  <ol class="breadcrumb">
    <?php if ($type == 1) { ?>
      <a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>
    <?php } else if ($type == 2) { ?>
      <a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i> <?php echo __('Retour'); ?></a>
    <?php } ?>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">

        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($factureavoirfrs, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">

          <div class="row">

            <div class="col-md-6">
              <?php
              echo $this->Form->control('numero', ["value" => $numero, 'readonly' => 'readonly']);
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('date', ['empty' => true, 'value' => date("d/m/Y"), 'class' => 'form-control', 'id' => 'date']);

              ?>
            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <?php
              //  echo $this->Form->control('fournisseur_id', ['value' => $fournisseurs, 'empty' => 'Veuillez choisir !!' , 'class'=>'form-control select2 facturefr','id'=>'fournisseur']);

              ?>
              <div class="form-group input text required">
                <?php echo $this->Form->control('fournisseur_id', ['empty' => 'Veuillez choisir !!', 'label' => 'Fournisseur', 'class' => 'select2 form-control  control-label', 'id' => 'fournisseur']); ?>
              </div>
            </div>
            <div class="col-md-6">
              <?php
              /// echo $this->Form->control('depot_id', ['value' => $depots, 'class'=>'form-control select2','id'=>'depot']);
              echo $this->Form->control('depot_id', ['readonly' => 'readonly', 'class' => 'form-control  control-label', 'id' => 'depot_id']); ?>

            </div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <?php
              echo $this->Form->control('totalht', ['class' => 'form-control calculttc ', 'id' => 'ht']);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('tauxtva', ['class' => 'form-control  ', 'value' => '19', 'id' => 'taux', 'readonly' => 'readonly']);

              ?></div>
          </div>

          <div class="row">
            <div class="col-md-6">
              <?php
              echo $this->Form->control('facture_id', ['class' => 'form-control select2 ', 'value' => $factures, 'id' => 'facture', 'empty' => 'Veuillez choisir !!',]);

              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo $this->Form->control('totalttc', ['class' => 'form-control ', 'readonly' => 'readonly', 'id' => 'ttc']);

              ?></div>
          </div>



        </div>
        <br><br>

        <div align="center">
          <button style="margin-bottom: 2% ;" type="submit" class="btn btn-primary avbtn  verifchamp">Enregistrer</button>

        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })



  })
  $('.select2').select2();
  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', {
    'placeholder': 'dd/mm/yyyy'
  })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', {
    'placeholder': 'mm/dd/yyyy'
  })
  //Money Euro
  $('[data-mask]').inputmask()
  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({
    timePicker: true,
    timePickerIncrement: 30,
    format: 'MM/DD/YYYY h:mm A'
  })
</script>
<?php $this->end(); ?>

<style>
  .select2-selection__rendered {
    line-height: 25px !important;
  }

  .select2-container .select2-selection--single {
    height: 35px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #d2d6de !important;

  }

  .select2-selection__arrow {
    height: 34px !important;

  }

  .select2-selection__choice {
    height: 24px !important;
    color: black !important;
    background-color: white !important;
    font-size: 18px !important;
  }

  .select2-container {
    display: block;
    width: auto !important;
  }
</style>

<script>
  $(function() {
    $('.facturefr').on('change', function() {
      ////alert('hello');
      id = $('#fournisseur').val();
      ///alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Factureavoirfrs', 'action' => 'getfacture']) ?>",
        dataType: "json",
        data: {
          id: id,
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          //alert(data['ligne']['valeur']);
          $('#facture').html(data.select);
        }
      })
    });



    $('.select2').select2();
  });

  /**************** */

  $(document).ready(function() {
    $('#fournisseur').on('change', function() {
      var fournisseurId = $(this).val();
      // alert(fournisseurId);
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Factures', 'action' => 'rectype']) ?>",
        dataType: "JSON",
        data: {
          fournisseurId: fournisseurId,
        },
        success: function(data) {
          var typeFournisseurId = data.typeFournisseurId;
          //alert
          // Mettez à jour le champ #depot_id en fonction de typeFournisseurId
          if (typeFournisseurId === 4) {
            $('#depot_id').removeAttr('readonly');
            $('#depot_id').val(8);
          } else {
            $('#depot_id').removeAttr('readonly');
            $('#depot_id').val(7);
          }

          // Chargez la liste d'articles en fonction de typeFournisseurId
          // $.ajax({
          //     method: "GET",
          //     url: "<?= $this->Url->build(['controller' => 'Factures', 'action' => 'chargerArticles']) ?>",
          //     dataType: "JSON",
          //     data: {
          //         typeFournisseurId: typeFournisseurId
          //     },
          //     success: function(data) {
          //         var $articleSelect = $('.articleajax');
          //         $articleSelect.empty();
          //         $articleSelect.append($('<option value="" selected="selected" disabled>Veuillez choisir !!</option>'));

          //         $.each(data.articles, function(key, value) {
          //             $articleSelect.append($('<option>', {
          //                 value: value.id,
          //                 text: value.Code + ' ' + value.Dsignation
          //             }));
          //         });
          //     },
          //     error: function() {
          //         console.log('Erreur lors de la récupération de la liste des articles');
          //     }
          // });
        }
      });
    });
  });
</script>