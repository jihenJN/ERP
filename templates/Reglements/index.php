<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php //echo $this->Html->script('salma'); 
?>
<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Reglement[]|\Cake\Collection\CollectionInterface $reglements
 */
?>
<!-- Content Header (Page header) -->
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_achat' . $abrv);
// debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'reglements') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  // debug($liens);die;
}

if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'Add'], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php } ?>
<br><br><br>
<section class="content-header">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
  <h1>
    Recherche
  </h1>
</section>
<section class="content" style="width: 99%" style="background-color: white ;">
  <div class="box">
    <div class="box-header">
    </div>
    <div class="box-body">
      <div class="row">
        <?php echo $this->Form->create($cmd, ['id' => 'searchForm', 'type' => 'get']); ?>
        <div class="col-xs-3">
          <?php

          echo $this->Form->control('datedebut', array('label' => 'Date debut', 'value' => $this->request->getQuery('datedebut'), 'id' => 'datedebut', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
          ?>
        </div>

        <div class="col-xs-3">
          <?php
          echo $this->Form->control('datefin', array('label' => 'Date fin', 'value' => $this->request->getQuery('datefin'), 'id' => 'datefin', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
          ?>
        </div>
        <div class="col-xs-3">
          <?php
          echo $this->Form->control('fournisseur_id', ['label' => 'Fournisseur', 'value' => $this->request->getQuery('fournisseur_id'), 'id' => 'fournisseur_id', 'class' => 'form-control select2', 'empty' => 'Veuillez choisir !!']); ?>

        </div>
        <!-- <div class="col-xs-6">
          <?php
          //   echo $this->Form->control('pointdevente_id', ['label' => 'Point De Vente', 'value' => $this->request->getQuery('pointdevente_id'), 'class' => 'select2 form-control', 'empty' => 'Veuillez choisir !!']); 
          ?>

        </div> -->
        <div class="col-xs-1">
          <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
            <i class="fa fa-search"></i>
          </button>

        </div>
        <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
          <?php echo $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
        </div>
      </div>
      <!-- <div class="pull-right" style="margin-right:50%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary">Afficher</button>
        <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index'], ['class' => 'btn btn-primary ']) ?>
      </div> -->
      <?php echo $this->Form->end(); ?>
    </div>
    <br>
  </div>
  <!-- </section>
<h1>
  Réglements fournisseur
</h1>
<section class="content"> -->
  <br>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body">
          <table id="example2" class=" table table-bordered table-striped">
            <thead>
              <tr style="background-color: #4DAAA5;">
                <th width="10%" align="center"><?= ('N°') ?></th>
                <th width="10%" align="center"><?= ('Date') ?></th>
                <th width="10%" align="center"><?= ('Fournisseur') ?></th>
                <th width="8%" align="center"><?= ('Montant') ?></th>
                <th width="8%" align="center"><?= ('') ?></th>

                <th width="12%" align="center"><?= ('Actions') ?></th>

              </tr>
            </thead>

            <tbody>
              <?php foreach ($cmd as $reglement) : ?>
                <tr>
                  <td><?= h($reglement->numeroconca) ?></td>
                  <td width="15.3%"><?=
                                    $this->Time->format(
                                      $reglement->Date,
                                      'dd/MM/y'
                                    );
                                    ?></td>
                  <td><?= h($reglement->fournisseur->name) ?></td>



                  <td><?= $reglement->Montant; ?></td>


                  <td align="center">
                    <!-- <div style="margin-right: 2px;">
                                            <a onclick="openWindow(1000, 1000, wr+'reglementclients/imprimret/<?= $reglement->id ?>')">
                                                <button class="btn btn-xs btn-primary">
                                                    <i class="fa fa-print"></i>
                                                </button>
                                            </a>


                                        </div>  -->
                    <div style="margin-right: 10px;">
                      <button class="btn btn-sm btn-primary" type="button" style="margin-left:10%;" title="mode" onClick="openWindow(1000, 1000, wr+'reglements/modepaie/<?php echo $reglement->id ?>');" champ="orderr" value="0">
                        Mode Paiement
                      </button>
                    </div>
                  </td>
                  <td class="actions text" align="center">
                    <a onclick="openWindow(1000, 1000, '/ERP/reglements/imprimeview/<?= $reglement->id ?>')">
                      <button class="btn btn-xs btn-primary" style="background-color: #940c89; border-color: #940c89;">
                        <i class="fa fa-print"></i>
                      </button>
                    </a>

                    <!-- <div style="margin-right: 2px;">
                                                <a onclick="openWindow(1000, 1000, '/totenroulour/reglements/imprimeview/<?= $type ?>/<?= $bonlivraison->id ?>')">
                                                    <button class="btn btn-xs btn-primary" style="background-color: #940c89; border-color: #940c89;">
                                                        <i class="fa fa-print"></i>
                                                    </button>
                                                </a>


                                            </div> -->
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $reglement->id), array('escape' => false)); ?>
                    <?php //if ($edit == 1) {
                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $reglement->id), array('escape' => false));
                    // } 
                    ?>
                    <?php //if ($delete == 1) {
                    echo $this->Form->postLink("<button class='btn btn-xs btn-danger deletecon'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $reglement->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $reglement->id));
                    //} 
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

<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(".deletecon").on("click", function() {
    return confirm("voulez vous supprimer cet enregistrement !!");
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // const numeroInput = document.querySelector('input[name="numero"]');
    const datedebutInput = document.getElementById('datedebut');
    const datefinInput = document.getElementById('datefin');
    const fournisseurIdSelect = document.getElementById('fournisseur_id');

    // const numerofInput = document.querySelector('input[name="facturefournisseur"]');

    const searchForm = document.getElementById('searchForm');

    console.log('DOM entièrement chargé');

    if (datedebutInput && datefinInput && fournisseurIdSelect && searchForm) {
      console.log('Éléments de formulaire trouvés');

      // Fonction pour soumettre le formulaire
      function submitForm() {
        searchForm.submit();
      }

      // Événement pour soumettre le formulaire lorsqu'Entrée est pressé
      searchForm.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && (e.target !== datedebutInput || e.target !== datefinInput)) {
          e.preventDefault();
          submitForm();
        }
      });

      // Événement pour soumettre le formulaire lorsqu'un changement est apporté au fournisseurIdSelect
      fournisseurIdSelect.addEventListener('change', function() {
        submitForm();
      });
    } else {
      console.log('Éléments de formulaire non trouvés');
    }
  });
</script>
<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': false,
      'ordering': false,
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
<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>

<?php $this->end(); ?>