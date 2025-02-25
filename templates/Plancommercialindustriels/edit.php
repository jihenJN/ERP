<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js" type="text/javascript"></script>

<?php echo $this->Html->script('safa'); ?>
<?php echo $this->fetch('script'); ?>
<?php echo $this->Html->css('select2'); ?>



<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Fournisseur $fournisseur
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>


    Modification Plan Commercial Industriel
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-reply"></i>
        <?php echo __('Retour'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="box ">
        <div class="box-header with-border">
          <h3 class="box-title"></h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <?php echo $this->Form->create($plancommercialindustriel, ['role' => 'form', 'onkeypress' => "return event.keyCode!=13"]);
        //debug($moisau);
        ?>

        <div id="my-div" style="overflow-x: scroll;">

          <div class="box-body">
            <div class="row">

              <div class="col-xs-6">
                <?php echo $this->Form->control('numero', ['readonly' => 'readonly', 'value' => $plancommercialindustriel->numero, 'label' => 'Numero', 'name', 'required' => 'off']); ?>
              </div>
              <div class="col-xs-6">
                <?php echo $this->Form->control('date', ['empty' => true]); ?>
              </div>
              <div class="col-xs-6">
                <label> Du </label>
                <select id="moisdu" class="form-control select2 " name="moisdu_id" value="<?php echo $moisdu ?>">
                  <option value="<?php echo  $moisdu ?>">Veuillez choisir </option>

                  <?php foreach ($mois as $j => $moi) {

                  ?>
                    <option <?php if ($moi->id == $moisdu) { ?> selected="selected" <?php } ?> value="<?php echo $moi->id; ?>"><?php echo $moi->name ?></option>
                  <?php } ?>

                </select>
              </div>
              <div class="col-xs-6">
                <label> Mois Au </label>
                <select id="moisau" class="form-control select2 articleblock   plan" name="moisau_id" value="<?php echo $moisau ?>">
                  <option value="<?php echo  $moisau ?>" selected="selected">Veuillez choisir </option>
                  <?php foreach ($mois as $j => $moi) {
                  ?>
                    <option <?php if ($moi->id == $moisau) { ?> selected="selected" <?php } ?> value="<?php echo $moi->id; ?>"><?php echo $moi->name ?></option>
                  <?php } ?>

                </select>

              </div>


              <div class="col-xs-6">

                <?php echo $this->Form->control('marge', ['required' => 'off', 'id' => 'marge', 'label' => 'marge(%)', 'div' => 'form-group', 'between' => '<div class="col-sm-10" >', 'after' => '</div>', 'class' => 'form-control']); ?>
              </div>



            </div>
            <div align="center">
            <button type='submit' class='btn btn-primary' >Enregistrer</button>
            </div>
          </div>
         

          <div id="divmp">

            <table style="width:100%" align="center" class="table table-bordered table-striped table-bottomless">
            
         
            <thead>
                <tr>
                  <td align="center" style="width: 50%;"><strong>Désignation</strong></td>
                  <td align="center" style="width :15%;"> <strong>Quantité Disponible</strong> </td>
                  <td align="center" style="width :15%;"> <strong>Qté cmd non liv</strong> </td>
                  <td align="center" style="width :15%;"> <strong>Qté Théorique</strong> </td>
                  <td align="center" style="width :15%;"> <strong>STOCK MIN ART</strong> </td>
                  <td align="center" style="width :15%;"> <strong>Qte LIV PERIODE</strong> </td>
                  <td align="center" style="width :15%;"> <strong>Qte vendue n-1</strong> </td>
                  <td align="center" style="width :15%;"> <strong>Besoin</strong> </td>
                  <td align="center" style="width :15%;"> <strong>QT OF NON CLOTURE PF</strong> </td>
                  <td align="center" style="width :15%;"> <strong>Besoin Production THEORIQUE periode</strong> </td>
                  <td align="center" style="width :15%;"> <strong>Besoin Production PRATIQUE</strong> </td>
                  <td align="center" style="width :15%;"> <strong>Lancer Vers PDP FORMULE</strong> </td>
                  <td align="center" style="width :15%;"> <strong>Rang</strong> </td>

                  <td align="center" style="width :15%;"> <strong>VENTE N-1 MOIS D4+1</strong> </td>
                  <td align="center" style="width :15%;"> <strong>QTE M1</strong> </td>
                  <td align="center" style="width :15%;"> <strong>VENTE N-1 MOIS D4+2</strong> </td>
                  <td align="center" style="width :15%;"> <strong>QTE M2</strong> </td>
                  <td align="center" style="width :15%;"> <strong>VENTE N-1 MOIS D4+3</strong> </td>
                  <td align="center" style="width :15%;"> <strong>QTE M3</strong> </td>


                </tr>
              </thead>
              <tbody>
                <?php foreach ($lignes as $j => $lp) {
                //dd($lp);
                  $ch = ""; ?>

                  <tr>

                    <td>


                      <input value=" <?php echo $lp['article_id'] ?>" type='hidden' champ="article_id" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][article_id]" class='form-control' , readonly>
                      <input value=" <?php echo $lp['article']['Code'], $lp['article']['Dsignation'] ?>" name="" class='form-control' , readonly>


                    </td>
                    <td><input value="<?php echo $lp['qtedisp'] ?>" champ="qtedisp" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtedisp]" class='form-control' , readonly></td>

                    <td><input value="<?php echo $lp['qtenonliv'] ?>" champ="qtenonliv" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtenonliv]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['qtetheo'] ?>" champ="qtetheo" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtetheo]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['stockminart'] ?>" champ="stockminart" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][stockminart]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['qtelivper'] ?>" champ="qtelivper" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtelivper]" class='form-control' , readonly></td>

                    <td><input value="<?php echo $lp['qtevendu'] ?>" champ="qtevendu" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtevendu]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['besoin'] ?>" champ="besoin" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][besoin]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['qtenoncloture'] ?>" champ="qtenoncloture" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtenoncloture]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['besoinprodtheoperiode'] ?>" champ="besoinprodtheoperiode" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][besoinprodtheoperiode]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['qtprodpratique'] ?>" champ="qtprodpratique" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtprodpratique]"  class='form-control' type='text' required ='true' oninput ='validity.valid||(value="")' pattern="^-?\d*\.?\d+$"> </td>

                    <td><select id='lancerpdp<?php echo $j ?>' class='form-control' name="data[Pci][<?php echo $j ?>][lancerpdp]" style='width:80px!important;' >
                      <option style='width:80px!important;'value='<?php echo "oui "?>' <?php echo ($lp['lancerpdp'] == 'oui') ? 'selected' : ''; ?>>oui</option>
                      <option value='<?php echo "non "?>' <?php echo ($lp['lancerpdp'] == 'non') ? 'selected' : ''; ?>>non</option>
                    </select>
                    </td>
                    
                    <td><input value="<?php echo $lp['rang'] ?>" champ="rang" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][rang]"  class='form-control' , readonly> </td>

                    <td><input value="<?php echo $lp['ventem1'] ?>" champ="ventem1" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][ventem1]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['qtem1'] ?>" champ="qtem1" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtem1]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['ventem2'] ?>" champ="ventem2" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][ventem2]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['qtem2'] ?>" champ="qtem2" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtem2]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['ventem3'] ?>" champ="ventem3" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][ventem3]" class='form-control' , readonly></td>
                    <td><input value="<?php echo $lp['qtem3'] ?>" champ="qtem3" index="<?php echo $j ?>" table="Pci" name="data[Pci][<?php echo $j ?>][qtem3]" class='form-control' , readonly></td>


                  </tr>


              </tbody>

            <?php } ?>

            </table>

          </div>
          <?= $this->Form->end() ?>
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

<?php $this->start('scriptBottom'); ?>
<script>
  $(function() {
    //Initialize Select2 Elements
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
<script>
  $(document).ready(function() {
    $('.plan').on('change', function() {
      //  alert('hello');
      //index = $(this).attr('index');//alert(index)
      //article_id = $('#article_id' + index).val() || 0;

      moisdu = $("#moisdu").val();
      moisau = $("#moisau").val();
      //alert(id)

      if (Number(moisau) < Number(moisdu) && moisau != '') {

        alert(' Entrez un MoisAu supérieur au MoisDu ');
        $('#moisau').val('');

      } else {
        $.ajax({
          method: "GET",
          url: "<?= $this->Url->build(['controller' => 'Plancommercialindustriels', 'action' => 'getplan']) ?>",
          dataType: "json",
          data: {
            moisau: moisau,
            moisdu: moisdu,
            //index:index,

          },
          headers: {
            'X-CSRF-Token': $('meta[name="csrfToken"]').attr('content')
          },
          success: function(data, status, settings) {
            alert(data.res);

            $('#divmp').html(data.res);
          },
          error: function(data) {
            //alert(data.res);
            $('#divmp').html(null);

          }

        })
      }
    });
  });
</script>
<script>
  function scrollPage() {
    var div = document.getElementById("my-div");
    div.scrollLeft = div.scrollWidth;
  }
  // Appel de la fonction scrollPage() lorsque la page est chargée.
  window.onload = function() {
    scrollPage();
  }
</script>
<?php $this->end(); ?>