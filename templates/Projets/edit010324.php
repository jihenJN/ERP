<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Projet $projet
 */
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('dhouha'); ?>
<section class="content-header">
  <h1>
    Modification Projet
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?>
      </a></li>
  </ol>
</section>
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <?php echo $this->Form->create($projet, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13", 'type' => 'file']); ?>
        <div class="box-body">
          <div class="row" style="color: blue">
            <div class="col-xs-6">
              <?php echo $this->Form->control('libelle', ['readonly' => 'readonly', 'class' => 'form-control ', 'champ' => 'name', 'label' => 'Réf.']); ?>
            </div>
            <div class="col-xs-6">
              <?php echo $this->Form->control('name', ['class' => 'form-control ', 'champ' => 'libelle', 'label' => 'Libellé.']); ?>
            </div>
          </div>
          <div class="row" style="margin-left:5px">
            <div class="col-xs-1">
              <h5><strong> USAGE </strong></h5>
            </div>
            <div class="col-xs-3">
              <label for="suivre_opportunite">Suivre une opportunité</label>
              <?php echo $this->Form->checkbox('suivre_opportunite', ['class' => 'form-check-input']); ?>
            </div>
            <div class="col-xs-3">
              <label for="suivre_tache">Suivre une tâche</label>
              <?php echo $this->Form->checkbox('suivre_tache', ['class' => 'form-check-input']); ?>
            </div>
            <div class="col-xs-3">
              <label for="facturer_temps_passe">Facturer le temps passé</label>
              <?php echo $this->Form->checkbox('facturer_temps_passe', ['class' => 'form-check-input']); ?>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6" style="color: blue">
            <?php echo $this->Form->control('client_id', ['empty' => 'Veuillez choisir un tier!!', 'class' => 'form-control select2', 'id' => 'client_id', 'label' => 'Tiers']); ?>
          </div>
          <div class="col-xs-6">
            <span><strong>Visibilité</strong></span>
            <select name="visibilite" class="form-control select2 control-label" id="visibilite">
              <option value="">Veuillez choisir !!</option>
              <option value="0" <?php if ($projet->visibilite = 0) { ?><?php echo 'selected="selected"' ?> <?php } ?>>
                Contacts projet </option>
              <option value="1" <?php if ($projet->visibilite = 1) { ?><?php echo 'selected="selected"' ?> <?php } ?>>
                Tout le monde</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6">
            <?php echo $this->Form->control('date', ['required' => 'off', 'id' => 'date', 'type' => 'date', 'class' => 'form-control', 'label' => 'Date debut']); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('datefin', ['required' => 'off', 'id' => 'date', 'type' => 'date', 'class' => 'form-control', 'label' => 'Date fin']); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6" style="color: blue">
            <?php echo $this->Form->control('opportunite_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!!', 'id' => 'opportunite_id', 'class' => 'form-control select2', 'label' => 'Statut opportunité']); ?>
            <?php //echo $this->Form->control('budget', ['required' => 'off', 'id' => 'budget', 'class' => 'form-control', 'label' => 'Budget']); 
            ?>
            <?php echo $this->Form->control('personnel_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!!', 'id' => 'personnel_id', 'class' => 'form-control ', 'style' => "pointer-events: none;", 'readonly', 'label' => 'Commercial']); ?>
            <?php //echo $this->Form->control('tags', ['required' => 'off', 'id' => 'budget', 'class' => 'form-control', 'label' => 'Tags/catégories']); 
            ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('devise_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!! ', 'id' => 'devise_id', 'class' => 'form-control select2', 'label' => 'Devise']); ?>
            <?php echo $this->Form->control('banque_id', ['required' => 'off', 'empty' => 'Veuillez choisir !!!! ', 'id' => 'banque_id', 'class' => 'form-control select2', 'label' => 'Banque']); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('montant', ['class' => 'form-control ', 'champ' => 'montant', 'label' => 'Montant opportunité']); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('budget', ['class' => 'form-control ', 'champ' => 'name', 'label' => 'Budget']); ?>
          </div>
          <div class="col-xs-6">
            <?php echo $this->Form->control('description', ['required' => 'off', 'id' => 'description', 'type' => 'textarea', 'class' => 'form-control', 'label' => 'Description']); ?>
          </div>
        </div>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_pdf' style=" float: right; margin-bottom: 5px;">
                  <i class="fa fa-plus-circle "></i> Ajouter fichier</a>
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabfichier">
                    <thead style="display:'none'">
                      <tr width:"20px">
                        <td align="center" style="width: 75%;"><strong>Fichier</strong></td>
                        <td align="center" style="width: 25%;"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // $f = 0;
                      // debug($lignes->toArray());
                      foreach ($fichierpdfs as $f => $fichierpdf) :
                        // debug($fichierpdf);
                      ?>
                        <tr>
                          <td align="center">
                            <input table="fichier" id="sup1<?php echo $f ?>" name="data[fichier][<?php echo $f ?>][sup1]" champ="sup1" index="<?php echo $f ?>" class="form-control" type="hidden">
                            <input type="hidden" value="<?php echo $fichierpdf['id']; ?>" name="data[fichier][<?php echo $f ?>][id]">
                            <?php echo $this->Form->control('pdff', ['name' => "data[fichier][$f][pdf]", 'class' => 'form-control', 'value' => $fichierpdf['fichier'], 'index' => $f, 'type' => 'file', 'label' => '', 'champ' => 'pdf', 'table' => 'fichier', 'width' => '50%']); ?>
                            <button type="button">
                              <?php $url = $_SERVER['HTTP_HOST']; ?>
                              <a onclick="openWindow(1000, 1000,'/genuis/img/logoclients/<?php echo $fichierpdf['fichier']; ?>');">
                                <i class="fa fa-eye text-orange"></i>
                              </a>
                            </button>
                            <!-- <?php echo $this->Html->image('logoclients/' . $fichierpdf['fichier'], ['style' => 'max-width:150px;height:100px;']); ?> -->
                            <p name="data[fichier][$f][pdf]">Fichier actuel : <?= h($fichierpdf['fichier']) ?></p>
                          </td>
                          <td align="center">
                            <i index="<?php echo $f ?>" id="" name="" class="fa fa-times supLigne1" style="color: #c9302c;font-size: 22px;"></i>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <tr class="tr" style="display: none !important">
                        <!--  <td style="width: 8%;" align="center">
                                <input type="hidden" name="" id="" champ="sup0" table="ligne" index="" class="form-control" >                              
                            </td>-->
                        <td align="center" style="width: 25%;">
                          <input table="fichier" id="" name="" champ="sup1" index="" class="form-control" type="hidden">
                          <?php echo $this->Form->control('pdf', ['class' => 'form-control', 'type' => 'file', 'label' => '', 'champ' => 'pdf', 'table' => 'fichier',]); ?>
                          <!-- <input table="ligne" id="" name=""champ="personnel_id" index="" class="form-control"> -->
                        </td>
                        <td align="center" style="width: 25%;">
                          <i index="0" id="" name="" class="fa fa-times supLigne1" style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>
                      <input type="hidden" value="<?php echo $f ?>" id="index0">
                    </tbody>
                  </table><br>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="content-header">
          <h1 class="box-title">
            <?php echo __('Les responsables'); ?>
          </h1>
        </section>
        <section class="content" style="width: 99%">
          <div class="row">
            <div class="box">
              <div class="box-header with-border">
                <a class="btn btn-primary  " table='addtable' index='index' id='ajouter_ligne0' style="
                                       float: right;
                                       margin-bottom: 5px;
                                       ">
                  <i class="fa fa-plus-circle "></i> Ajouter responsable</a>
              </div>
              <div class="panel-body">
                <div class="table-responsive ls-table">
                  <table class="table table-bordered table-striped table-bottomless" id="tabligne0">
                    <thead>
                      <tr width:"20px">
                        <td align="center" style="width: 25%;"><strong>Nom du responsable</strong></td>

                        <td align="center" style="width: 25%;"></td>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $i = 0;

                      foreach ($lignes as $i => $ligne) :
                        // dd($ligne);
                      ?>
                        <tr>


                          <td align="center">
                            <input table="ligne" id="sup1<?php echo $i ?>" name="data[ligne][<?php echo $i ?>][sup1]" champ="sup1" index="<?php echo $i ?>" class="form-control" type="hidden">
                            <?php echo $this->Form->control('personnel_id', ['value' => $ligne['personnel_id'], 'required' => 'off', 'index' => $i, 'id' => 'personnel_id' . $i, 'name' => 'data[ligne][' . $i . '][personnel_id]', 'champ' => 'personnel_id', 'table' => 'ligne', 'empty' => 'Veuillez choisir !!!!', 'class' => 'form-control', 'label' => '']); ?>

                            <!-- <input table="ligne" id="" name=""champ="personnel_id" index="" class="form-control"> -->
                          </td>
                          <td align="center">
                            <i index="<?php echo $i ?>" id="" name="" class="fa fa-times supLigne1" style="color: #c9302c;font-size: 22px;"></i>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                      <tr class="tr" style="display: none !important">

                        <td align="left">
                          <input table="ligne" id="" name="" champ="sup1" index="" class="form-control" type="hidden">
                          <?php echo $this->Form->control('personnel_id', ['required' => 'off', 'index' => '', 'id' => '', 'name' => '', 'champ' => 'personnel_id', 'table' => 'ligne', 'empty' => 'Veuillez choisir !!!!', 'class' => 'form-control', 'label' => '']); ?>
                        </td>

                        <td align="center">
                          <i index="" id="" class="fa fa-times supLigne1" style="color: #c9302c;font-size: 22px;"></i>
                        </td>
                      </tr>


                    </tbody>
                  </table><br>
                  <input type="hidden" value="<?php echo $i ?>" id="index0">
                </div>
              </div>
            </div>
          </div>

        </section>




        <div align="center">
          <?php echo $this->Form->submit('Modifier', ['id' => 'verifenr']); ?>
        </div>

        <?php echo $this->Form->end(); ?>
      </div>
      <!-- /.box -->
    </div>
  </div>
  <!-- /.row -->
</section>


<script>
  $('#verifenr').on('click', function() {
    libelle = $('#libelle').val();
    name = $('#name').val();
    client_id = $('#client_id').val();
    opportunite_id = $('#opportunite_id').val();

    if (libelle === '') {
      alert('veuillez remplir le champ Libelle');
      event.preventDefault();
    } else if (name === '') {
      alert('veuillez remplir le champ  Reference')
      event.preventDefault();
    } else if (client_id === '') {
      alert('veuillez remplir le champ  Client')
      event.preventDefault();
    } else if (opportunite_id === '') {
      alert('veuillez remplir le champ  opportunite')
      event.preventDefault();
    }
  });
</script>

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

<?php $this->start('scriptBottom'); ?>
<style>
  .select2-selection__rendered {
    line-height: 25px !important;
  }

  .select2-container .select2-selection--single {
    height: 35px !important;
    border-radius: 0 !important;
    box-shadow: none !important;
    border-color: #D2D6DE !important;
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
  function openWindow(h, w, url) {
    leftOffset = (screen.width / 2) - w / 2;
    topOffset = (screen.height / 2) - h / 2;
    window.open(url, this.target, 'left=' + leftOffset + ',top=' + topOffset + ',width=' + w + ',height=' + h + ',resizable,scrollbars=yes');
  }
</script>
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    // $("#verifenr").on("mouseover", function () {
    //   client_id = $("#client_id").val();//alert(client_id)
    //   opportunite_id = $("#opportunite_id").val();
    //   if (client_id == "") {
    //     alert("Veuillez choisir un tier !!", function () { });
    //     return false;
    //   } if (opportunite_id == "") {
    //     alert("Veuillez choisir une Statut opportunit� !!", function () { });
    //     return false;
    //   }
    // });
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
    //Date range as a button
    $('#daterange-btn').daterangepicker({
        ranges: {
          'Today': [moment(), moment()],
          'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days': [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month': [moment().startOf('month'), moment().endOf('month')],
          'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate: moment()
      },
      function(start, end) {
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<?php $this->end(); ?>