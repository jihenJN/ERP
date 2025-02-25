<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Agence $agence
 */
?>
<?php echo $this->Html->css('select2'); ?>
<?php

use Cake\Datasource\ConnectionManager;

$connection = ConnectionManager::get('default');

?>
<?php echo $this->Html->script('salma'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<section class="content-header">
  <?php if ($type == 2) { ?>
    <h1>
      Ajout Bordereau versement chéque
    </h1>
  <?php } else { ?>
    <h1>
      Ajout Bordereau versement traite
    </h1>
  <?php } ?>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index/' . $type]); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?>
      </a></li>
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
        <?php echo $this->Form->create($bordereauversementcheque, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]); ?>
        <div class="box-body">
          <div class="row">
            <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
              <div class="col-xs-6">
                <?php
                echo $this->Form->control('numero', ['readonly', 'label' => 'Numero', 'value' => $mm]);
                echo $this->Form->control('type', ['readonly','type'=>'hidden', 'label' => 'Type', 'value' => $type]);

                ?>
                <?php
                echo $this->Form->control('date', ['id' => 'date', 'value' => @$date, 'label' => 'Du', 'class' => 'form-control date']);
                ?>
                <?php
                echo $this->Form->control('dateimp', ['type' => 'date', 'value' => @$dateimp, 'label' => 'Date impression', 'class' => 'form-control']);
                ?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Form->control('situation', ['value' => @$stituation, 'type' => 'hidden', 'id' => 'situation', 'empty' => 'Veuillez choisir !!', 'label' => 'situation', 'class' => 'form-control  control-label']); ?>

                <?php echo $this->Form->control('compte_id', ['value' => @$compte_id, 'id' => 'client', 'options' => $comptes, 'empty' => 'Veuillez choisir !!', 'label' => 'Comptes', 'class' => 'form-control select2 control-label']); ?>

                <?php
                echo $this->Form->control('datefin', ['type' => 'date', 'value' => @$datefin, 'label' => 'Au', 'class' => 'form-control date']);
                ?>
              </div>
            </div>
          </div>
          <?php if ($compte_id != null) { ?>
            <section class="content" style="width: 99%">
              <div class="row">
                <div class="box box-primary">
                  <div class="box-header with-border">


                  </div>
                  <div class="panel-body">
                    <div class="table-responsive ls-table">
                      <div class="panel-body">
                        <table class="table table-bordered table-striped table-bottomless" id="addtable" style="width:90%"
                          align="center">
                          <thead>
                            <tr>
                              <td hidden align="center" nowrap="nowrap">id</td>

                              <td align="center" nowrap="nowrap">Num Chéque</td>
                              <td align="center" nowrap="nowrap">Banque</td>
                              <td align="center" nowrap="nowrap">Client</td>
                              <td align="center" nowrap="nowrap">Montant</td>
                              <td align="center" nowrap="nowrap"><button type="button" class="plus" hidden><i class="fa fa-plus" aria-hidden="true"></i></button><button type="button" class="moin"><i class="fa fa-minus" aria-hidden="true"></i></button>
                              </td>

                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($aas as $i => $v) {
                              $clients = $connection->execute('SELECT *  FROM clients WHERE id=' . $v->reglementclient->client_id . ';')->fetchAll('assoc');
                            ?>
                              <tr class="tr">
                                <td hidden>
                                  <?php echo $this->Form->input('piecerglementclient_id', ['label' => '', 'value' => @$v['id'], 'id' => 'piecerglementclient_id' . $i, 'table' => 'lignebordereauversementcheques', 'name' => 'data[lignebordereauversementcheques][' . $i . '][piecereglementclient_id]', 'type' => 'text']); ?>
                                </td>
                                <td><?php echo $v['num'] ?></td>
                                <td><?php echo $v->banque->name ?></td>

                                <td><?php echo $clients['0']['Raison_Sociale'] ?></td>
                                <td><?php echo $v['montant'] ?></td>
                                <td> <?php echo $this->Form->input('coffre', ['checked', 'label' => '', 'value' => @$v['id'], 'id' => 'coffre' . $i, 'table' => 'lignebordereauversementcheques', 'name' => 'data[lignebordereauversementcheques][' . $i . '][coffre_id]', 'type' => 'checkbox']); ?>
                                </td>
                              </tr>
                            <?php } ?>


                          </tbody>
                        </table>
                        <input type="hidden" value="<?php echo $i ?>" id="index" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>


            </section>
          <?php } ?>
          <button type="submit" class="pull-right btn btn-success" id="controleagence"
            style="margin-right:48%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
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
<script>
  $(function() {
    $('.plus').on('click', function() {
      index = $('#index').val();
      for (i = 0; i <= index; i++) {
        $('#coffre' + i).prop('checked', true);
      }
      $('.plus').hide();
      $('.moin').show();
    });

    $('.moin').on('click', function() {
      index = $('#index').val();
      for (i = 0; i <= index; i++) {
        $('#coffre' + i).prop('checked', false);
      }
      $('.plus').show();
      $('.moin').hide();
    });

    $('#client').on('change', function() {

      compte_id = $('#client').val();
      //alert(id)
      date = $('#date').val();
      datefin = $('#datefin').val();
      datefin = $('#dateimp').val();
      if (date == "") {
        alert('Ajouter le date debut', function() {});
        return false;
      } else if (datefin == "") {
        alert('Ajouter le date fin', function() {});
        return false;
      } else if (dateimp == "") {
        alert('Ajouter le date Impression', function() {});
        return false;
      } else {
        window.location.href = '/ERP/bordereauversementcheques/add/' + compte_id + '/' + date + '/' + datefin + '/' + dateimp; // Ajoute un paramètre à l'URL

      }


    });
    $('.date').on('change', function() {

      compte_id = $('#client').val();
      //alert(id)
      date = $('#date').val();
      datefin = $('#datefin').val();
      dateimp = $('#dateimp').val();
      if (compte_id == "") {
        alert("veuillez choisir le compte");
        return false;
      } else if (date == "") {
        alert('Ajouter le date debut', function() {});
        return false;
      } else if (datefin == "") {
        alert('Ajouter le date fin', function() {});
        return false;
      } else if (dateimp == "") {
        alert('Ajouter le date Impression', function() {});
        return false;
      } else {
        window.location.href = '/demo/bordereauversementcheques/add/' + compte_id + '/' + date + '/' + datefin + '/' + dateimp; // Ajoute un paramètre à l'URL

      }


    });
    $('#controleagence').on('mousemove', function() {

      compte_id = $('#client').val();
      //alert(id)
      date = $('#date').val();
      total = $('#total').val();
      nom = $('#name').val();
      numero = $('#numero').val();
      index = $('#index').val();
      if (compte_id == "") {
        alert("veuillez choisir le compte");

        return false;
      }
      if (nom == "") {
        alert('Ajouter le nom', function() {});
        return false;
      }
      if (date == "") {
        alert('Ajouter le date', function() {});
        return false;
      }
      test = 0;
      if (index >= 0) {
        for (i = 0; i <= index; i++) {
          coffre = $('#coffre' + i).val();
          if ($('#coffre' + i).prop('checked')) {
            test++;
          }
        }
        if (test == 0) {
          alert('Choisir une piece du reglement ', function() {});
          return false;
        }

      }

    });
  });
</script>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(".select2").select2({});
</script>
<?php $this->end(); ?>