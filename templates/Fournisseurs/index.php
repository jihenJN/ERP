<script>
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');

  }
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>


<section class="content-header">
  <header>
    <h1 style="text-align:center;"> Fournisseurs</h1>
  </header>
</section>


<?php echo $this->Html->script('controle_frs'); ?>
<?php echo $this->Html->script('hela'); ?>
<?php echo $this->Html->css('select2'); ?>
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
  if (@$liens['lien'] == 'fournisseurs') {
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
      <div class="row">
        <?php echo $this->Form->create($fournisseurs, ['id' => 'searchForm', 'type' => 'get']); ?>
        <div class="col-xs-2">
          <?php
          echo $this->Form->control('name', ['label' => 'Nom', 'id' => 'name', 'value' => $this->request->getQuery('name'), 'name', 'required' => 'off']); ?>
        </div>
        <div class="col-xs-2">
          <div class="form-group input text required">
            <label class="control-label" for="name">Type localisation</label>
            <select class="form-control select2" name="typelocalisation_id" id="typelocalisation_id">
              <option value="" <?= empty($this->request->getQuery('typelocalisation_id')) ? 'selected' : '' ?>>Veuillez choisir !!</option>
              <?php foreach ($typelocalisations as $id => $point) { ?>
                <option value="<?= $id ?>" <?= $id == $this->request->getQuery('typelocalisation_id') ? 'selected' : '' ?>><?= $point ?></option>
              <?php } ?>
            </select>

          </div>
        </div>
        <div class="col-xs-2">
          <div class="form-group input text required">
            <label class="control-label" for="name">Mode paiement</label>
            <select class="form-control select2" name="paiement_id" id="paiement_id">
              <option value="" <?= empty($this->request->getQuery('paiement_id')) ? 'selected' : '' ?>>Veuillez choisir !!</option>
              <?php foreach ($paiements as $id => $point) { ?>
                <option value="<?= $id ?>" <?= $id == $this->request->getQuery('paiement_id') ? 'selected' : '' ?>><?= $point ?></option>
              <?php } ?>
            </select>

          </div>
        </div>

        <!-- <div class="col-xs-2">
          <div class="form-group input text required">
            <label class="control-label" for="name">Type utilisateur</label>
            <select class="form-control select2" name="typeutilisateur_id" id="typeutilisateur_id">
              <option value="" <?= empty($this->request->getQuery('typeutilisateur_id')) ? 'selected' : '' ?>>Veuillez choisir !!</option>
              <?php foreach ($typeutilisateurs as $id => $point) { ?>
                <option value="<?= $id ?>" <?= $id == $this->request->getQuery('typeutilisateur_id') ? 'selected' : '' ?>><?= $point ?></option>
              <?php } ?>
            </select>
          </div>
        </div> -->


        <div class="col-xs-2">
          <?php
          echo $this->Form->control('compte_comptable', ['id' => 'compte_comptable', 'label' => 'Compte comptable ', 'required' => 'off', 'value' => $this->request->getQuery('compte_comptable'), 'autocomplete' => '']); ?>
        </div>
        <div class="col-xs-1">
          <button type="submit" style="margin-top: 25px;" id="searchButton" class="btn btn-default custom-width-button">
            <i class="fa fa-search"></i>
          </button>

        </div>
        <div class="col-xs-1" style="text-align: center; margin-top: 25px;">
          <?php echo $this->Html->link(__(''), ['action' => 'index'], ['class' => 'btn btn-default btn-large fa fa-remove', 'style' => 'width: 37px; height: 35px; display: flex; justify-content: center; align-items: center;']) ?>
        </div>
        <?php echo $this->Form->end(); ?>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header">
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th hidden scope="col"><?= h('id') ?></th>

                <th scope="col"><?= h('Nom') ?></th>
                <th scope="col"><?= h('Compte comptable') ?></th>
                <th scope="col"><?= h('Type utilisateur') ?></th>
                <th scope="col"><?= h('Type localisation') ?></th>
                <th scope="col"><?= h('Mode paiement') ?></th>
                <th scope="col" class="actions text-center"><?= __('Actions') ?></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($fournisseurs as $i => $fournisseur) : ?>
                <tr>
                  <?php echo $this->Form->control('id', ['type' => 'hidden', 'index' => $i, 'id' => 'id' . $i, 'value' => $fournisseur->id, 'label' => '', 'champ' => 'id', 'class' => 'form-control']); ?>

                  <td>
                    <?php
                    if (isset($fournisseur->name)) {
                      echo  h($fournisseur->name);
                    } ?>
                  </td>
                  <td>
                    <?php
                    if (isset($fournisseur->compte_comptable)) {
                      echo  h($fournisseur->compte_comptable);
                    } ?>
                  </td>
                  <td>
                    <?php
                    if (isset($fournisseur->typeutilisateur)) {
                      echo  h($fournisseur->typeutilisateur->name);
                    } ?>
                  </td>
                  <td>
                    <?php
                    if (isset($fournisseur->typelocalisation)) {
                      echo  h($fournisseur->typelocalisation->name);
                    } ?>
                  </td>

                  <td>
                    <?php
                    if (isset($fournisseur->paiement)) {
                      echo  h($fournisseur->paiement->name);
                    } ?>
                  </td>
                  <td class="actions text-right">
                    <?php echo $this->Html->link("<button class='btn btn-xs btn-success'><i class='fa fa-search'></i></button>", array('action' => 'view', $fournisseur->id), array('escape' => false)); ?>
                    <?php if ($edit == 1) {
                      echo $this->Html->link("<button class='btn btn-xs btn-warning'><i class='fa fa-edit'></i></button>", array('action' => 'edit', $fournisseur->id), array('escape' => false));
                    } ?>

                    <?php if ($delete == 1) { ?>

                      <button index='<?php echo $i ?>' class='verifiercmd btn btn-xs btn-danger'><i class='fa fa-trash-o'></i></button>

                      <!-- <button type='button' index='<?php echo $i; ?>' class='verifiercmd btn btn-xs btn-danger deletetest'><i class='fa fa-trash-o'></i></button> -->

                    <?php   //  echo $this->Form->postLink("<button class='btn btn-xs btn-danger deleteConfirm'><i class='fa fa-trash-o'></i></button>", array('action' => 'delete',  $fournisseur->id), array('escape' => false, null), __('Veuillez vraiment supprimer cette enregistrement # {0}?',  $fournisseur->id));
                    } ?>
                  </td>

                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <input type="hidden" value="<?php echo $i ?>" id="index">

        </div>
      </div>
    </div>
  </div>
</section>
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- iCheck for checkboxes and radio inputs -->
<?php echo $this->Html->css('AdminLTE./plugins/iCheck/all', ['block' => 'css']); ?>
<!-- Bootstrap Color Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min', ['block' => 'css']); ?>
<!-- Bootstrap time Picker -->
<?php echo $this->Html->css('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->css('AdminLTE./bower_components/select2/dist/css/select2.min', ['block' => 'css']); ?>
<!-- Select2 -->
<?php echo $this->Html->script('AdminLTE./bower_components/select2/dist/js/select2.full.min', ['block' => 'script']); ?>
<!-- InputMask -->
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.date.extensions', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/input-mask/jquery.inputmask.extensions', ['block' => 'script']); ?>
<!-- date-range-picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- bootstrap datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- bootstrap color picker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min', ['block' => 'script']); ?>
<!-- bootstrap time picker -->
<?php echo $this->Html->script('AdminLTE./plugins/timepicker/bootstrap-timepicker.min', ['block' => 'script']); ?>
<!-- iCheck 1.0.1 -->
<?php echo $this->Html->script('AdminLTE./plugins/iCheck/icheck.min', ['block' => 'script']); ?>

<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net/js/jquery.dataTables.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/datatables.net-bs/js/dataTables.bootstrap.min', ['block' => 'script']); ?>
<?php echo $this->Html->css('AdminLTE./bower_components/datatables.net-bs/css/dataTables.bootstrap.min', ['block' => 'css']); ?>
<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {

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
  $(function() {
    $('.verifiercmd').on('click', function() {
      // alert('hello');
      ind = $(this).attr('index');
      //  alert(ind);
      fournisseurId = $('#id' + ind).val();
      //  alert(id);
      //  alert(id)
      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Fournisseurs', 'action' => 'getfourcmd']) ?>",
        dataType: "json",
        data: {
          fournisseurid: fournisseurId
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data) {
          //   $('#pays').html(data.pays);
          //  alert(data.pays);


          if (data.fournisseurs != 0) {
            alert("Existe dans un autre document");

          } else {
            if (confirm('Voulez vous vraiment supprimer cet enregistrement')) {
              document.location = wr + "fournisseurs/delete/" + fournisseurId;
            }
          }
        }
      })
    });

  });
</script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.querySelector('input[name="name"]');
    const locIdSelect = document.getElementById('typelocalisation_id');
    const paiIdSelect = document.getElementById('paiement_id');
    const typeIdSelect = document.getElementById('typeutilisateur_id');
    const compteInput = document.getElementById('compte_comptable');

    const searchForm = document.getElementById('searchForm');

    console.log('DOM entièrement chargé');

    if (nameInput && locIdSelect && paiIdSelect && typeIdSelect && compteInput && searchForm) {
      console.log('Éléments de formulaire trouvés');

      // Fonction pour soumettre le formulaire
      function submitForm() {
        searchForm.submit();
      }

      // Événement pour soumettre le formulaire lorsqu'Entrée est pressé
      document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && (e.target !== nameInput || e.target !== locIdSelect || e.target !== paiIdSelect || e.target !== typeIdSelect || e.target !== compteInput)) {
          e.preventDefault();
          submitForm();
        }
      });

      // Événement pour soumettre le formulaire lorsqu'un changement est apporté au fournisseurIdSelect
      nameInput.addEventListener('change', function() {
        submitForm();
      });
    } else {
      console.log('Éléments de formulaire non trouvés');
    }
  });
</script>

<script>
  $(function() {
    $('.verifiercmd07112024').on('click', function() {
      let ind = $(this).attr('index');
      let id = $('#id' + ind).val();

      $.ajax({
        method: "GET",
        url: "<?= $this->Url->build(['controller' => 'Fournisseurs', 'action' => 'veriffournisseursup']) ?>",
        dataType: "json",
        data: {
          id: id
        },
        headers: {
          'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
        },
        success: function(data, status, settings) {
          if (data.Fournisseurs != 0) {
            alert('existe dans un document');
          } else {
            if (confirm('Voulez-vous supprimer cet enregistrement')) {
              document.location = wr+"Fournisseurs/delete/" + id;
            }
          }
        }
      });
    });
  });
</script>


<script language="JavaScript" type="text/javascript">
  $(function() {
    $('.deleteConfirm').on('click', function() {

      return confirm('Voulez vous supprimer cette enregistrement? ');

    });


  });
</script>
<?php $this->end(); ?>