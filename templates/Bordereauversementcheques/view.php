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
  <h1>
    Consultation Bordereau versement cheque
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index/'.$bordereauversementcheque->type]); ?>"><i class="fa fa-reply"></i>
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
                echo $this->Form->control('numero', ['readonly', 'label' => 'Numero']);
                ?>
                <?php
                echo $this->Form->control('date', ['readonly', 'label' => 'Du', 'class' => 'form-control']);
                ?>
                 <?php
               // echo $this->Form->control('dateimp', ['readonly', 'label' => 'Date impression', 'class' => 'form-control']);
                ?>
              </div>
              <div class="col-xs-6">

                <?php echo $this->Form->control('compte_id', ['disabled' => true, 'id' => 'client', 'options' => $comptes, 'empty' => 'Veuillez choisir !!', 'label' => 'Comptes', 'class' => 'form-control select2 control-label']); ?>

                <?php
               // echo $this->Form->control('datefin', ['readonly', 'label' => 'Au', 'class' => 'form-control']);
                ?>
              </div>
            </div>
          </div>

          <section class="content" style="width: 99%">
            <div class="row">
              <div class="box box-primary">

                <div class="panel-body">
                  <div class="table-responsive ls-table">
                    <div class="panel-body">
                      <table class="table table-bordered table-striped table-bottomless" id="addtable" style="width:90%"
                        align="center">
                        <thead>
                          <tr>

                            <td align="center" nowrap="nowrap">Num Chéque</td>
                            <td align="center" nowrap="nowrap">Banque</td>
                            <td align="center" nowrap="nowrap">Client</td>
                            <td align="center" nowrap="nowrap">Montant</td>
                            <td align="center" nowrap="nowrap"></td>

                          </tr>
                        </thead>
                        <tbody>
                        <?php $i=0;
                          //debug($lignebordereauversementcheques);die;
                          foreach ($lignebordereauversementcheques as $i => $lg) {
                            
                            $piece = $connection->execute('SELECT piecereglementclients.id as idp,piecereglementclients.num,piecereglementclients.montant,piecereglementclients.echance,banques.name ,reglementclients.id as idr,reglementclients.client_id as idc,clients.Raison_Sociale as rs  FROM piecereglementclients,reglementclients,banques,clients WHERE piecereglementclients.reglementclient_id=reglementclients.id and reglementclients.client_id=clients.id and  piecereglementclients.banque_id=banques.id and  piecereglementclients.id=' . $lg['piecereglementclient_id'] . ';')->fetchAll('assoc');

                            ?>
    
                                <tr class="tr">
                                  <td><?php echo $piece[0]['num']  ?></td>
                                  <td><?php echo $piece[0]['name'] ?></td>
    
                                  <td><?php echo $piece[0]['rs'] ?></td>
                                  <td><?php echo $piece[0]['montant'] ?></td>  
                         
                         
                                <td> <?php echo $this->Form->input('coffre', ['disabled'=>true,'checked','label'=>'', 'value' => @$piece[0]['idp'], 'id' => 'coffre' . $i, 'table' => 'lignebordereauversementcheques', 'name' => 'data[lignebordereauversementcheques][' . $i . '][coffre_id]', 'type' => 'checkbox']); ?>
                                </td>
                              </tr>
                      
                          <?php }?>

                        </tbody>
                      </table>
                      <input type="hidden" value="<?php echo $i; ?>" id="index" />
                    </div>
                  </div>
                </div>
              </div>
            </div>


          </section>
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
    $('#controleagence').on('click', function() {

      compte_id = $('#client').val();
      //alert(id)
      date = $('#date').val();
      total = $('#total').val();
      nom = $('#name').val();
      numero = $('#numero').val();
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
      // if (total == "") {
      //   alert('Ajouter Total ', function () { });
      //   return false;
      // }

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