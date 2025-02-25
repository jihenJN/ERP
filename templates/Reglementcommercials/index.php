<?php echo $this->fetch('script'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('salma'); ?>
<?php echo $this->Html->css('select2'); ?>

<section class="content-header">
  <header>
    <h1 style="text-align:center;"> Reglement commercial
    </h1>
  </header>
</section>

<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_commercialmenus' . $abrv);
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'reglementcommercial') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php  } ?>

<br> <br><br>
<section class="content-header">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <h1>
    Recherche
  </h1>
</section>
<section class="content" style="width: 99%" style="background-color: white ;">
  <div class="box">
    <div class="box-body">
      <div class="row">




        <?php echo $this->Form->create($reglementcommercials, ['type' => 'get']);
        // debug($reglementcommercials);
        ?>
        <div class="row">
          <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">

            <div class="col-xs-6">
              <?php echo $this->Form->control('numero', ['required' => 'off', 'label' => 'Numero', 'value' => $this->request->getQuery('numero'), 'autocomplete' => 'off']); ?>


            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('commercial_id', ['label' => 'Commercial', 'class' => 'select2 form-control ', 'empty' => 'Veuillez choisir !!', 'value' => $this->request->getQuery('commercial_id')]); ?>

            </div>
          </div>
        </div>
        <div class="row">
          <div style=" margin: 0 auto;  margin-left: 20px; margin-right: 20px; position: static; ">
            <!--                        <div class="col-xs-6">
                            <?php
                            //echo $this->Form->control('datetime', ['label' => 'date', 'class' => 'form-control', 'required' => 'off', 'value' => $this->request->getQuery('datetime')]);
                            ?>
                        </div>-->
          </div>
        </div>
        <div class="pull-right" style="margin-right:44%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary ">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary ']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
</section>






<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>


                <th><?php echo ('Numero') ?></th>
                <th><?php echo ('Date') ?></th>
                <th><?php echo ('Commercial') ?></th>
                <th><?php echo ('Montant regle') ?></th>
                <th class="actions"><?= __('Actions') ?>





              </tr>
            </thead>
            <tbody>
              <?php foreach ($reglementcommercials as $reglementcommercial) :
                // debug($reglementcommercial->date);
              ?>
                <tr>
                  <td><?= h($reglementcommercial->numero) ?></td>
                  <td><?php echo
                      $this->Time->format(
                        $reglementcommercial->date,
                        'd/MM/y H:m:s'
                      );
                      ?></td>
                  <td><?= h($reglementcommercial->commercial->name) ?></td>
                  <td><?= $reglementcommercial->paiement->name ?></td>
                  <td align="center">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $reglementcommercial->id), array('escape' => false)); ?>
                    <?php if ($edit == 1) {
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $reglementcommercial->id), array('escape' => false));
                    } ?>
                    <?php if ($delete == 1) {
                      echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $reglementcommercial->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # %s?', $reglementcommercial->id));
                    }  ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>


        </div>

      </div>

    </div>
  </div>
</section>


























<!--<div class="reglementcommercials index content">
    
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('commercial_id') ?></th>
                    <th><?= $this->Paginator->sort('paiement_id') ?></th>
                   
                </tr>
            </thead>
            <tbody>
<?php foreach ($reglementcommercials as $reglementcommercial) : ?>
                                                            <tr>
                                                                <td><?= $this->Number->format($reglementcommercial->id) ?></td>
                                                                <td><?= $this->Number->format($reglementcommercial->commercial_id) ?></td>
                                                                <td><?= $reglementcommercial->has('paiement') ? $this->Html->link($reglementcommercial->paiement->name, ['controller' => 'Paiements', 'action' => 'view', $reglementcommercial->paiement->id]) : '' ?></td>
                                                                <td><?= h($reglementcommercial->date) ?></td>
                                                                <td class="actions">
    <?= $this->Html->link(__('View'), ['action' => 'view', $reglementcommercial->id]) ?>
    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $reglementcommercial->id]) ?>
    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $reglementcommercial->id], ['confirm' => __('Are you sure you want to delete # {0}?', $reglementcommercial->id)]) ?>
                                                                </td>
                                                            </tr>
<?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
<?= $this->Paginator->first('<< ' . __('first')) ?>
<?= $this->Paginator->prev('< ' . __('previous')) ?>
<?= $this->Paginator->numbers() ?>
<?= $this->Paginator->next(__('next') . ' >') ?>
<?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>-->

<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>

<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }











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
  $('.select2').select2()

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