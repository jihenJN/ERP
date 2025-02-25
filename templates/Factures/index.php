<section class="content-header">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
</section>
<?php echo $this->Html->css('select2'); ?>
<?php echo $this->Html->script('salma'); ?>
<?php

use Cake\Datasource\ConnectionManager;
?>

<section class="content-header">
  <header>

    <?php if ($typefact == 1) { ?>
      <h1 style="text-align:center;"> Factures Services</h1>
    <?php } ?>

    <?php if ($typefact == 0) { ?>
      <h1 style="text-align:center;"> Factures </h1>
    <?php } ?>
  </header>
</section>
<?php
$add = "";
$edit = "";
$delete = "";
$view = "";
$session = $this->request->getSession();
$abrv = $session->read('abrvv');
$lien = $session->read('lien_achat' . $abrv);
//debug($lien);die;
foreach ($lien as $k => $liens) {
  if (@$liens['lien'] == 'factures') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>

  <?php if ($typefact == 0) { ?>
    <!-- <div class="pull-left" style="margin-left:25px;margin-top: 20px">

<?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $typef . '/' . $typefact], ['class' => 'btn btn-success btn-sm']) ?>
</div> -->

  <?php } ?>

  <?php //if ($typefact == 1) { 
  ?>
  <!-- <div class="pull-left" style="margin-left:25px;margin-top: 20px">

      <?php //echo $this->Html->link(__('Ajouter'), ['action' => 'addservice/' . $typef . '/' . $typefact], ['class' => 'btn btn-success btn-sm']) 
      ?>
    </div> -->
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">

    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $typef . '/' . $typefact], ['class' => 'btn btn-success btn-sm']) ?>
  </div>

  <?php // } 
  ?>
<?php } ?>
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

      <?php echo $this->Form->create($factures, ['id' => 'searchForm', 'type' => 'get']); ?>


      <div class="row">
        <div class="col-xs-2">
          <?php

          echo $this->Form->control('datedebutfacture', array('label' => 'Date debut facture', 'value' => $this->request->getQuery('datedebutfacture'), 'id' => 'datedebutfacture', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control', 'type' => 'date'));
          ?>
        </div>

        <div class="col-xs-2">
          <?php
          echo $this->Form->control('datefinfacture', array('label' => 'Date fin facture', 'value' => $this->request->getQuery('datefinfacture'), 'id' => 'datefinfacture', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'date'));
          ?>
        </div>
        <div class="col-xs-2">
          <?php
          echo $this->Form->control('numero', array('value' => $this->request->getQuery('numero'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control ', 'type' => 'text'));
          ?>
        </div>
        <div class="col-xs-2">
          <?php
          echo $this->Form->control('fournisseur_id', ['label' => 'Fournisseur ', 'options' => $fournisseurs, 'value' => $this->request->getQuery('fournisseur_id'), 'empty' => 'Veuillez choisir !!', 'class' => 'select2 form-control']); ?>
        </div>


        <div class="col-xs-6" hidden>
          <?php
          echo $this->Form->input('depot_id', array('label' => 'Depot', 'empty' => 'Veuillez choisir !!', 'options' => $depots, 'value' => $this->request->getQuery('depot_id'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2'));
          ?>
        </div>


        <div class="col-xs-2" hidden>
          <?php
          echo $this->Form->control('facturefournisseur', array('value' => $this->request->getQuery('facturefournisseur'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control '));
          ?>
        </div>
        <div class="col-xs-1">
          <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
            <i class="fa fa-search"></i>
          </button>

        </div>
        <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
          <?php echo $this->Html->link(__(''), ['action' => 'index/' . $typef . '/' . $typefact], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
        </div>
      </div>
      <!-- <div class="pull-right" style="margin-right:40%;margin-top: 20px;">
        <button type="submit" class="btn btn-primary ">Afficher</button>
        <?php //echo $this->Html->link(__('Afficher Tous'), ['action' => 'index/' . $typef . '/' . $typefact], ['class' => 'btn btn-primary ']) 
        ?>

      </div> -->
      <?php echo $this->Form->end(); ?>

    </div>

    <br>
  </div>
  <br>

  <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>

          <tr style="background-color: #4DAAA5;">
            <th hidden scope="col">
              <?= h('id') ?>
            </th>
            <th scope="col">
              <?= h('Numéro') ?>
            </th>
            <th scope="col">
              <?= h('Date') ?>
            </th>
            <th scope="col">
              <?= h('Fournisseur') ?>
            </th>
            <!-- <th scope="col">
                <?= h('N° Fac Fournisseur') ?>
              </th>
              <th scope="col">
                <?= h('Date Facture fournisseur') ?>
              </th> -->
            <th scope="col">
              <?= h('Montant') ?>
            </th>

            <th hidden scope="col">Validation</th>
            <th scope="col" hidden><?= h('Etat') ?></th>

            <th scope="col"><?= h('Avoir') ?></th>



            <th scope="col" class="actions text-center">
              <?= __('Actions') ?>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php //debug($factures->toarray());
          foreach ($factures as $i => $facture) :



            /*****************************************************************/


            $connection = ConnectionManager::get('default');
            $id = $facture->id;

            $commandeTotQte = 0;
            $BLTotQte = 0;

            if (!empty($id)) {
              $commandeTotQteResult = $connection->execute(
                'SELECT SUM(qte) AS sommeqtecmd FROM lignefactures WHERE facture_id = :facture_id',
                ['facture_id' => $id]
              )->fetch('assoc');
              $commandeTotQte = !empty($commandeTotQteResult['sommeqtecmd']) ? $commandeTotQteResult['sommeqtecmd'] : 0;
            }

            if (!empty($id)) {
              $bls = $connection->execute(
                'SELECT id FROM factureavoirfrs WHERE facture_id = :facture_id',
                ['facture_id' => $id]
              )->fetchAll('assoc');

              if (!empty($bls)) {
                $blsIds = array_column($bls, 'id');
                $blsIdsString = implode(',', $blsIds);

                $BLTotQteResult = $connection->execute(
                  'SELECT SUM(quantite) AS sommeqtebl FROM lignefactureavoirfrs WHERE factureavoirfr_id IN (' . $blsIdsString . ')'
                )->fetch('assoc');
                $BLTotQte = !empty($BLTotQteResult['sommeqtebl']) ? $BLTotQteResult['sommeqtebl'] : 0;
              }
            }
          ?>


            <tr>
              <td hidden>
                <?php echo $this->Form->control('id', ['index' => $i, 'id' => 'id' . $i, 'value' => $facture->id, 'label' => '', 'champ' => 'id', 'type' => 'hidden', 'class' => 'form-control']); ?>
                <?php //echo $this->Form->control('tre', ['index' => $i, 'id' => 'paiement_id' . $i, 'value' => $facture->paiement_id, 'label' => '', 'champ' => 'paiement_id','multiple'=>true, 'type' => 'hidden', 'class' => 'form-control']); 
                ?>
              </td>
              <td>
                <?= h($facture->numero) ?>
              </td>
              <td>
                <?php echo $this->Time->format($facture->date, 'dd/MM/y HH:mm:ss'); ?>
              </td>
              <td>
                <?= h($facture->fournisseur->name) ?>
              </td>
              <!-- <td style="text-align:center">
                  <?= h($facture->facturefournisseur) ?>
                </td> -->
              <!-- <td style="text-align:center">
                  <?php echo ($this->Time->format($facture->datefournisseur, 'dd/MM/y HH:mm:ss')); ?>
                </td> -->
              <td style="text-align:right">
                <?php echo sprintf("%01.3f", $facture->ttc + $timbre) ?>
              </td>
              <td hidden style="text-align:center">
                <?php if ($facture->valide != 1) { ?>
                  <!-- <button class="validate btn btn-xs btn-primary" onclick="validateRecord(<?= $facture->id ?>)">
                    <i class="fa fa-check"></i>
                  </button> -->

                  <?php if ($validationfactureachat == 1) { ?>
                    <button class="btn btn-success btn-xs glyphicon glyphicon-check opendialogcycle" index=<?php echo $i ?> id="<?php echo '' ?>"></button>
                  <?php } ?>
                <?php } else {
                  echo 'Validée';
                }
                ?>

              </td>
              <td width="14%" align="center" hidden>
                <?php
                if ($BLTotQte > 0 && $BLTotQte == $commandeTotQte) {
                  echo '<button class="btn btn-sm custom-button" style="background-color: #54A74D; color: white;">Livré</button>';
                } elseif ($BLTotQte == 0) {
                  echo '<button class="btn btn-sm custom-button" style="background-color: #F55C43; color: white;">En cours</button>';
                } elseif ($BLTotQte > 0 && $BLTotQte < $commandeTotQte) {
                  echo '<button class="btn btn-sm custom-button" style="background-color: #F99048; color: white;">Livré Partiel</button>';
                } else {
                  echo '<button class="btn btn-sm custom-button" style="background-color: #F55C43; color: white;">En cours</button>';
                }
                ?>
              </td>

              <td align="center">

                <?php
                if ($BLTotQte != $commandeTotQte) { ?>

                  <button
                    class="btn btn-xs btn-dark"
                    style="background-color: black;"
                    onclick="window.open('<?= $this->Url->build(['controller' => 'Factureavoirfrs', 'action' => 'addfactureavoir', $facture->id]) ?>', '_blank');">
                    <i class="fa fa-plus" style="color: white;"></i>
                  </button>
                <?php //   echo $this->Html->link(
                  //     "<button class='btn btn-xs btn-dark' style='background-color: black;'><i class='fa fa-plus' style='color:white;'></i></button>",
                  //     ['controller' => 'Factureavoirfrs', 'action' => 'addfactureavoir', $facture->id],
                  //     ['escape' => false]
                  //   );
                  // 
                }
                ?>
              </td>

              <td class="actions text-center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $facture->id), array('escape' => false)); ?>
                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $facture->id), array('escape' => false)); ?>
                <?php if ($edit == 1  && $BLTotQte == 0) {
                  echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $facture->id), array('escape' => false));
                } ?>
                <?php if ($delete == 1 && $BLTotQte == 0) {
                  echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete', $facture->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?', $facture->id));
                } ?>





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

</section>

<div id="dialogcycle" title="Validation">
  <section class="content" style="width: 99%">
    <?php echo $this->Form->create($suivi, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
    ?>


    <!-- Checkbox: Treilles Soudés Obligatoire -->
    <div align=center class="col-xs-12">
      <?php
      echo $this->Form->control('paiement_id', [
        'label' => 'Mode de paiement',
        'required' => 'off',
        'name' => 'paiement_id[]',
        'id' => 'paiement_id',
        'class' => 'form-control',
        'multiple' => true,


      ]);
      ?>
    </div>

    <!-- Checkbox: Autorisation Sans Avance -->
    <div align=center class="col-xs-12">
      <?php
      echo $this->Form->control('commentaireReglement', [
        'type' => 'textarea',
        'id' => 'commentaireReglement',

        'label' => 'Commentaire Réglement'
      ]);
      // echo $this->Form->control('iddialog', ['label' => false, 'class' => 'form-control', 'required' => 'off', 'type' => 'hidden']); 
      ?>

    </div>


  </section>

  <div class="dialog-footer" align="center">
    <!-- <?php echo $this->Form->submit(__('Enregistrer'), ['id' => 'dialogbutton']); ?>
    <?php //echo $this->Html->link("<button index= '" . $i . "' id='view" . $i . "' class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $bonlivraisonusine->id), array('escape' => false)); 
    ?> -->
    <button align="center" type="submit" class="pull-right btn btn-success dialog-footer " id="dialogbutton" style="margin-right:15%;margin-top: 20px;margin-bottom:20px;">Enregistrer</button>
  </div>
  <?php echo $this->Form->end(); ?>


</div>

<style type="text/css">
  .ui-dialog {
    z-index: 4000;

  }

  #dialogcycle {
    position: relative;
  }

  .dialog-footer {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 10px;
  }
</style>
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const numeroInput = document.querySelector('input[name="numero"]');
    const datedebutInput = document.getElementById('datedebutfacture');
    const datefinInput = document.getElementById('datefinfacture');
    const fournisseurIdSelect = document.getElementById('fournisseur-id');

    // const numerofInput = document.querySelector('input[name="facturefournisseur"]');

    const searchForm = document.getElementById('searchForm');

    console.log('DOM entièrement chargé');

    if (numeroInput && datedebutInput && datefinInput && fournisseurIdSelect && searchForm) {
      console.log('Éléments de formulaire trouvés');

      // Fonction pour soumettre le formulaire
      function submitForm() {
        searchForm.submit();
      }

      // Événement pour soumettre le formulaire lorsqu'Entrée est pressé
      searchForm.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && (e.target !== numeroInput || e.target !== datedebutInput || e.target !== datefinInput)) {
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

    $("form").submit(function() {
      $('#dialogbutton').attr('disabled', 'disabled');
    })
    $('#dialogbutton').on('mouseover', function() {


      paiement_id = $("#paiement_id").val();
      // alert(paiement_id);
      if (paiement_id == '') {
        alert('Veuillez choisir au moins un mode de paiement !!')
      }
    })

    $('.select2').select2();

    $('#example1').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': false,
      'ordering': false,
      'info': true,
      'autoWidth': false
    })
  })
</script>


<script>
  function validateRecord(recordId) {
    if (confirm('Veuillez confirmer ')) {
      window.location.href = '<?= $this->Url->build(['action' => 'validation']) ?>/' + recordId;
    }
  }

  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>

<?php $this->end(); ?>

<script type="text/javascript">
  $j = jQuery.noConflict();

  $(document).ready(function() {


    $j("#dialogcycle").dialog({
      autoOpen: false,
      width: 500,
      modal: true,

      open: function(event, ui) {
        originalContent = $("#dialogcycle").html();
        $j('.ui-widget-overlay').bind('click', function() {

          $j("#dialogcycle").dialog('close');
          $("#dialogcycle").html(originalContent);

        });
      }

    });
    $j('.opendialogcycle').on('click', function() {

      index = $(this).attr('index');
      id = $('#id' + index).val();
      // alert(index);
      // alert('id' + index);
      // alert(id);



      $('#iddialog').val(id);
      //  $('#paiement_id').select2();

      $j("#dialogcycle").dialog('open');




    });
  });
</script>