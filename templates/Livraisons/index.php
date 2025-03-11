<?php echo $this->Html->css('select2'); ?>

<?php

use Cake\Datasource\ConnectionManager;
?>


<?php
$connection = ConnectionManager::get('default');
?>
<section class="content-header">
  <header>
    <h1 style="text-align:center;"> Livraisons Achat</h1>
  </header>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('alert'); ?>
<?php echo $this->Html->script('salma'); ?>

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
  if (@$liens['lien'] == 'livraisons') {
    $add = $liens['ajout'];
    $edit = $liens['modif'];
    $delete = $liens['supp'];
    $valide = $liens['valide'];
    $imp = $liens['imprimer'];
  }
  //debug($liens);die;
}

if ($add == 1) { ?>
  <div class="pull-left" style="margin-left:25px;margin-top: 20px">
    <?php echo $this->Html->link(__('Ajouter'), ['action' => 'add/' . $typebl], ['class' => 'btn btn-success btn-sm']) ?>
  </div>
<?php  } ?>
<br><br><br>

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

        <?php echo $this->Form->create(/*$clients, ['role' => 'form']); */$livraisons, ['id' => 'searchForm', 'type' => 'get']);

        ?>

        <div class="col-xs-3">
          <?php
          echo $this->Form->control('numero', array('value' => $this->request->getQuery('numero'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
          ?>
        </div>

        <div class="col-xs-3">
          <?php
          echo $this->Form->control('fournisseur_id', ['label' => 'Fournisseur ', 'id' => 'fournisseur_id', 'options' => $fournisseurs, 'value' => $this->request->getQuery('fournisseur_id'), 'class' => ' form-control select2', 'empty' => 'Veuillez choisir !!']); ?>
        </div>



        <!-- <div class="col-xs-6">
          <?php
          echo $this->Form->input('numero de commande', array('label' => 'Numero de commande', 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
          ?>
        </div> -->



        <!-- <div class="col-xs-6">
          <?php
          echo $this->Form->control('materieltransport_id', array('value' => $this->request->getQuery('materieltransport_id'), 'label' => 'Materiel de transport', 'empty' => 'Veuillez choisir !!', 'options' => $materieltransports, 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
          ?>
        </div> -->








        <div class="col-xs-6" hidden>
          <?php
          echo $this->Form->control('depot_id', array('label' => 'Depot', 'empty' => 'Veuillez choisir !!', 'options' => $depots, 'value' => $this->request->getQuery('depot_id'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control select2'));
          ?>
        </div>

        <div class="col-xs-3">
          <?php
          echo $this->Form->control('blfournisseur', array('label' => 'N° BL Fournisseur', 'value' => $this->request->getQuery('blfournisseur'), 'div' => 'form-group', 'between' => '<div class="col-sm-10">', 'after' => '</div>', 'class' => 'form-control'));
          ?>
        </div>



        <!-- <div class="pull-right" style="margin-right:40%;margin-top: 20px;">
          <button type="submit" class="btn btn-primary ">Afficher</button>
          <?php echo $this->Html->link(__('Afficher Tous'), ['action' => 'index', $typebl], ['class' => 'btn btn-primary ']) ?>

        </div> -->
        <div class="col-xs-1">
          <button type="submit" style="margin-top: 25px;" class="btn btn-default custom-width-button">
            <i class="fa fa-search"></i>
          </button>

        </div>
        <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
          <?php echo $this->Html->link(__(''), ['action' => 'index/' . $typebl], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
        </div>






        <?php echo $this->Form->end(); ?>
      </div>
    </div>
    <br>
  </div>
  <!-- </section> -->
  <br>

  <input style="display:none" type="textarea" id="result" class='form-control'>



  <!-- <section class="content"> -->
  <div class="box">
    <div class="box-header">
    </div>
    <!-- /.box-header -->
    <div class="box-body">

      <table id="example2" class="table table-bordered table-striped">
        <thead>
          <tr style="background-color: #4DAAA5;">

            <th width="9%" align="center"><?= h('Numero') ?></th>
            <th width="8%" align="center"><?= h('Date') ?></th>
            <th width="11%" align="center"><?= h('N° BC') ?></th>

            <th width="11%" align="center" scope="col"><?= h('Fournisseur') ?></th>
            <th width="11%" align="center" scope="col"><?= h('N° BL Fournisseur') ?></th>
            <th width="11%" hidden align="center" scope="col"><?= h('Depot') ?>
            </th>
            <th width="11%" align="center" scope="col"><?= h('Total TTC') ?></th>

            <th width="11%" align="center" scope="col"><?= h('Facture') ?></th>
            <th width="11%" align="center" scope="col" class="actions text-center"><?= __('Actions') ?></th>
          </tr>
        </thead>
        <tbody>
          <?php $i = -1;
          // debug($livraisons->toarray());
          foreach ($livraisons as $i => $livraison) :





          ?> <tr>

              <td width="11%"><?= h($livraison->numero) ?></td>
              <td width="11%"><?= $this->Time->format(
                                $livraison->date,
                                'dd/MM/y'
                              ); ?></td>

              <td width="11%"><?php
                              if ($livraison->commandefournisseur_id) {
                                $commande = $connection->execute('SELECT * FROM commandefournisseurs where commandefournisseurs.id=' . $livraison->commandefournisseur_id . ';')->fetchAll('assoc');
                              }




                              echo ($commande[0]['numero']) ?></td>
              <td width="11%"><?= h($livraison->fournisseur->name) ?></td>
              <td width="10%"><?= h($livraison->blfournisseur) ?></td>


              <td width="11%" hidden><?= h($livraison->depot->name) ?></td>
              <td width="11%" ><?= h($livraison->ttc) ?></td>


              <td>
                <!--                  <input type="checkbox" value="<?php echo $livraison->livraison_id ?>" id="check<?php echo $i ?>" ligne="<?php echo $i ?>" index="<?php echo $i ?>" class="blfbre" />-->
                <input id="fournisseur_id<?= $i ?>" ligne="<?php echo $i; ?>" class="" type="hidden" value="<?= $livraison->fournisseur_id ?>">
                <input align="center " type="checkbox" id="check<?php echo $i; ?>" value="<?php echo $livraison->id ?>" name="checkbox[]" ligne="<?php echo $i; ?>" class="blfbree" <?php if (!empty($livraison->facture_id)) { ?> style="display:none" <?php } ?> />

              </td>
              <td class="actions" align="center">
                <?php echo $this->Html->link("<button class='btn btn-xs btn-primary'><i class='fa fa-print'></i></button>", array('action' => 'imprimeview', $livraison->id), array('escape' => false)); ?>

                <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $livraison->id), array('escape' => false)); ?>
                <?php if ($edit == 1) {
                  if (empty($livraison->facture_id)) {
                    echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $livraison->id), array('escape' => false));
                  }
                } ?>
                <?php if ($delete == 1) {
                  if (empty($livraison->facture_id)) {
                    echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $livraison->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $livraison->id));
                  }
                } ?>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      <input type="hidden" value="<?php echo $i ?>" id="index2">
      <div class="col-md-12  testcheck" style="display:none;">
        <input type="hidden" name="tes" value="0" class="tespv" />
        <input type="hidden" name="tes" value="0" class="tes" />
        <input type="hidden" name="nombre" value="<?php echo $i ?>" class="nombre" />
        <a href="" class="btn btn btn-danger" id="cammandeaddd"> <i class="fa fa-plus-circle"></i> Créer Une Facture </a>
      </div>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
  </div>
  </div>
</section>


<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>

<script>
  function data_editable_table() {
    'use strict';
    $('#ls-editable-table').dataTable({
      "aaSorting": [
        [0, "desc"]
      ],
      "sPaginationType": "full_numbers"
    })
  }
  $('#cammandeaddd').on('click', function() {

    // var tab = new Array;
    // conteur = $('.nombre').val(); 
    // for (var i = 0; i <= conteur; i++) {
    //   val = ($('#check' + i).attr('checked'));

    //   v = $('#check' + i).val(); 

    //   if ($('#check' + i).is(':checked')) {

    //     tab[i] = v;

    //   }
    // }
    // var removeItem = undefined;
    // tab = jQuery.grep(tab, function(value) {
    //   return value != removeItem;
    // });
    // client = $('.tes').val();
    tab = $('#result').val();

    window.open(wr+"factures/addindirect/" + tab)
    //document.getElementById('cammandeaddd').setAttribute('href', 'http://localhost:8765/Factures/addindirect/' + tab);
    //$(this).attr("href", wr + "Commandeclients/addcommindirect/" + tab)
  });

  // $('.blfbree').on('click', function() {
  //   //alert("fd");
  //   ligne = $(this).attr('ligne');
  //   index = Number($('#index2').val());
  //   test = 0;
  //   //alert(index);
  //   for (i = 0; i <= Number(index); i++) {

  //     if ($('#check' + i).is(':checked')) {
  //       test = test + 1;
  //     }
  //   }
  //   if (test == 2) {
  //     alert('choisir une seul bon de bon de livraison', function() {});
  //     return false
  //   }
  //   if (test == 1) {
  //     $('.testcheck').show();
  //     client = $('#client_id' + ligne).val();
  //     //alert("g");
  //     //alert(client)
  //     numero = $('#numero_id').val();

  //     if ($('.tes').val() == 0) {
  //       //alert("1");
  //       $('.tes').val(client);
  //       //alert(client);
  //       $('.tes').val(numero);
  //     }
  //   }
  //   if (test == 0) {
  //     //alert("2");
  //     //alert("fera8");
  //     $('.tes').val(0);
  //     $('.tespv').val(0);
  //     $('.testcheck').hide();
  //     //            $('.testcheckfc').hide();
  //   }
  // });
  $('.blfbree').on('click', function() {
    ligne = $(this).attr('ligne');
    index = $('#index2').val();
    test = 0;
    for (i = 0; i <= Number(index); i++) {
      if ($('#check' + i).is(':checked')) {
        test = 1;
      }
    }
    if (test == 1) {
      $('.testcheck').show();

      fournisseur = $('#fournisseur_id' + ligne).val();
      // alert(fournisseur);

      if ($('.tes').val() == 0) {
        $('.tes').val(fournisseur);
      }
      //alert($('.tes').val());
      if (($('.tes').val() != fournisseur) && $('.tes').val() != 0) {

        alert('Il faut choisir des BL pour un meme fournisseur ');
        return false;

      }

    }
    if (test == 0) {
      //alert("fera8");
      $('.tes').val(0);
      $('.tespv').val(0);
      $('.testcheck').hide();

    }
  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const numeroInput = document.querySelector('input[name="numero"]');
    const numeroblInput = document.querySelector('input[name="blfournisseur"]');

    // const datedebutInput = document.getElementById('datedebut');
    // const datefinInput = document.getElementById('datefin');
    const fournisseurIdSelect = document.getElementById('fournisseur_id');
    const searchForm = document.getElementById('searchForm');

    console.log('DOM entièrement chargé');

    if (numeroInput && numeroblInput && fournisseurIdSelect && searchForm) {
      console.log('Éléments de formulaire trouvés');

      // Fonction pour soumettre le formulaire
      function submitForm() {
        searchForm.submit();
      }

      // Événement pour soumettre le formulaire lorsqu'Entrée est pressé
      searchForm.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && (e.target !== numeroInput || e.target !== numeroblInput)) {
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
    $('.select2').select2();

    $('#example2').DataTable({
      'paging': true,
      'lengthChange': true,
      'searching': false,
      'ordering': false,
      'info': true,
      'autoWidth': false
    })
  })

  $(document).ready(function() {
    // Array to store selected values
    var selectedValues = [];

    // Function to update the input value
    function updateInput() {
      $('#result').val(selectedValues.join(','));
    }

    // Event listener for checkbox changes within the pagination container
    $('.content').on('change', 'input[type="checkbox"]', function() {
      var value = $(this).val();
      if ($(this).is(':checked')) {
        selectedValues.push(value);
      } else {
        var index = selectedValues.indexOf(value);
        if (index !== -1) {
          selectedValues.splice(index, 1);
        }
      }
      updateInput();
    });
  });
</script>
<?php $this->end(); ?>