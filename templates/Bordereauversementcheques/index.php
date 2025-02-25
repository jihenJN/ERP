<!-- Content Header (Page header) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php
echo $this->Html->script('salma');
?>
<section class="content-header">
  <?php if ($type == 2) { ?>
    <h1>
      <?php echo __('Bordereau Chéques'); ?>

    </h1><br>
  <?php } else { ?>
    <h1>
      <?php echo __('Bordereau Traites'); ?>

    </h1><br>
  <?php } ?>
  <?php

  use Cake\Datasource\ConnectionManager;

  $connection = ConnectionManager::get('default');
  $add = "";
  $edit = "";
  $delete = "";
  $view = "";
  $session = $this->request->getSession();
  $abrv = $session->read('abrvv');
  $lien = $session->read('lien_finance' . $abrv);

  foreach ($lien as $k => $liens)
  //debug($liens['lien']);
  {
    if (@$liens['lien'] == 'agences') {

      $add = $liens['ajout'];
      $edit = $liens['modif'];
      $delete = $liens['supp'];
    }
    //debug($liens);die;
  }

  //if ($add == 1) { 
  ?>

  <div class="pull-left"><?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $type], ['class' => 'btn btn-success btn-xs']) ?></div>
</section>
<?php  //} 
?>

<br> <br><br>


<section class="content-header">
  <h1>
    Recherche
  </h1>
</section>
<section class="content" style="width: 99%">
  <div class="box">
    <div class="box-header">
    </div>

    <div class="box-body">
      <div class="row">

        <?php echo $this->Form->create($bordereauversementcheques, ['type' => 'get']); ?>

        <div class="col-xs-6">
          <label>Date Début</label>

          <?php

          echo $this->Form->input('datedebut', array('label' => 'Date debut', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'class' => 'form-control', 'type' => 'date'));
          ?>
        </div>

        <div class="col-xs-6">
          <label>Date Fin</label>

          <?php
          echo $this->Form->input('datefin', array('label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'class' => 'form-control ', 'type' => 'date'));
          ?>
        </div>

        <div class="col-xs-6">

          <?php
          echo $this->Form->control('compte_id', ['label' => 'Compte', 'value' => $this->request->getQuery('compte_id'),  'empty' => 'Choisir client !!', 'id' => 'compte_id', 'class' => 'form-control select2']); ?>


        </div>
        <div class="col-xs-6">

          <?php
          echo $this->Form->control('bordereauversementcheque_id', ['label' => 'Numéro', 'options' => $bordereaus, 'value' => $this->request->getQuery('bordereauversementcheque_id'),  'empty' => 'Choisir Numéro !!', 'id' => 'bordereauversementcheque_id', 'class' => 'form-control select2']); ?>


        </div>
        <div class="col-xs-6">

          <?php
          echo $this->Form->control('montant', ['label' => 'Montant', 'value' => $this->request->getQuery('montant'),  'id' => 'montant', 'class' => 'form-control ']); ?>


        </div>
        <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary btn-sm">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index/' . $type], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>



      </div>







      <?php echo $this->Form->end(); ?>
    </div>
  </div>
</section>
<!-- Main content -->
<section class="content-header">
  <h1>
    Bordereau versement chéques
  </h1>
</section>




<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th width="10%" align="center"><?= ('Numero') ?></th>
                <th width="10%" align="center"><?= ('Compte') ?></th>
                <th width="10%" align="center"><?= ('Date debut') ?></th>
                <th width="10%" align="center"><?= ('Date fin') ?></th>
                <th width="10%" align="center"><?= ('Montant total') ?></th>
                <th width="10%" align="center"><?= ('Nomberpiece') ?></th>
                <th width="10%" align="center"><?= ('Situation') ?></th>
                <th width="10%" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($bordereauversementcheques as $i => $agence):

                $ag = $connection->execute('SELECT *  FROM agences WHERE id=' . $agence->compte->agence_id . ';')->fetchAll('assoc');
                $montant = $connection->execute('SELECT sum(montant) as m  FROM lignebordereauversementcheques WHERE bordereauversementcheque_id=' . $agence->id . ';')->fetchAll('assoc');
                //echo $montant[0]['m'];
              ?>
                <tr>
                  <td>
                    <?= h($agence->numero) ?>
                  </td>

                  <td>
                    <?= h($agence->compte->numero . '-' . $ag[0]['name']) ?>
                  </td>
                  <td><?php echo $this->Time->format(
                        $agence->date,
                        'dd/MM/y'
                      ) ?></td>
                  <td><?php echo $this->Time->format(
                        $agence->datefin,
                        'dd/MM/y'
                      ) ?></td>
                  <td>
                    <?= h(number_format(abs($montant[0]['m']), 3, ',', ' ')); ?>
                  </td>
                  <td>
                    <?= h($agence->Nomberpiece) ?>
                  </td>
                  <td>
                    <?= h($agence->situation) ?>
                  </td>
                  <td class="actions text" align="center">
                    <?php
                    $basePath = $this->request->getAttribute('base');
                    ?>

                    <a onclick="openWindow(1000, 1000, '<?= $basePath ?>/Bordereauversementcheques/imprimer/<?php echo $agence->id; ?>')"><button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button></a>

                    <?php //echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $agence->id), array('escape' => false)); 
                    ?>
                    <?php //if ($edit == 1) { 
                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $agence->id), array('escape' => false)); //}
                    ?>
                    <?php //if ($delete == 1) { 
                    echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $agence->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $agence->id)); ?>
                    <!-- <button index='<?php echo $i ?>' class='btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button> -->
                    <?php //} 
                    ?>
                  </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>


<script>
  $('.select2').select2();
</script>
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>
<?php $this->end(); ?>